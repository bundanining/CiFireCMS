<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Admin_controller {

	public $mod = 'post';
	public $pk;

	public function __construct()
	{
		parent::__construct();
		
		$this->lang->load('mod/'.$this->mod, $this->_language);
		$this->meta_title(lang_line('mod_title'));
		$this->load->model('mod/post_model');
	}


	public function index() 
	{
		if ( $this->read_access )
		{
			if ( $this->input->is_ajax_request() )
			{
				$data_output = array();
				foreach ( $this->post_model->get_datatables() as $res )
				{
					$row = [];
					$row[] = '<div class="text-center"><input type="checkbox" class="row_data" value="'. encrypt($res['post_id']) .'"></div>';

					$headline = ( $res['post_headline'] == 'Y' ? '<span class="h-'. $res['post_id'] .'"><i class="fa fa-star text-warning"></i> Headline</span>' : '<span class="h-'. $res['post_id'] .'"></span>');
					
					// Title
					$row[] = '<div><a href="'. post_url($res['post_seotitle']) .'" target="_blank">'. $res['post_title'] .'</a></div> <div class="badge badge-pill mt-2 pl-2 pr-2" style="background-color:#f1f1f1;font-size:12px;color:#777;"> <span class="mr-2"><i class="fa fa-calendar mr-2"></i>'. ci_date($res['post_datepost'] . $res['post_timepost'],'l, d F Y, h:i A') .'</span> <span class="mr-2"><i class="fa fa-user mr-2"></i>'. $res['user_name'] .'</span> <span class="mr-2"><i class="fa fa-eye mr-2"></i>'. $res['post_hits'] .'</span> <span class="mr-2"><i class="fa fa-comments mr-2"></i>'. $res['comments'] .'</span> '. $headline .'</div> ';

					// category
					$row[] = $res['category_title'];

					// status
					$row[] = ($res['post_active'] == 'Y' ? '<span class="badge badge-b badge-pill badge-primary">Active</span>' : '<span class="badge badge-b badge-pill badge-secondary">No</span>');

					// Action
					$h = ( $res['post_headline']=='Y' ? 'hedline_off' : 'headline_on' );
					$row[] = '<div class="text-center"><div class="btn-group">
							<button type="button" class="button btn-xs btn-default headline_toggle" data-toggle="tooltip" data-placement="top" data-title="Headline" data-id="'. encrypt($res['post_id']) .'"><i class="fa fa-star"></i></button>
							<a href="'. admin_url($this->mod.'/edit/'.$res['post_id']) .'" class="button btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="'. lang_line('button_edit') .'"><i class="icon-pencil3"></i></a>
							<button type="button" class="button btn-xs btn-default delete_single" data-toggle="tooltip" data-placement="top" data-title="'. lang_line('button_delete') .'" data-pk="'. encrypt($res['post_id']) .'"><i class="icon-bin"></i></button>
							</div></div>';
					
					$data_output[] = $row;
				}

				$output = array(
								"data" => $data_output,
								"draw" => $this->input->post('draw'),
								"recordsTotal" => $this->post_model->count_all(),
								"recordsFiltered" => $this->post_model->count_filtered()
								);

				$this->json_output($output);
			}
			else
			{
				$this->render_view('view_index', $this->vars);
			}
		}
		else
		{
			$this->render_403();
		}
	}


	public function headline()
	{
		if ( $this->input->is_ajax_request() && $this->modify_access )
		{
			$this->pk = decrypt($this->input->post('pk'));
			
			$query_headline = $this->db
				->select('id,headline')
				->where('id', $this->pk)
				->get('t_post');

			if ( $query_headline->num_rows() == 1 )
			{
				$post = $query_headline->row_array();
				$headline = ( $post['headline'] == 'Y' ? 'N' : 'Y');
				$data = [
					'headline' => $headline
				];

				$this->post_model->update_post($this->pk, $data);

				$response['status'] = true;
				$response['index'] = 'h-'.$this->pk;
				$response['html'] = ( $headline == 'Y' ? '<i class="fa fa-star text-warning"></i> Headline' : '' );
				$response['alert']['type'] = 'alert';
				$response['alert']['content'] = ( $headline == 'Y' ? '<i class="fa fa-exclamation-circle mr-2"></i> Headline ON' : '<i class="fa fa-exclamation-circle mr-2"></i> Headline OFF' );
			}
			else
			{
				$response['status'] = false;
				$response['alert']['type'] = 'error';
				$response['alert']['content'] = 'Error';
			}

			$this->json_output($response);
		}
		else
		{
			show_403();
		}
	}


	public function delete()
	{
		if ( $this->input->is_ajax_request() && $this->delete_access )
		{
			$data_pk = $this->input->post('data');
			foreach ($data_pk as $key)
			{
				$pk = xss_filter(decrypt($key),'sql');
				$this->post_model->delete($pk);
			}
			$response['success'] = true;
			$response['alert']['type'] = 'success';
			$response['alert']['content'] = lang_line('form_message_delete_success');
			$this->json_output($response);
		}
		else
		{
			show_403();
		}
	}


	public function add_new() 
	{
		if ( $this->write_access ) 
		{
			if ( $this->input->is_ajax_request() ) // submit add new post.
			{
				$this->form_validation->set_rules(array(
					array(
						'field' => 'title',
						'label' => lang_line('form_label_title'),
						'rules' => 'required|trim|min_length[6]|max_length[150]|callback__cek_add_seotitle'
					),
					array(
						'field' => 'category',
						'label' => lang_line('form_label_category'),
						'rules' => 'required|trim'
					),
					array(
						'field' => 'content',
						'label' => lang_line('form_label_content'),
						'rules' => 'required'
					)
				));

				if ( $this->form_validation->run() ) 
				{
					$tags_input = $this->input->post('tags');
					$tags_input_s = explode(',', $tags_input);
					
					$tags = '';
					foreach ($tags_input_s as $tval) 
					{
						$tag_title = clean_tag($tval);
						$tag_seotitle = seotitle($tval,'');

						$this->load->model('mod/tag_model'); // Load tag_model
						
						if ( $this->tag_model->cek_seotitle($tag_seotitle) == TRUE )
						{
							$this->tag_model->insert(array(
								'title' => $tag_title,
								'seotitle' => $tag_seotitle
							));
						}

						$tags .= $tag_seotitle.',';	
					}
					$tags = rtrim($tags, ',');
					
					$date_post = (empty($this->input->post('datepost')) ? date('Y-m-d') : date('Y-m-d', strtotime($this->input->post('datepost'))));
					$headline = ($this->input->post('headline') == '1' ? 'Y' : 'N');
					$active   = ($this->input->post('active') == '1' ? 'Y' : 'N');
					$comment  = ($this->input->post('comment') == '1' ? 'Y' : 'N');
					$title    = xss_filter($this->input->post('title'));
					$seotitle = seotitle($title);

					$data_post = array(
						'title'         => $title,
						'seotitle'      => $seotitle,
						'content'       => xss_filter($this->input->post('content')),
						'id_category'   => xss_filter(decrypt($this->input->post('category')),'sql'),
						'tag'           => $tags,
						'picture'       => xss_filter($this->input->post('picture')),
						'image_caption' => xss_filter($this->input->post('image_caption')),
						'datepost'      => $date_post,
						'timepost'      => xss_filter($this->input->post('timepost').':'.date('s')),
						'id_user'       => login_key('admin'),
						'headline'      => $headline,
						'comment'       => $comment,
						'active'        => $active,
					);

					$this->post_model->insert_post($data_post);
					$this->alert->set($this->mod, 'success', lang_line('form_message_add_success'));
					$response['success'] = true;
				}
				else
				{
					$response['success'] = false;
					$response['alert']['type'] = 'error';
					$response['alert']['content'] = validation_errors();
				}

				$this->json_output($response);
			}

			else
			{
				$this->vars['all_category'] = $this->post_model->get_all_category();
				$this->vars['all_tag'] = $this->post_model->get_all_tag();
				$this->vars['all_user'] = $this->post_model->get_all_user();
				$this->render_view('view_add_new', $this->vars);
			}
		}
		else 
		{
			$this->render_403();
		}
	}


	public function edit($id_post = '') 
	{
		if ( $this->modify_access )
		{
			$id_post = xss_filter($id_post,'sql');

			if ( !empty($id_post) || $this->post_model->cek_id($id_post) == 1 ) 
			{
				if ( $this->input->is_ajax_request() )  // submit update.
				{
					$this->form_validation->set_rules(array(
						array(
							'field' => 'title',
							'label' => lang_line('form_label_title'),
							'rules' => 'required|trim|min_length[6]|max_length[150]|callback__cek_edit_seotitle',
						),
						array(
							'field' => 'category',
							'label' => lang_line('form_label_category'),
							'rules' => 'trim|required',
						),
						array(
							'field' => 'content',
							'label' => lang_line('form_label_content'),
							'rules' => 'required',
						),
						array(
							'field' => 'content',
							'label' => lang_line('form_label_content'),
							'rules' => 'required',
						),
					));

					if ( $this->form_validation->run() ) 
					{
						$tag_input = $this->input->post('tags');
						$tag_input_s = explode(',', $tag_input);
						$tags = '';
						foreach ( $tag_input_s as $tval ) 
						{
							$tag_title = clean_tag($tval);
							$tag_seotitle = seotitle($tval,'');

							$this->load->model('mod/tag_model'); // Load tag_model
							
							if ( $this->tag_model->cek_seotitle($tag_seotitle) == TRUE )
							{
								$this->tag_model->insert(array(
									'title' => $tag_title,
									'seotitle' => $tag_seotitle
								));
							}

							$tags .= $tag_seotitle.',';	
						}
						$tags = rtrim($tags, ',');
						
						$input_category = decrypt($this->input->post('category'));
						$id_category = (!empty($input_category) ? $input_category : '1');
						$headline = ($this->input->post('headline') == '1' ? 'Y' : 'N');
						$comment = ($this->input->post('comment') == '1' ? 'Y' : 'N');
						$active = ($this->input->post('active') == '1' ? 'Y' : 'N');
						$title = xss_filter($this->input->post('title'));
						$seotitle = seotitle($title);

						if ( user_level('level') == 'super-admin' || user_level('level') == 'admin' )
						{
							$data = array(
								'title'        => $title,
								'seotitle'     => $seotitle,
								'content'      => xss_filter($this->input->post('content')),
								'id_category'  => $id_category,
								'tag'          => $tags,
								'picture'      => xss_filter($this->input->post('picture')),
								'image_caption' => xss_filter($this->input->post('image_caption')),
								'datepost'     => date('Y-m-d', strtotime(xss_filter($this->input->post('datepost')))),
								'timepost'     => xss_filter($this->input->post('timepost')),
								'id_user'      => xss_filter($this->input->post('author'), 'sql'),
								'headline'     => $headline,
								'comment'      => $comment,
								'active'       => $active,
							);
						}
						else
						{
							$data = array(
								'title'         => $title,
								'seotitle'      => $seotitle,
								'content'       => xss_filter($this->input->post('content')),
								'id_category'   => $id_category,
								'tag'           => $tags,
								'picture'       => xss_filter($this->input->post('picture')),
								'image_caption' => xss_filter($this->input->post('image_caption')),
								'headline'      => $headline,
								'comment'       => $comment,
								'active'        => $active,
							);	
						}

						$this->post_model->update_post($id_post, $data);

						$response['success'] = true;
						$response['alert']['type'] = 'success';
						$response['alert']['content'] = lang_line('form_message_update_success');
					}
					else
					{
						$response['success'] = false;
						$response['alert']['type'] = 'error';
						$response['alert']['content'] = validation_errors();
					}

					$this->json_output($response);
				}

				else
				{
					$this->vars['result_post']  = $this->post_model->get_post($id_post);
					$this->vars['all_category'] = $this->post_model->get_all_category();
					$this->vars['all_user']     = $this->post_model->get_all_user();
					$this->render_view('view_edit', $this->vars);
				}
			}
			else
			{
				$this->render_404();
			}
		}
		else 
		{
			$this->render_403();
		}
	}


	public function ajax_get_category()
	{
		if ( $this->input->is_ajax_request() && $this->read_access ) 
		{		
			$data_output = null;
			$params = trim($this->input->post('search'));

			$query = $this->db
				   ->where('active', 'Y')
				   ->like('title', $params)
				   ->get('t_category');

			if ( $query->num_rows() > 0 )
			{
				foreach ( $query->result_array() as $res ) 
				{
					$row = [];
					$row['id'] = encrypt($res['id']);
					$row['text'] = $res['title'];
					$rowOutput[] = $row;
				}

				$data_output = $rowOutput;
			}
			else
			{
				$getAll = $this->db
						->where('active', 'Y')
						->get('t_category')
						->result_array();

				foreach ( $getAll as $res ) 
				{
					$row = [];
					$row['id'] = encrypt($res['id']);
					$row['text'] = $res['title'];
					$rowOutput[] = $row;
				}

				$data_output = $rowOutput;
			}

			$this->json_output($data_output);
		}
		else
		{
			show_404();
		}
	}


	public function ajax_tags()
	{
		if ( $this->input->is_ajax_request() && $this->read_access )
		{
			$input = seotitle($this->input->post('seotitle'));
			$output = $this->post_model->ajax_tags($input);
			$this->json_output($output);
		}
		else
		{
			show_404();
		}
	}


	public function _cek_add_seotitle($seotitle = '') 
	{
		$cek = $this->post_model->cek_seotitle(seotitle($seotitle));

		if ( $cek === FALSE ) 
		{
			$this->form_validation->set_message('_cek_add_seotitle', lang_line('form_message_already_exists'));
		}
		
		return $cek;
	}


	public function _cek_edit_seotitle($seotitle = '') 
	{
		$id_post = $this->uri->segment(4);
		$cek = $this->post_model->cek_seotitle2($id_post, seotitle($seotitle));
		
		if ( $cek === FALSE ) 
		{
			$this->form_validation->set_message('_cek_edit_seotitle', lang_line('form_message_already_exists'));
		} 

		return $cek;
	}
} // End class.
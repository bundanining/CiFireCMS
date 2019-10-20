<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends Admin_controller {

	public $mod = 'comment';
	public $pk;

	public function __construct() 
	{
		parent::__construct();
		
		$this->lang->load('mod/'.$this->mod, $this->_language);
		$this->meta_title(lang_line('mod_title'));
		$this->load->model('mod/comment_model', 'mod_model');
	}


	public function index()
	{
		if ( $this->read_access )
		{
			if ( $this->input->is_ajax_request() )
			{
				$data_list = $this->mod_model->get_datatables();
				$data_output = array();

				foreach ($data_list as $val) 
				{
					$row = [];
					$row[] = '<div class="text-center"><input type="checkbox" class="row_data" value="'. encrypt($val['id']) .'"></div>';
					
					if ($val['active'] == 'N')
					{
						$valactive = '<i id="active'.$val['id'].'" class="fa fa-commenting text-success"></i>';
					} 
					elseif ($val['active'] == 'Y')
					{
						$valactive = '<i id="active'.$val['id'].'" class="fa fa-commenting-o text-muted"></i>';
					} 
					else 
					{
						$valactive = '<i id="active'.$val['id'].'" class="fa fa-ban text-danger"></i>';
					}

					$row[] = $valactive;
					$row[] = $val['name'];

					$post = $this->db
						->select('title,seotitle')
						->where('id', $val['id_post'])
						->get('t_post')
						->row_array();

					$row[] = '<div>'.cut($val['comment'],60,TRUE).'...</div><div><small>Post : <a href="'.post_url($post['seotitle']).'" target="_blank">'.$post['title'].'</a></small></div>';
					
					$row[] = ci_date($val['date'], 'd M Y, h:i A');

					if ($val['active'] == 'X') 
					{
						$btn_block = '<span id="btn_block_'.$val['id'].'" class="button btn-xs btn-default modal_active" data-toggle="tooltip" data-placement="top" data-title="'.lang_line('button_active').'" idCom="'.$val['id'].'"><i class="fa fa-check"></i></span>';
					}
					else
					{
						$btn_block = '<span id="btn_block_'.$val['id'].'" class="button btn-xs btn-default modal_block" data-toggle="tooltip" data-placement="top" data-title="'.lang_line('button_block').'" idCom="'.$val['id'].'"><i class="fa fa-ban"></i></span>';
					}
					$row[] = '<div class="text-center"> <div class="btn-group">
					 <span class="button btn-xs btn-default modal_detail" data-toggle="tooltip" data-placement="top" data-title="'.lang_line('button_view').'" idDet="'.$val['id'].'"><i class="fa fa-eye"></i></span> 

					'.$btn_block.'

					<button type="button" class="button btn-xs btn-default delete_single" data-toggle="tooltip" data-placement="top" data-title="'. lang_line('button_delete') .'" data-pk="'. encrypt($val['id']) .'"><i class="icon-bin"></i></button>
					 </div> </div>';
					$data_output[] = $row;
				}

				$output = array(
								"draw"            => $this->input->post('draw'),
								"recordsTotal"    => $this->mod_model->count_all(),
								"recordsFiltered" => $this->mod_model->count_filtered(),
								"data"            => $data_output,
								);

				$this->json_output($output);
			}

			if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
			{
				// block.
				if ( $this->modify_access && $this->_act == 'block' )
				{
					$id_cblock = xss_filter($this->input->post('id'),'sql');

					$this->mod_model->block_comment($id_cblock);

					redirect(uri_string());
				}

				// unblock
				elseif ( $this->modify_access && $this->_act == 'unblock' )
				{
					$id_cblock = xss_filter($this->input->post('id'),'sql');
					$this->mod_model->unblock_comment($id_cblock);
					redirect(uri_string());
				}

				else
				{
					$this->render_403();
				}
			} 
			
			$this->render_view('view_index', $this->vars);
		}
		else
		{
			$this->render_403();
		}
	}


	public function view_detail($id = '')
	{
		if ( !empty($id) && $this->input->is_ajax_request() ) 
		{
			$id = xss_filter($id, 'sql');
			
			if ( $this->read_access && $this->modify_access )
			{
				$result = $this->mod_model->get_comment($id);
				$_output= $result;
				$_output['comment'] = $result['comment'];
				$_output['date'] = ci_date($result['date'], 'd M Y, h:i A');
				
				if ($_output['active'] == "X") 
				{
					$_output['textClass'] = "text-danger";
					$_output['icon'] = "fa-ban";
				}
				else
				{
					$_output['textClass'] = "text-muted";
					$_output['icon'] = "fa-commenting-o";
					$this->mod_model->update($id, array('active'=>'Y'));
				}

				$this->json_output($_output);
			}
			else
			{
				$this->render_403();
			}
		}
		else
		{
			show_404();
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
				$this->mod_model->delete($pk);
			}
			$response['success'] = true;
			$response['alert']['type'] = 'success';
			$response['alert']['content'] = lang_line('form_message_delete_success');
			$this->json_output($response);
		}
		else
		{
			show_404();
		}
	}
} // End class.
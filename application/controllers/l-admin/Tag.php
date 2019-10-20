<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends Admin_controller {

	public $mod = 'tag';

	public function __construct() 
	{
		parent::__construct();
		
		$this->lang->load('mod/'.$this->mod, $this->_language);
		$this->meta_title(lang_line('mod_title'));
		$this->load->model('mod/tag_model');
	}


	public function index()
	{
		if ( $this->read_access )
		{
			if ( $this->write_access && $this->_act == 'input' )
			{
				$tags = xss_filter($this->input->post('tags'), 'xss');
				$tags = explode(',', $tags);
				foreach ($tags as $key)
				{
					$title = clean_tag($key);
					$seotitle = seotitle($key,'');
					if ( $this->tag_model->cek_seotitle($seotitle) == TRUE )
					{
						$this->tag_model->insert(array(
							'title' => $title,
							'seotitle' => $seotitle
						));
					}
				}
				$this->alert->set($this->mod, 'success', lang_line('form_message_add_success'));
				redirect(uri_string());
			}

			if ( $this->input->is_ajax_request() )
			{
				$data_list = $this->tag_model->get_datatables();
				$data_output = array();

				foreach ($data_list as $val) 
				{
					$row = [];
					$row[] = '<div class="text-center"><input type="checkbox" class="row_data" value="'. encrypt($val['id']) .'"></div>';
					$row[] = $val['title'];
					$row[] = $val['tag_count'];
					$row[] = '<div class="text-center"><button type="button" class="button btn-xs btn-default delete_single" data-toggle="tooltip" data-placement="top" data-title="'. lang_line('button_delete') .'" data-pk="'. encrypt($val['id']) .'"><i class="icon-bin"></i></button></div>';
					$data_output[] = $row;
				}

				$output = array(
								"draw" => $this->input->post('draw'),
								"recordsTotal" => $this->tag_model->count_all(),
								"recordsFiltered" => $this->tag_model->count_filtered(),
								"data" => $data_output,
								);

				$this->json_output($output);
			}

			$this->render_view('view_index', $this->vars);
		}
		else
		{
			$this->render_403();
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
				$this->tag_model->delete($pk);
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
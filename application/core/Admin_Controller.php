<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
	
	public $mod_view;
	public $_language;

	public function __construct()
	{
		parent::__construct();

		if ( login_status('admin') == TRUE ) // Cek status login.
		{
			$this->_language = strtolower($this->set_language());
			$this->lang->load('main', $this->_language);

			$this->form_validation->set_error_delimiters('<div class="text-danger">*&nbsp;', '</div>');

			// set user access.
			$this->set_access();

			// post act.
			$this->_act = !empty($this->input->post('act')) ? $this->input->post('act') : NULL;
		}
		
		else
		{
			redirect(base_url(FADMIN.'/login'), 'refresh');
		}
	}

	
	public function load_admin_content()
	{
		if ($this->mod_view == 'error403') 
		{
			$this->load->view('admin/error_403');
		}
		elseif ($this->mod_view == 'error404') 
		{
			$this->load->view('admin/error_404');
		}
		elseif ($this->mod_view && file_exists(VIEWPATH . "mod/".$this->mod."/".$this->mod_view.".php"))
		{
			$this->load->view('mod/'.$this->mod.'/'.$this->mod_view);
		}
		else
		{
			$this->load->view('admin/error_404');
		}
	}


	public function render_view($view = '', $data = '', $parm = FALSE)
	{
		$this->mod_view = $view;
		$this->load->view('admin/index', $data, $parm);
	}


	public function render_400()
	{
		$this->mod_view = 'error400';
		$this->load->view('admin/index');
	}


	public function render_403()
	{
		$this->mod_view = 'error403';
		$this->load->view('admin/index');
	}


	public function render_404()
	{
		$this->mod_view = 'error404';
		$this->load->view('admin/index');
	}


	public function m_filter($str, $segment = 3) 
	{
		if ($this->uri->segment($segment) === $str) 
		{
			return show_404();
		}
	}
} // End class.
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_controller {

	public $mod = 'setting';

	public function __construct() 
	{
		parent::__construct();

		$this->lang->load('mod/'.$this->mod, $this->_language);
		$this->meta_title(lang_line('mod_title'));
		$this->load->model('mod/setting_model');
		$this->global_access('admin');
	}


	public function general()
	{
		$this->vars['res'] = $this->db->where('groups','general')->get('t_setting')->result_array();
		$this->render_view('general');
	}


	public function index()
	{
		if ( $this->input->is_ajax_request() ) 
		{
			$path = VIEWPATH.'meta_social.php'; 
			$data_content = $_POST['meta_content'];
			fopen($path, "r") or die("Could not open file!");
			write_file($path, $data_content);
			$response['success'] = TRUE;
			$response['alert']['type'] = 'success';
			$response['alert']['content'] = lang_line('mod_lang_metasocial').'&nbsp;'.lang_line('update_success');
			$this->json_output($response);
		}

		$this->vars['lang_kode'] = $this->db->where('seotitle', $this->settings->website('language'))->get('t_language')->row_array()['kode'];
		$this->vars['lang_flag'] = content_url('images/flag/').$this->vars['lang_kode'].".png";

		$this->render_view('view_index', $this->vars);
	}


	public function submit() 
	{
		$act = (!empty($_POST) ? $_POST['pk'] : "");

		if ( $this->input->is_ajax_request() ) 
		{
			if ( $act == 'website_name' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('web_name', array('value' => $value));
			}

			elseif ( $act == 'website_url' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('web_url', array('value' => $value));
			}

			elseif ( $act == 'meta_description' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('meta_description', array('value' => $value));
			}

			elseif ( $act == 'meta_keyword' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('meta_keyword', array('value' => $value));
			}

			elseif ( $act == 'web_email' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('web_email', array('value' => $value));
			}

			elseif ( $act == 'tlpn' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('tlpn', array('value' => $value));
			}

			elseif ( $act == 'fax' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('fax', array('value' => $value));
			}

			elseif ( $act == 'address' )
			{
				$val_address = trim($this->input->post('value'));
				$value = xss_filter($val_address);
				$this->setting_model->update('address', array('value' => $value));
			}

			elseif ( $act == 'visitors' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('visitors', array('value' => $value));
			}
			
			elseif ( $act == 'maintenance' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('maintenance', array('value' => $value));
			}

			elseif ( $act == 'member_registration' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('member_registration', array('value' => $value));
			}

			elseif ( $act == 'country' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('country', array('value' => $value));
			}

			elseif ( $act == 'timezone' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('timezone', array('value' => $value));
			}

			elseif ( $act == 'slug_url' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('slug_url', array('value' => $value));
				$this->_save_routes();
			}

			elseif ( $act == 'slug_title' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('slug_title', array('value' => $value));
				$this->_save_routes();
			}

			elseif ( $act == 'page_item' )
			{
				$value = xss_filter(trim($this->input->post('value')),'sql');
				$this->setting_model->update('page_item', array('value' => $value));
			}

			elseif ( $act == 'captcha' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('captcha', array('value' => $value));
			}

			elseif ( $act == 'recaptcha_site_key' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('recaptcha_site_key', array('value' => $value));
			}

			elseif ( $act == 'recaptcha_secret_key' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('recaptcha_secret_key', array('value' => $value));
			}

			elseif ( $act == 'mail_protocol' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('protocol', array('value' => $value));
			}

			elseif ( $act == 'mail_hostname' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('hostname', array('value' => $value));
			}

			elseif ( $act == 'mail_username' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('username', array('value' => $value));
			}

			elseif ( $act == 'mail_password' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('password', array('value' => encrypt($value)));
			}

			elseif ( $act == 'mail_port' )
			{
				$value = trim($this->input->post('value'));
				$this->setting_model->update('port', array('value' => $value));
			}
		}

		else
		{
			if ( $act == 'language' )
			{
				$value = trim($this->input->post('lang'));
				$this->setting_model->update('language', array('value' => $value));

				$langActive = strtolower($this->CI->global_model->lang());
				$session_lang['lang_active'] = $langActive;
				$this->session->set_userdata($session_lang);
				redirect(admin_url($this->mod), 'refresh');
			}

			if ( $act == 'cache' )
			{
				$cache = trim($this->input->post('cache'));
				$this->setting_model->update('cache', array('value' => $cache));
				$cache_time = trim($this->input->post('cache_time'));
				$this->setting_model->update('cache_time', array('value' => $cache_time));
				redirect(admin_url($this->mod), 'refresh');
			}

			if ( $act == 'del_cache' )
			{
				$this->output->delete_cache();
				$this->clear_all_cache();
				redirect(admin_url($this->mod), 'refresh');
			}			

			if ( $act == 'favicon' )
			{
				$file_name = "favicon.png";
				$file_path = CONTENTPATH."favicon/";
				$tmp_file   = $_FILES['fupload']['tmp_name'];

				$this->load->library('upload', array(
					'upload_path'   => $file_path,
					'allowed_types' => "jpg|png|jpeg",
					'file_name'     => $file_name,
					'max_size'      => 1024 * 10, // 5Mb
					'overwrite'     => TRUE
				));

				if ( $this->upload->do_upload('fupload') ) 
				{
					$this->load->library('image_lib', array(
						'image_library'  => 'gd2',
						'source_image'   => $file_path.$file_name,
						'maintain_ratio' => TRUE,
						'width'          => 16,
						'height'         => 16,
					));
					
					$this->image_lib->resize();

					$this->alert->set($this->mod, 'success', lang_line('table_favicon')."&nbsp;".lang_line('update_success'));
				}
				else
				{
					$error_content = $this->upload->display_errors();
					$this->alert->set($this->mod, 'danger', $error_content);
				}

				redirect(admin_url($this->mod),'refresh');
			}

			if ( $act == 'web_logo' )
			{
				$tmp_file   = $_FILES['fupload']['tmp_name'];
				$file_extension = pathinfo($_FILES['fupload']['name'], PATHINFO_EXTENSION);
				$file_name = "logo.png";
				$file_path = CONTENTPATH."favicon/";

				$this->load->library('upload', array(
					'upload_path'   => $file_path,
					'allowed_types' => 'jpg|png|jpeg',
					'file_name'     => $file_name,
					'max_size'      => 1024 * 5, // 5Mb
					'overwrite'     => TRUE
				));

				if ( $this->upload->do_upload('fupload') ) 
				{
					if ($file_name != $this->settings->website('logo')) 
					{
						@unlink(CONTENTPATH . "favicon/" . $this->settings->website('logo'));
					}
					
					$this->setting_model->update('logo',array('value' => $file_name));

					$this->load->library('image_lib', array(
						'image_library'  => 'gd2',
						'source_image'   => $file_path.$file_name,
						'maintain_ratio' => TRUE,
						// 'width'          => 16,
						// 'height'         => 16,
					));
					
					$this->image_lib->resize();

					$this->alert->set($this->mod, 'success', lang_line('table_web_logo')."&nbsp;".lang_line('update_success'));
				}
				else
				{
					$error_content = $this->upload->display_errors();
					$this->alert->set($this->mod, 'danger', $error_content);
				}

				redirect(admin_url($this->mod), 'refresh');
			}

			if ( $act == 'web_image' )
			{
				$tmp_file   = $_FILES['fupload']['tmp_name'];
				$file_extension = pathinfo($_FILES['fupload']['name'], PATHINFO_EXTENSION);
				$file_name = "web.png";
				$file_path = CONTENTPATH."favicon/";

				$this->load->library('upload', array(
					'upload_path'   => $file_path,
					'allowed_types' => 'jpg|png|jpeg',
					'file_name'     => $file_name,
					'max_size'      => 1024 * 5, // 5Mb
					'overwrite'     => TRUE
				));

				if ( $this->upload->do_upload('fupload') ) 
				{
					if ($file_name != $this->settings->website('web_image')) 
					{
						@unlink(CONTENTPATH . "favicon/" . $this->settings->website('web_image'));
					}
					
					$this->setting_model->update('web_image',array('value' => $file_name));

					$this->load->library('image_lib', array(
						'image_library'  => 'gd2',
						'source_image'   => $file_path.$file_name,
						'maintain_ratio' => TRUE,
						// 'width'          => 16,
						// 'height'         => 16,
					));
					
					$this->image_lib->resize();

					$this->alert->set($this->mod, 'success', lang_line('table_web_image')."&nbsp;".lang_line('update_success'));
				}
				else
				{
					$error_content = $this->upload->display_errors();
					$this->alert->set($this->mod, 'danger', $error_content);
				}

				redirect(admin_url($this->mod), 'refresh');
			}

			if ($act == 'sitemap')
			{
				$this->load->library('sitemap');

				$changefreq  = $this->input->post('changefreq');
				$priority    = $this->input->post('priority');
				$this->sitemap->setDomain('');
				$this->sitemap->setPath(FCPATH);

				$this->sitemap->addItem(site_url(), $priority, $changefreq, '');

				$pages = $this->db
					->select('seotitle')
					->where('active', 'Y')
					->order_by('id', 'DESC')
					->get('t_pages')
					->result_array();
					
				foreach ($pages as $res_pages)
				{
					$this->sitemap->addItem(site_url('pages/'.$res_pages['seotitle']), $priority, $changefreq, date('Y-m-d'));
				}

				$categorys = $this->db
					->select('seotitle')
					->where('active', 'Y')
					->order_by('seotitle','ASC')
					->get('t_category')
					->result_array();

				foreach ($categorys as $res_category)
				{
					$this->sitemap->addItem(site_url('category/'.$res_category['seotitle']), $priority, $changefreq, date('Y-m-d'));
				}

				$posts = $this->db
					->select('seotitle, datepost')
					->where('active','Y')
					->order_by('id','DESC')
					->get('t_post')
					->result_array();
					
				foreach ($posts as $res_post)
				{
					$this->sitemap->addItem(post_url($res_post['seotitle']), $priority, $changefreq, $res_post['datepost']);
				}

				$this->sitemap->createSitemapIndex(site_url(), 'Today');
				redirect(site_url('sitemap.xml'), 'refresh');
			}
		}
	}


	private function clear_all_cache()
	{
	    $path       = $this->CI->config->item('cache_path');
	    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;
	    $handle     = opendir($cache_path);

	    while ( ($file = readdir($handle)) !== FALSE ) 
	    {
	        if ($file != '.htaccess' && $file != 'index.html' && $file != 'routes.php')
	           @unlink($cache_path.'/'.$file);
	    }
	    closedir($handle);       
	}
	
	
	public function get_lang()
	{
		if ( $this->read_access )
		{			
			$lang = $this->CI->db
				->select("id,title")
				->where('active', 'Y')
				->get('t_language')
				->result_array();

			$this->json_output($lang);
		}
	}


	public function get_slug_url()
	{
		if ( $this->read_access )
		{			
			$query = $this->CI->db->get('t_slug')->result_array();
			$this->json_output($query);
		}
	}


	private function _save_routes()
	{
		$slg_setting = $this->db->where('options', 'slug_url')->get('t_setting')->row_array()['value'];
		$slg_title   = $this->db->where('options', 'slug_title')->get('t_setting')->row_array()['value'];
		$slg_actives = $this->db->where('title', $slg_setting)->get('t_slug')->result_array();

		$data = [];
		$data[] = "<?php defined('BASEPATH') OR exit('No direct script access allowed');";

		foreach ($slg_actives as $key) 
		{
			if ( $slg_setting === 'slug/seotitle' )
			{
				$data[] = '$route[\'' . $slg_title . '/([a-z0-9-]+)\'] = \'post/index/$1\';';
			}

			if ( $slg_setting === 'yyyy/seotitle' )
			{
				$data[] = '$route[\'' . $key['slug'] . '\'] = \'post/index/$2\';';
			}

			if ( $slg_setting === 'yyyy/mm/seotitle' )
			{
				$data[] = '$route[\'' . $key['slug'] . '\'] = \'post/index/$3\';';
			}

			if ( $slg_setting === 'yyyy/mm/dd/seotitle' )
			{
				$data[] = '$route[\'' . $key['slug'] . '\'] = \'post/index/$4\';';
			}

			if ( $slg_setting === 'seotitle' )
			{
				$data[] = '$route[\'' . $key['slug'] . '\'] = \'post/index/$1\';';
			}
		}

		$output = implode("\n", $data);
		write_file(APPPATH . 'config/routes/slug_routes.php', $output);
	}
} // End Class.
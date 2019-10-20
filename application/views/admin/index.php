<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $this->CI->meta_title;?> - Administrator</title>
	<link rel="stylesheet" href="<?php echo content_url('plugins/font-awesome/font-awesome.min.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/icomoon/styles.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/dashboard/css/bootstrap_limitless.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/dashboard/css/bootstrap.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/dashboard/css/layout.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/dashboard/css/components.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/dashboard/css/colors.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/x-editable/x-editable.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/uniform/uniform.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/tagsinput/typeahead.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/select2/select2.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/uploaders/fileinput.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/jqueri-ui-interactions/interactions.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/notifications/noty.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/sweetalert2/sweetalert2.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/datetime/bootstrap-datetimepicker.min.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/fancybox-2.1.7/jquery.fancybox.css');?>" type="text/css" media="screen">

	<?php if ($this->mod === 'setting' || $this->mod == 'theme'): ?>
	<link rel="stylesheet" href="<?php echo content_url('plugins/codemirror/lib/codemirror.css');?>"  type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/codemirror/theme/github.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/codemirror/addon/display/fullscreen.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/codemirror/addon/hint/show-hint.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/codemirror/addon/dialog/dialog.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo content_url('plugins/codemirror/addon/scroll/simplescrollbars.css');?>" type="text/css">
	<?php endif ?>

	<?php if ($this->uri->segment(2) == 'menumanager'): ?>
	<link rel="stylesheet" href="<?php echo content_url('plugins/menumanager/menu.css');?>" type="text/css">
	<?php endif ?>

	<link rel="shortcut icon" href="<?php echo favicon();?>">

	<script type="text/javascript">
		<?php 
			$a_login_key = login_key('admin');
			$a_site_url  = site_url();
			$a_content_url  = content_url();
			$a_admin_url = site_url(FADMIN.'/');
			$a_fcontent  = CONTENTPATH;
			$a_mod = $this->mod;
			$a_act = (!empty($this->uri->segment(3)) ? "/".$this->uri->segment(3) : "");
			$a_datatable_lang = content_url('plugins/datatable/lang/'.$this->_language.'.json');
			$a_system_lang = content_url('plugins/json/lang/'.$this->_language.'.json');
		?>
		var ses_key = "<?php echo $a_login_key;?>";
		var site_url = "<?php echo $a_site_url;?>";
		var admin_url = "<?php echo $a_admin_url;?>";
		var content_url = "<?php echo $a_content_url;?>";
		var a_mod = "<?php echo $a_mod;?>";
		var a_act = "<?php echo $a_act;?>";
		var datatable_lang = "<?php echo $a_datatable_lang;?>";
		var lang_active = "<?php echo $this->_language;?>";
	    var csrfName = '<?php echo $this->CI->security->get_csrf_token_name();?>';
	    var csrfToken = '<?php echo $this->CI->security->get_csrf_hash();?>';
	    var csrfData = {};
	    csrfData['<?php echo $this->CI->security->get_csrf_token_name();?>'] = '<?php echo $this->CI->security->get_csrf_hash();?>';
	</script>

	<!-- jquery -->
	<script type="text/javascript" src="<?php echo content_url('plugins/jquery/jquery-2.2.4.min.js');?>"></script>
</head>
<body class="navbar-top">
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-light fixed-top">
		<div class="navbar-brand">
			<!-- <a href="<?php echo admin_url('home');?>" class="d-inline-block adm-title">CiFire<span class="text-warning">CMS</span></a> -->
			<a href="<?php echo admin_url('home');?>" class="d-inline-block adm-title">
				<img src="<?=content_url('images/logo.png');?>" class="pull-left"> <div>CiFire<span class="text-warning">CMS</span></div>
			</a>
		</div>
		<div class="d-md-none">
			<!-- to frondend link -->
			<a href="<?php echo site_url();?>" class="navbar-toggler nav-btn-mobile-link"><i class="icon-display"></i></a>
			<!-- user menu button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></button>
			<!-- sidebar menu button -->
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button"><i class="icon-paragraph-justify3"></i></button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block"><i class="icon-paragraph-justify3"></i></a>
				</li>
			</ul>
			<span class="navbar-text ml-md-3 mr-md-auto"></span>
			<!-- top nav -->
			<ul class="navbar-nav">
				<!-- language -->
				<li class="nav-item dropdown dropdown-lang">
					<a href="#" class="navbar-nav-link dropdown-toggle lang" data-toggle="dropdown">
						<img src="<?php echo content_url('images/flag/'.$this->_language.'.png');?>" class="" alt="Language">
						<!-- <span><?php echo humanize($this->_language);?></span> -->
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:void(0)" class="dropdown-item" onclick="setLang('english')">English</a>
						<a href="javascript:void(0)" class="dropdown-item" onclick="setLang('indonesia')">Indonesia</a>
					</div>
				</li>
				<!--/ language -->

				<!-- User Menu Top Nav -->
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo user_photo(data_login('admin','photo'));?>" class="rounded-circle" alt="Avatar">
						<span class="text-strong"><?php echo data_login('admin', 'name');?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?php echo site_url();?>" target="_blank" class="dropdown-item"><i class="icon-display"></i> <?php echo lang_line('menu_tofront');?></a>
						<a href="<?php echo admin_url('profile');?>" class="dropdown-item"><i class="icon-user"></i> Profile</a>
						<a href="<?php echo admin_url('mail');?>" class="dropdown-item"><i class="icon-envelop2"></i> <?php echo lang_line('menu_mail');?></a></a>
						<a href="<?php echo admin_url('setting');?>" class="dropdown-item"><i class="fa fa-cog"></i> <?php echo lang_line('menu_setting');?></a>
						<a href="<?php echo admin_url('logout');?>" class="dropdown-item"><i class="icon-switch"></i> <?php echo lang_line('menu_logout');?></a>
					</div>
				</li>
			</ul>
			<!--/ top nav -->
		</div>
	</div>
	<!--/ main navbar -->

	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
		<!-- <div  class="sidebar sidebar-dark sidebar-lightX sidebar-main sidebar-expand-md"> -->
		<!-- 
		<div  class="sidebar sidebar-darkx sidebar-light sidebar-main sidebar-expand-md"> -->
		<div class="sidebar sidebar-light sidebar-main sidebar-fixed sidebar-expand-md">
			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle"><i class="icon-arrow-left8"></i></a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->
			<!-- Sidebar content -->
			<div class="sidebar-content">
				<div class="card card-sidebar-mobile">
					<?php 
						$menu_group = dashboard_menu_active(login_level('admin', true));
						echo $this->CI->menu->dashboard_menu(
							$group_id   = $menu_group, 
							$ul_attr    = 'id="main_menu" class="nav nav-sidebar" data-nav-type="accordion"', 
							$li_attrs   = 'class="nav-item"', 
							$a_attr     = 'class="nav-link"',
							$li_ul_attr = 'class="nav nav-group-sub"',
							$ul_li_a_ul_li = 'class="nav-item"'
						);
					?>
				</div>
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper pb-4">
			<?php $this->CI->load_admin_content(); ?>
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->

	<!-- Go to Top -->
	<div class="sgo-top"></div>

	<!-- bootstrap.bundle -->
	<script src="<?php echo content_url('plugins/dashboard/js/bootstrap.bundle.min.js');?>"></script>
	<!-- jqueri-ui-interactions -->
	<script src="<?php echo content_url('plugins/jqueri-ui-interactions/interactions.min.js');?>"></script>
	<!-- sticky -->
	<script src="<?php echo content_url('plugins/sticky/sticky.min.js');?>"></script>
	<!-- notifications -->
	<script src="<?php echo content_url('plugins/notifications/noty.min.js');?>"></script>
	<!-- sweetalert2 -->
	<script src="<?php echo content_url('plugins/sweetalert2/sweetalert2.min.js');?>"></script>
	<!-- uniform -->
	<script src="<?php echo content_url('plugins/uniform/uniform.min.js');?>"></script>
	<!-- selects2 -->
	<script src="<?php echo content_url('plugins/select2/select2.min.js');?>"></script>
	<!-- bootstrap-multiselect -->
	<script src="<?php echo content_url('plugins/bootstrap-multiselect/bootstrap-multiselect.js');?>"></script>
	<!-- DataTables js-->
	<script src="<?php echo content_url('plugins/datatable/DataTables-1.10.18.min.js');?>"></script>
	<!-- tagsinput-->
	<script src="<?php echo content_url('plugins/tagsinput/bootstrap-tagsinput.js');?>"></script>
	<!-- typeahead -->
	<script src="<?php echo content_url('plugins/tagsinput/typeahead.bundle.min.js');?>"></script>
	<!-- datetimepicker -->
	<script src="<?php echo content_url('plugins/datetime/moment.js');?>"></script>
	<script src="<?php echo content_url('plugins/datetime/bootstrap-datetimepicker.js');?>"></script>
	<!-- maskedinput -->
	<script src="<?php echo content_url('plugins/maskedinput/jquery.maskedinput.min.js');?>"></script>
	<!-- x-editable -->
	<script src="<?php echo content_url('plugins/x-editable/x-editable.js');?>"></script>
	<!-- jquery validator -->
	<script src="<?php echo content_url('plugins/jquery-validator/jquery-validator.min.js');?>"></script>
	<!-- Add mousewheel plugin (this is optional) -->
	<script src="<?php echo content_url('plugins/fancybox-2.1.7/jquery.mousewheel.pack.js');?>"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script src="<?php echo content_url('plugins/fancybox-2.1.7/jquery.fancybox.pack.js');?>"></script>
	<!-- Add Media helper (this is optional) -->
	<script src="<?php echo content_url('plugins/fancybox-2.1.7/jquery.fancybox-media.js');?>"></script>
	<?php if ($this->mod != 'post'): ?>
	<!-- fileinput -->
	<script src="<?php echo content_url('plugins/uploaders/fileinput.min.js');?>"></script>
	<script src="<?php echo content_url('plugins/uploaders/purify.min.js');?>"></script>
	<script src="<?php echo content_url('plugins/uploaders/sortable.min.js');?>"></script>
	<?php endif ?>

	<!-- tinymce -->
	<script src="<?php echo content_url('plugins/tinymce/tinymce.min.js');?>"></script>

	<?php if ( $this->mod == 'theme' || $this->mod == 'setting'): ?>
	<!-- codemirror -->
	<script src="<?php echo content_url('plugins/codemirror/lib/codemirror.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/fold/xml-fold.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/edit/matchtags.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/edit/closetag.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/edit/closebrackets.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/selection/active-line.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/display/fullscreen.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/hint/show-hint.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/hint/xml-hint.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/hint/html-hint.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/dialog/dialog.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/search/searchcursor.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/search/search.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/addon/scroll/simplescrollbars.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/mode/clike/clike.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/mode/css/css.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/mode/htmlmixed/htmlmixed.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/mode/javascript/javascript.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/mode/php/php.js');?>"></script>
	<script src="<?php echo content_url('plugins/codemirror/mode/xml/xml.js');?>"></script>
	<?php endif ?>

	<!-- menumanager -->
	<?php if ($this->mod == "menumanager"): ?>
	<script src="<?php echo content_url('plugins/menumanager/jquery-1.7.2.js');?>"></script>
	<script src="<?php echo content_url('plugins/menumanager/iutil.js');?>"></script>
	<script src="<?php echo content_url('plugins/menumanager/idrag.js');?>"></script>
	<script src="<?php echo content_url('plugins/menumanager/idrop.js');?>"></script>
	<script src="<?php echo content_url('plugins/menumanager/isortables.js');?>"></script>
	<script src="<?php echo content_url('plugins/menumanager/inestedsortable.js');?>"></script>
	<?php endif ?>

	<!-- chart -->
	<?php if ($this->mod == "home"): ?>
	<script src="<?php echo content_url('plugins/chartjs/chart.min.js');?>"></script>
	<?php endif ?>
	
	<?php if ($this->mod == "compogen"): ?>
	<script src="<?php echo content_url('plugins/wizards/steps.min.js');?>"></script>
	<?php endif ?>

	<!-- dashboard app -->
	<script src="<?php echo content_url('plugins/dashboard/js/app.js');?>"></script>
	<script src="<?php echo content_url('plugins/dashboard/js/custom.js');?>"></script>
	<script src="<?php echo content_url('plugins/dashboard/js/perfect_scrollbar.min.js');?>"></script>
	<script src="<?php echo content_url('plugins/dashboard/js/fixed.js');?>"></script>
	<!--/ dashboard app -->

	<!-- Include Modjs -->
	<?php if (file_exists(CONTENTPATH . 'modjs/'.$this->mod.'.js')): ?>
	<script src="<?php echo  content_url('modjs/'.$this->mod.'.js');?>"></script> 
	<?php endif ?>
</body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?=$this->CI->meta_title;?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport"/>
	<meta name="robots" content="noindex,nofollow">
	<link href="<?=content_url('plugins/member/css/bootstrap.min.css')?>" rel="stylesheet"/>
	<link href="<?=content_url('plugins/font-awesome/font-awesome.min.css')?>" rel="stylesheet"/>
	<link href="<?=content_url('plugins/member/css/pe-icon-7-stroke.css')?>" rel="stylesheet"/>
	<link href="<?=content_url('plugins/select2/select2.css')?>" rel="stylesheet"/>
	<link href="<?=content_url('plugins/tagsinput/typeahead.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?=content_url('plugins/notifications/noty.css')?>" rel="stylesheet" type="text/css"/>
	<link href="<?=content_url('plugins/sweetalert2/sweetalert2.css')?>" rel="stylesheet"/>
	<link href="<?=content_url('plugins/x-editable/x-editable.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?=content_url('plugins/datetime/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?=content_url('plugins/member/css/light-bootstrap-dashboard.css')?>" rel="stylesheet" type="text/css"/>

	<link rel="apple-touch-icon" sizes="16x16" href="<?=content_url('images/favicon.png')?>">
	<link rel="shortcut icon" type="image/png" href="<?=content_url('images/favicon.png')?>">

	<script>
		var _MOD = '<?=$this->mod;?>';
		var _KEY = '<?=$this->_key;?>';
		var _SITE_URL = '<?=site_url()?>';
		var _CONTENT_URL = '<?=content_url()?>';
		var _MEMBER_URL = '<?=member_url()?>';
		var _LANGACTIVE = '<?=$this->_language;?>';
		var _LANGTABLE = '<?=$this->datatable_lang;?>';
	</script>
</head>
<body class="sidebar-mini">
	<div class="wrapperX main">
		<div class="sidebar" data-color="blue">
			<div class="sidebar-wrapper">
				<div class="logo">
					<a href="#" class="simple-text logo-mini">
						<img src="<?=content_url('images/logo.png')?>" style="height:27px;">
					</a>
					<a href="#" class="simple-text logo-normal">MEMBER</a>
				</div>
				<!-- Sidebar menu -->
				<ul class="nav">
					<li class="nav-item <?=$this->CI->menu_class('home')?>">
						<a href="<?=member_url('home')?>" class="nav-link">
							<i class="pe-7s-home"></i>
							<p><?=lang_line('menu_dashboard')?></p>
						</a>
					</li>
					<li class="nav-item <?=$this->CI->menu_class('post')?>">
						<a href="<?=member_url('post')?>" class="nav-link">
							<i class="nc-icon nc-paper-2"></i>
							<p><?=lang_line('menu_post')?></p>
						</a>
					</li>
					<li class="nav-item <?=$this->CI->menu_class('account')?>">
						<a href="<?=member_url('account')?>" class="nav-link">
							<i class="nc-icon nc-circle-09"></i>
							<p><?=lang_line('menu_account')?></p>
						</a>
					</li>
					<li class="nav-item mobile-logoutx">
						<a href="<?=member_url('logout')?>" class="nav-link">
							<i class="pe-7s-power"></i>
							<p><?=lang_line('menu_logout')?></p>
						</a>
					</li>
				</ul>
				<!--/ Sidebar menu -->
			</div>
		</div>

		<div class="main-panel">
			<!-- top Navbar -->
			<nav class="navbar navbar-expand-lg" color-on-scroll="500">
				<div class=" container-fluid  ">
					<div style="min-width:80%;">
						<a href="#" class="navbar-brand ci-icon mr-3"> 
							<img src="<?=content_url('images/logo.png')?>" style="height:27px;">
						</a>
						<a href="<?=member_url('post/add-new')?>" class="navbar-brand nav-tools"> <i class="pe-7s-pen"></i><span><?=lang_line('menu_write_post')?></span></a>
						<a href="<?=site_url()?>" target="_blank" class="navbar-brand nav-tools"> <i class="pe-7s-global"></i><span><?=lang_line('menu_view_site')?></span></a>
					</div>
					<div class="pull-right h-account">
						<a href="<?=member_url('account')?>" class="navbar-brand ci-icon2"> 
							<img src="<?=user_photo(data_login('member','photo'));?>">
							<span><?=data_login('member', 'name');?></span>
						</a>
					</div>
					<button href="javascript:void(0);" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar burger-lines"></span>
						<span class="navbar-toggler-bar burger-lines"></span>
						<span class="navbar-toggler-bar burger-lines"></span>
					</button>
				</div>
			</nav>
			<!--/ top Navbar -->
			
			<!-- CONTENT -->
			<div class="content">
				<div class="container-fluid">
				<?php $this->CI->load_content(); ?>
				</div>
			</div>
			<!-- End CONTENT -->
		</div>
	</div>

	<div id="gotop" class="to-top"></div>
	
	<!-- JavaScript -->
	<script src="<?=content_url('plugins/member/js/jquery.3.2.1.min.js')?>"></script>
	<script src="<?=content_url('plugins/member/js/popper.min.js')?>"></script>
	<script src="<?=content_url('plugins/member/js/bootstrap.min.js')?>"></script>
	<script src="<?=content_url('plugins/member/js/bs-custom-file-input.min.js')?>"></script>
	<script src="<?=content_url('plugins/member/js/light-bootstrap-dashboard.js')?>"></script>
	<script src="<?=content_url('plugins/datatable/DataTables-1.10.18.min.js')?>"></script>
	<script src="<?=content_url('plugins/select2/select2.min.js')?>"></script>
	<script src="<?=content_url('plugins/tagsinput/bootstrap-tagsinput.js')?>"></script>
	<script src="<?=content_url('plugins/tagsinput/typeahead.bundle.min.js')?>"></script>
	<script src="<?=content_url('plugins/notifications/noty.min.js')?>"></script>
	<script src="<?=content_url('plugins/sweetalert2/sweetalert2.min.js')?>"></script>
	<script src="<?=content_url('plugins/x-editable/x-editable.js');?>"></script>
	<script src="<?=content_url('plugins/tinymce/tinymce.min.js');?>"></script>
	<script src="<?=content_url('plugins/datetime/moment.js');?>"></script>
	<script src="<?=content_url('plugins/datetime/bootstrap-datetimepicker.js');?>"></script>
	<script src="<?=content_url('plugins/maskedinput/jquery.maskedinput.min.js');?>"></script>
	<script src="<?=content_url('plugins/member/js/custom.js')?>"></script>
</body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex,nofollow">
	<title><?=$this->CI->meta_title;?></title>
	<link href="<?=content_url('plugins/icomoon/styles.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=content_url('plugins/font-awesome/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=content_url('plugins/dashboard/css/bootstrap.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=content_url('plugins/dashboard/css/bootstrap_limitless.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=content_url('plugins/dashboard/css/layout.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=content_url('plugins/dashboard/css/components.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=content_url('plugins/dashboard/css/colors.css')?>" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="<?=favicon()?>" />
	<script src="<?=content_url('plugins/jquery/jquery-2.2.4.min.js')?>"></script>
	<script src="<?=content_url('plugins/dashboard/js/bootstrap.bundle.min.js')?>"></script>
	<script type="text/javascript">
		var _LOGIN_URL = '<?=admin_url("login/")?>';
	</script>
</head>
<body>
<div class="page-content">
	<div class="content-wrapper">
		<div class="content d-flex justify-content-center align-items-center">
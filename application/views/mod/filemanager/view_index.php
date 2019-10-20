<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold">File Manager</span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?php echo admin_url('home'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo lang_line('admin_link_home') ?></a>
			<span class="breadcrumb-item">File Manager</span>
		</div>
	</div>
</div>
<div class="contentX" style="padding:0px;margin-top:3px;margin-bottom:-30px;">
	<div class="block-content">
		<style>iframe.flstyle{width: 100% !important; min-height:500px !important; display: table; border:0px solid #ddd;} </style>
		<iframe class="flstyle" frameborder="0" src="<?php echo content_url('plugins/filemanager/dialog.php?type=0&sort_by=extension&descending=1');?>"></iframe>
	</div>
</div>
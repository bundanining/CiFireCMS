<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- 
*******************************************************
	Include Header Template
******************************************************* 
-->
<?php $this->CI->render_view('header'); ?>
<!-- End Header -->

<!-- 
*******************************************************
	Insert Content
******************************************************* 
-->
<section id="page-title">
	<div class="container clearfix">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo  site_url(); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Pages</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $res['title'];?></li>
		</ol>
	</div>
</section>
<section id="content">
	<div class="content-wrap pt-5">
		<div class="container clearfix">
			<div class="">
				<h1><?php echo $res['title'];?></h1>
			</div>
			<div class="col_full detail-content">
				<?php echo html_entity_decode($res['content']);?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</section>
<!-- End Content -->

<!-- 
*******************************************************
	Include Footer Template
******************************************************* 
-->
<?php $this->CI->render_view('footer'); ?>
<!-- End Footer -->
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
		<h1>Index Post</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url();?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Index</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap" style="padding-bottom:0;">
		<div class="container clearfix">
			<div class="row">
				<div class="col-lg-8 nobottommargin clearfix">
					<div id="posts" class="small-thumbs">
						<?php foreach ($data_post as $res): ?>
						<div class="entry clearfix">
							<div class="entry-image">
								<a href="<?php echo post_url($res['post_seotitle']);?>" title="<?php echo $res['post_title'];?>">
									<img class="image_fade" src="<?php echo post_images($res['picture'],'medium',TRUE);?>" alt="<?php echo $res['post_title'];?>">
								</a>
							</div>
							<div class="entry-c">
								<div class="entry-title">
									<h2>
										<a href="<?php echo post_url($res['post_seotitle']);?>" title="<?php echo $res['post_title'];?>"><?php echo $res['post_title'];?></a>
									</h2>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo ci_date($res['datepost'].$res['timepost'], 'l, d F Y');?></li>
									<li><i class="icon-folder-open"></i> <a href="<?php echo site_url('category/'.$res['category_seotitle']);?>"><?php echo $res['category_title'];?></a></li>
									<li><i class="icon-eye"></i> <?php echo $res['hits'];?> kali dilihat</li>
								</ul>
								<div class="entry-content">
									<p><?php echo cut($res['content'],150);?>...</p>
									<a href="<?php echo post_url($res['post_seotitle']);?>" title="Read More" class="more-link">Read More</a>
								</div>
							</div>
						</div>
						<?php endforeach ?>
					</div>
					<div class="row mb-3">
						<div class="col-12">
							<ul class="pagination justify-content-center">
								<?php echo $page_link;?>
							</ul>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-4 nobottommargin col_last clearfix">
					<?php $this->CI->render_view('sidebar'); ?>
				</div>
				<!-- End Sidebar -->
			</div>
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
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
		<h1>Gallery</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url();?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Gallery</li>
		</ol>
	</div>
</section>
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="portfolio grid-container clearfix">
				<?php
					foreach ($albums as $row_album):
						$cover = $this->CI->gallery_model->album_cover($row_album['id']);
						$pitures = $this->CI->gallery_model->get_gallery_images($row_album['id']);
				?>
				<article class="portfolio-item pf-icons pf-illustrations mb-5">
					<div class="portfolio-image">
						<a href="#">
							<img src="<?php echo post_images($cover['picture'],'medium',TRUE);?>" alt="<?php echo $cover['title'];?>">
						</a>
						<div class="portfolio-overlay" data-lightbox="gallery">
							<?php foreach ($pitures as $img): ?>
							<a href="<?php echo post_images($img['picture']);?>" title="<?php echo $img['title'];?>" class="center-icon" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
							<?php endforeach ?>
						</div>
					</div>
					<div class="portfolio-desc">
						<h3><a href="#"><?php echo $row_album['title']?></a></h3>
					</div>
				</article>
				<?php endforeach ?>
			</div>
		</div>
		<!-- Pagination
		<div class="col-12">
			<ul class="pagination justify-content-center">
				<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item active"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">Next</a></li>
			</ul>
		</div>
		<!--/ Pagination -->
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
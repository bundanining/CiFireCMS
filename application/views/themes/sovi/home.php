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
<section id="content">
	<div class="content-wrap" style="padding-bottom:0;">
		<div class="section header-stick bottommargin-lg clearfix" style="padding: 20px 0;">
			<div>
				<div class="container clearfix">
					<span class="badge badge-danger bnews-title">Breaking News:</span>
					<div class="fslider bnews-slider nobottommargin" data-speed="800" data-pause="6000" data-arrows="false" data-pagi="false">
						<div class="flexslider">
							<div class="slider-wrap">
								<?php 
									$header_news = $this->db
										->select('title, seotitle, datepost, timepost')
										->where('active', 'Y')
										->order_by('id','DESC')
										->limit(5)
										->get('t_post')
										->result_array();
									foreach ($header_news as $row_hnews):
								?>
								<div class="slide">
									<a href="<?php echo post_url($row_hnews['seotitle']);?>" title="<?php echo $row_hnews['title'];?>"><small class="text-muted"><?php echo ci_date($row_hnews['datepost'].$row_hnews['timepost'],'l, H:i A');?></small> - <strong><?php echo $row_hnews['title'];?></strong></a>
								</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container clearfix">
			<div class="row">
				<div class="col-lg-8 bottommargin">
					<!-- Slider -->
					<div class="col_full bottommargin-lg">
						<div class="fslider flex-thumb-grid grid-6" data-animation="fade" data-arrows="true" data-thumbs="true">
							<div class="flexslider">
								<div class="slider-wrap">
									<?php foreach ($headline as $res_headline): ?>
									<!-- item -->
									<div class="slide" data-thumb="">
										<a href="<?php echo post_url($res_headline['post_seotitle']);?>" title="<?php echo $res_headline['post_title'];?>">
											<img src="<?php echo post_images($res_headline['picture'],'',true);?>" alt="<?php echo $res_headline['post_title'];?>">
											<div class="overlay">
												<div class="text-overlay">
													<div class="text-overlay-title">
														<h3><?php echo $res_headline['post_title'];?></h3>
													</div>
													<div class="text-overlay-meta">
														<i class="icon-calendar"></i> &nbsp;
														<span><?php echo ci_date($res_headline['datepost'].$res_headline['timepost'], 'l, d M Y');?></span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<!--/ item -->
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
					<!-- End Slider -->
					
					<div class="clear"></div>
					
					<!-- Content Box 1 -->
					<div class="col_full bottommargin-lg clearfix">
						<?php
							$catPost1 = $this->CI->index_model->get_category_by('id', 2, 'row');
						?>
						<div class="fancy-title title-border">
							<h3><?php echo $catPost1['title'];?></h3>
						</div>
						<div class="ipost clearfix">
							<!-- primary item -->
							<?php
								$post1a = $this->CI->index_model->get_post_lmit_by_category($catPost1['id'], [1]);
								foreach ($post1a as $res_post1a):
							?>
							<div class="col_half bottommargin-sm">
								<div class="entry-image">
									<a href="<?php echo post_url($res_post1a['post_seotitle'])?>" title="<?php echo $res_post1a['post_title'];?>">
										<img class="image_fade" alt="<?php echo $res_post1a['post_title'];?>" src="<?php echo post_images($res_post1a['picture'], 'medium', TRUE);?>">
									</a>
								</div>
								<div class="entry-title">
									<h3>
										<a href="<?php echo post_url($res_post1a['post_seotitle'])?>" title="<?php echo $res_post1a['post_title'];?>"><?php echo $res_post1a['post_title'];?></a>
									</h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo ci_date($res_post1a['datepost'].$res_post1a['timepost'], 'l, d F Y');?></li>
									<li><i class="icon-folder-open"></i> <a href="<?php echo site_url('category/'.$res_post1a['category_seotitle']);?>"><?php echo $res_post1a['category_title'];?></a></li>
								</ul>
								<div class="entry-content">
									<p><?php echo cut($res_post1a['content'], 90);?>...</p>
								</div>
							</div>
							<?php endforeach ?>
							<!-- End primary item -->

							<div class="col_half nobottommargin col_last">
								<!-- secondary item -->
								<?php
									$post1b = $this->CI->index_model->get_post_lmit_by_category($catPost1['id'], [4,1]);
									foreach ($post1b as $res_post1b):
								?>
								<div class="spost clearfix">
									<div class="entry-image">
										<a href="<?php echo post_url($res_post1b['post_seotitle']);?>" title="<?php echo $res_post1b['post_title'];?>">
											<img alt="<?php echo $res_post1b['post_title'];?>" src="<?php echo post_images($res_post1b['picture'], 'thumb', TRUE);?>">
										</a>
									</div>
									<div class="entry-c">
										<div class="entry-title">
											<h4>
												<a href="<?php echo post_url($res_post1b['post_seotitle']);?>" title="<?php echo $res_post1b['post_title'];?>"><?php echo $res_post1b['post_title'];?></a>
											</h4>
										</div>
										<ul class="entry-meta clearfix">
											<li><i class="icon-calendar3"></i> <?php echo ci_date($res_post1b['datepost'].$res_post1b['timepost'], 'l, d F Y');?></li>
											<li><i class="icon-folder-open"></i> <a href="<?php echo site_url('category/'.$res_post1b['category_seotitle']);?>"><?php echo $res_post1b['category_title'];?></a></li>
										</ul>
									</div>
								</div>
								<?php endforeach ?>
								<!-- End secondary item -->
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<!-- End Content Box 1 -->					

					<!-- Content Box 2 -->
					<div class="col_full bottommargin-lg clearfix">
						<?php
							$catPost2 = $this->CI->index_model->get_category_by('id', 3, 'row');
						?>
						<div class="fancy-title title-border">
							<h3><?php echo $catPost2['title']?></h3>
						</div>
						<?php
							$post2a = $this->CI->index_model->get_post_lmit_by_category($catPost2['id'], [1]);
							foreach ($post2a as $res_post2a):
						?>
						<div class="ipost clearfix bottommargin-sm">
							<div class="col_half nobottommargin">
								<div class="entry-image">
									<a href="<?php echo post_url($res_post2a['post_seotitle'])?>" title="<?php echo $res_post2a['post_title'];?>">
										<img src="<?php echo post_images($res_post2a['picture'], 'medium', TRUE);?>" alt="<?php echo $res_post2a['post_title'];?>" class="image_fade">
									</a>	
								</div>
							</div>
							<div class="col_half nobottommargin col_last">
								<div class="entry-title">
									<h3>
										<a href="<?php echo post_url($res_post2a['post_seotitle'])?>" title="<?php echo $res_post2a['post_title'];?>"><?php echo $res_post2a['post_title'];?></a>
									</h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo ci_date($res_post2a['datepost'].$res_post2a['timepost'], 'l, d F Y');?></li>
									<li><i class="icon-folder-open"></i> <a href="<?php echo site_url('category/'.$res_post2a['category_seotitle']);?>"><?php echo $res_post2a['category_title'];?></a></li>
								</ul>
								<div class="entry-content">
									<p><?php echo cut($res_post2a['content'], 250);?>...</p>
								</div>
							</div>
						</div>
						<?php endforeach ?>

						<div class="clear"></div>

						<?php
							$post2b = $this->CI->index_model->get_post_lmit_by_category($catPost2['id'], [2,1]);
							foreach ($post2b as $res_post2b):
						?>
						<div class="col_half no-bottommargin col_last">
							<div class="spost clearfix">
								<div class="entry-image">
									<a href="<?php echo post_url($res_post2b['post_seotitle']);?>" title="<?php echo $res_post2b['post_title'];?>">
										<img alt="<?php echo $res_post2b['post_title'];?>" src="<?php echo post_images($res_post2b['picture'], 'thumb', TRUE);?>">
									</a>
								</div>
								<div class="entry-c">
									<div class="entry-title">
										<h4><a href="<?php echo post_url($res_post2b['post_seotitle']);?>" title="<?php echo $res_post2b['post_title'];?>"><?php echo $res_post2b['post_title'];?></a></h4>
									</div>
									<ul class="entry-meta clearfix">
										<li><i class="icon-calendar3"></i> <?php echo ci_date($res_post2b['datepost'].$res_post2b['timepost'], 'l, d F Y');?></li>
										<li><i class="icon-folder-open"></i> <a href="<?php echo site_url('category/'.$res_post2b['category_seotitle']);?>"><?php echo $res_post2b['category_title'];?></a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php endforeach ?>
					</div>
					<!-- End Content Box 2 -->
					
					<!-- Content Box 3 -->
					<div class="col_full nobottommargin clearfix">
						<?php
							$catPost3 = $this->CI->index_model->get_category_by('id', 4, 'row');
						?>
						<div class="fancy-title title-border">
							<h3><?php echo $catPost3['title']?></h3>
						</div>

						<?php
							$post3a = $this->CI->index_model->get_post_lmit_by_category($catPost3['id'], [3]);
							$i=0;
							foreach ($post3a as $res_post3a):
								$i++;
								$col_last = ( count($post3a) == $i ? 'col_last' : '' );
						?>
						<div class="col_one_third <?php echo $col_last?>">
							<div class="ipost clearfix">
								<div class="entry-image">
									<a href="<?php echo post_url($res_post3a['post_seotitle'])?>" title="<?php echo $res_post3a['post_title'];?>">
										<img src="<?php echo post_images($res_post3a['picture'], 'medium', TRUE);?>" alt="<?php echo $res_post3a['post_title'];?>" class="image_fade">
									</a>
								</div>
								<div class="entry-title">
									<h3>
										<a href="<?php echo post_url($res_post3a['post_seotitle'])?>" title="<?php echo $res_post3a['post_title'];?>"><?php echo $res_post3a['post_title'];?></a>
									</h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> <?php echo ci_date($res_post3a['datepost'].$res_post3a['timepost'], 'l, d F Y');?></li>
									<li><i class="icon-folder-open"></i> <a href="<?php echo site_url('category/'.$res_post3a['category_seotitle']);?>"><?php echo $res_post3a['category_title'];?></a></li>
								</ul>
								<div class="entry-content">
									<p><?php echo cut($res_post3a['content'], 100);?>...</p>
								</div>
							</div>
						</div>
						<?php endforeach ?>

						<div class="clear"></div>
					</div>
					<!-- End Content Box 3 -->
				</div>
				
				<div class="col-lg-4">
					<!-- Include Sidebar -->
					<?php $this->CI->render_view('sidebar'); ?>
					<!--/ Include Sidebar -->
				</div>
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
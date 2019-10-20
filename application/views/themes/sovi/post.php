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
			<li class="breadcrumb-item"><a href="<?php echo  site_url('category/'.$result_post['category_seotitle']); ?>"><?php echo $result_post['category_title'];?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $result_post['post_title']?></li>
		</ol>
	</div>
</section>
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="row">
				<div class="col-lg-8 nobottommargin clearfix">
					<div class="single-post nobottommargin">
						<div class="entry clearfix">
							<div class="entry-title">
								<h2><?php echo $result_post['post_title']?></h2>
							</div>
							<ul class="entry-meta clearfix">
								<li><a href="#"><i class="icon-user"></i> <?php echo $result_post['author_name'];?></a></li>
								<li><i class="icon-calendar3"></i><?php echo ci_date($result_post['datepost'], 'l, d F Y');?> &nbsp; <i class="icon-clock"></i> <?php echo ci_date($result_post['timepost'], 'h:i A');?></li>
								<li><i class="icon-folder-open"></i> <a href="<?php echo  site_url('category/'.$result_post['category_seotitle']); ?>"><?php echo $result_post['category_title'];?></a></li>
								<li><a href="#comments"><i class="icon-comments"></i> <?php echo $result_post['comment'];?> Comment</a></li>
								<li><i class="icon-eye"></i> <?php echo $result_post['hits'];?> views</li>
							</ul>

							<div class="entry-image">
								<?php if ( post_images($result_post['picture']) ):?>
								<img src="<?php echo post_images($result_post['picture']);?>" alt="<?php echo $result_post['image_caption'];?>" style="max-witdth:100%;margin:auto;">
								<?php if ($result_post['image_caption']): ?>
								<p class="post-image-caption text-center"><?php echo $result_post['image_caption']; ?></p>
								<?php endif ?>
								<?php endif ?>
							</div>

							<!-- Entry Content -->
							<div class="entry-content notopmargin">
								<?php echo html_entity_decode($result_post['content']);?>

								<div class="clear"></div>

								<!-- Tag Cloud -->

								<div class="tagcloud clearfix bottommarginX">
									<?php
										$tags = explode(',', $result_post['tag']);
										if ( ! empty($result_post['tag']) && $tags > 0) {
											foreach ($tags as $tag) {
												$tag = seotitle($tag, NULL);
												$resTag = $this->CI->db->where('seotitle', $tag)->get('t_tag')->row_array();
												if ( $tag == $resTag['seotitle'] )
													echo '<a href="'.site_url('tag/'.$tag).'" rel="tag"># '.$resTag['title'].'</a>';
											}
										}
									?>
								</div>
								<div class="clear"></div>

								<!-- Share
								<div class="si-share noborder clearfix">
									<div style="margin-right:8px;">Share : </div>
									<div>
										<a href="#" class="social-icon si-borderless si-facebook">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>
										<a href="#" class="social-icon si-borderless si-twitter">
											<i class="icon-twitter"></i>
											<i class="icon-twitter"></i>
										</a>
										<a href="#" class="social-icon si-borderless si-instagram">
											<i class="icon-instagram"></i>
											<i class="icon-instagram"></i>
										</a>
										<a href="#" class="social-icon si-borderless si-rss">
											<i class="icon-rss"></i>
											<i class="icon-rss"></i>
										</a>
										<a href="#" class="social-icon si-borderless si-email3">
											<i class="icon-email3"></i>
											<i class="icon-email3"></i>
										</a>
									</div>
								</div> -->
							</div>
						</div>

						<!-- Post Navigation -->
						<div class="post-navigation clearfix">
							<div class="col_half nobottommargin">
								<a href="<?php echo $prev_post['url']?>" title="<?php echo $prev_post['title']?>" class="btn btn-light">&lArr; Previous Post</a>
							</div>
							<div class="col_half col_last tright nobottommargin">
								<a href="<?php echo $next_post['url']?>" title="<?php echo $next_post['title']?>" class="btn btn-light">Next Post &rArr;</a>
							</div>
						</div>
						<!--/ Post Navigation -->

						<div class="line"></div>

						<!-- Author Info -->
						<div class="card">
							<div class="card-header">
								<strong>Editor : <a href="#"><?php echo $result_post['author_name']?></a></strong>
							</div>
							<div class="card-body">
								<div class="author-image">
									<img src="<?php echo user_photo($result_post['author_photo'])?>" alt="<?php echo $result_post['author_name']?>" class="rounded-circle">
								</div>
								<p><?php echo $result_post['author_about']?></p>
							</div>
						</div>
						<!--/ Author Info -->

						<div class="line"></div>

						<!-- related-posts -->
						<div class="fancy-title title-border">
							<h4>Related Posts</h4>
						</div>
						<div class="related-posts clearfix">
							<!-- item -->
							<?php
								$related_posts = $this->CI->post_model->related_post($result_post['tag'], $result_post['post_id'], 4);
								foreach ($related_posts as $res_relatedpost):
							?>
							<div class="col_half nobottommarginX">
								<div class="mpost clearfix">
									<div class="entry-image">
										<a href="<?php echo post_url($res_relatedpost['seotitle']);?>" title="<?php echo $res_relatedpost['title'];?>">
											<img src="<?php echo post_images($res_relatedpost['picture'],'medium',TRUE);?>" alt="<?php echo $res_relatedpost['title'];?>">
										</a>
									</div>
									<div class="entry-c">
										<div class="entry-title">
											<h4>
												<a href="<?php echo post_url($res_relatedpost['seotitle']);?>" title="<?php echo $res_relatedpost['title'];?>"><?php echo cut($res_relatedpost['title'],30);?>...</a>
											</h4>
										</div>
										<ul class="entry-meta clearfix">
											<li><i class="icon-calendar3"></i> <?php echo ci_date($res_relatedpost['datepost'], 'd M Y');?></li>
										</ul>
										<div class="entry-content"><?php echo cut($res_relatedpost['content'],40);?>...</div>
									</div>
								</div>
							</div>
							<?php endforeach ?>
							<!--/ item -->
						</div>
						<!--/ related-posts -->

						<!-- Comments -->
						<?php if ( $result_post['post_comment'] == "Y" ): ?>
						<div id="comments" class="clearfix">
							<h3 id="comments-title"><span><?php echo $result_post['comment']?></span> Comments</h3>

							<!-- Comments List -->
							<ol class="commentlist clearfix">
								<?php
									$data_comments = $this->CI->db
										->where('id_post', $result_post['post_id'])
										->where('active != "N"')
										->where('parent = "0"', NULL, FALSE)
										->get('t_comment');

									foreach ($data_comments->result_array() as $comment):
										$usersa = $this->CI->db
											->select('id,photo')
											->where('id', $comment['id_user'])
											->get('t_user')
											->row_array();
								?>
								<li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-1">
									<div id="comment-1" class="comment-wrap clearfix">
										<div class="comment-meta">
											<div class="comment-author vcard">
												<span class="comment-avatar clearfix">
													<img src="<?php echo user_photo($usersa['photo']);?>" class="avatar avatar-60 photo" height="60" width="60" />
												</span>
											</div>
										</div>
										<div class="comment-content clearfix">
											<div class="comment-author">
												<a href="#" rel="external nofollow" class="url"><?php echo $comment['name'];?></a>
												<span><a href="#"><?php echo ci_date($comment['date'],'d M Y, h:i A');?></a></span>
											</div>
											<p>
												<?php 
													if ($comment['active'] == 'X') {
														echo '<i class="text-danger">This comment is banned by Admin</i>';
													} else {
														echo auto_link($comment['comment']);
													}
												?>
											</p>
											<!-- reply -->
											<a href="#form_comment" class="comment-reply-link reply_comment" data-parent="<?php echo encrypt($comment['id'])?>"><i class="icon-reply"></i></a>
										</div>
										<div class="clear"></div>
									</div>

									<!-- children -->
									<?php
										if ($comment['active'] != 'X'):
											
											$rep_comments = $this->CI->db
												->where('parent', $comment['id'])
												->where('active != "N"')
												->get('t_comment');

											foreach ($rep_comments->result_array() as $res_rep):
												$users_rep = $this->CI->db
													->select('id,photo')
													->where('id', $res_rep['id_user'])
													->where('active', 'Y')
													->get('t_user')
													->row_array();
									?>
									<ul class="children">
										<li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">
											<div id="comment-3" class="comment-wrap clearfix">
												<div class="comment-meta">
													<div class="comment-author vcard">
														<span class="comment-avatar clearfix">
														<img src="<?php echo user_photo($users_rep['photo']);?>" class="avatar avatar-40 photo" height="40" width="40" /></span>
													</div>
												</div>
												<div class="comment-content clearfix">
													<div class="comment-author">
														<a href="#" rel="external nofollow" class="url"><?php echo $res_rep['name'];?></a>
														<span><a href="#"> <?php echo ci_date($res_rep['date'],'d M Y, h:i A');?></a></span>
													</div>
													<p>
														<?php 
															if ($res_rep['active'] == 'X') {
																echo '<i class="text-danger">This comment is banned by Admin</i>';
															} else {
																echo auto_link($res_rep['comment']);
															}
														?>
													</p>
													<!-- reply -->
													<a href="#form_comment" class="comment-reply-link reply_comment" data-parent="<?php echo encrypt($comment['id'])?>"><i class="icon-reply"></i></a>
												</div>
												<div class="clear"></div>
											</div>
										</li>
									</ul>
									<?php endforeach ?>
									<?php endif ?>
								</li>
								<?php endforeach ?>
							</ol>
							<!--/ Comments List -->

							<div class="clear"></div>

							<!-- Comment Form -->
							<div id="form_comment">
								<div id="respond" class="clearfix">
									<h3>Leave Your Comment</h3>
									<?php $this->alert->show('alert_comment'); ?>
									<?php echo form_open('','id="commentform" class="clearfix"');?>

										<input type="hidden" name="parent" class="comment_parent">

										<?php if ( login_status('member') == TRUE ): ?>

										<div class="col_half">
											<label for="Nama">Namae</label>
											<input type="text" name="name" id="Nama" size="22" tabindex="1" class="sm-form-control" value="<?php echo data_login('member', 'name')?>"/>
										</div>
										<div class="col_half col_last">
											<label for="email">Email</label>
											<input type="email" name="email" id="email" size="22" tabindex="2" class="sm-form-control" value="<?php echo data_login('member', 'email')?>"/>
										</div>

										<?php else: ?>

										<div class="col_half">
											<label for="Nama">Name</label>
											<input type="text" name="name" id="Nama" size="22" tabindex="1" class="sm-form-control"/>
										</div>
										<div class="col_half col_last">
											<label for="email">Email</label>
											<input type="email" name="email" id="email" size="22" tabindex="2" class="sm-form-control"/>
										</div>
										
										<?php endif ?>

										<div class="clear"></div>

										<div class="col_full">
											<label for="comment">Comment</label>
											<textarea name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
										</div>

										<div class="col_full nobottommargin">
											<?php if ($this->CI->captcha() == TRUE): ?>
											<div class="g-recaptcha pull-right" data-sitekey="<?php echo $this->settings->website('recaptcha_site_key')?>" style="margin-bottom:5px;"></div>
											<script src='https://www.google.com/recaptcha/api.js'></script>
											<?php endif; ?>
											<button type="submit" id="submit-button" tabindex="5" class="button button-3d m-0"><?php echo lang_line('button_submit')?></button>
										</div>
									<?php echo form_close();?>
								</div>
							</div>
							<!--/ Comment Form -->
						</div>
						<?php endif ?>
						<!--/ Comments -->
					</div>
				</div>

				<!-- Include Sidebar -->
				<div class="col-lg-4 nobottommargin col_last clearfix">
					<?php $this->CI->render_view('sidebar'); ?>
				</div>
				<!--/ Include Sidebar -->
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
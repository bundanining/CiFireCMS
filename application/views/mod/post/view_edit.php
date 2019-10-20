<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold"><?php echo lang_line('mod_title'); ?></span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?php echo admin_url('home'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo lang_line('admin_link_home') ?></a>
			<span class="breadcrumb-item"><?php echo lang_line('mod_title'); ?></span>
			<span class="breadcrumb-item"><?php echo lang_line('mod_title_edit'); ?></span>
		</div>
	</div>
</div>
<div class="content">
	<div><?php echo $this->alert->show($this->mod.'edit');?></div>
	<div class="block">
		<div class="block-header">
			<h3><?php echo lang_line('mod_title_edit');?></h3>
			<div class="pull-right">
				<a href="<?php echo admin_url($this->mod);?>" class="button btn-default btn-sm"><i class="icon-arrow-left7 "></i> <?php echo lang_line('button_back');?></a>
			</div>
		</div>
		<div class="box-content">
			<?php
				echo form_open('', 'id="form_update" autocomplete="off"');
				echo form_hidden('act', 'update');
				echo form_hidden('pk', encrypt($result_post['id']));
			?>
			<div class="row">
				<div class="col-md-9">
					<!-- Title -->
					<div class="form-group mb-4">
						<input type="text" name="title" id="title" class="form-control post-title-input" value="<?php echo !empty(set_value('title')) ? set_value('title') : $result_post['post_title'];?>" placeholder="<?php echo lang_line('form_label_title');?>">
						<input id="seotitle" type="hidden" name="seotitle" value="<?php echo !empty(set_value('seotitle')) ? set_value('seotitle') : $result_post['post_seotitle'];?>" readonly>
					</div>
					<!--/ Title -->
					<!-- Content -->
					<div class="form-group">
						<span class="btn-group pull-right">
							<button type="button" id="tiny-text" class="button btn-xs btn-default btn-flat">Text</button type="button">
							<button type="button" id="tiny-visual" class="button btn-xs btn-default btn-flat">Visual</button type="button">
						</span>
						<div class="clearfix"></div>
						<textarea id="Content" name="content" class="form-control" rows="11" style="border-radius:0px;"><?php echo  !empty(set_value('content')) ? set_value('content') : $result_post['post_content'];?></textarea>
					</div>
					<!--/ Content -->
				</div>
				<div class="col-md-3" style="min-width:120px;">
					<div id="sticky" class="bg-white">
						<div class="accordion post-setting" id="accordionPost">
							<!-- Publish -->
							<div class="card">
								<div class="card-header" id="collapse-category">
									<button class="btn btn-link" type="button" data-toggle="collapse" aria-expanded="true" data-target="#Publish" aria-controls="Publish">Publish</button>
								</div>
								<div id="Publish" class="collapse show" aria-labelledby="collapse-status" data-parent="#accordionPost">
									<div class="card-body">
										<!-- active -->
										<div class="form-check">
											<?php if ( $result_post['post_active'] == 'Y' ): ?>
											<input class="form-check-input" type="checkbox" id="cActivea" name="active" value="1" checked>
											<label class="form-check-label" for="cActivea"><?php echo lang_line('form_label_active');?></label>
											<?php else: ?>
											<input class="form-check-input" type="checkbox" id="cActiveb" name="active" value="1">
											<label class="form-check-label" for="cActiveb"><?php echo lang_line('form_label_active');?></label>
											<?php endif ?>
										</div>
										<!--/ active -->
										<!-- headline -->
										<div class="form-check">
											<?php if ( $result_post['post_headline'] == 'Y' ): ?>
											<input class="form-check-input" type="checkbox" id="cHeadlinea" name="headline" value="1" checked>
											<label class="form-check-label" for="cHeadlinea"><?php echo lang_line('form_label_headline');?></label>
											<?php else: ?>
											<input class="form-check-input" type="checkbox" id="cHeadlineb" name="headline" value="1">
											<label class="form-check-label" for="cHeadlineb"><?php echo lang_line('form_label_headline');?></label>
											<?php endif ?>
										</div>
										<!--/ headline -->
										<!-- comment -->
										<div class="form-check mb-3">
											<?php if ( $result_post['comment'] == 'Y' ): ?>
											<input class="form-check-input" type="checkbox" id="cCommenta" name="comment" value="1" checked>
											<label class="form-check-label" for="cCommenta"><?php echo lang_line('form_label_comment');?></label>
											<?php else: ?>
											<input class="form-check-input" type="checkbox" id="cCommentb" name="comment" value="1">
											<label class="form-check-label" for="cCommentb"><?php echo lang_line('form_label_comment');?></label>
											<?php endif ?>
										</div>
										<!--/ comment -->
										<div class="mt-2">
											<button type="submit" class="button btn-sm btn-primary submit_update mr-2"><i id="submit_icon" class="fa fa-save mr-2"></i><?php echo lang_line('button_save');?></button>
										</div>
									</div>
								</div>
							</div>
							<!--/ Publish -->
							<!-- Category -->
							<div class="card">
								<div class="card-header" id="collapse-category">
									<button class="btn btn-link" type="button" data-toggle="collapse" aria-expanded="true" data-target="#collapseCategory" aria-controls="collapseCategory"><?php echo lang_line('form_label_category');?></button>
								</div>
								<div id="collapseCategory" class="collapse" aria-labelledby="collapse-category" data-parent="#accordionPost">
									<div class="card-body">
										<div id="select-category"></div>
										<select name="category" class="select-category" data-placeholder="- <?php echo lang_line('form_label_category');?> -" required>
											<?php echo '<option value="'. encrypt($result_post['category_id']) .'">'. $result_post['category_title'] .'</option>'; ?>
										</select>
										<div class="mt-2">
											<small><b><a href="<?php echo admin_url('category/add-new')?>" target="_blank" class="mt-8"><i class="icon-plus-circle2"></i> <?php echo lang_line('button_add_new')?></a></b></small>
										</div>
									</div>
								</div>
							</div>
							<!--/ Category -->
							<!-- Tags -->
							<div class="card">
								<div class="card-header" id="collapsed-tags">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsedTags" aria-expanded="false" aria-controls="collapsedTags"><?php echo lang_line('form_label_tag');?></button>
								</div>
								<div id="collapsedTags" class="collapse" aria-labelledby="collapsed-tags" data-parent="#accordionPost">
									<div class="card-body">
										<?php
											$valtag = $this->CI->post_model->valtag($result_post['tag']);
										?>
										<input id="tagsjs" type="text" name="tags" value="<?php echo $valtag;?>" class="form-control" placeholder="Input Tags">
									</div>
								</div>
							</div>
							<!--/ Tags -->
							<!-- Picture -->
							<div class="card">
								<div class="card-header" id="collapsed-picture">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsedPicture" aria-expanded="false" aria-controls="collapsedPicture"><?php echo lang_line('form_label_picture');?></button>
								</div>
								<div id="collapsedPicture" class="collapse" aria-labelledby="collapsed-picture" data-parent="#accordionPost">
									<div class="card-body">
										<!-- Picture -->
										<div>
											<a class="browse-files" href="<?php echo content_url('plugins/filemanager/dialog.php?type=1&relative_url=1&field_id=picture&sort_by=date&descending=1&akey='.login_key('admin'));?>">
												<img id="imgprv" class="" src="<?php echo post_images($result_post['post_picture'],'',TRUE);?>" style="width:100%;max-width:115px;">
											</a>
											<div class="mt-2">
												<span id="delpict" class="button btn-xs btn-default"><i class="icon-bin"></i> <?php echo lang_line('button_delete');?> <?php echo lang_line('form_label_picture');?></span>
											</div>
											<input id="picture" type="hidden" name="picture" value="<?php echo $result_post['post_picture'];?>">
										</div>
										<!--/ Picture -->
										<!-- Image descrption -->
										<div class="mt-3 form-groupX">
											<label><?php echo lang_line('form_label_caption');?></label>
											<textarea name="image_caption" class="form-control" maxlength="100"><?php echo  !empty(set_value('image_caption')) ? set_value('image_caption') : $result_post['image_caption'];?></textarea>
										</div>
										<!--/ Image descrption -->
									</div>
								</div>
							</div>
							<!--/ Picture -->
							<!-- Date Publish -->
							<div class="card">
								<div class="card-header" id="collapsed-datetime">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsedDateTime" aria-expanded="false" aria-controls="collapsedDateTime"><?php echo lang_line('form_label_date');?></button>
								</div>
								<div id="collapsedDateTime" class="collapse" aria-labelledby="collapsed-datetime" data-parent="#accordionPost">
									<div class="card-body">
										<!-- Date -->
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-date"><i class="fa fa-calendar"></i></span>
											</div>
											<input type="text" id="publishdate" name="datepost" class="form-control" aria-label="Date" aria-describedby="basic-date" value="<?php echo date('Y-m-d',strtotime($result_post['datepost']));?>" required>
										</div>
										<!--/ Date -->
										<!-- Time -->
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-time"><i class="fa fa-clock-o"></i></span>
											</div>
											<input type="text" id="publishtime" name="timepost" class="form-control" aria-label="Time" aria-describedby="basic-time" value="<?php echo date('H:i:s',strtotime($result_post['timepost']));?>" required>
										</div>
										<!--/ Time -->
									</div>
								</div>
							</div>
							<!--/ Date Publish -->
							<!-- Author -->
							<div class="card">
								<div class="card-header" id="collapsed-author">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsedAuthor" aria-expanded="false" aria-controls="collapsedAuthor">
										<?php echo lang_line('form_label_author');?>
									</button>
								</div>
								<div id="collapsedAuthor" class="collapse" aria-labelledby="collapsed-author" data-parent="#accordionPost">
									<div class="card-body">
										<select name="author" class="select-2">
											<?php 
												if ( login_level('admin') != 0 && login_level('admin') <= 2 ) {
													foreach ( $all_user as $key_user ) {
														$selected = ( $result_post['user_id']==$key_user['user_id'] ? 'selected' : '');		
														echo '<option value="'. $key_user['user_id'] .'" '. $selected .'>'. $key_user['user_name'] .'</option>';
													}
												} else {
													echo '<option value="'. $result_post['user_id'] .'" selected>'. $result_post['user_name'] .'</option>';
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<!--/ Author -->
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
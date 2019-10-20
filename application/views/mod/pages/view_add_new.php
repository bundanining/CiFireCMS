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
			<span class="breadcrumb-item"><?php echo lang_line('mod_title_add'); ?></span>
		</div>
	</div>
</div>

<div class="content">
	<div class="block">
		<div class="block-header">
			<h3><?php echo lang_line('mod_title_add');?></h3>
			<div class="pull-right">
				<a href="<?php echo admin_url($this->mod);?>" class="button btn-default btn-sm"><i class="icon-arrow-left7 "></i> <?php echo lang_line('button_back');?></a>
			</div>
		</div>
		<div class="box-content">
			<!-- <form id="cf-form" autocomplete="off"> -->
			<?php
				echo form_open('','id="form_add" autocomplete="off"');
				echo form_hidden('act','add-new');
			?>
				<div class="row">
					<div class="col-md-9">
						<!-- Title -->
						<div class="form-group mb-4">
							<input type="text" name="title" id="title" class="form-control post-title-input" value="<?php echo set_value('title');?>" placeholder="<?php echo lang_line('form_label_title');?>" required>
						</div>
						<!--/ Title -->

						<!-- Content -->
						<div class="form-group mb-0">
							<label class="mb-1"><?php echo lang_line('form_label_content');?></label>
							<span class="btn-group pull-right">
								<button type="button" id="tiny-text" class="button btn-xs btn-default btn-flat">Text</button type="button">
								<button type="button" id="tiny-visual" class="button btn-xs btn-default btn-flat">Visual</button type="button">
							</span>
							<div class="clearfix"></div>
							<textarea id="Content" name="content" class="form-control" rows="11" style="border-radius:0px;"><?php echo  set_value('content');?></textarea>
							<div class="form-input-error"><?php echo form_error('content');?></div>
						</div>
						<!--/ Content -->
					</div>

					<div class="col-md-3 " style="min-width:120px;">
						<div id="sticky">
							<div class="accordion post-setting" id="accordionExampleX">
								<!-- Status -->
								<div class="card">
									<div class="card-header" id="collapse-category">
										<button class="btn btn-link" type="button" data-toggle="collapse" aria-expanded="true" data-target="#collapseStatus" aria-controls="collapseStatus">Status</button>
									</div>
									<div id="collapseStatus" class="collapse show" aria-labelledby="collapse-status" data-parent="#accordionExample">
										<div class="card-body">
											<div class="form-check">
												<?php if ( !empty(set_value('active')) ): ?>

												<input class="form-check-input" type="checkbox" id="cActivea" name="active" value="1" checked>
												<label class="form-check-label" for="cActivea"><?php echo lang_line('form_label_active');?></label>
												
												<?php else: ?>

												<input class="form-check-input" type="checkbox" id="cActiveb" name="active" value="1">
												<label class="form-check-label" for="cActiveb"><?php echo lang_line('form_label_active');?></label>

												<?php endif ?>
											</div>
										</div>
									</div>
								</div>
								<!--/ Status -->
								<!-- Picture -->
								<div class="card">
									<div class="card-header" id="collapsed-picture">
										<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsedPicture" aria-expanded="false" aria-controls="collapsedPicture">
											<?php echo lang_line('form_label_picture');?>
										</button>
									</div>
									<div id="collapsedPicture" class="collapse show" aria-labelledby="collapsed-picture" data-parent="#accordionExample">
										<div class="card-body">
											<!-- Picture -->
											<div>
												<a class="browse-files" href="<?php echo content_url('plugins/filemanager/dialog.php?type=1&relative_url=1&field_id=picture&sort_by=date&descending=1&akey=' . login_key('admin'));?>">
													<img id="imgprv" class="" src="<?php echo base64_image(post_images(set_value('picture'), '', TRUE))?>" style="width:100%;max-width:115px;">

												</a>
												<div class="mt-2">
													<span id="delpict" class="button btn-xs btn-default"><i class="icon-bin"></i> <?php echo lang_line('button_delete');?> <?php echo lang_line('form_label_picture');?></span>
												</div>
												<input id="picture" type="hidden" name="picture" value="<?php echo set_value('picture');?>">
											</div>
											<!--/ Picture -->
										</div>
									</div>
								</div>
								<!--/ Picture -->
							</div>
							<hr>
							<div>
								<button type="submit" class="button btn-primary submit_add"><i id="submit_icon" class="fa fa-check mr-2"></i>Submit</button>
								<a href="<?php echo admin_url($this->mod);?>" class="button btn-default pull-right"><i class="fa fa-times mr-2"></i><?php echo lang_line('button_cancel');?></a>
							</div>
						</div>
					</div>
				</div>
			<?form_open();?>
		</div>
	</div>
</div>
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
	<?php 
		echo form_open('','id="form_add" class="form-bordered" autocomplete="off" ');
		echo form_hidden('act', 'add_new');
	?>
	<div class="block">
		<div class="block-header">
			<h3><?php echo lang_line('mod_title_add');?></h3>
			<div class="pull-right">
				<a href="<?php echo admin_url($this->mod);?>" class="button btn-default btn-sm"><i class="icon-arrow-left7 "></i> <?php echo lang_line('button_back');?></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- title -->
				<div class="form-group row">
					<label class="col-form-label col-md-2"><?php echo lang_line('form_label_title');?></label>
					<div class="col-md-10">
						<input type="text" name="title" id="title" class="form-control" required>
					</div>
				</div>
				<!--/ title -->
				<!-- parent -->
				<div class="form-group row">
					<label class="col-form-label col-md-2"><?php echo lang_line('form_label_parent');?></label>
					<div class="col-md-4">
						<select class="select-2" name="parent" data-placeholder="<?php echo lang_line('form_label_parent_placeholder');?>">
								<option value="0" selected>No parent</option>
								<?php
									$parents = $this->CI->db
										->select('id,title')
										->where_not_in('id','1')
										->get('t_category')
										->result_array();
									foreach ($parents as $parent) {
										echo '<option value="'. encrypt($parent['id']) .'">'.$parent['title'].'</option>';
									}
								?>
							</select>
					</div>
				</div>
				<!--/ parent -->
				<!-- description -->
				<div class="form-group row">
					<label class="col-form-label col-md-2"><?php echo lang_line('form_label_description');?></label>
					<div class="col-md-10">
						<textarea name="description" class="form-control"></textarea>
					</div>
				</div>
				<!--/ description -->
				<!-- Status -->
				<div class="form-group row">
					<label class="col-form-label col-md-2">Status</label>
					<div class="col-md-4">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="cActive" name="active" value="1" checked>
							<label class="form-check-label" for="cActive"><?php echo lang_line('form_label_active');?></label>
						</div>
					</div>
				</div>
				<!--/ Status -->
				<hr>
				<div class="block-actions">
					<button type="submit" class="submit_add button btn-primary mr-2"><i class="fa fa-check mr-2"></i><?php echo lang_line('button_submit');?></button>
					<a href="<?php echo admin_url($this->mod);?>" class="button btn-default pull-right"><i class="fa fa-times mr-2"></i><?php echo lang_line('button_cancel');?></a>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close();?>
</div>
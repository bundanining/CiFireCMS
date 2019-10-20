<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3><span class="font-weight-semibold"><?=lang_line('mod_title'); ?></span></h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?=admin_url('home'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?=lang_line('admin_link_home') ?></a>
			<span class="breadcrumb-item"><?=lang_line('mod_title'); ?></span>
			<span class="breadcrumb-item"><?=lang_line('mod_title_edit'); ?></span>
		</div>
	</div>
</div>

<div class="content">
	<?php 
		echo form_open('','id="form_update" autocomplete="off" class="form-bordered"');
		echo form_hidden('act', 'update');
	?>
	<div class="block">
		<div class="block-header">
			<h3><?=lang_line('mod_title_edit');?></h3>
			<div class="pull-right">
				<a href="<?php echo admin_url($this->mod);?>" class="button btn-default btn-sm"><i class="icon-arrow-left7 "></i> <?php echo lang_line('button_back');?></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- title -->
				<div class="form-group row">
					<label class="col-form-label col-md-2"><?=lang_line('form_label_title');?></label>
					<div class="col-md-10">
						<input type="text" name="title" id="title" class="form-control" value="<?=!empty(set_value('title')) ? set_value('title') : $res_category['title'];?>"/>
						<div class="form-input-error"><?=form_error('title');?></div>
					</div>
				</div>
				<!--/ title -->
				<!-- parent -->
				<div class="form-group row">
					<label class="col-form-label col-md-2"><?=lang_line('form_label_parent');?></label>
					<div class="col-md-4">
						<select class="select-2" name="parent"  data-placeholder="<?=lang_line('form_label_parent_placeholder');?>">
							<option value="0">No parent</option>
							<?php
								$parents = $this->CI->db
									->select('id, title')
									->where_not_in('id', ['1', $res_category['id']])
									->order_by('id', 'DESC')
									->get('t_category')
									->result_array();

								foreach ($parents as $res_parent) {
									$selected = ( $res_parent['id'] == $res_category['id_parent'] ? 'selected': '' ); 
									echo '<option value="'. encrypt($res_parent['id']) .'" '. $selected .'>'. $res_parent['title'] .'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<!--/ parent -->
				<!-- description -->
				<div class="form-group row">
					<label class="col-form-label col-md-2"><?=lang_line('form_label_description');?></label>
					<div class="col-md-10">
						<textarea name="description" class="form-control"><?=!empty(set_value('description')) ? set_value('description') : $res_category['description'];?></textarea>
					</div>
				</div>
				<!--/ description -->
				<!-- Status -->
				<div class="form-group row">
					<label class="col-form-label col-md-2">Status</label>
					<div class="col-md-4">
						<div class="form-check">
							<?php if ($res_category['active'] == 'Y'): ?>
							<input class="form-check-input" type="checkbox" id="cActivea" name="active" value="1" checked>
							<label class="form-check-label" for="cActivea"><?=lang_line('form_label_active');?></label>
							<?php else: ?>
							<input class="form-check-input" type="checkbox" id="cActiveb" name="active" value="1">
							<label class="form-check-label" for="cActiveb"><?=lang_line('form_label_active');?></label>
							<?php endif ?>
						</div>
					</div>
				</div>
				<!--/ Status -->
				<hr>
				<div class="block-actions">
					<button type="submit" class="submit_update button btn-primary mr-2"><i class="fa fa-save mr-2"></i><?=lang_line('button_save');?></button>
					<a href="<?=admin_url($this->mod);?>" class="button btn-default pull-right"><i class="fa fa-times mr-2"></i><?=lang_line('button_cancel');?></a>
				</div>
			</div>
		</div>
	</div>
	<?=form_close();?>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold"><?php echo lang_line('mod_title');?></span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?php echo admin_url('home');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo lang_line('admin_link_home');?></a>
			<span class="breadcrumb-item"><?php echo lang_line('mod_title');?></span>
			<span class="breadcrumb-item"><?php echo lang_line('mod_title_reply');?></span>
		</div>
	</div>
</div>

<div class="content">

	<?php echo $this->alert->show($this->mod);?>

	<div class="block">
		<div class="block-header">
			<h3><?php echo lang_line('mod_title_reply');?></h3>
			<div class="pull-right">
				<a href="<?php echo admin_url($this->mod);?>" class="button btn-default btn-sm"><i class="icon-arrow-left7 "></i> <?php echo lang_line('button_back');?></a>
			</div>
		</div>
		<?php echo form_open();?>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label><?php echo lang_line('form_label_to')?></label>
							<input type="text" class="form-control" value="<?php echo $res_mail['email']?>" disabled>
							<input type="hidden" name="to" class="form-control" value="<?php echo $res_mail['email']?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label><?php echo lang_line('form_label_subject')?></label>
							<input type="text" name="subject" class="form-control" value="<?php echo $res_mail['subject']?>">
						</div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="form-group">
							<label for="Content"><?php echo lang_line('form_label_message')?></label>
							<textarea name="message" id="Content" cols="30" rows="10"></textarea>
						</div>
					</div>
				</div>
				<hr>
				<div class="block-actions">
					<button type="submit" class="button btn-primary mr-2"><i class="fa fa-paper-plane mr-2"></i><?php echo lang_line('button_send');?></button>
					<a href="<?php echo admin_url($this->mod);?>" class="button btn-default pull-right"><i class="fa fa-times mr-2"></i><?php echo lang_line('button_cancel');?></a>
				</div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
	<div class="compogen-heading text-center">
		<i class="icon-cup2"></i>
		<h2>CompoGen</h2>
		<p>Component Generator</p>
	</div>
	<div class="text-center">
		<h4><?php echo lang_line('mod_success1')?></h4>
		<br>
		<?php if ($fitur): ?>
		<p><?=$fitur?></p>
		<br>
		<?php endif ?>
		<button type="button" onclick="location.href='<?php echo admin_url($c_link)?>'" class="btn rounded-round btn-primary mb-3">
			<span class="ml-4 mr-4"><?php echo lang_line('button_goto_component')?></span>
		</button>
	</div>
</div>
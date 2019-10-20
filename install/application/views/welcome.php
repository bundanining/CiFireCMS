<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="container">
	<div class="text-center">
		<h2>Welcome To CiFireCMS Installation Page</h2>
	</div>
	<div id="body">
		<div class="license">
			<textarea class="form-control" style="background-color: #fafafa;" readonly><?php include(FCPATH."install/license.txt"); ?></textarea>
		</div>
		<div class="text-center">
			<form method="POST">
				<button type="submit" name="act" value="start" class="btn btn-lg btn-success">Start Installation</button>
			</form>
		</div><br><br>
	</div>
</div>
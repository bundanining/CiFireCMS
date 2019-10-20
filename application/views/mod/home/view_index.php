<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold"><?php echo lang_line('mod_welcome');?></span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?php echo admin_url('home');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo lang_line('admin_link_home');?></a>
		</div>
	</div>
</div>

<div class="content">
	<?php if ( $notif_comment[0] > 0 ||  $notif_mail[0] > 0): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body text-left">
					<?php if ( $notif_comment[0] > 0 ): ?>
					<p>
						<i class="fa fa-commenting-o mr-2"></i>
						<a href="<?php echo admin_url('comment');?>"><?php echo $notif_comment[1];?></a>
					</p>
					<?php endif ?>
					<?php if ( $notif_mail[0] > 0 ): ?>
					<p class="mb-0">
						<i class="icon-envelop2 mr-2"></i>
						<a href="<?php echo admin_url('mail');?>"><?php echo $notif_mail[1];?></a>
					</p>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	<div class="row">
		<div class="col-lg-3 home-widget primary">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('post');?>" class="home-widget-icon">
							<i class="icon-book2"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Post</h6>
						<span class="text-muted"><?php echo $h_post;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget success">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('category');?>" class="home-widget-icon">
							<i class="fa fa-folder-open-o"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Category</h6>
						<span class="text-muted"><?php echo $h_category;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget warning">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('tag');?>" class="home-widget-icon">
							<i class="icon-price-tags2"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Tags</h6>
						<span class="text-muted"><?php echo $h_tags;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget danger">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('pages');?>" class="home-widget-icon">
							<i class="icon-file-text2"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Pages</h6>
						<span class="text-muted"><?php echo $h_pages;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget secondary">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('component');?>" class="home-widget-icon">
							<i class="icon-cube3"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Component</h6>
						<span class="text-muted"><?php echo $h_component;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget danger">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('theme');?>" class="home-widget-icon">
							<i class="fa fa-paint-brush"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Theme</h6>
						<span class="text-muted"><?php echo $h_theme;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget info">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('mail');?>" class="home-widget-icon">
							<i class="icon-envelop2"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Mail</h6>
						<span class="text-muted"><?php echo $h_mail;?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 home-widget success">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3">
						<a href="<?php echo admin_url('user');?>" class="home-widget-icon">
							<i class="icon-users4"></i>
						</a>
					</div>
					<div class="media-body">
						<h6 class="mb-0">Users</h6>
						<span class="text-muted"><?php echo $h_users;?></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-5">
			<div class="card">
				<div class="card-header bg-white header-elements-inline">
					<h5 class="card-title"><i class="fa fa-heart text-danger  mr-2"></i> <?php echo lang_line('mod_box_title_1'); ?></h5>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				<div class="table-responsive table-scrollable">
					<table class="table">
						<tbody>
							<?php
								$popular_posts = $this->db
									->select('title,seotitle,picture,datepost,timepost,hits')
									->where('active', 'Y')
									->order_by('hits','DESC')
									->limit(10)
									->get('t_post')
									->result_array();
								foreach ($popular_posts as $res) {
							?>
							<tr>
								<td>
									<a href="<?php echo post_url($res['seotitle']);?>" target="_blank" title="<?php echo $res['title'];?>">
										<img src="<?php echo post_images($res['picture'],'thumb',TRUE);?>" alt="<?php echo $res['title'];?>" class="" width="70"/>
									</a>
								</td>
								<td>
									<div class="text-muted mb-1">
										<small><i class="fa fa-calendar"></i> <?php echo ci_date($res['datepost'].$res['timepost'], 'd M Y, h:i A');?> &nbsp; <i class="fa fa-eye"></i> <?php echo $res['hits'];?></small>
									</div>
									<a href="<?php echo post_url($res['seotitle']);?>" target="_blank" title="<?php echo $res['title'];?>"><small class="text-strong"><?php echo $res['title'];?></small></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-7">
			<div class="card">
				<div class="card-header bg-white header-elements-inline">
					<h5 class="card-title"><i class="icon-chart text-primary mr-2"></i> <?php echo lang_line('mod_box_title_3'); ?></h5>
					<div class="header-elements">
						<a href="<?php echo admin_url('home/visitors'); ?>" class="button btn-xs btn-default" title="Detail"><i class="fa fa-line-chart"></i></a>
                	</div>
				</div>
				<div class="card-body">
					<div class="stats-desc">
						<div class="text-center">
							<i class="fa fa-stop" style="color:#97BBCD;"></i> visitors
							<i class="fa fa-stop" style="color:#DCDCDC; margin-left:15px;"></i> hits
						</div>
						<canvas id="canvas-stats"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php
		$rrhari = implode($arrhari, ",");
		$rrvisitors = implode(array_reverse($rvisitors), ",");
		$rrhits = implode(array_reverse($rhits), ",");
	?>
	var datastats = {
		labels: [<?php echo implode($arrhari, ",");?>],
		datasets: [
			{
				label: "Visitor",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: [
					<?php echo implode(array_reverse($rvisitors), ",");?>
				]
			},
			{
				label: "Hits",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [
					<?php echo implode(array_reverse($rhits), ",");?>
				]
			}
		]
	};
</script>
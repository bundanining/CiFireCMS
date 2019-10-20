<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
	<div class="compogen-heading text-center">
		<i class="icon-cup2"></i>
		<h2>CompoGen</h2>
		<p>Component Generator</p>
	</div>

	<div class="card compogen">
		<form class="wizard-form steps-validation" data-fouc>



			<!-- Component -->
			<h6><?php echo lang_line('mod_setp1')?></h6>
			<fieldset>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php echo lang_line('label_component_name')?> <span class="text-danger">*</span></label>
							<input type="text" name="general[component_name]" id="component_name" class="form-control" minlength="4" maxlength="50"required/>
							<input type="hidden" id="classname" name="general[class_name]"/>
						</div>
						<!-- component type (comingsoon) -->
						<input type="hidden" name="general[component_type]" value="module" />
					</div>
				</div>
			</fieldset>
			<!--/ Component -->
			
			<!-- Database -->
			<h6><?php echo lang_line('mod_setp2')?></h6>
			<fieldset>
				<div id="step-database">
					<div class="form-group">
						<div class="row">
							<div class="col-md-5">
								<label><?php echo lang_line('label_table_name')?> <span class="text-danger">*</span></label>
								<input id="tablename" type="text" name="table_name" class="form-control" placeholder="Ex : t_table_name" minlength="4" maxlength="50" required/>
							</div>
						</div>
					</div>
					
					<hr>

					<!-- Field 1 -->
					<p class="text-strong"><i class="fa fa-list-ul"></i> <?php echo lang_line('label_table_filed')?></p>

					<table class="table table-bordered table-fields">
						<tbody id="append-add-field">
							<tr>
								<td>
									<div>
										<p class="text-success">
											<i class="fa fa-caret-right mr-2"></i>
											<span class="text-sm mr-2"><?php echo lang_line('label_field');?> 1</span>
											<i class="text-danger text-sm">(Primary Key, Auto Increment).</i>
										</p>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label><?php echo lang_line('label_field_name')?> <span class="text-danger">*</span></label>
													<input type="text" name="com_filed_name_1" id="com_fieldname_1" class="form-control" value="id" minlength="2" maxlength="15" required/>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label><?php echo lang_line('label_field_type')?></label>
													<input type="text" class="form-control" value="INTEGER" disabled/>
													<input type="hidden" name="com_filed_type_1" class="form-control input-sm" value="INTEGER"/>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label><?php echo lang_line('label_field_Length_values')?></label>
													<input type="number" name="com_filed_lenght_1" class="form-control" value="50" required/>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>

						<!-- Field 2 ~ 4 -->
						<?php for ($i=2; $i <= 4 ; $i++): ?>
						<tr id="def-field-<?php echo $i;?>">
							<td>
								<span id="<?php echo $i;?>" class="btn btn-xs text-danger cursor-hand rmfield pull-right"><i class="fa fa-times"></i> <?php echo lang_line('button_delete');?></span>
								<p class="text-success"><i class="fa fa-caret-right"></i> &nbsp; <b><small><?php echo lang_line('label_field');?> <?php echo $i;?></small></b></p>
								<div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label><?php echo lang_line('label_field_name');?> <span class="text-danger">*</span></label>
												<input id="field[<?php echo $i;?>]" fldn="field<?php echo $i;?>" type="text" name="field[<?php echo $i;?>][com_filed_name]" class="form-control" minlength="3" maxlength="20" required/>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label><?php echo lang_line('label_field_type');?></label>
												<select name="field[<?php echo $i;?>][com_filed_type]" class="form-control">
													<option value="INT">INTEGER</option>
													<option value="VARCHAR">VARCHAR</option>
													<option value="TEXT">TEXT</option>
													<option value="DATE">DATE</option>
													<option value="TIME">TIME</option>
													<option value="DATETIME">DATETIME</option>
													<option value="ENUM">ENUM</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label><?php echo lang_line('label_field_Length_values');?></label>
												<input type="text" name="field[<?php echo $i;?>][com_filed_lenght]" class="form-control" value="100" required/>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label><?php echo lang_line('label_field_default_values');?></label>
												<input type="text" name="field[<?php echo $i;?>][com_filed_default]" class="form-control"/>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php endfor ?>
						<!--/ Field 2 ~ 4 -->
						</tbody>
					</table>
					<!-- Button Add New Field -->
					<p class="text-center"><a class="btn btn-xs btn-round btn-default btn-add-field" id="5"><i class="fa fa-plus-circle"></i> <?php echo lang_line('button_add_field')?></a></p>
				</div>
			</fieldset>
			<!--/ Database -->

			<!-- Configuration -->
			<h6><?php echo lang_line('mod_setp3')?></h6>
			<fieldset>
				<div id="step-config">
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<!-- Action Elements -->
								<tr>
									<td>
										<div class="row">
											<div class="col-sm-3">
												<p class="text-strong"><?php echo lang_line('label_conf_action')?></p>
											</div>
											<div class="col-sm-9">
												<div class="custom-checkbox checkbox-vertical">
													<div class="checkbox">
														<input type="checkbox" name="conf[action][read]" value="1" checked style="display:none;" />
														<input type="checkbox" id="c-Read" checked disabled/>
														<label for="c-Read"><span><?php echo lang_line('label_conf_read');?></span></label>
													</div>
													<div class="checkbox">
														<input type="checkbox" id="c-Add" name="conf[action][add]" value="1"/>
														<label for="c-Add"><span><?php echo lang_line('label_conf_add');?></span></label>
													</div>
													<div class="checkbox">
														<input type="checkbox" id="c-Edit" name="conf[action][edit]" value="1"/>
														<label for="c-Edit"><span><?php echo lang_line('label_conf_edit');?></span></label>
													</div>
													<div class="checkbox">
														<input type="checkbox" id="c-Delete" name="conf[action][delete]" value="1"/>
														<label for="c-Delete"><span><?php echo lang_line('label_conf_delete');?></span></label>
													</div>
													<div class="checkbox">
														<input type="checkbox" id="c-Delete2" name="conf[action][delete_multiple]" value="1"/>
														<label for="c-Delete2"><span><?php echo lang_line('label_conf_multiple_delete');?></span></label>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<!--/ Action Elements -->

								<!-- Field For Browse File -->
								<tr>
									<td>
										<div class="row">
											<div class="col-md-3">
												<p class="text-strong"><?php echo lang_line('label_conf_Browse')?></p>
											</div>
											<div class="col-md-9">
												<div class="row" style="margin-bottom:10px;">
													<div class="col-sm-6">
														<input name="conf[field_browse]" class="form-control" placeholder="Field Name"/>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<!--/ Field For Browse File -->

								<!-- Field For Content TinyMCE -->
								<tr>
									<td>
										<div class="row">
											<div class="col-md-3">
												<p class="text-strong"><?php echo lang_line('label_conf_tinymce')?></p>
											</div>
											<div class="col-md-9">
												<div class="row" style="margin-bottom:10px;">
													<div class="col-sm-6">
														<input name="conf[field_tinymce]" class="form-control" placeholder="Field Name"/>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<!--/ Field For Content TinyMCE -->

								<!-- Field For Select Option -->
								<tr>
									<td>
										<div class="row">
											<div class="col-md-3">
												<p class="text-strong"><?php echo lang_line('label_conf_select')?></p>
											</div>
											<div class="col-md-9">
												<div class="row" style="margin-bottom:10px;">
													<div class="col-sm-6">
														<input name="conf[field_select]" class="form-control" placeholder="Fild Name"/>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div id="def-option1">
															<div class="input-group mb-2">
																<div class="input-group-prepend">
																	<span class="input-group-text"><?php echo lang_line('label_conf_option');?></span>
																</div>
																<input type="text" name="conf[field_select_option][1]" class="form-control" placeholder="Option 1"/>
																<div class="input-group-append">
																	<span id="1" class="btn btn-default rmoption"><i class="icon-cross3"></i></span>
																</div>
															</div>
														</div>
														<div id="append-add-options"></div>
														<div class="">
															<a href="javascript:void(0)" id="2" class="btn btn-xs btn-default add-more-option"><i class="fa fa-plus-circle"></i> <?php echo lang_line('button_add_option');?></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<!--/ Field For Select Option -->

								<!-- Column Datatable -->
								<tr>
									<td>
										<div class="row">
											<div class="col-md-3">
												<p class="text-strong"><?php echo lang_line('label_conf_datatable')?></p>
											</div>
											<div class="col-md-9">
												<!-- column 1 -->
												<div>
													<p class="text-success"><i class="fa fa-caret-right"></i> &nbsp; <span class="text-b text-sm"><?php echo lang_line('label_conf_column');?> 1</span></p>
													<div class="bordered">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label><?php echo lang_line('label_conf_column_name');?></label>
																	<input name="conf_column_name_1" class="form-control" value="Id Data" minlength="2" required/>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label><?php echo lang_line('label_conf_field_data');?></label>
																	<input class="form-control" value="Automatically for field 1 (primary key)" disabled/>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div id="def-column-2">
													<span id="2" class="text-danger cursor-hand pull-right btn btn-xs rmcol"><i class="fa fa-times"></i> <?php echo lang_line('button_delete')?></span>
													<p class="text-success"><i class="fa fa-caret-right"></i> &nbsp; <span class="text-b text-sm"><?php echo lang_line('label_conf_column');?> 2</span></p>
													<div class="bordered">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label><?php echo lang_line('label_conf_column_name');?></label>
																	<input type="text" name="col[2][col_name]" class="form-control" minlength="2" required/>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label><?php echo lang_line('label_conf_field_data');?></label>
																	<input type="text" name="col[2][col_field]" class="form-control" minlength="2" required/>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- Another fields -->
												<div id="append-add-column"></div>
												<p>
													<!-- Button Add New column -->
													<a id="3" class="btn btn-xs btn-default btn-add-column"><i class="fa fa-plus-circle"></i> <?php echo lang_line('button_add_column')?></a>
												</p>
											</div>
										</div>
									</td>
								</tr>
								<!--/ Column Datatable -->
								
								<!-- Frontend -->
								<tr>
									<td>
										<br>
										<div class="row">
											<div class="col-md-3">
												<p class="text-strong"><?php echo lang_line('label_conf_frontend')?></p>
											</div>
											<div class="col-md-9">
												<div>
													<div class="custom-checkbox checkbox-vertical">
														<div class="checkbox">
															<input type="checkbox" id="c-frontend" name="frontend[active]" value="1"/>
															<label for="c-frontend"><span>Create element</span></label>
														</div>
													</div>
												</div>
												<br>
												<!-- Meta Title -->
												<div class="form-group">
													<label>Meta Title</label>
													<input type="text" name="frontend[meta_title]" class="form-control" placeholder="Ex : My Custom Title" style="max-width:300px;" required>
												</div>
												<!--/ Meta Title -->
												<!-- Route Title -->
												<div class="form-group">
													<label>Route Title</label>
													<input type="text" name="frontend[route]" id="route_title" class="form-control"  minlength="4" maxlength="20" placeholder="Ex : my-route" style="max-width:300px;" required>
												</div>
												<!--/ Route Title -->

												<br>

												<!-- Layout -->
												<div class="form-group">
													<label>Layout</label>
													<div class="row">
														<?php 
															for($i=1; $i<=2; $i++): 
																$lchecked = ( $i==1 ? 'checked':'');
														?>	
														<div class="col-sm-2">
															<div class="custom-checkbox checkbox-vertical">
																<div class="checkbox">
																	<input type="radio" id="c-layout<?=$i;?>" name="frontend[layout]" value="<?=$i;?>" <?=$lchecked;?> />
																	<label for="c-layout<?=$i;?>"><span><small>Layout <?=$i;?></small></span></label>
																</div>
															</div>
															<img src="<?=content_url('images/layout'.$i.'.jpg');?>" alt="layout<?=$i;?>" style="max-width:100px;border:1px solid #ddd;">
															<br>
														</div>
														<?php endfor ?>	
													</div>
												</div>
												<!--/ Layout -->
											</div>
										</div>
									</td>
								</tr>
								<!--/ Frontend -->
							</table>
						</div>
					</div>
				</div>
			</fieldset>
			<!--/ Configuration -->

			<!-- Finish -->
			<h6><?php echo lang_line('mod_setp4')?></h6>
			<fieldset>
				<div id="step-finish" class="text-center">
					<?php echo lang_line('mod_setp4_1')?> <a href="javascript:void(0)" class="show-modal-terms"><?php echo lang_line('mod_setp4_2')?></a>.
				</div>
			</fieldset>
			<!--/ Finish -->
		</form>
	</div>
</div>

<div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="gi gi-pen"></i> <?php echo strtoupper(lang_line('mod_setp4_2'))?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<ol style="padding-left:20px;">
					<?php echo lang_line('mod_tos')?>
				</ol>
			</div>
			<div class="modal-footer">
				<button type="button" class="button btn-sm btn-default" data-dismiss="modal"><?php echo lang_line('button_close')?></button>
			</div>
		</div>
	</div>
</div>

<div id="loads" class="co-loads" style="display:none;">
	<div class="installing">
		<p style="margin:0;">
			<img class="mr-2" src="<?php echo content_url('images/loading.gif');?>"/>
			<span>Process...</span>
		</p>
	</div>
</div>
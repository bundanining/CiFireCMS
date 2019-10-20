<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * - CompoGen Helper
 * - Helper ini di gunakan pada komponen CompGen.
 *
 *   File    : compogen_helper.php
 *   Author  : Adiman 
 *   License : MIT License
*/

if ( ! function_exists('dump_file_html')) {
/**
 * - File index.html
 * - Ini adalah fungsi untuk membuat konten file index.html.
 * 
 * @return void|string
*/

function dump_file_html() {
$write = <<<EOS
<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>
EOS;
return $write;
} //----------------------> End funcion. File index.html
}




if ( ! function_exists('dump_view_index')) {
/**
 *-------------------------------------------------------------
 *  VIEW INDEX.
 *-------------------------------------------------------------
*/

/**
 * - View index.
 * - Ini adalah fungsi untuk membuat konten view index.
 * 
 * @param 	string|array 	$data
 * @return 	void|string
*/
function dump_view_index($data='') {
$data_general    = $data['general'];
$data_config     = $data['conf'];
$data_col_name_1 = $data['conf_column_name_1'];
$data_field_1    = $data['com_filed_name_1'];

if (!empty($data['field'])) {
	$data_fields = $data['field'];
}

if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$write = <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold">{$data_general['component_name']}</span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?php echo admin_url('home'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo lang_line('admin_link_home') ?></a>
			<span class="breadcrumb-item">{$data_general['component_name']}</span>
		</div>
	</div>
</div>

<div class="content">
	<?=\$this->alert->show(\$this->mod);?>
	<div class="ajax_alert" style="display:none;"></div>
	<div class="block">
		<div class="row">
			<div class="col-md-12">
				<div class="block-header">
					<h3>{$data_general['component_name']}</h3>\n
EOS;



//----------> Tambahkan tombol Add New.
if (!empty($data_config['action']['add'])) {
$write .= <<<EOS
					<div class="pull-right">
						<a href="<?=admin_url(\$this->mod.'/add-new');?>" class="button btn-sm btn-primary"><i class="icon-add"></i> <?=lang_line('button_add_new');?></a>
					</div>\n
EOS;
} //-------> End if.


$write .= <<<EOS
				</div>
			</div>
		</div>
		<div class="row">
			<div class="table-responsive">
				<div class="col-md-12">
					<table id="DataTable" class="display responsive no-wrap table table-striped table-hover table-bordered table-content">
						<thead>
							<tr>\n
EOS;

//----------> Tambahkan fitur "checkbox select all" delete_multiple.
if (!empty($data_config['action']['delete_multiple'])) {
$write .= <<<EOS
								<th class="no-sort text-center">
									<input type="checkbox" class="select_all" data-toggle="tooltip" data-placement="top" data-title="<?=lang_line('tooltip_select_all');?>">
								</th>\n
EOS;
} //-----> End if. checkbox select all.

//----------> Tabel Kolom 1.
$write .= <<<EOS
								<th>{$data_col_name_1}</th>\n
EOS;

//----------> Tabel Kolom lainya.
if (!empty($data['col'])) {
foreach ($data_cols as $key_col => $row_col) {
$th_name = humanize($row_col['col_name']);
$write .= <<<EOS
								<th>{$th_name}</th>\n
EOS;
} //--------> End foreach.
}

$write .= <<<EOS
								<th class="th-action text-center">Action</th>
							</tr>
						</thead>
						<tbody></tbody>\n
EOS;

//----------> Tambahkan tombol "Delete Selected Item" delete_multiple.
if (!empty($data_config['action']['delete_multiple'])) {
$write .= <<<EOS
						<tr id="delall">
							<td colspan="100">
								<span class="delete_multi button btn-sm btn-default text-danger"><i class="icon-bin"></i> <?=lang_line('button_delete_selected_item');?></span>
							</td>
						</tr>\n
EOS;
} //--------> End if.



$write .= <<<EOS
					</table>
				</div>
			</div>
		</div>
	</div>
</div>\n
EOS;

return $write;
} //----------------------------> End function.  Dump View Index.
} // endif





















if ( ! function_exists('dump_view_add')) {
/**
 * ---------------------------------------------------------
 *  VIEW ADD NEW
 * ---------------------------------------------------------
*/

/**
 * - View add new.
 * - Ini adalah fungsi untuk membuat konten view add new.
 * 
 * @param 	string|array 	$data
 * @return 	void|string
*/
function dump_view_add($data = '') {
$write = '';
$data_general = $data['general'];
$component_name = $data_general['component_name'];
$data_field_1 = $data['com_filed_name_1'];

if (!empty($data['field'])) {
	$data_fields = $data['field'];
}

$data_col_name_1 = $data['conf_column_name_1'];

if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$data_config = $data['conf'];

$write .= <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold">{$component_name}</span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?php echo admin_url('home'); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo lang_line('admin_link_home') ?></a>
			<span class="breadcrumb-item">{$component_name}</span>
			<span class="breadcrumb-item"><?=lang_line('title_add');?></span>
		</div>
	</div>
</div>
<div class="content">
	<?=\$this->alert->show(\$this->mod);?>
	<div class="ajax_alert" style="display:none;"></div>
	<div class="block">
		<div class="block-header">
			<h3>{$component_name}<small class="text-muted"> - <?=lang_line('title_add');?></small></h3>
		</div>
		<?php 
			echo form_open('','autocomplete="off" class="form-bordered"');
			echo form_hidden('act', 'add_new');
		?>
		<div class="row">
			<div class="col-md-12">\n
EOS;


//--- data_fields ------------------------------------------------//
if (!empty($data['field'])) {
	
foreach ($data_fields as $key_field => $val_field) {

$field_name    = $val_field['com_filed_name'];
$field_type    = $val_field['com_filed_type'];
$input_label   = ucfirst($field_name);
$input_name    = $field_name;
$filed_lenght  = $val_field['com_filed_lenght'];
$filed_default = $val_field['com_filed_default'];

//-----------> Start. FIELD TYPE VARCHAR.
if ($field_type == "VARCHAR") {

//-----------> Input browse filemanager (VARCHAR).
if (!empty($data_config['field_browse']) && $data_config['field_browse'] == $field_name) {
$write_input_filemanager_varchar = write_input_filemanager($input_label, $field_name);
$write .= <<< EOS
{$write_input_filemanager_varchar}
EOS;
} //-----------> End. Input browse filemanager (VARCHAR).


//-----------> Start. Input select
elseif (!empty($data_config['field_select']) && $data_config['field_select'] == $field_name) {
$write_input_select = write_input_select($input_label, $field_name, $val='', $data_config['field_select_option']);
$write .= <<<EOS
{$write_input_select}
EOS;
} //-----------> End. Input select


//-----------> Start. Input text (VARCHAR).
else {
$write_input_text_varchar = write_input_text($input_label, $field_name);
$write .= <<< EOS
{$write_input_text_varchar}
EOS;
} //-----------> End. Input text (VARCHAR).

} //-----------> End. FIELD TYPE VARCHAR.


//-----------> Start. FIELD TYPE INT.
elseif ($field_type == "INT") {
$write_input_number = write_input_number($input_label, $field_name, $val = '');
$write .= <<< EOS
{$write_input_number}
EOS;
} //-----------> End. FIELD TYPE INT.


//-----------> Start. FIELD TYPE DATE.
elseif ($field_type == "DATE") {
$write_input_date = write_input_date($input_label, $field_name);
$write .= <<<EOS
{$write_input_date}
EOS;
} //-----------> End. FIELD TYPE DATE.


//-----------> Start. FIELD TYPE TIME.
elseif ($field_type == "TIME") {
$write_input_time = write_input_time($input_label, $field_name);
$write .= <<<EOS
{$write_input_time}
EOS;
} //-----------> End. FIELD TYPE TIME.



//-----------> Start. FIELD TYPE DATETIME.
elseif ($field_type == "DATETIME") {
$write_input_datetime = write_input_datetime($input_label, $field_name);
$write .= <<<EOS
{$write_input_datetime}
EOS;
} //-----------> End. FIELD TYPE DATETIME.



//-----------> Start. FIELD TYPE TEXT.
elseif ($field_type == "TEXT") {

//-----------> Start. Input TinyMCE (TEXT).
if (!empty($data_config['field_tinymce']) && $data_config['field_tinymce'] == $field_name) {
$write_input_tinymce = write_input_tinymce($input_label, $field_name);
$write .= <<<EOS
{$write_input_tinymce}
EOS;
} //-----------> End. Input TinyMCE (TEXT).


//-----------> Input browse filemanager (TEXT).
elseif (!empty($data_config['field_browse']) && $data_config['field_browse'] == $field_name) {
$write_input_filemanager_varchar = write_input_filemanager($input_label, $field_name);
$write .= <<< EOS
{$write_input_filemanager_varchar}
EOS;
} //-----------> End. Input browse filemanager (TEXT).

//-----------> Start. Input textarea (TEXT).
else {
$write_input_textarea = write_input_textarea($input_label, $field_name);
$write .= <<<EOS
{$write_input_textarea}
EOS;
} //-----------> Start. Input textarea (TEXT).

} //-----------> End. FIELD TYPE TEXT.



//-----------> Start. Input ENUM.
elseif ($field_type == "ENUM") {
$op_enum = explode(',', $filed_lenght);
$write_input_enum = write_input_enum($input_label, $field_name, $op_enum, $filed_default, FALSE);
$write .= <<<EOS
{$write_input_enum}
EOS;
} //-----------> Start. Input ENUM.

} //-----------> End forech. $data_fields.

} //-----------> End if data['field']


$write .= <<<EOS
			</div>
			<div class="col-md-12">
				<hr>
				<div class="block-actions">
					<button type="submit" class="button btn-primary"><i class="fa fa-check"></i> <?=lang_line('button_submit');?></button>
					<button type="button" class="button btn-default pull-right" onclick="location.href='<?=admin_url(\$this->mod);?>'"><i class="fa fa-times"></i> <?=lang_line('button_cancel');?></button>
				</div>
			</div>
		</div>
		<?=form_close();?>
	</div>
</div>
EOS;


return $write;
} //----------------------------------> End funcion. VIEW ADD NEW. 
} // endif















if ( ! function_exists('dump_view_edit')) {
/**
 * -----------------------------------------------------------
 *  VIEW EDIT
 * -----------------------------------------------------------
*/

/**
 * - View edit
 * - Ini adalah fungsi untuk membuat konten view edit.
 * 
 * @param 	string|array 	$data
 * @return 	void|string
*/
function dump_view_edit($data = '') {

$write = '';
$data_general = $data['general'];
$component_name = $data_general['component_name'];

$data_field_1 = $data['com_filed_name_1'];

if (!empty($data['field'])) {	
	$data_fields = $data['field'];
}

$data_col_name_1 = $data['conf_column_name_1'];

if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$data_config = $data['conf'];

$write .= <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-inline">
		<div class="page-title">
			<h3>
				<span class="font-weight-semibold">{$component_name}</span>
			</h3>
		</div>
	</div>
	<div class="breadcrumb-line breadcrumb-line-light">
		<div class="breadcrumb">
			<a href="<?=admin_url('home');?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?=lang_line('admin_link_home')?></a>
			<span class="breadcrumb-item">{$component_name}</span>
			<span class="breadcrumb-item"><?=lang_line('title_edit');?></span>
		</div>
	</div>
</div>
<div class="content">
	<?=\$this->alert->show(\$this->mod);?>
	<div class="ajax_alert" style="display:none;"></div>
	<div class="block">
		<div class="block-header">
			<h3>{$component_name}<small class="text-muted"> - <?=lang_line('title_edit');?></small></h3>
		</div>
		<?php 
			echo form_open('','autocomplete="off" class="form-bordered"');
			echo form_hidden('act', '1');
		?>
		<div class="row">
			<div class="col-md-12">\n
EOS;


//-- data_fields ---------------------------------------------------//.
if (!empty($data['field'])) {

foreach ($data_fields as $key_field => $val_field) {

$field_name    = $val_field['com_filed_name'];
$field_type    = $val_field['com_filed_type'];
$filed_lenght  = $val_field['com_filed_lenght'];
$filed_default = $val_field['com_filed_default'];
$input_label   = ucfirst($field_name);
$input_name    = $field_name;

//-----------> Start. FIELD TYPE VARCHAR.
if ($field_type == "VARCHAR") {

//-----------> Input browse filemanager (VARCHAR).
if (!empty($data_config['field_browse']) && $data_config['field_browse'] == $field_name) {
$write_input_filemanager_varchar = write_input_filemanager($input_label, $field_name, TRUE);
$write .= <<< EOS
{$write_input_filemanager_varchar}
EOS;
} //-----------> End. Input browse filemanager (VARCHAR).

//-----------> Start. Input select (VARCHAR)
elseif (!empty($data_config['field_select']) && $data_config['field_select'] == $field_name) {
$write_input_select = write_input_select($input_label, $field_name, TRUE, $data_config['field_select_option']);
$write .= <<<EOS
{$write_input_select}
EOS;
} //-----------> End. Input select (VARCHAR)

//-----------> Start. Input text (VARCHAR).
else {
$write_input_text_varchar = write_input_text($input_label, $field_name, TRUE);
$write .= <<< EOS
{$write_input_text_varchar}
EOS;
} //-----------> End. Input text (VARCHAR).

} //-----------> End. FIELD TYPE VARCHAR.
	

//-----------> Start. FIELD TYPE INT.
elseif ($field_type == "INT") {
$write_input_number = write_input_number($input_label, $field_name, TRUE);
$write .= <<< EOS
{$write_input_number}
EOS;
} //-----------> End. FIELD TYPE INT.


//-----------> Start. FIELD TYPE DATE.
elseif ($field_type == "DATE") {
$write_input_date = write_input_date($input_label, $field_name, TRUE);
$write .= <<<EOS
{$write_input_date}
EOS;
} //-----------> End. FIELD TYPE DATE.


//-----------> Start. FIELD TYPE TIME.
elseif ($field_type == "TIME") {
$write_input_time = write_input_time($input_label, $field_name, TRUE);
$write .= <<<EOS
{$write_input_time}
EOS;
} //-----------> End. FIELD TYPE TIME.


//-----------> Start. FIELD TYPE DATETIME.
elseif ($field_type == "DATETIME") {
$datetime = write_input_datetime($input_label, $field_name, TRUE);
$write .= <<<EOS
{$datetime}
EOS;
} //-----------> End. FIELD TYPE DATETIME.


//-----------> Start. FIELD TYPE TEXT.
elseif ($field_type == "TEXT") {

//-----------> Start. Input TinyMCE (TEXT).
if (!empty($data_config['field_tinymce']) && $data_config['field_tinymce'] == $field_name) {
$write_input_tinymce = write_input_tinymce($input_label, $field_name, TRUE);
$write .= <<<EOS
{$write_input_tinymce}
EOS;
} //-----------> End. Input TinyMCE (TEXT).

//-----------> Input browse filemanager (TEXT).
elseif (!empty($data_config['field_browse']) && $data_config['field_browse'] == $field_name) {
$write_input_filemanager_varchar = write_input_filemanager($input_label, $field_name, TRUE);
$write .= <<< EOS
{$write_input_filemanager_varchar}
EOS;
} //-----------> End. Input browse filemanager (TEXT).

//-----------> Start. Input textarea (TEXT).
else {
$write_input_textarea = write_input_textarea($input_label, $field_name, TRUE);
$write .= <<<EOS
{$write_input_textarea}
EOS;
} //-----------> Start. Input textarea (TEXT).

} //-----------> End. FIELD TYPE TEXT.


//-----------> Start. Input ENUM.
elseif ($field_type == "ENUM") {
$op_enum = explode(',', $filed_lenght);
$write_input_enum = write_input_enum($input_label, $field_name, $op_enum, $filed_default, TRUE);
$write .= <<<EOS
{$write_input_enum}
EOS;
} //-----------> End. Input ENUM.

} //---------------------------------------------> End forech. $data_fields.

} //-----------> End. IF data_fields.

$write .= <<<EOS
			</div>
			<div class="col-md-12">
				<hr>
				<div class="block-actions">
					<button type="submit" class="button btn-primary"><i class="fa fa-check"></i> <?=lang_line('button_submit');?></button>
					<button type="button" class="button btn-default pull-right" onclick="location.href='<?=admin_url(\$this->mod);?>'"><i class="fa fa-times"></i> <?=lang_line('button_cancel');?></button>
				</div>
			</div>
		</div>
		<?=form_close();?>
	</div>
</div>
EOS;

return $write;
} //----------------------------------> End funcion. VIEW EDIT. 
} // endif















if ( ! function_exists('dump_file_javascript')) {
/**
 * -------------------------------------------------------------
 * Dum for file mod js *.js
 * -------------------------------------------------------------
*/

/**
 * - File Mod Js
 * - Ini adalah fungsi untuk membuat konten file javasript.
 * 
 * @param 	string|array 	$data
 * @return 	void|string
*/
function dump_file_javascript($data = '') {
$rdate = DATE('Y-m-d ~ h:i:s');
$write = <<<EOS
/**
 * - This file was created using CompoGen
 * 
 * - File         : javascript.js
 * - Date created : {$rdate}
 * - Author       : CompoGen
 * - License      : MIT License
*/

// DataTable
$(document).ready(function() {
	$('#DataTable').DataTable({
        'language': {
            'url': datatable_lang,
        },        
        'autoWidth': false,
        'responsive': true,
        'processing': true,
        'serverSide': true,
        'order': [
            [1, 'desc']
        ],
        'columnDefs': [
            {'targets': [0], 'width': '20px', 'orderable': false, 'searchable': false},
            {'targets': [1], 'width': '50px'},
            {'targets': 'no-sort', 'orderable': false, 'searchable': false},
            {'targets': 'th-action', 'width': '80px', 'orderable': false, 'searchable': false}
        ],
        'lengthMenu': [
            [10, 30, 50, 100, -1],
            [10, 30, 50, 100, 'All']
        ],
        'ajax': {
            'url': admin_url + a_mod + '/data-table',
            'type': 'POST',
            data : csrfData
        },
        'drawCallback': function(settings) {
            var api_table = this.api();
            dataTableDrawCallback();

			$('.delete_single').on('click', function(i) {
				var data_pk = [];
				data_pk = [$(this).attr('data-pk')];
				$('.noty_layout').remove(); // close jsnotif
				cfSwalDelete(data_pk,api_table,admin_url+a_mod+'/delete');
			});

			$('.delete_multi').on('click', function() {
				var data_pk = [];
				$('.row_data:checked').each(function(i) {
					data_pk[i] = $(this).val();
				});
				if (data_pk != '' && data_pk != 'on') {
					$('.noty_layout').remove(); // close jsnotif
					cfSwalDelete(data_pk,api_table,admin_url+a_mod+'/delete');
				}
			});
        }
    });
});


// datetime-picker
$(document).ready(function() {   
	$('#datetime-picker').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		showTodayButton: true,
		showClear: true,
		icons: {
			previous: 'icon-arrow-left8',
			next: 'icon-arrow-right8',
			today: 'fa fa-calendar-check-o',
			clear: 'icon-bin',
		},
	});
});


// datepicker
$(document).ready(function() {
    $('#date-picker').datetimepicker({
        format: 'YYYY-MM-DD',
        showTodayButton: true,
        showClear: true,
        icons: {
			previous: 'icon-arrow-left8',
			next: 'icon-arrow-right8',
			today: 'fa fa-calendar-check-o',
			clear: 'icon-bin',
		},
    });
});

// clockpicker
$(document).ready(function() {
    $('#time-picker').datetimepicker({
        format: 'HH:mm:ss',
		showTodayButton: true,
		showClear: true,
		icons: {
			up: 'icon-arrow-up7',
			down: 'icon-arrow-down7',
			today: 'fa fa-clock-o',
			clear: 'icon-bin',
		},
    });
});

// textarea-tinymce
$(document).ready(function() {
	cfTnyMCE('#textarea-tinymce');
});

// filemanager
$(document).ready(function() {
    $('#browse-filemanager').fancybox({ 
        width: 880, 
        height: 570, 
        type: 'iframe', 
        autoScale:1 ,
    });
});

// filemanager callback
function responsive_filemanager_callback(field_id) {
    console.log(field_id);
    var url = jQuery('#' + field_id).val();
    $('#prv').val(url);
    parent.$.fancybox.close();
}
EOS;
return $write;
} //----------------------> End funcion. File javasript.
} // endif















if ( ! function_exists('dump_file_controller')) {
/**
 * ----------------------------------------------------------------
 * Dum for file Controller *.php
 * ----------------------------------------------------------------
*/

/**
 * - File Controller.
 * - Ini adalah fungsi untuk membuat konten file controller.
 * 
 * @param 	string|array 	$data
 * @return 	void|string
*/
function dump_file_controller($data = '') {
$cname = $data['general']['class_name'];
$component_name = $data['general']['component_name'];
$class_name = ucfirst($cname);
$class_mod = underscore($cname);
$model_name = $class_mod."_model";

$data_general = $data['general'];
$component_name = $data_general['component_name'];

$data_field_1 = $data['com_filed_name_1'];

if (!empty($data['field'])) {
	$data_fields = $data['field'];
}
$data_col_name_1 = $data['conf_column_name_1'];

if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$data_config = $data['conf'];

$write = '';
$rdate = DATE('Y-m-d ~ h:i:s');
$write .= <<<EOS
<?php
/**
 * - This file was created using CompoGen
 * 
 * - File         : {$class_name}.php
 * - Date created : {$rdate}
 * - Author       : CompoGen
 * - License      : MIT License
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class {$class_name} extends Admin_controller {
	
	public \$mod = '{$class_mod}';

	public function __construct() 
	{
		parent::__construct();
		
		\$this->load->model("mod/{$class_mod}_model");
		\$this->meta_title("{$component_name}");
	}


	/**
	 * - Function Index
	 *
	 * @return void|string
	 * @access public
	*/
	public function index()
	{
		if (\$this->read_access == TRUE)
		{
			\$this->render_view('view_index', \$this->vars);
		}
		else
		{
			return \$this->render_404();
		}
	}


	/**
	 * - Function DataTable.
	 *
	 * @return void|string|json
	 * @access public
	*/
	public function data_table()
	{
		if (\$this->input->is_ajax_request() == TRUE && \$this->read_access == TRUE) 
		{
			\$output = array();
			\$datas = \$this->{$model_name}->get_datatables();

			foreach (\$datas as \$val) 
			{
				\$row = [];\n
EOS;

if (!empty($data_config['action']['delete_multiple'])) {
$write .= <<< EOS
				\$row[] = '<div class="text-center"><input type="checkbox" class="row_data" value="'. encrypt(\$val['{$data_field_1}']) .'"></div>';\n
EOS;
}

$write .= <<< EOS
				\$row[] = \$val['{$data_field_1}'];\n
EOS;


//---- data_fields cols -----------------------------------------------//
if (!empty($data['col'])) {
foreach ($data_cols as $key => $val) {
$row_value = $val['col_field'];

$write .= <<< EOS
				\$row[] = \$val['{$row_value}'];\n
EOS;

} //-----> End. Foreach data_fields.
}

$write .= <<< EOS
				\$row[] = '<div class="text-center"><div class="btn-group">\n
EOS;

if (!empty($data_config['action']['edit'])) {
$write .= <<< EOS
<button type="button" onclick="location.href=\''. admin_url(\$this->mod."/edit/".\$val['{$data_field_1}']) .'\'" class="button btn-xs btn-default" data-toggle="tooltip" data-placement="top" data-title="'. lang_line('button_edit') .'"><i class="fa fa-pencil"></i></button>\n
EOS;
}

if (!empty($data_config['action']['delete'])) {
$write .= <<< EOS
<button type="button" class="button btn-xs btn-default delete_single" data-toggle="tooltip" data-placement="top" data-title="'.lang_line('button_delete').'" data-pk="'. encrypt(\$val['{$data_field_1}']) .'"><i class="icon-bin"></i></button>\n
EOS;
}

$write .= <<< EOS
</div></div>';
				\$output[] = \$row;
			}

			\$output = array(
							"data" => \$output,
							"draw" => \$this->input->post('draw'),
							"recordsTotal" => \$this->{$model_name}->count_all(),
							"recordsFiltered" => \$this->{$model_name}->count_filtered()
							);

			\$this->json_output(\$output);
		}
		else
		{
			return show_404();
		}
	}



	/**
	 * - Function Add New.
	 *
	 * @return void
	 * @access public
	*/
	public function add_new()
	{
		if (\$this->_act)
		{\n
EOS;


if (!empty($data['field'])) {
foreach ($data_fields as $key_field => $val_field) {
$i_type = $val_field['com_filed_type'];
$i_name = $val_field['com_filed_name'];
$i_label = humanize($i_name);

if ($i_type == "INT") {
$write .= <<<EOS
			\$this->form_validation->set_rules(array(array(
				'field' => '{$i_name}',
				'label' => '{$i_label}',
				'rules' => 'trim'
			)));
\n
EOS;
}//----> End if.

elseif ($i_type == "TEXT") {
$write .= <<<EOS
			\$this->form_validation->set_rules(array(array(
				'field' => '{$i_name}',
				'label' => '{$i_label}'
			)));
\n
EOS;
} //----> End elseif.

else {
$write .= <<<EOS
			\$this->form_validation->set_rules(array(array(
				'field' => '{$i_name}',
				'label' => '{$i_label}',
				'rules' => 'trim'
			)));
\n
EOS;
} //----> End else.

} //----> End foreach.
}

$write .= <<<EOS
			if (\$this->form_validation->run() == TRUE)
			{
				\$data_isert = array(\n
EOS;

if (!empty($data['field'])) {
foreach ($data_fields as $key => $di_val) {
$di_type = $di_val['com_filed_type'];
$di_name = $di_val['com_filed_name'];

if ($di_type == "VARCHAR") {
$write .= <<<EOS
					'{$di_name}' => xss_filter(\$this->input->post('{$di_name}')),\n
EOS;
} // End if.

elseif ($di_type == "INT") {
$write .= <<<EOS
					'{$di_name}' => xss_filter(\$this->input->post('{$di_name}')),\n
EOS;
} // End elseif.

else {
$write .= <<<EOS
					'{$di_name}' => xss_filter(\$this->input->post('{$di_name}')),\n
EOS;
} // End else.

} // End foreach
}

$write .= <<<EOS
				);

				if (\$this->{$model_name}->insert(\$data_isert))
				{
					\$this->alert->set(\$this->mod, 'success', lang_line('form_message_add_success'));
					redirect(admin_url(\$this->mod),'refresh');
				}
				else
				{
					\$this->alert->set(\$this->mod, 'danger', "Oups..! Some error occurred.<br>Please complete the data correctly");
				}
			}
		}

		// render view.
		\$this->render_view('view_add_new', \$this->vars);
	}



	/**
	 * - Function Edit
	 *
	 * @param 	int|string \$id_data
	 * @return 	void
	 * @access 	public
	*/
	public function edit(\$id_data = '')
	{
		if (\$this->modify_access == TRUE)
		{
			\$id_edit = xss_filter(\$id_data, 'sql');
			\$cek_id = \$this->{$model_name}->cek_id(\$id_edit);

			if (\$cek_id == 1) 
			{
				if (\$this->_act)
				{\n
EOS;

if (!empty($data['field'])) {
foreach ($data_fields as $key_field => $val_field) {
$i_type = $val_field['com_filed_type'];
$i_name = $val_field['com_filed_name'];
$i_label = humanize($i_name);

if ($i_type == "INT") {
$write .= <<<EOS
					\$this->form_validation->set_rules(array(array(
						'field' => '{$i_name}',
						'label' => '{$i_label}',
						'rules' => 'trim'
					)));
\n
EOS;
}//----> End if.

elseif ($i_type == "TEXT") {
$write .= <<<EOS
					\$this->form_validation->set_rules(array(array(
						'field' => '{$i_name}',
						'label' => '{$i_label}'
					)));
\n
EOS;
} //----> End elseif.

else {
$write .= <<<EOS
					\$this->form_validation->set_rules(array(array(
						'field' => '{$i_name}',
						'label' => '{$i_label}',
						'rules' => 'trim'
					)));
\n
EOS;
} //----> End else.

} //----> End foreach.
}

$write .= <<< EOS
					if (\$this->form_validation->run() == TRUE)
					{
						\$data_update = array(\n

EOS;

if (!empty($data['field'])){
foreach ($data_fields as $key => $di_val) {
$di_type = $di_val['com_filed_type'];
$di_name = $di_val['com_filed_name'];

if ($di_type == "VARCHAR") {
$write .= <<<EOS
							'{$di_name}' => xss_filter(\$this->input->post('{$di_name}')),\n
EOS;
} // End if.

elseif ($di_type == "INT") {
$write .= <<<EOS
							'{$di_name}' => xss_filter(\$this->input->post('{$di_name}'), 'xss'),\n
EOS;
} // End elseif.

else {
$write .= <<<EOS
							'{$di_name}' => xss_filter(\$this->input->post('{$di_name}')),\n
EOS;
} // End else.

} // End foreach
}

$write .= <<< EOS
						);

						if (\$this->{$model_name}->update(\$id_edit, \$data_update))
						{
							\$this->alert->set(\$this->mod, 'success', lang_line('form_message_update_success'));
						}
						else
						{
							\$this->alert->set(\$this->mod, 'danger', "Oups..! Some error occurred.<br>Please complete the data correctly");
						}
					}
				}
				\$data_edit = \$this->{$model_name}->get_data_edit(\$id_edit);
				\$this->vars['data_row'] = \$data_edit;
				\$this->render_view('view_edit', \$this->vars);
			}
			else
			{
				\$this->render_404();
			}
		}
		else
		{
			\$this->render_404();
		}
	}



	/**
	 * - Function Delete
	 *
	 * @return 	void|string|json
	 * @access 	public
	*/
	public function delete()
	{
		if (\$this->input->is_ajax_request() == TRUE && \$this->delete_access == TRUE)
		{
			\$data = \$this->input->post('data');

			foreach (\$data as \$key)
			{
				\$pk = xss_filter(decrypt(\$key),'sql');
				\$this->{$model_name}->delete(\$pk);
			}

			\$response['success'] = true;
			\$response['alert']['type']    = 'success';
			\$response['alert']['content'] = 'Data has been successfully deleted';
			\$this->json_output(\$response);
		}
		else
		{
			show_404();
		}
	}
} // End Class.
EOS;
return $write;
} //----------------------> End funcion. File Controller.
} // endif















if ( ! function_exists('dump_file_model')) {
/**
 * ----------------------------------------------------------
 * Dum for file Model *.php
 * ----------------------------------------------------------
*/

/**
 * - File Model
 * - Ini adalah fungsi untuk membuat konten file model.
 * 
 * @param 	string|array 	$data
 * @return 	void|string
*/

function dump_file_model($data = '') {
$cname = $data['general']['class_name'];
$component_name = $data['general']['component_name'];
$class_name = ucfirst($cname."_model");
$class_mod = underscore($cname);
$model_name = $class_mod."_model";
$table_name = $data['table_name'];
$data_general = $data['general'];
$component_name = $data_general['component_name'];
$data_field_1 = $data['com_filed_name_1'];

if (!empty($data['field'])) {	
	$data_fields = $data['field'];
}

$data_col_name_1 = $data['conf_column_name_1'];

if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$data_config = $data['conf'];

$write = '';
$rdate = DATE('Y-m-d ~ h:i:s');
$write .= <<<EOS
<?php
/**
 * - This file was created using CompoGen
 * 
 * - File         : {$class_name}.php
 * - Date created : {$rdate}
 * - Author       : CompoGen
 * - License      : MIT License
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class {$class_name} extends CI_Model {

	public \$vars;
	private \$_table = '{$table_name}';
	private \$_column_order = array(null, '{$data_field_1}',
EOS;
if (!empty($data['col'])) {
foreach ($data_cols as $key => $val) {
$coval = $val['col_field'];
$write .= <<< EOS
 '{$coval}',
EOS;
}
}

$write .= <<< EOS
 '{$data_field_1}');
	private \$_column_search = array('{$data_field_1}',
EOS;
if (!empty($data['col'])) {
foreach ($data_cols as $key => $val) {
$csval = $val['col_field'];
$write .= <<< EOS
 '{$csval}',
EOS;
}
}
$write .= <<< EOS
 '{$data_field_1}');

	public function __construct()
	{
		parent::__construct();
	}


	private function _datatable_query()
	{
		\$this->db->from(\$this->_table);

		\$i = 0;	
		foreach (\$this->_column_search as \$item) 
		{
			if (\$this->input->post('search')['value'])
			{
				if (\$i === 0)
				{
					\$this->db->group_start();
					\$this->db->like(\$item, \$this->input->post('search')['value']);
				}
				else
				{
					\$this->db->or_like(\$item, \$this->input->post('search')['value']);
				}

				if (count(\$this->_column_search) - 1 == \$i) 
				{
					\$this->db->group_end(); 
				}
			}
			\$i++;
		}
		
		if (!empty(\$this->input->post('order'))) 
		{
			\$this->db->order_by(
				\$this->_column_order[\$this->input->post('order')['0']['column']], 
				\$this->input->post('order')['0']['dir']
			);
		}
		else
		{
			\$this->db->order_by('{$data_field_1}', 'DESC');
		}
	}


	public function get_datatables()
	{
		\$this->_datatable_query();

		if (\$this->input->post('length') != -1) 
		{
			\$this->db->limit(\$this->input->post('length'), \$this->input->post('start'));
			\$query = \$this->db->get();
		}
		else
		{
			\$query = \$this->db->get();
		}
		
		return \$query->result_array();
	}


	public function count_filtered()
	{
		\$this->_datatable_query();
		\$query = \$this->db->get();
		return \$query->num_rows();
	}


	public function count_all()
	{
		\$this->db->from(\$this->_table);
		return \$this->db->count_all_results();
	}


	public function insert(array \$data)
	{
		\$query = \$this->db->insert(\$this->_table, \$data);
		
		if (\$query == FALSE)
			return FALSE;
		else
			return TRUE;
	}


	public function update(\$key, \$data)
	{
		\$query = \$this->db->where('{$data_field_1}', \$key);
		\$query = \$this->db->update(\$this->_table, \$data);
		
		if (\$query == FALSE)
			return FALSE;
		else
			return TRUE;
	}


	public function delete(\$val = 0)
	{
		if (\$this->cek_id(\$val) == 1) 
		{
			\$this->db->where('{$data_field_1}', \$val)->delete(\$this->_table);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function get_data_edit(\$val_id)
	{
		\$query = \$this->db->where('{$data_field_1}', \$val_id);
		\$query = \$this->db->get(\$this->_table);
		\$result = \$query->row_array();
		return \$result;
	}


	public function cek_id(\$val = 0)
	{
		\$query = \$this->db->select('{$data_field_1}');
		\$query = \$this->db->where('{$data_field_1}', \$val);
		\$query = \$this->db->get(\$this->_table);
		\$query = \$query->num_rows();
		\$int = (int)\$query;
		return \$int;
	}
} // End class.
EOS;
return $write;
} //----------------------> End funcion. File Model.
} // endif















if ( ! function_exists('write_input_text')) {
/**
 * - Text.
 * - Ini adalah fungsi untuk membuat input text.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_text($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
value="<?=\$data_row['{$field_name}'];?>"
EOS;
}
$content = <<< EOS
					<!-- input text | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<input type="text" name="{$field_name}" {$value} class="form-control" required>
						</div>
					</div>
					<!--/ input text | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_text.
} // endif




if ( ! function_exists('write_input_number')) {
/**
 * - Number.
 * - Ini adalah fungsi untuk membuat input number.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_number($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
value="<?=\$data_row['{$field_name}'];?>"
EOS;
}
$content = <<< EOS
					<!-- input number | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<input type="number" name="{$field_name}" {$value} class="form-control" required>
						</div>
					</div>
					<!--/ input number | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_number.
} // endif




if ( ! function_exists('write_input_select')) {
/**
 * - Select Option.
 * - Ini adalah fungsi untuk membuat input select.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_select($input_label = '', $field_name = '', $val = '', array $options) {
$input_label = humanize($input_label);

$option1 = '';
if (!empty($val)) {
$option1 .= <<< EOS
<option value="<?=\$data_row['{$field_name}'];?>" style="display:none;"><?=\$data_row['{$field_name}'];?></option>
EOS;
} else {
$option1 .= <<< EOS
<option value="" style="display:none;">- Select -</option>
EOS;
}

$option = '';
foreach ($options as $key => $ov) {
	$option .= '<option value="'.$ov.'">'.$ov.'</option>';
}
$content = <<<EOS
					<!-- input select | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<select name="{$field_name}" class="form-control" style="max-width:400px;" required>
								{$option1}{$option}
							</select>
						</div>
					</div>
					<!--/ input select | {$input_label} -->\n
EOS;
return $content;
} //---------> End Function write_input_select.
} // endif


if ( ! function_exists('write_input_enum')) {
/**
 * - Select ENUM.
 * - Ini adalah fungsi untuk membuat input select.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_enum($input_label = '', $field_name = '', $options, $default, $val = FALSE) {
$input_label = humanize($input_label);

$option1 = '';
$option2 = '';

if ($val == TRUE) {
$option1 .= <<< EOS
<option value="<?=\$data_row['{$field_name}'];?>" style="display:none;"><?=\$data_row['{$field_name}'];?></option>
EOS;
foreach ($options as $key) {
$option2 .= <<< EOS
<option value="{$key}">{$key}</option>
EOS;
}
}

elseif ($val == FALSE) {
$option1 .= <<< EOS
<option value="{$default}" style="display:none;">{$default}</option>
EOS;
foreach ($options as $key) {
$option2 .= <<< EOS
<option value="{$key}">{$key}</option>
EOS;
}
}

$content = <<<EOS
					<!-- input select ENUM | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<select name="{$field_name}" class="form-control" style="max-width:400px;" required>
								{$option1}{$option2}
							</select>
						</div>
					</div>
					<!--/ input select ENUM | {$input_label} -->\n
EOS;
return $content;
} //---------> End Function write_input_enum.
} // endif


if ( ! function_exists('write_input_textarea')) {
/**
 * - Textarea.
 * - Ini adalah fungsi untuk membuat input textarea.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_textarea($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
<?=\$data_row['{$field_name}'];?>
EOS;
}
$content = <<< EOS
					<!-- textarea | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<textarea name="{$field_name}" class="form-control">{$value}</textarea>
						</div>
					</div>
					<!--/ textarea | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_textarea.
} // endif



if ( ! function_exists('write_input_tinymce')) {
/**
 * - Textarea TinyMCE.
 * - Ini adalah fungsi untuk membuat input textarea dengan plugin TinyMCE.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_tinymce($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
<?=\$data_row['{$field_name}'];?>
EOS;
}
$content = <<< EOS
					<!-- textarea TinyMCE | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<textarea id="textarea-tinymce" name="{$field_name}" class="form-control">{$value}</textarea>
						</div>
					</div>
					<!--/ textarea TinyMCE | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_tinymce.
} // endif



if ( ! function_exists('write_input_date')) {
/**
 * - Text DATE.
 * - Ini adalah fungsi untuk membuat input date.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_date($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
value="<?=\$data_row['{$field_name}'];?>"
EOS;
}
else {
$value .= <<< EOS
value="<?=date('Y-m-d');?>"
EOS;
}
$content = <<<EOS
					<!-- input date | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<div class="input-group" style="max-width:250px;">
								<input id="date-picker" type="text" name="{$field_name}" {$value} class="form-control" placeholder="yyyy-mm-dd" required/>
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<!--/ input date | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_date.
} // endif



if ( ! function_exists('write_input_time')) {
/**
 * - Text Time.
 * - Ini adalah fungsi untuk membuat input time.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_time($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
value="<?=\$data_row['{$field_name}'];?>"
EOS;
}
else {
$value .= <<< EOS
value="<?=date('HH:ii:ss');?>"
EOS;
}
$content = <<<EOS
					<!-- input time | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<div class="input-group" style="max-width:250px;">
								<input id="time-picker" type="text" name="{$field_name}" {$value} class="form-control" placeholder="HH:ii:ss" required/>
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-clock-o"></i></span>
								</div>
							</div>
						</div>
					</div>
					<!--/ input time | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_time.
} // endif



if ( ! function_exists('write_input_datetime')) {
/**
 * - Text DateTime.
 * - Ini adalah fungsi untuk membuat input datetime.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_datetime($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
value="<?=\$data_row['{$field_name}'];?>"
EOS;
}
else {
$value .= <<< EOS
value="<?=date('Y-m-d HH:ii:ss');?>"
EOS;
}
$content = <<<EOS
					<!-- input datetime | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<div class="input-group" style="max-width:250px;">
								<input id="datetime-picker" type="text" name="{$field_name}" {$value} class="form-control" placeholder="yyyy-mm-dd HH:ii:ss" required/>
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<!--/ input datetime | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_datetime.
} // endif



if ( ! function_exists('write_input_filemanager')) {
/**
 * - File input browse filemanager.
 * - Ini adalah fungsi untuk membuat input browse filemanager.
 * 
 * @param 	string 	$input_label
 * @param 	string 	$field_name
 * @param 	string 	$val
 * @return 	void|string
*/
function write_input_filemanager($input_label = '', $field_name = '', $val = '') {
$input_label = humanize($input_label);
$value = '';
if (!empty($val)) {
$value .= <<< EOS
value="<?=\$data_row['{$field_name}'];?>"
EOS;
}
$content = <<< EOS
					<!-- input browse filemanager | {$input_label} -->
					<div class="form-group row">
						<label class="col-form-label col-md-2">{$input_label}</label>
						<div class="col-md-10">
							<div class="input-group" style="max-width:400px;">
								<div class="input-group-prepend">
									<button type="button" id="browse-filemanager" href="<?=content_url('plugins/filemanager/dialog.php?type=1&relative_url=1&field_id=pictures&sort_by=date&descending=1&akey='.login_key('admin'));?>" class="btn btn-default">Browse</button>
								</div>
								<input type="text" id="prv" {$value} class="form-control" placeholder="Choose file..." disabled>
								<input type="hidden" name="{$field_name}" id="pictures" class="form-control">
							</div>
						</div>
					</div>
					<!-- input browse filemanager | {$input_label} -->\n
EOS;
return $content;
} //---------> End function write_input_filemanager.
} // endif


















/**
 * ---------------------------------------------------------------------------------------------
 * Dum for frontend file Controller *.php
 * ---------------------------------------------------------------------------------------------
*/

function dump_frontend_controller($data) {
$component_name = $data['general']['component_name'];
$cname      = seotitle($data['general']['class_name'],'_');
$class_name = "Mod_".$cname;
$class_mod  = underscore($cname);
$model_name = $class_name."_model";
$meta_title = ( !empty($data['frontend']['meta_title']) ? $data['frontend']['meta_title'] : $component_name);
$filename   = $class_name.".php";
$views_file = "mod_$cname";
$rdate      = ci_date(DATE('Y-m-d h:i:s'), 'l, d F Y | h:i A');

$write = '';
$write .= <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * - This file was created using CompoGen
 * 
 * - Mod          : {$component_name}
 * - File         : {$filename}
 * - Date created : {$rdate}
 * - Author       : CompoGen
 * - License      : MIT License
*/

class {$class_name} extends Web_controller {

	public function __construct() 
	{
		parent::__construct();
		
		\$this->load->model("web/{$model_name}"); // Load model
		\$this->meta_title("{$meta_title}"); // Set meta title
	}


	public function index()
	{
		\$this->vars['datas'] = \$this->{$model_name}->get_data(); // get data
		
		// render view
		// \$this->render_view('header', \$this->vars);
		\$this->render_view('{$views_file}', \$this->vars);
		// \$this->render_view('footer', \$this->vars);
	}

} // End Class.
EOS;



return $write;
} //---------> End function dump_frontend_controller.



















/**
 * ---------------------------------------------------------------------------------------------
 * Dum for frontend file Model *.php
 * ---------------------------------------------------------------------------------------------
*/
function dump_frontend_model($data) {
$component_name = $data['general']['component_name'];
$cname = seotitle($data['general']['class_name'],'_');
$class_name = "Mod_".$cname."_model";
$table_name = $data['table_name'];
$data_general = $data['general'];
$data_field_1 = $data['com_filed_name_1'];

if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$filename = $class_name.".php";
$rdate = ci_date(DATE('Y-m-d h:i:s'), 'l, d F Y | h:i A');
$write = '';
$write .= <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * - This file was created using CompoGen
 * 
 * - Mod          : {$component_name}
 * - File         : {$filename}.php
 * - Date created : {$rdate}
 * - Author       : CompoGen
 * - License      : MIT License
*/

class {$class_name} extends CI_Model {

	private \$_table = '{$table_name}';

	public function __construct()
	{
		parent::__construct();
	}


	public function get_data()
	{
		\$query = \$this->db->select('{$data_field_1}
EOS;
if (!empty($data['col'])) {
foreach ($data_cols as $key => $val) {
$col_field = $val['col_field'];
$write .= <<< EOS
,{$col_field}
EOS;
}
}
$write .= <<<EOS
');
		\$query = \$this->db->from(\$this->_table);
		\$query = \$this->db->order_by('{$data_field_1}', 'DESC');
		\$query = \$this->db->get();
		\$result = \$query->result_array();
		return \$result;
	}
} // End Class.
EOS;
return $write;
} //---------> End function dump_frontend_model.
















/**
 * ---------------------------------------------------------------------------------------------
 * Dum for frontend file View  *.php
 * ---------------------------------------------------------------------------------------------
*/
function dump_frontend_view($data) {
$component_name = $data['general']['component_name'];
if (!empty($data['col'])) {
	$data_cols = $data['col'];
}

$write = '';
$write .= <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- 
*******************************************************
	Include Header Template
******************************************************* 
-->
<?php \$this->CI->render_view('header'); ?>

<!-- 
*******************************************************
	Insert Content
******************************************************* 
-->

<section id="page-title">
	<div class="container clearfix">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">{$component_name}</li>
		</ol>
	</div>
</section>
<section id="content">
	<div class="content-wrap pt-5">
		<div class="container clearfix">
			<div class="">
				<h1>{$component_name}</h1>
			</div>
			<div class="col_full detail-content">

				<table class="table table-condensed table-sm table-bordered table-striped">
					<thead>
						<tr>\n
EOS;

if (!empty($data['col'])) {
foreach ($data_cols as $key => $val) {
$row_value = humanize($val['col_name']);
$write .= <<< EOS
							<th>{$row_value}</th>\n
EOS;
}
}

$write .= <<<EOS
						</tr>
					</thead>
					<tbody>
						<?php foreach (\$datas as \$result): ?>
						<tr>\n
EOS;

if (!empty($data['col'])) {
foreach ($data_cols as $key => $val) {
$td_value = $val['col_field'];
$write .= <<< EOS
							<td><?=\$result['{$td_value}'];?></td>\n
EOS;
}
}

$write .= <<<EOS
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</section>

<!-- 
*******************************************************
	Include Footer Template
******************************************************* 
-->
<?php \$this->CI->render_view('footer'); ?>
EOS;

return $write;
} //---------> End function dump_frontend_view.


















/**
 * ---------------------------------------------------------------------------------------------
 * Dum for frontend route
 * ---------------------------------------------------------------------------------------------
*/
function dump_frontend_route($data) {
$component_name = $data['general']['component_name'];
$cname          = seotitle($data['general']['class_name']);
$class_name     = "mod-".$cname;
$class_route    = (!empty($data['frontend']['route']) ? $data['frontend']['route'] : $class_name);

$write = <<<EOS
<?php defined('BASEPATH') OR exit('No direct script access allowed');
\$route['{$class_route}'] = '{$class_name}/index';
EOS;
return $write;
} //---------> End function dump_frontend_view.
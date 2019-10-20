var DataTableIndex = $('#DataTable').DataTable({
    'language': {
        'url': datatable_lang,
    },
    // 'stateSave': true,
    'autoWidth': false,
    'responsive': true,
    'processing': true,
    'serverSide': true,
    'order': [
        //[1, 'desc']
    ],
    'columnDefs': [
        {'targets': 'no-sort', 'orderable': false, 'searchable': false},
        {'targets': 'th-action', 'orderable': false, 'searchable': false},
        { 'targets': [0], 'width': '20px'},
        { 'targets': [1], 'width': '20px'},
        { 'targets': [6], 'width': '70px'}
    ],
    'lengthMenu': [
        [10, 30, 50, 100, -1],
        [10, 30, 50, 100, 'All']
    ],
    'ajax': {
        'type': 'POST',
        'url': window.location.href
    },
    'drawCallback': function( settings ) {
        var api_table = this.api();
        dataTableDrawCallback(); // standard setting

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

$('#form_add_user').on('submit', function(e){
    //e.preventDefault();
    $('.submit_add').find('i').removeClass().addClass('icon-spinner2 spinner mr-2');
    $('.noty_layout').remove();
    var form = $('#form_add_user');
    $.ajax({
        url: admin_url + a_mod + '/add-new',
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        cache: false,
        success:function(response){
            if (response['success']==true) {
                $(location).attr('href',admin_url + a_mod);
            } else {
                cfNotif(response['alert']);
                $('.submit_add').find('i').removeClass().addClass('fa fa-check mr-2');
            }
        }
    })
    return false;
});

$('#form_update_user').on('submit',function(e){
    e.preventDefault();
    $('.submit_update').find('i').removeClass().addClass('icon-spinner2 spinner mr-2');
    $('.noty_layout').remove();
    var formData = new FormData(this);
    var form = $('#form_update_user');
    $.ajax({
        url: admin_url + a_mod + '/submit-update-user',
        type: 'POST',
        //data: formData.serialize(),
        data: formData,
        dataType: 'json',
        contentType: false,  
        processData:false,
        cache: false,
        success:function(response){
            cfNotif(response['alert']);
            $('.submit_update').find('i').removeClass().addClass('fa fa-save mr-2');
        }
    })
    return false;
});

// data-table level
var DataTableLevel = $("#DataTableLevel").DataTable({
	"language": {
        "url": datatable_lang,
    },
	// "stateSave": true,
	"autoWidth": false,
	"responsive": true,
	"processing": true,
	"serverSide": true,
	//"order": [[0, 'asc']],
	"columnDefs": [
		{ "targets": [0], "width": "30px",},
		{ "targets": [4], "width": "90px", "orderable": false, "searchable": false},
	],
	"lengthMenu": [
		[10, 30, 50, 100, -1],
		[10, 30, 50, 100, "All"]
	],
	"ajax": {
		"url": admin_url + a_mod + "/data-table-level",
		"type": "POST",
        data: csrfData
	},
	"drawCallback": function( settings ) {
		var api_table = this.api();
        dataTableDrawCallback(); // standard setting

        $('[data-toggle="tooltip"]').tooltip();

        $('.row_data:checkbox').on('click', function(a) { 
            $(this).is('.row_data:checked') ? $(this).closest('table tbody tr').addClass('table-danger') : $(this).closest('table tbody tr').removeClass('table-danger') 
        }),
        $('.select_all').on('click', function(a) {
            var a = this.checked;
            $('.row_data').each(function() {
                this.checked = a, a == this.checked && $(this).closest('table tbody tr').removeClass('table-danger'), this.checked && $(this).closest('table tbody tr').addClass('table-danger')
            })
        });

        $('.delete_single').on('click', function(i) {
            var data_pk = [];
            data_pk = [$(this).attr('data-pk')];
            $('.noty_layout').remove(); // close jsnotif
            cfSwalDelete(data_pk, api_table, admin_url+a_mod+'/delete-level');
        });

		$(".view_level").on('click', function(e){
            e.preventDefault();
			$('#modal_preview_level').modal('show');
            $('#data-detail').html('<p class="text-center">Please wait...</p>')
		    var id_level=$(this).attr("id-level");
		    var title_level=$(this).attr("title-level");
		    $.ajax({
		        type:'POST',
                dataType: 'html',
                data: {
                    act: 'ajax_preview_level',
                    id_level: id_level,
                    title: title_level,
                },
		        cache:false,
		        success: function(data){
		        	$('#data-detail-title').html(title_level);
		        	$('#data-detail').html(data);
		        }
		    });
		});
	},
});

$(".add_level").click(function() {
	$('#modal_add_level').modal('show');
});

$("#level-title-input").on("input",function(){
	var e;
	e=(e=(e=$.trim($(this).val())).replace(/\s+/g," ")).replace(/_/g," "),
	$("#level-seotitle-input").val(e.toLowerCase()),
	$("#level-seotitle-input").val($("#level-seotitle-input").val().replace(/\W/g," ")),
	$("#level-seotitle-input").val($.trim($("#level-seotitle-input").val())),
	$("#level-seotitle-input").val($("#level-seotitle-input").val().replace(/\s+/g,"-"))
});

$('#level-seotitle-input').on('input',function(){
	var a;
	a=$(this).val(),a=a.replace(/\s+/g,' '),a=a.replace(/_/g,' '),
	$('#level-seotitle-input').val(a.toLowerCase()),
	$('#level-seotitle-input').val($('#level-seotitle-input').val().replace(/\W/g,' ')),
	$('#level-seotitle-input').val($('#level-seotitle-input').val().replace(/\s+/g,'-'))
});

$(".add_module_role").on('click',function(e) {
    e.preventDefault();
	$('#modal_add_module_role').modal('show');
});

$(".edit_module_role").on('click',function(e) {
    e.preventDefault();
	var id_module = $(this).attr("id-module");
    $('#id_module').val(id_module);
	return $.ajax({
        type:'POST',
        data:'id_module='+id_module+'&act=edit_module_role&'+csrfName+'='+csrfToken,
        cache:false,
        success: function(data){
        	$('#view-edit-module').html(data);
			$('#modal_edit_module_role').modal('show');
        }
    });
});

$(".moda_delete_module").click(function() {
    $('#modal_delete_module').modal('show');
    var idMod = $(this).attr("idMod");
    $('#idMod').val(idMod);
    $('#modal_delete_level').modal('show');
});

$(".close-preview2").click(function(){
	$(this).hide();
	var resimg = $('#resset-image').val();
	var valimg = $(this).attr('vaimg');
    $('#image-preview').attr('src', resimg);
    $('#upload-image').val(valimg);
    
});

$(".close-preview").click(function(){
	$(this).hide();
	var resimg = content_url + '/images/avatar.jpg';
    $('#image-preview').attr('src', resimg);
    $('#upload-image').val('');
});

$('#input-datepicker').datetimepicker({
    format: 'YYYY-MM-DD',
    showTodayButton: true,
    showClear: true,
    icons: {
        previous: 'icon-arrow-left8',
        next: 'icon-arrow-right8',
        today: 'icon-calendar3',
        clear: 'icon-bin',
    },
});

$('input:not(textarea)').keydown(function(event){
    var a = event.witch || event.keyCode;
    if(a == 13){
        event.preventDefault();
        return false;
    }
});

function readImgURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result);
            $(".close-preview").show();
            $(".close-preview2").show();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#upload-image").change(function(){
    readImgURL(this);
});
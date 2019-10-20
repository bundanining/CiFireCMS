$('#DataTable').DataTable({
	'language': {
		'url': datatable_lang,
	},
	'stateSave': false,
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
		{ 'targets': [4], 'width': '70px'}
	],
	'lengthMenu': [
		[10, 30, 50, 100, -1],
		[10, 30, 50, 100, 'All']
	],
	'ajax': {
		'type': 'POST',
		'url': window.location.href
	},
	drawCallback: function( settings ) {
        var api_table = this.api();
        dataTableDrawCallback(); // standard setting

        $('.delete_single').on('click', function(i) {
            var data_pk = [];
            var url = admin_url+a_mod+'/delete';
            data_pk = [$(this).attr('data-pk')];
            cfSwalDelete(data_pk,api_table,url);
        });

        $('.delete_multi').on('click', function() {
            var data_pk = [];
            var url = admin_url+a_mod+'/delete';
            $('.row_data:checked').each(function(i) {
                data_pk[i] = $(this).val();
            });
            if (data_pk != '' && data_pk != 'on') {
                cfSwalDelete(data_pk,api_table,url);
            }
        });
	}
});


$('#form_add').on('submit',function(event){
	event.preventDefault();
	$('.submit_add').find('i').removeClass().addClass('icon-spinner2 spinner mr-2');
	// $('.noty_layout').remove();
	tinyMCE.triggerSave();
	var form = $(this);
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


$('#form_update').on('submit',function(event){
	event.preventDefault();
	$('.submit_update').find('i').removeClass().addClass('icon-spinner2 spinner mr-2');
	// $('.noty_layout').remove();
	tinyMCE.triggerSave();
	var form = $(this);
	$.ajax({
		type: 'POST',
		data: form.serialize(),
		dataType: 'json',
		cache: false,
		success:function(response){
			cfNotif(response['alert']);
			$('.submit_update').find('i').removeClass().addClass('fa fa-save mr-2');
		}
	})
	return false;
});


$('#delpict').on('click',function(event){
	event.preventDefault();
	$('#picture').val('');
	$('#imgprv').attr('src', content_url + '/images/noimage.jpg');
});

cfTnyMCE('#Content'); // load TnyMCE

$('input:not(textarea)').keydown(function(event){
	var kc = event.witch || event.keyCode;
	if(kc == 13){
	event.preventDefault();
		return false;
	}
});
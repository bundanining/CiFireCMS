$("#DataTable").DataTable({
	"language": {
		"url": datatable_lang,
	},
	// "stateSave": true,
	'autoWidth': false,
	'responsive': true,
	'processing': true,
	'serverSide': true,
	"order": [
		// [4, 'desc']
	],
	"columnDefs": [
		{'targets': 'no-sort', 'orderable': false, 'searchable': false},
		{'targets': 'th-action', 'orderable': false, 'searchable': false},
		{ 'targets': [0], 'width': '20px'},
		{ 'targets': [1], 'width': '20px'},
		{ 'targets': [4], 'width': '200px'},
		{ 'targets': [5], 'width': '60px'}
	],
	"lengthMenu": [
		[10, 30, 50, 100, -1],
		[10, 30, 50, 100, "All"]
	],
	'ajax': {
		'type': 'POST',
		'url': window.location.href
	},
	"drawCallback": function( settings ) {
		var api_table = this.api();
		dataTableDrawCallback();

		$('.delete_single').on('click', function(i) {
			var data_pk = [];
			data_pk = [$(this).attr('data-pk')];
			var url = admin_url + a_mod + '/delete';
			cfSwalDelete(data_pk, api_table, url);
		});

		$('.delete_multi').on('click', function() {
			var data_pk = [];
			var url = admin_url + a_mod + '/delete';
			$('.row_data:checked').each(function(i) {
				data_pk[i] = $(this).val();
			});
			if (data_pk != '' && data_pk != 'on') {
				cfSwalDelete(data_pk,api_table,url);
			}
		});

		/*
		$('.mail_detail').click(function() {
			var id_data = $(this).attr('id');
			var h_name = $(this).attr('h-name');
			var h_email = $(this).attr('h-email');

			$('.mail_head b').html(h_name);
			$('.mail_head span').html(h_email);

			$('#modal_view').modal('show');
			
			$('.mail_content').html('<center><img src="' + content_url + '/images/loading.gif" style="display:table;margin:auto;"></center>');

			$.ajax({
				type:'POST',
				url:window.location.href + '/mail_detail/',
				data:'id='+id_data,
				success: function(data){    
					var res = data;
					$('.mail_content').html('<div><h4>' + res.subject + '</h4><hr>' + res.content + '</div>');                        
					$('#mico-'+id_data).removeClass('text-success');
					$('#mico-'+id_data).addClass('text-muted');
					$('#mico-'+id_data).html('<i class="fa fa-envelope-o"></i>');
				}
			});
		});
		*/
	},
});

$(document).ready(function() {
	$('#submit_delete').on('click',function() {
		document.body.scrollTop = document.documentElement.scrollTop = 0;
		var form = $('#form_delete');
		$('.ajax_alert').hide();
		$('.alert').hide();
		$('#modal_delete').modal('hide');
		$.ajax({
			url: admin_url + a_mod + '/delete',
			type: 'POST',
			data: form.serialize(),
			dataType: 'json',
			success:function(response) {
				var alert_type = response.alert_type;
				var alert_messages = response.alert_messages;
				table.row($('#table tr.active')).remove().draw(false);
				$('.ajax_alert').show().html('<div class="alert alert-' + alert_type + ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + alert_messages + '</div>');
				$('.ajax_alert').fadeTo(15353, 50).slideUp(300, function() {
					$('.alert').alert('close');
					$('.ajax_alert').hide();
				});
			}
		}); 
		return false;
	});
});

$(document).ready(function() {
	cfTnyMCE('#Content');
});

$('.delete_read_mail').on('click',function(event) {
	event.preventDefault();
	var dataPk = [$(this).attr('data-id')];
	var dataUrl = admin_url + a_mod + '/delete';
	_mail_delete(dataPk,dataUrl)
});

function _mail_delete(pk,uri) {
	var dataPk = pk;
	var dataUrl = uri;
	getLangJSON().done(function(lang){
		var _txtTitle = '<strong>'+lang.modal['delete_title']+'</strong>';
		var _txtContent = lang.modal['delete_content'];
		var _btnDelete = '<i class="icon-bin mr-2"></i>'+lang.button['delete'];
		var _btnCancel = lang.button['cancel'];
		swal.fire({
			type: 'warning',
			position: 'top',
			title: _txtTitle,
			text: _txtContent,
			showCloseButton: true,
			buttonsStyling: false,
			showCancelButton: true,
			showConfirmButton: true,
			confirmButtonClass: 'btn btn-danger',
			cancelButtonClass: 'btn btn-default',
			confirmButtonText: _btnDelete,
			cancelButtonText: _btnCancel,
			showLoaderOnConfirm: true,
			preConfirm: function() {
				return new Promise(function(resolve, reject) {
					$.ajax({
						type: 'POST',
						url: dataUrl,
						dataType: 'json',
						data: {data: dataPk},
						cache: false,
						success:function(response) {
							if (response['success']==true) {
								window.location.href = admin_url + a_mod;
							} else {
								Swal.fire({
									position: 'top',
									type: 'error',
									title: 'Error',
									showConfirmButton: false,
									timer: 2500
								})
								setTimeout(function() {
									resolve();
								}, 1000000);
							};
						}
					});
				});
			},
		}).then( (result) => {
			if (result.value) {
			}
			else{}
		})
	});
}
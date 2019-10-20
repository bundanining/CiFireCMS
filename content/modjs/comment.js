$('#DataTable').DataTable({
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
        { 'targets': [5], 'width': '90px'}
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
        dataTableDrawCallback();

        $('.delete_single').on('click', function(i) {
            var data_pk = [];
            var url = window.location.href+'/delete';
            data_pk = [$(this).attr('data-pk')];
            cfSwalDelete(data_pk,api_table,url);
        });

        $('.delete_multi').on('click', function() {
            var data_pk = [];
            var url = window.location.href+'/delete';
            $('.row_data:checked').each(function(i) {
                data_pk[i] = $(this).val();
            });
            if (data_pk != '' && data_pk != 'on') {
                cfSwalDelete(data_pk,api_table,url);
            }
        });

        $('.modal_detail').click(function() {
			var idDet = $(this).attr('idDet');
			$('#modal_detail').modal('show');
			$('#cdet').html('<div><img src="' + content_url + '/images/loading.gif" style="display:table;margin:auto;"></div>');
			$.ajax({
				type: 'POST',
				url: window.location.href + '/view-detail/' + idDet,
				data: 'id=' + idDet + '&' + csrfName + '=' + csrfToken,
				success: function(data){
					$('#cdet').html('<div><b>' + data.name + '</b>&nbsp;<small class="text-muted">(' + data.email + ')</small></div><div style="margin-bottom:18px;font-size:14px;color:#888;"><small>' + data.date + '</small></div><div><p>' + data.comment + '</p></div>');
					$('#active'+idDet).removeClass('text-success');
					$('#active'+idDet).removeClass('fa-commenting');
					$('#active'+idDet).addClass(data.textClass);
					$('#active'+idDet).addClass(data.icon);
				}
			});
		});

		$('.modal_block').click(function() {
			var idCom = $(this).attr('idCom');
			$('#idCom').val(idCom);
			$('#modal_block').modal('show');
		});

		$('.modal_active').click(function() {
			var idCom = $(this).attr('idCom');
			$('#idComu').val(idCom);
			$('#modal_active').modal('show');
		});
    }
});

$('#submit_delete').on('click',function() {
    document.body.scrollTop = document.documentElement.scrollTop = 0;
    var form = $('#form_delete');
    $('.ajax_alert').hide();
    $('.alert').hide();
    $('#modal_delete').modal('hide');
    $.ajax({
        url: window.location.href + '/delete',
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
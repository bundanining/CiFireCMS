var DataTable = $('#DataTable').DataTable({
	'language': {
		'url': datatable_lang,
	},
	'stateSave': false,
	'autoWidth': false,
	'responsive': false,
	'processing': true,
	'serverSide': true,
	'order': [
		//[1, 'desc']
	],
	'columnDefs': [
		{'targets': 'no-sort', 'orderable': false, 'searchable': false},
		{'targets': 'th-action', 'orderable': false, 'searchable': false},
		{ 'targets': [0], 'width': '20px'},
		// { 'targets': [1], 'width': '20px'},
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

		$('.headline_toggle').on('click', function() {
			$(this).find('i').removeClass().addClass('icon-spinner2 spinner');
			$('.noty_layout').remove();
			var data_pk = $(this).attr('data-id');
			$.ajax({
				url: admin_url + a_mod + '/headline',
				type: 'POST',
				dataType: 'json',
				data:{pk: data_pk,},
				success:function(response){
					if (response['status']==true) {
						var classRow = '.'+response['index'];
						var content = response['html'];
						$(classRow).html(content);
						cfNotif(response['alert']);
					} else{
						cfNotif(response['alert']);
					};
					$('.headline_toggle').find('i').removeClass().addClass('fa fa-star');
				}
			});
		});
	}
});

$('input:not(textarea)').keydown(function(event){
	var a = event.witch || event.keyCode;
	if(a == 13){
		event.preventDefault();
		return false;
	}
});

$('#form_add').on('submit',function(event){
	event.preventDefault();
	$('.submit_add').find('i#submit_icon').removeClass().addClass('icon-spinner2 spinner mr-2');
	// $('.noty_layout').remove();
	tinyMCE.triggerSave();
	var form = $('#form_add');
	$.ajax({
		url: admin_url + a_mod + '/add-new',
		type: 'POST',
		data: form.serialize(),
		dataType: 'json',
		cache: false,
		success:function(data){
			if (data['success']==true) {
				$(location).attr('href',admin_url + a_mod);
			} else {
				cfNotif(data['alert']);
				$('.submit_add').find('i#submit_icon').removeClass().addClass('fa fa-check mr-2');
			}
		}
	})
	return false;
});

$('#form_update').on('submit',function(event){
	event.preventDefault();
	$('.submit_update').find('i#submit_icon').removeClass().addClass('icon-spinner2 spinner mr-2');
	// $('.noty_layout').remove();
	tinyMCE.triggerSave();
	var form = $('#form_update');
	$.ajax({
		type: 'POST',
		data: form.serialize(),
		dataType: 'json',
		cache: false,
		success:function(data){
			cfNotif(data['alert']);
			$('.submit_update').find('i#submit_icon').removeClass().addClass('fa fa-save mr-2');
			// $('html, body').animate({scrollTop:0});
		}
	})
	return false;
});

var tagName = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	remote: {
		url: admin_url + 'post/ajax-tags',
		prepare: function (query, settings) {
			$('.tt-hint').show();
			settings.type = 'POST';
			settings.data = 'seotitle=' + query + '&' + csrfName + '=' + csrfToken;
			return settings;
		},
		filter: function (parsedResponse) {
			$('.tt-hint').hide();
			return parsedResponse;
		}
	}
});

tagName.initialize();

$('#tagsjs').tagsinput({
	typeaheadjs: {
		name: 'tagName',
		displayKey: 'title',
		valueKey: 'title',
		source: tagName.ttAdapter()
	}
});

$('.twitter-typeahead').css('display', 'inline');

$('.select-category').select2({
	minimumInputLength: 0,
	// allowClear: true,
	ajax: {
		dataType: 'json',
		type: 'POST',
		url: admin_url + a_mod + '/ajax-get-category',
		data: function(params) {
			return {
				search: params.term
			}
		},
		processResults: function (data, page) {
			return {
				results: data
			}
		},
	}
});

$('#publishdate').datetimepicker({
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

$('#publishtime').datetimepicker({
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

$('#delpict').on('click',function(){
	$('#picture').val('');
	$('#imgprv').attr('src', content_url + '/images/noimage.jpg');
});

cfTnyMCE('#Content'); // load TnyMCE
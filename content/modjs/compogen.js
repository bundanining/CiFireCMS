
getLangJSON().done(function(jsonLang){
	var lang = jsonLang['compogen'];
	var errMsg = jsonLang['validation'];
	var formCompoGen = $('.steps-validation');

	/* form wizart */
	formCompoGen.steps({
		headerTag: 'h6',
		bodyTag: 'fieldset',
		titleTemplate: '<span class="number">#index#</span> #title#',
		labels: {
			previous: '<i class="icon-arrow-left13 ml-2 mr-2" /><span class="mr-2">'+ lang['button']['prev'] +'</span>',
			next:  '<span class="ml-2">'+ lang['button']['next'] + '</span><i class="icon-arrow-right14 ml-2 mr-2" />',
			finish: '<span class="ml-3 mr-3">'+ lang['button']['generate'] + '</span>'
		},
		transitionEffect: 'none',
		autoFocus: true,
		onInit: function (event, currentIndex) {
			_compGenOnInit();
		},
		onStepChanging: function (event, currentIndex, newIndex) {
			var form = $(this).show();
			// Allways allow previous action even if the current form is not valid!
			if (currentIndex > newIndex) {
				return true;
			}
			// Needed in some cases if the user went back (clean up)
			if (currentIndex < newIndex) {
				// To remove error styles
				form.find('.body:eq(' + newIndex + ') label.error').remove();
				form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
			}
			form.validate().settings.ignore = ':disabled,:hidden';
			return form.valid();
		},
		onFinishing: function (event, currentIndex) {
			var form = $(this);
			form.validate().settings.ignore = ':disabled';
			return form.valid();
		},
		onFinished: function (event, currentIndex) {
			event.preventDefault();
			$('#loads').show();
			var form = $(this);
			$.ajax({
				url: window.location.href+'/submit',
				type: 'POST',
				data: form.serialize(),
				dataType: 'json',
				cache: false,
				success:function(response) {
					if (response['success']==true) {
						window.location.href=window.location.href+'/finish/'+response['class'];
					} else {
						$('#loads').hide();
						cfNotif(response['alert']);
					};
				}
			});
		}
	});
	
	/* validation */
	$.validator.setDefaults({
		debug: true,
	});
	formCompoGen.validate({
		ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
		errorClass: 'error',
		rules: {
			"general[component_name]": {
				required: true,
				minlength: 4,
				maxlength: 50,
			},
			"table_name": {
				required: true,
				minlength: 4,
				maxlength: 50,
			}
		}
	});
	$.validator.messages.required = errMsg['required'];
	$.validator.messages.minlength = errMsg['minlength'];
	$.validator.messages.maxlength = errMsg['maxlength'];
});

function _compGenOnInit(){
	$('.btn-add-field').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr("id");
		var newid = parseInt(id) + 1;
		var idtot = $('#totalfield').val();
		var newidtot = parseInt(idtot) + 1;
		var dataString = 'id=' + id;
		$('.btn-add-field').find('i').removeClass().addClass('fa fa-spinner fa-pulse');
		$.ajax({
			type: 'POST',
			url: window.location.href + '/add-field',
			data: dataString,
			cache: false,
			success: function(data){
				$('[data-toggle="tooltip"]').tooltip();
				$('#append-add-field').append(data);
				$('.btn-add-field').attr('id', '' + newid + '');
				$('input[id^="field"]').on('input',function(){var b;b=(b=(b=$(this).val()).replace(/\s+/g,' ')).replace(/_/g,' '),$(this).val(b.toLowerCase()),$(this).val($(this).val().replace(/\W/g,' ')),$(this).val($(this).val().replace(/\s+/g,'_'))});
				$('#totalfield').val(newidtot);
				$('.btn-add-field').find('i').removeClass().addClass('fa fa-plus-circle');
			}
		});
		return false;
	});

	$(document).on('click','.rmfield',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		$('#def-field-'+id).remove();
	});

	$(document).on('click','.add-more-option',function(e){
		e.preventDefault();
		var id = $(this).attr("id");
		var newid = parseInt(id) + 1;
		var idtot = $('#totaloption').val();
		var newidtot = parseInt(idtot) + 1;
		var dataString = 'id=' + id;
		$('.add-more-option').find('i').removeClass().addClass('fa fa-spinner fa-pulse');
		$.ajax({
			type: 'POST',
			url: window.location.href + '/add-option',
			data: dataString,
			cache: false,
			success: function(html){
				$('#append-add-options').append(html);
				$('.add-more-option').attr('id', '' + newid + '');
				$('#totaloption').val(newidtot);
				$('.add-more-option').find('i').removeClass().addClass('fa fa-plus-circle');
			}
		});
		return false;
	});

	$(document).on('click','.rmoption',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		$('#def-option'+id).remove();
	});

	$(document).on('click','.btn-add-column',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		var newid = parseInt(id) + 1;
		var idtot = $('#totalcol').val();
		var newidtot = parseInt(idtot) + 1;
		var dataString = 'id=' + id;
		$('.btn-add-column').find('i').removeClass().addClass('fa fa-spinner fa-pulse');
		$.ajax({
			type: 'POST',
			url: window.location.href + '/add-column',
			data: dataString,
			cache: false,
			success: function(html){
				$('#append-add-column').append(html);
				$('.btn-add-column').attr('id', '' + newid + '');
				$('#totalcol').val(newidtot);
				$('.btn-add-column').find('i').removeClass().addClass('fa fa-plus-circle');
			}
		});
		return false;
	});

	$(document).on('click','.rmcol',function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		$('#def-column-' + id).remove();
	});

	$(document).on('click','.show-modal-terms',function(e){
		e.preventDefault();
		$('#modal-terms').modal('show');
	});

	$(document).on('input','#component_name',function(){var b;b=(b=(b=$(this).val()).replace(/\s+/g," ")).replace(/_/g," "),$('#classname').val(b.toLowerCase()),$('#classname').val($('#classname').val().replace(/\W/g," ")),$('#classname').val($('#classname').val().replace(/\s+/g,""))});
	$(document).on('input','#tablename',function(){var b;b=(b=(b=$(this).val()).replace(/\s+/g," ")).replace(/_/g," "),$(this).val(b.toLowerCase()),$(this).val($(this).val().replace(/\W/g," ")),$(this).val($(this).val().replace(/\s+/g,"_"))});
	$(document).on('input','#com_fieldname_1',function(){var b;b=(b=(b=$(this).val()).replace(/\s+/g," ")).replace(/_/g," "),$(this).val(b.toLowerCase()),$(this).val($(this).val().replace(/\W/g," ")),$(this).val($(this).val().replace(/\s+/g,"_"))});
	$(document).on('input','input[id^="field"]',function(){var b;b=(b=(b=$(this).val()).replace(/\s+/g," ")).replace(/_/g," "),$(this).val(b.toLowerCase()),$(this).val($(this).val().replace(/\W/g," ")),$(this).val($(this).val().replace(/\s+/g,"_"))});

	$(document).on('input','#route_title',function(){var b;b=(b=(b=$(this).val()).replace(/\s+/g," ")).replace(/_/g," "),$('#route_title').val(b.toLowerCase()),$('#route_title').val($('#route_title').val().replace(/\W/g," ")),$('#route_title').val($('#route_title').val().replace(/\s+/g,"-"))});
}
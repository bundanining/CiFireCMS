var _jsDsCustoms = function () {
	// Sidebar navigation
	var _navigationSidebar = function() {
		// Define default class names and options
		var navClass = 'nav-sidebar',
			navItemClass = 'nav-item',
			navItemOpenClass = 'nav-item-open',
			navLinkClass = 'nav-link',
			navSubmenuClass = 'nav-group-sub',
			navSlidingSpeed = 250,
			activeMod = admin_url + a_mod,
			activeAct = admin_url + a_mod + a_act,
			activePage = window.location.href;
		// Configure collapsible functionality
		$('.' + navClass).each(function() {
			$(this).find('.' + navItemClass).has('.' + navSubmenuClass).children('.' + navItemClass + ' > ' + '.' + navLinkClass).not('.disabled').on('click', function (e) {
				e.preventDefault();

				// Simplify stuff
				var $target = $(this),
					$navSidebarMini = $('.sidebar-xs').not('.sidebar-mobile-main').find('.sidebar-main .' + navClass).children('.' + navItemClass);

				// Collapsible
				if($target.parent('.' + navItemClass).hasClass(navItemOpenClass)) {
					$target.parent('.' + navItemClass).not($navSidebarMini).removeClass(navItemOpenClass).children('.' + navSubmenuClass).slideUp(navSlidingSpeed);
				}
				else {
					$target.parent('.' + navItemClass).not($navSidebarMini).addClass(navItemOpenClass).children('.' + navSubmenuClass).slideDown(navSlidingSpeed);
				}

				// Accordion
				if ($target.parents('.' + navClass).data('nav-type') == 'accordion') {
					$target.parent('.' + navItemClass).not($navSidebarMini).siblings(':has(.' + navSubmenuClass + ')').removeClass(navItemOpenClass).children('.' + navSubmenuClass).slideUp(navSlidingSpeed);
				}
			});
		});

		// Disable click in disabled navigation items
		$(document).on('click', '.' + navClass + ' .disabled', function(e) {
			e.preventDefault();
		});

		// Scrollspy navigation
		$('.nav-scrollspy').find('.' + navItemClass).has('.' + navSubmenuClass).children('.' + navItemClass + ' > ' + '.' + navLinkClass).off('click');

		$('ul#main_menu > li a').not('ul li ul a').each(function(){
			var currentPage = $(this).attr('href');
			if (activeMod === currentPage) {
				$(this).parent().addClass('nav-item-open');
				$('.li-'+a_mod).css('display','block');
			} 
		});

		$('ul#main_menu li a').each(function(){
			var currentPage = $(this).attr('href');
			if (activeAct == '' || activeAct == null || activeAct == undefined) {
				if (activePage == currentPage) {
					$(this).parent().addClass('nav-item-open');
					$('.li-'+a_mod).css('display','block');
				}
			} else {
				var activeAct = window.location.href;
				if (activeAct == currentPage) {
					$(this).parent().addClass('nav-item-open');
					$('.li-'+a_mod).css('display','block');
				}
			}
		});
	};

	var _componentSticky = function() {
		if (!$().stick_in_parent) {
			console.warn('Warning - sticky.min.js is not loaded.');
			return;
		}
		// Initialize
		$('#sticky').stick_in_parent({
			offset_top: 49,
			parent: '.box-content'
		});
		// Detach on mobiles
		$('.sidebar-mobile-component-toggle').on('click', function() {
			$('#sticky').trigger("sticky_kit:detach");
		});
	}

	var _scrollToTop = function() {
		$(document).scroll(function () {
			var _sgtp = $(this).scrollTop();
			if (_sgtp > 100) {
				$('.sgo-top').show();
			} else {
				$('.sgo-top').hide();
			}
		});

		// klik link to top scroll
		$('.sgo-top').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({scrollTop:0}, '100');
			return false;
		});
	}

	var _alertDefault = function() {
		$(".alert").delay(5000).slideUp(300, function() {
			$(this).alert('close');
		});
	}

	var _browseFiles = function() {
		$('.browse-files').fancybox({ 
			width: 880, 
			height: 570, 
			type: "iframe", 
			autoScale:1 ,
		});
	}

	var _inputSelect2 = function() {
		$('.select-2').select2();
		$('.select-2-nosearch').select2({
			minimumResultsForSearch: Infinity
		});
	}
	
	var _tooltip = function () {
		$('[data-toggle="tooltip"]').tooltip();
	}

	var _fancybox = function () {
		$('.fancybox').fancybox();
	}

	return {
		initComponents: function() {
			_navigationSidebar();
			_alertDefault();
			_scrollToTop();
			_componentSticky();
			_browseFiles();
			_inputSelect2();
			_tooltip();
			_fancybox();
		}
	}
}();

document.addEventListener('DOMContentLoaded', function() {
	_jsDsCustoms.initComponents();
});

function cfNotif(data){
	Noty.overrideDefaults({
		theme: 'limitless',
		layout: 'topRight',
		type: 'alert',
		timeout: 4000
	});   
	new Noty({
		text: data['content'],
		type: data['type'],
		modal: true
	}).show();
}

function cfAlert(data){
	$('#alert-notif').html('<div class="alert alert-' + data['type'] + ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data['content'] + '</div>').show();
	$('.alert').fadeTo(15353, 50).slideUp(300, function() {
		$('.alert').alert('close');
		$('#alert-notif').hide();
	});
}

function dataTableDrawCallback() {
	$('.dataTables_length select').select2({
		minimumResultsForSearch: Infinity,
		dropdownAutoWidth: true,
		width: 'auto'
	});
	$('[data-toggle="tooltip"]').tooltip();
	$('.row_data:checkbox').on('click', function(a) { 
		$(this).is('.row_data:checked') ? $(this).closest('table tbody tr').addClass('table-danger') : $(this).closest('table tbody tr').removeClass('table-danger') 
	});
	$('.select_all').on('click', function(a) {
		var a = this.checked;
		$('.row_data').each(function() {
			this.checked = a, a == this.checked && $(this).closest('table tbody tr').removeClass('table-danger'), this.checked && $(this).closest('table tbody tr').addClass('table-danger')
		})
	});
}

function getLangJSON(){
	var result = $.ajax({
		dataType: 'json',
		url: content_url+'plugins/json/lang/'+lang_active+'.json',
	});
	return result;
}

function cfSwalDelete(pk,api_table,uri){
	var dataPk = pk;
	var dataUrl = uri;
	var dataTable = api_table;
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
								dataTable.row($('#DataTable tr.active')).remove().draw(false);
								resolve();
							} else {
								Swal.fire({
									position: 'top',
									type: 'error',
									title: 'Error',
									showConfirmButton: false,
									timer: 2500
								})
							};
						}
					});
				});
			},
		}).then( (result) => {
			if (result.value) {
				Swal.fire({
					position: 'top',
					type: 'success',
					title: lang.message['delete_success'],
					showConfirmButton: false,
					timer: 2500
				})
			}
			else{}
		})
	});
}

function cfCompogen(){
	getLangJSON().done(function(lang){
		$('.steps-validation').steps({
		    headerTag: 'h6',
		    bodyTag: 'fieldset',
		    titleTemplate: '<span class="number">#index#</span> #title#',
		    labels: {
		        previous: '<i class="icon-arrow-left13 mr-2" /> Previous',
		        next: 'Next <i class="icon-arrow-right14 ml-2" />',
		        finish: 'Generate now <i class="icon-arrow-right14 ml-2" />'
		    },
		    transitionEffect: 'none',
		    autoFocus: true,
		    onStepChanging: function (event, currentIndex, newIndex) {
		        var formCoGen = $(this).show();
		        if (currentIndex > newIndex) {
		            return true;
		        }
		        if (currentIndex < newIndex) {
		            formCoGen.find('.body:eq(' + newIndex + ') label.error').remove();
		            formCoGen.find('.body:eq(' + newIndex + ') .error').removeClass('error');
		        }
		        formCoGen.validate().settings.ignore = ':disabled,:hidden';
		        return formCoGen.valid();
		    },
		    onFinishing: function (event, currentIndex) {
		        form.validate().settings.ignore = ':disabled';
		        return form.valid();
		    },
		    onFinished: function (event, currentIndex) {
		        event.preventDefault();
		        var formCoGen = $(this);
		        var form_data = formCoGen.serialize();
		        $.ajax({
		            url: admin_url + a_mod +'/submit',
		            type: 'POST',
		            data: form_data,
		            dataType: 'json',
		            cache: false,
		            success:function(response) {
		                if (response['success']==true) {
		                    window.location.href=admin_url+a_mod+'/finish/'+response['class'];
		                } else{
		                    alert('ERROR')
		                };
		            }
		        });
		    }
		});

		$('.steps-validation').validate({
		    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
		    errorClass: 'validation-invalid-label',
		    highlight: function(element, errorClass) {
		        $(element).removeClass(errorClass);
		    },
		    unhighlight: function(element, errorClass) {
		        $(element).removeClass(errorClass);
		    },
		    errorPlacement: function(error, element) {
		        // Unstyled checkboxes, radios
		        if (element.parents().hasClass('form-check')) {
		            error.appendTo( element.parents('.form-check').parent() );
		        }
		        // Input with icons and Select2
		        else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
		            error.appendTo( element.parent() );
		        }
		        // Input group, styled file input
		        else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
		            error.appendTo( element.parent().parent() );
		        }
		        // Other elements
		        else {
		            error.insertAfter(element);
		        }
		    },
		    rules: {
		        email: {
		            email: true
		        }
		    }
		});
	});
}


function cfTnyMCE(element){
	var selectorTnyMCE = element;
	$('#tiny-text').click(function (e) {
		e.stopPropagation();
		tinymce.EditorManager.execCommand('mceRemoveEditor', true, 'Content');
	});
	$('#tiny-visual').click(function (e) {
		e.stopPropagation();
		tinymce.EditorManager.execCommand('mceAddEditor', true, 'Content');
	});
	tinymce.init({
		selector: selectorTnyMCE,
		editor_deselector: 'mceNoEditor',
		skin: 'lightgray',
		plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor",
			"code fullscreen youtube autoresize codemirror codesample responsivefilemanager"
		],
		toolbar1:'undo redo | bold italic underline forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table',
		toolbar2:'removeformat styleselect | fontsizeselect | hr charmap link unlink responsivefilemanager image media youtube codesample code | visualblocks preview fullscreen',
		menubar: false,
		branding: false,
		visualblocks_default_state: false,
		relative_urls: false,
		remove_script_host: false,
		image_caption: true,
		image_advtab: true,
		fontsize_formats: '8px 10px 12px 14px 18px 24px 36px',
		resize: true,
		autoresize_min_height: 420,
    	autoresize_top_margin:5,
    	autoresize_bottom_margin:4,
		content_css: content_url+'plugins/member/css/bootstrap.min.css,'+content_url+'plugins/font-awesome/css/font-awesome.min.css',
		codemirror: {
			indentOnInit: true,
			path: content_url+'/plugins/codemirror'
		},
		filemanager_title: 'File Manager',
		filemanager_access_key: ses_key,
		external_filemanager_path: content_url+'plugins/filemanager/',
		external_plugins: {
			"responsivefilemanager": content_url + "plugins/tinymce/plugins/responsivefilemanager/plugin.min.js",
			'filemanager': content_url+'plugins/filemanager/plugin.min.js'
		}
	});
}


function setLang(lang){
	var dataLang = lang;
	$.ajax({
		url: admin_url+'home/setlang',
		type: 'POST',
		dataType: 'json',
		data:{
			data: dataLang
		},
		cache:false,
		success:function(response){
			if (response['status']==true){
				window.location.reload();
			}
		}
	});
}


function responsive_filemanager_callback(){
	var pict = $('#picture').val();
	var url = content_url + '/uploads/' + pict;
	$('#imgprv').attr('src', url).show();
	parent.$.fancybox.close();
	console.log();
}


function str_seotitle(str){
	var seotitle;
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();
	// remove accents, swap ñ for n, etc
	var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
	var to = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
	for (var i = 0, l = from.length; i < l; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}
	str = str.replace(/[^a-z0-9 -]/g, " ") // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-') // collapse dashes
		.replace(/\W/g, ' '); // collapse dashes
	seotitle = $.trim(str).replace(/\W/g, ' ').replace(/\s+/g, '-');
	return seotitle;
}

/* lazyload.js (c) Lorenzo Giuliani
 * MIT License (http://www.opensource.org/licenses/mit-license.html)
 *
 * expects a list of:
 * `<img src="blank.gif" data-src="my_image.png" width="600" height="400" class="lazy">`
 */
$(function(){function e(r,s){var t=new Image,u=r.getAttribute('data-src');t.onload=function(){!r.parent?r.src=u:r.parent.replaceChild(t,r),s?s():null},t.src=u}function g(r){var s=r.getBoundingClientRect();return 0<=s.top&&0<=s.left&&s.top<=(window.innerHeight||document.documentElement.clientHeight)}for(var h=function(r,s){if(document.querySelectorAll)s=document.querySelectorAll(r);else{var t=document,u=t.styleSheets[0]||t.createStyleSheet();u.addRule(r,'f:b');for(var v=t.all,w=0,x=[],y=v.length;w<y;w++)v[w].currentStyle.f&&x.push(v[w]);u.removeRule(0),s=x}return s},j=function(r,s){window.addEventListener?this.addEventListener(r,s,!1):window.attachEvent?this.attachEvent('on'+r,s):this['on'+r]=s},m=[],n=h('img.lazy'),o=function(){for(var r=0;r<m.length;r++)g(m[r])&&e(m[r],function(){m.splice(r,r)})},p=0;p<n.length;p++)m.push(n[p]);o(),j('scroll',o)});

$('.form-check-input-styled').uniform();
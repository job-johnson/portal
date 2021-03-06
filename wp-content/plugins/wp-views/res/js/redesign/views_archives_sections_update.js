// Error handling

jQuery(document).ready(function(){
	jQuery.ajaxSetup({
		error:function(x,e){
			if(x.status==0){
				console.log('You are offline!!n Please Check Your Network.');
			}else if(x.status==404){
				console.log('Requested URL not found.');
			}else if(x.status==500){
				console.log('Internel Server Error.');
			}else if(e=='timeout'){
				console.log('Request Time out.');
			}else {
				console.log('Unknow Error.n'+x.responseText);
			}
		}
	});
});

// Collection of previous values

var view_settings = [];
view_settings['.js-wpv-title'] = jQuery('.js-title').val();
view_settings['.js-wpv-description'] = jQuery('.js-wpv-description').val();
view_settings['.js-wpv-layout-settings-extra-js'] = jQuery('.js-wpv-layout-settings-extra-js').val();

var section_update_results = {};

// title update

jQuery(document).on('keyup input cut paste', '.js-title', function(){
	jQuery('#titlediv').find('.toolset-alert').remove();
	jQuery('.js-wpv-title-update').parent().find('.toolset-alert-error').remove();
	if (view_settings['.js-wpv-title'] != jQuery('.js-title').val()) {
		jQuery('.js-wpv-title-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-title-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});

// Description update

jQuery(document).on('keyup input cut paste', '.js-wpv-description', function(){
	jQuery('.js-wpv-title-update').parent().find('.toolset-alert-error').remove();
	if (view_settings['.js-wpv-description'] != jQuery('.js-wpv-description').val()) {
		jQuery('.js-wpv-description-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-description-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});

jQuery(document).on('click', '.js-wpv-title-update', function(e){
	e.preventDefault();
	var thiz = jQuery( this ),
	thiz_container = thiz.parents( '.js-wpv-settings-title-and-desc' ),
	thiz_message_container = thiz_container.find( '.js-wpv-message-container' ),
	unsaved_message = thiz.data('unsaved'),
	nonce = thiz.data('nonce'),
	spinnerContainer = jQuery('<div class="wpv-spinner ajax-loader">').insertBefore( thiz ).show(),
	data_view_id = jQuery('.js-post_ID').val();
	thiz_container.find('.toolset-alert-error').remove();
	thiz
		.prop( 'disabled', true )
		.removeClass( 'button-primary' )
		.addClass( 'button-secondary' );

    // Escape the title and pass information about it to the AJAX call.
    // It will render different success message if there was something to escape.
    var titleOriginal = jQuery('.js-title').val(),
	titleEscaped = titleOriginal.replace( /\'/gi, '' ),
	isTitleEscaped = true;
	
    titleEscaped = WPV_Toolset.Utils._strip_tags_and_preserve_text( _.unescape( titleEscaped ) );
    isTitleEscaped = ( titleOriginal != titleEscaped );

	var data = {
		action: thiz.hasClass('js-wpv-description-update')? 'wpv_update_description':'wpv_update_title',
		id: data_view_id,
		title: titleEscaped,
		is_title_escaped: isTitleEscaped ? 1 : 0,
		wpnonce: nonce
	};

    section_update_results['title'] = false;

	jQuery.ajax({
		async: false,
		type: "POST",
		dataType: "json",
		url: ajaxurl,
		data: data,
		success: function( response ) {
			if ( response.success ) {
				thiz.removeClass( 'js-wpv-section-unsaved' );
				view_settings['.js-wpv-title'] = titleEscaped;
				if ( jQuery( '.js-wpv-section-unsaved' ).length < 1 ) {
					setConfirmUnload(false);
				}
				jQuery( '.js-title' ).val(titleEscaped);
				WPViews.wpa_edit_screen.manage_ajax_success( response.data, thiz_message_container );
                section_update_results['title'] = true;
			} else {
				WPViews.wpa_edit_screen.manage_ajax_fail( response.data, thiz_message_container );
				thiz
					.prop( 'disabled', false )
					.removeClass( 'button-secondary' )
					.addClass( 'button-primary' );
			}
		},
		error: function( ajaxContext ) {
			thiz_message_container
				.wpvToolsetMessage({
					text:unsaved_message,
					type:'error',
					inline:true,
					stay:true
				});
			thiz
				.prop( 'disabled', false )
				.removeClass( 'button-secondary' )
				.addClass( 'button-primary' );
		},
		complete: function() {
			spinnerContainer.remove();
		}
	});
});

jQuery(document).on('click', '.js-wpv-description-update', function(e){
	e.preventDefault();
	var thiz = jQuery( this ),
	thiz_container = thiz.parents( '.js-wpv-settings-title-and-desc' ),
	thiz_message_container = thiz_container.find( '.js-wpv-message-container' ),
	//update_message = thiz.data('success'),
	unsaved_message = thiz.data('unsaved'),
	nonce = thiz.data('nonce'),
	spinnerContainer = jQuery('<div class="wpv-spinner ajax-loader">').insertBefore( thiz ).show(),
	data_view_id = jQuery('.js-post_ID').val();
	thiz_container.find('.toolset-alert-error').remove();
	thiz
		.prop( 'disabled', true )
		.removeClass( 'button-primary' )
		.addClass( 'button-secondary' );

	var data = {
		action: thiz.hasClass('js-wpv-description-update')? 'wpv_update_description':'wpv_update_title',
		id: data_view_id,
		description: jQuery('.js-wpv-description').val(),
		wpnonce: nonce
	};

    section_update_results['description'] = false;

	jQuery.ajax({
		async: false,
		type: "POST",
		dataType: "json",
		url: ajaxurl,
		data: data,
		success: function( response ) {
			if ( response.success ) {
				thiz.removeClass( 'js-wpv-section-unsaved' );
				view_settings['.js-wpv-description'] = jQuery( '.js-wpv-description' ).val();
				if ( jQuery( '.js-wpv-section-unsaved' ).length < 1 ) {
					setConfirmUnload(false);
				}
				WPViews.wpa_edit_screen.manage_ajax_success( response.data, thiz_message_container );
                section_update_results['description'] = true;
			} else {
				WPViews.wpa_edit_screen.manage_ajax_fail( response.data, thiz_message_container );
				thiz
					.prop( 'disabled', false )
					.removeClass( 'button-secondary' )
					.addClass( 'button-primary' );
			}
		},
		error: function( ajaxContext ) {
			thiz_message_container
				.wpvToolsetMessage({
					text:unsaved_message,
					type:'error',
					inline:true,
					stay:true
				});
			thiz
				.prop( 'disabled', false )
				.removeClass( 'button-secondary' )
				.addClass( 'button-primary' );
		},
		complete: function() {
			spinnerContainer.remove();
		}
	});
});

// Layout Extra update

codemirror_views_layout.on('change', function(){
	jQuery('.js-wpv-layout-extra-update').parent().find('.toolset-alert-error').remove();
	if (codemirror_views_layout_val != codemirror_views_layout.getValue()
		|| codemirror_views_layout_css_val != codemirror_views_layout_css.getValue()
		|| codemirror_views_layout_js_val != codemirror_views_layout_js.getValue()
	) {
		jQuery('.js-wpv-layout-extra-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-layout-extra-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		jQuery('.js-screen-options').find('.toolset-alert').remove();
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});
codemirror_views_layout_css.on('change', function(){
	jQuery('.js-wpv-layout-extra-update').parent().find('.toolset-alert-error').remove();
	if (codemirror_views_layout_val != codemirror_views_layout.getValue()
		|| codemirror_views_layout_css_val != codemirror_views_layout_css.getValue()
		|| codemirror_views_layout_js_val != codemirror_views_layout_js.getValue()
	) {
		jQuery('.js-wpv-layout-extra-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-layout-extra-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		jQuery('.js-screen-options').find('.toolset-alert').remove();
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});
codemirror_views_layout_js.on('change', function(){
	jQuery('.js-wpv-layout-extra-update').parent().find('.toolset-alert-error').remove();
	if (codemirror_views_layout_val != codemirror_views_layout.getValue()
		|| codemirror_views_layout_css_val != codemirror_views_layout_css.getValue()
		|| codemirror_views_layout_js_val != codemirror_views_layout_js.getValue()
	) {
		jQuery('.js-wpv-layout-extra-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-layout-extra-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		jQuery('.js-screen-options').find('.toolset-alert').remove();
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});

jQuery('.js-wpv-layout-extra-update').on('click', function(e){
	e.preventDefault();
	var layout_val = codemirror_views_layout.getValue();
	var layout_css_val = codemirror_views_layout_css.getValue();
	var layout_js_val =  codemirror_views_layout_js.getValue();

	var thiz = jQuery( this ),
	thiz_container = thiz.parents( '.js-wpv-settings-layout-extra' ),
	thiz_message_container = thiz_container.find( '.js-wpv-message-container' ),
	//update_message = thiz.data('success'),
	unsaved_message = thiz.data('unsaved'),
	nonce = thiz.data('nonce'),
	spinnerContainer = jQuery('<div class="wpv-spinner ajax-loader">').insertBefore( thiz ).show(),
	data_view_id = jQuery('.js-post_ID').val();
	thiz_container.find('.toolset-alert-error').remove();
	thiz
		.prop( 'disabled', true )
		.removeClass( 'button-primary' )
		.addClass( 'button-secondary' );
	var data = {
		action: 'wpv_update_layout_extra',
		id: data_view_id,
		layout_val: layout_val,
		layout_css_val: layout_css_val,
		layout_js_val: layout_js_val,
		wpnonce: nonce
	};

	// Include the wizard settings
	if ( WPViews.layout_wizard.settings_from_wizard ) {
		data.include_wizard_data = 'true';
		for (var attr_name in WPViews.layout_wizard.settings_from_wizard) {
			data[attr_name] = WPViews.layout_wizard.settings_from_wizard[attr_name];
		}
        if ( ! WPViews.layout_wizard.use_loop_template ) {
            if ( WPViews.layout_wizard.use_loop_template_id != '' ) {
				data['delete_view_loop_template'] =  WPViews.layout_wizard.use_loop_template_id;
				WPViews.view_edit_screen_inline_content_templates.remove_inline_content_template( WPViews.layout_wizard.use_loop_template_id, jQuery( '.js-wpv-ct-listing-' + WPViews.layout_wizard.use_loop_template_id ) );
			}
			WPViews.layout_wizard.use_loop_template_id = '';
			WPViews.layout_wizard.use_loop_template_title = '';
        }
	}

    section_update_results['layout-extra'] = false;

	jQuery.ajax({
		async: false,
		type: "POST",
		dataType: "json",
		url: ajaxurl,
		data: data,
		success: function( response ) {
			if ( response.success ) {
				thiz.removeClass('js-wpv-section-unsaved');
				jQuery('.js-screen-options').find('.toolset-alert').remove();
				if ( jQuery('.js-wpv-section-unsaved').length < 1 ) {
					setConfirmUnload(false);
				}
				codemirror_views_layout_val = layout_val;
				codemirror_views_layout_css_val = layout_css_val;
				codemirror_views_layout_js_val = layout_js_val;
				WPViews.wpa_edit_screen.manage_ajax_success( response.data, thiz_message_container );
                section_update_results['layout-extra'] = true;
			} else {
				WPViews.wpa_edit_screen.manage_ajax_fail( response.data, thiz_message_container );
			}
		},
		error: function (ajaxContext) {
			thiz_message_container
				.wpvToolsetMessage({
					text:unsaved_message,
					type:'error',
					inline:true,
					stay:true
				});
			console.log( "Error: ", ajaxContext.responseText );
		},
		complete: function() {
			spinnerContainer.remove();
		}
	});
	
});

// Layout aditional JS update

jQuery(document).on('keyup input cut paste', '.js-wpv-layout-settings-extra-js', function(){
	jQuery('.js-wpv-layout-settings-extra-js-update').parent().find('.toolset-alert-error').remove();
	if (view_settings['.js-wpv-layout-settings-extra-js'] != jQuery(this).val()) {
		jQuery('.js-wpv-layout-settings-extra-js-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-layout-settings-extra-js-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		jQuery('.js-screen-options').find('.toolset-alert').remove();
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});

jQuery(document).on('click', '.js-wpv-layout-settings-extra-js-update', function(e){
	e.preventDefault();
	view_settings['.js-wpv-layout-settings-extra-js'] = jQuery('.js-wpv-layout-settings-extra-js').val();
	var thiz = jQuery( this ),
	thiz_container = thiz.parents( '.js-wpv-settings-layout-settings-extra-js' ),
	thiz_message_container = thiz_container.find( '.js-wpv-message-container' ),
	//update_message = thiz.data('success'),
	unsaved_message = thiz.data('unsaved'),
	nonce = thiz.data('nonce'),
	spinnerContainer = jQuery('<div class="wpv-spinner ajax-loader">').insertBefore( thiz ).show(),
	data_view_id = jQuery('.js-post_ID').val();
	thiz_container.find('.toolset-alert-error').remove();
	thiz
		.prop( 'disabled', true )
		.removeClass( 'button-primary' )
		.addClass( 'button-secondary' );
	var data = {
		action: 'wpv_update_layout_extra_js',
		id: data_view_id,
		value: view_settings['.js-wpv-layout-settings-extra-js'],
		wpnonce: nonce
	};

    section_update_results['layout-settings-extra'] = false;

	jQuery.ajax({
		async: false,
		type: "POST",
		dataType: "json",
		url: ajaxurl,
		data: data,
		success: function( response ) {
			if ( response.success ) {
				thiz.removeClass('js-wpv-section-unsaved');
				jQuery('.js-screen-options').find('.toolset-alert').remove();
				if ( jQuery('.js-wpv-section-unsaved').length < 1 ) {
					setConfirmUnload(false);
				}
				WPViews.wpa_edit_screen.manage_ajax_success( response.data, thiz_message_container );
                section_update_results['layout-settings-extra'] = true;
			} else {
				WPViews.wpa_edit_screen.manage_ajax_fail( response.data, thiz_message_container );
			}
		},
		error: function ( ajaxContext ) {
			thiz_message_container
				.wpvToolsetMessage({
					text:unsaved_message,
					type:'error',
					inline:true,
					stay:true
				});
			console.log( "Error: ", ajaxContext.responseText );
		},
		complete: function() {
			spinnerContainer.remove();
		}
	});
});

// Content update

codemirror_views_content.on('change', function(){
	jQuery('.js-wpv-content-update').parent().find('.toolset-alert-error').remove();
	if (codemirror_views_content_val != codemirror_views_content.getValue()) {
		jQuery('.js-wpv-content-update').prop('disabled', false).removeClass('button-secondary').addClass('button-primary').addClass('js-wpv-section-unsaved');
		setConfirmUnload(true);
	} else {
		jQuery('.js-wpv-content-update').prop('disabled', true).removeClass('button-primary').addClass('button-secondary').removeClass('js-wpv-section-unsaved');
		jQuery('.js-screen-options').find('.toolset-alert').remove();
		if (jQuery('.js-wpv-section-unsaved').length < 1) {
			setConfirmUnload(false);
		}
	}
});

jQuery(document).on('click', '.js-wpv-content-update', function(e){
	e.preventDefault();
	codemirror_views_content_val = codemirror_views_content.getValue();
	var thiz = jQuery( this ),
	thiz_container = thiz.parents( '.js-wpv-settings-content' ),
	thiz_message_container = thiz_container.find( '.js-wpv-message-container' ),
	//update_message = thiz.data('success'),
	unsaved_message = thiz.data('unsaved'),
	nonce = thiz.data('nonce'),
	spinnerContainer = jQuery('<div class="wpv-spinner ajax-loader">').insertBefore( thiz ).show(),
	data_view_id = jQuery('.js-post_ID').val();
	thiz_container.find('.toolset-alert-error').remove();
	thiz
		.prop( 'disabled', true )
		.removeClass( 'button-primary' )
		.addClass( 'button-secondary' );
	var data = {
		action: 'wpv_update_content',
		id: data_view_id,
		content: codemirror_views_content_val,
		wpnonce: nonce
	};

    section_update_results['content'] = false;

	jQuery.ajax({
		async: false,
		type: "POST",
		dataType: "json",
		url: ajaxurl,
		data: data,
		success: function( response ) {
			if ( response.success ) {
				thiz.removeClass('js-wpv-section-unsaved');
				jQuery('.js-screen-options').find('.toolset-alert').remove();
				if ( jQuery('.js-wpv-section-unsaved').length < 1 ) {
					setConfirmUnload(false);
				}
				WPViews.wpa_edit_screen.manage_ajax_success( response.data, thiz_message_container );
                section_update_results['content'] = true;
			} else {
				WPViews.wpa_edit_screen.manage_ajax_fail( response.data, thiz_message_container );
			}
		},
		error: function( ajaxContext ) {
			thiz_message_container
				.wpvToolsetMessage({
					text:unsaved_message,
					type:'error',
					inline:true,
					stay:true
				});
			console.log( "Error: ", ajaxContext.responseText );
		},
		complete: function() {
			spinnerContainer.remove();
		}
	});
});

// Save all

jQuery('.js-wpv-view-save-all').click(function(e){
	jQuery(this).prop('disabled', true).removeClass('button-primary').addClass('button-secondary');
	e.preventDefault();
	var spinnerContainerAll = jQuery('<div class="wpv-spinner ajax-loader">').insertBefore(jQuery(this)).show();

    section_update_results = {};

    // Click on all update buttons on unsaved sections
    jQuery('.js-wpv-section-unsaved').each(function(){
		jQuery(this).click();
	});
	spinnerContainerAll.remove();

    // Determine the overall result.
    var was_everything_successful = _.every(section_update_results);
    var action_bar_class = (was_everything_successful ? 'wpv-action-success' : 'wpv-action-failure');

    // Display success/failure message.
    if(was_everything_successful) {
        //noinspection JSUnresolvedVariable
        WPViews.wpa_edit_screen.manage_action_bar_success({message: wpv_views_archive_update_l10n.sections_saved});
    } else {
        //noinspection JSUnresolvedVariable
        WPViews.wpa_edit_screen.manage_action_bar_error({message: wpv_views_archive_update_l10n.some_section_unsaved, stay: false});
    }

    // Highlight the action bar
	jQuery( '.js-wpv-general-actions-bar' ).addClass(action_bar_class);
	setTimeout( function () {
		jQuery( '.js-wpv-general-actions-bar' ).removeClass(action_bar_class)
	}, 1000 );

    // Todo: Is this still being used?
	jQuery(document).trigger( 'js_event_wpv_view_save_all_finished' );
});

// Confirmation dialog - prevent users to navigate way if there is unsaved data

function setConfirmUnload(on) {
	if (on && jQuery('.js-wpv-section-unsaved').length > 0) {
		window.onbeforeunload = function(e) {
			jQuery('.js-wpv-section-unsaved').each(function(){
				var unsaved_message = jQuery(this).data('unsaved');
				if (jQuery(this).parents('.js-wpv-update-button-wrap').find('.toolset-alert-error').length < 1) {
					// @todo review this message, it needs to be attached to a dedicated empty container
					jQuery(this)
						.parents('.js-wpv-update-button-wrap')
							.find('.js-wpv-message-container')
								.wpvToolsetMessage({
									text:unsaved_message,
									type:'error',
									inline:true,
									stay:true
								});
				}
			});
			var message = 'You have entered new data on this page.';
			// For IE and Firefox prior to version 4
			if (e) {
				e.returnValue = message;
			}
			// For Safari
			//	var e = event || window.event;
			return message;
		}
		jQuery('.js-wpv-view-save-all').prop('disabled', false).removeClass('button-secondary').addClass('button-primary');
		jQuery(document).trigger( 'js_event_wpv_set_confirmation_unload_done', [ true ] );
	} else {
		window.onbeforeunload = null;
		jQuery('.js-wpv-view-save-all, .js-wpv-section-unsaved').prop('disabled', true).removeClass('button-primary').addClass('button-secondary');
		jQuery(document).trigger( 'js_event_wpv_set_confirmation_unload_done', [ false ] );
	}
}

// Console log safe

if( !console )
{
	var console = {
		log:function(){}
	};
}

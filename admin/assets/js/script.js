/*
██     ██ ██████       ██████  ██████  ██       ██████  ██████      ██████  ██  ██████ ██   ██ ███████ ██████
██     ██ ██   ██     ██      ██    ██ ██      ██    ██ ██   ██     ██   ██ ██ ██      ██  ██  ██      ██   ██
██  █  ██ ██████      ██      ██    ██ ██      ██    ██ ██████      ██████  ██ ██      █████   █████   ██████
██ ███ ██ ██          ██      ██    ██ ██      ██    ██ ██   ██     ██      ██ ██      ██  ██  ██      ██   ██
 ███ ███  ██           ██████  ██████  ███████  ██████  ██   ██     ██      ██  ██████ ██   ██ ███████ ██   ██
*/
jQuery( document ).ready( function() {
	jQuery( '.wp-color-picker' ).wpColorPicker( {
		// you can declare a default color here,
		// or in the data-default-color attribute on the input
		// defaultColor: '#fff',
		// a callback to fire whenever the color changes to a valid color
		// change: function( event, ui ) {},
		// a callback to fire when the input is emptied or an invalid color
		// clear: function() {
		// 	jQuery( this ).closest( '.wp-picker-container' )
		// 		.find( '.color-alpha' ).css( 'background', '#fff' )
		// 		.find( '.wp-color-picker' ).val( '#fff' );
		// },
		// hide the color picker controls on load
		// hide: true,
		// show a group of common colors beneath the square
		// or, supply an array of colors to customize further
		// palettes: true
	} );
} );


/*
███    ███ ███████ ██████  ██  █████
████  ████ ██      ██   ██ ██ ██   ██
██ ████ ██ █████   ██   ██ ██ ███████
██  ██  ██ ██      ██   ██ ██ ██   ██
██      ██ ███████ ██████  ██ ██   ██
*/
jQuery( document ).ready( function() {
	jQuery( document ).on( 'click', '.ds-image-add', function() {
		open_media( 'ds-image-load', jQuery( this ).closest( '.ds-image-load' ) );
	} );

	jQuery( document ).on( 'click', '.ds-image-remove', function() {
		var parent = jQuery( this ).closest( '.ds-image-load' );
		parent.removeClass( 'loaded' );
		parent.find( 'input' ).val( '' );
		parent.find( 'img' ).prop( 'src', '' );
	} );

	/**
	 * Background images.
	 */
	jQuery( document ).on( 'click', '#background-image-add', function() {
		open_media( 'background' );
	} );

	jQuery( document ).on('click', '.ds-radio-image.custom > .remove', function( e ) {
		e.preventDefault();

		jQuery( this ).parent().fadeOut( function() {
			jQuery( this ).remove();

			if ( !jQuery( '#background-image-picker input[type="radio"]:checked' ).length ) {
				jQuery( '#background-image-picker input[type="radio"]' ).last().trigger( 'click' );
			}
		} );
	} );

	jQuery( document ).on( 'click', '#background-image-picker input[type="radio"]', function() {
		jQuery( '#background-image-picker input[type="radio"]' ).prop( 'checked', false );
		jQuery( this ).prop( 'checked', true );
		jQuery( '#background-image-name' ).val( jQuery( this ).parent().children( '[name*="[name]"]' ).val() );
	} );

	/**
	 * WP Media uploader.
	 */
	var media_uploader = null;

	/**
	 * DS Media handler function.
	 *
	 * @param string type Media type.
	 * @param object parent DOM element.
	 */
	function open_media( type, parent ) {
		parent = parent || '';

		media_uploader = wp.media( {
			frame: "post",
			state: "insert",
			multiple: false
		} );

		media_uploader.on( "insert", function() {
			var json = media_uploader.state().get( "selection" ).first().toJSON();

			if ( type === 'background' ) {
				var custom_images = jQuery( '.ds-radio-image.custom' );
				var custom_add = 0;

				if ( custom_images.length ) {
					custom_add = parseInt( custom_images.last().attr( 'id' ).split( '-' )[1] ) + 1;
				}

				var html = '<label id="custom-' + custom_add + '" class="ds-radio ds-radio-image ds-col ds-col-4 custom ds-mb-2">';
					html += '<div class="remove">X</div>'
					html += '<input name="dssm_settings[design][background][images][custom][' + custom_add + '][name]" type="hidden" value="' + json.title.replace( /\s+/g, '-' ).toLowerCase() + '" />'
					html += '<input name="dssm_settings[design][background][images][custom][' + custom_add + '][url]" type="hidden" value="' + json.url + '" />'
					html += '<input type="radio" value="' + json.url + '" />'
					html += '<img width="100%" height="auto" src="' + json.url + '" />';
				html += '</label>';

				jQuery( '#background-image-add' ).parent().before( html );
			} else if ( type === 'ds-image-load' ) {
				if ( !parent.hasClass( 'loaded' ) )
					parent.addClass( 'loaded' );

				parent.find( 'input' ).val( json.url );
				parent.find( 'img' ).prop( 'src', json.url );
			}
		} );

		media_uploader.open();
	}
} );


/*
 █████       ██  █████  ██   ██     ███████  ██████  ██████  ███    ███
██   ██      ██ ██   ██  ██ ██      ██      ██    ██ ██   ██ ████  ████
███████      ██ ███████   ███       █████   ██    ██ ██████  ██ ████ ██
██   ██ ██   ██ ██   ██  ██ ██      ██      ██    ██ ██   ██ ██  ██  ██
██   ██  █████  ██   ██ ██   ██     ██       ██████  ██   ██ ██      ██
*/
jQuery( document ).ready( function() {
	var original_prev_button_html = jQuery( '.dssm-preview-button' ).html(); // Capture the original text value as is defined in the template.

	// On input change perform HTML updates.
	jQuery( document ).on( 'change', '#dssm-form-main input, #dssm-form-main select, #dssm-form-main textarea', function() {
		jQuery( '.dssm-preview-button' ).html( 'Save & Preview' ).addClass( 'dssm-changes-pending' );
	} );

	// On preview, save first when changes are pending.
	jQuery( document ).on( 'click', '.dssm-preview-button.dssm-changes-pending', function( e ) {
		e.preventDefault();
		jQuery( '#dssm-form-main' ).submit();
		jQuery( this ).html( 'Live Preview' ).removeClass( 'dssm-changes-pending' ).addClass( 'dssm-preview-pending' );
	} );

	// Convert form submission to Ajax submission.
	jQuery( '#dssm-form-main' ).submit( function( e ) {
		e.preventDefault();

		jQuery( this ).ajaxSubmit( {
			beforeSend: function() {
				jQuery( '#dssm-form-loading-panel' ).addClass( 'active' );
			},
			success: function() {
				jQuery( '#dssm-form-saved-notice' ).addClass( 'active' );

				if ( jQuery( '.dssm-preview-button.dssm-preview-pending' ).hasClass( 'dssm-preview-pending' ) ) {
					var win = window.open( jQuery( '.dssm-preview-button' ).attr( 'href' ), '_dssm-preview' );

					if ( win )
						win.focus();
				}

				jQuery( '.dssm-preview-button' ).removeClass( 'dssm-changes-pending dssm-preview-pending' ).html( original_prev_button_html );
			},
			complete: function() {
				jQuery( '#dssm-form-loading-panel' ).removeClass( 'active' );

				setTimeout(
					function() {
						jQuery( '#dssm-form-saved-notice' ).removeClass( 'active' );
					},
					5000
				);
			},
			timeout: 5000
		} );

		return false;
	} );
} );

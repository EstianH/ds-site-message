/*
███    ███ ███████ ██████  ██  █████
████  ████ ██      ██   ██ ██ ██   ██
██ ████ ██ █████   ██   ██ ██ ███████
██  ██  ██ ██      ██   ██ ██ ██   ██
██      ██ ███████ ██████  ██ ██   ██
*/
jQuery( document ).ready( function() {
	jQuery( document ).on( 'click', '#image-add', function() {
		open_media( 'background' );
	} );

	jQuery( document ).on('click', '.image-radio.custom > .remove', function( e ){
		e.preventDefault();

		jQuery( this ).parent().fadeOut( function() {
			jQuery( this ).remove();

			if( !jQuery( '#image-picker input[type="radio"]:checked' ).length ) {
				jQuery( '#image-picker input[type="radio"]' ).last().trigger( 'click' );
			}
		});
	});

	jQuery( document ).on( 'click', '#image-picker input[type="radio"]', function() {
		jQuery( '#image-picker input[type="radio"]' ).prop( 'checked', false );
		jQuery( this ).prop( 'checked', true );
		jQuery( '#image-name' ).val( jQuery( this ).parent().children( '[name*="[name]"]' ).val() );
		jQuery( '#image-url' ).val( jQuery( this ).parent().children( '[name*="[url]"]' ).val() );
	});

	jQuery( document ).on( 'click', '.ds-image-add', function() {
		open_media( 'ds-image-load', jQuery( this ).closest( '.ds-image-load' ) );
	});

	jQuery( document ).on( 'click', '.ds-image-remove', function() {
		var parent = jQuery( this ).closest( '.ds-image-load' );
		parent.removeClass( 'loaded' );
		parent.find( 'input' ).val( '' );
		parent.find( 'img' ).prop( 'src', '' );
	});

	var media_uploader = null;

	function open_media( type, parent ){
		parent = parent || '';

		media_uploader = wp.media( {
			frame: "post",
			state: "insert",
			multiple: false
		} );

		media_uploader.on( "insert", function() {
			var json = media_uploader.state().get( "selection" ).first().toJSON();

			if( type == 'background' ) {
				var custom_images = jQuery( '.image-radio.custom' );
				var custom_add = 0;

				if( custom_images.length ) {
					custom_add = parseInt( custom_images.last().attr( 'id' ).split( '-' )[1] ) + 1;
				}

				var html = '<label id="custom-' + custom_add + '" class="image-radio ds-col ds-col-4 custom">';
					html += '<div class="remove">X</div>'
					html += '<input name="dssm-design[background][images][custom][' + custom_add + '][name]" type="hidden" value="' + json.title.replace( /\s+/g, '-' ).toLowerCase() + '" />'
					html += '<input name="dssm-design[background][images][custom][' + custom_add + '][url]" type="hidden" value="' + json.url + '" />'
					html += '<input type="radio" value="' + json.url + '" />'
					html += '<img width="100%" height="auto" src="' + json.url + '" />';
				html += '</label>';

				jQuery( '#image-add' ).before( html );
			} else if( type == 'ds-image-load' ) {
				if( !parent.hasClass( 'loaded' ) ) {
					parent.addClass( 'loaded' );
				}

				parent.find( 'input' ).val( json.url );
				parent.find( 'img' ).prop( 'src', json.url );
			}
		});

		media_uploader.open();
	}
});

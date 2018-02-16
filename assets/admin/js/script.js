jQuery(document).ready(function(){
    /* ============= LOGO ============= */
    jQuery(document).on('click', '#logo-add', function(){
        open_media('logo');
    });
    
    jQuery(document).on('click', '#logo-remove', function(){
        jQuery('#logo').removeClass('loaded');
        jQuery('#logo input').val('');
        jQuery('#logo img').prop('src', '');
    });
    /* ============= LOGO END ============= */
    /* ============= IMAGES ============= */
    jQuery(document).on('click', '#image-add', function(){
        open_media('background');
    });
    
    jQuery(document).on('click', '.image-radio.custom > .remove', function(e){
        e.preventDefault();
        
        jQuery(this).parent().fadeOut(function(){ 
            jQuery(this).remove();
            
            if(!jQuery('#image-picker input[type="radio"]:checked').length){
                jQuery('#image-picker input[type="radio"]').last().trigger('click');
            }
        });
    });
    
    jQuery(document).on('click', '#image-picker input[type="radio"]', function(){
        jQuery('#image-picker input[type="radio"]').prop('checked', false);
        jQuery(this).prop('checked', true);
        jQuery('#image-name').val(jQuery(this).parent().children('[name*="[name]"]').val());
        jQuery('#image-url').val(jQuery(this).parent().children('[name*="[url]"]').val());
    });
    /* ============= IMAGES END ============= */
    /* ============= MEDIA UPLOADER ============= */
    var media_uploader = null;

    function open_media(type){
        media_uploader = wp.media({
            frame: "post", 
            state: "insert", 
            multiple: false
        });
        
        media_uploader.on("insert", function(){
            var json = media_uploader.state().get("selection").first().toJSON();

            if(type == 'background'){
                var custom_images = jQuery('.image-radio.custom');
                var custom_add = 0;

                if(custom_images.length){
                    custom_add = parseInt(custom_images.last().attr('id').split('-')[1]) + 1;
                }

                var html = '<label id="custom-' + custom_add + '" class="image-radio ds-col ds-col-4 custom">';
                    html += '<div class="remove">X</div>'
                    html += '<input name="dssm-settings[background][images][custom][' + custom_add + '][name]" type="hidden" value="' + json.title.replace(/\s+/g, '-').toLowerCase() + '" />'
                    html += '<input name="dssm-settings[background][images][custom][' + custom_add + '][url]" type="hidden" value="' + json.url + '" />'
                    html += '<input type="radio" value="' + json.url + '" />'
                    html += '<img width="100%" height="auto" src="' + json.url + '" />';
                html += '</label>';

                jQuery('#image-add').before(html);
            } else if(type == 'logo'){
                if(!jQuery('#logo').hasClass('loaded')){
                    jQuery('#logo').addClass('loaded');
                }
                
                jQuery('#logo input').val(json.url);
                jQuery('#logo img').prop('src', json.url);
            }
        });

        media_uploader.open();
    }
    /* ============= MEDIA UPLOADER END ============= */
    /* ============= HEADERS STEALTH ============= */
    headers_stealth_mode(jQuery('#headers').prop('checked'));
    
    jQuery(document).on('change', '#headers', function(){
        headers_stealth_mode(jQuery(this).prop('checked'));
    });
    
    function headers_stealth_mode(enabled){
        if(enabled){
            jQuery('#retryafter').show();
        } else{
            jQuery('#retryafter input').val('');
            jQuery('#retryafter').hide();
        }
    }
    /* ============= HEADERS STEALTH END ============= */
    /* ============= PANEL STEALTH ============= */
    panel_stealth_mode(jQuery('#panel').prop('checked'));

    jQuery(document).on('change', '#panel', function(){
        panel_stealth_mode(jQuery(this).prop('checked'));
    });

    function panel_stealth_mode(enabled){
        if(enabled){
            jQuery('#panelcolor').show();
        } else{
            jQuery('#panelcolor input').val('');
            jQuery('#panelcolor').hide();
        }
    }
    /* ============= PANEL STEALTH END ============= */
    /* ============= IMAGES STEALTH ============= */
    image_stealth_mode(jQuery('#use-background-image').prop('checked'));
    
    jQuery(document).on('change', '#use-background-image', function(){
        image_stealth_mode(jQuery(this).prop('checked'));
    });
    
    function image_stealth_mode(enabled){
        if(enabled){
            jQuery('[name*="[image][name]"]').prop('disabled', false);
            jQuery('[name*="[image][url]"]').prop('disabled', false);
            jQuery('#image-picker').show();
        } else{
            jQuery('[name*="[image][name]"]').prop('disabled', true);
            jQuery('[name*="[image][url]"]').prop('disabled', true);
            jQuery('#image-picker').hide();
        }
    }
    /* ============= IMAGES STEALTH END ============= */
});
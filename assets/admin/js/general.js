jQuery(document).ready(function(){
    /* ============= SECTIONS ============= */
    jQuery(document).on('change', '[class="ds-section"]', function(){
        expand_sections(jQuery(this));
    });
    
    function expand_sections(section){
        if(section.prop('checked') && !section.parent().hasClass('expanded')){
            section.parent().addClass('expanded');
        } else{
            section.parent().removeClass('expanded');
        }
    }
    /* ============= SECTIONS END ============= */
    /* ============= EQUAL HEIGHT ============= */
    // Immediately build padded boxes.
    buildPaddedBoxes();

    // Rebuid padded boxes at given intervals to mitigate height issues.
    setTimeout(function(){
        buildPaddedBoxes();
    }, 1000);

    setTimeout(function(){
        buildPaddedBoxes();
    }, 5000);

    function buildPaddedBoxes(){
        jQuery('.ds-row-equal-height').each(function(){
            var height = 0;
            var elements = jQuery(this).find('> .ds-col');

            if(elements.length > 1){
                elements.each(function(){
                    jQuery(this).prop('style', null);

                    if(jQuery(this).outerHeight() > height){
                        height = jQuery(this).outerHeight();
                    }
                });

                elements.each(function(){
                    if(height > 0){
                        jQuery(this).css('height', height);
                    }
                });
            }
        });
    }
    /* ============= EQUAL HEIGHT END ============= */
});
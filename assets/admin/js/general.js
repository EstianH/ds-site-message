jQuery(document).ready(function(){
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
    /* ============= TABS ============= */
    $(document).on('click', '#ds-wrapper .nav-tab:not(.nav-tab-link)', function(e){
        e.preventDefault();
        
        $('#ds-wrapper .nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('#ds-wrapper .tab-content').removeClass('active');
        $($(this).attr('href')).addClass('active');
    });
    /* ============= TABS END ============= */
});
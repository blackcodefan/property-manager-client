jQuery(function () {
    jQuery('.pmc-accordion-handle').click(function (e) {
        jQuery('.pmc-accordion-handle').each(function () {
            if(this === e.target){
                jQuery(this).toggleClass('active');
            }else {
                jQuery(this).removeClass('active');
            }
        });
        jQuery('.pmc-accordion-panel').removeClass('expanded');
        if (jQuery(this).hasClass('active')){
            jQuery(this).next('.pmc-accordion-panel').addClass('expanded');
        }else{
            jQuery(this).next('.pmc-accordion-panel').removeClass('expanded');
        }

    });
    jQuery(".building-select").select2().on('change', function (e) {
        window.location.href = e.currentTarget.value;
    });
});
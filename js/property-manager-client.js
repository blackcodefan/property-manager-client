jQuery(function () {
    jQuery('.wp-hide-pw').click(function () {
        let span = jQuery(this).children('span')[0];
        jQuery(span).toggleClass('dashicons-hidden');
        jQuery(span).toggleClass('dashicons-visibility');
        jQuery('input[name="pmc_p"]').attr('type', (function (index, attr) {
            return attr === 'password' ? 'text' : 'password';
        }))
    });
});
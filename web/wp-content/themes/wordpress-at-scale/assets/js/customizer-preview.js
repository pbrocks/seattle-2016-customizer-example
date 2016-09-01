// if wp.customize exists
if ('undefined' !== typeof wp && wp.customize) {

    // wait for window load - no iframe ready event (yet)
    jQuery(window).load(function () {

        wp.customize('_s_home_banner', function (value) {
            value.bind(function (newval) {
                // Use jQUery and newval to update the text of #banner-title a
            });
        });

        // Add banner text size and color here

    });

}
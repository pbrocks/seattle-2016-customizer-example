// if wp.customize exists
if ('undefined' !== typeof wp && wp.customize) {

	// wait for window load - no iframe ready event (yet)
	jQuery(window).load(function () {

		wp.customize('_s_home_banner', function (value) {
			value.bind(function (newval) {
				jQuery('#banner-title a').text(newval);
			});
		});

		wp.customize('_s_home_banner_size', function (value) {
			value.bind(function (newval) {
				jQuery('#banner-title a').css('font-size', newval + 'px');
			});
		});

		wp.customize('_s_home_banner_color', function (value) {
			value.bind(function (newval) {
				jQuery('#banner-title a, #banner-title a:hover').css('color', newval);
			});
		});


	});

}
jQuery(document).ready(function ($) {
	if (window.console) {
		console.log('WordPress at scale theme initializing.');
	}

	/**
	 * Parallax and text fade on front-page banner
	 */
	if ($('#banner-home').length) {
		if ($(window).width() > 480) {
			$(window).scroll(function () {
				var scrollPos = $(this).scrollTop();
				var bannerHeight = $('#banner-home').height();
				var opacity = 1 - scrollPos / bannerHeight;
				$('#banner-home .wrap-inner').css({
					'opacity': opacity < 0 ? 0 : opacity
				});
				$('#banner-home').css({
					'background-position': 'center 0'
				});
			});
		}
	}

	/**
	 * Sticky nav on front page
	 */
	if ($('body').hasClass('front-page')) {
		var headerHeight = $('body').hasClass('front-page') ? 125 : 93;
		$(window).scroll(function () {
			if ($(this).scrollTop() >= headerHeight) {
				$('#header').addClass('active');
			} else {
				$('#header').removeClass('active');
				// Hide mobile menu when we hit the top of the front page
				$('#primary-nav').removeClass('active');
			}
		});
	}

	/**
	 * Toggle mobile menu on click
	 */
	$('#header .menu-icon.mobile a').click(function (e) {
		e.preventDefault();

		$('#header-nav').toggleClass('active');
	});

	/**
	 * Smooth internal link scrolling
	 */
	$('a[href^="#"]').on('click', function (e) {
		e.preventDefault();

		var targetHash = this.hash;
		var $target = $(targetHash);

		var offSet = 0;

		// Account for front page desktop sticky nav height
		if ($('body').hasClass('front-page') && $(window).width() > 480) {
			offSet = 83;
		}

		$('html, body').stop().animate({
			'scrollTop': $target.offset().top - offSet
		}, 900, 'swing', function () {
			window.location.hash = targetHash;
		});
	});

	/**
	 * Toggle mobile nav submenu
	 */
	$('#header-nav .icon-angle-down').on('click', function (e) {
		e.preventDefault();

		$(this).parent('li').toggleClass('active');
	});

	/**
	 * Add a clear after the last bulletbox
	 */
	if ($('.bulletbox').length) {
		$('.bulletbox').last().after('<div class="clear"></div>');
	}

	/**
	 * Add a class to paragraphs on the contributors
	 * page that contain an image for special styling
	 */
	if ($('body').hasClass('page-contributors')) {
		$('.entry-content img').parent('p').addClass('has-img');
	}
});
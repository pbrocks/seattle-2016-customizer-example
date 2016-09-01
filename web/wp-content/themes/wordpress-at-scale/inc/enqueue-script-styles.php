<?php
/**
 * Enqueue scripts and styles.
 */
function _s_scripts_styles() {
	$js_deps = array( 'jquery' );

	$css_deps = array();

	/**
	 * Flexbox polyfill for older browsers
	 *
	 * @link https://github.com/10up/flexibility
	 */
	wp_enqueue_script( 'flexibility', get_stylesheet_directory_uri() . '/assets/vendor/flexibility.js', $js_deps, '1.0.6', true );
	$js_deps[] = 'flexibility';

	/**
	 * Raleway font from Google CDN
	 */
	wp_enqueue_style( 'google-fonts-railway', '//fonts.googleapis.com/css?family=Raleway:400,700' );
	$css_deps[] = 'google-fonts-railway';

	/**
	 * Underscores theme CSS
	 */
	wp_enqueue_style( 'underscores', get_stylesheet_directory_uri() . '/assets/css/underscores.css', $css_deps );
	$css_deps[] = 'underscores';

	/**
	 * Enqueue theme JS/CSS last, with dependencies
	 */
	wp_enqueue_script( 'wordpress-at-scale', get_stylesheet_directory_uri() . '/assets/js/wordpress-at-scale.js', $js_deps, false, true );
	wp_enqueue_style( 'wordpress-at-scale', get_stylesheet_directory_uri() . '/assets/css/wordpress-at-scale.css', $css_deps );

	/**
	 * Remove oEmbed JS
	 */
	wp_dequeue_script( 'wp-embed' );

	/*
	 * Uncomment the code below when you are ready to use postMessage
	 * then open assets/js/customize-preview.js and follow the directions there.
	 *
	 * if_customize_preview is used so we don't enqueue this script outside of the customizer where it isn't needed.
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#using-postmessage-for-improved-setting-previewing
	 */
	// if( is_customize_preview() ){
		// wp_enqueue_script( 'customizer-preview-script', get_stylesheet_directory_uri() . '/assets/js/customizer-preview.js', array('jquery', 'customize-preview'), false, true );
	// }

}

add_action( 'wp_enqueue_scripts', '_s_scripts_styles' );

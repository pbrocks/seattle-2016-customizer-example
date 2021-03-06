<?php
/**
 * Theme options Customizer functionality.
 *
 * @package _s
 */

/**
 * Register the theme options admin menu link
 */
function _s_theme_setting_customizer_menu() {
	add_menu_page(
		__( 'Theme Options', '_s' ),
		__( 'Theme Options', '_s' ),
		'edit_theme_options',

		/*
		 * Autofocus the theme options panel.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#focusing
		 */
		'customize.php?autofocus[panel]=_s_theme_options&return=' . urlencode( get_admin_url() )
	);
}

add_action( 'admin_menu', '_s_theme_setting_customizer_menu' );

/**
 * Sanitize banner title size
 *
 * @param string $input user input.
 *
 * @return string|void
 */
function _s_sanitize_home_banner_size( $input ) {
	$input = intval( $input );

	$valid_sizes = array();

	for ( $i = 48; $i <= 80; $i = $i + 2 ) {
		$valid_sizes[] = $i;
	}

	// If there isn't a valid size return the default (48).
	return ( in_array( $input, $valid_sizes, true ) ) ? $input : 48;
}

add_action( 'admin_menu', '_s_theme_setting_customizer_menu' );

/**
 * Adds option sections for theme options in customizer
 *
 * @param object $wp_customize an instance of the WP_Customize_Manager class.
 */
function _s_theme_setting_customizer( $wp_customize ) {
	/**
	 * Adds a panel for theme options
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#panels
	 */
	$wp_customize->add_panel( '_s_theme_options', array(
		'title'       => __( 'Theme Options', '_s' ),
		'description' => '<p>' . __( 'Options for the WordPress at Scale theme', '_s' ) . '</p>',
		// Include html tags such as <p>.
		'priority'    => 160,
		// Mixed with top-level-section hierarchy.
	) );

	/*
	 * Add theme options section to customizer.
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections
	 */
	$wp_customize->add_section(
		// Use a unique, descriptive section slug to avoid conflicts.
		'wordpress_at_scale_theme_options',
		array(
			'title'           => __( 'Banner Options', '_s' ),
			'description'     => __( 'Options for the WordPress at Scale theme', '_s' ),
			'priority'        => 1,
			// Add the section to our custom panel.
			'panel'           => '_s_theme_options',

			/*
			 * Add an active callback so the banner theme options are only visible on the front page, where the banner is
			 * this way the user won't get confused by seeing options that don't apply to the page they are viewing.
			 *
			 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#contextual-controls-sections-and-panels
			 * @link https://core.trac.wordpress.org/browser/tags/4.6/src/wp-includes/class-wp-customize-section.php#L133
			 */
			'active_callback' => 'is_front_page',
		)
	);

	/*
	 * Add individual settings to the theme options section.
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#settings
	 */
	$wp_customize->add_setting( '_s_home_banner', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'default'           => get_bloginfo( 'name' ),

		/*
		 * Sanitization callbacks are important!
		 * Don't add settings with out sanitizing them
		 */
		'sanitize_callback' => 'sanitize_text_field',

		/*
		 * You can have validation callbacks too.
		 * Make items required or validate a certain format.
		 */
		'validate_callback' => '_s_sanitize_home_banner',

		/*
		 * postMessage for instant previewing of changes with JavaScript.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#using-postmessage-for-improved-setting-previewing
		 */
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_setting( '_s_home_banner_size', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'default'           => 48,
		'sanitize_callback' => '_s_sanitize_home_banner_size',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_setting( '_s_home_banner_color', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'default'           => '#FFFFFF',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	/*
	 * Add a Customizer control for each setting.
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#controls
	 */
	$wp_customize->add_control( '_s_home_banner', array(
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'wordpress_at_scale_theme_options',
		'label'       => __( 'Banner Text', '_s' ),
		'description' => __( '', '_s' ),
		'input_attrs' => array(
			'placeholder' => get_bloginfo( 'name' ),
		),
	) );

	$wp_customize->add_control( '_s_home_banner_size', array(
		'type'        => 'range',
		'priority'    => 10,
		'section'     => 'wordpress_at_scale_theme_options',
		'label'       => __( 'Banner Font Size', '_s' ),
		'description' => __( '', '_s' ),
		// You can add HTML5 attributes too.
		'input_attrs' => array(
			'min'  => 48,
			'max'  => 80,
			'step' => 2,
		),
		'default'     => '48',
	) );

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'_s_home_banner_color',
			array(
				'priority'    => 10,
				'section'     => 'wordpress_at_scale_theme_options',
				'label'       => __( 'Banner Text Color', '_s' ),
				'description' => __( '', '_s' ),
				'default'     => '#000000',
			)
		)
	);

	/**
	 * Add a field to the Customizer for the banner background image.
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#core-custom-controls
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#selective-refresh-fast-accurate-updates
	 */

	$wp_customize->add_setting( '_s_home_banner_image', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'absint',
		// We need postMessage to avoid full page reload.
		'transport'         => 'postMessage',
		'validate_callback' => '_s_sanitize_home_banner_background',
	) );

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'_s_home_banner_image',
			array(
				'label'             => __( 'Banner Background Image. Should be 1920px x 1200px', '_s' ),
				'section'           => 'wordpress_at_scale_theme_options',
				'mime_type'         => 'image',
				'width'             => 1920,
				'height'            => 1200,
			)
		)
	);

	/**
	 * Add a selective refresh partial for the banner
	 * when the background image changes
	 */
	$wp_customize->selective_refresh->add_partial( '_s_home_banner_image', array(
		'selector'        => '#banner-home',
		'render_callback' => function () {
			_s_banner_inline_css();
			get_template_part( 'template-parts/banner-home' );
		},
	) );

}

add_action( 'customize_register', '_s_theme_setting_customizer' );

/**
 * Add theme support for widget partial refresh
 */
add_theme_support( 'customize-selective-refresh-widgets' );

/**
 * Output dynamic theme setting CSS
 */
function _s_banner_inline_css() {
	$home_banner_color = sanitize_hex_color( get_theme_mod( '_s_home_banner_color' ) );
	$home_banner_size  = _s_sanitize_home_banner_size( get_theme_mod( '_s_home_banner_size' ) );
	?>
	<style type="text/css">
		#banner-title a {
			font-size: <?php echo esc_attr( $home_banner_size ); ?>px;
			color: <?php echo esc_attr( $home_banner_color ); ?>;
		}

		#banner-title a:hover {
			color: <?php echo esc_attr( $home_banner_color ); ?>;
			text-decoration: none;
		}
	</style>
	<?php
}

add_action( 'wp_head', '_s_banner_inline_css', 50 );


/**
 * Validate the banner title text
 *
 * @param object $validity validity object.
 * @param mixed  $value    user inputted value.
 *
 * @return object $validity
 */
function _s_sanitize_home_banner( $validity, $value ) {
	if ( '' === $value || empty( $value ) ) {
		$validity->add( 'required', __( 'A site title is required.', '_s' ) );
	} elseif ( 1 === preg_match( '/[wW]ordpress/', $value ) ) {
		$validity->add( 'WordPress', __( 'Capital P dangit!', '_s' ) );
	}

	return $validity;
}

/**
 * Validate the banner background image
 *
 * @param object $validity validity object.
 * @param mixed  $value    user inputted value.
 *
 * @return object $validity
 */
function _s_sanitize_home_banner_background( $validity, $value ) {
	if ( ! empty( $value ) ) {
		$image_atts = wp_get_attachment_metadata( $value );
		if ( false !== $image_atts && $image_atts['width'] < 1920 ) {
			$validity->add( 'image-size', __( 'The banner image should be at least 1920px wide', '_s' ) );
		}
	}

	return $validity;
}

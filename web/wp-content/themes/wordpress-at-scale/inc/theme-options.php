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
		'customize.php?autofocus[section]=wordpress_at_scale_theme_options&return=' . urlencode( get_admin_url() )
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
	// Add theme options section to customizer.
	$wp_customize->add_section(
		// Use a unique, descriptive section slug to avoid conflicts.
		'wordpress_at_scale_theme_options',
		array(
			'title'       => __( 'Theme Options', '_s' ),
			'description' => __( 'Options for the WordPress at Scale theme', '_s' ),
			'priority'    => 1,
		)
	);

	// Add individual settings to the theme options section.
	$wp_customize->add_setting( '_s_home_banner_size', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'default'           => 48,
		'sanitize_callback' => '_s_sanitize_home_banner_size',
	) );

	$wp_customize->add_setting( '_s_home_banner_color', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'default'           => '#FFFFFF',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( '_s_home_banner', array(
		'capability'        => 'manage_options',
		'type'              => 'theme_mod',
		'default'           => get_bloginfo( 'name' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Add a Customizer control for each setting.
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
		'input_attrs' => array(
			'min'  => 48,
			'max'  => 80,
			'step' => 2,
		),
		'default'     => '48',
	) );

}

add_action( 'customize_register', '_s_theme_setting_customizer' );

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

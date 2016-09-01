<?php
/**
 * _s includes.
 *
 * @package _s
 */

$theme_dir = get_stylesheet_directory();

$theme_includes = array(
	'theme-setup.php',
	'template-tags.php',
	'enqueue-script-styles.php',
	'body-classes.php',
	'theme-options.php',
	'prev-next-menu-post-ids.php',
	'add-excerpt-to-page.php',
	'pageloop.php',
	'social-sharing-html.php',
	'bullet-box-shortcode.php',
	'auto-p-after-shortcodes.php',
	'custom-nav-walker.php',
	'why-scale-article-links.php',
	'remove-emoji-support.php',
	'remove-oembed-support.php',
	'set-content-width.php',
);

foreach ( $theme_includes as $theme_include ) {
	require_once( $theme_dir . '/inc/' . $theme_include );
}

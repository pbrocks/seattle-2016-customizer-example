<?php
/**
 * Body classes
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if( is_front_page() ){
		$classes[] = 'front-page';
	}

	if ( is_page() ) {
		global $post;
		$slug           = get_post( $post )->post_name;
		$body_classes[] = "page-$slug";
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

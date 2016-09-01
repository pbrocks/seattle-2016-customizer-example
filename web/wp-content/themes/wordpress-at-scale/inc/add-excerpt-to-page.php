<?php
/**
 * Add excerpt to 'page' post type
 */
function _s__add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', '_s__add_excerpt_support_for_pages' );
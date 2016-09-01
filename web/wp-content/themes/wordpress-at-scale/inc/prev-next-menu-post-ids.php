<?php
/**
 * Why scale helper function.
 *
 * @package _s
 */

/**
 * Gets the previous and next ids of the pages in the 'why-scale' menu.
 */
function wordpress_at_scale_get_prev_next_menu_post_ids() {

	global $post;

	$return = array(
		'prevID' => null,
		'nextID' => null,
	);

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['why_scale'] ) ) {
		$menu = wp_get_nav_menu_object( $locations['why_scale'] );

		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		$menu_ids = [];
		foreach ( $menu_items as $menu_item ) {
			$menu_ids[] = $menu_item->object_id;
		}

		if ( in_array( $post->ID, $menu_ids, true ) ) {
			$current          = array_search( $post->ID, $menu_ids );
			$return['prevID'] = $current > 0 ? $menu_ids[ $current - 1 ] : null;
			$return['nextID'] = $current < ( count( $menu_ids ) - 1 ) ? $menu_ids[ $current + 1 ] : null;
		}
	}

	return $return;
}
<?php
/**
 * Returns links to all article is the why_scale menu
 *
 * @return string
 */
function _s_wp_scale_article_links() {
	$output = '';

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['why_scale'] ) ) {
		$menu = wp_get_nav_menu_object( $locations['why_scale'] );

		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		$output .= '<div class="article-links">';

		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title   = $menu_item->title;
			$url     = $menu_item->url;
			$post_id = (int) $menu_item->object_id;

			// Skip items missing their title or URL.
			if ( empty( $title ) || empty( $url ) ) {
				continue;
			}

			// Get the description from the excerpt.
			$desc = strip_tags( get_the_excerpt( $post_id ) );

			$desc_length = 75;

			if ( strlen( $desc ) > $desc_length ) {
				$desc = substr( $desc, 0, $desc_length ) . '...';
			}

			$output .= '<a class="article-link" href="' . $url . '">';
			$output .= '<span class="icon-link"></span>';
			$output .= '<span class="title">' . $title . '</span>';
			if ( ! empty( $desc ) ) {
				$output .= '<span class="break"> | </span><span class="desc">' . $desc . '</span>';
			}
			$output .= '</a>';

		}

		$output .= '</div>';
	}

	return trim( $output );
}

add_shortcode( 'article_links', '_s_wp_scale_article_links' );

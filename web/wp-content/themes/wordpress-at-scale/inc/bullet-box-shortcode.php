<?php
/**
 * Formats bullet_box shortcode
 *
 * @param        $atts
 * @param string $content
 *
 * @return string|void
 */
function _s_bullet_box( $atts, $content = '' ) {
	$atts = shortcode_atts( array(
		'title' => '',
		'align' => 'full'
	), $atts, 'bullet_box' );

	$align = strtolower( $atts['align'] );
	$title = $atts['title'];

	// bail if no content
	if ( empty( $content ) ) {
		return;
	}

	// make sure alignment is valid
	if ( ! in_array( $align, array( 'full', 'left', 'right' ) ) ) {
		$align = 'full';
	}

	$output = '<div class="bulletbox bb-' . $align . '">';
	$output .= '<h3>' . $title . '</h3>';
	$output .= $content;
	$output .= '</div>';

	return $output;
}

add_shortcode( 'bullet_box', '_s_bullet_box' );
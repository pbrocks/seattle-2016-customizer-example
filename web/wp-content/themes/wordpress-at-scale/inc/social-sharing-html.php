<?php
/**
 * Social sharing helper function.
 *
 * @package _s
 */

/**
 * Returns social sharing HTML
 *
 * @return string
 */
function _s_social_links() {
	$share_url  = get_permalink();
	$share_text = __( 'WordPress at Scale: ', '_s' );
	if ( is_front_page() ) {
		$share_text .= __( 'How to run a WordPress site at scale', '_s' );
	} else {
		$share_text .= get_the_title();
	}
	ob_start();
	?>
	<div id="social-links">
		<div class="prefix">
			<?php esc_attr_e( 'Share', '_s' ); ?>
		</div>
		<div class="icon twitter">
			<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( $share_url ); ?>&text=<?php echo urlencode( $share_text ); ?>"
			   target="_blank" title="<?php esc_attr_e( 'Share on Twitter', '_s' ); ?>">
				<span class="icon-twitter"></span>
			</a>
		</div>
		<div class="icon facebook">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $share_url ); ?>"
			   target="_blank" title="<?php esc_attr_e( 'Share on Facebook', '_s' ); ?>">
				<span class="icon-facebook"></span>
			</a>
		</div>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'social_links', '_s_social_links' );

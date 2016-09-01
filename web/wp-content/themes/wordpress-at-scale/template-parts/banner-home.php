<section id="banner-home"
	<?php
	// Fallback to theme image if no custom image.
	$banner_img_default = get_the_post_thumbnail_url( get_option( 'page-on-front' ) );

	$banner_img_id = get_theme_mod( '_s_home_banner_image', $banner_img_default );
	$banner_img    = wp_get_attachment_image_src( $banner_img_id, 'full' );
	if ( ! empty( $banner_img ) ) {
		echo ' style="background-image:url(\'' . $banner_img[0] . '\');"';
	}
	?>
>
	<div class="wrap-center">

		<div class="wrap-inner">

			<div class="thumb">
				<img data-width="157" data-height="158" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-white.png" alt="<?php the_title(); ?>" />
			</div>

			<header class="entry-header">
				<?php
				$site_title = apply_filters( '_s_home_banner', get_theme_mod( '_s_home_banner' ) );
				get_template_part( 'template-parts/banner-title' );
				?>
			</header><!-- .entry-header -->

			<div class="excerpt">
				<?php
				$the_excerpt = get_the_excerpt();
				if ( empty( $the_excerpt ) ) {
					_e( 'WordPress is moving upmarket, powering high-traffic, mission-critical websites. Find out what it takes to run WordPress at scale.', '_s' );
				} else {
					echo esc_html( $the_excerpt );
				}
				?>
			</div>

			<a class="btn" href="#content">Start Here</a>
		</div>

	</div>
</section>
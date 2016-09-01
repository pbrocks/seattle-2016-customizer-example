<?php
$site_title = apply_filters( '_s_home_banner', get_theme_mod( '_s_home_banner' ) );
?>
<div id="banner-title">
	<h1 class="entry-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
		   rel="home">
			<?php echo esc_attr( $site_title ); ?>
		</a>
	</h1>
</div>
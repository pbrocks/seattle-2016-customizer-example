<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

    $share_desc = is_front_page() ? __('How to run a WordPress site at scale', '_s') : get_the_title();
    $feat_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="WordPress at Scale"/>
    <meta property="og:description" content="<?php echo $share_desc; ?>"/>
    <?php if( $feat_img !== false ): ?>
    <meta property="og:image" content="<?php echo $feat_img; ?>"/>
    <?php endif; ?>
    <?php wp_head(); ?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-20272439-11']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
</head>
<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', '_s'); ?></a>
<header id="header">
    <div class="inner">
        <div class="logo">
            <div class="menu-icon mobile">
                <a href="#">
                    <span aria-hidden="true" class="icon-bars"></span>
                </a>
            </div>
            <a href="<?php bloginfo('url'); ?>">
                <img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/wpscale_logo.svg"
                    alt="WordPress at Scale Logo"/>
            </a>
        </div>

        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_id' => 'header-nav',
            'container_class' => 'primary-nav',
            'menu_class' => 'primary-menu',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => false,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 1,
            "walker" => new _s_primary_Menu_Walker(),
        ));
        ?>
    </div>
</header>
<?php
if( is_page() ){
    if( is_front_page() ){
        get_template_part('template-parts/banner', 'home');
    } else{
        _s_pageloop(get_the_ID());
    }
}
?>
<div id="content" class="site-content">

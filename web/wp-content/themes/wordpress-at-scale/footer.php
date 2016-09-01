<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * The HTML in this file was adapted from that of a previous theme (Bridge)
 * It has an excess number of wrapping divs.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

if( is_page() ){
    _s_pageloop(get_the_ID(), true);
}
?>

</div><!-- #content -->


<footer id="footer">
    <div class="inner">
        <div class="logo third">
            <a href="<?php bloginfo('url'); ?>">
                <img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/LogoReversed.svg"
                    alt="WordPress at Scale Logo"/>
            </a>
        </div>

        <div class="third">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => 'nav',
                'container_id' => 'footer-nav',
                'container_class' => 'primary-nav',
                'menu_class' => 'primary-menu',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => false,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 1,
            ));
            ?>
        </div>

        <a href="https://pantheon.io/wordpress-hosting" target="_blank">
            <div class="sponsor third"></div>
        </a>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * Move wpautop filter to after shortcodes are processed
 *
 * @package _s
 */

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop', 99 );
add_filter( 'the_content', 'shortcode_unautop', 100 );

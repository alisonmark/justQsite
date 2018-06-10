<?php

require dirname( __FILE__).'/inc/init.php';

/**
 * Các thiết lập liên quan đến theme
 */
function thachpham_theme_setup() 
    {
        add_image_size( 'sanpham_thumb', 370, 300, false );
    }

add_action('init', 'thachpham_theme_setup', 10);

/**
 * Xóa style.css của child-theme.
 */
function remove_default_styles()
    {
        wp_dequeue_style( 'synapse-style' );
    }

add_action('wp_print_styles', 'remove_default_styles', 10 );


?>
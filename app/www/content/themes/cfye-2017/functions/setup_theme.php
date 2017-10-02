<?php
// =========================================================================
// Setup Theme
// =========================================================================
function setup_theme() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( '900x600', 900, 600, true );
    add_image_size( '1600x1067', 1600, 1067, true );
    add_image_size( '1600x1600', 1600, 1600, false );

    add_theme_support( 'post-formats', array( 'gallery', 'video' ) );
}  
add_action( 'after_setup_theme', 'setup_theme' );
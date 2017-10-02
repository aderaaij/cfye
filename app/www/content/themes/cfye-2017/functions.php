<?php

// =========================================================================
// Theme Essentials
// =========================================================================
require_once('functions/setup_theme.php');
require_once('functions/add_scripts_styles.php');

// =========================================================================
// Remove stuff from header
// =========================================================================
require_once('functions/remove_wp_emojicons.php');
require_once('functions/remove_wp_emojicons_tinymce.php');
require_once('functions/remove_junk_from_head.php');

// =========================================================================
// Modifiy/remove/change things in the_content()
// =========================================================================
require_once('functions/remove_p_from_images.php');
require_once('functions/add_content_iframe_wrap.php');
require_once('functions/modify_img_caption_shortcode.php');

// =========================================================================
// Change queries and stuff
// =========================================================================
require_once('functions/modify_main_query.php');

/* = Limit Excerpt
-------------------------------------------------------------- */  
function get_excerpt($limit, $source = null){    
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

function add_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'admin_init', 'add_editor_styles' );


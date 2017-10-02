<?php
// =========================================================================
// Cache busting function
// =========================================================================
function autoversion($url) {
    $path = pathinfo($url);
    $test = file_exists(get_theme_file_path().$url);
    if($test) {
        $ver = filemtime(get_theme_file_path().$url);
        return $ver;
    }
    return '';
}

// =========================================================================
// REGISTER / DEREGISTER SCRIPTS AND STYLES
// =========================================================================
function add_scripts_styles() {
    global $wp_styles;
    // Register script
    wp_register_script( 'script', get_template_directory_uri() . '/assets/js/script.js','', autoversion('/assets/js/script.js'), true );
    wp_enqueue_script('script');

    wp_enqueue_style( 'style',  get_template_directory_uri() . '/assets/css/screen.css','', autoversion('/assets/css/screen.css'), '');

    // Remove wp-embed script
    wp_deregister_script( 'wp-embed' );
    
}
add_action( 'wp_enqueue_scripts', 'add_scripts_styles' );
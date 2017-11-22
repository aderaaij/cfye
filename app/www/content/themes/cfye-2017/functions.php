<?php

// =========================================================================
// Theme Essentials
// =========================================================================
require_once('functions/setup_theme.php');
require_once('functions/add_scripts_styles.php');
require_once('functions/register_menu.php');

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
require_once('functions/ssl_post_thumbnail_urls.php');

// =========================================================================
// Change queries and stuff
// =========================================================================
require_once('functions/modify_main_query.php');
require_once('functions/modify_admin_bar_position.php');

// =========================================================================
// Brand new functions that don't hook into WP Hooks
// =========================================================================
require_once('functions/get_current_page_name.php');

// =========================================================================
// Admin stuff
// =========================================================================
require_once('functions/add_editor_styles.php');
require_once('functions/admin_modify_contact_methods.php');
require_once('functions/remove_admin_profile_fields.php');


/* Add Google Maps API key to ACF */
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyAsIWgX7THlxoAl2hpyc0xgo2gJz6h90WU');
}
add_action('acf/init', 'my_acf_init');

/*
* New user registrations should have display_name set 
* to 'firstname lastname'. This is best used on the
* 'user_register' action.
*
* @param int $user_id The user ID
*/
function set_default_display_name( $user_id ) {
    $user = get_userdata( $user_id );
    $name = sprintf( '%s %s', $user->first_name, $user->last_name );
    $args = array(
        'ID'           => $user_id,
        'display_name' => $name,
        'nickname'     => $name
    );
    wp_update_user( $args );
}
add_action( 'user_register', 'set_default_display_name' );



/* Add general Advanded Custom Fields author page */
// if( function_exists('acf_add_options_page') ) {
// acf_add_options_page();
// acf_add_options_sub_page('General');
// }

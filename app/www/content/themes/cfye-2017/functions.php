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


/* Add Google Maps API key to ACF */
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyAsIWgX7THlxoAl2hpyc0xgo2gJz6h90WU');
}
add_action('acf/init', 'my_acf_init');


/* Add general Advanded Custom Fields author page */
// if( function_exists('acf_add_options_page') ) {
// acf_add_options_page();
// acf_add_options_sub_page('General');
// }

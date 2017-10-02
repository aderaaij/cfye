<?php 
/**
 * @package WordPress
 * @subpackage cfye
 * @since cfye 1.0
 *
 * Start our functions file
 * Many functions are borrowed from the twenty twelve theme
 */

/*
 * Set content width for images and oEmbeds
 */

if ( ! isset( $content_width ) ) $content_width = 625;



/*** Setup ***/
function cfye_setup() {	
	// Create translation files
	//load_theme_textdomain( 'let', get_template_directory() . '/languages' );
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );	
    add_theme_support( 'post-formats', array('video','gallery','audio' ) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'cfye' ) );
	add_editor_style();	
	// Register post thumbnail support. Uncomment or add to set sizes
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1600, 900); // Unlimited height, soft crop
	//add_image_size( 'side-thumb', 352, 185, true ); //300 pixels wide (and unlimited height)	
}
add_action( 'after_setup_theme', 'cfye_setup' );

/*** Includes - make all the cool stuff happen. Decomment for extra fun ***/
require_once('includes/enqueue.php');
require_once('includes/titles.php');
require_once('includes/navigation.php');
require_once('includes/entry-meta.php');
//require_once('includes/custom-post-types.php');
require_once('includes/taxonomies.php');
require_once('includes/post-limit.php');
require_once('includes/pagination.php');
require_once('includes/search-functions.php');
require_once('includes/profile-details.php');



function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) )
        return;
    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ) );
    return $r;
}
/* Remove jump to more anchor */
function remove_more_tag_link_jump($link) {
    $offset = strpos($link, '#more-'); //Locate the jump portion of the link
    if ($offset) { //If we found the jump portion of the link
        $end = strpos($link, '"', $offset); //Locate the end of the jump portion
    }
    if ($end) { //If we found the end of the jump portion
        $link = substr_replace($link, '', $offset, $end-$offset); //Remove the jump portion
    }
    return $link; //Return the link without jump portion or just the normal link if we didn't find a jump portion
} 
add_filter('the_content_more_link', 'remove_more_tag_link_jump'); //Add our function to the more link filter


add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'your-custom-size' => __('post-thumbnail'),
    ) );
}

function get_likes($url) {
  $json_string = file_get_contents('https://graph.facebook.com/?ids=' . $url);
  $json = json_decode($json_string, true);
  return intval( $json[$url]['shares'] );
} 

function get_tweets($url) {     
  $json_string = file_get_contents('https://urls.api.twitter.com/1/urls/count.json?url=' . $url);
  $json = json_decode($json_string, true);
  return intval( $json['count'] );
}


/*

/*remove p tags from content images */
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

add_action( 'after_setup_theme', 'wpse_74735_replace_wp_caption_shortcode' );

/**
 * Replace the default caption shortcode handler.
 *
 * @return void
 */
function wpse_74735_replace_wp_caption_shortcode() {
    remove_shortcode( 'caption', 'img_caption_shortcode' );
    remove_shortcode( 'wp_caption', 'img_caption_shortcode' );
    add_shortcode( 'caption', 'wpse_74735_caption_shortcode' );
    add_shortcode( 'wp_caption', 'wpse_74735_caption_shortcode' );
}

/**
 * Add the new class to the caption.
 *
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Caption text
 * @return string
 */
function wpse_74735_caption_shortcode( $attr, $content = NULL )
{
    $caption = img_caption_shortcode( $attr, $content );
    $caption = str_replace( '<p class="wp-caption"></p>', '<span class="wp-caption-text my_new_class', $caption );
    return $caption;
}



add_action( 'numbered_in_page_links', 'numbered_in_page_links', 10, 1 );

/**
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 *
 * @param  array $args
 * @return void
 */
function numbered_in_page_links( $args = array () )
{
    $defaults = array(
        'before'      => '<div class="page-links"><i class="icon-menu-3 pageLinksToggle"></i><ul class="subpage-list">' 
    ,   'after'       => '</ul></div>'
    ,   'link_before' => '<li>'
    ,   'link_after'  => '</li>'
    ,   'pagelink'    => '%'
    ,   'echo'        => 1
        // element for the current page
    ,   'highlight'   => 'b'
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    if ( ! $multipage )
    {
        return;
    }

    $output = $before;

    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
    {
        $j       = str_replace( '%', $i, $pagelink );
        $output .= ' ';

        if ( $i != $page || ( ! $more && 1 == $page ) )
        {
            $output .= "{$link_before}". _wp_link_page( $i ) . "{$j}</a>{$link_after}";
        }
        else
        {   // highlight the current page
            // not sure if we need $link_before and $link_after
            $output .= "{$link_before}<$highlight>{$j}</$highlight>{$link_after}";
        }
    }

    print $output . $after;
}

/* function wpr_maintenance_mode() {
    if ( ! is_user_logged_in() ) {
       require_once('503.php');

    }
}
add_action('get_header', 'wpr_maintenance_mode'); */
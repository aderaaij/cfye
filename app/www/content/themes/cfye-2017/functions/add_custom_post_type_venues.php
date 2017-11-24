<?php
add_action( 'init', 'cpt_venue_init' );
/**
 * Register a venue post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function cpt_venue_init() {
	$labels = array(
		'name'               => _x( 'Venues', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Venue', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Venues', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Venues', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'venue', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Venue', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Venue', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Venue', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Venue', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Venues', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Venues', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Venue:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No venues found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No venues found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'venues', 'with_front' => false),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);

	register_post_type( 'venues', $args );
}
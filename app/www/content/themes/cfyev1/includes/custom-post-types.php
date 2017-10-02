<?php
/* = New custom post-type
-------------------------------------------------------------- */
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Events' )
				
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author','tag','custom-fields', 'thumbnail' ),
		'rewrite' => array( 'slug' => 'events', 'with_front' => false ),
		'taxonomies' => array('post_tag'),
		)
	);
	register_post_type( 'shop',
		array(
			'labels' => array(
				'name' => __( 'Shop' ),
				'singular_name' => __( 'Shop' )
				
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author','tag','custom-fields', 'thumbnail' ),
		'rewrite' => array( 'slug' => 'shop', 'with_front' => true ),
		'taxonomies' => array('post_tag'),
		)
	);
}
/* = Create conditional post-type tags
-------------------------------------------------------------- */
function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}
/* = rewrite custom post-type / taxonomy / post url
-------------------------------------------------------------- */

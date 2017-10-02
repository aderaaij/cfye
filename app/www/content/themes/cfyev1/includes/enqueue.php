<?php
/**
 * @package WordPress
 * @subpackage cfye
 * @since cfye 0.1
 *
 * Register, Enqueue and dequeue scripts and styles
 *
 */
/**
 * Register, enqueue and dequeue scripts and styles 
 *
 * @since cfye 0.1
 */
function cfye_scripts_styles() {
	
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	//if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	//	wp_enqueue_script( 'comment-reply' );

	/*
	 * Register scripts
	 */		
	
	// wp_register_script( 'jquery-ui',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js",false, null, false );
	wp_register_script( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );	
	wp_register_script( 'scrolltofixed', get_template_directory_uri() . '/js/jquery-scrolltofixed-min.js', array('jquery'), null, true );
	wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), null, true );
	wp_register_script( 'ajaxify', get_template_directory_uri() . '/js/ajaxify-html5.js', array('jquery'), null, true );
	wp_register_script( 'history', get_template_directory_uri() . '/js/jquery.history.js', array('jquery'), null, false );
	wp_register_script( 'scrollto', get_template_directory_uri() . '/js/jquery-scrollto.js' , array('jquery'), null, false );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.16635.js' , false, null, false );	
	// wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array('jquery'), null, true );
	// wp_register_script( 'bootstrap-nav', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, false );
	// wp_register_script( 'caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), null, true );	
	// wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array('jquery'), null, true );	
	// wp_register_script( 'infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), '', true );
	// wp_register_script( 'dotdotdot', get_template_directory_uri() . '/js/jquery.dotdotdot.min.js', array('jquery'), null, true );
	wp_register_script(	'googlemaps',  'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', false, null, false );
	wp_register_script(	'spiderfier',  'http://jawj.github.io/OverlappingMarkerSpiderfier/bin/oms.min.js', array('googlemaps'), null, true );
	

	// wp_register_script( 'equalize', get_template_directory_uri() . '/js/equalize.min.js', array('jquery'), null, true );		
	// wp_register_script( 'jquery-ias', get_template_directory_uri() . '/js/jquery-ias.js', array('jquery'), '', true );
	// wp_register_script( 'onscreen', get_template_directory_uri() . '/js/jquery.onscreen.min.js' , false, null, true );	
	
	/*
	 * Enqueue Scripts
	 */		
	
	// wp_enqueue_script('bootstrap-nav');	
	// wp_enqueue_script('caroufredsel');
	// wp_enqueue_script('fitvids');
	// wp_enqueue_script('equalize');
	// wp_enqueue_script('scrolltofixed');	
	
	// wp_enqueue_script('onscreen');
	// wp_enqueue_script('imagesloaded');
	wp_enqueue_script('modernizr');	
	wp_enqueue_script('ajaxify');
	
	wp_enqueue_script('scrollto');
	wp_enqueue_script('plugins');
	wp_enqueue_script('history');		
	wp_enqueue_script('script');
	wp_enqueue_script('googlemaps');	
	wp_enqueue_script('spiderfier');
	
	
	wp_enqueue_style( 'cfye-icons',  get_template_directory_uri() . '/fonts/icons/style.css', false, '');
	
	/*
	 * Loads our main SASS generated stylesheet.
	 * style.css is only used as a placeholder for template information and doesn't need to be loaded
	 */
	
	//wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'cfye-style',  get_template_directory_uri() . '/css/screen.css', false, '');

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	//wp_enqueue_style( 'cfye-ie', get_template_directory_uri() . '/css/ie.css', array( 'cfye-style' ), '20121010' );
	//$wp_styles->add_data( 'cfye-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'cfye_scripts_styles' );

function load_admin_scripts() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/fonts/style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );
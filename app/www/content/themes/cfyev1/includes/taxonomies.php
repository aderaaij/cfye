<?php

/* = Add custom Taxonomies
-------------------------------------------------------------- */

add_action( 'init', 'build_taxonomies', 0 );  
function build_taxonomies() {  
    // code will go here 
	register_taxonomy(  
    'filter',  
    'post',  
    array(  
        'hierarchical' => true,  
        'label' => 'Filters',  
        'query_var' => true,  
        'rewrite' => true  
        )  
    );  
}  

add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2 );
function current_type_nav_class($classes, $item) {
    # get Query Vars
    $post_type = get_query_var('post_type');  
    $taxonomy = get_query_var('taxonomy');
    # get and parse Title attribute of Menu item
    $title = $item->attr_title; // menu item Title attribute, as post_type;taxonomy
    $title_array = explode(";", $title);
    $title_posttype = $title_array[0];
    $title_taxonomy = $title_array[0];
    # add class if needed
    if ($title != '' && ($title_posttype == $post_type || $title_taxonomy == $taxonomy)) {
        array_push($classes, 'current-menu-item');
    };
    return $classes;
}

/* = Adding a Taxonomy Filter to Admin List for posts
-------------------------------------------------------------- */	

add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
    // only display these taxonomy filters on desired custom post_type listings
    global $typenow;
    if ($typenow == 'post') {
        // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
        $filters = array('filter');
        foreach ($filters as $tax_slug) {
            // retrieve the taxonomy object
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            // output html for taxonomy dropdown filter
            echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
            echo "<option value=''>Show All $tax_name</option>";
            generate_taxonomy_options($tax_slug,0,0);
            echo "</select>";
        }
    }
}

function generate_taxonomy_options($tax_slug, $parent = '', $level = 0) {
    $args = array('show_empty' => 1);
    if(!is_null($parent)) {
        $args = array('parent' => $parent);
    }
    $terms = get_terms($tax_slug,$args);
    $tab='';
    for($i=0;$i<$level;$i++){
        $tab.='--';
    }
    foreach ($terms as $term) {
        // output each select option line, check against the last $_GET to show the current option selected
        echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
        generate_taxonomy_options($tax_slug, $term->term_id, $level+1);
    }
}

/* = Add extra column to post admin for custom taxonomies
-------------------------------------------------------------- */

add_filter( 'manage_posts_columns', 'add_new_columns' ); //Filter out Post Columns with 2 custom columns
function add_new_columns($defaults) {
    $defaults['filter'] = __('Filter'); //Language and Films is name of column
    return $defaults;
}
add_action('manage_posts_custom_column', 'add_new_custom_column', 10, 2); //Just need a single function to add multiple columns
function add_new_custom_column($column_name, $post_id) {
    global $wpdb;
    if( $column_name == 'filter' ) {
            $tags = get_the_terms($post->ID, 'filter'); //lang is the first custom taxonomy slug
            if ( !empty( $tags ) ) {
                $out = array();
                foreach ( $tags as $c )
                    $out[] = "<a href='edit.php?filter=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'filter', 'display')) . "</a>";
                echo join( ', ', $out );
            } else {
                _e('Not defined');  //No Taxonomy term defined
            }
        } 
    }

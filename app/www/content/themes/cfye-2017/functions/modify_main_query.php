<?php
// =========================================================================
// Modify a main query (not WP) 
// =========================================================================
function modify_main_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->query_vars['orderby'] = 'rand';
        $query->query_vars['posts_per_page'] = 20;
    }
}

add_action( 'pre_get_posts', 'modify_main_query' );
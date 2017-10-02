<?php 

if(!is_admin()){
    add_action('init', 'search_query_fix');
    function search_query_fix(){
        if(isset($_GET['s']) && $_GET['s']==''){
            $_GET['s']=' ';
        }
    }
}


function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
   <input type="text" name="s" id="s" value="'.trim(get_search_query()). '"/>
    <button type="submit" id="searchsubmit" class="search-icon icon-search" value="'. esc_attr__( '' ) .'" ></button>

    
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

// some code

function SearchFilter($query) {

    if (!is_admin())    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
}
add_filter('pre_get_posts','SearchFilter');

<?php 

/* =Limit recent author post description
-------------------------------------------------------------- */   
function recauth($limit) {
	$permalink = get_permalink();	
	$recauth = explode(' ', get_the_excerpt(), $limit);
	if (count($recauth)>=$limit) {
		array_pop($recauth);
		$recauth = implode(" ",$recauth).'...';
	} else {
		$recauth = implode(" ",$recauth);
	}	
	$recauth = preg_replace('/\[.+\]/','', $recauth);
	$recauth = apply_filters('the_content', $recauth); 
	$recauth = str_replace(']]>', ']]&gt;', $recauth);
	return $recauth;
}

/* =Limit recent author post description
-------------------------------------------------------------- */  
function get_excerpt($limit, $source = null){

    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

<?php 
if ( ! function_exists( 'cfye_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own cfye_entry_meta() to override in a child theme.
 *
 * @since cfye 0.1
 * Borrowed From TwentyTwelve 1.0
 */

//Replace rel="category tag" with rel="category"
add_filter( 'the_category', 'add_nofollow_cat' );  
function add_nofollow_cat( $text ) { 
	$text = str_replace('rel="category tag"', "", $text); return $text; 
}

function cfye_entry_meta() {

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'cfye' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'cfye' ) );

	$date = sprintf( '<time class="entry-date" datetime="%3$s" data-icon="&#xe000;">&nbsp;Posted on:&nbsp;%4$s</time>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cfye' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( '%3$s<br/><i class="icon-folder-open"></i>&nbsp;Categories:&nbsp; %1$s<br/> <i class="icon-tags">&nbsp;Tags:&nbsp; %2$s </i><br/> <span class="by-author"><i class="icon-user"></i>&nbsp;Author:&nbsp;%4$s</span>', 'cfye' );
	} elseif ( $categories_list ) {
		$utility_text = __( '%3$s<br/><i class="icon-folder-open"></i>&nbsp;Categories:&nbsp;%1$s <br/>  <span class="by-author"><i class="icon-user"></i>&nbsp;Author:&nbsp;%4$s</span>', 'cfye' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> %4$s</span>.', 'cfye' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

if ( ! function_exists( 'cfye_short_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own cfye_entry_meta() to override in a child theme.
 *
 * @since cfye 0.1
 * Borrowed From TwentyTwelve 1.0
 */

//Replace rel="category tag" with rel="category"


function cfye_short_entry_meta() {

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'cfye' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'cfye' ) );

	$date = sprintf( '<span class="short-meta-item"><time class="entry-date" datetime="%3$s"><i class="icon-calendar"></i>&nbsp;%4$s</time></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cfye' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	/*if ( $tag_list ) {
		$utility_text = __( '%3$s<br/><span data-icon="&#xe007;">&nbsp;Categories:&nbsp;</span> %1$s<br/> <span data-icon="&#xe009;">&nbsp;Tags:&nbsp; %2$s </span><br/> <span class="by-author" data-icon="&#xe012;">&nbsp;Author:&nbsp;%4$s</span>', 'cfye' );
	} */if ( $categories_list ) {
		$utility_text = __( '%3$s <span class="short-meta-item"><span class="by-author"><i class="icon-user"></i>&nbsp;%4$s</span></span>', 'cfye' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> %4$s</span>.', 'cfye' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;
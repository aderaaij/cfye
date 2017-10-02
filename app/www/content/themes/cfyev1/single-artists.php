<?php
/**
 * Display single pages
 *
 * @package WordPress
 * @subpackage cfye
 * @since cfye 0.1
 */

get_header(); ?>	
	
<?php 
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); 

			
		// Query related items
		$posts3 = get_field('related_articles'); 	
		// Count the number of posts
		$number = count($posts3);
		
		//start the loop
		if(  $posts3 ):
			
		
			//Start the loop, variable must be called $post (!IMPORTANT)
			foreach( $posts3 as $post): 
			// Setup post data
			setup_postdata($post);
			//Get the ID 

				
				
				if ($number > 1):
				get_template_part('partials/content','category');
				else: 
				get_template_part('partials/content','single');
				endif;
			endforeach;		
			endif;
		endwhile; 
		wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
	?>

		<?php cfye_content_nav( 'nav-below' ); ?>	
	<?php else: // if no posts ?>
		<?php get_template_part('partials/404','msg');?>
	<?php endif; // end have_posts() check ?>

<?php get_footer(); ?>
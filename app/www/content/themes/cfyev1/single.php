<?php
/**
 * Display single pages
 *
 * @package WordPress
 * @subpackage cfye
 * @since cfye 0.1
 */

get_header(); ?>	
	
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'partials/content-single', get_post_format() ); ?>
		
		<?php endwhile; ?>

		<?php cfye_content_nav( 'nav-below' ); ?>	

	<?php endif; // end have_posts() check ?>

<?php get_footer(); ?>
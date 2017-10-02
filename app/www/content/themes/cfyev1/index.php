<?php
/**
 * The index, found at the bottom of our waterfall
 * Borrowed mostly from the TwentyTwelve theme
 * The template hierarchy Cheat sheet: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage cfye
 * @since cfye 0.1
 */

get_header(); ?>

	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php get_template_part('partials/content','category');?>
	
	<?php endwhile; ?>
	
	<?php else:?>
		<?php if(is_search()):?>
			<?php get_template_part('partials/404','msg');?>
		<?php endif;?>
	<?php endif;?>
	
	
	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below">
	<?php cfye_numeric_posts_nav(); ?>

	</nav><!-- #nav-below -->
	<?php endif; ?>	
	<script>
/*	new AnimOnScroll( document, {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );*/
	</script>
<?php get_footer(); ?>
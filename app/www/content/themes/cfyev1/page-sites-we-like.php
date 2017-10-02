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
	
	<?php if(get_field('friends')): ?>
		
		<div class="sites-we-like">
			<ul class="swl-grid">
		
			<?php 
				while(has_sub_field('friends')): 
					$attachment_id = get_sub_field('friends_thumbnail');
					$size = "large"; // (thumbnail, medium, large, full or custom size)
					$image = wp_get_attachment_image_src( $attachment_id, $size );
			?>
				<li class="site-we-like">
					<a href="<?php the_sub_field('friends_link'); ?>" title=" <?php the_sub_field('friends_title'); ?>" target="_blank">						
						<div class="swl-thumb" style="background-image:url(<?php echo $image[0]; ?>);"></div>
						<div class="swl-info">
							<div class="swl-link">
								<h2 class="swl-title"><?php the_sub_field('friends_title');?></h2>
								<i class="big-icon icon-new-tab"></i>
							</div><!-- .swl-title-->
						</div><!-- .swl-info -->					
					</a>
				</li><!-- .site-we-like -->				
			<?php endwhile; ?>		
			</ul><!--.swl-grid-->
		</div><!-- .sites-we-like -->
	<?php endif; ?>
		
<?php endwhile; endif;?>	
	
<?php get_footer(); ?>
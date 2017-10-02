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
		<?php // get post thumbnail url for background image
			$image_id = get_post_thumbnail_id();		
			$image_url = wp_get_attachment_image_src($image_id,'post-thumbnail', true); 			
		?>	
		<div class="page-images-wrap">
			<div class="page-thumb" style="background-image:url(<?php echo $image_url[0];?>);"></div>
		</div><!-- .page-images-wrap -->

		<div class="page-content">
			<div class="entry-content">
				<h1 class="page-title">
					<?php the_title();?>
				</h1>
				<?php the_content();?>
				
				<?php if(is_page('about')):?>
					
					<?php if(get_field('q_and_a')):	?>
					<h2 class="qa-header">F.A.Q.</h2>
					<ul class="qa-list">
 
					<?php while(has_sub_field('q_and_a')):?>					
					<li class="qa-list-item">
						<i class="icon-angle-right qa-icon"></i>						
						<h3 class="qa-question">
							<?php the_sub_field('qa_question');?>
						</h3>
						<div class="qa-answer-wrap">
							<div class="qa-answer">
								<?php the_sub_field('qa_answer');?>
							</div><!-- .qa-answer -->
						</div>
					<?php endwhile;?>
					</ul><!-- .qa-list -->
					<?php endif;?>
				<?php endif;?>
			</div><!-- .entry-content -->
		</div><!-- .entry -content-->
		
	<?php endwhile; endif;?>	
	
<?php get_footer(); ?>
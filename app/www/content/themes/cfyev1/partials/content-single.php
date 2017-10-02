<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage cfye
 * @since cfye 0.1
 */
?>
	
	<?php get_template_part('partials/single',get_post_format());?>
	<?php $currentarticle = get_the_ID();?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		<div class="article-container-wrap">
				
			<?php previous_post_link('<div class="single-nav-next single-prev-next slideOutRight"> %link </div>','<span class="linktext">Previous article: %title </span> <i class="icon-angle-right single-nav"></i>  '); ?>
			<?php next_post_link('<div class="single-nav-prev single-prev-next slideOutLeft">%link </div>','<span class="linktext">Next article: %title </span> <i class="icon-angle-left single-nav"></i>'); ?>

			<div class="container">
				<div class="article-wrap">
					
					<header class="single-entry-header">
						<h1 class="page-title">
							<?php the_title();?>
						</h1><!-- .page-title -->
						<div class="top-meta meta-style">
							<?php cfye_short_entry_meta(); ?>
						</div><!-- .top-meta -->
					</header>					
					
					<div class="entry-content article-entry-content">
						<?php the_content(); ?>					
					</div><!-- .entry-content-->
					
					<?php global $multipage, $numpages, $page;if( $multipage ): ?>    
						<?php wp_link_pages (array( 
							'before'           => '<nav class="paginated-post-links">' ,
							'after'            => '</nav>',			
							'next_or_number' => 'next',
							'nextpagelink'     => '<div class="next-paginated">Continue this article&nbsp;<i class="icon-angle-right"></i></div>',
							'previouspagelink' => '<div class="prev-paginated"><i class="icon-angle-left"></i>&nbsp;Previous page</div>'
						) ); ?>
					<?php endif;?>
					
					<div class="single-share-wrap">
						<div class="single-share-buttons">
							
							<ul class="cat-meta-list">														
								<li class="facebook-share">
									<?php $posturl = get_permalink(); ?>
									<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>">
									<span class="share-left cshare-button">
										<i class="icon-facebook"></i>
									</span> 
									<span class="share-count cshare-button">
										<span rel="<?php the_permalink();?>" class="fb-counter"></span><?php //echo get_likes('http://cfye.com');?>
									</span>
								</a>
								</li>
								<li class="twitter-share">
									<a href="https://www.twitter.com/share?url=<?php the_permalink();?>" data-text="<?php the_title();?>">
									<span class="share-left cshare-button">
										<i class="icon-twitter"></i>
									</span>
									<span class="share-count cshare-button">
										<span  rel="<?php echo $posturl;?>" class="tw-counter"></span>
										<?php// echo get_tweets('http://cfye.com');?>
									</span>
									</a>
								</li>
							</ul><!-- .cat-meta-list--><span class="share-this"><?php _e( 'Share this:', 'cfye' ); ?></span>
						</div><!-- .single-share-buttons -->	
					</div><!-- .single-share-wrap -->
				
				</div><!-- .article-wrap-->
				<?php get_template_part('partials/artist-box');?>		
			</div><!-- .container-->
		</div><!-- .article-container-wrap -->
		
		<?php 	if( $multipage ): do_action( 'numbered_in_page_links' ); endif;?>

		<footer class="entry-meta total-width">
			<div class="container">	
				<div class="one-third last footer-newsletter">
					<?php // gravity_form(5, $display_title=true, $display_description=true, $display_inactive=false, $field_values=null, $ajax=true, $tabindex); ?>
				</div>
				<?php // get_template_part('partials/author-box');?>
			</div>
		</footer><!-- .entry-meta -->	
		
	</article><!-- #post -->
	
	<?php
		$posts = get_field('related_article'); 					
		if(  $posts ):  
	?>			
	<article class="related-article">		
		
	<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>

	<?php setup_postdata($post); ?>
	<?php // get post thumbnail url for background image
		$image_id = get_post_thumbnail_id();		
		$image_url = wp_get_attachment_image_src($image_id,'post-thumbnail', true); 
	?>	
		
		<a href="<?php the_permalink();?>" title="<?php the_title();?>">
			<div class="related-overlay">
				<div class="container">
					<div class="related-meta-wrap">
						<span class="read-next"><?php _e( 'Read next', 'cfye' ); ?></span>
						<h2 class="related-title"><?php the_title();?></h2>	
					</div><!-- .related-meta-wrap -->
				</div><!-- .container -->
			</div><!--.related-overlay -->
			<div class="related-thumbnail" style="background-image:url(<?php echo $image_url[0];?>);"></div>			
		</a>
		
	
	
	<?php endforeach; ?>

	</article><!-- .related-article -->

	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>		
	<?php endif;?>


	
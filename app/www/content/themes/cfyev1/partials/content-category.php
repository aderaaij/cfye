
	<?php // get post thumbnail url for background image
		$image_id = get_post_thumbnail_id();		
		$image_url = wp_get_attachment_image_src($image_id,'post-thumbnail', true); 
	?>	
		
	<article class="frontpage-post" id="post-<?php the_ID();?>">
		
		<a class="post-link" href="<?php the_permalink(); ?>">
			
			<div class="thumb-wrap">
				
			<?php if( get_field('article_type') == 'Video' ):?>
				
				<div class="cat-video-wrap">
					<?php if( get_field('_slt_video_provider') == 'Youtube'):?>
					<iframe  src="//www.youtube.com/embed/<?php the_field('_slt_youtube');?>" frameborder="0" allowfullscreen></iframe>
					<?php elseif( get_field('_slt_video_provider') == 'Vimeo'):?>
					<iframe  src="//player.vimeo.com/video/<?php the_field('_slt_vimeo');?>" frameborder="0" allowfullscreen></iframe>
					<?php elseif( get_field('_slt_video_provider') == 'other'):?>
					<?php the_field('video_embed_code');?>							
					<?php endif;?>
				</div>
			
			<?php else:?>
				
				<?php if( get_field('featured_image_alignment') || get_field('featured_image_size') ):?>				
					
					<?php 
						// Get our image position
						if( get_field('featured_image_alignment') == 'center' ):
							$bgposition = 'position-center';
						elseif( get_field('featured_image_alignment') == 'top'):
							$bgposition = 'position-top';
						elseif( get_field('featured_image_alignment') == 'bottom'):
							$bgposition = 'position-bottom';
						endif;
						// get our image background-size
						if( get_field('featured_image_size') == 'full' ):
							$bgsize = 'size-cover';
						elseif( get_field('featured_image_size') == 'proportional'):
							$bgsize = 'size-proportional';
						endif;
					?>

					<div class="frontpage-thumb <?php echo $bgposition; ?> <?php echo $bgsize;?> size-cover" style="background-image:url(<?php echo $image_url[0];?>); background-color:<?php the_field('featured_image_background'); ?>"></div>		
				
				<?php else:?>
				
					<div class="frontpage-thumb position-center" style="background-image:url(<?php echo $image_url[0];?>);"></div>
				
				<?php endif;?>
				
				<div class="click-overlay">
					<div class="click-content">
						<?php if ( 'video' == get_post_format() ): ?>
   						<i class="large-icon icon-film"></i>	<br/>						
						<span class="check-it"><?php _e( 'Watch the video', 'cfye' ); ?></span>
						<?php else:?>
						<i class="large-icon icon-eye"></i>	<br/>						
						<span class="check-it"><?php _e( 'View the article', 'cfye' ); ?></span>
						<?php endif;?>
					</div><!-- .click-content -->
				</div><!-- .click-overlay -->
			
			<?php endif;?>
			
			</div><!-- .thumb-wrap -->
			
		</a><!-- .post-link -->	
		
		<div class="post-wrap">					
			<a class="post-content-link" href="<?php the_permalink();?>" title="<?php the_title();?>">
			<header>
				<h1 class="post-title"><?php the_title();?></h1>
				<?php if(get_field('post_subtitle')):?>
				<span class="subtitle">					
					<?php the_field('post_subtitle');?>
				</span>
				<?php endif;?>
			</header>

			<div class="entry-content cat-entry-content dotdot">				
				<p>
					<?php echo get_excerpt(440, 'content');?>
				</p>
			</div><!-- .entry-content.cat-entry-content.dotdot -->
			</a>
			<a class="continue-button" href="<?php the_permalink();?>" title="<?php the_title();?>">
				<?php _e( 'View the article', 'cfye' ); ?>
			</a>	
			<footer class="entry-footer-meta meta-style">
				<ul class="cat-meta-list">
					<li>
						<i class="icon-calendar"></i>
						&nbsp;<?php echo get_the_date('d.m.Y');?>
					</li>	
					<li>
						<i class="icon-user"></i>
						&nbsp;<?php the_author();?>
					</li>										
					<li class="facebook-share">
						<?php $posturl = get_permalink(); ?>
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>">
						<span class="share-left cshare-button">
							<i class="icon-facebook"></i>
						</span> 
						<span class="share-count cshare-button">
							<span rel="<?php the_permalink();?>" class="fb-counter"></span><?php //echo get_likes('http://cfye.com');?>
						</span>
					</a>
					</li>
					<li class="twitter-share">
						<a href="http://www.twitter.com/share?url=<?php the_permalink();?>" data-text="<?php the_title();?>">
						<span class="share-left cshare-button">
							<i class="icon-twitter"></i>
						</span>
						<span class="share-count cshare-button">
							<span  rel="<?php echo $posturl;?>" class="tw-counter"></span>
							<?php// echo get_tweets('http://cfye.com');?>
						</span>
						</a>
					</li>
				</ul>					
			</footer><!-- .entry-footer-meta -->

		</div><!-- .post-wrap -->
	
	</article><!-- .frontpage-post -->			
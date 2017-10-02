<?php $posts = get_field('artist_post'); if( $posts ): ?>
<div class="artist-info">				
	<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
	<?php setup_postdata($post); ?>
		<?php $artistID = get_the_ID(); $artistname = get_the_title($postid); 
		?>		
		<div class="artist-outer-wrap">
			<div class="artist-thumb-wrap">
				<div class="flip-container">
					<div class="flipper">
						<div class="front">
						<?php the_post_thumbnail( $size = 'thumbnail', $attr = '' );?>
						</div>
						<div class="back">
							<div class="circle">
								<i class="big-icon icon-user"></i>
							</div>
						</div>
					</div><!-- .flipper -->
				</div><!--.flip-container-->
				<ul class="social-list">
					<?php if(get_field('_slt_website')):?>
						<li class="social-icon artist-web top">
							<a href="<?php the_field('_slt_website');?>" title="Visit <?php echo $artistname;?> Website" target="_blank">
								<i class="icon-earth"></i>
							</a>
						</li>
					<?php endif;?>	
					<?php if(get_field('_slt_facebookid')):?>
						<li class="social-icon artist-facebook upperright">
							<a href="<?php the_field('_slt_facebookid');?>" title="Like <?php echo $artistname;?> on Facebook" target="_blank">
								<i class="icon-facebook"></i>
							</a>
						</li>
					<?php endif;?>				
					<?php if(get_field('_slt_twitterid')):?>
						<li class="social-icon artist-twitter right">
							<a href="https://twitter.com/<?php the_field('_slt_twitterid');?>" title="Follow <?php echo $artistname;?> on Twitter" target="_blank">
								<i class="icon-twitter"></i>
							</a>
						</li>
					<?php endif;?>
					<?php if(get_field('flickr_username')):?>
						<li class="social-icon artist-flickr bottomright">
							<a href="https://flickr.com/photos/<?php the_field('flickr_username');?>" title="<?php echo $artistname;?> on Flickr" target="_blank">
								<i class="icon-flickr"></i>
							</a>
						</li>
					<?php endif;?>
					<?php if(get_field('_slt_tumblrid')):?>
						<li class="social-icon artist-tumblr bottomleft">
							<a href="<?php the_field('_slt_tumblrid');?>" title="<?php echo $artistname;?> on Tumblr" target="_blank">
								<i class="icon-tumblr"></i>
							</a>
						</li>
					<?php endif;?>
					<?php if(get_field('_slt_instagram')):?>
						<li class="social-icon artist-instagram upperleft">
							<a href="http://instagram.com<?php the_field('_slt_instagram');?>" title="Follow <?php echo $artistname;?> on Instagram" target="_blank">
								<i class="icon-camera"></i>
							</a>
						</li>
					<?php endif;?>
				</ul><!--.social-list-->
			</div><!--.artist-thumb-wrap-->
		</div>
		<div class="artist-meta">
			<h2 class="artist-title">
				About <?php echo $artistname; ?>
			</h2><!-- .artist-title -->
			<div class="artist-description">
				<?php the_field('artist_description');?>
			</div>
			
			
			<?php
				$posts2 = get_field('related_articles'); 	
				$number = count($posts2);
				if(  $posts2 ):  
			?>				
			
			<?php if ($number > 1):?>
			<div class="artist-related-wrap">
				
				<h3>
					More articles featuring <?php echo $artistname;?>
				</h3>				
				<ul class="related-artist-items">
				<?php foreach( $posts2 as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
				<?php 
					$current = get_the_ID(); global $wp_query; $thePostID = $wp_query->post->ID; 
					if($current != $thePostID):
				?>						
					<li class="related-article-artist">
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">								
							<h3>
								<i class="icon-newspaper related-icon"></i>
								&nbsp;<?php the_title();?>
							</h3>
							<span class="entry-meta"><?php echo get_the_date();?></span>
							<span class="teaser"><?php echo get_excerpt('50');?></span>
						</a>
					</li><!-- .related-article-artist -->
					
					<?php endif;?>
					<?php endforeach; ?>
				</ul><!-- .related-artist-items -->
			</div>
			<?php endif;?>
		</div><!-- .artist-meta -->
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>		
		<?php endif;?>

	
	<?php endforeach; ?>
	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	</div><!--.artist-info-->
<?php endif;?>

	

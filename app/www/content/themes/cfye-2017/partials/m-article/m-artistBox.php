<?php $posts = get_field('artist_post'); if( $posts ): ?>				
	<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
	<?php setup_postdata($post); ?>
	<?php $artistID = get_the_ID(); $artistname = get_the_title($artistID); ?>
	<div class='m-profileExcerpt'>
		<div class='m-profileExcerpt__person'>
			<div class='m-profileExcerpt__thumbnail'>
				<?php the_post_thumbnail( $size = 'thumbnail', $attr = '' );?>
			</div>
		</div>
		<div class='m-profileExcerpt__contentWrap'>		
			<div class='m-profileExcerpt__content'>
				<h3 class='m-profileExcerpt__artistTitle'>About <?php echo $artistname; ?></h3>
				<?php the_field('artist_description');?>
			</div>
			<ul class="m-profileExcerpt__socialList">
				<?php if(get_field('_slt_website')):?>
				<li>
					<a href="<?php the_field('_slt_website');?>" title="Visit <?php echo $artistname;?> Website" target="_blank" rel="noopener">
						<svg class="m-social__icon" viewbox="0 0 32 32">
							<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-link"></use>
						</svg>
					</a>
				</li>
				<?php endif;?>	
				<?php if(get_field('_slt_facebookid')):?>
				<li>
					<a href="<?php the_field('_slt_facebookid');?>" title="Like <?php echo $artistname;?> on Facebook" target="_blank" rel="noopener">
						<svg class="m-social__icon" viewbox="0 0 32 32">
							<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook"></use>
						</svg>
					</a>
				</li>
				<?php endif;?>				
				<?php if(get_field('_slt_twitterid')):?>
				<li>
					<a href="https://twitter.com/<?php the_field('_slt_twitterid');?>" title="Follow <?php echo $artistname;?> on Twitter" target="_blank" rel="noopener">
						<svg class="m-social__icon" viewbox="0 0 32 32">
							<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter"></use>
						</svg>
					</a>
				</li>
				<?php endif;?>
				<?php if(get_field('flickr_username')):?>
				<li>
					<a href="https://flickr.com/photos/<?php the_field('flickr_username');?>" title="<?php echo $artistname;?> on Flickr" target="_blank" rel="noopener">
						<svg class="m-social__icon" viewbox="0 0 32 32">
							<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-flickr"></use>
						</svg>
					</a>
				</li>
				<?php endif;?>
				<?php if(get_field('_slt_tumblrid')):?>
				<li>
					<a href="<?php the_field('_slt_tumblrid');?>" title="<?php echo $artistname;?> on Tumblr" target="_blank" rel="noopener">
						<svg class="m-social__icon" viewbox="0 0 32 32">
							<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-tumblr"></use>
						</svg>
					</a>
				</li>
				<?php endif;?>
				<?php if(get_field('_slt_instagram')):?>
				<li>
					<a href="https://instagram.com/<?php the_field('_slt_instagram');?>" title="Follow <?php echo $artistname;?> on Instagram" target="_blank" rel="noopener">
						<svg class="m-social__icon" viewbox="0 0 32 32">
							<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram"></use>
						</svg>
					</a>
				</li>
				<?php endif;?>
			</ul>
		</div>
	</div>	
		
	<?php
		$posts2 = get_field('related_articles'); 	
		$number = count($posts2);
		if(  $posts2 ):  
	?>				
	
	<?php if ($number > 100):?>
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
	<!-- </div>.artist-meta -->
	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>		
	<?php endif;?>

	
	<?php endforeach; ?>
	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	
<?php endif;?>

	

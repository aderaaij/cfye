<?php $authorID = get_the_author_meta( 'ID' ) ?>
<?php $authorUser = 'user_'. $authorID ?>
<?php $thumb = get_field( 'user_thumb', $authorUser ) ?>
<div class='m-profileExcerpt'>
	<div class='m-profileExcerpt__person'>
		<div class='m-profileExcerpt__thumbnail'>
			<a href="<?php echo get_author_posts_url( $authorID ) ?>" title="<?php the_author_meta( 'display_name', $authorID ) ?>'s profile page'">
				<img width="150" height="150" src="<?php echo $thumb['sizes']['thumbnail'] ?>"/>
			</a>
		</div>
	</div>
	<div class='m-profileExcerpt__contentWrap'>		
		<div class='m-profileExcerpt__content'>
			<h3 class='m-profileExcerpt__artistTitle'>
				<a href="<?php echo get_author_posts_url( $authorID ) ?>" title="<?php the_author_meta('display_name', $authorID) ?>'s profile page">About <?php the_author_meta( 'display_name', $authorID ) ?></a>
			</h3>
			<p><?php the_author_meta('description', $authorID) ?></p>
		</div>
		<ul class="m-profileExcerpt__socialList">
			<?php if ( get_field( 'website', $authorUser ) ): ?>
			<li>
				<a href="<?php the_field( 'website', $authorUser ) ?>" title="Visit <?php the_author_meta('display_name', $authorID) ?>'s website" target="_blank" rel="noopener">
					<svg class="m-social__icon" viewbox="0 0 32 32">
						<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-link"></use>
					</svg>
				</a>
			</li>
			<?php endif;?>	
			<?php if ( get_field( 'facebook', $authorUser ) ): ?>
			<li>
				<a href="<?php the_field( 'facebook', $authorUser ) ?>" title="Like <?php the_author_meta('display_name', $authorID) ?> on Facebook" target="_blank" rel="noopener">
					<svg class="m-social__icon" viewbox="0 0 32 32">
						<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook"></use>
					</svg>
				</a>
			</li>
			<?php endif;?>				
			<?php if ( get_field( 'twitter', $authorUser ) ): ?>
			<li>
				<a href="https://twitter.com/<?php the_field( 'twitter', $authorUser ) ?>" title="Follow <?php the_author_meta('display_name', $authorID) ?> on Twitter" target="_blank" rel="noopener">
					<svg class="m-social__icon" viewbox="0 0 32 32">
						<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter"></use>
					</svg>
				</a>
			</li>
			<?php endif;?>
			<?php if ( get_field( 'flickr', $authorUser ) ): ?>
			<li>
				<a href="https://flickr.com/photos/<?php the_field( 'flickr', $authorUser ) ?>" title="<?php the_author_meta('display_name', $authorID) ?> on Flickr" target="_blank" rel="noopener">
					<svg class="m-social__icon" viewbox="0 0 32 32">
						<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-flickr"></use>
					</svg>
				</a>
			</li>
			<?php endif;?>
			<?php if ( get_field( 'tumblr', $authorUser ) ): ?>
			<li>
				<a href="<?php the_field( 'tumblr', $authorUser ) ?>" title="<?php the_author_meta('display_name', $authorID) ?> on Tumblr" target="_blank" rel="noopener">
					<svg class="m-social__icon" viewbox="0 0 32 32">
						<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-tumblr"></use>
					</svg>
				</a>
			</li>
			<?php endif;?>
			<?php if ( get_field( 'instagram', $authorUser ) ): ?>
			<li>
				<a href="https://instagram.com/<?php the_field( 'instagram', $authorUser ) ?>" title="Follow <?php the_author_meta('display_name', $authorID) ?> on Instagram" target="_blank" rel="noopener">
					<svg class="m-social__icon" viewbox="0 0 32 32">
						<use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram"></use>
					</svg>
				</a>
			</li>
			<?php endif;?>
		</ul>
	</div>
</div>
	

<!-- <?php 
// the query
$args = array(
    'author'        =>  $authorID,
    'orderby'       =>  'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => 5
);
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php the_title() ?>
<?php endwhile; ?>
<?php endif; ?>
<?php
	$posts2 = get_field('related_articles'); 	
	$number = count($posts2);
	if(  $posts2 ):  
?>				 -->

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
					<?php the_title();?>
				</h3>
				<span class="entry-meta"><?php echo get_the_date();?></span>
				<span class="teaser"><?php echo wp_trim_words( get_the_content(), 10, '...' ); ?></span>
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


	

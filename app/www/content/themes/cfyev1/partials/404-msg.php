

<div class="page-images-wrap">
	<div class="page-thumb thumb-404" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/404bob.jpg);"></div>
</div>

<article class="page-content content-404">
	<div class="entry-content">
		<h1 class="page-title">
			<?php _e( 'We&#39;ve lost it', 'cfye' ); ?>
		</h1>
		<p><?php _e( 'Not our mind, but we can&#39;t seem to find whatever you&#39;re looking for! Give it a search if you feel lucky!', 'cfye' ); ?></p>
		<?php get_search_form( $echo = true );?>
		<p><?php _e( 'If you think this is a mistake or error, please contact us at')?> <a href="mailto:contact@cfye.com" title="contact CFYE">contact@cfye.com</a></p>

		<p> <?php _e('Or check out some of our recent articles if you&#39;re here anyway.', 'cfye' ); ?></p>
		<?php 
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 5
			);
			// The Query
			$the_query = new WP_Query( $args );
			// The Loop
			if ( $the_query->have_posts() ): 
		?>
		<ul class="recent-post-list">
		
			<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>

			<li class="recent-post-item">
				<a href="<?php the_permalink();?>" title="<?php the_title();?>">
					<i class="icon-newspaper"></i>&nbsp;					
					<h3><?php the_title();?></h3>
					<div class="recent-post-content">
						<span class="list-meta"><i class="icon-calendar"></i>&nbsp;<?php echo get_the_date();?></span>
						<p><?php echo get_excerpt(120);?></p>
					</div><!-- .recent-post-content -->
				</a>
			</li>
			<?php endwhile;?>
		</ul><!-- .recent-post-list -->
		<?php 
			endif; 
			/* Restore original Post Data */
			wp_reset_postdata();
		?>
	</div><!-- .entry-content -->
</article><!-- .entry -content-->
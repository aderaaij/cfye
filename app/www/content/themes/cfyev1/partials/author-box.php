<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
	<?php $author_id = get_the_author_meta( 'ID' );	?>
	
	<div class="author-info">

		<h2 class="artist-title">
			<?php printf( __( 'Author: %s', 'cfye' ), get_the_author() ); ?>
		</h2><!-- .artist-title -->
		
		<div class="artist-thumb-wrap">
			
			<div class="flip-container">
				<div class="flipper">					
					
					<div class="front">					
						<?php 
							$attachment_id = get_field('user_thumb','user_'.$author_id );
							$size = "thumbnail"; // (thumbnail, medium, large, full or custom size) 
							$image = wp_get_attachment_image_src( $attachment_id, $size );
						?>
						<img src="<?php echo $image[0]; ?>" alt ="<?php echo get_the_author_nickname();?>" />					
					</div><!-- .front -->
					
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="View all posts by <?php echo get_the_author_nickname();?>" rel="author">
						<div class="back">
							<div class="circle">
								<i class="big-icon icon-CFYE_NEW"></i>
							</div>
						</div>
					</a>

				</div><!-- .flipper -->
			</div><!--.flip-container-->

			<ul class="social-list">
				
				<?php if (! get_the_author_meta('url') == ''):?>
				<li class="social-icon artist-web top">
					<a href="<?php echo get_the_author_meta('url');?>" title="Visit <?php echo get_the_author_nickname();?>&#39;s Website" target="_blank">
						<i class="icon-earth"></i>
					</a>
				</li>
				<?php endif;?>	
				
				<?php if(get_field('facebook_profile','user_'.$author_id  )):?>
				<li class="social-icon artist-facebook upperright">
					<a href="<?php the_field('facebook_profile','user_'.$author_id );?>" title="Facebook" target="_blank">
						<i class="icon-facebook"></i>
					</a>
				</li>
				<?php endif;?>				
				
				<?php if(get_field('twitter_profile','user_'.$author_id  )):?>
				<li class="social-icon artist-twitter right">
					<a href="https://twitter.com/<?php the_field('twitter_profile','user_'.$author_id );?>" title="Follow <?php echo get_the_author_nickname();?> on Twitter" target="_blank">
						<i class="icon-twitter"></i>
					</a>
				</li>
				<?php endif;?>
				
				<?php if(get_field('flickr_profile','user_'.$author_id)):?>
				<li class="social-icon artist-flickr bottomright">
					<a href="https://flickr.com/photos/<?php the_field('flickr_profile','user_'.$author_id);?>" title="<?php echo $artistname;?> on Flickr" target="_blank">
						<i class="icon-flickr"></i>
					</a>
				</li>
				<?php endif;?>
				
				<li class="social-icon artist-e-mail bottom">
					<a target="_blank" title="E-mail <?php echo get_the_author_nickname();?>" href="mailto:<?php echo get_the_author_meta( 'user_email' )?>">
						<i class="icon-envelop"></i>
					</a>
				</li>

				<?php if(get_field('linked-in_profile','user_'.$author_id  )):?>
				<li class="social-icon artist-linkedin bottomleft">
					<a href="<?php the_field('linked-in_profile','user_'.$author_id );?>" title="Connect with <?php echo get_the_author_nickname();?> on LinkedIn" target="_blank">
						<i class="icon-linkedin"></i>
					</a>
				</li>
				<?php endif;?>
				
			</ul><!--.social-list-->

		</div><!--.artist-thumb-wrap-->

		<div class="artist-meta">
			<div class="author-description">
					<p><?php the_author_meta( 'description' ); ?></p>
			</div>			
		</div><!-- .author-description -->

	</div><!-- .author-info -->
<?php endif; ?>
	
	<?php // get post thumbnail url for background image
		$image_id = get_post_thumbnail_id();		
		$image_url = wp_get_attachment_image_src($image_id,'large', true); 
	?>	
	
<div class="top-content-wrap">
		
	<?php if(get_field('featured_image_alignment') && get_field('featured_image_size')):?>
		
		<?php 
			if( get_field('featured_image_alignment') == 'center' ):
				$bgposition = 'position-center';
			elseif( get_field('featured_image_alignment') == 'top'):
				$bgposition = 'position-top';
			elseif( get_field('featured_image_alignment') == 'bottom'):
				$bgposition = 'position-bottom';
			endif;

			if( get_field('featured_image_size') == 'full' ):
				$bgsize = 'size-cover';
			elseif( get_field('featured_image_size') == 'proportional'):
				$bgsize = 'size-proportional';
			endif;
		?>		

		<div class="top-content top-wrap <?php echo $bgposition; ?> <?php echo $bgsize; ?>" style="background-image:url(<?php echo $image_url[0];?>); <?php if(get_field('featured_image_background')):?> background-color:<?php the_field('featured_image_background');?>;<?php endif;?>"></div><!-- .top-content -->

	<?php else:?>

		<div class="top-content top-wrap size-cover position-center" style="background-image:url(<?php echo $image_url[0];?>);"></div><!-- .top-content -->

	<?php endif;?>
	
</div><!-- .top-content-wrap -->
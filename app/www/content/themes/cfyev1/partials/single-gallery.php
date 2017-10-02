<div class="carousel-wrap top-wrap">
	<?php $images = get_field('gallery_images'); if( $images ): ?>
			<div id="slider" class="single-carousel">
				
				<?php foreach( $images as $image ): ?>
					<div class="slide-image <?php if( get_field('gallery_size') == 'Proportional'):?>proportional<?php endif;?> " style="background-image:url(<?php echo $image['sizes']['large'];?>);"></div>								
				<?php endforeach; ?>

			</div><!-- #slider.single-carousel -->
			<div class="next-slide"><i class="slide-icon icon-angle-right"></i></div>
			<div class="prev-slide"><i class="slide-icon icon-angle-left"></i></div>
				<div id="slide-pager"></div>
	<?php endif;?>
</div><!-- .carousel-wrap -->
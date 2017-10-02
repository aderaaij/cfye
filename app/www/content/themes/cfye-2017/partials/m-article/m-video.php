<div class='e-fluidVideo'>
    <?php if( get_field('_slt_video_provider') == 'Youtube'):?>
    <iframe  src="//www.youtube.com/embed/<?php the_field('_slt_youtube');?>?rel=0;3&amp;autohide=1&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
    <?php elseif( get_field('_slt_video_provider') == 'Vimeo'):?>
    <iframe src="//player.vimeo.com/video/<?php the_field('_slt_vimeo');?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ec008c" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>		
    <?php elseif( get_field('_slt_video_provider') == 'Other'):?>
    <?php the_field('other');?>							
    <?php endif;?>
</div>
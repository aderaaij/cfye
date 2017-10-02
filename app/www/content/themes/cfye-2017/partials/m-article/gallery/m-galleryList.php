<?php
    $images = get_field('gallery_images');
    if( $images ):
?>
<div class='m-galleryList'>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
                <div class='m-galleryList__imageWrap'>
                <a class='no-barba m-galleryList__link' href="<?php echo $image['sizes']['large']; ?>">
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                </a>
                <p><?php echo $image['caption']; ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>   
</div> 
<?php endif; ?>  
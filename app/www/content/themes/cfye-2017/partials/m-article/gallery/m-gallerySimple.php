<?php
    $images = get_field('gallery_images');
    if( $images ):
?>
<div class='m-gallerySimple'>
    <ul>
        <?php foreach( $images as $image ): ?>
            <li>
                <div class='m-gallerySimple__imageWrap'>
                    <a class='no-barba m-gallerySimple__link' href="<?php echo $image['sizes']['large']; ?>">
                        <img class='m-gallerySimple__thumb' src="<?php echo $image['sizes']['900x600']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>
                    <p><?php echo $image['caption']; ?></p> 
                </div>
            </li>
        <?php endforeach; ?>
    </ul>   
</div>
<?php endif; ?>
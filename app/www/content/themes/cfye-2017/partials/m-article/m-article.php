<?php
$imageID = get_post_thumbnail_id();
$imageURLThumb = wp_get_attachment_image_src( $imageID, '100x100', true );
$imageURLLarge = wp_get_attachment_image_src( $imageID, 'large', true );
?>

<?php $text = preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', get_the_title() ) ?>

<article class='m-article'>
    
    <div class='m-article__hero'>
        <?php if ( is_sticky() ): ?>
        <div class='m-article__heroImage' data-src-large='<?php echo $imageURLLarge[0] ?>' style='background-image: url(<?php echo $imageURLLarge[0] ?>);'></div>
        <?php else: ?>
        <div class='m-article__heroImage' data-src-large='<?php echo $imageURLLarge[0] ?>' style='background-image: url(<?php echo $imageURLThumb[0] ?>);'></div>
        <?php endif; ?>
        <div class='m-article__titleWrap'>
            <h1 class='m-article__title'><?php echo $text ?></h1>
        </div>
    </div>

    <div class='m-article__content'>        
        <div class='m-article__entryContent'>    
            <?php the_content() ?>
        </div>
    </div>

    <?php if ( get_post_format( ) === 'video' ): ?>
    <div class='m-article__video'>
       <?php get_template_part( 'partials/m-article/m-video' ) ?>
    </div>
    <?php endif; ?>

    <?php if ( get_post_format( ) === 'gallery' ): ?>
    <div class='m-article__gallery'>
       
        <?php get_template_part( 'partials/m-article/gallery/m-gallerySimple' ) ?>
        
    </div>
    <?php endif; ?>
    <?php if ( get_field('artist_post') ): ?>
    <?php get_template_part( 'partials/m-article/m-artistBox' ) ?>
    <?php else: ?>
    <?php get_template_part( 'partials/m-article/m-authorBox' ) ?>
    <?php endif ?>
</article> 
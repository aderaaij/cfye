<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src( $thumb_id, 'large', true );
?>

<?php $text = preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', get_the_title()); ?>

<article class='m-article'>
    
    <div class='m-article__hero'>
        <div class='m-article__heroImage' style='background-image: url(<?php echo $thumb_url[0] ?>);'></div>
        <div class='m-article__titleWrap'>
            <h1 class='m-article__title'><?php echo $text ?></h1>
        </div>
    </div>

    <div class='m-article__content'>        
        <div class='m-article__entryContent'>    
            <?php the_content(); ?>
        </div>
    </div>

    <?php if(get_post_format( ) === 'video'): ?>
    <div class='m-article__video'>
       <?php get_template_part('partials/m-article/m-video') ?>
    </div>
    <?php endif; ?>

    <?php if(get_post_format( ) === 'gallery'): ?>
    <div class='m-article__gallery'>
       
        <?php get_template_part('partials/m-article/gallery/m-gallerySimple') ?>
        
    </div>
    <?php endif; ?>

    <?php get_template_part('partials/m-article/m-artistBox') ?>
</article>
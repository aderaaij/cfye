<?php get_header() ?>
<?php
$imageID = get_post_thumbnail_id();
$imageURLThumb = wp_get_attachment_image_src( $imageID, '100x100', true );
$imageURLLarge = wp_get_attachment_image_src( $imageID, 'large', true );
?>

<?php $text = preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', get_the_title() ) ?>

<article class='m-event'>
    <figure class='m-event__hero'>
        <?php the_post_thumbnail('large') ?>
    </figure>
    <div class='m-event__info'>
        <h1 class='m-event__title'>
            <?php the_title() ?>
        </h1>
        <div class='m-event__entryContent'>
            <?php the_content(); ?>
        </div>
    </div>
    <?php if ( get_post_format( ) === 'gallery' ): ?>
    <div class='m-article__gallery'>
       
        <?php get_template_part( 'partials/m-article/gallery/m-gallerySimple' ) ?>
        
    </div>
    <?php endif; ?>
    <?php if ( get_field('artist_post') ): ?>
    <?php get_template_part( 'partials/m-article/m-artistBox' ) ?>
    <?php else: ?>
    <?php if ( !is_singular( 'events' ) ): ?>
    <?php get_template_part( 'partials/m-article/m-authorBox' ) ?>
    <?php endif; ?>
    <?php endif ?>
</article>

<?php get_footer() ?>
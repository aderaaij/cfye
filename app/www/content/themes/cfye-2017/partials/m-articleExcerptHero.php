<?php
    $thumb_id = get_post_thumbnail_id();
    $imageID = get_post_thumbnail_id();
    $imageURLThumb = wp_get_attachment_image_src( $imageID, '100x100', true );
    $imageURLLarge = wp_get_attachment_image_src( $imageID, 'large', true );
    $thumb_small = wp_get_attachment_image_src( $thumb_id, 'medium', true );
    $thumb_900x600 = wp_get_attachment_image_src( $thumb_id, '900x600', true );
    $thumb_mediumLarge = wp_get_attachment_image_src( $thumb_id, 'medium_large', true );
    $thumb_large = wp_get_attachment_image_src( $thumb_id, 'large', true );
?>
<?php $title = preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', get_the_title()); ?>

<article 
    id="<?php the_ID();?>" 
    class='m-articleExcerptHero'
>
    <div class='m-articleExcerptHero__imageWrap'>
        <a 
            href="<?php the_permalink() ?>" 
            title="<?php the_title() ?>"   
            class="m-articleExcerptHero__image b-lazy"
            data-src="<?php echo $thumb_large[0] ?>"
            data-src-medium="<?php echo $thumb_900x600[0] ?>"
            data-src-small="<?php echo $thumb_mediumLarge[0] ?>"
            style="background-image:url(<?php echo $imageURLThumb[0] ?>"
        >
        </a>
        <noscript>
            <a 
                class="m-articleExcerptHero__image"
                href="<?php the_permalink() ?>" 
                title="<?php the_title() ?>" 
                style="background-image: url(<?php echo $thumb_large[0] ?>);">
            </a>
        </noscript>
    </div>
    <div class='m-articleExcerptHero__content'>
        <h2 class='m-articleExcerptHero__title'>
            <a 
                href="<?php the_permalink(); ?>" 
                title="<?php the_title(); ?>"
            >
                <?php echo $title ?>
            </a>
        </h2>
        <div class='m-articleExcerptHero__contentExcerpt'>
            <p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
        </div>
        <div class='m-articleExcerptHero__meta'>
            <ul>
                <li>
                    Author: 
                    <a href="<?php echo get_the_author_meta('url') ?>" rel="noopener" target="_blank" title="<?php echo get_the_author() ?>'s Website">
                        <?php echo get_the_author() ?>
                    </a>
                </li>
            </ul>                   
        </div>
    </div>
</article>
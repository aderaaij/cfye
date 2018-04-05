<?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_small = wp_get_attachment_image_src( $thumb_id, 'medium', true );
    $thumb_mediumLarge = wp_get_attachment_image_src( $thumb_id, 'medium_large', true );
    $thumb_large = wp_get_attachment_image_src( $thumb_id, '900x600', true );
?>
<?php $title = preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', get_the_title()); ?>

<article 
    id="<?php the_ID();?>" 
    class='m-articleExcerpt'
>
    <a 
        href="<?php the_permalink() ?>" 
        title="<?php the_title() ?>"                  
        class="m-articleExcerpt__link"
    >
        <div class='m-articleExcerpt__imageWrap'>
            <div
                data-src="<?php echo $thumb_large[0] ?>"
                data-src-small="<?php echo $thumb_small[0] ?>" 
                data-src-medium="<?php echo $thumb_mediumLarge[0]; ?>"                     
                class="m-articleExcerpt__image b-lazy"
            >
            </div>
          
        </div>
        
        <div class='m-articleExcerpt__content'>
            <h2 class='m-articleExcerpt__title'>
                <?php echo $title ?>
            </h2>
            <div class='m-articleExcerpt__contentExcerpt'>
                <p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
            </div>
            <div class='m-articleExcerpt__meta'>
                <?php $authID = get_the_author_meta( 'ID' ) ?>
                <ul>
                    <li>
                        Author: <?php echo get_the_author() ?>
                    </li>
                </ul>                   
            </div>
        </div>
    </a>
</article>
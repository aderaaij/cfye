<?php get_header() ?>
<?php $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); ?>
<?php $authorID = get_the_author_meta( 'ID' ) ?>
<?php $authorUser = 'user_'. $authorID ?>
<?php $image = get_field( 'header_image', $authorUser ) ?>
<?php $thumb = get_field( 'user_thumb', $authorUser ) ?>

<article class='m-artistProfile'> 
    <header class='m-artistProfile__header'>
        <figure class='m-artistProfile__image' style='background-image:url(<?php echo $image['sizes']['large'] ?>);'>
        </figure>
        <div class='m-artistProfile__titleWrap'>
            <h1 class='m-artistProfile__title'><?php echo $curauth->display_name; ?></h1>
        </div>
    </header>
    
    <div class='m-artistProfile__content'>
        <div class='m-artistProfile__thumb'>
            <img width="150" height="150" src="<?php echo $thumb['sizes']['thumbnail'] ?>"/>
        </div>
        <div class='m-artistProfile__entryContent'>
        <p><?php the_author_meta('description', $authorID) ?></p>
        </div>
        <ul class="m-artistProfile__socialList">
            <?php if ( get_field( 'website', $authorUser ) ) : ?>
            <li>
                <a href="<?php the_field( 'website', $authorUser ) ?>" title="Visit <?php the_author_meta('display_name', $authorID) ?>'s website" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-link"></use>
                    </svg>
                </a>
            </li>
            <?php endif ?>	
            <?php if ( get_field( 'facebook', $authorUser ) ) : ?>
            <li>
                <a href="<?php the_field( 'facebook', $authorUser ) ?>" title="Like <?php the_author_meta('display_name', $authorID) ?> on Facebook" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook"></use>
                    </svg>
                </a>
            </li>
            <?php endif ?>				
            <?php if ( get_field( 'twitter', $authorUser ) ) : ?>
            <li>
                <a href="https://twitter.com/<?php the_field( 'twitter', $authorUser ) ?>" title="Follow <?php the_author_meta('display_name', $authorID) ?> on Twitter" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter"></use>
                    </svg>
                </a>
            </li>
            <?php endif ?>
            <?php if ( get_field( 'flickr', $authorUser ) ) : ?>
            <li>
                <a href="https://flickr.com/photos/<?php the_field( 'flickr', $authorUser ) ?>" title="<?php the_author_meta('display_name', $authorID) ?> on Flickr" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-flickr"></use>
                    </svg>
                </a>
            </li>
            <?php endif ?>
            <?php if ( get_field( 'tumblr', $authorUser ) ) : ?>
            <li>
                <a href="<?php the_field( 'tumblr', $authorUser ) ?>" title="<?php the_author_meta('display_name', $authorID) ?> on Tumblr" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-tumblr"></use>
                    </svg>
                </a>
            </li>
            <?php endif ?>
            <?php if ( get_field( 'instagram', $authorUser ) ) : ?>
            <li>
                <a href="https://instagram.com/<?php the_field( 'instagram', $authorUser ) ?>" title="Follow <?php the_author_meta('display_name', $authorID) ?> on Instagram" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram"></use>
                    </svg>
                </a>
            </li>
            <?php endif ?>
        </ul>

        <?php if ( have_posts() ) : ?>
        <div class='m-artistProfile__related'>
            <h3 class='m-artistProfile__related-title'>Articles</h3>				
            <ul>
            <?php while ( have_posts() ) : the_post() ?>            
                <li class='m-artistProfile__related-item'>
                    <a class='m-artistProfile__related-link' href="<?php the_permalink();?>" title="<?php the_title();?>">
                        <div class='m-artistProfile__related-thumb'>
                            <?php the_post_thumbnail( $size = 'thumbnail', $attr = '' );?>						
                        </div>
                        <div class='m-artistProfile__related-content'>
                            <h3>
                                <?php echo mb_strimwidth(get_the_title(), 0, 45, '...'); ?>
                            </h3>
                            <span class="entry-meta"><?php echo get_the_date() ?></span>
                            <p><?php echo wp_trim_words( get_the_content(), 10, '...' ); ?></p>
                        </div>
                    </a>
                </li>
            <?php endwhile ?>
            </ul>            	
        </div>	
        <?php endif ?>
    </div>
</article>


<?php get_footer() ?>
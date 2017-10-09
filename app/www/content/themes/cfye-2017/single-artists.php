<?php get_header() ?>
<?php $image = get_field('header_image'); ?>

<article class='m-artistProfile'> 
    <header class='m-artistProfile__header'>
        <figure class='m-artistProfile__image' style='background-image:url(<?php echo $image['sizes']['large'] ?>);'>
        </figure>
        <div class='m-artistProfile__titleWrap'>
            <h1 class='m-artistProfile__title'><?php the_title(); ?></h1>
        </div>
    </header>
    
    <div class='m-artistProfile__content'>
        <div class='m-artistProfile__thumb'>
            <?php the_post_thumbnail( $size = 'thumbnail', $attr = '' );?>
        </div>
        <div class='m-artistProfile__entryContent'>
            <?php the_field('artist_description') ?>
        </div>
        <ul class="m-artistProfile__socialList">
            <?php if(get_field('_slt_website')):?>
            <li>
                <a href="<?php the_field('_slt_website');?>" title="Visit <?php echo $artistname;?> Website" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-link"></use>
                    </svg>
                </a>
            </li>
            <?php endif;?>	
            <?php if(get_field('_slt_facebookid')):?>
            <li>
                <a href="<?php the_field('_slt_facebookid');?>" title="Like <?php echo $artistname;?> on Facebook" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-facebook"></use>
                    </svg>
                </a>
            </li>
            <?php endif;?>				
            <?php if(get_field('_slt_twitterid')):?>
            <li>
                <a href="https://twitter.com/<?php the_field('_slt_twitterid');?>" title="Follow <?php echo $artistname;?> on Twitter" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-twitter"></use>
                    </svg>
                </a>
            </li>
            <?php endif;?>
            <?php if(get_field('flickr_username')):?>
            <li>
                <a href="https://flickr.com/photos/<?php the_field('flickr_username');?>" title="<?php echo $artistname;?> on Flickr" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-flickr"></use>
                    </svg>
                </a>
            </li>
            <?php endif;?>
            <?php if(get_field('_slt_tumblrid')):?>
            <li>
                <a href="<?php the_field('_slt_tumblrid');?>" title="<?php echo $artistname;?> on Tumblr" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-tumblr"></use>
                    </svg>
                </a>
            </li>
            <?php endif;?>
            <?php if(get_field('_slt_instagram')):?>
            <li>
                <a href="https://instagram.com/<?php the_field('_slt_instagram');?>" title="Follow <?php echo $artistname;?> on Instagram" target="_blank" rel="noopener">
                    <svg class="m-social__icon" viewbox="0 0 32 32">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/assets/img/sprite.svg#icon-instagram"></use>
                    </svg>
                </a>
            </li>
            <?php endif;?>
        </ul>

        <?php
            $posts = get_field('related_articles'); 	
            $number = count($posts);
            if(  $posts ):  
        ?>
        <div class='m-artistProfile__related'>
            <h3 class='m-artistProfile__related-title'>Articles</h3>				
            <ul>
            <?php foreach( $posts as $post): ?>
            <?php setup_postdata( $post) ?>
                <li class='m-artistProfile__related-item'>
                    <a class='m-artistProfile__related-link' href="<?php the_permalink();?>" title="<?php the_title();?>">
                        <div class='m-artistProfile__related-thumb'>
                            <?php the_post_thumbnail( $size = 'thumbnail', $attr = '' );?>						
                        </div>
                        <div class='m-artistProfile__related-content'>
                            <h3>
                                <?php the_title();?>
                            </h3>
                            <span class="entry-meta"><?php echo get_the_date() ?></span>
                            <p><?php echo get_excerpt('100') ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach ?>
            </ul>        
            <?php wp_reset_postdata() ?>	
        </div>	
        <?php endif ?>
    </div>
</article>


<?php get_footer() ?>
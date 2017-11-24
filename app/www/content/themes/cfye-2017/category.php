<?php get_header() ?>

<?php if ( have_posts() ) : $postCount = 0 ?>
    <?php while ( have_posts() ) : the_post() ?>       
        <?php get_template_part('partials/m-articleExcerpt') ?>  
    <?php endwhile ?>
<?php endif ?>

<?php get_footer() ?>
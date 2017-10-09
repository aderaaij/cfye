<?php get_header() ?>

<?php if ( is_home()  ) : ?>
    <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post() ?>

        <?php get_template_part('partials/m-articleExcerpt') ?>

        <?php endwhile; ?>
    <?php endif; ?>
<?php endif ?>

<?php get_footer() ?>
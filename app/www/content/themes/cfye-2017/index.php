<?php get_header() ?>

<?php if ( is_home()  ) : ?>
    <?php if ( have_posts() ) : $postCount = 0;
        while ( have_posts() ) : the_post(); $postCount++; ?>
        <?php if($postCount == 1): ?>
        <?php get_template_part('partials/m-articleExcerptHero') ?>
        <?php else: ?>
        <?php get_template_part('partials/m-articleExcerpt') ?>
        <?php endif ?>
        <?php endwhile; ?>
    <?php endif; ?>
<?php endif ?>

<?php get_footer() ?>
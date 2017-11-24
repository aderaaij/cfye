<?php get_header() ?>
<?php the_title() ?>
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post() ?>
        <?php the_title() ?>

        <?php 
        $args = array(
            'post_type'           => 'events',
            'posts_per_page'      => -1,
        ); ?>
        <?php $query = new WP_Query( $args ); ?>
        <?php if ( $query->have_posts() ): ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
        <article>
            <h1><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h1>
        </article>
        <?php endwhile; ?>
        <?php endif ?>
    <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>
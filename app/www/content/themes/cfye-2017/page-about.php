<?php get_header() ?>
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src( $thumb_id, 'large', true );
?>

<div class='m-aboutPage'>
    <article class='m-aboutPage__about m-aboutPage__about--first'>
        <div class='m-aboutPage__image' style='background-image: url(<?php echo $thumb_url[0] ?>)'></div>
        <div class='m-aboutPage__content'>
            <h1 class='m-aboutPage__title'><?php the_title() ?></h1>
            <div class='m-aboutPage__entryContent'>
                <?php the_content() ?>
            </div>
        </div>
    </article>
    <!-- <article class='m-aboutPage__about'>
        <div class='m-aboutPage__content'>
            <h1 class='m-aboutPage__title'><?php the_title() ?></h1>
            <div class='m-aboutPage__entryContent'>
                <?php the_content() ?>
            </div>
        </div>
        <div class='m-aboutPage__image' style='background-image: url(<?php echo $thumb_url[0] ?>)'></div>
    </article> -->



<?php get_footer() ?>
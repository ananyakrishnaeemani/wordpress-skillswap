<?php get_header(); ?>

<div class="skill-post">
    <h1><?php the_title(); ?></h1>
    <div class="skill-content">
        <?php the_content(); ?>
    </div>

    <div class="skill-rating">
        <?php echo do_shortcode('[skill_rating]'); ?>
    </div>
</div>

<?php get_footer(); ?>

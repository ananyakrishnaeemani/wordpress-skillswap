<?php get_header(); ?>

<h1>Welcome to SkillSwap</h1>

<?php
$args = array(
    'post_type' => 'skill',
    'post_status' => array('publish', 'pending'),
    'posts_per_page' => 10
);

$skills = new WP_Query($args);

if ($skills->have_posts()) :
    while ($skills->have_posts()) : $skills->the_post(); ?>
        <div class="skill-post">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_excerpt(); ?></div>
        </div>
    <?php endwhile;
    wp_reset_postdata();
else :
    echo "<p>No skills found.</p>";
endif;
?>

<?php get_footer(); ?>

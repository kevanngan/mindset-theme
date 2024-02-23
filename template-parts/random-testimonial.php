<?php
// Query a random testimonial
$testimonial_query = new WP_Query(array(
    'post_type' => 'fwd-testimonial',
    'posts_per_page' => 1,
    'orderby' => 'rand',
));

// Check if there are testimonials
if ($testimonial_query->have_posts()) :
    while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
        ?>
        <div class="testimonial">
            <h3><?php the_title(); ?></h3>
            <div class="testimonial-content"><?php the_content(); ?></div>
        </div>
        <?php
    endwhile;
    // Reset post data
    wp_reset_postdata();
else :
    // No testimonials found
    echo 'No testimonials found.';
endif;
?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
<?php
$taxonomy = 'fwd-service-category';
$terms    = get_terms(
    array(
        'taxonomy' => $taxonomy
    )
);
if($terms && ! is_wp_error($terms) ){
    foreach($terms as $term){
        $args = array(
            'post_type'      => 'fwd-service',
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'orderby'        => 'title',
            'tax_query'      => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $term->slug,
                )
            ),
        );
         
        $query = new WP_Query( $args );
         
        if ( $query -> have_posts() ) {
            // Output Term name.
            echo '<h2>' . esc_html( $term->name ) . '</h2>';
         
            // Output Navigation.
            while ( $query -> have_posts() ) {
                $query -> the_post();
                echo '<a href="#'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</a>';
            }
            wp_reset_postdata();
         
            // Output Content.
            while ( $query -> have_posts() ) {
                $query -> the_post();
         
                if ( function_exists( 'get_field' ) ) {
                    if ( get_field( 'service_text' ) ) {
                        echo '<h4 id="'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</h4>';
                        the_field( 'service_text' );
                    }
                }
         
            }
            wp_reset_postdata();
        }
    }
}
?>

    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', 'page');
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
    endwhile; // End of the loop.
    ?>

    <?php
    $args = array(
        'post_type'      => 'fwd-service',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        ?>
        <nav class="service-navigation">
            <ul>
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <li><a href="#service-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </ul>
        </nav>
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <article id="service-<?php echo get_the_ID(); ?>">
                <h2><?php the_title(); ?></h2>
                <?php
                $service_content = get_field('service_cpt');
                if ($service_content) {
                    echo '<div class="service-cpt">' . $service_content . '</div>';
                }
                ?>
            </article>
            <?php
        }
        wp_reset_postdata();
    }
    ?>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
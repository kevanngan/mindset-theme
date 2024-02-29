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

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>

                <!-- Navigation Links -->
                <nav class="service-navigation">
                    <ul>
                        <?php
                        $args = array(
                            'post_type'      => 'fwd-service',
                            'posts_per_page' => -1,
                            'order'          => 'ASC',
                            'orderby'        => 'title'
                        );
                        $query = new WP_Query( $args );
                        
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                        ?>
                                <li><a href="#service-<?php the_ID(); ?>"><?php the_title(); ?></a></li>
                        <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </ul>
                </nav>

                <?php
                $terms = get_terms( 
                    array(
                        'taxonomy' => 'fwd-service-category',
                    ) 
                );
                if ( $terms && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        echo '<h2>' . esc_html( $term->name ) . '</h2>';

                        $args = array(
                            'post_type'      => 'fwd-service',
                            'posts_per_page' => -1,
                            'order'          => 'ASC',
                            'orderby'        => 'title',
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'fwd-service-category',
                                    'field'    => 'slug',
                                    'terms'    => $term->slug,
                                ),
                            ),
                        );
                        $query = new WP_Query( $args );
                        
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                ?>
                                <section id="service-<?php the_ID(); ?>">
                                    <h3><?php the_title(); ?></h3>
                                    <?php
                                    if ( function_exists( 'get_field' ) && get_field( 'service_cpt' ) ) {
                                        the_field( 'service_cpt' );
                                    }
                                    ?>
                                </section>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                    }
                }
                ?>
            </div>

        </article>

    <?php endwhile; ?>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>

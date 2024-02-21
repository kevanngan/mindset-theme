<?php
/**
 * The template for displaying the home page of the website
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			// get_template_part( 'template-parts/content', 'page' );
			?>
	
			<section class="home-intro">
				<?php the_post_thumbnail(); ?>
			</section>

			<section class="home-work"></section>

			<section class="home-work"></section>

			<section class="home-left"></section>

			<section class="home-right"></section>

			<section class="home-sldier"></section>
			
			<section class="home-blog">
				<h2><?php esc_html_e( 'Latest Blog Posts', 'fwd');?></h2>
				<?php
				$args = array(
					'posts_type' 	 => 'posts',
					'posts_per_page' => 4
				);
				$blog_query = new WP_Query( $args );
				if ( $blog_query -> have_posts() ) {
					while ( $blog_query -> have_posts() ) {
                        $blog_query -> the_post();
                        ?>
						<article>
							<h3>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<p><?php echo get_the_date(); ?></p>
							<?php if ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail( 'latest-blog-post-image' ); ?>
							<?php } ?>
						</article>
						<?php
                    }
					wp_reset_postdata();
				}
				?>
			</section>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
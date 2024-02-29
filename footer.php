<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FWD_Starter_Theme
 */

?>

	<footer id="colophon" class="site-footer">
	<button id="scroll-to-top-btn" class="scroll-to-top-btn">Scroll To Top</button>
		<div class="footer-contact">	
			<?php
			if ( function_exists( 'get_field' ) ) {
				if ( ! is_page('contact') ) {
					if ( get_field('physical_address', 6) ) {
						echo '<div class="footer-contact-left">';
							get_template_part( 'images/location' );
							the_field('physical_address', 6);
						echo '</div>';
					}
					if ( get_field('email_address', 6) ) {
						$email  = get_field( 'email_address', 6 );
						$mailto = 'mailto:' . $email;
						?>
						<div class="footer-contact-right">
							<p><a href="<?php echo esc_url( $mailto ); ?> "><?php echo esc_html( $email ); ?></a></p>
						</div>
						<?php
					}
				}
			}
			?>
			
		</div><!-- .footer-contact -->
		<div class="footer-menus">
			<nav id="footer-navigation" class="footer-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-left') ); ?>
				<?php the_privacy_policy_link(); ?>
			</nav>
			<nav id="footer-navigation" class="footer-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-socials') ); ?>
			</nav>
		</div><!-- .footer-menus -->
		<div class="site-info">
			<?php esc_html_e( 'Created by ', 'fwd' ); ?><a href="<?php echo esc_url( __( 'https://wp.bcitwebdeveloper.ca/', 'fwd' ) ); ?>"><?php esc_html_e( 'Jonathon Leathers', 'fwd' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

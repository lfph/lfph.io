<?php
/**
 * Footer
 *
 * Use in templates to call the footer - it also calls WordPress footer.
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

$options = get_option( 'cncf-mu' );
?>

<footer class="footer">
	<div class="container wrap copyright-social-wrapper">

			<?php // get_template_part( 'components/social-links' ); //phpcs:ignore. ?>

			<div class="copyright-text">
				<p class="smaller-text">Copyright &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
					<?php echo wp_kses_post( $options['copyright_textarea'] ); ?>
				</p>
			</div>

	</div>
</footer>
<?php // get_template_part( 'components/back-to-top' ); //phpcs:ignore. ?>
<?php // get_template_part( 'components/cookie-banner' );  //phpcs:ignore. ?>
<?php get_footer(); ?>

<?php
/**
 * Header
 *
 * Header section - can contain the navigation.
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

get_header();

$image   = new Image();
$options = get_option( 'cncf-mu' );

if ( $options['show_hello_bar'] ) :
	get_template_part( 'components/hello-bar' );
endif;
?>

<header class="site-header">
	<div class="container wrap">

		<?php if ( $options['header_image_id'] ) { ?>
		<div class="logo">
			<a href="/" title="<?php echo bloginfo( 'name' ); ?>">
				<?php // TODO: replace with SVG in-line from theme. ?>
				<img src="<?php echo esc_url( wp_get_attachment_url( $options['header_image_id'] ) ); ?>"
					height="38" alt="<?php echo bloginfo( 'name' ); ?>">
			</a>
			<?php } ?>
		</div>

		<button class="hamburger hamburger--spin" type="button" aria-label="Toggle Menu">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>

		
	</div>
</header>

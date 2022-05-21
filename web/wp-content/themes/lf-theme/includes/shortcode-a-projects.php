<?php
/**
 * Projects Shortcode
 *
 * @package WordPress
 * @subpackage lf-theme
 * @since 1.0.0
 */

 /**
  * Add Projects shortcode.
  *
  * @param array $atts Attributes.
  */
function add_all_projects_shortcode( $atts ) {

	$query_args = array(
		'post_type'      => 'lf_project',
		'post_status'    => array( 'publish' ),
		'posts_per_page' => 100,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);

	$project_query = new WP_Query( $query_args );
	ob_start();
	if ( $project_query->have_posts() ) {
		?>

<div class="projects-wrapper">
		<?php
		while ( $project_query->have_posts() ) :
			$project_query->the_post();

			$external_url = get_post_meta( get_the_ID(), 'lf_project_external_url', true );

			$date_accepted = get_post_meta( get_the_ID(), 'lf_project_date_accepted', true ) ? ' (accepted to LFPH on ' . gmdate( 'n/j/Y', strtotime( get_post_meta( get_the_ID(), 'lf_project_date_accepted', true ) ) ) . ')' : '';

			$project_category = get_post_meta( get_the_ID(), 'lf_project_category', true );

			$github = get_post_meta( get_the_ID(), 'lf_project_github', true );

			$stack_overflow = get_post_meta( get_the_ID(), 'lf_project_stack_overflow', true );

			$devstats = get_post_meta( get_the_ID(), 'lf_project_devstats', true );

			$logos = get_post_meta( get_the_ID(), 'lf_project_logos', true );

			$mail = get_post_meta( get_the_ID(), 'lf_project_mail', true );

			$blog = get_post_meta( get_the_ID(), 'lf_project_blog', true );

			$twitter = get_post_meta( get_the_ID(), 'lf_project_twitter', true );

			$slack = get_post_meta( get_the_ID(), 'lf_project_slack', true );

			$youtube = get_post_meta( get_the_ID(), 'lf_project_youtube', true );

			$gitter = get_post_meta( get_the_ID(), 'lf_project_gitter', true );

			$logo = get_post_meta( get_the_ID(), 'lf_project_logo', true );

			$image = new Image();

			?>
	<div class="project-box">
	<a href="<?php the_permalink(); ?>"
			title="<?php echo esc_html( the_title_attribute() . $date_accepted ); ?>"
			class="project-thumbnail-container">

			<img src="<?php echo esc_url( $logo ); ?>" loading="lazy"
				title="<?php echo esc_html( the_title_attribute() . $date_accepted ); ?>"
				class="project-thumbnail">
		</a>

			<?php if ( $project_category ) : ?>
	<span class="project-category">
				<?php echo esc_html( $project_category ); ?></span>
	<?php endif; ?>

	<div class="project-icons">

			<?php if ( $github ) : ?>
		<a title="<?php the_title(); ?> on Github"
			href="<?php echo esc_html( $github ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/github.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $devstats ) : ?>
		<a title="<?php the_title(); ?> on DevStats"
			href="<?php echo esc_html( $devstats ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/lf-devstats.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $logos ) : ?>
		<a title="<?php the_title(); ?> Logos"
			href="<?php echo esc_html( $logos ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/lf-artwork.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $stack_overflow ) : ?>
		<a title="<?php the_title(); ?> on Stack Overflow"
			href="<?php echo esc_html( $stack_overflow ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/stack-overflow.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $twitter ) : ?>
		<a title="<?php the_title(); ?> on Twitter"
			href="<?php echo esc_html( $twitter ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/twitter.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $blog ) : ?>
		<a title="<?php the_title(); ?> Blog"
			href="<?php echo esc_html( $blog ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/blog.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $mail ) : ?>
		<a title="<?php the_title(); ?> Contact"
			href="<?php echo esc_html( $mail ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/email.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $slack ) : ?>
		<a title="<?php the_title(); ?> Slack"
			href="<?php echo esc_html( $slack ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/slack.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $youtube ) : ?>
		<a title="<?php the_title(); ?> on YouTube"
			href="<?php echo esc_html( $youtube ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/youtube.svg' ); ?></a>
		<?php endif; ?>

			<?php if ( $gitter ) : ?>
		<a title="<?php the_title(); ?> on Gitter"
			href="<?php echo esc_html( $gitter ); ?>" rel="noopener"
			target="_blank"><?php $image->get_svg( '/social/gitter.svg' ); ?></a>
		<?php endif; ?>

	</div>

</div>
			<?php
		endwhile;
		wp_reset_postdata();
	}
	?>
</div>
	<?php
	$block_content = ob_get_clean();
	return $block_content;
}
add_shortcode( 'all-projects', 'add_all_projects_shortcode' );

<?php
/**
 * Single project page template.
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

$logo = get_post_meta( get_the_ID(), 'lf_project_logo', true );

$stage            = Lf_Utils::get_term_names( get_the_ID(), 'lf-project-stage', true );
$description      = get_post_meta( get_the_id(), 'lf_project_description', true );
$project_category = get_post_meta( get_the_ID(), 'lf_project_category', true );
$external_url     = get_post_meta( get_the_ID(), 'lf_project_external_url', true );

$date_accepted = get_post_meta( get_the_ID(), 'lf_project_date_accepted', true ) ? gmdate( 'F j, Y', strtotime( get_post_meta( get_the_ID(), 'lf_project_date_accepted', true ) ) ) : '';

// Links for Project.
$github         = get_post_meta( get_the_ID(), 'lf_project_github', true );
$stack_overflow = get_post_meta( get_the_ID(), 'lf_project_stack_overflow', true );
$devstats       = get_post_meta( get_the_ID(), 'lf_project_devstats', true );
$logos          = get_post_meta( get_the_ID(), 'lf_project_logos', true );
$mail           = get_post_meta( get_the_ID(), 'lf_project_mail', true );
$blog           = get_post_meta( get_the_ID(), 'lf_project_blog', true );
$twitter        = get_post_meta( get_the_ID(), 'lf_project_twitter', true );
$slack          = get_post_meta( get_the_ID(), 'lf_project_slack', true );
$youtube        = get_post_meta( get_the_ID(), 'lf_project_youtube', true );
$gitter         = get_post_meta( get_the_ID(), 'lf_project_gitter', true );

$project_slug = strtolower( get_the_title() );

?>

<main class="projects-single">
	<article class="container wrap">

		<div class="projects-single-box lf-grid">
			<!-- column 1 -->
			<div class="projects-single-box__col1">

				<a class="projects-single-box__link"
					href="<?php echo esc_url( $external_url ); ?>"><img
						src="<?php echo esc_url( $logo ); ?>" loading="lazy"
						title="Visit <?php echo esc_html( the_title_attribute() ); ?> website"
						class="projects-single-box__image"></a>
			</div>

			<!-- column 2 -->
			<div class="projects-single-box__col2">
				<?php if ( $description ) { ?>
				<h2 class="projects-single-box__description">
					<?php echo esc_html( $description ); ?>
				</h2>
				<div style="height:20px" aria-hidden="true"
					class="wp-block-spacer">
				</div>
					<?php
				}

				if ( $date_accepted ) {
					?>
				<p class="projects-single-box__accepted">
					<?php the_title(); ?>&nbsp;was accepted to CNCF on
					<strong><?php echo esc_html( $date_accepted ); ?></strong>
				</p>
					<?php
				}
				?>

				<div style="height:60px" aria-hidden="true"
					class="wp-block-spacer is-style-60-responsive">
				</div>

				<div class="projects-single-box__links">

					<?php if ( $external_url ) : ?>

					<div class="wp-block-button is-style-reduced-height"><a
							href="<?php echo esc_url( $external_url ); ?>"
							class="wp-block-button__link">Visit Project
							Website</a></div>
						<?php
endif;
					?>
					<div class="projects-single-box__icons">

						<?php if ( $github ) : ?>
						<a title="<?php the_title_attribute(); ?> on Github"
							href="<?php echo esc_html( $github ); ?>"><?php LF_utils::get_svg( '/social/boxed-github.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $devstats ) : ?>
						<a title="<?php the_title_attribute(); ?> on DevStats"
							href="<?php echo esc_html( $devstats ); ?>"><?php LF_utils::get_svg( '/social/boxed-lf-devstats.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $logos ) : ?>
						<a title="<?php the_title_attribute(); ?> Logos"
							href="<?php echo esc_html( $logos ); ?>"><?php LF_utils::get_svg( '/social/boxed-lf-artwork.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $stack_overflow ) : ?>
						<a title="<?php the_title_attribute(); ?> on Stack Overflow"
							href="<?php echo esc_html( $stack_overflow ); ?>"><?php LF_utils::get_svg( '/social/boxed-stack-overflow.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $twitter && ( preg_match( '/^https?:\/\/(www\.)?twitter\.com\/(#!\/)?(?<name>[^\/]+)(\/\w+)*$/', $twitter, $matches ) ) && ( 'CloudNativeFdn' != $matches['name'] ) ) : ?>
						<a title="<?php the_title_attribute(); ?> on Twitter"
							href="<?php echo esc_html( $twitter ); ?>"><?php LF_utils::get_svg( '/social/boxed-twitter.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $blog ) : ?>
						<a title="<?php the_title_attribute(); ?> Blog"
							href="<?php echo esc_html( $blog ); ?>"><?php LF_utils::get_svg( '/social/boxed-blog.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $mail ) : ?>
						<a title="<?php the_title_attribute(); ?> Discussion Group"
							href="<?php echo esc_html( $mail ); ?>"><?php LF_utils::get_svg( '/social/boxed-email.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $slack ) : ?>
						<a title="<?php the_title_attribute(); ?> Slack"
							href="<?php echo esc_html( $slack ); ?>"><?php LF_utils::get_svg( '/social/boxed-slack.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $youtube ) : ?>
						<a title="<?php the_title_attribute(); ?> on YouTube"
							href="<?php echo esc_html( $youtube ); ?>"><?php LF_utils::get_svg( '/social/boxed-youtube.svg' ); ?></a>
						<?php endif; ?>

						<?php if ( $gitter ) : ?>
						<a title="<?php the_title_attribute(); ?> on Gitter"
							href="<?php echo esc_html( $gitter ); ?>"><?php LF_utils::get_svg( '/social/boxed-gitter.svg' ); ?></a>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>

		<div style="height:100px" aria-hidden="true"
			class="wp-block-spacer is-style-100-responsive"></div>
		<?php
		// NEWS.

		$related_args = array(
			'posts_per_page'     => 3,
			'ignore_custom_sort' => true,
			'post_type'          => array( 'post' ),
			'post_status'        => array( 'publish' ),
			'order'              => 'DESC',
			'orderby'            => 'date',
			'no_found_rows'      => true,
			's'                  => $project_slug,
		);

		$related_query = new WP_Query( $related_args );

		if ( $related_query->have_posts() ) :
			?>
			<div class="wp-container-3 wp-block-group alignfull has-tertiary-background-color has-background"><div class="wp-block-group__inner-container">
			<div class="wp-container-2 wp-block-group"><div class="wp-block-group__inner-container">
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer is-style-40-responsive"></div>

			<div class="wp-block-columns is-style-section-header">
			<div class="wp-block-column bh-01" style="flex-basis:70%">	
			<h3>Recent <?php the_title(); ?> news</h3>
			</div>

			<div class="wp-block-column bh-02" style="flex-basis:30%">
			<h6 class="is-style-add-chevron-after">
				<a href="<?php echo esc_url( '/?post_type=post&s=' . $project_slug ); ?>">See all news</a></h6>
			</div>
			</div>

			<section class="wp-block-lf-newsroom is-style-horizontal has-images-border">

				<?php
				while ( $related_query->have_posts() ) {
					$related_query->the_post();
					Lf_Utils::newsroom_show_post( get_the_ID(), true, false );
				}
				?>

			</section>

			<div style="height:60px" aria-hidden="true" class="wp-block-spacer is-style-60-responsive"></div>
			</div></div>
			</div></div>
		<div style="height:80px" aria-hidden="true"
			class="wp-block-spacer is-style-80-responsive"></div>
			<?php
			wp_reset_postdata();
endif;
		?>

		<?php
		// TWITTER.
		// Check if Twitter is present, parses username, checks if not LFPH account.
		if ( $twitter && ( preg_match( '/^https?:\/\/(www\.)?twitter\.com\/(#!\/)?(?<name>[^\/]+)(\/\w+)*$/', $twitter, $matches ) ) && ( 'LFPubHealth' !== $matches['name'] ) ) :

			// Only continue if some tweets are returned.
			$out = do_shortcode( '[custom-twitter-feeds num=8 layout=masonry includeretweets=false showheader=true showbutton=false masonrycols=4 masonrymobilecols=1 screenname="' . esc_html( $matches['name'] ) . '"]' );
			if ( ! strpos( $out, 'Unable to load Tweets' ) ) :
				?>
		<div class="wp-block-group is-style-no-padding is-style-see-all">

			<div class="wp-block-columns is-style-section-header">
			<div class="wp-block-column bh-01" style="flex-basis:70%">	
			<h3>Latest tweets from <?php the_title(); ?></h3>
			</div>

			<div class="wp-block-column bh-02" style="flex-basis:30%">
			<h6 class="is-style-add-chevron-after">
			<a href="<?php echo esc_url( $twitter ); ?>">See all tweets</a></h6>
			</div>
			</div>

			<div style="height:40px" aria-hidden="true"
				class="wp-block-spacer is-style-40-responsive"></div>

				<?php
		echo $out; //phpcs:ignore
				?>
			<div style="height:40px" aria-hidden="true"
				class="wp-block-spacer is-style-40-responsive"></div>
		</div>
				<?php

		endif;
endif;
		?>

	</article>
</main>

<?php
/**
 * Front page
 *
 * Template for the front page (home).
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

get_template_part( 'components/header' );

?>

<main class="page-content">
	<article class="container wrap entry-content">

		<section class="front-hero alignfull ">

			<div class="container wrap front-hero-wrapper">
				<img src="/wp-content/themes/cncf-theme/images/lfph/lfph-horizontal-long-white.svg"
					alt="Linux Foundation Public Health" class="lfph-logo">

				<figure class="front-hero-main-image">
					<img sizes="(max-width: 2000px) 100vw, 2000px" srcset="
/wp-content/themes/cncf-theme/images/lfph/faces-w_300.png 300w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_520.png 520w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_690.png 690w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_838.png 838w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_964.png 964w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1090.png 1090w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1205.png 1205w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1311.png 1311w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1416.png 1416w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1511.png 1511w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1609.png 1609w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1700.png 1700w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1792.png 1792w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1878.png 1878w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1961.png 1961w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_1999.png 1999w,
/wp-content/themes/cncf-theme/images/lfph/faces-w_2000.png 2000w"
						src="/wp-content/themes/cncf-theme/images/lfph/faces-w_2000.png"
						alt="LFPH" width="300px" height="120px">

				</figure>
				<h2>Linux Foundation Public Health will be launching in June</h2>

				<p class="front-hero-small">You can contact us at <a
						href="mailto:info@lfph.io">info@lfph.io</a></p>

				<?php get_template_part( 'components/newsletter' ); ?>

			</div>


		</section>
	</article>
</main>

<?php

get_template_part( 'components/footer' );

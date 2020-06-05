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

$options = get_option( 'cncf-mu' );
?>

<main class="page-content lfph-holding">
	<article class="container wrap">

		<!-- breakout image container -->
		<section
			class="alignwide background-image-wrapper lfph-logo-image-container">

			<figure class="background-image-figure">
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

			<!-- logo  -->
			<div class="background-image-text-overlay">
				<img src="/wp-content/themes/cncf-theme/images/lfph/lfph-horizontal-white.svg"
					alt="Linux Foundation Public Health" class="lfph-logo">
			</div>
		</section>

		<div class="container">
			<h2 class="launch-header">Launching in late June</h2>
			<p class="contact-text">You can contact us at <a
					href="mailto:info@lfph.io">info@lfph.io</a></p>
			<p class="subscribe-text">Subscribe to
				the LFPH newsletter to receive updates as they
				become available.</p>

			<!-- form  -->

			<form id="sfmc-form1" class="newsletter-form"
				action="https://cloud.email.thelinuxfoundation.org/LFPH-Newsletter-Form-Submission">
				<label for="FirstName" required>
					<span class="screen-reader-text">First
						Name</span>
					<input type="text" id="FirstName" name="FirstName"
						placeholder="First Name" autocomplete="given-name"
						spellcheck="false" required>
				</label>
				<label for="LastName" required>
					<span class="screen-reader-text">Last
						Name</span>
					<input type="text" id="LastName" name="LastName"
						placeholder="Last Name" autocomplete="family-name"
						spellcheck="false" required>
				</label>
				<label for="Organization" required>
					<span class="screen-reader-text">Organization</span>
					<input type="text" id="Organization" name="Organization"
						placeholder="Organization"
						spellcheck="false" required>
				</label>
				<label for="EmailAddress" required>
					<span class="screen-reader-text">Email
						Address</span>
					<input type="email" id="EmailAddress" name="EmailAddress"
						placeholder="Email Address" autocomplete="email"
						spellcheck="false" required>
				</label>
				<button type="submit" class="button stocky"
					id="sfmc-submit1">Subscribe</button>
				<div id="recaptcha-form1" style="display:none;">
				</div>
			</form>
			<div id="sfmc-message1" class="form-message"></div>
			<p class="smaller-text">By submitting this form, you
				acknowledge that your
				information is subject to The Linux Foundation’s <a
					href="https://www.linuxfoundation.org/privacy/"
					rel="norefferer noopener" class="external is-primary-color"
					target="_blank">Privacy Policy</a>.</p>

			<!-- form end  -->
		</div>
	</article>
	<footer class="footer">
	<div class="container wrap">

<div class="copyright-text">
				<p class="smaller-text">Copyright &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
					<?php echo wp_kses_post( $options['copyright_textarea'] ); ?>
				</p>
			</div>

	</div>
</footer>

</main>

<?php
get_footer();

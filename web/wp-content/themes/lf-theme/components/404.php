<?php
/**
 * 404 page
 *
 * Shown when a page is not found.
 *
 * @package WordPress
 * @subpackage lf-theme
 * @since 1.0.0
 */

$image = new Image();
?>

<section class="error-page">

	<div class="container wrap">

	<p>We're sorry, but that page cannot be found. Use search to find what you're looking for.</p>

	<form role="search" method="get" class="no-search-results"
			action="<?php echo esc_url( home_url() ); ?>">
			<label><span class="search-text screen-reader-text">Search the
					site</span>


			<div class="search-button-align">
				<input type="search" class="search-field margin-y"
					placeholder="Enter search term"
					value="<?php echo get_search_query(); ?>" name="s"
					title="Search for" autocomplete="off" autocorrect="off"
					autocapitalize="off" spellcheck="false" />
			</label>

			<input type="submit" class="button" value="Search" />
			</div>
		</form>

<p class="margin-top">or go to LFPH homepage</p>
		<a href="/" class="button">Go to Homepage</a>

	</div>
</section>

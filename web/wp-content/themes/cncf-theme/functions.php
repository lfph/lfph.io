<?php
/**
 * Theme Functions
 *
 * Try to keep this file as clean as possible
 *
 * @package WordPress
 * @subpackage cncf-theme
 * @since 1.0.0
 */

/**
 * Theme Support functions
 *
 * Used to enable specific features of WordPress and other tools.
 */
function cncf_theme_support_setup() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// include custom image sizes.
	require_once 'includes/image-sizes.php';

	// include gutenberg setup.
	require_once 'includes/gutenberg-setup.php';

}
add_action( 'after_setup_theme', 'cncf_theme_support_setup' );

/**
 * Theme function classes
 *
 * Any additional functionality should be added in the classes folder and linked up below.
 */
global $enqueue;
global $image;
require 'classes/class-enqueue.php';
require 'classes/class-image.php';
$enqueue = new Enqueue();

/**
 * Includes (enable as appropriate)
 */

// development.
if ( WP_DEBUG === true ) {
	require_once 'includes/development.php';
}

// gutenberg settings.
require_once 'includes/gutenberg-options.php';

// speed improvements.
require_once 'includes/speed.php';

// admin & dashboard customisation.
require_once 'includes/admin-dashboard.php';

// post excerpts.
require_once 'includes/excerpts.php';

// speakers bureau.
require_once 'includes/speakers-bureau.php';

// countries import.
require_once 'classes/class-fuerza-import-countries.php';

// speakers bureau bulk email form.
require_once 'classes/class-speakers-contact.php';

// speakers bureau export.
require_once 'classes/class-speakers-export.php';

// Fuerza utils.
require_once 'classes/class-fuerza-utils.php';

// CNCF utils.
require_once 'classes/class-cncf-utils.php';

/* Will only run on front end of site */
if ( ! is_admin() ) {
	/**
	 * Make all JS defer onload apart from files specified.
	 *
	 * @param string $url the URL.
	 */
	function defer_parsing_of_js( $url ) {
		if ( false === strpos( $url, '.js' ) ) {
			return $url;
		}
		if ( strpos( $url, 'jquery.js' ) ) {
			return $url;
		}
		return str_replace( ' src', ' defer src', $url );
	}
	add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );
}

/**
 * The WP REST API is cached heavily by Pantheon so we need to explicitly exclude certain calls from the cache.
 * From https://pantheon.io/docs/mu-plugin#wp-rest-api-code-classlanguage-textwp-jsoncode-endpoints-cache.
 */
$regex_json_path_patterns = array(
	'#^/wp-json/post-meta-controls/v1/?#',
);
foreach ( $regex_json_path_patterns as $regex_json_path_pattern ) {
	if ( preg_match( $regex_json_path_pattern, $_SERVER['REQUEST_URI'] ) ) { //phpcs:ignore
		// re-use the rest_post_dispatch filter in the Pantheon page cache plugin.
		add_filter( 'rest_post_dispatch', 'filter_rest_post_dispatch_send_cache_control', 12, 2 );

		/**
		 * Re-define the send_header value with any custom Cache-Control header.
		 *
		 * @param obj $response Response object.
		 * @param obj $server Server object.
		 */
		function filter_rest_post_dispatch_send_cache_control( $response, $server ) {
			$server->send_header( 'Cache-Control', 'no-cache, must-revalidate, max-age=0' );
			return $response;
		}
		break;
	}
}

/**
 * Updates image class names after post import in order to correct the IDs.
 * It also adds the external url of news posts as a meta value.
 *
 * @param int $import_id Import ID.
 */
function post_import_processing( $import_id ) {
	global $wpdb;
	$imported_posts = $wpdb->get_results( $wpdb->prepare( 'SELECT `post_id` FROM `' . $wpdb->prefix . 'pmxi_posts` WHERE `import_id` = %d', $import_id ) );
	foreach ( $imported_posts as $x_post ) {
		$i_post = get_post( $x_post->post_id );
		$doc = new DOMDocument();
		@$doc->loadHTML( $i_post->post_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

		$image_tags = $doc->getElementsByTagName( 'img' );

		if ( $image_tags->length > 0 ) {

			foreach ( $image_tags as $tag ) {
				$img_guid = preg_replace( '/(-\d+x\d+)/', '', $tag->getAttribute( 'src' ) );
				$result = $wpdb->get_row( $wpdb->prepare( 'SELECT `ID` FROM `' . $wpdb->prefix . 'posts` WHERE `guid` LIKE %s', '%' . $img_guid . '%' ) );
				if ( $result ) {
					$tag->setAttribute( 'class', 'wp-image-' . $result->ID );
				}
			}
			$i_post->post_content = $doc->saveHTML();
			wp_update_post( $i_post );
		}

		$anchor_tags = $doc->getElementsByTagName( 'a' );

		if ( $anchor_tags->length > 0 ) {
			$last_tag = $anchor_tags->item( $anchor_tags->length - 1 );
			if ( 'READ MORE' === strtoupper( $last_tag->nodeValue ) ) { //phpcs:ignore
				$external_url = $last_tag->getAttribute( 'href' );
				if ( $external_url ) {
					update_post_meta( $x_post->post_id, 'cncf_post_external_url', $external_url );
					$last_tag->parentNode->removeChild( $last_tag );//phpcs:ignore
					$i_post->post_content = $doc->saveHTML();
					wp_update_post( $i_post );
				}
			}
		}
	}
}
add_action( 'pmxi_after_xml_import', 'post_import_processing', 10, 1 );

<?php
/**
 * Critical CSS
 *
 * Experiment focused on front page to help improve load times.
 *
 * @package WordPress
 * @subpackage lf-theme
 * @since 1.0.0
 */

/**
 * Move CSS to preload/onload.
 *
 * @param object $html HTML.
 * @param string $handle File handle.
 * @param string $href link.
 * @param string $media media type.
 */
function lf_home_css_rel_preload( $html, $handle, $href, $media ) {
	if ( is_front_page() && ! is_admin() ) {
		$html = '<link rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\' " id="' . $handle . '" href="' . $href . '" type="text/css" media="all" />';
	}
	return $html;
}
add_filter( 'style_loader_tag', 'lf_home_css_rel_preload', 10, 4 );

/**
 * Load critical CSS in head.
 */
function lf_home_critical_css() {
	if ( is_front_page() ) {

		ob_start();
		include get_template_directory() . '/build/critical.min.css';
		$critical_css = ob_get_clean();

		echo '<style>*/ Critical CSS */' . $critical_css . '</style>'; // phpcs:ignore
	}
}
add_action( 'wp_head', 'lf_home_critical_css', 10 );

/**
 * LoadCSS polyfill.
 */
function lf_home_loadcss_critical_css() {
	if ( is_front_page() ) { ?>

<script>
(function(w) {
	"use strict";
	if (!w.loadCSS) {
		w.loadCSS = function() {}
	}
	var rp = loadCSS.relpreload = {};
	rp.support = (function() {
		var ret;
		try {
			ret = w.document.createElement("link").relList.supports(
				"preload")
		} catch (e) {
			ret = !1
		}
		return function() {
			return ret
		}
	})();
	rp.bindMediaToggle = function(link) {
		var finalMedia = link.media || "all";

		function enableStylesheet() {
			if (link.addEventListener) {
				link.removeEventListener("load", enableStylesheet)
			} else if (link.attachEvent) {
				link.detachEvent("onload", enableStylesheet)
			}
			link.setAttribute("onload", null);
			link.media = finalMedia
		}
		if (link.addEventListener) {
			link.addEventListener("load", enableStylesheet)
		} else if (link.attachEvent) {
			link.attachEvent("onload", enableStylesheet)
		}
		setTimeout(function() {
			link.rel = "stylesheet";
			link.media = "only x"
		});
		setTimeout(enableStylesheet, 3000)
	};
	rp.poly = function() {
		if (rp.support()) {
			return
		}
		var links = w.document.getElementsByTagName("link");
		for (var i = 0; i < links.length; i++) {
			var link = links[i];
			if (link.rel === "preload" && link.getAttribute("as") ===
				"style" && !link.getAttribute("data-loadcss")) {
				link.setAttribute("data-loadcss", !0);
				rp.bindMediaToggle(link)
			}
		}
	};
	if (!rp.support()) {
		rp.poly();
		var run = w.setInterval(rp.poly, 500);
		if (w.addEventListener) {
			w.addEventListener("load", function() {
				rp.poly();
				w.clearInterval(run)
			})
		} else if (w.attachEvent) {
			w.attachEvent("onload", function() {
				rp.poly();
				w.clearInterval(run)
			})
		}
	}
	if (typeof exports !== "undefined") {
		exports.loadCSS = loadCSS
	} else {
		w.loadCSS = loadCSS
	}
}(typeof global !== "undefined" ? global : this))
</script>

		<?php
	}
}
add_action( 'wp_head', 'lf_home_loadcss_critical_css', 11 );

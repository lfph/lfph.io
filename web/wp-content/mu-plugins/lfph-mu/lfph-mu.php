<?php
/**
 * Core functionality for running the lfph.io site.
 *
 * @link              https://lfph.io/
 * @since             1.0.0
 * @package           lfphmu
 *
 * @wordpress-plugin
 * Plugin Name:       LFPH MU
 * Plugin URI:        https://github.com/lfph/lfph.io
 * Description:       Core functionality for running the lfph.io site.
 * Version:           1.1.0
 * Author:            Chris Abraham, James Hunt
 * Author URI:        https://www.lfph.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lfph-mu
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LFPH_MU_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lfph-mu-activator.php
 */
function activate_lfph_mu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lfph-mu-activator.php';
	Lfph_Mu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lfph-mu-deactivator.php
 */
function deactivate_lfph_mu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lfph-mu-deactivator.php';
	Lfph_Mu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lfph_mu' );
register_deactivation_hook( __FILE__, 'deactivate_lfph_mu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lfph-mu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lfph_mu() {

	$plugin = new Lfph_Mu();
	$plugin->run();

}
run_lfph_mu();

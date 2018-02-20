<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://briancoords.com
 * @since             1.0.0
 * @package           S2_Member_Cleaner
 *
 * @wordpress-plugin
 * Plugin Name:       S2 Member User Cleaner
 * Plugin URI:        https://briancoords.com
 * Description:       Handle automatic cleaning of old S2 Member accounts.
 * Version:           1.0.0
 * Author:            Brian Coords
 * Author URI:        https://briancoords.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       s2-member-cleaner
 * Domain Path:       /languages
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-s2-member-cleaner-activator.php
 */
function activate_s2_member_cleaner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-s2-member-cleaner-activator.php';
	S2_Member_Cleaner_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-s2-member-cleaner-deactivator.php
 */
function deactivate_s2_member_cleaner() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-s2-member-cleaner-deactivator.php';
	S2_Member_Cleaner_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_s2_member_cleaner' );
register_deactivation_hook( __FILE__, 'deactivate_s2_member_cleaner' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-s2-member-cleaner.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_s2_member_cleaner() {

	$plugin = new S2_Member_Cleaner();
	$plugin->run();

}
run_s2_member_cleaner();

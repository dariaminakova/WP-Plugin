<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              dream.team
 * @since             1.0.0
 * @package           Amazing
 *
 * @wordpress-plugin
 * Plugin Name:       amazing
 * Plugin URI:        https://dream.team.com
 * Description:       Slider plugin
 * Version:           1.1.0
 * Author:            dream.team
 * Author URI:        dream.team
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       amazing
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
define( 'AMAIZING_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-amazing-activator.php
 */
function activate_amazing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-amazing-activator.php';
	Amazing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-amazing-deactivator.php
 */
function deactivate_amazing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-amazing-deactivator.php';
	Amazing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_amazing' );
register_deactivation_hook( __FILE__, 'deactivate_amazing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-amazing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_amazing() {

	$plugin = new Amazing();
	$plugin->run();

}
run_amazing();

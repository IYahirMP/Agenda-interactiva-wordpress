<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://iyahir.live
 * @since             1.0.0
 * @package           Nutriologa_Agenda_Interactiva
 *
 * @wordpress-plugin
 * Plugin Name:       Agenda programable interactiva
 * Plugin URI:        https://iyahir.live
 * Description:       Permite controlar una agenda de manera interactiva a través de un menú administrativo y permite que los usuarios agenden una cita.
 * Version:           1.0.0
 * Author:            Ivan Yahir Mojica Pineda
 * Author URI:        https://iyahir.live
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nutriologa-agenda-interactiva
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
define( 'NUTRIOLOGA_AGENDA_INTERACTIVA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nutriologa-agenda-interactiva-activator.php
 */
function activate_nutriologa_agenda_interactiva() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nutriologa-agenda-interactiva-activator.php';
	Nutriologa_Agenda_Interactiva_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nutriologa-agenda-interactiva-deactivator.php
 */
function deactivate_nutriologa_agenda_interactiva() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nutriologa-agenda-interactiva-deactivator.php';
	Nutriologa_Agenda_Interactiva_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nutriologa_agenda_interactiva' );
register_deactivation_hook( __FILE__, 'deactivate_nutriologa_agenda_interactiva' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nutriologa-agenda-interactiva.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nutriologa_agenda_interactiva() {

	$plugin = new Nutriologa_Agenda_Interactiva();
	$plugin->run();

}
run_nutriologa_agenda_interactiva();

<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://iyahir.live
 * @since      1.0.0
 *
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/includes
 * @author     Ivan Yahir Mojica Pineda <ivanyahirmopi@gmail.com>
 */
class Nutriologa_Agenda_Interactiva_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nutriologa-agenda-interactiva',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

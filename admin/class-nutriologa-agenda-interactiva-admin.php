<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://iyahir.live
 * @since      1.0.0
 *
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/admin
 * @author     Ivan Yahir Mojica Pineda <ivanyahirmopi@gmail.com>
 */
class Nutriologa_Agenda_Interactiva_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nutriologa_Agenda_Interactiva_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nutriologa_Agenda_Interactiva_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/nutriologa-agenda-interactiva-admin.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-bootstrapcss', plugin_dir_url(__FILE__) . "css/bootstrap.min.css", array(), "v5.3.0-alpha1", 'all');
		wp_enqueue_style($this->plugin_name . '-calendarcss', plugin_dir_url(__FILE__) . "css/calendar.css", array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nutriologa_Agenda_Interactiva_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nutriologa_Agenda_Interactiva_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/nutriologa-agenda-interactiva-admin.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . '-jquery', plugin_dir_url(__FILE__) . "js/jquery-3.6.3.js", array(), $this->version, false);
		wp_enqueue_script($this->plugin_name . '-bootstrapjs', plugin_dir_url(__FILE__) . "js/bootstrap.min.js", array(), "v5.3.0-alpha1", false);
		wp_enqueue_script($this->plugin_name . '-calendarjs', plugin_dir_url(__FILE__) . "js/calendar.js", array('jquery'), "1.5", false);
	}

	/**
	 * Fires before the administration menu loads in the admin.
	 *
	 * @param string $context Empty context.
	 */
	public function menu_agenda()
	{
		add_menu_page(
			'Agenda de la nutriologa',
			'Agenda de citas',
			'manage_options',
			'agenda',
			array($this, 'agenda'),
			'dashicons-calendar-alt',
			6
		);
	}

	public function agenda()
	{
		require_once 'partials/nutriologa-agenda-interactiva-admin-display.php';
	}
}

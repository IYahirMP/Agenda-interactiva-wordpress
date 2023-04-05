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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/nutriologa-agenda-interactiva-admin.js', array('jquery'), "1.2.3", false);
		wp_enqueue_script($this->plugin_name . '-jquery', plugin_dir_url(__FILE__) . "js/jquery-3.6.3.js", array(), $this->version, false);
		wp_enqueue_script($this->plugin_name . '-bootstrapjs', plugin_dir_url(__FILE__) . "js/bootstrap.bundle.min.js", array(), "v5.3.0-alpha", false);
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

		add_submenu_page(
			'agenda', //Slug del menú Agenda de la nutriologa
			'Ubicaciones', //Titulo de la pagina
			'Ubicaciones', //Titulo del menu
			'manage_options', //Capacidades del menu
			'nac_ubicaciones', //Slug del menu
			array($this, 'ubicaciones')
		);
	}

	public function agenda()
	{
		require_once 'partials/nutriologa-agenda-interactiva-admin-display.php';
	}

	public function ubicaciones()
	{
		require_once 'partials/nac_ubicaciones.php';
	}

	public function actualizarDatosUbicacion()
	{
		global $wpdb;

		$objeto = $_POST["data"];

		$where = array(
			'id' => intval($objeto["id"])
		);

		$datosActualizar = array(
			'estado' => $objeto["estado"],
			'municipio' => $objeto["municipio"],
			'localidad' => $objeto["localidad"],
			'calle' => $objeto['calle'],
			'colonia' => $objeto['colonia'],
			'num_exterior' => $objeto['num_exterior'],
			'num_interior' => $objeto['num_interior'],
			'telefono_contacto' => $objeto['telefono_contacto']
		);

		$actualizado = $wpdb->update($wpdb->prefix . "nac_ubicacion", $datosActualizar, $where);

		if (false == $actualizado) {
			wp_send_json_error();
			wp_die();
		} else {
			$consulta = "SELECT * FROM {$wpdb->prefix}nac_ubicacion;";
			$resultado = $wpdb->get_results($consulta);
			wp_send_json_success($resultado);
			wp_die();
		}
	}

	public function crearUbicacion()
	{
		global $wpdb;

		$objeto = $_POST["data"];

		$registro = array(
			'estado' => $objeto["estado"],
			'municipio' => $objeto["municipio"],
			'localidad' => $objeto["localidad"],
			'calle' => $objeto['calle'],
			'colonia' => $objeto['colonia'],
			'num_exterior' => $objeto['num_exterior'],
			'num_interior' => $objeto['num_interior'],
			'telefono_contacto' => $objeto['telefono_contacto']
		);

		$creado = $wpdb->insert($wpdb->prefix . "nac_ubicacion", $registro);

		if (false == $creado) {
			wp_send_json_error();
			wp_die();
		} else {
			$consulta = "SELECT * FROM {$wpdb->prefix}nac_ubicacion;";
			$resultado = $wpdb->get_results($consulta);
			wp_send_json_success($resultado);
			wp_die();
		}
	}

	public function eliminarUbicacion()
	{
		global $wpdb;
		$objeto = $_POST["data"];
		$id = array(
			'id' => intval($objeto["id"])
		);

		$resultado = $wpdb->delete($wpdb->prefix . "nac_ubicacion", $id);
		if (false == $resultado) {
			wp_send_json_error();
			wp_die();
		} else {
			$consulta = "SELECT * FROM {$wpdb->prefix}nac_ubicacion;";
			$resultado = $wpdb->get_results($consulta);
			wp_send_json_success($resultado);
			wp_die();
		}
	}

	public function obtenerDatosCalendario()
	{
		global $wpdb;
		//$mes = isset($_GET["mes"]) ? $_GET["mes"] : -1;
		//$anio = isset($_GET["anio"]) ? $_GET["anio"] : -1;
		$mes = 3;
		$mesSig = $mes + 1;
		$anio = "2023";
		if ($mes == -1 || $anio == -1) {
			die;
		}

		$mes = ($mes < 10) ? "0$mes" : $mes;
		$mesSig = ($mesSig < 10) ? "0$mesSig" : $mesSig;

		if ($anio < 100) {
			$anio = "20$anio";
		}

		$fecha = "$anio-$mes-01";
		$fechap = "$anio-$mesSig-01";

		$prefix = $wpdb->prefix . "nac_";
		$cita = $prefix . "cita";
		$cliente = $prefix . "cliente";
		$horario = $prefix . "horario";
		$consulta = "SELECT $cita.id as id, nombre, apellidoPaterno, apellidoMaterno , dia, horaInicio, horaFin
                    FROM $cita   JOIN $horario ON $cita.horario = $horario.id
                                JOIN $cliente ON $cliente.id = $cita.cliente
                                WHERE dia >= '$fecha' AND dia < '$fechap'";
		$eventos = $wpdb->get_results($consulta);

		$dia = "1";
		$mes = (intval($mes) < 10) ? $mes[1] : $mes;
		$a = new stdClass();
		$a->$anio = new stdClass();
		$a->$anio->$mes = new stdClass();
		$a->$anio->$mes->$dia = array();

		foreach ($eventos as $evento => $objeto) {
			if ($objeto->dia[8] == 0)
				$dia = $objeto->dia[9];
			else
				$dia = $objeto->dia[8] . $objeto->dia[9];
			$current = $a->$anio->$mes->$dia[] = new stdClass();
			$current->id = $objeto->id;
			$current->dia = $objeto->dia;
			$current->startTime = $objeto->horaInicio;
			$current->endTime = $objeto->horaFin;
			$current->text = "Cita con " . $objeto->nombre . " " . $objeto->apellidoPaterno . " " . $objeto->apellidoMaterno;
			$current->nombre = $objeto->nombre;
			$current->apellidoPaterno = $objeto->apellidoPaterno;
			$current->apellidoMaterno = $objeto->apellidoMaterno;
		}

		$aJSON = json_encode($a);

		wp_send_json_success($aJSON);
	}
}

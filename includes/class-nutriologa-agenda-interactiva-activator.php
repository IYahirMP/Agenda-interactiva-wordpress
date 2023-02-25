<?php

/**
 * Fired during plugin activation
 *
 * @link       https://iyahir.live
 * @since      1.0.0
 *
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/includes
 * @author     Ivan Yahir Mojica Pineda <ivanyahirmopi@gmail.com>
 */
class Nutriologa_Agenda_Interactiva_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		//Tabla cliente
		$cliente = $wpdb->prefix . "cliente";
		$sqlCliente = "CREATE TABLE IF NOT EXISTS $cliente (
				id int unsigned not null auto_increment,
				nombre varchar(40),
				apellidoPaterno varchar(40),
				apellidoMaterno varchar(40),
				telefono varchar(12),
				correo varchar(60),
				PRIMARY KEY (id)
			)$charset_collate;";

		//Tabla de horarios
		$horario = $wpdb->prefix . "horario";
		$sqlHorario = "CREATE TABLE IF NOT EXISTS $horario (
			id int unsigned not null auto_increment,
			dia date,
			horaInicio time,
			horaFin time,
			ubicacion varchar(30),
			PRIMARY KEY (id)
		)$charset_collate;";

		//Tabla de citas
		$cita = $wpdb->prefix . "cita";
		$sqlCita = "CREATE TABLE IF NOT EXISTS $cita (
			id int unsigned not null auto_increment,
			asunto varchar(100),
			cliente int unsigned not null,
			horario int unsigned not null,
			PRIMARY KEY (id),
			FOREIGN KEY (cliente) REFERENCES $cliente(id),
			FOREIGN KEY (horario) REFERENCES $horario(id)
		)$charset_collate;";

		//Tabla de pagos
		$pagos = $wpdb->prefix . "pago";
		$sqlPagos = "CREATE TABLE IF NOT EXISTS $pagos (
			id int unsigned not null auto_increment,
			cantidad float not null,
			citaId int unsigned not null,
			fecha timestamp not null,
			PRIMARY KEY (id),
			FOREIGN KEY (citaId) REFERENCES $cita(id)
		)$charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta($sqlCliente);
		dbDelta($sqlHorario);
		dbDelta($sqlCita);
		dbDelta($sqlPagos);
	}
}

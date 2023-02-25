<?php

$servername = "localhost:3308";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, "tienda");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

/*
global $wpdb;
$cita = $wpdb->prefix . "cita";
$cliente = $wpdb->prefix . "cliente";
$horario = $wpdb->prefix . "horario";*/

$cita = "wp_cita";
$cliente = "wp_cliente";
$horario = "wp_horario";

$consulta = "SELECT nombre, apellidoPaterno, apellidoMaterno, horaInicio, horaFin
                FROM $cita   JOIN $horario ON $cita.horario = $horario.id
                            join $cliente ON $cliente.id = $cita.cliente";
//$eventos = $wpdb->get_results($consulta);

$result = $conn->query($consulta);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $rows => $as) {
            echo $as;
            echo "<br>";
        }
    }
} else {
    echo "0 results";
}

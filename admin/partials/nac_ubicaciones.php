<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://iyahir.live
 * @since      1.0.0
 *
 * @package    Nutriologa_Agenda_Interactiva
 * @subpackage Nutriologa_Agenda_Interactiva/admin/partials
 */
?>

<?php
global  $wpdb;
$consulta = "SELECT * FROM {$wpdb->prefix}nac_ubicacion;";
$resultado = $wpdb->get_results($consulta);
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center display-1">Ubicaciones</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <h2 class="text-left display-3">Listado de ubicaciones</h2>
            </div>
            <div class="col-1 d-flex align-items-center justify-content-center">
                <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#listadoUbicaciones" aria-expanded="false" aria-controls="listadoUbicaciones">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="collapse" id="listadoUbicaciones">
            <ul class="list-group" id="listaUbicaciones">
                <?php if ($resultado) : foreach ($resultado as $row) : ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6" id="<?php echo "registro" . $row->id; ?>">
                                    <?php
                                    $dir = '';
                                    $dir .= $row->localidad;
                                    $dir .= ", ";
                                    $dir .= $row->estado;
                                    $dir .= ", municipio de ";
                                    $dir .= $row->municipio;
                                    $dir .= ", colonia ";
                                    $dir .= $row->colonia;
                                    $dir .= ", calle ";
                                    $dir .= $row->calle;
                                    $dir .= ", numero exterior ";
                                    $dir .= $row->num_exterior;
                                    $dir .= ", numero interior ";
                                    $dir .= $row->num_interior;
                                    $dir .= ", con teléfono de contacto ";
                                    $dir .= $row->telefono_contacto;
                                    echo $dir;
                                    ?>
                                </div>
                                <div class="col-1 offset-5">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button id=<?php echo '"editar' . $row->id . '"'; ?> class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalEditar" onclick="poblarModal(<?php echo $row->id; ?>)">Editar</button></li>
                                            <li><button id=<?php echo '"eliminar' . $row->id . '"'; ?> class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalEliminar" onclick="configurarModalEliminacion(<?php echo $row->id; ?>)">Eliminar</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                <?php
                    endforeach;
                endif;
                ?>
            </ul>
        </div>

        <div class="row">
            <div class="col-11">
                <h2 class="display-3">Crear ubicación</h2>
            </div>
            <div class="col-1">
                <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#crearUbicacion" aria-expanded="false" aria-controls="crearUbicacion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="collapse show" id="crearUbicacion">
            <div class="row">
                <form>
                    <fieldset>
                        <div class="mb-3">
                            <label for="estado2" class="form-label">Estado</label>
                            <input class="form-control" type="text" id="estado2" aria-describedby="ayudaEstado" required>
                            <div id="ayudaEstado" class="form-text">Ej. Guerrero, México, Ciudad de México.</div>
                        </div>
                        <div class="mb-3">
                            <label for="municipio2" class="form-label">Municipio</label>
                            <input class="form-control" type="text" id="municipio2" aria-describedby="ayudaMunicipio" required>
                            <div id="ayudaMunicipio" class="form-text">Ej. Pungarabato, Coyuca de Catalán, San Marcos.</div>
                        </div>
                        <div class="mb-3">
                            <label for="localidad2" class="form-label">Localidad</label>
                            <input class="form-control" type="text" id="localidad2" aria-describedby="ayudaLocalidad" required>
                            <div id="ayudaLocalidad" class="form-text">Ej. Ciudad Altamirano, Tanganhuato, Santa Bárbara.</div>
                        </div>
                        <div class="mb-3">
                            <label for="calle2" class="form-label">Calle</label>
                            <input class="form-control" type="text" id="calle2" aria-describedby="ayudaCalle">
                            <div id="ayudaCalle" class="form-text">Ej. Benito Juarez Poniente.<br>Si no tiene calle, dejar en blanco.</div>
                        </div>
                        <div class="mb-3">
                            <label for="colonia2" class="form-label">Colonia</label>
                            <input class="form-control" type="text" id="colonia2" aria-describedby="ayudaColonia" required>
                            <div id="ayudaColonia" class="form-text">Ej. Centro, Doctores.</div>
                        </div>
                        <div class="mb-3">
                            <label for="num_exterior2" class="form-label">N&uacute;mero exterior</label>
                            <input class="form-control" type="text" id="num_exterior2" aria-describedby="ayudaNumExterior">
                            <div id="ayudaNumExterior" class="form-text">Ej. 311.<br>Si no tiene n&uacute;mero exterior, dejar en blanco.</div>
                        </div>
                        <div class="mb-3">
                            <label for="num_interior2" class="form-label">N&uacute;mero interior</label>
                            <input class="form-control" type="text" id="num_interior2" aria-describedby="ayudaNumInterior">
                            <div id="ayudaNumInterior" class="form-text">Ej. 311A, 412B, ...<br>Si no tiene n&uacute;mero interior, dejar en blanco.</div>
                        </div>
                        <div class="mb-3">
                            <label for="telefono2" class="form-label">Teléfono de contacto</label>
                            <input class="form-control" type="text" id="telefono2" aria-describedby="ayudaTelefono">
                            <div id="ayudaTelefono" class="form-text">Ej. 7331567430.<br>Si no tiene n&uacute;mero de Teléefono, dejar en blanco.</div>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <button class="btn btn-primary" type="button" onclick="crearUbicacion()">Crear nueva ubicación</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php include_once(__DIR__ . "\\nac_modales.php") ?>

    <script>
        var datos = <?php echo json_encode($resultado) ?>;
    </script>

</body>

</html>
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
$consulta = "SELECT * FROM {$wpdb->prefix}nac_ubicacion LIMIT 10;";
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
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Editar ubicaci&oacute;n</h2>
                </div>
                <div class="modal-body">
                    <form>
                        <fieldset>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="id" required hidden disabled>
                                <label for="estado" class="form-label">Estado</label>
                                <input class="form-control" type="text" id="estado" aria-describedby="ayudaEstado" required>
                                <div id="ayudaEstado" class="form-text">Ej. Guerrero, México, Ciudad de México.</div>
                            </div>
                            <div class="mb-3">
                                <label for="municipio" class="form-label">Municipio</label>
                                <input class="form-control" type="text" id="municipio" aria-describedby="ayudaMunicipio" required>
                                <div id="ayudaMunicipio" class="form-text">Ej. Pungarabato, Coyuca de Catalán, San Marcos.</div>
                            </div>
                            <div class="mb-3">
                                <label for="localidad" class="form-label">Localidad</label>
                                <input class="form-control" type="text" id="localidad" aria-describedby="ayudaLocalidad" required>
                                <div id="ayudaLocalidad" class="form-text">Ej. Ciudad Altamirano, Tanganhuato, Santa Bárbara.</div>
                            </div>
                            <div class="mb-3">
                                <label for="calle" class="form-label">Calle</label>
                                <input class="form-control" type="text" id="calle" aria-describedby="ayudaCalle">
                                <div id="ayudaCalle" class="form-text">Ej. Benito Juarez Poniente.<br>Si no tiene calle, dejar en blanco.</div>
                            </div>
                            <div class="mb-3">
                                <label for="colonia" class="form-label">Colonia</label>
                                <input class="form-control" type="text" id="colonia" aria-describedby="ayudaColonia" required>
                                <div id="ayudaColonia" class="form-text">Ej. Centro, Doctores.</div>
                            </div>
                            <div class="mb-3">
                                <label for="num_exterior" class="form-label">N&uacute;mero exterior</label>
                                <input class="form-control" type="text" id="num_exterior" aria-describedby="ayudaNumExterior">
                                <div id="ayudaNumExterior" class="form-text">Ej. 311.<br>Si no tiene n&uacute;mero exterior, dejar en blanco.</div>
                            </div>
                            <div class="mb-3">
                                <label for="num_interior" class="form-label">N&uacute;mero interior</label>
                                <input class="form-control" type="text" id="num_interior" aria-describedby="ayudaNumInterior">
                                <div id="ayudaNumInterior" class="form-text">Ej. 311A, 412B, ...<br>Si no tiene n&uacute;mero interior, dejar en blanco.</div>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Tel&eacute;fono de contacto</label>
                                <input class="form-control" type="text" id="telefono" aria-describedby="ayudaTelefono">
                                <div id="ayudaTelefono" class="form-text">Ej. 7331567430.<br>Si no tiene n&uacute;mero de tel&eacute;efono, dejar en blanco.</div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="actualizarDatos()">Guardar cambios</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExitoso">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Cambios guardados</h2>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p id="guardado">La ubicación ha sido guardada exitosamente.</p>
                        <div id="imagenCheck" class="d-flex justify-content-center">
                            <img style="height:10vh; text-align:center;" src="/wp-content/plugins/nutriologa-agenda-interactiva/admin/images/check.png">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminado">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Ubicación eliminada</h2>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p id="guardado">La ubicación ha sido eliminada exitosamente.</p>
                        <div id="imagenCheck" class="d-flex justify-content-center">
                            <img style="height:10vh; text-align:center;" src="/wp-content/plugins/nutriologa-agenda-interactiva/admin/images/check.png">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Eliminar ubicaci&oacute;n</h1>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <legend>¿Está seguro de que desea eliminar esta ubicaci&oacute;n?</legend>
                        <div class="d-flex flex-row justify-content-around">
                            <button id="botonEliminar" class="btn btn-primary px-4" data-bs-dismiss="modal">Sí</button>
                            <button class="btn btn-primary px-4" data-bs-dismiss="modal">No</button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <script>
        var datos = <?php echo json_encode($resultado) ?>;

        function poblarModal(id) {
            var objeto = null;
            datos.some(function(dato) {
                if (id == dato.id) {
                    objeto = dato;
                    return true;
                }
            })
            $("#id").val(objeto.id);
            $("#estado").val(objeto.estado);
            $("#municipio").val(objeto.municipio);
            $("#localidad").val(objeto.localidad);
            $("#calle").val(objeto.calle);
            $("#colonia").val(objeto.colonia);
            $("#num_exterior").val(objeto.num_exterior);
            $("#num_interior").val(objeto.num_interior);
            $("#telefono").val(objeto.telefono_contacto);
        }

        function configurarModalEliminacion(id) {
            $("#botonEliminar").on('click', function() {
                eliminarDatos(id)
            });
        }

        function eliminarDatos(id_elem) {
            $("#modalEliminado").modal('show');

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "eliminarUbicacion",
                    data: {
                        id: id_elem
                    }
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);

                }
            });
        }

        function actualizarDatos(id) {
            var objeto = {
                id: $("#id").val(),
                estado: $("#estado").val(),
                municipio: $("#municipio").val(),
                localidad: $("#localidad").val(),
                calle: $("#calle").val(),
                colonia: $("#colonia").val(),
                num_exterior: $("#num_exterior").val(),
                num_interior: $("#num_interior").val(),
                telefono_contacto: $("#telefono").val()
            };
            console.log(objeto);
            $("#modalExitoso")
            $("#modalEditar").modal('hide');
            $("#modalExitoso").modal('show');
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'actualizarDatosUbicacion',
                    data: objeto
                },
                success: function(response) {
                    console.log("Success", response);
                    datos = response.data;
                    actualizarLista(datos);
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }

        function actualizarLista(data) {
            $("#listaUbicaciones").empty();
            data.forEach(function(objeto) {
                const listItem = $("<li>", {
                    class: "list-group-item"
                });

                const renglon = $("<div>", {
                    class: "row"
                });

                const columnaTexto = $("<div>", {
                    class: "col-6",
                    id: "registro" + objeto.id
                });

                var texto = "";
                texto += objeto.localidad;
                texto += ", ";
                texto += objeto.estado;
                texto += ", municipio de ";
                texto += objeto.municipio;
                texto += ", colonia ";
                texto += objeto.colonia;
                texto += ", calle ";
                texto += objeto.calle;
                texto += ", numero exterior ";
                texto += objeto.num_exterior;
                texto += ", numero interior ";
                texto += objeto.num_interior;
                texto += ", con teléfono de contacto ";
                texto += objeto.telefono_contacto;
                columnaTexto.text(texto);

                renglon.append(columnaTexto);

                const columnaBotones = $("<div>", {
                    class: "col-1 offset-5",
                });

                const dropDown = $("<div>", {
                    class: "dropdown"
                });

                const boton = $("<button>", {
                    class: "btn btn-primary dropdown-toggle",
                    type: "button",
                    "data-bs-toggle": "dropdown",
                    "aria-expanded": "false"
                });

                const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                    </svg>`;

                const dropDownMenu = $("<ul>", {
                    class: "dropdown-menu"
                });

                const botonEditar = `<li><button id="editar` + objeto.id + `" class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalEditar" onclick="poblarModal(` + objeto.id + `)">Editar</button></li>`;
                const botonEliminar = `<li><button id="eliminar` + objeto.id + `" class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button></li>`;

                dropDownMenu.append(botonEditar).append(botonEliminar);
                boton.append(svg);
                dropDown.append(boton).append(dropDownMenu);
                columnaBotones.append(dropDown);
                renglon.append(columnaBotones);
                listItem.append(renglon);

                $("#listaUbicaciones").append(listItem);
            });
        }
    </script>
</body>

</html>
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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1 hidden>Agenda de la nutrióloga</h1>

<div class="row">
    <div id="calendarContainer" class="col-md-6 col-sm-12"></div>
    <div id="organizerContainer" class="col-md-6 col-sm-12" style="margin-left: 8px;"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalInicial" tabindex="-1" aria-labelledby="modalInicialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalInicialLabel">Acciones sobre el registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-row justify-content-around">
                <button type="button" class="btn btn-primary" data-bs-target="#modalRegistro" data-bs-toggle="modal">Modificar</button>
                <button type="button" class="btn btn-danger" data-bs-target="#modalEliminar" data-bs-toggle="modal">Eliminar</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Modificar el registro</h1>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                        <legend>Detalles de la cita</legend>
                        <div class="container">
                            <div class="row">
                                <div class="col align-self-center justify-content-evenly">
                                    <div class="row m-1">
                                        <label for="nombre">Nombre:</label>
                                    </div>
                                    <div class="row m-1">
                                        <label for="fecha">Fecha y hora:</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row m-1">
                                        <input type="text" id="nombre">
                                    </div>
                                    <div class="row m-1">
                                        <input type="datetime-local" id="fecha">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-target="#modalInicial" data-bs-toggle="modal">Regresar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEliminar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Eliminar cita</h1>
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend>¿Está seguro de que desea eliminar esta cita?</legend>
                    <div class="d-flex flex-row justify-content-around">
                        <button class="btn btn-primary px-4" data-bs-dismiss="modal">Sí</button>
                        <button class="btn btn-primary px-4" data-bs-target="#modalInicial" data-bs-toggle="modal">No</button>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<script>
    //Aquí se renderiza el organizador

    $("document").ready(async function() {
        $("#boton").on("click", btnfun);
        //Creación del calendario
        calendario = crearCalendario();
        //Esta línea quita los límites de tamaño del calendario.
        ajustarCalendario();
        //Creación de datos
        var data = await obtenerDatosCalendario();
        data = JSON.parse(data);
        if (data == "No data") {
            return;
        }
        //Creación del organizador
        console.log(data);
        organizador = crearOrganizador(calendario, data);
        //Esta linea quita el margen al organizador. Permite utilizar columnas de 50% con bootstrap
        ajustarOrganizador();
        ajustarEventos();
    })

    function ajustarEventos() {
        $(".cjslib-list li").on("click", mostrarModal);
    }

    function mostrarModal() {
        var modal = new bootstrap.Modal(document.getElementById("modalInicial"));
        modal.show();
    }

    function ajustarCalendario() {
        $(".cjslib-calendar.cjslib-size-small").css({
            "width": "100%",
            "height": "100%"
        })
    }

    function crearCalendario() {
        var calendar = new Calendar("calendarContainer", "small",
            ["Lunes", 3],
            ["#2a9df4", "#187bcd", "#ffffff", "#ffecb3"], {
                days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                indicator: false,
                placeholder: "No hay eventos aquí"
            });
        return calendar;
    }

    function crearOrganizador(calendario, datos) {
        var organizer = new Organizer("organizerContainer", calendario, datos);
        return organizer;
    }

    function ajustarOrganizador() {
        $(".cjslib-date").css("width", "100%");
        $("#organizerContainer").css("marginLeft", "0");
        $(".cjslib-events.cjslib-size-small").css({
            "width": "40vw",
            "height": "90vh"
        });
    }

    function btnfun() {
        $("#boton").css("border", "10px solid red");
    }

    function escucharCambioMes(calendario) {
        calendario.setOnClickListener('month-slider',
            function() {

            },
            function() {

            }
        );
    }

    async function obtenerDatosCalendario() {
        try {
            const response = await $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'obtenerDatosCalendario'
                }
            });
            if (response.success == true) {
                return response.data;
            } else {
                console.log("Error al obtener datos");
                return "No data";
            }
        } catch (error) {
            console.log("Error:", error);
            return "No data";
        }
    }
</script>
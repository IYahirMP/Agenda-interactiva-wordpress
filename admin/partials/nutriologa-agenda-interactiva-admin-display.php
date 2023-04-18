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

<style>
    #espera {
        width: 40vw;
        height: 90vh;
        background-color: #f6f6f6;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
    }

    .parrafo-espera {
        flex: 0 1 5vw;
        font-size: 3rem;
    }

    .cjslib-calendar.cjslib-size-small {
        width: 45vw;
        height: 90vh;
    }

    .cjslib-date {
        width: 100%;
    }

    .cjslib-events.cjslib-size-small {
        width: 45vw;
        height: 90vh;
    }

    @media screen and (max-width:576px) {
        #espera {
            width: 90vw;
            height: 90vh;
            background-color: #f6f6f6;
            display: flex;
            flex-flow: column nowrap;
            align-items: center;
            justify-content: center;
        }

        .parrafo-espera {
            flex: 0 1 5vw;
            font-size: 3rem;
        }

        .cjslib-calendar.cjslib-size-small {
            width: 90vw;
            height: 90vh;
        }

        .cjslib-date {
            width: 100%;
        }

        .cjslib-events.cjslib-size-small {
            width: 90vw;
            height: 90vh;
        }

        .agenda {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }

        .calendarContainer {
            margin-bottom: 5vh;
            display: flex;
            justify-content: center;
        }

        .organizerContainer {
            display: flex;
            justify-content: center;
        }
    }
</style>

<div class="row agenda">
    <div id="calendarContainer" class="col-sm-6 col-xs-12 calendarContainer"></div>
    <div id="organizerContainer" class="col-sm-6 col-xs-12 organizerContainer">
        <div id="espera" hidden="">
            <p class="parrafo-espera">
                Cargando datos...
            </p>
        </div>
    </div>
</div>

<!-- Modal -->
<?php include_once "nac_modales_calendario.php"; ?>

<script>
    var eventoActual = 0;
    //Aquí se renderiza el organizador
    $("document").ready(async function() {
        //Creación del calendario
        calendario = crearCalendario();
        //Esta línea quita los límites de tamaño del calendario.
        //Creación de datos
        var data = await obtenerDatosCalendario(calendario);
        data = JSON.parse(data);
        if (data == "No data") {
            return;
        }
        //Creación del organizador
        console.log(data);
        organizador = crearOrganizador(calendario, data);
        escucharCambioMes(organizador);
        //Esta linea quita el margen al organizador. Permite utilizar columnas de 50% con bootstrap
        ajustarEventos();
    })

    function ajustarEventos() {
        $(".cjslib-list li").on("click", mostrarModal);
    }

    async function mostrarModal() {
        //Se muestra el modal
        $("#modalInicial").modal('show');
        //Obtiene el elemento desde el cual se llama
        eventoActual = this;
        //Retiene el atributo id
        var idActual = this.getAttribute("id");
        //Obtiene el id de cita
        var idx = [idActual.length - 3, idActual.length - 2, idActual.length - 1];
        var idEvento = idActual[idx[0]] + idActual[idx[1]] + idActual[idx[2]];

        //Espera a que se obtenga información del servidor
        var info = await obtenerInformacionEvento(idEvento);
        var infoJSON = JSON.parse(info);
    }

    async function obtenerInformacionEvento(idEvento) {
        try {
            const response = await $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'obtenerInformacionEvento',
                    data: idEvento
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

    function escucharCambioMes(organizador) {
        obtenerDatos = async function() {
            let datos = await obtenerDatosCalendario(organizador.calendar);
            organizador.data = JSON.parse(datos);
        };
        organizador.setOnClickListener('days-blocks', obtenerDatos, obtenerDatos);
        organizador.setOnClickListener('month-slider', obtenerDatos, obtenerDatos);
        organizador.setOnClickListener('day-slider', obtenerDatos, obtenerDatos);
        organizador.setOnClickListener('year-slider', obtenerDatos, obtenerDatos);
    }

    async function obtenerDatosCalendario(calendario) {
        $(".cjslib-events.cjslib-size-small").attr({
            "hidden": ""
        });
        document.querySelector("#espera").removeAttribute("hidden");
        try {
            const response = await $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'obtenerDatosCalendario',
                    data: calendario.date.toISOString()
                }
            });
            if (response.success == true) {
                document.querySelector("#espera").setAttribute("hidden", "hidden");
                $(".cjslib-events.cjslib-size-small").removeAttr("hidden");
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
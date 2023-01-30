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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1>Agenda de la nutrióloga</h1>

<div class="row">
    <div id="calendarContainer" class="col-md-6 col-sm-12"></div>
    <div id="organizerContainer" class="col-md-6 col-sm-12" style="margin-left: 8px;"></div>
</div>

<script>
    // Basic config
    var calendar = new Calendar("calendarContainer", "small",
        ["Monday", 3],
        ["#2a9df4", "#187bcd", "#ffffff", "#ffecb3"], {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            indicator: false,
            placeholder: "No hay eventos aquí"
        });

    //Esta linea quita el margen al organizador. Permite utilizar columnas de 50% con bootstrap
    document.querySelector('#organizerContainer').style.marginLeft = 0;
    //Esta línea quita los límites de tamaño del calendario.
    document.querySelectorAll('.cjslib-calendar.cjslib-size-small').forEach(item => {
        item.style.width = "100%";
        item.style.height = "100%";
    });

    //Datos dummy del organizador
    var data = {
        2017: {
            12: {
                25: [{
                        startTime: "00:00",
                        endTime: "24:00",
                        text: "Christmas Day"
                    },
                    {
                        startTime: "00:00",
                        endTime: "24:00",
                        text: "Christssssmas Day"
                    }
                ]
            }
        }
    };

    //Aquí se renderiza el organizador
    var organizer = new Organizer("organizerContainer", calendar, data);

    //Este bloque quita los límites de tamaño del organizador
    document.querySelectorAll('.cjslib-events.cjslib-size-small').forEach(item => {
        item.style.width = "100%";
        item.style.height = "100%";
    });
</script>
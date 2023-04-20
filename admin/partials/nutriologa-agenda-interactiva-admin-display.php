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
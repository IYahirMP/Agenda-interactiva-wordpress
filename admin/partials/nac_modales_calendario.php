<div class="modal fade" id="modalEspera">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Procesando</h2>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Espere un momento, por favor. Se está procesando la operación</p>
                    <div class="d-flex justify-content-center">
                        <img style="height:10vh; text-align:center;" src="/wp-content/plugins/nutriologa-agenda-interactiva/admin/images/wip.png">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInicial" tabindex="-1" aria-labelledby="modalInicialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalInicialLabel">Acciones sobre el registro</h1>
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
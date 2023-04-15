<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
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
                            <label for="telefono" class="form-label">Teléfono de contacto</label>
                            <input class="form-control" type="text" id="telefono" aria-describedby="ayudaTelefono">
                            <div id="ayudaTelefono" class="form-text">Ej. 7331567430.<br>Si no tiene n&uacute;mero de Teléefono, dejar en blanco.</div>
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
                    <div class="d-flex justify-content-center">
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

<div class="modal fade" id="modalCrearExitoso">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ubicación creada</h2>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p id="guardado">La ubicación ha sido creada exitosamente.</p>
                    <div class="d-flex justify-content-center">
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

<div class="modal fade" id="modalCrearError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Crear ubicación</h2>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Hubo un error al crear la ubicación.</p>
                    <div class="d-flex justify-content-center">
                        <img style="height:10vh; text-align:center;" src="/wp-content/plugins/nutriologa-agenda-interactiva/admin/images/cross.png">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGuardadoError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Guardar ubicación</h2>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Los datos de la ubicación no pudieron guardarse correctamente.</p>
                    <div class="d-flex justify-content-center">
                        <img style="height:10vh; text-align:center;" src="/wp-content/plugins/nutriologa-agenda-interactiva/admin/images/cross.png">
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
                    <p>La ubicación ha sido eliminada exitosamente.</p>
                    <div class="d-flex justify-content-center">
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

<div class="modal fade" id="modalEliminadoError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Eliminar ubicación</h2>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>La ubicación no pudo ser eliminada.</p>
                    <div class="d-flex justify-content-center">
                        <img style="height:10vh; text-align:center;" src="/wp-content/plugins/nutriologa-agenda-interactiva/admin/images/cross.png">
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
                <fieldset class="text-center">
                    <legend>¿Está seguro de que desea eliminar esta ubicaci&oacute;n?</legend>
                    <div class=" d-flex flex-row justify-content-around">
                        <button id="botonEliminar" class="btn btn-primary px-4" data-bs-dismiss="modal">Sí</button>
                        <button class="btn btn-primary px-4" data-bs-dismiss="modal">No</button>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
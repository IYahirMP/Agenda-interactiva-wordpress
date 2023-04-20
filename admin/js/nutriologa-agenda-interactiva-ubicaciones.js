// Las funciones en esta parte son usadas en la parte de ubicaciones
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
            $("#botonEliminar").off('click');
			$("#botonEliminar").on('click', function() {
                eliminarDatos(id)
            });
        }

        function eliminarDatos(id_elem) {
            $("#modalEspera").modal("show");
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
                    $("#modalEspera").modal("hide");
                    if (response.success == true) {
                        $("#modalEliminado").modal('show');
						datos = response.data;
                        actualizarLista(response.data);
                    } else {
                        $("#modalEliminadoError").modal("show");
                    }
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
            $("#modalEditar").modal('hide');
            $("#modalEspera").modal('show');
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'actualizarDatosUbicacion',
                    data: objeto
                },
                success: function(response) {
                    $("#modalEspera").modal('hide');
                    if (response.success == true) {
                        $("#modalExitoso").modal('show');
                        datos = response.data;
                        actualizarLista(datos);
                    } else {
                        $("#modalGuardadoError").modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }

		function crearUbicacion() {
            var objeto = {
                estado: $("#estado2").val(),
                municipio: $("#municipio2").val(),
                localidad: $("#localidad2").val(),
                calle: $("#calle2").val(),
                colonia: $("#colonia2").val(),
                num_exterior: $("#num_exterior2").val(),
                num_interior: $("#num_interior2").val(),
                telefono_contacto: $("#telefono2").val()
            };
            console.log(objeto);
            $("#modalEspera").modal('show');
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'crearUbicacion',
                    data: objeto
                },
                success: function(response) {
                    $("#modalEspera").modal('hide');
                    if (response.success == true) {
                        $("#modalCrearExitoso").modal('show');
                        datos = response.data;
                        actualizarLista(datos);
                    } else {
                        $("#modalCrearError").modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }

        function actualizarLista(data) {
            if(data.length == 0){
                $("#listaUbicaciones").empty();
                let elemento = `<li class="list-group-item">
                <div class="row">
                    <div class="col-6" id="noReg">
                        No hay registros
                    </div>
                </div>
            </li>`;
                $("#listaUbicaciones").append(elemento);
                return;
            }
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
                const botonEliminar = `<li><button id="eliminar` + objeto.id + `" class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalEliminar" onclick="configurarModalEliminacion(` + objeto.id + `)">Eliminar</button></li>`;

                dropDownMenu.append(botonEditar).append(botonEliminar);
                boton.append(svg);
                dropDown.append(boton).append(dropDownMenu);
                columnaBotones.append(dropDown);
                renglon.append(columnaBotones);
                listItem.append(renglon);

                $("#listaUbicaciones").append(listItem);
            });
        }

//A partir de aquí, las funciones son usadas en la parte de calendario
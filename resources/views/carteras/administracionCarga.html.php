<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 mt-lg-4 mb-5">
            <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
            <li class="breadcrumb-item">Administración</li>
            <li class="breadcrumb-item active">Carga</li>
        </ol>
    </nav>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-asignacion-tab" data-bs-toggle="tab" data-bs-target="#asignacion" type="button" role="tab" aria-controls="home">CARGAR ASIGNACIÓN</button>
            <button class="nav-link" id="nav-pagos-tab" data-bs-toggle="tab" data-bs-target="#pagos" type="button" role="tab" aria-controls="profile">CARGAR PAGOS</button>
            <button class="nav-link" id="nav-messages-tab" data-bs-toggle="tab" data-bs-target="#demograficos" type="button" role="tab" aria-controls="messages">CARGAR DEMOGRÁFICOS</button>
            <button class="nav-link" id="nav-tareas-tab" data-bs-toggle="tab" data-bs-target="#tareas" type="button" role="tab" aria-controls="tareas">CARGAR TAREAS</button>
            <button class="nav-link" id="nav-agendamientos-tab" data-bs-toggle="tab" data-bs-target="#agendamientos" type="button" role="tab" aria-controls="agendamientos">CARGAR AGENDAMIENTOS</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane show active" id="asignacion" role="tabpanel">
            <h4 class="text-center fw-bold my-3"><i class="bi bi-person-lines-fill"></i> Cargar Asignación</h4>

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <form id="formCargaAsignacion" class="formCarga" enctype="multipart/form-data" action="javascript:void(0);" data-id="formCargaAsignacion" data-controlador="carterasController" data-ajax="administracionCarga" data-tipo="Asignacion">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><strong>Fecha vigencia</strong></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-pencil"></i></div>

                                <input type="text" class="form-control fecha" name="vigencia_asignacion" placeholder="Fecha Vigencia">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subir Archivo desde una carpeta</label>
                            <input class="inputCarga form-control" type="file" name="archivo" readyonly required>

                            <input type="hidden" name="metodo" value="cargarArchivo">
                            <input type="hidden" name="tipo" value="cargarAsignacion">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="pagos">
            <h4 class="text-center fw-bold my-3"><i class="bi bi-piggy-bank-fill"></i> Cargar Pagos</h4>

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <form id="formCargaPagos" data-id="formCargaPagos" class="formCarga" data-controlador="carterasController" data-ajax="administracionCarga" data-tipo="Pagos" enctype="multipart/form-data" action="javascript:void(0);">
                        <label class="form-label">Subir Archivo desde una carpeta</label>

                        <input type="file" name="archivo" readyonly class="form-label inputCarga" required>
                        <input type="hidden" name="metodo" value="cargarArchivo">
                        <input type="hidden" name="tipo" value="cargarPagos">
                    </form>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="demograficos">
            <h4 class="text-center fw-bold my-3"><i class="bi bi-body-text"></i> Cargar Demograficos</h4>

            <div class="d-flex justify-content-center">
                <div class="row">
                    <form id="formCargaDemograficos" data-id="formCargaDemograficos" class="formCarga" data-controlador="carterasController" data-ajax="administracionCarga" data-tipo="Demograficos" enctype="multipart/form-data" action="javascript:void(0);">
                        <div class="col-md-12">
                            <label for=""><b>Seleccione el tipo de demografico</b></label>
                            <select required name="tipo_demografico" class="form-select">
                                <option value="">...SELECCIONE...</option>
                                <option value="telefonos">Telefonos</option>
                                <option value="direcciones">Direcciones</option>
                                <option value="correos">Correos</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Subir Archivo desde una carpeta</label>
                            <input type="file" name="archivo" readyonly class="form-label inputCarga" required>
                            <input type="hidden" name="metodo" value="cargarArchivo">
                            <input type="hidden" name="tipo" value="cargarDemografico">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="tareas">
            <h4 class="text-center fw-bold my-3"><i class="bi bi-list-task"></i> Cargar Tarea</h4>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form id="formCargaTareas" class="formCarga" enctype="multipart/form-data" action="javascript:void(0);" data-id="formCargaTareas" data-controlador="carterasController" data-ajax="administracionCarga" data-tipo="Tareas">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><strong>Seleccione un tipo de tarea</strong></label>

                            <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-tasks"></i></div>

                                <select required class="form-select" name="tipo_tarea">
                                    <option value="">..Seleccione..</option>
                                    <option value="activa">Tarea Activa</option>
                                    <option value="asesor">Tarea Asesor</option>
                                    <option value="libre">Tarea Libre</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><strong>Nombre de la Tarea</strong></label>

                            <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-pencil"></i></div>
                                <input type="text" class="form-control" name="nombre_tarea" placeholder="Nombre de la tarea" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <label class="form-label">Subir Archivo desde una carpeta</label>
                            <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                            <input type="hidden" name="metodo" value="cargarArchivo">
                            <input type="hidden" name="tipo" value="cargarTarea">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="agendamientos">
            <h4 class="text-center fw-bold my-3"><i class="bi bi-list-task"></i> Cargar Agendamientos</h4>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form id="formCargaAgendamientos" class="formCarga" enctype="multipart/form-data" action="javascript:void(0);" data-id="formCargaAgendamientos" data-controlador="carterasController" data-ajax="administracionCarga" data-tipo="Agendamientos">
                        <div class="d-grid gap-2">
                            <label class="form-label">Subir Archivo desde una carpeta</label>
                            <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                            <input type="hidden" name="metodo" value="cargarArchivo">
                            <input type="hidden" name="tipo" value="cargarAgendamientos">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALS-->
    <div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus"></span> Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form id="formularioCreacionUsuarios" action="javascript:void(0);">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Nombre</strong></label>-->
                                    <div class="input-group">
                                        <div class="input-group-text"><span class="glyphicon glyphicon-pencil"></span></div>
                                        <input id="nombreCambio" value="" data-parsley-required class="form-control" name="nombre" type="text" placeholder="Nombre completo!">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario</strong></label>-->
                                    <div class="input-group">
                                        <div class="input-group-text"><span class="glyphicon glyphicon-user"></span></div>
                                        <input id="usuarioCambio" value="" data-parsley-required class="form-control" name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario Cliente</strong></label>-->
                                    <div class="input-group">
                                        <div class="input-group-text"><span class="glyphicon glyphicon-user"></span></div>
                                        <input value="" class="form-control" name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Identificación</strong></label>-->
                                    <div class="input-group">
                                        <div class="input-group-text"><span class="glyphicon glyphicon-credit-card"></span></div>
                                        <input id="focusedinput" value="" class="form-control" name="identificacion" type="text" placeholder="Ingrese el número de identificación" data-parsley-required data-parsley-type="number" data-parsley-minlength="6" data-parsley-maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Fecha Nacimiento</strong></label>-->
                                    <div class="input-group">
                                        <div class="input-group-text has-success"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input value="" class="form-control fecha" name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="metodo" value="crearNuevoUsuario">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="permisosUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Permisos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="editarPermisosInfo" class="col-md-10 col-md-offset-2">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="accionGuardarPermisos">Aplicar Cambios</button>
                </div>
            </div>
        </div>
    </div>

</div>
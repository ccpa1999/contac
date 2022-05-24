<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Carga</li>
</ol>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#asignacion" aria-controls="home" role="tab" data-toggle="tab">CARGAR ASIGNACIÓN</a></li>
                                <li role="presentation"><a href="#pagos" aria-controls="profile" role="tab" data-toggle="tab">CARGAR PAGOS</a></li>
                                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">CARGAR DEMOGRÁFICOS</a></li>
                                <!--<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">TELÉFONOS INACTIVOS</a></li>-->
                                <li role="presentation"><a href="#tareas" aria-controls="tareas" role="tab" data-toggle="tab">CARGAR TAREAS</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="asignacion">
                                    <form id="formCargaAsignacion" data-id="formCargaAsignacion" class="formCarga" data-tipo="Asignacion" enctype="multipart/form-data" action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">
                                                        <strong>Fecha vigencia</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                        <input type="text" class="form-control fecha" name="vigencia_asignacion" placeholder="Fecha Vigencia">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <label class="control-label">Subir Archivo desde una carpeta</label>
                                                <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                                                <input type="hidden" name="metodo" value="cargarArchivo">
                                                <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                <input type="hidden" name="tipo" value="cargarAsignacion">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="pagos">
                                    <form id="formCargaPagos" data-id="formCargaPagos" class="formCarga" data-tipo="Pagos" enctype="multipart/form-data" action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3">
                                                <label class="control-label">Subir Archivo desde una carpeta</label>
                                                <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                                                <input type="hidden" name="metodo" value="cargarArchivo">
                                                <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                <input type="hidden" name="tipo" value="cargarPagos">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages">...</div>
                                <div role="tabpanel" class="tab-pane" id="tareas">
                                    <form id="formCargaTareas" data-id="formCargaTareas" class="formCarga" data-tipo="Tareas" enctype="multipart/form-data" action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">
                                                                <strong>Seleccione un tipo de tarea</strong>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-tasks"></i>
                                                                </div>
                                                                <select class="form-control" name="tipo_tarea">
                                                                    <option value="">..Seleccione..</option>
                                                                    <option value="activa">Tarea Activa</option>
                                                                    <option value="asesor">Tarea Asesor</option>
                                                                    <option value="libre">Tarea Libre</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">
                                                                <strong>Nombre de la Tarea</strong>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                                <input type="text" class="form-control" name="nombre_tarea" placeholder="Nombre de la tarea">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-top: 2%;">
                                                <label class="control-label">Subir Archivo desde una carpeta</label>
                                                <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                                                <input type="hidden" name="metodo" value="cargarArchivo">
                                                <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                <input type="hidden" name="tipo" value="cargarTarea">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
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
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
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
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
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
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
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
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span></div>
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
                                    <div class="input-group-addon has-success"><span class="glyphicon glyphicon-calendar"></span></div>
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
<?php ?>
<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Clientes</li>
</ol>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row" style="padding-bottom: 30px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="asignacion">
                                    <form id="formCargaCliente" data-id="formCargaCliente" class="formCarga" data-ajax="administracionClientes" data-controlador="administracionController" enctype="multipart/form-data" action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="nombre_cliente"><strong>Nombre cliente</strong></label>
                                                <input type="text" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre Cliente" class="form-control">
                                            </div>
                                            <div class="col-md-6 ">
                                                <label class="control-label"><strong>Subir Archivo desde una carpeta</strong></label>
                                                <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                                                <input type="hidden" name="metodo" value="crearRegistro">
                                                <input type="hidden" name="tipo" value="crearCliente">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">
                                    <h3>CLIENTES</h3>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="row container-fluid">
                    <div id="resultadoBusquedaUsuarios">
                        <?php foreach ($datos['clientes'] as $cliente) : ?>
                            <?php if (isset($cliente['ruta_logo']) && $cliente['ruta_logo'] != '') : ?>
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img style="display: block; height: 100px; width: 160px" src="../../public/images/<?= $cliente['ruta_logo']; ?>" data-holder-rendered="true">
                                        <div class="caption" style="text-align: center;">
                                            <h3><?= ucwords($cliente['nombre_cliente']); ?> <span class="label label-<?= ($cliente['estado'] != 0)  ? 'success' : 'danger' ?>"><?= ($cliente['estado'] != 0)  ? 'Activo' : 'inactivo' ?></span></h3>
                                            <p>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-controlador="administracionController" data-ajax="administracionClientes" data-tipo="editarCliente" data-id="<?= $cliente['id_cliente'] ?>" href="#" role="button">
                                                    <span class="glyphicon glyphicon-edit"></span> Editar</a>
                                                <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-target="#myModal" data-ajax="administracionClientes" data-controlador="administracionController" data-accion="borrarCliente" data-id="<?= $cliente['id_cliente'] ?>" href="#" role="button">
                                                    <span class="glyphicon glyphicon-refresh"></span> <?= ($cliente['estado'] != 0)  ? 'INACTIVAR' : 'ACTIVAR' ?></a>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
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
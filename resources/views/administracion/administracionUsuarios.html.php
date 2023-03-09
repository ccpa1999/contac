<?php ?>

<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Usuarios</li>
</ol>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row" style="padding-bottom: 30px;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <button data-toggle="collapse" data-target="#formularioCreacion" title="AGREGAR USUARIO" data-parametro="formularioCrearUsuario" data-cartera="" data-identificacion="" data-formulario="formularioCreacionUsuario" class="btn btn-primary btn-lg btnFormularioCreacionRegistro">
                                    <i class="fa fa-plus"></i> Nuevo Usuario</button>
                            </div>
                        </div>
                        <div class="row">
                            <form id="formularioCreacion" data-id="formularioCreacion" class="formCarga collapse" data-ajax="administracionUsuarios" data-controlador="administracionController" enctype="multipart/form-data" action="javascript:void(0);">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="focusedinput"><strong>Nombre</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                                <input value="" data-parsley-required class="form-control nombreCambio" name="nombre" type="text" placeholder="Nombre completo!">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                                <input id="usuarioCambio" value="" data-parsley-required class="form-control" name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="focusedinput"><strong>Usuario Cliente</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                                <input value="" class="form-control" name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="focusedinput"><strong>Dirección Residencia</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="fa fa-map"></span></div>
                                                <input value="" class="form-control" name="direccion" type="text" placeholder="La dirección del usuario!">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="focusedinput"><strong>Teléfono Fijo</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="fa fa-phone"></span></div>
                                                <input value="" class="form-control" name="telefono_fijo" type="text" placeholder="Un teléfono fijo!">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="focusedinput"><strong>Teléfono Celular</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="fa fa-phone-square"></span></div>
                                                <input value="" class="form-control" name="telefono_celular" type="text" placeholder="El teléfono celular!">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" for="focusedinput"><strong>Identificación</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span></div>
                                                <input id="focusedinput" value="" class="form-control" name="identificacion" type="text" placeholder="Ingrese el número de identificación" data-parsley-required data-parsley-type="number" data-parsley-minlength="6" data-parsley-maxlength="10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="form-group">
                                            <label class="col-sm-12 control-label" for="focusedinput"><strong>Fecha Nacimiento</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-addon has-success"><span class="glyphicon glyphicon-calendar"></span></div>
                                                <input value="" class="form-control fecha" name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <input data-toggle="collapse" data-target="#formularioCreacion" type="submit" class="btn btn-primary" name="metodo" value="Crear Usuario">
                                <input type="hidden" name="metodo" value="crearRegistro">
                                <input type="hidden" name="tipo" value="crearNuevoUsuario">
                            </form>
                        </div>
                    </div>
                    <hr />
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
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group in-grp1">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-search"></i>
                            </span>
                            <input class="form-control busqueda" type="text" placeholder="Búsqueda Usuario" autocomplete="off" maxlength="50" data-div-resultado="resultadoBusquedaUsuarios" data-metodo="buscarUsuarios">
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">
                                    <h3>USUARIOS</h3>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="row container-fluid">
                    <div id="resultadoBusquedaUsuarios">
                        <?php foreach ($datos['usuarios'] as $usuario) : ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <!--<img alt="100%x200" data-src="holder.js/100%x200" style="display: block;" src="../../public/images/1476391269_human.png" data-holder-rendered="true">-->
                                    <center><i class="fa fa-user-o fa-4x success"></i></center>
                                    <div class="caption" style="text-align: center;">
                                        <h3><?= ucwords($usuario['nombre_completo']); ?></h3>
                                        <p>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><strong>Usuario:</strong></label>
                                            <h4><span class="label label-success"><?= $usuario['usuario'] ?></span></h4>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Fecha Creación:</strong></label>
                                            <h4><span class="label label-warning"><?= $usuario['fecha_creacion'] ?></span></h4>
                                        </div>
                                        </p>
                                        <p>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarUsuario" data-controlador="administracionController" data-id="<?= $usuario['id_usuario'] ?>" href="#" role="button">
                                                <span class="glyphicon glyphicon-edit"></span> Editar</a>
                                            <!-- <a class="btn btn-primary reestablecerContraseña" title="Reestablecer Contraseña" data-ajax="administracionUsuarios" data-controlador="administracionController" data-id="<?= $usuario['id_usuario'] ?>" href="#">
                                                <span class="fa fa-lock"></span> Reestablecer</a> -->
                                            <a class="btn btn-primary obtenerPermisos" data-toggle="modal" data-target="#permisosUsuario" data-controlador="administracionController" data-idenUsuario="<?= $usuario['identificacion']; ?>" data-usuario="<?= $usuario['id_usuario'] ?>" href="#" role="button">
                                                <span class="glyphicon glyphicon-fire"></span> Permisos</a>
                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-target="#myModal" data-ajax="administracionUsuarios" data-controlador="administracionController" data-accion="borrarUsuario" data-id="<?= $usuario['id_usuario'] ?>" href="#" role="button">
                                                <span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                <!--<form id="formularioCreacionUsuarios" action="javascript:void(0);">-->
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
                <!--                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input id="usuarioCambio" value="" data-parsley-required class="form-control"
                                           name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
                                </div>
                            </div>
                        </div>
                    </div>-->
                <!--                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario Cliente</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input value="" class="form-control"
                                           name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
                                </div>
                            </div>
                        </div>
                    </div>-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario Cliente</strong></label>-->
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-map"></span></div>
                                <input value="" class="form-control" name="direccion" type="text" placeholder="La dirección del usuario!">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario Cliente</strong></label>-->
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-phone"></span></div>
                                <input value="" class="form-control" name="telefono_fijo" type="text" placeholder="Un teléfono fijo!">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario Cliente</strong></label>-->
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-mobile fa-2x"></span></div>
                                <input value="" class="form-control" name="telefono_movil" type="text" placeholder="El teléfono celular!">
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
                <button type="button" data-controlador="administracionController" class="btn btn-primary" id="accionGuardarPermisos">Aplicar Cambios</button>
            </div>
        </div>
    </div>
</div>
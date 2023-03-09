<?php ?>

<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Roles</li>
</ol>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1" >
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <h3>ROLES</h3>
                            </a>
                        </div>
                    </div>
                </nav>
                <div class="row">
                    <div class="col-md-12">
                        <form id="formCargaRol" data-id="formCargaRol" data-ajax="administracionRoles" class="form-inline formCarga" data-controlador="administracionController" action="javascript:void">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                    <input  value="" required class="form-control" 
                                            name="nombre_rol" type="text" placeholder="Nombre Rol">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo Rol</button>
                            <input type="hidden" id="metodo" name="metodo" value="crearRegistro">
                            <input type="hidden" id="tipo" name="tipo" value="crearRol">
                        </form>
                    </div>
                </div>
                <br />
                <div class="row container-fluid">
                    <table class="table table-bordered table-responsive">
                        <thead class="thead-success">
                            <tr>
                                <th>#</th>
                                <th>
                                    <div class="input-group in-grp1">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </span>
                                        <input class="form-control busqueda" type="text" 
                                               placeholder="Rol" autocomplete="off" maxlength="50" 
                                               data-div-resultado="resultadoBusquedaRoles"
                                               data-metodo="buscarRoles">
                                        <!--</div>-->
                                    </div>
                                </th>
                                <th>Estado</th>
                                <th>Acción</th>

                            </tr>
                        </thead>
                        <tbody>
                        <div id="resultadoBusquedaRoles">
                            <?php
                            $cont = 1;
                            foreach ($datos['roles'] as $rol):
                                $clase = ($rol['estado'] == 1) ? 'label-success' : 'label-danger';
                                $estado = ($rol['estado'] == 1) ? 'ACTIVO' : 'INACTIVO';
                                ?>
                                <tr style="text-align: center;">
                                    <th scope="row"><?= $cont; ?></th>
                                    <td><?= ucwords($rol['rol']); ?></td>
                                    <td><label class="label <?= $clase; ?>"><?= $estado; ?></label></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a class="btn btn-primary formularioEditarRegistro" data-controlador="administracionController" data-toggle="modal" 
                                               data-target="#editarRegistro" data-tipo="editarRoles" data-id="<?= $rol['id_rol'] ?>" href="#" role="button">
                                                <span class="glyphicon glyphicon-edit"></span> Editar</a>
                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-ajax="administracionRoles"
                                               data-target="#myModal" data-controlador="administracionController" data-accion="borrarRol" data-id="<?= $rol['id_rol'] ?>" href="#" role="button">
                                                <span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $cont ++;
                            endforeach;
                            ?>
                        </div>
                        </tbody>
                    </table>
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
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus"></span>  Agregar Usuario</h4>
            </div>
            <div class="modal-body" >
                <form id="formularioCreacionUsuarios" action="javascript:void(0);">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <!--<label class="col-sm-2 control-label" for="focusedinput"><strong>Nombre</strong></label>-->
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                    <input id="nombreCambio" value="" data-parsley-required class="form-control"
                                           name="nombre" type="text" placeholder="Nombre completo!">
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
                                    <input id="usuarioCambio" value="" data-parsley-required class="form-control"
                                           name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
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
                                    <input value="" class="form-control"
                                           name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
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
                                    <input id="focusedinput" value="" class="form-control" 
                                           name="identificacion" type="text"
                                           placeholder="Ingrese el número de identificación" data-parsley-required
                                           data-parsley-type="number" 
                                           data-parsley-minlength="6" data-parsley-maxlength="10">
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
                                    <input  value="" class="form-control fecha" 
                                            name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
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



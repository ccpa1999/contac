<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Informes</li>
</ol>
<div class="row">
    <form id="formularioGenerar" action="javascript:void(0);">
        <div class="col-md-5 col-sm-5 col-xs-5 switch">
            <div class="switch-right-grid">
                <div class="switch-right-grid1" >
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                           <div class="input-group">
                                <div class="input-group-addon has-success">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                                <input class="form-control fecha" value="" name="fecha_inicial" data-parsley-required data-provide="datepicker" placeholder="Fecha Inicio" type="text">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                            <div class="input-group">
                                <div class="input-group-addon has-success">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                                <input class="form-control fecha" data-parsley-required value="" name="fecha_final" data-provide="datepicker" placeholder="Fecha Final" type="text">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                            <select class="form-control" name="informe" data-parsley-required>
                              <option value="">..Informe..</option>
                              <option value='gestion'>Gestión</option>
                              <option value='productividad'>Productividad</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-4">
                            <button type="submit" id="generarInforme" class="btn btn-lg btn-primary"><i class="fa fa-cloud-upload"></i>  Generar</button>
                        </div>
                    </div>
                    <br />
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="generarInforme">
        <input type="hidden" name="cartera" value="<?php echo $cartera;?>">
    </form>
    <div class="col-md-7 col-sm-7 col-sm-7 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1" >
                <div class="row">
                    <div class="col-md-12">
                       <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                 <div class="navbar-header">
                                    <a class="navbar-brand" href="#">
                                     <h3><i class="fa fa-folder-open"></i> MIS ARCHIVOS</h3>
                                    </a>
                                  </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr class="info">
                                    <th>Archivo</th>
                                    <th>Fechas</th>
                                    <th>Acciones</th>                        
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($archivos as $archivo):?>
                                <tr>
                                    <td><?php echo $archivo['Nombre'];?></td>
                                    <td><?php echo date ("m/d/Y", $archivo['Modificado']);?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a class="btn btn-primary formularioEditarRegistro" title="Descargar" href="<?php echo $archivo['Ruta'];?>">
                                                <span class="fa fa-download"></span>
                                            </a>
                                            <a class="btn btn-primary eliminarArchivo" data-metodo="administracionInformes" data-controlador="administracionController" data-accion="borrarArchivo" data-archivo="<?php echo $archivo['Nombre'];?>" href="#" title="Eliminar">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
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



<?php if ($parametro == 'telefono'): ?>
    <form class="formularioCreacion" id="formCreacionTelefono" action="javascript:void(0);" data-metodo="buscarDeudorRecarga" data-tipo="cedula" data-dato="<?= $datos['identificacion'];?>" data-controlador="carterasController.php">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo Teléfono</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <select class="form-control" name="tipo">
                        <option value="">..seleccione..</option>
                        <option value="celular">Celular</option>
                        <option value="otro celular">Otro Celular</option>
                        <option value="telefono residencia">Teléfono Residencia</option>
                        <option value="otro telefono">Otro Teléfono</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Teléfono</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" required name="telefono" placeholder="Ingrese el teléfono" class="form-control">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="creacionRegistro">
        <input type="hidden" id="accion" name="accion" value="crearTelefono">
        <input type="hidden" name="identificacion" value="<?= $datos['identificacion']; ?>">
        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
    </form>
<?php elseif ($parametro == 'formularioCrearUsuario'): ?>
    <form class="formularioCreacion" id="formularioCreacionUsuario" action="javascript:void(0);" data-controlador="administracionController.php" 
          data-metodo="administracionUsuarios">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="focusedinput"><strong>Nombre</strong></label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                        <input value="" data-parsley-required class="form-control nombreCambio"
                               name="nombre" type="text" placeholder="Nombre completo!">
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="focusedinput"><strong>Usuario</strong></label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input id="usuarioCambio" value="" data-parsley-required class="form-control"
                               name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
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
                        <input value="" class="form-control"
                               name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label class="col-sm-12 control-label" for="focusedinput"><strong>Dirección Residencia</strong></label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="fa fa-map"></span></div>
                        <input value="" class="form-control"
                               name="direccion" type="text" placeholder="La dirección del usuario!">
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
                        <input value="" class="form-control"
                               name="telefono_fijo" type="text" placeholder="Un teléfono fijo!">
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label class="col-sm-12 control-label" for="focusedinput"><strong>Teléfono Celular</strong></label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="fa fa-phone-square"></span></div>
                        <input value="" class="form-control"
                               name="telefono_celular" type="text" placeholder="El teléfono celular!">
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
                        <input id="focusedinput" value="" class="form-control" 
                               name="identificacion" type="text"
                               placeholder="Ingrese el número de identificación" data-parsley-required
                               data-parsley-type="number" 
                               data-parsley-minlength="6" data-parsley-maxlength="10">
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label class="col-sm-12 control-label" for="focusedinput"><strong>Fecha Nacimiento</strong></label>
                    <div class="input-group">
                        <div class="input-group-addon has-success"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input value="" class="form-control fecha" 
                            name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
                    </div>
                </div>
            </div>
        </div>
        <br />
        <input type="hidden" name="metodo" value="crearNuevoUsuario">
        <!--<input type="submit" value="Guardar Cambios" class="btn btn-success">-->
    </form>
<!--    <div class="modal-footer">
        <input class="btnEnviarFormulario btn btn-success" data-formulario="formularioCreacionUsuario" value="Guardar Cambios">
    </div>-->
<?php elseif ($parametro == 'formularioCrearUsuario'): ?>
    <form class="formularioCreacion" action="javascript:void(0);" data-metodo="refrescarHistorico" data-controlador="carterasController.php">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo Teléfono</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <select class="form-control" name="tipo">
                        <option value="">..seleccione..</option>
                        <option value="celular">Celular</option>
                        <option value="otro celular">Otro Celular</option>
                        <option value="telefono residencia">Teléfono Residencia</option>
                        <option value="otro telefono">Otro Teléfono</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Teléfono</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" required name="telefono" placeholder="Ingrese el teléfono" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2 col-xs-offset-9">
                <input class="btn btn-info" type="submit" value="CREAR">
            </div>
        </div>
        <input type="hidden" name="metodo" value="creacionRegistro">
        <input type="hidden" id="accion" name="accion" value="crearTelefono">
        <input type="hidden" name="identificacion" value="<?= $datos['identificacion']; ?>">
        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
    </form>
<?php endif; ?>
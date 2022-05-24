<?php if ($parametro == 'formularioPermisos'): ?>
    <div class="btn-group" role="group"  data-toggle="buttons" aria-label="...">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        $cont = 0;
                        foreach ($clientes as $cliente):
                            ?>
                            <li role="presentation"><a href="#cliente_<?php echo $cont; ?>" aria-controls="#cliente_<?php echo $cont; ?>" role="tab" data-toggle="tab"><?php echo $cliente['nombre_cliente'] ?></a></li>
                            <?php
                            $cont ++;
                        endforeach;
                        ?>
                    </ul>
                    <form id="formGuardarPermisos" action="javascript:void(0);">
                        <div class="tab-content">
                            <?php
                            $cont = 0;
                            foreach ($clientes as $cliente):
                                ?>
                                <div role="tabpanel" class="tab-pane" id="cliente_<?php echo $cont; ?>">
                                    <select class="form-control" name="permisos[<?php echo $cont; ?>]">
                                        <option value="<?php echo $cliente['id_cliente']; ?>,0,<?php echo $usuario; ?>">..Seleccione..</option>
                                        <?php
                                        $contador = 0;
                                        foreach ($roles as $rol):
                                            foreach ($permisos as $permiso) {
                                                if ($permiso['id_rol'] == $rol['id_rol'] &&
                                                        $permiso['id_cliente'] == $cliente['id_cliente']) {
                                                    $propiedad = 'selected';
                                                    break;
                                                } else {
                                                    $propiedad = '';
                                                }
                                            }
                                            ?>
                                            <option <?php echo $propiedad; ?> value="<?php echo $cliente['id_cliente']; ?>,<?php echo $rol['id_rol']; ?>,<?php echo $usuario; ?>"
                                                                              ><?php echo $rol['rol']; ?></option>

                                            <?php
                                            $contador++;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                </label>
                                <?php
                                $cont++;
                            endforeach;
                            ?>
                        </div>
                        <input type="hidden" name="metodo" value="guardarPermisos">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'editarUsuario'): ?>
    <div class="row">
        <div class="col-md-7">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Nombre</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="nombreCambio" value="<?php echo $datos[0]['nombre_completo']; ?>" data-parsley-required class="form-control"
                                       name="nombre" type="text" placeholder="Nombre completo!">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Usuario</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input id="usuarioCambio" value="<?php echo $datos[0]['usuario']; ?>" data-parsley-required class="form-control"
                                       name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Usuario del Cliente</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input value="<?php echo $datos[0]['homologado']; ?>" class="form-control"
                                       name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Número de Identificación</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span></div>
                                <input id="focusedinput" value="<?php echo $datos[0]['identificacion']; ?>" class="form-control" 
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
                            <label><strong>Fecha de Nacimiento</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon has-success"><span class="glyphicon glyphicon-calendar"></span></div>
                                <input  value="<?php echo $datos[0]['fecha_nacimiento']; ?>" class="form-control fecha" 
                                        name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        <label for="exampleRadios1"><strong>Contraseña</strong></label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="cambio_contraseña" id="exampleRadios1" value="mantener" checked>
                                Mantener contraseña actual
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="cambio_contraseña" id="exampleRadios1" value="cambiar">
                                Cambiar Contraseña
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarRegistro">
                <input type="hidden" name="accion" value="editarUsuario">
                <input type="hidden" name="" value="editarRegistro">
            </form>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <span class="glyphicon glyphicon-user info" style="font-size: 180px;"></span>
        </div>
    </div>

<?php endif; ?>
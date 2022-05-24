<?php if ($parametro == 'formularioPermisos') : ?>
    <div class="btn-group" role="group" data-toggle="buttons" aria-label="...">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        $cont = 0;
                        foreach ($clientes as $cliente) :
                        ?>
                            <li role="presentation"><a href="#cliente_<?php echo $cont; ?>" aria-controls="#cliente_<?php echo $cont; ?>" role="tab" data-toggle="tab"><?php echo $cliente['nombre_cliente'] ?></a></li>
                        <?php
                            $cont++;
                        endforeach;
                        ?>
                    </ul>
                    <form id="formGuardarPermisos" action="javascript:void(0);">
                        <div class="tab-content">
                            <?php
                            $cont = 0;
                            foreach ($clientes as $cliente) :
                            ?>
                                <div role="tabpanel" class="tab-pane" id="cliente_<?php echo $cont; ?>">
                                    <select class="form-control" name="permisos[<?php echo $cont; ?>]">
                                        <option value="<?php echo $cliente['id_cliente']; ?>,0,<?php echo $usuario; ?>">..Seleccione..</option>
                                        <?php
                                        $contador = 0;
                                        foreach ($roles as $rol) :
                                            $propiedad = '';
                                            foreach ($permisos as $permiso) {
                                                if (
                                                    $permiso['id_rol'] == $rol['id_rol'] &&
                                                    $permiso['id_cliente'] == $cliente['id_cliente']
                                                ) {
                                                    $propiedad = 'selected';
                                                    break;
                                                }
                                            }
                                        ?>
                                            <option <?php echo $propiedad; ?> value="<?php echo $cliente['id_cliente']; ?>,<?php echo $rol['id_rol']; ?>,<?php echo $usuario; ?>,<?php echo $identificacion; ?>"><?php echo $rol['rol']; ?></option>

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
                        <input type="hidden" name="cedula" value="<?php echo $identificacion ?>">
                        <input type="hidden" name="metodo" value="guardarPermisos">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'editarUsuario') : ?>
    <div class="row">
        <div class="col-md-7">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Nombre</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="nombreCambio" value="<?php echo $datos[0]['nombre_completo']; ?>" data-parsley-required class="form-control" name="nombre" type="text" placeholder="Nombre completo!">
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
                                <input id="usuarioCambio" value="<?php echo $datos[0]['usuario']; ?>" data-parsley-required class="form-control" name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
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
                                <input value="<?php echo $datos[0]['homologado']; ?>" class="form-control" name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
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
                                <input id="focusedinput" value="<?php echo $datos[0]['identificacion']; ?>" class="form-control" name="identificacion" type="text" placeholder="Ingrese el número de identificación" data-parsley-required data-parsley-type="number" data-parsley-minlength="6" data-parsley-maxlength="10">
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
                                <input value="<?php echo $datos[0]['fecha_nacimiento']; ?>" class="form-control fecha" name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
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
<?php elseif ($parametro == 'editarTelefono') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Teléfono</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="telefonoCambio" value="<?php echo $datos[0]['telefono']; ?>" data-parsley-required required="" class="form-control" name="telefono" type="text" placeholder="Teléfono">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Tipo Teléfono</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <select class="form-control" data-parsley-required required="" name="tipo" id="tipoDemografico">
                                    <option value="">..seleccione..</option>
                                    <option value="celular">Celular</option>
                                    <option value="celular oficina">Celular Oficina</option>
                                    <option value="otro celular">Otro Celular</option>
                                    <option value="otro teléfono">Otro Teléfono</option>
                                    <option value="teléfono oficina">Teléfono Oficina</option>
                                    <option value="teléfono residencia">Teléfono Residencia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Hora disponibilidad</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input class="form-control" type="text" name="hora" id="hora">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Estado</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <select class="form-control" data-parsley-required required="" name="estado" id="estadoDemo">
                                    <option value="">..seleccione..</option>
                                    <option value="0">Ilocalizado</option>
                                    <option value="1">Principal</option>
                                    <option value="2">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarDemografico">
                <input type="hidden" name="accion" value="editarTelefono">
                <input type="hidden" name="div" value="divTelefonos">
                <input type="hidden" name="cedula_deudor" value="<?php echo $datos[0]['cedula_deudor'] ?>">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id_telefono']; ?>">
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'editarEmail') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                        <div class="form-group">
                            <label><strong>Email</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="emailCambio" value="<?php echo $datos[0]['correo']; ?>" data-parsley-required required="" class="form-control" name="correo" type="text" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group">
                            <label><strong>Tipo Email</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <select class="form-control" data-parsley-required="" name="tipo" id="tipoDemografico">
                                    <option value="">..seleccione..</option>
                                    <option value="email personal">E-mail Personal</option>
                                    <option value="email oficina">E-mail Oficina</option>
                                    <option value="otro email">Otro E-mail</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Estado</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <select class="form-control" data-parsley-required required="" name="estado" id="estadoDemo">
                                    <option value="">..seleccione..</option>
                                    <option value="0">Ilocalizado</option>
                                    <option value="1">Principal</option>
                                    <option value="2">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarDemografico">
                <input type="hidden" name="accion" value="editarEmail">
                <input type="hidden" name="div" value="divCorreos">
                <input type="hidden" name="cedula_deudor" value="<?php echo $datos[0]['cedula_deudor'] ?>">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id_correo']; ?>">
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'editarDireccion') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><strong>Ciudad</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="ciudadCambio" value="<?php echo $datos[0]['ciudad']; ?>" data-parsley-required class="form-control" name="ciudad" type="text" placeholder="Ciudad">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2">
                        <div class="form-group">
                            <label><strong>Tipo Direccion</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <select class="form-control" data-parsley-required="" name="tipo" id="tipoDemografico">
                                    <option value="">..seleccione..</option>
                                    <option value="direccion residencia">Dirección Residencia</option>
                                    <option value="direccion empresarial">Dirección Empresarial</option>
                                    <option value="otra direccion">Otra Dirección</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><strong>Direccion</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="direccionCambio" value="<?php echo $datos[0]['direccion']; ?>" data-parsley-required class="form-control" name="direccion" type="text" placeholder="Direccion">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2">
                        <div class="form-group">
                            <label><strong>Estado</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <select class="form-control" data-parsley-required required="" name="estado" id="estadoDemo">
                                    <option value="">..seleccione..</option>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarDemografico">
                <input type="hidden" name="accion" value="editarDireccion">
                <input type="hidden" name="div" value="divDirecciones">
                <input type="hidden" name="cedula_deudor" value="<?php echo $datos[0]['cedula_deudor'] ?>">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id_direccion']; ?>">
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarAccion') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><strong>Acción</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?php echo $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Acción">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarHomologado">
                <input type="hidden" name="accion" value="editarAccion">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id']; ?>">
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarContacto') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><strong>Contacto</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?php echo $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Direccion">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarHomologado">
                <input type="hidden" name="accion" value="editarContactos">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id']; ?>">
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarEfecto') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><strong>Efecto</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?php echo $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Efecto">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarHomologado">
                <input type="hidden" name="accion" value="editarEfectos">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id']; ?>">
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarMotivo') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label><strong>Motivo de no pago</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?php echo $datos[0]['motivo']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Motivo">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="metodo" value="editarHomologado">
                <input type="hidden" name="accion" value="editarMotivo">
                <input type="hidden" name="id" value="<?php echo $datos[0]['id']; ?>">
            </form>
        </div>
    </div>
    
<?php endif; ?>
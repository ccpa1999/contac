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
                            <li role="presentation"><a href="#cliente_<?= $cont; ?>" aria-controls="#cliente_<?= $cont; ?>" role="tab" data-toggle="tab"><?= $cliente['nombre_cliente'] ?></a></li>
                        <?php
                            $cont++;
                        endforeach;
                        ?>
                    </ul>
                    <form id="formGuardarPermisos" data-id="formGuardarPermisos" data-controlador="administracionController" class="formCarga" action="javascript:void(0);">
                        <div class="tab-content">
                            <?php
                            $cont = 0;
                            foreach ($clientes as $cliente) :
                            ?>
                                <div role="tabpanel" class="tab-pane" id="cliente_<?= $cont; ?>">
                                    <select class="form-control" name="permisos[<?= $cont; ?>]">
                                        <option value="<?= $cliente['id_cliente']; ?>,0,<?= $usuario; ?>">..Seleccione..</option>
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
                                            <option <?= $propiedad; ?> value="<?= $cliente['id_cliente']; ?>,<?= $rol['id_rol']; ?>,<?= $usuario; ?>,<?= $identificacion; ?>"><?= $rol['rol']; ?></option>

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
                        <input type="hidden" name="cedula" value="<?= $identificacion ?>">
                        <input type="hidden" name="metodo" value="guardarPermisos">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($parametro == 'editarCliente') : ?>
    <form id="formEditarCliente" data-ajax="administracionClientes" data-id="formEditarCliente" class="formCarga" data-controlador="administracionController" enctype="multipart/form-data" action="javascript:void(0);">
        <div class="row">
            <div class="col-md-6">
                <label for="nombre_cliente"><strong>Nombre cliente</strong></label>
                <input type="text" name="nombre_cliente" placeholder="Nombre Cliente" class="form-control" value="<?= ($datos[0]['nombre_cliente'] != '') ? $datos[0]['nombre_cliente'] : '' ?>">
            </div>
            <div class="col-md-6 ">
                <label class="control-label"><strong>Subir Archivo desde una carpeta</strong></label>
                <input type="file" name="archivo" readyonly class="file-loading inputCarga">
                <input type="hidden" name="id" value="<?= $datos[0]['id_cliente']; ?>">
                <input type="hidden" name="metodo" value="crearRegistro">
                <input type="hidden" name="tipo" value="crearCliente">
            </div>
        </div>
    </form>
<?php elseif ($parametro == 'editarRoles') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formEditarRol" data-id="formEditarRol" data-ajax="administracionRoles" class="form-inline col-md-12 formCarga" data-controlador="administracionController" action="javascript:void(0)">
                <div class="form-group col-md-9">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="fa fa-pencil-square"></span></div>
                        <input value="<?= $datos[0]['rol']; ?>" required class="form-control" name="nombre_rol" type="text" placeholder="Nombre Rol">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Guardar Rol</button>
                    <input type="hidden" id="metodo" name="metodo" value="crearRegistro">
                    <input type="hidden" name="id" value="<?= $datos[0]['id_rol']; ?>">
                    <input type="hidden" id="accion" name="tipo" value="crearRol">
                </div>
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'editarUsuario') : ?>
    <div class="row">
        <div class="col-md-7">
            <form id="formEditarRol" data-id="formEditarRol" data-ajax="administracionUsuarios" class="col-md-12 formCarga" data-controlador="administracionController" action="javascript:void(0)">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><strong>Nombre</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-pencil-square" id="basic-addon3"></span></div>
                                <input id="nombreCambio" value="<?= $datos[0]['nombre_completo']; ?>" data-parsley-required class="form-control" name="nombre" type="text" placeholder="Nombre completo!">
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
                                <input id="usuarioCambio" value="<?= $datos[0]['usuario']; ?>" data-parsley-required class="form-control" name="usuario" type="text" placeholder="El nombre de usuario!" readonly>
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
                                <input value="<?= $datos[0]['homologado']; ?>" class="form-control" name="usuario_cliente" type="text" placeholder="El nombre de usuario!">
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
                                <input id="focusedinput" value="<?= $datos[0]['identificacion']; ?>" class="form-control" name="identificacion" type="text" placeholder="Ingrese el número de identificación" data-parsley-required data-parsley-type="number" data-parsley-minlength="6" data-parsley-maxlength="10">
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
                                <input value="<?= $datos[0]['fecha_nacimiento']; ?>" class="form-control fecha" name="fecha_nacimiento" data-provide="datepicker" type="text" placeholder="Fecha Nacimiento">
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
                <input type="submit" class="btn btn-primary" value="Enviar">
                <input type="hidden" name="metodo" value="crearRegistro">
                <input type="hidden" name="tipo" value="crearNuevoUsuario">
                <input type="hidden" name="id" value="<?= $datos[0]['id_usuario']; ?>">
            </form>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <span class="glyphicon glyphicon-user info" style="font-size: 180px;"></span>
        </div>
    </div>

<?php elseif ($parametro == 'EditarAccion') : ?>
    <form id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro">
        <div class="mb-2">
            <div class="form-group">
                <label class="form-label"><strong>Acción</strong></label>

                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-pencil-square" id="basic-addon3"></i></div>
                    <input id="homologadoCambio" value="<?= $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Acción">
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Actualizar Registro</button>
            <input type="hidden" name="metodo" value="crearHomologado">
            <input type="hidden" name="tipo" value="accion">
            <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
        </div>
    </form>
<?php elseif ($parametro == 'EditarContacto') : ?>
    <form id="formularioEdicionRegistro" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);">
        <div class="mb-2">
            <label class="form-label"><strong>Contacto</strong></label>
            <div class="input-group">
                <div class="input-group-text"><span class="fa fa-pencil-square" id="basic-addon3"></span></div>
                <input id="homologadoCambio" value="<?= $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Direccion">
            </div>
        </div>

        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Actualizar Registro</button>
            <input type="hidden" name="metodo" value="crearHomologado">
            <input type="hidden" name="tipo" value="contacto">
            <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
        </div>
    </form>
<?php elseif ($parametro == 'EditarEfecto') : ?>
    <form id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro">
        <div class="mb-2">
            <label class="form-label"><strong>Efecto</strong></label>
            <div class="input-group mb-2">
                <div class="input-group-text"><i class="fa fa-pencil-square" id="basic-addon3"></i></div>
                <input id="homologadoCambio" value="<?= $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Efecto">
            </div>
            <div class="input-group">
                <div class="input-group-text"><i class="fa fa-pencil-square" id="basic-addon3"></i></div>
                <select class="form-select" required name="efectividad">
                    <option <?= ($datos[0]['efectividad'] === "null") ? 'selected' : '' ;?>>SELECCIONE...</option>
                    <option <?= ($datos[0]['efectividad'] === "0") ? 'selected' : '' ;?> value="0">NO CONTACTO</option>
                    <option <?= ($datos[0]['efectividad'] === "1") ? 'selected' : '' ;?> value="1">CONTACTO CIERRE EXITOSO</option>
                    <option <?= ($datos[0]['efectividad'] === "2") ? 'selected' : '' ;?> value="2">CONTACTO CIERRE NO EXITOSO</option>
                </select>
            </div>
        </div>

        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Actualizar Registro</button>
            <input type="hidden" name="metodo" value="crearHomologado">
            <input type="hidden" name="tipo" value="efecto">
            <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
        </div>
    </form>
<?php elseif ($parametro == 'EditarMotivo') : ?>
    <form id="formularioEdicionRegistro" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);">
        <div class="mb-2">
            <label class="form-label"><strong>Motivo de no pago</strong></label>
            <div class="input-group">
                <div class="input-group-text"><i class="fa fa-pencil-square" id="basic-addon3"></i></div>
                <input id="homologadoCambio" value="<?= $datos[0]['motivo']; ?>" data-parsley-required class="form-control" name="motivo" type="text" placeholder="Motivo">
            </div>
        </div>

        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Actualizar Registro</button>

            <input type="hidden" name="metodo" value="crearHomologado">
            <input type="hidden" name="tipo" value="motivo">
            <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
        </div>
    </form>
<?php elseif ($parametro == 'editarTelefono') : ?>
    <form id="formularioEdicionTelefono" class="formCarga" action="javascript:void(0);" data-id="formularioEdicionTelefono" data-controlador="carterasController">

        <div class="mb-3">
            <label class="form-label"><strong>Teléfono</strong></label>

            <div class="input-group">
                <div class="input-group-text"><span class="fa fa-pencil-square" id="basic-text3"></span></div>
                <input id="telefonoCambio" value="<?= $datos[0]['telefono']; ?>" class="form-control" name="telefono" type="text" placeholder="Teléfono" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Tipo Teléfono</strong></label>

            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-phone-flip"></span></div>

                <select value="<?= $datos[0]['tipo_telefono'] ?>" class="form-select" name="tipo" id="tipoDemografico" required>
                    <option value="">..seleccione..</option>
                    <option <?= ($this->codificarCaracteres($datos[0]['tipo_telefono']) == "celular") ? 'selected' : ''; ?> value="celular">Celular</option>
                    <option <?= ($this->codificarCaracteres($datos[0]['tipo_telefono']) == "celular oficina") ? 'selected' : ''; ?> value="celular oficina">Celular Oficina</option>
                    <option <?= ($this->codificarCaracteres($datos[0]['tipo_telefono']) == "otro celular") ? 'selected' : ''; ?> value="otro celular">Otro Celular</option>
                    <option <?= ($this->codificarCaracteres($datos[0]['tipo_telefono']) == "otro teléfono") ? 'selected' : ''; ?> value="otro teléfono">Otro Teléfono</option>
                    <option <?= ($this->codificarCaracteres($datos[0]['tipo_telefono']) == "teléfono oficina") ? 'selected' : ''; ?> value="teléfono oficina">Teléfono Oficina</option>
                    <option <?= ($this->codificarCaracteres($datos[0]['tipo_telefono']) == "teléfono residencia") ? 'selected' : ''; ?> value="teléfono residencia">Teléfono Residencia</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Disponibilidad</strong></label>

            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-clock-history"></span></div>
                <input value="<?= $datos[0]['hora_disponibilidad'] ?>" class="form-control hora" type="text" name="hora" id="hora">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Estado</strong></label>

            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-capsule"></span></div>

                <select class="form-select" name="estado" id="estadoDemo" value="<?= $datos[0]['estado'] ?>">
                    <option value="">seleccione...</option>

                    <option <?= ($datos[0]['estado'] == 0) ? 'selected' : ''; ?> value="0">Ilocalizado</option>
                    <option <?= ($datos[0]['estado'] == 1) ? 'selected' : ''; ?> value="1">Principal</option>
                    <option <?= ($datos[0]['estado'] == 2) ? 'selected' : ''; ?> value="2">Otro</option>
                </select>
            </div>
        </div>

        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Actualizar Teléfono</button>

            <input type="hidden" name="metodo" value="creacionDemografico">
            <input type="hidden" id="accion" name="accion" value="crearTelefono">
            <input type="hidden" name="div" value="divTelefonos">
            <input type="hidden" name="id" value="<?= $datos[0]['id_telefono']; ?>">
            <input type="hidden" name="identificacion" value="<?= $datos[0]['cedula_deudor'] ?>">
        </div>
        </div>
    </form>
<?php elseif ($parametro == 'editarEmail') : ?>
    <form id="formularioEdicionEmail" class="formCarga" action="javascript:void(0);" data-id="formularioEdicionEmail" data-controlador="carterasController">
        <div class="mb-3">
            <label class="form-label"><strong>E-mail</strong></label>

            <div class="input-group">
                <div class="input-group-text"><i class="bi bi-envelope-check" id="basic-addon3"></i></div>

                <input id="emailCambio" value="<?= $datos[0]['correo']; ?>" required="" class="form-control" data-parsley-required name="email" type="text" placeholder="Email">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Tipo E-mail</strong></label>

            <div class="input-group">
                <div class="input-group-text"><i class="bi bi-envelope-at"></i></div>

                <select class="form-select" data-parsley-required="" name="tipo" id="tipoDemografico">
                    <option value="">..seleccione..</option>
                    <option <?= ($datos[0]['tipo'] == 'email personal') ? 'selected' : '' ?> value="email personal">E-mail Personal</option>
                    <option <?= ($datos[0]['tipo'] == 'email oficina') ? 'selected' : '' ?> value="email oficina">E-mail Oficina</option>
                    <option <?= ($datos[0]['tipo'] == 'otro email') ? 'selected' : '' ?> value="otro email">Otro E-mail</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Estado</strong></label>

            <div class="input-group">
                <div class="input-group-text"><i class="bi bi-capsule"></i></div>

                <select class="form-select" data-parsley-required required="" name="estado" id="estadoDemo">
                    <option value="">..seleccione..</option>
                    <option <?= ($datos[0]['estado'] == 0) ? 'selected' : ''; ?> value="0">Ilocalizado</option>
                    <option <?= ($datos[0]['estado'] == 1) ? 'selected' : ''; ?> value="1">Principal</option>
                    <option <?= ($datos[0]['estado'] == 2) ? 'selected' : ''; ?> value="2">Otro</option>
                </select>
            </div>
        </div>

        <div class="d-grid gap-2 mb-2"><br>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Actualizar E-mail</button>

            <input type="hidden" name="metodo" value="creacionDemografico">
            <input type="hidden" id="accion" name="accion" value="crearEmail">
            <input type="hidden" name="div" value="divCorreos">
            <input type="hidden" name="identificacion" value="<?= $datos[0]['cedula_deudor'] ?>">
            <input type="hidden" name="id" value="<?= $datos[0]['id_correo']; ?>">
        </div>
    </form>
<?php elseif ($parametro == 'editarDireccion') : ?>
    <form id="formularioEdicionDireccion" class="formCarga" action="javascript:void(0);" data-id="formularioEdicionDireccion" data-controlador="carterasController">
        <div class="mb-3">
            <label class="form-label"><strong>Ciudad</strong></label>

            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-globe-americas" id="basic-text3"></span></div>
                <input id="ciudadCambio" value="<?= $this->codificarCaracteres($datos[0]['ciudad']); ?>" required data-parsley-required class="form-control" name="ciudad" type="text" placeholder="Ciudad">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Tipo Dirección</strong></label>

            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-map"></span></div>

                <select class="form-select" value="<?= $datos[0]['tipo']; ?>" name="tipo" id="tipoDemografico">
                    <option value="">..seleccione..</option>
                    <option <?= ($datos[0]['tipo'] == 'direccion residencia') ? 'selected' : '' ?> value="direccion residencia">Dirección Residencia</option>
                    <option <?= ($datos[0]['tipo'] == 'direccion empresarial') ? 'selected' : '' ?> value="direccion empresarial">Dirección Empresarial</option>
                    <option <?= ($datos[0]['tipo'] == 'otra direccion') ? 'selected' : '' ?> value="otra direccion">Otra Dirección</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Dirección</strong></label>
            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-geo-fill" id="basic-text3"></span></div>

                <input id="direccionCambio" value="<?= $this->codificarCaracteres($datos[0]['direccion']); ?>" required data-parsley-required class="form-control" name="direccion" type="text" placeholder="Direccion">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Estado</strong></label>
            <div class="input-group">
                <div class="input-group-text"><span class="bi bi-capsule"></span></div>
                <select class="form-select" value="<?= $datos[0]['estado']; ?>" name="estado" id="estadoDemo">
                    <option value="">..seleccione..</option>
                    <option <?= ($datos[0]['estado'] == 0) ? 'selected' : '' ?> value="0">Inactivo</option>
                    <option <?= ($datos[0]['estado'] == 1) ? 'selected' : '' ?> value="1">Activo</option>
                </select>
            </div>
        </div>

        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Actualizar Dirección</button>

            <input type="hidden" name="metodo" value="creacionDemografico">
            <input type="hidden" name="accion" value="crearDireccion">
            <input type="hidden" name="div" value="divDirecciones">
            <input type="hidden" name="identificacion" value="<?= $datos[0]['cedula_deudor'] ?>">
            <input type="hidden" name="id" value="<?= $datos[0]['id_direccion']; ?>">
        </div>
    </form>
<?php elseif ($parametro == 'EditarAccion') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label><strong>Acción</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-pencil-square" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?= $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Acción">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span></button>
                        <input type="hidden" name="metodo" value="crearHomologado">
                        <input type="hidden" name="tipo" value="accion">
                        <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarContacto') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label><strong>Contacto</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-pencil-square" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?= $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Direccion">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span></button>
                        <input type="hidden" name="metodo" value="crearHomologado">
                        <input type="hidden" name="tipo" value="contacto">
                        <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarEfecto') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label><strong>Efecto</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-pencil-square" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?= $datos[0]['homologado']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Efecto">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span></button>
                        <input type="hidden" name="metodo" value="crearHomologado">
                        <input type="hidden" name="tipo" value="efecto">
                        <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'EditarMotivo') : ?>
    <div class="row">
        <div class="col-md-12">
            <form id="formularioEdicionRegistro" data-ajax="administracionCartera" data-controlador="carterasController" data-id="formularioEdicionRegistro" class="formCarga" action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label><strong>Motivo de no pago</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-pencil-square" id="basic-addon3"></span></div>
                                <input id="homologadoCambio" value="<?= $datos[0]['motivo']; ?>" data-parsley-required class="form-control" name="homologado" type="text" placeholder="Motivo">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"><br>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span></button>
                        <input type="hidden" name="metodo" value="crearHomologado">
                        <input type="hidden" name="tipo" value="motivo">
                        <input type="hidden" name="id" value="<?= $datos[0]['id']; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

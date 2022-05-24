<?php if ($parametro == 'crearTelefono'): ?>
    <table class="table table-striped table-responsive tableDemografico">
        <thead>
        <tr class="success">
            <th>Teléfono</th>
            <th>Tipo Teléfono</th>
            <th>Disponibilidad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($datos as $telefono):
            $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
            $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
            ?>
            <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?php echo $telefono['telefono']; ?>">
                <td><?php echo $telefono['telefono']; ?></td>
                <td><?php echo ucwords(utf8_encode($telefono['tipo_telefono'])); ?></td>
                <td><?php echo $telefono['hora_disponibilidad'];?></td>
                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                <td style="text-align: center"><div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal"
                           data-target="#editarRegistro" data-tipo="editarTelefono" data-div="divTelefonos" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span></a>
                    </div></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($parametro == 'crearDireccion'): ?>
    <table class="table table-striped table-responsive tableDemografico">
        <thead>
        <tr class="success">
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Tipo Dirección</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($datos as $direccion):
            $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
            $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
            ?>
            <tr style="height:30px; cursor:pointer;">
                <td><?php echo ucwords(utf8_encode($direccion['ciudad'])); ?></td>
                <td><?php echo ucwords(utf8_encode($direccion['direccion'])); ?></td>
                <td><?php echo ucwords(utf8_encode($direccion['tipo_direccion'])); ?></td>
                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                <td style="text-align: center"><div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal"
                           data-target="#editarRegistro" data-tipo="editarDireccion" data-div="divDirecciones" data-id="<?php echo $direccion['id_direccion'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span></a>
                    </div></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($parametro == 'crearEmail'): ?>
    <table class="table table-striped table-responsive tableDemografico">
        <thead>
        <tr class="success">
            <th>Correo</th>
            <th>Tipo Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($datos as $email):
            $estado = ($email['estado'] == 1) ? 'Principal' : (($email['estado'] == 0) ? 'Ilocalizado' : 'Otro');
            $clase = ($email['estado'] == 1) ? 'primary' : (($email['estado'] == 0) ? 'danger' : 'success');
            ?>
            <tr style="height:30px; cursor:pointer;">
                <td><?php echo utf8_encode($email['correo']); ?></td>
                <td><?php echo ucwords(utf8_encode($email['tipo_correo'])); ?></td>
                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                <td style="text-align: center"><div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal"
                           data-target="#editarRegistro" data-tipo="editarEmail" data-div="divCorreos" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span></a>
                    </div></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($parametro == 'formularioArbol'): ?>
    <div class="col-sm-12 col-md-12">
        <div class="thumbnail">
        <form id="formParametroArbol" action="javascript:void(0);">
                <div class="row">
                    <div class="caption" style="text-align: center;">
                        <?php foreach ($parametros['homologado'] as $homologado) : ?>
                            <?php
                            $propiedad = '';
                            foreach ($parametros['asignadas'] as $asignadas) :
                                if ($homologado['id'] == $asignadas['id']) {
                                    $propiedad = 'checked';
                                }
                            ?>
                            <?php endforeach; ?>
                            <div class="col-sm-2" style="text-align: left;">
                                <input type="checkbox" <?php echo $propiedad; ?> name="parametro[]" value="<?php echo $homologado['id'] . '-' . $parametro_id; ?>">
                                <?php echo (isset($homologado['homologado'])) ? utf8_encode($homologado['homologado']) : ''; ?>
                                <?php echo (isset($homologado['motivo'])) ? utf8_encode($homologado['motivo']) : ''; ?>
                            </div>
                        <?php endforeach; ?>
                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                        <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                        <input type="hidden" name="metodo" value="crearParametroArbol">
                    </div>
                </div>
                <hr>
                <div class="row" style="text-align: center; padding: 20px;">
                    <div class="col-sm-12 col-md-12">
                        <input class="btn btn-primary" href="#" type="submit" value="GUARDAR">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'busquedaReferencia'): ?>
    <?php $id = (!empty($resultado['pagos']) ? tableReferencia : tableRefe); ?>
    <div class="table-responsive">
        <table class="table table-bordered" id="<?php echo $id; ?>">
            <thead>
                <tr class="success">
                    <th style="text-align: center;">Referencia de Pago</th>
                    <?php if (!empty($resultado['pagos'])): ?>
                        <th style="text-align: center;">Valor del Pago</th>
                        <th style="text-align: center;">Fecha del Pago</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody style="background-color: white; text-align: center;">
                <?php if (!empty($resultado['pagos'])): ?>
                    <?php foreach ($resultado['pagos'] as $pagos): ?>
                        <tr>
                            <td><?php echo $resultado['obligacion'][0]['estrategia_actual'] ?></td>
                            <td><?php echo $pagos['valor_pago']; ?></td>
                            <td><?php echo $pagos['fecha_pago']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td><?php echo $resultado['obligacion'][0]['estrategia_actual'] ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'editarTelefono'): ?>
    <table class="table table-striped table-responsive tableDemografico">
        <thead>
        <tr class="success">
            <th>Teléfono</th>
            <th>Tipo Teléfono</th>
            <th>Disponibilidad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($datos as $telefono):
            $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
            $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
            ?>
            <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?php echo $telefono['telefono']; ?>">
                <td><?php echo $telefono['telefono']; ?></td>
                <td><?php echo ucwords(utf8_encode($telefono['tipo_telefono'])); ?></td>
                <td><?php echo $telefono['hora_disponibilidad']; ?></td>
                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                <td style="text-align: center"><div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal"
                           data-target="#editarRegistro" data-tipo="editarTelefono" data-div="divTelefonos" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span></a>
                    </div></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($parametro == 'editarDireccion'): ?>
    <table class="table table-striped table-responsive tableDemografico">
        <thead>
        <tr class="success">
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Tipo Dirección</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($datos as $direccion):
            $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
            $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
            ?>
            <tr style="height:30px; cursor:pointer;">
                <td><?php echo ucwords(utf8_encode($direccion['ciudad'])); ?></td>
                <td><?php echo ucwords(utf8_encode($direccion['direccion'])); ?></td>
                <td><?php echo ucwords(utf8_encode($direccion['tipo_direccion'])); ?></td>
                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                <td style="text-align: center"><div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal"
                           data-target="#editarRegistro" data-tipo="editarDireccion" data-div="divDirecciones" data-id="<?php echo $direccion['id_direccion'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span></a>
                    </div></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($parametro == 'editarEmail'): ?>
    <table class="table table-striped table-responsive tableDemografico">
        <thead>
        <tr class="success">
            <th>Correo</th>
            <th>Tipo Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($datos as $email):
            $estado = ($email['estado'] == 1) ? 'Activo' : 'Inactivo';
            $clase = ($email['estado'] == 1) ? 'success' : 'danger';
            $estado = ($email['estado'] == 1) ? 'Principal' : (($email['estado'] == 0) ? 'Ilocalizado' : 'Otro');
            $clase = ($email['estado'] == 1) ? 'primary' : (($email['estado'] == 0) ? 'danger' : 'success');
            ?>
            <tr style="height:30px; cursor:pointer;">
                <td><?php echo utf8_encode($email['correo']); ?></td>
                <td><?php echo ucwords(utf8_encode($email['tipo_correo'])); ?></td>
                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                <td style="text-align: center"><div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal"
                           data-target="#editarRegistro" data-tipo="editarEmail" data-div="divCorreos" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span></a>
                    </div></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($parametro == 'parametroObligatoriedad'): ?>
    <div class="col-sm-12 col-md-12">
        <div class="thumbnail">
            <form id="formObligatoriedad" action="javascript:void(0);">
                <div class="row">
                    <div class="caption" style="text-align: center;">
                        <?php foreach ($parametros['inputs'] as $input): ?>
                            <?php
                            $propiedad = '';
                            foreach ($parametros['inputsAsignados'] as $asignadas):
                                if ($input['id'] == $asignadas['id_input']) {
                                    $propiedad = 'checked';
                                }
                                ?>
                            <?php endforeach; ?>
                            <div class="col-sm-2" style="text-align: left;">
                                <input type="checkbox" <?php echo $propiedad; ?> name="parametro[]" value="<?php echo $input['id']; ?>">
                                <?php echo utf8_encode($input['input']); ?>
                            </div>
                        <?php endforeach; ?>
                        <input type="hidden" name="accion" value="<?php echo $accion; ?>">
                        <input type="hidden" name="contacto" value="<?php echo $contacto; ?>">
                        <input type="hidden" name="efecto" value="<?php echo $efecto; ?>">
                        <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                        <input type="hidden" name="metodo" value="guardarObligatoriedad">
                    </div>
                </div>
                <hr>
                <div class="row" style="text-align: center; padding: 20px;">
                    <div class="col-sm-12 col-md-12">
                        <input class="btn btn-primary" href="#" type="submit" value="GUARDAR">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php
$this->layout('layout.html', ['modulo' => 'cartera', 'carteraActual' => $carteraActual,
    'logoCarteraActual' => $cartera[0]['ruta_logo'], 'cliente' => $cliente['cliente'][0]]);
?>
<div id="contenedor_data">
    <div class="row">
        <div class="col-md-12 switch">
            <div class="switch-right-grid">
                <div class="container-fluid" style="padding-top: 7px;">
                    <div class="row">
                        <div class="col-xs-2 cedulaGestion" id="cedulaGestion" data-clipboard-text=" <?php echo $cliente['cliente'][0]['cedula']; ?>" title="Cedúla del cliente">
                            <a href="#"><h4><i class="fa fa-user success"></i> <?php echo $cliente['cliente'][0]['cedula'] ?></h4></a>
                        </div>
                        <div class="col-xs-5">
                            <a href="#"><h4><?php echo $cliente['cliente'][0]['nombre']; ?></h4></a>
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
                <div class="container-fluid" style="padding-top: 7px; font-size: 14px;">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-xs-2">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" 
                                       href="#collapsCreditos" aria-expanded="true" aria-controls="collapsCreditos" title="Creditos del cliente">
                                        <h4><span class="fa fa-credit-card-alt success"></span> CREDITOS</h4></a>
                                </div>
                                <div class="col-xs-5">
                                    <a href="#"><i class="fa fa-hand-o-left fa-2x"></i> <i>"Haga clic en "CREDITOS" para desplegar la información de creditos"</i></a> 
                                </div>
                            </div>
                            <div id="collapsCreditos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="success">
                                                <th>Estado Reparto</th>
                                                <th>Número Obligación</th>
                                                <th>Producto</th>
                                                <th>Saldo Total</th>
                                                <th>Saldo en Mora</th>
                                                <th>Dias Mora Actual</th>
                                                <th>Tipo Credito</th>
                                                <th>Fecha Vencimiento</th>
                                                <th>Estado Obligación</th>
                                                <th>Clase Riesgo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cliente['obligaciones'] as $obligacion): ?>
                                                <tr class="obligacionGestion" data-obligacion="<?php echo $obligacion['numero_obligacion']; ?>" style="cursor:pointer;">
                                                    <td><?php echo $obligacion['estado_reparto']; ?></td>
                                                    <td><?php echo $obligacion['numero_obligacion']; ?></td>
                                                    <td><?php echo $obligacion['producto']; ?></td>
                                                    <td><?php echo $obligacion['saldo_total']; ?></td>
                                                    <td><?php echo $obligacion['saldo_mora']; ?></td>
                                                    <td><?php echo $obligacion['dias_mora_actual']; ?></td>
                                                    <td><?php echo $obligacion['ciclo_mora_actual_sistema']; ?></td>
                                                    <td><?php echo $obligacion['fecha_pago']; ?></td>
                                                    <td><?php echo $obligacion['estado_obligacion']; ?></td>
                                                    <td><?php echo $obligacion['zona']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12 switch">
                    <div class="switch-right-grid " style="padding-top: 7px; font-size: 14px;" >
                        <div class="panel-group container-fluid" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" 
                                           href="#collapsDemograficos" aria-expanded="true" aria-controls="collapsDemograficos" title="Creditos del cliente">
                                            <h4><span class="fa fa-map-o success"></span> DEMOGRÁFICOS</h4></a>
                                    </div>
                                    <div class="col-xs-7">
                                        <a href="#"><i class="fa fa-hand-o-left fa-2x"></i> <i>"Haga clic en "DEMOGRAFICOS" para desplegar la información demográfica"</i></a> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="collapsDemograficos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="row" style="font-size: 16px;">
                                                <div class="col-md-12">
                                                    <ul id="myTabs" class="nav nav-tabs" role="tablist">
                                                        <li class="active" role="presentation">
                                                            <a id="home-tab" href="#telefonos" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                                                <i class="fa fa-mobile fa-2x"></i> 
                                                                Teléfonos</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a id="profile-tab" href="#direcciones" role="tab" data-toggle="tab" aria-controls="profile">
                                                                <i class="fa fa-map-marker  fa-2x"></i>
                                                                Direcciones</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a id="profile-tab" href="#emails" role="tab" data-toggle="tab" aria-controls="profile">
                                                                <i class="fa fa-envelope-o fa-2x"></i>
                                                                E-mail</a>
                                                        </li>
                                                    </ul>
                                                    <div id="myTabContent" class="tab-content">
                                                        <div id="telefonos" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                            <button class="btn btn-success btnFormularioCreacionRegistroBusqueda" data-parametro="telefono" data-formulario="formCreacionTelefono"
                                                                    data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Teléfono</button>
                                                            <table class="table table-striped table-responsive">
                                                                <thead>
                                                                    <tr class="success">
                                                                        <th>Teléfono</th>
                                                                        <th>Tipo Teléfono</th>
                                                                        <th>Estado</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($cliente['telefonos'] as $telefono):
                                                                        $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                            $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
                                                                        ?>
                                                                        <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?php echo $telefono['telefono']; ?>">
                                                                            <td><?php echo $telefono['telefono']; ?></td>
                                                                            <td><?php echo ucwords(utf8_encode($telefono['tipo_telefono'])); ?></td>
                                                                            <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                            <td><div class="btn-group" role="group" aria-label="...">
                                                                                    <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" 
                                                                                       data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                                                                                        <span class="glyphicon glyphicon-edit"></span></a>
                                                                                    <a class="btn btn-primary eliminarRegistro" data-toggle="modal" 
                                                                                       data-target="#myModal" data-ajax="administracionUsuarios" data-accion="borrarUsuario" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                                                                                        <span class="glyphicon glyphicon-remove"></span></a>
                                                                                </div></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div id="direcciones" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="direcciones1" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionRegistro" data-parametro="direccion"><i class="fa fa-plus"></i> Agregar Dirección</button>
                                                                <table class="table table-striped table-responsive">
                                                                    <thead>
                                                                        <tr class="success">
                                                                            <th>Ciudad</th>
                                                                            <th>Dirección</th>
                                                                            <th>Estado</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($cliente['direcciones'] as $direccion):
                                                                            $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
                                                                            $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
                                                                            ?>
                                                                            <tr style="height:30px;">
                                                                                <td><?php echo ucwords(utf8_encode($direccion['ciudad'])); ?></td>
                                                                                <td><?php echo ucwords(utf8_encode($direccion['direccion'])); ?></td>
                                                                                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                <td><div class="btn-group" role="group" aria-label="...">
                                                                                        <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" 
                                                                                           data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $rol['id_usuario'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        <a class="btn btn-primary eliminarRegistro" data-toggle="modal" 
                                                                                           data-target="#myModal" data-ajax="administracionUsuarios" data-accion="borrarUsuario" data-id="<?php echo $rol['id_usuario'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-remove"></span></a>
                                                                                    </div></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="emails" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="direcciones1" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionRegistro" data-parametro="email"><i class="fa fa-plus"></i> Agregar E-mail</button>
                                                                <table class="table table-striped table-responsive">
                                                                    <thead>
                                                                        <tr class="success">
                                                                            <th>E-mail</th>
                                                                            <th>Estado</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($cliente['emails'] as $email):
                                                                            $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
                                                                            $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
                                                                            ?>
                                                                            <tr style="height:30px;">
                                                                                <td><?php utf8_encode($email['correo']); ?></td>
                                                                                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                <td><div class="btn-group" role="group" aria-label="...">
                                                                                        <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" 
                                                                                           data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        <a class="btn btn-primary eliminarRegistro" data-toggle="modal" 
                                                                                           data-target="#myModal" data-ajax="administracionUsuarios" data-accion="borrarUsuario" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-remove"></span></a>
                                                                                    </div></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="col-md-12 switch">
                <div class="switch-right-grid">
                    <div class="container-fluid" style="padding-top:15px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="#" title="Información"><h4><i class="fa fa-info-circle success"></i> INFORMACIÓN</h4></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#"><h4>Ultimo Efecto</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['ultimo_efecto'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#"><h4>Estado Obligación</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <h3><label class="label label-success"><?php echo $cliente['obligaciones'][0]['estado_obligacion'] ?></label></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#"><h4>Regional</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['regional'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#"><h4>Estrategia Actual</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['estrategia_actual'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#"><h4>Número Obligaciones</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['obligaciones'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#"><h4>Saldo Expuesto</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php  echo $cliente['obligaciones'][0]['saldo_expuesto']?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#"><h4>Nueva Marca Foco</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['nueva_marca_foco'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#"><h4>Mono Multi</h4></a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['mono_multi'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-12 switch">
            <div class="switch-right-grid">
                <div class="container-fluid" style="padding-top: 7px;">
                    <div class="row">
                        <div class="col-xs-5 col-xs-offset-5">
                            <a href="#" title="Cedúla del cliente"><h4><i class="fa fa-clock-o success"></i> HISTORIAL DE GESTIÓNES</h4></a>
                        </div>
                        <?php $rolActual = (count($_SESSION['acceso']) > 1) ? $_SESSION['acceso'][$carteraActual - 1]['id_rol'] : $_SESSION['acceso'][0]['id_rol'];
                        if ($rolActual != '1'):
                            ?>
                            <div class="col-xs-3">
                                <a href="#" class="dropdown-toggle btn btn-success accionAgregarGestion" id="btnAgregarGestion" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-plus"></i> GESTIONAR
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-xs-12">
                            <div id="divHistoricoGestion">
                                <table class="table table-bordered">
                                    <thead>
                                         <tr class="success">
                                            <th>Fecha</th>
                                            <th>Gestor</th>
                                            <th>Obligación</th>
                                            <th>Acción</th>
                                            <th>Efecto</th>
                                            <th>Contacto</th>
                                            <th>Motivo No Pago</th>
                                            <th>Fecha Acuerdo</th>
                                            <th>Valor Acuerdo</th>
                                            <th>Teléfono</th>
                                            <th>Tipo Negociacíón</th>
                                            <th>Obervaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial as $historico): ?>
                                            <tr>
                                                <td><?php echo $historico['fecha_gestion']; ?></td>
                                                <td><?php echo $historico['gestor']; ?></td>
                                                <td><?php echo $historico['obligacion']; ?></td>
                                                <td><?php echo $historico['accion']; ?></td>
                                                <td><?php echo $historico['efecto']; ?></td>
                                                <td><?php echo utf8_encode($historico['contacto']); ?></td>
                                                <td><?php echo $historico['motivo_no_pago']; ?></td>
                                                <td><?php echo $historico['fecha_acuerdo']; ?></td>
                                                <td><?php echo $historico['valor_acuerdo']; ?></td>
                                                <td><?php echo $historico['telefono']; ?></td>
                                                <td><?php echo $historico['tipo_negociacion']; ?></td>
                                                <td><?php echo utf8_encode($historico['observaciones']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper" class="active">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="ventanaMovimiento">
            <div class="container-fluid" style="padding-top: 10px;">
                <div class="row" >
                    <div class="col-xs-7 col-xs-offset-3">
                        <a href="#" title="Cedúla del cliente" style="color:#FFFFFF; margin-top: 10px;"><h4><i class="fa fa-user success"></i> GESTIÓN</h4></a>
                    </div>
                </div>
                <div class="row" style="display:none;" id="visualizacionObligacion">
                    <div class="col-xs-7 col-xs-offset-2">
                        <label class="label label-info" id="labelVisualizacionObligacion"></label>
                    </div>
                </div>
                <br>
                <form id="formularioGestion" action="javascript:void(0);">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Acción</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <select class="form-control" id="accionGestion" name="accionGestion">
                                        <option value="">..seleccione..</option>
                                        <?php foreach ($gestion['acciones'] as $accion): ?>
                                            <option value="<?php echo $accion['id'] ?>"><?php echo utf8_encode(strtoupper($accion['homologado'])); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Contacto</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                        <select class="form-control" id="contacto_gestion" name="contacto_gestion">
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                            <div id="divEfectoGestion" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Efecto</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-magic"></i></div>
                                        <select class="form-control" id="efecto_gestion" name="efecto_gestion">
                                            <option>..seleccione..</option>
                                        </select>
                                    </div>
                                </div>                                
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>Motivo No Pago</strong></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                            <select class="form-control" id="motivo_gestion" name="motivo_gestion">
                                                <option value="">..seleccione..</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Seguimiento</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" readonly class="form-control fecha" name="fecha_seguimiento" value="">
                                    </div>
                                </div>
                                <!--<div id="divAcuerdoGestion" style="display:none;">-->

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>Valor Acuerdo</strong></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            <input type="text" class="form-control" name="valor_acuerdo" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>Fecha Acuerdo</strong></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" readonly class="form-control fecha" name="fecha_acuerdo" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>Tipo Negociación</strong></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-handshake-o"></i></div>
                                            <select class="form-control" name="tipo_negociacion">
                                                <option value="">..seleccione..</option>
                                            </select>
                                        </div>
                                    </div>
                                <!--</div>-->
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Observaciones</strong></label>
                                <textarea name="obervaciones" id="observacionesGestion" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-8">
                            <div id="visualizacionTelefonos" class="success" style="display: none; text-align: center;">

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-success btn-lg" id="autocompletar" title="Autocompletar"><i class="fa fa-magic"></i></button>
                                <button type="submit" class="btn btn-success btn-lg" title="Guardar Gestión"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" value="guardarGestion">
                    <input type="hidden" name="origen_gestion" value="general">
                    <input type="hidden" name="obligacion" id="obligacionGestion" value="">
                    <input type="hidden" name="cedula_deudor" id="cedula_deudor" value="<?php echo $cliente['cliente'][0]['cedula'] ?>">
                    <input type="hidden" name="telefonos" id="telefonosGestion" value="">
                    <input type="hidden" name="cartera" id="carteraGestion" value="<?php echo $carteraActual; ?>">
                </form>
            </div>
        </div>
    </div>
</div>
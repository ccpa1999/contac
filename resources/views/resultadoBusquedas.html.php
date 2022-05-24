<?php if ($parametro == 'busquedaClientes') : ?>
    <div class="table-responsive" style="padding-bottom: 30px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        <h2>Nombre</h2>
                    </th>
                    <th>
                        <h2>Identificación</h2>
                    </th>
                    <th>
                        <h2>Dirección</h2>
                    </th>
                    <th>
                        <h2>Teléfono</h2>
                    </th>
                    <th>
                        <h2>E-mail</h2>
                    </th>
                    <th>
                        <h2>Placa</h2>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $cliente) : ?>
                    <tr style="cursor: pointer" class="editarCliente" data-cliente="<?php echo $cliente['id'] ?>">
                        <td>
                            <h3><span class="label label-success"><strong><?php echo strtoupper($cliente['nombre_completo']) ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo $cliente['identificacion'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $cliente['direccion'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $cliente['telefono'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $cliente['correo_electronico'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $cliente['placa'] ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'busquedaClientesFacturacion') : ?>
    <div class="table-responsive" style="padding-bottom: 30px; padding-top: 30px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <th>Placa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $cliente) :
                ?>
                    <tr style="cursor: pointer" class="accionAgregarClienteFacturacion" data-cliente="<?php echo $cliente['id'] ?>" data-cedula="<?php echo $cliente['identificacion'] ?>" data-nombre="<?php echo $cliente['nombre_completo'] ?>" data-telefono="<?php echo $cliente['telefono'] ?>">
                        <td>
                            <span class="label label-success"><strong><?php echo strtoupper($cliente['nombre_completo']) ?></strong></span>
                        </td>
                        <td><?php echo $cliente['identificacion'] ?></td>
                        <td><?php echo $cliente['direccion'] ?></td>
                        <td><?php echo $cliente['telefono'] ?></td>
                        <td><?php echo $cliente['correo_electronico'] ?></td>
                        <td><?php echo $cliente['placa'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'busquedaServicios') : ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>SERVICIO</th>
                    <th>DETALLE</th>
                    <th>VALOR</th>
                    <th>FECHA INICIAL</th>
                    <th>FECHA FINAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $servicio) : ?>
                    <tr>
                        <td>
                            <h3><span class="label label-success"><strong><?php echo mb_strtoupper(utf8_encode($servicio['descripcion_servicio']), 'UTF-8'); ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo utf8_encode($servicio['detalle_servicio']) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo '$' . number_format($servicio['valor']) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $servicio['fecha_inicial'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $servicio['fecha_final'] ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'busquedaUsuarios') : ?>
    <?php foreach ($resultados as $usuario) : ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img alt="100%x200" data-src="holder.js/100%x200" style="display: block;" src="../../public/images/1476391269_human.png" data-holder-rendered="true">
                <div class="caption" style="text-align: center;">
                    <h3><?php echo ucwords($usuario['nombre_completo']); ?></h3>
                    <p>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><strong>Usuario:</strong></label>
                            <h4><span class="label label-success"><?php echo $usuario['usuario'] ?></span></h4>
                        </div>
                        <div class="form-group">
                            <label><strong>Fecha Creación:</strong></label>
                            <h4><span class="label label-warning"><?php echo $usuario['fecha_creacion'] ?></span></h4>
                        </div>
                    </p>
                    <p>
                        <div class="btn-group" role="group" aria-label="...">
                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $usuario['id_usuario'] ?>" href="#" role="button">
                                <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <a class="btn btn-primary obtenerPermisos" data-toggle="modal" data-target="#permisosUsuario" data-idenusuario="<?php echo $usuario['identificacion'] ?>" data-usuario="<?php echo $usuario['id_usuario'] ?>" href="#" role="button">
                                <span class="glyphicon glyphicon-fire"></span> Permisos</a>
                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="administracionUsuarios" data-target="#myModal" data-controlador="administracionController" data-accion="borrarUsuario" data-id="<?php echo $usuario['id_usuario'] ?>" href="#" role="button">
                                <span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php elseif ($parametro == 'busquedaDescuentos') : ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Descuento</th>
                    <th>Detalle Descuento</th>
                    <th>Valor Descuento</th>
                    <th>Servicio Relacionado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $descuento) : ?>
                    <tr>
                        <td>
                            <h3><span class="label label-success"><strong><?php echo $descuento['descuento'] ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo $descuento['detalle_descuento'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $descuento['valor_descuento'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo utf8_encode($descuento['descripcion_servicio']) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $descuento['fecha_inicio'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $descuento['fecha_fin'] ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'busquedaInsumos') : ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Insumo</th>
                    <th>Detalle Insumo</th>
                    <th>Medida</th>
                    <th>Cantidad Minima</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $insumo) : ?>
                    <tr>
                        <td>
                            <h3><span class="label label-success"><strong><?php echo mb_strtoupper(utf8_encode($insumo['insumo']), 'UTF-8'); ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo utf8_encode($insumo['detalle_insumo']) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $insumo['medida'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $insumo['cantidad_minima'] ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'busquedaPuntosServicio') : ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Insumo</th>
                    <th>Detalle Insumo</th>
                    <th>Medida</th>
                    <th>Cantidad Minima</th>
                    <th>Consecitivo Factura</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $punto_servicio) : ?>
                    <tr>
                        <td>
                            <h3><span class="label label-success"><strong><?php echo mb_strtoupper(utf8_encode($punto_servicio['nombre_punto']), 'UTF-8'); ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo utf8_encode($punto_servicio['ciudad_punto']) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $punto_servicio['administrador_nombre'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $punto_servicio['cantidad_lavadores'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $punto_servicio['consecutivo_factura'] ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'busquedaInventarios') : ?>
    <div class="table-responsive">
        <table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <th>
                        <center>Insumo</center>
                    </th>
                    <th>
                        <center>Cantidad Disponible</center>
                    </th>
                    <th>
                        <center>Medida</center>
                    </th>
                    <th>
                        <center>Usuario Actualizó</center>
                    </th>
                    <th>
                        <center>Fecha Actualización</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $inventario) : ?>
                    <tr>
                        <td>
                            <h3><span class="label label-success"><strong><?php echo mb_strtoupper(utf8_encode($inventario['insumo']), 'UTF-8'); ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo utf8_encode($inventario['cantidad_disponible']) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo ucwords(utf8_encode($inventario['medida'])) ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $inventario['nombre_completo'] ?></h3>
                        </td>
                        <td>
                            <h3><?php echo $inventario['fecha_registro'] ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
<?php elseif ($parametro == 'busquedaTiposMantenimiento') : ?>
    <div class="table-responsive">
        <table class="table" style="text-align: center;">
            <thead>
                <tr>
                    <th>
                        <center>TIPO DE MANTENIMIENTO</center>
                    </th>
                    <th>
                        <center>DESCRIPCION</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $inventario) : ?>
                    <tr>
                        <td>
                            <h3><span class="label label-success"><strong><?php echo mb_strtoupper(utf8_encode($inventario['tipo_mantenimiento']), 'UTF-8'); ?></strong></span></h3>
                        </td>
                        <td>
                            <h3><?php echo utf8_encode($inventario['descripcion']) ?></h3>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

<?php elseif ($parametro == 'construirTablaFacturacion') : ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">SERVICIO</th>
                <th style="text-align: center;">CANTIDAD</th>
                <th style="text-align: center;">VALOR UNIDAD</th>
                <th style="text-align: center;">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <div id="detalladoFactura">
            </div>
            <?php
            $iva_total = 0;
            $subtotal = 0;
            $total = 0;
            $cont = 0;
            $total_productos = sizeof($factura);
            foreach ($factura as $datosFactura) :
            ?>
                <tr>
                    <td style="text-align: center;"><?php echo utf8_encode($datosFactura['descripcion_servicio']); ?></td>
                    <td style="text-align: center;"><?php echo $datosFactura['cantidad']; ?></td>
                    <td style="text-align: center;">$<?php echo number_format($datosFactura['valor']); ?></td>
                    <td style="text-align: center;">$<?php echo number_format($datosFactura['subtotal']); ?></td>
                </tr>
                <input type="hidden" name="producto_[]" value="<?php echo $datosFactura['id_producto']; ?>,<?php echo $datosFactura['cantidad']; ?>,<?php echo $datosFactura['subtotal']; ?>,<?php echo $datosFactura['iva_item']; ?> ">
            <?php
                $iva_total = $iva_total + $datosFactura['iva_item'];
                $subtotal = $subtotal + $datosFactura['subtotal'];
                $total = $iva_total + $subtotal;
            endforeach;
            ?>
            <tr>
                <td colspan="2" style="border: 0px;"></td>
                <td class="active success" style="text-align: center; color: #fff;
                background-color: #5cb85c;
                border-color: #4cae4c;"><strong>IVA</strong></td>
                <td style="text-align: center;">$<?php echo number_format($iva_total); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="border: 0px;"></td>
                <td class="active success" style="text-align: center; color: #fff;
                background-color: #5cb85c;
                border-color: #4cae4c;"><strong>TOTAL</strong></td>
                <td style="text-align: center;">$<?php echo number_format($total); ?></td>
            </tr>
        </tbody>
        <input type="hidden" id="cantidad_productos_factura" name="cantidad_productos_factura" value="<?php echo $total_productos; ?>">
        <input type="hidden" id="valor_total_factura" name="valor_total_factura" value="<?php echo $total; ?>">
    </table>
<?php elseif ($parametro == 'busquedaDeudor') : ?>
    <?php
    $this->layout('layout.html', [
        'modulo' => 'cartera', 'carteraActual' => $carteraActual,
        'logoCarteraActual' => $cartera[0]['ruta_logo'], 'cliente' => $cliente['cliente'][0]
    ]);
    ?>
    <div id="contenedor_data">
    <div class="row">
        <div class="col-md-12 switch">
            <div class="switch-right-grid">
                <div class="container-fluid" style="padding-top: 7px;">
                    <div class="row">
                        <div class="col-xs-2 cedulaGestion" id="cedulaGestion" data-clipboard-text="<?php echo $cliente['cliente'][0]['cedula']; ?>" title="Cedúla del cliente">
                            <a href="#">
                                <h4><i class="fa fa-user success"></i> <?php echo $cliente['cliente'][0]['cedula'] ?></h4>
                            </a>
                        </div>
                        <div class="col-xs-5">
                            <a href="#">
                                <h4><?php echo $cliente['cliente'][0]['nombre']; ?></h4>
                            </a>
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
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsCreditos" aria-expanded="true" aria-controls="collapsCreditos" title="Creditos del cliente">
                                        <h4><span class="fa fa-credit-card-alt success"></span> CREDITOS</h4>
                                    </a>
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
                                                <?php if ($carteraActual == '5' || $carteraActual == '12') : ?>
                                                    <th>Día Facturación</th>
                                                    <th>Fecha Vencimiento Factura</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                                <tr class="refereciaObligacionGestion" data-obligacion="<?php echo $obligacion['numero_obligacion']; ?>" style="cursor:pointer;">
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
                                                    <?php if ($carteraActual == '5' || $carteraActual == '12') : ?>
                                                        <td><?php echo $obligacion['dia_facturacion']; ?></td>
                                                        <td><?php echo $obligacion['fecha_ultimo_alivio']; ?></td>
                                                    <?php endif; ?>
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
                    <div class="switch-right-grid " style="padding-top: 7px; font-size: 14px;">
                        <div class="panel-group container-fluid" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsDemograficos" aria-expanded="true" aria-controls="collapsDemograficos" title="Creditos del cliente">
                                            <h4><span class="fa fa-map-o success"></span> DEMOGRÁFICOS</h4>
                                        </a>
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
                                                            <button class="btn btn-success btnFormularioCreacionDemografico" data-parametro="telefono" data-div="divTelefonos" data-formulario="formCreacionTelefono" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Teléfono</button>
                                                            <hr>
                                                            <div id="divTelefonos">
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
                                                                        foreach ($cliente['telefonos'] as $telefono) :
                                                                            $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                            $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
                                                                        ?>
                                                                            <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?php echo $telefono['telefono']; ?>">
                                                                                <td><?php echo $telefono['telefono']; ?></td>
                                                                                <td><?php echo ucwords(utf8_encode($telefono['tipo_telefono'])); ?></td>
                                                                                <td><?php echo $telefono['hora_disponibilidad'];?></td>
                                                                                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                <td style="text-align: center">
                                                                                    <div class="btn-group" role="group" aria-label="...">
                                                                                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarTelefono" data-div="divTelefonos" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="direcciones" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="direcciones2" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionDemografico" data-div="divDirecciones" data-parametro="direccion" data-formulario="formCreacionDireccion" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Dirección</button>
                                                                <hr>
                                                                <div id="divDirecciones">
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
                                                                            foreach ($cliente['direcciones'] as $direccion) :
                                                                                $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
                                                                                $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
                                                                            ?>
                                                                                <tr style="height:30px;">
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['ciudad'])); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['direccion'])); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['tipo_direccion'])); ?></td>
                                                                                    <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                    <td style="text-align: center">
                                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                                            <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarDireccion" data-div="divDirecciones" data-id="<?php echo $direccion['id_direccion'] ?>" href="#" role="button">
                                                                                                <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="emails" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="emails2" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionDemografico" data-div="divCorreos" data-parametro="email" data-formulario="formCreacionEmail" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar E-mail</button>
                                                                <hr>
                                                                <div id="divCorreos">
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
                                                                            foreach ($cliente['emails'] as $email) :
                                                                                $estado = ($email['estado'] == 1) ? 'Principal' : (($email['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                                $clase = ($email['estado'] == 1) ? 'primary' : (($email['estado'] == 0) ? 'danger' : 'success');
                                                                            ?>
                                                                                <tr style="height:30px;">
                                                                                    <td><?php echo utf8_encode($email['correo']); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($email['tipo_correo'])); ?></td>
                                                                                    <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                    <td style="text-align: center">
                                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                                            <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarEmail" data-div="divCorreos" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                                                                                                <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        </div>
                                                                                    </td>
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
        </div>
        <div class="col-md-7">
            <div class="col-md-12 switch">
                <div class="switch-right-grid">
                    <div class="container-fluid" style="padding-top:15px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="#" title="Información">
                                    <h4><i class="fa fa-info-circle success"></i> INFORMACIÓN</h4>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Ultimo Efecto</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['ultimo_efecto'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Estado Obligación</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <h3><label class="label label-success"><?php echo $cliente['obligaciones'][0]['estado_obligacion'] ?></label></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Regional</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['regional'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Estrategia Actual</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['estrategia_actual'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Número Obligaciones</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['obligaciones'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Saldo Expuesto</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['saldo_expuesto'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Nueva Marca Foco</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['nueva_marca_foco'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Mono Multi</h4>
                                </a>
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
                            <a href="#" title="Cedúla del cliente">
                                <h4><i class="fa fa-clock-o success"></i> HISTORIAL DE GESTIÓNES</h4>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $rolActual = $_SESSION['rol_actual'];
                        if ($rolActual != '1' && ($cliente['obligaciones'] != false) ) :
                        ?>
                            <div class="col-xs-12">
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary accionAgregarGestion" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" id="btnAgregarGestion" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-plus"></i> GESTIONAR
                                        </button>
                                        <button type="button" class="btn btn-primary accionPagos" id="btnPagos" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-usd"></i> PAGOS
                                        </button>
                                        <?php
                                        if ($carteraActual == 2) :
                                        ?>
                                            <button type="button" class="btn btn-primary  accionSolicitudReestructuracion" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" id="btnSolicitudReestructuracion">
                                                <i class="fa fa-id-card"></i> SOLICITUD REESTRUCTURACIÓN
                                            </button>
                                            <button type="button" data-cedula="<?php echo $cliente['cliente'][0]['cedula'] ?>" class="btn btn-danger  accionExportarSolicitud" style="border: 1px solid #FFFFFF !important; border-radius: 6px;">
                                                <i class="fa fa-file-pdf-o "></i>
                                            </button>
                                            <button type="button" class="btn btn-primary  accionOpcionSimuladores" style="border: 1px solid #FFFFFF !important; border-radius: 6px;">
                                                <i class="fa fa-calculator"></i> SIMULADORES
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div id="divHistoricoGestion">
                                <table class="table table-bordered tablaHistoricoGestion" style="width: 100%;">
                                    <thead>
                                        <tr class="success">
                                            <th>Fecha</th>
                                            <th>Gestor</th>
                                            <th>Obligación</th>
                                            <th>Acción</th>
                                            <th>Efecto</th>
                                            <th>Contacto</th>
                                            <th>Motivo No Pago</th>
                                            <!--<th>Motivo No Pago</th>-->
                                            <th>Fecha Acuerdo</th>
                                            <th>Valor Acuerdo</th>
                                            <th>Teléfono</th>
                                            <th>Tipo Negociacíón</th>
                                            <th>Obervaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial as $historico) : ?>
                                            <tr>
                                                <td><?php echo $historico['fecha_gestion']; ?></td>
                                                <td><?php echo $historico['gestor']; ?></td>
                                                <td><?php echo $historico['obligacion']; ?></td>
                                                <td><?php echo $historico['accion']; ?></td>
                                                <td><?php echo $historico['efecto']; ?></td>
                                                <td><?php echo utf8_encode($historico['contacto']); ?></td>
                                                <td><?php echo $historico['motivo_no_pago']; ?></td>
                                                <!--<td><?php echo $historico['actividad_economica']; ?></td>-->
                                                <td><?php echo $historico['fecha_acuerdo']; ?></td>
                                                <td><?php echo $historico['valor_acuerdo']; ?></td>
                                                <td><?php echo $historico['telefono']; ?></td>
                                                <td><?php echo $historico['tipo_negociacion']; ?></td>
                                                <td><?php echo utf8_encode($historico['observaciones']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
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
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Pagos -->
    <div class="modal fade" id="modalPagos">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="background-color: #444444;">
                <div style="width: 100%; height:7px; border-radius: 5px 5px 0px 0px;" class="bg-primary">
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" style="color: white;"> <i class="fa fa-usd text-primary"></i> PAGOS</h3>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablepagos">
                                    <thead>
                                        <tr class="success">
                                            <th># Obligación</th>
                                            <th>Valor del Pago</th>
                                            <th>Fecha del Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: white;">
                                        <?php foreach ($cliente['pagos'] as $pagos) : ?>
                                            <?php foreach ($pagos as $pagos) : ?>
                                                <tr>
                                                    <td><?php echo $pagos['obligacion']; ?></td>
                                                    <td><?php echo $pagos['valor_pago']; ?></td>
                                                    <td><?php echo $pagos['fecha_pago']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper" class="active">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="ventanaMovimiento" style="z-index: 1000;">
            <div class="container-fluid" style="padding-top: 10px;">
                <div class="row">
                    <div class="col-xs-7 col-xs-offset-3">
                        <a href="#" title="Cedúla del cliente" style="color:#FFFFFF; margin-top: 10px;">
                            <h4><i class="fa fa-user success"></i> GESTIÓN</h4>
                        </a>
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
                                <label for="exampleInputEmail1"><strong>Obligaciones</strong></label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Obligaciones
                                                <span class="caret"></span>
                                            </button>
                                            <div class="collapse" id="collapseExample">
                                                <div class="well">
                                                    <div class="checkbox-group required">
                                                        <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                                            <?php if($obligacion['numero_obligacion'] !== ""): ?>
                                                            <div class="checkbox-inline1">
                                                                <label>
                                                                <input  type="checkbox" name="obligacion[]" class="obligacionGestion" value="<?php echo $obligacion['numero_obligacion']; ?>"> <strong><?php echo $obligacion['numero_obligacion']; ?></strong>
                                                                </label>
                                                            </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div id="visualizacionTelefonos" style="display: none; text-align: center; color:white;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Acción</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <select class="form-control" id="accionGestion" name="accionGestion" required>
                                        <option value="">..seleccione..</option>
                                        <?php foreach ($gestion['acciones'] as $accion) : ?>
                                            <option value="<?php echo $accion['id'] ?>"><?php echo utf8_encode(strtoupper($accion['homologado'])); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Contacto</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <select class="form-control" id="contacto_gestion" name="contacto_gestion" required>
                                        <option value="">..seleccione..</option>
                                    </select>
                                </div>
                            </div>
                            <div id="divEfectoGestion" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Efecto</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-magic"></i></div>
                                        <select class="form-control" id="efecto_gestion" name="efecto_gestion" required>
                                            <option>..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Motivo No Pago</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                        <?php $requerido = ($_SESSION['carteraActual'] == '2') ? 'required' : ''; ?>
                                        <select class="form-control" id="motivo_gestion" name="motivo_gestion" <?php echo $requerido; ?>>
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Actividad Economíca</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                        <select class="form-control" id="actividad_gestion" name="actividad_gestion">
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Seguimiento</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control fecha" name="fecha_seguimiento" id="fecha_seguimiento" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Salarios Rango</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <select class="form-control" name="salarios_rango" id="salarios_rango">
                                            <option value="No informa">No informa</option>
                                            <option value="$1 - $500.000">$1 - $500.000</option>
                                            <option value="$501.000 - $1.000.000">$501.000 - $1.000.000</option>
                                            <option value="$1.001.000 - $1.500.000">$1.001.000 - $1.500.000</option>
                                            <option value="$1.500.000 o mayor">$1.500.000 o mayor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Valor Acuerdo</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input type="number" class="form-control" name="valor_acuerdo" id="valor_acuerdo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Acuerdo</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control fecha" name="fecha_acuerdo" id="fecha_acuerdo" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Tipo Negociación</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-handshake-o"></i></div>
                                        <select class="form-control" name="tipo_negociacion" id="tipo_negociacion">
                                            <option value="">..seleccione..</option>
                                            <option value="PUESTA AL DIA">PUESTA AL DÍA</option>
                                            <option value="CANCELACION TOTAL">CANCELANCIÓN TOTAL</option>
                                            <option value="PAGO TOTAL">PAGO TOTAL</option>
                                            <option value="PAGO MORA">PAGO MORA</option>
                                            <option value="PAGO PARA DEVOLVER">PAGO PARA DEVOLVER</option>
                                            <option value="PAGO PARA MANTENER">PAGO PARA MANTENER</option>
                                            <option value="PAGO REESTRUCTURACION">PAGO REESTRUCTURACION</option>
                                            <option value="RECLASIFICACION A CAPITAL">RECLASIFICACION A CAPITAL</option>
                                            <option value="SIN ACUERDO">SIN ACUERDO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Observaciones</strong></label>
                                <textarea name="obervaciones" id="observacionesGestion" class="form-control"></textarea>
                            </div>
                            <?php if ($carteraActual == 2 || $carteraActual == 4 || $carteraActual == 5 || $carteraActual == 13) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <a class="d-block small" href="#" style="font-size: 80%"></i><input type="checkbox" name="producto" value="SI"> Marca esta casilla si el cliente está interesado en adquirir un <b>Nuevo producto</b></a>
                                    </div>
                                </div>
                                <?php elseif ($carteraActual == 19) : ?>
                                <div class="form-group">
                                <div class="alert alert-info">
                                        <p>Selecciona si el cliente solicita:</p>
                                        <input type="radio" name="producto" value="Solicita Factura">
                                        <label for="SI">Solicitud de Factura</label><br>
                                        <input type="radio" name="producto" value="Form Reestructuración">
                                        <label for="moto">Form Reestructuración</label><br>
                                        <input type="radio" name="producto" value="Form Normalización">
                                        <label for="css">Form normalización</label><br>
                                    </div>
                                </div>
                            <?php elseif ($carteraActual == 15) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <p>Selecciona si el cliente solicita:</p>
                                        <input type="radio" name="producto" value="Factura">
                                        <label for="SI">Factura</label><br>
                                        <input type="radio" name="producto" value="Reconexion">
                                        <label for="moto">Reconexion</label><br>
                                        <input type="radio" name="producto" value="Envío de información">
                                        <label for="css">Envío de información</label><br>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($carteraActual == 9) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <p>Selecciona si el cliente tiene moto:</p>
                                        <input required type="radio" id="css" name="moto" value="SI">
                                        <label for="SI">SI</label><br>
                                        <input type="radio" id="css" name="moto" value="NO">
                                        <label for="css">No</label><br>
                                        <input type="radio" id="NoInforma" name="moto" value="No informa">
                                        <label for="moto">No informa</label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-xs-2 col-xs-offset-9">
                            <div class="btn-group" role="group" aria-label="...">
                                <!--                                <button type="button" class="btn btn-success btn-lg" id="btnActualizacion" title="Acepta actualización"><i class="fa fa-handshake-o"></i></button>
                                                                                                <button type="button" class="btn btn-success btn-lg" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>" 
                                                                                                           <!--data-cartera="<?php echo $carteraActual; ?>" id="btnSeleccionarObligaciones" title="Seleccionar Obligaciones"><i class="fa fa-plus"></i></button>-->
                                <!--<button type="button" class="btn btn-success btn-lg" id="autocompletar" title="Autocompletar"><i class="fa fa-magic"></i></button>-->
                                <button type="submit" class="btn btn-success btn-lg" title="Guardar Gestión"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" value="guardarGestion">
                    <input type="hidden" name="origen_gestion" value="general">
                    <!--<input type="hidden" name="obligacion" id="obligacionGestion" value="">-->
                    <input type="hidden" name="inicioGestion" id="inicioGestion">
                    <input type="hidden" name="cedula_deudor" id="cedula_deudor" value="<?php echo $cliente['cliente'][0]['cedula'] ?>">
                    <input type="hidden" name="telefono" id="telefonosGestion" value="">
                    <?php if ($carteraActual == 5 || $carteraActual == 13) : ?>
                        <input type="hidden" name="homologadoGevening" id="homologadoGevening">
                    <?php endif; ?>
                    <input type="hidden" name="cartera" id="carteraGestion" value="<?php echo $carteraActual; ?>">
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMiProductividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">MI PRODUCTIVIDAD</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="estadoTareaContent" class="col-md-12" style="text-align: center;">
                            <p style="text-align: center;"><strong>Estadisticas por analista</strong></p>
                            <canvas id="miProductividadCanvas" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ($parametro == 'busquedaDeudorTarea') : ?>
    <div class="row">
        <div class="col-md-12 switch">
            <div class="switch-right-grid">
                <div class="container-fluid" style="padding-top: 7px;">
                    <div class="row">
                        <div class="col-xs-2 cedulaGestion" id="cedulaGestion" data-clipboard-text="<?php echo $cliente['cliente'][0]['cedula']; ?>" title="Cedúla del cliente">
                            <a href="#">
                                <h4><i class="fa fa-user success"></i> <?php echo $cliente['cliente'][0]['cedula'] ?></h4>
                            </a>
                        </div>
                        <div class="col-xs-5">
                            <a href="#">
                                <h4><?php echo $cliente['cliente'][0]['nombre']; ?></h4>
                            </a>
                        </div>
                        <div class="col-xs-3 col-xs-offset-2">
                            <a href="#" class="siguienteClienteTarea" data-tarea="<?php echo $tarea ?>">
                                <h4>SIGUIENTE <i class="fa fa-arrow-circle-right success fa-1x"></i></h4>
                            </a>
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
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsCreditos" aria-expanded="true" aria-controls="collapsCreditos" title="Creditos del cliente">
                                        <h4><span class="fa fa-credit-card-alt success"></span> CREDITOS</h4>
                                    </a>
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
                                                <?php if ($carteraActual == '5' || $carteraActual == '12') : ?>
                                                    <th>Día Facturación</th>
                                                    <th>Fecha Vencimiento Factura</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                                <tr class="refereciaObligacionGestion" data-obligacion="<?php echo $obligacion['numero_obligacion']; ?>" style="cursor:pointer;">
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
                                                    <?php if ($carteraActual == '5' || $carteraActual == '12') : ?>
                                                        <td><?php echo $obligacion['dia_facturacion']; ?></td>
                                                        <td><?php echo $obligacion['fecha_ultimo_alivio']; ?></td>
                                                    <?php endif; ?>
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
                    <div class="switch-right-grid " style="padding-top: 7px; font-size: 14px;">
                        <div class="panel-group container-fluid" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsDemograficos" aria-expanded="true" aria-controls="collapsDemograficos" title="Creditos del cliente">
                                            <h4><span class="fa fa-map-o success"></span> DEMOGRÁFICOS</h4>
                                        </a>
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
                                                            <button class="btn btn-success btnFormularioCreacionDemografico" data-parametro="telefono" data-div="divTelefonos" data-formulario="formCreacionTelefono" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Teléfono</button>
                                                            <hr>
                                                            <div id="divTelefonos">
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
                                                                        foreach ($cliente['telefonos'] as $telefono) :
                                                                            $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                            $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
                                                                        ?>
                                                                            <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?php echo $telefono['telefono']; ?>">
                                                                                <td><?php echo $telefono['telefono']; ?></td>
                                                                                <td><?php echo ucwords(utf8_encode($telefono['tipo_telefono'])); ?></td>
                                                                                <td><?php echo $telefono['hora_disponibilidad'];?></td>
                                                                                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                <td style="text-align: center">
                                                                                    <div class="btn-group" role="group" aria-label="...">
                                                                                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarTelefono" data-div="divTelefonos" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="direcciones" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="direcciones2" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionDemografico" data-div="divDirecciones" data-parametro="direccion" data-formulario="formCreacionDireccion" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Dirección</button>
                                                                <hr>
                                                                <div id="divDirecciones">
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
                                                                            foreach ($cliente['direcciones'] as $direccion) :
                                                                                $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
                                                                                $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
                                                                            ?>
                                                                                <tr style="height:30px;">
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['ciudad'])); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['direccion'])); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['tipo_direccion'])); ?></td>
                                                                                    <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                    <td style="text-align: center">
                                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                                            <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarDireccion" data-div="divDirecciones" data-id="<?php echo $direccion['id_direccion'] ?>" href="#" role="button">
                                                                                                <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="emails" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="emails2" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionDemografico" data-div="divCorreos" data-parametro="email" data-formulario="formCreacionEmail" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar E-mail</button>
                                                                <hr>
                                                                <div id="divCorreos">
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
                                                                            foreach ($cliente['emails'] as $email) :
                                                                                $estado = ($email['estado'] == 1) ? 'Principal' : (($email['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                                $clase = ($email['estado'] == 1) ? 'primary' : (($email['estado'] == 0) ? 'danger' : 'success');
                                                                            ?>
                                                                                <tr style="height:30px;">
                                                                                    <td><?php echo utf8_encode($email['correo']); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($email['tipo_correo'])); ?></td>
                                                                                    <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                    <td style="text-align: center">
                                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                                            <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarEmail" data-div="divCorreos" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                                                                                                <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        </div>
                                                                                    </td>
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
        </div>
        <div class="col-md-7">
            <div class="col-md-12 switch">
                <div class="switch-right-grid">
                    <div class="container-fluid" style="padding-top:15px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="#" title="Información">
                                    <h4><i class="fa fa-info-circle success"></i> INFORMACIÓN</h4>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Ultimo Efecto</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['ultimo_efecto'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Estado Obligación</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <h3><label class="label label-success"><?php echo $cliente['obligaciones'][0]['estado_obligacion'] ?></label></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Regional</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['regional'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Estrategia Actual</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['estrategia_actual'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Número Obligaciones</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['obligaciones'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Saldo Expuesto</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['saldo_expuesto'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Nueva Marca Foco</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['nueva_marca_foco'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Mono Multi</h4>
                                </a>
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
                            <a href="#" title="Cedúla del cliente">
                                <h4><i class="fa fa-clock-o success"></i> HISTORIAL DE GESTIÓNES</h4>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $rolActual = $_SESSION['rol_actual'];
                        if ($rolActual != '1' && ($cliente['obligaciones'] != false) ) :
                        ?>
                            <div class="col-xs-12">
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary accionAgregarGestion" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" id="btnAgregarGestion" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-plus"></i> GESTIONAR
                                        </button>
                                        <button type="button" class="btn btn-primary accionPagos" id="btnPagos" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-usd"></i> PAGOS
                                        </button>
                                        <?php
                                        if ($carteraActual == 2) :
                                        ?>
                                            <button type="button" class="btn btn-primary  accionSolicitudReestructuracion" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" id="btnSolicitudReestructuracion">
                                                <i class="fa fa-id-card"></i> SOLICITUD REESTRUCTURACIÓN
                                            </button>
                                            <button type="button" data-cedula="<?php echo $cliente['cliente'][0]['cedula'] ?>" class="btn btn-danger  accionExportarSolicitud" style="border: 1px solid #FFFFFF !important; border-radius: 6px;">
                                                <i class="fa fa-file-pdf-o "></i>
                                            </button>
                                            <button type="button" class="btn btn-primary  accionOpcionSimuladores" style="border: 1px solid #FFFFFF !important; border-radius: 6px;">
                                                <i class="fa fa-calculator"></i> SIMULADORES
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div id="divHistoricoGestion">
                                <table class="table table-bordered tablaHistoricoGestion" style="width: 100%;">
                                    <thead>
                                        <tr class="success">
                                            <th>Fecha</th>
                                            <th>Gestor</th>
                                            <th>Obligación</th>
                                            <th>Acción</th>
                                            <th>Efecto</th>
                                            <th>Contacto</th>
                                            <th>Motivo No Pago</th>
                                            <!--<th>Motivo No Pago</th>-->
                                            <th>Fecha Acuerdo</th>
                                            <th>Valor Acuerdo</th>
                                            <th>Teléfono</th>
                                            <th>Tipo Negociacíón</th>
                                            <th>Obervaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial as $historico) : ?>
                                            <tr>
                                                <td><?php echo $historico['fecha_gestion']; ?></td>
                                                <td><?php echo $historico['gestor']; ?></td>
                                                <td><?php echo $historico['obligacion']; ?></td>
                                                <td><?php echo $historico['accion']; ?></td>
                                                <td><?php echo $historico['efecto']; ?></td>
                                                <td><?php echo utf8_encode($historico['contacto']); ?></td>
                                                <td><?php echo $historico['motivo_no_pago']; ?></td>
                                                <!--<td><?php echo $historico['actividad_economica']; ?></td>-->
                                                <td><?php echo $historico['fecha_acuerdo']; ?></td>
                                                <td><?php echo $historico['valor_acuerdo']; ?></td>
                                                <td><?php echo $historico['telefono']; ?></td>
                                                <td><?php echo $historico['tipo_negociacion']; ?></td>
                                                <td><?php echo utf8_encode($historico['observaciones']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
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
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Pagos -->
    <div class="modal fade" id="modalPagos">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="background-color: #444444;">
                <div style="width: 100%; height:7px; border-radius: 5px 5px 0px 0px;" class="bg-primary">
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" style="color: white;"> <i class="fa fa-usd text-primary"></i> PAGOS</h3>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablepagos">
                                    <thead>
                                        <tr class="success">
                                            <th># Obligación</th>
                                            <th>Valor del Pago</th>
                                            <th>Fecha del Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: white;">
                                        <?php foreach ($cliente['pagos'] as $pagos) : ?>
                                            <?php foreach ($pagos as $pagos) : ?>
                                                <tr>
                                                    <td><?php echo $pagos['obligacion']; ?></td>
                                                    <td><?php echo $pagos['valor_pago']; ?></td>
                                                    <td><?php echo $pagos['fecha_pago']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper" class="active">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="ventanaMovimiento" style="z-index: 1000;">
            <div class="container-fluid" style="padding-top: 10px;">
                <div class="row">
                    <div class="col-xs-7 col-xs-offset-3">
                        <a href="#" title="Cedúla del cliente" style="color:#FFFFFF; margin-top: 10px;">
                            <h4><i class="fa fa-user success"></i> GESTIÓN</h4>
                        </a>
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
                                <label for="exampleInputEmail1"><strong>Obligaciones</strong></label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Obligaciones
                                                <span class="caret"></span>
                                            </button>
                                            <div class="collapse" id="collapseExample">
                                                <div class="well">
                                                    <div class="checkbox-group required">
                                                        <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                                            <?php if($obligacion['numero_obligacion'] !== ""): ?>
                                                            <div class="checkbox-inline1">
                                                                <label>
                                                                <input  type="checkbox" name="obligacion[]" class="obligacionGestion" value="<?php echo $obligacion['numero_obligacion']; ?>"> <strong><?php echo $obligacion['numero_obligacion']; ?></strong>
                                                                </label>
                                                            </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div id="visualizacionTelefonos" style="display: none; text-align: center; color:white;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Acción</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <select class="form-control" id="accionGestion" name="accionGestion" required>
                                        <option value="">..seleccione..</option>
                                        <?php foreach ($gestion['acciones'] as $accion) : ?>
                                            <option value="<?php echo $accion['id'] ?>"><?php echo utf8_encode(strtoupper($accion['homologado'])); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Contacto</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <select class="form-control" id="contacto_gestion" name="contacto_gestion" required>
                                        <option value="">..seleccione..</option>
                                    </select>
                                </div>
                            </div>
                            <div id="divEfectoGestion" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Efecto</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-magic"></i></div>
                                        <select class="form-control" id="efecto_gestion" name="efecto_gestion" required>
                                            <option>..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Motivo No Pago</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                        <?php $requerido = ($_SESSION['carteraActual'] == '2') ? 'required' : ''; ?>
                                        <select class="form-control" id="motivo_gestion" name="motivo_gestion" <?php echo $requerido; ?>>
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Actividad Economíca</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                        <select class="form-control" id="actividad_gestion" name="actividad_gestion">
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Seguimiento</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control fecha" name="fecha_seguimiento" id="fecha_seguimiento" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Salarios Rango</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <select class="form-control" name="salarios_rango" id="salarios_rango">
                                            <option value="No informa">No informa</option>
                                            <option value="$1 - $500.000">$1 - $500.000</option>
                                            <option value="$501.000 - $1.000.000">$501.000 - $1.000.000</option>
                                            <option value="$1.001.000 - $1.500.000">$1.001.000 - $1.500.000</option>
                                            <option value="$1.500.000 o mayor">$1.500.000 o mayor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Valor Acuerdo</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input type="number" class="form-control" name="valor_acuerdo" id="valor_acuerdo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Acuerdo</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control fecha" name="fecha_acuerdo" id="fecha_acuerdo" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Tipo Negociación</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-handshake-o"></i></div>
                                        <select class="form-control" name="tipo_negociacion" id="tipo_negociacion">
                                            <option value="">..seleccione..</option>
                                            <option value="PUESTA AL DIA">PUESTA AL DÍA</option>
                                            <option value="CANCELACION TOTAL">CANCELANCIÓN TOTAL</option>
                                            <option value="PAGO TOTAL">PAGO TOTAL</option>
                                            <option value="PAGO MORA">PAGO MORA</option>
                                            <option value="PAGO PARA DEVOLVER">PAGO PARA DEVOLVER</option>
                                            <option value="PAGO PARA MANTENER">PAGO PARA MANTENER</option>
                                            <option value="PAGO REESTRUCTURACION">PAGO REESTRUCTURACION</option>
                                            <option value="RECLASIFICACION A CAPITAL">RECLASIFICACION A CAPITAL</option>
                                            <option value="SIN ACUERDO">SIN ACUERDO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Observaciones</strong></label>
                                <textarea name="obervaciones" id="observacionesGestion" class="form-control"></textarea>
                            </div>
                            <?php if ($carteraActual == 2 || $carteraActual == 4 || $carteraActual == 5 || $carteraActual == 13) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <a class="d-block small" href="#" style="font-size: 80%"></i><input type="checkbox" name="producto" value="SI"> Marca esta casilla si el cliente está interesado en adquirir un <b>Nuevo producto</b></a>
                                    </div>
                                </div>
                                <?php elseif ($carteraActual == 19) : ?>
                                <div class="form-group">
                                <div class="alert alert-info">
                                        <p>Selecciona si el cliente solicita:</p>
                                        <input type="radio" name="producto" value="Solicita Factura">
                                        <label for="SI">Solicitud de Factura</label><br>
                                        <input type="radio" name="producto" value="Form Reestructuración">
                                        <label for="moto">Form Reestructuración</label><br>
                                        <input type="radio" name="producto" value="Form Normalización">
                                        <label for="css">Form normalización</label><br>
                                    </div>
                                </div>
                            <?php elseif ($carteraActual == 15) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <p>Selecciona si el cliente solicita:</p>
                                        <input type="radio" name="producto" value="Factura">
                                        <label for="SI">Factura</label><br>
                                        <input type="radio" name="producto" value="Reconexion">
                                        <label for="moto">Reconexion</label><br>
                                        <input type="radio" name="producto" value="Envío de información">
                                        <label for="css">Envío de información</label><br>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($carteraActual == 9) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <p>Selecciona si el cliente tiene moto:</p>
                                        <input required type="radio" id="css" name="moto" value="SI">
                                        <label for="SI">SI</label><br>
                                        <input type="radio" id="css" name="moto" value="NO">
                                        <label for="css">No</label><br>
                                        <input type="radio" id="NoInforma" name="moto" value="No informa">
                                        <label for="moto">No informa</label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-xs-2 col-xs-offset-9">
                            <div class="btn-group" role="group" aria-label="...">
                                <!--                                <button type="button" class="btn btn-success btn-lg" id="btnActualizacion" title="Acepta actualización"><i class="fa fa-handshake-o"></i></button>
                                                                                                <button type="button" class="btn btn-success btn-lg" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>" 
                                                                                                           <!--data-cartera="<?php echo $carteraActual; ?>" id="btnSeleccionarObligaciones" title="Seleccionar Obligaciones"><i class="fa fa-plus"></i></button>-->
                                <!--<button type="button" class="btn btn-success btn-lg" id="autocompletar" title="Autocompletar"><i class="fa fa-magic"></i></button>-->
                                <button type="submit" class="btn btn-success btn-lg" title="Guardar Gestión"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" value="guardarGestion">
                    <input type="hidden" name="origen_gestion" value="tarea">
                    <input type="hidden" name="id_tarea" value="<?php echo $tarea; ?>">
                    <input type="hidden" name="inicioGestion" id="inicioGestion">
                    <input type="hidden" name="cedula_deudor" id="cedula_deudor" value="<?php echo $cliente['cliente'][0]['cedula'] ?>">
                    <input type="hidden" name="telefono" id="telefonosGestion" value="">
                    <?php if ($carteraActual == 5 || $carteraActual == 13) : ?>
                        <input type="hidden" name="homologadoGevening" id="homologadoGevening">
                    <?php endif; ?>
                    <input type="hidden" name="cartera" id="carteraGestion" value="<?php echo $carteraActual; ?>">
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMiProductividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">MI PRODUCTIVIDAD</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="estadoTareaContent" class="col-md-12" style="text-align: center;">
                            <p style="text-align: center;"><strong>Estadisticas por analista</strong></p>
                            <canvas id="miProductividadCanvas" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'buscarAsignacionMora') : ?>
    <div class="container">
        <div class="col-sm-12">
            <div class="thumbnail">
                <table class="table table-bordered tablaAsignacionEdadMora" style="width: 100%;">
                    <thead>
                        <tr class="success">
                            <th><input type="checkbox"></th>
                            <th>EDADES DE MORA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado['edades_mora'] as $edad) : ?>
                            <?php $atributo = "";
                            foreach ($resultado['asignacion'] as $asignadas) :
                                foreach ($resultado['asesores'] as $usuario) :
                                    if ($asignadas['id_usuario'] == $usuario['id_usuario'] && $edad['id'] == $asignadas['id_edad_mora']) :
                                        $atributo = 'checked';
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                            <tr>
                                <td class="col-sm-1"> <input type="checkbox" <?php echo $atributo; ?> class="formAsignarEdadMora" cartera=<?php echo $_SESSION['carteraActual'] ?> id_edad=<?php echo $edad['id'] ?> id_usuario=<?php echo $asignadas['id_usuario'] ?>></td>
                                <td class="col-sm-11">Edad de Mora <b><?php echo $edad['edad']; ?></b></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'busquedaDeudorRecarga') : ?>
    <div class="row">
        <div class="col-md-12 switch">
            <div class="switch-right-grid">
                <div class="container-fluid" style="padding-top: 7px;">
                    <div class="row">
                        <div class="col-xs-2 cedulaGestion" id="cedulaGestion" data-clipboard-text="<?php echo $cliente['cliente'][0]['cedula']; ?>" title="Cedúla del cliente">
                            <a href="#">
                                <h4><i class="fa fa-user success"></i> <?php echo $cliente['cliente'][0]['cedula'] ?></h4>
                            </a>
                        </div>
                        <div class="col-xs-5">
                            <a href="#">
                                <h4><?php echo $cliente['cliente'][0]['nombre']; ?></h4>
                            </a>
                        </div>
                        <div class="col-xs-3 col-xs-offset-2">
                            <a href="#" class="siguienteClienteTarea" data-tarea="<?php echo $tarea ?>">
                                <h4>SIGUIENTE <i class="fa fa-arrow-circle-right success fa-1x"></i></h4>
                            </a>
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
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsCreditos" aria-expanded="true" aria-controls="collapsCreditos" title="Creditos del cliente">
                                        <h4><span class="fa fa-credit-card-alt success"></span> CREDITOS</h4>
                                    </a>
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
                                                <?php if ($carteraActual == '5' || $carteraActual == '12') : ?>
                                                    <th>Día Facturación</th>
                                                    <th>Fecha Vencimiento Factura</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                                <tr class="refereciaObligacionGestion" data-obligacion="<?php echo $obligacion['numero_obligacion']; ?>" style="cursor:pointer;">
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
                                                    <?php if ($carteraActual == '5' || $carteraActual == '12') : ?>
                                                        <td><?php echo $obligacion['dia_facturacion']; ?></td>
                                                        <td><?php echo $obligacion['fecha_ultimo_alivio']; ?></td>
                                                    <?php endif; ?>
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
                    <div class="switch-right-grid " style="padding-top: 7px; font-size: 14px;">
                        <div class="panel-group container-fluid" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsDemograficos" aria-expanded="true" aria-controls="collapsDemograficos" title="Creditos del cliente">
                                            <h4><span class="fa fa-map-o success"></span> DEMOGRÁFICOS</h4>
                                        </a>
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
                                                            <button class="btn btn-success btnFormularioCreacionDemografico" data-parametro="telefono" data-div="divTelefonos" data-formulario="formCreacionTelefono" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Teléfono</button>
                                                            <hr>
                                                            <div id="divTelefonos">
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
                                                                        foreach ($cliente['telefonos'] as $telefono) :
                                                                            $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                            $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
                                                                        ?>
                                                                            <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?php echo $telefono['telefono']; ?>">
                                                                                <td><?php echo $telefono['telefono']; ?></td>
                                                                                <td><?php echo ucwords(utf8_encode($telefono['tipo_telefono'])); ?></td>
                                                                                <td><?php echo $telefono['hora_disponibilidad'];?></td>
                                                                                <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                <td style="text-align: center">
                                                                                    <div class="btn-group" role="group" aria-label="...">
                                                                                        <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarTelefono" data-div="divTelefonos" data-id="<?php echo $telefono['id_telefono'] ?>" href="#" role="button">
                                                                                            <span class="glyphicon glyphicon-edit"></span></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div id="direcciones" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="direcciones2" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionDemografico" data-div="divDirecciones" data-parametro="direccion" data-formulario="formCreacionDireccion" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar Dirección</button>
                                                                <hr>
                                                                <div id="divDirecciones">
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
                                                                            foreach ($cliente['direcciones'] as $direccion) :
                                                                                $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
                                                                                $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
                                                                            ?>
                                                                                <tr style="height:30px;">
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['ciudad'])); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['direccion'])); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($direccion['tipo_direccion'])); ?></td>
                                                                                    <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                    <td style="text-align: center">
                                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                                            <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarDireccion" data-div="divDirecciones" data-id="<?php echo $direccion['id_direccion'] ?>" href="#" role="button">
                                                                                                <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="emails" class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div id="emails2" class="tab-pane fade in active" role="tabpanel" aria-labelledby="home-tab">
                                                                <button class="btn btn-success btnFormularioCreacionDemografico" data-div="divCorreos" data-parametro="email" data-formulario="formCreacionEmail" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>"><i class="fa fa-plus"></i> Agregar E-mail</button>
                                                                <hr>
                                                                <div id="divCorreos">
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
                                                                            foreach ($cliente['emails'] as $email) :
                                                                                $estado = ($email['estado'] == 1) ? 'Principal' : (($email['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                                                                                $clase = ($email['estado'] == 1) ? 'primary' : (($email['estado'] == 0) ? 'danger' : 'success');
                                                                            ?>
                                                                                <tr style="height:30px;">
                                                                                    <td><?php echo utf8_encode($email['correo']); ?></td>
                                                                                    <td><?php echo ucwords(utf8_encode($email['tipo_correo'])); ?></td>
                                                                                    <td><label class="label label-<?php echo $clase; ?>"><?php echo $estado; ?></td>
                                                                                    <td style="text-align: center">
                                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                                            <a class="btn btn-primary formularioEditarDemografico" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarEmail" data-div="divCorreos" data-id="<?php echo $email['id_correo'] ?>" href="#" role="button">
                                                                                                <span class="glyphicon glyphicon-edit"></span></a>
                                                                                        </div>
                                                                                    </td>
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
        </div>
        <div class="col-md-7">
            <div class="col-md-12 switch">
                <div class="switch-right-grid">
                    <div class="container-fluid" style="padding-top:15px;">
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="#" title="Información">
                                    <h4><i class="fa fa-info-circle success"></i> INFORMACIÓN</h4>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Ultimo Efecto</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['ultimo_efecto'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Estado Obligación</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <h3><label class="label label-success"><?php echo $cliente['obligaciones'][0]['estado_obligacion'] ?></label></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Regional</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['regional'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Estrategia Actual</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['estrategia_actual'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Número Obligaciones</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['obligaciones'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Saldo Expuesto</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['saldo_expuesto'] ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Nueva Marca Foco</h4>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <label class="label label-success"><?php echo $cliente['obligaciones'][0]['nueva_marca_foco'] ?></label>
                            </div>
                            <div class="col-xs-3">
                                <a href="#">
                                    <h4>Mono Multi</h4>
                                </a>
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
                            <a href="#" title="Cedúla del cliente">
                                <h4><i class="fa fa-clock-o success"></i> HISTORIAL DE GESTIÓNES</h4>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $rolActual = $_SESSION['rol_actual'];
                        if ($rolActual != '1' && ($cliente['obligaciones'] != false) ) :
                        ?>
                            <div class="col-xs-12">
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary accionAgregarGestion" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" id="btnAgregarGestion" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-plus"></i> GESTIONAR
                                        </button>
                                        <button type="button" class="btn btn-primary accionPagos" id="btnPagos" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-usd"></i> PAGOS
                                        </button>
                                        <?php
                                        if ($carteraActual == 2) :
                                        ?>
                                            <button type="button" class="btn btn-primary  accionSolicitudReestructuracion" style="border: 1px solid #FFFFFF !important; border-radius: 6px;" id="btnSolicitudReestructuracion">
                                                <i class="fa fa-id-card"></i> SOLICITUD REESTRUCTURACIÓN
                                            </button>
                                            <button type="button" data-cedula="<?php echo $cliente['cliente'][0]['cedula'] ?>" class="btn btn-danger  accionExportarSolicitud" style="border: 1px solid #FFFFFF !important; border-radius: 6px;">
                                                <i class="fa fa-file-pdf-o "></i>
                                            </button>
                                            <button type="button" class="btn btn-primary  accionOpcionSimuladores" style="border: 1px solid #FFFFFF !important; border-radius: 6px;">
                                                <i class="fa fa-calculator"></i> SIMULADORES
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div id="divHistoricoGestion">
                                <table class="table table-bordered tablaHistoricoGestion" style="width: 100%;">
                                    <thead>
                                        <tr class="success">
                                            <th>Fecha</th>
                                            <th>Gestor</th>
                                            <th>Obligación</th>
                                            <th>Acción</th>
                                            <th>Efecto</th>
                                            <th>Contacto</th>
                                            <th>Motivo No Pago</th>
                                            <!--<th>Motivo No Pago</th>-->
                                            <th>Fecha Acuerdo</th>
                                            <th>Valor Acuerdo</th>
                                            <th>Teléfono</th>
                                            <th>Tipo Negociacíón</th>
                                            <th>Obervaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($historial as $historico) : ?>
                                            <tr>
                                                <td><?php echo $historico['fecha_gestion']; ?></td>
                                                <td><?php echo $historico['gestor']; ?></td>
                                                <td><?php echo $historico['obligacion']; ?></td>
                                                <td><?php echo $historico['accion']; ?></td>
                                                <td><?php echo $historico['efecto']; ?></td>
                                                <td><?php echo utf8_encode($historico['contacto']); ?></td>
                                                <td><?php echo $historico['motivo_no_pago']; ?></td>
                                                <!--<td><?php echo $historico['actividad_economica']; ?></td>-->
                                                <td><?php echo $historico['fecha_acuerdo']; ?></td>
                                                <td><?php echo $historico['valor_acuerdo']; ?></td>
                                                <td><?php echo $historico['telefono']; ?></td>
                                                <td><?php echo $historico['tipo_negociacion']; ?></td>
                                                <td><?php echo utf8_encode($historico['observaciones']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
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
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Pagos -->
    <div class="modal fade" id="modalPagos">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="background-color: #444444;">
                <div style="width: 100%; height:7px; border-radius: 5px 5px 0px 0px;" class="bg-primary">
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" style="color: white;"> <i class="fa fa-usd text-primary"></i> PAGOS</h3>
                    <div class="row" style="padding-top: 7px; font-size: 14px;">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablepagos">
                                    <thead>
                                        <tr class="success">
                                            <th># Obligación</th>
                                            <th>Valor del Pago</th>
                                            <th>Fecha del Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: white;">
                                        <?php foreach ($cliente['pagos'] as $pagos) : ?>
                                            <?php foreach ($pagos as $pagos) : ?>
                                                <tr>
                                                    <td><?php echo $pagos['obligacion']; ?></td>
                                                    <td><?php echo $pagos['valor_pago']; ?></td>
                                                    <td><?php echo $pagos['fecha_pago']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper" class="active">
        <!-- Sidebar -->
        <?php $required = ($_SESSION['cartera'] == 2) ? 'required' : ''; ?>
        <div id="sidebar-wrapper" class="ventanaMovimiento" style="z-index: 1000;">
            <div class="container-fluid" style="padding-top: 10px;">
                <div class="row">
                    <div class="col-xs-7 col-xs-offset-3">
                        <a href="#" title="Cedúla del cliente" style="color:#FFFFFF; margin-top: 10px;">
                            <h4><i class="fa fa-user success"></i> GESTIÓN</h4>
                        </a>
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
                                <label for="exampleInputEmail1"><strong>Obligaciones</strong></label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Obligaciones
                                                <span class="caret"></span>
                                            </button>
                                            <div class="collapse" id="collapseExample">
                                                <div class="well">
                                                    <div class="checkbox-group required">
                                                    <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                                            <?php if($obligacion['numero_obligacion'] !== ""): ?>
                                                            <div class="checkbox-inline1">
                                                                <label>
                                                                    <input  type="checkbox" name="obligacion[]" class="obligacionGestion" value="<?php echo $obligacion['numero_obligacion']; ?>"> <strong><?php echo $obligacion['numero_obligacion']; ?></strong>
                                                                </label>
                                                            </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div id="visualizacionTelefonos" style="display: none; text-align: center; color:white;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Acción</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <select class="form-control" id="accionGestion" name="accionGestion" required>
                                        <option value="">..seleccione..</option>
                                        <?php foreach ($gestion['acciones'] as $accion) : ?>
                                            <option value="<?php echo $accion['id'] ?>"><?php echo utf8_encode(strtoupper($accion['homologado'])); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Contacto</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <select class="form-control" id="contacto_gestion" name="contacto_gestion" required>
                                        <option value="">..seleccione..</option>
                                    </select>
                                </div>
                            </div>
                            <div id="divEfectoGestion" style="display:none;">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Efecto</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-magic"></i></div>
                                        <select class="form-control" id="efecto_gestion" name="efecto_gestion" required>
                                            <option>..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Motivo No Pago</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                        <?php $requerido = ($_SESSION['carteraActual'] == '2') ? 'required' : ''; ?>
                                        <select class="form-control" id="motivo_gestion" name="motivo_gestion" <?php echo $requerido; ?>>
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Actividad Economíca</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-exclamation"></i></div>
                                        <select class="form-control" id="actividad_gestion" name="actividad_gestion">
                                            <option value="">..seleccione..</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Seguimiento</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control fecha" name="fecha_seguimiento" id="fecha_seguimiento" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Salarios Rango</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <select class="form-control" name="salarios_rango" id="salarios_rango">
                                            <option value="No informa">No informa</option>
                                            <option value="$1 - $500.000">$1 - $500.000</option>
                                            <option value="$501.000 - $1.000.000">$501.000 - $1.000.000</option>
                                            <option value="$1.001.000 - $1.500.000">$1.001.000 - $1.500.000</option>
                                            <option value="$1.500.000 o mayor">$1.500.000 o mayor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Valor Acuerdo</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input type="number" class="form-control" name="valor_acuerdo" id="valor_acuerdo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Fecha Acuerdo</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control fecha" name="fecha_acuerdo" id="fecha_acuerdo" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Tipo Negociación</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-handshake-o"></i></div>
                                        <select class="form-control" name="tipo_negociacion" id="tipo_negociacion">
                                            <option value="">..seleccione..</option>
                                            <option value="PUESTA AL DIA">PUESTA AL DÍA</option>
                                            <option value="CANCELACION TOTAL">CANCELANCIÓN TOTAL</option>
                                            <option value="PAGO TOTAL">PAGO TOTAL</option>
                                            <option value="PAGO MORA">PAGO MORA</option>
                                            <option value="PAGO PARA DEVOLVER">PAGO PARA DEVOLVER</option>
                                            <option value="PAGO PARA MANTENER">PAGO PARA MANTENER</option>
                                            <option value="PAGO REESTRUCTURACION">PAGO REESTRUCTURACION</option>
                                            <option value="RECLASIFICACION A CAPITAL">RECLASIFICACION A CAPITAL</option>
                                            <option value="SIN ACUERDO">SIN ACUERDO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><strong>Observaciones</strong></label>
                                <textarea name="obervaciones" id="observacionesGestion" class="form-control"></textarea>
                            </div>
                            <?php if ($carteraActual == 2 || $carteraActual == 4 || $carteraActual == 5 || $carteraActual == 13) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <a class="d-block small" href="#" style="font-size: 80%"></i><input type="checkbox" name="producto" value="SI"> Marca esta casilla si el cliente está interesado en adquirir un <b>Nuevo producto</b></a>
                                    </div>
                                </div>
                                <?php elseif ($carteraActual == 19) : ?>
                                <div class="form-group">
                                <div class="alert alert-info">
                                        <p>Selecciona si el cliente solicita:</p>
                                        <input type="radio" name="producto" value="Solicita Factura">
                                        <label for="SI">Solicitud de Factura</label><br>
                                        <input type="radio" name="producto" value="Form Reestructuración">
                                        <label for="moto">Form Reestructuración</label><br>
                                        <input type="radio" name="producto" value="Form Normalización">
                                        <label for="css">Form normalización</label><br>
                                    </div>
                                </div>
                            <?php elseif ($carteraActual == 15) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <p>Selecciona si el cliente solicita:</p>
                                        <input type="radio" name="producto" value="Factura">
                                        <label for="SI">Factura</label><br>
                                        <input type="radio" name="producto" value="Reconexion">
                                        <label for="moto">Reconexion</label><br>
                                        <input type="radio" name="producto" value="Envío de información">
                                        <label for="css">Envío de información</label><br>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($carteraActual == 9) : ?>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <p>Selecciona si el cliente tiene moto:</p>
                                        <input required type="radio" id="css" name="moto" value="SI">
                                        <label for="SI">SI</label><br>
                                        <input type="radio" id="css" name="moto" value="NO">
                                        <label for="css">No</label><br>
                                        <input type="radio" id="NoInforma" name="moto" value="No informa">
                                        <label for="moto">No informa</label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-xs-2 col-xs-offset-9">
                            <div class="btn-group" role="group" aria-label="...">
                                <!--                                <button type="button" class="btn btn-success btn-lg" id="btnActualizacion" title="Acepta actualización"><i class="fa fa-handshake-o"></i></button>
                                                                                                <button type="button" class="btn btn-success btn-lg" data-identificacion="<?php echo $cliente['cliente'][0]['cedula'] ?>" 
                                                                                                           <!--data-cartera="<?php echo $carteraActual; ?>" id="btnSeleccionarObligaciones" title="Seleccionar Obligaciones"><i class="fa fa-plus"></i></button>-->
                                <!--<button type="button" class="btn btn-success btn-lg" id="autocompletar" title="Autocompletar"><i class="fa fa-magic"></i></button>-->
                                <button type="submit" class="btn btn-success btn-lg" title="Guardar Gestión"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="metodo" value="guardarGestion">
                    <input type="hidden" name="origen_gestion" value="general">
                    <!--<input type="hidden" name="obligacion" id="obligacionGestion" value="">-->
                    <input type="hidden" name="inicioGestion" id="inicioGestion">
                    <input type="hidden" name="cedula_deudor" id="cedula_deudor" value="<?php echo $cliente['cliente'][0]['cedula'] ?>">
                    <input type="hidden" name="telefono" id="telefonosGestion" value="">
                    <?php if ($carteraActual == 5 || $carteraActual == 13) : ?>
                        <input type="hidden" name="homologadoGevening" id="homologadoGevening">
                    <?php endif; ?>
                    <input type="hidden" name="cartera" id="carteraGestion" value="<?php echo $carteraActual; ?>">
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMiProductividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">MI PRODUCTIVIDAD</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="estadoTareaContent" class="col-md-12" style="text-align: center;">
                            <p style="text-align: center;"><strong>Estadisticas por analista</strong></p>
                            <canvas id="miProductividadCanvas" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'formularioCambiarOrden') : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <select class="form-control" name="columna" id="columna1">
                    <option value="">..Seleccione..</option>
                    <?php
                    ($resultado['filtro2'][0]) ? $resultado['filtro1'] = $resultado['filtro2'][0] : '';
                    if ($resultado['filtro1']) :
                        foreach ($resultado['filtro1'] as $columnas) : ?>
                            <option value="<?php echo $columnas['columna']; ?>"><?php echo $columnas['columna']; ?></option>
                    <?php endforeach;
                    endif ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="columna" id="columna2">
                    <option value="">..Seleccione..</option>
                    <?php
                    if ($resultado['filtro2']) :
                        foreach ($resultado['filtro2'][1] as $columnas) : ?>
                            <option value="<?php echo $columnas['columna']; ?>"><?php echo $columnas['columna']; ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="columna" id="columna3">
                    <option value="">..Seleccione..</option>
                    <?php
                    if ($resultado['filtro3']) :
                        foreach ($resultado['filtro3'][2] as $columnas) : ?>
                            <option value="<?php echo $columnas['columna']; ?>"><?php echo $columnas['columna']; ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'obtenerChats') : ?>
    <?php foreach ($resultado['mensajes'] as $mensaje) : ?>
        <?php $emisor = explode(',', $mensaje['id_emisor']); ?>
        <?php $receptor = explode(',', $mensaje['id_receptor']); ?>
        <?php $fecha = explode(' ', $mensaje['fecha']); ?>
        <?php ($emisor[1] == $_SESSION['usuario']) ? $clase = "alert bg-primary text-right col-md-offset-6" : $clase = "well col-md-6" ?>
        <?php if ($receptor[0] == $_SESSION['id_usuario'] || $emisor[0] == $_SESSION['id_usuario'] && $receptor[0] >= 20 && $mensaje['mensaje'] != '') : ?>
            <div class="row">
            <div title="<?php echo "visto: " . $mensaje['fecha_visto'] ?>" style="border-radius: 16px;" class="<?php echo $clase ?>">
            <div style="word-wrap: break-word">
                    <?php $mensaje = explode(';', $mensaje['mensaje']); ?>
                        <div><?php echo $mensaje[0]; ?></div>
                        <?php if(!empty($mensaje[1])): ?>
                            <div ><a style="color: black;" target="_blank" href="../../public/archivos/cargas/archivosChat/<?php echo $mensaje[1]?>"><i style="padding: 5px;" class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $mensaje[1] ?></a></div>
                        <?php endif; ?>
                    </div>
                    <p style="font-size: 70%;"><b><?php echo $fecha[1] ?></b></p>
                </div>
            </div>
        <?php elseif ( $receptor[0] <= 20 && $mensaje['mensaje'] != '') : ?>
            <div class="row">
                <div title="<?php echo "visto: " . $mensaje['fecha_visto'] ?>" style="border-radius: 16px;" class="<?php echo $clase ?>">
                    <div class="">
                        <p><b><?php echo ($emisor[1] != $_SESSION['usuario']) ? $emisor[1] : '';?></b></p>
                    </div>
                    <div style="word-wrap: break-word">
                    <?php $mensaje = explode(';', $mensaje['mensaje']); ?>
                        <div><?php echo $mensaje[0]; ?></div>
                        <?php if(!empty($mensaje[1])): ?>
                            <div ><a style="color: black;" target="_blank" href="../../public/archivos/cargas/archivosChat/<?php echo $mensaje[1]?>"><i style="padding: 5px;" class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $mensaje[1] ?></a></div>
                        <?php endif; ?>
                    </div> 
                    <p style="font-size: 70%;"><b><?php echo $fecha[1] ?></b></p>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php elseif ($parametro == 'busquedaChats') : ?>
    <div class="list-group pre-scrollable">
        <?php if(isset($mensajes['mensajes'])): ?>
        <?php foreach ($mensajes['mensajes'] as $mensaje) :
            $emisor = explode(',', $mensaje['id_emisor']);
            $receptor = explode(',', $mensaje['id_receptor']);
            if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) : 
                $notificacion = "fa fa-bookmark align-right text-primary";
            else:
                $notificacion = "";
            endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['carteraActual'])) : ?>
            <a href="#" data-idGrupo="18" class="grupo list-group-item btn btn-info">Coordinador</a>
            <?php endif; ?>
            <?php if ($_SESSION['rol_actual'] !== "4") : ?>
                <a href="#" data-idGrupo="16" class="grupo list-group-item btn btn-info">Fianza</a>
            <?php if(isset($resultado['grupos'])): ?>
            <?php foreach ($resultado['grupos'] as $grupo) : ?>
                <?php if ($grupo['id_cliente'] != 10 && $grupo['id_cliente'] != 11) : ?>
                    <a href="#" data-idGrupo="<?php echo $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?php echo utf8_decode(utf8_encode($grupo['nombre_cliente'])) ?><i class="<?php echo $notificacion; ?>"></i></a>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if(isset($resultado['usuarios'])): ?>
            <?php foreach ($resultado['usuarios'] as $usuario) : ?>
                <?php if ($usuario['id_usuario'] != $_SESSION['id_usuario']) : ?>
                    <a href="#" data-idGrupo="<?php echo $usuario['id_usuario'] . ',' . $usuario['usuario'] ?>" class="list-group-item btn btn-info"><?php echo utf8_decode(utf8_encode($usuario['usuario'])) ?><i class="<?php echo (isset($notificacion)) ? $notificacion : ''; ?>"></i></a>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        <?php elseif ($_SESSION['rol_actual'] === "4") : ?>
            <?php if(isset($resultado['grupos'])): ?>
            <?php foreach ($resultado['grupos'] as $grupo) : ?>
                <?php if ($_SESSION['carteraActual'] == $grupo['id_cliente']) : ?>
                    <a href="#" data-idGrupo="<?php echo $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?php echo $grupo['nombre_cliente'] ?><i class="<?php echo $notificacion; ?>"></i></a>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if(isset($resultado['agrupados'])): ?>
            <?php foreach ($mensajes['agrupados'] as $mensaje) :
                $emisor = explode(',', $mensaje['id_emisor']);
                $receptor = explode(',', $mensaje['id_receptor']);
                if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) : ?>
                    <a href="#" data-idGrupo="<?php echo $mensaje['id_emisor'] ?>" class="list-group-item btn btn-info"><?php echo utf8_decode(utf8_encode($emisor[1])) ?><i class="<?php echo $notificacion; ?>"></i></a>
            <?php endif;
            endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
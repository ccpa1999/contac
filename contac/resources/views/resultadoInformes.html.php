<?php if ($parametro == 'construirTablaFacturacion'): ?>
    <div class="table-responsive" style="padding-bottom: 30px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><h2>Factura</h2></th>
            <th><h2>Cliente</h2></th>
            <th><h2>Cédula cliente</h2></th>
            <th><h2>Teléfono cliente</h2></th>
            <th><h2>Servicio</h2></th>
            <th><h2>Cantidad</h2></th>
            <th><h2>Precio base</h2></th>
            <th><h2>Base Iva</h2></th>
            <th><h2>Medio pago</h2></th>
            <th><h2>Usuario</h2></th>
            <th><h2>Fecha Venta</h2></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados['datos'] as $resultado): ?>
                    <!--<tr style="cursor: pointer" class="editarCliente" data-cliente="<?php echo $cliente['id'] ?>">-->
                        <td><h3><span class="label label-success"><strong><?php echo strtoupper($resultado['id_factura']) ?></strong></span></h3></td>
                        <td><h3><?php echo $resultado['nombre_cliente'] ?></h3></td>
                        <td><h3><?php echo $resultado['cedula_cliente'] ?></h3></td>
                        <td><h3><?php echo $resultado['telefono_cliente'] ?></h3></td>
                        <td><h3><?php echo $resultado['descripcion_servicio'] ?></h3></td>
                        <td><h3><?php echo $resultado['cantidad'] ?></h3></td>
                        <td><h3><?php echo $resultado['precio_base'] ?></h3></td>
                        <td><h3><?php echo $resultado['base_iva'] ?></h3></td>
                        <td><h3><?php echo $resultado['medio_pago'] ?></h3></td>
                        <td><h3><?php echo $resultado['nombre_completo'] ?></h3></td>
                        <td><h3><?php echo $resultado['fecha_venta'] ?></h3></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<?php endif; ?>
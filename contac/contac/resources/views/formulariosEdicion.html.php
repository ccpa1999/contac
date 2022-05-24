<?php if ($parametro == 'usuarios'): ?>
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
                                        <option value="">..Seleccione..</option>
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
<?php elseif ($parametro == 'busquedaClientesFacturacion'): ?>
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
                foreach ($resultados as $cliente):
                    ?>
                    <tr style="cursor: pointer" class="accionAgregarClienteFacturacion" data-cliente="<?php echo $cliente['id'] ?>"
                        data-cedula ="<?php echo $cliente['identificacion'] ?>" 
                        data-nombre = "<?php echo $cliente['nombre_completo'] ?>" 
                        data-telefono="<?php echo $cliente['telefono'] ?>">
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

<?php endif; ?>
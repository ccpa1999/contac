<?php if ($parametro == 'formularioBusquedaDeudores'): ?>
    <form id="formularioBusquedaDudores" action="javascript:void(0);">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo Busqueda</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-filter"></i>
                    </div>
                    <select class="form-control" name="tipo">
                        <option value="">..seleccione..</option>
                        <option value="cedula">Documento</option>
                        <option value="numero_obligacion">Obligacion</option>
                        <option value="telefono">Teléfono</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Dato</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" required name="datoBusqueda" placeholder="Ingrese el dato para busqueda" class="form-control">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="buscarDeudor">
        <input type="hidden" name="cartera" value="<?php echo $carteraActual; ?>">
    </form>
<?php elseif ($parametro == 'tablaHistorico'): ?>
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
                <th>Fecha Seguimiento</th>
                <th>Valor Acuerdo</th>
                <th>Teléfono</th>
                <th>Tipo Negociacíón</th>
                <th>Obervaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato): ?>
                <tr>
                    <td><?php echo $dato['fecha_gestion']; ?></td>
                    <td><?php echo $dato['gestor']; ?></td>
                    <td><?php echo $dato['obligacion']; ?></td>
                    <td><?php echo $dato['accion']; ?></td>
                    <td><?php echo $dato['efecto']; ?></td>
                    <td><?php echo $dato['contacto']; ?></td>
                    <td><?php echo $dato['motivo_no_pago']; ?></td>
                    <td><?php echo $dato['fecha_seguimiento']; ?></td>
                    <td><?php echo $dato['valor_acuerdo']; ?></td>
                    <td><?php echo $dato['telefono']; ?></td>
                    <td><?php echo $dato['tipo_negociacion']; ?></td>
                    <td><?php echo utf8_encode($dato['observaciones']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
elseif ($parametro == 'listadoTareas'):
    foreach ($tareas as $tarea):
        ?>
        <li>
            <a href="#" data-tarea="<?php echo $tarea['id']; ?>" class="label label-success activarTarea">
                <h4><strong><?php echo ucwords($tarea['nombre_tarea']); ?></strong></h4>
            </a>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
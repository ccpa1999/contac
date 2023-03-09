<div id="divDirecciones" class="table-responsive my-auto">
    <table class="table table-bordered tableDemografico">
        <thead class="bg-demografico">
            <tr>
                <th class="text-white">Ciudad</th>
                <th class="text-white">Dirección</th>
                <th class="text-white">Tipo Dirección</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($direcciones)) : ?>
                <?php
                foreach ($direcciones as $direccion) :
                    $estado = ($direccion['estado'] == 1) ? 'Activo' : 'Inactivo';
                    $clase = ($direccion['estado'] == 1) ? 'success' : 'danger';
                ?>
                    <tr>
                        <td><?= ucwords($this->codificarCaracteres($direccion['ciudad'])); ?></td>
                        <td><?= ucwords($this->codificarCaracteres($direccion['direccion'])); ?></td>
                        <td><?= ucwords($this->codificarCaracteres($direccion['tipo_direccion'])); ?></td>
                        <td><label class="badge bg-<?= $clase; ?>"><?= $estado; ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="...">
                                <button class="btn btn-primary formularioEditarRegistro" type="button" 
                                  data-bs-toggle="modal" data-bs-target="#editarRegistro" data-tipo="editarDireccion" 
                                  data-controlador="carterasController" data-ajax="administracionClientes" 
                                  data-div="editarDireccion" data-id="<?= $direccion['id_direccion'] ?>">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
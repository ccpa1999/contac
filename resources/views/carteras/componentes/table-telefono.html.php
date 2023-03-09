<div id="divTelefonos" class="table-responsive my-auto">
    <table class="table table-bordered tableDemografico">
        <thead class="bg-demografico">
            <tr>
                <th class="text-white">Teléfono</th>
                <th class="text-white">Tipo Teléfono</th>
                <th class="text-white">Disponibilidad</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($telefonos)) : ?>
                <?php
                foreach ($telefonos as $telefono) :
                    $estado = ($telefono['estado'] == 1) ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                    $clase = ($telefono['estado'] == 1) ? 'primary' : (($telefono['estado'] == 0) ? 'danger' : 'success');
                ?>
                    <tr style="height:30px; cursor:pointer;" class="telefonoGestion" data-telefono="<?= $telefono['telefono']; ?>">
                        <td><?= $telefono['telefono']; ?></td>
                        <td><?= ucwords($this->codificarCaracteres($telefono['tipo_telefono'])); ?></td>
                        <td><?= $telefono['hora_disponibilidad']; ?></td>
                        <td><label class="badge bg-<?= $clase; ?>"><?= $estado; ?></td>
                        <td style="text-align: center">
                            <div class="btn-group" role="group" aria-label="...">
                                <button class="btn btn-primary formularioEditarRegistro" 
                                  data-bs-toggle="modal" data-bs-target="#editarRegistro" data-div="divTelefonos" 
                                  data-controlador="carterasController" data-ajax="administracionClientes" data-tipo="editarTelefono" 
                                  data-id="<?= $telefono['id_telefono'] ?>" role="button" type="button">
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
<div id="divCorreos" class="table-responsive my-auto">
    <table class="table table-bordered tableDemografico">
        <thead class="bg-demografico">
            <tr>
                <th class="text-white">Correo</th>
                <th class="text-white">Tipo Correo</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($emails)) : ?>
                <?php
                foreach ($emails as $email) :
                    $estado = ($email['estado'] == 1) ? 'Principal' : (($email['estado'] == 0) ? 'Ilocalizado' : 'Otro');
                    $clase = ($email['estado'] == 1) ? 'primary' : (($email['estado'] == 0) ? 'danger' : 'success');
                ?>
                    <tr>
                        <td><?= $this->codificarCaracteres($email['correo']); ?></td>
                        <td><?= ucwords($this->codificarCaracteres($email['tipo_correo'])); ?></td>
                        <td><label class="badge bg-<?= $clase; ?>"><?= $estado; ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="...">
                                <button class="btn btn-primary formularioEditarRegistro" type="button" data-controlador="carterasController" data-ajax="administracionClientes" data-bs-toggle="modal" data-bs-target="#editarRegistro" data-tipo="editarEmail" data-div="divCorreos" data-id="<?= $email['id_correo'] ?>">
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
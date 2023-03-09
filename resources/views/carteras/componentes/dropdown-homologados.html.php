<button class="btn btn-success dropdown-toggle add-homologado" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $nombreCampo ?>" aria-expanded="false" aria-controls="collapse<?= $nombreCampo ?>">
    <i class="fa fa-plus"></i> Agregar <?= $label ?>
</button>

<div class="collapse mt-2" id="collapse<?= $nombreCampo ?>">
    <div class="card card-body">
        <form class="formCarga" id="formHomologado<?= $nombreCampo ?>" action="javascript:void(0);" data-id="formHomologado<?= $nombreCampo ?>" data-ajax="administracionCartera" data-controlador="carterasController" data-metodo="administracionCartera" data-formulario="formHomologado<?= $nombreCampo ?>">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mb-2">
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa fa-volume-control-phone success"></i></div>

                        <select class="form-select" required name="<?= $id_select ?>">
                            <option value="">seleccione...</option>

                            <?php foreach ($opciones as $accion) : ?>
                                <option value="<?= $accion['id']; ?>"><?= $this->codificarCaracteres($accion[$tipo]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if ($tipo == 'efecto') : ?>
                    <div class="col-md-12 mb-2">
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-volume-control-phone success"></i></div>

                            <select class="form-select" required name="efectividad">
                                <option value="0">NO CONTACTO</option>
                                <option value="1">CONTACTO CIERRE EXITOSO</option>
                                <option value="2">CONTACTO CIERRE NO EXITOSO</option>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-12 mb-2">
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa fa-pencil success"></i></div>
                        <input class="form-control" type="text" required name="homologado" placeholder="Ingrese el Homologado">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Registrar <?= $label ?></button>
                    </div>
                </div>
            </div>

            <input type="hidden" name="metodo" value="crearRegistro">
            <input type="hidden" id="accion" name="accion" value="crearHomologado">
            <input type="hidden" name="tipo" value="<?= $tipo ?>">
            <input type="hidden" name="cartera" value="<?= $_SESSION['carteraActual']; ?>">
        </form>
    </div>
</div>
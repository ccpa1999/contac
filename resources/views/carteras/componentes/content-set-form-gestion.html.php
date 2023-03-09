<div class="row d-flex justify-content-center" id="cardsGestion">
    <?php 
        foreach($inputs as $inputs_gestion) : 
            $readonly = false;

            if ($inputs_gestion['id_input'] == 'fecha_acuerdo' || $inputs_gestion['id_input'] == 'fecha_seguimiento' || 
                $inputs_gestion['id_input'] == 'observaciones')
                $readonly = true;
    ?>
        <div id="contenedor_campo" class="col-sm-12 col-md-6 col-lg-4 mb-3" data-posicion="<?= $inputs_gestion['posicion'] ?>" data-id-campo="<?= $inputs_gestion['id'] ?>">
            <div class="card bg-gray-2 altura-max">
                <div class="row g-0">
                    <div class="col-10">
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="" class="form-label fw-bold">Nombre Campo</label>
                                <input type="text" class="form-control" id="<?= $inputs_gestion['id_input'] ?>" <?= $readonly ? 'readonly' : '' ?> 
                                    name="<?= $inputs_gestion['id_input'] ?>[input]" value="<?= $inputs_gestion['input'] ?>" required>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label fw-bold">Tipo de Dato</label>
    
                                <select type="text" class="form-select dataTypeGestion" value="<?= $inputs_gestion['tipo'] ?>" id="tipo-<?= $inputs_gestion['id'] ?>" 
                                  name="<?= $inputs_gestion['id_input'] ?>[tipo][]" required
                                  data-id-campo="<?= $inputs_gestion['id'] ?>" data-id-input="<?= $inputs_gestion['id_input']?>">
                                    <option value="" <?= ($readonly ? 'disabled' : '') ?>>seleccione...</option>
                                    <option <?= ($inputs_gestion['tipo']) == "email" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="email">E-mail</option>
                                    <option <?= ($inputs_gestion['tipo']) == "date" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="date">Fecha</option>
                                    <option <?= ($inputs_gestion['tipo']) == "datetime" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="datetime">Fecha y Hora</option>
                                    <option <?= ($inputs_gestion['tipo']) == "time" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="time">Hora</option>
                                    <option <?= ($inputs_gestion['tipo']) == "number" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="number">Número</option>
                                    <option <?= ($inputs_gestion['tipo']) == "text" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="text">Texto</option>
                                    <option <?= ($inputs_gestion['tipo']) == "select" ? 'selected' : ($readonly ? 'disabled' : '') ?> value="select">Una opción entre varias</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        <div id="posicion-campo" class="mt-4 mx-auto fw-bold fs-4 pin-posicion text-white <?= $inputs_gestion['estado'] == 1 ? "pin-enable" : "pin-disabled" ?>">
                            <?= $inputs_gestion['posicion'] ?>
                        </div>

                        <input type="checkbox" class="enableCampo mt-5" title="Desactivar / Activar Campo"
                          id="estado-<?= $inputs_gestion['id'] ?>" 
                          name="<?= $inputs_gestion['id_input'] ?>[estado]" 
                          <?= $inputs_gestion['estado'] == 1 ? "checked" : '' ?> />
                    </div>
                </div>

                <div id="opciones-select-<?= $inputs_gestion['id'] ?>" class="my-0 py-0"
                 style="display: <?= ((isset($inputs_opciones[$inputs_gestion['id_input']]) && $inputs_gestion['tipo'] != "select") ? "none" : "''") ?>;"
                    data-id-campo="<?= $inputs_gestion['id'] ?>">
                    <?php 
                        $this->insert('carteras/componentes/opciones-select.html', 
                            ['id_campo' => $inputs_gestion['id'],'inputs_opciones' => $inputs_opciones, 
                             'idInput' => $inputs_gestion['id_input']]);
                    ?>
                </div>
            </div>
        </div>

        <input type="hidden" name="<?= $inputs_gestion['id_input'] ?>[id]" value="<?= $inputs_gestion['id'] ?>">
    <?php endforeach; ?>
</div>

<input type="hidden" name="metodo" id="metodo" value="camposFormGestion">

<div class="row d-flex justify-content-center mt-2">
    <div class="col-md-6">
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Guardar Campos</button>

            <input type="hidden" name="div" value="camposFormGestion">
        </div>
    </div>
</div>
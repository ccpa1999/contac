<div class="mb-2">
    <label class="form-label" for="<?= $input['id_input'] ?>"><strong><?= $input['input'] ?></strong></label>

    <?php if ($input['tipo'] == 'select'): ?>
        <div class="input-group">
            <div class="input-group-text"><i class="bi bi-check2-square"></i></div>
            <select class="form-select" name="<?= $input['id_input'] ?>" id="<?= $input['id_input'] ?>">
                <option value="">seleccione...</option>

                <?php if (isset($opciones[$input['id_input']])): ?>
                    <?php foreach($opciones[$input['id_input']] as $opcion) : ?>
                        <option value="<?= $opcion['opcion']?>"><?= $opcion['opcion']?></option>
                    <?php endforeach;?>
                <?php endif; ?>
            </select>
        </div>
    <?php elseif ($input['input'] == 'Observaciones'): ?>
            <textarea class="form-control" rows="3" placeholder="Escriba las observaciones"
              id="<?= $input['id_input'] ?>" name="observaciones"></textarea>
    <?php else: ?>
        <?php 
            $class = '';

            switch ($input['tipo']) {
                case 'date':
                    $class = 'fecha';
                    break;
                case 'datetime':
                    $class = 'fechaHora';
                    break;
                case 'time':
                    $class = 'hora';
                    break;
            }
        ?>

        <div class="input-group">
            <div class="input-group-text">
                <i class="<?= (strpos($input['tipo'], 'date') !== false ? 'fa fa-calendar' : 'fa fa-pencil' ) ?>"></i>
            </div>
            
            <input type="<?= (strpos($input['tipo'], 'date') !== false  ? "text" : $input['tipo']) ?>" name="<?= $input['id_input'] ?>" id="<?= $input['id_input'] ?>"
              class="form-control <?= $class ?>">
        </div>
    <?php endif;?>
</div>

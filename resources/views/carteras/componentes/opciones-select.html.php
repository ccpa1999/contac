<?php 
    if (isset($inputs_opciones[$idInput])): 
        $id_input = $idInput;
?>
    <button class="ms-3 btn btn-primary mt-0 mb-2" type="button" 
        data-bs-toggle="collapse" data-bs-target="#collapseOpciones-<?= $id_campo ?>" aria-expanded="false" aria-controls="collapseOpciones-<?= $id_campo ?>">
        Ver Opciones
    </button>

    <div class="collapse" id="collapseOpciones-<?= $id_campo ?>">
        <div class="card-body mt-0 pt-0 preexistente" id="innerOpciones-<?= $id_campo ?>" data-id-campo="<?= $id_campo ?>">
            <h6 class="text-center fw-bold">Ingrese las Opciones</h6>

            <?php foreach ($inputs_opciones[$id_input] as $opcion): ?>
                <?php 
                    $this->insert('carteras/componentes/inputs-opciones-gestion.html', 
                        ['id_input' => $id_input, 'id_campo' => $id_campo, 'opcion' => $opcion ]) 
                ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="row mb-2">
    <div class="col-9">
        <input type="text" class="form-control" value="<?= htmlspecialchars($opcion['opcion'] ?? '') ?>" required
            id="<?= $id_input?>[tipo][<?= isset($opcion) ? 'store' : 'new' ?>][<?= $opcion['id'] ?? '' ?>]" 
            name="<?= $id_input?>[tipo][<?= isset($opcion) ? 'store' : 'new' ?>][<?= $opcion['id'] ?? '' ?>]">
    </div>

    <div class="col-3">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary addOption" 
              data-id-campo="<?= $id_campo ?>" data-id-input="<?= $id_input ?>">
                <i class="fa fa-plus"></i>
            </button>
            
            <button type="button" class="btn btn-danger deleteOption" data-id-opcion="<?= $opcion['id'] ?? '' ?>">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
</div>

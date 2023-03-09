<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 mt-lg-4 mb-5">
            <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
            <li class="breadcrumb-item">Administración</li>
            <li class="breadcrumb-item active">Árbol</li>
        </ol>
    </nav>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-arbol" data-bs-toggle="tab" data-bs-target="#arbolGestion">Árbol de Gestión</button>
            <button class="nav-link" id="nav-obligatorio" data-bs-toggle="tab" data-bs-target="#obligatorio" type="button" role="tab" aria-controls="obligatorio" aria-selected="false">OBLIGATORIEDAD</button>
        </div>
    </nav>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="arbolGestion" role="tabpanel" aria-labelledby="nav-arbolGestion">
            <div class="row d-flex justify-content-around my-3">
                <div class="col-auto">
                    <h3 class="fw-bold title-informes"><i class="fa fa-tree text-success"></i> ÁRBOL DE DECISIÓN</h3>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-6 mt-2">
                    <div class="card altura-max border border-secondary">
                        <div class="card-header text-center bg-card-arbol"><i class="fa fa-phone fa-2x"></i></div>

                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <label class="col-auto col-form-label fw-bold">Acción: </label>

                                <div class="col-auto">
                                    <select class="parametroArbol form-select" name="accion" data-tipo="accion">
                                        <option value="">..Seleccione..</option>
                                        <?php foreach ($datos['arbol']['acciones'] as $acciones) : ?>
                                            <option value="<?= $acciones['id'] ?>"><?= $acciones['homologado'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 mt-2">
                    <div class="card altura-max border border-secondary">
                        <div class="card-header text-center text-color-1 bg-card-arbol"><i class="fa fa-group fa-2x"></i></div>

                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <label class="col-auto col-form-label fw-bold">Contacto:</label>

                                <div class="col-auto">
                                    <select class="parametroArbol form-select" name="accion" data-tipo="contacto">
                                        <option value="">..Seleccione..</option>
                                        <?php foreach ($datos['arbol']['contactos'] as $contacto) : ?>
                                            <option value="<?= $contacto['id'] ?>"><?= $contacto['homologado'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="resultadoParametroArbol">

                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="obligatorio" role="tabpanel" aria-labelledby="nav-obligatorio">
            <h3 class="text-center fw-bold my-3"><i class="bi bi-node-plus-fill"></i> Definir que campos serán obligatorios</h3>

            <div class="row d-flex justify-content-around mt-2">
                <div class="col-md-6 col-lg-4 mt-2">
                    <div class="card altura-max border border-secondary">
                        <div class="card-header text-center bg-card-arbol"><i class="fa fa-phone fa-2x"></i></div>

                        <div class="card-body text-center">
                            <div class="row d-flex justify-content-center">
                                <label for="tipo_accion" class="col-auto col-form-label"><strong>Acción</strong></label>

                                <div class="col-auto">
                                    <select class="form-select" id="tipo_accion" name="tipo_accion" required="">
                                        <option value="">..Seleccione..</option>
                                        <?php foreach ($datos['arbol']['acciones'] as $contacto) : ?>
                                            <option value="<?= $contacto['id']; ?>"><?= $contacto['homologado']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mt-2">
                    <div class="card altura-max border border-secondary">
                        <div class="card-header text-center bg-card-arbol"><i class="fa fa-users fa-2x"></i></div>

                        <div class="card-body text-center">
                            <div class="row d-flex justify-content-center">
                                <label for="tipo_contacto" class="col-auto col-form-label"><strong>Contacto</strong></label>

                                <div class="col-auto">
                                    <select class="form-select" id="tipo_contacto" name="tipo_contacto" required="">
                                        <option value="">..Seleccione..</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mt-2">
                    <div class="card altura-max border border-secondary">
                        <div class="card-header text-center bg-card-arbol"><i class="fa fa-info fa-2x"></i></div>

                        <div class="card-body text-center">
                            <div class="row d-flex justify-content-center">
                                <label for="tipoefecto" class="col-auto col-form-label"><strong>Efecto</strong></label>

                                <div class="col-auto">
                                    <select class="form-select" id="tipoefecto" name="tipoefecto" required="">
                                        <option value="">..Seleccione..</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div id='inputGestion'>

                </div>
            </div>
        </div>
    </div>
</div>
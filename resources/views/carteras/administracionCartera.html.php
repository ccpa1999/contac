<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 mt-lg-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
            <li class="breadcrumb-item">Campañas</li>
            <li class="breadcrumb-item active">Administración Campaña</li>
        </ol>
    </nav>

    <h2 class="ms-4 fw-bold my-5 text-secondary"><i class="fa fa-cogs"></i> Configurar Campaña</h2>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-homologados" data-bs-toggle="tab" data-bs-target="#homologados">HOMOLOGADOS GESTIÓN</button>
            <button class="nav-link" id="nav-campos-gestion" data-bs-toggle="tab" data-bs-target="#campos_gestion">FORMULARIO GESTIÓN</button>
            <button class="nav-link" id="nav-guiones" data-bs-toggle="tab" data-bs-target="#guiones" type="button" role="tab" aria-controls="guiones" aria-selected="false">GUIONES DE GESTIÓN</button>
            <button class="nav-link" id="nav-informacion" data-bs-toggle="tab" data-bs-target="#informacion" type="button" role="tab" aria-controls="informacion" aria-selected="false">SELECCIÓN DE INFORMACIÓN </button>
            <button class="nav-link" id="nav-informacion" data-bs-toggle="tab" data-bs-target="#panelInformacion" type="button" role="tab" aria-controls="panelInformacion" aria-selected="false">TITULOS INFORMACIÓN</button>
            <button class="nav-link" id="nav-informacion" data-bs-toggle="tab" data-bs-target="#panelTablaHistorico" type="button" role="tab" aria-controls="panelTablaHistorico" aria-selected="false">TABLA HISTORICO</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="homologados" role="tabpanel" aria-labelledby="nav-homologados">
            <div class="row d-flex justify-content-around">
                <div class="col-md-10 col-lg-6 mt-2">
                    <div class="card mt-2 shadow-lg p-3 mb-3 bg-body rounded">
                        <div class="card-header">
                            <?php
                            $this->insert(
                                "carteras/componentes/dropdown-homologados.html",
                                [
                                    'nombreCampo' => "Accion",
                                    'label' => "Acción",
                                    'opciones' => $datos['accion'],
                                    'id_select' => "id_accion",
                                    'tipo' => 'accion',
                                ]
                            );
                            ?>
                        </div>

                        <div class="card-body">
                            <div class="row mt-2 me-2">
                                <div class="table-responsive" style="max-height: 31em; overflow:auto;">
                                    <table class="table table-bordered table-light text-center">
                                        <thead>
                                            <tr class="active">
                                                <th><i class="fa fa-volume-control-phone text-success ms-1"></i> ACCIÓN</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datos['homologado_accion'] as $homologado) : ?>
                                                <tr>
                                                    <td><?= mb_strtoupper($this->codificarCaracteres($homologado['homologado'])) ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="...">
                                                            <a class="btn btn-primary formularioEditarRegistro" data-bs-toggle="modal" data-bs-target="#editarRegistro" data-controlador="carterasController" data-ajax="administracionCartera" data-accion="EditarRegistro" data-tipo="EditarAccion" data-id="<?= $homologado['id'] ?>" href="#" role="button">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                            <a class="btn btn-danger eliminarRegistro" href="#" role="button" data-controlador="carterasController" data-ajax="administracionCartera" data-metodo="eliminarRegistro" data-accion="borrarAccion" data-id="<?= $homologado['id'] ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-lg-6 mt-2">
                    <div class="card mt-2 shadow-lg p-3 mb-3 bg-body rounded">
                        <div class="card-header">
                            <?php
                            $this->insert(
                                "carteras/componentes/dropdown-homologados.html",
                                [
                                    'nombreCampo' => "Contacto",
                                    'label' => "Contacto",
                                    'opciones' => $datos['contacto'],
                                    'id_select' => "id_contacto",
                                    'tipo' => 'contacto',
                                ]
                            );
                            ?>
                        </div>

                        <div class="card-body">
                            <div class="row mt-2 me-2" style="max-height: 31em; overflow:auto;">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="active">
                                                <th><span class="fa fa-user-circle success"></span> CONTACTO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datos['homologado_contacto'] as $homologado) : ?>
                                                <tr>
                                                    <td><?= mb_strtoupper($this->codificarCaracteres($homologado['homologado'])) ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="...">
                                                            <a class="btn btn-primary formularioEditarRegistro" data-bs-toggle="modal" data-bs-target="#editarRegistro" data-controlador="carterasController" data-ajax="administracionCartera" data-accion="EditarRegistro" data-tipo="EditarContacto" data-id="<?= $homologado['id'] ?>" href="#" role="button">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                            <a class="btn btn-danger eliminarRegistro" href="#" role="button" data-controlador="carterasController" data-ajax="administracionCartera" data-metodo="eliminarRegistro" data-accion="borrarContacto" data-id="<?= $homologado['id'] ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-around">
                <div class="col-md-10 col-lg-6 mt-2">
                    <div class="card shadow-lg p-3 mb-3 bg-body rounded">
                        <div class="card-header">
                            <?php
                            $this->insert(
                                "carteras/componentes/dropdown-homologados.html",
                                [
                                    'nombreCampo' => "Efecto",
                                    'label' => "Efecto",
                                    'opciones' => $datos['efecto'],
                                    'id_select' => "id_efecto",
                                    'tipo' => 'efecto',
                                ]
                            );
                            ?>
                        </div>

                        <div class="card-body">
                            <div class="row mt-2 me-2" style="max-height: 31em; overflow:auto;">
                                <div class="table-responsive">
                                    <table id="acciones" class="table table-bordered text-center">
                                        <thead>
                                            <tr class="active">
                                                <th><span class="fa fa-flash success"></span> EFECTO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datos['homologado_efecto'] as $homologado) : ?>
                                                <tr>
                                                    <td><?= mb_strtoupper($this->codificarCaracteres($homologado['homologado'])) ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="...">
                                                            <a class="btn btn-primary formularioEditarRegistro" data-bs-toggle="modal" data-bs-target="#editarRegistro" data-controlador="carterasController" data-ajax="administracionCartera" data-tipo="EditarEfecto" data-id="<?= $homologado['id'] ?>" href="#" role="button">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>

                                                            <a class="btn btn-danger eliminarRegistro" href="#" role="button" data-controlador="carterasController" data-ajax="administracionCartera" data-metodo="eliminarRegistro" data-accion="borrarEfecto" data-id="<?= $homologado['id'] ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="campos_gestion" role="tabpanel">
            <h3 class="text-center fw-bold my-3"><i class="bi bi-ui-checks"></i> Definir el formulario de Gestión</h3>

            <form action="javascript:void(0);" class="formCarga" id="camposFormGestion" data-ajax="administracionCartera" data-controlador="carterasController" data-id="camposFormGestion">
                <?php
                $this->insert(
                    'carteras/componentes/content-set-form-gestion.html',
                    ['inputs' => $datos['inputs_gestion'], 'inputs_opciones' => ($datos['inputs_opciones'] ?? [])]
                )
                ?>
            </form>
        </div>

        <div class="tab-pane fade" id="guiones" role="tabpanel" aria-labelledby="nav-guiones">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form id="formCargaGuion" class="formCarga" action="javascript:void(0);" data-controlador="carterasController" data-ajax="administracionCartera" data-tipo="Guiones" enctype="multipart/form-data" data-id="formCargaGuion">
                        <h2 class="text-center fw-bold my-3">Guiones para la Gestión</h2>
                        <div class="mb-2">
                            <label for="tipo_efecto" class="form-label">Seleccione el efecto</label>

                            <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-tasks"></i></div>

                                <select class="form-select" required id="tipo_efecto" name="tipo_efecto" required>
                                    <option value="">..Seleccione..</option>
                                    <?php foreach ($datos['homologado_efecto'] as $homologado) : ?>
                                        <option value="<?= $homologado['id']; ?>"><?= $this->codificarCaracteres($homologado['homologado']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="txtGuion">Guión</label>
                            <textarea name="txtGuion" id="txtGuion" class="form-control" placeholder="..."></textarea>
                        </div>

                        <div class="d-grid gap-2 mb-2">
                            <button class="btn btn-success" type="submit">Guardar Guión</button>
                        </div>

                        <input type="hidden" value="crearRegistro" name="metodo">
                        <input type="hidden" value="guardarGuion" name="accion">
                        <input type="hidden" value="<?= $_SESSION['carteraActual']; ?>" name="cartera">
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="informacion" role="tabpanel" aria-labelledby="nav-informacion">
            <h3 class="text-center fw-bold my-3">Crear Selección</h3>

            <div class="row d-flex justify-content-center g-4">
                <div class="col-md-6 col-lg-5">
                    <form id="formInformacion" class="formCarga" enctype="multipart/form-data" data-id="formInformacion" data-tipo="seleccionInformacion" data-controlador="carterasController" data-ajax="administracionCartera" action="javascript:void(0);">
                        <div class="mb-3">
                            <label for="label" class="form-label fw-bold">Label</label>
                            <input id="label" class="form-control" name="label" type="text" placeholder="Ingresa el texto que deseas indicar" value="<?= $datos['opciones'][0]['label'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="opciones" class="form-label fw-bold">Opciones</label>
                            <input id="opciones" class="form-control" name="opciones" type="text" value="<?= $datos['opciones'][0]['opciones'] ?? '' ?>" placeholder="Cada opción delimitada por coma, long max 25 caracteres">
                        </div>

                        <div class="d-grid gap-2">
                            <input type="submit" class="btn btn-primary" value="GUARDAR">
                        </div>

                        <input type="hidden" name="metodo" value="crearRegistro">
                        <input type="hidden" name="accion" value="crearOpcionesInformacion">
                    </form>
                </div>

                <div class="col-md-6 col-lg-4">
                    <h5 class="fw-bold">Vista Previa</h5>

                    <div class="alert alert-success" role="alert">
                        <h6 id="pvlabel" class="alert-heading fw-bold"><?= (isset($datos['opciones'][0]['label']) && !empty($datos['opciones'][0]['label']) ? $datos['opciones'][0]['label'] : 'Label') ?></h6>
                        <p id="pvopciones" class="mb-0">Opciones</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panelInformacion" role="tabpanel" aria-labelledby="nav-informacion">
            <h3 class="text-center fw-bold my-3">Personalización de Panel Información</h3>
            <div class="row d-flex justify-content-center g-4">
                <div class="col-sm-12 col-md-5">
                    <form id="formTitulos" data-id="formTitulos" data-controlador="carterasController" data-metodo="administracionCartera" data-ajax="administracionCartera" class="formCarga" action="javascript:void(0);" method="post">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Campo</th>
                                    <th>Titulo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datos['label_informacion'] as $titulos) : ?>
                                    <tr>
                                        <td><?= $titulos['campo_tabla'] ?></td>
                                        <td>
                                            <input type="text" data-txttitulo="<?= $titulos['campo_tabla']; ?>" class="txttitulo" name="titulo[<?= $titulos['campo_tabla']; ?>]" value="<?= $titulos['titulo'] ?>">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table><br>
                        <input type="hidden" name="metodo" value="actualizarTituloInformacion">
                        <button class="col-md-6 offset-md-3 btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="col-md-12 col-lg-7">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="card text-dark bg-light">
                                <div class="card-header bg-ligth-blue">
                                    <div class="row d-flex justify-content-around">
                                        <div class="col-auto">
                                            <div class="title-1 fw-bold"><i class="fa fa-info-circle"></i> Información</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body fs-5 altura-max">
                                    <div class="row">
                                        <?php foreach ($datos['label_informacion'] as $titulos) : ?>
                                            <div class="col-sm-12 col-md-12 col-lg-6 border-bottom border-2 mb-2">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6">
                                                        <h5 id="<?= $titulos['campo_tabla']; ?>" class="subtitle-1"><?= $titulos['titulo'] ?>:</h5>
                                                    </div>

                                                    <div class="col-sm-6 col-md-6">
                                                        Ejemplo de dato
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="panelTablaHistorico" role="tabpanel" aria-labelledby="nav-informacion">
            <div class="mt-4 shadow rounded border border-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row my-2">
                            <form id="formTablaHistorico" data-id="formTablaHistorico" class="formCarga mx-3 col-md-12" action="javascript:void(0)" data-controlador="carterasController" data-metodo="administracionCartera" data-ajax="administracionCartera" method="post">
                                <div class="row">
                                    <?php foreach ($datos['inputs_gestion'] as $columnas) : ?>
                                        <?php if ($columnas['estado'] == 1) : ?>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input data-id="<?= $columnas['id_input']; ?>" data-titulo="<?= $columnas['input']; ?>" class="form-check-input colHistorico" type="checkbox" name="id_input[]" value="<?= $columnas['id_input']; ?>" <?= ($columnas['estado_tabla'] == 1) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <?= $columnas['input']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <input type="hidden" name="metodo" value="habilitarColumnas">
                                        <button class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="table-responsive mx-3 small-font" id="divHistoricoGestion">
                                    <table class="table table-striped tablaHistoricoGestion">
                                        <thead class="bg-thead text-white align-middle">
                                            <tr class="titulos">
                                                <th>Fecha</th>
                                                <th>Gestor</th>
                                                <th>Obligación</th>
                                                <th>Acción</th>
                                                <th>Efecto</th>
                                                <th>Contacto</th>
                                                <th>Teléfono</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="columnas">
                                                <td>Valor prueba</td>
                                                <td>Valor prueba</td>
                                                <td>Valor prueba</td>
                                                <td>Valor prueba</td>
                                                <td>Valor prueba</td>
                                                <td>Valor prueba</td>
                                                <td>Valor prueba</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="titulos">
                                                <th>Fecha</th>
                                                <th>Gestor</th>
                                                <th>Obligación</th>
                                                <th>Acción</th>
                                                <th>Efecto</th>
                                                <th>Contacto</th>
                                                <th>Teléfono</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// function codificarCaracteres($cadena)
// {
//     return utf8_decode(utf8_encode($cadena));
// }
?>
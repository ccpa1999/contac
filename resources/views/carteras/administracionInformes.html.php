<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 mt-lg-4 mb-5">
            <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
            <li class="breadcrumb-item">Administración</li>
            <li class="active breadcrumb-item">Informes</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-sm-12 col-md-5 mb-2">
            <div class="card card-body">
                <div class="card-header text-center mb-1">
                    <h3 class="fw-bold">Generar Informe(s)</h3>
                </div>

                <form id="formularioGenerar" class="formCarga" data-id="formularioGenerar" data-controlador="carterasController" data-ajax="administracionInformes" action="javascript:void(0);">
                    <div class="mb-2">
                        <label for="fecha_inicial" class="form-label">Fecha Inicial</label>

                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            <input class="form-control" value="<?= date("Y-m-d") ?>" name="fecha_inicial" autocomplete="off" placeholder="Fecha Inicio" type="date" max="<?= date("Y-m-d") ?>" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="fecha_final" class="form-label">Fecha Final</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-calendar-check-o"></i></div>
                            <input class="form-control" value="<?= date("Y-m-d") ?>" name="fecha_final" autocomplete="off" placeholder="Fecha Final" type="date" max="<?= date("Y-m-d") ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="informe">Tipo de Informe</label>

                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-file-text-o"></i></div>

                            <select class="form-select" name="informe" data-parsley-required required>
                                <option value="">..Informe..</option>
                                <option value='demografico'>Demográfico</option>
                                <option value='gestion'>Gestión</option>
                                <option value='mejor_gestion'>Mejor Gestión</option>
                                <option value='productividad'>Productividad</option>
                                <option value='seguimientos'>Seguimientos</option>
                                <option value='tiempos_muertos'>Tiempos Muertos</option>
                                <option value='tiempos_muertos_detallado'>Tiempos Muertos Detallado</option>
                                <?php if ($_SESSION['carteraActual'] == 19) : ?>
                                    <option value='facturas'>Facturas</option>
                                    <option value='formatos'>Formatos</option>
                                    <option value='no_contac'>No contac</option>
                                    <option value='normalizacion'>Normalizacion</option>
                                    <option value='condonaciones'>Condonaciones</option>
                                    <option value='ajustes'>Ajustes</option>
                                    <option value='pagare'>Pagare</option>
                                    <option value='reprogramados'>Reprogramados</option>
                                    <option value='ROM'>ROM</option>
                                    <option value='gestion_whatsapp'>Gestión Whatsapp</option>
                                    <option value='novedades'>Novedades</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" id="generarInforme" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Generar</button>
                    </div>

                    <input type="hidden" name="metodo" value="generarInforme">
                    <input type="hidden" name="cartera" value="<?= $_SESSION['carteraActual']; ?>">
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-7">
            <div class="row d-flex justify-content-around">
                <div class="col-auto">
                    <h3 class="fw-bold title-informes"><i class="fa fa-folder-open"></i> MIS ARCHIVOS</h3>
                </div>
            </div>

            <div class="row d-flex justify-content-star">
                <div class="col-auto">
                    <button class="btn btn-danger" id="btnBorrarCarpeta" data-controlador="carterasController" data-ajax="administracionInformes" data-function><i class="fa fa-trash">
                        </i> Borrar Todo
                    </button>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead class="thead-informes border boder-light">
                                <tr class="text-white">
                                    <th>Archivo</th>
                                    <th>Fechas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="tb-body-informes border-table-1">
                                <?php foreach ($datos['archivos'] as $archivo) : ?>
                                    <tr>
                                        <td><?= $archivo['Nombre']; ?></td>
                                        <td><?= date("m/d/Y", $archivo['Modificado']); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="...">
                                                <a class="btn btn-success" title="Descargar" href="<?= $archivo['Ruta']; ?>">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a class="btn btn-danger eliminarArchivo" data-ajax="administracionInformes" data-metodo="administracionInformes" data-controlador="carterasController" data-accion="borrarArchivo" data-archivo="<?= $archivo['Nombre']; ?>" href="#" title="Eliminar">
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
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2 mt-lg-4 mb-5">
            <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
            <li class="breadcrumb-item">Administración</li>
            <li class="breadcrumb-item active">Tareas</li>
        </ol>
    </nav>

    <div class="row d-flex justify-content-around">
        <div class="col-auto">
            <h3 class="fw-bold title-informes"><i class="fa fa-list-ol"></i> PANEL DE TAREAS</h3>
        </div>
    </div>

    <div class="row">
        <?php if (count($datos['tareas']) > 0): ?>
            <?php foreach ($datos['tareas'] as $tarea): ?>
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card card-body text-center">
                        <i class="fa fa-tasks fa-2x success"></i>

                        <div class="fw-bold mt-2">Tarea:</div>
                        <div class="fw-bold fs-5 mb-3 text-success"><?= $tarea['nombre_tarea'] ?></div>

                        <div class="fw-bold">Tipo Tarea:</div>
                        <h5 class="fw-bold text-primary"><?= ucwords($tarea['tipo_tarea']) ?></h5>

                        <div class="btn-group btn-group-sm" role="group" aria-label="task-buttons">
                            <button class="btn btn-primary AccionEstadoTarea" data-bs-toggle="modal" 
                                data-bs-target="#estadoTarea_<?= $tarea['id']; ?>" data-id="<?= $tarea['id'] ?>">
                                <i class="fa fa-bar-chart-o"></i> Estado
                            </button>

                            <a class="btn btn-danger eliminarRegistro" data-bs-toggle="modal" data-bs-target="#myModal"
                                data-metodo="admini stracionTareas" data-controlador="carterasController" data-ajax="administracionTareas" 
                                data-accion="borrarTarea" data-id="<?= $tarea['id'] ?>" href="#" role="button">
                                <i class="fa fa-remove"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="d-flex justify-content-around">
                <div class="alert alert-danger mt-3" role="alert">
                    <h4 class="alert-heading">Sin tareas!</h4>
                    <p>No hay tareas asignadas por el momento.</p>
                    <hr>
                    <p class="mb-0">Si desea asignar una o más tareas puede cargarlas en el módulo de 
                        <a href="#" class="fw-bold text-danger button"
                          data-controlador="carterasController" data-metodo="administracionCarga">
                            Cargar
                        </a>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php foreach ($datos['tareas'] as $tarea): ?>
        <div class="modal fade" id="estadoTarea_<?= $tarea['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-lg modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Estado Actual Tarea</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row d-flex justify-content-around">
                            <div id="estadoTareaContent" class="col-md-12 col-lg-5">
                                <p class="text-center"><strong>GESTIONADOS</strong></p>
                                
                                <canvas id="cantidadGestionados_<?= $tarea['id']; ?>" width="400" height="400"></canvas>
                            </div>

                            <div id="estadoTareaContent" class="col-md-12 col-lg-5">
                                <p class="text-center"><strong>GESTIONADOS POR USUARIO</strong></p>

                                <canvas id="cantidadGestionadosUsuario_<?= $tarea['id']; ?>" width="400" height="400"></canvas>
                            </div>
                        </div>

                        <hr>

                        <div class="row d-flex justify-content-center">
                            <div class="col-10 text-center">
                                <p><strong>TIEMPO PROMEDIO POR GESTIÓN</strong></p>
                                <div id="promedioGestionTarea_<?= $tarea['id']; ?>" class="text-success" style="font-size: 20px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="modal fade" id="usuariosTarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Estado Actual Tarea</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="usuariosTareaContent" class="col-md-10 col-md-offset-2">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container shadow mt-5 p-4">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" role="presentation"><a class="nav-link active" href="#FACTURAS" aria-controls="home" role="tab" data-bs-toggle="tab">FACTURAS</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#FORMATOS" aria-controls="profile" role="tab" data-bs-toggle="tab">FORMATOS</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#NO_CONTAC" aria-controls="messages" role="tab" data-bs-toggle="tab">NO CONTAC</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#NORMALIZACIONES" aria-controls="messages" role="tab" data-bs-toggle="tab">NORMALIZACIONES</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#CONDONACIONES" aria-controls="messages" role="tab" data-bs-toggle="tab">CONDONACIONES</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#AJUSTES" aria-controls="messages" role="tab" data-bs-toggle="tab">AJUSTES</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#PAGARE" aria-controls="messages" role="tab" data-bs-toggle="tab">PAGARE</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#REPROGRAMADOS" aria-controls="messages" role="tab" data-bs-toggle="tab">REPROGRAMADOS</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#ROM" aria-controls="messages" role="tab" data-bs-toggle="tab">ROM</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#NOVEDADES" aria-controls="messages" role="tab" data-bs-toggle="tab">NOVEDADES</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#GESTION_WHATSAPP" aria-controls="messages" role="tab" data-bs-toggle="tab">GESTIÓN WHATSAPP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="FACTURAS">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formFacturas" data-id="formFacturas" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" id="cedula" placeholder="Cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="valor_pago" placeholder="Valor pago" class="form-control valor_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="plazo_fecha_pago" placeholder="Fecha pago" class="form-control fecha plazo_fecha_pago">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="obligacion" placeholder="Obligacion" class="form-control obligacion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="correo_cel" placeholder="Correo cel" class="form-control correo_cel">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="facturas">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Valor</th>
                                                                <th>Fecha Pago</th>
                                                                <th>Obligacion</th>
                                                                <th>Correo o cel asociado</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'facturas') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['valor_pago']; ?></td>
                                                                        <td><?= $dato['plazo_fecha_pago']; ?></td>
                                                                        <td><?= $dato['obligacion']; ?></td>
                                                                        <td><?= $dato['correo_cel']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="FORMATOS">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formFormatos" data-id="formFormatos" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="Cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="normalizacion" placeholder="Normalizacion" class="form-control normalizacion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="correo_cel" placeholder="Correo Wp" class="form-control correo_cel">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="formatos">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading4">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Normalizacion</th>
                                                                <th>Correo o cel asociado</th>
                                                                <th>Observacion</th>
                                                                <th>Gestor</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'formatos') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['normalizacion']; ?></td>
                                                                        <td><?= $dato['correo_cel']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="NO_CONTAC">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading5">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formNoContac" data-id="formNoContac" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="no_contac">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading6">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Gestor</th>
                                                                <th>Observacion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'no_contac') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="NORMALIZACIONES">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading7">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formNormalizaciones" data-id="formNormalizaciones" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="obligacion" placeholder="obligacion" class="form-control obligacion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="normalizacion" placeholder="normalizacion" class="form-control normalizacion">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="valor_pago" placeholder="valor pago" class="form-control valor_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="plazo_fecha_pago" placeholder="plazo fecha pago" class="form-control plazo_fecha_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="normalizaciones">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading8">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Obligacion</th>
                                                                <th>Normalizacion</th>
                                                                <th>Valor</th>
                                                                <th>Fecha Pago</th>
                                                                <th>Observacion</th>
                                                                <th>Gestor</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'normalizaciones') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['obligacion']; ?></td>
                                                                        <td><?= $dato['normalizacion']; ?></td>
                                                                        <td><?= $dato['valor_pago']; ?></td>
                                                                        <td><?= $dato['plazo_fecha_pago']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="CONDONACIONES">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading9">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse9" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse9" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formCondonaciones" data-id="formCondonaciones" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="obligacion" placeholder="obligacion" class="form-control obligacion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="valor_pago" placeholder="valor pago" class="form-control valor_pago">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="plazo_fecha_pago" placeholder="plazo fecha pago" class="form-control fecha plazo_fecha_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="correo_cel" placeholder="correo cel" class="form-control correo_cel">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="condonaciones">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading10">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse10" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse10" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Valor</th>
                                                                <th>Fecha Pago</th>
                                                                <th>Obligacion</th>
                                                                <th>Correo o cel asociado</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'condonaciones') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['valor_pago']; ?></td>
                                                                        <td><?= $dato['plazo_fecha_pago']; ?></td>
                                                                        <td><?= $dato['obligacion']; ?></td>
                                                                        <td><?= $dato['correo_cel']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="AJUSTES">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading11">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse11" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse11" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formAjustes" data-id="formAjustes" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="nombre_completo" placeholder="nombre completo" class="form-control nombre_completo">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="obligacion" placeholder="obligacion" class="form-control obligacion">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="tipo_ahorro" placeholder="tipo ahorro" class="form-control tipo_ahorro">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="valor_pago" placeholder="valor pago" class="form-control valor_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="normalizacion" placeholder="normalizacion" class="form-control normalizacion">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="plazo_fecha_pago" placeholder="plazo fecha pago" class="form-control fecha plazo_fecha_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="valor_cruzar" placeholder="valor cruzar" class="form-control valor_cruzar">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="motivo_saldo" placeholder="motivo saldo" class="form-control motivo_saldo">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="ajustes">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading12">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse12" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse12" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Nombre Completo</th>
                                                                <th>Obligacion</th>
                                                                <th>Tipo Ahorro</th>
                                                                <th>Normalizacion</th>
                                                                <th>Fecha Pago</th>
                                                                <th>Valor a cruzar</th>
                                                                <th>Motivo saldo</th>
                                                                <th>Gestor</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'ajustes') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['nombre_completo']; ?></td>
                                                                        <td><?= $dato['obligacion']; ?></td>
                                                                        <td><?= $dato['tipo_ahorro']; ?></td>
                                                                        <td><?= $dato['normalizacion']; ?></td>
                                                                        <td><?= $dato['plazo_fecha_pago']; ?></td>
                                                                        <td><?= $dato['valor_cruzar']; ?></td>
                                                                        <td><?= $dato['motivo_saldo']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="PAGARE">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading13">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse13" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse13" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formPagare" data-id="formPagare" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="nombre_completo" placeholder="nombre completo" class="form-control nombre_completo">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="ciudad_expedicion_cedula" placeholder="ciudad expedicion cedula" class="form-control ciudad_expedicion_cedula">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="correo_cel" placeholder="correo cel" class="form-control correo_cel">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="celular" placeholder="celular" class="form-control celular">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <select class="form-control" name="deudor_codeudor" id="deudor_codeudor deudor_codeudor">
                                                                    <option value="Deudor">Deudor</option>
                                                                    <option value="Codeudor">Codeudor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="normalizacion" placeholder="normalizacion" class="form-control normalizacion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="pagare">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading14">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse14" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse14" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Nombre</th>
                                                                <th>Cedula</th>
                                                                <th>Ciuadad expedicion</th>
                                                                <th>Correo</th>
                                                                <th>Celular</th>
                                                                <th>Deudor/Codeudor</th>
                                                                <th>Gestor</th>
                                                                <th>Normalizacion</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'pagare') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['nombre_completo']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['ciudad_expedicion_cedula']; ?></td>
                                                                        <td><?= $dato['correo_cel']; ?></td>
                                                                        <td><?= $dato['celular']; ?></td>
                                                                        <td><?= $dato['deudor_codeudor']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td><?= $dato['normalizacion']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="REPROGRAMADOS">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading15">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse15" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse15" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formReprogramados" data-id="formReprogramados" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="hora_gestion" placeholder="hora gestion" class="form-control hora_gestion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="asesor_que_llama" placeholder="asesor que llama" class="form-control asesor_que_llama">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="reprogramados">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading16">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse16" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse16" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Hora Gestion</th>
                                                                <th>Gestor</th>
                                                                <th>Gestor que llama</th>
                                                                <th>Observacion</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'reprogramados') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['hora_gestion']; ?></td>
                                                                        <td><?= $dato['plazo_fecha_pago']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="ROM">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading17">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse17" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse17" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formRom" data-id="formRom" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="obligacion" placeholder="obligacion" class="form-control obligacion">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="plazo_fecha_pago" placeholder="plazo fecha pago" class="form-control fecha plazo_fecha_pago">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="medio_pago" placeholder="medio pago" class="form-control medio_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="valor_pago" placeholder="valor pago" class="form-control valor_pago">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="correo_cel" placeholder="correo cel" class="form-control correo_cel">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="numero_caso" placeholder="numero caso" class="form-control numero_caso">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="fecha_respuesta" placeholder="fecha respuesta" class="form-control fecha fecha_respuesta">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="responsable_envio" placeholder="responsable envio" class="form-control responsable_envio">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="rom">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading18">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse18" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse18" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Obligacion</th>
                                                                <th>Fecha Pago</th>
                                                                <th>Medio de pago</th>
                                                                <th>Valor</th>
                                                                <th>Observacion</th>
                                                                <th>Gestor</th>
                                                                <th>Correo o cel asociado</th>
                                                                <th>Fecha ejecucion</th>
                                                                <th># caso</th>
                                                                <th>Fecha respuesta</th>
                                                                <th>Responsable envío</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'rom') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['obligacion']; ?></td>
                                                                        <td><?= $dato['plazo_fecha_pago']; ?></td>
                                                                        <td><?= $dato['medio_pago']; ?></td>
                                                                        <td><?= $dato['valor_pago']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td><?= $dato['correo_cel']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td><?= $dato['numero_caso']; ?></td>
                                                                        <td><?= $dato['fecha_respuesta']; ?></td>
                                                                        <td><?= $dato['responsable_envio']; ?></td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="NOVEDADES">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading19">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse19" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse19" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formNovedad" data-id="formNovedad" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="tipo_ahorro" placeholder="Tipo novedad" class="form-control celular">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="novedad">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading20">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse20" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse20" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Gestor</th>
                                                                <th>Tipo Novedad</th>
                                                                <th>Cedula</th>
                                                                <th>Observaciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'novedad') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td><?= $dato['tipo_ahorro']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="GESTION_WHATSAPP">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading21">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse21" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Hacer una solicitud
                                                </button>
                                            </h2>
                                            <div id="flush-collapse21" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form id="formWhatsapp" data-id="formWhatsapp" class="formCarga" data-controlador="carterasController" data-ajax="formulariosSolicitudes" data-tipo="Asignacion" action="javascript:void(0);">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="cedula" placeholder="cedula" class="form-control cedula">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="celular" placeholder="celular" class="form-control celular">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <input type="text" name="observaciones" placeholder="observaciones" class="form-control observaciones">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""></label>
                                                                <?php if ($_SESSION['rol_actual'] !== '4') : ?>
                                                                    <input type="text" name="fecha_envio" placeholder="fecha envio" class="form-control fecha fecha_envio">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-3 col-md-offset-6">
                                                                <input type="hidden" name="tipo" value="gestion_whatsapp">
                                                                <input type="submit" value="Enviar" class="btn btn-primary">
                                                                <input type="hidden" name="metodo" value="enviarSolicitud">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading22">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse22" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Ver solicitudes
                                                </button>
                                            </h2>
                                            <div id="flush-collapse22" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered tableSolicitudes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Solicitud</th>
                                                                <th>Cedula</th>
                                                                <th>Gestor</th>
                                                                <th>Número</th>
                                                                <th>Novedad</th>
                                                                <th>Fecha ejecucion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos as $dato) : ?>
                                                                <?php if ($dato['tipo'] == 'gestion_whatsapp') : ?>
                                                                    <tr>
                                                                        <td><?= $dato['fecha_solicitud']; ?></td>
                                                                        <td><?= $dato['cedula']; ?></td>
                                                                        <td><?= $dato['gestor']; ?></td>
                                                                        <td><?= $dato['correo_cel']; ?></td>
                                                                        <td><?= $dato['observaciones']; ?></td>
                                                                        <td>
                                                                            <?php if (($_SESSION['rol_actual'] != 4 || $_SESSION['usuario'] == 'omunoz' || $_SESSION['usuario'] == 'smarin') && $dato['fecha_envio'] == '') : ?>
                                                                                <a class="btn btn-info asignarFecha" data-id="<?= $dato['id'] ?>" href="#">
                                                                                    Fecha</a>
                                                                            <?php else : ?>
                                                                                <?= $dato['fecha_envio']; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
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
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
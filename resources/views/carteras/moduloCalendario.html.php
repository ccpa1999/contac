<?php 
    $esAsesor = true;

    for ($contador = 0; $contador < count($_SESSION['acceso']); $contador++)
    {
        if ($_SESSION['acceso'][$contador]['cliente_id'] == $_SESSION['carteraActual'])
        {
            $rolActual = mb_strtoupper($_SESSION['acceso'][$contador]['rol']);
            $rolBuscar = mb_strtoupper("Asesor");

            if (strpos($rolActual, $rolBuscar) === false)
                $esAsesor = false;

            break;
        }
    }
?>

<div class="container-fluid">
    <div class="d-flex flex-row my-3">
        <h1 class="fw-bold ms-4 me-auto"><i class="bi bi-calendar-week-fill"></i> Calendario</h1>

        <?php //if (!$esAsesor): ?>
            <div class=" <?= $esAsesor ? 'invisible' : ''; ?> row">
                <label for="usuarios" class="col-auto col-form-label fw-bold">Usuarios: </label>

                <div class="col-auto me-5">
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-people-fill"></i></div>
                        <select name="usuarios" id="usuarios" class="form-select eventosUser">
                            <option value="<?= $_SESSION['usuario'] ?>">Mis Eventos</option>
                            <option disabled>──────────</option>
            
                            <?php foreach ($datos['usuarios'] as $usuario) : ?>
                                <option value="<?= $usuario['usuario'] ?>"><?= $usuario['usuario'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php //endif;?>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div id="calendar"></div>
        </div>
    </div>

    <div class="modal fade" id="agendarModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Agendar Evento(s)</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="agendarEvento" method="POST" action="javascript: void(0);" class="formCarga"
                      data-id="agendarEvento" data-controlador="carterasController" data-ajax="obtenerCalendario">

                        <div class="mb-2">
                            <label for="tipo" class="form-label">Tipo de Evento: </label>
                            
                            <select id="tipoEvento" name="tipo" type="text" class="form-select" required>
                                <option <?= ($esAsesor ? "disabled" : "") ?> value="">Seleccione...</option>
                                <option <?= ($esAsesor ? "disabled" : "") ?> value="Almuerzo">Almuerzo</option>
                                <option <?= ($esAsesor ? "disabled" : "") ?> value="Break">Break</option>
                                <option <?= ($esAsesor ? "disabled" : "") ?> value="Jornada">Jornada</option>
                                <option <?= ($esAsesor ? "disabled" : "") ?> value="Novedad">Novedad</option>
                                <option <?= ($esAsesor ? "disabled" : "") ?> value="Pausas Activas">Pausas Activas</option>
                                <option value="reprogramacion">Reprogramación</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="inicio_evento" class="form-label">Fecha Inicio Evento: </label>
                            <input id="inicio_evento" name="inicio_evento" type="text" class="validar form-control" required>
    
                            <div id="validationFecha" class="invalid-feedback fw-bold">
                                La fecha inicial debe ser menor o igual que la fecha final.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="fin_evento" class="form-label">Fecha Fin Evento: </label>
                            <input id="fin_evento" name="fin_evento" type="text" class="form-control" required>
                        </div>

                        <div id="contenedor_hora">
                            <div class="mb-2">
                                <label for="h_inicio" class="form-label">Hora Inicio: </label>
                                <input id="h_inicio" name="h_inicio" type="time" class="validar form-control hora" required>

                                <div id="validationHora" class="invalid-feedback fw-bold">
                                    La hora inicial debe ser menor que la hora final.
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="h_fin" class="form-label">Hora Fin: </label>
                                <input id="h_fin" name="h_fin" type="time" class="form-control hora" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label id="tituloLabel" for="titulo" class="form-label">Nombre del evento: </label>
                            <input type="text" id="titulo" name="titulo" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="usuario" class="form-label">Usuario:</label>

                            <select name="usuario" id="usuario" class="form-select" required>
                                <option value="<?= ($esAsesor ? "" : $_SESSION['usuario']) ?>"><?= ($esAsesor ? "seleccione..." : $_SESSION['usuario']) ?></option>

                                <?php foreach ($datos['usuarios'] as $usuario) : ?>
                                    <option value="<?= $usuario['usuario'] ?>"><?= $usuario['usuario'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary button-calendario">
                                Agendar Evento
                            </button>

                            <button type="button" id="eliminarEvento" class="btn btn-danger button-calendario" disabled>
                                Eliminar Evento
                            </button>
                        </div>

                        <input type="hidden" name="metodo" id="metodo" value="crearRegistro">
                        <input type="hidden" name="accion" id="accion" value="guardarEvento">
                        <input type="hidden" name="id" id="id" value="" disabled>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

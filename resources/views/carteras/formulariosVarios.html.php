<?php if ($parametro == 'formularioBusquedaDeudores' || $parametro == 'formularioBusquedaDeudoresEdad') : ?>
    <form id="<?= $parametro ?>" method="POST" action="javascript:void(0);">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo Busqueda</strong></label>

                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-filter"></i></div>

                    <select class="form-control" name="tipo">
                        <option value="cedula">Documento</option>
                        <option value="numero_obligacion">Obligación</option>
                        <option value="telefono">Teléfono</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-xs-5">
                <label for="datoBusqueda"><strong>Dato</strong></label>

                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-info"></i></div>
                    <input type="text" class="form-control inputEnter" name="datoBusqueda" placeholder="Ingrese el dato para busqueda" required>
                </div>
            </div>
        </div>

        <input type="hidden" name="metodo" value="<?= $form = ($parametro == 'formularioBusquedaDeudores') ? 'buscarDeudor' : 'buscarDeudorEdadMora'; ?>">
        <input type="hidden" name="cartera" value="<?= $carteraActual; ?>">
    </form>
<?php elseif ($parametro == 'buscarDeudorDemografico') : ?>
    <form id="formularioBusquedaDeudores" action="javascript:void(0);">
        <label for="datoBusqueda" class="form-label">Cédula</label>

        <div class="input-group">
            <div class="input-group-text"><i class="fa fa-info"></i></div>
            <input type="text" id="cedula" name="datoBusqueda" class="form-control inputEnter" placeholder="Ingrese el número de cédula para busqueda" required>
        </div>

        <input type="hidden" name="metodo" value="buscarDeudorDemografico">
        <input type="hidden" id="cartera" name="cartera" value="<?= $carteraActual; ?>">
    </form>
<?php elseif ($parametro == 'exportarDeudorDemografico') : ?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-dark">
            <thead>
                <tr>
                    <th>Teléfono(s)</th>
                    <th colspan="2">Dirección(es)</th>
                    <th>Correo(s)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $max = count($datos['telefonos']);
                $max2 = (count($datos['direcciones']) >= count($datos['correos'])) ? count($datos['direcciones']) : count($datos['correos']);

                if ($max < $max2) $max = $max2;

                for ($contador = 0; $contador < $max; $contador++) {
                ?>
                    <tr>
                        <td><?= $datos['telefonos'][$contador]['telefono'] ?? "" ?></td>
                        <td><?= $datos['direcciones'][$contador]['ciudad'] ?? "" ?></td>
                        <td><?= $datos['direcciones'][$contador]['direccion'] ?? "" ?></td>
                        <td><?= $datos['correos'][$contador]['correo'] ?? "" ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'listadoTareas') : ?>
    <?php foreach ($tareas as $tarea) : ?>
        <li>
            <a href="#" data-tarea="<?= $tarea['id']; ?>" class="dropdown-item alert alert-success mb-1 py-2 activarTarea">
                <?= ucwords($tarea['nombre_tarea']); ?>
            </a>
        </li>
    <?php endforeach; ?>
<?php elseif ($parametro == 'listadoNotificaciones') : ?>
    <?php foreach ($notificaciones['agendamiento'] as $agendamiento) : ?>
        <li>
            <a href="#" class="dropdown-item alert alert-primary mb-1 py-2 <?= ($agendamiento['tipo'] == 'reprogramacion') ? 'cedulaAgendamiento' : ''; ?>" data-cedula="<?= $agendamiento['title']; ?>">
                <i class="fa fa-phone"></i>
                <b><?= ucwords($agendamiento['tipo']) ?></b> para hoy: <b><?= $agendamiento['title']; ?></b>
                desde <b><?= explode(' ', $agendamiento['start'])[1]; ?></b>
                hasta <b><?= explode(' ', $agendamiento['end'])[1]; ?></b>
            </a>
        </li>
    <?php endforeach; ?>
<?php elseif ($parametro == 'miProductividad') : ?>
    <div class="row">
        <div id="estadoTareaContent" class="col-md-5">
            <p style="text-align: center;"><strong>Estadisticas por analista</strong></p>
            <canvas id="miProductividadCanvas" width="200" height="200"></canvas>
        </div>
    </div>
<?php elseif ($parametro == 'formularioCambiarOrden') : ?>
    <p style="text-align: center;"><strong>Seleccione el orden del saldo expuesto</strong></p><br>
    <form id="formularioCambiarOrden" action="javascript:void(0);">
        <label>Obligaciones</label>
        <select class="form-control" id="filtro1" name="filtro1">
            <option value="">..Seleccione..</option>
            <option value=",o.regional">REGIONAL</option>
            <option value=",o.ultimo_efecto">ULTIMO EFECTO</option>
            <option value=",o.valor_actual_inicial">VALOR ACTUAL INICIAL</option>
            <option value=",o.dia_facturacion">DÍA FACTURACIÓN</option>
            <option value=",o.franja_actual">FRANJA ACTUAL</option>
            <option value=",o.estado_obligacion">ESTADO OBLIGACIÓN</option>
            <option value=",o.dias_mora_inicial">DIAS MORA INICIAL</option>
            <option value=",o.dias_mora_actual">DIAS MORA ACTUAL</option>
            <option value=",o.fecha_pago">FECHA DE PAGO</option>
            <option value=",o.saldo_capital_inicial">SALDO CAPITAL INICIAL</option>
            <option value=",o.saldo_total">SALDO TOTAL</option>
            <option value=",o.saldo_expuesto">SALDO EXPUESTO</option>
        </select><br>
        <div class="orden hide form-group">
            <label>Orden</label>
            <select class="form-control" name="orden">
                <option value="">..Seleccione..</option>
                <option value="ASC">ASCENDENTE</option>
                <option value="DESC">DESCENDENTE</option>
            </select>
        </div><br>
        <label>Gestión</label>
        <select class="form-control" id="filtro2" name="filtro2">
            <option value="">..Seleccione..</option>
            <option value="h.fecha_gestion">FECHA DE GESTIÓN</option>
            <option value="h.efecto">EFECTO</option>
            <option value="h.motivo_no_pago">MOTIVO DE NO PAGO</option>
            <option value="h.fecha_acuerdo">FECHA DE ACUERDO</option>
        </select><br>
        <div class="orden1 hide form-group">
            <label>Orden</label>
            <select class="form-control" name="orden1">
                <option value="">..Seleccione..</option>
                <option value="ASC">ASCENDENTE</option>
                <option value="DESC">DESCENDENTE</option>
            </select>
        </div>
        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
        <input type="hidden" name="metodo" value="cambiarOrdenTarea">
        <input type="hidden" name="id_tarea" value="<?= $datos['id_tarea']; ?>">
    </form>
    </div>
<?php elseif ($parametro == 'seleccionarObligacionesGestion') : ?>
    <div class="row">
        <div class="col-md-6">
            <?php foreach ($obligaciones as $obligacion) : ?>
                <strong><?= $obligacion['numero_obligacion']; ?></strong>
            <?php endforeach; ?>
        </div>
        <div class="col-md-6">
            <select name="">
                <option value=""></option>
            </select>
        </div>
    </div>
<?php elseif ($parametro == 'formularioPausas') : ?>
    <div class="d-flex row justify-content-around">
        <div class="col-md-8 mb-2">
            ¡Actualmente te encuentras en pausa por <strong><?= $datos['label']; ?></strong>!
        </div>
    </div>

    <form id="formTiempos" action="javascript:void();">
        <div class="d-flex justify-content-around row">
            <div class="col-auto mb-2">
                <input class="cronometro text-center form-control text-primary fw-bold" type="text" id="cronometroTiempos" placeholder="0" readonly name="tiempo">
                <input type="hidden" name="metodo" value="guardarTiempoMuerto">
                <input type="hidden" name="tipo" value="<?= $datos['pausa']; ?>">
                <input type="hidden" name="cartera" value="<?= $carteraActual; ?>">
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-around row">
        <div class="col-auto">
            <input type="password" class="form-control inputEnter" name="password" id="passwordTiempos" placeholder="Ingresar contraseña">
            <p id="mensaje_error_tiempos" style="display: none; color:red;"><strong>¡Contraseña incorrecta!</strong></p>
        </div>
    </div>
<?php elseif ($parametro == 'opciones-select') : ?>
    <div class="card-body mt-0 pt-0" id="innerOpciones-<?= $datos['id'] ?>">
        <h6 class="text-center fw-bold">Ingrese las Opciones</h6>

        <?php
        $this->insert(
            'carteras/componentes/inputs-opciones-gestion.html',
            ['id_input' => $datos['id_input'], 'id_campo' => $datos['id']]
        )
        ?>
    </div>
<?php elseif ($parametro == 'descargarCarta') : ?>
    <br>
    <center>
        <p><strong>Su PDF fue generado correctamente</strong></p>
        <p>Descarguelo haciendo click en el botón</p>
        <br>
        <p>
            <a href="<?= $ruta; ?>" class="btn btn-danger" target="_blank">
                <i class="fa fa-file-pdf-o fa-4x"></i>
            </a>
        </p>
    </center>
<?php elseif ($parametro == 'panelSoporte') : ?>
    <form id="formSoporte" method="POST" action="javascript:void();">
        <div class="row">
            <div class="col-xs-6">
                <label><b>Tipo de error</b></label>
                <select id="errores_soporte" name="errores_soporte" class="form-control">
                    <option value="">...SELECCIONE...</option>
                    <?php foreach ($errores as $error) : ?>
                        <option value="<?= $error['error'] ?>"><?= $error['error'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-xs-6">
                <label><b>Extención</b></label>
                <input class="form-control" type="text" name="extencion" id="extencion" placeholder="Extención">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label><b>Detalle</b></label>
                <textarea class="form-control" name="detalle" id="detalle" placeholder="Detalle" maxlength="255" cols="30" rows="2"></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="input-group">
                <input type="hidden" name="metodo" value="submitSoporte">
                <button class="btn btn-primary submitSoporte" type="button" style="margin-top: 1%;margin-left: 53%;width: 44%; font-weight: bold">
                    <i class="fa fa-envelope-o"></i> ENVIAR
                </button>
            </div>
        </div>
    </form>
<?php elseif ($parametro == 'panelAsignacionMora') : ?>
    <ol class="breadcrumb">
        <li><a href="#">FIANZA LTDA</a></li>
        <li>Administración</li>
        <li class="active">Asignación</li>
    </ol>
    <div class="row">
        <div class="col-md-12 switch">
            <div class="switch-right-grid">
                <div class="switch-right-grid1">
                    <div>
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="#">
                                        <h3>ASIGNACIÓN</h3>
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div style="margin-left: 27%;" class="container">
                        <div class="col-sm-6">
                            <div class="thumbnail">
                                <center><i class="fa fa-user fa-2x success"></i></center>
                                <div class="caption" style="text-align: center;">
                                    <div class="form-group">
                                        <label><strong>USUARIO:</strong></label>
                                        <select class="form-control" id="asesores" name="asesores">
                                            <option value="0">...SELECCIONE...</option>
                                            <?php foreach ($resultado['asesores'] as $usuario) : ?>
                                                <option value="<?= $usuario['id_usuario'] ?>"><?= $usuario['usuario'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="tablaAsignacion"></div>
                </div>
            </div>
        </div>
    <?php elseif ($parametro == 'panelChat') : ?>
        <style>
            * {
                scrollbar-color: rgb(2, 117, 216, 1) lightgray;
                scrollbar-width: thin;
            }
        </style>
        <div class="row">
            <div class="col-xs-3 siblings">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">CHATS</div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="input-group in-grp1">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </span>
                                    <input class="form-control busqueda" type="text" placeholder="Búsqueda Chats" autocomplete="off" maxlength="50" data-div-resultado="resultadoBusquedaChats" data-metodo="buscarChats">
                                </div>
                            </div>
                        </div>
                        <div id="resultadoBusquedaChats">
                            <div class="list-group pre-scrollable">
                                <input class="hidden" type="text" id="usuarioActual" value="<?= $_SESSION['id_usuario'] . ',' . $_SESSION['usuario'] ?>">
                                <?php foreach ($mensajes['mensajes'] as $mensaje) :
                                    $emisor = explode(',', $mensaje['id_emisor']);
                                    $receptor = explode(',', $mensaje['id_receptor']);
                                    if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) : ?>
                                        <?php $notificacion = "fa fa-bookmark align-right text-primary" ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <?php if (isset($_SESSION['carteraActual'])) : ?>
                                    <a href="#" data-idGrupo="18" class="grupo list-group-item btn btn-info">Coordinador</a>
                                <?php endif; ?>
                                <?php if (strpos(ucwords($_SESSION['rol_actual']), "Asesor") === false) : ?>
                                    <a href="#" data-idGrupo="16" class="grupo list-group-item btn btn-info">Fianza</a>
                                    <?php foreach ($resultado['recientes'] as $reciente) : ?>
                                        <?php $idReciente = explode(",", $reciente['id_receptor']); ?>
                                        <?php $emiReciente = explode(",", $reciente['id_emisor']) ?>
                                        <?php if ($idReciente[0] === $_SESSION['id_usuario']) : ?>
                                            <a href="#" data-idGrupo="<?= $reciente['id_emisor'] ?>" class="grupo list-group-item btn btn-info"><?= utf8_decode(utf8_encode($emiReciente[1])) ?><i class="<?= $notifify = ($reciente['visto'] == 0) ? $notificacion : ""; ?>"></i></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($resultado['grupos'] as $grupo) : ?>
                                        <?php if ($grupo['id_cliente'] != 10 && $grupo['id_cliente'] != 11) : ?>
                                            <a href="#" data-idGrupo="<?= $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?= utf8_decode(utf8_encode($grupo['nombre_cliente'])) ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php elseif (strpos(ucwords($_SESSION['rol_actual']), "Asesor") !== false || $_SESSION['rol_actual'] != "0") : ?>
                                    <?php foreach ($resultado['grupos'] as $grupo) : ?>
                                        <?php if ($_SESSION['carteraActual'] == $grupo['id_cliente']) : ?>
                                            <a href="#" data-idGrupo="<?= $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?= $grupo['nombre_cliente'] ?><i class="<?= $notificacion; ?>"></i></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($mensajes['agrupados'] as $mensaje) :
                                        $emisor = explode(',', $mensaje['id_emisor']);
                                        $receptor = explode(',', $mensaje['id_receptor']);
                                        if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) : ?>
                                            <a href="#" data-idGrupo="<?= $mensaje['id_emisor'] ?>" class="list-group-item btn btn-info"><?= utf8_decode(utf8_encode($emisor[1])) ?><i class="<?= $notifify = ($mensaje['visto'] == 0) ? $notificacion : ""; ?>"></i></a>
                                    <?php endif;
                                    endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-9">
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">MENSAJES</div>
                        <div style="background: radial-gradient(circle, rgba(63,187,251,0.4429972672662815) 30%, rgba(63,155,251,0.6054622532606793) 100%);" class="divu panel-body pre-scrollable nicescroll-rails">
                            <div id="mensajes"></div>
                        </div>
                        <form id="formMensaje" data-id="formMensaje" class="formCarga" enctype="multipart/form-data" action="javascript:void(0);">
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <div class="input-group">
                                            <textarea type="text" name="mensaje" maxlength="1000" placeholder="Mensaje" class="mensaje form-control"></textarea>
                                            <input type="file" name="archivo" readyonly class="file-loading inputCarga">
                                            <!--<button id="enviarMensaje" class="w-25 fa fa-paper-plane-o"></button>-->
                                            <input type="hidden" id="receptor" name="receptor">
                                            <input type="hidden" name="metodo" value="submitMensaje">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
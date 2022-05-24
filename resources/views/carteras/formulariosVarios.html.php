<?php if ($parametro == 'formularioBusquedaDeudores' || $parametro == 'formularioBusquedaDeudoresEdad') : ?>
    <form id="formularioBusquedaDudores" action="javascript:void(0);">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo Busqueda</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-filter"></i>
                    </div>
                    <select class="form-control" name="tipo">
                        <option value="cedula">Documento</option>
                        <option value="numero_obligacion">Obligacion</option>
                        <option value="telefono">Teléfono</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Dato</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" required name="datoBusqueda" placeholder="Ingrese el dato para busqueda" class="form-control inputEnter">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="<?php echo $form = ($parametro == 'formularioBusquedaDeudores') ? 'buscarDeudor' : 'buscarDeudorEdadMora'; ?>">
        <input type="hidden" name="cartera" value="<?php echo $carteraActual; ?>">
    </form>
<?php elseif ($parametro == 'buscarDeudorDemografico') : ?>
    <form id="formularioBusquedaDudores" action="javascript:void(0);">
        <div class="row">
            <div class="form-group col-xs-10 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Cédula</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" id="cedula" required name="datoBusqueda" placeholder="Ingrese el número de cédula para busqueda" class="form-control inputEnter">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="buscarDeudorDemografico">
        <input type="hidden" id="cartera" name="cartera" value="<?php echo $carteraActual; ?>">
    </form>
<?php elseif($parametro == 'exportarDeudorDemografico'): ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>Direccion</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos as $dato): ?>
                <tr>
                    <td><?php echo $dato['cedula_deudor'] ?></td>
                    <td><?php echo $dato['telefono'] ?></td>
                    <td><?php echo $dato['ciudad'] ?></td>
                    <td><?php echo $dato['direccion'] ?></td>
                    <td><?php echo $dato['correo'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
<?php elseif ($parametro == 'tablaHistorico') : ?>
    <table class="table table-bordered tablaHistoricoGestion">
        <thead>
            <tr class="success">
                <th>Fecha</th>
                <th>Gestor</th>
                <th>Obligación</th>
                <th>Acción</th>
                <th>Efecto</th>
                <th>Contacto</th>
                <th>Motivo No Pago</th>
                <th>Fecha Seguimiento</th>
                <th>Valor Acuerdo</th>
                <th>Teléfono</th>
                <th>Tipo Negociacíón</th>
                <th>Obervaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
                <tr>
                    <td><?php echo $dato['fecha_gestion']; ?></td>
                    <td><?php echo $dato['gestor']; ?></td>
                    <td><?php echo $dato['obligacion']; ?></td>
                    <td><?php echo $dato['accion']; ?></td>
                    <td><?php echo $dato['efecto']; ?></td>
                    <td><?php echo $dato['contacto']; ?></td>
                    <td><?php echo $dato['motivo_no_pago']; ?></td>
                    <td><?php echo $dato['fecha_seguimiento']; ?></td>
                    <td><?php echo $dato['valor_acuerdo']; ?></td>
                    <td><?php echo $dato['telefono']; ?></td>
                    <td><?php echo $dato['tipo_negociacion']; ?></td>
                    <td><?php echo utf8_encode($dato['observaciones']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
elseif ($parametro == 'listadoTareas') :
    foreach ($tareas as $tarea) :
    ?>
        <li>
            <a href="#" data-tarea="<?php echo $tarea['id']; ?>" class="label label-success activarTarea">
                <h4><strong><?php echo ucwords($tarea['nombre_tarea']); ?></strong></h4>
            </a>
        </li>
    <?php endforeach; ?>
    <?php
elseif ($parametro == 'listadoNotificaciones') :
    foreach ($notificaciones['agendamiento'] as $agendamiento) :
    ?>
        <li>
            <a href="#" class="label label-warning cedulaAgendamiento" data-cedula="<?php echo $agendamiento['documento_titular']; ?>">
                <div class="row">
                    <div class="col-xs-1">
                        <i class="fa fa-phone fa-2x"></i>
                    </div>
                    <div class="col-xs-8">
                        <strong>Alerta de agendamiento titular: <?php echo $agendamiento['documento_titular']; ?><p>para el <?php echo $agendamiento['fecha']; ?> </strong></p>
                    </div>
                </div>
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
        <input type="hidden" name="cartera" value="<?php echo $datos['cartera']; ?>">
        <input type="hidden" name="metodo" value="cambiarOrdenTarea">
        <input type="hidden" name="id_tarea" value="<?php echo $datos['id_tarea']; ?>">
    </form>
    </div>

<?php elseif ($parametro == 'telefono') : ?>
    <form class="formularioCreacion" id="formCreacionTelefono" action="javascript:void(0);" data-metodo="buscarDeudorRecarga" data-tipo="cedula" data-dato="<?php echo $datos['identificacion']; ?>" data-controlador="carterasController.php" data-div="divTelefonos">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo Teléfono</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <select class="form-control" data-parsley-required="" name="tipo">
                        <option value="">..seleccione..</option>
                        <option value="celular">Celular</option>
                        <option value="celular oficina">Celular Oficina</option>
                        <option value="otro celular">Otro Celular</option>
                        <option value="otro teléfono">Otro Teléfono</option>
                        <option value="teléfono oficina">Telefono Oficina</option>
                        <option value="teléfono residencia">Teléfono Residencia</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Teléfono</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" required name="telefono" placeholder="Ingrese el teléfono" class="form-control" required="">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="creacionDemografico">
        <input type="hidden" id="accion" name="accion" value="crearTelefono">
        <input type="hidden" name="identificacion" value="<?php echo $datos['identificacion']; ?>">
        <input type="hidden" name="div" value="divTelefonos">
        <input type="hidden" name="cartera" value="<?php echo $datos['cartera']; ?>">
    </form>

<?php elseif ($parametro == 'direccion') : ?>
    <form class="formularioCreacion" id="formCreacionDireccion" action="javascript:void(0);" data-metodo="buscarDeudorRecarga" data-tipo="cedula" data-dato="<?php echo $datos['identificacion']; ?>" data-controlador="carterasController.php" data-div="divDirecciones">
        <div class="row">
            <div class="form-group col-xs-4">
                <label for="exampleInputEmail1"><strong>Tipo Dirección</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <select class="form-control" name="tipo" required="">
                        <option value="">..seleccione..</option>
                        <option value="direccion residencia">Dirección Residencia</option>
                        <option value="direccion empresarial">Dirección Empresarial</option>
                        <option value="otra direccion">Otra Dirección</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-4">
                <label for="exampleInputEmail1"><strong>Dirección</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" name="direccion" placeholder="Ingrese la Dirección" class="form-control" required="">
                </div>
            </div>
            <div class="form-group col-xs-4">
                <label for="exampleInputEmail1"><strong>Ciudad</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <input type="text" name="ciudad" placeholder="Ingrese la Ciudad" class="form-control" required="">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="creacionDemografico">
        <input type="hidden" id="accion" name="accion" value="crearDireccion">
        <input type="hidden" name="identificacion" value="<?php echo $datos['identificacion']; ?>">
        <input type="hidden" name="div" value="divDirecciones">
        <input type="hidden" name="cartera" value="<?php echo $datos['cartera']; ?>">
    </form>

<?php elseif ($parametro == 'email') : ?>
    <form class="formularioCreacion" id="formCreacionEmail" action="javascript:void(0);" data-metodo="buscarDeudorRecarga" data-tipo="cedula" data-dato="<?php echo $datos['identificacion']; ?>" data-controlador="carterasController.php" data-div="divCorreos">
        <div class="row">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Tipo E-mail</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <select class="form-control" name="tipo" required="">
                        <option value="">..seleccione..</option>
                        <option value="email personal">E-mail Personal</option>
                        <option value="email oficina">E-mail Oficina</option>
                        <option value="otro email">Otro E-mail</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Email</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </div>
                    <input type="text" required name="email" placeholder="Ingrese el Email" class="form-control" required="">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="creacionDemografico">
        <input type="hidden" id="accion" name="accion" value="crearEmail">
        <input type="hidden" name="identificacion" value="<?php echo $datos['identificacion']; ?>">
        <input type="hidden" name="div" value="divCorreos">
        <input type="hidden" name="cartera" value="<?php echo $datos['cartera']; ?>">
    </form>

<?php elseif ($parametro == 'seleccionarObligacionesGestion') : ?>
    <div class="row">
        <div class="col-md-6">
            <?php foreach ($obligaciones as $obligacion) : ?>
                <strong><?php echo $obligacion['numero_obligacion']; ?></strong>
            <?php endforeach; ?>
        </div>
        <div class="col-md-6">
            <select name="">
                <option value=""></option>
            </select>
        </div>
    </div>
<?php elseif ($parametro == 'formularioPausas') : ?>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            ¡Actualmente te encuentras en pausa por <strong><?php echo $datos['label']; ?></strong>!
        </div>
    </div>
    <br>
    <form id="formTiempos" action="javascript:void();">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <input style="text-align: center; color: #3498db;" type="text" id="cronometroTiempos" placeholder="0" readonly class="cronometro" name="tiempo">
                <input type="hidden" name="metodo" value="guardarTiempoMuerto">
                <input type="hidden" name="tipo" value="<?php echo $datos['pausa']; ?>">
                <input type="hidden" name="cartera" value="<?php echo $carteraActual; ?>">
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <input type="password" class="form-control inputEnter" name="password" id="passwordTiempos" placeholder="Ingresar contraseña">
            <p id="mensaje_error_tiempos" style="display: none; color:red;"><strong>¡Contraseña incorrecta!</strong></p>
        </div>
    </div>
<?php elseif ($parametro == 'descargarCarta') : ?>
    <br>
    <center>
        <p><strong>Su PDF fue generado correctamente</strong></p>
        <p>Descarguelo haciendo click en el botón</p>
        <br>
        <p>
            <a href="<?php echo $ruta; ?>" class="btn btn-danger" target="_blank">
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
                        <option value="<?php echo $error['error'] ?>"><?php echo $error['error'] ?></option>
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
                                                <option value="<?php echo $usuario['id_usuario'] ?>"><?php echo $usuario['usuario'] ?></option>
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
                                <input class="hidden" type="text" id="usuarioActual" value="<?php echo $_SESSION['id_usuario'] . ',' . $_SESSION['usuario']?>">
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
                                <?php if ($_SESSION['rol_actual'] !== "4") : ?>
                                    <a href="#" data-idGrupo="16" class="grupo list-group-item btn btn-info">Fianza</a>
                                    <?php foreach ($resultado['recientes'] as $reciente) : ?>
                                        <?php $idReciente = explode(",", $reciente['id_receptor']); ?>
                                        <?php $emiReciente = explode(",",$reciente['id_emisor']) ?>
                                        <?php if ($idReciente[0] === $_SESSION['id_usuario']) : ?>
                                            <a href="#" data-idGrupo="<?php echo $reciente['id_emisor'] ?>" class="grupo list-group-item btn btn-info"><?php echo utf8_decode(utf8_encode($emiReciente[1])) ?><i class="<?php echo $notifify = ($reciente['visto'] == 0) ? $notificacion : ""; ?>"></i></a>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    <?php foreach ($resultado['grupos'] as $grupo) : ?>
                                        <?php if ($grupo['id_cliente'] != 10 && $grupo['id_cliente'] != 11) : ?>
                                            <a href="#" data-idGrupo="<?php echo $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?php echo utf8_decode(utf8_encode($grupo['nombre_cliente'])) ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php elseif ($_SESSION['rol_actual'] === "4" || $_SESSION['rol_actual'] != "0") : ?>
                                    <?php foreach ($resultado['grupos'] as $grupo) : ?>
                                        <?php if ($_SESSION['carteraActual'] == $grupo['id_cliente']) : ?>
                                            <a href="#" data-idGrupo="<?php echo $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?php echo $grupo['nombre_cliente'] ?><i class="<?php echo $notificacion; ?>"></i></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php foreach ($mensajes['agrupados'] as $mensaje) :
                                        $emisor = explode(',', $mensaje['id_emisor']);
                                        $receptor = explode(',', $mensaje['id_receptor']);
                                        if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) : ?>
                                            <a href="#" data-idGrupo="<?php echo $mensaje['id_emisor'] ?>" class="list-group-item btn btn-info"><?php echo utf8_decode(utf8_encode($emisor[1])) ?><i class="<?php echo $notifify = ($mensaje['visto'] == 0) ? $notificacion : ""; ?>"></i></a>
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
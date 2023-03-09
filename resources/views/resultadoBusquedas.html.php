<?php if ($parametro == 'busquedaUsuarios') : ?>
    <?php foreach ($resultados as $usuario) : ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <!--<img alt="100%x200" data-src="holder.js/100%x200" style="display: block;" src="../../public/images/1476391269_human.png" data-holder-rendered="true">-->
                <center><i class="fa fa-user-o fa-4x success"></i></center>
                <div class="caption" style="text-align: center;">
                    <h3><?= ucwords($usuario['nombre_completo']); ?></h3>
                    <p>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><strong>Usuario:</strong></label>
                        <h4><span class="label label-success"><?= $usuario['usuario'] ?></span></h4>
                    </div>
                    <div class="form-group">
                        <label><strong>Fecha Creación:</strong></label>
                        <h4><span class="label label-warning"><?= $usuario['fecha_creacion'] ?></span></h4>
                    </div>
                    </p>
                    <p>
                    <div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-tipo="editarUsuario" data-controlador="administracionController" data-id="<?= $usuario['id_usuario'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-edit"></span> Editar</a>
                        <!-- <a class="btn btn-primary reestablecerContraseña" title="Reestablecer Contraseña" data-ajax="administracionUsuarios" data-controlador="administracionController" data-id="<?= $usuario['id_usuario'] ?>" href="#">
                                                <span class="fa fa-lock"></span> Reestablecer</a> -->
                        <a class="btn btn-primary obtenerPermisos" data-toggle="modal" data-target="#permisosUsuario" data-controlador="administracionController" data-idenUsuario="<?= $usuario['identificacion']; ?>" data-usuario="<?= $usuario['id_usuario'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-fire"></span> Permisos</a>
                        <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-target="#myModal" data-ajax="administracionUsuarios" data-controlador="administracionController" data-accion="borrarUsuario" data-id="<?= $usuario['id_usuario'] ?>" href="#" role="button">
                            <span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php elseif ($parametro == 'buscarAsignacionMora') : ?>
    <div class="container">
        <div class="col-sm-12">
            <div class="thumbnail">
                <table class="table table-bordered tablaAsignacionEdadMora" style="width: 100%;">
                    <thead>
                        <tr class="success">
                            <th><input type="checkbox"></th>
                            <th>EDADES DE MORA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado['edades_mora'] as $edad) : ?>
                            <?php $atributo = "";
                            foreach ($resultado['asignacion'] as $asignadas) :
                                foreach ($resultado['asesores'] as $usuario) :
                                    if ($asignadas['id_usuario'] == $usuario['id_usuario'] && $edad['id'] == $asignadas['id_edad_mora']) :
                                        $atributo = 'checked';
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                            <tr>
                                <td class="col-sm-1"> <input type="checkbox" <?= $atributo; ?> class="formAsignarEdadMora" cartera=<?= $_SESSION['carteraActual'] ?> id_edad=<?= $edad['id'] ?> id_usuario=<?= $asignadas['id_usuario'] ?>></td>
                                <td class="col-sm-11">Edad de Mora <b><?= $edad['edad']; ?></b></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'formularioCambiarOrden') : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <select class="form-control" name="columna" id="columna1">
                    <option value="">..Seleccione..</option>
                    <?php
                    ($resultado['filtro2'][0]) ? $resultado['filtro1'] = $resultado['filtro2'][0] : '';
                    if ($resultado['filtro1']) :
                        foreach ($resultado['filtro1'] as $columnas) : ?>
                            <option value="<?= $columnas['columna']; ?>"><?= $columnas['columna']; ?></option>
                    <?php endforeach;
                    endif ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="columna" id="columna2">
                    <option value="">..Seleccione..</option>
                    <?php
                    if ($resultado['filtro2']) :
                        foreach ($resultado['filtro2'][1] as $columnas) : ?>
                            <option value="<?= $columnas['columna']; ?>"><?= $columnas['columna']; ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="columna" id="columna3">
                    <option value="">..Seleccione..</option>
                    <?php
                    if ($resultado['filtro3']) :
                        foreach ($resultado['filtro3'][2] as $columnas) : ?>
                            <option value="<?= $columnas['columna']; ?>"><?= $columnas['columna']; ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'obtenerChats') : ?>
    <?php foreach ($resultado['mensajes'] as $mensaje) : ?>
        <?php $emisor = explode(',', $mensaje['id_emisor']); ?>
        <?php $receptor = explode(',', $mensaje['id_receptor']); ?>
        <?php $fecha = explode(' ', $mensaje['fecha']); ?>
        <?php ($emisor[1] == $_SESSION['usuario']) ? $clase = "alert bg-primary text-right col-md-offset-6" : $clase = "well col-md-6" ?>
        <?php if ($receptor[0] == $_SESSION['id_usuario'] || $emisor[0] == $_SESSION['id_usuario'] && $receptor[0] >= 20 && $mensaje['mensaje'] != '') : ?>
            <div class="row">
                <div title="<?= "visto: " . $mensaje['fecha_visto'] ?>" style="border-radius: 16px;" class="<?= $clase ?>">
                    <div style="word-wrap: break-word">
                        <?php $mensaje = explode(';', $mensaje['mensaje']); ?>
                        <div><?= $mensaje[0]; ?></div>
                        <?php if (!empty($mensaje[1])) : ?>
                            <div><a style="color: black;" target="_blank" href="../../public/archivos/cargas/archivosChat/<?= $mensaje[1] ?>"><i style="padding: 5px;" class="fa fa-file-text-o" aria-hidden="true"></i><?= $mensaje[1] ?></a></div>
                        <?php endif; ?>
                    </div>
                    <p style="font-size: 70%;"><b><?= $fecha[1] ?></b></p>
                </div>
            </div>
        <?php elseif ($receptor[0] <= 20 && $mensaje['mensaje'] != '') : ?>
            <div class="row">
                <div title="<?= "visto: " . $mensaje['fecha_visto'] ?>" style="border-radius: 16px;" class="<?= $clase ?>">
                    <div class="">
                        <p><b><?= ($emisor[1] != $_SESSION['usuario']) ? $emisor[1] : ''; ?></b></p>
                    </div>
                    <div style="word-wrap: break-word">
                        <?php $mensaje = explode(';', $mensaje['mensaje']); ?>
                        <div><?= $mensaje[0]; ?></div>
                        <?php if (!empty($mensaje[1])) : ?>
                            <div><a style="color: black;" target="_blank" href="../../public/archivos/cargas/archivosChat/<?= $mensaje[1] ?>"><i style="padding: 5px;" class="fa fa-file-text-o" aria-hidden="true"></i><?= $mensaje[1] ?></a></div>
                        <?php endif; ?>
                    </div>
                    <p style="font-size: 70%;"><b><?= $fecha[1] ?></b></p>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php elseif ($parametro == 'busquedaChats') : ?>
    <div class="list-group pre-scrollable">
        <?php if (isset($mensajes['mensajes'])) : ?>
            <?php foreach ($mensajes['mensajes'] as $mensaje) :
                $emisor = explode(',', $mensaje['id_emisor']);
                $receptor = explode(',', $mensaje['id_receptor']);
                if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) :
                    $notificacion = "fa fa-bookmark align-right text-primary";
                else :
                    $notificacion = "";
                endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['carteraActual'])) : ?>
            <a href="#" data-idGrupo="18" class="grupo list-group-item btn btn-info">Coordinador</a>
        <?php endif; ?>
        <?php if (strpos(ucwords($_SESSION['rol_actual']),"Asesor") === false) : ?>
            <a href="#" data-idGrupo="16" class="grupo list-group-item btn btn-info">Fianza</a>
            <?php if (isset($resultado['grupos'])) : ?>
                <?php foreach ($resultado['grupos'] as $grupo) : ?>
                    <?php if ($grupo['id_cliente'] != 10 && $grupo['id_cliente'] != 11) : ?>
                        <a href="#" data-idGrupo="<?= $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?= utf8_decode(utf8_encode($grupo['nombre_cliente'])) ?><i class="<?= $notificacion; ?>"></i></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($resultado['usuarios'])) : ?>
                <?php foreach ($resultado['usuarios'] as $usuario) : ?>
                    <?php if ($usuario['id_usuario'] != $_SESSION['id_usuario']) : ?>
                        <a href="#" data-idGrupo="<?= $usuario['id_usuario'] . ',' . $usuario['usuario'] ?>" class="list-group-item btn btn-info"><?= utf8_decode(utf8_encode($usuario['usuario'])) ?><i class="<?= (isset($notificacion)) ? $notificacion : ''; ?>"></i></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php elseif (strpos(ucwords($_SESSION['rol_actual']),"Asesor") === false) : ?>
            <?php if (isset($resultado['grupos'])) : ?>
                <?php foreach ($resultado['grupos'] as $grupo) : ?>
                    <?php if ($_SESSION['carteraActual'] == $grupo['id_cliente']) : ?>
                        <a href="#" data-idGrupo="<?= $grupo['id_cliente'] ?>" class="grupo list-group-item btn btn-info"><?= $grupo['nombre_cliente'] ?><i class="<?= $notificacion; ?>"></i></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($resultado['agrupados'])) : ?>
                <?php foreach ($mensajes['agrupados'] as $mensaje) :
                    $emisor = explode(',', $mensaje['id_emisor']);
                    $receptor = explode(',', $mensaje['id_receptor']);
                    if ($receptor[0] == $_SESSION['id_usuario'] && $receptor[0] != '' && $emisor[0] != $_SESSION['id_usuario']) : ?>
                        <a href="#" data-idGrupo="<?= $mensaje['id_emisor'] ?>" class="list-group-item btn btn-info"><?= utf8_decode(utf8_encode($emisor[1])) ?><i class="<?= $notificacion; ?>"></i></a>
                <?php endif;
                endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
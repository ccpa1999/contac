<?php ?>

<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Tareas</li>
</ol>
<br>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1" >
                <div>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">
                                    <h3>TAREAS</h3>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="row container-fluid">
                    <div id="resultadoBusquedaUsuarios">
                        <?php foreach ($tareas as $tarea): ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <!--<img alt="100%x200" data-src="holder.js/100%x200" style="display: block;" src="../../public/images/1476391269_human.png" data-holder-rendered="true">-->
                                    <center><i class="fa fa-tasks fa-2x success"></i></center>
                                    <div class="caption" style="text-align: center;">
                                        <p>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><strong>Tarea:</strong></label>
                                            <h4><span class="label label-success"><strong><?php echo $tarea['nombre_tarea'] ?></strong></span></h4>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tipo Tarea:</strong></label>
                                            <h4><span class="label label-warning"><strong><?php echo ucwords($tarea['tipo_tarea']) ?></strong></span></h4>
                                        </div>
                                        </p>
                                        <p>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a class="btn btn-primary AccionEstadoTarea" data-toggle="modal" 
                                               data-target="#estadoTarea_<?php echo $tarea['id'];?>" data-id="<?php echo $tarea['id'] ?>" href="#" role="button">
                                                <span class="fa fa-bar-chart-o"></span> Estado</a>
                                            <!--<a class="btn btn-primary obtenerPermisos" data-toggle="modal"
                                               data-target="#estadoTarea" data-id="<?php echo $tarea['id'] ?>" href="#" role="button">
                                                <span class="fa fa-users"></span> Usuarios</a>-->
                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="admini stracionTareas"
                                               data-target="#myModal" data-controlador="carterasController" data-accion="borrarTarea" data-id="<?php echo $tarea['id'] ?>" href="#" role="button">
                                                <span class="fa fa-remove"></span> Eliminar</a>
                                        </div>
                                        </p>
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
<?php foreach ($tareas as $tarea): ?>
    <div class="modal fade" id="estadoTarea_<?php echo $tarea['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Estado Actual Tarea</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="estadoTareaContent" class="col-md-5 col-md-offset-1">
                            <p style="text-align: center;"><strong>GESTIONADOS</strong></p>
                            <canvas id="cantidadGestionados_<?php echo $tarea['id'];?>" width="400" height="400"></canvas>
                        </div>
                        <div id="estadoTareaContent" class="col-md-5">
                            <p style="text-align: center;"><strong>GESTIONADOS POR USUARIO</strong></p>
                            <canvas id="cantidadGestionadosUsuario_<?php echo $tarea['id'];?>" width="400" height="400"></canvas>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1" style="text-align: center;">
                            <p><strong>TIEMPO PROMEDIO POR GESTIÓN</strong></p>
                            <br>
                            <div id="promedioGestionTarea_<?php echo $tarea['id'];?>" class="label label-success" style="font-size: 20px;">        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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



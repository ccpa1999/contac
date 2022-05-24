<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Campañas</li>
    <li class="active">Administración Campaña</li>
</ol>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1" >
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#homologados" aria-controls="home" role="tab" data-toggle="tab">HOMOLOGADOS GESTIÓN</a></li>
                                <li role="presentation"><a href="#horarios" aria-controls="profile" role="tab" data-toggle="tab">HORARIOS</a></li>
                                <li role="presentation"><a href="#guiones" aria-controls="messages" role="tab" data-toggle="tab">GUIONES DE GESTIÓN</a></li>
                                <li role="presentation"><a href="#informacion" aria-controls="messages" role="tab" data-toggle="tab">LABEL INFORMACIÓN</a></li>
                              
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="homologados">
                                    <div class="row">
                                            <div class="col-md-5">
                                                    <div class="row">
                                                        <form id="formHomologadoAccion" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera">
                                                             <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                         <i class="fa fa-volume-control-phone success"></i>
                                                                    </div>
                                                                    <select class="form-control" name="id_accion">
                                                                        <option value="">..seleccione..</option>
                                                                        <?php foreach($datos['accion'] as $accion):?>
                                                                            <option value="<?php echo $accion['id'];?>"><?php echo utf8_encode($accion['accion']);?></option>
                                                                        <?php endforeach;?> 
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                       <div class="input-group-addon">
                                                                             <i class="fa fa-pencil success"></i>
                                                                        </div>
                                                                    <input type="text" required name="homologado" placeholder="Ingrese el Homologado" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                              <input type="hidden" name="metodo" value="creacionRegistro">
                                                            <input type="hidden" id="accion" name="accion" value="crearHomologado">
                                                            <input type="hidden" name="tipo" value="accion">
                                                            <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                        </form>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" style="text-align: center;">
                                                                <thead>
                                                                    <tr class="active">
                                                                        <th><span class="fa fa-volume-control-phone success"></span> ÁCCIÓN</th>
                                                                        <th>ACCIONES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($datos['homologado_accion'] as $homologado):?>
                                                                    <tr>
                                                                        <td><?php echo strtoupper($homologado['homologado'])?></td>
                                                                        <td><div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" 
                                                                               data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="administracionCartera"
                                                                               data-target="#myModal" data-controlador="administracionController" data-accion="borrarUsuario" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                        </div></td>
                                                                    </tr>
                                                                <?php endforeach;?>    
                                                                </tbody>
                                                            </table>  
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-5 col-md-offset-1">
                                                    <div class="row">
                                                        <form id="formHomologadoContacto" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera">
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                         <i class="fa fa-user-circle success"></i>
                                                                    </div>
                                                                    <select class="form-control" name="id_contacto">
                                                                        <option value="">..seleccione..</option>
                                                                        <?php foreach($datos['contacto'] as $contacto):?>
                                                                            <option value="<?php echo $contacto['id'];?>"><?php echo utf8_encode($contacto['contacto']);?></option>
                                                                        <?php endforeach;?> 
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                         <i class="fa fa-pencil success"></i>
                                                                    </div>
                                                                    <input type="text" required name="homologado" placeholder="Ingrese el Homologado" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                            <input type="hidden" name="metodo" value="creacionRegistro">
                                                            <input type="hidden" id="accion" name="accion" value="crearHomologado">
                                                            <input type="hidden" name="tipo" value="contacto">
                                                            <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                        </form>  
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" style="text-align: center;">
                                                                <thead>
                                                                    <tr class="active">
                                                                        <th><span class="fa fa-user-circle success"></span> CONTACTO</th>
                                                                        <th>ACCIONES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($datos['homologado_contacto'] as $homologado):?>
                                                                    <tr>
                                                                        <td><?php echo strtoupper($homologado['homologado'])?></td>
                                                                        <td><div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" 
                                                                               data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="administracionUsuarios"
                                                                               data-target="#myModal" data-controlador="administracionController" data-accion="borrarUsuario" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                        </div></td>
                                                                    </tr>
                                                                <?php endforeach;?>  
                                                                </tbody>
                                                            </table>  
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="row">
                                                        <form id="formHomologadoEfecto" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera">
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                         <i class="fa fa-user-circle success"></i>
                                                                    </div>
                                                                    <select class="form-control" name="id_efecto">
                                                                        <option value="">..seleccione..</option>
                                                                        <?php foreach($datos['efecto'] as $efecto):?>
                                                                            <option value="<?php echo $efecto['id'];?>"><?php echo utf8_encode($efecto['efecto'])?></option>
                                                                        <?php endforeach;?> 
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                         <i class="fa fa-pencil success"></i>
                                                                    </div>
                                                                    <input type="text" required name="homologado" placeholder="Ingrese el Homologado" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                            <input type="hidden" name="metodo" value="creacionRegistro">
                                                            <input type="hidden" id="accion" name="accion" value="crearHomologado">
                                                            <input type="hidden" name="tipo" value="efecto">
                                                            <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                        </form>    
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" style="text-align: center;">
                                                                <thead>
                                                                    <tr class="active">
                                                                        <th><span class="fa fa-flash success"></span> EFECTO</th>
                                                                        <th>ACCIONES</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($datos['homologado_efecto'] as $homologado):?>
                                                                    <tr>
                                                                        <td><?php echo strtoupper($homologado['homologado'])?></td>
                                                                        <td><div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" 
                                                                               data-target="#editarRegistro" data-tipo="editarUsuario" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="administracionUsuarios"
                                                                               data-target="#myModal" data-controlador="administracionController" data-accion="borrarUsuario" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                        </div></td>
                                                                    </tr>
                                                                <?php endforeach;?>    
                                                                </tbody>
                                                            </table>  
                                                        </div>
                                                    </div>
                                                    
                                            </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">...</div>
                                <div role="tabpanel" class="tab-pane" id="messages">...</div>
                                <div role="tabpanel" class="tab-pane" id="informacion">
                                    <form id="formCargaTareas" data-id="formCargaTareas" class="formCarga" data-tipo="Tareas" enctype="multipart/form-data" action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">
                                                                <strong>Seleccione un tipo de tarea</strong>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-tasks"></i>
                                                                </div>
                                                                <select class="form-control" name="tipo_tarea">
                                                                    <option value="">..Seleccione..</option>
                                                                    <option value="activa">Tarea Activa</option>
                                                                    <option value="asesor">Tarea Asesor</option>
                                                                    <option value="libre">Tarea Libre</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">
                                                                <strong>Nombre de la Tarea</strong>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                                <input type="text" class="form-control" name="nombre_tarea" placeholder="Nombre de la tarea">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-top: 2%;">
                                                    <label class="control-label">Subir Archivo desde una carpeta</label>
                                                    <input type="file" name="archivo" readyonly class="file-loading inputCarga" required>
                                                    <input type="hidden" name="metodo" value="cargarArchivo">
                                                    <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                    <input type="hidden" name="tipo" value="cargarTarea">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>
<!-- MODALS-->

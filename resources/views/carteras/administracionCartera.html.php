<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Campañas</li>
    <li class="active">Administración Campaña</li>
</ol>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#homologados" aria-controls="home" role="tab" data-toggle="tab">HOMOLOGADOS GESTIÓN</a></li>
                                <li role="presentation"><a href="#horarios" aria-controls="profile" role="tab" data-toggle="tab">HORARIOS</a></li>
                                <li role="presentation"><a href="#guiones" aria-controls="messages" role="tab" data-toggle="tab">GUIONES DE GESTIÓN</a></li>
                                <li role="presentation"><a href="#informacion" aria-controls="messages" role="tab" data-toggle="tab">LABEL INFORMACIÓN</a></li>
                                <li role="presentation"><a href="#obligatorio" aria-controls="messages" role="tab" data-toggle="tab">OBLIGATORIEDAD</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="homologados">
                                    <div class="row">
                                        <div class="col-md-5" style="margin:2em;max-height: 31em; overflow:auto;">
                                            <div class="row">
                                                <form id="formHomologadoAccion" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera" data-formulario="formHomologadoAccion">
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-volume-control-phone success"></i>
                                                            </div>
                                                            <select class="form-control" required name="id_accion">
                                                                <option value="">..seleccione..</option>
                                                                <?php foreach ($datos['accion'] as $accion) : ?>
                                                                    <option value="<?php echo $accion['id']; ?>"><?php echo utf8_encode($accion['accion']); ?></option>
                                                                <?php endforeach; ?>
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
                                                                <th><span class="fa fa-volume-control-phone success"></span> ACCIÓN</th>
                                                                <th>ACCIONES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos['homologado_accion'] as $homologado) : ?>
                                                                <tr>
                                                                    <td><?php echo strtoupper($homologado['homologado']) ?></td>
                                                                    <td>
                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-accion="EditarRegistro" data-tipo="EditarAccion" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-target="#myModal" data-metodo="eliminarRegistro" data-accion="borrarAccion" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5" style="margin:2em;max-height: 31em; overflow:auto;">
                                            <div class="row">
                                                <form id="formHomologadoContacto" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera" data-formulario="formHomologadoContacto">
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-user-circle success"></i>
                                                            </div>
                                                            <select class="form-control" required name="id_contacto">
                                                                <option value="">..seleccione..</option>
                                                                <?php foreach ($datos['contacto'] as $contacto) : ?>
                                                                    <option value="<?php echo $contacto['id']; ?>"><?php echo utf8_encode($contacto['contacto']); ?></option>
                                                                <?php endforeach; ?>
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
                                                            <?php foreach ($datos['homologado_contacto'] as $homologado) : ?>
                                                                <tr>
                                                                    <td><?php echo strtoupper($homologado['homologado']) ?></td>
                                                                    <td>
                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-accion="EditarRegistro" data-tipo="EditarContacto" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="eliminarRegistro" data-target="#myModal" data-controlador="administracionController" data-accion="borrarContacto" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
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
                                    <div class="row">
                                        <div class="col-md-5" style="margin:2em;max-height: 31em; overflow:auto;">
                                            <div class="row">
                                                <form id="formHomologadoEfecto" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera" data-formulario="formHomologadoEfecto">
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-user-circle success"></i>
                                                            </div>
                                                            <select class="form-control" required name="id_efecto">
                                                                <option value="">..seleccione..</option>
                                                                <?php foreach ($datos['efecto'] as $efecto) : ?>
                                                                    <option value="<?php echo $efecto['id']; ?>"><?php echo utf8_encode($efecto['efecto']) ?></option>
                                                                <?php endforeach; ?>
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
                                                    <table id="acciones" class="table table-bordered" style="text-align:center;">
                                                        <thead>
                                                            <tr class="active">
                                                                <th><span class="fa fa-flash success"></span> EFECTO</th>
                                                                <th>ACCIONES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos['homologado_efecto'] as $homologado) : ?>
                                                                <tr>
                                                                    <td><?php echo strtoupper($homologado['homologado']) ?></td>
                                                                    <td>
                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-tipo="EditarEfecto" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="eliminarRegistro" data-target="#myModal" data-controlador="administracionController" data-accion="borrarEfecto" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-5" style="margin:2em;max-height: 31em; overflow:auto;">
                                            <div class="row">
                                                <form id="formMotivoNoPago" class="formHomologado" action="javascript:void(0);" data-controlador="carterasController.php" data-metodo="administracionCartera" data-formulario="formMotivoNoPago">
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-pencil success"></i>
                                                            </div>
                                                            <input type="text" required name="motivo" placeholder="Motivo de no pago" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                    <input type="hidden" name="metodo" value="creacionRegistro">
                                                    <input type="hidden" id="accion" name="accion" value="crearHomologado">
                                                    <input type="hidden" name="tipo" value="motivo">
                                                    <input type="hidden" name="cartera" value="<?php echo $cartera; ?>">
                                                </form>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" style="text-align: center;">
                                                        <thead>
                                                            <tr class="active">
                                                                <th><span class="fa fa-money success"></span> MOTIVO NO PAGO</th>
                                                                <th>ACCIONES</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($datos['motivos_no_pago'] as $homologado) : ?>
                                                                <tr>
                                                                    <td><?php echo strtoupper($homologado['motivo']) ?></td>
                                                                    <td>
                                                                        <div class="btn-group" role="group" aria-label="...">
                                                                            <a class="btn btn-primary formularioEditarRegistro" data-toggle="modal" data-target="#editarRegistro" data-tipo="EditarMotivo" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-edit"></span> </a>
                                                                            <a class="btn btn-primary eliminarRegistro" data-toggle="modal" data-metodo="eliminarRegistro" data-target="#myModal" data-controlador="administracionController" data-accion="borrarMotivo" data-id="<?php echo $homologado['id'] ?>" href="#" role="button">
                                                                                <span class="glyphicon glyphicon-remove"></span></a>
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
                                <div role="tabpanel" class="tab-pane" id="profile">...</div>
                                <div role="tabpanel" class="tab-pane" id="guiones">
                                    <form id="formCargaGuion" data-id="formCargaGuion" class="formCarga" data-tipo="Guiones" enctype="multipart/form-data" action="javascript:void(0);">
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">
                                                        <strong>Seleccione el efecto</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-tasks"></i>
                                                        </div>
                                                        <select class="form-control" required id="tipo_efecto" name="tipo_efecto" required>
                                                            <option value="">..Seleccione..</option>
                                                            <?php foreach ($datos['homologado_efecto'] as $homologado) : ?>
                                                                <option value="<?php echo $homologado['id']; ?>"><?php echo $homologado['homologado']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">
                                                        <strong>Guión</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <textarea name="txtGuion" id="txtGuion" class="form-control" placeholder="..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 col-md-offset-2">
                                                <button class="btn btn-success" type="submit">Guardar Guíon</button>
                                            </div>
                                        </div>
                                        <input type="hidden" value="guardarGuion" name="metodo">
                                        <input type="hidden" value="<?php echo $cartera; ?>" name="cartera">
                                    </form>
                                </div>
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
                                <div role="tabpanel" class="tab-pane" id="obligatorio">
                                    <div class="row container-fluid">
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <center><i class="fa fa-phone fa-2x success"></i></center>
                                                <div class="caption" style="text-align: center;">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            <strong>Acción</strong>
                                                        </label>
                                                        <select id="tipo_accion" name="tipo_accion" required="">
                                                            <option value="">..Seleccione..</option>
                                                            <?php foreach ($datos['homologado_accion'] as $contacto) : ?>
                                                                <option value="<?php echo $contacto['id']; ?>"><?php echo $contacto['homologado']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <center><i class="fa fa-users fa-2x success"></i></center>
                                                <div class="caption" style="text-align: center;">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            <strong>Contacto</strong>
                                                        </label>
                                                        <select id="tipo_contacto" name="tipo_contacto" required="">
                                                            <option value="">..Seleccione..</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <center><i class="fa fa-info fa-2x success"></i></center>
                                                <div class="caption" style="text-align: center;">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            <strong>Efecto</strong>
                                                        </label>
                                                        <select id="tipoefecto" name="tipo_efecto" required="">
                                                            <option value="">..Seleccione..</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12" id='inputGestion'>

                                        </div>
                                    </div>
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
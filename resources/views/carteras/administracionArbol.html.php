<ol class="breadcrumb">
    <li><a href="#">FIANZA LTDA</a></li>
    <li>Administración</li>
    <li class="active">Arbol</li>
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
                                    <h3>ARBOL</h3>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="row container-fluid">
                <div id="resultadoBusquedaUsuarios">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <center><i class="fa fa-phone fa-2x success"></i></center>
                                <div class="caption" style="text-align: center;">
                                    <div class="form-group">
                                        <label><strong>Accion:</strong></label>
                                        <select class="parametroArbol" name="accion" data-tipo="accion">
                                            <option value="">..Seleccione..</option>
                                            <?php foreach ($arbol['acciones'] as $acciones): ?>
                                                <option value="<?php echo $acciones['id'] ?>"><?php echo $acciones['homologado'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <center><i class="fa fa-group fa-2x success"></i></center>
                                <div class="caption" style="text-align: center;">
                                    <div class="form-group">
                                        <label><strong>Contacto:</strong></label>
                                        <select class="parametroArbol" name="accion" data-tipo="contacto">
                                            <option value="">..Seleccione..</option>
                                            <?php foreach ($arbol['contactos'] as $contacto): ?>
                                                <option value="<?php echo $contacto['id'] ?>"><?php echo $contacto['homologado'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <center><i class="fa fa-money fa-2x success"></i></center>
                                <div class="caption" style="text-align: center;">
                                    <div class="form-group">
                                        <label><strong>Motivo de no pago:</strong></label>
                                        <select class="parametroArbol" name="accion" data-tipo="motivo">
                                            <option value="">..Seleccione..</option>
                                            <?php foreach ($arbol['contactos'] as $contacto):?>
                                                <option value="<?php echo $contacto['id'] ?>"><?php echo $contacto['homologado'] ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12" id="resultadoParametroArbol">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

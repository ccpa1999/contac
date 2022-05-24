<?php ?>

<ol class="breadcrumb">
    <li><a href="lavacascos.php">Lavacascos</a></li>
    <li>Administración</li>
    <li class="active">Puntos de Servicio</li>
</ol>
<div class="row">
    <div class="col-md-8 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row" style="padding-bottom: 30px;">
                    <div class="col-md-3 col-sm-2">
                        <h3>INFORMES</h3>
                    </div>
                    <form id="formGenerarInformes" action="javascrit:void(0)">
                        <div class="col-md-3 col-sm-6">
                            <!--<div class="row" style="padding-bottom: 30px;">-->
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input class="form-control fecha" type="text" id ="fecha_inicial_informe" name="fecha_inicial_informe"
                                       placeholder="Fecha inicial">
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <!--<div class="row" style="padding-bottom: 30px;">-->
                            <div class="input-group in-grp1">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input class="form-control fecha" type="text" 
                                       placeholder="Fecha final" id ="fecha_final_informe" name="fecha_final_informe">
                                <!--</div>-->
                            </div>
                        </div>
                </div>
                <div class="row" style="padding-bottom: 30px;">
                    <div class="col-md-6 col-sm-8 col-md-offset-3">
                        <label class="col-sm-6 control-label" for="focusedinput"><strong>Informe</strong></label>
                        <select class="form-control" id="disparadorInforme" name="perfil" required>
                            <option value="">..seleccione..</option>
                            <option value="ventas">Ventas</option>
                            <option value="insumos">Insumos</option>
                            <option value="ingreso">Control Ingreso</option>
                        </select>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 switch">
        <div class="switch-right-grid">
            <div class="switch-right-grid1" >
                <h3>INFORME</h3>
                <hr />
                <div class="row">
                    <div class="row" id="resultadoInformes">
<!--                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre Punto</th>
                                        <th>Ciudad</th>
                                        <th>Administrador</th>
                                        <th>Cantidad Lavadores</th>
                                        <th>Consecitivo Factura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($puntos_servicio as $punto_servicio): ?>
                                        <tr>
                                            <td><h3><span class="label label-success"><strong><?php echo mb_strtoupper(utf8_encode($punto_servicio['nombre_punto']), 'UTF-8'); ?></strong></span></h3></td>
                                            <td><h3><?php echo utf8_encode($punto_servicio['ciudad_punto']) ?></h3></td>
                                            <td><h3><?php echo $punto_servicio['administrador_nombre'] ?></h3></td>
                                            <td><h3><?php echo $punto_servicio['cantidad_lavadores'] ?></h3></td>
                                            <td><h3><?php echo $punto_servicio['consecutivo_factura'] ?></h3></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODALS-->

<div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Punto de Servicio</h4>
            </div>
            <div class="modal-body" >
                <form id="formularioCreacionPuntoServicio" action="javascript:void(0);">
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="focusedinput"><strong>Nombre del Punto</strong></label>
                        <input id="focusedinput" value="" required="true" class="form-control"
                               name="nombre" type="text" placeholder="El nombre del punto de servicio!">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="focusedinput"><strong>Ciudad</strong></label>
                        <select class="form-control" name="ciudad">
                            <option value="">..seleccione..</option>
                            <?php foreach ($ciudades as $ciudad): ?>
                                <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo utf8_encode($ciudad['nombre']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="focusedinput"><strong>Administrador</strong></label>
                        <select class="form-control" name="administrador">
                            <option value="">..seleccione..</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario['id']; ?>"><?php echo utf8_encode($usuario['nombre_completo']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <hr />
                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="focusedinput"><strong>Cantidad de Lavadores</strong></label>
                        <input id="focusedinput" value="" required="true" class="form-control"
                               name="cantidad_lavadores" type="text" placeholder="Ingrese el número de lavadores!">
                    </div>
                    <hr />
                    <div class="row">
                        <label class="col-sm-6 control-label" for="focusedinput"><strong>Consecutivo Facturación</strong></label>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">

                                <label class="col-sm-6 control-label" for="focusedinput"><strong> Prefijo Alfabetico</strong></label>
                                <input id="focusedinput" value="" required="true" class="form-control"
                                       name="prefijo_alfabetico" type="text" placeholder="EJ: ARG">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">

                                <label class="col-sm-6 control-label" for="focusedinput"><strong>Numero Inicial</strong></label>
                                <input id="focusedinput" value="" required="true" class="form-control"
                                       name="numero_inicial" type="text" placeholder="EJ: 0">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">

                                <label class="col-sm-6 control-label" for="focusedinput"><strong>Numero Final</strong></label>
                                <input id="focusedinput" value="" required="true" class="form-control"
                                       name="numero_final" type="text" placeholder="EJ: 999">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="metodo" value="crearNuevoPuntoServicio">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="crearNuevoUsuarioAccion">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




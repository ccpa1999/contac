<ol class="breadcrumb">
    <li>
        <a href="#">FIANZA LTDA</a>
    </li>
    <li>
        <a href="#" id="volver" >Capacitaciónes</a>
    </li>
    <li class="active">
        Usuarios       
    </li>
</ol>
<hr>
<div class="row">
    <div class="col-md-4 col-xs-8 col-sm-6 col-lg-4">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div class="row" style="padding:15px;">
                    <div class="row">
                        <?php foreach ($capacitacion["TipoCapacitacion"] as $item): ?>
                            <?php $TipoCapacitacionId = $item['id'] ?>
                            <div class="row">
                                <div class="col-sm-12" style="margin-top: -10px !important;">
                                    <h2 class="text-center" style="margin-top: -10px !important;"><?=$item['nombre']; ?></h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12text-center">
                                    <img src="../../public/images/<?=$item['imagen_capacitacion'] ?>" alt="" class="img-responsive center-block">
                                </div>
                            </div>    
                            <br>
                            <p style="text-align: justify;padding-left: 2%; padding-right: 2%;">
                                <?=($item['descripcion']) ?>
                            </p>
                            <br>
                            <?php if ($_SESSION['rol_actual'] == '7' || $_SESSION['rol_actual'] == '1'): ?>
                                 
                                    <div class="row">
                                        <div class="col-md-5 "> 
                                             <a id="btnAgregarCapacitacion" class="btn btn-primary " data-toggle="modal" data-tipo="asignarCapacitaciones" data-id="<?=$item['id']; ?>" role="button">
                                            <span class="glyphicon glyphicon-edit"></span> Asignar pruebas</a>
                                        </div>
                                        <div class="col-md-5 col-md-offset-1">
                                             <a id="btnHabilitarUsuarios" class="btn btn-primary" data-toggle="modal" data-tipo="habilitarUsuario" data-id="<?=$item['id']; ?>" role="button">
                                            <span class="glyphicon glyphicon-education"></span>  Habilitar usuarios</a>
                                        </div>
                                    </div>
                                <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                             <a id="btnBloquearExamen" class="btn btn-danger" data-toggle="modal" data-tipo="bloquearExamen" data-id="<?=$item['id']; ?>" role="button">
                                            <span class="glyphicon glyphicon-ban-circle"></span>  Bloquear examen</a>
                                        </div>
                                    </div>
                                    
                            <?php endif ?>                           
                        <?php endforeach; ?>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['rol_actual'] == '1' || $_SESSION['rol_actual'] == '7'): ?>
    <?php else: ?>
        <!-- esto es lo que me muestra los modulos para capacitarse y donde se le pone chulito -->

    <div id="IdFormulario" class="col-md-8 col-xs-12 col-sm-10 col-lg-8" style=" margin-bottom:2%">
        <div class="switch-right-grid">
            <div class="switch-right-grid1">
                <div id="divHistoricoGestion" style="padding-bottom: 10px;">
                    <form id="formGuardarCapacitacion" action="javascript:void(0);">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr class="success" >
                                    <th style="text-align: center">Listo</th>
                                    <th style="text-align: center">Presentación</th> 
                                    <th style="text-align: center">Descarga</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($capacitacion["Capacitaciones"] as $item): ?>
                                    <tr class="">
                                        <td> <i class="<?=$item['class'] ?>" style="font-size:30px;color:green"</i><input class="" type="checkbox" name="completado<?=$item['id']; ?>" value="<?=$item['id']; ?>" style=" <?= ($item['class'] != "") ? "display: none" : "" ; ?>" ></td>
                                        <td> <?=$item["nombre"]; ?></td>  
                                        <?php
                                        $clase = "fa fa-file-o";
                                        switch ($item["tipo"]):
                                            case "PDF":$clase = "fa fa-file-pdf-o";
                                                break;
                                            case "PPT": $clase = "fa fa-file-powerpoint-o";
                                                break;
                                            case "CSV": $clase = "fa fa-file-excel-o";
                                                break;
                                            case "DOCX": $clase = "fa fa-file-word-o";
                                                break;
                                            case "YOUTUBE": $clase = "fa fa-youtube-square";
                                                break;
                                            case "MP4": $clase = "fa fa-file-video-o";
                                                break;
                                            case "MP3": $clase = "fa fa-file-audio-o";
                                                break;
                                                ?>  
                                        <?php endswitch; ?>
                                        <td><a title="Descargar Presentacion" href="../../public/archivos/descargas/<?=$item["ruta"]; ?>" target="_blank"><i class="<?=$clase; ?>" style="font-size:36px"></i></a></td> 
                                    </tr>                                   
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <input id="usuarioCapacitacion" name="usuario" type="hidden">
                        <input id="usuarioClave" name="clave" type="hidden">
                        <input name="metodo" value="insertarHistorico" type="hidden">
                        <input id="IdTipoCapacitacion" name="tipo_capacitacion" value="<?=$TipoCapacitacionId; ?>" type="hidden">
                        <input type="hidden" name="parametro" value="modalExito" type="text">
                        <center>
                            <button type="submit" class="btn btn-primary btn-lg" id="btnGuardarPresentacion" title="GUARDAR">
                                <i class="fa fa-floppy-o" ></i>
                                Guardar 
                            </button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- esto es lo que me muestra los modulos para capacitarse y donde se le pone chulito FIN -->
    <?php endif ?>


</div>


<!-- MODAL ASIGNAR-->
    <div class="modal fade bs-example-modal-lg" id="asignarCapacitacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Asignar Capacitación</h4>
                </div>
                <div class="modal-body" >
                    <div id="content_data">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- MODAL FIN -->
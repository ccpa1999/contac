<?php if ($parametro == 'formularioUsuarioCapacitacion'): ?>
    <input class="form-control" id="usuarioFormulario" placeholder="USUARIO" />
    <input type="hidden" id="boleano" value="">
    <strong id="Noexiste" hidden="true" style="color: red">Este usuario no esta registrado</strong>
    <script type="text/javascript">
        $("#usuarioFormulario").focus(function () {
            $("#Noexiste").html("");
            $("#Noexiste").attr("hidden");
        });
    </script>
<?php elseif ($parametro == 'formularioUsuarioClave'): ?>
    <input type="password"  class="form-control" id="claveFormulario" placeholder="CONTRASEÑA"/>
    <strong id="NoexisteCla" hidden="true" style="color: red">Contraseña errónea</strong>
    <script type="text/javascript">
        $("#claveFormulario").focus(function () {
            $("#NoexisteCla").html("");
            $("#NoexisteCla").attr("hidden");
        });
    </script>
<?php elseif ($parametro == 'parametrosInformeCapacitacion'): ?>
    <form id="formularioRangoFechas" action="javascript:void(0);">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p style="text-align: center;">Por favor ingrese un rango de fechas</p>
            </div>
        </div>
        <hr />
        <div class="row" style="text-align: center;">
            <div class="form-group col-xs-5 col-xs-offset-1">
                <label for="exampleInputEmail1"><strong>Fecha Inicial</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar-plus-o"></i>
                    </div>
                    <input id="IdfechaInicial" type="text" required name="fecha_inicial" placeholder="Ingrese una fecha inicial" class="form-control fecha">
                </div>
            </div>
            <div class="form-group col-xs-5">
                <label for="exampleInputEmail1"><strong>Fecha Final</strong></label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar-plus-o"></i>
                    </div>
                    <input id="IdfechaFinal" type="text" required name="fecha_final" placeholder="Ingrese una fecha final" class="form-control fecha">
                </div>
            </div>
        </div>
        <input type="hidden" name="metodo" value="">
    </form> 
    <?php
elseif ($parametro == 'descargarConsolidado'):
    if (isset($tipo)) {
        if ($tipo == "pdf") {
            $icono = "fa fa-file-pdf-o fa-4x";
        } else {
            $icono = "fa fa-file-excel-o fa-4x";
        }
    } else {
        $icono = "fa fa-file-excel-o fa-4x";
    }
    
    ?>
    <br>
    <center>
        <p><strong>El informe fue generado correctamente</strong></p>
        <p>Descarguelo haciendo click en el botón</p>
        <br>
        <p>
            <a href="../../public/archivos/descargas/<?=$ruta; ?>" class="btn btn-success" target="_blank">
                <i class="<?=$icono; ?>"></i>
            </a>
        </p>
    </center>

<?php elseif ($parametro == 'cambioCapacitacion'): ?>
         <h5 style="text-align: center; display: none;" id="titleCap">Tipo de capacitación <h5/>
       <select class="form-control " id="selectCapacitacion1" data-live-search="true" multiple="" title="Seleccione una capacitación...">
            <?php foreach ($capacitacion as $item): ?> 
                <option name="tipoCheck" style="overflow: auto !important;" value="<?=$item['id']; ?>"><?=$item['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

<?php elseif ($parametro == 'busquedaPrueba'): ?>

    <div style="overflow: auto;">
        <?php if ($_SESSION['rol_actual'] != '7' && $_SESSION['rol_actual'] != '1'): ?>
            <input class="form-control" id="usuarioBusquedaPrueba" placeholder="Usuario" required="" disabled="TRUE" value="<?=$_SESSION['usuario'] ?>" /> 
        <?php else: ?>
            <input class="form-control" id="usuarioBusquedaPrueba" placeholder="Usuario" required=""/> 
        <?php endif; ?>
        <br/>
        <h5 style="text-align: center;"> Capacitaciones <h5/>
        <center><select class="form-control" style="color: #444444" id="selectTipoCapacitacion">
            <option value="seleccione" disabled selected="" >Seleccione...</option>    
            <?php foreach ($capacitacion['TipoCapacitaciones'] as $item): ?> 
                <option name="tipoCheck" value="<?=$item['id']; ?>"><?=$item['nombre']; ?></option>
            <?php endforeach; ?>
        </select></center>
        <br>
        <center id="contentCapa">
        </center>
        <br>
        <br>
        <br>
        <br>
        <strong id="PNoexiste" hidden="true" style="color: red">Este usuario no esta registrado</strong>
    </div>
        <script type="text/javascript">
            $("#usuarioBusquedaPrueba").focus(function () {
                $("#PNoexiste").html("");
                $("#PNoexiste").attr("hidden");
            });
            $('#selectTipoCapacitacion').change(function(){
                $.ajax({
                    url: "../../app/controllers/capacitacionController.php",
                    type: 'POST',
                    data: {metodo: 'obtenerCapacitaciones',
                        id: $("#selectTipoCapacitacion").val()
                    },
                    success: function (resultado) {
                        $("#contentCapa").html(resultado);
                        $("#titleCap").css("display","inline");
                        $('#selectCapacitacion1').selectpicker({

                        });
                    }
                });
            });
        </script>



<?php elseif ($parametro == 'tablaPreguntas'):

    $contador = 0;
    if ($capacitacion[0]["cantidadPreguntas"] > 0) { ?>
        <?php $valor = (count($capacitacion[0]["preguntas"]) > 9) ? "true" : 'false'; ?>              
        <form id="formPreguntas" action="javascript:void(0);">
            <div class="row" style="margin-bottom: 2%;padding-top: 0%"> 
            <div class="col-md-6">
                <h5 style="padding-bottom: 5px;text-align: center">Porcentaje de aprobacion:</h5>
                <input type="range" id="rangoAprobacion" name="rangoAprobacion" value="<?=$capacitacion[0]["prueba"][0]["aprobacion"] ?>" max="100">         
            </div>
            <div class="col-md-1" style="padding-top: 2.2%;" >
                <input  type="button" class="btn btn-default" id="porcentajeA" name="porcentajeA" style="#porcentajeA:hover { background: rgba(0,0,0,0); color: #3a7999;}" value="<?=$capacitacion[0]["prueba"][0]["aprobacion"] ?>%"></input>
            </div>
            <div class="col-md-2">
                <h5 style="text-align: center">Tiempo de la prueba</h5> 
                <div class="input-group clockpicker">
                    <input id="tiempoPrueba" name="tiempoPrueba" type="text" class="form-control" value="<?=$capacitacion[0]["prueba"][0]["tiempo"]; ?>" placeholder="hh:mm:ss">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>               
            </div>
            <div class="col-md-3">
                <h5 style="text-align: center" data-toggle="tooltip" data-placement="left" title="Se muestra el numero de preguntas aleatorias en el examen">Cantidad de preguntas:</h5>
                <input id="cantidadCheck" name="cantidadCheck" class="form-control" type="number" value="<?=$capacitacion[0]["prueba"][0]["cantidad_preguntas"] ?>" style="margin-bottom:4%"> 
            </div>
        </div>
        <input id="inputCargue" type="hidden" value="<?=$valor; ?>" /> 
            <table class="table table-bordered" style="text-align: center">
                <thead>
                    <tr>
                        <th style="text-align:center;">PREGUNTA</th>
                        <th style="text-align:center;">RESPUESTA CORRECTA</th>
                        <!-- <th style="text-align:center;">ACCION</th> -->
                        <th style="text-align:center;">SELECCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $arrayRC = array();
                        $i = 0;
                        $cantidad = 0;
                        foreach ($capacitacion[0]["preguntas"] as $itemP): ?>
                    <tr> 
                        <td><?=utf8_encode(utf8_decode($itemP["pregunta"])); ?></td>
                        <td style="text-align:center;"> 
                            <select name="select<?=$itemP["id"]; ?>" class="form-control">  
                                <?php foreach ($capacitacion[0]["respuestas"][$contador++] as $itemR):                                    
                                        if ($itemR["respuesta_correcta"] == "1") {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>
                                    <option value="<?=$itemR["id"];?>" <?=$selected; ?> ><?=utf8_encode(utf8_decode($itemR["respuesta"])); ?> </option>
                                <?php endforeach; ?>  
                            </select>
                        </td>                        
                        <!-- <td><button type="button" class="btn btn-warning btn-sm">Editar</button></td> -->
                        <td>
                            <input class="Check" type="checkbox" value="<?=$itemP["id"]; ?>"  name="pregunta<?=$itemP["id"]; ?>" 
                            <?php $cantidad++;
                                if ($itemP["estado"] == 1): ?>       
                                    checked=""
                            <?php endif; ?>/>
                        </td> 
                    </tr>
                    <?php endforeach; ?>						
                </tbody>
            </table>
            <input id="cantidadPreguntas" type="hidden" value="<?=$cantidad; ?>">
            <center>
                <button type="submit" class="btn btn-primary btn-lg" title="GUARDAR">
                    <i class="fa fa-floppy-o" ></i> Guardar 
                </button>
            </center>
            <input type="hidden" name="metodo" value="guardarRespuestas">
            <input type="hidden" name="Capacitacion" value="<?=$capacitacion[0]["TipoCapacitacion"]; ?>">
            <!-- <input type="hidden" id="timePrueba" name="timePrueba" value=""> -->
            <!-- <input type="hidden" id="aprobacionR" name="aprobacionR" value=""> -->
        </form>

    <?php } else { ?>
        <h2 style="text-align: center; color: #989595;">No existen preguntas de ""</h2>
    <?php } ?>


    <?php elseif ($parametro == 'descargarFormato'): ?>
        <br>
        <center>
            <p><strong>Su PDF fue generado correctamente</strong></p>
            <p>Descarguelo haciendo click en el botón</p>
            <br>
            <p>
                <a href="<?=$ruta; ?>" class="btn btn-danger" target="_blank">
                    <i class="fa fa-file-pdf-o fa-4x"></i>
                </a>
            </p>
        </center>

    <?php elseif ($parametro == 'checksAdmin'): ?>
            <div class="row">
                <div class="col-sm-12">
                    <p>Seleccione las capacitaciones de este usuario:</p>
                </div>
            </div>             
            <?php if (empty($capacitacion["capUsuario"])): ?>
                <?php foreach ($capacitacion["capacitaciones"] as $i): ?>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="checkboxClass">
                            <?=$i["nombre"]; ?>
                            <input name="cap<?=$i["id"]; ?>" value="<?=$i["id"]; ?>" type="checkbox">
                            <span class="checkmark"></span>
                        </label> 
                    </div>
                    <div class="col-sm-6" style="display: inline;">
                        <input type="file" class="inputCarga" name="archivo<?=$i["id"]; ?>">
                    </div>
                </div> 
                <hr> 
                <?php endforeach; ?>  
            <?php else: ?>
                <?php foreach ($capacitacion["capacitaciones"] as $i): ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="checkboxClass">
                                <?=$i["nombre"]; ?>
                                <input name="cap<?=$i["id"]; ?>" value="<?=$i["id"]; ?>" type="checkbox" <?php
                                foreach ($capacitacion["capUsuario"] as $capsU) {
                                    if ($capsU["id"] == $i["id"]) {
                                        echo "checked='checked'";
                                    }
                                }
                                ?>
                                >
                                <span class="checkmark"></span>
                            </label> 
                        </div>
                        <div class="col-sm-6" style="display: inline;">
                            <input type="file" class="inputCarga" name="archivo<?=$i["id"]; ?>">
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>  
            <?php endif; ?>     
            <input type="hidden" name="idUsuario" value="<?=$capacitacion["idUser"] ?>">
    <?php elseif ($parametro == 'pruebaPreguntas'):?>
        <div class="row">
            <div class="col-sm-12">
                    
            </div>
        </div>
        <input id="CantidadPreguntas" type="hidden" value="" />
        <?php foreach ($capacitacion as $capa): ?>
            <?php $cont = 1;
            $contador = 0; ?>
            <?php foreach ($capa["preguntas"] as $itemP): ?>
                <?php if ($cont <= $capa["prueba"][0]["cantidad_preguntas"]): ?>
                    <div id="pregunta<?=$cont ?>" class="pregunta" >          
                        <h4><?= $contador + 1 . ". " . $itemP["pregunta"]; ?></h4>
                        <hr>
                        <?php foreach ($capa["respuestas"][$contador++] as $itemR): ?>
                            <div class="radio">
                              <label>
                                <input type="radio" class="Rpregunta" name="Rpregunta<?=$itemP["id"] ?>" value="<?=$itemP["id"] . "-" . $itemR["id"]; ?>">
                                <?=utf8_encode(utf8_decode($itemR["respuesta"])); ?>
                              </label>
                            </div>
                        <?php endforeach ?>
                    </div>  
                    <?php $cont++ ?>
                <?php endif ?>                                            
            <?php endforeach ?>
            <script>
                $('#CantidadPreguntas').val(Number($('#CantidadPreguntas').val()) + Number(<?=$capa["cantidadPreguntas"]; ?>));            
            </script>
        <?php endforeach ?>
        <input type="text" id="tiempoU" hidden value="">
        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="#"class="btn btn-primary btn-lg" id="siguiente">Siguiente</a>
            </div>
        </div> 

    <?php elseif ($parametro == 'tablaCapacitaciones'): ?>


        <form action="javascript:void(0);">
            <center>
                <button id="IdNCapacitacion" class="btn btn-primary">Nueva Capacitacion</button>
            </center>
            <br>
            <table class="table table-condensed table-bordered">
                <thead style="text-align: center">
                    <tr>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center">CAPACITACION</th>
                        <th style="text-align: center">TIPO</th>
                        <th style="text-align: center">ARCHIVO</th>
                        <?php if ($_SESSION['rol_actual'] == 1) {?>
                        <th style="text-align: center">ACCION</th><?php } ?>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    <?php $cont = 1;
                    foreach ($capacitacion as $i): ?>
                        <tr>
                            <td><?=$cont++; ?></td>
                            <td><?=$i["nombre"]; ?></td>
                            <td><?=$i["tipo"]; ?></td>
                            <?php $clase = "fa fa-file-o";
                            switch ($i["tipo"]):
                                case "PDF":$clase = "fa fa-file-pdf-o";
                                    break;
                                case "YOUTUBE": $clase = "fa fa-youtube-square";
                                    break;
                                case "MP4": $clase = "fa fa-file-video-o";
                                    break;
                                case "MP3": $clase = "fa fa-file-audio-o";
                                    break;
                            endswitch; ?>
                            <td><a title="Descargar Presentacion" href="../../public/archivos/descargas/<?=$i["ruta"]; ?>" target="_blank"><i class="<?=$clase; ?>" style="font-size:36px"></i></a></td>
                            <?php if ($_SESSION['rol_actual'] == 1) {?>
                                <td><button data-id="<?=$i['id']?>"" data-ruta="" class="btn btn-danger btnBorrarCap"><i class="fa fa-trash-o" ></i> </button> </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>                
                </tbody>
            </table>
        </form>
<?php endif; ?>
   
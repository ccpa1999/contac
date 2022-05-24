<ol class="breadcrumb">
    <li>
        <a href="#">FIANZA LTDA</a>
    </li>
    <li>
        <a class="active" href="#" id="Freload" >Examen</a>
    </li>
</ol>
<hr>
<?php foreach ($prueba as $key ): ?>
    <div id="contenedor_data">
        <div class="row">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 " style="margin-bottom: 3%">  
                        <div id="ContenidoPreguntas" style="display:none" class="switch-right-grid">
                            <div class="switch-right-grid1">
                                <div class="row" style="padding-bottom: 30px;">
                                    <center>
                                        <button class="btn btn-primary btn-lg"
                                                id="idComenzarPrueba" title="">
                                            <i class="fa fa-pencil-square-o" style="color:white"></i>
                                            COMENZAR PRUEBA
                                        </button> 
                                    </center>                               
                                    <div style="display:none;" id="preguntas"> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 style="padding-left: 15%;" >Tiempo de la prueba</h5>
                                                <h4 style="padding-left: 15%;" id="Cronometro"></h4>
                                                <input id="TimerJ" type="hidden">
                                            </div>
                                            <div class="col-md-8">
                                                <h3 style="padding-left: 10%;">EXAMEN DE <?=(strtoupper(($key['TipoCapacitacion'][0]["nombre"]))); ?> </h3> 
                                            </div>
                                        </div>
                                        <hr>           
                                        <div style="padding: 4% 4% 0 ;"id="preguntasOpciones">
                                            
                                        </div>   
                                        <center>
                                            <button class="btn btn-primary btn-lg"
                                                    id="idGuardarPrueba" style="display: none;" title="">
                                                <i class="fa fa-floppy-o" style="color:white"></i>
                                                        ¡Guardar examen!
                                            </button> 
                                        </center>  
                                    </div>                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
        </div>
    </div>
    <div id="vard"></div>
    <input id="tiempoPrueba" class="tiempoPrueba" type="hidden" value="<?=$key["tiempoPrueba"]; ?>" >
<?php endforeach; ?>



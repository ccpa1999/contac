<ol class="breadcrumb">
    <li>
        <a href="#">FIANZA LTDA</a>
    </li>
    <li class="active">informes
    </li>  
</ol>
<hr>
<div id="contenedor_data">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="panel panel-default">
              <div id="diagrama" class="panel-body" style="display:none;">
              </div>
            </div>
        </div>
        <form class="" id="formInformesCapacitacion" action="javascript:void(0);">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8 prueba" >
                        <div class="col-sm-6">
                            <label for="dateInicial">Fecha inicial: </label>
                            <input class="form-control" type="date" id="dateInicial" name="dateInicial">
                        </div>
                        <div class="col-sm-6">
                            <label for="dateFinal">Fecha final: </label>
                            <input class="form-control" type="date" id="dateFinal" name="dateFinal">
                        </div>
                    </div>
                    <div class="col-sm-4 prueba" style="margin-top: 6px;">
                        <!-- <p class="col-sm-12">Filtro de fecha</p> -->
                        <div class="row" style="margin-bottom: 6px;">
                            <div class="col-sm-12">
                                <label class="col-sm-2 switch1">
                                    <input type="checkbox" id="chkPrueba" checked>
                                    <span class="slider round"></span>
                                </label>
                                <p class="col-sm-10">Prueba Realizada</p>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-sm-2 switch1">
                                  <input type="checkbox" id="chkAsignar" checked>
                                  <span class="slider round"></span>
                                </label>
                                <p class="col-sm-10">Asignación Capacitación</p>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row" id="rowInformes">
                    <div class="col-sm-12">
                        <label for="selectInforme">Seleccione una opcion de informe: </label>
                        <select class="form-control" id="selectInforme">
                            <option value='' selected="" disabled="">...</option>
                            <?php if($_SESSION['rol_actual'] == 1): ?>
                                <option value='1'>Capacitador</option>
                                <option value='2'>Capacitaciones</option>
                            <?php endif  ?>                            
                            <option value='3'>Usuarios</option>
                        </select>
                    </div>
                </div>
                <br>
                <div id="rowUsuarios" style="display: none;"  class="row data">

                </div> 
                <div id="rowComprobacionUSU" style="display: none;"  class="row data">

                </div>
                <br>
                <div class="row" style="display: block;">
                    <div class="col-sm-12 text-center">
                        <input id="ver" type="submit" class="btn btn-info btn-lg" value="Ver informe">
                    </div>
                </div>
                <br>
                <div class="row" id="btnDescargarRow" style="display: block;">
                    <div class="col-sm-12 text-center">
                        <input id="btnDescargar" type="submit" class="btn btn-success btn-lg" value="Descargar">
                    </div>
                </div>
              </div>
            </div>
            <input type="text" id="usuario" hidden value="<?=$_SESSION['rol_actual'] ?>">
        </form>
    </div>
</div>
<script>
    $('#dateInicial').on('change',validarFecha);
    $('#dateFinal').on('change',validarFecha);

    function validarFecha(){
        var today = new Date();
        var evento = new Date($(this).val());
        if(evento > today){
            mensaje('dark', 'Ups!', 'red', '¡No se puede usar una fecha mayor a la fecha actual!');
            var year = today.getFullYear();
            var month = (today.getMonth() + 1);
            var day = today.getDate();
            if(day<10){
                day='0'+day; //agrega cero si el menor de 10
            }
            if(month<10){
                month='0'+month;
            }
            $(this).val(year + "-"+month +"-"+ day);            
        }
        var dateInicial = new Date($('#dateInicial').val());
        var dateFinal = new Date($('#dateFinal').val());
        var tiempo = dateFinal.getTime() - dateInicial.getTime();
        var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
        if (dias > 31 || dias < 0) {
            mensaje('dark', 'Ups!', 'red', '¡No se puede usar una rango de fechas mayor a 31 días!');
            $(this).val('');
            $(this).focus();
        }
    }
</script>
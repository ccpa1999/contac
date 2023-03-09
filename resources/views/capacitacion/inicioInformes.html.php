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

        <div class="col-md-6 col-xs-12 col-sm-8 col-lg-6" style="">
            <div class="switch-right-grid" style="padding: 2%;padding-top: 0%;">
                <div class="switch-right-grid1">
                    <h4 style="text-align: center;">Resultados generales</h4>
                    <canvas id="pie-chart" width="100%"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 col-sm-8 col-lg-6" style="">
            <div class="switch-right-grid" style="padding: 1%">
                <div class="switch-right-grid1">
                    <table class="table table-bordered" style="text-align: center">
                        <thead>
                            <tr class="success" >
                                <th style="text-align: center">INFORME </th>
                                <th style="text-align: center">TIPO</th> 
                                <th style="text-align: center">DESCARGA</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center">
                                <td>PRESENTACIONES COMPLETADAS</td>
                                <td>CONSOLIDADO</td> 
                                <td>
                                    <i id="btnBusquedaPorFecha" title="DESCARGAR INFORME"
                                       class="fa fa-file-excel-o" style="font-size:36px;color: #337AB7;"></i>                                    
                                </td>
                            </tr>
                            <tr style="text-align: center">
                                <td>PRUEBAS REALIZADAS</td>
                                <td>POR USUARIO</td>
                                <td>
                                    <i id="btnPruebasRealizadas" title="DESCARGAR INFORME" class="fa fa-file-excel-o" style="font-size:36px;color: #337AB7;"></i>
                                </td>
                            </tr>
                            <tr style="text-align: center">
                                <td>RESULTADOS DE PRUEBAS</td>
                                <td>CONSOLIDADO</td>
                                <td>
                                    <i id="btnResultadosPruebasG" title="DESCARGAR INFORME" class="fa fa-file-excel-o" style="font-size:36px;color: #337AB7;"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>     
                </div>
            </div>
        </div>
    </div>
</div>
<input id="sinRealizar" type="hidden" value="<?= $pruebas["SinRealizar"] ?>">
<input id="aprobados" type="hidden" value="<?= $pruebas["Aprobados"] ?>">
<input id="reprobados" type="hidden" value="<?= $pruebas["Reprobados"] ?>">


<ol class="breadcrumb">
    <li>
        <a href="#">FIANZA LTDA</a>
    </li>
    <li>
        <a class="active" href="#" id="" >Administracion</a>
    </li>
    <li>
        <a class="" href="#" id="" >Usuarios</a>
    </li>
</ol>
<div id="contenedor_data">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="margin-bottom: 4%">
            <div class="switch-right-grid" style=" padding-bottom: 3%">
                <div class="switch-right-grid1">
                    <h2 style="">Usuarios del sistema</h2>
                    <p>Ingrese el dato del usuario a buscar:</p>  
                    <input class="form-control" id="myInput" type="text" placeholder="Buscar usuario ..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center">USUARIO</th>
                                <th style="text-align: center">IDENTIFICACION</th>
                                <th style="text-align: center">NOMBRE</th>
                                <th style="text-align: center">CERTIFICADO</th>
                                <th style="text-align: center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">

                            <?php foreach ($capacitaciones as $u): ?>
                                <tr style="text-align: center">
                                    <td><?=$u["usuario"]; ?></td>
                                    <td><?=$u["identificacion"]; ?></td>
                                    <td><?=$u["nombre_completo"]; ?></td>  
                                    <td>
                                        <a href="" data-id='<?=$u["id_usuario"]; ?>' class="btn btn-success verCertificado" data-toggle="modal" data-target="#certificadosModal">¡Ver!</a>

                                        <!--<a title="Descargar Presentacion" href="<?php /* $u["ruta_certificacion"]; */?>" target="_blank"><i class="fa fa-file-pdf-o" style="font-size:36px"></i></a> -->
                                    </td>
                                    <td>
                                        <a href="#modal-container-851020" data-toggle="modal">
                                            <button data-id='<?=$u["id_usuario"]; ?>' class="btn btn-warning   btnActualizar" >Editar</button>
                                        </a>
                                    </td>
                                </tr>  
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Ver certificados -->
        <div class="modal fade" id="certificadosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content mdoal-md">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificados</h4>
              </div>
              <div class="modal-body">
                <div id="verCertificadoCapa"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Asignar capacitaciones -->
        <div class="modal fade" id="modal-container-851020" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 style="text-align: center" class="modal-title" id="myModalLabel">
                            Administrar Usuario
                        </h4>
                    </div>
                    <form id="formActualizarCap" action="javascript:void(0);" >
                        <div class="modal-body">
                            <div class="tabbable" id="tabs-23616">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active">
                                        <a href="#seccionCap" data-toggle="tab">CAPACITACIONES</a>
                                    </li>
                                   <!--  <li>
                                        <a href="#seccion2" data-toggle="tab">SECCION 2</a>
                                    </li> -->
                                </ul>
                                <div class="tab-content container" style="width: 100% !important;">
                                    <div role="tabpanel" class="tab-pane active" id="seccionCap">
                                        <div class="row" id="contenidoChecks"> 

                                        </div>
                                    </div>
                                    <!-- <div class="tab-pane" id="seccion2">                               
                                        <h2>Seccion 2</h2>                                
                                    </div> -->
                                </div>
                            </div>                    
                        </div>
                        <div class="modal-footer">   
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                        </div>
                        <input type="hidden" name="metodo" value="actualizarUsuario">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</div>
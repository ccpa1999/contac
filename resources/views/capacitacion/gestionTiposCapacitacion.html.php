<ol class="breadcrumb">
    <li>
        <a href="#">FIANZA LTDA</a>
    </li>
    <li>
        <a  href="#" id="" >Administracion</a>
    </li>
    <li class="active">
        Tipos
    </li>
</ol>

<div id="contenedor_data">
    <div class="row" >
        <div class="col-md-12" style="margin-bottom: 1%">
            <div class="switch-right-grid" style="padding-bottom: 2%;">
                <div>
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">
                                    <h3 style="text-align: center">NUEVO TIPO DE CAPACITACION</h3>
                                </a>
                            </div>
                        </div>
                    </nav>

                    <div class="row" style="padding: 1%">
                        <form id="subirTipoCap" class="formCarga" enctype="multipart/form-data" action="javascript:void(0);" > 
                            <div class="col-md-4">
                                <label>Nombre :</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input id="nombreTipo" name="nombreTipo" class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">                             

                                <label class="control-label">Subir imagen desde una carpeta :</label>
                                <input type="file" accept="image/*" id="archivo" name="archivo" readyonly class="file-loading inputCarga" required> 
                                <input type="hidden" name="metodo" value="guardarTipo">
                                <input type="hidden" id="tipoCapacitacion" name="" value="">                            
                            </div>
                            <div class="col-md-4">
                                <label for="comment">Descripcion:</label>
                                <div class="form-group">                                
                                    <textarea style="min-width: 359px; max-width: 359px; min-height: 132px; max-height: 132px" id="descripcionTipo" name="descripcionTipo" class="form-control" rows="5" id="comment" maxlength="255"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row" style="padding: 1%">
                        <center>
                            <button id="btnSubirTipo" class="btn btn-primary"> <i class="fa fa-floppy-o"></i> GUARDAR</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <h3 style="text-align: center">TIPOS DE CAPACITACION CARGADOS</h3>
                </a>
            </div>
        </div>
    </nav>

    <div class="row" style="overflow: hidden">
        <?php foreach ($capacitacion["tiposCap"] as $item): ?>
            <?php if ($item['imagen_capacitacion'] != ''): ?>
                <div class="col-md-2">
                    <a href="#" class="thumbnail btnIniciarCapacitacion" title="<?=$item['nombre'] ?>" style="min-height:150px;height:50px;"
                       data-tipo="<?=$item['id']; ?>">
                        <img src="../../public/images/<?=$item['imagen_capacitacion'] ?>" alt="" class="img-responsive"
                             style="padding-top: 15%;">
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

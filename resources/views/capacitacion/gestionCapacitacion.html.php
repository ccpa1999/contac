<ol class="breadcrumb">
    <li>
        <a href="#">FIANZA LTDA</a>
    </li>
    <li>
        <a  href="#" id="" >Administracion</a>
    </li>
    <li class="active">
        Capacitaciones
    </li>
</ol>

<div id="contenedor_data">

    <div class="row" >
        <div class="col-md-4" style="margin-bottom: 1%">
            <div class="switch-right-grid" style="padding-bottom: 2%;">
                <div class="switch-right-grid1">
                    <div class="panel panel-success">
                        <p style="margin-bottom: 5%; text-align: center">Seleccione el tipo de capacitacion</p>
                        <select id="TipoCapacitacion" class="form-control" style="margin-bottom: 5%;">
                            <option value="0">Seleccione...</option>
                            <?php foreach ($capacitacion["tiposCapU"] as $item): ?>
                                <option value="<?=$item["id"]; ?>"><?=$item["nombre"]; ?></option>
                            <?php endforeach; ?>
                        </select>    
                    </div>
                </div>
            </div>
        </div>        

        <div class="col-md-8" style="margin-bottom: 1%">
            <div class="switch-right-grid" style="padding-bottom: 2%;">
                <div  id="ContenidoTabla" class="switch-right-grid1">

                </div>
            </div>
        </div>
    </div>

</div>







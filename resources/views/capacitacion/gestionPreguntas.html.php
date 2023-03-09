<div id="contenedor_data">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">FIANZA LTDA</a>
            </li>
            <li class="active">Capacitaciónes
            </li>  
        </ol>
        <br>
        <div class="row" style="margin-bottom: 2%">
            <div class="col-md-12 " >
                <div class="switch-right-grid" style="padding-bottom: 2%;">
                    <div class="switch-right-grid1">
                        <div class="row">                            
                            <div class="col-md-4 " >
                                <label class="control-label">Seleccione el tipo de CAPACITACIÓN</label>
                                <select id="selectTipo" class="form-control">
                                    <option value="none">Seleccione..</option>
                                    <?php if (!empty($TipoCapacitacion)): 
                                        foreach ($TipoCapacitacion as $tipos): ?>
                                        <option value="<?=$tipos["id"]; ?>"><?=$tipos["nombre"]; ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="col-md-4 " >
                                <label class="control-label">Seleccione CAPACITACIÓN</label>
                                <select id="selectCapacitacion" class="form-control" data-tipo="">
                                    <option value="none">Seleccione..</option>
                                </select>
                            </div>                            
                            <div id="divCarga" class="col-md-4 inactivo" style="display: none">
                                <form id="formCarga" class="formCarga" enctype="multipart/form-data" action="javascript:void(0);" >
                                    <label class="control-label">Subir Archivo desde una carpeta</label>
                                    <input type="file" accept=".csv" name="archivo" readyonly class="file-loading inputCarga" required> 
                                    <input type="hidden" name="metodo" value="cargarPreguntas">
                                    <input type="hidden" id="tipoCap" name="tipoCap" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccionOculta" class="row seccionOculta" style="margin-bottom: 2% ; display: none">
            <div class="col-md-12">
                <div class="switch-right-grid" style="padding-bottom: 2%;">
                    <div class="switch-right-grid1">                        
                        <div id="divTabla">

                        </div>
                    </div>                        
                </div>                    
            </div>
        </div>
    </div>
</div>






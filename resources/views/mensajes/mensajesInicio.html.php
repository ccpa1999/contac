<?php $this->layout('layout.html', ['modulo' => 'mensajes']) ?>

<div id="contenedor_data">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">FIANZA LTDA</a>
            </li>
            <li class="active">Mensajes de texto
            </li>  
        </ol>
        <hr>
        <div class="row">
    		<div id="divCarga" class="col-md-12 ">
				<form id="cargarMensajes" class="formCarga" enctype="multipart/form-data" method="POST" action="javascript:void(0);">
					<div class="col-md-8 col-md-offset-2">
                        <h1>¡Envie masivamente sus mensajes!</h1>
                        <br>
                        <label for="texto">Mensaje masivo</label>
                        <textarea class="form-control" placeholder="Escriba aquí su texto...."  id="texto" name="texto" rows="3" style="max-width: 100%; min-width: 100%; max-height: 150px; min-height: 150px; width: 931px; height: 164px;"></textarea>
                        <br><br>
						<label for="archivo" class="control-label">Subir archivo desde una carpeta</label>
						<input type="file" accept=".csv" name="archivo" readyonly class="file-loading inputCarga" required>
						<input type="hidden" name="metodo" value="cargarMensajes">
						<input name="metodo" value="cargarMensajes" type="hidden">
					</div>				
                </form>
			</div>
		</div>
    </div>
</div>
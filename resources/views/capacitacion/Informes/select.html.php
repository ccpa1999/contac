
<style>

</style>
<?php if (isset($parametro)): ?>
	<br>
    <div class='col-sm-12'>
		<label for='selectInforme'>Seleccione capacitaciones a ver (OPCIONAL): </label>
		<select class='form-control' id='select1' name='select1'>
			<option value='0'>Toda las pruebas</option>";
			<?php foreach ($resultado as $key) : ?>
				<option value="<?=$key['id'] ?>"><?=$key['nombre'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
    <div class="col-sm-12">
        <br>
        <label for="">Seleccione los campos a observar: </label>
    </div>
    <div class="col-sm-12 checbox">
    <?php 
    	if ($parametro == "3"):
    		$check = array(
    			"cntIntentosPrueba"=>"Cantidad de intentos de la prueba",
    			"detIntentosPrueba"=>"Detalle por intento de la prueba",
    			"tmpPrueba"=>"Tiempo de la prueba",
    			"Preguntas_Respuestas"=>"Preguntas y Respuesta usuario",
    			"tmpPregunta"=>"Tiempo por pregunta",
    			"cntIntentosRespuesta"=>"Cantidad de movimientos por pregunta",
    			"dtlIntentoPregunta" =>"Detalles del intento");
    	elseif($parametro == "2"):
    		$check = array(
    			"numPreguntas"=>"Numero de preguntas",
    			"cntRealizados"=>"Cantidad de veces realizadas",
    			"promIntentosPr"=>"Promedio de intentos de la prueba");
    	elseif($parametro == "1"):
    		$check = array(
    			"promResultadorUsu"=>"Promedio de resultados de usuarios",
    			"promNorealizadoUsu"=>"Promedio de usuarios que no han realizado el examen",
    			"cntAsignadoUsu"=>"Cantidad de usuarios asignados",
    			"promIntentosPr"=>"Promedio de intentos por prueba");
    	endif; 
        foreach ($check as $key => $value) : ?>
			<div class="col-sm-6 col-md-3">
                <label class="col-sm-2 switch1">
                  <input type="checkbox" name="<?=$key ?>" checked>
                  <span class="slider round"></span>
                </label>
                <p class="col-sm-10"><?=$value ?></p>
	        </div>
	<?php endforeach ?>
    </div>
<?php else: ?>
	<div class="col-sm-12">
		<label for="select">Seleccione un usuario: </label>
	    <select class="form-control" id="sltUsuario" name="sltUsuario">
	        <option value='' selected='' disabled=''>...</option>
			<?php foreach ($resultado as $key) :?>
				<option value="<?=$key['id'] ?>" ><?=$key['nombre'] ?></option>;
			<?php endforeach; ?>         
	    </select>
    </div>
<?php endif ?>
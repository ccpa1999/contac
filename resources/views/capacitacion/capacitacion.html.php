<?php if($parametro == 'asignarCapacitaciones'): ?>
<div class="container-fluid">
    <form action="" id="formAsignarCapacitacion">
        <div class="row">
              <a href="#" id="Guardar"></a>

    			<div class="col-sm-12 col-md-4 thumbnail" style="margin: 0px !important; height: 320px !important; max-height: 420px; padding: 10px 10px;">
    				<h4 class="modal-title text-center" id="myModalLabel">Usuarios</h4>
            <hr style="margin: 10px 0px;">
    				<div class="form-group">
    					<input class="form-control" style="margin: 0 auto !important;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar usuario..." autocomplete="off">	
    				</div>
    				<div style="overflow: auto; height:	67%;">
    					<ul id="galleryUsu" style="width: 100% !important; padding: 0;">
    						<?php foreach ($usuarios as $usuario): ?>
    							<li style="height:36px !important; width: 100% !important; margin: 2px 0px !important;" type="button" class="btn btn-default" data-id="<?=$usuario['id_usuario'] ?>">
    								<a style="width: 100% !important; color: #000 !important;"><?=$usuario['usuario']; ?></a>
    							</li>
    						<?php endforeach; ?>
    					</ul> 
    				</div>
    			</div>
          <div class="col-sm-12 col-md-4 thumbnail" style="margin: 0px !important; height: 320px !important; max-height: 420px; padding: 10px 10px;">
                    <h4 class="modal-title text-center" id="myModalLabel">Capacitaciones</h4>
                    <hr style="margin: 10px 0px;">
    				<div class="form-group">				
                    	<input  class="form-control" style="margin: 0 auto !important;" type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Buscar usuario..." autocomplete="off">
    				</div>
    				<div style="overflow: auto; height:	67%;">
    	                <ul id="gallery" style="width: 100% !important; padding: 0;">
    						<?php foreach ($capacitaciones as $modulo): ?>
    						<li style="height:36px !important; width: 100% !important; margin: 2px 0px !important;" type="button" class="btn btn-default" data-id="<?=$modulo['id'] ?>">
    							<a style="color: #000 !important;"><?=$modulo['nombre']; ?></a>
    						</li>
    						<?php endforeach; ?>
    					</ul> 
    				</div>
          </div> 
          <div class="col-sm-12 col-md-4 thumbnail" style="margin: 0px !important; height: 320px !important; max-height: 420px; padding: 10px 10px;" id="capacitac">
    				<h4 class="modal-title text-center" id="myModalLabel">Vista previa</h4>
            <hr style="margin: 10px 0px;">
    				
              <h4 class="modal-title text-center"  id="myModalLabel">Usuarios</h4>
              <div style="overflow: auto; height:30.5% !important;" class="thumbnail">
      					<ul style="width: 100% !important; padding: 0;" id="trash">
      						
      					</ul>
              </div>
              <h4 class="modal-title text-center"  id="myModalLabel">Capacitaciones</h4>           
                
              <div style="overflow: auto; height:30.5% !important;" class="thumbnail">
      					<ul style="width: 100% !important; padding: 0;" id="trash1"> 

                </ul>
    				  </div>
    			</div>
        </div>
  		<div>
  			<input type="hidden" name="capa" id="capa" required>
  			<input type="hidden" name="usu" id="usu" required>
        <br>
  			<div class="row">
         <div class="col-sm 12 align-right">
           <input type="button" class="btn btn-primary btn-lg" value="Guardar" id="btnGuardarForm">
         </div>   
        </div>
  		</div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#trash').on('click', 'li', function() {
      	$(this).appendTo('#galleryUsu');
      	$id = $(this).data('id');
      	$temporal = "";
      	$.each($('#usu').val().split(","),function (key, value){      		
      		if ($id != value && value != "") {
      			$temporal += value+",";
      		}
      	});
      	$('#usu').val($temporal);
      
    });
    $('#galleryUsu').on('click', 'li', function() {
      	$(this).appendTo('#trash');
      	$('#usu').val($(this).data('id')+"," + $('#usu').val());
    });
    $('#trash1').on('click', 'li', function() {
      	$(this).appendTo('#gallery');
      	$id = $(this).data('id');
      	$temporal = "";
      	$.each($('#capa').val().split(","),function (key, value){      		
      		if ($id != value && value != "  ") {
      			$temporal += value+",";
      		}
      	});
      	$('#capa').val($temporal);
    });

    $('#gallery').on('click', 'li', function() {
      	$(this).appendTo('#trash1');
      	$('#capa').val($(this).data('id')+"," + $('#capa').val());
    });
});
   
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("galleryUsu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function myFunction1() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput1");
    filter = input.value.toUpperCase();
    ul = document.getElementById("gallery");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<?php 
elseif($parametro == 'habilitarUsuario'): ?>
  <div class="container-fluid">
    <form action="" id="formAsignarCapacitacion">
        <div class="row">
              <a href="#" id="Guardar"></a>

          <div class="col-sm-12 col-md-6 thumbnail" style="margin: 0px !important; height: 320px !important; max-height: 420px; padding: 10px 10px;">
            <h4 class="modal-title text-center" id="myModalLabel">Usuarios</h4>
            <hr style="margin: 10px 0px;">
            <div class="form-group">
              <input class="form-control" style="margin: 0 auto !important;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar usuario..." autocomplete="off">  
            </div>
            <div style="overflow: auto; height: 67%;">
              <ul id="galleryUsu" style="width: 100% !important; padding: 0;">
                <?php foreach ($usuarios as $usuario => $data): ?>
                  <li style="height:36px !important; width: 100% !important; margin: 2px 0px !important;" type="button" class="btn btn-default" data-id="<?=$capacitaciones[$usuario]['id_cap_usuario']; ?>">
                    <a style="width: 100% !important; color: #000 !important;"><?=$data['usuario']; ?> -  <?=$capacitaciones[$usuario]['capacitacion']; ?></a>
                  </li>
                <?php endforeach; ?>
              </ul> 
            </div>
          </div>
          <div class="col-sm-12 col-md-6 thumbnail" style="margin: 0px !important; height: 320px !important; max-height: 420px; padding: 10px 10px;" id="capacitac">
            <h4 class="modal-title text-center" id="myModalLabel">Habilitar</h4>
            <hr style="margin: 10px 0px;">  
              <div style="overflow: auto; height:85% !important;" class="thumbnail">
                <ul style="width: 100% !important; padding: 0;" id="trash">
                  
                </ul>
              </div>
          </div>
        </div>
      <div>
        <input type="hidden" name="capa" id="capa" required>
        <br>
        <div class="row">
         <div class="col-sm 12 align-right">
           <input type="button" class="btn btn-primary btn-lg" value="Guardar" id="btnGuardarForm">
         </div>   
        </div>
      </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#trash').on('click', 'li', function() {
        $(this).appendTo('#galleryUsu');
        $id = $(this).data('id');
        $temporal = "";
        $.each($('#capa').val().split(","),function (key, value){          
          if ($id != value && value != "") {
            $temporal += value+",";
          }
        });
        $('#capa').val($temporal);
      
    });
    $('#galleryUsu').on('click', 'li', function() {
        $(this).appendTo('#trash');
        $('#capa').val($(this).data('id')+"," + $('#capa').val());
    });
});
   
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("galleryUsu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<?php
elseif($parametro == 'bloquearExamen'): ?>
  <div class="container-fluid">
    <form action="" id="formBloquearExamen">
        <div class="row">
              <a href="#" id="Guardar"></a>

          <div class="col-sm-12 col-md-6 thumbnail" style="margin: 0px !important; height: 220px !important; max-height: 220px; padding: 10px 10px;">
            <h4 class="modal-title text-center" id="myModalLabel">Usuarios</h4>
            <hr style="margin: 10px 0px;">
            <div class="form-group">
              <input class="form-control" style="margin: 0 auto !important;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar usuario..." autocomplete="off">  
            </div>
            <div style="overflow: auto; height: 67%;">
              <ul id="galleryUsu" name="galleryUsu" style="width: 100% !important; padding: 0;">
                <?php foreach ($usuarios as $usuario => $data): ?>
                  <li style="height:36px !important; width: 100% !important; margin: 2px 0px !important;" type="button" class="btn btn-default" data-id="<?=$capacitaciones[$usuario]['id_cap_usuario']; ?>">
                    <a style="width: 100% !important; color: #000 !important;"><?=$data['usuario']; ?> -  <?=$capacitaciones[$usuario]['capacitacion']; ?></a>
                  </li>
                <?php endforeach; ?>
              </ul> 
            </div>
          </div>
          <div class="col-sm-12 col-md-6 thumbnail" style="margin: 0px !important; height: 220px !important; max-height: 220px; padding: 10px 10px;" id="capacitac">
            <h4 class="modal-title text-center" id="myModalLabel">Bloquear</h4>
            <hr style="margin: 10px 0px;">  
              <div style="overflow: auto; height:75% !important;" class="thumbnail">
                <ul style="width: 100% !important; padding: 0;" id="trash" name="trash">
                  
                </ul>
              </div>
          </div>
          <div class="col-sm-12 col-md-12 thumbnail" style="margin: 0px !important; height: 220px !important; max-height: 220px; padding: 10px 10px;" >
            <h4 class="modal-title text-center" id="myModalLabel">Descripción</h4>
            <hr style="margin: 10px 0px;">  
            <select class="form-control" id="descripcion" name="descripcion">
              <option value="" selected="" disabled="">Seleccione una opción..</option>
              <option value="El usuario tiene la capacitación abierta durante el examen">El usuario tiene la capacitación abierta durante el examen</option>
              <option value="El usuario se copió">El usuario se copió</option>
              <option value="Fuga de información">Fuga de información</option>
              <option value="El usuario tiene un aparato tecnólogic">El usuario tiene un aparato tecnólogico</option>
              <option value="6">Otro, ¿Cual?...</option>
            </select>
            <br>
            <textarea id="descripcionOtro" name="descripcionOtro" class="form-control" style="display: none;" rows="4"></textarea>
          </div>
        </div>
      <div>
        <input type="hidden" name="capa" id="capa" required>
        <input type="hidden" name="metodo" id="metodo" value="guardarBloquearExamen" required>
        <br>
        <div class="row">
         <div class="col-sm 12 align-right">
           <input type="button" class="btn btn-primary btn-lg" value="Guardar" id="btnGuardarForm">
         </div>   
        </div>
      </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#descripcion').on('change',function(){
      if($('#descripcion').val() == '6'){
        $('#descripcionOtro').css('display','block');
      }else{
        $('#descripcionOtro').css('display','none');
      }
    });

    $('#trash').on('click', 'li', function() {
        $(this).appendTo('#galleryUsu');
        $id = $(this).data('id');
        $temporal = "";
        $.each($('#capa').val().split(","),function (key, value){          
          if ($id != value && value != "") {
            $temporal += value+",";
          }
        });
        $('#capa').val($temporal);
      
    });
    $('#galleryUsu').on('click', 'li', function() {
        $(this).appendTo('#trash');
        $('#capa').val($(this).data('id')+"," + $('#capa').val());
    });
});
   
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("galleryUsu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<?php
elseif($parametro == 'verCertificadoCapa'): ?>
  <ul class="nav nav-tabs" role="tablist">
    <?php foreach ($capacitaciones as $ruta): ?>    
        <li role="presentation" class=""><a href="#home<?=$ruta['id'] ?>" aria-controls="home<?=$ruta['id'] ?>" role="tab" data-toggle="tab"><?=$ruta['nombre'] ?></a></li>  
    <?php endforeach ?>
  </ul>
  <div class="tab-content">
    <?php foreach ($capacitaciones as $ruta): ?> 
      <div role="tabpanel" class="tab-pane" id="home<?=$ruta['id'] ?>">
          <div class="col-sm-12">
            <div class="embed-responsive embed-responsive-16by9">            
              <iframe class="embed-responsive-item" src="<?=$ruta['ruta_certificacion']?>" frameborder="0"></iframe>
            </div>
          </div>
          <div class="caption">
            <p>
              <a style="margin: 15px 0px 0px 15px !important" target="_blank" href="<?=$ruta['ruta_certificacion']?>" class="btn btn-primary btn-lg" role="button">¡Ver certificado!</a>
            </p>
          </div>
      </div>
    <?php endforeach ?>
  </div>
<?php endif; ?>
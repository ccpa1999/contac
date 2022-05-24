<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../../public/css/bootstrap.min.css" type="text/css">
 <style media="screen">
 .container{
   display: block;
   width: 100% !important;
   margin: 0 auto !important;
   padding: 15px;
 }
 .col-sm-12 p{
   text-align: justify;
 }
   .pad{
     width: 50%;
     display: inline-block;
     position: relative;
   }
   .td{
     width: 100px;
   }
 </style>
</head>
<body>
 <div class="container">
 <br>
 <?php
   if($param == 'Certificacion'):
   $cont= 0;
   ?>
   <div class="row" style="border: 2px solid #000; padding:5px;">
     <div class="">
       <img class="img-responsive" style="display:inline-block !important; width:150px; float:left;"  src="../../public/images/logo_fianza-01.png" alt="Fianza Logo">
     </div><div style="display:inline-block; padding-top: 40px; padding-left: 15px !important;"><h4><em>CERTIFICACIÓN DE ASISTENCIA A CAPACITACION<?php
         if(sizeof($datos['capacitaciones'])>1){
           echo "ES";
         }
          ?>
        </em></h4></div>
   </div>
   <br>
   <div class="row align-center">
     <br>
     <br>
     <div class="col-sm-12">
       <p>Yo <?= strtoupper($datos['capacitado'][0]['nombre_completo']) ?>, identificado(a) con cedula de ciudadanía No. <?= strtoupper($datos['capacitado'][0]['identificacion']); ?>, recibí capacitación<?php if(sizeof($datos['capacitaciones'])>1){ echo 'es'; } ?> de: </p>
       <br>
       <br>
       <ol>
        <?php foreach($datos['capacitaciones'] as $cap): ?>
          <li><?=strtoupper($cap[0]['nombre']); ?></li>
        <?php endforeach; ?>
       </ol>
     </div>
   </div>
   <div class="row">
         <br>
         <br>
         <div class="col-sm 12">
           <p>Declaro que comprendo y acepto cada una de las politicas aqui consignadas y reconozco que el incumplimiento parcial o total de las mismas será considerado como una falta grave.</p>
           <br>
           <div class="col-sm-12">
             Fecha: <?=date("d-m-Y"); ?>
           </div>
           <br>
           <div class="col-sm-12">
            Firma en señal de aceptación:
           </div>
         </div>
         <br>
         <br>
         <br>
         <br>
         <div class="col-sm-12">
           <div class="pad text-center">
             <?= strtoupper($datos['capacitado'][0]['nombre_completo']); ?>
           </div>
           <div class="pad text-center">
             <?= strtoupper($datos['capacitador'][0]['nombre_completo']); ?>
           </div>
         </div>
         <div class="col-sm-12">
           <div class="pad text-center">
             ________________________
           </div>
           <div class="pad text-center">
             ________________________
           </div>
         </div>
        <div class="col-sm-12">
          <div class="pad text-center">
            Asesor
          </div>
          <div class="pad text-center">
            Capacitador
          </div>
        </div>
   </div>
<?php endif; ?>
   </div>
<script src="../../public/js/jquery-3.1.1.min.js"></script>
<script src="../../public/js/bootstrap.min.js"></script>
</body>
</html>

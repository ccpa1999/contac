<h2>Diagrama</h2>
<hr>
	<canvas id="canvas" style="position: relative;margin: auto;height: 80vh;  width: 80vw;">
	</canvas>
	<script src="../../public/js/Chart.min.js"></script>
	<script>
		canvas = document.getElementById('canvas');
		var myChart = new Chart(canvas, {
	            type: '<?php if($informe != "3"){ echo "horizontalBar"; }else{
	            	echo "doughnut";
	            } ?>',
		<?php if($informe == "1"): ?>
			            data: {
			                labels: <?= "[";
			                $cont = 0;
			                foreach($lenguajes as $l){
			                  echo "'".$l['Tipo_Prueba']."',";

			                 }
			                 echo "]";  ?> /* Bases de datos", "Html5"]*/,
			                datasets: [
			                {
			                  label: 'Usuarios asignados',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Cantidad de usuarios asignados'].",";
			                   }
			                   echo "]";  ?> /*[12, 19, 39]*/,
			                  backgroundColor: 'rgb(240,119,222)',
			                },
			                {
			                  label: 'Aprobados',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Promedio de usuarios que aprobaron'].",";
			                   }
			                   echo "]";  ?> /*[12, 19, 39]*/,
			                  backgroundColor: 'rgb(242,234,120)',
			                }, {
			                  label: 'Reprobados',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Promedio de usuarios que reprobaron'].",";
			                   }
			                   echo "]";  ?>/*[45, 37, 25]*/,
			                  backgroundColor:'rgb(75,189,182)',
			                },
			                {
			                  label: 'Sin realizar',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Promedio de usuarios que sin realizado'].",";
			                   }
			                   echo "]";  ?> /*[35, 10, 47]*/,
			                  backgroundColor: 'rgb(163,65,148)',
			                }
			              ]
			            },
		<?php elseif($informe == "2"): ?>
			            data: {
			                labels: <?= "[";
			                $cont = 0;
			                foreach($lenguajes as $l){
			                  echo "'".$l['Tipo_Prueba']."',";

			                 }
			                 echo "]";?>,
			                datasets: [
			                {
			                  label: 'Preguntas por prueba',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Numero de preguntas'].",";
			                   }
			                   echo "]";  ?>,
			                  backgroundColor: 'rgb(242,138,216)',
			                },
			                {
			                  label: 'Total de pruebas realizadas',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Total de pruebas realizadas'].",";
			                   }
			                   echo "]";  ?>,
			                  backgroundColor: 'rgb(101,166,166)',
			                },
			                {
			                  label: 'Cantidad de usuarios asignados',
			                  data: <?= "[";
			                  $cont = 0;
			                  foreach($lenguajes as $l){
			                    echo $l['Cantidad de usuarios asignados'].",";
			                   }
			                   echo "]";  ?>,
			                  backgroundColor:'rgb(166,78,143)',
			                },
			                {
			                  label: 'Promedio de intentos de prueba',
			                  data: <?= "[";
			                  foreach($lenguajes as $l){
			                    echo $l['Promedio de intentos de prueba'].",";
			                   }
			                   echo "]";  ?>,
			                  backgroundColor: 'rgb(245,233,115)',
			                }
			              ]
			            },
		<?php elseif($informe == "3"): ?>
						data: {
					        labels: <?= "[";
			                foreach($lenguajes as $l){
			                  echo "'INTENTOS POR ".$l['Tipo_Prueba']."',";
			                  echo "'APROBADOS POR ".$l['Tipo_Prueba']."',";
			                  echo "'REPROBADOS POR ".$l['Tipo_Prueba']."',";
			                 }
			                 echo "]";?>,
					        datasets: [{
					            label: 'Intentos de prueba',
					            data: <?= "[";					            
					            foreach ($lenguajes as $l) {
					            	echo $l['Cantidad de intentos'].",";
					            	$reprobo = 0;
					            	$aprobo = 0;
					            	$cont = 0;
					            	for ($i=0; $i < $l['Cantidad de intentos']; $i++) { if($l[$i]['Resultado prueba'] == "Reprobo"){
						            		$reprobo++;
						            	}else{
						            		$aprobo++;
					            		}
					            	}
					            	echo $reprobo.",";
					            	echo $aprobo.",";
					        	}
					            echo "]";?>,
					            backgroundColor: [
					            <?php
					            //hsv(colores,x,y) (0-360, 25-45,90-100)
					            foreach($lenguajes as $l){
					            	$color = rand(0,360);
					            	$x=rand(50,100);
					            	$y= rand(70,88);
					echo "'HSL(".$color.", ".$x."%, ".$y."%)','HSL(".($color+15).", ".$x."%, ".$y."%)','HSL(".($color+65).", ".$x."%, ".$y."%)',";
				                }
				                ?>
					            ],
					        }]
					    },
					    options: {
					        cutoutPercentage: 40,
					    },
					});
    		<?php endif;  ?>		            
	<?php if($informe != "3"): ?>
			            options: {
			                responsive: true,
			                legend: {
			                  display: true,
			                  position: 'bottom',
			                  labels: {
								fontSize: 15,
			                    boxWidth: 10,
			                    usePointStyle:  true,
			                    padding: 20,
			                  },
			                },
			                scales: {
			                    // yAxes: [{
			                    //     ticks: {
			                    //     	min:0,
			                    //     	suggestedMin: 0,
			                    //         beginAtZero:true,
			                    //     }
			                    // }],
			                    xAxes: [{
			                        ticks: {
			                        	min:0,
			                        	suggestedMin: 0,
			                            beginAtZero:true,
			                        }
			                    }]
			                }
			            }
			        });
	
		Chart.plugins.register({
	      afterDatasetsDraw: function(chart) {
	        var ctx = chart.ctx;

	        chart.data.datasets.forEach(function(dataset, i) {
	          var meta = chart.getDatasetMeta(i);
	          if (!meta.hidden) {
	            meta.data.forEach(function(element, index) {
	              // Just naively convert to string for now
	              var dataString = dataset.data[index].toString();

	              // Draw the text in black, with the specified font
	              	ctx.fillStyle = 'rgba(0, 0, 0,.5)';

	              var fontSize = 14;
	              var fontStyle = 'normal';
	              var fontFamily = 'Arial';

	              ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
	              // Make sure alignment settings are correct
	              ctx.textAlign = 'left';
	              ctx.textBaseline = 'top';
	              var padding = 5;
	              var position = element.tooltipPosition();
	              if(dataString == 0){
	              	ctx.fillText(dataString,(position.x + 10) ,(position.y - (fontSize / 2) ) );
	              }else{
	              	ctx.fillText(dataString,(position.x / 2) ,(position.y - (fontSize / 2) ) );
	              }
	              
	            });
	          }
	        });
	      }
	    });
	 <?php endif; ?>
	</script>





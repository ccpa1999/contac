<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header("Content-Type: *");
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Credentials: true');
/**
 * Este Archivo y todos los contenidos en esta aplicación son propiedad
 * exclusiva de FIANZA LTDA, cualquier copia o reproducción del codigo 
 * aquí contenido será tomada como una violación a los derechos de autor 
 * de la marca anteriormente nombrada y será castigada y denunciada
 * penalmente
 * 
 * @author Jonnathan Murcia <jjmurciab@gmail.com>
 * @version 1.0
 * @copyright (c) 2017, Fianza LTDA 
 * */

class Consultas {

    var $consultas;

    public function __construct()
    {
      
    }

    public function consultas()
    {
    	$consultas = Array('tabla_asignacion' => 'CREATE TEMPORARY TABLE `tmp` (
												  `campo1` varchar(200) DEFAULT NULL,
												  `campo2` varchar(200) DEFAULT NULL,
												  `campo3` varchar(200) DEFAULT NULL,
												  `campo4` varchar(200) DEFAULT NULL,
												  `campo5` varchar(200) DEFAULT NULL,
												  `campo6` varchar(200) DEFAULT NULL,
												  `campo7` varchar(200) DEFAULT NULL,
												  `campo8` varchar(200) DEFAULT NULL,
												  `campo9` varchar(200) DEFAULT NULL,
												  `campo10` varchar(200) DEFAULT NULL,
												  `campo11` varchar(200) DEFAULT NULL,
												  `campo12` varchar(200) DEFAULT NULL,
												  `campo13` varchar(200) DEFAULT NULL,
												  `campo14` varchar(200) DEFAULT NULL,
												  `campo15` varchar(200) DEFAULT NULL,
												  `campo16` varchar(200) DEFAULT NULL,
												  `campo17` varchar(200) DEFAULT NULL,
												  `campo18` varchar(200) DEFAULT NULL,
												  `campo19` varchar(200) DEFAULT NULL,
												  `campo20` varchar(200) DEFAULT NULL,
												  `campo21` varchar(200) DEFAULT NULL,
												  `campo22` varchar(200) DEFAULT NULL,
												  `campo23` varchar(200) DEFAULT NULL,
												  `campo24` varchar(200) DEFAULT NULL,
												  `campo25` varchar(200) DEFAULT NULL,
												  `campo26` varchar(200) DEFAULT NULL,
												  `campo27` varchar(200) DEFAULT NULL,
												  `campo28` varchar(200) DEFAULT NULL,
												  `campo29` varchar(200) DEFAULT NULL,
												  `campo30` varchar(200) DEFAULT NULL,
												  `campo31` varchar(200) DEFAULT NULL,
												  `campo32` varchar(200) DEFAULT NULL,
												  `campo33` varchar(200) DEFAULT NULL,
												  `campo34` varchar(200) DEFAULT NULL,
												  `campo35` varchar(200) DEFAULT NULL,
												  `campo36` varchar(200) DEFAULT NULL,
												  `campo37` varchar(200) DEFAULT NULL,
												  `campo38` varchar(200) DEFAULT NULL,
												  `campo39` varchar(200) DEFAULT NULL,
												  `campo40` varchar(200) DEFAULT NULL,
												  `campo41` varchar(200) DEFAULT NULL,
												  `campo42` varchar(200) DEFAULT NULL,
												  `campo43` varchar(200) DEFAULT NULL,
												  `campo44` varchar(200) DEFAULT NULL,
												  `campo45` varchar(200) DEFAULT NULL,
												  `campo46` varchar(200) DEFAULT NULL,
												  `campo47` varchar(200) DEFAULT NULL,
												  `campo48` varchar(200) DEFAULT NULL,
												  `campo49` varchar(200) DEFAULT NULL,
												  `campo50` varchar(200) DEFAULT NULL,
												  `campo51` varchar(200) DEFAULT NULL,
												  `campo52` varchar(200) DEFAULT NULL,
												  `campo53` varchar(200) DEFAULT NULL,
												  `campo54` varchar(200) DEFAULT NULL,
												  `campo55` varchar(200) DEFAULT NULL,
												  `campo56` varchar(200) DEFAULT NULL,
												  `campo57` varchar(200) DEFAULT NULL,
												  `campo58` varchar(200) DEFAULT NULL,
												  `campo59` varchar(200) DEFAULT NULL,
												  `campo60` varchar(200) DEFAULT NULL,
												  `campo61` varchar(200) DEFAULT NULL,
												  `campo62` varchar(200) DEFAULT NULL,
												  `campo63` varchar(200) DEFAULT NULL,
												  `campo64` varchar(200) DEFAULT NULL,
												  `campo65` varchar(200) DEFAULT NULL,
												  `campo66` varchar(200) DEFAULT NULL,
												  `campo67` varchar(200) DEFAULT NULL,
												  `campo68` varchar(200) DEFAULT NULL,
												  `campo69` varchar(200) DEFAULT NULL,
												  `campo70` varchar(200) DEFAULT NULL,
												  `campo71` varchar(200) DEFAULT NULL,
												  `campo72` varchar(200) DEFAULT NULL,
												  `campo73` varchar(200) DEFAULT NULL,
												  `campo74` varchar(200) DEFAULT NULL,
												  `campo75` varchar(200) DEFAULT NULL,
												  `campo76` varchar(200) DEFAULT NULL,
												  `campo77` varchar(200) DEFAULT NULL,
												  `campo78` varchar(200) DEFAULT NULL,
												  `campo79` varchar(200) DEFAULT NULL,
												  `campo80` varchar(200) DEFAULT NULL,
												  `campo81` varchar(200) DEFAULT NULL,
												  `campo82` varchar(200) DEFAULT NULL,
												  `campo83` varchar(200) DEFAULT NULL,
												  `campo84` varchar(200) DEFAULT NULL,
												  `campo85` varchar(200) DEFAULT NULL,
												  `campo86` varchar(200) DEFAULT NULL,
												  `campo87` varchar(200) DEFAULT NULL,
												  `campo88` varchar(200) DEFAULT NULL,
												  `campo89` varchar(200) DEFAULT NULL,
												  `campo90` varchar(200) DEFAULT NULL

												) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
		return $consultas;
    }
}

<?php 

/**
 * Este Archivo y todos los contenidos en esta aplicación son propiedad
 * exclusiva de FIANZA LDTA, cualquier copia o reproducción del codigo
 * aquí contenido será tomada como una violación a los derechos de autor
 * de la marca anteriormente nombrada y será castigada y denunciada
 * penalmente
 *
 * @author Jose Arrieta <jrarrieta7@misena.edu.co>
 * @version 1.0
 * @copyright (c) 2017, FIANZA LTDA
 * */

include_once '../../vendor/autoload.php';

class modeloInformesCaps extends conexion {

    public function __construct() {
        session_start();
        $this->conexion();
    }

    /**
     * Retorna los datos con las rutas de los archivos del módulo actual
     * @param Array $datos: Contiente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return Array $return: contiene los datos consultados
     */
    public function controlador($datos) {
        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
        $metodo = $datos['metodo'];
        return $this->$metodo($datos);
    }

    /**
     * REVISAR Función que busca los principales resultados de las pruebas
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $array: array con los datos de las pruebas realizadas 
     */

    private function iniciarInformes($datos) {

        $Aprobados = 0;
        $Reprobados = 0;
        $Rcorrectas = 0;
        $query = "SELECT id FROM prueba";
        $consultaPrueba = $this->row($query);
        $query = "SELECT usuario FROM usuarios";
        $consultaUsu = $this->row($query);
        foreach ($consultaPrueba as $res) {
            foreach ($consultaUsu as $key) {
                $query = "SELECT id, estado, intentos,prueba,usuario FROM pruebas_realizadas Where intentos = (SELECT MAX(intentos) FROM pruebas_realizadas WHERE prueba = ".$res['id'] . " AND usuario = '". $key['usuario'] ."') AND prueba = ". $res['id'] . " AND usuario = '". $key['usuario'] . "'";
                $resultado = $this->row($query);
                if (isset($resultado[0]['estado'])) {
                    if ($resultado[0]['estado'] == 1) {
                        $Aprobados++;
                    } elseif($resultado[0]['estado'] == 0){
                        $Reprobados++;
                    }
                }
            }
        }
        $qpruebaR = "SELECT COUNT(U.usuario) AS cantidadU  FROM `capacitacion_usuarios` AS U";
        $pruebasRealizadas = $this->row($qpruebaR);
        $Qusuarios = "SELECT MAX(intentos) AS cantidadP FROM pruebas_realizadas AS Ru GROUP BY prueba,usuario";
        $TUsers = $this->row($Qusuarios);
        $array["SinRealizar"] = $pruebasRealizadas[0]['cantidadU'] - count($TUsers);
        $array["Aprobados"] = $Aprobados;
        $array["Reprobados"] = $Reprobados;
        return $array;
    }




    private function descargarInforme($datos){
        $condicionPrueba = "";
        $condicionAsignado = "";
        if ($datos['chkPrueba'] == "true" && $datos['dato'][0]['value'] != "" && $datos['dato'][1]['value'] != "") {
            $condicionPrueba = " AND pr.fecha >= '" . $datos['dato'][0]['value'] . "' AND pr.fecha <= '" . $datos['dato'][1]['value'] . "'";
        }
        if ($datos['chkAsignar'] == "true" && $datos['dato'][0]['value'] != "" && $datos['dato'][1]['value'] != "") {
            $condicionAsignado = " AND cu.fecha >= '" . $datos['dato'][0]['value'] . "' AND cu.fecha <= '" . $datos['dato'][1]['value'] . "' ";
        }

        if($datos['parametro'] == '3') {
            if($datos['boton'] == "btnDescargar"){
                $hoy = getdate();
                $Rcorrectas = 0;
                $temporalUsu = $this->row("SELECT usuario FROM usuarios WHERE id_usuario = " . $datos['dato'][2]['value']);
                $nombre = "Informe_Usuario " . $temporalUsu[0]['usuario'] . " _" . $hoy['wday'] . "-" . $hoy['mon'] . "-" . $hoy['year'];
                $ruta = "../../public/archivos/descargas/informePruebas/Usuarios/" . $nombre . ".csv";
               
            }else{
                $ruta = "";
            }
            $array = $this->informeUsuario($datos,$condicionPrueba,$condicionAsignado,$ruta);
        }else if ($datos['parametro'] == '1') {
            if($datos['boton'] == "btnDescargar"){
                $hoy = getdate();
                $Rcorrectas = 0;
                $temporalUsu = $this->row("SELECT usuario FROM usuarios WHERE id_usuario = " . $datos['dato'][2]['value']);
                $nombre = "Informe_Capacitador " . $temporalUsu[0]['usuario'] . " _" . $hoy['wday'] . "-" . $hoy['mon'] . "-" . $hoy['year'];
                $ruta = "../../public/archivos/descargas/informePruebas/Capacitador/" . $nombre . ".csv";
               
            }else{
                $ruta = "";
            }
            $array = $this->informeCapacitador($datos,$condicionPrueba,$condicionAsignado,$ruta);
        }else if ($datos['parametro'] == '2') {
            if($datos['boton'] == "btnDescargar"){
                $hoy = getdate();
                $Rcorrectas = 0;
                $nombre = "Informe_TipoCapacitacion " . $vista['prueba_realizada'][0]['tcnombre'] . " _" . $hoy['wday'] . "-" . $hoy['mon'] . "-" . $hoy['year'];
                $ruta = "../../public/archivos/descargas/informePruebas/Capacitacion/" . $nombre . ".csv";
               
            }else{
                $ruta = "";
            }
            $array = $this->informeCapacitacion($datos,$condicionPrueba,$condicionAsignado,$ruta);
        }
               
        return $array;
    }



    public function informeUsuario($datos,$condicionPrueba,$condicionAsignado,$ruta){
        $checks = array('cntIntentosPrueba' => "",
            'tmpPrueba' => "",
            'Preguntas_Respuestas' => "",
            'tmpPregunta' => "",
            'cntIntentosRespuesta' => "",
            'dtlIntentoPregunta' => "");
        $cabeceras = array('Tipo Prueba',"Fecha Asignacion",'Cantidad de intentos','Porcentaje aprobacion','intento','Fecha Realizada','Tiempo Prueba','Resultado prueba','Descripcion','Pregunta','Respuesta usuario','Resultado pregunta','Respuesta correcta','tiempo en la pregunta','Cantidad de movimientos en la respuesta');
        foreach ($datos['dato'] as $key1) {
            foreach ($checks as $key => $value) {                
                if ($key1['name'] == $key) {
                    $checks[$key] = "OK";
                }
            }
        }
        $condicionSlect = ($datos['dato'][3]['value'] == 0)?"":"AND p.id = " . $datos['dato'][3]['value'] . "";
        $query = "SELECT p.id as 'idPrueba', pr.estado as 'aprobo', c.nombre as 'nombre', p.tiempo AS 'tiempoPrueba',p.aprobacion as 'aprobacion', pr.fecha as 'fechaAsignado' FROM pruebas_realizadas pr JOIN prueba p ON pr.prueba = p.id JOIN capacitaciones c ON c.id = p.capacitacion WHERE pr.usuario = " . $datos['dato'][2]['value'] . " $condicionSlect  $condicionPrueba GROUP BY p.id";
        
        $vista['prueba_realizada'] = $this->row($query);
     

        if($datos['boton'] == "btnDescargar"){
            $fp = fopen($ruta, 'w');
            fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
            header('Content-Type: text/html; charset=UTF-8');
            fputcsv($fp, $cabeceras, ';');
        }
        $cont1 = 0;
            foreach ($vista['prueba_realizada'] as $key) {
                $cont2 = 0;
            
                $vista['cantIntentoPrueba'] = $this->row("SELECT MAX(intentos) as 'cantIntentoPrueba' FROM pruebas_realizadas pr WHERE pr.usuario = " . $datos['dato'][2]['value'] . " AND pr.prueba = " . $key['idPrueba']);  
                $cont1++;
                $array[$cont1] = array('Tipo_Prueba' => $key['nombre'],
                    'fecha_asignacion' => $key['fechaAsignado'],
                    'Cantidad de intentos' => $vista['cantIntentoPrueba'][0]['cantIntentoPrueba'],
                    'Porcentaje aprobacion' => $key['aprobacion'],
                    'intento' => '',
                    'fecha_realizada' => '',
                    'Tiempo Prueba' =>'',
                    'Resultado prueba' => '',
                    'Descripcion' => '',
                    'Pregunta' => '',
                    'Respuesta' => '',
                    'Resultado pregunta' => '',
                    'Respuesta correcta' => '',
                    'tiempo en la pregunta' => '',
                    'Cantidad de movimientos en la respuesta' => '');
                if($datos['boton'] == "btnDescargar"){
                    fputcsv($fp, $array[$cont1], ';');
                }
                $query = "SELECT pr.estado as 'aprobo', p.tiempo AS 'tiempoPrueba',pr.id as 'idPruebaRealizada', pr.intentos as 'intento', pr.descripcion as 'des', pr.fecha as 'fecha_realizada' FROM pruebas_realizadas pr JOIN prueba p ON pr.prueba = p.id WHERE pr.usuario = " . $datos['dato'][2]['value'] . " AND p.id = " . $key['idPrueba'];

                $vista['intentos'] = $this->row($query);
                foreach ($vista['intentos'] as $key3) {
                    $cont3 = 0;
                    $key3['aprobo'] = ($key3['aprobo'] == 1)? "Aprobo" : "Reprobo";
                    $cont2++;
                    $array[$cont1][$cont2] = array('Tipo_Prueba' => '',
                        'fecha_asignacion' => '',
                        'Cantidad de intentos' => '',
                        'Porcentaje aprobacion' => '',
                        'intento' => $key3['intento'],
                        'fecha_realizada' => $key3['fecha_realizada'],
                        'Tiempo Prueba' => $key3['tiempoPrueba'],
                        'Resultado prueba' => $key3['aprobo'],
                        'Descripcion' => ($key3['des']),
                        'Pregunta' => '',
                        'Respuesta' => '',
                        'Resultado pregunta' => '',
                        'Respuesta correcta' => '',
                        'tiempo en la pregunta' => '',
                        'Cantidad de movimientos en la respuesta' => '');
                    if($datos['boton'] == "btnDescargar"){
                        fputcsv($fp, $array[$cont1][$cont2], ';');
                    }
                    
                    if ($checks['Preguntas_Respuestas'] == "OK") {
                        $query = "SELECT pg.id as 'idpregunta', pg.pregunta, r.respuesta, ru.respuesta as 'idRespuesta',ru.id as 'idRespuesta2' FROM respuestas_users ru JOIN preguntas pg ON ru.pregunta = pg.id JOIN respuestas r ON r.id = ru.respuesta JOIN pruebas_realizadas pu ON ru.prueba_realizada = pu.id JOIN prueba p ON p.id = pg.prueba WHERE pu.usuario = " . $datos['dato'][2]['value'] . " AND p.id = " . $key['idPrueba'] . " AND ru.prueba_realizada = " . $key3['idPruebaRealizada'];
                        $vista['Preguntas_Respuestas'] = $this->row($query);


                        foreach ($vista['Preguntas_Respuestas'] as $key2) {
                            if ($checks['tmpPregunta'] == "OK") {
                                $query = "SELECT MIN(er.tiempo) as 'tiempoPregunta' FROM estadisticas_respuesta er JOIN respuestas_users ru ON ru.id = er.respuesta_guardada JOIN preguntas pg ON ru.pregunta = pg.id JOIN prueba p ON p.id = pg.prueba JOIN capacitaciones c ON c.id = p.capacitacion JOIN pruebas_realizadas pu ON pu.id = ru.prueba_realizada WHERE pu.usuario = " . $datos['dato'][2]['value'] . " AND p.id = " . $key['idPrueba'] . " GROUP by er.respuesta_guardada";
                                $vista['tiempoPregunta'] = $this->row($query);
                            }
                            if ($checks['cntIntentosRespuesta'] == "OK") {

                                $query = "SELECT COUNT(er.respuesta_guardada) as 'cantIntentoRespuestas' FROM estadisticas_respuesta er JOIN respuestas_users ru ON ru.id = er.respuesta_guardada JOIN preguntas pg ON ru.pregunta = pg.id JOIN prueba p ON p.id = pg.prueba JOIN capacitaciones c ON c.id = p.capacitacion JOIN pruebas_realizadas pu ON pu.id = ru.prueba_realizada WHERE pu.usuario = " . $datos['dato'][2]['value'] . " AND er.respuesta_guardada = ".$key2['idRespuesta2']." AND p.id = " . $key['idPrueba'] . " GROUP by er.respuesta_guardada";
                                $vista['cantIntentoRespuestas'] = $this->row($query);
                            }
                            if ($checks['dtlIntentoPregunta'] == "OK") {

                                // queda igual 
                                $vista['detIntentoRespuestas'] = $this->row("SELECT er.respuesta_guardada,er.respuesta,er.tiempo FROM estadisticas_respuesta er JOIN respuestas_users ru ON ru.id = er.respuesta_guardada JOIN preguntas pg ON ru.pregunta = pg.id JOIN prueba p ON p.id = pg.prueba JOIN capacitaciones c ON c.id = p.capacitacion JOIN pruebas_realizadas pu ON pu.id = ru.prueba_realizada WHERE pu.usuario = " . $datos['dato'][2]['value'] . " AND c.id = " . $key['idPrueba']);
                            } 
                            $vista['respuestaCorrecta'] = $this->row("SELECT r.respuesta FROM `respuestas` r WHERE r.respuesta_correcta = 1 AND r.pregunta = " . $key2['idpregunta']);
                            $cont3++;
                            $query = "SELECT max(tiempo) as 'tiempoPREspuesta' FROM estadisticas_respuesta WHERE respuesta_guardada = " . $key2['idRespuesta2'];
                            $vista['tiempoPreguntaR'] = $this->row($query);
                            $array[$cont1][$cont2][$cont3] = array('Tipo_Prueba'=> '',
                                'fecha_asignacion' => '',
                                'Cantidad de intentos'=> '',
                                'Porcentaje aprobacion' => '',
                                'intento'=> '',
                                'fecha_realizada' => '',
                                'Tiempo Prueba'=> '',
                                'Resultado prueba'=> '',
                                'Descripcion' => '',
                                'Pregunta'=> ($key2['pregunta']),
                                'Respuesta'=> ($key2['respuesta']),
                                'Resultado pregunta'=> ($vista['respuestaCorrecta'][0]['respuesta'] == $key2['respuesta'])? "acierto":"desacierto",
                                'Respuesta correcta' => ($vista['respuestaCorrecta'][0]['respuesta']),
                                'tiempo en la pregunta'=> $vista['tiempoPreguntaR'][0]['tiempoPREspuesta'],
                                'Cantidad de movimientos en la respuesta'=> $vista['cantIntentoRespuestas'][0]['cantIntentoRespuestas']);     
                            if($datos['boton'] == "btnDescargar"){
                                fputcsv($fp, $array[$cont1][$cont2][$cont3], ';');
                            }
                        }
                    }
                }
            }
            if (isset($array)) {
                if($datos['boton'] == "btnDescargar"){
                    fclose($fp);
                    $retorno = $ruta;
                }else{
                    $retorno = $array;
                }                
            }else{
                $retorno = "error";
            } 
            return $retorno;
    }

    public function informeCapacitador($datos,$condicionPrueba,$condicionAsignado,$ruta){
        $checks = array('promResultadorUsu' => "",
            'promNorealizadoUsu' => "",
            'cntAsignadoUsu' => "",
            'promAprovacionPr' => "",
            'promIntentosPr' => "",
            'promTiempoPr'=>"",
            'promTiempoPg' => "");
        $cabeceras = array('Tipo Prueba','Cantidad de usuarios asignados','Cantidad de usuarios que aprobaron','Cantidad de usuarios que reprobaron','Cantidad de usuarios que no han realizado','Promedio de intentos de prueba');
        foreach ($datos['dato'] as $key1) {
            foreach ($checks as $key => $value) {                
                if ($key1['name'] == $key) {
                    $checks[$key] = "OK";
                }
            }
        }
        $condicionSelect = ($datos['dato'][3]['value'] == 0)? "" : "AND p.id = " . $datos['dato'][3]['value'] ."";

        $query = "SELECT p.id as 'idPrueba', c.nombre as 'nombre' FROM tipocapacitacion_usuarios tcu JOIN tipo_capacitaciones tc ON tc.id = tcu.tipo_capacitacion JOIN capacitaciones c ON tc.id = c.id_tipo_capacitacion join prueba p ON p.capacitacion = c.id WHERE tcu.usuario =  " . $datos['dato'][2]['value'] . " $condicionSelect";

        $vista['prueba_realizada'] = $this->row($query);
        if($datos['boton'] == "btnDescargar"){
            $fp = fopen($ruta, 'w');
            fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
            header('Content-Type: text/html; charset=UTF-8');
            fputcsv($fp, $cabeceras, ';');
        }
        $cont=0;
        foreach ($vista['prueba_realizada'] as $key) {
            $query = "SELECT u.id_usuario as 'nombre' FROM capacitacion_usuarios cu JOIN usuarios u ON u.id_usuario = cu.usuario JOIN prueba p ON p.capacitacion = cu.capacitacion WHERE p.id = " . $key['idPrueba'] . " $condicionAsignado AND cu.capacitador = " . $datos['dato'][2]['value'];
            $vista['usariosCapacitados'] = $this->row($query); 
            $vista['cantUsuariosAprobados'] = 0;
            $vista['cantUsuariosReprobados'] = 0;
            $vista['cantUsuariosNorealizados'] = 0;
            $vista['sumaIntentos'] = 0;
            
            foreach ($vista['usariosCapacitados'] as $key1) {


                $query = "SELECT pr.usuario,pr.estado,pr.intentos  FROM pruebas_realizadas pr WHERE intentos = (SELECT MAX(intentos) FROM pruebas_realizadas pr WHERE pr.prueba = " . $key['idPrueba'] . " AND pr.usuario = '" .$key1['nombre'] . "')  AND pr.prueba = " . $key['idPrueba'] . " AND pr.usuario = '" .$key1['nombre'] . "'";



                $temporal = $this->row($query);
                if (!isset($temporal[0]['estado'])) {
                    $vista['cantUsuariosNorealizados']++;
                }else if($temporal[0]['estado'] == 1) {
                    $vista['cantUsuariosAprobados']++;
                }else if($temporal[0]['estado'] == 0) {
                    $vista['cantUsuariosReprobados']++;
                }
                if (isset($temporal[0]['intentos'])) {
                    $vista['sumaIntentos'] = $vista['sumaIntentos'] + $temporal[0]['intentos'];
                }
            }
            $divisionIntentos = ((count($vista['usariosCapacitados'])-$vista['cantUsuariosNorealizados']) == 0)? 0 :  $vista['sumaIntentos']/(count($vista['usariosCapacitados'])-$vista['cantUsuariosNorealizados']);
            $array[$cont] = array('Tipo_Prueba' => $key['nombre'],
                'Cantidad de usuarios asignados' => count($vista['usariosCapacitados']),
                'Promedio de usuarios que aprobaron' => $vista['cantUsuariosAprobados'],
                'Promedio de usuarios que reprobaron' => $vista['cantUsuariosReprobados'],
                'Promedio de usuarios que sin realizado' => $vista['cantUsuariosNorealizados'],
                'Promedio de intentos de prueba' =>  round($divisionIntentos) . " intentos en promedio",
                'Promedio de tiempo de Prueba' => "",
                'Promedio de tiempo por pregunta' => "");
            if($datos['boton'] == "btnDescargar"){
                fputcsv($fp, $array[$cont], ';');
            }
            $cont++;
        }   
        if (isset($array)) {
                if($datos['boton'] == "btnDescargar"){
                    fclose($fp);
                    $retorno = $ruta;
                }else{
                    $retorno = $array;
                }                
            }else{
                $retorno = "error";
            } 
        return $retorno;
    }

    public function informeCapacitacion($datos,$condicionPrueba,$condicionAsignado,$ruta){
        $checks = array(
            'promResultadorUsu' => "",
            'promNorealizadoUsu' => "",
            'cntAsignadoUsu' => "",
            'promAprovacionPr' => "",
            'promIntentosPr' => "",
            'promTiempoPr'=>"",
            'promTiempoPg' => "");

        $cabeceras = array('Tipo Prueba','Numero de preguntas','Total de pruebas realizadas','Cantidad de usuarios asignados','Cantidad de usuarios que aprobaron','Cantidad de usuarios que reprobaron','Cantidad de usuarios que no han realizado','Promedio de intentos por prueba','Maximo de intentos','Minimo de intentos');
        foreach ($datos['dato'] as $key1) {
            foreach ($checks as $key => $value) {                
                if ($key1['name'] == $key) {
                    $checks[$key] = "OK";
                }
            }
        }
        $condicionSelect = ($datos['dato'][3]['value'] == 0)? "tc.id = " . $datos['dato'][2]['value'] . "": "c.id = " . $datos['dato'][3]['value']. "";
        $query = "SELECT p.id as 'idPrueba', c.nombre as 'nombre', tc.nombre as 'tcnombre' FROM tipocapacitacion_usuarios tcu JOIN tipo_capacitaciones tc ON tc.id = tcu.tipo_capacitacion JOIN capacitaciones c ON tc.id = c.id_tipo_capacitacion join prueba p On p.capacitacion = c.id WHERE $condicionSelect";



        $vista['prueba_realizada'] = $this->row($query);
        if($datos['boton'] == "btnDescargar"){
            $fp = fopen($ruta, 'w');
            fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
            header('Content-Type: text/html; charset=UTF-8');
            fputcsv($fp, $cabeceras, ';');
        }
        $cont=0;
        foreach ($vista['prueba_realizada'] as $key) {
            $vista['Npreguntas'] = count($this->row("SELECT pg.id FROM preguntas pg WHERE pg.prueba = " . $key['idPrueba']));
           

            $vista['NpruebaRealizadas'] = count($this->row("SELECT pr.id FROM pruebas_realizadas pr WHERE pr.prueba = " . $key['idPrueba'] . " $condicionPrueba"));

            $vista['usariosCapacitados'] = $this->row("SELECT u.id_usuario as 'nombre' FROM capacitacion_usuarios cu JOIN usuarios u ON u.id_usuario = cu.usuario JOIN prueba p ON p.capacitacion = cu.capacitacion WHERE p.id = " . $key['idPrueba'] . " $condicionAsignado "); 
            $vista['maxIntento'] = $this->row("SELECT MAX(pr.intentos) as 'maximo' FROM pruebas_realizadas pr WHERE pr.prueba = " . $key['idPrueba'] . " $condicionPrueba");
            $vista['minIntento'] = 999999;
            $vista['cantUsuariosAprobados'] = 0;
            $vista['cantUsuariosReprobados'] = 0;
            $vista['cantUsuariosNorealizados'] = 0;
            $vista['sumaIntentos'] = 0;
            foreach ($vista['usariosCapacitados'] as $key1) {
                $query = "SELECT pr.usuario,pr.estado,pr.intentos  FROM pruebas_realizadas pr WHERE intentos = (SELECT MAX(intentos) FROM pruebas_realizadas pr WHERE pr.prueba = " . $key['idPrueba'] . " AND pr.usuario = " .$key1['nombre'] . ") AND pr.prueba = " . $key['idPrueba'] . " AND pr.usuario = '" .$key1['nombre'] . "' $condicionPrueba ";

                $temporal = $this->row($query);
                if (isset($temporal[0]['intentos']) && ($vista['minIntento'] > $temporal[0]['intentos'])) {
                    $vista['minIntento'] = $temporal[0]['intentos'];
                }
                if (!isset($temporal[0]['estado'])) {
                    $vista['cantUsuariosNorealizados']++;
                }else if($temporal[0]['estado'] == 1) {
                    $vista['cantUsuariosAprobados']++;
                }else if($temporal[0]['estado'] == 0) {
                    $vista['cantUsuariosReprobados']++;
                }
                if (isset($temporal[0]['intentos'])) {
                    $vista['sumaIntentos'] = $vista['sumaIntentos'] + $temporal[0]['intentos'];
                }
            }
            $divisionIntentos = ((count($vista['usariosCapacitados'])-$vista['cantUsuariosNorealizados']) == 0)? 0 :  $vista['sumaIntentos']/(count($vista['usariosCapacitados'])-$vista['cantUsuariosNorealizados']);
            $array[$cont] = array(
                'Tipo_Prueba' => $key['nombre'],
                'Numero de preguntas' => $vista['Npreguntas'],
                'Total de pruebas realizadas' => $vista['NpruebaRealizadas'],
                'Cantidad de usuarios asignados' => count($vista['usariosCapacitados']),
                'Promedio de usuarios que aprobaron' => $vista['cantUsuariosAprobados'],
                'Promedio de usuarios que reprobaron' =>  $vista['cantUsuariosReprobados'],
                'Promedio de usuarios que sin realizado' => $vista['cantUsuariosNorealizados'],
                'Promedio de intentos de prueba' => round($divisionIntentos),
                'maximo de intentos' => $vista['maxIntento'][0]['maximo'],
                'minimo de intentos' => $vista['minIntento']);
            if($datos['boton'] == "btnDescargar"){
                fputcsv($fp, $array[$cont], ';');
            }           
            $cont++;
        }
        if (isset($array)) {
            if($datos['boton'] == "btnDescargar"){
                fclose($fp);
                $retorno = $ruta;
            }else{
                $retorno = $array;
            }                
        }else{
            $retorno = "error";
        } 
        return $retorno;
    }













    //NEW K - L
    private function informesCaps($datos){
        if (isset($datos['parametro'])) {
            if (isset($datos['dataselect'])) {
                $query = "SELECT u.nombre_completo as 'nombre', u.id_usuario as 'id' FROM `capacitacion_usuarios` cu JOIN usuarios u ON cu.usuario = u.id_usuario GROUP by id_usuario";
            }else if($datos['parametro'] == '3'){
                $query = 'SELECT  p.id, c.nombre FROM prueba p INNER JOIN capacitaciones c on p.capacitacion = c.id JOIN capacitacion_usuarios cu ON cu.capacitacion = c.id WHERE cu.usuario = ' . $datos['dataselect1'];
            }else if($datos['parametro'] == '1'){
                $query = 'SELECT  p.id, c.nombre FROM prueba p INNER JOIN capacitaciones c on p.capacitacion = c.id join tipo_capacitaciones tc ON tc.id = c.id_tipo_capacitacion join tipocapacitacion_usuarios tcu ON tcu.tipo_capacitacion = tc.id WHERE tcu.usuario = ' . $datos['dataselect1'];
            }else if($datos['parametro'] == '2'){
                $query = 'SELECT  p.id, c.nombre FROM prueba p INNER JOIN capacitaciones c on p.capacitacion = c.id join tipo_capacitaciones tc ON tc.id = c.id_tipo_capacitacion join tipocapacitacion_usuarios tcu ON tcu.tipo_capacitacion = tc.id WHERE tc.id = ' . $datos['dataselect1'];
            }
        }elseif($datos['dataselect'] == '1'){
            $query = "SELECT usu.nombre_completo as 'nombre', usu.id_usuario as 'id' FROM `roles_usuarios` r_usu INNER JOIN usuarios usu ON usu.id_usuario = r_usu.id_usuario WHERE r_usu.id_cliente = 10 AND (id_rol = 7 OR id_rol = 1 )";
        }elseif($datos['dataselect'] == '2'){
            $query = "SELECT nombre,id FROM tipo_capacitaciones";
        }elseif($datos['dataselect'] == '3'){
            $queryRol = ($_SESSION['rol_actual'] != '1')? " WHERE cu.capacitador = " . $_SESSION['id_usuario'] . " ":"" ;
            $query = "SELECT u.nombre_completo as 'nombre', u.id_usuario as 'id' FROM `capacitacion_usuarios` cu JOIN usuarios u ON cu.usuario = u.id_usuario $queryRol GROUP by id_usuario";
        }       
        return $this->row($query);
    }   
}

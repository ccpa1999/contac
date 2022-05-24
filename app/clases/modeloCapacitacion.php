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

class modeloCapacitacion extends conexion {

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
     * Función que guarda en un arreglo los tipos de capacitacion
     * @param Array $datos: Contiente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return Array $return: contiene los datos consultados
     */
// Cambios capacitacion KAYA - LUIS

    private function paginaInicio() {
        $resultado['tipo_capacitacion'] = $this->obtenerTiposCapacitacionUsuario();
        $resultado['capacitaciones'] = $this->obtenerCapacitacionUsuario();
        $_SESSION['hist_capacitacion'] = $this->obtenerHistoricoCapacitacion();
        $_SESSION['tipo_capacitacion'] = $resultado['tipo_capacitacion'];
        $_SESSION['capacitaciones'] = $resultado['capacitaciones'];        
        return $resultado;
    }

    private function obtenerTiposCapacitaciones(){
        $query = "SELECT * FROM tipo_capacitaciones";
        $return = $this->row($query);
        return $return;
    }

    /**
     * Función que trae los tipos de capacitacion de los usuarios dependiendo su rol
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $TipoCapacitaciones: devuelve los tipos de capacitaciones del usuario
    */

    private function obtenerTiposCapacitacionUsuario() {        
        $query = "SELECT t.* FROM tipo_capacitaciones t";
        switch ($_SESSION['rol_actual']) {
            case '1':
                break;
            case '7':
                $query .= " inner join tipocapacitacion_usuarios tu on t.id = tu.tipo_capacitacion WHERE tu.usuario = ". $_SESSION["id_usuario"];
                break;          
            default:
                $capacitacion = $this->obtenerCapacitacionUsuario();
                $query .= " WHERE ";
                $contador = 0;
                foreach ($capacitacion as $id) {
                    $query .= " t.id = ". $id["id_tipo_capacitacion"];
                    if ($contador < (count($capacitacion)-1)) {
                        $query .= " or";
                    }
                    $contador++;
                }                
                break;         
        }     
        $TipoCapacitaciones = $this->row($query);
        return $TipoCapacitaciones;
    }

    /**
     * Función que trae las capacitaciones de los usuarios dependiendo su rol
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $Capacitaciones: devuelve las capacitaciones del usuario
    */

    private function obtenerCapacitacionUsuario() {
        $query = "SELECT c.* FROM capacitaciones c";
        switch ($_SESSION['rol_actual']) {
            case '1':
                break;
            case '7':
                $tipo_capacitacion = $this->obtenerTiposCapacitacionUsuario();
                $query .= " WHERE c.id_tipo_capacitacion = ". $tipo_capacitacion[0]["id"];
                break;          
            default:
                $query .= " inner join capacitacion_usuarios tu on c.id = tu.capacitacion WHERE tu.usuario = ". $_SESSION["id_usuario"];
                break;          
        }
        $Capacitaciones = $this->row($query);
        return $Capacitaciones;
    }

    /**
     * Función que trae las capacitaciones y tipo de capacitaciones del usuario en session
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $Capacitaciones: devuelve las capacitaciones del usuario
    */

    private function obtenerPruebaUsuario($datos){
        $return['Capacitaciones'] = $_SESSION['capacitaciones'];
        $return['TipoCapacitaciones'] = $_SESSION['tipo_capacitacion'];
        return $return;
    }

    private function obtenerHistoricoCapacitacion() {
        $query = "SELECT h.* FROM historico_capacitacion h WHERE usuario = '" . $_SESSION['usuario'] . "'";
        $Capacitaciones = $this->row($query);
        return $Capacitaciones;
    }

     /**
     * Funcion que guarda en el historico gestion de cuando leyeron las capacitaciones
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $retorno: Devulve un texto con la finalizacion del proceso
    */ 

    private function insertarHistorico($datos) {
        $retorno = "";
        $temp = 0;
        $clave = md5($datos["clave"]);
        $query = "SELECT * FROM `usuarios` WHERE usuario = '" . $_SESSION['usuario'] . "' and password = '" . $clave . "'";
        $resultado = $this->row($query);
        if (empty($resultado)) {
            $retorno = "Contraseña errónea";
        } else {
            foreach ($datos as $key => $value) {
                $arrayDatos[$key] = $value;
                $largo = strlen($key);
                if (substr($key, 0, 10) == "completado") {
                    $Completados[$temp] = $value;
                    $temp++;
                }
            }
            for ($i = 0; $i < count($Completados); $i++) {
                $query = "INSERT INTO `historico_capacitacion`( `usuario`,tipo_capacitacion, `id_capacitacion`, `fecha_capacitacion`) VALUES (" . "'" . $_SESSION['usuario'] . "'" . "," . $arrayDatos["tipo_capacitacion"] . "," . $Completados[$i] . ",CURRENT_DATE)";
                $this->ejecutar2($query);
            }
            $retorno = "Gestion Guardada";
        }
        return $retorno;
    }

     /**
     * Funcion que busca los tipos de capacitacion que tiene el usuario 
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $retorno: Devuelve un array con los tipo de capacitaciones que tiene el usuario
    */ 

    private function gestionTipoCapacitacion() {
        $retorno = array("tiposCap");
        $retorno["tiposCap"] = $_SESSION['tipo_capacitacion'];
        return $retorno;
    }

    /**
     * Funcion que guarda en tipo_capacitaciones el nuevo capacitador
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $return: Devuelve un OK si se ingreso correctamente y vacio  si no
    */ 

    private function guardarTipo($datos) { 
        $return = "";
        $query = "INSERT INTO `tipo_capacitaciones` (`nombre`, `imagen_capacitacion`, `descripcion`, `estado`) VALUES ('".$datos['nombreTipo']."', '".$datos['ruta']."','".$datos['descripcionTipo']."','1')";
        if ($this->ejecutar2($query) > 0) {
            $return = "ok";                  
        }
        return $return;
    }

    /**
     * Función que guarda en la tabla capacitacion_usuarios e inserta la capacitación
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $return: devuelve SI inserto correctamente los usuarios
    */

    private function guardarAsignarCapacitacion($datos) {        
        $capacitaciones = explode(',', $datos['dataC'],-1);
        $usuarios = explode(',', $datos['dataU'],-1);
        $contador = 0; 
        $return = "";
        $query = "INSERT INTO `capacitacion_usuarios` (`capacitacion`, `usuario`, `capacitador`, `estado`, `habilitado`,`fecha`) VALUES ";
        foreach ($capacitaciones as $modulo) {
            foreach ($usuarios as $usuario) {

                $query .= "('".$modulo."' , '".$usuario."', '".$_SESSION['id_usuario']."' , '1' , '1',NOW())";
                if ($contador < ((count($capacitaciones)*count($usuarios))-1)) {
                    $query .= ",";
                }else{
                    $query .= ";";
                }
                $contador++;
            }
        }      
        if ($this->ejecutar2($query) > 0) {
            $return = "ok";                  
        }
        return $return;
    }

    /**
     * Función que guarda en la tabla capacitacion_usuarios y le agraga habilitado 1
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $return: devuelve SI habilito correctamente los usuarios
    */

    private function guardarHabilitarUsuarios($datos){
        $capacitaciones = explode(',', $datos['dataC'],-1);
        $contador = 0; 
        $return = "ok";        
        foreach ($capacitaciones as $modulo) {
            $query = "UPDATE `capacitacion_usuarios` set `habilitado` = 1 WHERE id = $modulo";
            if ($this->ejecutar2($query) == 0) {
                $return = "";                  
            }
        }              
        return $return;
    }

    /**
     * Función que guarda en la tabla pruebas_realizadas y le agraga la descripcion y estado 0
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $return: devuelve SI bloqueeo correctamente los usuarios
    */

    private function guardarBloquearExamen($datos){
        $capacitaciones = explode(',', $datos['capa']);
        $return = "ok";        
        $descripcion=($datos['descripcionOtro'] == '')? $datos['descripcion']: $datos['descripcionOtro'];
        foreach ($capacitaciones as $modulo) {
            if ($modulo != "") {
               $query = "UPDATE `pruebas_realizadas` set `estado` = 0,`descripcion` = '".$descripcion."' WHERE id = $modulo";
                if ($this->ejecutar2($query) == 0) {
                    $return = "";                  
                }
            }            
        }              
        return $return;
    }    

    /**
     * Funcion busca los tipos de capacitaciones del usuario
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $retorno: Devuelve un array los tipos de capacitacion de los usuarios
    */ 

    private function gestionarCapacitaciones($datos) {
        $retorno = array("tiposCapU", "todasCap");
        $retorno["todasCap"] = $this->obtenerTiposCapacitaciones();
        $retorno["tiposCapU"] = $_SESSION['tipo_capacitacion'];
        return $retorno;
    }

    /**
     * Funcion que obtiene las capacitaciones de un tipo capacitación especifico
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $resultado: Devuelve un array con las capacitaciones de un tipo de capacitación especifico
    */ 

    private function obtenerCapacitaciones($datos) {
        $query = "SELECT * FROM capacitaciones WHERE id_tipo_capacitacion =" . $datos['id'];
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * Funcion que obtiene los tipos de capacitacion de los usuarios
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array: Devuelve un array con los tipos de capacitación de los usuarios
    */ 

    private function certificacionesUsuarios($datos){
        $query = "SELECT tu.id,tu.ruta_certificacion, t.nombre from tipocapacitacion_usuarios tu JOIN tipo_capacitaciones t ON t.id = tu.tipo_capacitacion where tu.usuario = ".$datos['id'];
        return $this->row($query);
    }

    /**
     * Funcion que obtiene los roles de los usuarios
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $return: Devuelve un array con los datos de los usuarios
    */ 

    private function administracionUsuarios() {
        $query = "SELECT u.* FROM usuarios u INNER JOIN roles_usuarios ru on ru.id_usuario = u.id_usuario WHERE ru.id_cliente = 10 AND id_rol = 7";
        $return = $this->row($query);        
        return $return;
    }

    /**
     * Funcion que obtiene las capacitaciones de un usuario especifico
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $return: Devuelve un array con las capacitaciones de un usuario especifico
    */ 

    private function obtenerCapacitacionesUsuario($datos) {  
        $return = Array("capacitaciones" => array(), "capUsuario" => array(), "idUser" => $datos["idUsuario"]);
        $query = "SELECT tc.* FROM "
                . "tipocapacitacion_usuarios cu INNER JOIN tipo_capacitaciones tc ON cu.tipo_capacitacion"
                . " = tc.id WHERE cu.usuario = " . $datos["idUsuario"];
        $return["capUsuario"] = $this->row($query);
        $return["capacitaciones"] = $this->obtenerTiposCapacitaciones();
        return $return;
    }

    /**
     * Funcion que inserta en capacitaciones los datos de una nueva capacitación
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $return: con un mensaje de si se hizo o no correctamente
    */ 

    private function insertarCapacitacion($datos) {
        $return = array();
        $rutaArchivo = substr($datos["ruta"], 32, strlen($datos["ruta"]));
        $query = "INSERT INTO `capacitaciones`( `nombre`, `tipo`, `ruta`, "
                . "`id_tipo_capacitacion`) VALUES ('" . $datos["nombreCapacitacion"]
                . "','" . strtoupper($datos["tipoArchivo"]) . "','" . $rutaArchivo . "'," . $datos["tipoCap"] . ")";
        $resultado = $this->ejecutar2($query);
        if ($resultado < 1) {
            $return["resultado"] = "fallo";
            $return["mensaje"] = "El archivo no se cargo correctamente";
        } else {
            $return["resultado"] = "ok";
            $return["mensaje"] = "El archivo se cargo correctamnete";
        }
        return $return;
    }

    /**
     * Consulta de capacitaciones que puede asignar un capacitador a un usuario 
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $resultado: array con usuarios y capacitaciones para asignar
    */

    private function asignarCapacitaciones($datos){
        $resultado['capacitaciones'] = $this->obtenerCapacitaciones($datos);
        $query = "SELECT * FROM usuarios WHERE usuario != '" . $_SESSION['usuario'] . "'";
        $resultado['usuarios'] = $this->row($query);
        return $resultado;
    }

    /**
     * Consulta de capacitaciones de un usuario que ha realizado la prueba
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $dato: array con usuarios[id_usuario, usuario] y las 
     * pruebas [idcapacitacio,idpruebarealizada, nombrecapacitacion] que ya ha realizado 
    */

    private function habilitarUsuario($datos){        
        $query = "SELECT cap_u.id, us.usuario, us.id_usuario, cap.nombre, capacitacion FROM capacitacion_usuarios cap_u INNER JOIN capacitaciones cap ON cap_u.capacitacion = cap.id INNER JOIN usuarios us ON cap_u.usuario = us.id_usuario WHERE habilitado = 0 and cap.id_tipo_capacitacion = ".$datos['id'];
        $resultado = $this->row($query);
        $cont=0;
        foreach ($resultado as $data) {
             $dato['capacitaciones'][$cont]['id_cap_usuario'] = $data['id'];
             $dato['capacitaciones'][$cont]['id_capacitacion'] = $data['capacitacion'];
             $dato['capacitaciones'][$cont]['capacitacion'] = $data['nombre'];
             $dato['usuarios'][$cont]['id_usuario'] = $data['id_usuario'];
             $dato['usuarios'][$cont]['usuario'] = $data['usuario'];
             $cont++;
        }
        return $dato;
    }

    /**
     * Consulta de capacitaciones de un usuario que ha realizado la prueba y se deseea bloquear
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $dato: array con usuarios[usuario] y las pruebas [idpruebarealizada, 
     * nombrecapacitacion] que ya ha realizado  y se pueden bloquear
    */

    private function bloquearExamen($datos){
        $query = "SELECT u.usuario, c.nombre, MAX(pr.id) as 'id' FROM capacitaciones c INNER JOIN prueba p ON p.capacitacion = c.id INNER JOIN pruebas_realizadas pr ON p.id = pr.prueba JOIN usuarios u ON u.id_usuario = pr.usuario WHERE c.id_tipo_capacitacion = ".$datos['id']." GROUP BY c.nombre, u.usuario";
        $resultado = $this->row($query);
        $cont=0;
        foreach ($resultado as $data) {
             $dato['capacitaciones'][$cont]['id_cap_usuario'] = $data['id'];
             $dato['capacitaciones'][$cont]['capacitacion'] = $data['nombre'];
             $dato['usuarios'][$cont]['usuario'] = $data['usuario'];
             $cont++;
        }
        return $dato;
    }

    /**
     * Funcion que le guarda las capacitaciones asignadas a un capacitador
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String: Devuelve un ok si se realizo correctamente y fallo si paso algo
    */ 
    
    private function actualizarUsuario($datos){
        $arrayCap = array();
        $allCap = $this->obtenerTiposCapacitaciones();
        foreach ($allCap as $value) {
            $this->ejecutar2("DELETE FROM `tipocapacitacion_usuarios` WHERE usuario = " . $datos["idUsuario"] . " AND tipo_capacitacion = " . $value["id"]);
        }
        foreach ($datos as $key => $value) {
            $cont=0;
            if(substr($key,0,3) == "cap"){
                $ruta = "../../public/archivos/descargas/certificado_capacitador/certificado ".$datos['idUsuario']." - ".$value.".pdf";
                $datos['ruta']=$ruta;
                
                move_uploaded_file($_FILES['archivo'.$value]['tmp_name'], "../../public/images/".$ruta);

                $query = "INSERT INTO tipocapacitacion_usuarios (tipo_capacitacion, usuario, estado, ruta_certificacion) VALUES ('".$value."','".$datos['idUsuario']."','1','".$datos['ruta']."')";
                $resultado = $this->ejecutar2($query);
                if ($resultado != 1) {
                   $cont++;
                }
            }
        }
        if ($cont > 0) {
            return "fallo";
        }else{
            return "ok";
        }
    }


    private function inicioPreguntas() { 
        return $_SESSION['tipo_capacitacion'];
    }

     /**
     * Funcion que busca las preguntas y respuestas de la prueba
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $return: Devulve un array con los datos de la prueba, preguntas y respuestas
    */ 


    private function obtenerPreguntasRespuestas($datos) {
        $contador = 0;
        $cont=0;
        $preguntasResp = array("preguntas" => array(), "respuestas" => array(), "cantidadPreguntas", "nombreCapacitacion", "respuestasCorrectas" => array(), "TipoCapacitacion", "prueba");
        $preguntasResp["cantidadPreguntas"] = 0;
        if ($datos["obtencion"] == "gestion") {
            $preguntasResp["prueba"] = $this->obtenerPrueba($datos);
            $preguntasResp["TipoCapacitacion"] = $datos["tipoCap"];
            if (!empty($preguntasResp["prueba"])) {
                if ($datos["obtencion"] == "gestion") {
                    $query = "SELECT * FROM `preguntas` WHERE `prueba` = " . $preguntasResp["prueba"][0]['id'];
                    $query2 = "SELECT count(*) as cantidadPreguntas FROM `preguntas` WHERE `prueba` = " . $preguntasResp["prueba"][0]['id'];
                } else {
                    $query = "SELECT * FROM `preguntas` WHERE `prueba` = " . $preguntasResp["prueba"][0]['id'] . " AND estado = 1";
                    $query2 = "SELECT  count(*) as cantidadPreguntas FROM `preguntas` WHERE `prueba` = " . $preguntasResp["prueba"][0]['id'] . " AND estado = 1";
                }
                $preguntasResp["preguntas"] = $this->row($query);                
                $preguntasResp["cantidadPreguntas"] = (isset($preguntasResp["prueba"][0]['cantidad_preguntas']))? $preguntasResp["prueba"][0]['cantidad_preguntas'] : $this->row($query2);
                $preguntasResp["preguntas"];
                if ($preguntasResp['cantidadPreguntas'] != 0) {
                    foreach ($preguntasResp["preguntas"] as $item) {
                        if ($datos["obtencion"] != "gestion") {
                            $query2 = "SELECT * FROM `respuestas` WHERE pregunta = " . $item["id"] . " AND estado = 1";
                        } else {
                            $query2 = "SELECT * FROM `respuestas` WHERE pregunta = " . $item["id"];
                        }
                        $preguntasResp["respuestas"][$contador] = $this->row($query2);
                        $contador++;
                    }
                }            
            }
            $return[$cont++] = $preguntasResp;
        }else{
            foreach ($datos["tipoCap"] as $key) { 
                $datos['cap'] = $datos["tipoCap"];
                $datos["tipoCap"] = $key;
                $preguntasResp["prueba"] = $this->obtenerPrueba($datos);
                $preguntasResp["TipoCapacitacion"] = $datos["tipoCap"];
                if (!empty($preguntasResp["prueba"])) {
                    if ($datos["obtencion"] == "gestion") {
                        $query = "SELECT * FROM `preguntas` WHERE `prueba` = " . $preguntasResp["prueba"][0]['id'];
                    } else {
                        $query = "SELECT * FROM `preguntas` WHERE `prueba` = " . $preguntasResp["prueba"][0]['id'] . " AND estado = 1";
                    }
                    $preguntasResp["preguntas"] = $this->row($query);
                    $preguntasResp["cantidadPreguntas"] = $preguntasResp["prueba"][0]['cantidad_preguntas'];
                    shuffle($preguntasResp["preguntas"]);
                    if ($preguntasResp['cantidadPreguntas'] != 0) {
                        $contador = 0;
                        foreach ($preguntasResp["preguntas"] as $item) {
                            if ($datos["obtencion"] != "gestion") {
                                $query2 = "SELECT * FROM `respuestas` WHERE pregunta = " . $item["id"] . " AND estado = 1";
                            } else {
                                $query2 = "SELECT * FROM `respuestas` WHERE pregunta = " . $item["id"];
                            }
                            $preguntasResp["respuestas"][$contador] = $this->row($query2);
                            shuffle($preguntasResp["respuestas"][$contador]);
                            $contador++;
                        }
                    }            
                }
                $return[$cont++] = $preguntasResp;
                $datos["tipoCap"] = $datos['cap'];
            }
        }   
        return $return;
    }

    /**
     * Funcion que guarda las respuestas de una prueba 
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $data['capacitacion']: Devuelve un array los datos de la capacitacion modificada
    */ 

    private function guardarRespuestas($data) {
      // ---------------------------------------
      // Insertar y modificar de la tabla prueba dependiendo de si ya esta creado o no INICIO
        $query = "SELECT * FROM prueba WHERE capacitacion ='".$data['Capacitacion']."'";
        $resultPrueba = $this->row($query);
        if($resultPrueba[0] != NULL) {
          $query = "UPDATE `prueba` SET `aprobacion`= ".$data['rangoAprobacion'].",`tiempo`='".$data['tiempoPrueba']."',`cantidad_preguntas`=".$data['cantidadCheck']." WHERE capacitacion = ".$data['Capacitacion'];
          $this->ejecutar2($query);
        }else{
          $query = "INSERT INTO prueba (aprobacion,tiempo,cantidad_preguntas,capacitacion,terminos) VALUES ('".$data['rangoAprobacion']."', '".$data['tiempoPrueba']."', " . $data['cantidadCheck'] . ", '".$data['Capacitacion']."', 'Declaro que comprendo cada una de las políticas aquí consignadas y reconozco que el incumplimiento parcial o total de las mismas será considerado como una falta grave')";
          echo "variable r " . $r;
          $this->ejecutar2($query);
        }
        $query = "UPDATE preguntas as pr inner join prueba as p on pr.prueba=p.id  set estado = 0 WHERE p.capacitacion = ".$data['Capacitacion'];
        $this->ejecutar2($query);
        $query = "UPDATE respuestas r join preguntas as pr on r.pregunta = pr.id inner join prueba as p on pr.prueba=p.id set respuesta_correcta = 0 WHERE p.capacitacion = ".$data['Capacitacion'];
        $this->ejecutar2($query);
        foreach ($data as $llave => $valor) {
            if (substr($llave, 0, 6) == "select") {
                $pregunta = substr($llave, 6);
                $query = "UPDATE `respuestas` SET `respuesta_correcta`= 1 WHERE `id` =" . $valor;
                $resultado = $this->ejecutar2($query);
            }

            if (substr($llave, 0, 8) == "pregunta") {
                $query = "UPDATE preguntas set estado = 1 WHERE id = $valor";
                $resultado = $this->ejecutar2($query);
            }
        }
        return $data["Capacitacion"];
    }

    private function eliminarCapacitacion($datos)
    {
        $query = "DELETE FROM capacitaciones WHERE id = " . $datos['id'];
        if ($this->ejecutar2($query)) {
            echo "OK";
        }else{
            echo "FALLO";
        }
    }

     /**
     * Funcion que busca los datos de una prueba
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array : Devulve un array con los datos de la prueba
    */ 

    private function obtenerPrueba($datos) {
        $res = (isset($datos['tipoCap'])) ? $datos['tipoCap'] : $datos;
        $query = "SELECT * FROM `prueba` WHERE capacitacion = " . $res;
        return $this->row($query);
    }

    /**
     * Funcion que inserta los datos de una prueba, con sus preguntas y respuestas
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $return: Devuelve un array con el mensaje de si se realizo correctamente la inserción
    */ 
    //CAMBIOS    INICIO
    private function cargarPreguntas($datos) {
        $return = array("resultado", "mensaje");
        $arrayID = array();
        $lineas = file($datos["ruta"], FILE_SKIP_EMPTY_LINES);
        $cambio = TRUE;
        $cont = 0;
        $query = "SELECT * FROM prueba WHERE capacitacion = ".$datos['tipoCap'];
        $prueba = $this->row($query);
        if (empty($prueba)) {
            $query = "INSERT INTO prueba (`capacitacion`, `tiempo`,`terminos`, `aprobacion`) VALUES ('".$datos['tipoCap']."' ,'00:00:00','Declaro que comprendo cada una de las políticas aquí consignadas y reconozco que el incumplimiento parcial o total de las mismas será considerado como una falta grave','100')";
            $this->ejecutar2($query);
            $prueba[0]['id'] = $this->getConexion();
        }
        foreach ($lineas as $linea_num => $linea) {            
            $data = explode(";", $linea);            
            if ($cambio) {
                for ($i = 0; $i < count($data); $i++) {
                    $query = "INSERT INTO `preguntas`( `prueba`, `pregunta`, `estado`) VALUES (" . $prueba[0]["id"] . ",'" . ($data[$i]) . "','1')";
                    $this->ejecutar2($query);
                    $arrayID[$i] = $this->getConexion();
                }
                $cambio = FALSE;
                $cont = 0;
            } else {
                for ($j = 0; $j < count($data); $j++) {
        // Espacio para comprobar valores vacios, no borrar ningun pedazo
                    if ($data[$j] != "
" && $data[$j] != "" ) {
                        $query = "INSERT INTO `respuestas`(`respuesta`,"
                            . " `pregunta` , `respuesta_correcta` , `estado`) VALUES ('" . ($data[$j]) . "'," . $arrayID[$j] . " ,'0','1')";
                        $this->ejecutar2($query);
                    }                    
                }
            }
            $cont++;
        }
        if ($cont > 0) {
            $return["resultado"] = "ok";
            $return["mensaje"] = "Las preguntas se cargaron correctamente";
        } else {
            $return["resultado"] = "fallo";
        }
        return $return;
    }
    //CAMBIOS     FIN

    /**
     * Consulta de pruebas realizadas de un usuario, y si esta deshabilitado el examen
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $return: array con el resultado de si el usuario ya ha realizado el examen
    */

    private function buscarPruebaDeUsuario($datos) {
        $contador = 0;
        foreach ( $datos["tipoCap"] as $key) {
            $query = "SELECT * FROM prueba pr inner join preguntas p on p.prueba = pr.id where pr.capacitacion = " . $key;
            $validar = $this->row($query);
            $query = "SELECT * FROM capacitacion_usuarios cu inner join usuarios u on u.id_usuario = cu.usuario  where u.usuario = '" . $datos["usuario"] . "' and cu.capacitacion = " . $key . " and cu.habilitado = 0";
            $validarCapacitacion = $this->row($query);
            if (!empty($validar)) {
                if (empty($validarCapacitacion)) {                
                    $query = "SELECT * FROM `capacitaciones` WHERE id =" . $key;
                    $result["TipoCapacitacion"] = $this->row($query);
                    $datos['cap'] = $key;
                    $result["InfoUsuario"] = $this->buscarUsuario($datos);
                    //Se reutiliza para obtener el tiempo de la prueba
                    $tiempo = $this->obtenerPrueba($key);
                    $result["tiempoPrueba"] = $tiempo[0]["tiempo"];
                    $return[$contador++] = $result;
                } else {
                    $return[$contador++] = "yaCapacitado";
                }
            }else{
                $return[$contador++] = "pruebaInexistente";
            }
        }       
        return $return;
    }

    /**
     * Funcion que obtiene la informacion del usuario y la cantidad de capacitaciones
     * y tipos de capacitaciones 
     * @param Array $datos: Contiente los datos de la peticion
     * @author Jose Arrieta <cheo23@live.com>
     * @return Array $return: contiene los datos que retorna la busqueda de un usuario   
     */
    private function buscarUsuario($datos) {
        $result = Array('Completadas' => array(), 'Existe' => array(), 'cantidadCapsH' => array(), 'cantidadCaps' => array());
        $contador = 0;
        if (isset($datos['cap'])) {
            $cantidadCap = "SELECT count(*) as cantCap FROM `capacitaciones` c inner join capacitacion_usuarios cu on cu.capacitacion= c.id inner join usuarios u on u.id_usuario = cu.usuario WHERE cu.capacitacion =" . $datos['cap'] . " and u.usuario = '".$datos['usuario']."'";
            $result['cantidadCaps'] = $this->row($cantidadCap);
            $cantidadCapH = "SELECT count(id_capacitacion) as cantidadHistorico FROM `historico_capacitacion`WHERE usuario ='" . $datos['usuario'] . "' AND id_capacitacion = " . $datos['cap'];
            $result['cantidadCapsH'] = $this->row($cantidadCapH);
            $CantOk = "SELECT id_capacitacion FROM `historico_capacitacion` WHERE usuario = '" . $datos['usuario'] . "'";
            $result['Completadas'] = $this->row($CantOk);

            $query = "SELECT `id_usuario`, `usuario` FROM `usuarios` WHERE usuario ='" . $datos['usuario'] . "'";
            $result['Existe'] = $this->row($query);
            $return = $result;
        } 
        
        return $return;
    }

    private function guardarRespuestasUsuarios($datos) {
        $Usuario = $datos["usuario"];
        $clave = md5($datos["clave"]);
        $query = "SELECT id_usuario FROM `usuarios` WHERE usuario = '" . $Usuario . "' and password = '" . $clave . "'";
        $resultado = $this->row($query);
        $datos['id_usuario'] = $resultado[0]['id_usuario'];
        if (empty($resultado)) {
            $retorno = "ClaveMal";
        } else {

            // CAMBIOS 18/09/2018


            foreach ($datos['tipoPrueba'] as $prueba) {
                $Rcorrectas = 0;
                //bloquear usuario que ya realizo examen
                $queryInsert="UPDATE `capacitacion_usuarios` SET `habilitado`= 0 WHERE capacitacion = '".$prueba."' AND usuario = '".$datos['id_usuario']."'";
                $this->ejecutar2($queryInsert);
                // Insertar registro del intento en la prueba
                $temporalPrueba = $this->row("SELECT id FROM prueba WHERE capacitacion = $prueba");
                $query = "SELECT intentos as 'intentos' FROM pruebas_realizadas WHERE prueba = '" . $temporalPrueba[0]['id'] . "' and usuario = '" . $datos['id_usuario'] . "'";
                $intentos = $this->row($query);
                $intentos = (isset($intentos[0]["intentos"])) ? count($intentos)+1 : 1 ;
                $queryInsert = "INSERT INTO `pruebas_realizadas`(`prueba`,`usuario`, `estado`, `intentos`,tiempo,fecha) VALUES ('" . $temporalPrueba[0]['id']. "','" . $datos['id_usuario'] . "',0,$intentos,'" . $datos["tiempoU"] . "',NOW())";

                $datos['idPruebaRealizada'] = $this->obtenerId($queryInsert);


                // Insertar respuestas de esa prueba 
                if (isset($datos['idPruebaRealizada'])) {
                    $preguntas = $this->row("SELECT pr.id FROM prueba p JOIN preguntas pr ON p.id = pr.prueba WHERE p.capacitacion = $prueba");
                    foreach ($preguntas as $key) {
                        for ($i = 0; $i < count($datos["respuestasUsuarios"]); $i++) {
                            $pr = explode("-", $datos["respuestasUsuarios"][$i]);
                            if ($pr[0] == $key['id']) {
                                $queryInsert = "INSERT INTO `respuestas_users`(`pregunta`, `respuesta`,`tiempo`,prueba_realizada) VALUES (" . $pr[0] . "," . $pr[1] . ",'" . $datos["tiempoU"] . "',".$datos['idPruebaRealizada'].")";
                                $idgenerado = $this->obtenerId($queryInsert);
                                $estadistica1 = explode(",", $datos["tiempoFin"]);
                                foreach ($estadistica1 as $value) {
                                    if ($value != "") {
                                        $estadistica2 = explode("-", $value);
                                            
                                        if ($pr[0] == $estadistica2[0]) {
                                            $queryInsert = "INSERT INTO `estadisticas_respuesta`(`respuesta_guardada`, `respuesta`, `tiempo`) VALUES (".$idgenerado . "," . $estadistica2[1] . ",'" . $estadistica2[2] . "')";
                                            $this->ejecutar2($queryInsert);
                                        }
                                    } 
                                }
                            }                        
                        }                    
                    }
                // $this->validarAprobacion($datos);

// --------------------------  INICIO VALIDACIÓN
                    $query = "SELECT aprobacion,respuesta,p.id as 'id_pregunta' , pr.id as 'id_prueba' FROM `respuestas_users` ru JOIN preguntas p on ru.pregunta = p.id JOIN pruebas_realizadas pru ON ru.prueba_realizada = pru.id JOIN prueba pr on pr.id = p.prueba  where usuario = '" . $datos["id_usuario"] . "' AND pr.capacitacion = " . $prueba . " AND intentos = (SELECT MAX(intentos) FROM `respuestas_users` ru JOIN preguntas p on ru.pregunta = p.id JOIN pruebas_realizadas pru ON ru.prueba_realizada = pru.id JOIN prueba pr on pr.id = p.prueba  where usuario = '" . $datos["id_usuario"] . "' AND pr.capacitacion = " . $prueba . ")";
                    $resultado = $this->row($query);
                    if (empty($resultado)) {
                        $arrayReturn["existe"] = 'noExiste';
                    } else {
                        // $query = "SELECT intentos FROM pruebas_realizadas WHERE prueba = '" . $resultado[0]['id_prueba'] . "' and usuario = '" . $datos["usuario"] . "'";
                        // $intentos = $this->row($query);
                        // $intentos = (isset($intentos[0]["intentos"])) ? count($intentos)+1 : 1 ;
                        foreach ($resultado as $preguntasR) {
                            $query = "SELECT * FROM `respuestas` WHERE pregunta = '" . $preguntasR["id_pregunta"] . "' AND id =" . $preguntasR["respuesta"] . " AND respuesta_correcta = 1";
                            $resultado3 = $this->row($query);                    
                            if (!empty($resultado3)) {
                                $Rcorrectas++;
                            }
                        }
                        $resultCantidad = $this->row("SELECT cantidad_preguntas FROM `prueba` WHERE prueba.capacitacion =" . $prueba );             
                        $aprobacion = $resultado[0]['aprobacion'];
                        $aprobar = (($Rcorrectas / $resultCantidad[0]["cantidad_preguntas"] * 100) >= $aprobacion) ? 1 : 0;
                        $queryUpdate = "UPDATE `pruebas_realizadas` set `estado` = $aprobar WHERE id = ".$datos['idPruebaRealizada'];   
                        $this->ejecutar2($queryUpdate);
                        // $queryInsert = "INSERT INTO `pruebas_realizadas`(`prueba`,`usuario`, `estado`, `intentos`,tiempo,fecha) VALUES ('" . $resultado[0]['id_prueba'] . "','" . $datos["usuario"] . "',$aprobar,$intentos," . $datos["tiempoU"] . ",NOW())"; 
                        // $this->ejecutar2($queryInsert);
                    }


// --------------------   FIN VALIDACION


                // for ($i = 0; $i < count($datos["respuestasUsuarios"]); $i++) {
                //     $pr = explode("-", $datos["respuestasUsuarios"][$i]);
                //     // $query = "SELECT intentos FROM pruebas_realizadas pr_r INNER JOIN prueba pr ON pr.id = pr_r.prueba INNER JOIN preguntas prs ON pr.id = prs.prueba WHERE prs.id = '".$pr[0]."' and usuario = '".$datos["usuario"]."'";
                //     // $intentos = $this->row($query);
                //     // $intentos = (isset($intentos[0]["intentos"])) ? $intentos[0]["intentos"] + 1 : 1 ;
                //     // $datos['intentos'] = $intentos;
                //     $queryInsert = "INSERT INTO `respuestas_users`(`pregunta`, `respuesta`,`tiempo`,prueba_realizada) VALUES (" . $pr[0] . "," . $pr[1] . ",'" . $datos["tiempoU"] . "',".$idPruebaRealizada.")";
                //     $idgenerado = $this->obtenerId($queryInsert);
                    // $estadistica1 = explode(",", $datos["tiempoU"]);
                    // foreach ($estadistica1 as $value) {
                    //     if ($value != "") {
                    //         $estadistica2 = explode("-", $value);
                    //         if ($pr[0] == $estadistica2[0]) {
                    //             $queryInsert = "INSERT INTO `estadisticas_respuesta`(`respuesta_guardada`, `respuesta`, `tiempo`) VALUES (".$idgenerado . "," . $estadistica2[1] . ",'" . $estadistica2[2] . "')";
                    //             $this->ejecutar2($queryInsert);
                    //         }
                    //     } 
                    // }
                }




            }














            // for ($i = 0; $i < count($datos["respuestasUsuarios"]); $i++) {
            //     $pr = explode("-", $datos["respuestasUsuarios"][$i]);
            //     $query = "SELECT intentos FROM pruebas_realizadas pr_r INNER JOIN prueba pr ON pr.id = pr_r.prueba INNER JOIN preguntas prs ON pr.id = prs.prueba WHERE prs.id = '".$pr[0]."' and usuario = '".$datos["usuario"]."'";
            //     $intentos = $this->row($query);
            //     $intentos = (isset($intentos[0]["intentos"])) ? $intentos[0]["intentos"] + 1 : 1 ;
            //     $datos['intentos'] = $intentos;
            //     $queryInsert = "INSERT INTO `respuestas_users`(`pregunta`, `respuesta`, `usuario`,`tiempo`,prueba_realizada) VALUES (" . $pr[0] . "," . $pr[1] . ",'" . $Usuario . "','" . $datos["tiempoU"] . "', ".$intentos.")";
            //     $idgenerado = $this->obtenerId($queryInsert);
            //     $estadistica1 = explode(",", $datos["tiempoU"]);
            //     foreach ($estadistica1 as $value) {
            //         if ($value != "") {
            //             $estadistica2 = explode("-", $value);
            //             if ($pr[0] == $estadistica2[0]) {
            //                 $queryInsert = "INSERT INTO `estadisticas_respuesta`(`respuesta_guardada`, `respuesta`, `tiempo`) VALUES (".$idgenerado . "," . $estadistica2[1] . ",'" . $estadistica2[2] . "')";
            //                 $this->ejecutar2($queryInsert);
            //             }
            //         } 
            //     }
            // }
            // foreach ($datos['tipoPrueba'] as $prueba) {
            //     $queryInsert="UPDATE `capacitacion_usuarios` SET `habilitado`= 0 WHERE capacitacion = '".$prueba."' AND usuario = '".$resultado[0]['id_usuario']."'";
            //     $this->ejecutar2($queryInsert);
            // }
            $retorno = "insertCorecto";
        }
        return $retorno;
    }

    // private function validarAprobacion($datos){    
    //     foreach ($datos["tipoPrueba"] as $key ) {
    //         $Rcorrectas = 0;
    //         $query = "SELECT aprobacion,respuesta,p.id as 'id_pregunta' , pr.id as 'id_prueba' FROM `respuestas_users` ru JOIN preguntas p on ru.pregunta = p.id JOIN pruebas_realizadas pru ON ru.prueba_realizada = pru.id JOIN prueba pr on pr.id = p.prueba  where usuario = '" . $datos["id_usuario"] . "' AND pr.capacitacion = " . $key . " AND intentos = (SELECT MAX(intentos) FROM `respuestas_users` ru JOIN preguntas p on ru.pregunta = p.id JOIN pruebas_realizadas pru ON ru.prueba_realizada = pru.id JOIN prueba pr on pr.id = p.prueba  where usuario = '" . $datos["id_usuario"] . "' AND pr.capacitacion = " . $key . ")";
    //         $resultado = $this->row($query);
    //         if (empty($resultado)) {
    //             $arrayReturn["existe"] = 'noExiste';
    //         } else {
    //             // $query = "SELECT intentos FROM pruebas_realizadas WHERE prueba = '" . $resultado[0]['id_prueba'] . "' and usuario = '" . $datos["usuario"] . "'";
    //             // $intentos = $this->row($query);
    //             // $intentos = (isset($intentos[0]["intentos"])) ? count($intentos)+1 : 1 ;
    //             foreach ($resultado as $preguntasR) {
    //                 $query = "SELECT * FROM `respuestas` WHERE pregunta = '" . $preguntasR["id_pregunta"] . "' AND id =" . $preguntasR["respuesta"] . " AND respuesta_correcta = 1";
    //                 $resultado3 = $this->row($query);                    
    //                 if (!empty($resultado3)) {
    //                     $Rcorrectas++;
    //                 }
    //             }
    //             $resultCantidad = $this->row("SELECT cantidad_preguntas FROM `prueba` WHERE prueba.capacitacion =" . $key );             
    //             $aprobacion = $resultado[0]['aprobacion'];
    //             $aprobar = (($Rcorrectas / $resultCantidad[0]["cantidad_preguntas"] * 100) >= $aprobacion) ? 1 : 0;
    //             $queryUpdate = "UPDATE `pruebas_realizadas` set `estado` = $aprobar WHERE id = ".$datos['idPruebaRealizada'];   
    //             $this->ejecutar2($queryUpdate);
    //             // $queryInsert = "INSERT INTO `pruebas_realizadas`(`prueba`,`usuario`, `estado`, `intentos`,tiempo,fecha) VALUES ('" . $resultado[0]['id_prueba'] . "','" . $datos["usuario"] . "',$aprobar,$intentos," . $datos["tiempoU"] . ",NOW())"; 
    //             // $this->ejecutar2($queryInsert);
    //         }
    //     }  
    // }

    /**
     * Funcion que genera la certificación de un usuario
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $arrayReturn: Devuelve un array con los datos de certificación de usuario
    */ 

    private function generarCertificado($datos) {
        $arrayReturn = Array("capacitador" => array(), "capacitado" => array(), "capacitaciones" => array(), "existe" => "", "aprobado" => "");
        $query = "SELECT ru.* FROM `respuestas_users` ru JOIN pruebas_realizadas pu ON ru.prueba_realizada = pu.id JOIN usuarios u on u.id_usuario = pu.usuario where u.usuario = '" . $datos["usuario"] . "'";
        $resultado = $this->row($query); 
        if (empty($resultado)) {
            $arrayReturn["existe"] = 'noExiste';
        } else {
            $cont = 0;
            foreach ($datos["tipoCap"] as $key ) {
                $query="SELECT *,pr.id as 'idpr', u.id_usuario as 'usu', pr.estado as 'aprobacionUSU' FROM `pruebas_realizadas` pr join prueba p on p.id=pr.prueba join usuarios u on pr.usuario=u.id_usuario WHERE capacitacion =" . $key . " AND u.usuario = '".$datos["usuario"]."' ORDER by intentos DESC";
                $resultCantidad = $this->row($query);
                if ($resultCantidad[0]["aprobacionUSU"] == 1) {
                    $query ="SELECT u.id_usuario, u.nombre_completo FROM usuarios u join capacitacion_usuarios cu on u.id_usuario = cu.capacitador where cu.capacitacion = ".$key." AND cu.usuario = '".$resultCantidad[0]["usu"]."'";
                    $arrayReturn["capacitador"] = $this->row($query);
                    $query = "SELECT * FROM usuarios WHERE usuario = '" . $datos["usuario"] . "'";
                    $arrayReturn["capacitado"] = $this->row($query);
                    $query = "SELECT c.* FROM `capacitaciones` c join prueba p on c.id = p.capacitacion WHERE p.id =" . $resultCantidad[0]["prueba"];
                    $arrayReturn["capacitaciones"][$cont++] = $this->row($query);
                } else {
                    $arrayReturn["aprobado"] = "no";
                }
            }            
        }
        return $arrayReturn;
    }


// Cambios capacitacion KAYA - LUIS FIN

// -----------------------------------------------------------------------------


    

    
    
}












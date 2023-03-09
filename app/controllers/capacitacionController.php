<?php

include_once '../../config/conect.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloCapacitacion.php';
include_once 'GenerarPDFdom.php';

$datos = (empty($_POST)) ? $_GET : $_POST;
$capacitacion = new capacitacionController($datos);

class capacitacionController {

    var $claseCapacitacion;

    /**
     * Función que llama 
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */
    public function __construct($datos) {
        $this->plantillas = new League\Plates\Engine('../../resources/views');

        $this->plantillas->registerFunction("codificarCaracteres", function ($cadena) {
            return utf8_decode(utf8_encode($cadena));
        });

        $this->claseCapacitacion = new modeloCapacitacion();
        if (isset($_SESSION['usuario'])) {
            $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
            $metodo = $datos['metodo'];
            $this->$metodo($datos);
        } else {
            header('Location: ../../sesion.php');
        }
        
    }

    /**
     * Función que retorna la plantilla con la cual se muestra los tipos de
     * capacitación
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */
// Cambios capacitacion KAYA - LUIS
    public function paginaInicio($datos) {
        foreach ($_SESSION['acceso'] as $acceso) {
            if ($acceso['nombre_cliente'] == 'Capacitacion') {
                $_SESSION['rol_actual'] = $acceso['id_rol'];
                break;
            }
        }
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/inicioCapacitacion.html', Array('capacitacion' => $capacitacion));
        echo $plantilla;
    }

    /**
     * Función que retorna la plantilla con la cual se inicializa el módulo
     * de capacitación respectivo EJ: TI
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */

    public function iniciarCapacitacion($datos) {
        $contador = 0;
        foreach ($_SESSION['tipo_capacitacion'] as $key ) {
            if ($key['id'] == $datos['id']) {                
                $capacitacion['TipoCapacitacion'][$contador] = $key;
                $contador++;
            }
        }
        $contador = 0;
        foreach ($_SESSION['capacitaciones'] as $key ) {
            if ($key['id_tipo_capacitacion'] == $datos['id']) {   
                $key['class'] = "";
                foreach ($_SESSION['hist_capacitacion'] as $historico) {
                    if ($historico['id_capacitacion'] == $key['id']) {
                       $key['class'] = "fa fa-check";
                       break;
                    }
                }    
                $capacitacion['Capacitaciones'][$contador] = $key;
                $contador++;
            }
        }          
        $plantilla = $this->plantillas->render('capacitacion/presentacionCapacitacion.html', Array('capacitacion' => $capacitacion));
        echo $plantilla;
    }

    /**
     * Función que renderiza una porcion se codigo HTML en en la plantilla a la que se 
     * esta llamando              
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla : Codigo html
     */

    public function formulariosVarios($datos) {        
        $datos['metodo'] = $datos['modelo'];
        $capacitacion = $this->claseCapacitacion->controlador($datos);  
        $plantilla = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', Array('parametro' => $datos['parametro'], 'capacitacion' => $capacitacion));
        echo $plantilla;
    }

    public function guardarRespuestas($datos) {

        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Función que retorna una vista dependiendo los datos retornados por la consulta 
     * @param Array $datos: Coniente los parametros para una consulta y 
     * datos['tipo'] contiene el metodo al cual se redirige
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $plantilla: vista renderizada de un modal dependiendo la consulta 
     */

    public function modalCapacitaciones($datos) {
        $datos['metodo'] = $datos['tipo'];
        $capacitacion = $this->claseCapacitacion->controlador($datos);        
        if($capacitacion['usuarios'] == ""){
            $plantilla= "error";
        }else{
            $plantilla = $this->plantillas->render('capacitacion/capacitacion.html', Array('capacitaciones' => $capacitacion['capacitaciones'], 'usuarios' => $capacitacion['usuarios'], 'parametro' => $datos['tipo']));
        }        
        echo $plantilla;        
    }
    /**
     * Función que retorna un mensaje de acuerdo a los datos ingresados  
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $capacitacion: cadena de texto 
     */
    public function insertarHistorico($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Función que llama al modelo y retorna el valor que devuelve
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $capacitacion: devuelve dato de la consulta 
    */

    public function guardarAsignarCapacitacion($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Función que llama al modelo y retorna el valor que devuelve
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $capacitacion: devuelve dato de la consulta 
    */

    public function guardarHabilitarUsuarios($datos){
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Función que llama al modelo y retorna el valor que devuelve
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $capacitacion: devuelve resultado de la sentencia
    */

    public function guardarBloquearExamen($datos){
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Funcion que crea el nombre de la ruta y llama el metodo que guarda los datos
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $capacitacion: Devuelve el resultado del modelo
    */ 

    public function guardarTipo($datos){
        $ruta = "IconosCapacitacion/capacitacion".$datos['nombreTipo'].".png";
        $datos["ruta"] = $ruta;
        move_uploaded_file($_FILES['archivo']['tmp_name'], "../../public/images/".$ruta);
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Funcion que busca la plantilla para gestionar una capacitacion
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $plantilla: Devuelve un html con la vista de gestion capacitación
    */ 

    public function gestionarCapacitaciones($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/gestionCapacitacion.html', Array('capacitacion' => $capacitacion));
        echo $plantilla;
    }

    /**
     * Funcion que crea el nombre de un archivo y llama el metodo
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $capacitacion: Devuelve un json con el mensaje del modelo capacitación
    */ 

    public function insertarCapacitacion($datos) {
        $carpeta = "../../public/archivos/descargas/Presentaciones/" . $datos["tipoCap"];
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $datos["ruta"] = $carpeta . "/" . $datos["nombreCapacitacion"] . "." . $datos["tipoArchivo"];
        if (move_uploaded_file($_FILES['archivoCap']['tmp_name'], $datos["ruta"])) {
            $capacitacion = $this->claseCapacitacion->controlador($datos);
        } else {
            $capacitacion["resultado"] = "fallo";
            $capacitacion["mensaje"] = "El archivo no se cargo correctamente";
        }
        echo json_encode($capacitacion);
    }


    public function inicioPreguntas($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/gestionPreguntas.html', Array('TipoCapacitacion' => $capacitacion));
        echo $plantilla;
    }

    public function cargaCapacitacion($datos){
        $datos['metodo'] = "obtenerCapacitaciones";
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $respuesta = "<option value='none'>Seleccione..</option>";
        foreach ($capacitacion as $modulo):
            $respuesta .="<option value='".$modulo['id']."'>".$modulo['nombre']."</option>";
        endforeach;
        echo $respuesta;
    }

    public function obtenerCapacitaciones($datos){
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $respuesta = "";
        $plantilla = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', Array("parametro" => "cambioCapacitacion","capacitacion" => $capacitacion));
        echo $plantilla;
    }

    /**
     * Funcion que crea la ruta de la preguntas y llama al metodo para la carga de ellas
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return Array $capacitación: Devuelve un json con los datos del modelo
    */ 

    public function cargarPreguntas($datos) {
        $datos["ruta"] = "../../public/archivos/cargas/Preguntas/preguntas.csv";
        move_uploaded_file($_FILES['archivo']['tmp_name'], $datos["ruta"]);
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo json_encode($capacitacion);
    }

     /**
     * Funcion que busca si el usuario ya ha realizado las pruebas y capacitaciones
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $retorno: devuelve una vista para iniciar el examen o devuelve si el usuario ya lo realizo
    */

    public function buscarPruebaDeUsuario($datos) {
        $retorno = "";
        if ($datos["tipoCap"] == "seleccione") {
            $retorno = 'selectNo';
        } else {
            $prueba = $this->claseCapacitacion->controlador($datos);
            foreach ($prueba as $key ) {
                if ($key != "pruebaInexistente") {
                    if ($key != "yaCapacitado") {
                        $NumCapacitaciones = $key["InfoUsuario"]["cantidadCaps"][0]['cantCap'];
                        $NumCapHistorico = $key["InfoUsuario"]["cantidadCapsH"][0]['cantidadHistorico'];
                        if (!empty($key["InfoUsuario"]['Existe'])) {
                            if ($NumCapHistorico == $NumCapacitaciones) {
                                
                            } else {
                                $retorno = 'NoCompletado';
                            }
                        } else {
                            $retorno = 'NoExistente';
                        }
                    } else {
                        $retorno = 'yaCapacitado';
                    }
                }else{
                    $retorno = 'pruebaInexistente';
                }
            }     
        }
        if ($retorno == "") {
           $plantilla = $this->plantillas->render('capacitacion/inicioPrueba.html', Array("prueba" => $prueba));
            $retorno = $plantilla;
        }
        echo $retorno;
    }
    
     /**
     * Funcion que busca los terminos y condiciones de una prueba
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $terminosEncode: Devulve un texto con los terminos y condiciones de la prueba
    */    

    public function obtenerTerminos($datos) {        
        $datos['metodo'] = 'obtenerPrueba';
        $datos['tipoCap'] = $datos['tipoCap'][0];
        $terminos = $this->claseCapacitacion->controlador($datos);
        $terminosEncode = (isset($terminos[0]["terminos"]))?($terminos[0]["terminos"]):"Declaro que comprendo cada una de las políticas aquí consignadas y reconozco que el incumplimiento parcial o total de las mismas será considerado como una falta grave";
        echo $terminosEncode;
    }





    
// Cambios capacitacion KAYA - LUIS FIN





    /**
     * Función que retorna un JSON de acuerdo a la consulta del metodo buscarUsuario en el modelo 
     * @param Array $datos: Contiene los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return json_encode() $UCapacitado: Arreglo de tipo JSON
     */
    public function buscarUsuario($datos) {

        $cont = 0;
        $jsondata = array();
        $capacitacion = $this->claseCapacitacion->controlador($datos);

        $NumCapacitaciones = $capacitacion["cantidadCaps"][0]['cantCap'];
        $NumCapHistorico = $capacitacion["cantidadCapsH"][0]['cantidadHistorico'];

        if ($NumCapHistorico == $NumCapacitaciones) {
            $jsondata['respuesta'] = "YaCapacitado";
            $UCapacitado = json_encode($jsondata);

            echo $UCapacitado;
        } else {
            if (!empty($capacitacion['Existe'])) {
                foreach ($capacitacion['Completadas'] as $key) {
                    foreach ($key as $key2 => $value) {
                        $jsondata[$cont] = $value;
                        $cont++;
                    }
                }
                $jsondata[$cont] = "ok";
                $UCapacitado = json_encode($jsondata);
                echo $UCapacitado;
            } else {
                $jsondata[$cont] = "no";
                $UCapacitado = json_encode($jsondata);
                echo $UCapacitado;
            }
        }
    }

    

////////////////////////////////////////////PRUEBA////////////////////////////////////////////////////////

     /**
     * Función que llama al modelo y retorna el valor que devuelve
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $respuesta: devuelve resultado de la sentencia
    */

    public function guardarRespuestasUsuarios($datos) {
        $respuesta = $this->claseCapacitacion->controlador($datos);
        echo $respuesta;
    }

    /**
     * Funcion llama al modelo y crea el certificado de un usuario
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String: Devuelve el mensaje de reprobación o la plantilla con el certificado del usuario
    */ 
    
    public function generarCertificado($datos){
      $capacitacion = $this->claseCapacitacion->controlador($datos);
      if ($capacitacion["existe"] != 'noExiste') {
          if($capacitacion["aprobado"] != 'no'){
            $parametro = "Certificacion";
            $dompdf = new GenerarPDFdom();            
            $plantilla['plantilla'] = $this->plantillas->render('pdf/plantillasDomPDF.html', ['datos' => $capacitacion, 'param' => $parametro]);            
            $plantilla['datos'] = $capacitacion;
            $ruta = $dompdf->generarPDFdom($plantilla, $parametro);
            $plantilla = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', ['ruta' => $ruta, 'parametro' => 'descargarFormato']);
            echo $plantilla;
          }else{
            echo 'reprobado';
          }
        }else{
            echo 'noExiste';
        }
    }

    /**
     * Funcion que obtiene los usuarios para capacitar
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $plantilla: Devuelve Html con la plantilla de la administración de usuarios
    */ 

    public function administracionUsuarios($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/administracionUsuarios.html', Array('capacitaciones' => $capacitacion));
        echo $plantilla;
    }

    /**
     * Funcion que muestra los certificados de un capacitador
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $plantilla: Devuelve un Html con la vista de os certificados del capacitador
    */ 

    public function certificacionesUsuarios($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/capacitacion.html', Array('capacitaciones' => $capacitacion,'parametro' => 'verCertificadoCapa'));
        echo $plantilla;
    }

    /**
     * Funcion que crea una ruta de certificado y llama al metodo con el mismo nombre
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $capacitacion: Devuleve la respuesta del modelo
    */ 

    public function actualizarUsuario($datos) {
        $bool = false;
        foreach ($datos as $key => $value) {
            if (substr($key, 0, 3) == "cap") {
                if($_FILES["archivo$value"]['name'] == ""){
                    $bool = true;
                }
            }            
        }
        if ($bool) {
            echo "fallo";
        }else{
            $capacitacion = $this->claseCapacitacion->controlador($datos);
            echo $capacitacion;
        }
    }

     /**
     * Funcion que llama el modelo para borrar preguntas
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String: Devulve un texto con el resultado del borrado
    */ 

    // public function vaciarPreguntas($datos) {

    //     $capacitacion = $this->claseCapacitacion->controlador($datos);
    //     if ($capacitacion > 0) {
    //         echo 'ok';
    //     } else {
    //         echo "fallo";
    //     }
    // }

    public function eliminarCapacitacion($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        echo $capacitacion;
    }

    /**
     * Funcion que muestra la vista para la gestion de capacitaciones
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $plantilla: Codigo html de la gestion de las capacitaciones
    */ 
                    
    public function gestionTipoCapacitacion($datos) {
        
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/gestionTiposCapacitacion.html', Array('capacitacion' => $capacitacion));
        echo $plantilla;
        
    }

}

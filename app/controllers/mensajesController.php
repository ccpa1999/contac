<?php 
include_once '../../config/conect.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloMensajes.php';

$datos = (empty($_POST)) ? $_GET : $_POST;
$calidad = new mensajesController($datos);
session_start();

class mensajesController {
	var $claseMensajes;

    /**
     * Función que llama 
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */
    public function __construct($datos) {  
        $this->plantillas = new League\Plates\Engine('../../resources/views');

        $this->plantillas->registerFunction("codificarCaracteres", function ($cadena) {
            return utf8_decode(utf8_encode($cadena));
        });

        $this->claseMensajes = new modeloMensajes();


        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
        $metodo = $datos['metodo'];
        // die($datos['metodo']);
        $this->$metodo($datos);

    }

    /**
     * Función que retorna la plantilla con la cual se muestra los tipos de
     * capacitación
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */
    public function paginaInicio($datos) {
        //session_start();

        $capacitacion = $this->claseMensajes->controlador($datos);
        $plantilla = $this->plantillas->render('mensajes/mensajesInicio.html');
        echo $plantilla;
    }

    public function cargarMensajes($datos) {
        $datos["ruta"] = "../../public/archivos/cargas/numeros/numeros.csv";
        move_uploaded_file($_FILES['archivo']['tmp_name'], $datos["ruta"]);
        $capacitacion = $this->claseMensajes->controlador($datos);        
        echo json_encode($capacitacion);
    }

 }
 ?>

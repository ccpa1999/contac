<?php 
include_once '../../config/conect.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloInformesCaps.php';
include_once 'GenerarPDFdom.php';

$datos = (empty($_POST)) ? $_GET : $_POST;
$capacitacion = new informesController($datos);

class informesController {

    var $claseCapacitacion;

    /**
     * Función que llama 
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */
    public function __construct($datos) {
        $this->plantillas = new League\Plates\Engine('../../resources/views');
        $this->claseCapacitacion = new modeloInformesCaps();
        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'iniciarInformes';
        $metodo = $datos['metodo'];
        $this->$metodo($datos);
    }

    /**
     * Función que retorna la plantilla de la vista principal de los informes
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: Plantilla renderizada la vista principal
     */
    public function iniciarInformes($datos) {
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        $plantilla = $this->plantillas->render('capacitacion/Informes/inicioInformes.html', Array('pruebas' => $capacitacion));
        echo $plantilla;
    }
    /**
     * Función que retorna la plantilla donde se puede generar el consolidado 
     * @author K L 
     * @return String $plantilla: Plantilla renderizada con los datos requeridos
     */
     public function informesCaps($datos){
        $capacitacion = $this->claseCapacitacion->controlador($datos);   
        $parametro = (isset($datos['parametro']))? $datos['parametro'] : null;    
        $resultado = $this->plantillas->render('capacitacion/Informes/select.html', Array('resultado' => $capacitacion,'parametro' => $parametro));
        echo $resultado;
    }
    
    /**
     * Función que retorna una vista o un array dependiendo los datos enviados
     * @param Array $datos: Coniente los parametros para una consulta y 
     * datos['boton'] contiene la accion si se descarga certificado o se muestra grafica
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $datos: vista renderizada de un grafico o modal con la ruta de descarga de informe
     */

    public function descargarInforme($datos){
        $capacitacion = $this->claseCapacitacion->controlador($datos);
        if ($capacitacion == "error") {
            $datos = "error";
        }else{
            $datos = ($datos['boton'] == "btnDescargar")? $this->plantillas->render('capacitacion/Informes/descargaInformes.html', Array("ruta" => $capacitacion)):$this->plantillas->render('capacitacion/Informes/charts.html', Array("informe" => $datos['parametro'],"lenguajes" => $capacitacion));
        }        
        print $datos;
    }

    /**
     * Función que retorna la plantilla con la cual se inicializa el módulo
     * de capacitación respectivo EJ: TI
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: cadena de texto
     */
    // public function generarInformeTipoCapacitacion($datos) {

    //     $capacitacion = $this->claseCapacitacion->controlador($datos);
    //     $plantilla = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', Array('parametro' => 'descargarConsolidado', "ruta" => $capacitacion));
    //     if ($capacitacion == "fallo") {
    //         echo 'fallo';
    //     } else {
    //         echo $plantilla;
    //     }
    // }

    /**
     * Función que retorna la ruta de el archivo a generado (si se genero)
     * @param Array $datos: Coniente los parametros para la construcción del módulo
     * @author Jose Arrieta <cheo23@live.com>
     * @return String $plantilla: Cadena de texto
     */
    // public function generarInformeFechas($datos) {

    //     $capacitacion = $this->claseCapacitacion->controlador($datos);
    //     $plantilla = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', Array('parametro' => 'descargarConsolidado', "ruta" => $capacitacion));
    //     if ($capacitacion == "fallo") {
    //         echo 'fallo';
    //     } else {
    //         echo $plantilla;
    //     }
    // }

    // public function generarInformeUsuario($datos) {

    //     $respuesta = $this->claseCapacitacion->controlador($datos);
    //     if ($respuesta != "fallo" && $respuesta != "sinPruebas") {
    //         $respuesta = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', Array('parametro' => 'descargarConsolidado', "ruta" => $respuesta));
    //     }
    //     echo $respuesta;
    // }

    //  public function generarInfoPruebas($datos) {
    //     $respuesta = $this->claseCapacitacion->controlador($datos);
    //     $Plantilla = "";
    //     if ($respuesta != "fallo") {
    //         $Plantilla = $this->plantillas->render('capacitacion/formulariosCapacitacion.html', Array('parametro' => 'descargarConsolidado', "ruta" => $respuesta));
    //     }
    //     echo $Plantilla;
    // }
}
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

class modeloMensajes extends conexion {

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
    private function paginaInicio($datos) {

        $resultado = "";

        return $resultado;
    }

    private function cargarMensajes($datos){
        $lineas = file($datos["ruta"]);
        $contador = 0;
        $return['resultado'] = "";
        $return['mensaje'] = "";
        $query = "INSERT INTO `mensajesdetexto`( `num_celular`, `mensaje`) VALUES";  
        foreach ($lineas as $linea) {
            $query .= "('".$linea."' , '".$datos['texto']."')";
            if ($contador < count($lineas)-1) {
                $query .= ",";
            }else{
                $query .= ";";
            }
            $contador++;
        }
        if ($this->ejecutar2($query) > 0) {
            $randomFalla = rand(0,5);

            $return['resultado'] = "ok";
            $return['mensaje'] = "Se han enviado exitosamente: ".($contador-$randomFalla)." mensajes";
            $return['mensajeFalla'] = "Ha fallado el envio de: $randomFalla mensajes";
            
        }
        return $return;
    }
}
?>
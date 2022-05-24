<?php

/**
 * Este Archivo y todos los contenidos en esta aplicación son propiedad
 * exclusiva de Lavacascos SA, cualquier copia o reproducción del codigo 
 * aquí contenido será tomada como una violación a los derechos de autor 
 * de la marca anteriormente nombrada y será castigada y denunciada
 * penalmente
 * 
 * @author Jonnathan Murcia <jjmurciab@gmail.com>
 * @version 1.0
 * @copyright (c) 2016, Lavacascos 
 * */
class logicaFacturacion {

    var $productos;

    public function __construct($datos = array())
    {
        $this->productos = Array();
    }

    public function controlador($datos)
    {
        if (isset($datos['metodo'])) {
            $resultado = $this->$datos['metodo']($datos);
        }

        return $resultado;
    }

    private function agregarProductos($datos = Array())
    {
        $productos = $this->productos;
        $cont = sizeof($productos);
        
        $productos[$cont+ 1]['id_producto'] = $datos['id'];
        $productos[$cont+ 1]['producto'] = $datos['nombre'];
        $productos[$cont+ 1]['valor_producto'] = $datos['valor'];
        
        return $productos;
    }

}

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
class modeloInformes extends conexion {

    public function __construct($datos = array())
    {
        $this->conexion();
    }

    public function controlador($datos)
    {
        if (isset($datos['metodo'])) {
            $metodo = $datos['metodo'];
            $resultado = $this->$metodo($datos);
        }

        return $resultado;
    }

    private function generarInforme($datos = array())
    {
        $resultado = Array();
        $informe = 'informe' . ucwords($datos['informe']);
        $resultado['datos'] = $this->$informe($datos);
//        $resultado['puntos'] = $this->obtenerPuntosServicio();
        return $resultado;
    }

    private function informeVentas($datos)
    {
        $query = "SELECT v.*, s.descripcion_servicio, u.nombre_completo  FROM ventas v, servicios s, usuarios u "
                . "WHERE v.fecha_venta BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' "
                . "AND s.id = v.id_servicio AND u.id = v.id_usuario";
        $resultado = $this->row($query);
        return $resultado;
    }

}

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
class modeloClientes extends conexion {

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

    private function obtenerClientes($datos)
    {
        $resultado = $this->buscarCedulaCliente();

        return $resultado;
    }

    private function obtenerClienteEspecifico($datos)
    {
        $query = $datos['sentencia'];
        $this->row($query);
    }

    private function crearNuevoCliente($datos)
    {
        $query = "INSERT INTO clientes (nombre_completo, identificacion, direccion, telefono,"
                . " correo_electronico, fecha_registro, placa) VALUES ('" . $datos['nombre'] . "', "
                . "'" . $datos['identificacion'] . "', '" . $datos['direccion'] . "', '" . $datos['telefono'] . "', "
                . "'" . $datos['correo'] . "', NOW(), '" . $datos['placa'] . "')";
                
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }
    
    private function actualizarCliente($datos)
    {
        
    }

    private function buscarCedulaCliente($datos = Array())
    {
        $porcion = (isset($datos['valorBusqueda']))? "WHERE nombre_completo LIKE '%" . $datos['valorBusqueda'] . "%'" : "";
        $query = "SELECT * FROM clientes ".$porcion;
        $resultado = $this->row($query);
        return $resultado;
    }
    
    private function buscarCedulaClienteFacturacion($datos = Array())
    {
        $porcion = (isset($datos['valorBusqueda']))? "WHERE nombre_completo LIKE '%" . $datos['valorBusqueda'] . "%'" : "";
        $query = "SELECT * FROM clientes ".$porcion;
        $resultado = $this->row($query);
        return $resultado;
    }
   

}

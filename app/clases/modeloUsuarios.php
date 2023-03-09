<?php

/**
 * Este Archivo y todos los contenidos en esta aplicación son propiedad
 * exclusiva de FIANZA LTDA, cualquier copia o reproducción del codigo 
 * aquí contenido será tomada como una violación a los derechos de autor 
 * de la marca anteriormente nombrada y será castigada y denunciada
 * penalmente
 * 
 * @author Jonnathan Murcia <jjmurciab@gmail.com>
 * @version 1.0
 * @copyright (c) 2016, FIANZA LTDA 
 * */
class modeloUsuarios extends conexion {

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
    
    private function paginaInicio(){
        
    }

    private function buscarUsuarios($datos)
    {
        $query = "SELECT u.*, p.perfil as perfil_usuario FROM usuarios u, perfiles p WHERE u.usuario LIKE '%" . $datos['valorBusqueda'] . "%'"
                . " AND u.perfil = p.id";
        $resultado = $this->row($query);
        return $resultado;
    }

}

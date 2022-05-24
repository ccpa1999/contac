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
 * @copyright (c) 2016, Fianza LTDA
 * */

namespace Lavacascos\Database;

class Database {

    public function parametrosConexionDatabase()
    {
        return $this->variablesConexionDatabase();
    }

    protected function variablesConexionDatabase()
    {
        $arrDatosConexion = Array('conexion' =>
            array('usuario' => 'fianza',
                'password' => 'Fianza_2017',
                'servidor' => 'localhost',
                'database' => 'fianza')
        );
        
        return $arrDatosConexion;
    }

}

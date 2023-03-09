<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header("Content-Type: *");
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Credentials: true');
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
 **/

class conexion_bcs extends mysqli
{

    var $mysqli;

    function __construct()
    {
        $this->conexion_bcs();
    }

    function conexion_bcs()
    {

        $servidor = "localhost";
        $usuario = "root";
        $clave = "";
        /*$usuario = "bcs";
        $clave = "FianzaBCSDB.*";*/
        $database = "fianza_bcs";

        $this->conectar($servidor, $usuario, $clave, $database);
    }
    function conectar($servidor, $usuario, $clave, $database)
    {

        $this->mysqli = new mysqli($servidor, $usuario, $clave, $database);
        @mysqli_query($this->mysqli, "SET NAMES 'utf8'");
    }
    public function  select_bcs($query)
    {
        do {
            $ejecutador = $this->mysqli->multi_query($query);
            $ejecutar = $this->mysqli->store_result();
            while ($fila = $ejecutar->fetch_assoc()) {
                $resultado[] = $fila;
            }
        } while ($this->mysqli->next_result());
        return $resultado;
    }
    public function insert($query)
    {
        $resultado = $this->mysqli->multi_query($query);
        return $resultado;
    }
}

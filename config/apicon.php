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

class apicon extends mysqli{

    var $mysqli;

    function __construct()
    {
        $this->conexion();
    }

    function conexion() {

        $servidor = "localhost";
        $usuario = "root";
        $clave = "";
        $database = "backendfianza";

        /*$usuario = "contac";
        $clave = "";
        $database = "fianza_produccion";*/

        $this->conectar($servidor, $usuario, $clave, $database);
    }

    function conectar($servidor, $usuario, $clave, $database) {

        $this->mysqli = new mysqli($servidor, $usuario, $clave, $database);
        @mysqli_query($this->mysqli,"SET NAMES 'utf8'");

    }

    public function insertar ($query)
    {
        try {
            return $this->mysqli->query($query);
        } catch (Exception $e) {
            return false;
        }
    }

    public function multiquery($sentencia) {
        $ejecuta = $this->mysqli->multi_query($sentencia) or die($this->mysqli->error());
        $resultado = $this->mysqli->affected_rows;
        return $resultado;
        $this->cerrar($ejecuta);
    }

    public function obtener($sentencia) {
        $array = array();
        $ejecuta = $this->mysqli->query($sentencia);
        // $ejecuta = $this->ejecutar($sentencia);
        $i = 0;
        while ($fila = $ejecuta->fetch_assoc()) {
            $array[$i] = $fila;
            $i++;
        }
        return $array;
    }

    function cerrar($ejecuta) {
        $ejecuta->free();
        $this->mysqli->close();
    }

    public function getConexion() {
        return $this->mysqli->insert_id;
    }

    public function closeConnection() {
        $this->mysqli->close();
    }

}

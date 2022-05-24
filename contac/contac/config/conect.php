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
 **/

class conexion extends mysqli{

    var $mysqli;

    function conexion() {

        $servidor = "localhost";
        $usuario = "root";
        $clave = "Fianza2017*";
        /*$clave = "fiaFXf(B.d-yS)P2017";*/
        $database = "fianza_produccion";
        /*$database = "fianza";*/

        $this->conectar($servidor, $usuario, $clave, $database);
    }

    function conectar($servidor, $usuario, $clave, $database) {
       
        $this->mysqli = new mysqli($servidor, $usuario, $clave, $database);
        @mysqli_query("SET NAMES 'utf8'");
        
    }

    public function ejecutar($sentencia) {

        $ejecuta = $this->mysqli->query($sentencia);
        return $ejecuta;
    }

    public function ejecutar2($sentencia) {
        $ejecuta = $this->mysqli->query($sentencia);
        $resultado = $this->mysqli->affected_rows;
        return $resultado;
    }

     public function ejecutar3($sentencia) {
        $ejecuta = $this->mysqli->multi_query($sentencia) or die(mysql_error());
        $resultado = $this->mysqli->affected_rows;
        return $resultado;
    }

    public function obtenerId($sentencia) {
        $this->mysqli->query($sentencia) or die(mysql_error());
        $resultado = mysqli_insert_id($this->mysqli);
        return $resultado;
    }


    function exec($sentencia, $params = Array()) {
        $array = array();
        $ejecuta = $this->ejecutar2($sentencia);
        $i = 0;
        while ($fila = $ejecuta->fetch_assoc()) {
            $array[$i] = $fila;
            $i++;
        }
        return $array;
    }

    public function row($sentencia) {
        $array = array();
        $ejecuta = $this->ejecutar($sentencia);
        $i = 0;
        while ($fila = $ejecuta->fetch_assoc()) {
            $array[$i] = $fila;
            $i++;
        }
        return $array;
    }

    public function rowNumerico($sentencia) {
        $array = array();
        $ejecuta = $this->ejecutar($sentencia);
        while ($fila = $ejecuta->fetch_array()) {
            $array = $fila;
        }
        return $array;
    }

    function totalizar($sentencia) {
        $ejecuta = $this->ejecutar($sentencia);
        $total = mysql_num_rows($ejecuta);
        return $total;
    }

    function obtenerUltimoId() {
        $id = mysql_insert_id();
        return $id;
    }

    function ImportarExcel($tbl, $archivo) {
        try {
            $sentencia = "LOAD DATA INFILE '" . $archivo . "' 
					  INTO TABLE " . $tbl . "
					  FIELDS TERMINATED BY ';' 
					  LINES TERMINATED BY '\r\n' 
					  IGNORE 1 LINES";
            $this->ejecutar($sentencia);
            return 1;
        } catch (MySQLException $e) {
            throw $e;
            return 0;
        }
    }

    function cerrar() {
        mysqli_close($this->cnx);
    }

}

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
session_start();

require_once './config/conect.php';

$login = new Login($_POST);

class Login {
    var $conexion;
    
    public function __construct($datos)
    {
        $this->usuario = $datos['usuario'];
        $this->password = $datos['password'];

        $this->conexion = new conexion();

        $resultado = $this->logueoUsuario();

        if ($resultado == 'existe') 
        {
            $controlador = $this->obtenerControlador($_SESSION['acceso']);

            header("location: app/controllers/$controlador");
        } 
        else 
        {
            ?>
            <script>
                alert("ERROR EN INICIO DE SESION \nUSUARIO O CLAVE INCORRECTA");
                javascrpit:history.back();
            </script>
            <?php
        }
    }
    /**
     * Función que controla el logueo del usuario
     *
     * @return string $resultado: resultado de consulta del usuario
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    public function logueoUsuario()
    {
        $resultado = "no existe";
        $usuario = $this->obtenerUsuario();

        if (isset($usuario[0]['id_usuario'])) {
            $acceso = $this->obtenerAcceso($usuario[0]['id_usuario']);

            $this->asignarSesion($usuario, $acceso['roles']);
            $this->registrarIngreso($usuario);

            $resultado = "existe";
        }

        return $resultado;
    }
    /**
     * Función que valida la existencia del usuario con los datos ingresados
     * por el cliente
     *
     * @return Array Retorna los datos del usuario consultado
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    private function obtenerUsuario()
    {
        $query = "SELECT * FROM usuarios WHERE usuario = '" . $this->usuario . "' "
                . "AND password = MD5('" . $this->password . "')";
        $resultado = $this->conexion->row($query);

        return $resultado;
    }
    /**
     * Función que se encarga de registrar la fecha y hora de acceso al aplicativo
     *
     * @return Boolean NULL
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    private function registrarIngreso($datos)
    {
        $ip = $this->obtenerIP();

        $query = "INSERT INTO control_acceso (usuario, tipo_ingreso, ip_ingreso, fecha_ingreso) VALUES"
                . "('" . $datos[0]['usuario'] . "', 'inicio_sesion', '$ip', NOW())";
        $this->conexion->ejecutar($query);
    }
    /**
     * Función que se encarga de registrar los datos del usuario consultados
     * en la variables $_SESSION
     *
     * @return Boolean NULL
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    private function asignarSesion($datos, $acceso)
    {
        date_default_timezone_set('America/Bogota');

        $date = new DateTime();
        $año = $date->format('Y');
        
        $password = 'Fianza' . $año . '*';
        
        $_SESSION['cambio_password'] = ($this->password == $password) ? 1 : 0;
        
        $fechaActual = date("m-d");
        $cumpleanios = explode("-", $datos[0]['fecha_nacimiento']);
        $activarCumpleanios = ($cumpleanios[1] .'-'. $cumpleanios[2] == $fechaActual) ? 1 : 0;
        
        $_SESSION['id_usuario'] = $datos[0]['id_usuario'];
        $_SESSION['usuario'] = $datos[0]['usuario'];
        $_SESSION['nombre'] = $datos[0]['nombre_completo'];
        $_SESSION['homologado'] = $datos[0]['homologado'];
        $_SESSION['fecha_creacion'] = $datos[0]['fecha_creacion'];
        $_SESSION['cumpleanios'] = $activarCumpleanios;
        $_SESSION['ultimo_ingreso'] = $datos[0]['ultimo_ingreso'];
        $_SESSION['estado_pausa'] = $datos[0]['estado_pausa'];
        $_SESSION['tiempo_pausa'] = (isset($datos[0]['tiempo_pausa'])) ? $datos[0]['tiempo_pausa'] : '';
        $_SESSION['estado'] = $datos[0]['estado'];
        $_SESSION['rol_actual'] = 0;
    }
    /**
     * Función que valida la IP publica del cliente
     *
     * @param type $datos
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    private function obtenerIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }
    /**
     * Función que consulta la cantidad de roles asignados que tiene el usuario
     *
     * @return Array $resultado: cantidad de roles asignados al usuario así como cada uno de ellos
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    private function obtenerAcceso($id_usuario)
    {
        $resultado = Array();

        $query = "SELECT ru.*, r.rol as nombre_rol, c.nombre_cliente "
                ."FROM roles_usuarios ru, roles r, clientes c, usuarios u "
                ."WHERE ru.id_rol = r.id_rol "
                ."AND ru.id_cliente = c.id_cliente "
                ."AND ru.id_usuario = u.id_usuario "
                ."AND ru.id_rol != '0' "
                ."AND u.id_usuario = '" . $id_usuario ."'"
                ."ORDER BY c.id_cliente ASC";
        $datos = $this->conexion->row($query);

        $resultado['cantidad'] = count($datos);

        $resultado['roles'] = $datos;
        $_SESSION['acceso'] = $datos;

        return $resultado;
    }
    /**
     * Función que define el controlador frontal que se va a usar por el usuario que está ingresando
     *
     * @param array $acceso: contiene tanto la cantidad de roles asignados, como la información de los mismos
     * @return string $controller: el nombre del controlador asignado para el cliente
     * @access private
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     */
    private function obtenerControlador($acceso)
    {
        if (count($acceso) <= 1) 
        {
            $query = "SELECT controlador, id_cliente FROM clientes WHERE id_cliente = '" . $acceso[0]['id_cliente'] . "'";
            $resultado = $this->conexion->row($query);
            
            $controller = $resultado[0]['controlador'] . '?&cartera=' . $resultado[0]['id_cliente'];
        }
        else
        {
            $controller = 'administracionController.php';
        }

        return $controller;
    }
}
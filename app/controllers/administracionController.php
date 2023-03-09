<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header("Content-Type: *");
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Credentials: true');

session_start();

if (isset($_POST['token']) && $_POST['token'] !== null) {
    $_SESSION = json_decode($_POST['usuario'], true);
    $_SESSION['_token'] = $_POST['token'];
}

include_once '../../config/conect.php';
include_once '../../config/apicon.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloAdministracion.php';

$administracion = new administracionController($_POST);

class administracionController
{
    var $claseAdministracion;
    var $claseInformes;
    var $claseUsuarios;
    var $plantillas;

    public function __construct($datos)
    {
        if (isset($_SESSION['_token']) && isset($_COOKIE['token_access'])) {
            $this->plantillas = new League\Plates\Engine('../../resources/views');

            $this->plantillas->registerFunction("codificarCaracteres", function ($cadena) {
                return utf8_decode(utf8_encode($cadena));
            });

            $this->claseAdministracion = new modeloAdministracion();

            $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
            $metodo = $datos['metodo'];

            $this->$metodo($datos);
        } else {
            header('Location: ../../sesion.php');
        }
    }

    /**
     * 
     * @param type $datos
     */
    public function paginaInicio($datos)
    {
        define("APLICACION", "administracion");

        $datos = $this->claseAdministracion->controlador($datos);

        if ($datos['clientes'] != null && count($datos['clientes']) >= 2) {
            $plantilla = $this->plantillas->render('administracion.html', array('datos' => $datos));

            echo $plantilla;
        } elseif ($datos['clientes'] != null && count($datos['clientes']) == 1) {
            header('location: carterasController.php?&cartera=' . $datos['clientes'][0]['id']);
        } else {
            header('location: ../../sesion.php');
        }
    }

    /**********************************************************************MODULOS*********************************************************************************************/

    public function obtenerModulo($datos)
    {
        $data = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render("administracion/" . $datos['tipo'] . ".html", ['datos' => $data]);
        echo $plantilla;
    }

    /**********************************************************************CREACIÓN*********************************************************************************************/

    public function crearRegistro($datos)
    {
        $return = $this->claseAdministracion->controlador($datos);
        echo json_encode($return);
    }

    public function guardarPermisos($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    /**********************************************************************EDICIÓN*********************************************************************************************/

    public function formularioEditarRegistro($datos)
    {
        $resultado = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('formulariosEdicion.html', [
            'parametro' => $datos['tipo'],
            'datos' => $resultado
        ]);
        echo $plantilla;
    }

    /**********************************************************************ELIMINACIÓN*********************************************************************************************/

    public function borrarRegistro($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        $retorno = json_encode(array(
            'resultado' => $resultado
        ));
        echo $retorno;
    }

    /**********************************************************************OBTENER*********************************************************************************************/

    public function buscarUsuarios($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', [
            'resultados' => $resultados,
            'parametro' => 'busquedaUsuarios'
        ]);
        echo $plantilla;
    }

    public function buscarMenusPermiso($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', [
            'resultados' => $resultados,
            'parametro' => 'busquedaMenusPermiso'
        ]);
        echo $plantilla;
    }

    public function perfilUsuario($datos)
    {
        $usuario = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('perfil.html', ['usuario' => $usuario]);
        echo $plantilla;
    }

    public function actualizarInformacionPersonal($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function validarCredenciales($datos = array())
    {
        $resultado = $this->claseAdministracion->controlador($datos);

        echo $resultado;
    }

    public function obtenerPermisos($datos)
    {
        $usuarios = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('formulariosEdicion.html', [
            'permisos' => $usuarios['permisos'],
            'roles' => $usuarios['roles'],
            'clientes' => $usuarios['clientes'],
            'usuario' => $datos['usuario'],
            'identificacion' => $datos['identificacion'],
            'parametro' => 'formularioPermisos'
        ]);
        echo $plantilla;
    }
}

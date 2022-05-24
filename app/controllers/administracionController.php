<?php

include_once '../../config/conect.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloAdministracion.php';
include_once '../../app/clases/modeloInformes.php';
include_once '../../app/clases/modeloUsuarios.php';

$administracion = new administracionController($_POST);

class administracionController
{

    var $claseAdministracion;
    var $claseInformes;
    var $claseUsuarios;
    var $plantillas;

    public function __construct($datos)
    {
        $this->plantillas = new League\Plates\Engine('../../resources/views');
        $this->claseAdministracion = new modeloAdministracion();
        $this->claseUsuarios = new modeloUsuarios();
        $this->claseInformes = new modeloInformes();

        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
        $metodo = $datos['metodo'];
        $this->{$metodo}($datos);
    }

    /**
     * 
     * @param type $datos
     */
    public function paginaInicio($datos)
    {
        define("APLICACION", "administracion");
        $datos = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracion.html', array('datos' => $datos));
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de usuarios, consultando los datos
     * de los usuario existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionUsuarios($datos)
    {
        $usuarios = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionUsuarios.html', [
            'usuarios' => $usuarios['usuarios'],
            'roles' => $usuarios['roles']
        ]);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de clientes, consultando los datos
     * de los usuario existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionClientes($datos)
    {
        $clientes = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracion/administracionClientes.html', [
            'clientes' => $clientes['clientes'],
            'roles' => $usuarios['roles']
        ]);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionRoles($datos)
    {
        $roles = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionRoles.html', ['roles' => $roles['roles']]);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionRegiones($datos)
    {
        $roles = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionGeograficos.html', ['parametro' => 'regiones']);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionDepartamentos($datos)
    {
        $roles = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionGeograficos.html', ['roles' => $roles['roles']]);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionCiudades($datos)
    {
        $roles = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionGeograficos.html', ['roles' => $roles['roles']]);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionPermisos($datos)
    {
        $menus = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracion/administracionPermisos.html', [
            'menus' => $menus['menus'],
            'roles' => $menus['roles'],
            'permisos' => $menus['permisos']
        ]);
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionCarga($datos)
    {
        //        $menus = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracion/administracionCarga.html');
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de administración de informes, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con 
     * dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionInformes($datos)
    {
        $archivos = array();
        $i = 0;
        $directorio = "../../public/archivos/descargas/" . $datos['cartera'] . ""; //ruta actual
        $archivos = $this->obtenerListadoDeArchivos($directorio);
        $plantilla = $this->plantillas->render('administracion/administracionInformes.html', [
            'cartera' => $datos['cartera'],
            'archivos' => $archivos
        ]);
        echo $plantilla;
    }

    /**
     * Función se encarga de obtener el listado de archivos de la carpeta de descargas de cada cartera
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return Array $res contiene los archivos obtenidos de la carpeta de descargas
     */
    private function obtenerListadoDeArchivos($directorio)
    {

        // Array en el que obtendremos los resultados
        $res = array();

        // Agregamos la barra invertida al final en caso de que no exista
        if (substr($directorio, -1) != "/")
            $directorio .= "/";

        // Creamos un puntero al directorio y obtenemos el listado de archivos
        $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
        while (($archivo = $dir->read()) !== false) {
            // Obviamos los archivos ocultos
            if ($archivo[0] == ".")
                continue;
            if (is_dir($directorio . $archivo)) {
                continue;
            } else if (is_readable($directorio . $archivo)) {
                $res[] = array(
                    "Nombre" => $archivo,
                    "Ruta" => $directorio . $archivo,
                    "Tamaño" => filesize($directorio . $archivo),
                    "Modificado" => filemtime($directorio . $archivo)
                );
            }
        }
        $dir->close();
        return $res;
    }

    /**
     * Esta function crea un nuevo usuario en la base de datos de acuerdo a los criterios
     * del formulario.
     * 
     * @param Array $datos contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String ok: La consulta retorna un ingreso correcto
     *                fallo: La consulta retorna un ingreso incorrecto
     */
    public function crearNuevoUsuario($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    /**
     * Esta function crea un nuevo usuario en la base de datos de acuerdo a los criterios
     * del formulario.
     * 
     * @param Array $datos contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String ok: La consulta retorna un ingreso correcto
     *                fallo: La consulta retorna un ingreso incorrecto
     */
    public function crearTelefono($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    /**
     * Esta function crea un nuevo registro en la base de datos de acuerdo a los criterios
     * del formulario.
     * 
     * @param Array $datos contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String ok: La consulta retorna un ingreso correcto
     *                fallo: La consulta retorna un ingreso incorrecto
     */
    public function creacionRegistro($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1 || $respuesta <= -1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    /**
     * Función que obtiene los permisos de un usuario y construye 
     * un formulario para el modal de edición de permisos
     * 
     * @param Array $datos contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     * 
     */
    public function obtenerPermisos($datos)
    {
        $usuarios = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoFormularios.html', [
            'permisos' => $usuarios['permisos'],
            'roles' => $usuarios['roles'],
            'clientes' => $usuarios['clientes'],
            'usuario' => $datos['usuario'],
            'identificacion' => $datos['identificacion'],
            'parametro' => 'formularioPermisos'
        ]);
        echo $plantilla;
    }

    /**
     * Funcion que almacena los permisos por campaña para cada usuario
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function guardarPermisos($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    /**
     * Funcion que se encarga de borrar un registro de acuerdo al parametro enviado
     * dede el formulario.
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String $retorno: array json con la información de resultado de la consulta 
     *                          y la función javascript a ejecutar
     */
    public function borrarRegistro($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1 || $respuesta <= -1) ? 'ok' : 'fallo';

        $retorno = json_encode(array(
            'resultado' => $resultado,
            'ajax' => $datos['ajax']
        ));
        echo $retorno;
    }

    /**
     * Función que construye el formulario de edición de acuerdo al parametro enviado
     * 
     * @param type $datos
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String $resultado: array json con la información de resultado de la consulta 
     *                          y la función javascript a ejecutar
     */
    public function formularioEditarRegistro($datos)
    {
        $resultado = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoFormularios.html', [
            'parametro' => $datos['tipo'],
            'datos' => $resultado
        ]);
        echo $plantilla;
    }

    /**
     * Funcion que se encarga de editar un registro de acuerdo al parametro enviado
     * dede el formulario.
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String $retorno: array json con la información de resultado de la consulta 
     *                          y la función javascript a ejecutar
     */
    public function editarRegistro($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1 || $respuesta <= -1) ? 'ok' : 'fallo';

        $retorno = json_encode(array(
            'resultado' => $resultado,
            'ajax' => $datos['ajax']
        ));
        echo $retorno;
    }

    /**
     * 
     * @param type $datos
     */
    public function buscarUsuarios($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', [
            'resultados' => $resultados,
            'parametro' => 'busquedaUsuarios'
        ]);
        echo $plantilla;
    }

    
    /**
     * 
     * @param type $datos
     */
    public function buscarMenusPermiso($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', [
            'resultados' => $resultados,
            'parametro' => 'busquedaMenusPermiso'
        ]);
        echo $plantilla;
    }

    /**
     * 
     * @param type $datos
     */
    public function perfilUsuario($datos)
    {
        $usuario = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('perfil.html', ['usuario' => $usuario]);
        echo $plantilla;
    }

    /**
     * 
     * @param type $datos
     */
    public function actualizarInformacionPersonal($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function obtenerAlarmas($datos)
    {
        $resultado = $this->claseAdministracion->controlador($datos);
        //        $factura = $this->claseVentas->obtenerUltimaFactura($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', [
            'factura' => $factura,
            'parametro' => 'construirTablaFacturacion'
        ]);

        echo $plantilla;
    }

    public function generarInforme($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoInformes.html', [
            'factura' => $factura,
            'parametro' => 'construirTablaFacturacion',
            'resultados' => $resultado
        ]);
        echo $plantilla;
    }

    /**
     * Función que reestablece la contraseña del usuarios
     * @param Array $datos contiene el id del usuario
     * @return string : Ok si fue satisfactorio, fallo si no.
     */
    public function reestablecerContraseña($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    /**
     * Función que construye el formulario de edición de acuerdo al parametro enviado
     *
     * @param type $datos
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String $resultado: array json con la información de resultado de la consulta
     *                          y la función javascript a ejecutar
     */
    public function formularioEditarDemografico($datos)
    {
        $resultado = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoFormularios.html', [
            'parametro' => $datos['tipo'],
            'datos' => $resultado
        ]);

        $respuesta = json_encode(array(
            "plantilla" => $plantilla,
            "valor" => utf8_encode($resultado[0]['tipo']), "estado" => $resultado[0]['estado']
        ));
        echo $respuesta;
    }

    /**
     * @param $datos
     */
    public function editarDemografico($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/resultadoFormularios.html', [
            'parametro' => $datos['accion'],
            'datos' => $respuesta['datos']
        ]);
        $resultado = ($respuesta >= 1 || $respuesta <= -1) ? 'ok' : 'fallo';

        $retorno = json_encode(array(
            'resultado' => $resultado,
            'div' => $datos['div'], 'plantilla' => $plantilla
        ));
        echo $retorno;
    }

    /**
     * @param $datos
     */
    public function editarHomologado($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        echo $respuesta;
    }
    

}

<?php

include_once '../../config/conect.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloCarteras.php';
include_once '../../app/clases/modeloAdministracion.php';
include_once '../../app/clases/modeloInformes.php';
include_once '../../app/clases/modeloUsuarios.php';
use League\Csv\Writer;


$datos = (empty($_POST)) ? $_GET : $_POST;
$carteras = new carterasController($datos);

class carterasController {

    var $claseCarteras;
    var $claseAdministracion;
    var $claseInformes;
    var $claseUsuarios;
    var $plantillas;
    var $csv;

    public function __construct($datos)
    {
        $this->plantillas = new League\Plates\Engine('../../resources/views');
        ////$this->csv = Writer::createFromFileObject(new SplTempFileObject());
        $this->claseCarteras = new modeloCarteras();
        $this->claseAdministracion = new modeloAdministracion();
        $this->claseInformes = new modeloInformes();

        $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
        $this->$datos['metodo']($datos);
    }

    /**
     * Función que construye el módulo de gestión de cada una de las carteras
     * 
     * @param array $datos contiene la información para el cargue de la cartera
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return string $plantilla imprime la plantilla con los datos cargados
     */
    public function paginaInicio($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        $rol_actual = 0;
        foreach($_SESSION['acceso'] as $acceso){
            if($acceso['id_cliente'] == $data['cartera'][0]['id_cliente']){
                $rol_actual = $acceso['id_rol'];
                $_SESSION['rol_actual'] = $acceso['id_rol'];
                break;
            }
        }
        
        $plantilla = $this->plantillas->render('carteras/moduloGestion.html', Array('cartera' => $data['cartera'],
            'cliente' => $data['cliente'],
            'gestion' => $data['gestion'],
            'historial' => $data['historial'],
            'carteraActual' => $datos['cartera']));
        echo $plantilla;
    }

    /**
     * Función que construye el módulo de gestión de acuerdo al criterio de busqueda
     *
     * @param Array $datos contiene el criterio y el tipo de dato para la busqueda
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function buscarDeudor($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        file_put_contents("/tmp/dataBusqueda.txt", print_r($data, true));
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', Array('cartera' => $data['cartera'],
            'cliente' => $data['cliente'],
            'gestion' => $data['gestion'],
            'historial' => $data['historial'],
            'parametro' => 'busquedaDeudor',    
            'carteraActual' => $datos['cartera']));

        $resultado = (!empty($data['cliente']['cliente'])) ? 'ok' : 'fallo';
        $retorno = json_encode(Array('plantilla' => utf8_encode($plantilla),
            'resultado' => $resultado));

        

        echo $plantilla;
    }

    /**
     * Función que construye el módulo de gestión de acuerdo al criterio de busqueda
     * después de crear un registro para algún cliente
     *
     * @param Array $datos contiene el criterio y el tipo de dato para la busqueda
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function buscarDeudorRecarga($datos)
    {   
        $data = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', Array('cartera' => $data['cartera'],
            'cliente' => $data['cliente'],
            'gestion' => $data['gestion'],
            'historial' => $data['historial'],
            'parametro' => 'busquedaDeudorRecarga',
            'carteraActual' => $datos['cartera']));

        $resultado = (!empty($data['cliente']['cliente'])) ? 'ok' : 'fallo';
        $retorno = json_encode(Array('plantilla' => utf8_encode($plantilla),
            'resultado' => $resultado));

        

        echo $plantilla;
    }

    /**
     * Función que construye el módulo de gestión de acuerdo al criterio de busqueda
     *
     * @param Array $datos contiene el criterio y el tipo de dato para la busqueda
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function buscarDeudoresTarea($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', Array('cartera' => $data['cartera'],
            'cliente' => $data['cliente'],
            'gestion' => $data['gestion'],
            'tarea' => $datos['tarea'],
            'historial' => $data['historial'],
            'parametro' => 'busquedaDeudorTarea',
            'carteraActual' => $datos['cartera']));

        $resultado = (isset($data['cliente']['cliente'])) ? 'ok' : 'fallo';
        $retorno = json_encode(Array('plantilla' => utf8_encode(utf8_decode($plantilla)),
            'resultado' => $resultado));

        echo $retorno;
    }

    /**
     * Función que obtiene formularios de ultilidades varias dependiendo el parametro
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function formulariosVarios($datos)
    {
        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', ['parametro' => $datos['parametro'], 'carteraActual' => $datos['cartera']]);
        echo $plantilla;
    }

    /**
     * Función que obtiene los datos de contacto de acuerdo a la acción 
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return Array restultado contiene los parametros de contacto
     */
    public function obtenerContactosAccion($datos)
    {
        $resultado = Array();
        $contactos = $this->claseCarteras->controlador($datos);
        $contador = sizeof($contactos);
        $resultado['contacto'] = $contactos;
        $resultado['contador'] = $contador;
        $resultado = json_encode($resultado);
        echo $resultado;
    }

    /**
     * Función que obtiene los datos de efecto de acuerdo al contacto
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return Array restultado contiene los parametros de efecto
     */
    public function obtenerEfectosContacto($datos)
    {
        $resultado = Array();
        $respuesta = $this->claseCarteras->controlador($datos);
        $contador = sizeof($respuesta['efectos']);
        $resultado['efecto'] = $respuesta['efectos'];
        $resultado['contador'] = $contador;
        $resultado['motivos'] = $respuesta['motivos'];
        $resultado = json_encode($resultado);
        echo $resultado;
    }

    public function guardarGestion($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
    }

    public function refrescarHistorico($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', ['parametro' => 'tablaHistorico',
            'datos' => $resultado]);
        echo $plantilla;
    }
    
    public function refrescarDemograficos($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', ['parametro' => 'tablaHistorico',
            'datos' => $resultado]);
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
    public function autocompletar($datos)
    {
        parse_str($datos['datos'], $formulario);
        $guion = $this->claseCarteras->controlador($datos);
        $guion = str_replace('+telefono+', $formulario['telefonos'], utf8_encode($guion[0]['guion']));
        $guion = str_replace('+obligacion+', $formulario['obligacion'], $guion);
        $guion = str_replace('+valor_acuerdo+', $formulario['valor_acuerdo'], $guion);
        $guion = str_replace('+tipo_negociacion+', $formulario['tipo_negociacion'], $guion);
        echo $guion;
    }

    /**
     * Función que construye el módulo de administración de roles, consultando los datos
     * de los roles existentes en la base, posteriormente renderiza la plantilla con dichos datos
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionTareas($datos)
    {
        $tareas = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/administracionTareas.html', ['tareas' => $tareas]);
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
        $plantilla = $this->plantillas->render('administracion/administracionPermisos.html', ['menus' => $menus['menus'],
            'roles' => $menus['roles'],
            'permisos' => $menus['permisos']]);
        echo $plantilla;
    }

    /**
     * 
     * 
     * @param Array $datos: contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String plantilla renderizada con la información requerida
     */
    public function administracionInformes($datos)
    {
        session_start();
        $plantilla = $this->plantillas->render('administracionInformes.html', ['perfil' => $_SESSION['perfil']]);
        echo $plantilla;
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
     * Esta function crea un nuevo formulario para crear registros según sea requerido
     * 
     * @param Array $datos contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String ok: La consulta retorna un ingreso correcto
     *                fallo: La consulta retorna un ingreso incorrecto
     */
    public function formulariosCreacionRegistro($datos){
        $plantilla = $this->plantillas->render('carteras/formulariosCreacion.html', ['parametro' => $datos['parametro'],
            'datos' => $datos]);
        echo $plantilla;
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
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';
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
        $plantilla = $this->plantillas->render('resultadoFormularios.html', ['permisos' => $usuarios['permisos'],
            'roles' => $usuarios['roles'],
            'clientes' => $usuarios['clientes'],
            'usuario' => $datos['usuario'],
            'parametro' => 'formularioPermisos']);
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

        $retorno = json_encode(Array('resultado' => $resultado,
            'ajax' => $datos['ajax']));
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
        $plantilla = $this->plantillas->render('resultadoFormularios.html', ['parametro' => $datos['tipo'],
            'datos' => $resultado]);
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

        $retorno = json_encode(Array('resultado' => $resultado,
            'ajax' => $datos['ajax']));
        echo $retorno;
    }

    /**
     * 
     * @param type $datos
     */
    public function buscarUsuarios($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaUsuarios']);
        echo $plantilla;
    }

    /**
     * 
     * @param type $datos
     */
    public function buscarMenusPermiso($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaMenusPermiso']);
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
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['factura' => $factura,
            'parametro' => 'construirTablaFacturacion']);

        echo $plantilla;
    }

    public function generarInforme($datos)
    {

        $retorno = $this->claseCarteras->controlador($datos);
        $array = array();
        echo $retorno;
    }

    /**
     * Función para realizar carga de los archivos
     * 
     * @param type $datos
     * @return String Mensaje devuelto por la carga
     */
    public function cargarArchivo($datos)
    {
        $mensaje = $this->$datos['tipo']($datos);
        echo $mensaje;
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
        $menus = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracion/administracionCarga.html', ['cartera' => $datos['carteraActual']]);
        echo $plantilla;
    }

    /**
     * 
     * 
     */
    public function cargarAsignacion($datos)
    {
        $fecha = date('Y-m');
        $ruta = '../../public/archivos/cargas/asignacion' . $fecha . '.csv';
        $resultado = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

        $return = $this->claseCarteras->controlador(array('ruta' => $ruta, 'metodo' => 'cargarAsignacion',
            'cartera' => $datos['cartera']));
        echo $return;
    }

    /**
     * 
     * @param type $datos
     */
    public function cargarTarea($datos)
    {
        
        $fecha = date('Y-m');
        $ruta = '../../public/archivos/cargas/tarea' . $fecha . '.csv';
        $resultado = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        
        $return = $this->claseCarteras->controlador(array('ruta' => $ruta, 'metodo' => 'cargarTarea',
            'cartera' => $datos['cartera'],
            'datos' => $datos));
        echo $return;
    }

    /**
     * 
     * @param type $datos
     */
    public function consultarTareas($datos)
    {
        $tareas = $this->claseCarteras->controlador($datos);
        $cantidad = count($tareas);
        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', ['parametro' => 'listadoTareas',
            'tareas' => $tareas]);
        $retorno = json_encode(Array('plantilla' => $plantilla,
            'cantidad' => $cantidad));
        echo $retorno;
    }

    /**
    *
    *
    */
    public function administracionCartera($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/administracionCartera.html', ['cartera' => $datos['carteraActual'], 'datos' => $data]);
        echo $plantilla;
    }

     /**
    * Esta función crea un nuevo item homologado de acuerdo a los parametros de cada lider de campaña
    *
    * @param Type array: $datos contiene la información requerida para parametrizar las consultas
    * @return type int: $retorno:retorna la cantidad de items afectados
    **/
    public function crearHomologado($datos){
        $resultado = $this->claseCarteras->controlador($datos);
        $retorno = (count($resultado) >= 1)? 'ok': 'fallo';

        return $retorno;  
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
     * Esta function crea un nuevo usuario en la base de datos de acuerdo a los criterios
     * del formulario.
     * 
     * @param Array $datos contiene el metodo al que apunta y datos adicionales opcionales
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String ok: La consulta retorna un ingreso correcto
     *                fallo: La consulta retorna un ingreso incorrecto
     */
    public function estadoTarea($datos)
    {
        $respuesta = $this->claseCarteras->controlador($datos);

        $resultado = json_encode($respuesta);

        echo $resultado;
    }


}


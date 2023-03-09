<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header("Content-Type: *");
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Credentials: true');

session_start();

include_once '../../config/conect.php';
include_once '../../config/apicon.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloAdministracion.php';
include_once '../../app/clases/modeloCarteras.php';
include_once '../../app/clases/modeloUsuarios.php';
include_once 'GenerarPDFdom.php';
include_once 'enviarMails.php';
$datos = (empty($_POST)) ? $_GET : $_POST;
$carteras = new carterasController($datos);

class carterasController
{
    var $claseCarteras;
    var $claseAdministracion;
    var $claseUsuarios;
    var $plantillas;
    public function __construct($datos)
    {
        $this->plantillas = new League\Plates\Engine('../../resources/views');

        $this->plantillas->registerFunction("codificarCaracteres", function ($cadena) {
            return utf8_decode(utf8_encode($cadena));
        });

        $this->claseAdministracion = new modeloAdministracion();
        $this->claseCarteras = new modeloCarteras();
        $this->asignarCartera($datos);
        if (!isset($_SESSION['usuario']) || !isset($_COOKIE['token_access'])) {
            header('Location: ../../sesion.php');
            die();
        }

        if (isset($_SESSION['carteraActual'])) {
            if ($this->validarCartera($_SESSION['carteraActual'])) {
                $datos['metodo'] = (isset($datos['metodo'])) ? $datos['metodo'] : 'paginaInicio';
                $metodo = $datos['metodo'];
                $this->$metodo($datos);
            } else {
                echo "<script>location.replace('administracionController.php')</script>";
            }
        }
    }

    private function asignarCartera($datos)
    {
        $_SESSION['carteraActual'] = (isset($datos['cartera'])) ? $datos['cartera'] : $_SESSION['carteraActual'];
        $_SESSION['nombreCartera'] = $this->claseCarteras->obtenerInformacionCartera($_SESSION['carteraActual'])[0]['nombre'];
    }

    public function paginaInicio($datos)
    {
        $data = $this->claseCarteras->controlador($datos);

        foreach ($_SESSION['acceso'] as $acceso) {
            if ($acceso['cliente_id'] == $data['cartera'][0]['id']) {
                $_SESSION['rol_actual'] = ($_SESSION['admin'] == 1) ? 1 : $acceso['rol'];
                break;
            }
        }

        $plantilla = $this->plantillas->render('carteras/moduloGestion.html', $data);

        echo $plantilla;
    }

    /************************************************************************************************MODULOS************************************************************************************************************/
    public function moduloGestion($data)
    {
        $plantilla = $this->plantillas->render('carteras/gestion/gestion.html', $data);

        return $plantilla;
    }

    public function exportarDeudorDemografico($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);

        $plantilla = $this->plantillas->render(
            'carteras/formulariosVarios.html',
            ['datos' => $resultado, 'parametro' => $datos['metodo']]
        );
        echo $plantilla;
    }

    public function obtenerModulo($datos)
    {
        switch ($datos['tipo']) {
            case 'administracionCarga':
                $directorio = "../../public/archivos/cargas/" . $_SESSION['carteraActual'] . ""; //ruta actual
                $data = '';
                $this->validarRutas($directorio);
                break;
            case 'administracionInformes':
                $directorio = "../../public/archivos/descargas/" . $_SESSION['carteraActual'] . ""; //ruta actual
                $this->validarRutas($directorio);
                $data['archivos'] = $this->obtenerListadoDeArchivos($directorio);
                break;
            default:
                $data = $this->claseCarteras->controlador($datos);
                break;
        }
        $plantilla = $this->plantillas->render("carteras/" . $datos['tipo'] . ".html", ['datos' => $data]);
        echo $plantilla;
    }

    public function validarRutas($directorio)
    {
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }
    }

    public function formulariosVarios($datos)
    {
        $plantilla = $this->plantillas->render(
            'carteras/formulariosVarios.html',
            [
                'parametro' => $datos['parametro'],
                'carteraActual' => $_SESSION['carteraActual'],
                'datos' => $datos
            ]
        );

        echo $plantilla;
    }

    public function buscarDeudor($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        $plantilla = $this->moduloGestion($data);
        echo $plantilla;
    }

    private function obtenerListadoDeArchivos($directorio)
    {

        $res = array();

        if (substr($directorio, -1) != "/")
            $directorio .= "/";
        $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
        while (($archivo = $dir->read()) !== false) {
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

    public function generarInforme($datos)
    {
        $retorno = $this->claseCarteras->controlador($datos);
        echo json_encode($retorno);
    }


    public function parametroArbol($datos)
    {
        $parametros = $this->claseCarteras->controlador($datos);

        $plantilla = $this->plantillas->render('carteras/resultadoFormularios.html', [
            'parametros' => $parametros, 'parametro' => 'formularioArbol',
            'tipo' => $datos['tipo'],
            'cartera' => $datos['cartera'],
            'parametro_id' => $datos['parametro']
        ]);

        echo $plantilla;
    }

    public function obtenerContactosAccion($datos)
    {
        $resultado = array();
        $contactos = $this->claseCarteras->controlador($datos);
        $contador = sizeof($contactos);
        $resultado['contacto'] = $contactos;
        $resultado['contador'] = $contador;
        $resultado = json_encode($resultado);
        echo $resultado;
    }

    public function obtenerEfectosContacto($datos)
    {
        $resultado = array();
        $respuesta = $this->claseCarteras->controlador($datos);
        $contador = sizeof($respuesta['efectos']);
        $resultado['efecto'] = $respuesta['efectos'];
        $resultado['contador'] = $contador;
        $retorno = json_encode($resultado);
        echo $retorno;
    }

    public function obtenerCalendario($datos)
    {
        $eventos = $this->claseCarteras->controlador($datos);
        $eventos = json_encode($eventos);

        echo $eventos;
    }

    public function obtenerScoring($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo json_encode($resultado);
    }

    public function obtenerRanking($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo json_encode($resultado);
    }

    public function searchObligatoriedad($datos)
    {
        $respuesta = array();
        $resultado = $this->claseCarteras->controlador($datos);
        echo json_encode($resultado);
    }

    public function buscarGuion($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        $resultado[0]['guion'] = (isset($resultado[0]['guion'])) ? $resultado[0]['guion'] : '';
        echo json_encode($resultado[0]['guion']);
    }

    private function homologadoGevening($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo (isset($resultado[0]['id'])) ? $resultado[0]['id'] : '';
    }

    public function formulariosSolicitudes($datos)
    {
        $datos = $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/formularioSolicitudes.html', ['datos' => $datos]);
        echo $plantilla;
    }

    public function enviarSolicitud($datos)
    {
        $result = $this->claseCarteras->controlador($datos);
        echo json_encode($result);
    }

    public function actualizarFecha($datos)
    {
        $result = $this->claseCarteras->controlador($datos);
        echo json_encode($result);
    }

    /************************************************************************************************CREACIÓN************************************************************************************************************/

    public function crearParametroArbol($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        $retorno = ($resultado >= 1) ? 'ok' : 'fallo';

        echo $retorno;
    }

    public function crearHomologado($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo json_encode($resultado);
    }

    public function crearRegistro($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        echo json_encode($data);
    }

    public function cargarArchivo($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        echo json_encode($data);
    }

    public function guardarGestion($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
    }

    public function creacionDemografico($datos)
    {
        $return = array();
        $respuesta = $this->claseCarteras->controlador($datos);

        $resultado = 'ok';

        $plantilla = $this->plantillas->render('carteras/resultadoFormularios.html', [
            'parametro' => $datos['accion'],
            'datos' => $respuesta['datos']
        ]);

        $return['plantilla'] = $plantilla;
        $return['respuesta'] = $resultado;
        $return['div'] = $datos['div'];

        echo json_encode($return);
    }


    public function camposFormGestion($datos)
    {
        $div = $datos['div'];
        unset($datos['div']);

        $this->claseCarteras->controlador($datos);

        $inputs_gestion = $this->claseCarteras->obtenerInputsGestion($_SESSION['carteraActual']);
        $inputs_opciones = $this->claseCarteras->obtenerOpcionesInputGestion($inputs_gestion);

        echo json_encode(array('resultado' => 'ok', 'mensaje' => 'La asignación fue importada con exito'));
    }

    public function establecerPosicion($datos)
    {

        $respuesta = $this->claseCarteras->controlador($datos);

        if ($respuesta == 1)
            echo 1;
        else
            echo 0;
    }

    public function habilitarColumnas($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        echo json_encode($data);
    }

    public function actualizarTituloInformacion($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        echo json_encode($data);
    }

    /************************************************************************************************EDICIÓN************************************************************************************************************/

    public function formularioEditarRegistro($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);

        $plantilla = $this->plantillas->render('formulariosEdicion.html', [
            'parametro' => $datos['tipo'],
            'datos' => $resultado
        ]);

        echo $plantilla;
    }

    /************************************************************************************************ELIMINACIÓN************************************************************************************************************/

    public function borrarRegistro($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        echo json_encode($data);
    }

    public function eliminarArchivo($datos)
    {
        $archivo = '../../public/archivos/descargas/' . $_SESSION['carteraActual'] . '/' . $datos['archivo'];
        if (!is_file($archivo)) {
            return "No existe el archivo";
        }
        if (!unlink($archivo)) {
            return "No se elimino el archivo";
        }
        echo "Se ha eliminado con exito";
    }

    public function borrarContenidoCarpeta($datos)
    {
        $dir = '../../public/archivos/descargas/' . $_SESSION['carteraActual'] . '/';
        $files = scandir($dir);
        $ficherosEliminados = 0;
        foreach ($files as $f) {
            if (is_file($dir . $f)) {
                if (unlink($dir . $f)) {
                    $ficherosEliminados++;
                }
            }
        }
        $respuesta = "Se han eliminado : <strong>" . $ficherosEliminados . "</strong> ficheros correctamente";
        echo $respuesta;
    }

    /************************************************************************************************OBTENER************************************************************************************************************/

    public function refrescarHistorico($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo $resultado;
    }

    public function consultarNotificaciones($datos)
    {
        $notificaciones = $this->claseCarteras->controlador($datos);

        $cantidad = count($notificaciones['agendamiento']);

        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', [
            'parametro' => 'listadoNotificaciones',
            'notificaciones' => $notificaciones
        ]);

        $retorno = json_encode(array(
            'plantilla' => $plantilla,
            'cantidad' => $cantidad
        ));

        echo $retorno;
    }

    public function consultarTareas($datos)
    {
        $tareas = $this->claseCarteras->controlador($datos);
        $cantidad = count($tareas);
        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', [
            'parametro' => 'listadoTareas',
            'tareas' => $tareas
        ]);
        $retorno = json_encode(array(
            'plantilla' => $plantilla,
            'cantidad' => $cantidad
        ));
        echo $retorno;
    }

    public function buscarDeudoresTarea($datos)
    {
        $data = $this->claseCarteras->controlador($datos);
        $plantilla = $this->moduloGestion($data);
        echo $plantilla;
    }

    public function iniciarPausa($datos)
    {
        $this->claseCarteras->controlador($datos);
        $plantilla = $this->plantillas->render('carteras/formulariosVarios.html', ['parametro' => $datos['parametro'], 'carteraActual' => $datos['cartera'], 'datos' => $datos]);
        echo $plantilla;
    }

    public function guardarTiemposSesion($datos = array())
    {
        $segundos = $this->horaASegundos($datos['tiempo']);
        $_SESSION['tiempo_pausa'] = $segundos;
        $_SESSION['tipo_pausa'] = $datos['tipo'];
        // $_SESSION['label_pausa'] = $datos['label'];
    }

    public function horaASegundos($pa6)
    {
        list($h, $m, $s) = explode(':', $pa6);
        return ($h * 3600) + ($m * 60) + $s;
    }

    public function guardarTiempoMuerto($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
    }

    public function estadoTarea($datos)
    {
        $respuesta = $this->claseCarteras->controlador($datos);

        $resultado = json_encode($respuesta);

        echo $resultado;
    }

    public function busquedaReferencia($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);

        $plantilla = $this->plantillas->render('carteras/resultadoFormularios.html', [
            'parametro' => 'busquedaReferencia',
            'datos' => $datos, 'resultado' => $resultado
        ]);
        echo $plantilla;
    }

    public function busquedaEfecto($datos)
    {
        $retornar = array();
        $resultado = $this->claseCarteras->controlador($datos);

        $retornar['efecto'] = $resultado;
        echo json_encode($retornar);
    }

    public function administrarObligatoriedad($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);

        $plantilla = $this->plantillas->render('carteras/resultadoFormularios.html', [
            'parametros' => $resultado,
            'parametro' => 'parametroObligatoriedad', 'cartera' => $datos['cartera'],
            'accion' => $datos['accion'], 'contacto' => $datos['contacto'], 'efecto' => $datos['efecto']
        ]);

        echo $plantilla;
    }

    public function guardarObligatoriedad($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        $respuesta = ($resultado >= 1) ? 'ok' : 'fallo';
        echo json_encode($respuesta);
    }

    private function validarCartera($cartera)
    {
        // $_SESSION['acceso'] = $this->claseAdministracion->obtenerAccesos();

        for ($indice = 0; $indice < count($_SESSION['acceso']); $indice++) {
            if ($_SESSION['acceso'][$indice]['cliente_id'] == $cartera) {
                return true;
                break;
            }
        }

        if ($indice == count($_SESSION['acceso'])) {
            return false;
        }
    }

    public function disponibilidadAgenda($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo json_encode($resultado);
    }

    public function obtenerUsuariosCartera($datos)
    {
        $resultado = $this->claseCarteras->controlador($datos);
        echo json_encode($resultado);
    }
}

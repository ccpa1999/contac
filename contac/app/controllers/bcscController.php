<?php

include_once '../../config/conect.php';
include_once '../../vendor/autoload.php';
include_once '../../app/clases/modeloClientes.php';
include_once '../../app/clases/modeloAdministracion.php';
include_once '../../app/clases/modeloInformes.php';
include_once '../../app/clases/modeloInventario.php';
include_once '../../app/clases/modeloUsuarios.php';
include_once '../../app/clases/modeloVentas.php';
include_once '../../app/clases/logicaFacturacion.php';

$lavacascos = new lavacascosController($_POST);

class lavacascosController {

    var $claseClientes;
    var $claseAdministracion;
    var $claseVentas;
    var $claseInformes;
    var $claseInventario;
    var $claseUsuarios;
    var $claseLogicaFacturacion;
    var $plantillas;

    public function __construct($datos)
    {
        $this->plantillas = new League\Plates\Engine('../../resources/views');
        $this->claseClientes = new modeloClientes();
        $this->claseAdministracion = new modeloAdministracion();
        $this->claseUsuarios = new modeloUsuarios();
        $this->claseVentas = new modeloVentas();
        $this->claseInformes = new modeloInformes();
        $this->claseInventario = new modeloInventario();
        $this->claseLogicaFacturacion = new logicaFacturacion();

        if (isset($datos['metodo'])) {
            $this->$datos['metodo']($datos);
        }
    }

    public function obtenerClientes($datos)
    {
        $clientes = $this->claseClientes->controlador($datos);
        $plantilla = $this->plantillas->render('clientes.html', ['clientes' => $clientes]);
        echo $plantilla;
    }

    public function cargarAdministracion($datos)
    {
        $clientes = $this->claseClientes->controlador($datos);
        $plantilla = $this->plantillas->render('administracion.html');
        echo $plantilla;
    }

    public function administracionUsuarios($datos)
    {
        $usuarios = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionUsuarios.html', ['usuarios' => $usuarios['usuarios'],
            'puntos_servicio' => $usuarios['puntos']]);
        echo $plantilla;
    }

    public function administracionCostos($datos)
    {
        $costos = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionCostos.html', ['costos' => $costos]);
        echo $plantilla;
    }

    public function administracionValorServicios($datos)
    {
        $valorServicios = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionValorServicios.html', ['servicios' => $valorServicios['servicios']]);
        echo $plantilla;
    }

    public function administracionDescuentos($datos)
    {
        $valorDescuentos = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionDescuentos.html', ['descuentos' => $valorDescuentos['descuentos'],
            'servicios' => $valorDescuentos['servicios']]);
        echo $plantilla;
    }

    public function administracionMantenimientos($datos)
    {
        $tiposMantenimiento = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionMantenimientos.html', ['mantenimientos' => $tiposMantenimiento['mantenimientos']]);
        echo $plantilla;
    }

    public function administracionInsumos($datos)
    {
        $insumos = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionInsumos.html', ['insumos' => $insumos]);
        echo $plantilla;
    }

    public function administracionPuntosServicio($datos)
    {
        $puntosServicio = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('administracionPuntosServicio.html', ['puntos_servicio' => $puntosServicio['puntos'],
            'ciudades' => $puntosServicio['ciudades'],
            'usuarios' => $puntosServicio['usuarios']]);
        echo $plantilla;
    }

    public function administracionInformes($datos)
    {
        session_start();
        $plantilla = $this->plantillas->render('administracionInformes.html', ['perfil' => $_SESSION['perfil']]);
        echo $plantilla;
    }

    public function administracionInventario($datos)
    {
        session_start();
        if ($_SESSION['perfil'] == 1) {
            $datos['punto_servicio'] = '';
            $inventarios = $this->claseAdministracion->controlador($datos);
            $plantilla = $this->plantillas->render('administracionInventarios.html', ['parametro' => 'admin',
                'inventarios' => $inventarios['inventarios'],
                'puntos_servicio' => $inventarios['puntos'],
                'insumos' => $inventarios['insumos']]
            );
        } else {
            $datos['punto_servicio'] = $_SESSION['punto_servicio'];
            $inventarios = $this->claseAdministracion->controlador($datos);
            $plantilla = $this->plantillas->render('administracionInventarios.html', ['parametro' => 'otro',
                'inventarios' => $inventarios['inventarios'],
                'insumos' => $inventarios['insumos']]);
        }

        echo $plantilla;
    }

    public function crearNuevoUsuario($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoServicio($datos)
    {

        $confirmacionImagen = $this->cargarImagen($datos);
        $respuesta = 0;
        if (isset($confirmacionImagen['imagen'])) {
            $datos['imagen'] = $confirmacionImagen['imagen'];
            $respuesta = $this->claseAdministracion->controlador($datos);
        }
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoDescuento($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoInsumo($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoTipoMantenimiento($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoPuntoServicio($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoCliente($datos)
    {
        $respuesta = $this->claseClientes->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function crearNuevoInventario($datos)
    {
        $respuesta = $this->claseAdministracion->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function buscarCedulaCliente($datos)
    {
        $resultados = $this->claseClientes->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaClientes']);
        echo $plantilla;
    }

    public function buscarCedulaClienteFacturacion($datos)
    {
        $resultados = $this->claseClientes->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaClientesFacturacion']);
        echo $plantilla;
    }

    public function buscarServicios($datos)
    {
        $resultados = $this->claseVentas->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaServicios']);
        echo $plantilla;
    }

    public function buscarUsuarios($datos)
    {
        $resultados = $this->claseUsuarios->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaUsuarios']);
        echo $plantilla;
    }

    public function buscarTiposMantenimiento($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaTiposMantenimiento']);
        echo $plantilla;
    }

    public function buscarDescuentos($datos)
    {
        $resultados = $this->claseVentas->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaDescuentos']);
        echo $plantilla;
    }

    public function buscarInsumos($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaInsumos']);
        echo $plantilla;
    }

    public function buscarInventarios($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaInventarios']);
        echo $plantilla;
    }

    public function buscarPuntosServicio($datos)
    {
        $resultados = $this->claseAdministracion->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['resultados' => $resultados,
            'parametro' => 'busquedaPuntosServicio']);
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

    public function moduloFacturacion($datos)
    {
        session_start();
        $resultado = $this->claseVentas->controlador($datos);
        file_put_contents("/tmp/sesion.txt", print_r($_SESSION, true));
        $consecutivo = $resultado['puntos_servicio'][0]['prefijo_alfabetico'] .
                '-' . $resultado['puntos_servicio'][0]['numerico_actual'];
        $ultimaFactura = $this->claseVentas->obtenerUltimaFactura(array('consecutivo' => $consecutivo));

        $cantidad_descuentos = sizeof($resultado['descuentos']);

        $plantilla = $this->plantillas->render('facturacion.html', ['servicios' => $resultado['servicios'],
            'descuentos' => $resultado['descuentos'],
            'puntosServicio' => $resultado['puntos_servicio'],
            'cantidad_descuentos' => $cantidad_descuentos,
            'ultimaFactura' => $ultimaFactura,
            'novedades' => $resultado['novedades'],
            'id_consecutivo' => $resultado['puntos_servicio'][0]['id_consecutivo'],
            'consecutivo' => $consecutivo]);

        echo $plantilla;
    }

    public function moduloMantenimientos($datos)
    {
        session_start();
        $resultado = $this->claseAdministracion->controlador($datos);

        $plantilla = $this->plantillas->render('mantenimientos.html', ['mantenimientos' => $resultado['servicios'],
            'tipo_mantenimiento' => $resultado['servicios']]);

        echo $plantilla;
    }

    private function imprimirFactura($datos = Array())
    {
        $respuesta = $this->claseVentas->controlador($datos);
        $resultado = ($respuesta >= 1) ? 'ok' : 'fallo';

        echo $resultado;
    }

    public function cargarImagen($datos = array())
    {
        $nombre_img = $_FILES['imagen']['name'];
        $tipo = $_FILES['imagen']['type'];
        $tamano = $_FILES['imagen']['size'];
        $respuesta = array();
        if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 200000)) {
            //indicamos los formatos que permitimos subir a nuestro servidor
            if (($_FILES["imagen"]["type"] == "image/gif") || ($_FILES["imagen"]["type"] == "image/jpeg") || ($_FILES["imagen"]["type"] == "image/jpg") || ($_FILES["imagen"]["type"] == "image/png")) {
                // Ruta donde se guardarán las imágenes que subamos
                $directorio = $_SERVER['DOCUMENT_ROOT'] . '/proyecto_lavacascos/public/images/servicios/';
                // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre_img);
                $respuesta['imagen'] = $nombre_img;
                $respuesta['mensaje'] = 'subida satisfactoria';
            } else {
                //si no cumple con el formato
                $respuesta['mensaje'] = "No se puede subir una imagen con ese formato ";
            }
        } else {
            //si existe la variable pero se pasa del tamaño permitido
            if ($nombre_img == !NULL)
                $respuesta['mensaje'] = "La imagen es demasiado grande ";
        }

        return $respuesta;
    }

    public function agregarProductos($datos = array())
    {
        $resultado = $this->claseVentas->controlador($datos);
        $factura = $this->claseVentas->obtenerUltimaFactura($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['factura' => $factura,
            'parametro' => 'construirTablaFacturacion']);

        echo $plantilla;
    }

    public function obtenerAlarmas($datos)
    {
        $resultado = $this->claseAdministracion->controlador($datos);
//        $factura = $this->claseVentas->obtenerUltimaFactura($datos);
        $plantilla = $this->plantillas->render('resultadoBusquedas.html', ['factura' => $factura,
            'parametro' => 'construirTablaFacturacion']);

        echo $plantilla;
    }

    public function generarInforme($datos)
    {
        $resultado = $this->claseInformes->controlador($datos);
        $plantilla = $this->plantillas->render('resultadoInformes.html', ['factura' => $factura,
            'parametro' => 'construirTablaFacturacion',
            'resultados' => $resultado]);
        echo $plantilla;
    }

}

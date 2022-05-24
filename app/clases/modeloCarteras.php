<?php

include_once '../../config/consultas.php';
include_once '../../config/conectFormsBCS.php';

/**
 * Este Archivo y todos los contenidos en esta aplicación son propiedad
 * exclusiva de Lavacascos SA, cualquier copia o reproducción del codigo
 * aquí contenido será tomada como una violación a los derechos de autor
 * de la marca anteriormente nombrada y será castigada y denunciada
 * penalmente
 *
 * @author Jonnathan Murcia <jjmurciab@gmail.com>
 * @version 1.0
 * @copyright (c) 2016, FIANZA LTDA
 * */
class modeloCarteras extends conexion
{

    var $productos;
    var $cartera;
    var $pivote;

    public function __construct($datos = array())
    {
        $this->conexion();
        $this->productos = array();
        $this->cartera = '';
        $this->pivote = array();
        $this->consultas = new Consultas();
    }

    public function controlador($datos, $parametrosAdicionales = array())
    {
        if (isset($datos['metodo'])) {
            $metodo = $datos['metodo'];
            $resultado = $this->$metodo($datos, $parametrosAdicionales);
        }
        return $resultado;
    }

    /**
     * Función que
     * @param type $datos
     */
    private function paginaInicio($datos)
    {
        $resultado = array();
        $resultado['cartera'] = $this->obtenerInformacionCartera($datos['cartera']);
        $resultado['cliente'] = $this->obtenerInformacionClientes($datos['cartera']);
        $resultado['gestion'] = $this->obtenerInformacionGestion($datos['cartera']);
        if (isset($resultado['cliente']['cliente'][0]['cedula'])) {
            $resultado['historial'] = $this->obtenerInformacionHistoricoGestion($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);
        }
        
        return $resultado;
    }

    /**
     * Función que obtiene la información de la cartera a la cual se está accesando
     *
     * @param type $cartera incluye el id de la cartera que se seleccionó en el acceso
     */
    private function buscarDeudor($datos)
    {
        $resultado['cartera'] = $this->obtenerInformacionCartera($datos['cartera']);
        if (isset($datos['key']) && ($_SESSION['carteraActual'] == 4 || $_SESSION['carteraActual'] == 5 || $_SESSION['carteraActual'] == 13)) {
            $resultado['cliente'] = $this->obtenerInformacionClientesMultiplay($datos['cartera'], $datos['datoBusqueda'], $datos['tipo']);
            $resultado['historial'] = $this->obtenerInformacionHistoricoGestionMultiplay($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);
        } else {
            $resultado['cliente'] = $this->obtenerInformacionClientesParametro($datos['cartera'], $datos['datoBusqueda'], $datos['tipo']);
            if (isset($resultado['cliente']['cliente'][0]['cedula'])) {
                $resultado['historial'] = $this->obtenerInformacionHistoricoGestion($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);
            }
        }

        $resultado['gestion'] = $this->obtenerInformacionGestion($datos['cartera']);
        
        return $resultado;
    }

    /**
     * Función que obtiene la información de la cartera a la cual se está accesando
     *
     * @param type $cartera incluye el id de la cartera que se seleccionó en el acceso
     */
    private function buscarDeudorEdadMora($datos)
    {
        $resultado['cartera'] = $this->obtenerInformacionCartera($datos['cartera']);
        $resultado['cliente'] = $this->obtenerInformacionClientesEdadMora($datos['cartera'], $datos['datoBusqueda'], $datos['tipo']);
        $resultado['gestion'] = $this->obtenerInformacionGestion($datos['cartera']);
        $resultado['historial'] = $this->obtenerInformacionHistoricoGestion($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);

        return $resultado;
    }

    /**
     * Función que obtiene la información de la cartera a la cual se está accesando
     *
     * @param type $cartera incluye el id de la cartera que se seleccionó en el acceso
     */
    private function buscarDeudorRecarga($datos)
    {
        $resultado['cartera'] = $this->obtenerInformacionCartera($datos['cartera']);
        $resultado['cliente'] = $this->obtenerInformacionClientesParametro($datos['cartera'], $datos['datoBusqueda'], $datos['tipo']);
        $resultado['gestion'] = $this->obtenerInformacionGestion($datos['cartera']);
        $resultado['historial'] = $this->obtenerInformacionHistoricoGestion($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);
        
        return $resultado;
    }

    private function buscarDeudoresTarea($datos)
    {
        $resultado['cartera'] = $this->obtenerInformacionCartera($datos['cartera']);
        $deudor = $this->deudorLibreTarea($datos['tarea'], $datos['cartera']);
        if (isset($deudor[0]['identificacion'])) {
            $resultado['cliente'] = $this->obtenerInformacionClientesParametro($datos['cartera'], $deudor[0]['identificacion'], 'cedula');
            $resultado['gestion'] = $this->obtenerInformacionGestion($datos['cartera']);
            $resultado['historial'] = $this->obtenerInformacionHistoricoGestion($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);
            $this->marcarDeudoresTarea($deudor[0]['identificacion'], $datos['tarea']);
        }
        
        return $resultado;
    }

    private function marcarDeudoresTarea($identificacion, $tarea)
    {
        $query = "UPDATE datos_tareas SET inicio_gestion = NOW(), usuario='" . $_SESSION['usuario'] . "'
        WHERE  identificacion = '$identificacion' AND id_tarea = '$tarea'";
        $return = $this->ejecutar2($query);
    }

    private function deudorLibreTarea($tarea, $cartera)
    {
        $query = "SELECT orden FROM tareas WHERE id = '$tarea'";
        $orden = $this->row($query);
        $orden = $orden[0]['orden'];
        $query = "SELECT o.cedula_deudor as identificacion, d.nombre FROM datos_tareas dt, obligaciones o, deudores d WHERE dt.id_tarea = '$tarea'
        AND dt.cartera ='$cartera' AND dt.identificacion = o.cedula_deudor AND d.cedula = dt.identificacion AND dt.usuario IN('', '" . $_SESSION['usuario'] . "') AND dt.gestionado = '0' ORDER BY dt.orden asc $orden LIMIT 1";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * Función que obtiene la información de la cartera a la cual se está accesando
     *
     * @param type $cartera incluye el id de la cartera que se seleccionó en el acceso
     * º
     */
    private function obtenerInformacionCartera($cartera)
    {
        $query = "SELECT * FROM clientes WHERE id_cliente = '$cartera'";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * Función que obtiene un cliente de la lista que se encuentre libre
     * y regresa los datos de obligaciones y demográficos
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @return Array $return regresa la información del cliente inicial
     */
    private function obtenerInformacionClientes($cartera)
    {
        $return = array();
        $query = "SELECT d.cedula FROM deudores d, obligaciones o WHERE d.cedula = o.cedula_deudor AND o.cartera = '$cartera' 
        AND d.estado = '1' AND d.cedula NOT IN(SELECT cedula FROM bloqueo_gestion where cedula_deudor = o.cedula_deudor and CONCAT('1-', '$cartera')) LIMIT 1";
        $resultado = $this->row($query);
        $cedula = (isset($resultado[0]['cedula'])) ? $resultado[0]['cedula'] : '';

        $query = "SELECT * FROM deudores WHERE cedula = '$cedula'";
        $return['cliente'] = $this->row($query);
        /* OBTENER OBLIGACIONES */
        $query = "SELECT * FROM obligaciones WHERE cedula_deudor = '$cedula' AND estado = '1' AND cartera = '$cartera'";
        $return['obligaciones'] = $this->row($query);
        /* OBTENER PAGOS */
        foreach ($return['obligaciones'] as $key => $obligaciones) {
            $query = "SELECT * FROM pagos WHERE obligacion = '" . $obligaciones['numero_obligacion'] . "' AND cliente_pago = '$cartera'";
            $pagos[$key] = $this->row($query);
        }
        $return['pagos'] = (isset($pagos)) ? $pagos : '';
        /* OBTENER DIRECCIONES */
        $query = "SELECT * FROM direcciones WHERE cedula_deudor = '$cedula'";
        $return['direcciones'] = $this->row($query);
        /* OBTENER CORREOS */
        $query = "SELECT * FROM correos WHERE cedula_deudor = '$cedula'";
        $return['emails'] = $this->row($query);
        /* OBTENER TELEFONOS */
        $query = "SELECT * FROM telefonos WHERE cedula_deudor = '$cedula'";
        $return['telefonos'] = $this->row($query);


        $this->marcarCliente($cartera, $cedula);
        return $return;
    }

    /**
     * Función que valida el tipo de dato y consulta de acuerdo al criterio de busqueda
     *
     * @param String $cartera contiente la cartera en la que se van a consultar
     * @param String $parametro
     * @param String $tipo
     * @return Array
     */
    private function obtenerInformacionClientesParametro($cartera, $parametro, $tipo)
    {
        $return = array();
        switch ($tipo) {
            case 'cedula':
                $query = "SELECT cedula as cedula_deudor FROM deudores WHERE cedula = '$parametro'";
                break;
            case 'numero_obligacion':
                $query = "SELECT cedula_deudor FROM obligaciones WHERE numero_obligacion = '$parametro'";
                break;
            case 'telefono':
                $query = "SELECT cedula_deudor FROM telefonos WHERE telefono = '$parametro'";
                break;
        }

        $cedula = $this->row($query);
        $id = "";
        foreach ($cedula as $cedula) {
            $id = $id . $cedula['cedula_deudor'] . ',';
        }
        $id = substr($id, 0, -1);
        $query = "SELECT cedula_deudor FROM obligaciones WHERE cedula_deudor IN('$id') AND cartera = '$cartera'";
        $cedula = $this->row($query);
        $cedula = isset($cedula[0]['cedula_deudor']) ? $cedula[0]['cedula_deudor'] : '';
        if ($cedula != '') {
            $query = "SELECT * FROM deudores WHERE cedula = '$cedula'";
            $return['cliente'] = $this->row($query);
            /* OBTENER OBLIGACIONES */
            $query = "SELECT * FROM obligaciones WHERE cedula_deudor = '$cedula' AND cartera = '$cartera'";
            $return['obligaciones'] = $this->row($query);
            /* OBTENER PAGOS */
            foreach ($return['obligaciones'] as $key => $obligaciones) {
                $query = "SELECT * FROM pagos WHERE obligacion = '" . $obligaciones['numero_obligacion'] . "' AND cliente_pago = '$cartera'";
                $pagos[$key] = $this->row($query);
            }
            $return['pagos'] = $pagos;
            /* OBTENER DIRECCIONES */
            $query = "SELECT * FROM direcciones WHERE cedula_deudor = '$cedula'";
            $return['direcciones'] = $this->row($query);
            /* OBTENER CORREOS */
            $query = "SELECT * FROM correos WHERE cedula_deudor = '$cedula'";
            $return['emails'] = $this->row($query);
            /* OBTENER TELEFONOS */
            $query = "SELECT * FROM telefonos WHERE cedula_deudor = '$cedula'";
            $return['telefonos'] = $this->row($query);
        }
        return $return;
    }


    private function obtenerInformacionClientesMultiplay($cartera, $parametro, $tipo)
    {
        $return = array();
        switch ($tipo) {
            case 'cedula':
                $query = "SELECT cedula as cedula_deudor FROM deudores WHERE cedula = '$parametro'";
                break;
            case 'numero_obligacion':
                $query = "SELECT cedula_deudor FROM obligaciones WHERE numero_obligacion = '$parametro'";
                break;
            case 'telefono':
                $query = "SELECT cedula_deudor FROM telefonos WHERE telefono = '$parametro'";
                break;
        }

        $cedula = $this->row($query);
        $id = "";
        foreach ($cedula as $cedula) {
            $id = $id . $cedula['cedula_deudor'] . ',';
        }
        $id = substr($id, 0, -1);
        $query = "SELECT cedula_deudor FROM obligaciones WHERE cedula_deudor IN('$id') AND cartera = '$cartera'";
        $cedula = $this->row($query);
        $cedula = $cedula[0]['cedula_deudor'];
        if ($cedula != '') {
            $query = "SELECT * FROM deudores WHERE cedula = '$cedula'";
            $return['cliente'] = $this->row($query);
            /* OBTENER OBLIGACIONES */
            $query = "SELECT * FROM obligaciones WHERE cedula_deudor = '$cedula' AND estado = '1' AND cartera IN(4,5,13)";
            $return['obligaciones'] = $this->row($query);
            /* OBTENER PAGOS */
            foreach ($return['obligaciones'] as $key => $obligaciones) {
                $query = "SELECT * FROM pagos WHERE obligacion = '" . $obligaciones['numero_obligacion'] . "' AND cliente_pago = '$cartera'";
                $pagos[$key] = $this->row($query);
            }
            $return['pagos'] = $pagos;
            /* OBTENER DIRECCIONES */
            $query = "SELECT * FROM direcciones WHERE cedula_deudor = '$cedula'";
            $return['direcciones'] = $this->row($query);
            /* OBTENER CORREOS */
            $query = "SELECT * FROM correos WHERE cedula_deudor = '$cedula' AND estado = '1'";
            $return['emails'] = $this->row($query);
            /* OBTENER TELEFONOS */
            $query = "SELECT * FROM telefonos WHERE cedula_deudor = '$cedula'";
            $return['telefonos'] = $this->row($query);
        }
        return $return;
    }


    /**
     * Función que valida el tipo de dato y consulta de acuerdo al criterio de busqueda
     *
     * @param String $cartera contiente la cartera en la que se van a consultar
     * @param String $parametro
     * @param String $tipo
     * @return Array
     */
    private function obtenerInformacionClientesEdadMora($cartera, $parametro, $tipo)
    {
        $edades = ($this->buscarAsignacionUsuarioActual() == '') ? '1,' : $this->buscarAsignacionUsuarioActual();
        $return = array();
        switch ($tipo) {
            case 'cedula':
                $query = "SELECT cedula as cedula_deudor FROM deudores WHERE cedula = '$parametro'";
                break;
            case 'numero_obligacion':
                $query = "SELECT cedula_deudor FROM obligaciones WHERE numero_obligacion = '$parametro'";
                break;
            case 'telefono':
                $query = "SELECT cedula_deudor FROM telefonos WHERE telefono = '$parametro'";
                break;
        }

        $cedula = $this->row($query);
        $id = "";
        foreach ($cedula as $cedula) {
            $id = $id . $cedula['cedula_deudor'] . ',';
        }
        $id = substr($id, 0, -1);
        $query = "SELECT cedula_deudor FROM obligaciones WHERE (dias_mora_inicial IN(" . substr($edades, 0, -1) . ") OR zona IN(" . substr($edades, 0, -1) . ")) AND cedula_deudor IN('" . $id . "') AND cartera = '$cartera'";
        $cedula = $this->row($query);
        $cedula = $cedula[0]['cedula_deudor'];
        if ($cedula != '') {
            $query = "SELECT * FROM deudores WHERE cedula = '$cedula'";
            $return['cliente'] = $this->row($query);
            /* OBTENER OBLIGACIONES */
            $query = "SELECT * FROM obligaciones WHERE cedula_deudor = '$cedula' AND estado = '1' AND cartera = '$cartera'";
            $return['obligaciones'] = $this->row($query);
            /* OBTENER PAGOS */
            foreach ($return['obligaciones'] as $key => $obligaciones) {
                $query = "SELECT * FROM pagos WHERE obligacion = '" . $obligaciones['numero_obligacion'] . "' AND cliente_pago = '$cartera'";
                $pagos[$key] = $this->row($query);
            }
            $return['pagos'] = $pagos;
            /* OBTENER DIRECCIONES */
            $query = "SELECT * FROM direcciones WHERE cedula_deudor = '$cedula'";
            $return['direcciones'] = $this->row($query);
            /* OBTENER CORREOS */
            $query = "SELECT * FROM correos WHERE cedula_deudor = '$cedula' AND estado = '1'";
            $return['emails'] = $this->row($query);
            /* OBTENER TELEFONOS */
            $query = "SELECT * FROM telefonos WHERE cedula_deudor = '$cedula'";
            $return['telefonos'] = $this->row($query);
        }
        return $return;
    }

    /**
     * Función que obtiene toda la información para llenar los campos de la
     * ventana de gestión
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @return Array $return Contiene toda la información requerida para la gestión
     */
    private function obtenerInformacionGestion($cartera)
    {
        /* Obtener las acciones */
        $return = array();
        $query = "SELECT h.* FROM accion a, homologado_accion h WHERE a.estado = '1'
        AND h.id_accion = a.id AND  h.id_cliente = '$cartera'"
            . "AND h.estado = '1'";
        $return['acciones'] = $this->row($query);
        /* Obtener los tipos de contacto */
        $query = "SELECT h.* FROM contacto c, homologado_contacto h WHERE c.estado = '1'
        AND h.id_contacto = c.id AND h.id_cliente = '$cartera'"
            . "AND h.estado = '1'";
        $return['contacto'] = $this->row($query);
        /* Obtener los */
        $query = "SELECT h.* FROM efecto e, homologado_efecto h WHERE e.estado = '1'
        AND h.id_efecto = e.id AND h.id_cliente = '$cartera'"
            . "AND h.estado = '1'";

        $return['motivo_no_pago'] = $this->row($query);

        return $return;
    }

    /**
     * Función que obtiene toda la información para llenar los campos de la
     * ventana de gestión
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @return Array $return Contiene toda la información requerida para la gestión
     */
    private function obtenerInformacionHistoricoGestion($cedula, $cartera)
    {
        $query = "SELECT h.id, h.fecha_gestion, h.gestor, h.cedula_deudor, h.obligacion, h.fecha_seguimiento, h.valor_acuerdo, 
        h.fecha_acuerdo, (SELECT motivo FROM motivos_no_pago WHERE id = h.motivo_no_pago) as motivo_no_pago, h.telefono, h.tipo_negociacion, 
        h.actividad_economica, h.observaciones, a.homologado as accion, e.homologado as efecto, c.homologado as contacto 
        FROM homologado_accion a, homologado_efecto e, homologado_contacto c, historico_gestion h WHERE h.cedula_deudor = '$cedula' AND 
        h.cliente_id = '$cartera' AND h.accion = a.id AND h.efecto = e.id AND h.contacto = c.id ORDER by fecha_gestion DESC";
        $return = $this->row($query);

        return $return;
    }

    private function obtenerInformacionHistoricoGestionMultiplay($cedula, $cartera)
    {
        $query = "SELECT h.id, h.fecha_gestion, h.gestor, h.cedula_deudor, h.obligacion, h.fecha_seguimiento,
               h.valor_acuerdo, h.fecha_acuerdo, h.motivo_no_pago, h.telefono, h.tipo_negociacion, h.actividad_economica,
               h.observaciones, a.homologado as accion, e.homologado as efecto, c.homologado as contacto
               FROM homologado_accion a, homologado_efecto e,
               homologado_contacto c, historico_gestion h
               WHERE h.cedula_deudor = '$cedula'
               AND h.cliente_id IN(4,5,13)
               AND h.accion = a.id
               AND h.efecto = e.id
               AND h.contacto = c.id
               ORDER by fecha_gestion DESC";
        $return = $this->row($query);
        foreach ($return as $key => $value) {
            $query = "SELECT motivo FROM motivos_no_pago WHERE id = '" . $value['motivo_no_pago'] . "'";
            $result = $this->row($query);
            $return[$key]['motivo_no_pago'] = (isset($result[0]['motivo']) == 'true') ? $result[0]['motivo'] : '';
        }

        return $return;
    }


    /**
     * Función que realiza la marca del cliente para que el mismo no pueda
     * ser gestionado por dos agentes al tiempo
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @param String $cedula Contiene la cedula del deudor
     */
    private function obtenerContactosAccion($datos)
    {
        $query = "SELECT c.homologado, c.id FROM homologado_contacto c, arbol_contacto a "
            . "WHERE a.id_accion = '" . $datos['accion'] . "' AND a.id_contacto = c.id AND a.estado = '1' AND c.estado = '1'";

        $return = $this->row($query);
        return $return;
    }

    /**
     * Función que realiza la marca del cliente para que el mismo no pueda
     * ser gestionado por dos agentes al tiempo
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @param String $cedula Contiene la cedula del deudor
     */
    private function obtenerEfectosContacto($datos)
    {
        $query = "SELECT e.homologado, e.id FROM homologado_efecto e, arbol_efecto a "
            . "WHERE a.id_contacto = '" . $datos['contacto'] . "' AND a.id_efecto = e.id
                AND a.id_cliente = '" . $datos['cartera'] . "' AND a.estado = '1' AND e.estado = '1'";


        $return['efectos'] = $this->row($query);

        $query = "SELECT m.motivo, m.id FROM motivos_no_pago m, arbol_motivos_no_pago a "
            . "WHERE a.id_contacto = '" . $datos['contacto'] . "' AND a.id_motivo_no_pago = m.id
                AND a.id_cliente = '" . $datos['cartera'] . "'";

        $return['motivos'] = $this->row($query);

        $query = "SELECT * FROM actividad_economica "
            . "WHERE cliente = '" . $datos['cartera'] . "' AND estado = '1'";

        $return['actividades'] = $this->row($query);

        return $return;
    }

    /**
     * Función que realiza la marca del cliente para que el mismo no pueda
     * ser gestionado por dos agentes al tiempo
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @param String $cedula Contiene la cedula del deudor
     */
    private function marcarCliente($cartera, $cedula)
    {
        $query = "INSERT INTO bloqueo_gestion (id_bloqueo, cedula_deudor) "
            . "VALUES('1-$cartera', '$cedula') ON DUPLICATE KEY UPDATE cedula_deudor = '$cedula';";
        $this->ejecutar2($query);
    }

    /**
     *
     * @param type $datos
     * @return type
     */
    private function cargarAsignacion($datos)
    {

        $cartera = $datos['cartera'];
        $return = array('mensaje' => '', 'resultado' => '');


        $return = $this->cargaAsignacionUpdate($datos);

        return json_encode($return);
    }

    /**
     * Función que realiza la carga de la asignación tratando de mejorar el rendimiento de la carga de la misma
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @param String $cedula Contiene la cedula del deudor
     */
    private function cargaAsignacionUpdate($datos)
    {
        $cartera = $datos['cartera'];
        $vigencia_asignacion = $datos['vigencia_asignacion'];
        $file_type = $_FILES['archivo']['type'];
        $handle = fopen($datos['ruta'], "r");
        $resultado = array();
        $i = 0;
        $query = "";
        $queryTmp = $this->consultas->consultas();
        $query .= $queryTmp['tabla_asignacion'];

        while (($datos = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $query .= utf8_encode("INSERT INTO tmp (campo1, campo2, campo3, campo4, campo5, campo6, campo7,
            campo8, campo9, campo10, campo11, campo12, campo13, campo14, campo15, campo16, campo17,
            campo18, campo19, campo20, campo21, campo22, campo23, campo24, campo25, campo26, campo27,
            campo28, campo29, campo30, campo31, campo32, campo33, campo34, campo35, campo36, campo37,
            campo38, campo39, campo40, campo41, campo42, campo43, campo44, campo45, campo46, campo47,
            campo48, campo49, campo50, campo51, campo52, campo53, campo54, campo55, campo56, campo57,
            campo58, campo59, campo60, campo61, campo62, campo63, campo64, campo65, campo66, campo67,
            campo68, campo69)
            VALUES (   '$datos[0]', $cartera, '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]',"
                . "'$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]', '$datos[13]', "
                . "'$datos[14]', '$datos[15]', '$datos[16]', '$datos[17]', '$datos[18]', '$datos[19]', '$datos[20]', "
                . "'$datos[21]', '$datos[22]', '$datos[23]', '$datos[24]', '$datos[25]', '$datos[26]', '$datos[27]', "
                . "'$datos[28]', '$datos[29]', '$datos[30]', '$datos[31]', '$datos[32]', '$datos[33]', '$datos[34]', "
                . "'$datos[35]', '$datos[36]', '$datos[37]', '$datos[38]', '$datos[39]', '$datos[40]', '$datos[41]', "
                . "'$datos[42]', '$datos[43]', '$datos[44]', '$datos[45]', '$datos[46]', '$datos[47]', '$datos[48]', "
                . "'$datos[49]', '$datos[50]', '$datos[51]', '$datos[52]', '$datos[53]', '$datos[54]', '$datos[55]', "
                . "'$datos[56]', '$datos[57]', '$datos[58]', '$datos[59]', '$datos[60]', '$datos[61]', '$datos[62]', "
                . "'$datos[63]', '$datos[64]', '$datos[65]', '$datos[66]', '$datos[81]'); ");
            $i++;
        }


        fclose($handle);

        $query .= "INSERT INTO deudores (nombre, cedula, estado) " .
            "SELECT campo7, campo1, '1' FROM tmp ON DUPLICATE KEY
                  UPDATE estado = '1';";

        $query .= "UPDATE obligaciones SET estado = '0' WHERE cartera = '$cartera' "
            . "AND (fecha_vigencia_asignacion = '' "
            . "OR fecha_vigencia_asignacion = CURDATE());";

        $query .= "INSERT INTO obligaciones (cedula_deudor, cartera, producto, numero_obligacion, entidad, "
            . "regional, estrategia_inicial, estrategia_actual, obligaciones, ultimo_efecto, valor_actual_inicial, "
            . "valor_maximo, fecha_apertura, plazo, dia_facturacion, modalidad, franja_actual, estado_reparto, "
            . "user_id, mono_multi, nueva_marca_foco, estapa_proceso_juridico, codigo_garantia, fecha_ultimo_alivio, "
            . "estado_ciclo, estado_obligacion, codigo_recuperacion, fecha_actualizacion_inicial, "
            . "fecha_actualizacion, dias_mora_inicial, dias_mora_actual, fecha_pago, saldo_capital_inicial, "
            . "saldo_capital, interes_sobre_saldo, saldo_total, valor_cuota, capital_mora, intereses_mora, "
            . "cargo_cobranzas, cantidad_disputada, saldo_mora, pagos_mes_cliente, pagos_por_obligacion, "
            . "fecha_ultimo_pago, ciclo_mora_inicial_obligacion, ciclo_mora_actual_sistema, porcentaje_gac, "
            . "pago_fianza, fecha_seguro, valor_seguro, valor_provisionado, otros_cargos, zona, saldo_expuesto, estado, fecha_vigencia_asignacion) "
            . "SELECT campo1, campo2, campo3, campo4, campo5, campo6, "
            . "campo8, campo9, campo10, campo11, campo12, campo13, campo14, "
            . "campo15, campo16, campo17, campo18, campo19, campo20, campo21, "
            . "campo22, campo23, campo24, campo25, campo26, campo27, campo28, "
            . "campo29, campo30, campo31, campo32, campo33, campo34, campo35, "
            . "campo36, campo37, campo38, campo39, campo40, campo41, campo42, "
            . "campo43, campo44, campo45, campo46, campo47, campo48, campo49, "
            . "campo50, campo51, campo52, campo53, campo54, campo55, campo69, '1', '" . $vigencia_asignacion . "' FROM tmp "
            . "ON DUPLICATE KEY "
            . "UPDATE estado = '1', cartera = " . $_SESSION['carteraActual']  . ", fecha_vigencia_asignacion = '" . $vigencia_asignacion . "', entidad = campo5, regional = campo6, estrategia_inicial = campo8,
                       estrategia_actual = campo9, obligaciones = campo10, ultimo_efecto = campo11,
                       valor_actual_inicial = campo12, valor_maximo = campo13, fecha_apertura = campo14,
                       plazo = campo15, dia_facturacion = campo16, modalidad = campo17, franja_actual = campo18,
                       estado_reparto = campo19, user_id = campo20, mono_multi = campo21,
                       nueva_marca_foco = campo22, estapa_proceso_juridico = campo23, codigo_garantia = campo24,
                       fecha_ultimo_alivio = campo25, estado_ciclo = campo26, estado_obligacion = campo27,
                       codigo_recuperacion = campo28, fecha_actualizacion_inicial = campo29,
                       fecha_actualizacion = campo30, dias_mora_inicial = campo31, dias_mora_actual = campo32,
                       fecha_pago = campo33, saldo_capital_inicial = campo34, saldo_capital = campo35,
                       interes_sobre_saldo = campo36, saldo_total = campo37, valor_cuota = campo38,
                       capital_mora = campo39, intereses_mora = campo40, cargo_cobranzas = campo41,
                       cantidad_disputada = campo42, saldo_mora = campo43, pagos_mes_cliente = campo44,
                       pagos_por_obligacion = campo45, fecha_ultimo_pago = campo46,
                       ciclo_mora_inicial_obligacion = campo47, ciclo_mora_actual_sistema = campo48,
                       porcentaje_gac = campo49, pago_fianza = campo50, fecha_seguro = campo51,
                       valor_seguro = campo53, valor_provisionado = campo53,
                       otros_cargos = campo54, zona = campo55, saldo_expuesto = campo69;";

        $query .= "INSERT INTO direcciones (cedula_deudor, tipo_direccion, ciudad, direccion, estado) "
            . "SELECT campo1, '', campo56, campo57, '1' FROM tmp WHERE campo57 != '' ON DUPLICATE KEY "
            . "UPDATE estado = '1';";

        for ($i = 62; $i <= 67; $i++) {
            switch ($i) {
                case 62:
                    $tipo = 'celular';
                    break;
                case 63:
                    $tipo = 'telefono residencia';
                    break;
                case 64:
                    $tipo = 'celular oficina';
                    break;
                case 65:
                    $tipo = 'telefono oficina';
                    break;
                case 66:
                    $tipo = 'otro celular';
                    break;
                case 67:
                    $tipo = 'otro telefono';
                    break;
            }
            $query .= "INSERT INTO telefonos (cedula_deudor, tipo_telefono, telefono, estado) "
                . "SELECT campo1, '" . utf8_decode($tipo) . "', campo" . $i . ", '1' FROM tmp
                               WHERE campo" . $i . " != '' ON DUPLICATE KEY "
                . "UPDATE estado = '1';";
        }
        $query .= "INSERT INTO correos (cedula_deudor, tipo_correo, correo, estado) "
            . "SELECT campo1, '', campo61, '1' FROM tmp WHERE campo61 != '' ON DUPLICATE KEY "
            . "UPDATE estado = '1';";
	file_put_contents("q.sql", $query);
        $this->ejecutar3($query);

        $return = array('resultado' => 'ok', 'mensaje' => 'La asignación fue importada con exito');
        return $return;
    }

    /**
     * Función que obtiene los datos insertados en la tabla pivot de acuerdo a la cartera
     * en la cual fueron cargados
     *
     * @param String $cartera contiene la cartera de gestión actual
     * @return Array $resultado Contiene los datos obtenidos por la consulta
     */
    private function obtenerDatosPivote($cartera)
    {
        $query = "SELECT * FROM pivote WHERE cartera = '$cartera'";
        $resultado = $this->row($query);
        foreach ($resultado as $key => $registro) {
            $datos = explode(";", $registro['informacion']);
            $resultado[$key]['informacion'] = $datos;
        }
        return $resultado;
    }

    /**
     * Función que inserta los deudores
     */
    private function insertarDeudores($cartera, $resultado)
    {
        $suma = 0;
        $return = array('deudores' => 0, 'obligaciones' => 0, 'demograficos' => array(
            'telefonos' => 0,
            'direcciones' => 0
        ), 'pagos' => 0);
        $query = "UPDATE obligaciones SET estado = '0' WHERE cartera = '$cartera'";
        $this->ejecutar2($query);
        foreach ($resultado as $registro) {
            $identificacion = $registro['identificacion'];
            $nombre = $registro['informacion'][5];
            $query = "INSERT INTO deudores (nombre, cedula, estado) "
                . "VALUES ('$nombre', '$identificacion', '1') ON DUPLICATE KEY "
                . "UPDATE estado = '1'";
            $temp = $this->ejecutar2($query);
            $return['deudores'] = ($temp >= 1) ? ($return['deudores'] + $temp) : $return['deudores'];
            /*             * ***********OBLIGACIONES************** */
            $obligaciones = $this->insertarObligaciones($cartera, $registro);
            $return['obligaciones'] = $obligaciones + $return['obligaciones'];
            /*             * ***********DEMOGRAFICOS************** */
            $demograficos = $this->insertarDemograficos($registro);
            $return['demograficos']['direcciones'] = $demograficos['direcciones'] + $return['demograficos']['direcciones'];
            $return['demograficos']['telefonos'] = $demograficos['telefonos'] + $return['demograficos']['telefonos'];
            /*             * ***********PAGOS************** */
            $pagos = $this->insertarPagos($registro);
            $return['pagos'] = $pagos + $return['pagos'];
        }
        return $return;
    }

    /**
     * Función que inserta los deudores
     */
    private function insertarObligaciones($cartera, $registro)
    {
        $return = 0;
        $identificacion = $registro['identificacion'];
        $vigencia_asignacion = $registro['vigencia_asignacion'];
        $datos = $registro['informacion'];
        $nombre = $registro['informacion'][5];
        $query = "INSERT INTO obligaciones (cedula_deudor, cartera, producto, numero_obligacion, entidad, "
            . "regional, estrategia_inicial, estrategia_actual, obligaciones, ultimo_efecto, valor_actual_inicial, "
            . "valor_maximo, fecha_apertura, plazo, dia_facturacion, modalidad, franja_actual, estado_reparto, "
            . "user_id, mono_multi, nueva_marca_foco, estapa_proceso_juridico, codigo_garantia, fecha_ultimo_alivio, "
            . "estado_ciclo, estado_obligacion, codigo_recuperacion, fecha_actualizacion_inicial, "
            . "fecha_actualizacion, dias_mora_inicial, dias_mora_actual, fecha_pago, saldo_capital_inicial, "
            . "saldo_capital, interes_sobre_saldo, saldo_total, valor_cuota, capital_mora, intereses_mora, "
            . "cargo_cobranzas, cantidad_disputada, saldo_mora, pagos_mes_cliente, pagos_por_obligacion, "
            . "fecha_ultimo_pago, ciclo_mora_inicial_obligacion, ciclo_mora_actual_sistema, porcentaje_gac, "
            . "pago_fianza, fecha_seguro, valor_seguro, valor_provisionado, otros_cargos, zona, estado, fecha_vigencia_asignacion) "
            . "VALUES ('$identificacion', '$cartera', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[6]',"
            . "'$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]', '$datos[13]', "
            . "'$datos[14]', '$datos[15]', '$datos[16]', '$datos[17]', '$datos[18]', '$datos[19]', '$datos[20]', "
            . "'$datos[21]', '$datos[22]', '$datos[23]', '$datos[24]', '$datos[25]', '$datos[26]', '$datos[27]', "
            . "'$datos[28]', '$datos[29]', '$datos[30]', '$datos[31]', '$datos[32]', '$datos[33]', '$datos[34]', "
            . "'$datos[35]', '$datos[36]', '$datos[37]', '$datos[38]', '$datos[39]', '$datos[40]', '$datos[41]', "
            . "'$datos[42]', '$datos[43]', '$datos[44]', '$datos[45]', '$datos[46]', '$datos[47]', '$datos[48]', "
            . "'$datos[49]', '$datos[50]', '$datos[51]', '$datos[52]', '$datos[53]', '1','$vigencia_asignacion') "
            . "ON DUPLICATE KEY "
            . "UPDATE estado = '1'";

        $temp = $this->ejecutar2($query);
        $return = ($temp >= 1) ? ($return + $temp) : $return;

        return $return;
    }

    /**
     * Función que inserta los deudores
     */
    private function insertarDemograficos($registro)
    {
        $return = array('direcciones' => 0, 'telefonos' => 0);
        $datos = $registro['informacion'];
        $identificacion = $registro['identificacion'];
        if ($datos[55] != '') {
            $query = "INSERT INTO direcciones (cedula_deudor, tipo_direccion, ciudad, direccion, estado) "
                . "VALUES ('$identificacion', '', '$datos[54]', '$datos[55]', '1') ON DUPLICATE KEY "
                . "UPDATE estado = '1'";
            $temp = $this->ejecutar2($query);
            $return['direcciones'] = ($temp >= 1) ? ($return['direcciones'] + $temp) : $return['direcciones'];
        }
        for ($i = 60; $i <= 65; $i++) {
            if ($datos[$i] != '') {
                switch ($i) {
                    case 60:
                        $tipo = 'celular';
                        break;
                    case 61:
                        $tipo = 'teléfono residencia';
                        break;
                    case 62:
                        $tipo = 'celular oficina';
                        break;
                    case 63:
                        $tipo = 'teléfono oficina';
                        break;
                    case 64:
                        $tipo = 'otro celular';
                        break;
                    case 65:
                        $tipo = 'otro teléfono';
                        break;
                }
                $query = "INSERT INTO telefonos (cedula_deudor, tipo_telefono, telefono, estado) "
                    . "VALUES ('$identificacion', '" . utf8_decode($tipo) . "', '$datos[$i]', '1') ON DUPLICATE KEY "
                    . "UPDATE estado = '1'";
                $temp1 = $this->ejecutar2($query);
                $return['telefonos'] = ($temp1 >= 1) ? ($return['telefonos'] + $temp1) : $return['telefonos'];
            }
        }

        return $return;
    }

    /**
     * Función que inserta los deudores
     */
    private function insertarPagos($registro)
    {
        $return = 0;
        $datos = $registro['informacion'];
        $identificacion = $registro['identificacion'];
        if (!empty($datos[32])) {
            $query = "INSERT INTO pagos (cedula_deudor, obligacion, valor_pago, fecha_pago) "
                . "VALUES ('$identificacion', '$datos[2]', '$datos[32]', '$datos[31]') ";
            $temp = $this->ejecutar2($query);
            $return = ($temp >= 1) ? ($return + $temp) : $return;
        }

        return $return;
    }

    private function vaciarPivote($cartera)
    {
        $query = "DELETE FROM pivote WHERE cartera = '$cartera'";
        $this->ejecutar2($query);
    }

    /**
     * Función que retorna mensaje para div de mensajes
     * @param type $resultado
     * @return String $mensajeFinal, contiene
     */
    private function mensaje($mensajes)
    {
        $mensajeFinal = '';
        foreach ($mensajes as $mensaje) {
            $mensajeFinal = $mensajeFinal . $mensaje . "<br>";
        }

        return $mensajeFinal;
    }

    /**
     * Función que realiza el cargue de las tareas respectivas de cada cartera
     *
     * @param type $datos
     */
    private function cargarTarea($datos)
    {
        $cartera = $datos['cartera'];
        $return = array('mensaje' => '', 'resultado' => '');
        $cont = 0;
        $file_type = $_FILES['archivo']['type'];
        $handle = fopen($datos['ruta'], "r");
        $resultado = array();
        $i = 0;

        $query = "INSERT INTO tareas(nombre_tarea, cartera, tipo_tarea)
                      VALUES('" . $datos['datos']['nombre_tarea'] . "', '$cartera', '" . $datos['datos']['tipo_tarea'] . "')";

        $id = $this->obtenerId($query);
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            switch ($datos['datos']['tipo_tarea']) {
                case 'activa':
                    $nombre_tarea = $data[0];
                    $asesor = '';
                    $identificacion = $data[1];
                    $asesor = '';
                    $orden = $i;
                    break;
                case 'asesor':
                    $nombre_tarea = '';
                    $asesor = $data[0];
                    $identificacion = $data[1];
                    $asesor = $data[0];
                    $orden = $i;
                    break;
                case 'libre':
                    $nombre_tarea = $data[0];
                    $asesor = '';
                    $identificacion = $data[1];
                    $orden = $i;
                    break;
            }
            $query = "INSERT INTO datos_tareas (id_tarea, identificacion, usuario, tipo_tarea, cartera, gestionado, orden) "
                . "VALUES ('$id', '$identificacion', '$asesor', '" . $datos['datos']['tipo_tarea'] . "',"
                . " '$cartera', '0', $orden) ON DUPLICATE KEY UPDATE gestionado = '0', orden = $orden";
            $temp = $this->ejecutar2($query);
            $cont = ($temp >= 1) ? ($cont + $temp) : $cont;
            $i++;
        }
        fclose($handle);
        $mensaje = 'Se insertaron ' . $cont . ' registros en Tareas';
        $return['mensaje'] = $mensaje;
        $return['resultado'] = ($cont >= 1) ? 'ok' : 'fallo';
        return json_encode($return);
    }

    /**
     * Función que realiza el cargue de las pagos de cada cartera
     *
     * @param type $datos
     */
    private function cargarPagos($datos)
    {
        $cartera = $datos['cartera'];
        $return = array('mensaje' => '', 'resultado' => '');

        $file_type = $_FILES['archivo']['type'];
        $handle = fopen($datos['ruta'], "r");
        $resultado = array();
        $i = 0;
        $yesInsert = 0;
        $notInsert = 0;
        $query = "";

        $query .= 'CREATE TEMPORARY TABLE `tmp`(
                    `campo1` varchar(200) DEFAULT NULL,
                    `campo2` varchar(200) DEFAULT NULL,
                    `campo3` varchar(200) DEFAULT NULL,
					`campo4` varchar(200) DEFAULT NULL,
					`campo5` varchar(200) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

        while (($datos = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $array = explode("/", $datos[2]);
            $fecha_pago = $array[2] . "-" . $array[1] . "-" . $array[0];

            $query1 = 'SELECT * FROM obligaciones WHERE numero_obligacion = "' . trim($datos[0]) . '" AND cartera = "' . $cartera . '"';
            $numObligacion = $this->row($query1);

            if ($numObligacion[0]['numero_obligacion'] == trim($datos[0])) {
                $query .= "
                INSERT INTO tmp (campo1, campo2, campo3, campo4)
                VALUES ('" . trim($datos[0]) . "', '" . trim($datos[1]) . "', '" . $fecha_pago . "', '" . $cartera . "'); ";
                $yesInsert += 1;
            } else {
                $notInsert += 1;
            }

            $i++;
        }

        fclose($handle);

        $query .= "INSERT IGNORE INTO pagos (obligacion, valor_pago, fecha_pago, cliente_pago)
                   SELECT campo1, campo2, campo3, campo4 FROM tmp";

        $resultado = $this->ejecutar3($query);
        if ($notInsert > 1 && $yesInsert == 0) {
            $return['resultado'] = 'fallo';
        } elseif ($notInsert == 0) {
            $return['resultado'] = 'ok';
            $return['mensaje'] = '¡El archivo fue cargado de forma exitosa!<br> Se cargaron ' . $yesInsert . '.';
        } else {
            $return['resultado'] = 'ok';
            $return['mensaje'] = '¡El archivo no fue cargado completamente!<br> Se cargaron ' . $yesInsert . ' & ' . $notInsert . ' No fueron cargados.';
        }

        return json_encode($return);
    }

    /**
     * Función que se encarga de guarda la gestión en cada una de las campañas
     * @param type $datos
     */
    private function guardarGestion($datos)
    {
        if (!isset($datos['obligacion'])) {
            $datos['obligacion'][0] = '';
        }
        $datos['producto'] = (isset($datos['producto'])) ? $datos['producto'] : '';
        $datos['moto'] = (isset($datos['moto'])) ? $datos['moto'] : '';
        $datos['salarios_rango'] = (isset($datos['salarios_rango'])) ? $datos['salarios_rango'] : '';
        $resultado = '';
        if (isset($datos['obligacion'])) :
            foreach ($datos['obligacion'] as $obligacion) {
                $query = "INSERT INTO historico_gestion (fecha_gestion, gestor, cedula_deudor, obligacion, accion, efecto, contacto, motivo_no_pago, actividad_economica, "
                    . "fecha_seguimiento, valor_acuerdo, fecha_acuerdo, telefono, tipo_negociacion, observaciones, origen_gestion, producto_nuevo, moto, salarios_rango, inicio_gestion, cliente_id) "
                    . "VALUES (NOW(), '" . $_SESSION['usuario'] . "', '" . $datos['cedula_deudor'] . "', "
                    . "'" . $obligacion . "', '" . $datos['accionGestion'] . "', "
                    . "'" . $datos['efecto_gestion'] . "', '" . $datos['contacto_gestion'] . "', '" . $datos['motivo_gestion'] . "', '" . $datos['actividad_gestion'] . "',"
                    . "'" . $datos['fecha_seguimiento'] . "', '" . $datos['valor_acuerdo'] . "', '" . $datos['fecha_acuerdo'] . "', '" . $datos['telefono'] . "', '" . $datos['tipo_negociacion'] . "', "
                    . "'" . htmlentities(str_replace("'", "", $datos['obervaciones'])) . "', '" . $datos['origen_gestion'] . "', '" . $datos['producto'] . "', '" . $datos['moto'] . "', '" . $datos['salarios_rango'] . "' , '" . $datos['inicioGestion'] . "' ,
                    '" . $datos['cartera'] . "')";
                $resultado = $this->ejecutar2($query);
            }
        endif;

        if ($datos['cartera'] == 19 && $datos['contacto_gestion'] == 106 || $datos['origen_gestion'] == 'tarea') {
            $datos['id_tarea'] = (isset($datos['id_tarea'])) ? $datos['id_tarea'] : '';
	    $query = "UPDATE datos_tareas SET gestionado = '1', fin_gestion = NOW()
                        WHERE id_tarea = '" . $datos['id_tarea'] . "' OR cartera = '". $datos['cartera'] ."'
                        AND identificacion = '" . $datos['cedula_deudor'] . "'";
            $this->ejecutar2($query);
        }

        $query = "UPDATE agendamiento SET estado = 0 WHERE usuario = '" . $_SESSION['usuario'] . "' AND documento_titular = '" . $datos['cedula_deudor'] . "';";
        $this->ejecutar2($query);

        if ($datos['fecha_seguimiento'] != '') {
            $query = "INSERT INTO agendamiento (usuario, documento_titular, fecha, cartera, estado)"
                . " VALUES ('" . $_SESSION['usuario'] . "', '" . $datos['cedula_deudor'] . "', "
                . "'" . $datos['fecha_seguimiento'] . "', '" . $datos['cartera'] . "', '1')";
            $this->ejecutar2($query);
        }
        
        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function autocompletar($datos)
    {
        parse_str($datos['datos'], $formulario);
        $query = "SELECT guion FROM guiones_gestion WHERE id_efecto = '" . $formulario['efecto_gestion'] . "'";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     *
     * @param type $datos
     * @return type
     */
    private function refrescarHistorico($datos)
    {
        $datos = $this->obtenerInformacionHistoricoGestion($datos['cedula_deudor'], $datos['cartera']);
        return $datos;
    }

    /**
     *
     * @param type $datos
     */
    private function administracionTareas($datos)
    {
        $query = "SELECT id, nombre_tarea, tipo_tarea FROM tareas WHERE cartera = '" . $datos['cartera'] . "'";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function administracionArbol($datos)
    {
        $resultado = array();
        $query = "SELECT id, homologado FROM homologado_accion WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
        $resultado['acciones'] = $this->row($query);
        $query = "SELECT id, homologado FROM homologado_contacto WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
        $resultado['contactos'] = $this->row($query);
        $query = "SELECT id, homologado FROM homologado_efecto WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
        $resultado['efectos'] = $this->row($query);
        $query = "SELECT id, motivo FROM motivos_no_pago WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
        $resultado['motivo'] = $this->row($query);
        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function parametroArbol($datos)
    {
        $resultado = array();

        switch ($datos['tipo']) {
            case 'accion':
                $query = "SELECT id, homologado FROM homologado_contacto WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
                $resultado['homologado'] = $this->row($query);
                $query = "SELECT h.id as id, h.homologado FROM homologado_contacto h, arbol_contacto a WHERE a.id_cliente = '" . $datos['cartera'] . "'"
                    . "AND a.id_contacto = h.id AND a.id_accion = '" . $datos['parametro'] . "' AND a.estado = '1' AND h.estado = '1'";
                $resultado['asignadas'] = $this->row($query);

                break;

            case 'contacto':
                $query = "SELECT id, homologado FROM homologado_efecto WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
                $resultado['homologado'] = $this->row($query);
                $query = "SELECT h.id, h.homologado FROM homologado_efecto h, arbol_efecto a WHERE a.id_cliente = '" . $datos['cartera'] . "'"
                    . "AND a.id_efecto = h.id AND a.id_contacto = '" . $datos['parametro'] . "' AND a.estado = '1' AND h.estado = '1'";
                $resultado['asignadas'] = $this->row($query);
                break;
            case 'motivo':
                $query = "SELECT id, motivo FROM motivos_no_pago WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1'";
                $resultado['homologado'] = $this->row($query);
                $query = "SELECT m.id, m.motivo FROM motivos_no_pago m, arbol_motivos_no_pago a WHERE a.id_cliente = '" . $datos['cartera'] . "'"
                    . "AND a.id_motivo_no_pago = m.id AND a.id_contacto = '" . $datos['parametro'] . "' AND m.estado = '1'";
                $resultado['asignadas'] = $this->row($query);
                break;
        }
        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function crearParametroArbol($datos)
    {
        $tipoAccionContacto = explode('-', $datos['parametro'][0]);
        $tipoAccionContacto = $tipoAccionContacto[1];
        switch ($datos['tipo']) {
            case 'accion':
                $query = "UPDATE arbol_contacto SET estado = 0 WHERE id_accion = '" . $tipoAccionContacto . "' AND id_cliente =  '" . $datos['cartera'] . "'";
                $resultado = $this->ejecutar2($query);
                foreach ($datos['parametro'] as $parametro) {
                    $arr = explode('-', $parametro);
                    $query = "INSERT INTO arbol_contacto (id_accion, id_contacto, id_cliente) "
                        . "VALUES('" . $arr[1] . "', '" . $arr[0] . "', " . $datos['cartera'] . ") "
                        . "ON DUPLICATE KEY UPDATE estado = 1";
                    $resultado = $this->ejecutar2($query);
                }

                break;

            case 'contacto':
                $query = "UPDATE arbol_efecto SET estado = 0 WHERE id_contacto = '" . $tipoAccionContacto . "' AND id_cliente =  '" . $datos['cartera'] . "'";
                $resultado = $this->ejecutar2($query);
                foreach ($datos['parametro'] as $parametro) {
                    $arr = explode('-', $parametro);
                    $query = "INSERT INTO arbol_efecto (id_contacto, id_efecto, id_cliente) "
                        . "VALUES('" . $arr[1] . "', '" . $arr[0] . "', " . $datos['cartera'] . ") "
                        . "ON DUPLICATE KEY UPDATE estado = 1";
                    file_put_contents('resultado_consulta.txt', 'CONTACTO: ' . $query . PHP_EOL, FILE_APPEND);
                    $resultado = $this->ejecutar2($query);
                }
                break;
            case 'motivo':
                $query = "UPDATE arbol_motivos_no_pago SET estado = 0 WHERE id_contacto = '" . $tipoAccionContacto . "' AND id_cliente =  '" . $datos['cartera'] . "'";
                $resultado = $this->ejecutar2($query);
                foreach ($datos['parametro'] as $parametro) {
                    $arr = explode('-', $parametro);
                    $query = "INSERT INTO arbol_motivos_no_pago(id_contacto, id_motivo_no_pago, id_cliente)"
                        . "VALUES(" . $arr[1] . ", " . $arr[0] . ", " . $datos['cartera'] . ")"
                        . "ON DUPLICATE KEY UPDATE estado = 1";
                    $resultado = $this->ejecutar2($query);
                }
                break;
        }

        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function consultarTareas($datos)
    {
        $query = "SELECT id, nombre_tarea FROM tareas WHERE cartera = '" . $datos['cartera'] . "' "
            . "AND tipo_tarea IN ('libre', 'asesor') AND terminada = '0'";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function consultarNotificaciones($datos)
    {
        $notificaciones = array('agendamiento' => array(), 'mensajes' => array());
        $notificaciones['agendamiento'] = $this->consultarAgendamiento($datos);
        //        $notificaciones['mensajes'] = $this->consultarMensajes($datos);
        return $notificaciones;
    }

    private function consultarAgendamiento($datos)
    {
        $fecha_inicial = date('Y-m-d H:i:s');
        $nuevafecha = strtotime('+1 hour', strtotime($fecha_inicial));
        $fecha_final = date('Y-m-d H:i:s', $nuevafecha);
        $query = "SELECT documento_titular, fecha  FROM agendamiento WHERE usuario = '" . $_SESSION['usuario'] . "' AND fecha BETWEEN DATE_SUB(NOW(), INTERVAL 1 HOUR) AND DATE_ADD(NOW(), INTERVAL 10 MINUTE) AND cartera = '" . $datos['cartera'] . "' AND estado = 1";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * Función que obtiene y retorna los datos requeridos de acuerdo al tipo de informe
     * @param Type array: $datos
     **/
    private function generarInforme($datos)
    {
        switch ($datos['informe']) {
            case 'gestion':
                $resultado = $this->informeGestion($datos);
                break;
                // case 'gestion_cliente':
                //     $resultado = $this->informeGestionCliente($datos);
                //     break;
            case 'productividad':
                $resultado = $this->informeProductividad($datos);

                break;
            case 'mejor_gestion':
                $resultado = $this->informeMejorGestion($datos);
                break;
            case 'tiempos_muertos':
                $resultado = $this->informeTiemposMuertos($datos);
                break;
            case 'tiempos_muertos_detallado':
                $resultado = $this->informeTiemposMuertosDetallado($datos);
                break;
            case 'demografico':
                $resultado = $this->informeDemografico($datos);
                break;
            case 'seguimientos':
                $resultado = $this->informeSeguimientos($datos);
                break;
            default:
                # code...
                break;
        }

        /*
          $resultado = array();
          $respuesta = $this->consultasInformes($datos);
          $resultado['cabeceras'] = $respuesta['cabeceras'];
          $resultado['resultado'] = $this->row($respuesta['query']); */
        return $resultado;
    }

    /**
     * Función que obtiene y retorna los datos requeridos de acuerdo al tipo de informe
     * @param Type array: $tipo
     * @return type string: $query: contiene la consulta solicitada de acuerdo al tipo de informe
     * */
    private function informeGestion($datos)
    {
        $query = "SELECT h.*, a.homologado as accion_homologado, e.homologado as efecto_homologado, c.homologado as contacto_homologado, 
        (SELECT motivo FROM motivos_no_pago WHERE id = h.motivo_no_pago) as motivo, (SELECT actividad FROM actividad_economica 
        WHERE id = h.actividad_economica) as actividad FROM historico_gestion h, homologado_accion a, homologado_efecto e, homologado_contacto c 
        WHERE h.fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' 
        AND h.cliente_id = '" . $datos['cartera'] . "' AND h.accion = a.id AND h.efecto = e.id 
        AND h.contacto = c.id;";
        $resultado = $this->row($query);

        if($datos['cartera'] == 19){
            $tipo = 'Solicitud';
        }elseif($datos['cartera'] == 15){
            $tipo = 'Solicitud';
        }else{
            $tipo = 'Producto Nuevo';
        }
        $cabeceras = array(
            'Identificacion', 'Obligacion', 'Fecha Gestion',
            'Accion', 'Efecto', 'Contacto', 'Motivo No Pago',
            'Actividad Economica', 'Fecha Promesa', 'Valor', 'Tipo Acuerdo',
            'Telefono', 'Seguimiento', 'Observaciones', 'Gestor', $tipo, 'Moto', 'salarios_rango',
            'Hora inicio Gestion', 'Hora Fin Gestion', 'Tiempo Gestion', 'Tiempo entre llamadas'
        );
        if($datos['cartera'] != 9){
            unset($cabeceras[16]);
            unset($cabeceras[17]);
        }

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        // header('Content-Type: text/html; charset=UTF-8');
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $fechas = explode(' ', $campos['fecha_gestion']);
            $horaInicio = explode(' ', $campos['inicio_gestion']);
            $fechaUno = new DateTime($horaInicio[1]);
            $intervaloLlamada = (empty($array['hora_gestion'])) ? ($fechaUno) : new DateTime($array['hora_gestion']);
            $gestorAnterior = (isset($array['gestor'])) ? $array['gestor'] : '';
            $fechaDos = new DateTime($fechas[1]);
            $fechaGestion = (isset($array['fecha_gestion'])) ? $array['fecha_gestion'] : '';
            $array['identificacion'] = $campos['cedula_deudor'];
            if ($datos['cartera'] == '2') {
                $array['obligacion'] = "P" . utf8_decode(utf8_encode($campos['obligacion']));
            } else {
                $array['obligacion'] = '_' . utf8_decode(utf8_encode($campos['obligacion']));
            }
            $array['fecha_gestion'] = $fechas[0];
            $array['accion'] = utf8_decode(utf8_encode($campos['accion_homologado']));
            $array['efecto'] = utf8_decode(utf8_encode($campos['efecto_homologado']));
            $array['contacto'] = utf8_decode(utf8_encode($campos['contacto_homologado']));
            $array['motivo_no_pago'] = utf8_decode(utf8_encode($campos['motivo']));
            $array['actividad_economica'] = utf8_decode(utf8_encode($campos['actividad']));
            $array['fecha_promesa'] = $campos['fecha_acuerdo'];
            $array['valor'] = $campos['valor_acuerdo'];
            $array['tipo_acuerdo'] = $campos['tipo_negociacion'];
            $array['telefono'] = $campos['telefono'];
            $array['seguimiento'] = $campos['fecha_seguimiento'];
            $array['observaciones'] = $campos['observaciones'];
            $array['gestor'] = $campos['gestor'];
            $array['producto_nuevo'] = $campos['producto_nuevo'];
            if($datos['cartera'] == 9){
                $array['moto'] = $campos['moto'];
                $array['salarios_rango'] = $campos['salarios_rango'];
            }
            $array['inicio_gestion'] = $horaInicio[1];
            $array['hora_gestion'] = $fechas[1];
            $intervaloLlamada = ($array['gestor'] != $gestorAnterior || $array['fecha_gestion'] != $fechaGestion) ? ($fechaUno) : $intervaloLlamada;
            $array['tiempo_gestion'] = ($fechaUno->diff($fechaDos))->format('%i:%s ');
            $array['tiempo_entre_llamadas'] = ($intervaloLlamada->diff($fechaUno))->format('%h:%i:%s');


            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    /**
     * Función que obtiene y retorna los datos requeridos de acuerdo al tipo de informe
     * @param Type array: $tipo
     * @return type string: $query: contiene la consulta solicitada de acuerdo al tipo de informe
     * */
    private function informeProductividad($datos)

    {

        $resultado = array();

        $array = array();

        $query = "SELECT gestor, count(DISTINCT cedula_deudor) as cliente FROM historico_gestion WHERE cliente_id = '" . $datos['cartera'] . "' AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP BY gestor;";
        $array['clientes'] = $this->row($query);

        $query = "SELECT gestor, COUNT(efecto) as promesa FROM `historico_gestion` WHERE efecto in(SELECT id FROM homologado_efecto where id_cliente = '" . $datos['cartera'] . "' 
                AND id_efecto in('108','137')) AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP by gestor;";
        $array['promesas'] = $this->row($query);

        $query = "SELECT gestor, COUNT(efecto) as posible FROM `historico_gestion` WHERE efecto in(SELECT id FROM homologado_efecto where id_cliente = '" . $datos['cartera'] . "'  
                AND id_efecto in('106')) AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP by gestor;";
        $array['posibles'] = $this->row($query);

        $query = "SELECT gestor, COUNT(contacto) as contacto FROM historico_gestion WHERE contacto in(SELECT id FROM homologado_contacto WHERE id_contacto = '4' AND id_cliente = '" . $datos['cartera'] . "') 
                AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP by gestor;";
        $array['directos'] = $this->row($query);



        $query = "SELECT gestor, COUNT(efecto) as gestiones FROM `historico_gestion` WHERE cliente_id = '" . $datos['cartera'] . "' AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP by gestor;";

        $array['gestiones'] = $this->row($query);

        $resultado = $array;

        $cabeceras = array(
            'Agente', 'Clientes Gestionados', 'Numero de Compromisos',
            'Numero de Posibles', 'Numero de Directos', 'Numero de Gestiones'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        header('Content-Type: text/html; charset=UTF-8');
        fputcsv($fp, $cabeceras, ';');
        $array = array();

        $i = 0;

        foreach ($resultado['gestiones'] as $campos) {

            $array['agente'] = $resultado['gestiones'][$i]['gestor'];
            $clave_gestionado = array_search($array['agente'], array_column($resultado['clientes'], 'gestor'));
            $array['gestionados'] = $resultado['clientes'][$clave_gestionado]['cliente'];

            $clave_compromiso = array_search($array['agente'], array_column($resultado['promesas'], 'gestor'));
            $clave_compromiso = ($clave_compromiso === 0) ? "0" : $clave_compromiso;
            $array['compromisos'] = ($clave_compromiso != '') ? $resultado['promesas'][$clave_compromiso]['promesa'] : '0';

            $clave_posible = array_search($array['agente'], array_column($resultado['posibles'], 'gestor'));
            $clave_posible = ($clave_posible === 0) ? "0" : $clave_posible;
            $array['posibles'] = ($clave_posible != '') ? $resultado['posibles'][$clave_posible]['posible'] : '0';

            $clave_directo = array_search($array['agente'], array_column($resultado['directos'], 'gestor'));
            $clave_directo = ($clave_directo === 0) ? "0" : $clave_directo;
            $array['directos'] = ($clave_directo != '') ? $resultado['directos'][$clave_directo]['contacto'] : '0';

            $clave_gestiones = array_search($array['agente'], array_column($resultado['gestiones'], 'gestor'));
            $clave_gestiones = ($clave_gestiones === 0) ? "0" : $clave_gestiones;
            $array['gestiones'] = ($clave_gestiones != '') ? $resultado['gestiones'][$clave_gestiones]['gestiones'] : '0';

            fputcsv($fp, $array, ';');

            $i++;
        }
        fclose($fp);

        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informeMejorGestion($datos)
    {
        $arr = array();
        $query = "SELECT h.*, a.homologado as accion_homologado, e.homologado as efecto_homologado, c.homologado as contacto_homologado, 
            (SELECT motivo FROM motivos_no_pago WHERE id = h.motivo_no_pago) as motivo, (SELECT actividad FROM actividad_economica 
            WHERE id = h.actividad_economica) as actividad FROM historico_gestion h, homologado_accion a, homologado_efecto e, homologado_contacto c 
            WHERE h.fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00'
                AND '" . $datos['fecha_final'] . " 23:59:59' AND h.cliente_id = '" . $datos['cartera'] . "' AND h.accion = a.id AND h.efecto = e.id 
            AND h.contacto = c.id ORDER BY e.peso, h.cedula_deudor ASC;";

        $arr = $this->row($query);

        $resultado = $arr;

        $cabeceras = array(
            'Identificacion', 'Obligacion', 'Fecha Gestion',
            'Hora Gestion', 'Accion', 'Efecto', 'Contacto', 'Motivo No Pago',
            'Actividad Economica', 'Fecha Promesa', 'Valor', 'Tipo Acuerdo',
            'Telefono', 'Seguimiento', 'Observaciones', 'Gestor'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        header('Content-Type: text/html; charset=UTF-8');
        fputcsv($fp, $cabeceras, ';');
        foreach ($arr as $campos) {
            $fechas = explode(' ', $campos['fecha_gestion']);
            $array['identificacion'] = $campos['cedula_deudor'];
            $array['obligacion'] = $campos['obligacion'];
            $array['fecha_gestion'] = $fechas[0];
            $array['hora_gestion'] = $fechas[1];
            $array['accion'] = utf8_decode(utf8_encode($campos['accion_homologado']));
            $array['efecto'] = utf8_decode(utf8_encode($campos['efecto_homologado']));
            $array['contacto'] = utf8_decode(utf8_encode($campos['contacto_homologado']));
            $array['motivo_no_pago'] = utf8_decode(utf8_encode($campos['motivo']));
            $array['actividad_economica'] = utf8_decode(utf8_encode($campos['actividad']));
            $array['fecha_promesa'] = $campos['fecha_acuerdo'];
            $array['valor'] = $campos['valor_acuerdo'];
            $array['tipo_acuerdo'] = $campos['tipo_negociacion'];
            $array['telefono'] = $campos['telefono'];
            $array['seguimiento'] = $campos['fecha_seguimiento'];
            $array['observaciones'] = $campos['observaciones'];
            $array['gestor'] = $campos['gestor'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informeTiemposMuertos($datos)
    {
        $arr = array();
        $cont = 0;
        $query = "SELECT usuario, tipo_pausa, SEC_TO_TIME( SUM( TIME_TO_SEC( `tiempo_pausa` ) ) ) AS tiempo, fecha_pausa FROM pausas 
        WHERE cartera = '" . $datos['cartera'] . "' AND fecha_pausa BETWEEN  '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59'
        GROUP BY usuario, tipo_pausa;";

        $arr = $this->row($query);

        $resultado = $arr;

        $cabeceras = array('Usuario', 'Pausa', 'Tiempo Total', 'Fecha');
        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        header('Content-Type: text/html; charset=UTF-8');
        fputcsv($fp, $cabeceras, ';');

        foreach ($arr as $campos) {
            $array['usuario'] = $campos['usuario'];
            $array['tipo_pausa'] = $campos['tipo_pausa'];
            $array['tiempo_total'] = $campos['tiempo'];
            $array['fecha_pausa'] = $campos['fecha_pausa'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    /**
     * Función que obtiene y retorna los datos requeridos de acuerdo al tipo de informe
     * @param Type array: $tipo
     * @return type string: $query: contiene la consulta solicitada de acuerdo al tipo de informe
     * */
    private function informeTiemposMuertosDetallado($datos)
    {
        $arr = array();
        $cont = 0;

        $query = "SELECT usuario, tipo_pausa, tiempo_pausa AS tiempo, fecha_pausa FROM pausas WHERE cartera = '" . $datos['cartera'] . "' 
            AND fecha_pausa BETWEEN  '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' order by usuario asc, tipo_pausa asc;";

        $arr = $this->row($query);

        $resultado = $arr;

        $cabeceras = array('Usuario', 'Pausa', 'Tiempo', 'Fecha');
        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        header('Content-Type: text/html; charset=UTF-8');
        fputcsv($fp, $cabeceras, ';');

        foreach ($arr as $dato) {
            $array['usuario'] = $dato['usuario'];
            $array['tipo_pausa'] = $dato['tipo_pausa'];
            $array['tiempo_total'] = $dato['tiempo'];
            $array['fecha_pausa'] = $dato['fecha_pausa'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    /**
     * Función que obtiene y retorna los datos requeridos de acuerdo al tipo de informe
     * @param Type array: $tipo
     * @return type string: $query: contiene la consulta solicitada de acuerdo al tipo de informe
     * */
    private function consultasInformes($datos)
    {
        $resultado = array();
        switch ($datos['informe']) {
            case 'gestion':
                $resultado['query'] = "SELECT * FROM historico_gestion
                WHERE fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00'
                AND '" . $datos['fecha_final'] . " 23:59:59' AND cliente_id = '" . $datos['cartera'] . "'";

                $resultado['cabeceras'] = array(
                    'Identificacion', 'Obligacion', 'Fecha Gestion',
                    'Hora Gestion', 'Accion', 'Efecto', 'Contacto', 'Motivo No Pago',
                    'Actividad Economica', 'Fecha Promesa', 'Valor', 'Tipo Acuerdo',
                    'Telefono', 'Seguimiento', 'Observaciones', 'Gestor'
                );
                break;

            case 'productividad':
                $query = "";
                break;
            default:
                # code...
                break;
        }

        return $resultado;
    }

    /**
     * Función que obtiene información de homologados por cartera
     *
     * @param Type array: $datos contiene la información requerida para parametrizar las consultas
     * @return type array: $return:retorna todos los datos de las tipificaciones genericas y por cartera
     * */
    private function administracionCartera($datos)
    {
        /*         * *DEFAULT** */
        $return = array();
        $query = "SELECT id, accion FROM accion WHERE estado = '1'";
        $resultado = $this->row($query);
        $return['accion'] = $resultado;

        $query = "SELECT id, contacto FROM contacto WHERE estado = '1'";
        $resultado = $this->row($query);
        $return['contacto'] = $resultado;

        $query = "SELECT id, efecto FROM efecto WHERE estado = '1'";
        $resultado = $this->row($query);
        $return['efecto'] = $resultado;

        /*         * *HOMOLOGADO CARTERA** */

        $query = "SELECT id, id_accion, homologado FROM homologado_accion WHERE estado = '1' AND id_cliente = '" . $datos['carteraActual'] . "' ORDER BY homologado asc";

        $resultado = $this->row($query);
        $return['homologado_accion'] = $resultado;

        $query = "SELECT id, id_contacto, homologado FROM homologado_contacto WHERE estado = '1' AND id_cliente = '" . $datos['carteraActual'] . "' ORDER BY homologado asc";
        $resultado = $this->row($query);
        $return['homologado_contacto'] = $resultado;

        $query = "SELECT id, id_efecto, homologado FROM homologado_efecto WHERE estado = '1' AND id_cliente = '" . $datos['carteraActual'] . "' ORDER BY homologado asc";
        $resultado = $this->row($query);
        $return['homologado_efecto'] = $resultado;

        $query = "SELECT id, motivo FROM motivos_no_pago WHERE estado = '1' AND id_cliente = '" . $datos['carteraActual'] . "' ORDER BY motivo asc";
        $resultado = $this->row($query);
        $return['motivos_no_pago'] = $resultado;


        return $return;
    }

    /**
     * Función que obtiene información de homologados por cartera
     *
     * @param Type array: $datos contiene la información requerida para parametrizar las consultas
     * @return type array: $return:retorna todos los datos de las tipificaciones genericas y por cartera
     * */
    private function estadoTarea($datos)
    {
        $resultado = array();
        $query = "SELECT COUNT(identificacion) as gestionado, usuario FROM datos_tareas WHERE id_tarea = '" . $datos['id'] . "'
                  AND gestionado = '1' GROUP BY usuario";

        $gestionados_por_asesor = $this->row($query);
        foreach ($gestionados_por_asesor as $gestionados) {
            $resultado['gestionados_por_asesor']['labels'][] = $gestionados['usuario'];
            $resultado['gestionados_por_asesor']['data'][] = $gestionados['gestionado'];
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            $resultado['gestionados_por_asesor']['colores'][] = $color;
        }

        $query = "SELECT COUNT(identificacion) as gestionado FROM datos_tareas WHERE id_tarea = '" . $datos['id'] . "'
                  AND gestionado = '1'";
        $gestionados = $this->row($query);
        $resultado['gestionados'] = $gestionados[0]['gestionado'];


        $query = "SELECT COUNT(identificacion) as no_gestionado FROM datos_tareas WHERE id_tarea = '" . $datos['id'] . "'
                  AND gestionado = ''";
        $no_gestionados = $this->row($query);
        $resultado['no_gestionados'] = $no_gestionados[0]['no_gestionado'];

        $query = "SELECT COUNT(identificacion) as cantidad, TIMESTAMPDIFF(MINUTE , dt.inicio_gestion, dt.fin_gestion ) AS diferencia
                  FROM datos_tareas dt
                  WHERE dt.id_tarea = '" . $datos['id'] . "' AND dt.fin_gestion != ''";

        $diferencias = $this->row($query);
        $suma = 0;
        foreach ($diferencias as $diferencia) {
            $suma = $suma + $diferencia['diferencia'];
        }

        $resultado['promedio_gestion'] = $suma / $diferencias[0]['cantidad'];
        return $resultado;
    }

    /**
     *
     * @param type $datos
     */
    private function miProductividad($datos = array())
    {
        $query = "SELECT id FROM homologado_contacto WHERE id_contacto = '4' AND id_cliente = '" . $datos['cartera'] . "'";
        $contactos = "";
        $resultante = $this->row($query);
        foreach ($resultante as $contacto) {
            $contactos = $contactos . "'" . $contacto['id'] . "', ";
        }

        /* $query = "SELECT id FROM homologado_efecto WHERE id_efecto IN('108', '137') AND id_cliente = '" . $datos['cartera'] . "'";
          $resultante = $this->row($query);
          $promesas = "";
          foreach ($resultante as $promesa) {
          $promesas = $promesas . "'" . $promesa['id'] . "', ";
          }

          $query = "SELECT id FROM homologado_efecto WHERE id_efecto = '106' AND id_cliente = '" . $datos['cartera'] . "'";
          $posibles = "";
          $resultante = $this->row($query);
          foreach ($resultante as $posible) {
          $posibles = $posibles . "'" . $posible['id'] . "', ";
          } */

        $resultado = array();
        $array = array();
        $fecha = date('Y-m-d');
        $fecha_final = date('Y-m-d');
        /*
          $query = "SELECT COUNT(cedula_deudor) as clientes FROM historico_gestion WHERE gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
          AND '" . $fecha . " 23:59:59' GROUP BY cedula_deudor";
          $clientes = $this->row($query);
          $array['clientes'][0]['clientes'] = sizeof($clientes);

          $query = "SELECT COUNT(efecto) as gestiones FROM historico_gestion WHERE gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
          AND '" . $fecha . " 23:59:59'";
          $array['gestiones'] = $this->row($query);
          $query = "SELECT COUNT(efecto) as promesas FROM historico_gestion WHERE efecto IN(" . substr($promesas, 0, -2) . ") AND gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
          AND '" . $fecha . " 23:59:59'";
          $array['promesas'] = $this->row($query);
          $query = "SELECT COUNT(efecto) as posibles FROM historico_gestion WHERE efecto IN(" . substr(strtoupper($posibles), 0, -2) . ") AND gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
          AND '" . $fecha . " 23:59:59'";
          $array['posibles'] = $this->row($query);
         */
        $query = "SELECT cedula_deudor FROM historico_gestion WHERE contacto IN(" . substr(strtoupper($contactos), 0, -2) . ") AND gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
                AND '" . $fecha . " 23:59:59' GROUP BY cedula_deudor";
        $clientes = $this->row($query);

        $numDirectos = 0;
        foreach ($clientes as $cliente) {
            $query = "SELECT COUNT(id) FROM historico_gestion WHERE contacto IN(" . substr(strtoupper($contactos), 0, -2) . ") AND gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
                AND '" . $fecha . " 23:59:59' AND cedula_deudor = '" . $cliente['cedula_deudor'] . "'";
            $directos = $this->row($query);

            if ($directos > 1) {
                $numDirectos += 1;
            } else {
                $numDirectos += $directos;
            }
        }
        /*
          $query = "SELECT COUNT(contacto) as directos FROM historico_gestion WHERE contacto IN(" . substr(strtoupper($contactos), 0, -2) . ") AND gestor = '" . $_SESSION['usuario'] . "' AND fecha_gestion BETWEEN '" . $fecha . " 00:00:00'
          AND '" . $fecha . " 23:59:59'"; */
        $array['directos'] = $numDirectos;
        $resultado = $array;
        return $resultado;
    }

    /**
     * Función que cambia el orden en el cual se listan las tareas que ven los asesores
     * @param type $datos
     * @return type $string resultado
     */
    private function cambiarOrdenTarea($datos)
    {
        if ($datos['filtro1'] != '' && $datos['filtro2'] != '') {
            $coma = ',';
        }
        $query = "UPDATE tareas SET orden = '" . $datos['filtro1'] . ' ' . $datos['orden'] . '' . $coma . ' ' . $datos['filtro2'] . ' ' . $datos['orden1'] . "' WHERE id = '" . $datos['id_tarea'] . "'";
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * Función que cambia el orden en el cual se listan las tareas que ven los asesores
     * @param type $datos
     * @return type $string resultado
     */
    private function seleccionarObligacionesGestion($datos)
    {
        $query = "SELECT * FROM obligaciones WHERE CC = '" . $datos['identificacion'] . "' AND cartera = '" . $datos['cartera'] . "'";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     *
     * @param type $datos
     * @return type
     */
    private function validarCredenciales($datos)
    {
        $query = "SELECT * FROM usuarios WHERE usuario = '" . $_SESSION['usuario'] . "' "
            . "AND password = MD5('" . $datos['password'] . "')";

        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     *
     * @param type $datos
     * @return type
     */
    private function iniciarPausa($datos)
    {
        $query = "UPDATE usuarios SET estado_pausa = '1' WHERE usuario = '" . $_SESSION['usuario'] . "'";
        $_SESSION['estado_pausa'] = 1;
        $_SESSION['tipo_pausa'] = $datos['pausa'];
        $_SESSION['label_pausa'] = $datos['label'];
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    /**
     *
     * @param type $datos
     * @return type
     */
    private function guardarTiempoMuerto($datos)
    {
        $query = "INSERT INTO pausas (tipo_pausa, tiempo_pausa, usuario, fecha_pausa, cartera) "
            . "VALUES ('" . $datos['tipo'] . "', '" . $datos['tiempo'] . "', '" . $_SESSION['usuario'] . "', NOW(), '" . $datos['cartera'] . "')";
        if ($_SESSION['usuario'] == 'vsuarez') {
            file_put_contents("../../logs/vsuarez.txt", $query);
        }
        $resultado = $this->ejecutar2($query);
        $query = "UPDATE usuarios SET estado_pausa = '0' WHERE usuario = '" . $_SESSION['usuario'] . "' ";
        $this->ejecutar2($query);
        $_SESSION['estado_pausa'] = 0;

        return $resultado;
    }
    /**
     * @metodo busquedaReferencia
     * @param type $datos
     * @return type
     */
    private function busquedaReferencia($datos)
    {
        $resultado = array();

        /* Obligación */
        $query = 'SELECT * FROM obligaciones WHERE numero_obligacion = "' . trim($datos['obligacion']) . '" AND cartera = "' . trim($datos['cartera']) . '"';
        $resultado['obligacion'] = $this->row($query);

        /* Pagos */
        $query = 'SELECT * FROM pagos WHERE obligacion = "' . trim($datos['obligacion']) . '" AND cliente_pago = "' . trim($datos['cartera']) . '"';
        $resultado['pagos'] = $this->row($query);

        return $resultado;
    }


    /**
     * Función que obtiene y retorna los datos requeridos de acuerdo al tipo de informe
     * @param Type array: $datos
     * @return type string: $query: contiene la consulta solicitada de acuerdo al tipo de informe
     * */
    private function informeDemografico($datos)
    {
        $arr = array();

        $query = "SELECT cedula_deudor FROM historico_gestion WHERE fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59'"
            . "AND cliente_id = '" . $datos['cartera'] . "' GROUP BY cedula_deudor";

        $deudores = $this->row($query);

        $resultado = $deudores;

        foreach ($deudores as $key => $deudor) {
            //*Telefonos*//
            $query = "SELECT * FROM telefonos WHERE cedula_deudor = '" . $deudor['cedula_deudor'] . "'";
            $arr[$key]['telefono'] = $this->row($query);

            //*Direcciones*//
            $query = "SELECT * FROM direcciones WHERE cedula_deudor = '" . $deudor['cedula_deudor'] . "'";
            $arr[$key]['direccion'] = $this->row($query);

            //*Correos*//
            $query = "SELECT * FROM correos WHERE cedula_deudor = '" . $deudor['cedula_deudor'] . "'";
            $arr[$key]['correo'] = $this->row($query);
        }
        // Telefonos
        $this->informeTipoDemografico($datos, $arr, 'Telefono');
        // Direccion
        $this->informeTipoDemografico($datos, $arr, 'Direccion');
        // Correos
        $this->informeTipoDemografico($datos, $arr, 'Correos');

        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informeSeguimientos($datos){
        $query = "SELECT h.* FROM historico_gestion h
        WHERE h.fecha_gestion  BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' 
        AND h.cliente_id = '" . $datos['cartera'] . "' AND fecha_seguimiento != '' ORDER BY gestor";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Identificacion', 'Obligacion', 'Fecha Gestion',
            'Seguimiento', 'Observaciones', 'Gestor'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        header('Content-Type: text/html; charset=UTF-8');
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array['identificacion'] = $campos['cedula_deudor'];
            if ($datos['cartera'] == '2') {
                $array['obligacion'] = "P" . utf8_decode(utf8_encode($campos['obligacion']));
            } else {
                $array['obligacion'] = '_' . utf8_decode(utf8_encode($campos['obligacion']));
            }
            $array['fecha_gestion'] = $campos['fecha_gestion'];
            $array['seguimiento'] = $campos['fecha_seguimiento'];
            $array['observaciones'] = $campos['observaciones'];
            $array['gestor'] = $campos['gestor'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function exportarDeudorDemografico($datos){
        $cedula = explode(',', $datos['cedula']);
        $cedula = "'" . implode("','", $cedula) . "'";
        $query = "SELECT t.cedula_deudor, t.telefono, d.ciudad, d.direccion, c.correo FROM telefonos t 
        INNER JOIN direcciones d ON t.cedula_deudor = d.cedula_deudor 
        INNER JOIN correos c ON d.cedula_deudor = c.cedula_deudor WHERE t.cedula_deudor in($cedula)";
        $resultado = $this->row($query);
        return $resultado;
    }

    private function informeTipoDemografico($datos, $data, $parametro)
    {

        switch ($parametro) {
            case 'Telefono':
                $cabeceras = array('Identificacion', 'Telefono', 'Tipo Telefono', 'Hora Disponibilidad', 'Estado');

                $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . '_Telefonos ' . date("Y-m-d") . '.csv', 'w');
                header('Content-Type: text/html; charset=UTF-8');
                fputcsv($fp, $cabeceras, ';');

                foreach ($data as $datos) {
                    foreach ($datos['telefono'] as $telefono) {

                        $query = "SELECT * FROM usuarios WHERE id_usuario = '" . $telefono['usuario_modificacion'] . "'";
                        $usuario = $this->row($query);

                        $array['identificacion'] = $telefono['cedula_deudor'];
                        $array['telefono'] = $telefono['telefono'];
                        $array['tipo_telefono'] = utf8_decode(utf8_encode($telefono['tipo_telefono']));
                        //$array['usuario_modificacion'] = isset($usuario[0]) ? utf8_decode($usuario[0]['usuario']) : 'NO COINCIDE';
                        $array['hora_disponibilidad'] = $telefono['hora_disponibilidad'];
                        $array['estado'] = ($telefono['estado'] == 1 ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro'));

                        fputcsv($fp, $array, ';');
                    }
                }
                fclose($fp);
                break;

            case 'Direccion':
                $cabeceras = array('Identificacion', 'Ciudad', 'Direccion', 'Tipo Direccion', 'Usuario Modificacion', 'Fecha Modificacion', 'Estado');

                $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . '_Direcciones ' . date("Y-m-d") . '.csv', 'w');
                header('Content-Type: text/html; charset=UTF-8');
                fputcsv($fp, $cabeceras, ';');

                foreach ($data as $datos) {
                    foreach ($datos['direccion'] as $direccion) {

                        $query = "SELECT * FROM usuarios WHERE id_usuario = '" . $direccion['usuario_modificacion'] . "'";
                        $usuario = $this->row($query);

                        $array['identificacion'] = $direccion['cedula_deudor'];
                        $array['ciudad'] = utf8_decode(utf8_encode($direccion['ciudad']));
                        $array['direccion'] = utf8_decode(utf8_encode($direccion['direccion']));
                        $array['tipo_direccion'] = utf8_decode(utf8_encode($direccion['tipo_direccion']));
                        $array['usuario_modificacion'] = isset($usuario[0]) ? utf8_decode($usuario[0]['usuario']) : 'NO COINCIDE';
                        $array['fecha_modificacion'] = $direccion['fecha_modificacion'];
                        $array['estado'] = ($direccion['estado'] == 1 ? 'Activo' : 'Inactivo');

                        fputcsv($fp, $array, ';');
                    }
                }
                fclose($fp);
                break;

            case 'Correos':
                $cabeceras = array('Identificacion', 'Correo', 'Tipo Correo',  'Estado');

                $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . '_Correos ' . date("Y-m-d") . '.csv', 'w');
                header('Content-Type: text/html; charset=UTF-8');
                fputcsv($fp, $cabeceras, ';');

                foreach ($data as $datos) {
                    foreach ($datos['correo'] as $correo) {

                        $query = "SELECT * FROM usuarios WHERE id_usuario = '" . $correo['usuario_modificacion'] . "'";
                        $usuario = $this->row($query);

                        $array['identificacion'] = $correo['cedula_deudor'];
                        $array['correo'] = utf8_decode(utf8_encode($correo['correo']));
                        $array['tipo_correo'] = utf8_decode(utf8_encode($correo['tipo_correo']));
                        //$array['usuario_modificacion'] = $array['usuario_modificacion'] = isset($usuario[0]) ? utf8_decode($usuario[0]['usuario']) : 'NO COINCIDE';
                        //$array['fecha_modificacion'] = $correo['fecha_modificacion'];
                        $array['estado'] = ($correo['estado'] == 1 ? 'Principal' : (($correo['estado'] == 0) ? 'Ilocalizado' : 'Otro'));

                        fputcsv($fp, $array, ';');
                    }
                }
                fclose($fp);
                break;
            default:
                break;
        }
    }

    private function administrarObligatoriedad($datos)
    {
        $respuesta = array();

        $query = "SELECT * FROM inputs_gestion WHERE estado = 1";
        $respuesta['inputs'] = $this->row($query);

        $query = "SELECT * FROM obligatoriedad WHERE id_accion = '" . $datos['accion'] . "'"
            . " AND id_contacto = '" . $datos['contacto'] . "' AND id_efecto = '" . $datos['efecto'] . "' AND cartera = '" . $datos['cartera'] . "'"
            . "AND estado = 1";
        $respuesta['inputsAsignados'] = $this->row($query);

        return $respuesta;
    }

    private function busquedaEfecto($datos)
    {
        $query = "SELECT e.homologado, e.id FROM homologado_efecto e, arbol_efecto a "
            . "WHERE a.id_contacto = '" . $datos['contacto'] . "' AND a.id_efecto = e.id
                AND a.id_cliente = '" . $datos['cartera'] . "' AND a.estado = '1' AND e.estado = '1'";

        return $this->row($query);
    }

    private function guardarObligatoriedad($datos)
    {
        $query = "UPDATE obligatoriedad SET estado = 0 WHERE id_accion = '" . $datos['accion'] . "' AND id_contacto = '" . $datos['contacto'] . "'"
            . "AND id_efecto = '" . $datos['efecto'] . "' AND cartera = '" . $datos['cartera'] . "'";
        $resultado = $this->ejecutar2($query);

        foreach ($datos['parametro'] as $parametro) {
            $query = "INSERT INTO obligatoriedad (id_accion, id_contacto, id_efecto, id_input, cartera) "
                . "VALUES('" . $datos['accion'] . "', '" . $datos['contacto'] . "','" . $datos['efecto'] . "',$parametro, '" . $datos['cartera'] . "')"
                . "ON DUPLICATE KEY UPDATE estado = 1";
            $resultado = $this->ejecutar2($query);
        }

        return $resultado;
    }

    private function searchObligatoriedad($datos)
    {
        $respuesta = array();
        $query = "SELECT * FROM obligatoriedad WHERE id_accion = '" . $datos['accion'] . "'"
            . " AND id_contacto = '" . $datos['contacto'] . "' AND id_efecto = '" . $datos['efecto'] . "' AND cartera = '" . $datos['cartera'] . "'"
            . "AND estado = 1";
        $resultadoInput = $this->row($query);

        foreach ($resultadoInput as $key => $input) {
            $query = "SELECT input , id_input FROM inputs_gestion WHERE id = '" . $input['id_input'] . "' AND estado = 1";
            $respuesta[$key] = $this->row($query);
        }
        return $respuesta;
    }

    /**
     * Función que obtiene el homologado partiendo de la cartera y el efecto que se envíe
     * @param type $datos
     * @return type $array resultado
     */
    private function homologadoGevening($datos)
    {
        $query = "SELECT id FROM homologado_gevening WHERE id_cliente = '" . $datos['cartera'] . "' AND id_efecto = '" . $datos['efecto'] . "'";
        $resultado = $this->row($query);

        return $resultado;
    }

    private function guardarGuion($datos)
    {
        $query = "INSERT INTO guiones_gestion (id_efecto, guion, id_cliente)"
            . "VALUES ('" . $datos['tipo_efecto'] . "', '" . $datos['txtGuion'] . "', '" . $datos['cartera'] . "')"
            . "ON DUPLICATE KEY UPDATE guion = '" . $datos['txtGuion'] . "'";
        return $this->ejecutar2($query);
    }

    private function buscarGuion($datos)
    {
        $query = "SELECT * FROM guiones_gestion WHERE id_efecto = '" . $datos['dato'] . "' and id_cliente = '" . $datos['cartera'] . "'";

        return $this->row($query);
    }

    private function formulariosSimuladores($datos)
    {
        $query = "SELECT * FROM obligaciones WHERE cedula_deudor = '" . $datos['cedula_deudor'] . "' AND estado = '1'";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * Función que obtiene dos resultados para construir el panel del formulario de reestructuración
     * @param type $datos
     * @return type $string resultado
     */
    private function formularioReestructuracion()
    {
        $resultado['ciudades'] = $this->ciudades();
        $resultado['actividad_especifica'] = $this->actividadesEspecificas();

        return $resultado;
    }

    private function ciudades()
    {
        $query = "SELECT * FROM ciudades;";
        $resultado = $this->row($query);

        return $resultado;
    }

    private function actividadesEspecificas()
    {
        $query = "SELECT * FROM actividad_especifica;";
        $conexionBCS = new conexion_bcs();
        $resultado = $conexionBCS->select_bcs($query);
        return $resultado;
    }
    /**
     * Función que se encarga de guardar la data diligenciada en el formulario de reestructuración
     * @param type $datos
     * @return type $boolean resultado
     */
    private function guardarFormularioReestructuracion($datos)
    {
        switch ($datos['parametro']) {
            case 'informacionCliente':
                $query = $this->insertClienteReestructuracion($datos);
                break;
            case 'solicitud':
                $query = $this->insertSolicitud($datos);
                break;
            case 'referencias':
                $query = $this->insertReferencias($datos);
                break;
            case 'conyugue':
                $query = $this->insertConyugue($datos);
                break;
            case 'ubicacion':
                $query = $this->insertUbicacion($datos);
                break;
            case 'ocupacion':
                $query = $this->insertOcupacion($datos);
                break;
            case 'ingresosEgresos':
                $query = $this->insertIngresosEgresos($datos);
                break;
            case 'endeudamiento':
                $query = $this->insertEndeudamiento($datos);
                break;
            case 'balanceResponsables':
                $query = $this->balanceResponsables($datos);
                break;
        }
        $conexionBCS = new conexion_bcs();
        $resultado = $conexionBCS->insert($query);

        $return = (!$resultado) ? 'fallo' : 'ok';

        return $return;
    }

    private function insertClienteReestructuracion($datos)
    {

        $identificacionCliente = $datos['num_documento_cliente'];
        $tipoCliente = $datos['clase_cliente'];
        $tipoIdentificacion = $datos['tipo_documento_cliente'];
        $primerNombre = $datos['primer_nombre_cliente'];
        $segundoNombre = $datos['segundo_nombre_cliente'];
        $primerApellido = $datos['primer_apellido_cliente'];
        $segundoApellido = $datos['segundo_apellido_cliente'];
        $fechaNacimiento = $datos['fecha_nacimiento_cliente'];
        $lugarNacimiento = $datos['lugar_nacimiento_cliente'];
        $genero = $datos['genero_cliente'];
        $estadoCivil = $datos['estado_civil_cliente'];
        $personasACargo = $datos['personas_a_cargo'];
        $familiarEnBanco = $datos['familiar_en_banco'];
        $parentesco = $datos['parentesco_cliente'];
        $nivelEducativo = $datos['nivel_educativo'];

        //DATOS DE IDENTIFICACION
        $fechaExpedicion = $datos['fecha_expedicion'];
        $lugarExpedicion = $datos['lugar_expedicion'];

        $query = "INSERT INTO solicitante (numero_identificacion,tipo_solicitante,tipo_documento,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,parentesco_titular,parentesco_familiar_bcs,ciudad_nacimiento,fecha_nacimiento,ciudad_expedicion,
        fecha_expedicion,genero,estado_civil,personas_a_cargo,nivel_educativo)
        VALUES ('$identificacionCliente','$tipoCliente','$tipoIdentificacion','$primerNombre','$segundoNombre','$primerApellido','$segundoApellido','$parentesco', '$familiarEnBanco', '$lugarNacimiento','$fechaNacimiento','$lugarExpedicion',
        '$fechaExpedicion','$genero','$estadoCivil', '$personasACargo','$nivelEducativo')
        ON DUPLICATE KEY UPDATE numero_identificacion = '$identificacionCliente', tipo_solicitante = '$tipoCliente', tipo_documento =  '$tipoIdentificacion', primer_nombre = '$primerNombre', segundo_nombre = '$segundoNombre', primer_apellido = '$primerApellido',
        segundo_apellido = '$segundoApellido', parentesco_titular = '$parentesco', parentesco_familiar_bcs = '$familiarEnBanco', ciudad_nacimiento = '$lugarNacimiento', fecha_nacimiento = '$fechaNacimiento', ciudad_expedicion = '$lugarExpedicion',
        fecha_expedicion = '$fechaExpedicion', genero = '$genero', estado_civil = '$estadoCivil', personas_a_cargo = '$personasACargo', nivel_educativo = '$nivelEducativo';";

        $idCliente = $datos['num_documento_cliente'];
        setcookie('id', $idCliente, time() + 3600);
        $tipoCliente = $datos['clase_cliente'];

        return $query;
    }

    private function insertSolicitud($datos)
    {
        $canal_radicador = $datos['canal_radicador'];
        $oficina_administradora = $datos['oficina'];
        $numero_obligacion = $datos['numero_obligacion'];
        $tipo_pagare_soporte = $datos['tipo_pagare'];
        $garantias_actuales = $datos['garantias_actuales'];
        $valor_solicitado = $datos['valor_solicitado'];
        $tipo_solicitud = $datos['tipo_solicitud'];
        $subtipo_solicitud = $datos['subtipo_solicitud'];
        $estrategia = $datos['estrategia'];
        $modalidad = $datos['modalidad'];
        $tipo_cartera = $datos['tipo_cartera'];
        $plazo_actual = $datos['plazo_actual'];
        $nuevo_plazo = $datos['nuevo_plazo'];
        $periodo_gracia = $datos['periodo_gracia'];
        $num_meses = $datos['numero_meses'];
        $valor_cuota_sugerida = $datos['valor_sugerido'];
        $nueva_fecha_pago = $datos['nueva_fecha'];
        $mismo_sistema_amortizacion = $datos['mismo_sistema'];
        $nuevo_sistema_amortizacion = $datos['nuevo_sistema'];
        $nueva_tasa = $datos['nueva_tasa'];
        $abono = $datos['abona'];
        $valor_abono = $datos['valor_abono'];
        $condonacion = $datos['condonacion'];
        $justificacion = $datos['justificacion_condonacion'];
        $credito_tasa_emergencia = $datos['credito_emergencia'];
        $monto = $datos['monto'];
        $plazo = $datos['plazo'];
        $fecha_pago = $datos['fecha_pago'];
        $justificacion_solucion = $datos['justificacion_solucion'];
        $grabacion = $datos['grabacion'];
        $plazo_total = $plazo_actual + $nuevo_plazo + $num_meses;

        $query = "INSERT INTO solicitud (canal_radicador,oficina_administradora,fecha,numero_obligacion,tipo_pagare_soporte,garantias_actuales,valor_solicitado,tipo_solicitud,subtipo_solicitud,estrategia,modalidad,tipo_cartera,
        plazo_actual,nuevo_plazo, periodo_gracia,num_meses,plazo_total,valor_cuota_sugerida,nueva_fecha_pago,mismo_sistema_amortizacion,nuevo_sistema_amortizacion,nueva_tasa,abono,valor_abono,condonacion,justificacion,
        credito_tasa_emergencia,monto,plazo,fecha_pago,justificacion_solucion,valor_total_negociar, grabacion,id_cliente)
        VALUES ('$canal_radicador','$oficina_administradora','" . date("d-m-Y") . "', '$numero_obligacion', '$tipo_pagare_soporte', '$garantias_actuales', '$valor_solicitado', '$tipo_solicitud', '$subtipo_solicitud',
        '$estrategia','$modalidad', '$tipo_cartera', '$plazo_actual', '$nuevo_plazo', '$periodo_gracia', '$num_meses', '$plazo_total', '$valor_cuota_sugerida', '$nueva_fecha_pago', '$mismo_sistema_amortizacion',
        '$nuevo_sistema_amortizacion', '$nueva_tasa', '$abono', '$valor_abono', '$condonacion','$justificacion','$credito_tasa_emergencia','$monto', '$plazo','$fecha_pago','$justificacion_solucion', '$valor_solicitado',
        '$grabacion' , " . $_COOKIE['id'] . ")
        ON DUPLICATE KEY UPDATE canal_radicador = '$canal_radicador', oficina_administradora = '$oficina_administradora', fecha = '" . date("d-m-Y") . "', numero_obligacion = '$numero_obligacion', tipo_pagare_soporte = '$tipo_pagare_soporte',
        garantias_actuales = '$garantias_actuales', valor_solicitado = '$valor_solicitado', tipo_solicitud = '$tipo_solicitud', subtipo_solicitud = '$subtipo_solicitud', estrategia = '$estrategia', modalidad = '$modalidad',
        tipo_cartera = '$tipo_cartera', plazo_actual = '$plazo_actual', nuevo_plazo = '$nuevo_plazo', periodo_gracia = '$periodo_gracia', num_meses = '$num_meses', plazo_total = '$plazo_total', valor_cuota_sugerida = '$valor_cuota_sugerida',
        nueva_fecha_pago = '$nueva_fecha_pago', mismo_sistema_amortizacion = '$mismo_sistema_amortizacion', nuevo_sistema_amortizacion = '$nuevo_sistema_amortizacion', nueva_tasa = '$nueva_tasa', abono = '$abono', valor_abono =
        '$valor_abono', condonacion = '$condonacion', justificacion = '$justificacion', credito_tasa_emergencia =  '$credito_tasa_emergencia', monto = '$monto', plazo = '$plazo', fecha_pago = '$fecha_pago', justificacion_solucion =
        '$justificacion_solucion', valor_total_negociar = '$valor_solicitado', grabacion = '$grabacion';";
        return $query;
    }

    private function insertReferencias($datos)
    {
        $nombres_familiar = $datos['nombre_familiar'];
        $telefono_familiar = $datos['telefono_familiar'];
        $celular_familiar = $datos['celular_familiar'];
        $ciudad_familiar = $datos['ciudad_familiar'];
        $nombres_referencia = $datos['nombre_referencia'];
        $telefono_referencia = $datos['telefono_referencia'];
        $celular_referencia = $datos['celular_referencia'];
        $ciudad_referencia = $datos['ciudad_referencia'];

        $query = "INSERT INTO referencias (nombres_familiar,telefono_familiar,celular_familiar,ciudad_familiar,nombres_referencia,telefono_referencia,celular_referencia,ciudad_referencia,id_cliente)
        VALUES ('$nombres_familiar', '$telefono_familiar', '$celular_familiar', '$ciudad_familiar', '$nombres_referencia', '$telefono_referencia', '$celular_referencia', '$ciudad_referencia', " . $_COOKIE['id'] . ")
        ON DUPLICATE KEY UPDATE nombres_familiar = '$nombres_familiar', telefono_familiar = '$telefono_familiar', celular_familiar = '$celular_familiar', ciudad_familiar = '$ciudad_familiar', nombres_referencia = '$nombres_referencia',
        telefono_referencia = '$telefono_referencia', celular_referencia = '$celular_referencia', ciudad_referencia = '$ciudad_referencia';";

        return $query;
    }

    private function insertConyugue($datos)
    {

        $nombres = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        $tipo_documento = $datos['tipo_documento'];
        $numero_documento = $datos['numero_identificacion'];
        $telefono = $datos['telefono'];
        $actividad_economica = $datos['actividad_economica'];
        $productos_activos = $datos['productos_activos'];
        $actividad_comercial = $datos['actividad_comercial'];

        $query = "INSERT INTO conyugue (nombres,apellidos,tipo_documento,numero_documento,telefono_conyugue,actividad_economica,productos_activos,actividad_comercial,id_cliente)
        VALUES ('$nombres', '$apellidos', '$tipo_documento', '$numero_documento', '$telefono', '$actividad_economica', '$productos_activos', '$actividad_comercial', " . $_COOKIE['id'] . ")
        ON DUPLICATE KEY UPDATE nombres = '$nombres', apellidos = '$apellidos', tipo_documento = '$tipo_documento', numero_documento = '$numero_documento', telefono_conyugue = '$telefono', actividad_economica =
        '$actividad_economica', productos_activos = '$productos_activos', actividad_comercial = '$actividad_comercial';";

        return $query;
    }

    private function insertUbicacion($datos)
    {

        $direccion = $datos['direccion'];
        $tipo_vivienda = $datos['tipo_vivienda'];
        $barrio = $datos['barrio'];
        $ciudad = $datos['ciudad'];
        $celular = $datos['celular'];
        $telefono = $datos['telefono'];
        $correo = $datos['correo'];

        $query = "INSERT INTO ubicacion (direccion,tipo_vivienda,barrio,ciudad,celular,telefono,correo,id_cliente)
        VALUES ('$direccion', '$tipo_vivienda', '$barrio', '$ciudad', '$celular', '$telefono', '$correo', " . $_COOKIE['id'] . ")
        ON DUPLICATE KEY UPDATE direccion = '$direccion', tipo_vivienda = '$tipo_vivienda', barrio = '$barrio', ciudad = '$ciudad', celular = '$celular', telefono = '$telefono', correo = '$correo';";

        return $query;
    }

    private function insertOcupacion($datos)
    {
        $ocupacion = $datos['ocupacion'];
        $sector = $datos['sector'];
        $subsector = $datos['subsector'];
        $profesion_especifica = $datos['profesion_especifica'];
        $actividad_general = $datos['actividad_general'];
        $actividad_especifica = $datos['actividad_especifica'];
        $nombre_empresa = $datos['nombre_empresa'];
        $direccion_empresa = $datos['direccion_empresa'];
        $barrio = $datos['barrio_empresa'];
        $ciudad = $datos['ciudad_empresa'];
        $telefono1 = $datos['telefono1'];
        $telefono2 = $datos['telefono2'];
        $grado_formalidad = $datos['grado_formalidad'];
        $recursos_publicos = $datos['recursos_publicos'];
        $clasificacion_laboral = $datos['cargo'];
        $cargo_especifico = $datos['cargo_especifico'];
        $antiguedad_actividad = $datos['antiguedad'];
        $tipo_salario = $datos['tipo_salario'];
        $tipo_contrato = $datos['tipo_contrato'];
        $sitio_fijo = $datos['sitio_fijo'];
        $tipo_local = $datos['tipo_local'];
        $tiempo_local = $datos['tiempo_local'];
        $seguridad_social = $datos['seguridad_social'];
        $declara_renta = $datos['declara_renta'];
        $empleados_temporal = $datos['empleados_temporales'];
        $empleados_fijos = $datos['empleados_fijos'];
        $total_empleados = $empleados_fijos + $empleados_temporal;

        $query = "INSERT INTO ocupacion_principal (ocupacion,sector,subsector,profesion_especifica,actividad_general,actividad_especifica,nombre_empresa,direccion_empresa,barrio,ciudad,telefono1,telefono2,grado_formalidad,
        recursos_publicos,clasificacion_laboral,cargo_especifico,antiguedad_actividad,tipo_salario,tipo_contrato,sitio_fijo,tipo_local,tiempo_local,seguridad_social,declara_renta,empleados_temporal,empleados_fijos,
        total_empleados,id_cliente)
        VALUES ('$ocupacion', '$sector', '$subsector', '$profesion_especifica', '$actividad_general', '$actividad_especifica', '$nombre_empresa', '$direccion_empresa', '$barrio', '$ciudad', '$telefono1', '$telefono2',
        '$grado_formalidad','$recursos_publicos', '$clasificacion_laboral', '$cargo_especifico','$antiguedad_actividad','$tipo_salario','$tipo_contrato','$sitio_fijo','$tipo_local','$tiempo_local','$seguridad_social',
        '$declara_renta','$empleados_temporal','$empleados_fijos','$total_empleados', " . $_COOKIE['id'] . ")
        ON DUPLICATE KEY UPDATE  ocupacion = '$ocupacion', sector = '$sector', subsector = '$subsector', profesion_especifica = '$profesion_especifica', actividad_general = '$actividad_general', actividad_especifica = '$actividad_especifica',
        nombre_empresa = '$nombre_empresa', direccion_empresa = '$direccion_empresa', barrio = '$barrio', ciudad = '$ciudad', telefono1 = '$telefono1', telefono2 = '$telefono2', grado_formalidad = '$grado_formalidad',
        recursos_publicos = '$recursos_publicos', clasificacion_laboral = '$clasificacion_laboral', cargo_especifico = '$cargo_especifico', antiguedad_actividad = '$antiguedad_actividad', tipo_salario = '$tipo_salario',
        tipo_contrato = '$tipo_contrato', sitio_fijo = '$sitio_fijo', tipo_local = '$tipo_local', tiempo_local = '$tiempo_local', seguridad_social = '$seguridad_social', declara_renta = '$declara_renta', empleados_temporal = '$empleados_temporal',
        empleados_fijos = '$empleados_fijos', total_empleados = '$total_empleados';";

        return $query;
    }

    private function insertIngresosEgresos($datos)
    {
        //INGRESOS
        $salario_titular = $datos['salario_titular'];
        $salario_deudor1 = $datos['salario_deudor1'];
        $salario_deudor2 = $datos['salario_deudor2'];
        $ingresos_mensuales_titular = $datos['ingresos_titular'];
        $ingresos_mensuales_deudor1 = $datos['ingresos_deudor1'];
        $ingresos_mensuales_deudor2 = $datos['ingresos_deudor2'];
        $otros_ingresos_titular = $datos['otros_ingresos_titular'];
        $otros_ingresos_deudor1 = $datos['otros_ingresos_deudor1'];
        $otros_ingresos_deudor2 = $datos['otros_ingresos_deudor2'];
        $ayudas_titular = $datos['ayudas_economicas_titular'];
        $ayudas_deudor1 = $datos['ayudas_economicas_deudor1'];
        $ayudas_deudor2 = $datos['ayudas_economicas_deudor2'];
        $descripcion_otros_ingresos = $datos['descripcion_ingresos'];
        $descripcion_ayudas = $datos['descripcion_ayudas'];
        $antiguedad_titular = $datos['antiguedad_titular'];
        $antiguedad_deudor1 = $datos['antiguedad_deudor1'];
        $antiguedad_deudor2 = $datos['antiguedad_deudor2'];
        $actividad_titular = $datos['actividad_titular'];
        $actividad_deudor1 = $datos['actividad_deudor1'];
        $actividad_deudor2 = $datos['actividad_deudor2'];
        $total_otros_ingresos_titular = $otros_ingresos_titular + $ayudas_titular;
        $total_otros_ingresos_deudor1 = $otros_ingresos_deudor1 + $ayudas_deudor1;
        $total_otros_ingresos_deudor2 = $otros_ingresos_deudor2 + $ayudas_deudor2;


        //EGRESOS
        $costo_operacion_titular = $datos['costo_operacion_titular'];
        $empleados_titular = $datos['empleados_titular'];
        $arriendo_local_titular = $datos['arriendo_local_titular'];
        $cuotas_prestamos_local_titular = $datos['cuotas_prestamo_titular'];
        $otros_gastos_operativos_titular = $datos['otros_gastos_titular'];
        $costo_operacion_deudor1 = $datos['costo_operacion_deudor1'];
        $costo_operacion_deudor2 = $datos['costo_operacion_deudor2'];
        $empleados_deudor1 = $datos['empleados_deudor1'];
        $empleados_deudor2 = $datos['empleados_deudor2'];
        $arriendo_local_deudor1 = $datos['arriendo_local_deudor1'];
        $arriendo_local_deudor2 = $datos['arriendo_local_deudor2'];
        $cuotas_prestamos_local_deudor1 = $datos['cuotas_prestamo_deudor1'];
        $cuotas_prestamos_local_deudor2 = $datos['cuotas_prestamo_deudor2'];
        $otros_gastos_operativos_deudor1 = $datos['otros_gastos_deudor1'];
        $otros_gastos_operativos_deudor2 = $datos['otros_gastos_deudor2'];
        $gastos_familiares_titular = $datos['gastos_familiares_titular'];
        $arriendo_titular = $datos['valor_arriendo_hipotecas_titular'];
        $cuotasTDC_titular = $datos['cuotas_TDC_titular'];
        $cuotas_creditos_entidades_titular = $datos['cuotas_otras_entidades_titular'];
        $cuotas_creditos_bcs_titular = $datos['cuotas_con_entidad_titular'];
        $otros_egresos_titular = $datos['otros_egresos_titular'];
        $gastos_familiares_deudor1 = $datos['gastos_familiares_deudor1'];
        $gastos_familiares_deudor2 = $datos['gastos_familiares_deudor2'];
        $arriendo_deudor1 = $datos['valor_arriendo_hipotecas_deudor1'];
        $arriendo_deudor2 = $datos['valor_arriendo_hipotecas_deudor2'];
        $cuotasTDC_deudor1 = $datos['cuotas_TDC_deudor1'];
        $cuotasTDC_deudor2 = $datos['cuotas_TDC_deudor2'];
        $cuotas_creditos_entidades_deudor1 = $datos['cuotas_otras_entidades_deudor1'];
        $cuotas_creditos_entidades_deudor2 = $datos['cuotas_otras_entidades_deudor2'];
        $cuotas_creditos_bcs_deudor1 = $datos['cuotas_con_entidad_deudor1'];
        $cuotas_creditos_bcs_deudor2 = $datos['cuotas_con_entidad_deudor2'];
        $otros_egresos_deudor1 = $datos['otros_egresos_deudor1'];
        $otros_egresos_deudor2 = $datos['otros_egresos_deudor2'];
        $total_costos_titular = $costo_operacion_titular + $empleados_titular + $arriendo_local_titular + $cuotas_prestamos_local_titular + $otros_gastos_operativos_titular;
        $total_costos_deudor1 = $costo_operacion_deudor1 + $empleados_deudor1 + $arriendo_local_deudor1 + $cuotas_prestamos_local_deudor1 + $otros_gastos_operativos_deudor1;
        $total_costos_deudor2 = $costo_operacion_deudor2 + $empleados_deudor2 + $arriendo_local_deudor2 + $cuotas_prestamos_local_deudor2 + $otros_gastos_operativos_deudor2;

        $total_gastos_titular = $gastos_familiares_titular + $arriendo_titular + $cuotasTDC_titular + $cuotas_creditos_entidades_titular + $cuotas_creditos_bcs_titular + $otros_egresos_titular;
        $total_gastos_deudor1 = $gastos_familiares_deudor1 + $arriendo_deudor1 + $cuotasTDC_deudor1 + $cuotas_creditos_entidades_deudor1 + $cuotas_creditos_bcs_deudor1 + $otros_egresos_deudor1;
        $total_gastos_deudor2 = $gastos_familiares_deudor2 + $arriendo_deudor2 + $cuotasTDC_deudor2 + $cuotas_creditos_entidades_deudor2 + $cuotas_creditos_bcs_deudor2 + $otros_egresos_deudor2;


        $disponible_titular = ($salario_titular + $ingresos_mensuales_titular + $total_otros_ingresos_titular) - ($total_gastos_titular + $total_costos_titular);
        $disponible_deudor1 = ($salario_deudor1 + $ingresos_mensuales_deudor1 + $total_otros_ingresos_deudor1) - ($total_gastos_deudor1 + $total_costos_deudor1);
        $disponible_deudor2 = ($salario_deudor2 + $ingresos_mensuales_deudor2 + $total_otros_ingresos_deudor2) - ($total_gastos_deudor2 + $total_costos_deudor2);

        $query = "INSERT INTO ingresos (salario_titular,salario_deudor1,salario_deudor2,ingresos_mensuales_titular,ingresos_mensuales_deudor1,ingresos_mensuales_deudor2,otros_ingresos_titular,otros_ingresos_deudor1,otros_ingresos_deudor2,ayudas_titular,ayudas_deudor1,ayudas_deudor2,descripcion_otros_ingresos,descripcion_ayudas,antiguedad_titular,antiguedad_deudor1,antiguedad_deudor2,actividad_titular,actividad_deudor1,actividad_deudor2,total_otros_ingresos_titular,total_otros_ingresos_deudor1,total_otros_ingresos_deudor2,disponible_titular,disponible_deudor1,disponible_deudor2,total_gastos_familiares_titular,total_gastos_familiares_deudor1, total_gastos_familiares_deudor2, id_cliente)
                  VALUES ('$salario_titular','$salario_deudor1','$salario_deudor2','$ingresos_mensuales_titular','$ingresos_mensuales_deudor1','$ingresos_mensuales_deudor2','$otros_ingresos_titular','$otros_ingresos_deudor1','$otros_ingresos_deudor2','$ayudas_titular','$ayudas_deudor1','$ayudas_deudor2','$descripcion_otros_ingresos','$descripcion_ayudas','$antiguedad_titular','$antiguedad_deudor1','$antiguedad_deudor2','$actividad_titular','$actividad_deudor1','$actividad_deudor2','$total_otros_ingresos_titular','$total_otros_ingresos_deudor1','$total_otros_ingresos_deudor2','$disponible_titular','$disponible_deudor1','$disponible_deudor2', '$total_gastos_titular','$total_gastos_deudor1', '$total_gastos_deudor2', " . $_COOKIE['id'] . ")
                      ON DUPLICATE KEY UPDATE salario_titular = '$salario_titular', salario_deudor1 = '$salario_deudor1', salario_deudor2 = '$salario_deudor2', ingresos_mensuales_titular = '$ingresos_mensuales_titular', ingresos_mensuales_deudor1 = '$ingresos_mensuales_deudor1', ingresos_mensuales_deudor2 = '$ingresos_mensuales_deudor2', otros_ingresos_titular = '$otros_ingresos_titular', otros_ingresos_deudor1 = '$otros_ingresos_deudor1', otros_ingresos_deudor2 = '$otros_ingresos_deudor2', ayudas_titular = '$ayudas_titular', ayudas_deudor1 = '$ayudas_deudor1', ayudas_deudor2 = '$ayudas_deudor2', descripcion_otros_ingresos = '$descripcion_otros_ingresos', descripcion_ayudas = '$descripcion_ayudas', antiguedad_titular = '$antiguedad_titular',
                      antiguedad_deudor1 = '$antiguedad_deudor1', antiguedad_deudor2 = '$antiguedad_deudor2', actividad_titular = '$actividad_titular', actividad_deudor1 = '$actividad_deudor1', actividad_deudor2 = '$actividad_deudor2', total_otros_ingresos_titular = '$total_otros_ingresos_titular', total_otros_ingresos_deudor1 = '$total_otros_ingresos_deudor1', total_otros_ingresos_deudor2 = '$total_otros_ingresos_deudor2', disponible_titular = '$disponible_titular', disponible_deudor1 = '$disponible_deudor1', disponible_deudor2 = '$disponible_deudor2', total_gastos_familiares_titular = '$total_gastos_titular', total_gastos_familiares_deudor1 = '$total_gastos_deudor1', total_gastos_familiares_deudor2 = '$total_gastos_deudor2';

                  INSERT INTO egresos (costo_operacion_titular,empleados_titular,arriendo_local_titular,cuotas_prestamos_local_titular,otros_gastos_operativos_titular,costo_operacion_deudor1,costo_operacion_deudor2,empleados_deudor1,empleados_deudor2,arriendo_local_deudor1,arriendo_local_deudor2,cuotas_prestamos_local_deudor1,cuotas_prestamos_local_deudor2,otros_gastos_operativos_deudor1,otros_gastos_operativos_deudor2,gastos_familiares_titular,arriendo_titular,cuotasTDC_titular,cuotas_creditos_entidades_titular,cuotas_creditos_bcs_titular,otros_egresos_titular,gastos_familiares_deudor1,gastos_familiares_deudor2,arriendo_deudor1,arriendo_deudor2,cuotasTDC_deudor1,cuotasTDC_deudor2,cuotas_creditos_entidades_deudor1,cuotas_creditos_entidades_deudor2,cuotas_creditos_bcs_deudor1,cuotas_creditos_bcs_deudor2,otros_egresos_deudor1,otros_egresos_deudor2,total_costos_titular,total_costos_deudor1,total_costos_deudor2,id_cliente)
                  VALUES ('$costo_operacion_titular','$empleados_titular','$arriendo_local_titular','$cuotas_prestamos_local_titular','$otros_gastos_operativos_titular','$costo_operacion_deudor1','$costo_operacion_deudor2','$empleados_deudor1','$empleados_deudor2','$arriendo_local_deudor1','$arriendo_local_deudor2','$cuotas_prestamos_local_deudor1','$cuotas_prestamos_local_deudor2','$otros_gastos_operativos_deudor1','$otros_gastos_operativos_deudor2','$gastos_familiares_titular','$arriendo_titular','$cuotasTDC_titular','$cuotas_creditos_entidades_titular','$cuotas_creditos_bcs_titular','$otros_egresos_titular','$gastos_familiares_deudor1','$gastos_familiares_deudor2','$arriendo_deudor1','$arriendo_deudor2','$cuotasTDC_deudor1','$cuotasTDC_deudor2','$cuotas_creditos_entidades_deudor1','$cuotas_creditos_entidades_deudor2','$cuotas_creditos_bcs_deudor1','$cuotas_creditos_bcs_deudor2','$otros_egresos_deudor1','$otros_egresos_deudor2','$total_costos_titular','$total_costos_deudor1','$total_costos_deudor2', " . $_COOKIE['id'] . ")
                  ON DUPLICATE KEY UPDATE costo_operacion_titular = '$costo_operacion_titular', empleados_titular = '$empleados_titular', arriendo_local_titular = '$arriendo_local_titular', cuotas_prestamos_local_titular = '$cuotas_prestamos_local_titular', otros_gastos_operativos_titular = '$otros_gastos_operativos_titular', costo_operacion_deudor1 = '$costo_operacion_deudor1', costo_operacion_deudor2 = '$costo_operacion_deudor2', empleados_deudor1 = '$empleados_deudor1', empleados_deudor2 = '$empleados_deudor2', arriendo_local_deudor1 = '$arriendo_local_deudor1', arriendo_local_deudor2 = '$arriendo_local_deudor2', cuotas_prestamos_local_deudor1 = '$cuotas_prestamos_local_deudor1', cuotas_prestamos_local_deudor2 = '$cuotas_prestamos_local_deudor2', otros_gastos_operativos_deudor1 = '$otros_gastos_operativos_deudor1', otros_gastos_operativos_deudor2 = '$otros_gastos_operativos_deudor2', gastos_familiares_titular = '$gastos_familiares_titular', arriendo_titular = '$arriendo_titular', cuotasTDC_titular = '$cuotasTDC_titular', cuotas_creditos_entidades_titular = '$cuotas_creditos_entidades_titular', cuotas_creditos_bcs_titular = '$cuotas_creditos_bcs_titular', otros_egresos_titular = '$otros_egresos_titular', gastos_familiares_deudor1 = '$gastos_familiares_deudor1', gastos_familiares_deudor2 = '$gastos_familiares_deudor2', arriendo_deudor1 = '$arriendo_deudor1', arriendo_deudor2 = '$arriendo_deudor2', cuotasTDC_deudor1 = '$cuotasTDC_deudor1', cuotasTDC_deudor2 = '$cuotasTDC_deudor2', cuotas_creditos_entidades_deudor1 = '$cuotas_creditos_entidades_deudor1', cuotas_creditos_entidades_deudor2 = '$cuotas_creditos_entidades_deudor2', cuotas_creditos_bcs_deudor1 = '$cuotas_creditos_bcs_deudor1', cuotas_creditos_bcs_deudor2 = '$cuotas_creditos_bcs_deudor2', otros_egresos_deudor1 = '$otros_egresos_deudor1', otros_egresos_deudor2 = '$otros_egresos_deudor2', total_costos_titular = '$total_costos_titular', total_costos_deudor1 = '$total_costos_deudor1', total_costos_deudor2 = '$total_costos_deudor2';";

        return $query;
    }

    private function insertEndeudamiento($datos)
    {

        $entidad_financiera = $datos['entidad'];
        $num_obligacion    = $datos['num_obligacion'];
        $valor_cuota = $datos['valor_cuota'];
        $saldo_total = $datos['saldo_total'];
        $estado    = $datos['estado'];
        $responsable_pago = $datos['responsable'];
        $observaciones = $datos['observaciones'];

        $query = "INSERT INTO endeudamiento (entidad_financiera,num_obligacion,valor_cuota,saldo_total,estado,responsable_pago,observaciones,id_cliente)
        VALUES ('$entidad_financiera', '$num_obligacion', '$valor_cuota', '$saldo_total', '$estado', '$responsable_pago', '$observaciones', " . $_COOKIE['id'] . ")
        ON DUPLICATE KEY UPDATE entidad_financiera = '$entidad_financiera', num_obligacion = '$num_obligacion', valor_cuota = '$valor_cuota', saldo_total = '$saldo_total', estado = '$estado', responsable_pago = '$responsable_pago', observaciones = '$observaciones';";

        return $query;
    }

    private function balanceResponsables($datos)
    {
        //Balance
        $activos_corrientes = $datos['activos_corrientes'];
        $activos_fijos = $datos['activos_fijos'];
        $otros_activos = $datos['otros_activos'];
        $total_activos = $activos_corrientes + $activos_fijos + $otros_activos;
        $fecha_balance = $datos['fecha_balance'];

        //Responsable
        $nombre_promotor = $datos['nombre_promotor'];
        $num_identificacion = $datos['numero_identificacion'];
        $usuario = $datos['usuario'];
        $nombre_agencia = $datos['nombre_agencia'];

        $query = "INSERT INTO balance (activos_corrientes,activos_fijos,otros_activos,total_activos,fecha_balance,id_cliente)
                  VALUES ('$activos_corrientes','$activos_fijos','$otros_activos','$total_activos','$fecha_balance', " . $_COOKIE['id'] . ")
                  ON DUPLICATE KEY UPDATE activos_corrientes = '$activos_corrientes', activos_fijos = '$activos_fijos', otros_activos = '$otros_activos', total_activos = '$total_activos', fecha_balance = '$fecha_balance';

                  INSERT INTO responsables(nombre_promotor,num_identificacion,usuario,nombre_agencia,id_cliente)
                  VALUES ('$nombre_promotor','$num_identificacion','$usuario','$nombre_agencia', " . $_COOKIE['id'] . ")
                  ON DUPLICATE KEY UPDATE nombre_promotor = '$nombre_promotor', num_identificacion = '$num_identificacion', usuario = '$usuario', nombre_agencia = '$nombre_agencia';";

        return $query;
    }

    private function selectSolicitante($datos)
    {
        $query = "SELECT * FROM solicitante s, referencias r, solicitud so WHERE s.numero_identificacion = '" . $datos['cedula'] . "' AND r.id_cliente = '" . $datos['cedula'] . "' AND so.id_cliente = '" . $datos['cedula'] . "' ";
        $conexionBCS = new conexion_bcs();
        $resultado = $conexionBCS->select_bcs($query);
        return $resultado;
    }

    private function selectConyugueUbicacionResponsables($datos)
    {
        $query = "SELECT * FROM conyugue c, ubicacion u, responsables r WHERE c.id_cliente = '" . $datos['cedula'] . "' AND u.id_cliente = '" . $datos['cedula'] . "' AND r.id_cliente = '" . $datos['cedula'] . "';";
        $conexionBCS = new conexion_bcs();
        $resultado = $conexionBCS->select_bcs($query);
        return $resultado;
    }

    private function selectDetalleEconomico($datos)
    {
        $query = "SELECT * FROM balance b, egresos e, ingresos i, ocupacion_principal op WHERE b.id_cliente = '" . $datos['cedula'] . "' AND e.id_cliente = '" . $datos['cedula'] . "' AND i.id_cliente = '" . $datos['cedula'] . "' AND op.id_cliente = '" . $datos['cedula'] . "';";
        $conexionBCS = new conexion_bcs();
        $resultado = $conexionBCS->select_bcs($query);
        return $resultado;
    }

    private function selectEndeudamiento($datos)
    {
        $query = "SELECT * FROM endeudamiento WHERE id_cliente = '" . $datos['cedula'] . "';";
        $conexionBCS = new conexion_bcs();
        $resultado = $conexionBCS->select_bcs($query);
        return $resultado;
    }

    /**
     * Función que consulta la data para poder general el PDF de reestructuración
     * @param type $datos
     * @return type $array resultado
     */

    public function generarPDFReestructuracion($datos)
    {
        $resultado['solicitante'] = $this->selectSolicitante($datos);
        $resultado['detalle_solicitante'] = $this->selectConyugueUbicacionResponsables($datos);
        $resultado['detalle_economico'] = $this->selectDetalleEconomico($datos);
        $resultado['endeudamiento'] = $this->selectEndeudamiento($datos);
        return $resultado;
    }

    /**
     * Función que consulta el listado de errores para crear el panel de soporte
     * @param type $datos
     * @return type $string resultado
     */
    public function panelSoporte()
    {
        $query = "SELECT * FROM errores;";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * Función que se encarga de consultar los parametros esperados por la estructura del panel de asignación
     * @param type $datos
     * @return type $string resultado
     */
    public function panelAsignacionMora()
    {
        $id_usuarios = $this->buscarIdAsesores();
        $borrar = $this->borrarAsignacion();
        $resultado['asesores'] = $this->buscarAsesores($id_usuarios);
        $resultado['edades_mora'] = $this->edadesMora();
        return $resultado;
    }

    /**
     * Función que consulta la identificacion de los usuarios con rol asesor
     * @param type $datos
     * @return type $string resultado
     */
    public function buscarIdAsesores()
    {
        $query = "SELECT id_usuario FROM roles_usuarios WHERE id_rol = 4 AND id_cliente = 13;";
        $resultado = "";
        $ids = $this->row($query);

        foreach ($ids as $id_usuario) {
            $resultado = $resultado . $id_usuario['id_usuario'] . ",";
        }
        return $resultado;
    }

    /**
     * Función que consulta toda la información de los usuarios por medio del id obtenido en el parametro
     * @param type $datos
     * @return type $string resultado
     */
    public function buscarAsesores($datos)
    {
        $query = "SELECT * FROM usuarios WHERE id_usuario IN(" . substr($datos, 0, -1) . ");";
        $resultado = $this->row($query);
        return $resultado;
    }
    /**
     * Función que se encarga de buscar la edad de mora asignada al usuario
     * @param type $datos
     * @return type $string resultado
     */
    public function buscarAsignacionMora($datos)
    {
        $query = "SELECT * FROM asesores_edad_mora WHERE id_usuario = " . $datos['id'] . " ORDER BY id_usuario ASC;";
        $resultado['asignacion'] = $this->row($query);
        $id_usuarios = $this->buscarIdAsesores();
        $borrar = $this->borrarAsignacion();
        $resultado['asesores'] = $this->buscarAsesores($id_usuarios);
        $resultado['edades_mora'] = $this->edadesMora();
        return $resultado;
    }
    /**
     * Función que obtiene las edades de mora existentes
     * @param type $datos
     * @return type $string resultado
     */
    public function edadesMora()
    {
        $query = "SELECT * FROM edades_mora;";
        $resultado = $this->row($query);
        return $resultado;
    }
    /**
     * Función utilizada para realizar la asignación de la edad de mora al asesor
     * @param type $datos
     * @return type $string resultado
     */
    public function asignarEdadMora($datos)
    {
        $query = "INSERT INTO asesores_edad_mora (id_usuario, id_edad_mora, id_cliente, estado)
        VALUES (" . $datos['id_usuario'] . ", " . $datos['id_edad'] . ", " . $datos['cartera'] . ", 1)
        ON DUPLICATE KEY UPDATE estado = 0;";
        $borrar = $this->panelAsignacionMora();
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }
    /**
     * Función que elimina la asignación que no esté activa
     * @param type $datos
     * @return type $string resultado
     */
    public function borrarAsignacion()
    {
        $query = "DELETE FROM asesores_edad_mora WHERE estado = 0;";
        $resultado = $this->ejecutar($query);
    }
    /**
     * Función que consulta el vinculo entre el asesor y la edad de mora
     * @param type $datos
     * @return type $string resultado
     */
    public function buscarAsignacionUsuarioActual()
    {
        $query = "SELECT edad FROM asesores_edad_mora ae, edades_mora em WHERE id_usuario = " . $_SESSION['id_usuario'] . " AND ae.id_edad_mora = em.id ORDER BY id_usuario ASC";
        $resultado = "";
        $edades = $this->row($query);
        foreach ($edades as $edad) {
            $resultado = $resultado . "'" . $edad['edad'] . "',";
        }
        return $resultado;
    }

    public function panelChat()
    {
        $resultado['grupos'] = $this->obtenerGrupos();
        $resultado['usuarios'] = $this->obtenerUsuarios();
        $resultado['recientes'] = $this->recientes();

        return $resultado;
    }

    public function obtenerChats($datos)
    {
        $receptor = explode(",", $datos['receptor']);
        switch ($receptor[0]):
            case $receptor[0] < 20:
                $query = "SELECT * FROM chatfianza WHERE id_receptor = '$datos[receptor]' OR id_emisor = '$datos[receptor]' AND id_receptor < 50 ORDER BY id ASC";
                $agrupados = "SELECT * FROM chatfianza WHERE id_receptor = '$datos[receptor]' AND id_receptor < 50 and visto = 0 group by id_emisor ORDER BY id DESC";
                break;
            default:
                $query = "SELECT * FROM chatfianza WHERE id_receptor = '$datos[receptor]' OR id_emisor = '$datos[receptor]' AND id_receptor > 50 ORDER BY id ASC";
                $agrupados = "SELECT * FROM chatfianza WHERE id_receptor = '$datos[receptor]' AND  id_receptor > 50 group by id_emisor ORDER BY id DESC";
                break;
        endswitch;
        $resultado['mensajes'] = $this->row($query);
        $resultado['agrupados'] = $this->row($agrupados);
        return $resultado;
    }

    public function notificacionChats($datos)
    {
        $query = "SELECT count(*) as alerta FROM `chatfianza` WHERE id_receptor = '$_SESSION[id_usuario],$_SESSION[usuario]' and visto = 0 ";
        $resultado = $this->row($query);
        return $resultado;
    }

    public function obtenerGrupos()
    {
        $query = "SELECT * FROM clientes where estado = 1;";
        $resultado = $this->row($query);
        return $resultado;
    }

    public function recientes()
    {
        $query = "SELECT u.usuario, cf.* FROM usuarios u, chatfianza cf where cf.id_emisor = CONCAT(u.id_usuario,',',u.usuario) and cf.id_receptor > 20 and cf.visto = 0 GROUP by cf.id_receptor ORDER BY cf.id DESC;";
        $resultado = $this->row($query);
        return $resultado;
    }

    public function obtenerUsuarios()
    {
        $query = "SELECT * FROM usuarios ORDER BY usuario asc ;";
        $resultado = $this->row($query);
        return $resultado;
    }

    public function buscarChats($datos)
    {
        $query = "SELECT id_usuario, usuario FROM usuarios WHERE usuario LIKE '%" . $datos['valorBusqueda'] . "%'";
        $resultado['usuarios'] = $this->row($query);
        return $resultado;
    }

    public function marcarVisto($datos)
    {
        if (isset($datos['actual'])) :
            $query = "UPDATE chatfianza SET visto = 1, fecha_visto = NOW() WHERE id_emisor = '$datos[receptor]' and id_receptor = '$datos[actual]'";
            $this->ejecutar2(($query));
        endif;
    }

    public function submitMensaje($datos)
    {
        $archivo = ($datos['archivo'] != '') ? ';' . $datos['archivo'] : '';
        $query = "INSERT INTO chatfianza (id_emisor, mensaje, id_receptor, fecha)
                  VALUES ('" . $_SESSION['id_usuario'] . "," . $_SESSION['usuario'] . "', '" . $datos['mensaje'] . $archivo . "', '" . $datos['receptor'] . "', NOW())";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

}

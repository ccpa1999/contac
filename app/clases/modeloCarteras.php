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
    private $consultas;

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

    /**********************************************************************MODULOS*********************************************************************************************/

    private function paginaInicio($datos)
    {
        $datos['tipo'] = 'inicio';
        $modulo = $this->informacionModuloGestion($datos);
        return $modulo;
    }

    private function informacionModuloGestion($datos)
    {
        $datos['datoBusqueda'] = (isset($datos['datoBusqueda']) && $datos['datoBusqueda'] !== '') ? $datos['datoBusqueda'] : '';
        $datos['tipo'] = (isset($datos['tipo']) && $datos['tipo'] !== '') ? $datos['tipo'] : '';

        $resultado['cliente'] = $this->obtenerInformacionClientesParametro($datos['cartera'], $datos['datoBusqueda'], $datos['tipo']);
        $resultado['cartera'] = $this->obtenerInformacionCartera($datos['cartera']);

        if (isset($resultado['cliente']['cliente'][0]['cedula'])) {
            $resultado['gestion'] = $this->obtenerInformacionGestion($datos['cartera']);
            $resultado['historial'] = $this->obtenerInformacionHistoricoGestion($resultado['cliente']['cliente'][0]['cedula'], $datos['cartera']);
        }

        return $resultado;
    }

    private function obtenerModulo($datos)
    {
        $tipo = $datos['tipo'];
        $data = $this->$tipo($datos);
        return $data;
    }

    private function moduloCalendario()
    {
        $resultado = [];

        $resultado['usuarios'] = $this->obtenerUsuariosCartera(["rol" => ucwords("Asesor")]);
        $resultado['eventos'] = $this->consultarAgendamiento(['metodo' => "obtenerCalendario"]);

        return $resultado;
    }

    private function obtenerCalendario($datos)
    {
        $eventos = $this->consultarAgendamiento($datos);

        for ($contador = 0; $contador < count($eventos); $contador++) {

            $fechaInicio = explode(" ", $eventos[$contador]['start']);
            $fechaFin = explode(" ", $eventos[$contador]['end']);

            $eventos[$contador]['start'] = $fechaInicio[0] . "T" . $fechaInicio[1];
            $eventos[$contador]['end'] = $fechaFin[0] . "T" . $fechaFin[1];
        }

        return $eventos;
    }

    private function moduloScoring($datos)
    {
        $resultado['usuarios'] = $this->obtenerUsuariosCartera(['rol' => 'Asesor']);
        $resultado['scoring'] = $this->obtenerScoring([]);
        return $resultado;
    }

    private function moduloRanking($datos)
    {
        $resultado['usuarios'] = $this->obtenerUsuariosCartera(['rol' => 'Asesor']);
        $resultado['ranking'] = $this->obtenerRanking([]);
        return $resultado;
    }

    private function obtenerEfectividades($datos)
    {
        $result = [];
        $cliente = $this->obtenerInformacionCartera($_SESSION['carteraActual'])[0]['nombre'];
        $datos['fecha_inicial'] = (isset($datos['fecha_inicial'])) ? $datos['fecha_inicial'] : date('Y-m-') . '01';
        $datos['fecha_final'] = (isset($datos['fecha_final'])) ? $datos['fecha_final'] : date('Y-m-') . '31';
        $datos['gestor'] = (isset($datos['gestor']) && $datos['gestor'] != '') ? "AND h.gestor = '$datos[gestor]'" : '';
        extract($datos);
        $query = "SELECT h.fecha_gestion, h.gestor, e.homologado, e.efectividad FROM historico_gestion h 
                INNER JOIN homologado_efecto e ON h.efecto = e.id 
                WHERE h.cliente_id = '" . $_SESSION['carteraActual'] . "' 
                AND h.fecha_gestion BETWEEN '" . $fecha_inicial . " 00:00:00' AND '" . $fecha_final . " 23:59:59' $gestor;";
        $efectividades = $this->row($query);
        $meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        $total = count($efectividades);
        foreach ($efectividades as $efectividad) {
            $mes = explode('-', $efectividad['fecha_gestion'])[1] - 1;
            $result[$meses[$mes]][$efectividad['gestor']]['TOTAL'] += 1;
            $result[$meses[$mes]][$efectividad['gestor']]['EXITOSO'] += ($efectividad['efectividad'] == 2) ? 1 : 0;
            $result[$meses[$mes]][$cliente]['TOTAL'] = $total;
            $result[$meses[$mes]][$cliente]['EXITOSO'] += ($efectividad['efectividad'] == 2) ? 1 : 0;
        }
        return $result;
    }

    private function obtenerScoring($datos)
    {
        $result = $this->obtenerEfectividades($datos);
        $cliente = $this->obtenerInformacionCartera($_SESSION['carteraActual'])[0]['nombre'];
        foreach ($result as $mes => $data) {
            foreach ($data as $usuario => $totales) {
                if ($usuario !== $cliente) {
                    $porcentajes['usuarios'][] = ($totales['EXITOSO'] / $totales['TOTAL']) * 100;
                    $resultado['usuarios'][$mes][$usuario] = number_format(($totales['EXITOSO'] / $totales['TOTAL']) * 5, 3);
                } else {
                    $total = $totales['TOTAL'];
                    $porcentajes['cliente'] = ($totales['EXITOSO'] / $totales['TOTAL']) * 100;
                }
            }
            $resultado['cartera']['labels'][0] = $cliente;
            $resultado['cartera'][$mes][] = (max($porcentajes['usuarios']) > 0) ? number_format(($porcentajes['cliente'] / max($porcentajes['usuarios'])) * 5, 3) : 0;
        }
        $resultado['total'] = $total;
        $resultado['resultado'] = "grafica";
        return $resultado;
    }

    private function obtenerRanking($datos)
    {
        $result = $this->obtenerEfectividades($datos);
        $cliente = $this->obtenerInformacionCartera($_SESSION['carteraActual'])[0]['nombre'];
        $exitoso = 0;
        foreach ($result as $mes => $data) {
            foreach ($data as $usuario => $totales) {
                if ($usuario !== $cliente) {
                    $porcentajes['usuarios'][] = ($totales['EXITOSO'] / $totales['TOTAL']) * 100;
                    $resultado['usuarios'][$mes][$usuario] = number_format(($totales['EXITOSO'] / $totales['TOTAL']) * 100, 3);
                } else {
                    $total = $totales['TOTAL'];
                    $exitoso += $totales['EXITOSO'];
                    $porcentajes['cliente'] = ($totales['EXITOSO'] / $totales['TOTAL']) * 100;
                }
            }
            $resultado['cartera']['labels'][0] = $cliente;
            $resultado['cartera'][$mes][] = (max($porcentajes['usuarios']) > 0) ? number_format(($porcentajes['cliente'] / max($porcentajes['usuarios'])) * 100, 3) : 0;
        }
        $resultado['total'] = $total;
        $resultado['exitoso'] = $exitoso;
        $resultado['totales'] = $result;
        $resultado['resultado'] = "grafica";
        return $resultado;
    }

    private function administracionTareas($datos)
    {
        $query = "SELECT id, nombre_tarea, tipo_tarea FROM tareas WHERE cartera = '" . $_SESSION['carteraActual'] . "'";
        $resultado['tareas'] = $this->row($query);

        return $resultado;
    }

    private function administracionArbol($datos)
    {
        $resultado = array();

        $query = "SELECT id, homologado FROM homologado_accion WHERE id_cliente = '" . $_SESSION['carteraActual'] . "' AND estado = '1' ORDER BY homologado ASC";
        $result['acciones'] = $this->row($query);

        $query = "SELECT id, homologado FROM homologado_contacto WHERE id_cliente = '" . $_SESSION['carteraActual'] . "' AND estado = '1' ORDER BY homologado ASC";
        $result['contactos'] = $this->row($query);

        $query = "SELECT id, homologado FROM homologado_efecto WHERE id_cliente = '" . $_SESSION['carteraActual'] . "' AND estado = '1' ORDER BY homologado ASC";
        $result['efectos'] = $this->row($query);

        $query = "SELECT id, motivo FROM motivos_no_pago WHERE id_cliente = '" . $_SESSION['carteraActual'] . "' AND estado = '1' ORDER BY motivo ASC";
        $result['motivo'] = $this->row($query);

        $resultado['arbol'] = $result;

        return $resultado;
    }

    private function administracionCartera($datos)
    {
        $return = array();
        $query = "SELECT id, accion FROM accion WHERE estado = '1' ORDER BY accion";
        $resultado = $this->row($query);
        $return['accion'] = $resultado;

        $query = "SELECT id, contacto FROM contacto WHERE estado = '1' ORDER BY contacto";
        $resultado = $this->row($query);
        $return['contacto'] = $resultado;

        $query = "SELECT id, efecto FROM efecto WHERE estado = '1' ORDER BY efecto";
        $resultado = $this->row($query);
        $return['efecto'] = $resultado;

        $query = "SELECT id, id_accion, homologado FROM homologado_accion WHERE estado = '1' AND id_cliente = '" . $_SESSION['carteraActual'] . "' ORDER BY homologado asc";
        $resultado = $this->row($query);
        $return['homologado_accion'] = $resultado;

        $query = "SELECT id, id_contacto, homologado FROM homologado_contacto WHERE estado = '1' AND id_cliente = '" . $_SESSION['carteraActual'] . "' ORDER BY homologado asc";
        $resultado = $this->row($query);
        $return['homologado_contacto'] = $resultado;

        $query = "SELECT id, id_efecto, homologado FROM homologado_efecto WHERE estado = '1' AND id_cliente = '" . $_SESSION['carteraActual'] . "' ORDER BY homologado asc";
        $resultado = $this->row($query);
        $return['homologado_efecto'] = $resultado;

        $query = "SELECT id, motivo FROM motivos_no_pago WHERE estado = '1' AND id_cliente = '" . $_SESSION['carteraActual'] . "' ORDER BY motivo asc";
        $resultado = $this->row($query);
        $return['motivos_no_pago'] = $resultado;

        $query = "SELECT * FROM opciones_informacion WHERE id_cliente = '" . $_SESSION['carteraActual'] . "'";
        $return['opciones'] = $this->row($query);

        $return['inputs_gestion'] = $this->obtenerInputsGestion($_SESSION['carteraActual']);

        $return['inputs_opciones'] = $this->obtenerOpcionesInputGestion($return['inputs_gestion']);
        $query = "SELECT * FROM label_informacion WHERE id_cliente = '" . $_SESSION['carteraActual'] . "'";
        $return['label_informacion'] = $this->row($query);

        return $return;
    }

    private function exportarDeudorDemografico($datos)
    {
        $cedula = explode(',', $datos['cedula']);

        $cedula = "'" . implode("','", $cedula) . "'";

        $query = "SELECT cedula_deudor, telefono FROM telefonos WHERE cedula_deudor in($cedula)";
        $resultado['telefonos'] = $this->row($query);

        $query = "SELECT ciudad, direccion FROM direcciones WHERE cedula_deudor in($cedula)";
        $resultado['direcciones'] = $this->row($query);

        $query = "SELECT correo FROM correos WHERE cedula_deudor in($cedula)";
        $resultado['correos'] = $this->row($query);

        return $resultado;
    }

    /**********************************************************************CARGAS*********************************************************************************************/

    private function cargarArchivo($datos)
    {
        $tipo = $datos['tipo'];
        $mensaje = $this->$tipo($datos);
        return $mensaje;
    }

    private function cargarAsignacion($datos)
    {
        $vigencia_asignacion = $datos['vigencia_asignacion'];
        $ruta = '../../public/archivos/cargas/asignacion_' . $_SESSION['carteraActual'] . '.csv';
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

        $handle = fopen($ruta, "r");
        // $resultado = array();
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
            VALUES (   '$datos[0]', $_SESSION[carteraActual], '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]',"
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

        $query .= "UPDATE obligaciones SET estado = '0' WHERE cartera = '$_SESSION[carteraActual]' "
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
        $this->ejecutar3($query);

        $return = array('resultado' => 'ok', 'mensaje' => 'La asignación fue importada con exito');
        return $return;
    }

    // private function cargarPagos($datos)
    // {
    //     $ruta = '../../public/archivos/cargas/pagos-' . $_SESSION['carteraActual'] . '.csv';
    //     $handle = fopen($ruta, "r");
    //     $resultado = array();
    //     $i = 0;
    //     $yesInsert = 0;
    //     $notInsert = 0;
    //     $query = "";

    //     $query .= 'CREATE TEMPORARY TABLE `tmp`(
    //                 `campo1` varchar(200) DEFAULT NULL,
    //                 `campo2` varchar(200) DEFAULT NULL,
    //                 `campo3` varchar(200) DEFAULT NULL,
    // 				`campo4` varchar(200) DEFAULT NULL,
    // 				`campo5` varchar(200) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

    //     while (($datos = fgetcsv($handle, 1000, ";")) !== FALSE) {
    //         $array = explode("/", $datos[2]);
    //         $fecha_pago = $array[2] . "-" . $array[1] . "-" . $array[0];

    //         $query1 = 'SELECT * FROM obligaciones WHERE numero_obligacion = "' . trim($datos[0]) . '" AND cartera = "' . $cartera . '"';
    //         $numObligacion = $this->row($query1);

    //         if ($numObligacion[0]['numero_obligacion'] == trim($datos[0])) {
    //             $query .= "
    //             INSERT INTO tmp (campo1, campo2, campo3, campo4)
    //             VALUES ('" . trim($datos[0]) . "', '" . trim($datos[1]) . "', '" . $fecha_pago . "', '" . $cartera . "'); ";
    //             $yesInsert += 1;
    //         } else {
    //             $notInsert += 1;
    //         }

    //         $i++;
    //     }

    //     fclose($handle);

    //     $query .= "INSERT IGNORE INTO pagos (obligacion, valor_pago, fecha_pago, cliente_pago)
    //                SELECT campo1, campo2, campo3, campo4 FROM tmp";

    //     $resultado = $this->ejecutar3($query);
    //     if ($notInsert > 1 && $yesInsert == 0) {
    //         $return['resultado'] = 'fallo';
    //     } elseif ($notInsert == 0) {
    //         $return['resultado'] = 'ok';
    //         $return['mensaje'] = '¡El archivo fue cargado de forma exitosa!<br> Se cargaron ' . $yesInsert . '.';
    //     } else {
    //         $return['resultado'] = 'ok';
    //         $return['mensaje'] = '¡El archivo no fue cargado completamente!<br> Se cargaron ' . $yesInsert . ' & ' . $notInsert . ' No fueron cargados.';
    //     }

    //     return json_encode($return);
    // }

    private function cargarTarea($datos)
    {
        extract($datos);
        $ruta = '../../public/archivos/cargas/tarea' . $_SESSION['carteraActual'] . '.csv';
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

        $return = array('mensaje' => '', 'resultado' => '');
        $cont = 0;
        $handle = fopen($ruta, "r");
        $resultado = array();
        $i = 0;

        $query = "INSERT INTO tareas(nombre_tarea, cartera, tipo_tarea)
                      VALUES('" . $nombre_tarea . "', '$_SESSION[carteraActual]', '" . $tipo_tarea . "')";
        $id = $this->obtenerId($query);

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            switch ($datos['tipo_tarea']) {
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
                . "VALUES ('$id', '$identificacion', '$asesor', '" . $tipo_tarea . "',"
                . " '$_SESSION[carteraActual]', '0', $orden) ON DUPLICATE KEY UPDATE gestionado = '0', orden = $orden";
            $temp = $this->ejecutar2($query);
            $cont = ($temp >= 1) ? ($cont + $temp) : $cont;
            $i++;
        }
        fclose($handle);
        $return = array('resultado' => 'ok', 'mensaje' => 'Se insertaron ' . $cont . ' registros en Tareas');
        return $return;
    }

    private function cargarDemografico($datos)
    {
        $ruta = '../../public/archivos/cargas/demograficos' . $_SESSION['carteraActual'] . '.csv';
        if ((stristr(file_get_contents($ruta), '"') != false)
            || (stristr(file_get_contents($ruta), "'") != false)
            || (stristr(file_get_contents($ruta), '$') != false)
            || (stristr(file_get_contents($ruta), ',') != false)
            || (stristr(file_get_contents($ruta), '  ') != false)
            || (stristr(file_get_contents($ruta), '/\;') != false)
            || (stristr(file_get_contents($ruta), '\;') != false)
        ) {
            file_put_contents($ruta, str_replace(['"', "'", '$', '  ', '\;'], '', file_get_contents($ruta)));
            file_put_contents($ruta, str_replace(',', '.', file_get_contents($ruta)));
            file_put_contents($ruta, str_replace('/\;', ';', file_get_contents($ruta)));
        }
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

        $return = array('mensaje' => '', 'resultado' => '');
        $cont = 0;
        $handle = fopen($ruta, "r");
        $resultado = array();
        $i = 0;

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            switch ($datos['tipo_demografico']) {
                case 'telefonos':
                    $columnas = 'tipo_telefono, telefono, hora_disponibilidad';
                    $valores = "'$data[1]', '$data[2]', '$data[3]'";
                    break;
                case 'direcciones':
                    $columnas = 'tipo_direccion, ciudad, direccion';
                    $valores = "'$data[1]', '$data[2]', '$data[3]'";
                    break;
                case 'correos':
                    $columnas = 'tipo_correo, correo';
                    $valores = "'$data[1]', '$data[2]'";
                    break;
            }
            $query = "INSERT INTO $datos[tipo_demografico] (cedula_deudor, $columnas, estado)"
                . "VALUES ('$data[0]', $valores, 1) ON DUPLICATE KEY UPDATE estado = '1';";
            $temp = $this->ejecutar2($query);
            $cont = ($temp >= 1) ? ($cont + $temp) : $cont;
            $i++;
        }
        fclose($handle);
        $return = array('resultado' => 'ok', 'mensaje' => 'Se insertaron los ' . $datos['tipo_demografico']);
        return $return;
    }

    private function cargarAgendamientos($datos)
    {
        $ruta = '../../public/archivos/cargas/agendamiento' . $_SESSION['carteraActual'] . '.csv';
        $mover = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        if ((stristr(file_get_contents($ruta), '"') != false)
            || (stristr(file_get_contents($ruta), "'") != false)
        ) {
            file_put_contents($ruta, str_replace(['"', "'"], '', file_get_contents($ruta)));
        }

        $return = array('mensaje' => '', 'resultado' => '');
        $handle = fopen($ruta, "r");

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $query = "INSERT INTO agendamiento (usuario,cliente_id,tipo,titulo,inicio_evento,fin_evento)
            VALUES ('$data[0]', $_SESSION[carteraActual], '$data[1]', '$data[2]', '$data[3]', '$data[4]');";
            $apicon = new apicon();
            $apicon->multiquery($query);
        }
        fclose($handle);
        $return = array('resultado' => 'ok', 'mensaje' => 'Se insertaron correctamente');
        return $return;
    }

    /*********************************************************************DESCARGAS*********************************************************************************************/

    private function generarInforme($datos)
    {
        switch ($datos['informe']) {
            case 'gestion':
                $resultado = $this->informeGestion($datos);
                break;
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
            case 'facturas':
                $resultado = $this->informesFacturas($datos);
                break;
            case 'formatos':
                $resultado = $this->informesFormatos($datos);
                break;
            case 'no_contac':
                $resultado = $this->informesNo_contac($datos);
                break;
            case 'normalizacion':
                $resultado = $this->informesNormalizacion($datos);
                break;
            case 'condonaciones':
                $resultado = $this->informesCondonaciones($datos);
                break;
            case 'ajustes':
                $resultado = $this->informesAjustes($datos);
                break;
            case 'pagare':
                $resultado = $this->informesPagare($datos);
                break;
            case 'reprogramados':
                $resultado = $this->informesReprogramados($datos);
                break;
            case 'ROM':
                $resultado = $this->informesROM($datos);
                break;
            case 'gestion_whatsapp':
                $resultado = $this->informesGestion_whatsapp($datos);
                break;
            case 'novedades':
                $resultado = $this->informe_novedades($datos);
                break;
        }

        $retorno['resultado'] = 'ok';
        $retorno['mensaje'] = "Se ha generado correctamente.";
        return $retorno;
    }

    private function informeGestion($datos)
    {
        $query = "SELECT * FROM historico_gestion WHERE fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' 
        AND cliente_id = '" . $datos['cartera'] . "' ORDER BY gestor, fecha_gestion ASC;";

        $resultado = $this->row($query);
        foreach ($resultado as $key => $historico) {
            $query = "SELECT homologado FROM homologado_accion where id = '" . $historico['accion'] . "';";
            $resultado[$key]['accion'] = $this->row($query)[0]['homologado'];
            $query = "SELECT homologado FROM homologado_contacto where id = '" . $historico['contacto'] . "';";
            $resultado[$key]['contacto'] = $this->row($query)[0]['homologado'];
            $query = "SELECT homologado FROM homologado_efecto where id = '" . $historico['efecto'] . "';";
            $resultado[$key]['efecto'] = $this->row($query)[0]['homologado'];
        }

        if ($datos['cartera'] == 19 || $datos['cartera'] == 15) {
            $tipo = 'Solicitud';
        } else {
            $tipo = 'Producto Nuevo';
        }
        $cabeceras = array(
            'Identificacion', 'Obligacion', 'Fecha Gestion',
            'Accion', 'Efecto', 'Contacto', 'Motivo No Pago',
            'Actividad Economica', 'Fecha Promesa', 'Valor', 'Tipo Acuerdo',
            'Telefono', 'Seguimiento', 'Observaciones', 'Gestor', $tipo, 'Moto', 'salarios_rango',
            'Hora inicio Gestion', 'Hora Fin Gestion', 'Tiempo Gestion', 'Tiempo entre llamadas'
        );
        if ($datos['cartera'] != 9) {
            unset($cabeceras[16]);
            unset($cabeceras[17]);
        }

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
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
            $array['accion'] = utf8_decode(utf8_encode($campos['accion']));
            $array['efecto'] = utf8_decode(utf8_encode($campos['efecto']));
            $array['contacto'] = utf8_decode(utf8_encode($campos['contacto']));
            $array['motivo_no_pago'] = utf8_decode(utf8_encode($campos['motivo_no_pago']));
            $array['actividad_economica'] = utf8_decode(utf8_encode($campos['actividad_economica']));
            $array['fecha_promesa'] = $campos['fecha_acuerdo'];
            $array['valor'] = $campos['valor_acuerdo'];
            $array['tipo_acuerdo'] = $campos['tipo_negociacion'];
            $array['telefono'] = $campos['telefono'];
            $array['seguimiento'] = $campos['fecha_seguimiento'];
            $array['observaciones'] = $campos['observaciones'];
            $array['gestor'] = $campos['gestor'];
            $array['producto_nuevo'] = $campos['producto_nuevo'];
            if ($datos['cartera'] == 9) {
                $array['moto'] = $campos['moto'];
                $array['salarios_rango'] = $campos['salarios_rango'];
            }
            $array['inicio_gestion'] = $horaInicio[1];
            $array['hora_gestion'] = $fechas[1];
            $intervaloLlamada = ($array['gestor'] != $gestorAnterior || $array['fecha_gestion'] != $fechaGestion) ? ($fechaUno) : $intervaloLlamada;
            $array['tiempo_gestion'] = ($fechaUno->diff($fechaDos))->format('%h:%i:%s ');
            $array['tiempo_entre_llamadas'] = ($intervaloLlamada->diff($fechaUno))->format('%h:%i:%s');


            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        return $resultado;
    }

    private function informeProductividad($datos)

    {

        $resultado = array();

        $array = array();

        $query = "SELECT gestor, count(DISTINCT cedula_deudor) as cliente FROM historico_gestion WHERE cliente_id = '" . $datos['cartera'] . "' AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP BY gestor;";
        $array['clientes'] = $this->row($query);

        $query = "SELECT gestor, COUNT(efecto) as promesa FROM `historico_gestion` WHERE efecto in(SELECT homologado FROM homologado_efecto where id_cliente = '" . $datos['cartera'] . "' 
                AND id_efecto in('108','137')) AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP by gestor;";
        $array['promesas'] = $this->row($query);

        $query = "SELECT gestor, COUNT(efecto) as posible FROM `historico_gestion` WHERE efecto in(SELECT homologado FROM homologado_efecto where id_cliente = '" . $datos['cartera'] . "'  
                AND id_efecto in('106')) AND fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' GROUP by gestor;";
        $array['posibles'] = $this->row($query);

        $query = "SELECT gestor, COUNT(contacto) as contacto FROM historico_gestion WHERE contacto in(SELECT homologado FROM homologado_contacto WHERE id_contacto = '4' AND id_cliente = '" . $datos['cartera'] . "') 
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

        return $resultado;
    }

    private function informeMejorGestion($datos)
    {
        $arr = array();
        $query = "SELECT * FROM historico_gestion WHERE fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' 
        AND cliente_id = '" . $datos['cartera'] . "' ORDER BY gestor, fecha_gestion ASC;";

        $resultado = $this->row($query);

        foreach ($resultado as $key => $historico) {
            $query = "SELECT homologado FROM homologado_accion where id = '" . $historico['accion'] . "';";
            $resultado[$key]['accion'] = $this->row($query)[0]['homologado'];
            $query = "SELECT homologado FROM homologado_contacto where id = '" . $historico['contacto'] . "';";
            $resultado[$key]['contacto'] = $this->row($query)[0]['homologado'];
            $query = "SELECT homologado FROM homologado_efecto where id = '" . $historico['efecto'] . "';";
            $resultado[$key]['efecto'] = $this->row($query)[0]['homologado'];
        }
        $cabeceras = array(
            'Identificacion', 'Obligacion', 'Fecha Gestion',
            'Hora Gestion', 'Accion', 'Efecto', 'Contacto', 'Motivo No Pago',
            'Actividad Economica', 'Fecha Promesa', 'Valor', 'Tipo Acuerdo',
            'Telefono', 'Seguimiento', 'Observaciones', 'Gestor'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $fechas = explode(' ', $campos['fecha_gestion']);
            $array['identificacion'] = $campos['cedula_deudor'];
            $array['obligacion'] = '_'. $campos['obligacion'];
            $array['fecha_gestion'] = $fechas[0];
            $array['hora_gestion'] = $fechas[1];
            $array['accion'] = utf8_decode(utf8_encode($campos['accion']));
            $array['efecto'] = utf8_decode(utf8_encode($campos['efecto']));
            $array['contacto'] = utf8_decode(utf8_encode($campos['contacto']));
            $array['motivo_no_pago'] = utf8_decode(utf8_encode($campos['motivo_no_pago']));
            $array['actividad_economica'] = utf8_decode(utf8_encode($campos['actividad_economica']));
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
        return $resultado;
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
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');

        foreach ($arr as $campos) {
            $array['usuario'] = $campos['usuario'];
            $array['tipo_pausa'] = $campos['tipo_pausa'];
            $array['tiempo_total'] = $campos['tiempo'];
            $array['fecha_pausa'] = $campos['fecha_pausa'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        return $resultado;
    }

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
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');

        foreach ($arr as $dato) {
            $array['usuario'] = $dato['usuario'];
            $array['tipo_pausa'] = $dato['tipo_pausa'];
            $array['tiempo_total'] = $dato['tiempo'];
            $array['fecha_pausa'] = $dato['fecha_pausa'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        return $resultado;
    }

    private function informeDemografico($datos)
    {
        $arr = array();

        $query = "SELECT cedula_deudor FROM historico_gestion WHERE fecha_gestion BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59'"
            . "AND cliente_id = '" . $datos['cartera'] . "' GROUP BY cedula_deudor";

        $deudores = $this->row($query);

        $resultado = $deudores;

        foreach ($deudores as $key => $deudor) {
            $query = "SELECT * FROM telefonos WHERE cedula_deudor = '" . $deudor['cedula_deudor'] . "'";
            $arr[$key]['telefono'] = $this->row($query);

            $query = "SELECT * FROM direcciones WHERE cedula_deudor = '" . $deudor['cedula_deudor'] . "'";
            $arr[$key]['direccion'] = $this->row($query);

            $query = "SELECT * FROM correos WHERE cedula_deudor = '" . $deudor['cedula_deudor'] . "'";
            $arr[$key]['correo'] = $this->row($query);
        }
        $this->informeTipoDemografico($datos, $arr, 'Telefono');
        $this->informeTipoDemografico($datos, $arr, 'Direccion');
        $this->informeTipoDemografico($datos, $arr, 'Correos');

        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informeTipoDemografico($datos, $data, $parametro)
    {

        switch ($parametro) {
            case 'Telefono':
                $cabeceras = array('Identificacion', 'Telefono', 'Tipo Telefono', 'Hora Disponibilidad', 'Estado');

                $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . '_Telefonos ' . date("Y-m-d") . '.csv', 'w');
                fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
                fputcsv($fp, $cabeceras, ';');

                foreach ($data as $datos) {
                    foreach ($datos['telefono'] as $telefono) {
                        $array['identificacion'] = $telefono['cedula_deudor'];
                        $array['telefono'] = $telefono['telefono'];
                        $array['tipo_telefono'] = utf8_decode(utf8_encode($telefono['tipo_telefono']));
                        $array['hora_disponibilidad'] = $telefono['hora_disponibilidad'];
                        $array['estado'] = ($telefono['estado'] == 1 ? 'Principal' : (($telefono['estado'] == 0) ? 'Ilocalizado' : 'Otro'));

                        fputcsv($fp, $array, ';');
                    }
                }
                fclose($fp);
                break;

            case 'Direccion':
                $cabeceras = array('Identificacion', 'Ciudad', 'Direccion', 'Tipo Direccion', 'Estado');

                $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . '_Direcciones ' . date("Y-m-d") . '.csv', 'w');
                fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
                fputcsv($fp, $cabeceras, ';');

                foreach ($data as $datos) {
                    foreach ($datos['direccion'] as $direccion) {
                        $array['identificacion'] = $direccion['cedula_deudor'];
                        $array['ciudad'] = utf8_decode(utf8_encode($direccion['ciudad']));
                        $array['direccion'] = utf8_decode(utf8_encode($direccion['direccion']));
                        $array['tipo_direccion'] = utf8_decode(utf8_encode($direccion['tipo_direccion']));
                        $array['estado'] = ($direccion['estado'] == 1 ? 'Activo' : 'Inactivo');

                        fputcsv($fp, $array, ';');
                    }
                }
                fclose($fp);
                break;

            case 'Correos':
                $cabeceras = array('Identificacion', 'Correo', 'Tipo Correo',  'Estado');

                $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . '_Correos ' . date("Y-m-d") . '.csv', 'w');
                fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
                fputcsv($fp, $cabeceras, ';');

                foreach ($data as $datos) {
                    foreach ($datos['correo'] as $correo) {
                        $array['identificacion'] = $correo['cedula_deudor'];
                        $array['correo'] = utf8_decode(utf8_encode($correo['correo']));
                        $array['tipo_correo'] = utf8_decode(utf8_encode($correo['tipo_correo']));
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

    private function informeSeguimientos($datos)
    {
        $query = "SELECT h.* FROM historico_gestion h
        WHERE h.fecha_gestion  BETWEEN '" . $datos['fecha_inicial'] . " 00:00:00' AND '" . $datos['fecha_final'] . " 23:59:59' 
        AND h.cliente_id = '" . $datos['cartera'] . "' AND fecha_seguimiento != '' ORDER BY gestor";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Identificacion', 'Obligacion', 'Fecha Gestion',
            'Seguimiento', 'Observaciones', 'Gestor'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
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

    private function informesFacturas($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'facturas';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha Solicitud', 'Identificación', 'Valor', 'Fecha de pago', 'Obligación', 'Correo/celular', 'Gestor', 'Fecha envío'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['valor_pago'];
            $array[3] = $campos['plazo_fecha_pago'];
            $array[4] = $campos['obligacion'];
            $array[5] = $campos['correo_cel'];
            $array[6] = $campos['gestor'];
            $array[7] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesFormatos($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'formatos';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', 'Normalizacion', 'Correo / Wp', 'Observaciones', 'Gestor', 'Fecha envío / coordinador'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['normalizacion'];
            $array[3] = $campos['correo_cel'];
            $array[4] = $campos['observaciones'];
            $array[5] = $campos['gestor'];
            $array[7] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesNo_contac($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'no_contac';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha Solicitud', 'Cedula', 'Gestor', 'Fecha envío'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['gestor'];
            $array[3] = $campos['observaciones'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesNormalizacion($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'normalizaciones';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', 'Obligación', 'Normalización', 'Cápital', 'Plazo y fecha de primer pago', 'Observación', 'Gestor', 'Fecha envío'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['obligacion'];
            $array[3] = $campos['normalizacion'];
            $array[4] = $campos['valor_pago'];
            $array[5] = $campos['plazo_fecha_pago'];
            $array[6] = $campos['observaciones'];
            $array[7] = $campos['gestor'];
            $array[8] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesCondonaciones($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'condonaciones';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', '# Crédito', 'Valor del pago', 'Fecha de pago', 'Correo Paz y Salvo', 'Gestor', 'Fecha envío'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['obligacion'];
            $array[3] = $campos['valor_pago'];
            $array[4] = $campos['plazo_fecha_pago'];
            $array[5] = $campos['correo_cel'];
            $array[6] = $campos['gestor'];
            $array[7] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesAjustes($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'ajustes';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', 'Nombre', 'Obligacion', 'Tipo Ahorro', 'Valor Pago', 'Normalización', 'Fecha de pago', 'Valor a cruzar', 'Motivo de saldo', 'Gestor', 'Fecha envío'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['nombre_completo'];
            $array[3] = $campos['obligacion'];
            $array[4] = $campos['tipo_ahorro'];
            $array[5] = $campos['valor_pago'];
            $array[6] = $campos['normalizacion'];
            $array[7] = $campos['plazo_fecha_pago'];
            $array[8] = $campos['valor_cruzar'];
            $array[9] = $campos['motivo_saldo'];
            $array[10] = $campos['gestor'];
            $array[11] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesPagare($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'pagare';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Nombre', 'Cedula', 'Ciudad de expedición cedula', 'Correo', 'Celular', 'Deudor / codeudor', 'Gestor', 'Normalización', 'Fecha envío'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['nombre_completo'];
            $array[2] = $campos['cedula'];
            $array[3] = $campos['ciudad_expedicion_cedula'];
            $array[4] = $campos['correo_cel'];
            $array[5] = $campos['celular'];
            $array[6] = $campos['deudor_codeudor'];
            $array[7] = $campos['gestor'];
            $array[8] = $campos['normalizacion'];
            $array[9] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesReprogramados($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'reprogramados';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', 'Hora gestión', 'Gestor', 'Asesor que llama', 'Observaciones'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['hora_gestion'];
            $array[3] = $campos['gestor'];
            $array[4] = $campos['asesor_que_llama'];
            $array[5] = $campos['observaciones'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesROM($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'rom';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', 'Obligación', 'Fecha de pago(SIBANCO)', 'Medio de pago', 'Valor', 'Gestor', 'Envio de comprobante Correo o Whatsapp', 'Fecha de envio', '# de caso', 'Fecha de respuesta', 'Observaciones'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['obligacion'];
            $array[3] = $campos['plazo_fecha_pago'];
            $array[4] = $campos['medio_pago'];
            $array[5] = $campos['valor_pago'];
            $array[6] = $campos['gestor'];
            $array[7] = $campos['correo_cel'];
            $array[8] = $campos['fecha_envio'];
            $array[9] = $campos['numero_caso'];
            $array[10] = $campos['responsable_envio'];
            $array[11] = $campos['observaciones'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informesGestion_whatsapp($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'gestion_whatsapp';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Cedula', 'Gestor', 'Numero', 'Novedad', 'Fecha de envio'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[1] = $campos['cedula'];
            $array[2] = $campos['gestor'];
            $array[3] = $campos['celular'];
            $array[4] = $campos['observaciones'];
            $array[5] = $campos['fecha_envio'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    private function informe_novedades($datos)
    {
        $datos['fecha_inicial'] = date_format(date_create($datos['fecha_inicial']), 'Y-m-d');
        $datos['fecha_final'] = date_format(date_create($datos['fecha_final']), 'Y-m-d');
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '$datos[fecha_inicial] 00:00:00' AND '$datos[fecha_final] 23:59:59' AND tipo = 'novedad';";
        $resultado = $this->row($query);

        $cabeceras = array(
            'Fecha solicitud', 'Gestor', 'Tipo Novedad', 'Cedula', 'Observaciones'
        );

        $fp = fopen('../../public/archivos/descargas/' . $datos['cartera'] . '/informe_' . $datos['informe'] . ' ' . date("Y-m-d") . '.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $cabeceras, ';');
        foreach ($resultado as $campos) {
            $array[0] = $campos['fecha_solicitud'];
            $array[2] = $campos['gestor'];
            $array[3] = $campos['tipo_ahorro'];
            $array[1] = $campos['cedula'];
            $array[4] = $campos['observaciones'];

            fputcsv($fp, $array, ';');
        }

        fclose($fp);
        $retorno = (count($resultado) >= 1) ? 'ok' : 'fallo';
        return $retorno;
    }

    /**********************************************************************CREACIÓN*********************************************************************************************/

    private function crearRegistro($datos)
    {
        $tipo = $datos['accion'];
        $data = $this->$tipo($datos);
        return $data;
    }

    private function crearParametroArbol($datos)
    {
        $tipoAccionContacto = $datos['parametro_id'];
        switch ($datos['tipo']) {
            case 'accion':
                $query = "UPDATE arbol_contacto SET estado = 0 WHERE id_accion = '" . $tipoAccionContacto . "' AND id_cliente =  '" . $datos['cartera'] . "'";
                $resultado = $this->ejecutar2($query);

                if (isset($datos['parametro'])) {
                    foreach ($datos['parametro'] as $parametro) {
                        $arr = explode('-', $parametro);

                        $query = "INSERT INTO arbol_contacto (id_accion, id_contacto, id_cliente) "
                            . "VALUES('" . $arr[1] . "', '" . $arr[0] . "', " . $datos['cartera'] . ") "
                            . "ON DUPLICATE KEY UPDATE estado = 1";
                        $resultado = $this->ejecutar2($query);
                    }
                }

                break;

            case 'contacto':
                $query = "UPDATE arbol_efecto SET estado = 0 WHERE id_contacto = '" . $tipoAccionContacto . "' AND id_cliente =  '" . $datos['cartera'] . "'";
                $resultado = $this->ejecutar2($query);
                if (isset($datos['parametro'])) {
                    foreach ($datos['parametro'] as $parametro) {
                        $arr = explode('-', $parametro);
                        $query = "INSERT INTO arbol_efecto (id_contacto, id_efecto, id_cliente) "
                            . "VALUES('" . $arr[1] . "', '" . $arr[0] . "', " . $datos['cartera'] . ") "
                            . "ON DUPLICATE KEY UPDATE estado = 1";
                        $resultado = $this->ejecutar2($query);
                    }
                }
                break;
            case 'motivo':
                $query = "UPDATE arbol_motivos_no_pago SET estado = 0 WHERE id_contacto = '" . $tipoAccionContacto . "' AND id_cliente =  '" . $datos['cartera'] . "'";
                $resultado = $this->ejecutar2($query);
                if (isset($datos['parametro'])) {
                    foreach ($datos['parametro'] as $parametro) {
                        $arr = explode('-', $parametro);
                        $query = "INSERT INTO arbol_motivos_no_pago(id_contacto, id_motivo_no_pago, id_cliente)"
                            . "VALUES(" . $arr[1] . ", " . $arr[0] . ", " . $datos['cartera'] . ")"
                            . "ON DUPLICATE KEY UPDATE estado = 1";
                        $resultado = $this->ejecutar2($query);
                    }
                }
                break;
        }

        return $resultado;
    }

    private function crearHomologado($datos)
    {
        $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : '0';
        $datos['id_accion'] = (isset($datos['id_accion'])) ? $datos['id_accion'] : '0';
        $datos['id_contacto'] = (isset($datos['id_contacto'])) ? $datos['id_contacto'] : '0';
        $datos['id_efecto'] = (isset($datos['id_efecto'])) ? $datos['id_efecto'] : '0';
        extract($datos);
        switch ($datos['tipo']) {
            case 'accion':
                $query = "INSERT INTO homologado_accion (id, id_accion, homologado, id_cliente, estado)
                          VALUES ($id, " . $id_accion . ", '" . $homologado . "', '" . $_SESSION['carteraActual'] . "', '1')
                          ON DUPLICATE KEY UPDATE homologado = '" . $homologado . "', id_cliente = '" . $_SESSION['carteraActual'] . "'";
                break;

            case 'contacto':
                $query = "INSERT INTO homologado_contacto (id, id_contacto, homologado, id_cliente, estado)
                          VALUES ($id, " . $id_contacto . ", '" . $homologado . "', '" . $_SESSION['carteraActual'] . "', '1')
                          ON DUPLICATE KEY UPDATE homologado = '" . $homologado . "', id_cliente = '" . $_SESSION['carteraActual'] . "'";
                break;

            case 'efecto':
                $query = "INSERT INTO homologado_efecto (id, id_efecto, homologado, id_cliente, efectividad , estado)
                          VALUES ($id, " . $id_efecto . ",'" . $homologado . "', '" . $_SESSION['carteraActual'] . "', '" . $efectividad . "', '1')
                          ON DUPLICATE KEY UPDATE homologado = '" . $homologado . "', id_cliente = '" . $_SESSION['carteraActual'] . "', efectividad = '" . $efectividad . ";'";
                break;
            case 'motivo':
                $query = "INSERT INTO motivos_no_pago (id, motivo, id_cliente, estado)
                                  VALUES ($id,'" . $motivo . "', '" . $_SESSION['carteraActual'] . "', '1')
                          ON DUPLICATE KEY UPDATE motivo = '" . $motivo . "', id_cliente = '" . $_SESSION['carteraActual'] . "'";
                break;
        }
        $resultado = $this->ejecutar2($query);
        $return = array('resultado' => 'ok', 'mensaje' => 'Se creó correctamente');
        return $return;
    }

    private function crearOpcionesInformacion($datos)
    {
        extract($datos);
        $query = "DELETE FROM opciones_informacion WHERE id_cliente = $_SESSION[carteraActual]";
        $resultado = $this->ejecutar2($query);
        $query = "INSERT INTO opciones_informacion
        (label, opciones, id_cliente) 
        VALUES ('" . $label . "','" . $opciones . "',$_SESSION[carteraActual])";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    private function creacionDemografico($datos = array())
    {
        $metodo = $datos['accion'];
        $resultado = $this->$metodo($datos);

        return $resultado;
    }

    private function crearTelefono($datos = array())
    {
        $return = array();

        $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
        $datos['hora'] = $datos['hora'] ?? '';
        $datos['estado'] = $datos['estado'] ?? '1';
        extract($datos);
        $query = "INSERT INTO telefonos (id_telefono, cedula_deudor, tipo_telefono, telefono  ) "
            . "VALUES ($id,'" . $identificacion . "', '" . $this->codificarCaracteres($tipo) . "', "
            . "'" . $telefono . "') ON DUPLICATE KEY UPDATE
            telefono = '" . $telefono . "', tipo_telefono = '" . ($tipo ?? '') . "', hora_disponibilidad = '" . $hora . "', estado = '$estado';";
        $return['resultado'] = $this->ejecutar2($query);

        $query = "SELECT * FROM telefonos WHERE cedula_deudor = '" . $identificacion . "'";
        $return['datos'] = $this->row($query);

        return $return;
    }

    private function crearDireccion($datos = array())
    {
        $return = array();
        $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
        $datos['estado'] = $datos['estado'] ?? '1';
        extract($datos);
        $query = "INSERT INTO direcciones (id_direccion, cedula_deudor, tipo_direccion, ciudad, direccion, estado) "
            . "VALUES ($id,'" . $identificacion . "','" . $tipo . "','" . $ciudad . "', "
            . "'" . $direccion . "', 1) 
            ON DUPLICATE KEY UPDATE tipo_direccion = '" . $tipo . "', ciudad = '" . $ciudad . "', direccion = '" . $direccion . "', estado = '" . $estado . "'";
        $return['resultado'] = $this->ejecutar2($query);

        $query = "SELECT * FROM direcciones WHERE cedula_deudor = '" . $identificacion . "'";
        $return['datos'] = $this->row($query);
        return $return;
    }

    private function crearEmail($datos = array())
    {
        $return = array();
        $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
        $datos['estado'] = $datos['estado'] ?? '1';
        extract($datos);
        $query = "INSERT INTO correos (id_correo, cedula_deudor, tipo_correo, correo, estado) "
            . "VALUES ($id,'" . $identificacion . "', '" . $tipo . "', "
            . "'" . $email . "', 1) 
            ON DUPLICATE KEY UPDATE tipo_correo = '" . $tipo . "', correo = '" . $email . "', estado = '" . $estado . "'";
        $return['resultado'] = $this->ejecutar2($query);

        $query = "SELECT * FROM correos WHERE cedula_deudor = '" . $identificacion . "'";
        $return['datos'] = $this->row($query);
        return $return;
    }

    private function guardarGestion($datos)
    {
        if (!isset($datos['obligacion']))
            $datos['obligacion'][0] = '';

        extract($datos);
        foreach ($datos['obligacion'] as $obligacion) {
            $query = "INSERT INTO historico_gestion (fecha_gestion, gestor, cedula_deudor, obligacion, accion, "
                . "efecto, contacto, motivo_no_pago, fecha_seguimiento, valor_acuerdo, "
                . "fecha_acuerdo, telefono, tipo_negociacion, actividad_economica, origen_gestion, "
                . "observaciones, producto_nuevo, moto, salarios_rango, inicio_gestion, cliente_id)"
                . "VALUES (NOW(), '" . $_SESSION['usuario'] . "', '" . $cedula_deudor . "', '" . $obligacion . "', '" . $accion . "', "
                . "\"" . ($efecto ?? '') . "\", \"" . ($contacto ?? '') . "\", \"" . ($motivo_no_pago ?? '') . "\", \"" . (($fecha_seguimiento ?? '')) . "\", \"" . ($valor_acuerdo ?? '') . "\", "
                . "\"" . ($fecha_acuerdo ?? '') . "\", \"" . ($telefono ?? '') . "\", \"" . ($tipo_negociacion ?? '') . "\", \"" . ($actividad_economica ?? '') . "\", \"" . ($origen_gestion ?? '') . "\", "
                . "\"" . (str_replace("'", "", ($observaciones ?? ''))) . "\", \"" . ($producto ?? '') . "\", \"" . ($moto ?? '') . "\", \"" . ($salarios_rango ?? '') . "\", \"" . ($inicioGestion ?? '') . "\", \"" . ($cartera ?? '') . "\")";

            $resultado = $this->obtenerId($query);
        }

        $this->crearTelefono(['telefono' => $telefono, 'identificacion' => $cedula_deudor]);

        if ($cartera == 19 && $contacto_gestion == 106 || $origen_gestion == 'tarea') {
            $datos['id_tarea'] = $datos['id_tarea'] ?? '0';

            $query = "UPDATE datos_tareas SET gestionado = '1', fin_gestion = NOW()
                        WHERE id_tarea = '" . $id_tarea . "' OR cartera = '" . $cartera . "'
                        AND identificacion = '" . $cedula_deudor . "'";
            $this->ejecutar2($query);
        }
        $apicon = new apicon();
        $query = "UPDATE agendamiento SET estado = 1
          WHERE usuario = '" . $_SESSION['usuario'] . "' AND titulo = '" . $cedula_deudor . "';";
        $apicon->multiquery($query);

        if (isset($fecha_seguimiento) && $fecha_seguimiento != '') {
            date_default_timezone_set("America/Bogota");
            $inicio_evento = date_sub(date_create($fecha_seguimiento), date_interval_create_from_date_string("10 minutes"));
            $fin_evento = date_add(date_create($fecha_seguimiento), date_interval_create_from_date_string("1 hour"));
            $query = "INSERT INTO agendamiento (usuario,cliente_id,gestion_id,tipo,titulo,inicio_evento,fin_evento)"
                . "VALUES('$_SESSION[usuario]', $_SESSION[carteraActual],$resultado, 'reprogramacion', '$cedula_deudor','" . date_format($inicio_evento, "Y-m-d H:i:s") . "', '" . date_format($fin_evento, "Y-m-d H:i:s") . "');";
            $apicon->multiquery($query);
        }

        return $resultado;
    }

    private function guardarGuion($datos)
    {
        extract($datos);
        $query = "INSERT INTO guiones_gestion (id_efecto, guion, id_cliente)"
            . "VALUES ('" . $tipo_efecto . "', '" . $txtGuion . "', '" . $cartera . "')"
            . "ON DUPLICATE KEY UPDATE guion = '" . $txtGuion . "'";
        return $this->ejecutar2($query);
    }

    private function camposFormGestion($datos)
    {
        unset($datos['metodo']);

        $resultado = array();

        foreach ($datos as $entrada) {
            $estado = (isset($entrada['estado'])) ? 1 : 0;

            if (count($entrada['tipo']) > 1) {
                foreach ($entrada['tipo'] as $key => $opciones) {
                    if ($key == "0") continue;

                    foreach ($opciones as $id => $opcion) {
                        if (strpos($opcion, "\"") !== false)
                            $opcion = str_replace("\"", "", $opcion);

                        $query = "INSERT INTO inputs_opciones (id, input_id, opcion) VALUES ('" . (($key == 'new') ? 'NULL' : $id) . "', '"
                            . $entrada['id'] . "', \"" . $opcion . "\") ON DUPLICATE KEY UPDATE opcion = \"" . $opcion . "\"";
                        $this->ejecutar2($query);
                    }
                }
            }

            $query = "UPDATE inputs_gestion SET input = '" . $entrada['input'] . "', tipo = '" . $entrada['tipo']["0"] . "', " .
                "estado = '" . $estado . "' WHERE id = '" . $entrada['id'] . "'";

            $resultado[] = $this->ejecutar2($query);
        }

        return $resultado;
    }

    private function establecerPosicion($datos)
    {
        $respuesta = 1;

        foreach ($datos['campos'] as $posiciones) {
            $query = "UPDATE inputs_gestion SET posicion = '" . $posiciones[1] . "' WHERE id = '" . $posiciones[0] . "'";
            $this->ejecutar2($query);
        }

        return $respuesta;
    }

    private function habilitarColumnas($datos)
    {
        $query = "UPDATE inputs_gestion SET estado_tabla = 0 WHERE id_cartera = '$_SESSION[carteraActual]';";
        $this->ejecutar($query);
        foreach ($datos['id_input'] as $columna) {
            $query = "UPDATE inputs_gestion SET estado_tabla = 1 WHERE id_input = '$columna' AND id_cartera = '$_SESSION[carteraActual]';";
            $this->ejecutar($query);
        }
        $return = array('resultado' => 'ok', 'mensaje' => 'La asignación fue importada con exito');
        return $return;
    }

    private function actualizarTituloInformacion($datos)
    {
        foreach ($datos['titulo'] as $key => $titulo) {
            $query = "UPDATE label_informacion SET titulo = '$titulo' WHERE campo_tabla = '$key' AND id_cliente = '$_SESSION[carteraActual]';";
            $resultado = $this->ejecutar2($query);
        }
        $return = array('resultado' => 'ok', 'mensaje' => 'La asignación fue importada con exito');
        return $return;
    }

    private function guardarEvento($datos)
    {
        $apicon = new apicon();
        $resultado = false;
        $query = "INSERT INTO agendamiento (id, usuario, cliente_id, tipo, titulo, inicio_evento, fin_evento) VALUES\n";
        $usuario = empty($datos['usuario']) ? $_SESSION['usuario'] : $datos['usuario'];

        $fechaInicial = new DateTime($datos['inicio_evento'] . (isset($datos['h_inicio']) ? $datos['h_inicio'] . ":00" : ""));
        $fechaFinal = new DateTime($datos['fin_evento'] . (isset($datos['h_fin']) ? $datos['h_fin'] . ":00" : ""));

        if (!(($fechaInicial->format('Y-m-d') >= date("Y-m-d") && $fechaFinal->format('Y-m-d') >= date("Y-m-d")) &&
            ($fechaFinal->format('Y-m-d H:i:s') > $fechaInicial->format('Y-m-d H:i:s'))))
            return $resultado;

        if (mb_strtoupper($datos['tipo']) == strtoupper("Jornada")) {
            $eventos = $this->eventosDiaUsuario($datos);

            if (count($eventos) > 0 && !isset($datos['id']))
                return $resultado;

            for ($contador = 0; $contador < count($eventos); $contador++) {
                if ($datos['id'] == $eventos[$contador]['id'])
                    break;

                if ($contador == count($eventos) - 1)
                    return $resultado;
            }
        }

        if (!isset($datos['h_inicio'])) {
            if (isset($datos["id"])) {
                $query = "UPDATE agendamiento SET usuario = \"" . $usuario . "\", 
                        tipo = \"" . $datos['tipo'] . "\", titulo = \"" . $datos['titulo'] . "\", 
                        inicio_evento = \"" . $datos['inicio_evento'] . "\", fin_evento = \"" . $datos['fin_evento'] . "\"
                    WHERE estado = 0 AND id = '" . $datos['id'] . "';";
            } else {
                $query .= $this->valuesInsertAgendamiento($usuario, $datos);
            }
        } else if ($fechaFinal->format("H:i:s") > $fechaInicial->format("H:i:s")) {
            $intervalo = $fechaInicial->diff($fechaFinal)->days;

            for ($contador = 0; $contador <= $intervalo; $contador++) {
                if ($contador > 0)
                    $fechaInicial->modify("+1 day");

                $query .= $this->valuesInsertAgendamiento(
                    $usuario,
                    $datos,
                    ($fechaInicial->format("Y-m-d H:i:s")),
                    $fechaInicial->format("Y-m-d") . " " . $datos['h_fin'] . ":00"
                ) . ($contador == $intervalo ? "" : ",\n");
            }
        }

        if ($apicon->insertar($query)) {
            $resultado['resultado'] = "calendario";

            if ($this->rolCartera("asesor"))
                $resultado['eventos'] = $this->obtenerCalendario(array("metodo" => "obtenerCalendario"));
            else
                $resultado['eventos'] = $this->obtenerCalendario(array("usuario" => $usuario, "metodo" => "obtenerCalendario"));
        }

        return $resultado;
    }

    private function valuesInsertAgendamiento($usuario, $datos, $inicio_evento = NULL, $fin_evento = NULL)
    {
        return "(\"" . ($datos['id'] ?? "NULL") . "\", \"" . $usuario . "\", " .
            "\"" . $_SESSION['carteraActual'] . "\", \"" . $datos['tipo'] . "\", \"" . $datos['titulo'] . "\", " .
            "\"" . ($inicio_evento ?? $datos['inicio_evento']) . "\", \"" . ($fin_evento ?? $datos['fin_evento']) . "\")";
    }

    /**********************************************************************EDICIÓN*********************************************************************************************/

    private function formularioEditarRegistro($datos)
    {
        $metodo = 'formulario' . ucwords($datos['tipo']);
        $resultado = $this->$metodo($datos['id']);
        return $resultado;
    }

    private function formularioEditarTelefono($id)
    {
        $query = "SELECT * FROM telefonos WHERE id_telefono = $id ORDER BY estado asc";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     *
     * @param type $id
     * @return type
     */
    private function formularioEditarDireccion($id)
    {
        $query = "SELECT id_direccion, cedula_deudor, tipo_direccion as tipo, ciudad, direccion, estado FROM direcciones WHERE id_direccion = $id";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     *
     * @param type $id
     * @return type
     */
    private function formularioEditarEmail($id)
    {
        $query = "SELECT id_correo, cedula_deudor, tipo_correo as tipo, correo, estado FROM correos WHERE id_correo = $id";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function formularioEditarAccion($id)
    {
        $query = "SELECT * FROM homologado_accion WHERE id = $id";
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function formularioEditarContacto($id)
    {
        $query = "SELECT * FROM homologado_contacto WHERE id = $id";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function formularioEditarEfecto($id)
    {
        $query = "SELECT * FROM homologado_efecto WHERE id = $id";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function formularioEditarMotivo($id)
    {
        $query = "SELECT * FROM motivos_no_pago WHERE id = $id";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**********************************************************************ELIMINACION*********************************************************************************************/

    private function borrarRegistro($datos)
    {
        $tipo = (isset($datos['tipo'])) ? $datos['tipo'] : $datos['accion'];
        $data = $this->$tipo($datos['id']);
        return $data;
    }

    private function borrarTarea($id)
    {
        $query = "DELETE FROM tareas WHERE id = '$id'";
        $resultado = $this->ejecutar2($query);
        $query = "DELETE FROM datos_tareas WHERE id_tarea = '$id'";
        $resultado = $this->ejecutar2($query);
        $return = array('resultado' => 'ok', 'mensaje' => 'Se Eliminaron los registros correctamente.');
        return $resultado;
    }

    private function borrarAccion($id)
    {
        $query = "DELETE FROM homologado_accion WHERE id = $id";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    private function borrarContacto($id)
    {
        $query = "DELETE FROM homologado_contacto WHERE id = $id";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    private function borrarEfecto($id)
    {
        $query = "DELETE FROM homologado_efecto WHERE id = $id";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    private function borrarMotivo($id)
    {
        $query = "DELETE FROM motivos_no_pago WHERE id = $id";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    private function borrarOpcionGestion($id)
    {
        $query = "DELETE FROM inputs_opciones WHERE id = $id";
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    private function borrarEvento($datos)
    {
        $resultado = false;

        $query = "DELETE FROM agendamiento WHERE id = \"" . $datos['id'] . "\" AND estado = 0;";

        $apicon = new apicon();

        if ($apicon->insertar($query)) {
            $resultado = $this->obtenerCalendario(["usuario" => $datos['usuario'], "metodo" => "obtenerCalendario"]);
        }

        return $resultado;
    }

    /**********************************************************************OBTENER*********************************************************************************************/

    private function consultarNotificaciones($datos)
    {
        $notificaciones = array('agendamiento' => array(), 'mensajes' => array());
        $notificaciones['agendamiento'] = $this->consultarAgendamiento($datos);
        return $notificaciones;
    }

    private function consultarAgendamiento($datos)
    {
        if ($datos['metodo'] == 'consultarNotificaciones') {
            $query = "SELECT id, usuario, tipo, titulo as title, inicio_evento as start, fin_evento as end, estado FROM agendamiento WHERE usuario = '" . $_SESSION['usuario'] . "' AND cliente_id = '$_SESSION[carteraActual]' AND (inicio_evento BETWEEN NOW() AND '" . date('Y-m-d') . " 23:59:59' OR fin_evento BETWEEN NOW() AND '" . date('Y-m-d') . " 23:59:59') AND estado = 0 ORDER BY inicio_evento ASC;";
        } elseif ($datos['metodo'] == "obtenerCalendario") {
            $query = "SELECT id, usuario, tipo, titulo as title, inicio_evento as start, fin_evento as end, estado FROM agendamiento 
                WHERE cliente_id = \"" . $_SESSION['carteraActual'] . "\" AND usuario = \"" . ($datos['usuario'] ?? $_SESSION['usuario']) . "\" AND inicio_evento LIKE \"%" . date("Y") . "%\" AND fin_evento LIKE \"%" . date("Y") . "%\"";
        } else {
            $query = "SELECT * FROM agendamiento WHERE cliente_id = '$_SESSION[carteraActual]';";
        }

        $apicon = new apicon();
        $resultado = $apicon->obtener($query);

        return $resultado;
    }

    private function consultarTareas($datos)
    {
        $query = "SELECT id, nombre_tarea FROM tareas WHERE cartera = '" . $_SESSION['carteraActual'] . "' "
            . "AND tipo_tarea IN ('libre', 'asesor') AND terminada = '0'";
        $resultado = $this->row($query);
        return $resultado;
    }

    private function buscarDeudoresTarea($datos)
    {
        $datos['tipo'] = 'tarea';
        $datos['datoBusqueda'] = $datos['tarea'];

        $modulo = $this->informacionModuloGestion($datos);
        return $modulo;
    }

    public function obtenerInformacionCartera($cartera)
    {
        $apicon = new apicon();
        $query = "SELECT * FROM clientes WHERE id = '$cartera'";
        $resultado = $apicon->obtener($query);

        return $resultado;
    }

    private function parametroArbol($datos)
    {
        $resultado = array();

        switch ($datos['tipo']) {
            case 'accion':
                $query = "SELECT id, homologado FROM homologado_contacto WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1' ORDER BY homologado";
                $resultado['homologado'] = $this->row($query);
                $query = "SELECT h.id as id, h.homologado FROM homologado_contacto h, arbol_contacto a WHERE a.id_cliente = '" . $datos['cartera'] . "'"
                    . "AND a.id_contacto = h.id AND a.id_accion = '" . $datos['parametro'] . "' AND a.estado = '1' AND h.estado = '1'";
                $resultado['asignadas'] = $this->row($query);
                break;
            case 'contacto':
                $query = "SELECT id, homologado FROM homologado_efecto WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1' ORDER BY homologado";
                $resultado['homologado'] = $this->row($query);
                $query = "SELECT h.id, h.homologado FROM homologado_efecto h, arbol_efecto a WHERE a.id_cliente = '" . $datos['cartera'] . "'"
                    . "AND a.id_efecto = h.id AND a.id_contacto = '" . $datos['parametro'] . "' AND a.estado = '1' AND h.estado = '1'";
                $resultado['asignadas'] = $this->row($query);
                break;
            case 'motivo':
                $query = "SELECT id, motivo FROM motivos_no_pago WHERE id_cliente = '" . $datos['cartera'] . "' AND estado = '1' ORDER BY motivo";
                $resultado['homologado'] = $this->row($query);
                $query = "SELECT m.id, m.motivo FROM motivos_no_pago m, arbol_motivos_no_pago a WHERE a.id_cliente = '" . $datos['cartera'] . "'"
                    . "AND a.id_motivo_no_pago = m.id AND a.id_contacto = '" . $datos['parametro'] . "' AND m.estado = '1' AND a.estado = '1'";
                $resultado['asignadas'] = $this->row($query);
                break;
        }
        return $resultado;
    }

    private function obtenerInformacionClientesParametro($cartera, $parametro = '', $tipo = '')
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
            case 'tarea':
                $query = "SELECT orden FROM tareas WHERE id = '$parametro'";
                $orden = $this->row($query);
                $orden = $orden[0]['orden'];
                $query = "SELECT o.cedula_deudor FROM datos_tareas dt, obligaciones o, deudores d WHERE dt.id_tarea = '$parametro'
                AND dt.cartera ='$cartera' AND dt.identificacion = o.cedula_deudor AND d.cedula = dt.identificacion AND dt.usuario IN('', '" . $_SESSION['usuario'] . "') AND dt.gestionado = '0' ORDER BY dt.orden asc $orden LIMIT 1";
                break;
            case 'inicio':
                $query = "SELECT d.cedula as cedula_deudor FROM deudores d, obligaciones o WHERE d.cedula = o.cedula_deudor AND o.cartera = '$cartera' 
                AND d.estado = '1' AND d.cedula NOT IN(SELECT cedula FROM bloqueo_gestion where cedula_deudor = o.cedula_deudor and CONCAT('1-', '$cartera')) LIMIT 1";
                break;
        }
        $cedula = $this->row($query);
        if (isset($cedula[0]) && $tipo == 'tarea') {
            $this->marcarDeudoresTarea($cedula[0]['cedula_deudor'], $parametro);
        }
        $cedula = isset($cedula[0]['cedula_deudor']) ? $cedula[0]['cedula_deudor'] : '';
        $return['origen_gestion'] = ($tipo == 'tarea') ? 'tarea' : 'general';

        if ($cedula != '') {
            $query = "SELECT * FROM deudores WHERE cedula = '$cedula'";
            $return['cliente'] = $this->row($query);
            $query = "SELECT * FROM obligaciones WHERE cedula_deudor = '$cedula' AND cartera = '$cartera'";
            $return['obligaciones'] = $this->row($query);
            foreach ($return['obligaciones'] as $key => $obligaciones) {
                $query = "SELECT * FROM pagos WHERE obligacion = '" . $obligaciones['numero_obligacion'] . "' AND cliente_pago = '$cartera'";
                $pagos[$key] = $this->row($query);
            }
            $return['pagos'] = $pagos;
            $query = "SELECT * FROM direcciones WHERE cedula_deudor = '$cedula'";
            $return['direcciones'] = $this->row($query);
            $query = "SELECT * FROM correos WHERE cedula_deudor = '$cedula'";
            $return['emails'] = $this->row($query);
            $query = "SELECT * FROM telefonos WHERE cedula_deudor = '$cedula'";
            $return['telefonos'] = $this->row($query);
        }
        $this->marcarCliente($cartera, $cedula);
        return $return;
    }

    private function marcarDeudoresTarea($identificacion, $tarea)
    {
        $query = "UPDATE datos_tareas SET inicio_gestion = NOW(), usuario='" . $_SESSION['usuario'] . "'
        WHERE  identificacion = '$identificacion' AND id_tarea = '$tarea'";
        $return = $this->ejecutar2($query);
    }

    private function obtenerInformacionGestion($cartera)
    {
        $return = array();

        $query = "SELECT h.* FROM accion a, homologado_accion h WHERE a.estado = '1'
            AND h.id_accion = a.id AND  h.id_cliente = '$cartera'"
            . "AND h.estado = '1' ORDER BY h.homologado";
        $return['acciones'] = $this->row($query);

        $query = "SELECT h.* FROM contacto c, homologado_contacto h WHERE c.estado = '1'
            AND h.id_contacto = c.id AND h.id_cliente = '$cartera'"
            . "AND h.estado = '1' ORDER BY h.homologado";
        $return['contacto'] = $this->row($query);

        $return['campos_gestion'] = $this->obtenerInputsGestion($_SESSION['carteraActual'], 1);
        $return['opciones_gestion'] = $this->obtenerOpcionesInputGestion($return['campos_gestion']);

        $query = "SELECT * FROM opciones_informacion WHERE id_cliente = $_SESSION[carteraActual]";
        $return['opciones'] = $this->row($query);

        $query = "SELECT * FROM label_informacion WHERE id_cliente = '" . $_SESSION['carteraActual'] . "'";
        $return['label_informacion'] = $this->row($query);

        return $return;
    }

    private function obtenerInformacionHistoricoGestion($cedula, $cartera)
    {
        $query = "SELECT * FROM historico_gestion WHERE cedula_deudor = '$cedula' AND cliente_id = '$cartera' ORDER by fecha_gestion DESC;";
        $return = $this->row($query);
        foreach ($return as $key => $historico) {
            $query = "SELECT homologado FROM homologado_accion where id = '" . $historico['accion'] . "';";
            $return[$key]['accion'] = $this->row($query)[0]['homologado'];
            $query = "SELECT homologado FROM homologado_contacto where id = '" . $historico['contacto'] . "';";
            $return[$key]['contacto'] = $this->row($query)[0]['homologado'];
            $query = "SELECT homologado FROM homologado_efecto where id = '" . $historico['efecto'] . "';";
            $return[$key]['efecto'] = $this->row($query)[0]['homologado'];
        }
        return $return;
    }

    private function refrescarHistorico($datos)
    {
        $datos = $this->informacionModuloGestion($datos);
        return $datos;
    }

    private function marcarCliente($cartera, $cedula)
    {
        $query = "INSERT INTO bloqueo_gestion (id_bloqueo, cedula_deudor) "
            . "VALUES('1-$cartera', '$cedula') ON DUPLICATE KEY UPDATE cedula_deudor = '$cedula';";
        $this->ejecutar2($query);
    }

    private function buscarDeudor($datos)
    {
        $modulo = $this->informacionModuloGestion($datos);
        return $modulo;
    }

    private function obtenerContactosAccion($datos)
    {
        $query = "SELECT c.homologado, c.id FROM homologado_contacto c, arbol_contacto a "
            . "WHERE a.id_accion = '" . $datos['accion'] . "' AND a.id_contacto = c.id AND a.estado = '1' AND c.estado = '1'"
            . " ORDER BY c.homologado";

        $return = $this->row($query);
        return $return;
    }

    private function obtenerEfectosContacto($datos)
    {
        $query = "SELECT e.homologado, e.id FROM homologado_efecto e, arbol_efecto a "
            . "WHERE a.id_contacto = '" . $datos['contacto'] . "' AND a.id_efecto = e.id
                AND a.id_cliente = '" . $datos['cartera'] . "' AND a.estado = '1' AND e.estado = '1'"
            . " ORDER BY e.homologado";
        $return['efectos'] = $this->row($query);

        return $return;
    }

    private function searchObligatoriedad($datos)
    {
        $query = "SELECT id_input FROM inputs_gestion 
                WHERE id in(SELECT id_input FROM obligatoriedad WHERE id_accion = '" . $datos['accion'] . "' AND id_contacto = '" . $datos['contacto'] . "' AND id_efecto = '" . $datos['efecto'] . "' 
                AND cartera = '" . $datos['cartera'] . "' AND estado = 1); ";
        $respuesta['inputs'] = $this->row($query);

        return $respuesta;
    }

    private function buscarGuion($datos)
    {
        $query = "SELECT * FROM guiones_gestion WHERE id_efecto = '" . $datos['dato'] . "' and id_cliente = '" . $datos['cartera'] . "'";
        return $this->row($query);
    }

    private function homologadoGevening($datos)
    {
        $query = "SELECT id FROM homologado_gevening WHERE id_cliente = '" . $datos['cartera'] . "' AND id_efecto = '" . $datos['efecto'] . "'";
        $resultado = $this->row($query);

        return $resultado;
    }

    private function iniciarPausa($datos)
    {
        $query = "UPDATE backendfianza.usuarios SET estado_pausa = '1' WHERE usuario = '" . $_SESSION['usuario'] . "'";
        $_SESSION['estado_pausa'] = 1;
        $_SESSION['tipo_pausa'] = $datos['pausa'];
        $_SESSION['label_pausa'] = $datos['label'];
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    private function guardarTiempoMuerto($datos)
    {
        $query = "INSERT INTO pausas (tipo_pausa, tiempo_pausa, usuario, fecha_pausa, cartera) "
            . "VALUES ('" . $datos['tipo'] . "', '" . $datos['tiempo'] . "', '" . $_SESSION['usuario'] . "', NOW(), '" . $_SESSION['carteraActual'] . "')";
        $resultado = $this->ejecutar2($query);

        $query = "UPDATE backendfianza.usuarios SET estado_pausa = '0' WHERE usuario = '" . $_SESSION['usuario'] . "' ";
        $this->ejecutar2($query);

        $_SESSION['estado_pausa'] = 0;

        return $resultado;
    }

    private function estadoTarea($datos)
    {
        $resultado = array();
        $query = "SELECT COUNT(identificacion) as gestionado, usuario FROM datos_tareas WHERE id_tarea = '" . $datos['id'] . "'
                  AND gestionado = '1' GROUP BY usuario;";
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

        $resultado['promedio_gestion'] = ($diferencias[0]['cantidad'] != 0) ? $suma / $diferencias[0]['cantidad'] : 0;
        return $resultado;
    }

    private function busquedaReferencia($datos)
    {
        $resultado = array();

        /* Obligación */
        $query = 'SELECT * FROM obligaciones WHERE numero_obligacion = "' . $datos['obligacion'] . '" AND cartera = "' . $datos['cartera'] . '"';
        $resultado['obligacion'] = $this->row($query);

        /* Pagos */
        $query = 'SELECT * FROM pagos WHERE obligacion = "' . $datos['obligacion'] . '" AND cliente_pago = "' . $datos['cartera'] . '"';
        $resultado['pagos'] = $this->row($query);

        return $resultado;
    }

    private function busquedaEfecto($datos)
    {
        $query = "SELECT e.homologado, e.id FROM homologado_efecto e, arbol_efecto a "
            . "WHERE a.id_contacto = '" . $datos['contacto'] . "' AND a.id_efecto = e.id
                AND a.id_cliente = '" . $datos['cartera'] . "' AND a.estado = '1' AND e.estado = '1' ORDER BY e.homologado";

        return $this->row($query);
    }

    private function administrarObligatoriedad($datos)
    {
        $respuesta = array();

        $query = "SELECT * FROM inputs_gestion WHERE id_cartera = '" . $_SESSION['carteraActual'] . "' AND estado = 1 ORDER BY posicion;";
        $respuesta['inputs'] = $this->row($query);

        $query = "SELECT * FROM obligatoriedad WHERE id_accion = '" . $datos['accion'] . "'"
            . " AND id_contacto = '" . $datos['contacto'] . "' AND id_efecto = '" . $datos['efecto'] . "' AND cartera = '" . $datos['cartera'] . "'"
            . "AND estado = 1";
        $respuesta['inputsAsignados'] = $this->row($query);

        return $respuesta;
    }

    private function guardarObligatoriedad($datos)
    {
        $query = "UPDATE obligatoriedad SET estado = 0 WHERE id_accion = '" . $datos['accion'] . "' AND id_contacto = '" . $datos['contacto'] . "'"
            . "AND id_efecto = '" . $datos['efecto'] . "' AND cartera = '" . $datos['cartera'] . "'";
        $resultado = $this->ejecutar2($query);

        if (isset($datos['parametro'])) {
            foreach ($datos['parametro'] as $parametro) {
                $query = "INSERT INTO obligatoriedad (id_accion, id_contacto, id_efecto, id_input, cartera) "
                    . "VALUES('" . $datos['accion'] . "', '" . $datos['contacto'] . "','" . $datos['efecto'] . "',$parametro, '" . $datos['cartera'] . "')"
                    . "ON DUPLICATE KEY UPDATE estado = 1;";
                $resultado = $this->ejecutar2($query);
            }
        }

        return $resultado;
    }

    public function formulariosSolicitudes($datos)
    {
        $query = "SELECT * FROM solicitudes_envio WHERE fecha_solicitud BETWEEN '" . date('Y-m-') . "1 00:00:00' AND '" . date('Y-m-') . "31 23:59:59' ORDER BY fecha_solicitud DESC";
        $resultado = $this->row($query);
        return $resultado;
    }

    public function enviarSolicitud($datos)
    {
        $datos['ciudad_expedicion_cedula'] = $datos['ciudad_expedicion_cedula'] ?? '';
        $datos['nombre_completo'] = $datos['nombre_completo'] ?? '';
        $datos['normalizacion'] = $datos['normalizacion'] ?? '';
        $datos['observaciones'] = $datos['observaciones'] ?? '';
        $datos['celular'] = $datos['celular'] ?? '';
        $datos['tipo_ahorro'] = $datos['tipo_ahorro'] ?? '';
        $datos['valor_cruzar'] = $datos['valor_cruzar'] ?? '';
        $datos['motivo_saldo'] = $datos['motivo_saldo'] ?? '';
        $datos['deudor_codeudor'] = $datos['deudor_codeudor'] ?? '';
        $datos['hora_gestion'] = $datos['hora_gestion'] ?? '';
        $datos['asesor_que_llama'] = $datos['asesor_que_llama'] ?? '';
        $datos['medio_pago'] = $datos['medio_pago'] ?? '';
        $datos['numero_caso'] = $datos['numero_caso'] ?? '';
        $datos['fecha_respuesta'] = $datos['fecha_respuesta'] ?? '';
        $datos['responsable_envio'] = $datos['responsable_envio'] ?? '';
        $datos['valor_pago'] = str_replace(["'", '.', ','], '', $datos['valor_pago']);

        $query = "INSERT INTO solicitudes_envio(tipo, fecha_solicitud, cedula, ciudad_expedicion_cedula, nombre_completo, obligacion, valor_pago, plazo_fecha_pago, correo_cel, 
        gestor, fecha_envio, normalizacion, observaciones, celular, tipo_ahorro, valor_cruzar, motivo_saldo, deudor_codeudor,hora_gestion,asesor_que_llama,medio_pago,numero_caso,
        fecha_respuesta,responsable_envio, estado)
        VALUES('$datos[tipo]', NOW(), '$datos[cedula]', '$datos[ciudad_expedicion_cedula]', '$datos[nombre_completo]', '$datos[obligacion]', '$datos[valor_pago]', '$datos[plazo_fecha_pago]','$datos[correo_cel]',
        '$_SESSION[usuario]', '$datos[fecha_envio]', '$datos[normalizacion]', '$datos[observaciones]', '$datos[celular]', '$datos[tipo_ahorro]', '$datos[valor_cruzar]', '$datos[motivo_saldo]','$datos[deudor_codeudor]',
        '$datos[hora_gestion]', '$datos[asesor_que_llama]', '$datos[medio_pago]', '$datos[numero_caso]', '$datos[fecha_respuesta]', '$datos[responsable_envio]', '1');";
        $response = $this->ejecutar2($query);
        $resultado['resultado'] = ($response >= 1) ? 'ok' : 'fallo';
        $resultado['mensaje'] = ($response >= 1) ? 'Se ha enviado' : 'No se ha enviado';
        return $resultado;
    }

    public function actualizarFecha($datos)
    {
        $query = "UPDATE solicitudes_envio SET fecha_envio = '$datos[fecha]' WHERE id = $datos[id]";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    public function obtenerInputsGestion($cartera, $estado = '')
    {
        if ($estado != '')
            $estado = "AND estado = $estado";

        $query = "SELECT * FROM inputs_gestion WHERE id_cartera = " . $cartera . " $estado ORDER BY posicion;";

        return $this->row($query);
    }

    public function obtenerOpcionesInputGestion($inputs)
    {
        $opciones = [];

        for ($indice = 0; $indice < count($inputs); $indice++) {
            try {
                $query = "SELECT * FROM inputs_opciones WHERE input_id = " . $inputs[$indice]['id'] . " ORDER BY opcion;";
                $resultado = $this->row($query);

                if (count($resultado) > 0)
                    $opciones[$inputs[$indice]['id_input']] = $resultado;
            } catch (Exception $e) {
                continue;
            }
        }

        return $opciones;
    }

    private function obtenerUsuariosCartera($datos)
    {
        $apicon = new apicon();

        $query = "SELECT u.id, u.usuario, u.identificacion, c.id AS cliente_id, c.nombre AS cliente, r.id AS rol_id, r.nombre AS rol FROM usuarios AS u 
          INNER JOIN role_usuario AS ru ON u.id = ru.usuario_id
          INNER JOIN clientes AS c ON ru.cliente_id = c.id
          INNER JOIN roles AS r ON ru.role_id = r.id
          WHERE r.nombre LIKE (\"%" . $datos["rol"] . "%\") AND c.id = \"" . $_SESSION['carteraActual'] . "\" ORDER BY u.usuario;";
        $usuariosCartera = $apicon->obtener($query);
        $apicon->closeConnection();

        return $usuariosCartera;
    }

    private function disponibilidadAgenda($datos)
    {
        $query = "SELECT * FROM agendamiento WHERE usuario IN 
          (SELECT u.usuario FROM usuarios AS u 
            INNER JOIN role_usuario AS ru ON u.id = ru.usuario_id
            INNER JOIN clientes AS c ON ru.cliente_id = c.id
            INNER JOIN roles AS r ON ru.role_id = r.id
          WHERE r.nombre LIKE '%" . $datos['rol'] . "%' AND c.id = " . $_SESSION['carteraActual'] . " ORDER BY u.usuario) 
        AND tipo = '" . $datos['tipo'] . "' AND cliente_id = " . $_SESSION['carteraActual'] . " 
        AND (inicio_evento <= '" . $datos['fecha_inicio'] . "' AND fin_evento >= '" . $datos['fecha_fin'] . "')  ORDER BY usuario;";

        $apicon = new apicon();
        $resultado = $apicon->obtener($query);

        return $resultado;
    }

    public function eventosDiaUsuario($datos)
    {
        $inicio = date_create($datos['inicio_evento']);
        $fin = date_create($datos['fin_evento']);

        $query = "SELECT * FROM `agendamiento` WHERE usuario = '" . ($datos['usuario'] ?? $_SESSION['usuario']) . "' 
            AND tipo = '" . $datos['tipo'] . "'
            AND ((inicio_evento BETWEEN '" . date_format($inicio, "Y-m-d") . " 00:00:00' AND '" . date_format($fin, "Y-m-d") . " 23:59:59')
              AND (fin_evento BETWEEN '" . date_format($inicio, "Y-m-d") . " 00:00:00' AND '" . date_format($fin, "Y-m-d") . " 23:59:59'));";

        $apicon = new apicon();
        $resultado = $apicon->obtener($query);

        return $resultado;
    }

    public function rolCartera($rol)
    {
        $esRol = false;

        for ($contador = 0; $contador < count($_SESSION['acceso']); $contador++) {
            if ($_SESSION['acceso'][$contador]['cliente_id'] == $_SESSION['carteraActual']) {
                $rolActual = mb_strtoupper($_SESSION['acceso'][$contador]['rol']);
                $rolBuscar = mb_strtoupper($rol);

                if (strpos($rolActual, $rolBuscar) !== false)
                    $esRol = true;

                break;
            }
        }

        return $esRol;
    }

    public static function codificarCaracteres($cadena)
    {
        return utf8_decode(utf8_encode($cadena));
    }
}

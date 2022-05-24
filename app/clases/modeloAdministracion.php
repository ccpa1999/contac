<?php

/**
 * Este Archivo y todos los contenidos en esta aplicación son propiedad
 * exclusiva de FIANZA LDTA, cualquier copia o reproducción del codigo 
 * aquí contenido será tomada como una violación a los derechos de autor 
 * de la marca anteriormente nombrada y será castigada y denunciada
 * penalmente
 * 
 * @author Jonnathan Murcia <jjmurciab@gmail.com>
 * @version 1.0
 * @copyright (c) 2016, FIANZA LTDA 
 * */
session_start();

class modeloAdministracion extends conexion
{

    public function __construct($datos = array())
    {
        $this->conexion();
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    public function controlador($datos)
    {
        if (isset($datos['metodo'])) {
            $metodo = $datos['metodo'];

            $resultado = $this->$metodo($datos);
        }

        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function paginaInicio()
    {
        $resultado = array();

        $resultado['clientes'] = $this->obtenerClientes();
        $resultado['menus'] = $this->obtenerMenus();

        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function obtenerClientes()
    {
        $clientesAcceso = array();

        $i = 0;

        if (isset($_SESSION['acceso']))
        {
            foreach ($_SESSION['acceso'] as $acceso) {
                $query = "SELECT * FROM clientes "
                    . "WHERE id_cliente = '" . $acceso['id_cliente'] . "' AND estado = 1";

                $resultado = $this->row($query);

                $clientesAcceso[$i] = (isset($resultado[0])) ? $resultado[0] : '';

                $i++;
            }            
        }

        return $clientesAcceso;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function administracionUsuarios($datos = array())
    {
        $resultado = array();

        $resultado['usuarios'] = $this->obtenerUsuarios();
        $resultado['roles'] = $this->obtenerRoles();

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function administracionClientes($datos = array())
    {
        $resultado = array();
        $resultado['clientes'] = $this->obtenerClientes();

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function administracionCarga($datos = array())
    {
        $resultado = array();
        $resultado['cargas'] = $this->obtenerClientes();

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function administracionRoles($datos = array())
    {
        $resultado = array();
        $resultado['roles'] = $this->obtenerRoles();
        $resultado['menus'] = $this->obtenerMenus();

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function administracionPermisos($datos = array())
    {
        $resultado = array();
        $resultado['menus'] = $this->obtenerMenus();
        $resultado['roles'] = $this->obtenerRoles();
        $resultado['permisos'] = $this->obtenerPermisosMenus();

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function administracionRegiones($datos = array())
    {
        $query = "SELECT * FROM regiones WHERE ";

        // return $resultado;
    }

    /**
     * Fucnión que retorna los datos de todos los clientes existentes
     * 
     * @return array $resultado: contiene los clientes encontrados en la base de datos
     */
    private function obtenerDatosClientes()
    {
        $query = "SELECT * FROM clientes";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function buscarUsuarios($datos)
    {
        $query = "SELECT * FROM usuarios WHERE usuario LIKE '%" . $datos['valorBusqueda'] . "%'";
        $resultado = $this->row($query);
        return $resultado;
    }

    public function buscarChats($datos)
    {
        $query = "SELECT id_usuario, usuario FROM usuarios WHERE usuario LIKE '%" . $datos['valorBusqueda'] . "%'";
        $resultado['usuarios'] = $this->row($query);
        return $resultado;
    }
    /**
     * 
     * @param type $datos
     * @return type
     */
    private function obtenerCiudades($datos = array())
    {
        $query = "SELECT * FROM ciudades ORDER BY nombre ASC";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function obtenerUsuarios($datos = array())
    {
        $query = "SELECT * FROM usuarios WHERE estado = '1'";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function obtenerRoles()
    {
        $query = "SELECT * FROM roles WHERE estado = '1' ORDER BY id_rol ASC";
        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function obtenerMenus($rol = '')
    {
        $query = "SELECT * FROM menus WHERE estado = '1'";

        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function buscarMenusPermiso($datos)
    {
        $porcion = "usuario LIKE '%" . $datos['valorBusqueda'] . "%'";
        $query = "SELECT p.*, m.menu_tipo, m.menu_nombre, r.rol FROM permisos p, menus m, roles r "
            . "WHERE p.menu_idmenu = m.idmenu "
            . "AND p.roles_idroles = r.id_rol "
            . "AND m.menu_nombre LIKE '%" . $datos['valorBusqueda'] . "%'"
            . "ORDER by r.id_rol ASC";

        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function obtenerPermisosMenus()
    {
        $query = "SELECT p.*, m.menu_tipo, m.menu_nombre, r.rol FROM permisos p, menus m, roles r "
            . "WHERE p.menu_idmenu = m.idmenu "
            . "AND p.roles_idroles = r.id_rol $fragmento"
            . "ORDER by r.id_rol ASC";

        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function crearNuevoUsuario($datos = array())
    {
        date_default_timezone_set('America/Bogota');
        $date = new DateTime();
        $año = $date->format('Y');
        $password = 'Fianza' . $año . '*';
        $query = "INSERT INTO usuarios (usuario, password, nombre_completo, identificacion, "
            . "fecha_nacimiento, direccion, telefono_fijo, telefono_celular, homologado,"
            . " fecha_creacion, estado) VALUES ('" . $datos['usuario'] . "', "
            . "MD5('$password'), '" . $datos['nombre'] . "', '" . $datos['identificacion'] . "', "
            . "'" . $datos['fecha_nacimiento'] . "', '" . $datos['direccion'] . "',"
            . " '" . $datos['telefono_fijo'] . "', '" . $datos['telefono_celular'] . "',"
            . " '" . $datos['usuario_cliente'] . "', NOW(), '1')";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function creacionRegistro($datos = array())
    {
        $metodo = $datos['accion'];

        $resultado = $this->$metodo($datos);

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function creacionDemografico($datos = array())
    {
        $metodo = $datos['accion'];
        $resultado = $this->$metodo($datos);

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function crearPermiso($datos = array())
    {
        $query = "INSERT INTO permisos (menu_idmenu, roles_idroles, permiso_crear, "
            . "permiso_editar, permiso_eliminar) "
            . "VALUES ('" . $datos['menu'] . "', '" . $datos['rol'] . "', "
            . "'" . $datos['permisosCrear'] . "', '" . $datos['permisosEditar'] . "', "
            . "'" . $datos['permisosElimiar'] . "')";

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function crearRol($datos = array())
    {
        $query = "INSERT INTO roles (rol, estado) "
            . "VALUES ('" . $datos['nombre_rol'] . "', '1')";

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function obtenerPermisos($datos)
    {
        $resultado = array();
        $resultado['permisos'] = $this->obtenerPermisosUsuario($datos);
        $resultado['roles'] = $this->obtenerRoles();
        $resultado['clientes'] = $this->obtenerDatosClientes();

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function obtenerPermisosUsuario($datos)
    {

        $query = "SELECT ru.*, r.rol FROM roles_usuarios ru, roles r "
            . "WHERE ru.id_usuario = '" . $datos['usuario'] . "' "
            . "AND r.id_rol = ru.id_rol";

        $resultado = $this->row($query);
        return $resultado;
    }

    /**
     * 
     * 
     * @param type $datos
     * @return type
     */
    private function guardarPermisos($datos)
    {
        $array = array();
        $contador = 0;
        foreach ($datos['permisos'] as $permiso) {
            $array = explode(',', $permiso);
            $query = "INSERT INTO roles_usuarios (id_cliente, id_rol, id_usuario) "
                . "VALUES ('" . $array[0] . "', '" . $array[1] . "', '" . $array[2] . "')"
                . "ON DUPLICATE KEY UPDATE id_rol = '" . $array[1] . "'";
            $resultado = $this->ejecutar2($query);
            if ($resultado >= 1) {
                $contador += 1;
            }
            if ($contador >= 1 && isset($array[3])) {
                try {
                    $query = "UPDATE fianza_lida.historial_campana SET fecha_fin_campana = CURDATE() WHERE campana = '" . $array[0] . "' AND fecha_fin_campana = '' AND id_usuario = '" . $array[3] . "'";
                    $this->ejecutar2($query);
                    $query = "INSERT INTO fianza_lida.historial_campana(campana, fecha_inicio_campana, fecha_fin_campana, id_rol, observaciones, id_usuario)" .
                        "VALUES('" . $array[0] . "', CURDATE(), '', '" . $array[1] . "', '', '" . $array[3] . "') ON DUPLICATE KEY UPDATE fecha_fin_campana = '';";
                    $this->ejecutar($query);
                } catch (Exception $e) {
                    $query = "INSERT INTO fianza_lida.historial_campana(campana, fecha_inicio_campana, fecha_fin_campana, id_rol, observaciones, id_usuario)" .
                        "VALUES('" . $array[0] . "', CURDATE(), '', '" . $array[1] . "', '', '" . $array[3] . "') ON DUPLICATE KEY UPDATE fecha_fin_campana = '';";
                    $this->ejecutar($query);
                }
            }
        }

        return $contador;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function perfilUsuario($datos)
    {
        $query = "SELECT * FROM usuarios WHERE usuario = '" . $datos['usuario'] . "'";
        
        $resultado = $this->row($query);

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function actualizarInformacionPersonal($datos)
    {
        $query = "UPDATE usuarios SET "
            . "password = MD5('" . $datos['password'] . "'), "
            . "nombre_completo = '" . $datos['nombre'] . "', "
            . "identificacion = '" . $datos['identificacion'] . "', "
            . "fecha_nacimiento = '" . $datos['fecha_nacimiento'] . "' "
            . "WHERE usuario = '" . $datos['usuario'] . "'";
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function formularioEditarRegistro($datos)
    {
        $metodo = 'formulario' . ucwords($datos['tipo']);

        $resultado = $this->$metodo($datos['id']);

        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function formularioEditarUsuario($id)
    {
        $query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
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

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function editarRegistro($datos)
    {
        $resultado = $this->$datos['accion']($datos);
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function borrarRegistro($datos)
    {
        $metodo = $datos['accion'];

        $resultado = $this->$metodo($datos['id']);
        
        return $resultado;
    }

    /**
     * 
     * @param type $datos
     * @return type
     */
    private function editarUsuario($datos)
    {
        $fragmento = ($datos['cambio_contraseña'] == 'cambiar') ? "password = MD5('Fianza2017*')" : '';
        $query = "UPDATE usuarios SET identificacion = '" . $datos['identificacion'] . "', "
            . "nombre_completo = '" . $datos['nombre'] . "', "
            . "homologado = '" . $datos['usuario_cliente'] . "', "
            . "fecha_nacimiento = '" . $datos['fecha_nacimiento'] . "' $fragmento"
            . "WHERE usuario = '" . $datos['usuario'] . "'";
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }


    private function editarHomologado($datos)
    {
        switch ($datos['accion']) {
            case 'editarAccion':
                $query = "UPDATE homologado_accion SET homologado = '$datos[homologado]' WHERE id = '$datos[id]'";
                break;
            case 'editarContactos':
                $query = "UPDATE homologado_contacto SET homologado = '$datos[homologado]' WHERE id = '$datos[id]'";
                break;
            case 'editarEfectos':
                $query = "UPDATE homologado_efecto SET homologado = '$datos[homologado]' WHERE id = '$datos[id]'";
                break;
            case 'editarMotivo':
                $query = "UPDATE motivos_no_pago SET motivo = '$datos[homologado]' WHERE id = '$datos[id]'";
                break;
        }

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function borrarUsuario($id)
    {
        $query = "DELETE FROM usuarios WHERE id_usuario = '$id'";
        $resultado = $this->ejecutar2($query);
        $query = "DELETE FROM roles_usuario WHERE id_usuario = '$id'";
        $resultado = $this->ejecutar2($query);

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

    /**
     * 
     * @param type $id
     * @return type
     */
    private function borrarTarea($id)
    {
        $query = "DELETE FROM tareas WHERE id = '$id'";
        $resultado = $this->ejecutar2($query);
        $query = "DELETE FROM datos_tareas WHERE id_tarea = '$id'";
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function borrarPermiso($id)
    {
        $query = "DELETE FROM permisos WHERE idpermisos = '$id'";
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function borrarRol($id)
    {
        $query = "DELETE FROM roles WHERE id_rol = '$id'";
        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    private function crearTelefono($datos = array())
    {
        $return = array();

        $query = "INSERT IGNORE INTO telefonos (cedula_deudor, tipo_telefono, telefono  ) "
            . "VALUES ('" . $datos['identificacion'] . "', '" . $datos['tipo'] . "', "
            . "'" . $datos['telefono'] . "')";
        $return['resultado'] = $this->ejecutar2($query);

        $query = "SELECT * FROM telefonos WHERE cedula_deudor = '" . $datos['identificacion'] . "'";
        $return['datos'] = $this->row($query);

        return $return;
    }

    private function crearDireccion($datos = array())
    {
        $return = array();
        $query = "INSERT IGNORE INTO direcciones (cedula_deudor, tipo_direccion, ciudad, direccion  ) "
            . "VALUES ('" . $datos['identificacion'] . "','" . $datos['tipo'] . "','" . $datos['ciudad'] . "', "
            . "'" . $datos['direccion'] . "')";
        $return['resultado'] = $this->ejecutar2($query);

        $query = "SELECT * FROM direcciones WHERE cedula_deudor = '" . $datos['identificacion'] . "'";
        $return['datos'] = $this->row($query);
        return $return;
    }

    private function crearEmail($datos = array())
    {
        $return = array();
        $query = "INSERT IGNORE INTO correos (cedula_deudor, tipo_correo, correo  ) "
            . "VALUES ('" . $datos['identificacion'] . "', '" . utf8_decode($datos['tipo']) . "', "
            . "'" . $datos['email'] . "')";
        $return['resultado'] = $this->ejecutar2($query);

        $query = "SELECT * FROM correos WHERE cedula_deudor = '" . $datos['identificacion'] . "'";
        $return['datos'] = $this->row($query);
        return $return;
    }

    /**
     * Función que obtiene información de homologados por cartera  
     *
     * @param Type array: $datos contiene la información requerida para parametrizar las consultas
     * @return type array: $return:retorna todos los datos de las tipificaciones genericas y por cartera    
     * */
    private function crearHomologado($datos)
    {
        switch ($datos['tipo']) 
        {
            case 'accion':
                $query = "INSERT INTO homologado_accion (id_accion, homologado, id_cliente, estado)
                          VALUES ('" . $datos['id_accion'] . "', '" . $datos['homologado'] . "', '" . $datos['cartera'] . "', '1')";
                break;

            case 'contacto':
                $query = "INSERT INTO homologado_contacto (id_contacto, homologado, id_cliente, estado)
                          VALUES ('" . $datos['id_contacto'] . "', '" . $datos['homologado'] . "', '" . $datos['cartera'] . "', '1')";
                file_put_contents("/tmp/homologado.txt", $query);
                break;

            case 'efecto':
                $query = "INSERT INTO homologado_efecto (id_efecto, homologado, id_cliente, estado)
                          VALUES ('" . $datos['id_efecto'] . "', '" . $datos['homologado'] . "', '" . $datos['cartera'] . "', '1')";
                break;
            case 'motivo':
                $query = "INSERT INTO motivos_no_pago (motivo, id_cliente, estado)
                            VALUES ('" . $datos['motivo'] . "', '" . $datos['cartera'] . "', '1')";
                break;
        }

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
     * 
     * @param type $datos
     */
    private function reestablecerContraseña($datos)
    {
        $date = new DateTime();
        $año = $date->format('Y');
        $password = 'Fianza' . $año . '*';
        $query = "UPDATE usuarios SET password = MD5('$password') "
            . "WHERE id_usuario = '" . $datos['id'] . "'";
        $resultado = $this->ejecutar3($query);

        return $resultado;
    }

    /**
     * Función que crea un cliente nuevo en la BD
     * @param Array $datos arreglo con los datos de creación del cliente
     * @author Jonanthan Murcia <desarrollo@fianzaltda.com>
     */
    private function crearCliente($datos)
    {
        $query = "INSERT INTO clientes (nombre_cliente, controlador, ruta_logo, estado)
                          VALUES ('" . $datos['nombre_cliente'] . "', 'carterasController.php', '" . $datos['ruta'] . "', '1')";
        $return = $this->ejecutar2($query);
        $query = "SELECT MAX(id_cliente) as id_cliente FROM clientes";
        $cliente = $this->row($query);
        $resultado['resultado'] = ($return >= 1) ? 'ok' : 'fallo';
        $resultado['id_cliente'] = $cliente['0']['id_cliente'];
        $resultado['mensaje'] = '¡Proceso completado de forma satisfactoria!';

        return $resultado;
    }


    /**
     *
     * @param type $datos
     * @return type
     */
    private function formularioEditarDemografico($datos)
    {
        $metodo = 'formulario' . ucwords($datos['tipo']);

        $resultado = $this->$metodo($datos['id']);

        return $resultado;
    }

    private function editarEmail($datos)
    {
        $resultado = array();
        $query = "UPDATE correos SET tipo_correo = '" . utf8_decode($datos['tipo']) . "', correo = '" . $datos['correo'] . "',  estado = '" . $datos['estado'] . "'"
            . "WHERE id_correo = '" . $datos['id'] . "'";
        $resultado['respuesta'] = $this->ejecutar2($query);

        $query = "SELECT * FROM correos WHERE cedula_deudor = '" . $datos['cedula_deudor'] . "'";
        $resultado['datos'] = $this->row($query);
        return $resultado;
    }

    private function editarDireccion($datos)
    {
        $resultado = array();

        $query = "UPDATE direcciones SET tipo_direccion = '" . $datos['tipo'] . "', 
            ciudad = '" . $datos['ciudad'] . "',   estado = '" . $datos['estado'] . "'"
            . ", direccion = '" . $datos['direccion'] . "' WHERE id_direccion = '" . $datos['id'] . "'";

        $resultado['respuesta'] = $this->ejecutar2($query);

        $query = "SELECT * FROM direcciones WHERE cedula_deudor = '" . $datos['cedula_deudor'] . "'";

        $resultado['datos'] = $this->row($query);

        return $resultado;
    }

    private function editarTelefono($datos)
    {
        $resultado = array();
        
        $query = "UPDATE telefonos SET tipo_telefono = '" .$datos['tipo'] . "', telefono = '" . $datos['telefono'] . "',  estado = '" . $datos['estado'] . "', hora_disponibilidad = '".$datos['hora'].
        "' WHERE id_telefono = '" . $datos['id'] . "'";

        $resultado['respuesta'] = $this->ejecutar2($query);

        $query = "SELECT * FROM telefonos WHERE cedula_deudor = '" . $datos['cedula_deudor'] . "'";

        $resultado['datos'] = $this->row($query);

        return $resultado;
    }

    private function editarDemografico($datos)
    {
        $metodo = $datos['accion'];

        $resultado = $this->$metodo($datos);

        return $resultado;
    }

    /**
     * @
     * @param type $id
     * @return type
     */
    private function formularioEditarTelefono($id)
    {
        $query = "SELECT id_telefono, cedula_deudor, tipo_telefono AS tipo, telefono, estado FROM telefonos WHERE id_telefono = $id ORDER BY estado asc";

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

    private function codificarCaracteres($cadena)
    {
        return utf8_decode(utf8_encode($cadena));
    }
}

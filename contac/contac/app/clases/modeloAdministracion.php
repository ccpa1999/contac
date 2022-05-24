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

class modeloAdministracion extends conexion {

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
            $resultado = $this->$datos['metodo']($datos);
        }

        return $resultado;
    }

    /**
     * 
     * @return type
     */
    private function paginaInicio()
    {
        $resultado = Array();
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
        $clientesAcceso = Array();
        $i = 0;
        foreach ($_SESSION['acceso'] as $acceso) {
            $query = "SELECT * FROM clientes "
                    . "WHERE id_cliente = '" . $acceso['id_cliente'] . "'";

            $resultado = $this->row($query);
            $clientesAcceso[$i] = $resultado[0];
            $i++;
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
        $resultado = Array();
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
        $resultado = Array();
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
        $resultado = Array();
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
        $resultado = Array();
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
        $resultado = Array();
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

        return $resultado;
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
//        file_put_contents("/tmp/creacion.txt", print_r($datos, true));
        $resultado = $this->$datos['accion']($datos);
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
        $resultado = Array();
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
        $array = Array();
        $contador = 0;
        foreach ($datos['permisos'] as $permiso) {
            $array = explode(',', $permiso);
            $query = "INSERT INTO roles_usuarios (id_cliente, id_rol, id_usuario) "
                    . "VALUES ('" . $array[0] . "', '" . $array[1] . "', '" . $array[2] . "')"
                    . "ON DUPLICATE KEY UPDATE id_rol = '" . $array[1] . "'";
            $resultado = $this->ejecutar2($query);
            $contador = ($resultado >= 1) ? $contador + 1 : $contador;
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
        $resultado = $this->$datos['accion']($datos['id']);
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
        $query = "INSERT INTO telefonos (cedula_deudor, tipo_telefono, telefono, estado) "
                . "VALUES ('" . $datos['identificacion'] . "', '" . $datos['tipo'] . "', "
                . "'" . $datos['telefono'] . "', '1')";

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    private function crearDireccion($datos = array())
    {
        $query = "INSERT INTO roles (rol, estado) "
                . "VALUES ('" . $datos['nombre_rol'] . "', '1')";

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    private function crearEmail($datos = array())
    {
        $query = "INSERT INTO roles (rol, estado) "
                . "VALUES ('" . $datos['nombre_rol'] . "', '1')";

        $resultado = $this->ejecutar2($query);

        return $resultado;
    }

    /**
    * Función que obtiene información de homologados por cartera  
    *
    * @param Type array: $datos contiene la información requerida para parametrizar las consultas
    * @return type array: $return:retorna todos los datos de las tipificaciones genericas y por cartera    
    **/
    private function crearHomologado($datos)
    {
        switch ($datos['tipo']) {
            case 'accion':
                $query = "INSERT INTO homologado_accion (id_accion, homologado, id_cliente, estado)
                          VALUES ('".$datos['id_accion']."', '".$datos['homologado']."', '".$datos['cartera']."', '1')";
                break;
            
            case 'contacto':
                $query = "INSERT INTO homologado_contacto (id_contacto, homologado, id_cliente, estado)
                          VALUES ('".$datos['id_contacto']."', '".$datos['homologado']."', '".$datos['cartera']."', '1')";
                break;
                
            case 'efecto':
                $query = "INSERT INTO homologado_efecto (id_efecto, homologado, id_cliente, estado)
                          VALUES ('".$datos['id_efecto']."', '".$datos['homologado']."', '".$datos['cartera']."', '1')";
                break;    
        }
       
        $resultado = $this->ejecutar2($query);
        return $resultado;
    }

}

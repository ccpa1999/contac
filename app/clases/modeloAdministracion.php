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

class modeloAdministracion extends apicon
{

    public function __construct($datos = array())
    {
        $this->conexion();
    }

    public function controlador($datos)
    {
        $_SESSION['acceso'] = $this->obtenerAccesos();

        if (!isset($datos['metodo']))
            return;

        if ($datos['metodo'] == 'paginaInicio')
            return $this->paginaInicio();

        $resultado = '';

        for ($indice = 0; $indice < count($_SESSION['acceso']); $indice++) {
            if ($_SESSION['acceso'][$indice]['cliente_id'] == $_SESSION['carteraActual']) {
                $metodo = $datos['metodo'];
                $resultado = $this->$metodo($datos);

                break;
            }

            if ($indice == count($_SESSION['acceso']) - 1) {
                header('Location: administracionController.php?&metodo=paginaInicio');
                die();
            }
        }

        return $resultado;
    }

    public function obtenerAccesos()
    {
        if ($_SESSION['admin'] != 1) {
            $query = "SELECT ru.*, r.nombre rol, a.nombre FROM `usuarios` as u 
                INNER JOIN role_usuario as ru ON u.id = ru.usuario_id 
                INNER JOIN clientes as c ON ru.cliente_id = c.id 
                INNER JOIN roles as r ON r.id = ru.role_id 
                INNER JOIN aplicaciones as a ON a.id = r.aplicacion_id 
                WHERE a.nombre = 'contac' and u.id = '$_SESSION[id]' and ru.usuario_id = '$_SESSION[id]';";
        } else {
            $query = "SELECT u.id usuario_id, c.id cliente_id FROM usuarios u INNER JOIN clientes c WHERE u.id = '$_SESSION[id]' ORDER BY c.id ASC;";
        }
        $accesos = $this->obtener($query);
        return $accesos;
    }

    private function paginaInicio()
    {
        $resultado = array();
        $resultado['clientes'] = $this->obtenerClientesAcceso();
        return $resultado;
    }

    /**********************************************************************MODULOS*********************************************************************************************/

    private function obtenerModulo($datos)
    {
        $tipo = $datos['tipo'];
        $data = $this->$tipo($datos);
        return $data;
    }

    // private function administracionClientes($datos = array())
    // {
    //     $resultado = array();
    //     $resultado['clientes'] = $this->obtenerDatosClientes('todos');

    //     return $resultado;
    // }

    // private function administracionUsuarios($datos = array())
    // {
    //     $resultado = array();
    //     $resultado['usuarios'] = $this->obtenerUsuarios();
    //     $resultado['roles'] = $this->obtenerRoles();

    //     return $resultado;
    // }

    // private function administracionRoles($datos = array())
    // {
    //     $resultado = array();
    //     $resultado['roles'] = $this->obtenerRoles();
    //     $resultado['menus'] = $this->obtenerMenus();

    //     return $resultado;
    // }

    // private function administracionPermisos($datos = array())
    // {
    //     $resultado = array();
    //     $resultado['menus'] = $this->obtenerMenus();
    //     $resultado['roles'] = $this->obtenerRoles();
    //     $resultado['permisos'] = $this->obtenerPermisosMenus();

    //     return $resultado;
    // }

    // private function obtenerPermisos($datos)
    // {
    //     $resultado = array();
    //     $resultado['permisos'] = $this->obtenerPermisosUsuario($datos);
    //     $resultado['roles'] = $this->obtenerRoles();
    //     $resultado['clientes'] = $this->obtenerDatosClientes('activos');
    //     return $resultado;
    // }

    /**********************************************************************CREACIÓN*********************************************************************************************/

    private function crearRegistro($datos)
    {
        $tipo = $datos['tipo'];
        $respuesta = $this->$tipo($datos);
        return $respuesta;
    }

    // private function crearCliente($datos)
    // {
    //     $ruta = '../../public/images/logos_clientes/' . $datos['nombre_cliente'] . '.png';
    //     if ($_FILES['archivo']['tmp_name'] != '') {
    //         copy($_FILES['archivo']['tmp_name'], $ruta);
    //     }
    //     $datos['ruta'] = '/logos_clientes/' . $datos['nombre_cliente'] . '.png';
    //     $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
    //     $query = "INSERT INTO clientes (id_cliente, nombre_cliente, controlador, ruta_logo, estado)
    //                       VALUES ($id, '" . $datos['nombre_cliente'] . "', 'carterasController.php', '" . $datos['ruta'] . "', '1')
    //                       ON DUPLICATE KEY UPDATE nombre_cliente = '" . $datos['nombre_cliente'] . "', ruta_logo = '" . $datos['ruta'] . "'";
    //     $return = $this->ejecutar2($query);
    //     if ($return > 0) {
    //         $query = "SELECT MAX(id_cliente) as id_cliente FROM clientes";
    //         $cliente = $this->row($query);
    //         if (!empty($cliente['id_cliente'])) {
    //             $this->crearRutas($cliente['id_cliente']);
    //         }
    //     }
    //     $resultado['resultado'] = 'ok';
    //     $resultado['mensaje'] = '¡Proceso completo de forma satisfactoria!';
    //     return $resultado;
    // }

    private function crearRutas($id)
    {
        $rutas = array(
            'descargas' => '../../public/archivos/descargas/' . $id . '/',
            'informes' => '../../public/archivos/descargas/' . $id . '/informes/'
        );

        foreach ($rutas as $ruta) {
            if (!is_dir($ruta)) {
                mkdir($ruta, 0777);
            }
        }
    }

    // private function crearNuevoUsuario($datos = array())
    // {
    //     $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
    //     date_default_timezone_set('America/Bogota');
    //     $date = new DateTime();
    //     $año = $date->format('Y');
    //     $password = 'Fianza' . $año . '*';
    //     $fragmento = (isset($datos['cambio_contraseña']) && $datos['cambio_contraseña'] == 'cambiar') ? ", password = md5('$password')" : '';
    //     $query = "INSERT INTO usuarios (id_usuario, usuario, password, nombre_completo, identificacion, "
    //         . "fecha_nacimiento, direccion, telefono_fijo, telefono_celular, homologado,"
    //         . " fecha_creacion, estado) VALUES ($id,'" . $datos['usuario'] . "', "
    //         . "MD5('$password'), '" . $datos['nombre'] . "', '" . $datos['identificacion'] . "', "
    //         . "'" . $datos['fecha_nacimiento'] . "', '" . $datos['direccion'] . "',"
    //         . " '" . $datos['telefono_fijo'] . "', '" . $datos['telefono_celular'] . "',"
    //         . " '" . $datos['usuario_cliente'] . "', NOW(), '1')
    //         ON DUPLICATE KEY UPDATE nombre_completo = '$datos[nombre]', identificacion = '$datos[identificacion]',
    //         fecha_nacimiento = '$datos[fecha_nacimiento]' $fragmento";
    //     $result = $this->ejecutar2($query);
    //     $resultado['resultado'] = 'ok';
    //     $resultado['mensaje'] = '¡Proceso completo de forma satisfactoria!';
    //     return $resultado;
    // }

    // private function crearRol($datos = array())
    // {
    //     $id = (isset($datos['id']) && $datos['id'] != '') ? $datos['id'] : 'NULL';
    //     $query = "INSERT INTO roles (id_rol,rol, estado) "
    //         . "VALUES ($id,'" . $datos['nombre_rol'] . "', '1')
    //         ON DUPLICATE KEY UPDATE rol = '" . $datos['nombre_rol'] . "';";
    //     $result = $this->ejecutar2($query);
    //     $resultado['resultado'] = 'ok';
    //     $resultado['mensaje'] = '¡Proceso completo de forma satisfactoria!';
    //     return $resultado;
    // }

    // private function crearPermiso($datos = array())
    // {
    //     $query = "INSERT INTO permisos (menu_idmenu, roles_idroles, permiso_crear, "
    //         . "permiso_editar, permiso_eliminar) "
    //         . "VALUES ('" . $datos['menu'] . "', '" . $datos['rol'] . "', "
    //         . "'" . $datos['permisosCrear'] . "', '" . $datos['permisosEditar'] . "', "
    //         . "'" . $datos['permisosElimiar'] . "')";

    //     $result = $this->ejecutar2($query);
    //     $resultado['resultado'] = 'ok';
    //     $resultado['mensaje'] = '¡Proceso completo de forma satisfactoria!';
    //     return $resultado;
    // }

    // private function guardarPermisos($datos)
    // {
    //     $array = array();
    //     $contador = 0;
    //     foreach ($datos['permisos'] as $permiso) {
    //         $array = explode(',', $permiso);
    //         $query = "INSERT INTO roles_usuarios (id_cliente, id_rol, id_usuario) "
    //             . "VALUES ('" . $array[0] . "', '" . $array[1] . "', '" . $array[2] . "')"
    //             . "ON DUPLICATE KEY UPDATE id_rol = '" . $array[1] . "'";
    //         $resultado = $this->ejecutar2($query);
    //         if ($resultado >= 1) {
    //             $contador += 1;
    //         }
    //         if ($contador >= 1 && isset($array[3])) {
    //             try {
    //                 $query = "UPDATE fianza_lida.historial_campana SET fecha_fin_campana = CURDATE() WHERE campana = '" . $array[0] . "' AND fecha_fin_campana = '' AND id_usuario = '" . $array[3] . "'";
    //                 $this->ejecutar2($query);
    //                 $query = "INSERT INTO fianza_lida.historial_campana(campana, fecha_inicio_campana, fecha_fin_campana, id_rol, observaciones, id_usuario)" .
    //                     "VALUES('" . $array[0] . "', CURDATE(), '', '" . $array[1] . "', '', '" . $array[3] . "') ON DUPLICATE KEY UPDATE fecha_fin_campana = '';";
    //                 $this->ejecutar($query);
    //             } catch (Exception $e) {
    //                 $query = "INSERT INTO fianza_lida.historial_campana(campana, fecha_inicio_campana, fecha_fin_campana, id_rol, observaciones, id_usuario)" .
    //                     "VALUES('" . $array[0] . "', CURDATE(), '', '" . $array[1] . "', '', '" . $array[3] . "') ON DUPLICATE KEY UPDATE fecha_fin_campana = '';";
    //                 $this->ejecutar($query);
    //             }
    //         }
    //     }

    //     return $contador;
    // }

    // private function actualizarInformacionPersonal($datos)
    // {
    //     $query = "UPDATE usuarios SET "
    //         . "password = MD5('" . $datos['password'] . "'), "
    //         . "nombre_completo = '" . $datos['nombre'] . "', "
    //         . "identificacion = '" . $datos['identificacion'] . "', "
    //         . "fecha_nacimiento = '" . $datos['fecha_nacimiento'] . "' "
    //         . "WHERE usuario = '" . $datos['usuario'] . "'";
    //     $resultado = $this->ejecutar2($query);
    //     return $resultado;
    // }

    /**********************************************************************EDICIÓN*********************************************************************************************/

    // private function formularioEditarRegistro($datos)
    // {
    //     $metodo = 'formulario' . ucwords($datos['tipo']);
    //     $resultado = $this->$metodo($datos['id']);
    //     return $resultado;
    // }

    // private function formularioEditarCliente($id)
    // {
    //     $query = "SELECT * FROM clientes WHERE id_cliente = '$id'";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function formularioEditarRoles($id)
    // {
    //     $query = "SELECT * FROM roles WHERE id_rol = '$id'";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function formularioEditarUsuario($id)
    // {
    //     $query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    /**********************************************************************ELIMINACIÓN*********************************************************************************************/

    private function borrarRegistro($datos)
    {
        $metodo = $datos['accion'];
        $resultado = $this->$metodo($datos['id']);
        return $resultado;
    }

    // private function borrarCliente($id)
    // {
    //     $query = "SELECT estado FROM clientes WHERE id_cliente = '$id'";
    //     $estado = $this->row($query)[0]['estado'];
    //     $estado = ($estado === '0') ? '1' : '0';
    //     $query = "UPDATE clientes SET estado = $estado WHERE id_cliente = '$id'";
    //     $resultado = $this->ejecutar2($query);

    //     return $resultado;
    // }

    // private function borrarUsuario($id)
    // {
    //     $query = "DELETE FROM usuarios WHERE id_usuario = '$id'";
    //     $resultado = $this->ejecutar2($query);
    //     $query = "DELETE FROM roles_usuarios WHERE id_usuario = '$id'";
    //     $resultado = $this->ejecutar2($query);
    //     return $resultado;
    // }

    // private function borrarRol($id)
    // {
    //     $query = "DELETE FROM roles WHERE id_rol = '$id'";
    //     $resultado = $this->ejecutar2($query);

    //     return $resultado;
    // }

    /**********************************************************************OBTENER*********************************************************************************************/

    private function obtenerClientesAcceso()
    {
        $clientesAcceso = array();
        $i = 0;
        $cant = count($_SESSION['acceso']);
        foreach ($_SESSION['acceso'] as $acceso) {
            $query = "SELECT * FROM clientes "
                . "WHERE id = '" . $acceso['cliente_id'] . "' AND estado = 1";
            $resultado = $this->obtener($query);
            $clientesAcceso[$i] = (isset($resultado[0])) ? $resultado[0] : '';
            $i++;
        }
        if ($cant >= 1 && $i == $cant) {
            return $clientesAcceso;
        }
    }

    // private function obtenerMenus($rol = '')
    // {
    //     $query = "SELECT * FROM menus WHERE estado = '1'";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function obtenerDatosClientes($estado)
    // {
    //     $fragmento = ($estado == 'activos') ? 'WHERE estado = 1' : '';
    //     $query = "SELECT * FROM clientes $fragmento";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function obtenerUsuarios($datos = array())
    // {
    //     $query = "SELECT * FROM usuarios WHERE estado = '1'";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function obtenerRoles()
    // {
    //     $query = "SELECT * FROM roles WHERE estado = '1' ORDER BY id_rol ASC";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function obtenerPermisosMenus()
    // {

    //     $query = "SELECT p.*, m.menu_tipo, m.menu_nombre, r.rol FROM permisos p, menus m, roles r "
    //         . "WHERE p.menu_idmenu = m.idmenu "
    //         . "AND p.roles_idroles = r.id_rol "
    //         . "ORDER by r.id_rol ASC";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function buscarUsuarios($datos)
    // {
    //     $query = "SELECT * FROM usuarios WHERE usuario LIKE '%" . $datos['valorBusqueda'] . "%' OR identificacion LIKE '%" . $datos['valorBusqueda'] . "%' OR nombre_completo LIKE '%" . $datos['valorBusqueda'] . "%'";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // public function buscarChats($datos)
    // {
    //     $query = "SELECT id_usuario, usuario FROM usuarios WHERE usuario LIKE '%" . $datos['valorBusqueda'] . "%'";
    //     $resultado['usuarios'] = $this->row($query);
    //     return $resultado;
    // }

    // private function obtenerPermisosUsuario($datos)
    // {

    //     $query = "SELECT ru.*, r.rol FROM roles_usuarios ru, roles r "
    //         . "WHERE ru.id_usuario = '" . $datos['usuario'] . "' "
    //         . "AND r.id_rol = ru.id_rol";
    //     $resultado = $this->row($query);
    //     return $resultado;
    // }

    // private function perfilUsuario($datos)
    // {
    //     $query = "SELECT * FROM usuarios WHERE usuario = '" . $datos['usuario'] . "'";
    //     $resultado = $this->row($query);

    //     return $resultado;
    // }

    private function validarCredenciales($datos)
    {
        $query = "SELECT id, usuario, password FROM usuarios WHERE usuario = '" . $_SESSION['usuario'] . "'";
        $resultado = $this->obtener($query);

        if (password_verify($datos['password'], $resultado[0]['password']))
            return 1;
        else
            return 0;
    }
}

<?php
    foreach ($_SESSION['acceso'] as $acceso) {
        $permiso = ($acceso['id_rol'] == 1) ? true : false;
    }

    if ($modulo == 'administración' && $permiso == true) :
?>
    <ul class="nav nav-pills nav-stacked custom-nav">
        <!--<li><a href="../../app/controllers/administracionController.php"><i class="glyphicon glyphicon-briefcase"></i> <span>Carteras</span></a></li>-->
        <li class="accionCarteras"><a href="#"><i class="glyphicon glyphicon-briefcase"></i> <span>Carteras</span></a></li>
        <li class="accionDashboard"><a href="#"><i class="fa fa-pie-chart"></i><span>Dashboard</span></a></li>
        <li class="menu-list" id="accionAdministracion">
            <a href="#"><i class="fa fa-cogs"></i>
                <span>Administración</span></a>
            <ul class="sub-menu-list">
                <li id="accionClientes"><a href="#">Clientes</a> </li>
                <li id="accionUsuarios"><a href="#">Usuarios</a> </li>
                <li id="accionRoles"><a href="#">Roles</a> </li>
                <li id="accionPermisos"><a href="#">Permisos</a> </li>
                <li id="accionregiones"><a href="#">Regiones</a> </li>
                <li id="accionDepartamentos"><a href="#">Departamentos</a> </li>
                <li id="accionCiudades"><a href="#">Ciudades</a> </li>
            </ul>
        </li>
    </ul>
<?php elseif ($modulo == 'cartera') : ?>
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="accionExportarDemografico" data-cartera="<?php echo $cartera; ?>"><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>Fianza</span></a></li>
        <?php if ($_SESSION['carteraActual'] == '13') : ?>
            <li class="accionBuscarDeudoresEdad" data-cartera="<?php echo $cartera; ?>"><a href="#"><i class="fa fa-address-card-o"></i><span>Buscar Deudores</span></a></li>
        <?php endif; ?>
        <li class="accionBuscarDeudores" data-cartera="<?php echo $cartera; ?>"><a href="#"><i class="fa fa-user-circle-o"></i><span><?php echo $buscar = ($_SESSION['carteraActual'] != '13') ? 'Buscar Deudores' : 'Buscar Deudores general'; ?></span></a></li>
        <?php if ($_SESSION['rol_actual'] != '4') : ?>
            <li class="accionInformes"><a href="#"><i class="fa fa-line-chart"></i><span>Informes Cartera</span></a></li>
        <?php endif; ?>
        <li><a href="../../app/controllers/carterasController.php?&cartera=<?php echo $cartera; ?>"><i class="fa fa-bank"></i><span>Gestionar</span></a></li>
        <?php if ($_SESSION['rol_actual'] != '4') : ?>
            <li class="menu-list" id="accionAdministracionCartera">
                <a href="#"><i class="fa fa-cog"></i>
                    <span>Administración</span></a>
                <ul class="sub-menu-list">
                    <li id="accionTareas"><a href="#">Panel Tareas</a></li>
                    <li id="accionArbol"><a href="#">Árbol de Decisión</a> </li>
                    <li id="accionConfiguracionCartera"><a href="#">Configuración Campaña</a> </li>
                    <!--<li id="accionClientes"><a href="#">Arbol de Decisión</a> </li>-->
                    <li class="accionCargar"><a href="#">Cargar</a></li>
                    <li>
                        <?php if ($_SESSION['carteraActual'] == 13) : ?>
                            <a class="accionAsignarEdadMora" href="#">Asignar edad mora</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

    </ul>
    <?php if ($_SESSION['carteraActual'] == 2) : ?>
    <ul class="SuperInicio nav nav-pills nav-stacked custom-nav">
        <li class="menu-list">
            <a href="#" class="btnCalculadora" title="Calculadora">
                <i class="fa fa-calculator"></i><span>Calculadora</span>
            </a>
        </li>
    </ul>
    <?php endif;?>
    <!-- CAPACITACION -->
<?php elseif ($modulo == 'capacitacion') : ?>
    <ul class="SuperInicio nav nav-pills nav-stacked custom-nav">
        <li class="accionInicioCapacitacion"><a href="#"><i class="fa fa-graduation-cap"></i><span>Capacitación</span></a></li>
        <li class="accionInicioPrueba"><a href="#"><i class="fa fa fa-pencil"></i><span>Examen</span></a></li>
        <?php if ($_SESSION['rol_actual'] == '7' || $_SESSION['rol_actual'] == '1') : ?>
            <li class="accionInformesCapacitacion"><a href="#"><i class="fa fa-pie-chart"></i><span>Informes</span></a></li>
            <li class="menu-list" id="accionAdminCapacitacion">
                <a href="#"><i class="fa fa-cogs"></i>
                    <span>Administración</span></a>
                <ul class="sub-menu-list">
                    <li id="accionCapacitacion"><a href="#">Gestion Capacitaciones</a></li>
                    <li id="accionPreguntas"><a href="#">Preguntas</a></li>
                    <li id="accionCertificado"><a href="#">Certificar</a></li>
                    <?php if ($_SESSION['rol_actual'] == '1') : ?>
                        <li id="accionUsuariosCap"><a href="#">Capacitadores Autorizados</a></li>
                        <li id="accionCargarTipo"><a href="#">Cargar Tipo</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif ?>
    </ul>
<?php endif; ?>
<ul class="SuperInicio nav nav-pills nav-stacked custom-nav">
    <li class="menu-list">
        <a href="#" class="btnChat" title="Chat Fianza">
            <i class="fa fa-comments-o"></i><span>Chat Fianza</span>
        </a>
        <span class="badge badge-primary" id="notify" style="display:none;"></span>
    </li>
</ul>
<!--<ul class="SuperInicio nav nav-pills nav-stacked custom-nav">
    <li class="menu-list">
        <a href="#" class="btnSoporte" title="Botón de soporte">
            <i class="fa fa-question-circle-o"></i><span>Soporte</span>
        </a>
    </li>
</ul>-->
<!-- FIN DE CAPACITACION -->
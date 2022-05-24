<?php if ($modulo == 'administración'): ?>
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
<?php elseif ($modulo == 'cartera'): ?>
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="accionBuscarDeudores" data-cartera="<?php echo $cartera; ?>"><a href="#"><i class="fa fa-user-circle-o"></i><span>Buscar Deudores</span></a></li>
        <?php if ($_SESSION['rol_actual'] != '4'): ?>
            <li class="accionInformes"><a href="#"><i class="fa fa-line-chart"></i><span>Informes Cartera</span></a></li>
        <?php endif; ?>
        <li><a href="../../app/controllers/carterasController.php?&cartera=<?php echo $cartera; ?>"><i class="fa fa-bank"></i><span>Gestionar</span></a></li>
        <?php if ($_SESSION['rol_actual'] != '4'): ?>
            <li class="menu-list" id="accionAdministracionCartera">
                <a href="#"><i class="fa fa-cog"></i>
                    <span>Administración</span></a>
                <ul class="sub-menu-list">
                    <li id="accionTareas"><a href="#">Panel Tareas</a></li>
                    <li id="accionClientes"><a href="#">Arbol de Decisión</a> </li>
                    <li id="accionConfiguracionCartera"><a href="#">Configuración Campaña</a> </li>
                    <!--<li id="accionClientes"><a href="#">Arbol de Decisión</a> </li>-->
                    <li class="accionCargar"><a href="#">Cargar</a></li>
                    
                </ul>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<!-- 
    +---------+
    | SIDEBAR |
    +---------+
-->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel" style="width: 250px;">
    <div class="offcanvas-header">
        <div class="container">
            <div class="row d-flex justify-content-end small-font">
                <button type="button" class="btn-close text-reset float-end align-self-baseline" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-auto">
                    <a href="administracionController.php">
                        <img src="../../public/images/logo_fianza-01 banner.png" class="img-responsive mx-auto">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas-body bg-dark px-0">
        <div class="anchura-max">
            <?php if ($modulo == 'cartera') : ?>
                <a href="#" class="button item-sb" data-controlador="carterasController" data-metodo="moduloCalendario">
                    <i class="fa fa-calendar" aria-hidden="true"></i><span> Calendario</span>
                </a>
                <?php if (strpos(ucwords($_SESSION['rol_actual']), "Asesor") === false) : ?>
                    <a href="#" class="button item-sb" data-controlador="carterasController" data-metodo="moduloScoring">
                        <i class="fa fa-line-chart" aria-hidden="true"></i><span> Scoring</span>
                    </a>
                    <a href="#" class="button item-sb" data-controlador="carterasController" data-metodo="moduloRanking">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i><span> Ranking</span>
                    </a>
                <?php endif; ?>

                <a href="#" class="item-sb accionExportarDemografico" data-cartera="<?= $cartera; ?>">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i><span> Fianza</span>
                </a>

                <?php if ($_SESSION['carteraActual'] == '13') : ?>
                    <a href="#" class="accionBuscarDeudoresEdad item-sb" data-cartera="<?= $cartera; ?>">
                        <i class="fa fa-address-card-o"></i><span> Buscar Deudores</span>
                    </a>
                <?php endif; ?>

                <?php if ($_SESSION['carteraActual'] == '19') : ?>
                    <a href="#" class="button accionSolicitudes item-sb" data-cartera="<?= $cartera; ?>" data-controlador="carterasController" data-metodo="formulariosSolicitudes">
                        <i class="fa fa-address-book"></i><span> Solicitudes de envío</span>
                    </a>
                <?php endif; ?>

                <?php if (strpos(ucwords($_SESSION['rol_actual']), "Asesor") === false) : ?>
                    <a href="#" class="button accionInformes item-sb" data-controlador="carterasController" data-metodo="administracionInformes"><i class="fa fa-line-chart"></i><span> Informes Cartera</span></a>
                <?php endif; ?>

                <a onclick="location.reload()" href="#" class="item-sb">
                    <i class="fa fa-bank"></i><span> Gestionar</span>
                </a>

                <?php if (strpos(ucwords($_SESSION['rol_actual']), "Asesor") === false) : ?>
                    <!-- 
                        +------------------+
                        | Dropdown del nav |
                        +------------------+
                    -->
                    <div class="dropdown" id="accionAdministracionCartera">
                        <a href="#" class="dropdown-toggle item-sb" id="Dropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <i class="fa fa-cog"></i>
                            <span>Administración</span>
                        </a>

                        <ul class="dropdown-menu ms-1" aria-labelledby="Dropdown">
                            <?php if ($_SESSION['carteraActual'] == 13) : ?>
                                <li class="button dropdown-item" data-controlador="carterasController" data-metodo="panelAsignacionMora"><a href="#" class="dropdown-item">Asignar edad mora</a></li>
                            <?php endif; ?>

                            <li class="button dropdown-item" data-controlador="carterasController" data-metodo="administracionArbol"><a href="#" class="dropdown-item">Árbol de Decisión</a> </li>
                            <li class="button dropdown-item" data-controlador="carterasController" data-metodo="administracionCarga"><a href="#" class="dropdown-item">Cargar</a></li>
                            <li class="button dropdown-item" data-controlador="carterasController" data-metodo="administracionCartera"><a href="#" class="dropdown-item">Configuración Campaña</a> </li>
                            <li class="button dropdown-item" data-controlador="carterasController" data-metodo="administracionTareas"><a href="#" class="dropdown-item">Panel Tareas</a></li>

                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($_SESSION['carteraActual'] == 2) : ?>
                    <a href="#" class="btnCalculadora item-sb" title="Calculadora"><i class="fa fa-calculator"></i><span> Calculadora</span></a>
                <?php endif; ?>

                <!-- CAPACITACION -->
            <?php elseif ($modulo == 'capacitacion') : ?>
                <ul class="SuperInicio nav nav-pills nav-stacked custom-nav">
                    <li class="accionInicioCapacitacion mb-2"><a href="#"><i class="fa fa-graduation-cap"></i><span>Capacitación</span></a></li>
                    <li class="accionInicioPrueba mb-2"><a href="#"><i class="fa fa fa-pencil"></i><span>Examen</span></a></li>

                    <?php if (strpos(ucwords($_SESSION['rol_actual']), "Asesor") === false) : ?>
                        <li class="accionInformesCapacitacion mb-2"><a href="#"><i class="fa fa-pie-chart"></i><span>Informes</span></a></li>

                        <li class="menu-list mb-2" id="accionAdminCapacitacion">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span>Administración</span>
                            </a>

                            <ul class="sub-menu-list">
                                <li id="accionCapacitacion"><a href="#">Gestion Capacitaciones</a></li>
                                <li id="accionPreguntas"><a href="#">Preguntas</a></li>
                                <li id="accionCertificado"><a href="#">Certificar</a></li>

                                <?php if (strpos(ucwords($_SESSION['rol_actual']), "Asesor") !== false) : ?>
                                    <li id="accionUsuariosCap"><a href="#">Capacitadores Autorizados</a></li>
                                    <li id="accionCargarTipo"><a href="#">Cargar Tipo</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
                <!-- FIN DE CAPACITACION -->
            <?php endif; ?>

            <a href="http://<?= $_SERVER['REMOTE_ADDR'] ?>/chat_contac/public/autenticar/" class="btnChat mt-5 item-sb" target="_blank" title="Chat Fianza">
                <i class="fa fa-comments-o"></i> Chat Fianza
                <span id="notify" class="badge bg-danger" style="display: none;"></span>
            </a>
        </div>
    </div>
</div>
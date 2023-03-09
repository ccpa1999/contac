<!-- 
    +------------------------+
    | MENÚ SUPERIOR (NAVBAR) |
    +------------------------+
 -->
<div class="navbar navbar-expand-xl navbar-dark border-bottom border-3 shadow sticky-top menu-superior">
    <div class="container-fluid">
        <!-- 
            +++++++++++++++++++++++++++++++++++
            + BOTÓN PARA DESPLEGAR EL SIDEBAR +
            +++++++++++++++++++++++++++++++++++
        -->
        <button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
            <i class="fa fa-bars"></i>
        </button>

        <ul class="nav">
            <?php if ($modulo == 'cartera') : ?>
                <li class="nav-item dropdown item-menu">
                    <a href="#" class="nav-link dropdown-toggle link-menu" id="Dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>

                        <span class="position-absolute translate-middle badge rounded-pill bg-primary" id="spanCantidadNotificaciones" style="display:none;">
                            <div id="badgeCantidadNotificaciones"></div>
                        </span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="Dropdown">
                        <li>
                            <h3 class="dropdown-header">Notificaciones</h3>
                        </li>

                        <div id="resultadoAlarmas"></div>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="notification_bottom"><a href="#" class="dropdown-item">Ver todas las notificaciones</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown item-menu">
                    <a href="#" class="nav-link dropdown-toggle link-menu" id="dropdownTareas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-tasks"></i>
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger" id="spanCantidadTareas" style="display:none;">
                            <div id="badgeCantidadTareas"></div>
                        </span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownTareas">
                        <li>
                            <h3 class="dropdown-header">Tareas</h3>
                        </li>

                        <div id="divListadoTareas"></div>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="#" class="dropdown-item">Ver todas las tareas</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link link-menu" id="launchPhone"><i class="fa fa-phone"></i></a>
                </li>

                <li class="nav-item">
                    <a href="#" class="button nav-link link-menu" title="Mi Productividad" data-controlador="carterasController" data-metodo="moduloRanking">
                        <i class="fa fa-pie-chart"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle link-menu" id="pausasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-hourglass"></i>
                        <span class="badge blue1"></span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="pausasDropdown">
                        <li>
                            <h3 class="dropdown-header">Pausas</h3>
                        </li>

                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="almuerzo" data-label="Almuerzo">Almuerzo</a></li>
                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="agua" data-label="Agua">Agua</a></li>
                        <li>
                            <a href="#" class="notification_desc pausa dropdown-item" data-pausa="auditoria_formacion" data-label="Auditoría Formación">
                                Auditoría Formación
                            </a>
                        </li>
                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="bano" data-label="Baño">Baño</a> </li>
                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="break" data-label="Break">Break</a></li>
                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="pausas_activas" data-label="Pausas Activas">Pausas Activas</a></li>
                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="reunion" data-label="Reunión">Reunión</a></li>
                        <li><a href="#" class="notification_desc pausa dropdown-item" data-pausa="tarea_especial" data-label="Tarea Especial">Tarea Especial</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="#" class="notification_bottom dropdown-item">Ver todas las pausas</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if ($modulo == 'cartera') : ?>
                <li class="nav-item">
                    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/login/public/storage/<?= $logoCarteraActual; ?>" width="140" height="44" class="navbar-brand">
                </li>
            <?php endif; ?>
        </ul>

        <button class="navbar-toggler dropdown-toggle button-navbar fs-5 pb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            Menú
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- 
                    +----------------------------------+
                    | FORMULARIO DE BUSQUEDA DE DATOS |
                    +----------------------------------+
                -->
                <?php if ($modulo == 'cartera') :  ?>
                    <li class="nav-item mx-md-auto mt-sm-1 mt-xl-0">
                        <form id="formularioBusquedaDeudores" class="busquedaDeudor d-flex" method="POST" action="javascript:void(0);">
                            <div class="row text-light">
                                <div class="col-auto mb-1">
                                    <label for="tipo" class="col-form-label">Tipo Busqueda: </label>
                                </div>

                                <div class="col-auto mb-1">
                                    <select class="form-select" id="tipo" name="tipo">
                                        <option value="cedula">Documento</option>
                                        <option value="numero_obligacion">Obligación</option>
                                        <option value="telefono">Teléfono</option>
                                    </select>
                                </div>

                                <div class="col-auto mb-1">
                                    <label for="datoBusqueda" class="col-form-label">Dato: </label>
                                </div>

                                <div class="col-auto mb-1">
                                    <input type="text" required id="datoBusqueda" name="datoBusqueda" placeholder="Parámetro de Busqueda" class="form-control">
                                </div>

                                <div class="col-auto mb-1">
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                            </div>

                            <input type="hidden" name="metodo" value="buscarDeudor">
                            <input type="hidden" name="cartera" value="<?= $cartera; ?>">
                        </form>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- 
                +---------------------------------------+
                | BOTÓN PARA CERRAR SESIÓN O VER PERFIL |
                +---------------------------------------+
            -->
            <div class="d-flex flex-row-reverse ms-auto">
                <div class="dropdown dropstart">
                    <button href="#" class="dropdown-toggle text-light btn fs-" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['usuario']; ?>
                        <i class="fa fa-user-circle-o"></i>
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li>
                            <a href="#" id="accionPerfil" class="dropdown-item" data-usuario="<?= $_SESSION['usuario'] ?>"><i class="fa fa-user"></i> Perfil</a>
                        </li>

                        <li>
                            <!-- <form method="POST" action="http://<?= $_SERVER['HTTP_HOST'] ?>/backendfianza/public/api/logout/"> -->
                                <input type="hidden" id="_token" name="_token" value="<?= $_SESSION['_token'] ?>">

                            <!-- </form> -->
                            <a class="dropdown-item" id="salir" href="../../sesion.php" onclick="event.preventDefault();">
                                <i class="fa fa-sign-out"></i> Salir
                            </a>
                            <!-- <a class="dropdown-item" href="../../sesion.php" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa fa-sign-out"></i> Salir
                            </a> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
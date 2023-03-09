<!DOCTYPE html>
<html>

<head>
    <title>FIANZA LTDA</title>
    <link rel="icon" type="image/x-icon" href="../../favicon.ico.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
            Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- >>>> Estilos DataTables <<<<< -->
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css">

    <!--
        +-------------+
        | BOOTSTRAP 5 |
        +-------------+
    -->
    <link href="../../public/css/bootstrap.min.css" rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap-icons-1.10.2/bootstrap-icons.css">

    <!-- >>>> Estilos FullCalendar <<<<< -->
    <link rel="stylesheet" href="../../public/css/main.min.css">


    <link href="../../public/css/bootstrap-datepicker.min.css" rel='stylesheet' type='text/css' />
    <link href="../../public/css/jquery-confirm.css" rel='stylesheet' type='text/css' />

    <link href="../../public/css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../public/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../public/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/icon-font.min.css" type='text/css' />
    <!-- <link href="../../public/css/animate.css" rel="stylesheet" type="text/css" media="all"> -->
    <link href="../../public/css/fileinput.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../vendor/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../public/librerias/jquery-toggles-master/css/toggles-full.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../public/css/capacitacionStyle.css" rel="stylesheet" type="text/css" />

    <!-- CAPACITACION -->
    <link rel="stylesheet" href="../../public/css/bootstrap-select.min.css">

    <!-- Fin de CAPACITACION -->
</head>

<?php
//session_start();
if (isset($_SESSION['_token'])) :
?>
    <audio id="chatAudio">
        <source src="../../public/sonido/notify.mp3" type="audio/mpeg">
        <source src="notify.wav" type="audio/wav">
    </audio>

    <body class="left-side-collapsed">
        <div style="width: 100%;">
            <div class="main-content mb-5">
                <!-- 
                    +---------------------------+
                    | INSERTAR EL MENÚ SUPERIOR |
                    +---------------------------+
                -->
                <?php
                $this->insert(
                    'navbar.html',
                    [
                        'modulo' => $modulo,
                        'cartera' => ($carteraActual ?? ''),
                        'logoCarteraActual' => $logoCarteraActual ?? '',
                        'cliente' => $cliente ?? ''
                    ]
                );
                ?>

                <!-- 
                    +---------------------+
                    | INSERTAR EL SIDEBAR |
                    +---------------------+
                -->
                <?php $this->insert('menus.html', ['modulo' => $modulo, 'cartera' => ($carteraActual ?? '')]); ?>

                <?php if (isset($carteraActual)) : ?>
                    <input type="hidden" id="carteraActual" value="<?= $carteraActual; ?>">
                    <input type="hidden" id="rolActual" value="<?= $_SESSION['rol_actual']; ?>">
                <?php endif; ?>

                <input type="hidden" id="estadoPausa" value="0">

                <div id="divLogoCartera" style="position: absolute; bottom: 10%; right: 3%; z-index: 1000"></div>

                <div id="divCargando" class="success" style="display: none; position: absolute; bottom: 50%; right: 50%; z-index: 1000">
                    <i class="fa fa-spinner fa-spin fa-lg fa-4x fa-fw"></i>
                </div>

                <div class="alert alert-success alert-dismissible" role="alert" id="alertSuccess" style="display: none; position: absolute; bottom: 70%; right: 3%;
                         font-size: 18px; width: 300px; height: 100px; z-index: 1000; text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><i class="fa fa-check fa-2x"></i></p> <strong>Operación Completada.</strong>
                </div>

                <div class="alert alert-danger alert-dismissible" id="alertRecordatorio" style="display: none;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Recordatorio!</strong> Tienes una reprogramación, mira las notificaciones.
                </div>

                <div class="alert alert-danger alert-dismissible" role="alert" id="alertDanger" style="display: none; position: absolute; bottom: 50px; right: 16px;
                         font-size: 18px; width: 300px; height: 120px; z-index: 1000; text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><i class="fa fa-times-circle fa-2x"></i></p> <strong>La operación no se ha podido completar.</strong>
                </div>

                <div class="alert alert-warning alert-dismissible" role="alert" id="alertWarning" style="display: none; position: absolute; bottom: 50px; right: 16px;
                         font-size: 18px; width: 300px; height: 150px; z-index: 1000; text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p><i class="fa fa-warning fa-2x"></i></p> <strong>El registro que está tratando de ingresar ya existe.</strong>
                </div>

                <div id="page-wrapper">

                    <?= $this->section('content'); ?>

                    <div class="modal fade" id="editarRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Editar</h4>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row d-flex justify-content-center">
                                        <div id="editarRegistroContent" class="col-md-10">

                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" id="accionGuardarEditar">Aplicar Cambios</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed-bottom">
                <footer class="d-flex justify-content-around py-1 border-top border-secondary bg-light">
                    <?= date('Y'); ?> FIANZA LTDA | Todos los derechos reservados
                </footer>
            </div>

            <div id="modals">
                <div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            ...
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            ...
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            ...
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <script src="../../public/js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script> -->

        <!--<script src="../../public/js/jquery-1.10.2.min.js"></script>-->
        <!-- <script src="../../public/js/scripts.js"></script> -->
        <!-- <script src="../../public/librerias/jquery-toggles-master/js/Toggles.js"></script> -->
        <!-- <script src="../../public/js/scriptsCapacitacion.js"></script> -->

        <script src="../../public/js/jquery-3.1.1.min.js"></script>
        <script src="../../public/jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <script src="../../public/js/jquery-ui.min.js"></script>
        <script src="../../public/js/jquery.nicescroll.js"></script>
        <script src="../../public/js/Chart.js"></script>
        <script src="../../public/js/datalabels.js"></script>
        <!--
            +-------------+
            | BOOTSTRAP 5 |
            +-------------+
        -->
        <script src="../../public/js/popper.min.js"></script>
        <script src="../../public/js/bootstrap.min.js"></script>

        <!-- >>>>> Script fullCalendar <<<<< -->
        <script src="../../public/js/main.js"></script>
        <script src="../../public/js/es.js"></script>
        <script src="../../public/js/calendario.js"></script>

        <!-- >>>>> Script datatables <<<<< -->
        <script src="../../public/js/datatables.min.js"></script>

        <script src="../../public/js/bootstrap-datepicker.min.js"></script>
        <script src="../../public/js/parsley.min.js"></script>
        <script src="../../public/js/fileinput.js"></script>
        <script src="../../vendor/datetimepicker/build/jquery.datetimepicker.full.js"></script>
        <script src="../../public/js/jquery-confirm.js"></script>
        <script src="../../public/librerias/clipboard.js-master/dist/clipboard.min.js"></script>
        <script src="../../public/js/jquery.countdown.min.js"></script>
        <script src="../../public/js/timer.jquery.min.js"></script>
        <script src="../../public/js/idle-timer.min.js"></script>

        <script src="../../public/js/scripts_admin.js"></script>
        <script src="../../public/js/scripts_general.js"></script>
        <script src="../../public/js/scripts_carteras.js"></script>

        <!-- bootstrap select CAPACITACION-->
        <!-- <script src="../../public/js/bootstrap-select.min.js"></script> -->

        <?php if ($_SESSION['estado_pausa'] == 1 && strpos(ucwords($_SESSION['rol_actual']), "Asesor") !== false) : ?>
            <script>
                iniciarPausa(<?= $_SESSION['tiempo_pausa']; ?>, '<?= (isset($_SESSION['tipo_pausa'])) ? $_SESSION['tipo_pausa'] : ''; ?>', '<?= (isset($_SESSION['label_pausa'])) ? $_SESSION['label_pausa'] : ''; ?>');
            </script>
        <?php endif; ?>

        <?php /*
            if ($_SESSION['cumpleanios'] == 1) :
        ?>
                <script>
                    mensaje('dark', '¡FELICIDADES!', 'green', '<div class="row">\n\
                        <div class="col-xs-4" style="align-items:center;">\n\
                            <center>\n\
                                <img src="../../public/images/pastel_opcional.png" style="padding-top:50%;" class="img-responsive"/>\n\
                            </center>\n\
                        </div>\n\
                        <div class="col-xs-8">\n\
                            <p class="text-muted text-justify">\n\
                                Somos una de las compañías líderes en nuestro campo y \n\
                                esto sería posible sin la ayuda de colaboradores como <strong>TU</strong>, \n\
                                gracias por tu compromiso y apoyo.\n\
                                Por eso en el día de tu cumpleaños te extendemos nuestros mejores deseos,\n\
                                esperamos que tengas un día lleno de satisfacciones y sobre todo\n\
                                cerca de aquellos a quienes amas.\n\
                            </p>\n\
                            <br/>\n\
                            <br/>\n\
                            <p class="text-center"><strong>FIANZA LTDA</strong></p>\n\
                        </div>\n\
                        </div>');
                </script>
            <?php endif; */ ?>
        <?php
        /*
            if ($_SESSION['cambio_password'] == 1) :
            ?>
                <script>
                    mensaje('dark', '¡OBLIGATORIO!', 'red', '<div class="row">\n\
                        <div class="col-xs-8">\n\
                            <p class="text-muted">\n\
                                Debes cambiar tu contraseña y volver a iniciar sesión.\n\
                            </p>\n\
                        </div>\n\
                        </div>');
                </script>
        <?php endif; 
        */ ?>

        <?php if ($modulo == 'cartera' && !isset($cliente) && !isset($carteraActual)) : ?>
            <script>
                $.alert({
                    icon: 'fa fa-comment-o',
                    title: '¡UPS!',
                    type: 'red',
                    theme: 'supervan',
                    animation: 'rotateYR',
                    content: 'Al parecer no existen clientes disponibles para gestionar, ponte en contacto con el lider de campaña',
                });
            </script>
        <?php endif; ?>

        <?php else : ?>
            <link href="../../public/css/jquery-confirm.css" rel='stylesheet' type='text/css' />
            <script src="../../public/js/jquery-3.1.1.min.js"></script>
            <script src="../../public/js/jquery-confirm.js"></script>
            <script>
                // $.confirm({
                //     icon: 'fa fa-comment-o',
                //     title: '¡ATENCIÓN!',
                //     type: 'blue',
                //     theme: 'dark',
                //     animation: 'scaleX',
                //     content: 'Su sesión ha finalizado',
                //     buttons: {
                //         Ok: function() {
                window.location.href = '../../../login/public/login/';
                //         }
                //     }
                // });
            </script>
        <?php endif; ?>
    </body>

</html>
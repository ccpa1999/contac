(function () {
    "use strict";

    // custom scrollbar

    $("html").niceScroll({styler: "fb", cursorcolor: "#27cce4", cursorwidth: '5', cursorborderradius: '10px', background: '#424f63', spacebarenabled: false, cursorborder: '0', zindex: '1000'});

    $(".left-side").niceScroll({styler: "fb", cursorcolor: "#27cce4", cursorwidth: '3', cursorborderradius: '10px', background: '#424f63', spacebarenabled: false, cursorborder: '0'});


    $(".left-side").getNiceScroll();
    if ($('body').hasClass('left-side-collapsed')) {
        $(".left-side").getNiceScroll().hide();
    }



    // Toggle Left Menu
    jQuery('.menu-list > a').click(function () {

        var parent = jQuery(this).parent();
        var sub = parent.find('> ul');

        if (!jQuery('body').hasClass('left-side-collapsed')) {
            if (sub.is(':visible')) {
                sub.slideUp(200, function () {
                    parent.removeClass('nav-active');
                    jQuery('.main-content').css({height: ''});
                    mainContentHeightAdjust();
                });
            } else {
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(200, function () {
                    mainContentHeightAdjust();
                });
            }
        }
        return false;
    });

    function visibleSubMenuClose() {
        jQuery('.menu-list').each(function () {
            var t = jQuery(this);
            if (t.hasClass('nav-active')) {
                t.find('> ul').slideUp(200, function () {
                    t.removeClass('nav-active');
                });
            }
        });
    }

    function mainContentHeightAdjust() {
        // Adjust main content height
        var docHeight = jQuery(document).height();
        if (docHeight > jQuery('.main-content').height())
            jQuery('.main-content').height(docHeight);
    }

    //  class add mouse hover
    jQuery('.custom-nav > li').hover(function () {
        jQuery(this).addClass('nav-hover');
    }, function () {
        jQuery(this).removeClass('nav-hover');
    });


    // Menu Toggle
    jQuery('.toggle-btn').click(function () {
        $(".left-side").getNiceScroll().hide();

        if ($('body').hasClass('left-side-collapsed')) {
            $(".left-side").getNiceScroll().hide();
        }
        var body = jQuery('body');
        var bodyposition = body.css('position');

        if (bodyposition != 'relative') {

            if (!body.hasClass('left-side-collapsed')) {
                body.addClass('left-side-collapsed');
                jQuery('.custom-nav ul').attr('style', '');

                jQuery(this).addClass('menu-collapsed');

            } else {
                body.removeClass('left-side-collapsed chat-view');
                jQuery('.custom-nav li.active ul').css({display: 'block'});

                jQuery(this).removeClass('menu-collapsed');

            }
        } else {

            if (body.hasClass('left-side-show'))
                body.removeClass('left-side-show');
            else
                body.addClass('left-side-show');

            mainContentHeightAdjust();
        }

    });


    searchform_reposition();

    jQuery(window).resize(function () {

        if (jQuery('body').css('position') == 'relative') {

            jQuery('body').removeClass('left-side-collapsed');

        } else {

            jQuery('body').css({left: '', marginRight: ''});
        }

        searchform_reposition();

    });

    function searchform_reposition() {
        if (jQuery('.searchform').css('position') == 'relative') {
            jQuery('.searchform').insertBefore('.left-side-inner .logged-user');
        } else {
            jQuery('.searchform').insertBefore('.menu-right');
        }
    }
})(jQuery);


function crearNuevoUsuario() {
    if ($(this).parsley().validate() == true) {
        $.ajax({
            url: "../../app/controllers/administracionController.php",
            type: 'POST',
            data: $('#formularioCreacionUsuarios').serialize(),
        })
                .done(function (data) {
                    if (data == 'ok') {
                        $('#agregarUsuario').modal('hide');
                        $.alert('¡Operación Completada!');
                        $('#agregarUsuario').on('hidden.bs.modal', function (e) {
                            administracionUsuarios();
                        });
                    } else {
                        $('#agregarUsuario').modal('hide');
                        $.alert('¡Hubo un problema creando el usuario!');
                    }
                });
    }
}

function crearNuevoRegistro(formulario) {
    if (formulario != '') {
        var form = $('#'+ formulario);
    } else {
        var form = $(this);
    }
    var controlador = form.data('controlador');
    var metodo = form.data('metodo');
    /*if (form.parsley().validate() == true) {*/
        $.ajax({
            url: "../../app/controllers/" + controlador,
            type: 'POST',
            data: form.serialize(),
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
            success: function (dataRespuesta) {
                var respuesta = dataRespuesta;
                $('#divCargando').fadeOut();
                if (respuesta = 'ok') {
                    mensaje('dark', '¡ATENCIÓN!', 'green', '¡Su dato fue ingresado correctamente');
                    cargarDatos(controlador, metodo);
                } else {
                    mensaje('dark', '¡ERROR!', 'red', '¡Hubo un error ingresando el registro!');
                }
            }
        });
    /*}*/
}

function crearNuevoRegistroBusqueda(formulario) {
    if (formulario != '') {
        var form = $('#'+ formulario);
    } else {
        var form = $(this);
    }
    var controlador = form.data('controlador');
    var metodo = form.data('metodo');
    var tipo = form.data('tipo');
    var datoBusqueda = form.data('dato');
    /*if (form.parsley().validate() == true) {*/
        $.ajax({
            url: "../../app/controllers/" + controlador,
            type: 'POST',
            data: form.serialize(),
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
            success: function (dataRespuesta) {
                var respuesta = dataRespuesta;
                $('#divCargando').fadeOut();
                if (respuesta = 'ok') {
                    mensaje('dark', '¡ATENCIÓN!', 'green', '¡Su dato fue ingresado correctamente');
                    cargarDatosBusqueda(controlador, metodo, tipo, datoBusqueda);
                } else {
                    mensaje('dark', '¡ERROR!', 'red', '¡Hubo un error ingresando el registro!');
                }
            }
        });
    /*}*/
}

function crearNuevoCliente() {
    var controlador = $(this).data('controlador');
    var metodo = $(this).data('metodo');
    var formData = new FormData(document.getElementById('#formularioCreacion'));
    if ($(this).parsley().validate() == true) {
        $.ajax({
            url: "../../app/controllers/administracionController.php",
            type: 'POST',
            data: $('#formularioCreacion').serialize(),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
            success: function (resultado) {
                $('#divCargando').fadeOut();
                if (resultado == 'ok') {
                    $('#alertSuccess').fadeIn().delay(2000).fadeOut();
                    cargarDatos(controlador, metodo);
                } else {
                    $('#alertWarning').fadeIn().delay(2000).fadeOut();
                }
            }
        });
    }
}

function obtenerPermisos() {
    var thiz = $(this);
    var usuario = thiz.data('usuario');
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'obtenerPermisos',
            usuario: usuario},
        success: function (resultado) {
            $('#editarPermisosInfo').html(resultado);
        }
    });
}

function GuardarPermisos() {
    var thiz = $(this);
    var usuario = thiz.data('usuario');
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: $('#formGuardarPermisos').serialize(),
        success: function (resultado) {
            if (resultado == 'ok') {
                $("#permisosUsuario").modal('hide');
                $('#permisosUsuario').on('hidden.bs.modal', function (e) {
                    mensaje('dark', '¡ATENCION!', 'green', 'Operanción completada');
                })
            } else {
                $('#permisosUsuario').modal('hide');
                $('#permisosUsuario').on('hidden.bs.modal', function (e) {
                    mensaje('dark', '¡ERRO!', 'red', '¡Ups! algo salió mal por favor intenta de nuevo');
                });
            }
        }
    });
}

function eliminarRegistro() {
    var thiz = $(this);
    var controlador = thiz.data('controlador');
    var metodo = thiz.data('metodo');
    $.confirm({
        icon: 'fa fa-warning',
        title: '¡Atención!',
        content: '¿Está seguro de eliminar el registro?',
        type: 'orange',
        backgroundDismiss: false,
        backgroundDismissAnimation: 'glow', 
        buttons: {
            Confirmar: {
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url: "../../app/controllers/administracionController.php",
                        type: 'POST',
                        dataType: "json",       
                        data: {metodo: 'borrarRegistro',
                            id: thiz.data('id'),
                            accion: thiz.data('accion')},
                        beforeSend: function () {
                            $('#divCargando').fadeIn();
                        },
                        success: function (datos) {
                            $('#divCargando').fadeOut();
                            if (datos.resultado == 'ok') {
                                $.alert('¡Eliminado!');
                                cargarDatos(controlador, metodo);
                            } else {
                                $.alert('¡Hubo un error eliminando el registro!');
                            }
                        }
                    });
                }
            },
            Cancelar: {
                btnClass: 'btn-success',
                action: function () {
                    $.alert('¡Cancelado!');
                }
            }
        }
    });
}

function editarRegistro() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        dataType: "json",
        data: $('#formularioEdicionRegistro').serialize(),
        success: function (datos) {
            var funcion = thiz.data('ajax');
            editarRegistro
            if (datos.resultado == 'ok') {
                $('#editarRegistro').modal('hide');
                $('#editarRegistro').on('hidden.bs.modal', function (e) {
//                    $('#alertSuccess').fadeIn().delay(2000).fadeOut();
                    var dialog = bootbox.dialog({
                        message: "Registro actualizado correctamente!",
                        size: 'small',
                        closeButton: false,
                        backdrop: false,
                        className: 'success'
                    });
                    setTimeout(function () {
                        bootbox.hideAll();
                    }, 1500);

                    administracionUsuarios();
                })
            } else {
                $('#editarRegistro').modal('hide');
                $('#editarRegistro').on('hidden.bs.modal', function (e) {
                    var dialog1 = bootbox.dialog({
                        message: "Hubo un problema en la actualización del registro!",
                        size: 'small',
                        closeButton: false,
                        backdrop: false,
                        className: 'danger'
                    });
                    setTimeout(function () {
                        bootbox.hideAll();
                    }, 1500);
//                    $('#alertWarning').fadeIn().delay(2000).fadeOut();
                })
            }
        }
    })
}
function formularioEditarRegistro() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'formularioEditarRegistro',
            id: thiz.data('id'),
            tipo: thiz.data('tipo')},
        success: function (datos) {
            $('#editarRegistroContent').html(datos);
            $('#accionGuardarEditar').on('click', editarRegistro);
        }
    })
}

function formularioCrearRegistro() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'formularioCrearRegistro',
            id: thiz.data('id'),
            tipo: thiz.data('tipo')},
        success: function (datos) {
            $('#editarRegistroContent').html(datos);
            $('#accionGuardarEditar').on('click', editarRegistro);
        }
    })
}

function administracionUsuarios() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionUsuarios'},
    })
            .done(function (data) {
//                scriptIncial();
                $('#contenedor_data').html(data);
                $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
                $('.editarRegistro').on('click', editarRegistro);
                $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
                $('.obtenerPermisos').on('click', obtenerPermisos);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
                $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
                $('.busqueda').keyup(buscarDatos);
                $('#accionGuardarPermisos').on('click', GuardarPermisos);
            });
}


function estadoTarea(){
    var id =  $(this).data('id');
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {metodo: 'estadoTarea',
               id: $(this).data('id')},
    })
            .done(function (respuesta) {
                $('#promedioGestionTarea_' + id).html('<strong>'+respuesta.promedio_gestion + ' MINUTOS</strong>');
                var ctx = $("#cantidadGestionados_" + id);
                var dataPie = {
                    labels: [
                        "Gestionados",
                        "No Gestionados",
                    ],
                    datasets: [
                        {
                            data: [respuesta.gestionados, respuesta.no_gestionados],
                            backgroundColor: [
                                "#8BC34A",
                                "#03A9F4",
                            ],
                        }]
                };
                var myPieChart = new Chart(ctx,{
                    type: 'pie',
                    data: dataPie
                });
                var ctx1 = $("#cantidadGestionadosUsuario_" + id);
                var dataPolar = {
                    datasets: [{
                        data: respuesta.gestionados_por_asesor.data,
                        backgroundColor: respuesta.gestionados_por_asesor.colores,
                    }],
                    
                    labels: respuesta.gestionados_por_asesor.labels
                };
                var myPolarChart = new Chart(ctx1,{
                    type: 'polarArea',
                    data: dataPolar
                });
            });

}

function administracionTareas() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {metodo: 'administracionTareas',
               cartera : $('#carteraActual').val()},
    })
            .done(function (data) {
//                scriptIncial();
                $('#contenedor_data').html(data);
                $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
                $('.AccionEstadoTarea').on('click', estadoTarea);
                $('.editarRegistro').on('click', editarRegistro);
                $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
                $('.obtenerPermisos').on('click', obtenerPermisos);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
                $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
                $('.busqueda').keyup(buscarDatos);
                $('#accionGuardarPermisos').on('click', GuardarPermisos);
                
            });
}

function administracionRoles() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionRoles'},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
                $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('#formularioCreacion').on('submit', crearNuevoRegistro);
                $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
                $('#busquedaRoles').keyup(buscarDatos);
            });
}

function ingresoCarteras() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        data: {cartera: thiz.data('cartera')},
    }).done(function (data) {
        $('#contenedor_data').html(data);
    });
}

function administracionClientes() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionClientes'},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
                $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('#formularioCreacion').on('submit', crearNuevoCliente);
                $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
                $('#busquedaRoles').keyup(buscarDatos);
            });
}

function administracionPermisos() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionPermisos'},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
                $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('.activarOpcion').on('click', activarOpcion);
                $('#formularioCreacion').on('submit', crearNuevoRegistro);
                $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
                $('#busqueda').keyup(buscarDatos);
            });
}

function administracionInformes() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionInformes',
               cartera: $('#carteraActual').val()},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
                $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('.activarOpcion').on('click', activarOpcion);
                $('#formularioGenerar').on('submit', generarInforme);
                $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
                $('#busqueda').keyup(buscarDatos);
                $('#busqueda').on('click');
            });
}

function activarOpcion() {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('#' + $(this).data('input')).val('');
    } else {
        $(this).addClass('active');
        $('#' + $(this).data('input')).val($(this).data('value'));
    }
}

function administracionRegiones() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionRegiones'},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
            });
}

function administracionDepartamentos() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionDepartamentos'},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
            });
}

function administracionCiudades() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {metodo: 'administracionCiudades'},
    })
            .done(function (data) {
                $('#contenedor_data').html(data);
            });
}

function generarInforme() {
    if ($("#formularioGenerar").parsley().validate() == true) {
        $.ajax({
            url: "../../app/controllers/carterasController.php",
            type: 'POST',
            data: $('#formularioGenerar').serialize(),
        })
                .done(function (resultado) {
                    /*if (resultado == 'ok') {*/
                        mensaje('dark', '¡FELICIDADES!', 'green', 'Se generó el informe correctamente');
                        administracionInformes();
                    /*}*/
                });
    }
}

function buscarDatos() {
    var thiz = $(this);
    var metodo = thiz.data('metodo');
    var div_resultado = thiz.data('div-resultado');
    var textoBusqueda = thiz.val();

    $.post("../../app/controllers/administracionController.php",
            {valorBusqueda: textoBusqueda,
                metodo: metodo,
            },
            function (resultado) {
                $("#" + div_resultado).html(resultado);
                $('.editarCliente').on('click', editarCliente);
                $('.eliminarRegistro').on('click', eliminarRegistro);
                $('.obtenerPermisos').on('click', obtenerPermisos);
            });
    ;
}

function actualizarInformacionPersonal() {
    $.post("../../app/controllers/administracionController.php",
            $('#formularioActualizarInformacionPersonal').serialize(),
            function (resultado) {
                if (resultado == 'ok') {
                    $('#agregarUsuario').modal('hide');
                    $('#alertSuccess').fadeIn().delay(2000).fadeOut();
                } else {
                    $('#agregarUsuario').modal('hide');
                    $('#alertWarning').fadeIn().delay(2000).fadeOut();
                }
            });
}

function perfilUsuario() {
    var thiz = $(this);

    $.post("../../app/controllers/administracionController.php",
        {metodo: 'perfilUsuario',
            usuario: thiz.data('usuario')
        },
        
        function (resultado) {
            $("#contenedor_data").html(resultado);
            $("#formularioActualizarInformacionPersonal").submit(actualizarInformacionPersonal);
            $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
        }
    );
}

function obtenerAlarmas() {
    $.ajax({
        url: "../../app/controllers/lavacascosController.php",
        type: 'POST',
        data: {metodo: 'obtenerAlarmas'},
    })
    .done(function (data) 
    {
        $('#resultadoAlarmas').html(data);
    });
}

function cargarArchivo() {
    var thiz = $(this);
    var formData = new FormData(document.getElementById(thiz.data('id')));

    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#divCargando').fadeIn();
        },
    })
    .done(function (data) {
        $('#divCargando').fadeOut();

        if (data.resultado == 'ok') 
        {
            $.alert({
                icon: 'fa fa-comment-o',
                title: 'Proceso Completado',
                type: 'green',
                theme: 'dark',
                animation: 'rotateYR',
                content: data.mensaje,
            });
            administracionCarga();
        }
        else 
        {
            $('#agregarUsuario').modal('hide');

            $.alert({
                icon: 'fa fa-comment-o',
                title: '¡Ups!',
                type: 'red',
                theme: 'dark',
                animation: 'rotateYR',
                content: '¡Hubo un problema cargando el archivo!<br>\n\
                            es posible que uno o más registros ya existan en la base.',
            });
        }

    });
}

function administracionCarga() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {metodo: 'administracionCarga',
            carteraActual: $('#carteraActual').val()},
    })
    .done(function (data) {
        $('#contenedor_data').html(data);
        $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
        $('.eliminarRegistro').on('click', eliminarRegistro);
        $('.formCarga').on('submit', cargarArchivo);
        $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});   
        $('#busquedaRoles').keyup(buscarDatos);

        $(".inputCarga").fileinput({
            Locales: "es",
            browseLabel: 'Browse...',
        });

        $('.toggle').toggles({text: {on: 'ON', off: 'OFF'}});
    });
}


function administracionCartera() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: 
        {
            metodo: 'administracionCartera',
            carteraActual: $('#carteraActual').val()
        },
    })
    .done(function (data) {
        $('#contenedor_data').html(data);
        $('.formHomologado').on('submit', function(){
            crearNuevoRegistro($(this));   
        });
        $('.eliminarRegistro').on('click', eliminarRegistro);
    });
}


function cargarDatos(controlador, metodo) {
    $.ajax({
        url: "../../app/controllers/" + controlador,
        type: 'POST',
        data: {metodo: metodo, carteraActual: $('#carteraActual').val()},
        success: function (data) {
            $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function(){
                    crearNuevoRegistro($(this));   
            });
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);   
            $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
//            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.editarRegistro').on('click', editarRegistro);
            $('.activarOpcion').on('click', activarOpcion);
            $('#formularioCreacion').on('submit', crearNuevoRegistro);
            $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
            $('#busqueda').keyup(buscarDatos);
            $('.busqueda').keyup(buscarDatos);
            $('.obtenerPermisos').on('click', obtenerPermisos);
            $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
            $('#nombreCambio').on('change', nombreCambio($(this)));
            $('#accionGuardarPermisos').on('click', GuardarPermisos);
        }
    });
}


function cargarDatosBusqueda(controlador, metodo, tipo, datoBusqueda) {
    $.ajax({
        url: "../../app/controllers/" + controlador,
        type: 'POST',
        data: {metodo: metodo,
            cartera: $('#carteraActual').val(),
            datoBusqueda: datoBusqueda,
            tipo: tipo},
        success: function (data) {
            $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function(){
                crearNuevoRegistro($(this));   
            });
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro); 
            $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
//            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.editarRegistro').on('click', editarRegistro);
            $('.activarOpcion').on('click', activarOpcion);
            $('#formularioCreacion').on('submit', crearNuevoRegistro);
            $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
            $('#busqueda').keyup(buscarDatos);
            $('.busqueda').keyup(buscarDatos);
            $('.obtenerPermisos').on('click', obtenerPermisos);
            $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
            $('#nombreCambio').on('change', nombreCambio($(this)));
            $('#accionGuardarPermisos').on('click', GuardarPermisos);
        }
    });
}

function mensaje(tema, titulo, color, mensaje) {
    $.alert({
        icon: 'fa fa-commenting-o fa-2x',
        title: titulo,
        type: color,
        theme: tema,
        animation: 'rotateYR',
        content: mensaje,
    });
}

function nombreCambio(thiz) {
    var str = thiz.val();
    var inicial = str.substring(1, 0);
    var apellido = str.split(" ");
    var usuario = inicial + apellido[1];
    var usuarioFinal = usuario.toLowerCase();
    $('#usuarioCambio').val(usuarioFinal);
}

function iniciarPausa() {
    $.alert({
        icon: 'fa fa-pause-circle fa-2x',
        title: '¡Pausado!',
        type: 'orange',
        theme: 'supervan',
        animation: 'rotateYR',
        content: '¡Actualmente te encuentras en pausa de ' + $(this).data('pausa'),
    });
}

function scriptIncial() {
    $(document).on('click', function (ev) {
        ev.stopImmediatePropagation();
        $(".dropdown-toggle").dropdown("active");
    });

    $('#accionClientes').on('click', administracionClientes);
    //$('.accionBuscarDeudores').on('click', buscarDeudores);
    $('#accionUsuarios').on('click', administracionUsuarios);
    $('#accionRoles').on('click', administracionRoles);
    $('.accionInformes').on('click', administracionInformes);
    $('#accionPermisos').on('click', administracionPermisos);
    $('#accionRegiones').on('click', administracionRegiones);
    $('#accionDepartamentos').on('click', administracionDepartamentos);
    $('#accionCiudades').on('click', administracionCiudades);
    $('#accionPerfil').on('click', perfilUsuario);  
    $('#autocompletar').on('click', autocompletar);
    $('#accionConfiguracionCartera').on('click', administracionCartera);
    $('.ingresoCarteras').on('click', ingresoCarteras);
    $('.formularioCreacion').on('click', crearNuevoRegistro);
    $('.accionCargar').on('click', administracionCarga);
    $('.pausa').on('click', iniciarPausa);

    $('.obligacionGestion').dblclick(function () {
        $('#obligacionGestion').val('');
        $('#labelVisualizacionObligacion').html('OBLIGACION: ' + $(this).data('obligacion'));
        $('#visualizacionObligacion').fadeIn();
        $('#obligacionGestion').val($(this).data('obligacion'));
    });

    new Clipboard('.cedulaGestion');

    $('.telefonoGestion').dblclick(function () {
        var telefonos = $('#telefonosGestion').val();
        $('#telefonosGestion').val(telefonos + $(this).data('telefono') + ',');
        window.getSelection($(this).data('telefono'));
        document.execCommand("copy");
        $('#visualizacionTelefonos').html($('#visualizacionTelefonos').html() + '<i class="fa fa-clock-o"></i> ' + $(this).data('telefono') + '<br>');
        $('#visualizacionTelefonos').fadeIn();
    });

    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});

    $(".accionAgregarGestion").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $("#sidebar-wrapper").attr('style', '');
    });

    $(".ventanaMovimiento").draggable().resizable();
    $("#accionGestion").on('change', resultadoAccion);
    $("#contacto_gestion").on('change', resultadoContacto);
    /*$("#contacto_gestion").on('change', function () {
        $('#divMotivoNoPago').fadeOut();
        var array = ['1', '4', '6'];
        if ($.inArray($(this).val(), array) != -1) {
            $('#divMotivoNoPago').fadeIn();
        }
    });*/
    /*$("#efecto_gestion").on('change', function () {
        $('#divAcuerdoGestion').fadeOut();
        var array = ['106', '108', '109', '127'];
        if ($.inArray($(this).val(), array) != -1) {
            $('#divAcuerdoGestion').fadeIn();
        }
    });*/
    $('#formularioGestion').on('submit', guardarGestion);
    $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
    $('.btnFormularioCreacionRegistroBusqueda').on('click', formularioCreacionRegistroBusqueda);
    $('.formularioCreacion').on('submit', crearNuevoRegistro);
    
    if (typeof $('#carteraActual').val() != "undefined" && 
        $('#carteraActual').val() != null)
    {
        setInterval('consultarTareas()', 10000);
    }

    $('#launchPhone').on('click', function(event) {
        event.preventDefault();
        // This is set when the phone is open and removed on close
        if (!localStorage.getItem('ctxPhone')) {
            window.open(url, 'ctxPhone', features);
            return false;
        } else {    
            window.alert('Phone already open.');
        }
    });
}


function buscarDeudor() {
    form = $('#formularioBusquedaDudores').serialize();
    url =  "../../app/controllers/carterasController.php?" + form;
    if ($("#formularioBusquedaDudores").parsley().validate() == true) {
        /*$.ajax({
            url: "../../app/controllers/carterasController.php",
            type: 'POST',
            dataType: 'json',   
            data: $('#formularioBusquedaDudores').serialize(),
        })
        .done(function (data) {
            if (data.resultado == 'ok') {
                $('#contenedor_data').html(data.plantilla);
                scriptIncial();
            } else {
                mensaje('supervan', '¡ERROR!', 'red', 'No Hay coincidencias para este dato');
            }
        });*/

        window.open(url);
    }
}


function buscarDeudores() {
    var content = $('#divFormularioBusquedaDeudores').html();
    var cartera = $(this).data('cartera');

    $.alert({
        icon: 'fa fa-search',
        title: 'BUSCAR',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'medium',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {cartera: cartera,
                    metodo: 'formulariosVarios',
                    parametro: 'formularioBusquedaDeudores'},
            }).done(function (response) {
                self.setContent(response);
            });
        },
        buttons: {
            BUSCAR: {
                btnClass: 'btn-info',
                action: function () {
                    buscarDeudor();
                }
            }
        }
    });
}

function formularioCreacionRegistro() {
    var parametro = $(this).data('parametro');
    var identificacion = $(this).data('identificacion');
    var formulario = $(this).data('formulario');
    var cartera = $('#carteraActual').val();
    var jc = $.confirm({
        icon: 'fa fa-search',
        title: 'CREACION',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'large',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {cartera: cartera,
                    metodo: 'formulariosCreacionRegistro',
                    parametro: parametro,
                    identificacion: identificacion},
            }).done(function (response) {
                self.setContent(response);

            });
        },
        onContentReady: function () {
            $('.nombreCambio').on('change', function () {
                var str = $(this).val();
                var inicial = str.substring(1, 0);
                var apellido = str.split(" ");
                var usuario = inicial + apellido[1];
                var usuarioFinal = usuario.toLowerCase();
                $('#usuarioCambio').val(usuarioFinal);
            });
        },
        buttons: {
            Guardar: {
                btnClass: 'btn-success',
                action: function () {
                    crearNuevoRegistro(formulario);
                }
            }
        }
    });
}

function formularioCreacionRegistroBusqueda() {
    var parametro = $(this).data('parametro');
    var identificacion = $(this).data('identificacion');
    var formulario = $(this).data('formulario');
    var cartera = $('#carteraActual').val();

    var jc = $.confirm({
        icon: 'fa fa-search',
        title: 'CREACION',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'large',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {cartera: cartera,
                    metodo: 'formulariosCreacionRegistro',
                    parametro: parametro,
                    identificacion: identificacion},
            }).done(function (response) {
                self.setContent(response);

            });
        },
        onContentReady: function () {
            $('.nombreCambio').on('change', function () {
                var str = $(this).val();
                var inicial = str.substring(1, 0);
                var apellido = str.split(" ");
                var usuario = inicial + apellido[1];
                var usuarioFinal = usuario.toLowerCase();
                $('#usuarioCambio').val(usuarioFinal);
            });
        },
        buttons: {
            Guardar: {
                btnClass: 'btn-success',
                action: function () {
                    crearNuevoRegistroBusqueda(formulario);
                }
            }
        }
    });
}


function resultadoAccion() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {metodo: 'obtenerContactosAccion',
            accion: $(this).val(),
            cartera: $('#carteraActual').val()
        },
    })
    .done(function (data) {
        $('#contacto_gestion')
                .empty()
                .append('<option value="">..Seleccione..</option>');
        $.each(data.contacto, function (i, item) {
            $('#contacto_gestion').append(' <option value="' + item.id + '">' + item.homologado + '</option>');
        });
    });
}

function resultadoContacto(){
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {metodo: 'obtenerEfectosContacto',
            contacto: $(this).val(),
            cartera: $('#carteraActual').val()
        },
    })
    .done(function (data) {
        $('#efecto_gestion')
            .empty()
            .append('<option value="">..Seleccione..</option>');

        $('#motivo_gestion')
            .empty()
            .append('<option value="">..Seleccione..</option>');        

        $.each(data.efecto, function (i, item) {
            $('#efecto_gestion').append(' <option value="' + item.id + 
                '">' + item.homologado + '</option>');
        });

        $.each(data.motivos, function (i, item) {
            $('#motivo_gestion').append(' <option value="' + item.id + 
                '">' + item.motivo + '</option>');
        });

        $('#divEfectoGestion').fadeIn();
    });
}

function autocompletar() {
    var dataString = $('#formularioGestion').serialize();
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {metodo: 'autocompletar', datos: dataString},
    })
            .done(function (data) {
                $('#observacionesGestion').val(data);
            });
}

function refrescarHistorico() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {metodo: 'refrescarHistorico',
            cedula_deudor: $('#cedula_deudor').val(),
            cartera: $('#carteraGestion').val()
        },
    })
    .done(function (data) {
        $('#divHistoricoGestion').html(data);
    });
}

function guardarGestion() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: $('#formularioGestion').serialize()
    })
            .done(function (data) {
                refrescarHistorico();
                mensaje('dark', 'ATENCION', 'green', 'Gestión Guardada Correctamente');
                $('#btnAgregarGestion').click();
            });
}

function buscarDeudoresTarea(){
     $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            tarea: $(this).data('tarea'),
            metodo: 'buscarDeudoresTarea',
            cartera: $('#carteraActual').val()
        }
    })
    .done(function (data) {
        if(data.resultado == 'ok'){ 
            $('#contenedor_data').html(data.plantilla);
            $('.siguienteClienteTarea').on('click', buscarDeudoresTarea);

            scriptIncial();      
        }else{
            mensaje('dark', 'ATENCION', 'blue', 'La tarea ha finalizado');

            $(location).delay(1000).attr('../../app/controllers/carterasController.php?&cartera='+$('#carteraActual').val(), url);
            
        }
    });
}
function consultarTareas() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {metodo: 'consultarTareas',
            cartera: $('#carteraActual').val()}
    })
            .done(function (data) {
                $('#divListadoTareas').html(data.plantilla);
                if (data.cantidad >= 1) {
                    $('#badgeCantidadTareas').html(data.cantidad);
                    $('#spanCantidadTareas').show();
                    $('.activarTarea').on('click', buscarDeudoresTarea);
                } else {
                    $('#badgeCantidadTareas').html('');
                    $('#spanCantidadTareas').hide();
                }
            });
}

var url      = '../../vendor/ctxSip/phone',
    features = 'menubar=no,location=no,resizable=no,scrollbars=no,status=no,addressbar=no,width=320,height=480';

$(document).ready(function () {
    $(document).on('click', function (ev) {
        ev.stopImmediatePropagation();

        $(".dropdown-toggle").dropdown("active");
    });

    $('#accionClientes').on('click', administracionClientes);
    $('.accionBuscarDeudores').on('click', buscarDeudores);
    $('#accionUsuarios').on('click', administracionUsuarios);
    $('#accionRoles').on('click', administracionRoles);
    $('.accionInformes').on('click', administracionInformes);
    $('#accionPermisos').on('click', administracionPermisos);
    $('#accionRegiones').on('click', administracionRegiones);
    $('#accionDepartamentos').on('click', administracionDepartamentos);
    $('#accionCiudades').on('click', administracionCiudades);
    $('#accionPerfil').on('click', perfilUsuario);  
    $('#autocompletar').on('click', autocompletar);
    $('#accionTareas').on('click', administracionTareas);
    $('#accionConfiguracionCartera').on('click', administracionCartera);
    $('.ingresoCarteras').on('click', ingresoCarteras);
    $('.formularioCreacion').on('click', crearNuevoRegistro);
    $('.accionCargar').on('click', administracionCarga);
    $('.btnFormularioCreacionRegistroBusqueda').on('click', 
        formularioCreacionRegistroBusqueda);
    $('.pausa').on('click', iniciarPausa);

    $('.obligacionGestion').dblclick(function () {
        $('#obligacionGestion').val('');
        $('#labelVisualizacionObligacion').html('OBLIGACION: ' + $(this).data('obligacion'));
        $('#visualizacionObligacion').fadeIn();
        $('#obligacionGestion').val($(this).data('obligacion'));
    });

    new Clipboard('.cedulaGestion');

    $('.telefonoGestion').dblclick(function () {
        var telefonos = $('#telefonosGestion').val();

        $('#telefonosGestion').val(telefonos + $(this).data('telefono') + ',');
        
        window.getSelection($(this).data('telefono'));
        document.execCommand("copy");
        
        $('#visualizacionTelefonos').html($('#visualizacionTelefonos').html() + 
            '<i class="fa fa-clock-o"></i> ' + $(this).data('telefono') + '<br>');

        $('#visualizacionTelefonos').fadeIn();
    });
    
    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
    
    $(".accionAgregarGestion").click(function (e) {
        e.preventDefault();

        $("#wrapper").toggleClass("active");
        $("#sidebar-wrapper").attr('style', '');
    });

    $(".ventanaMovimiento").draggable().resizable();

    $("#accionGestion").on('change', resultadoAccion);
    $("#contacto_gestion").on('change', resultadoContacto);
    /*$("#contacto_gestion").on('change', function () {
        $('#divMotivoNoPago').fadeOut();
        var array = ['1', '4', '6'];
        if ($.inArray($(this).val(), array) != -1) {
            $('#divMotivoNoPago').fadeIn();
        }
    });*/
    /*$("#efecto_gestion").on('change', function () {
        $('#divAcuerdoGestion').fadeOut();
        var array = ['106', '108', '109', '127'];
        if ($.inArray($(this).val(), array) != -1) {
            $('#divAcuerdoGestion').fadeIn();
        }
    });*/
    $('#formularioGestion').on('submit', guardarGestion);
    $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
    $('.formularioCreacion').on('submit', crearNuevoRegistro);

    if (typeof $('#carteraActual').val() != "undefined" &&
        $('#carteraActual').val() != null)
    {
        setInterval('consultarTareas()', 10000);
    }

    $('#launchPhone').on('click', function(event) {
        event.preventDefault();

        // This is set when the phone is open and removed on close
        if (!localStorage.getItem('ctxPhone')) {
            window.open(url, 'ctxPhone', features);
            return false;
        } else {
            window.alert('Phone already open.');
        }
    });
//    setTimeout('consultarNotificaciones()', 10000);
});



/************** Search ****************/
$(function () {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function (login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function () {
        return false;
    });
    $(this).mouseup(function (login) {
        if (!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});
	
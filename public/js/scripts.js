(function () {
    "use strict";
    // custom scrollbar

    $("html").niceScroll({ styler: "fb", cursorcolor: "#27cce4", cursorwidth: '5', cursorborderradius: '10px', background: '#424f63', spacebarenabled: false, cursorborder: '0', zindex: '1000' });
    $(".left-side").niceScroll({ styler: "fb", cursorcolor: "#27cce4", cursorwidth: '3', cursorborderradius: '10px', background: '#424f63', spacebarenabled: false, cursorborder: '0' });
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
                    jQuery('.main-content').css({ height: '' });
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
                jQuery('.custom-nav li.active ul').css({ display: 'block' });
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

            jQuery('body').css({ left: '', marginRight: '' });
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

function cargarMensajes() {
    var formData = new FormData(document.getElementById("cargarMensajes"));
    $.ajax({
        url: "../../app/controllers/mensajesController.php",
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#divCargando').fadeIn();
        },
    }).done(function (data) {

        if (data.resultado == 'ok') {
            tipoCapacitacion = $("#tipoCapacitacion").val();
            setTimeout(function () {
                mensaje('dark', 'Proceso Completado', 'blue', data.mensaje + ' <i class="fa fa-check-circle"></i><br><br>' + data.mensajeFalla + '  <i class="fa fa-exclamation-triangle"></i>', "cambioSelectPrueba");
                $('#divCargando').fadeOut();
            }, 1000);
        } else {
            setTimeout(function () {
                mensaje('dark', '¡Hubo un problema al cargar el archivo!', 'red', data.mensaje);
                $('#divCargando').fadeOut();
            }, 1000);
        }
    });
}

function crearNuevoRegistro(formulario) {
    if (formulario != '') {
        var form = $('#' + formulario);
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
}

function crearNuevoRegistroBusqueda(formulario) {
    if (formulario != '') {
        var form = $('#' + formulario);
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
}
/*}*/

function formularioEditarDemografico() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        dataType: "json",
        data: {
            metodo: 'formularioEditarDemografico',
            id: thiz.data('id'),
            tipo: thiz.data('tipo')
        },
        success: function (datos) {
            $('#editarRegistroContent').html("");
            $('#editarRegistroContent').html(datos.plantilla);
            $("#tipoDemografico option[value = '" + datos.valor + "']").attr("selected", true);
            $("#estadoDemo option[value = '" + datos.estado + "']").attr("selected", true);
            $('#accionGuardarEditar').on('click', editarDemografico);
            $('#hora').datetimepicker({
                datepicker: false,
                format: 'H:i'
            });
        }
    })
}

function editarDemografico() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        dataType: "json",
        data: $('#formularioEdicionRegistro').serialize(),
        success: function (datos) {
            if (datos.resultado == 'ok') {
                $('#' + datos.div).html('');
                $('#' + datos.div).html(datos.plantilla);
                $('.formularioEditarDemografico').on('click', formularioEditarDemografico);
                $('.tableDemografico').DataTable({
                    "destroy": true,
                    "order": [[2, "desc"]],
                    "responsive": true,
                    "scrollCollapse": true,
                    "lengthMenu": [[3], [3]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_",
                        "zeroRecords": "No hay demografico",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registro disponible",
                        "search": "Buscar:",
                        "paginate": {
                            "first": "Pri",
                            "last": "Ult",
                            "next": "Sig",
                            "previous": "Ant"
                        },
                    },
                });
            } else {
                mensaje('dark', '¡ATENCIÓN!', 'red', '¡Ocurrio un error con la modificación!');
            }
        }
    })
}

function crearNuevoDemografico(formulario) {
    if (formulario != '') {
        var form = $('#' + formulario);
    } else {
        var form = $(this);
    }
    var controlador = form.data('controlador');
    var metodo = form.data('metodo');
    var tipo = form.data('tipo');
    var datoBusqueda = form.data('dato');
    var div = form.data('div');
    /*if (form.parsley().validate() == true) {*/
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: form.serialize(),
        beforeSend: function () {
            $('#divCargando').fadeIn();
        },
        success: function (dataRespuesta) {
            $('#divCargando').fadeOut();
            if (dataRespuesta.respuesta == 'ok') {
                $('#' + dataRespuesta.div).html('');
                $('#' + dataRespuesta.div).html(dataRespuesta.plantilla);
                mensaje('dark', '¡ATENCIÓN!', 'green', '¡Su dato fue ingresado correctamente');
                $('.formularioEditarDemografico').on('click', formularioEditarDemografico);
                $('.tableDemografico').DataTable({
                    "destroy": true,
                    "order": [[2, "desc"]],
                    "responsive": true,
                    "scrollCollapse": true,
                    "lengthMenu": [[3], [3]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_",
                        "zeroRecords": "No hay demografico",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registro disponible",
                        "search": "Buscar:",
                        "paginate": {
                            "first": "Pri",
                            "last": "Ult",
                            "next": "Sig",
                            "previous": "Ant"
                        },
                    },
                });
                $('.telefonoGestion').dblclick(function () {
                    //var telefonos = $('#telefonosGestion').val();
                    $('#telefonosGestion').val($(this).data('telefono'));
                    window.getSelection($(this).data('telefono'));
                    document.execCommand("copy");
                    $('#visualizacionTelefonos').html('<h4><span class="label label-default"><strong><i class="fa fa-phone" style="color:#5cb85c;"></i>  ' + $(this).data('telefono') + '</strong></span></h4>');
                    $('#visualizacionTelefonos').fadeIn();
                    $('#bannerTelefono').fadeIn();
                });
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
    var identificacion = thiz.data('idenusuario');
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {
            metodo: 'obtenerPermisos',
            usuario: usuario,
            identificacion: identificacion
        },
        success: function (resultado) {
            $('#permisosUsuario').modal({ backdrop: 'static', keyboard: false });
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
                //$('#permisosUsuario').on('hidden.bs.modal', function () {
                mensaje('dark', '¡ATENCION!', 'green', 'Operanción completada');
                //})
            } else {
                $('#permisosUsuario').modal('hide');
                //$('#permisosUsuario').on('hidden.bs.modal', function () {
                mensaje('dark', '¡ERROR!', 'red', '¡Ups! algo salió mal por favor intenta de nuevo');
                //});
            }
        }
    });
}

function eliminarRegistro() {
    debugger;
    var thiz = $(this);
    var controlador = thiz.data('controlador');
    var metodo = thiz.data('metodo');
    $.confirm({
        icon: 'fa fa-warning',
        title: '¡Atención!',
        content: '¿Está seguro de eliminar el registro?',
        type: ' orange',
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
                        data: {
                            metodo: 'borrarRegistro',
                            id: thiz.data('id'),
                            accion: thiz.data('accion')
                        },
                        beforeSend: function () {
                            $('#divCargando').fadeIn();
                        },
                        success: function (datos) {
                            administracionCartera();
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
            administracionCartera();
        }
    })
}
function formularioEditarRegistro() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {
            metodo: 'formularioEditarRegistro',
            id: thiz.data('id'),
            tipo: thiz.data('tipo')
        },
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
        data: {
            metodo: 'formularioCrearRegistro',
            id: thiz.data('id'),
            tipo: thiz.data('tipo')
        },
        success: function (datos) {
            $('#editarRegistroContent').html(datos);
            $('#accionGuardarEditar').on('click', editarRegistro);
        }
    })
}


function reestablecerContraseña() {
    var thiz = $(this);
    var id = thiz.data('id');
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {
            metodo: 'reestablecerContraseña',
            id: id
        },
    })
        .done(function (data) {
            if (data == 'ok') {
                mensaje('dark', '¡ATENCIÓN!', 'green', 'Contraseña Actualizada Correctamente');
            } else {
                mensaje('dark', '¡ERROR!', 'red', 'Hubo un problema al actualizar la contraseña');
            }
        });
}

function administracionUsuarios() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: { metodo: 'administracionUsuarios' },
    })
        .done(function (data) {
            //                scriptIncial();
            $('#contenedor_data').html(data);
            $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
            $('.editarRegistro').on('click', editarRegistro);
            $('.reestablecerContraseña').on('click', reestablecerContraseña);
            $('.obtenerPermisos').on('click', obtenerPermisos);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('.busqueda').keyup(buscarDatos);
            $('#accionGuardarPermisos').on('click', GuardarPermisos);
        });
}


function estadoTarea() {
    var id = $(this).data('id');
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: 'estadoTarea',
            id: $(this).data('id')
        },
    })
        .done(function (respuesta) {
            $('#promedioGestionTarea_' + id).html('<strong>' + respuesta.promedio_gestion + ' MINUTOS</strong>');
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
            var myPieChart = new Chart(ctx, {
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
            var myPolarChart = new Chart(ctx1, {
                type: 'polarArea',
                data: dataPolar
            });
        });
}

function administracionTareas() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'administracionTareas',
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            //                scriptIncial();
            $('#contenedor_data').html(data);
            $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
            $('.AccionEstadoTarea').on('click', estadoTarea);
            $('.editarRegistro').on('click', editarRegistro);
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.cambiarOrdenTarea').on('click', formularioCambiarOrdenTarea);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('.busqueda').keyup(buscarDatos);
            $('#accionGuardarPermisos').on('click', GuardarPermisos);
        });
}

function administracionRoles() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: { metodo: 'administracionRoles' },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('#formularioCreacion').on('submit', crearNuevoRegistro);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#busquedaRoles').keyup(buscarDatos);
        });
}

function ingresoCarteras() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        data: { cartera: thiz.data('cartera') },
    }).done(function (data) {
        $('#contenedor_data').html(data);
    });
}

function administracionClientes() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: { metodo: 'administracionClientes' },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formCarga').on('submit', cargarArchivo);
            $(".inputCarga").fileinput({
                Locales: "es",
                browseLabel: 'Examinar...',
            });
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('#formularioCreacion').on('submit', crearNuevoCliente);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#busquedaRoles').keyup(buscarDatos);
        });
}

function crearParametroArbol() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: $('#formParametroArbol').serialize(),
    })
        .done(function (data) {
            mensaje('dark', '¡FELICIDADES!', 'green', 'Se guardo el dato correctamente');
        });
}


function parametroArbol() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'parametroArbol',
            cartera: $('#carteraActual').val(),
            tipo: thiz.data('tipo'),
            parametro: thiz.val()
        },
    })
        .done(function (data) {
            $('#resultadoParametroArbol').html(data);
            $('#formParametroArbol').on('submit', crearParametroArbol);
        });
}

function administracionArbol() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'administracionArbol',
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.parametroArbol').on('change', parametroArbol);
            $('#formularioCreacion').on('submit', crearNuevoCliente);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#busquedaRoles').keyup(buscarDatos);
        });
}

function administracionPermisos() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: { metodo: 'administracionPermisos' },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.activarOpcion').on('click', activarOpcion);
            $('#formularioCreacion').on('submit', crearNuevoRegistro);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#busqueda').keyup(buscarDatos);
        });
}
function borrarContenidoCarpeta() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'borrarContenidoCarpeta',
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            administracionInformes();
            mensaje('dark', '¡ATENCIÓN!', 'blue', data);
        });
}

function administracionInformes() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: {
            metodo: 'administracionInformes',
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.activarOpcion').on('click', activarOpcion);
            $('#formularioGenerar').on('submit', generarInforme);
            $('#informe').on('change', changeInforme);
            $('#btnBorrarCarpeta').on('click', borrarContenidoCarpeta);
            $('.eliminarArchivo').on('click', borrarFile);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#busqueda').keyup(buscarDatos);
            $('#busqueda').on('click');
            $('#datoBusqueda').prop('required', false);
            $('#tipo').prop('required', false);
        });
}

function borrarFile() {
    var thiz = $(this);
    var archivo = thiz.data('archivo');
    $.confirm({
        icon: 'fa fa-exclamation-triangle',
        title: '¡Atención!',
        content: '¿Está seguro que desea eliminar este Informe? ' + archivo,
        type: 'blue',
        buttons: {
            Confirmar: {
                btnClass: 'btn-danger',
                action: function () {
                    $.ajax({
                        url: "../../app/controllers/carterasController.php",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            metodo: 'borrarFile',
                            cartera: $('#carteraActual').val(),
                            nombreArchivo: archivo
                        },
                        success: function (respuesta) {
                            if (respuesta.resultado == 'ok') {
                                $.alert('¡Eliminado!');
                                administracionInformes();
                            } else {
                                $.alert('¡Hubo un error eliminando el Informe!');
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
        data: { metodo: 'administracionRegiones' },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
        });
}

function administracionDepartamentos() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: { metodo: 'administracionDepartamentos' },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
        });
}

function administracionCiudades() {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
        type: 'POST',
        data: { metodo: 'administracionCiudades' },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
        });
}

function changeInforme() {
    var thiz = this;
    if (thiz.value == "gestion_cliente") {
        $('.inforCliente').css("display", "block");
        $('#datoBusqueda').prop('required', true);
        $('#tipo').prop('required', true);
    } else {
        $('.inforCliente').css("display", "none");
        $('#datoBusqueda').prop('required', false);
        $('#tipo').prop('required', false);
    }
}

function generarInforme() {
    if ($("#formularioGenerar").parsley().validate() == true) {
        $.ajax({
            url: "../../app/controllers/carterasController.php",
            type: 'POST',
            data: $('#formularioGenerar').serialize(),
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
        })
            .done(function (resultado) {
                /*if (resultado == 'ok') {*/
                $('#divCargando').fadeOut();
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
        {
            valorBusqueda: textoBusqueda,
            metodo: metodo,
        },
        function (resultado) {
            $("#" + div_resultado).html(resultado);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.obtenerPermisos').on('click', obtenerPermisos);
            //scriptIncial();
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
        {
            metodo: 'perfilUsuario',
            usuario: thiz.data('usuario')
        },
        function (resultado) {
            $("#contenedor_data").html(resultado);
            $("#formularioActualizarInformacionPersonal").submit(actualizarInformacionPersonal);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
        });
}

function obtenerAlarmas() {
    $.ajax({
        url: "../../app/controllers/lavacascosController.php",
        type: 'POST',
        data: { metodo: 'obtenerAlarmas' },
    })
        .done(function (data) {
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
            if (data.resultado == 'ok') {
                $.alert({
                    icon: 'fa fa-comment-o',
                    title: 'Proceso Completado',
                    type: 'green',
                    theme: 'dark',
                    animation: 'rotateYR',
                    content: data.mensaje,
                });
                administracionCarga();
            } else {
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
        data: {
            metodo: 'administracionCarga',
            carteraActual: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.formCarga').on('submit', cargarArchivo);
            $('.fecha').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#busquedaRoles').keyup(buscarDatos);
            $(".inputCarga").fileinput({
                Locales: "es",
                browseLabel: 'Examinar...',
            });

        });
}


function administracionCartera() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'administracionCartera',
            carteraActual: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function () {
                var thiz = $(this);
                crearNuevoRegistro(thiz.data('formulario'));
            });
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('#formCargaGuion').on('submit', administracionGuion);
            $('#formObligatoriedad').on('submit', administrarObligatoriedad);
            $('#tipo_efecto').on('change', buscarGuion);
            $('#tipoefecto').on('change', configuracionObligatoriedad);
            $('#tipo_accion').on('change', busquedaAccion);
            $('#tipo_contacto').on('change', busquedaEfecto);
        });
}


function buscarGuion() {
    var valor = $('#tipo_efecto').val();
    var cartera = $('#carteraActual').val();
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: "POST",
        dataType: 'json',
        data: {
            metodo: 'buscarGuion',
            dato: valor,
            cartera: cartera
        }
    }).done(function (data) {
        $('#txtGuion').val(data);
    });
}

function administracionGuion() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: "json",
        data: $('#formCargaGuion').serialize()
    }).done(function (data) {
        if (data == 'ok') {
            mensaje('DARK', '¡Atencion!', 'green', 'Se he registrado el guion de forma exitosa');
        } else {
            mensaje('DARK', '¡Atencion!', 'red', '¡Ocurrio un error en la creacion del guion!');
        }
    });
}

function busquedaAccion() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: 'obtenerContactosAccion',
            accion: $(this).val(),
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            $('#tipo_contacto')
                .empty()
                .append('<option value="">..Seleccione..</option>');
            $.each(data.contacto, function (i, item) {
                $('#tipo_contacto').append(' <option value="' + item.id + '">' + item.homologado + '</option>');
            });
        });
}

function busquedaEfecto() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: "busquedaEfecto",
            contacto: $(this).val(),
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            $('#tipoefecto')
                .empty()
                .append('<option value="">..Seleccione..</option>');
            $.each(data.efecto, function (i, item) {
                $('#tipoefecto').append(' <option value="' + item.id + '">' + item.homologado + '</option>');
            });
        });
}

function configuracionObligatoriedad() {
    var cartera = $('#carteraActual').val();
    var valorAccion = $('#tipo_accion').val(), valorContacto = $('#tipo_contacto').val(), valorEfecto = $('#tipoefecto').val();
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: "POST",
        data: {
            metodo: 'administrarObligatoriedad',
            accion: valorAccion,
            contacto: valorContacto,
            efecto: valorEfecto,
            cartera: cartera
        }
    }).done(function (data) {
        $('#inputGestion').html(data);
        $('#formObligatoriedad').on('submit', administrarObligatoriedad);
    });
}

function administrarObligatoriedad() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: "json",
        data: $('#formObligatoriedad').serialize()
    }).done(function (data) {
        if (data == 'ok') {
            mensaje('DARK', '¡Atencion!', 'green', 'Se he registrado deforma exitosa');
        } else {
            mensaje('DARK', '¡Atencion!', 'red', '¡Ocurrio un error en la creacion!');
        }
    });
}


function cargarDatos(controlador, metodo) {
    $.ajax({
        url: "../../app/controllers/" + controlador,
        type: 'POST',
        data: { metodo: metodo, carteraActual: $('#carteraActual').val() },
        success: function (data) {
            $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function () {
                var thiz = $(this);
                crearNuevoRegistro(thiz.data('formulario'));
            });
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
            $('.editarRegistro').on('click', editarRegistro);
            $('.activarOpcion').on('click', activarOpcion);
            $('#formularioCreacion').on('submit', crearNuevoRegistro);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#busqueda').keyup(buscarDatos);
            $('.busqueda').keyup(buscarDatos);
            $('.obtenerPermisos').on('click', obtenerPermisos);
            $('#formularioCreacionUsuarios').on('submit', crearNuevoUsuario);
            //$('#nombreCambio').on('change', nombreCambio($(this)));
            $('#accionGuardarPermisos').on('click', GuardarPermisos);
        }
    });
}


function cargarDatosBusqueda(controlador, metodo, tipo, datoBusqueda) {
    $.ajax({
        url: "../../app/controllers/" + controlador,
        type: 'POST',
        data: {
            metodo: metodo,
            cartera: $('#carteraActual').val(),
            datoBusqueda: datoBusqueda,
            tipo: tipo
        },
        success: function (data) {
            $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function () {
                crearNuevoRegistro($(this));
            });
            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.eliminarRegistro').on('click', eliminarRegistro);
            $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
            //            $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
            $('.editarRegistro').on('click', editarRegistro);
            $('.activarOpcion').on('click', activarOpcion);
            $('#formularioCreacion').on('submit', crearNuevoRegistro);
            $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
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
function guardarTiempoMuerto() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: $('#formTiempos').serialize(),
    })
        .done(function (data) {
            //                $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function () {
                var thiz = $(this);
                crearNuevoRegistro(thiz.data('formulario'));
            });
            $('.eliminarRegistro').on('click', eliminarRegistro);
        });
}


function iniciarPausa(tiempo = '0', pausa = '', label = '') {
    debugger;
    $('#cronometroTiempos').val(tiempo);
    if (pausa == '') {
        var pausa = $(this).data('pausa');
        var label = $(this).data('label');
        var tiempo = 0;
    }
    var arm = $.alert({
        icon: 'fa fa-hourglass-o',
        title: 'PAUSAS',
        type: 'blue',
        escapeKey: false,
        backgroundDismiss: false,
        theme: 'supervan',
        columnClass: 'medium',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    cartera: $('#carteraActual').val(),
                    metodo: 'iniciarPausa',
                    parametro: 'formularioPausas',
                    label: label,
                    pausa: pausa
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            document.onkeydown = function (e) {
                var tecla = (e.which || e.keyCode);
                if (tecla == 116) {
                    return false;
                }
            };
            $('.inputEnter').keypress(function (e) {
                if (e.which == 13) {
                    terminarPausa();
                    arm.close();
                }
            });
            $('.cronometro').timer({
                format: '%H:%M:%S',
                seconds: tiempo,
                duration: '1s',
                callback: function () {
                    $.ajax({
                        url: "../../app/controllers/carterasController.php",
                        type: 'POST',
                        data: {
                            metodo: 'guardarTiemposSesion',
                            tiempo: $('#cronometroTiempos').val(),
                            cartera: $('#carteraActual').val(),
                            tipo: pausa,
                            label: $('#carteraActual').val(),
                        },
                    })
                },
                repeat: true
            });
            $('#estadoPausa').val('1');
        },
        buttons: {
            DESBLOQUEAR: {
                btnClass: 'btn-info',
                action: function () {

                    document.onkeydown = function (e) {
                        return true;
                    };
                    $.ajax({
                        url: "../../app/controllers/carterasController.php",
                        type: 'POST',
                        data: {
                            password: $('#passwordTiempos').val(),
                            metodo: 'validarCredenciales',
                            cartera: $('#carteraActual').val()
                        },
                    })
                        .done(function (data) {
                            if (data == 1) {
                                $('.cronometro').timer('pause');
                                guardarTiempoMuerto();
                                arm.close();
                                $('#estadoPausa').val('0');
                            } else {
                                $('#mensaje_error_tiempos').fadeIn().delay(1000).fadeOut();
                            }
                        });
                    return false;
                }
            }
        }
    });
}

function scriptIncial() {
    notificacionChats();
    $('.tableDemografico').DataTable({
        "destroy": true,
        "order": [[2, "desc"]],
        "responsive": true,
        "scrollCollapse": true,
        "lengthMenu": [[3], [3]],
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No hay demografico",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registro disponible",
            "search": "Buscar:",
            "paginate": {
                "first": "Pri",
                "last": "Ult",
                "next": "Sig",
                "previous": "Ant"
            },
        },
    });
    setInterval('obtenerMensajes(undefined)', 5000);
    $.datetimepicker.setLocale('es');
    $(document).on('click', function (ev) {
        ev.stopImmediatePropagation();
        $(".dropdown-toggle").dropdown("active");
    });
    $('.formCarga').on('submit', cargarMensajes);
    $('.inputCarga').fileinput({
        Locales: "es",
        browseLabel: ' Examinar...',
    });
    $('#accionClientes').on('click', administracionClientes);
    //$('.accionBuscarDeudores').on('click', buscarDeudores);
    $('.accionBuscarDeudoresEdad').on('click', buscarDeudoresEdad);
    $('.btnSoporte').on('click', btnSoporte);
    //$('.btnChat').on('click', panelChat)
    $('.btnCalculadora').on('click', function () {
        $.confirm({
            title: 'Calculadora',
            theme: 'dark',
            type: 'blue',
            columnClass: 'medium',
            backgroundDismiss: true,
            content: 'Elige una calculadora para continuar',
            buttons: {
                proyeccionReestructuracion: {
                    text: 'Cancelación Total',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        calculadoraCancelacion();
                    }
                },
                consumo: {
                    text: 'Puesta al día',
                    btnClass: 'btn-green',
                    keys: ['enter', 'shift'],
                    action: function () {
                        calculadoraPuestaAlDia();
                    }
                }
            }
        })
    })
    $('#accionUsuarios').on('click', administracionUsuarios);
    $('#accionRoles').on('click', administracionRoles);
    $('.accionInformes').on('click', administracionInformes);
    $('#accionPermisos').on('click', administracionPermisos);
    $('.accionSolicitudReestructuracion').on('click', formularioReestructuracion);
    $('.accionAsignarEdadMora').on('click', panelAsignacionMora);
    $('.accionExportarSolicitud').on('click', function () {
        var cedula = $(this).data('cedula');
        $.ajax({
            url: '../../app/controllers/carterasController.php',
            type: 'POST',
            data: {
                metodo: 'generarPDFReestructuracion',
                cedula: cedula
            },
        }).done(function (response) {
            var url = response;
            window.open(url, 'dowload');
        });
    });
    $('.accionOpcionSimuladores').on('click', function () {
        $.confirm({
            icon: 'fa fa-calculator',
            title: 'SIMULARES DISPONIBLES',
            type: 'blue',
            escapeKey: true,
            backgroundDismiss: true,
            theme: 'dark',
            columnClass: 'small',
            animation: 'rotateYR',
            content: 'Elige un simulador para continuar',
            buttons: {
                proyeccionReestructuracion: {
                    text: 'Reestructuracion',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        simuladorReestructuracion();
                    }
                },
                consumo: {
                    text: 'Consumo',
                    btnClass: 'btn-green',
                    keys: ['enter', 'shift'],
                    action: function () {
                        simuladorConsumo();
                    }
                }
            }
        });
    });
    $('.formularioEditarDemografico').on('click', formularioEditarDemografico);
    $('#accionArbol').on('click', administracionArbol);
    $('#accionRegiones').on('click', administracionRegiones);
    $('#accionDepartamentos').on('click', administracionDepartamentos);
    $('#accionCiudades').on('click', administracionCiudades);
    $('#accionPerfil').on('click', perfilUsuario);
    $('#autocompletar').on('click', autocompletar);
    $('#btnSeleccionarObligaciones').on('click', seleccionarObligacionesGestion);
    $('#accionTareas').on('click', administracionTareas);
    $('#accionConfiguracionCartera').on('click', administracionCartera);
    $('#accionMiProductividad').on('click', miProductividad);
    $('.ingresoCarteras').on('click', ingresoCarteras);
    $('.historicoGestion').on('click', ingresoCarteras);
    $('.refereciaObligacionGestion').on('click', resultadoReferencia);
    /*$('.tablaHistoricoGestion').DataTable({
        "responsive": true,
        "scrollX": true,
        "order": [[0, "desc"]],
        "scrollCollapse": true,
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No encontrador - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registro disponible",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
    });*/
    $('.formularioCreacion').on('click', crearNuevoRegistro);
    $('.accionCargar').on('click', administracionCarga);
    $('.btnFormularioCreacionRegistroBusqueda').on('click', formularioCreacionRegistroBusqueda);
    $('.btnFormularioCreacionDemografico').on('click', formularioCreacionDemografico);
    $('.pausa').on('click', iniciarPausa);
    new Clipboard('.cedulaGestion');
    $('.telefonoGestion').dblclick(function () {
        //        var telefonos = $('#telcontacto_gestionefonosGestion').val();
        $('#telefonosGestion').val($(this).data('telefono'));
        window.getSelection($(this).data('telefono'));
        document.execCommand("copy");
        $('#visualizacionTelefonos').html('<h4><span class="label label-default"><strong><i class="fa fa-phone" style="color:#5cb85c;"></i>  ' + $(this).data('telefono') + '</strong></span></h4>');
        $('#visualizacionTelefonos').fadeIn();
        $('#bannerTelefono').fadeIn();
    });
    //    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
    $('.fecha').datetimepicker({
        format: 'Y-m-d H:i:s'
    });
    $(".accionAgregarGestion").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $("#sidebar-wrapper").attr('style', '');
    });
    $(".accionPagos").click(function (e) {
        e.preventDefault();
        $('#modalPagos').modal('show');
        $('#tablepagos').DataTable({
            "destroy": true,
            "responsive": true,
            "order": [[2, "desc"]],
            "scrollCollapse": true,
            "lengthMenu": [[3, 6, 9, -1], [3, 6, 9, "Todos"]],
            "language": {
                "lengthMenu": "Mostrar _MENU_",
                "zeroRecords": "No se encontraron pagos - sorry",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registro disponible",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
        });
    });
    $('.formularioEditarDemografico').on('click', formularioEditarDemografico);
    $('#accionRegiones').on('click', administracionRegiones);
    $('#accionDepartamentos').on('click', administracionDepartamentos);
    $('#accionCiudades').on('click', administracionCiudades);
    $('#accionPerfil').on('click', perfilUsuario);
    $('#autocompletar').on('click', autocompletar);
    $('#accionConfiguracionCartera').on('click', administracionCartera);
    $('#accionMiProductividad').on('click', miProductividad);
    $('.ingresoCarteras').on('click', ingresoCarteras);
    $('.formularioCreacion').on('click', crearNuevoRegistro);
    $('.accionCargar').on('click', administracionCarga);
    $('.pausa').on('click', iniciarPausa);
    new Clipboard('.cedulaGestion');
    $('.telefonoGestion').dblclick(function () {
        //        var telefonos = $('#telefonosGestion').val();
        $('#telefonosGestion').val($(this).data('telefono'));
        window.getSelection($(this).data('telefono'));
        document.execCommand("copy");
        $('#visualizacionTelefonos').html('<h4><span class="label label-default"><strong><i class="fa fa-phone" style="color:#5cb85c;"></i>  ' + $(this).data('telefono') + '</strong></span></h4>');
        $('#visualizacionTelefonos').fadeIn();
        $('#bannerTelefono').fadeIn();
    });
    $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
    $('.formHomologado').on('submit', function () {
        var thiz = $(this);
        crearNuevoRegistro(thiz.data('formulario'));
    });
    $(".ventanaMovimiento").draggable().resizable();
    $("#accionGestion").on('change', resultadoAccion);
    $("#contacto_gestion").on('change', resultadoContacto);
    $('.refereciaObligacionGestion').on('click', resultadoReferencia);
    $(".obligacionGestion").on('click', validarCheckObligacion);
    $('#formCargaGuion').on('submit', administracionGuion);
    $("#marckAll").on('click', marcarAll);
    $("#efecto_gestion").on('change', resultadoEfecto);
    $('.obtenerPermisos').on('click', obtenerPermisos);
    //    $('#accionGuardarPermisos').on('click', GuardarPermisos);
    $('#formularioGestion').on('submit', function(){
        if($('#carteraActual').val() == 9 || $('#carteraActual').val() == 19){
            var check = 0;
            $('.obligacionGestion').each(function(){
                if($('.obligacionGestion').is(':checked')){
                    check = 1;
                }
            })
            if(check == 1){
                guardarGestion();
            }else{
                mensaje('dark', '', 'red', 'Debes seleccionar una obligacion');
            }
        }else{
            guardarGestion();
        }
    });
    $('#formCargaGuion').on('submit', administracionGuion);
    $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
    $('.btnFormularioCreacionRegistroBusqueda').on('click', formularioCreacionRegistroBusqueda);
    $('.btnFormularioCreacionDemografico').on('click', formularioCreacionDemografico);
    $('.formularioCreacion').on('submit', crearNuevoRegistro);
    if (typeof $('#carteraActual').val() != "undefined" && $('#carteraActual').val() != null) {
        var dNow = new Date();
        var localdate = dNow.getFullYear() + '-' + (dNow.getMonth() + 1) + '-' + dNow.getDate() + ' ' + dNow.getHours() + ':' +
            dNow.getMinutes() + ':' + dNow.getSeconds();
        $('#inicioGestion').val(localdate);
        consultarNotificaciones();
        setInterval('consultarTareas()', 10000);
        setInterval('consultarNotificaciones()', 300000);
    }
    setInterval('notificacionChats()', 30000);
    $('#launchPhone').on('click', function (event) {
        event.preventDefault();
        // This is set when the phone is open and removed on close
        if (!localStorage.getItem('ctxPhone')) {
            window.open(url, 'ctxPhone', features);
            return false;
        } else {
            window.alert('Phone already open.');
        }
    });
    $('.tablaHistoricoGestion').DataTable({
        "responsive": true,
        "scrollX": true,
        "order": [[0, "desc"]],
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No encontrador - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registro disponible",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
    });
    // $(document).on("idle.idleTimer", function (event, elem, obj) {
    //     var roles = { 4: 4};
    //     if ($('#carteraActual').val() != null && ($('#rolActual').val() in roles)) {
    //         if ($('#estadoPausa').val() == 0) {
    //             iniciarPausa(0, 'tiempo_muerto', 'Tiempo Muerto');
    //         }
    //     }
    // });
    // $(document).idleTimer();
    // // idleTimer() takes an optional numeric argument that defines just the idle timeout
    // // timeout is in milliseconds
    // $(document).idleTimer(120000);

}


function buscarDeudor() {
    form = $('#formularioBusquedaDudores').serialize();
    url = "../../app/controllers/carterasController.php?" + form;
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
        location.assign(url);
    }
}

function buscarDeudorAgendamiento() {
    var cartera = $('#carteraActual').val();
    var thiz = $(this);
    url = "../../app/controllers/carterasController.php?tipo=cedula&datoBusqueda=" + thiz.data('cedula') + "&metodo=buscarDeudor&cartera=" + cartera;
    window.open(url);
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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosVarios',
                    parametro: 'formularioBusquedaDeudores'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('.inputEnter').keypress(function (e) {
                if (e.which == 13) {
                    buscarDeudor();
                }
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

function buscarDeudorDemografico(){
    var content = $('#divFormularioBusquedaDeudores').html();
    var cartera = $(this).data('cartera');
    $.alert({
        icon: 'fa fa-search',
        title: 'BUSCAR',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    cartera: cartera,
                    metodo: 'formulariosVarios',
                    parametro: 'buscarDeudorDemografico'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('.inputEnter').keypress(function (e) {
                if (e.which == 13) {
                    exportarDeudorDemografico();
                }
            });
        },
        buttons: {
            BUSCAR: {
                btnClass: 'btn-info',
                action: function () {
                    exportarDeudorDemografico();
                }
            }
        }
    });
}

function exportarDeudorDemografico() {
    var cartera = $('#cartera').val();
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            cartera: cartera,
            metodo: 'exportarDeudorDemografico',
            cedula: $('#cedula').val()
        }
    }).done(function(data){
        $.alert({
            title: 'Demograficos',
            theme: 'material',
            color: 'blue',
            backgroundDismiss: true,
            columnClass: 'large',
            content: data
        })
    })
}

function simuladorReestructuracion() {
    var cartera = $(this).data('cartera');
    $.alert({
        icon: 'fa fa-search',
        title: 'SIMULADOR DE PROYECCIÓN DE REESTRUCTURACIÓN',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'xlarge',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    cartera: cartera,
                    metodo: 'formulariosSimuladores',
                    cedula_deudor: $('#cedula_deudor').val(),
                    parametro: 'proyecccionReestructuracion'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            var capital = 0, tasa_efectiva = 0, tasa_nominal = 0, plazo = 0, cuota_sin_seguro = 0, cuota_con_seguro = 0,
                abono_capital = 0, abono_intereses = 0, valor_seguro, valor_seguro, saldo_final = 0;
            $('.accionSeleccionObligacionSimulador').click(function () {
                var saldo_obligacion = $(this).data('obligacion');
                if (!$(this).prop('selected')) {
                    capital = saldo_obligacion + capital;
                    $(this).prop('selected', true);
                } else {
                    capital = capital - saldo_obligacion;
                    $(this).prop('selected', false);
                }
                $('#txtCapital').val("$" + new Intl.NumberFormat().format(capital));
            });
            $('#iniciarSimulacionReestructuracion').click(function () {

                if ($('#txtCapital').val() != '' && $('#txtTasaEfectiva').val() != ''
                    && $('#txtSeguroMensual').val() != '' && $('#cuotas_simulador_reestructuracion').val() != '') {
                    plazo = $('#cuotas_simulador_reestructuracion').val();
                    capital = $('#txtCapital').val().replace("'", "").replace(".", "");
                    tasa_efectiva = $('#txtTasaEfectiva').val();
                    valor_seguro = $('#txtSeguroMensual').val().replace(".", "");
                    var percent = 1 + (tasa_efectiva.replace('%', ''));
                    var num2 = (1 / 12);
                    tasa_nominal = ((Math.pow((Number(percent) / 100), num2) - 1) * 12) * 100;
                    cuota_sin_seguro = pagoExcel(Number(capital.replace(/[$,]+/g, "")), (plazo / 12), tasa_nominal);
                    cuota_con_seguro = Number(cuota_sin_seguro) + Number(valor_seguro);
                    var capital_calculo = Number(capital.replace(/[$,]+/g, ""));
                    abono_intereses = capital_calculo * ((tasa_nominal.toFixed(2) / 12) / 100);
                    abono_capital = (cuota_sin_seguro - abono_intereses);
                    saldo_final = (capital_calculo - Number(abono_capital));

                    $('#lblTasaNominal').html('<i class="fa fa-hand-o-right"></i> <strong>Tasa Nominal: ' + tasa_nominal.toFixed(2) + '</strong><i class="fa fa-percent"></i>');
                    $('#txtCuotaMensualSimulado').html("$" + new Intl.NumberFormat().format(cuota_con_seguro));
                    $('#txtCuotaSinSeguroSimulado').html("$" + new Intl.NumberFormat().format(cuota_sin_seguro));
                    $('#txtAbonoCapitalSimulado').html("$" + new Intl.NumberFormat().format(abono_capital.toFixed(0)));
                    $('#txtAbonoInteresesSimulado').html("$" + new Intl.NumberFormat().format(abono_intereses.toFixed(0)));
                    $('#txtValorSeguroSimulado').html("$" + new Intl.NumberFormat().format(valor_seguro));
                    $('#txtSaldoFinalSimulado').html("$" + new Intl.NumberFormat().format(saldo_final.toFixed(0)));
                } else {
                    $.alert('Por favor completa todos los campos');
                }
            });
        }
    });
}

function pagoExcel(monto = 0, anios = 0, intereses = 0) {
    var a = 0;
    // Pagos Anuales
    var m = 12;
    // Tipo de interés fraccionado (del periodo)
    var im = intereses / m / 100;

    var im2 = Math.pow((1 + im), -(m * anios));

    // Cuota Cap. + Int.
    a = ((monto * im) / (1 - im2));
    return a.toFixed(0);
}

function simuladorConsumo() {
    var cartera = $(this).data('cartera');
    $.alert({
        icon: 'fa fa-calculator',
        title: 'SIMULADOR DE CONSUMO',
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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosSimuladores',
                    cedula_deudor: $('#cedula_deudor').val(),
                    parametro: 'consumo'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            var saldo_total = 0, capital = 0, intereses = 0, primer_cuota = 0, tasa_mensual = 0.021, cuotas = 0,
                disponible = 0, diferencia = 0, reduccion = 0, capacidad = 0;
            $('#obligacion_simulador_consumo').change(function () {
                $('#txtValorAdeudado').val("$" + new Intl.NumberFormat().format($(this).val()));
            });
            $('#iniciarSimulacionConsumo').click(function () {
                if ($('#cuotas_simulador_consumo').val() != '' && $('#inpIngresos').val() != ''
                    && $('#inpGastos').val() != '' && $('#inpCuotaActual').val() != ''
                    && $('#inpCuotaActual').val() != '' && $('#txtValorAdeudado').val() != ''
                    && $('#obligacion_simulador_consumo').val() != '') {
                    cuotas = $('#cuotas_simulador_consumo').val();
                    saldo_total = $('#txtValorAdeudado').val().replace("'", "").replace(".", "");
                    capital = Math.round(Number(saldo_total.replace(/[$,]+/g, "")) / cuotas);
                    intereses = Math.round(Number(saldo_total.replace(/[$,]+/g, "")) * tasa_mensual);
                    primer_cuota = Math.round(capital + intereses);
                    disponible = (Number($('#inpIngresos').val().replace(/[$,]+/g, "").replace("'", "").replace(".", "")) - Number($('#inpGastos').val().replace(/[$,]+/g, "").replace("'", "").replace(".", "")));
                    diferencia = (Number($('#inpCuotaActual').val().replace(/[$,]+/g, "").replace("'", "").replace(".", "")) - primer_cuota);
                    reduccion = 100 - ((((diferencia / Number($('#inpCuotaActual').val().replace(/[$,]+/g, "").replace("'", "").replace(".", ""))) * 100)) + 100);
                    capacidad = disponible / primer_cuota;

                    $('#txtPlazoSimulado').html(cuotas);
                    $('#txtCapitalSimulado').html("$" + new Intl.NumberFormat().format(capital));
                    $('#txtInteresSimulado').html("$" + new Intl.NumberFormat().format(intereses));
                    $('#txtCuotaSimulado').html("$" + new Intl.NumberFormat().format(primer_cuota));
                    $('#txtDisponible').html("$" + new Intl.NumberFormat().format(disponible));
                    $('#txtReduccion').html(new Intl.NumberFormat().format(reduccion.toFixed(1)) + "%");
                    $('#txtDiferencia').html("$" + new Intl.NumberFormat().format(diferencia));
                    if (capacidad >= 1) {
                        $('#txtTieneCapacidad').html('<div class="alert alert-success" role="alert">SI</div>');
                    } else {
                        $('#txtTieneCapacidad').html('<div class="alert alert-danger" role="alert">NO</div>');
                    }
                } else {
                    $.alert('Por favor completa todos los campos');
                }
            });
        }
    });
}


function formularioCambiarOrdenTarea() {
    var content = $('#divFormularioBusquedaDeudores').html();
    var cartera = $('#carteraActual').val();
    var id_tarea = $(this).data('id');
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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosVarios',
                    id_tarea: id_tarea,
                    parametro: 'formularioCambiarOrden'
                },
            }).done(function (response) {
                self.setContent(response);
            })
        },
        onContentReady: function () {
            $('#filtro1').on('change', function () {
                ($('#filtro1').val() != '') ? $('.orden').removeClass('hide') : '';
            });
            $('#filtro2').on('change', function () {
                ($('#filtro2').val() != '') ? $('.orden1').removeClass('hide') : '';
            });
        },
        buttons: {
            APLICAR: {
                btnClass: 'btn-info',
                action: function () {
                    cambiarOrdenTarea();
                }
            }
        }
    });
}

function miProductividad() {
    var content = $('#divFormularioBusquedaDeudores').html();
    var cartera = $('#carteraActual').val();
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            cartera: cartera,
            metodo: 'miProductividad'
        },
    }).done(function (response) {
        var ctx2 = $("#miProductividadCanvas");
        var dataPolar = {
            datasets: [{
                data: [/*response.resultados.clientes,
                     response.resultados.gestiones,
                     response.resultados.promesas,
                     response.resultados.posibles,*/
                    response.resultados.directos],
                backgroundColor: [/*'#22CECE', '#059BFF', '#FF3D67', '#FFC233',*/ '#AC83FF'],
            }],
            labels: [/*'Clientes', 'Gestiones', 'Promesas', 'Posibles',*/ 'Directos']
        };
        var myPolarChart = new Chart(ctx2, {
            type: 'polarArea',
            data: dataPolar
        });
        $('#modalMiProductividad').modal("show");
    });
}
function miProductividadGrafica(datos) {

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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosCreacionRegistro',
                    parametro: parametro,
                    identificacion: identificacion
                },
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

function seleccionarObligacionesGestion() {
    var parametro = $(this).data('parametro');
    var identificacion = $(this).data('identificacion');
    var cartera = $('#carteraActual').val();
    var jc = $.confirm({
        icon: 'fa fa-search',
        title: 'OBLIGACIONES',
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
                data: {
                    cartera: cartera,
                    metodo: 'seleccionarObligacionesGestion',
                    parametro: parametro,
                    identificacion: identificacion
                },
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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosCreacionRegistro',
                    parametro: parametro,
                    identificacion: identificacion
                },
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

function formularioCreacionDemografico() {
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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosCreacionDemografico',
                    parametro: parametro,
                    identificacion: identificacion
                },
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
                    $('.formularioCreacion').on('submit', crearNuevoDemografico(formulario));
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
        data: {
            metodo: 'obtenerContactosAccion',
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

function cambiarOrdenTarea() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: $('#formularioCambiarOrden').serialize(),
    })
        .done(function (data) {
            mensaje('dark', 'ATENCION', 'green', 'Sus cambios se realizaron correctamento');
        });
}

function resultadoContacto() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: 'obtenerEfectosContacto',
            contacto: $(this).val(),
            cartera: $('#carteraActual').val()
        },
    })
        .done(function (data) {
            if (thiz.val() == '51' && $('#carteraActual').val() == '2') {
                el = document.getElementsByClassName('obligacionGestion');
                var chequeada = false; //at least one cb is checked
                var posicion = 0;
                for (i = 0; i < el.length; i++) {
                    if (el[i].checked === true) {
                        chequeada = true;
                        posicion = i;
                    }
                }

                if (chequeada === true) {
                    for (i = 0; i < el.length; i++) {
                        el[i].required = false;
                    }
                } else {
                    for (i = 0; i < el.length; i++) {
                        el[i].required = true;
                    }
                }
                $('#fecha_seguimiento').prop('required', true);
            } else {
                if($("#contacto_gestion option:selected").text() == ('DIRECTO') || $("#contacto_gestion option:selected").text() == ('DIRECT CONTACT') ){
                    $('#motivo_gestion').prop('required', true);
                }else{
                    $('#motivo_gestion').prop('required', false);
                }
                $('#actividad_gestion').prop('required', false);
            }
            $('#efecto_gestion')
                .empty()
                .append('<option value="">..Seleccione..</option>');
            $('#motivo_gestion')
                .empty()
                .append('<option value="">..Seleccione..</option>');
            $('#actividad_gestion')
                .empty()
                .append('<option value="">..Seleccione..</option>');
            $.each(data.efecto, function (i, item) {
                $('#efecto_gestion').append(' <option value="' + item.id + '">' + item.homologado + '</option>');
            });
            $.each(data.motivos, function (i, item) {
                $('#motivo_gestion').append(' <option value="' + item.id + '">' + item.motivo + '</option>');
            });
            $.each(data.actividades, function (i, item) {
                $('#actividad_gestion').append(' <option value="' + item.id + '">' + item.actividad + '</option>');
            });
            $('#divEfectoGestion').fadeIn();
        });
}

function validarCheckObligacion() {
    if ($('#carteraActual').val() == '2') {
        el = document.getElementsByClassName('obligacionGestion');
        var chequeada = false; //at least one cb is checked
        var posicion = 0;
        for (i = 0; i < el.length; i++) {
            if (el[i].checked === true) {
                chequeada = true;
                posicion = i;
            }
        }

        if (chequeada === true) {
            for (i = 0; i < el.length; i++) {
                el[i].required = false;
            }
        } else {
            for (i = 0; i < el.length; i++) {
                el[i].required = true;
            }
        }

    }
}

function marcarAll() {
    debugger;
    var thiz = this;
    el = document.getElementsByClassName('obligacionGestion');
    if (thiz.checked == true) {
        for (i = 0; i < el.length; i++) {
            el[i].checked = true;
        }
        $('#marcarall').text('Desmarcar');
    } else {
        for (i = 0; i < el.length; i++) {
            el[i].checked = false;
        }
        $('#marcarall').text('Marcar Todas');
    }
}

function resultadoEfecto() {
    var cartera = $('#carteraActual').val();
    var valorAccion = $('#accionGestion').val(), valorContacto = $('#contacto_gestion').val(), valorEfecto = $(this).val();
    var textActual = $('#observacionesGestion').val();
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: "POST",
        dataType: 'json',
        data: {
            metodo: 'searchObligatoriedad',
            accion: valorAccion,
            contacto: valorContacto,
            efecto: valorEfecto,
            cartera: cartera
        }
    }).done(function (data) {
        if(cartera == 9){
            if($("#efecto_gestion option:selected").text() == ('ABONOS PARCIALES') 
            || $("#efecto_gestion option:selected").text() == ('POSIBLE NEGOCIACION') 
            || $("#efecto_gestion option:selected").text() == ('PAGO TOTAL')
            || $("#efecto_gestion option:selected").text() == ('COMPROMISO DE PAGO')){
                $('#valor_acuerdo').prop('required', true);
                $('#fecha_acuerdo').prop('required', true);
            }else{
                $('#valor_acuerdo').removeAttr('required');
                $('#fecha_acuerdo').removeAttr('required');
            }
            if($('#accionGestion option:selected').text() == 'PROYECCION'){
                if($("#efecto_gestion option:selected").text().includes('MES')){
                    $('#valor_acuerdo').prop('required', true);
                    $('#fecha_acuerdo').prop('required', true);
                }else{
                    $('#valor_acuerdo').removeAttr('required');
                    $('#fecha_acuerdo').removeAttr('required');
                }
            }
        }
        for (var i = 0; i < data.campos.inputs.length; i++) {
            var input = data.campos.inputs[i];
            var set = false;
            $.each(data.campos.asignados, function (i, item) {
                if (input.id_input == item[0].id_input) {
                    $("#" + item[0].id_input).prop('required', true);
                    set = true;
                } else {
                    if (set != true) {
                        $("#" + input.id_input).prop('required', false);
                    }
                }
            })
        }
    });
    if (cartera == 5 || cartera == 13) {
        $.ajax({
            url: "../../app/controllers/carterasController.php",
            type: "POST",
            dataType: "json",
            data: {
                metodo: 'homologadoGevening',
                efecto: valorEfecto,
                cartera: cartera
            }
        }).done(function (data) {
            $('#homologadoGevening').val(data);
        });
    }
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: "POST",
        dataType: 'json',
        data: {
            metodo: 'buscarGuion',
            dato: valorEfecto,
            cartera: cartera
        }
    }).done(function (data) {
        var valor = (data == null) ? '' : data;
        $('#observacionesGestion').val(textActual + valor);
    });
}

function autocompletar() {
    var dataString = $('#formularioGestion').serialize();
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: { metodo: 'autocompletar', datos: dataString },
    })
        .done(function (data) {
            $('#observacionesGestion').val(data);
        });
}

function refrescarHistorico() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'refrescarHistorico',
            cedula_deudor: $('#cedula_deudor').val(),
            cartera: $('#carteraGestion').val()
        },
    })
        .done(function (data) {
            $('#divHistoricoGestion').html(data);
            $('.tablaHistoricoGestion').DataTable({
                "responsive": true,
                "scrollX": true,
                "order": [[0, "desc"]],
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_",
                    "zeroRecords": "No encontrador - sorry",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registro disponible",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
            });
        });
}

function guardarGestion() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: $('#formularioGestion').serialize()
    })
        .done(function (data) {
            new Clipboard('#observacionesGestion');
            refrescarHistorico();
            mensaje('dark', 'ATENCION', 'green', 'Gestión Guardada Correctamente');
            $('#btnAgregarGestion').click();
        });
}

function buscarDeudoresTarea() {
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
            if (data.resultado == 'ok') {
                $('#contenedor_data').html(data.plantilla);
                $('.siguienteClienteTarea').on('click', buscarDeudoresTarea);
                scriptIncial();
            } else {
                mensaje('dark', 'ATENCION', 'blue', 'La tarea ha finalizado');
                $(location).delay(1000).attr('../../app/controllers/carterasController.php?&cartera=' + $('#carteraActual').val(), url);
            }
        });
}
function consultarTareas() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: 'consultarTareas',
            cartera: $('#carteraActual').val()
        }
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

function resultadoReferencia() {
    if ($('#carteraActual').val() == '5' || $('#carteraActual').val() == '13') {
        var obligacion = $(this).data('obligacion');
        var metodo = 'busquedaReferencia';
        var cartera = $('#carteraActual').val();
        $.alert({
            icon: 'fa fa-ravelry',
            title: 'OBLIGACIÓN',
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
                    data: {
                        cartera: cartera,
                        metodo: metodo,
                        obligacion: obligacion
                    },
                }).done(function (response) {
                    self.setContent(response);
                });
            },
            onContentReady: function () {
                $('#tableReferencia').DataTable({
                    "destroy": true,
                    "responsive": true,
                    "order": [[2, "desc"]],
                    "scrollCollapse": true,
                    "lengthMenu": [[3], [3]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_",
                        "zeroRecords": "No se encontro la referencia",
                        "info": "Mostrando Página _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registro disponible",
                        "search": "Buscar:",
                        "paginate": {
                            "first": "Pri",
                            "last": "Ult",
                            "next": "Sig",
                            "previous": "Ant"
                        },
                    },
                });
            }
        });
    }
}


function consultarNotificaciones() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: 'consultarNotificaciones',
            cartera: $('#carteraActual').val()
        }
    })
        .done(function (data) {
            $('#resultadoAlarmas').html(data.plantilla);
            if (data.cantidad >= 1) {
                $.alert({
                    icon: 'fa fa-ravelry',
                    title: 'OBLIGACIÓN',
                    type: 'blue',
                    escapeKey: true,
                    backgroundDismiss: true,
                    theme: 'dark',
                    columnClass: 'medium',
                    animation: 'rotateYR',
                    content: "¡HOLA!, tienes un recordatorio, mira las notificaciones."
                });
                $('#badgeCantidadNotificaciones').html(data.cantidad);
                $('#spanCantidadNotificaciones').show();
                $('.cedulaAgendamiento').on('click', buscarDeudorAgendamiento);
            } else {
                $('#badgeCantidadTareas').html('');
                $('#spanCantidadTareas').hide();
                $('#badgeCantidadNotificaciones').html("");
                $('#spanCantidadNotificaciones').hide();
            }
        });
}

function formularioReestructuracionSubmit() {
    var formData = new FormData(document.getElementById($(this).data('form')));
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#divCargando').fadeIn();
        },
    }).done(function (data) {
        if (data.resultado == 'ok') {
            setTimeout(function () {
                mensaje('dark', 'Proceso Completado', 'blue', data.mensaje + ' <i class="fa fa-check-circle"></i><br><br>' + data.mensajeFalla + '  <i class="fa fa-exclamation-triangle"></i>', "cambioSelectPrueba");
                $('#divCargando').fadeOut();
            }, 1000);
        } else {
            setTimeout(function () {
                mensaje('dark', '¡Server data request is too big!', 'red', data.mensaje);
                $('#divCargando').fadeOut();
            }, 1000);
        }
        //$.alert({ title: data });
    });
}

function formularioReestructuracion() {
    var cartera = $(this).data('cartera');
    $.alert({
        title: '',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'xlarge',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    cartera: cartera,
                    metodo: 'formularioReestructuracion',
                    parametro: 'formularioReestructuracion'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('.inputEnter').keypress(function (e) {
                if (e.which == 13) {
                    buscarDeudor();
                }
            });
            $('.submitFormReestructuracion').on('click', formularioReestructuracionSubmit);

        }
    });
}

function btnSoporte() {
    var cartera = $(this).data('cartera');
    $.confirm({
        title: 'Soporte de errores',
        type: 'blue',
        theme: 'dark',
        columnClass: 'medium',
        backgroundDismiss: true,
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    cartera: cartera,
                    metodo: 'panelSoporte',
                    parametro: 'panelSoporte'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('.submitSoporte').on('click', submitSoporte);
        },
        buttons: {
            ok: {
                btnClass: 'hide'
            }
        }
    })
}

function submitSoporte() {
    var formData = new FormData($('#formSoporte').get(0));
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
    }).done(function (data) {
        if (data == 'ok') {
            mensaje('dark', 'Mensaje!', 'blue', 'Se ha enviado correctamente');
        } else {
            mensaje('dark', 'Mensaje!', 'red', 'No! se ha enviado');
        }
    });
}

function panelAsignacionMora() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'panelAsignacionMora',
            cartera: $('#carteraActual').val()
        },
        success: function (data) {
            $('#contenedor_data').html(data);
            $('#asesores').on('change', function () {
                let id = $('#asesores').val();
                $.ajax({
                    url: '../../app/controllers/carterasController.php',
                    type: 'POST',
                    data: {
                        metodo: 'buscarAsignacionMora',
                        id: id
                    },
                    success: function (data) {
                        $('#tablaAsignacion').html(data);
                        $('.formAsignarEdadMora').on('change', asignarEdadMora);
                    }
                })
            })
        }
    })
}

function asignarEdadMora() {
    let element = $(this);
    let id_usuario = $('#asesores').val();
    let id_edad = $(element).attr('id_edad');
    let cartera = $(element).attr('cartera');
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            metodo: 'asignarEdadMora',
            cartera: cartera,
            id_edad: id_edad,
            id_usuario: id_usuario
        }
    })
}

function buscarDeudoresEdad() {
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
                data: {
                    cartera: cartera,
                    metodo: 'formulariosVarios',
                    parametro: 'formularioBusquedaDeudoresEdad'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('.inputEnter').keypress(function (e) {
                if (e.which == 13) {
                    buscarDeudor();
                }
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

function calculadoraCancelacion() {
    $.alert({
        icon: 'fa fa-calculator',
        title: 'CALCULADORA CANCELACIÓN TOTAL',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'xlarge',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosSimuladores',
                    parametro: 'cancelacionTotal'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('#porcentajeInteresesCorrientes').on('keyup', function () {
                var interes = $('#interesesCorrientes').val();
                var porcentaje = $('#porcentajeInteresesCorrientes').val();
                $('#condonacionInteresesCorrientes').val((porcentaje * interes) / 100);
                $('#totalCondonaciones').text(Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionInteresesSeguros').val()) + Number($('#condonacionInteresesGAC').val()));
                $('#pagoClienteInteresesCorrientes').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteInteresesSeguros").val()) + Number($("#pagoClienteInteresesGAC").val()));
            });
            $('#porcentajeInteresesMora').on('keyup', function () {
                var interes = $('#interesesMora').val();
                var porcentaje = $('#porcentajeInteresesMora').val();
                $('#condonacionInteresesMora').val((porcentaje * interes) / 100);
                $('#totalCondonaciones').text(Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionInteresesSeguros').val()) + Number($('#condonacionInteresesGAC').val()));
                $('#pagoClienteInteresesMora').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteInteresesSeguros").val()) + Number($("#pagoClienteInteresesGAC").val()));
            });
            $('#porcentajeInteresesSeguros').on('keyup', function () {
                var interes = $('#seguros').val();
                var porcentaje = $('#porcentajeInteresesSeguros').val();
                $('#condonacionInteresesSeguros').val((porcentaje * interes) / 100);
                $('#totalCondonaciones').text(Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionInteresesSeguros').val()) + Number($('#condonacionInteresesGAC').val()));
                $('#pagoClienteInteresesSeguros').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteInteresesSeguros").val()) + Number($("#pagoClienteInteresesGAC").val()));
            });
            $('#capitalMora').on('keyup', function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            })
            $('#interesesCorrientes').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#interesesMora').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#seguros').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#gac').on("keyup", function () {
                $("#pagoClienteInteresesGAC").val(Number($('#gac').val()));
                $("#totalPagoCliente").val(Number($('#gac').val()));
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#valorDescuento').on('keyup', function () {
                $('#saldoDescuento').val((Number($('#saldoCapital').val()) * Number($('#valorDescuento').val()) / 100));
                $('#subtotal').val(Number($('#saldoCapital').val()) - Number($('#saldoDescuento').val()));
                $('#total').text(Number($('#subtotal').val()) + Number($('#totalPagoCliente').val()));
                $('#Total').val(Number($('#subtotal').val()) + Number($('#totalPagoCliente').val()));
            })
            $('#cuotas').on('keyup', function () {
                if (Number($('#cuotas').val()) !== 0) {
                    $('#cantidad').text((Number($('#Total').val()) / Number($('#cuotas').val())).toFixed(2));
                } else {
                    $('#cantidad').text('');
                }
            })
        },
        buttons: {
            ok: {
                btnClass: 'hide'
            }
        }
    });
}

function calculadoraPuestaAlDia() {
    $.alert({
        icon: 'fa fa-calculator',
        title: 'CALCULADORA PUESTA AL DÍA',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'xlarge',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosSimuladores',
                    parametro: 'puestaDia'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        onContentReady: function () {
            $('#porcentajeCapitalMora').on('keyup', function () {
                var interes = $('#capitalMora').val();
                var porcentaje = $('#porcentajeCapitalMora').val();
                $('#condonacionCapitalMora').val((porcentaje * interes) / 100);
                $('.totalCondonaciones').val(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#totalCondonaciones').text(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#pagoClienteCapitalMora').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteCapitalMora").val()) + Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteOtros").val()) + Number($("#pagoClienteInteresesSeguros").val()));
                $("#total").text(Number($('#totalPagoCliente').val()));
                $('#porcentajeCondonar').text(Number($("#totalPagoCliente").val()) / (Number($('#interesesCorrientes').val()) + Number($('#interesesMora').val()) + $('#seguros').val()));
            });
            $('#porcentajeInteresesCorrientes').on('keyup', function () {
                var interes = $('#interesesCorrientes').val();
                var porcentaje = $('#porcentajeInteresesCorrientes').val();
                $('#condonacionInteresesCorrientes').val((porcentaje * interes) / 100);
                $('.totalCondonaciones').val(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#totalCondonaciones').text(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#pagoClienteInteresesCorrientes').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteCapitalMora").val()) + Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteOtros").val()) + Number($("#pagoClienteInteresesSeguros").val()));
                $("#total").text(Number($('#totalPagoCliente').val()));
                $('#porcentajeCondonar').text(Number($("#totalPagoCliente").val()) / (Number($('#interesesCorrientes').val()) + Number($('#interesesMora').val()) + $('#seguros').val()));
            });
            $('#porcentajeInteresesMora').on('keyup', function () {
                var interes = $('#interesesMora').val();
                var porcentaje = $('#porcentajeInteresesMora').val();
                $('#condonacionInteresesMora').val((porcentaje * interes) / 100);
                $('.totalCondonaciones').val(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#totalCondonaciones').text(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#pagoClienteInteresesMora').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteCapitalMora").val()) + Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteOtros").val()) + Number($("#pagoClienteInteresesSeguros").val()));
                $("#total").text(Number($('#totalPagoCliente').val()));
                $('#porcentajeCondonar').text(Number($("#totalPagoCliente").val()) / (Number($('#interesesCorrientes').val()) + Number($('#interesesMora').val()) + $('#seguros').val()));
            });
            $('#porcentajeOtros').on('keyup', function () {
                var interes = $('#otros').val();
                var porcentaje = $('#porcentajeOtros').val();
                $('#condonacionOtros').val((porcentaje * interes) / 100);
                $('.totalCondonaciones').val(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#totalCondonaciones').text(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#pagoClienteOtros').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteCapitalMora").val()) + Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteOtros").val()) + Number($("#pagoClienteInteresesSeguros").val()));
                $("#total").text(Number($('#totalPagoCliente').val()));
                $('#porcentajeCondonar').text(Number($("#totalPagoCliente").val()) / (Number($('#interesesCorrientes').val()) + Number($('#interesesMora').val()) + $('#seguros').val()));
            });
            $('#porcentajeInteresesSeguros').on('keyup', function () {
                var interes = $('#seguros').val();
                var porcentaje = $('#porcentajeInteresesSeguros').val();
                $('#condonacionInteresesSeguros').val((porcentaje * interes) / 100);
                $('.totalCondonaciones').val(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#totalCondonaciones').text(Number($('#condonacionCapitalMora').val()) + Number($('#condonacionInteresesCorrientes').val()) + Number($('#condonacionInteresesMora').val()) + Number($('#condonacionOtros').val()) + Number($('#condonacionInteresesSeguros').val()));
                $('#pagoClienteInteresesSeguros').val((interes - (porcentaje * interes) / 100));
                $("#totalPagoCliente").val(Number($("#pagoClienteCapitalMora").val()) + Number($("#pagoClienteInteresesCorrientes").val()) + Number($("#pagoClienteInteresesMora").val()) + Number($("#pagoClienteOtros").val()) + Number($("#pagoClienteInteresesSeguros").val()));
                $("#total").text(Number($('#totalPagoCliente').val()));
                $('#porcentajeCondonar').text(Number($("#totalPagoCliente").val()));
            });
            $('#capitalMora').on('keyup', function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#otros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            })
            $('#interesesCorrientes').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#otros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#interesesMora').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#otros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#interesesMora').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#otros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#seguros').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#otros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#gac').on("keyup", function () {
                $('#saldoMora').text(Number($('#capitalMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesCorrientes').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#interesesMora').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#otros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#seguros').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")) + Number($('#gac').val().replace(",", "").replace("$", "").replace(".", "").replace("%", "")));
            });
            $('#porcentageGac').on("keyup", function () {
                $('.valorProyectado').val(((Number($("#totalPagoCliente").val()) * (Number($("#porcentageGac").val()))) / 100).toFixed());
                $('#valorProyectado').text(((Number($("#totalPagoCliente").val()) * (Number($("#porcentageGac").val()))) / 100).toFixed());

                $('#valorPagar').text(Number($("#totalPagoCliente").val()) + Number($(".valorProyectado").val()));
            });
            $('#valorRedondeado').on('keyup', function () {
                $('#gacTotal').text((Number($('#valorRedondeado').val()) - (Number($('#valorRedondeado').val() / 1.1785))).toFixed());
            });
        },
        buttons: {
            ok: {
                btnClass: 'hide'
            }
        }
    });
}

function panelChat() {
    $('#notify').hide();
    $.alert({
        icon: 'fa fa-comments',
        title: 'CHAT FIANZA',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'xlarge',
        animation: 'rotateYR',
        content: function () {
            var panel = this;
            var cartera = $(this).data('cartera');
            $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    cartera: cartera,
                    metodo: 'panelChat',
                    parametro: 'panelChat',
                },
            }).done(function (data) {
                panel.setContent(data);
            });
        },
        onContentReady: function () {
            $('.busqueda').keyup(function () {
                var thiz = $(this);
                var metodo = thiz.data('metodo');
                var div_resultado = thiz.data('div-resultado');
                var textoBusqueda = thiz.val();
                $.post("../../app/controllers/carterasController.php",
                    {
                        valorBusqueda: textoBusqueda,
                        metodo: metodo,
                    },
                    function (resultado) {
                        $("#" + div_resultado).html(resultado);
                        $("a").on("click", function () {
                            $('a').siblings().removeClass("active select");
                            $(this).addClass("active select");
                            receptor = $(this).data('idgrupo');
                            perfilActual = $('#usuarioActual').val();
                            $('#receptor').val(receptor);
                            marcarVisto(perfilActual, receptor);
                            obtenerMensajes(receptor);
                        });
                    })
            });
            $("a").on("click", function () {
                $('a').siblings().removeClass("active select");
                $(this).addClass("active select");
                receptor = $(this).data('idgrupo');
                perfilActual = $('#usuarioActual').val();
                $('#receptor').val(receptor);
                marcarVisto(perfilActual, receptor);
                obtenerMensajes(receptor);
            });
            $('.mensaje').focus();
            $('.mensaje').keydown(function (e) {
                if (e.which == 13) {
                    submitMensaje();
                    e.preventDefault();
                    return false;
                }
            });
            $('.inputCarga').fileinput({
                Locales: "es",
                browseLabel: ' Examinar...',
            });
        },
        buttons: {
            ENVIAR: {
                btnClass: 'hide',
            }
        }
    })
}

function submitMensaje() {
    var formData = new FormData(document.getElementById('formMensaje'));
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        dataType: 'html',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (data) {
        $('.mensaje').val('');
        obtenerMensajes(receptor);
        setTimeout(function(){
            $('.divu').scrollTop($('.divu').prop('scrollHeight'));
        }, 100);
    });
}

function obtenerMensajes(datos) {
    receptor = (datos !== undefined) ? datos : $('.select').data('idgrupo');
    $('#receptor').val(receptor);
    perfilActual = $('#usuarioActual').val();
    if (receptor != undefined) {
        marcarVisto(perfilActual, receptor);
        $.ajax({
            url: '../../app/controllers/carterasController.php',
            type: 'POST',
            data: {
                receptor: receptor,
                metodo: 'obtenerChats',
                parametro: 'obtenerChats'
            }
        }).done(function (data) {
            $("#mensajes").html(data);
            var position = $('.divu').scrollTop();
            if(position == 0){
                $('.divu').scrollTop($('.divu').prop('scrollHeight'));
            }
            $('.divu').scroll(function() {
                var scroll = $('.divu').scrollTop();
                position = scroll;
            });
            $('.mensaje').focus();
        })
    }
}

function notificacionChats() {
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            metodo: 'notificacionChats'
        }
    }).done(function (alerta) {
        if (alerta > 0) {
            $('#chatAudio')[0].play();
            $('#notify').show();
        } else {
            $('#notify').hide();
        }
    })
}

function marcarVisto(perfilActual, receptor) {
    $.post({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            metodo: "marcarVisto",
            receptor: receptor,
            actual: perfilActual
        }
    })
}

var url = '../../vendor/ctxSip/phone',
    features = 'menubar=no,location=no,resizable=no,scrollbars=no,status=no,addressbar=no,width=320,height=480';
$(document).ready(function () {
    notificacionChats();
    $('.tableDemografico').DataTable({
        "destroy": true,
        "order": [[2, "desc"]],
        "responsive": true,
        "scrollCollapse": true,
        "lengthMenu": [[3], [3]],
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No hay demografico",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registro disponible",
            "search": "Buscar:",
            "paginate": {
                "first": "Pri",
                "last": "Ult",
                "next": "Sig",
                "previous": "Ant"
            },
        },
    });
    setInterval('obtenerMensajes(undefined)', 5000);
    $.datetimepicker.setLocale('es');
    $(document).on('click', function (ev) {
        ev.stopImmediatePropagation();
        $(".dropdown-toggle").dropdown("active");
    });
    $('.formCarga').on('submit', cargarMensajes);
    $('.inputCarga').fileinput({
        Locales: "es",
        browseLabel: ' Examinar...',
    });
    $('#accionClientes').on('click', administracionClientes);
    $('.accionBuscarDeudores').on('click', buscarDeudores);
    $('.accionBuscarDeudoresEdad').on('click', buscarDeudoresEdad);
    $('.accionExportarDemografico').on('click', buscarDeudorDemografico);
    $('.btnSoporte').on('click', btnSoporte);
    $('.btnChat').on('click', panelChat)
    $('.btnCalculadora').on('click', function () {
        $.confirm({
            title: 'Calculadora',
            theme: 'dark',
            type: 'blue',
            columnClass: 'medium',
            backgroundDismiss: true,
            content: 'Elige una calculadora para continuar',
            buttons: {
                proyeccionReestructuracion: {
                    text: 'Cancelación Total',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        calculadoraCancelacion();
                    }
                },
                consumo: {
                    text: 'Puesta al día',
                    btnClass: 'btn-green',
                    keys: ['enter', 'shift'],
                    action: function () {
                        calculadoraPuestaAlDia();
                    }
                }
            }
        })
    })
    $('#accionUsuarios').on('click', administracionUsuarios);
    $('#accionRoles').on('click', administracionRoles);
    $('.accionInformes').on('click', administracionInformes);
    $('#accionPermisos').on('click', administracionPermisos);
    $('.accionSolicitudReestructuracion').on('click', formularioReestructuracion);
    $('.accionAsignarEdadMora').on('click', panelAsignacionMora);
    $('.accionExportarSolicitud').on('click', function () {
        var cedula = $(this).data('cedula');
        $.ajax({
            url: '../../app/controllers/carterasController.php',
            type: 'POST',
            data: {
                metodo: 'generarPDFReestructuracion',
                cedula: cedula
            },
        }).done(function (response) {
            var url = response;
            window.open(url, 'dowload');
        });
    });
    $('.accionOpcionSimuladores').on('click', function () {
        $.confirm({
            icon: 'fa fa-calculator',
            title: 'SIMULARES DISPONIBLES',
            type: 'blue',
            escapeKey: true,
            backgroundDismiss: true,
            theme: 'dark',
            columnClass: 'small',
            animation: 'rotateYR',
            content: 'Elige un simulador para continuar',
            buttons: {
                proyeccionReestructuracion: {
                    text: 'Reestructuracion',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        simuladorReestructuracion();
                    }
                },
                consumo: {
                    text: 'Consumo',
                    btnClass: 'btn-green',
                    keys: ['enter', 'shift'],
                    action: function () {
                        simuladorConsumo();
                    }
                }
            }
        });
    });
    $('.formularioEditarDemografico').on('click', formularioEditarDemografico);
    $('#accionArbol').on('click', administracionArbol);
    $('#accionRegiones').on('click', administracionRegiones);
    $('#accionDepartamentos').on('click', administracionDepartamentos);
    $('#accionCiudades').on('click', administracionCiudades);
    $('#accionPerfil').on('click', perfilUsuario);
    $('#autocompletar').on('click', autocompletar);
    $('#btnSeleccionarObligaciones').on('click', seleccionarObligacionesGestion);
    $('#accionTareas').on('click', administracionTareas);
    $('#accionConfiguracionCartera').on('click', administracionCartera);
    $('#accionMiProductividad').on('click', miProductividad);
    $('.ingresoCarteras').on('click', ingresoCarteras);
    $('.historicoGestion').on('click', ingresoCarteras);
    $('.refereciaObligacionGestion').on('click', resultadoReferencia);
    $('.tablaHistoricoGestion').DataTable({
        "responsive": true,
        "scrollX": true,
        "order": [[0, "desc"]],
        "scrollCollapse": true,
        "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No encontrador - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registro disponible",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
    });
    $('.formularioCreacion').on('click', crearNuevoRegistro);
    $('.accionCargar').on('click', administracionCarga);
    $('.btnFormularioCreacionRegistroBusqueda').on('click', formularioCreacionRegistroBusqueda);
    $('.btnFormularioCreacionDemografico').on('click', formularioCreacionDemografico);
    $('.pausa').on('click', iniciarPausa);
    new Clipboard('.cedulaGestion');
    $('.telefonoGestion').dblclick(function () {
        //        var telefonos = $('#telcontacto_gestionefonosGestion').val();
        $('#telefonosGestion').val($(this).data('telefono'));
        window.getSelection($(this).data('telefono'));
        document.execCommand("copy");
        $('#visualizacionTelefonos').html('<h4><span class="label label-default"><strong><i class="fa fa-phone" style="color:#5cb85c;"></i>  ' + $(this).data('telefono') + '</strong></span></h4>');
        $('#visualizacionTelefonos').fadeIn();
        $('#bannerTelefono').fadeIn();
    });
    //    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
    $('.fecha').datetimepicker({
        format: 'Y-m-d H:i:s'
    });
    $(".accionAgregarGestion").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $("#sidebar-wrapper").attr('style', '');
    });
    $(".accionPagos").click(function (e) {
        e.preventDefault();
        $('#modalPagos').modal('show');
        $('#tablepagos').DataTable({
            "destroy": true,
            "responsive": true,
            "order": [[2, "desc"]],
            "scrollCollapse": true,
            "lengthMenu": [[3, 6, 9, -1], [3, 6, 9, "Todos"]],
            "language": {
                "lengthMenu": "Mostrar _MENU_",
                "zeroRecords": "No se encontraron pagos - sorry",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registro disponible",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
        });
    });
    $(".ventanaMovimiento").draggable().resizable();
    $("#accionGestion").on('change', resultadoAccion);
    $("#contacto_gestion").on('change', resultadoContacto);
    $(".obligacionGestion").on('click', validarCheckObligacion);
    $('#formCargaGuion').on('submit', administracionGuion);
    $("#marckAll").on('click', marcarAll);
    $("#efecto_gestion").on('change', resultadoEfecto);
    $('#formularioGestion').on('submit', function(){
        if($('#carteraActual').val() == 9 || $('#carteraActual').val() == 19){
            var check = 0;
            $('.obligacionGestion').each(function(){
                if($('.obligacionGestion').is(':checked')){
                    check = 1;
                }
            })
            if(check == 1){
                guardarGestion();
            }else{
                mensaje('dark', '', 'red', 'Debes seleccionar una obligacion');
            }
        }else{
            guardarGestion();
        }
    });
    $('.btnFormularioCreacionRegistro').on('click', formularioCreacionRegistro);
    $('.formularioCreacion').on('submit', crearNuevoRegistro);
    if (typeof $('#carteraActual').val() != "undefined" && $('#carteraActual').val() != null) {
        var dNow = new Date();
        var localdate = dNow.getFullYear() + '-' + (dNow.getMonth() + 1) + '-' + dNow.getDate() + ' ' + dNow.getHours() + ':' +
            dNow.getMinutes() + ':' + dNow.getSeconds();
        $('#inicioGestion').val(localdate);
        consultarNotificaciones();
        setInterval('consultarTareas()', 10000);
        setInterval('consultarNotificaciones()', 300000);
    }
    setInterval('notificacionChats()', 30000);
    $('#launchPhone').on('click', function (event) {
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
$(function () {
    // idleTimer() with all defaults
    $(document).on("idle.idleTimer", function (event, elem, obj) {
        var roles = { 4: 4};
        if ($('#carteraActual').val() != null && ($('#rolActual').val() in roles)) {
            if ($('#estadoPausa').val() == 0) {
                iniciarPausa(0, 'tiempo_muerto', 'Tiempo Muerto');
            }
        }
    });
    $(document).idleTimer();
    // idleTimer() takes an optional numeric argument that defines just the idle timeout
    // timeout is in milliseconds
    $(document).idleTimer(120000);
});


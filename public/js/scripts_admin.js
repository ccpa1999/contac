/*
Metodo de obtención de módulos
*/
function obtenerModulo(modulo, controlador) {
    var modulo = (typeof modulo == "object") ? $(this).data('metodo') : modulo;
    var controlador = (controlador == undefined) ? (($(this).data('controlador') == undefined) ? "administracionController" : $(this).data('controlador')) : controlador;

    $.ajax({
        url: "../../app/controllers/" + controlador + ".php",
        type: 'POST',
        data: {
            metodo: 'obtenerModulo',
            tipo: modulo,
            cartera: $('#carteraActual').val()
        },
    }).done(function (data) {
        $('#contenedor_data').html(data);

        scriptsGenerales();
    });
}

/*
Metodo de creación de registros
*/
function crearRegistro() {
    var controlador = $(this).data('controlador');
    var modulo = $(this).data('ajax');
    var formData = new FormData(document.getElementById($(this).data('id')));

    $.ajax({
        url: "../../app/controllers/" + controlador + ".php",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#divCargando').fadeIn();
        },
        success: function (resultado) {
            $('#divCargando').fadeOut();
            resultado = JSON.parse(resultado);

            if (resultado.resultado == 'ok') {
                mensaje('dark', 'Proceso Completado', 'blue', resultado.mensaje + ' <i class="fa fa-check-circle"></i>');
                obtenerModulo(modulo, controlador);
            } else if (resultado.resultado == "calendario") {
                if ($("#usuarios option:selected").val() != $("#usuario option:selected").val() &&
                    !$("#rolActual").val().includes("Asesor")) {
                    $("#usuarios option:selected").removeAttr("selected");

                    $(`#usuarios option[value='${$("#usuario option:selected").val()}'`).attr("selected", "");
                    $(`#usuarios`).val($("#usuario option:selected").val());
                }

                $(".validar").removeClass("is-invalid");

                myModal.hide();

                successAgendamiento(resultado.eventos, "light", "Proceso Exitoso",
                    'green', 'Se estableció el evento');
            }
            else if (resultado === false) {
                $(".validar").addClass("is-invalid");

                mensaje("light", "Error al guardar!!!", 'red', 'No se pudo almacenar la información');
            } else if (resultado.resultado == "grafica") {
                graficaScoring(resultado);
            } else {
                mensaje("light", "Proceso Exitoso", 'green', 'Se completo satisfactoriamente el proceso');

                $('#' + resultado.div).html(resultado.plantilla);
                scriptsGenerales();
            }
        }
    });
}

function graficaScoring(resultado) {
    $('#porcentaje').html('');
    $('#progreso').replaceWith($('<canvas id="progreso" style="width: 100%; height: 250px"></canvas>'));
    $('#cartera').replaceWith($('<canvas id="cartera" style="width: 100%; height: 250px"></canvas>'));
    $('#usuarios').replaceWith($('<canvas id="usuarios" style="width: 100%; height: 300px"></canvas>'));
    $('#tableRanking').load('../../resources/views/carteras/componentes/table-ranking.html.php', resultado)
    if (resultado.total !== null) {
        $('#total').html(resultado.total);
        $.each(resultado, function (tipokey, valres) {
            if (tipokey != 'total' && tipokey != 'resultado') {
                //captura de canvas
                let canvas = document.getElementById(tipokey);
                //definicion de tipo
                let tipo = (tipokey == 'cartera') ? 'bar' : 'line';
                //inicialización de variables
                let label = [];
                // let dataset = [];
                let datas = [];
                let dataset = [];
                //creación de datasets por recorrido de respuesta
                $.each(valres, function (mes, data) {
                    $.each(data, function (i, datos) {
                        if (mes != 'labels') {
                            label.push((tipokey == 'cartera') ? mes : [i, mes]);
                            datas.push(datos);
                        }
                    });
                });
                dataset.push({ label: [($('.table').length > 0 ? 'RANKING' : 'SCORING')], data: datas, backgroundColor: 'rgba(39, 110, 245, 0.5)', borderColor: 'rgba(39, 110, 245, 0.8)', borderWidth: 2.5, tension: 0.2, borderRadius: 5 });
                //creación de data para chart
                let chartData = {
                    labels: label,
                    datasets: dataset
                }

                graficas(chartData, canvas, tipo, tipokey, resultado);
            }
        });
    }
}

function graficas(chartData, canvas, tipo, tipokey, resultado) {
    //definición de options
    let options = {
        responsive: false,
        plugins: {
            datalabels: {
                color: 'black',
                font: {
                    size: '13%',
                    family: 'fantasy'
                },
                formatter: (value, context) => {
                    return (value > 0) ? value + (($('.table').length > 0) ? '%' : '') + ' \n\n\n' : '';
                }
            },
            title: {
                display: true,
                color: 'black',
                align: 'start',
                text: [($('.table').length > 0 ? 'RANKING' : 'SCORING') + ' ' + tipokey.toUpperCase()],
                font: {
                    size: '15'
                }
            },
        }
    }
    const data = {
        labels: [
            'Gestiones',
            'Promesas',
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [resultado.total, resultado.exitoso],
            backgroundColor: [
                'rgba(0, 93, 255, 0.3)',
                'rgba(0, 93, 255, 0.8)',
            ],
            hoverOffset: 4
        }]
    };
    $('#progreso').replaceWith($('<canvas id="progreso" style="width: 100%; height: 250px"></canvas>'));
    new Chart($('#progreso'), {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                datalabels: {
                    color: 'black'
                }
            }
        },
        plugins: [ChartDataLabels],
    });
    let porcentaje = (resultado.exitoso / resultado.total * 100).toFixed(3);
    porcentaje = (!isNaN(porcentaje)) ? porcentaje : 0;
    $('#porcentaje').html('<br>' + porcentaje + '% ');
    new Chart(canvas, {
        type: tipo,
        data: chartData,
        options: options,
        plugins: [ChartDataLabels]
    });
}
/*
Metodo de edición de registros
*/
function formularioEditarRegistro() {
    $.ajax({
        url: "../../app/controllers/" + $(this).data('controlador') + ".php",
        type: 'POST',
        data: {
            metodo: 'formularioEditarRegistro',
            id: $(this).data('id'),
            tipo: $(this).data('tipo')
        },
        success: function (datos) {
            $('#editarRegistroContent').html(datos);
            scriptsGenerales();
        }
    })
}

/*
Meotodo de eliminación de registros
*/
function eliminarRegistro() {
    var thiz = $(this);
    var accion = thiz.data('accion');
    var id = thiz.data('id');
    var modulo = thiz.data('ajax');
    var controlador = thiz.data('controlador');

    $.confirm({
        icon: 'fa fa-warning',
        title: '¡Atención!',
        content: '¿Está seguro de eliminar el registro?',
        type: 'red',
        backgroundDismiss: true,
        backgroundDismissAnimation: 'glow',
        buttons: {
            Confirmar: {
                btnClass: 'btn-danger',
                action: function () {
                    validarCredenciales(accion, id, modulo, controlador);
                }
            },
            Cancelar: {
                action: function () { }
            }
        }
    });
}

/*
Método de validación de contraseña, se ejecuta cuando se realiza la accion de eliminar un registro
*/
function validarCredenciales(accion, id, modulo, controlador) {
    $.confirm({
        title: 'Validar Contraseña',
        content: '<input type="password" id="password" class="form-control" placeholder="Escribe la contraseña">',
        buttons: {
            Confirmar: {
                title: "confirmar",
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: "../../app/controllers/administracionController.php",
                        type: 'POST',
                        data: {
                            password: $('#password').val(),
                            metodo: 'validarCredenciales',
                        },
                    }).done(function (data) {
                        if (data == 1) {
                            $.ajax({
                                url: '../../app/controllers/' + controlador + '.php',
                                type: 'POST',
                                data: {
                                    metodo: 'borrarRegistro',
                                    accion: accion,
                                    id: id
                                }
                            }).done(function (resultado) {
                                obtenerModulo(modulo, controlador);
                            })
                        }
                        else
                            mensaje('dark', '¡NO SE HA BORRADO!', 'red', 'La contraseña no coincide');
                    });
                }
            },
            Cancelar: function () { }
        }
    });
}

/*
creacion de usuario
*/
function nombreCambio() {
    var thiz = $(this);
    var str = thiz.val();
    var inicial = str.substring(1, 0);
    var apellido = str.split(" ");
    var usuario = inicial + apellido[1];
    var usuarioFinal = usuario.toLowerCase();
    $('#usuarioCambio').val(usuarioFinal);
}

/*
Metodo de busqueda
*/
function buscarDatos() {
    var metodo = $(this).data('metodo');
    var div_resultado = $(this).data('div-resultado');
    var textoBusqueda = $(this).val();
    $.ajax({
        url: '../../app/controllers/administracionController.php',
        type: 'POST',
        data: {
            valorBusqueda: textoBusqueda,
            metodo: metodo
        }
    }).done(function (resultado) {
        $("#" + div_resultado).html(resultado);
        scriptsGenerales();
    });
}

/*
Obtiene los roles y carteras
*/
function obtenerPermisos() {
    var thiz = $(this);
    var usuario = thiz.data('usuario');
    var identificacion = thiz.data('idenusuario');
    $.ajax({
        url: "../../app/controllers/" + $(this).data('controlador') + ".php",
        type: 'POST',
        data: {
            metodo: 'obtenerPermisos',
            usuario: usuario,
            identificacion: identificacion
        },
        success: function (resultado) {
            $('#permisosUsuario').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#editarPermisosInfo').html(resultado);
            $('#accionGuardarPermisos').on('click', GuardarPermisos);
        }
    });
}

/*
Almacenamiento de permisos sobre carteras
*/
function GuardarPermisos() {
    var thiz = $(this);
    var usuario = thiz.data('usuario');
    $.ajax({
        url: "../../app/controllers/" + $(this).data('controlador') + ".php",
        type: 'POST',
        data: $('#formGuardarPermisos').serialize(),
        success: function (resultado) {
            if (resultado == 'ok') {
                $("#permisosUsuario").modal('hide');
                mensaje('dark', '¡ATENCION!', 'green', 'Operanción completada');
            }
        }
    });
}

/*
Scripts que inicializa funciones complementarias dentro de los módulos
*/

function buscarDeudoresTarea() {
    var thiz = $(this);

    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            tarea: thiz.data('tarea'),
            metodo: 'buscarDeudoresTarea',
            cartera: $('#carteraActual').val()
        }
    }).done(function (data) {
        $('#contenedor_data').html(data);
        $('#siguiente').show();
        $('#siguiente').attr('data-tarea', thiz.data('tarea'));
        $('.siguienteClienteTarea').on('click', buscarDeudoresTarea);
        scriptsGenerales();
    });
}

/*
función encargada de verificar las tareas por campaña
*/
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

/*
función encargada de verificar las notificaciones por asesor
*/
function consultarNotificaciones() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            metodo: 'consultarNotificaciones',
            cartera: $('#carteraActual').val()
        }
    }).done(function (data) {
        $('#resultadoAlarmas').html(data.plantilla);

        if (data.cantidad >= 1) {
            if ($('.cedulaAgendamiento').length >= 1) {
                $('#alertRecordatorio').fadeIn().delay(3000).fadeOut();
            }
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

function consultarRanking() {
    $.ajax({
        url: '../../app/controllers/' + $('#formScoring').data('controlador') + '.php',
        type: 'POST',
        data: $('#formScoring').serialize()
    }).done(function (resultado) {
        resultado = JSON.parse(resultado);
        graficaScoring(resultado);
    });
}


/*
funcion que se encarga de mostrar el panel de perfil
*/
function perfilUsuario() {
    var thiz = $(this);
    $.post("../../app/controllers/administracionController.php", {
        metodo: 'perfilUsuario',
        usuario: thiz.data('usuario')
    },
        function (resultado) {
            $("#contenedor_data").html(resultado);
            $("#formularioActualizarInformacionPersonal").submit(actualizarInformacionPersonal);
            $('.fecha').datetimepicker({
                timepicker: false,
                format: 'Y-m-d',
            });
        });
}

/*
Funcion encargada de almacenar el resultado del perfil
*/
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

function calcularPagos() {
    $('#factor_mensual').val(($('#factor').val() / 12).toFixed(5));
    $('#seguro').val(Math.round(($('#capital').val() * $('#factor_mensual').val()) / 100));
    let capital = $('#capital').val();
    let plazo = $('#plazo').val();
    let tasa = $('#tasa').val() / 100;
    let seguro = ($('#seguro').val());
    let total = parseFloat(tasa * (Math.pow((1 + tasa), plazo)) * capital / (Math.pow((1 + tasa), plazo) - 1) + parseFloat(seguro)).toFixed(3);
    const formatterPeso = new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    })
    $('#totalPago').text(formatterPeso.format(total))
}

/*
funcion que se ejecuta para reconocer las acciones que se desean realizar
*/
function scriptsGenerales() {
    $('#salir').on('click', function () {
        $.ajax({
            url: 'http://172.16.10.192/backendfianza/public/api/logout',
            type: 'POST',
            data: {
                _token: $('#_token').val()
            },
            headers: {
                'Authorization': 'Bearer ' + $('#_token').val()
            }
        }).done(function (a) {
            location.reload();
        })
    });
    if (typeof $('#carteraActual').val() != "undefined" && $('#carteraActual').val() != null) {
        consultarNotificaciones();
        consultarTareas();
        if ($('#formScoring').length > 0) {
            consultarRanking();
        }
        if ($('.cedulaGestion').length >= 1) {
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
            new Clipboard('.cedulaGestion');
            $("#efecto_gestion").on('change', resultadoEfecto);

            $('.refereciaObligacionGestion').on('click', resultadoReferencia);

            $(".accionAgregarGestion").off();
            $(".accionAgregarGestion").click(function (e) {
                $("#wrapper").toggleClass("active");
                $("#sidebar-wrapper").attr('style', '');
            });
            $("#accionGestion").off();
            $("#accionGestion").on('change', resultadoAccion);
            $("#contacto_gestion").off();
            $("#contacto_gestion").on('change', resultadoContacto);
            $("#formularioGestion").off();
            $('#formularioGestion').on('submit', function () {
                if ($('#carteraActual').val() == 9 || $('#carteraActual').val() == 19) {
                    var check = 0;

                    $('.obligacionGestion').each(function () {
                        if ($('.obligacionGestion').is(':checked'))
                            check = 1;
                    })

                    if (check == 1)
                        guardarGestion();
                    else
                        mensaje('dark', '', 'red', 'Debes seleccionar una obligacion');
                }
                else
                    guardarGestion();
            });

            $(".ventanaMovimiento").draggable().resizable();
            $(document).keypress(function () {
                if (event.which == 124) {
                    buscarDeudores();
                }
            });

            $('.telefonoGestion').dblclick(function () {
                //var telefonos = $('#telcontacto_gestionefonosGestion').val();
                $('#telefonosGestion').val($(this).data('telefono'));
                window.getSelection($(this).data('telefono'));
                document.execCommand("copy");
                $('#visualizacionTelefonos').html('<span class=""><strong><i class="fa fa-phone" style="color:#5cb85c;"></i>  ' + $(this).data('telefono') + '</strong></span>');
                $('#visualizacionTelefonos').fadeIn();
                $('#bannerTelefono').fadeIn();
            });
            $('.calculoPago').on('keyup', calcularPagos);
            calcularPagos();
        }

        $('.asignarFecha').on('click', function () {
            var id = $(this).data('id');
            $.alert({
                title: 'Fecha',
                theme: 'dark',
                type: 'blue',
                backgroundDismiss: true,
                content: '<input class="form-control" id="fecha" name="fecha" type="text">',
                buttons: {
                    guardar: {
                        text: 'guardar',
                        action: function () {
                            $.ajax({
                                url: '../../app/controllers/carterasController.php',
                                type: 'POST',
                                data: {
                                    metodo: 'actualizarFecha',
                                    id: id,
                                    fecha: $('#fecha').val()
                                }
                            }).done(function (datos) {
                                datos = JSON.parse(datos);
                                $('.accionSolicitudes').trigger('click');
                            });
                        }
                    }
                }
            })
        });

        $('#label').on('change', function () {
            var label = $('#label').val();
            $('#pvlabel').text(label);
        });

        $('#opciones').on('change', function () {
            var opciones = $(this).val().split(',');
            $('#pvopciones').html('');

            $.each(opciones, function (i, val) {
                $('#pvopciones').append('<input type="radio" class="form-check-input" name="producto" value="' + val + '"> <label for="SI">' + val + '</label><br>');
            });
        });

        $('.txttitulo').on('keyup', function () {
            $('#' + $(this).data('txttitulo')).html($(this).val());
        })

        // Obligatoriedad
        $('#tipo_accion').on('change', busquedaAccion);
        $('#tipo_contacto').on('change', busquedaEfecto);
        $('#tipoefecto').on('change', configuracionObligatoriedad);
        $('#tipo_efecto').on('change', buscarGuion);

        $(".accionBuscarDeudores").off();
        $('.accionBuscarDeudores').on('click', buscarDeudores);
        $(".pausa").off();
        $('.pausa').on('click', iniciarPausa);
        $('.AccionEstadoTarea').on('click', estadoTarea);
        $('.accionExportarDemografico').off();
        $('.accionExportarDemografico').on('click', buscarDeudorDemografico);

        $(".busquedaDeudor").off();
        $(".busquedaDeudor").on("submit", buscarDeudor);

        $('.activarTarea').on('click', buscarDeudoresTarea);

        // Orden del formulario de Gestión
        $("#cardsGestion").sortable({
            opacity: 0.7,
            update: function (event, ui) {
                $('#cardsGestion').children('#contenedor_campo').each(function (posicion) {
                    if ($(this).attr('data-posicion') != (posicion + 1)) {
                        $(this).attr('data-posicion', (posicion + 1))
                            .addClass('updated');
                    }
                });

                guardarPosicion();
            }
        });

        $('.enableCampo').off('click');
        $('.enableCampo').on('click', function () {
            let padre = $(this).parent().parent().parent().find("#posicion-campo");

            if (this.checked) {
                padre.removeClass("pin-disabled").addClass("pin-enable");
            }
            else {
                padre.removeClass("pin-enable").addClass("pin-disabled");
            }
        });

        // Asignar los eventos a las opciones preexistentes 
        if ($('.preexistente').length > 0) {
            $('#contenedor_campo .preexistente').each(function () {
                let id = $(this).data('id-campo');
                eventsSetGestion(id);
            });

        }

        // Agregar las opciones select del formulario de gestión
        $(".dataTypeGestion").off();
        $(".dataTypeGestion").change(function () {
            let id = $(this).data('id-campo');

            if ($(this).val() == 'select') {
                let id_input = $(this).data('id-input');

                $('#opciones-select-' + id).show();
                $('#opciones-select-' + id).find('input').removeAttr("disabled");

                if ($('#innerOpciones-' + id).find('.row').length == 0)
                    establecerOpcionesGestion(id_input, id);
            }
            else {
                $('#opciones-select-' + id).hide();
                $('#opciones-select-' + id).find('input').attr("disabled", '');
            }
        });

        // var dNow = new Date();
        // var localdate = dNow.getFullYear() + '-' + (dNow.getMonth() + 1) + '-' + dNow.getDate() + ' ' + dNow.getHours() + ':' +
        //     dNow.getMinutes() + ':' + dNow.getSeconds();
        // $('#inicioGestion').val(localdate);
    }

    // ----- Calendario -----
    if ($('#calendar').length > 0) {
        $.ajax({
            url: "../../app/controllers/carterasController.php",
            type: "POST",
            data: {
                metodo: "obtenerCalendario",
            }
        }).done(function (eventos) {
            eventos = JSON.parse(eventos);
            setCalendario(document.getElementById('calendar'), eventos);
        });
    }

    $(".eventosUser").off();
    $(".eventosUser").on("change", function () {
        if ($(this).val() != "") {
            let usuario = $(this).val();

            $(`#usuario option:selected`).removeAttr("selected");
            $(`#usuario option[value='${usuario}']`).attr("selected", "");
            $("#agendarEvento #usuario").val(usuario);

            $.ajax({
                url: "../../app/controllers/carterasController.php",
                type: "POST",
                data: {
                    metodo: "obtenerCalendario",
                    usuario: usuario,
                }
            }).done(function (data) {
                data = JSON.parse(data);

                setCalendario(document.getElementById('calendar'), data);
            });
        }
        else
            $("#usuario").val("");
    });

    // EVENTOS REPROGRAMACION ------------------------

    $("#tipoEvento").off('change');
    $("#tipoEvento").on('change', function () {
        if ($("#tipoEvento").val() == 'reprogramacion')
            selectUsuarios();

        controlReprogramacion();
    });

    $("#agendarEvento #inicio_evento").off("change");
    $("#agendarEvento #inicio_evento").on("change", function () {

        if ($('#tipoEvento').val() == 'reprogramacion') {
            selectUsuarios();

            $("#fin_evento").val($('#inicio_evento').val());

            if ($("#fin_evento").val() != "" && $("#inicio_evento").val() != "")
                fechaReprogramados();
        }
    });

    $("#agendarEvento #h_inicio").off("blur");
    $("#agendarEvento #h_inicio").on("blur", function () {
        if ($('#tipoEvento').val() == "reprogramacion" && $("#inicio_evento").val() != "") {
            selectUsuarios();

            if ($("#h_inicio").val() != "")
                fechaReprogramados();
        }
    });

    // EVENTOS REPROGRAMACIÓN ------------------------

    $('.formCarga').off();
    $('.formCarga').on('submit', crearRegistro);
    $('.busqueda').off();
    $('.busqueda').keypress(buscarDatos);
    $('.button').off();
    $('.button').on('click', obtenerModulo);
    $('.eliminarRegistro').on('click', eliminarRegistro);
    $('.formularioEditarRegistro').off();
    $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
    $('#btnBorrarCarpeta').on('click', borrarContenidoCarpeta);
    $('.eliminarArchivo').on('click', eliminarArchivo);
    $('.nombreCambio').on('change', nombreCambio);
    $('.obtenerPermisos').on('click', obtenerPermisos);
    $('.parametroArbol').on('change', parametroArbol);
    $('#accionPerfil').off();
    $('#accionPerfil').on('click', perfilUsuario);

    if ($(".inputCarga").length >= 1) {
        $(".inputCarga").fileinput({
            Locales: "es",
            browseLabel: 'Examinar...',
            removeClass: "btn btn-danger",
            removeLabel: "Quitar",
            uploadClass: "btn btn-success",
            uploadLabel: "Subir Archivo",
        });
    }

    inputsTime();

    if ($('.table').length >= 1) {
        $('.table').DataTable({
            "destroy": true,
            "order": [[0, "desc"]],
            "responsive": true,
            "scrollCollapse": true,
            "lengthMenu": [3, 5, 10, 25],
            "language": {
                "lengthMenu": "Mostrar _MENU_",
                "zeroRecords": "No hay registros",
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
    }
    if ($('.colHistorico').length >= 1) {
        titulos = "";
        columnas = "";
        $('.table').DataTable().destroy();
        $('.columna').remove();
        $('.colHistorico').each(function () {
            if ($(this).is(':checked')) {
                '.table'
                titulos += "<th class='columna'>" + $(this).data('titulo') + "</th>";
                columnas += "<td class='columna'>Valor Prueba</td>";
            }
        });
        $(".titulos").append(titulos);
        $("#columnas").append(columnas);
        $('.table').DataTable();
        $('.colHistorico').on('click', function () {
            titulos = "";
            columnas = "";
            $('.table').DataTable().destroy();
            $('.columna').remove();
            $('.colHistorico').each(function () {
                if ($(this).is(':checked')) {
                    titulos += "<th class='columna'>" + $(this).data('titulo') + "</th>";
                    columnas += "<td class='columna'>Valor Prueba</td>";
                }
            });
            $(".titulos").append(titulos);
            $("#columnas").append(columnas);
            $('.table').DataTable();
        })
    }
}

function guardarPosicion() {
    let posiciones = [];

    $('.updated').each(function () {
        posiciones.push([$(this).attr('data-id-campo'),
        $(this).attr('data-posicion')]);

        $(this).find('#posicion-campo').html($(this).attr('data-posicion'));

        $(this).removeClass('updated');
    });

    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            metodo: 'establecerPosicion',
            campos: posiciones,
        }
    }).done(
        function (data) {
            if (data == 1) {
                $.alert({
                    icon: 'fa fa-sort',
                    title: 'Posición Modificada',
                    content: 'El Item ha sido cambiado de posición',
                    type: 'green',
                    buttons: {
                        Aceptar: {
                            text: 'Aceptar',
                            btnClass: 'btn-green'
                        }
                    }
                });
            }
            else {
                $.alert({
                    icon: 'fa fa-sort',
                    title: 'Cambio de Posición Truncado',
                    content: 'El Item no ha sido cambiado de posición',
                    type: 'red',
                    buttons: {
                        Aceptar: {
                            text: 'Aceptar',
                            btnClass: 'btn-danger'
                        }
                    }
                });
            }
        }
    );
}

function inputsTime() {
    $('.fechaHora, .fecha, .hora').attr("autocomplete", "off");

    if ($('.fechaHora').length >= 1) {
        $('.fechaHora').datetimepicker({
            timepicker: true,
            format: 'Y-m-d H:i:s',
            scrollMonth: false,
            scrollInput: false,
            minDate: 0,
        });
    }

    if ($('.fecha').length >= 1) {
        $('.fecha').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
            scrollMonth: false,
            scrollInput: false,
            minDate: 0,
        });
    }

    if ($('.hora').length >= 1) {
        $('.hora').datetimepicker({
            datepicker: false,
            format: 'H:i'
        });
    }
}

function obtenerUsuariosCartera(rol) {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: "POST",
        data: {
            metodo: "obtenerUsuariosCartera",
            rol: rol
        }
    }).done(function (data) {
        selectUsuarios(JSON.parse(data));
    });
}

var url = '../../vendor/ctxSip/phone',
    features = 'menubar=no,location=no,resizable=no,scrollbars=no,status=no,addressbar=no,width=320,height=480';

function crearIntervalos(inicial) {
    inicial[0] = setInterval('consultarTareas()', 10000);
    inicial[1] = setInterval('consultarNotificaciones()', 10000);
    if ($('#formScoring').length > 0) {
        inicial[2] = setInterval('consultarRanking()', 10000);
    }
}

function eliminarIntervalos(inicial) {
    inicial.map((i) => clearInterval(i));
}

$(document).ready(function () {
    let inicial = [0, 0];
    crearIntervalos(inicial);
    if (typeof $('#carteraActual').val() != "undefined" && $('#carteraActual').val() != null) {
        $(document).focus(function () {
            $.ajax({
                url: '../../app/controllers/carterasController.php',
                type: 'POST',
                data: {
                    metodo: 'asignarCartera',
                    cartera: $('#carteraActual').val()
                }
            }).done(function () {
                console.log($('#carteraActual').val());
            });
            eliminarIntervalos(inicial);
            crearIntervalos(inicial);
        });
        $(document).on('blur', function () {
            eliminarIntervalos(inicial);
        })
    }
    scriptsGenerales();
});
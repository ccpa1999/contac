/*
funcion encargada de mostrar gráficas del estado de tarea
*/
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
                    "GESTIONADOS",
                    "NO GESTIONADOS",
                ],
                datasets: [{
                    data: [respuesta.gestionados, respuesta.no_gestionados],
                    backgroundColor: [
                        "rgba(15, 84, 193, 0.8)",
                        "rgba(15, 84, 193, 0.3)",
                    ],
                }]
            };
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: dataPie,
                plugins: [ChartDataLabels],
                options: {
                    plugins: {
                        datalabels: {
                            color: 'black',
                            font: {
                                size: '13%',
                                family: 'fantasy'
                            },
                            formatter: (value, context) => {
                                return value;
                            }
                        }
                    }
                }
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
                data: dataPolar,
                plugins: [ChartDataLabels],
                options: {
                    plugins: {
                        datalabels: {
                            color: 'black',
                            font: {
                                size: '13%',
                                family: 'fantasy'
                            },
                            formatter: (value, context) => {
                                return value + (($('.table').length > 0) ? '%' : '') + ' \n\n\n';
                            }
                        }
                    }
                }
            });
        });
}

/*
funcion que recolecta los homologados dependiendo del parametro enviado
*/
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

/*
Despliegue de panel de arboles de desición
*/
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
            $('.fecha').datetimepicker({
                timepicker: false,
                format: 'Y-m-d',
            });
            $('#busquedaRoles').keyup(buscarDatos);
        });
}

/*
Eliminacion de archivos
*/
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

/*
Generación de informes
*/
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
                $('#divCargando').fadeOut();

                mensaje('light', '¡FELICIDADES!', 'green', 'Se generó el informe correctamente');
            });
    }
}

/*
Cargue de archivo
*/
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
    }).done(function (data) {
        $('#divCargando').fadeOut();
        if (data.resultado == 'ok') {
            $.alert({
                icon: 'fa fa-comment-o',
                title: 'Proceso Completado',
                type: 'green',
                theme: 'light',
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

/*
Panel de cargas
*/
function administracionCarga() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'administracionCarga',
            carteraActual: $('#carteraActual').val()
        },
    }).done(function (data) {
        $('#contenedor_data').html(data);
        $('.formularioEditarRegistro').on('click', formularioEditarRegistro);
        $('.eliminarRegistro').on('click', eliminarRegistro);
        $('.formCarga').on('submit', cargarArchivo);
        $('.fecha').datetimepicker({
            timepicker: false,
            format: 'Y-m-d',
        });
        $('#busquedaRoles').keyup(buscarDatos);
        $(".inputCarga").fileinput({
            Locales: "es",
            browseLabel: 'Examinar...',
            removeClass: "btn btn-danger",
            removeLabel: "Quitar",
            uploadClass: "btn btn-success",
            uploadLabel: "Subir Archivo",
        });
    });
}

/*
Detección de guiones a partir de los efectos
*/
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

/*
Panel de administracion de guiones
*/
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

/*
Optención de contactos, a partir de la acción
*/
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
                .append('<option value="">seleccione...</option>');

            $.each(data.contacto, function (i, item) {
                $('#tipo_contacto').append(' <option value="' + item.id + '">' + item.homologado + '</option>');
            });
        });
}

/*
Obtención de efectos, a partir del contacto
*/
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

/*
Almacenamiento de obligatoriedad de campos
*/
function configuracionObligatoriedad() {
    var cartera = $('#carteraActual').val();
    var valorAccion = $('#tipo_accion').val(),
        valorContacto = $('#tipo_contacto').val(),
        valorEfecto = $('#tipoefecto').val();
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

/*
Administración de obligatoriedad de campos
*/
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

/*
Almacenamiento de tiempos
*/
function guardarTiempoMuerto() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: $('#formTiempos').serialize(),
    })
        .done(function (data) {
            // $('#contenedor_data').html(data);
            $('.formHomologado').on('submit', function () {
                var thiz = $(this);
                crearNuevoRegistro(thiz.data('formulario'));
            });
            $('.eliminarRegistro').on('click', eliminarRegistro);
        });
}

/*
Inicio de cronometro
*/
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
                if (e.which == 13)
                    validarPausa(arm);
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

                    validarPausa(arm);

                    return false;
                }
            }
        }
    });
}

function validarPausa(alerta) {
    $.ajax({
        url: "../../app/controllers/administracionController.php",
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

                alerta.close();

                $('#estadoPausa').val('0');
            }
            else {
                $('#mensaje_error_tiempos').fadeIn().delay(1000).fadeOut();
            }
        });
}

/*
Busqueda de deudores
*/
function buscarDeudor() {
    form = $(this).serialize();

    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: form
    }).done(function (data) {
        $('#contenedor_data').html(data);

        scriptsGenerales();
    })
}

/*
Busqueda de deudores agendados(con seguimiento)
*/
function buscarDeudorAgendamiento() {
    var cartera = $('#carteraActual').val();
    var thiz = $(this);

    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            datoBusqueda: thiz.data('cedula'),
            tipo: 'cedula',
            metodo: 'buscarDeudor',
            cartera: cartera
        }
    }).done(function (data) {
        $('#contenedor_data').html(data);
        scriptsGenerales();
    })
}

/*
Emergente de busqueda de deudores
*/
function buscarDeudores() {
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
            $('.inputEnter').focus();

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
                    console.log(JSON.stringify(this))

                    buscarDeudor();
                }
            }
        }
    });
}

/*
Busqueda de demograficos por cedula
*/
function buscarDeudorDemografico() {
    let cartera = $(this).data('cartera');

    $.alert({
        icon: 'fa fa-search',
        title: 'BUSCAR',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        container: 'body',
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
            buscar: {
                btnClass: 'btn-blue',
                action: function () {
                    exportarDeudorDemografico();
                }
            }
        }
    });
}

/*
Emergente de demograficos
*/
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
    }).done(function (data) {
        $.alert({
            title: 'Demográficos',
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
            var capital = 0,
                tasa_efectiva = 0,
                tasa_nominal = 0,
                plazo = 0,
                cuota_sin_seguro = 0,
                cuota_con_seguro = 0,
                abono_capital = 0,
                abono_intereses = 0,
                valor_seguro, valor_seguro, saldo_final = 0;
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

                if ($('#txtCapital').val() != '' && $('#txtTasaEfectiva').val() != '' &&
                    $('#txtSeguroMensual').val() != '' && $('#cuotas_simulador_reestructuracion').val() != '') {
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
            var saldo_total = 0,
                capital = 0,
                intereses = 0,
                primer_cuota = 0,
                tasa_mensual = 0.021,
                cuotas = 0,
                disponible = 0,
                diferencia = 0,
                reduccion = 0,
                capacidad = 0;
            $('#obligacion_simulador_consumo').change(function () {
                $('#txtValorAdeudado').val("$" + new Intl.NumberFormat().format($(this).val()));
            });
            $('#iniciarSimulacionConsumo').click(function () {
                if ($('#cuotas_simulador_consumo').val() != '' && $('#inpIngresos').val() != '' &&
                    $('#inpGastos').val() != '' && $('#inpCuotaActual').val() != '' &&
                    $('#inpCuotaActual').val() != '' && $('#txtValorAdeudado').val() != '' &&
                    $('#obligacion_simulador_consumo').val() != '') {
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
                data: [
                    /*response.resultados.clientes,
                                         response.resultados.gestiones,
                                         response.resultados.promesas,
                                         response.resultados.posibles,*/
                    response.resultados.directos
                ],
                backgroundColor: [ /*'#22CECE', '#059BFF', '#FF3D67', '#FFC233',*/ '#AC83FF'],
            }],
            labels: [ /*'Clientes', 'Gestiones', 'Promesas', 'Posibles',*/ 'Directos']
        };
        var myPolarChart = new Chart(ctx2, {
            type: 'polarArea',
            data: dataPolar
        });
        $('#modalMiProductividad').modal("show");
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
                .append('<option value="">seleccione...</option>');
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
    }).done(function (data) {
        if (thiz.val() == '51' && $('#carteraActual').val() == '2') {
            el = document.getElementsByClassName('obligacionGestion');
            let chequeada = false; //at least one cb is checked
            let posicion = 0;

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
            }
            else {
                for (i = 0; i < el.length; i++) {
                    el[i].required = true;
                }
            }

            $('#fecha_seguimiento').prop('required', true);
        }
        else {
            if ($("#contacto_gestion option:selected").text() == ('DIRECTO') ||
                $("#contacto_gestion option:selected").text() == ('DIRECT CONTACT')) {
                $('#motivo_gestion').prop('required', true);
            }
            else {
                $('#motivo_gestion').prop('required', false);
            }

            $('#actividad_gestion').prop('required', false);
        }

        $('#efecto_gestion')
            .empty()
            .append('<option value="">..Seleccione..</option>');
        // $('#motivo_gestion')
        //     .empty()
        //     .append('<option value="">..Seleccione..</option>');
        // $('#actividad_gestion')
        //     .empty()
        //     .append('<option value="">..Seleccione..</option>');

        $.each(data.efecto, function (i, item) {
            $('#efecto_gestion').append(' <option value="' + item.id + '">' + item.homologado + '</option>');
        });

        // $.each(data.motivos, function (i, item) {
        //     $('#motivo_gestion').append(' <option value="' + item.motivo + '">' + item.motivo + '</option>');
        // });

        // $.each(data.actividades, function (i, item) {
        //     $('#actividad_gestion').append(' <option value="' + item.actividad + '">' + item.actividad + '</option>');
        // });

        $('#divEfectoGestion').fadeIn();
    });
}

function resultadoEfecto() {
    var cartera = $('#carteraActual').val();
    var valorAccion = $('#accionGestion').val(),
        valorContacto = $('#contacto_gestion').val(),
        valorEfecto = $(this).val();
    var textActual = $('#observaciones').val();
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
        $('#formularioGestion').find('input').removeAttr('required');
        $('#formularioGestion').find('select').removeAttr('required');
        $.each(data.inputs, function (i, val) {
            $("#" + val.id_input).prop('required', true);
        });
        $('#telefonosGestion').prop('required', true);
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
        $('#observaciones').val(textActual + valor);
    });
}

function autocompletar() {
    var dataString = $('#formularioGestion').serialize();
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            metodo: 'autocompletar',
            datos: dataString
        },
    })
        .done(function (data) {
            $('#observaciones').val(data);
        });
}

function refrescarHistorico() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: {
            tipo: 'cedula',
            metodo: 'buscarDeudor',
            datoBusqueda: $('#cedula_deudor').val(),
            cartera: $('#carteraGestion').val()
        },
    }).done(function (data) {
        $('#contenedor_data').html(data);
        scriptsGenerales();
    });
}

function guardarGestion() {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: 'POST',
        data: $('#formularioGestion').serialize()
    })
        .done(function (data) {
            new Clipboard('#observaciones');
            refrescarHistorico();
            mensaje('dark', 'ATENCION', 'green', 'Gestión Guardada Correctamente');
            $('#btnAgregarGestion').click();
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
                    "order": [
                        [2, "desc"]
                    ],
                    "scrollCollapse": true,
                    "lengthMenu": [3, 5, 10, 25],
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


// function consultarNotificaciones() {
//     $.ajax({
//             url: "../../app/controllers/carterasController.php",
//             type: 'POST',
//             dataType: 'json',
//             data: {
//                 metodo: 'consultarNotificaciones',
//                 cartera: $('#carteraActual').val()
//             }
//         })
//         .done(function (data) {
//             $('#resultadoAlarmas').html(data.plantilla);
//             if (data.cantidad >= 1) {
//                 $.alert({
//                     icon: 'fa fa-ravelry',
//                     title: 'OBLIGACIÓN',
//                     type: 'blue',
//                     escapeKey: true,
//                     backgroundDismiss: true,
//                     theme: 'dark',
//                     columnClass: 'medium',
//                     animation: 'rotateYR',
//                     content: "¡HOLA!, tienes un recordatorio, mira las notificaciones."
//                 });
//                 $('#badgeCantidadNotificaciones').html(data.cantidad);
//                 $('#spanCantidadNotificaciones').show();
//                 $('.cedulaAgendamiento').on('click', buscarDeudorAgendamiento);
//             } else {
//                 $('#badgeCantidadTareas').html('');
//                 $('#spanCantidadTareas').hide();
//                 $('#badgeCantidadNotificaciones').html("");
//                 $('#spanCantidadNotificaciones').hide();
//             }
//         });
// }

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
                alert(response)
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
                $.post("../../app/controllers/carterasController.php", {
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
                removeClass: "btn btn-danger",
                removeLabel: "Quitar",
                uploadClass: "btn btn-success",
                uploadLabel: "Subir Archivo",
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
        setTimeout(function () {
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
            if (position == 0) {
                $('.divu').scrollTop($('.divu').prop('scrollHeight'));
            }
            $('.divu').scroll(function () {
                var scroll = $('.divu').scrollTop();
                position = scroll;
            });
            $('.mensaje').focus();
        })
    }
}

function seleccionCalculadora() {
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
}

function exportacionSolicitud() {
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
}

function seleccionSimuladores() {
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

/*
Eliminar informe
*/
function eliminarArchivo() {
    let archivo = $(this).data('archivo');
    let controlador = $(this).data('controlador');
    let modulo = $(this).data('ajax');

    let contenido = "Seguro que quiere Eliminar el registro"

    if (archivo != "")
        contenido += ": " + archivo;

    $.confirm({
        title: "Eliminar!!!",
        content: contenido + "?",
        type: "red",
        buttons: {
            eliminar: {
                text: "Eliminar",
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: "../../app/controllers/carterasController.php",
                        type: 'POST',
                        data: {
                            metodo: 'eliminarArchivo',
                            cartera: $('#carteraActual').val(),
                            archivo: archivo
                        },
                    })
                        .done(function (data) {
                            obtenerModulo(modulo, controlador);
                        });
                }
            },
            cancelar: function () { }
        }
    });
}

/*
vaciar informes
*/
function borrarContenidoCarpeta() {
    var controlador = $(this).data('controlador');
    var modulo = $(this).data('ajax');

    $.confirm({
        title: "Eliminar!!!",
        content: "Quiere eliminar todo el contenido?",
        type: "red",
        buttons: {
            eliminar: {
                text: "Eliminar",
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: "../../app/controllers/carterasController.php",
                        type: 'POST',
                        data: {
                            metodo: 'borrarContenidoCarpeta',
                            cartera: $('#carteraActual').val()
                        },
                    }).done(function (data) {
                        obtenerModulo(modulo, controlador);
                        mensaje('light', '¡ATENCIÓN!', 'red', data);
                    });
                }
            },
            cancelar: function () { }
        }
    });
}

// Cargar inputs para registrar los option de los campos del formulario de Gestión
function establecerOpcionesGestion(id_input, id) {
    $.ajax({
        url: '../../app/controllers/carterasController.php',
        type: 'POST',
        data: {
            id_input: id_input,
            id: id,
            metodo: 'formulariosVarios',
            parametro: 'opciones-select',
        }
    }).done(function (data) {
        $('#opciones-select-' + id).html(data);

        eventsSetGestion(id);
    });
}

function crearCampoOpcion(botonActual) {
    let id = $(botonActual).data('id-campo');
    let id_input = $(botonActual).data('id-input');

    $('#innerOpciones-' + id).append(
        `<div class="row mb-2">
            <div class="col-9">
                <input type="text" class="form-control" value="" required
                    id="${id_input}[tipo][new][]" name="${id_input}[tipo][new][]">
            </div>
        
            <div class="col-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary addOption" 
                        data-id-campo="${id}" data-id-input="${id_input}">
                        <i class="fa fa-plus"></i>
                    </button>

                    <button type="button" class="btn btn-danger deleteOption"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>`
    );
}

function eventsSetGestion(id) {
    // Agregar un campo
    $('#innerOpciones-' + id).off('click', '.addOption');
    $('#innerOpciones-' + id,).on('click', '.addOption', function () {
        let botonActual = $(this);

        crearCampoOpcion(botonActual)
    });

    // Eliminar un campo específico
    $('#innerOpciones-' + id).off('click', '.deleteOption');
    $('#innerOpciones-' + id,).on('click', '.deleteOption', function () {
        let botonActual = $(this);
        let padre = $(botonActual).parent().parent().parent();

        let input = $(botonActual).parent().parent().parent().find('input').val() ?? '';

        $.alert({
            type: 'red',
            title: 'Eliminar Opción!',
            content: `Está seguro que quiere eliminar definitivamente: <div class="text-center fw-bold fs-5">${input}</div>`,
            buttons: {
                cancelar: {
                    action: function () { }
                },
                Eliminar: {
                    text: 'Eliminar',
                    btnClass: 'btn-danger',
                    keys: ['enter', 'shift'],
                    action: function () {
                        let id_campo = $(botonActual).data('id-opcion') ?? '';

                        if (id_campo != '') {
                            $.ajax({
                                url: '../../app/controllers/carterasController.php',
                                type: 'POST',
                                data: {
                                    id: id_campo,
                                    metodo: 'borrarRegistro',
                                    accion: 'borrarOpcionGestion',
                                }
                            })
                                .done(function () {
                                    $(padre).remove();

                                    let contenido = `Se ha eliminado: 
                                        <div class="text-center fw-bold fs-5">${input}</div>`;

                                    mensaje('light', 'Eliminado', 'green', contenido);
                                })
                                .fail(function () {
                                    let contenido = `No se ha eliminado: 
                                        <div class="text-center fw-bold fs-5">${input}</div>`;

                                    mensaje('light', 'No se ha eliminado', 'red', contenido);
                                });
                        }
                        else
                            $(padre).remove();
                    }
                },
            }
        }
        );
    });
}
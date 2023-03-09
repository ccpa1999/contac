var tipoCapacitacion = 1;
var retorno = false;
var alerta;
var alertaAjax;
var alertaClavePrueba;

//   --------------------------  NO ES NECESARIO----------------------




// ------------------------------------ NO ES NECESARIO FIN -------------------------

function buscarUsuario(Usuario) {
    retorno = false;
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        dataType: "json",
        cache: false,
        data: {
            metodo: 'buscarUsuario',
            usuario: Usuario,
            tipoCap: $("#IdTipoCapacitacion").val()
        },
        success: function (resultado) {
            var aux = 1;
            if (resultado.respuesta == "YaCapacitado") {
                $("#Noexiste").html("No existen capacitaciones disponibles");
                $("#Noexiste").css("color", "green");
                $("#Noexiste").removeAttr("hidden");
            } else {
                if (resultado[resultado.length - 1] === "ok") {
                    if (resultado[0] !== "ok") {
                        for (var i = 0; i < resultado.length; i++) {
                            $('.Cajas' + resultado[i]).css("display", "none");
                            $('.classChulo' + resultado[i]).addClass("fa fa-check");
                            aux++;
                            if (i == resultado.length - 2) {
                                break;
                            }
                        }
                    }
                    $('#usuarioCapacitacion').val($('#usuarioFormulario').val());
                    $('#IdFormulario').fadeIn(600);
                    $('#btnAgregarCapacitacion').fadeOut(500);
                    alerta.close();
                } else {
                    $("#Noexiste").html("Este usuario no esta registrado");
                    $("#Noexiste").css("color", "red");
                    $("#Noexiste").removeAttr("hidden");
                    $('#usuarioFormulario').css("border", "solid red");
                    $('#usuarioFormulario').css("border-width", "1px");
                }
            }
        }
    });
}

function asignarCapacitaciones() {
    var tipoU = $(this).data('tipo');
    $.ajax({
        url: '../../app/controllers/capacitacionController.php',
        type: 'POST',
        data: {
            metodo: 'modalCapacitaciones',
            id: $(this).data('id'),
            tipo: tipoU
        },
        success: function (resultado) {
            if (resultado == "error") {
                mensaje("dark", "Error!", "red", "No hay usuarios para este proceso");
            } else {
                $("#asignarCapacitacionModal").modal("show");
                $('#content_data').html(resultado);
                $('.activarOpcion').on('click', activarOpcion);
                switch (tipoU) {
                    case "asignarCapacitaciones":
                        $('#btnGuardarForm').on('click', guardarAsignarCapacitacion);
                        break;
                    case "habilitarUsuario":
                        $('#btnGuardarForm').on('click', guardarHabilitarUsuarios);
                        break;
                    case "bloquearExamen":
                        $('#btnGuardarForm').on('click', guardarBloquearExamen);
                        break;
                    default:
                        break;
                }
            }
        }
    });
}

function guardarAsignarCapacitacion() {
    var capacitacion = $('#capa').val();
    var usuario = $('#usu').val();
    if (capacitacion != "" && usuario != "") {
        $.ajax({
            url: '../../app/controllers/capacitacionController.php',
            type: 'POST',
            data: {
                metodo: 'guardarAsignarCapacitacion',
                dataC: capacitacion,
                dataU: usuario
            },
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
            success: function (datos) {
                $('#divCargando').fadeOut();
                if (datos == "ok") {
                    mensaje('dark', 'Proceso Completado', 'green', 'Se asignaron las capacitaciones exitosamente.');
                    setTimeout(function () {
                        $('#asignarCapacitacionModal').modal('hide');
                    }, 1000);
                } else {
                    mensaje('dark', 'Proceso Fallido', 'red', 'No se pudo realizar la asignación de las capacitaciones.');
                }

            }
        });
    } else {
        mensaje('dark', 'Datos incompletos', 'red', 'Hubo un error en el proceso de los datos.');
    }
}

function guardarHabilitarUsuarios() {
    var capacitacionUsuario = $('#capa').val();

    if (capacitacionUsuario != "") {
        $.ajax({
            url: '../../app/controllers/capacitacionController.php',
            type: 'POST',
            data: {
                metodo: 'guardarHabilitarUsuarios',
                dataC: capacitacionUsuario
            },
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
            success: function (datos) {
                setTimeout(function () {
                    if (datos == "ok") {
                        $('#habilitarCapacitacionModal').modal('hide');
                        mensaje('dark', 'Proceso completado', 'green', 'Se han habilitado las capacitaciones para estos usuarios exitosamente.');
                        $('#asignarCapacitacionModal').modal('hide');
                    } else {
                        mensaje('dark', 'Proceso fallido', 'red', 'No se pudo realizar la activacion de las capacitaciones a estos usuarios.');
                    }
                    $('#divCargando').fadeOut();
                }, 500);
            }
        });
    } else {
        mensaje('dark', 'Datos incompletos', 'red', 'Hubo un error en el proceso de los datos.');
    }
}

function guardarBloquearExamen() {
    if ($('#capa').val() == "" || $('#descripcion').val() == null || ($('#descripcion').val() == '6' && $('#descripcionOtro').val() == '')) {
        mensaje('dark', 'Proceso fallido', 'red', 'No has seleccionado a ningun usuario y/o descripción');
    } else {
        $.ajax({
            url: '../../app/controllers/capacitacionController.php',
            type: 'POST',
            data: $("#formBloquearExamen").serialize(),
            beforeSend: function () {
                $('#divCargando').css('z-index', '10000');
                $('#divCargando').fadeIn();
            },
            success: function (datos) {
                setTimeout(function () {
                    if (datos == "ok") {
                        mensaje('dark', 'Proceso completado', 'green', 'Se han habilitado las capacitaciones para estos usuarios exitosamente.');
                        $('#asignarCapacitacionModal').modal('hide');
                    } else {
                        mensaje('dark', 'Proceso fallido', 'red', 'No se pudo realizar la activacion de las capacitaciones a estos usuarios.');
                    }
                    $('#divCargando').fadeOut();
                }, 1500);
            }
        });
    }

}

function activarOpcion() {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('#moduloUsuarios').val('');
    } else {
        $(this).addClass('active');
        $('#moduloUsuarios').html($(this).data('value') + $('#moduloUsuarios').html());
    }
}

function formBusquedaUsuario() {
    alerta = $.alert({
        icon: 'fa fa-user',
        title: 'ASIGNAR USUARIO',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'small',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosVarios',
                    parametro: 'formularioUsuarioCapacitacion',
                    modelo: 'obtenerTiposCapacitacionUsuario'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        buttons: {
            AGREGAR: {
                btnClass: 'btn-info',
                action: function () {
                    if ($('#usuarioFormulario').val() == 0) {
                        $('#usuarioFormulario').css("border", "solid red");
                        $('#usuarioFormulario').css("border-width", "1px");
                        return false;
                    } else {
                        buscarUsuario($('#usuarioFormulario').val());
                        if (retorno != false) {
                            $('#btnAgregarCapacitacion').fadeOut();
                        }
                        return retorno;
                    }
                }
            }
        }
    });
}




// function generarInformeFecha() {
//     $.ajax({
//         url: "../../app/controllers/informesCapsController.php",
//         type: 'POST',
//         data: {metodo: 'generarInformeFechas',
//             FechaInicial: $("#IdfechaInicial").val(),
//             FechaFinal: $("#IdfechaFinal").val()
//         },
//     }).done(function (data) {
//         if (data == "fallo") {
//             mensaje('dark', '¡ATENCIÓN!', 'red', "Lo sentimos, no existen gestiones en este intervalo de fechas",
//                     "buscarFechasCapacitacion");
//             $("#IdfechaInicial").val("");
//             $("#IdfechaFinal").val("");
//         } else {
//             mensaje('dark', 'Informe generado', 'green', data);
//             $("#IdfechaInicial").val("");
//             $("#IdfechaFinal").val("");
//         }
//     });
// }

function buscarFechasCapacitacion() {
    $.alert({
        icon: 'fa fa-calendar',
        title: '¡BIENVENIDO!',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'medium',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosVarios',
                    parametro: 'parametrosInformeCapacitacion',
                    modelo: 'obtenerTiposCapacitacionUsuario'
                },
            }).done(function (response) {
                self.setContent(response);
                $('.fecha').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        },
        onContentReady: function () {
            $('.fecha').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        },
        buttons: {
            CONFIRMAR: {
                btnClass: 'btn-info',
                action: function () {

                    if ($("#IdfechaInicial").val() == 0) {
                        $("#IdfechaInicial").css("border", "solid red");
                        $("#IdfechaInicial").css("border-width", "1px");
                        return false;
                    }
                    if ($("#IdfechaFinal").val() == 0) {

                        $("#IdfechaFinal").css("border", "solid red");
                        $("#IdfechaFinal").css("border-width", "1px");
                        return false;
                    }
                    generarInformeFecha();
                }
            }
        }
    });
}

// function gererarInformeUsuario() {
//     var alertaInfo = $.alert({
//         icon: 'fa fa-line-chart',
//         title: 'Ingrese el usuario',
//         type: 'blue',
//         theme: 'dark',
//         columnClass: 'small',
//         escapeKey: true,
//         backgroundDismiss: true,
//         animation: 'rotateYR',
//         content: "<input class='form-control' id='usuarioPruebaIfo' placeholder='USUARIO' /><strong id='UPNoexiste' style='color: red;display:none'>Este usuario no esta registrado</strong>",
//         buttons: {

//             CONFIRMAR: {
//                 btnClass: 'btn-info',
//                 action: function () {
//                     $.ajax({
//                         url: "../../app/controllers/informesCapsController.php",
//                         type: 'POST',
//                         data: {metodo: 'generarInformeUsuario',
//                             usuario: $("#usuarioPruebaIfo").val()
//                         },
//                         success: function (resultado) {
//                             if (resultado == "fallo") {
//                                 mensaje('dark', '¡Ups!', 'red', "Es imposible ver el informe de este usuario porque las preguntas fueron eliminadas");
//                             } else if (resultado == "sinPruebas") {
//                                 $("#UPNoexiste").html("El Usuario no ha realizado prueba alguna");
//                                 $("#UPNoexiste").css("display", "");
//                                 $("#UPNoexiste").css("color", "red");
//                             } else {
//                                 mensaje('dark', 'Informe generado', 'green', resultado);
//                                 alertaInfo.close();
//                             }
//                         }
//                     });
//                     return false;
//                 }
//             }
//         }
//     });
// }


// function gererarInfoPruebasConsolidado() {

//     $.alert({
//         icon: 'fa fa-calendar',
//         title: '¡BIENVENIDO!',
//         type: 'blue',
//         escapeKey: true,
//         backgroundDismiss: true,
//         theme: 'dark',
//         columnClass: 'medium',
//         animation: 'rotateYR',
//         content: function () {
//             var self = this;
//             return $.ajax({
//                 url: '../../app/controllers/capacitacionController.php',
//                 type: 'POST',
//                 data: {
//                     metodo: 'formulariosVarios',
//                     parametro: 'parametrosInformeCapacitacion',
//                     modelo: 'obtenerTiposCapacitacionUsuario'
//                 },
//             }).done(function (response) {
//                 self.setContent(response);
//                 $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
//             });
//         },
//         onContentReady: function () {
//             $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
//         },
//         buttons: {
//             CONFIRMAR: {
//                 btnClass: 'btn-info',
//                 action: function () {
//                     $.ajax({
//                         url: "../../app/controllers/informesCapsController.php",
//                         type: 'POST',
//                         data: {metodo: 'generarInfoPruebas',
//                             fechaIni: $("#IdfechaInicial").val(),
//                             fechaFin: $("#IdfechaFinal").val()
//                         },
//                         success: function (resultado) {
//                             if (resultado == "fallo" || resultado == "") {
//                                 mensaje('dark', '¡ATENCIÓN!', 'red', "Lo sentimos, no existen gestiones en este intervalo de fechas",
//                                         "generarInfoPruebas");
//                             } else {
//                                 mensaje('dark', 'Informe generado', 'green', resultado);
//                             }
//                         }
//                     });
//                 }
//             }
//         }
//     });
// }

// Start Informes
function iniciarInformes() {
    $.ajax({
        url: '../../app/controllers/informesCapsController.php',
        type: 'POST',
        data: {
            metodo: 'iniciarInformes',
        },
        success: function (resultado) {
            $('#contenedor_data').html(resultado);
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth() + 1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if (dia < 10)
                dia = '0' + dia; //agrega cero si el menor de 10
            if (mes < 10)
                mes = '0' + mes //agrega cero si el menor de 10
            $("#dateInicial").val(ano + "-" + mes + "-" + dia);
            $("#dateFinal").val(ano + "-" + mes + "-" + dia);
            $('#selectInforme').on('change', generarInformeCaps);
            $("#btnDescargar").on('click', botones);
            $("#ver").on('click', botones);

        }
    });
}

function generarInformeCaps() {
    $.ajax({
        url: '../../app/controllers/informesCapsController.php',
        type: 'POST',
        data: {
            metodo: 'informesCaps',
            dataselect: $('#selectInforme').val(),
        },
        success: function (resultado) {
            $("#rowUsuarios").html(resultado);
            $(".data").each(function () {
                if ($(this).is("#rowUsuarios")) {
                    $(this).css('display', 'block');
                } else {
                    $(this).css('display', 'none');
                }
            });
            $("#sltUsuario").change(div);
        }
    });
};

function div() {
    if ($("#sltUsuario").val() != null) {
        $.ajax({
            url: '../../app/controllers/informesCapsController.php',
            type: 'POST',
            data: {
                metodo: 'informesCaps',
                parametro: $("#selectInforme").val(),
                dataselect1: $("#sltUsuario").val(),
            },
            success: function (resultado) {
                $("#rowComprobacionUSU").css('display', 'block');
                $("#rowComprobacionUSU").html(resultado);
                if ($('#diagrama').css('display') == "block") {
                    $('.checbox').children().removeClass("col-sm-6 col-md-3").addClass("col-sm-12");
                }
            }
        });
    }
}

function botones() {
    var usuario = $('#usuario').val();
    var btn = $(this).attr("id");
    comprobar = validar(usuario);
    if (comprobar == "") {
        if ($("#sltUsuario") != null) {
            var cualquiera = $("#formInformesCapacitacion").serializeArray();
            $.ajax({
                url: '../../app/controllers/informesCapsController.php',
                type: 'POST',
                data: {
                    metodo: 'descargarInforme',
                    parametro: $("#selectInforme").val(),
                    chkPrueba: $('#chkPrueba').is(":checked"),
                    chkAsignar: $('#chkAsignar').is(":checked"),
                    dato: cualquiera,
                    boton: btn,
                },
                success: function (resultado) {
                    if (resultado == "error") {
                        mensaje('dark', 'No hay datos', 'red', "No se encontraron resultados a este informe");
                    } else {
                        if (btn == "ver") {
                            $('#formInformesCapacitacion').addClass('col-sm-12 col-md-4 col-lg-4');
                            $('.checbox').children().removeClass("col-sm-6 col-md-3").addClass("col-sm-12");
                            $('.prueba').removeClass("col-sm-4 col-sm-8").addClass("col-sm-12");
                            $('#diagrama').css('display', 'block');
                            $('#diagrama').html(resultado);
                        } else {
                            mensaje('dark', 'Informe generado', 'green', resultado);
                        }
                    }
                }
            });
        }
    } else {
        mensaje('dark', '!UPS', 'red', 'Falta llenar estos campos ' + comprobar);
    }
}

function validar(usuario) {
    // Se valide que esten seleccionados los campos necesarios
    var dateInicial = $('#dateInicial');
    var dateFinal = $('#dateFinal');
    var chkPrueba = $('#chkPrueba');
    var chkAsignar = $('#chkAsignar');
    var selectInforme = $('#selectInforme');
    var sltUsuario = $('#sltUsuario');
    if (usuario == '1') {
        var datos = [selectInforme, sltUsuario];
    } else if (usuario == '7') {
        var datos = [dateInicial, dateFinal, chkPrueba, chkAsignar, selectInforme, sltUsuario];
    }
    var comprobar = "";
    var checkTrue = false;
    datos.forEach(function (dato) {
        if (dato.val() == "" || dato.val() == null || (((dato.attr("id") == "chkPrueba") || (dato.attr("id") == "chkAsignar")) && dato.is(':checked') == false)) {
            switch (dato.attr("id")) {
                case 'dateInicial':
                    comprobar += "<li>Fecha Inicial</li>";
                    break;
                case 'dateFinal':
                    comprobar += "<li>Fecha Final</li>";
                    break;
                case 'chkPrueba':
                    if (checkTrue) {
                        comprobar += "<li>No se selecciono un filtro de fecha</li>";
                    } else {
                        checkTrue = true;
                    }
                    break;
                case 'chkAsignar':
                    if (checkTrue) {
                        comprobar += "<li>No se selecciono un filtro de fecha</li>";
                    } else {
                        checkTrue = true;
                    }
                    break;
                case 'selectInforme':
                    comprobar += "<li>Seleccionar un tipo de informe</li>";
                    break;
                case 'sltUsuario':
                    comprobar += "<li>Seleccionar un usuario</li>";
                default:
                    break;
            }
            // validar = false;
        }
    });
    return comprobar;
}


// $('input:submit').click(function(){
// var dateInicial = $('#dateInicial');
// var dateFinal =  $('#dateFinal');
// var chkPrueba = $('#chkPrueba');
// var chkAsignar = $('#chkAsignar');
// var selectInforme = $('#selectInforme');
// var datos = [dateInicial, dateFinal,chkPrueba,chkAsignar,selectInforme];
// var comprobar = "";
// var checkTrue = false;
// var validar = true;
// datos.forEach(function(dato){
//     // alert(dato.is(':checked'));
//     if (dato.val() == "" || dato.val() == null || (((dato.attr("id") == "chkPrueba") || (dato.attr("id") == "chkPrueba")) && dato.is(':checked') == false)) {
//         switch(dato.attr("id")) {
//             case 'dateInicial':
//                 comprobar += "<li>Fecha Inicial</li>";
//                 break;
//             case 'dateFinal':
//                 comprobar += "<li>Fecha Final</li>";
//                 break;
//             case 'chkPrueba':
//                 if (checkTrue) {
//                     comprobar += "<li>Check Prueba</li>";
//                 }else{
//                     checkTrue = true;
//                 }
//                 break;
//             case 'chkAsignar':
//                 if (checkTrue) {
//                     comprobar += "<li>Check Asignar</li>";
//                 }else{
//                     checkTrue = true;
//                 }
//                 break;
//             case 'selectInforme':
//                 comprobar += "<li>Seleccionar un tipo de informe</li>";
//                 break;
//             default:
//                 break;
//         }
//         validar = false;
//     }
// });
//             if (validar) {
// }else{
//                 mensaje('dark','!UPS','red','Falta llenar estos campos ' + comprobar);
//             } 
//  });


// End Informes


// function iniciarInformes() {
//     $.ajax({
//         url: "../../app/controllers/informesCapsController.php",
//         type: 'POST',
//         data: {metodo: 'iniciarInformes',
//         },
//         success: function (resultado) {
//             $('#contenedor_data').html(resultado);
//             new Chart($("#pie-chart"), {
//                 type: 'doughnut',
//                 data: {
//                     position: 'letf',
//                     labels: ["Aprobados", "Reprobados", "Sin realizar"],
//                     datasets: [{
//                             label: "Population (millions)",
//                             backgroundColor: ["#646DFF", "#A958FF", "#58B9FF"],
//                             data: [$("#aprobados").val(), $("#reprobados").val(), $("#sinRealizar").val()]
//                         }]
//                 },
//                 options: {
//                     rotation: 0.5,
//                     layout: {
//                         padding: {
//                             left: 0,
//                             right: 0,
//                             top: 0,
//                             bottom: 10
//                         },
//                     },
//                     title: {
//                         position: 'bottom',
//                         display: true,
//                         text: 'Resultados de pruebas',
//                     }
//                 }
//             });
//             $('#btnBusquedaPorFecha').on("click", buscarFechasCapacitacion);
//             $('#btnPruebasRealizadas').on("click", gererarInformeUsuario);
//             $('#btnResultadosPruebasG').on("click", gererarInfoPruebasConsolidado);
//         }
//     });
// }

function IngresarFechaTipoCapInforme() {
    $.alert({
        icon: 'fa fa-calendar',
        title: '¡BIENVENIDO!',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'medium',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosVarios',
                    parametro: 'parametrosInformeCapacitacion',
                    modelo: 'obtenerTiposCapacitacionUsuario'
                },
            }).done(function (response) {
                self.setContent(response);
                $('.fecha').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        },
        onContentReady: function () {
            $('.fecha').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        },
        buttons: {
            CONFIRMAR: {
                btnClass: 'btn-info',
                action: function () {
                    if ($("#IdfechaInicial").val() == 0) {
                        $("#IdfechaInicial").css("border", "solid red");
                        $("#IdfechaInicial").css("border-width", "1px");
                        return false;
                    }
                    if ($("#IdfechaFinal").val() == 0) {
                        $("#IdfechaFinal").css("border", "solid red");
                        $("#IdfechaFinal").css("border-width", "1px");
                        return false;
                    }
                    generarInformeTipoCap();
                }
            }
        }
    });
}

// function generarInformeTipoCap() {
//     retorno = false;
//     $.ajax({
//         url: "../../app/controllers/informesCapsController.php",
//         type: 'POST',
//         data: {metodo: 'generarInformeTipoCapacitacion',
//             FechaInicial: $("#IdfechaInicial").val(),
//             FechaFinal: $("#IdfechaFinal").val(),
//             tipo_capacitacion: $("#IdTipoCapacitacion").val()
//         },
//     }).done(function (data) {
//         if (data == "fallo") {
//             mensaje('dark', '¡ATENCIÓN!', 'red', "Lo sentimos, no existen gestiones en este intervalo de fechas",
//                     "buscarFechasCapacitacion");
//             $("#IdfechaInicial").val("");
//             $("#IdfechaFinal").val("");
//         } else {
//             mensaje('dark', 'Informe generado', 'green', data);
//             $("#IdfechaInicial").val("");
//             $("#IdfechaFinal").val("");
//         }
//     });
// }

//----------------------------PRUEBA-----------------------------------------/

function recolectarRespuestas(usuario, tipo, duracionPrueba, tiempoU) {

    //obteniendo y guardando las respuestas y los datos de la prueba
    var respuestasUsuarios = [];
    var pos = 0;
    var cantidadPreguntas = $("#CantidadPreguntas").val();
    $(".Rpregunta").each(function () {
        if ($(this).prop("checked")) {
            respuestasUsuarios[pos++] = $(this).val();
        }
    });
    if (cantidadPreguntas == respuestasUsuarios.length) {
        $.alert({
            type: 'blue',
            theme: 'dark',
            title: '¿Seguro que deseas terminar la prueba?',
            content: 'Si guardas la prueba en este punto, no la podrás volver a realizar',
            buttons: {
                cancelar: function () {

                },
                confirmar: function () {
                    $('#Cronometro').countdown('pause');
                    $("#ContenidoPreguntas").remove();
                    alertaClavePrueba = $.alert({
                        title: 'Ingrese su contraseña',
                        theme: 'dark',
                        content: "<input id='passU' type='password' placeholder='Contraseña' class='form-control' required />" +
                            "<strong id='ClaveIncorrecta' hidden='true' style='color: red'>Contraseña errónea</strong>",
                        buttons: {

                            Confirmar: function () {
                                if ($("#passU").val() == 0) {
                                    $("#passU").css("border", "solid red");
                                    $("#passU").css("border-width", "1px");
                                    return false;
                                } else {
                                    return guardarPrueba(respuestasUsuarios, usuario, duracionPrueba, tipo, tiempoU);
                                    deshabilitarBotones(false);
                                }
                            }
                        }
                    });
                }
            }
        });
    } else {
        $.alert({
            title: 'Responde todas las preguntas',
            type: 'red',
            theme: 'dark',
            content: "Debes responder todas las preguntas"
        });
    }
}


function limiteTiempo(usuario, tiempo, tipo) {
    //Si se acaba el tiempo obtiene los datos alcanzados y los guarda
    var respuestasUsuarios = [];
    var pos = 0;

    $(".Rpregunta").each(function () {
        if ($(this).prop("checked")) {
            respuestasUsuarios[pos++] = $(this).val();
        }
    });
    console.log(respuestasUsuarios);
    $("#ContenidoPreguntas").remove();
    $.alert({
        title: 'Tiempo terminado !',
        theme: 'dark',
        content: "<label>Ingrese la contraseña </label><input id='passU' type='password' placeholder='Contraseña' class='form-control' required />" +
            "<strong id='ClaveIncorrecta' hidden='true' style='color: red'>Contraseña errónea</strong>",
        buttons: {
            Confirmar: function () {
                if ($("#passU").val() == 0) {
                    $("#passU").css("border", "solid red");
                    $("#passU").css("border-width", "1px");
                    return false;
                } else {
                    return guardarPrueba(respuestasUsuarios, usuario, tiempo, tipo, $('#tiempoU').val());
                }
            }
        }
    });
}

function guardarPrueba(respuestasUsuarios, usuario, tiempoFin, tipo, tiempoU) {
    //Guardar datos o respuestas de la pruebas
    var retorno = false;
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'guardarRespuestasUsuarios',
            usuario: usuario,
            clave: $('#passU').val(),
            respuestasUsuarios: respuestasUsuarios,
            tiempoFin: tiempoU,
            tipoPrueba: tipo,
            tiempoU: tiempoFin
        },
        success: function (resultado) {
            if (resultado == "ClaveMal") {
                $("#ClaveIncorrecta").removeAttr("hidden");
                retorno = false;
            } else {
                $.confirm({
                    type: 'blue',
                    theme: 'dark',
                    title: 'Prueba Guardada',
                    content: 'las respuestas han sido guardadas satisfactoriamente',
                    buttons: {
                        aceptar: function () {
                            location.reload();
                        }
                    }
                });
                alertaClavePrueba.close();
                retorno = true;
            }
        }
    });
    return retorno;
}


function buscarUsuarioPrueba(Usuario, tipo) {
    /*obtiene los datos del usuario y los envia al modelo para buscar 
        y validar que se pueda ejecutar la evaluación de la capacitación seleccionada */
    var duracionPrueba;
    var h = 0;
    var m = 0;
    var s = 0;
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'buscarPruebaDeUsuario',
            usuario: Usuario,
            tipoCap: tipo
        },
        success: function (resultado) {
            if (resultado == "NoExistente") {
                $("#PNoexiste").html("Este usuario no esta registrado");
                $("#PNoexiste").css("color", "red");
                $("#PNoexiste").removeAttr("hidden");
            } else if (resultado == "selectNo") {
                $("#PNoexiste").html("Selecciona una de las opciones");
                $("#selectTipoCapacitacion").css("border-color", "red");
                $("#PNoexiste").removeAttr("hidden");
            } else if (resultado == "NoCompletado") {
                $("#PNoexiste").html("Este usuario no a completado todas las capacitaciones de este tipo");
                $("#PNoexiste").css("color", "red");
                $("#PNoexiste").removeAttr("hidden");
            } else if (resultado == "yaCapacitado") {
                $("#PNoexiste").html("El usuario ya realizo este examen ");
                $("#PNoexiste").css("color", "red");
                $("#PNoexiste").removeAttr("hidden");
            } else if (resultado == "pruebaInexistente") {
                $("#PNoexiste").html("No existe este examen ");
                $("#PNoexiste").css("color", "red");
                $("#PNoexiste").removeAttr("hidden");
            } else {
                alertaAjax.close();
                if (terminosCondiciones(tipo, false)) {
                    $('#contenedor_data').html(resultado);
                    $("#idComenzarPrueba").on('click', function () {
                        deshabilitarBotones(true);
                        $("#TimerJ").timer({});
                        var tiempoPrueba = "000:00:00";
                        $(".tiempoPrueba").each(function () {
                            var temporal1 = tiempoPrueba.split(":");
                            var temporal2 = $(this).val().split(":");
                            temporal1[0] = parseInt(temporal1[0]) + parseInt(temporal2[0]);
                            temporal1[1] = parseInt(temporal1[1]) + parseInt(temporal2[1]);
                            temporal1[2] = parseInt(temporal1[2]) + parseInt(temporal2[2]);
                            tiempoPrueba = temporal1[0] + ":" + temporal1[1] + ":" + temporal1[2];

                        });
                        var tiempoFin = "";
                        var tiempoFin = tiempoPrueba.split(":");
                        var FechaActual = new Date();
                        var datetime = new Date(FechaActual.getFullYear(), (FechaActual.getMonth() + 1), FechaActual.getDate(), (FechaActual.getHours() + parseInt(tiempoFin[0])), (FechaActual.getMinutes() + parseInt(tiempoFin[1])), (FechaActual.getSeconds() + parseInt(tiempoFin[2])));
                        var segundos, minutos, horas;
                        $('#Cronometro').countdown(datetime, function (event) {
                            segundos = event.offset.seconds;
                            minutos = event.offset.minutes;
                            horas = event.offset.hours;
                            $(this).html(event.strftime('%H:%M:%S'));
                        }).on('update.countdown', function () {
                            if (horas == 0 && minutos == 1 && segundos == 1) {
                                $.alert({
                                    title: "",
                                    theme: 'material',
                                    animation: 'rotateYR',
                                    content: "¡la prueba terminara en un minuto!"
                                });
                            }
                            if (horas == 0 && minutos == 0 && segundos == 1) {
                                duracionPrueba = tiempoPrueba;
                                limiteTiempo(Usuario, duracionPrueba, tipo);
                            }
                        });
                        obtenerPreguntasRespuestas(Usuario, tipo);
                        $("#idComenzarPrueba").fadeOut();
                        $("#preguntas").fadeIn();
                    });
                    $("#idGuardarPrueba").on('click', function () {
                        var duracionPrueba = $('#TimerJ').val();
                        var tiempoU = $('#tiempoU').val();
                        recolectarRespuestas(Usuario, tipo, duracionPrueba, tiempoU);
                    });
                }
            }
        }
    });
}

function deshabilitarBotones(bool) {
    if (bool == true) {
        $('.SuperInicio').css('display', 'none');
    } else {
        $('.SuperInicio').css('display', 'block');
    }
}

function traerPlantillaPrueba() {
    // Modal de las pruebas que un usuario puede realizar
    alertaAjax = $.alert({
        icon: 'fa fa-user',
        title: 'EVALUAR USUARIO',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'medium',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosVarios',
                    parametro: 'busquedaPrueba',
                    modelo: 'obtenerPruebaUsuario'
                },
            }).done(function (response) {
                self.setContent(response);
            });
        },
        buttons: {
            AGREGAR: {
                btnClass: 'btn-info',
                action: function () {
                    if ($("#usuarioBusquedaPrueba").val() == 0) {
                        $("#usuarioBusquedaPrueba").css("border", "solid red");
                        return false;
                    } else {
                        buscarUsuarioPrueba($("#usuarioBusquedaPrueba").val(), $("#selectCapacitacion1").val());
                        return retorno;
                    }
                }
            }
        }
    });
}

function terminosCondiciones(tipo, activacion) {
    // Modal con los terminos y condiciones de la capacitacion
    var retorno = true;
    var checkTermino = "<hr><div style='width: 35%; margin-left: 65%; margin-top: -1%; font: italic;'> <label id='lbAcepto' style='margin-bottom: 4%;'>Acepto los terminos .</label><input id='checkTermino' type='checkbox' value='1' required /></div>";
    var idTipo = tipo;
    $.alert({
        title: 'Términos y condiciones',
        columnClass: 'medium',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'obtenerTerminos',
                    tipoCap: idTipo
                },
            }).done(function (response) {
                self.setContent(response + checkTermino);
            });
        },
        buttons: {
            IniciarPrueba: {
                btnClass: 'btn-info',
                text: 'Ir al examen',
                action: function () {
                    if (!$("#checkTermino").prop('checked')) {
                        $("#checkTermino").css("color", "red");
                        $("#lbAcepto").css("color", "red");
                        retorno = false;
                    } else {
                        if (activacion) {
                            guardarHistorico();
                        } else {
                            $("#ContenidoPreguntas").fadeIn();
                        }
                        retorno = true;
                    }
                    return retorno;
                }
            }
        }
    });
    return retorno;
}

function obtenerPreguntasRespuestas(usuario, tipo) {
    //trae los datos de las preguntas y respuestas y lo pinta
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'formulariosVarios',
            parametro: 'pruebaPreguntas',
            modelo: 'obtenerPreguntasRespuestas',
            obtencion: "",
            usuario: usuario,
            tipoCap: tipo
        },
    }).done(function (data) {
        $("#preguntasOpciones").html(data);
        var cont = 0;
        $(".pregunta").each(function () {
            if (cont == 0) {
                $(this).css('display', 'block');
            } else {
                $(this).css('display', 'none');
            }
            cont++;
        });
        var contadorsiguiente = 0;
        $('#siguiente').on("click", function () {
            contadorsiguiente++;
            var contadorcheck = 0;
            $('.Rpregunta').each(function () {
                if ($(this).is(':checked')) {
                    contadorcheck++;
                }
            });
            if (contadorsiguiente == contadorcheck) {
                var trues = false;
                $(".pregunta").each(function () {
                    if ($(this).css('display') == 'block') {

                        $(this).css('display', 'none');
                        $('#idGuardarPrueba').css('display', 'block');

                        if ($(this).css('display') == 'none') {
                            $('#siguiente').css('display', 'none');

                        }
                        trues = true;
                    } else if (trues) {
                        $(this).css('display', 'block');
                        $('#idGuardarPrueba').css('display', 'none');

                        if ($(this).css('display') == 'block') {
                            $('#siguiente').css('display', 'inline-block');
                        }
                        trues = false;
                    }
                });
            } else {
                contadorsiguiente--;
                $.alert({
                    title: 'Error!',
                    content: 'No has seleccionado una opcion!',
                    theme: 'dark',
                    type: 'red',
                });
            }
        });
        $('.Rpregunta').change(function () {
            if ($(this).prop("checked")) {
                $("#tiempoU").val($("#tiempoU").val() + $(this).val() + " - " + $('#TimerJ').val() + ",");
                // $("#TimerJ").val($('#TimerJ').val());
            }
        });
    });
}



// function vaciarPreguntas() {
//     $.confirm({
//         icon: 'fa fa-warning',
//         title: '¿Estas seguro(a)?',
//         content: 'las preguntas se eliminaran de manera premanente',
//         type: 'orange',
//         typeAnimated: true,
//         backgroundDismiss: true,
//         buttons: {
//             ACEPTAR: {
//                 btnClass: 'btn-orange',
//                 action: function () {
//                     $.ajax({
//                         url: "../../app/controllers/capacitacionController.php",
//                         type: 'POST',
//                         data: {
//                             metodo: "vaciarPreguntas",
//                             tipoCapacitacion: $("#selectPrueba").val()
//                         },
//                         success: function (resultado) {
//                             if (resultado == "ok") {
//                                 tipoCapacitacion = $("#selectPrueba").val();
//                                 mensaje('dark', '¡Preguntas Eliminadas!', 'blue', "Los cambios se han realizado con exito ", "cambioSelectPrueba");
//                             } else {
//                                 mensaje('dark', '¡Hubo un problema al cargar el archivo!', 'red', "es imposible vaciar las preguntas");
//                             }
//                         }
//                     });
//                 }
//             },
//             CANCELAR: {
//                 action: function () {
//                 }
//             }
//         }
//     });
// }







// Cambios CApacitacion LUIS-KAYA


function iniciarCapacitacion() {
    var thiz = $(this);
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'iniciarCapacitacion',
            id: thiz.data('tipo'),
            img: thiz.data("Imagen")
        },
        success: function (resultado) {
            $('#contenedor_data').html(resultado);
            $('#btnAgregarCapacitacion').on('click', asignarCapacitaciones);
            $('#btnHabilitarUsuarios').on('click', asignarCapacitaciones);
            $('#btnBloquearExamen').on('click', asignarCapacitaciones);
            // $('#ulModulos').on('click','li', asignarCapacitacion);
            // $('#moduloUsu').on('click','li', guardarAsignacionUsuario);
            $('#formGuardarCapacitacion').on('submit', preGuardarHistorico);
            $('.BTNdescargarInformeCap').on("click", IngresarFechaTipoCapInforme);
            $('.Cajas1').css("display", "none");
            $('.classChulo1').addClass("fa fa-check");
            $('#volver').on('click', function () {
                location.reload();
            });
        }
    });
}

function preGuardarHistorico() {
    terminosCondiciones($("#IdTipoCapacitacion").val(), true);
}

function guardarHistorico() {
    $.alert({
        icon: 'fa fa-key',
        title: 'INGRESE LA CONTRASEÑA',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'small',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosVarios',
                    parametro: 'formularioUsuarioClave',
                    modelo: 'obtenerTiposCapacitacionUsuario'
                }
            }).done(function (response) {
                self.setContent(response);
            });
        },
        buttons: {
            GUARDAR: {
                btnClass: 'btn-info',
                action: function () {
                    if ($("#claveFormulario").val() == 0) {
                        $('#claveFormulario').css("border", "solid red");
                        $('#claveFormulario').css("border-width", "1px");
                        return false;
                    }
                    $("#usuarioClave").val($("#claveFormulario").val());
                    validarU();
                }
            }
        }
    });
}

function validarU() {
    var a = $.alert({
        icon: 'fa fa-user',
        title: 'GESTION',
        type: 'blue',
        escapeKey: false,
        backgroundDismiss: false,
        theme: 'dark',
        columnClass: 'small',
        animation: 'rotateYR',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: $("#formGuardarCapacitacion").serialize(),
            }).done(function (response) {
                if (response == "Contraseña errónea") {
                    mensaje('dark', 'Ups!', 'red', response, "guardarHistorico");
                    a.close();
                } else {
                    self.setContent(response);
                }
            });
        },
        buttons: {
            ACEPTAR: {
                btnClass: 'btn-info',
                action: function () {
                    location.reload();
                    return true;
                }
            }
        }
    });
}

function gestionTipoCapacitacion() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'gestionTipoCapacitacion'
        },
        success: function (resultado) {
            $("#contenedor_data").html(resultado);
            $(".inputCarga").fileinput({
                Locales: "es",
                browseLabel: 'Examinar...',
            });
            $('#btnSubirTipo').on('click', cargarTipoCapacitacion);
        }
    });
}

function cargarTipoCapacitacion() {
    if ($('#nombreTipo').val() == "" || $('#archivo').val() == "" || $('#descripcionTipo').val() == "") {
        mensaje('dark', '¡Ups!', 'red', "Datos incompletos");
    } else {
        var formData = new FormData(document.getElementById("subirTipoCap"));
        $.ajax({
            url: "../../app/controllers/capacitacionController.php",
            type: 'POST',
            data: formData,
            cax: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#divCargando').fadeIn();
            },
        }).done(function (data) {
            $('#divCargando').fadeOut();
            if (data == "ok") {
                mensaje('dark', 'Creacion Exitosa!', 'green', "Se creo correctamente el tipo capacitacion");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                mensaje('dark', '¡Ups!', 'red', "No se pudo crear correctamente el tipo capacitacion");
            }
        });
    }


}

function gestionCapacitacion() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'gestionarCapacitaciones'
        },
        success: function (resultado) {
            $("#contenedor_data").html(resultado);
            $("#TipoCapacitacion").change(getTablaCapacitaciones);
        }
    });
}

function getTablaCapacitaciones() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: "POST",
        data: {
            metodo: "formulariosVarios",
            modelo: "obtenerCapacitaciones",
            parametro: "tablaCapacitaciones",
            id: $("#TipoCapacitacion").val()
        },
        success: function (resultado) {
            $("#ContenidoTabla").html(resultado);
            $(".btnBorrarCap").click(eliminarCapacitacion);
            $("#IdNCapacitacion").click(function () {
                formInsertarCapacitacion($("#TipoCapacitacion").val());
            });
        }
    });
}

function formInsertarCapacitacion(tipoCap) {
    $.alert({
        title: 'SUBIR CAPACITACION',
        theme: 'Supervan',
        content: '' +
            '<form enctype="multipart/form-data" id="formCargarCapacitacion" action="javascipt:void()">' +
            '<input id="nombreCapacitacion" name="nombreCapacitacion" type="text" placeholder="Nombre" class="name form-control" required />' +
            '<label>Adjunte archivo</label>' +
            '<input name="archivoCap" accept="application/pdf" type="file" class="" required />' +
            '<label>tipo de archivo</label>' +
            '<br>' +
            '<select class="form-control" name="tipoArchivo" style="color:#4C516A;" >' +
            '<option>Seleccione...</option>' +
            '<option value="pdf">PDF</option>' +
            '<option value="mp4">MP4</option>' +
            '<option value="mp3">MP3</option>' +
            '</select>' +
            '<input type="hidden" name="metodo" value="insertarCapacitacion"/>' +
            '<input type="hidden" name="tipoCap" value="' + tipoCap + '"/>' +
            '</form>',
        escapeKey: true,
        backgroundDismiss: true,
        boxWidth: '500px',
        buttons: {
            subir: function () {

                if ($("#nombreCapacitacion").val() == 0) {
                    $('#nombreCapacitacion').css("border-color", "red");
                    return false;
                } else {
                    var formDataCap = new FormData(document.getElementById("formCargarCapacitacion"));
                    $.ajax({
                        url: "../../app/controllers/capacitacionController.php",
                        type: 'POST',
                        dataType: "json",
                        data: formDataCap,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $('#divCargando').fadeIn();
                        },
                    }).done(function (data) {
                        $('#divCargando').fadeOut();
                        if (data.resultado == "ok") {
                            tipoCapacitacion = tipoCap;
                            mensaje('dark', '¡Gestion Exitosa!', 'green', data.mensaje, "getTablaCapacitaciones");
                        } else {
                            mensaje('dark', '¡Ups!', 'red', data.mensaje);
                        }
                    });
                }
            }
        }
    });
}

function guardarRespuestasGestion() {
    if ($("#tiempoPrueba").val() == "" || $("#tiempoPrueba").val().length < 8 || ($("#tiempoPrueba").val()[4] < 1 && $("#tiempoPrueba").val()[0] == 0 && $("#tiempoPrueba").val()[1] == 0 && $("#tiempoPrueba").val()[3] == 0)) {
        mensaje('dark', '¡ Mal tiempo!', 'red', 'Necesita agregar el tiempo a la prueba que sea mayor 1 minuto');
    } else if ($("#rangoAprobacion").val() <= 50) {
        mensaje('dark', '¡Ups!', 'red', 'El porcentaje de aprobación no puede ser inferior al 50%');
    } else {
        $.ajax({
            url: "../../app/controllers/capacitacionController.php",
            type: 'POST',
            data: $(this).serialize(),
            success: function (tipoCap) {
                tipoCapacitacion = tipoCap;
                mensaje('dark', '¡Gestion Exitosa!', 'green', "Los cambios se han realizado con exito ", "cambioSelectPrueba");
            }
        });
    }


}

function inicioPreguntas() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'inicioPreguntas'
        },
        success: function (resultado) {
            $('#contenedor_data').html(resultado);
            $("#selectTipo").change(cambioSelectTipo);
            $("#selectCapacitacion").change(cambioSelectPrueba);
            $(".inputCarga").fileinput({
                Locales: "es",
                browseLabel: 'Examinar...',
            });
            $('.formCarga').on('submit', cargarPreguntas);
        }
    });
}

function cambioSelectTipo() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'cargaCapacitacion',
            id: $('#selectTipo').val()
        },
        success: function (resultado) {
            $("#selectCapacitacion").html(resultado);
        }
    });
}

function cambioSelectPrueba() {

    if ($("#selectCapacitacion").val() != "none") {
        $.ajax({
            url: "../../app/controllers/capacitacionController.php",
            type: 'POST',
            data: {
                metodo: 'formulariosVarios',
                parametro: "tablaPreguntas",
                modelo: 'obtenerPreguntasRespuestas',
                obtencion: "gestion",
                tipoCap: $("#selectCapacitacion").val()
            },
            success: function (resultado) {
                $('#divTabla').html(resultado);
                $("#rangoAprobacion").change(function () {
                    $("#porcentajeA").val($("#rangoAprobacion").val() + "%");
                });
                $("#tipoCap").val($("#selectCapacitacion").val());
                if ($("#inputCargue").val("true")) {
                    $("#divCarga").show();
                }
                $(".seccionOculta").show();

                $("#tiempoPrueba").on('keyup', function () {
                    var value = $(this).val();
                    if (value.length >= 8) {

                        var temp = value[0] + value[1] + value[2] + value[3] + value[4] + value[5] +
                            value[6] + value[7];

                        $("#tiempoPrueba").val(temp);
                    }
                    if (value.length == 2 || value.length == 5) {
                        $(this).val($(this).val() + ":");
                    }
                });

                $("#cantidadCheck").change(function () {
                    var contCheck = 0;
                    $('.Check').each(function (index) {
                        if ($(this).prop('checked')) {
                            contCheck++;
                            console.log(contCheck);
                        }
                    });
                    if (($("#cantidadCheck").val() <= "0") || (Number($("#cantidadCheck").val()) > contCheck)) {
                        $("#cantidadCheck").val(Number(contCheck));
                        $.alert({
                            title: "Error",
                            content: "El numero que ha escrito esta por fuera del rango de las preguntas seleccionadas",
                            type: 'red',
                        });
                    }
                });
                $('#formPreguntas').submit(guardarRespuestasGestion);


            }
        });
    } else {
        $("#seccionPreguntas").hide();
    }
}



function administrarUsuarios() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'administracionUsuarios'
            // id: $(this).data("ids")
        },
        success: function (resultado) {
            $("#contenedor_data").html(resultado);
            $('.btnActualizar').on('click', formActualizarUsuario);
            $('#formActualizarCap').submit(actualizarUsuario);
            $('.verCertificado').click(verCertificado);
        }
    });
}

function verCertificado() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        data: {
            metodo: 'certificacionesUsuarios',
            id: $(this).data("id")
        },
        success: function (resultado) {
            $("#verCertificadoCapa").html(resultado);
        }
    });
}

function formActualizarUsuario() {
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: "POST",
        data: {
            metodo: "formulariosVarios",
            modelo: "obtenerCapacitacionesUsuario",
            parametro: "checksAdmin",
            idUsuario: $(this).data("id")
        },
        success: function (resultado) {
            $("#contenidoChecks").html(resultado);
            $(".inputCarga").fileinput({
                Locales: "es",
                browseLabel: 'Examinar...',
            });
        }
    });
}

function actualizarUsuario() {
    var formData = new FormData(document.getElementById("formActualizarCap"));
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
        type: 'POST',
        // dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#divCargando').fadeIn();
        },
    }).done(function (data) {
        $('#divCargando').fadeOut();
        if (data == "fallo") {
            mensaje('dark', '¡Ups!', 'red', "En estos momentos es imposible cargar");
        } else if (data == "ok") {
            $("#modal-container-851020").modal('hide');
            mensaje('dark', '¡Gestion Exitosa!', 'green', "se ha actualizado el tipo de capacitacion", "administrarUsuarios");
        }
    });
}

function cargarPreguntas() {
    //Guardar las preguntas y pruebas de una capacitación
    var formData = new FormData(document.getElementById("formCarga"));
    $.ajax({
        url: "../../app/controllers/capacitacionController.php",
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
            tipoCap = $("#tipoCap").val();
            mensaje('dark', 'Proceso Completado', 'green', data.mensaje, "cambioSelectPrueba");
        } else {
            mensaje('dark', '¡Hubo un problema al cargar el archivo!', 'red', data.mensaje);
        }
    });
}

function buscarCertificado() {
    alertaAjax = $.alert({
        icon: 'fa fa-user',
        title: 'CERTIFICAR USUARIO',
        type: 'blue',
        escapeKey: true,
        backgroundDismiss: true,
        theme: 'dark',
        columnClass: 'small',
        animation: 'left',
        content: function () {
            var self = this;
            return $.ajax({
                url: '../../app/controllers/capacitacionController.php',
                type: 'POST',
                data: {
                    metodo: 'formulariosVarios',
                    parametro: 'busquedaPrueba',
                    modelo: 'obtenerPruebaUsuario'
                },
                success: function (response) {
                    self.setContent(response);
                }
            });
        },
        buttons: {
            AGREGAR: {
                btnClass: 'btn-info',
                action: function () {
                    if ($("#selectCapacitacion1").val() == "seleccione") {
                        $("#selectCapacitacion1").css("border-color", "red");
                    } else {
                        if ($("#usuarioBusquedaPrueba").val() == 0) {
                            $("#usuarioBusquedaPrueba").css("border-color", "red");
                        } else {
                            $.ajax({
                                url: "../../app/controllers/capacitacionController.php",
                                type: 'POST',
                                data: {
                                    metodo: 'generarCertificado',
                                    usuario: $("#usuarioBusquedaPrueba").val(),
                                    tipoCap: $("#selectCapacitacion1").val()
                                },
                                success: function (resultado) {
                                    if (resultado == "noExiste") {
                                        $("#PNoexiste").html("Este usuario no ha realizado el examen");
                                        $("#PNoexiste").removeAttr("hidden");
                                    } else if (resultado == "reprobado") {
                                        $("#PNoexiste").html("Examen reprobado");
                                        $("#PNoexiste").removeAttr("hidden");
                                    } else {
                                        mensaje('dark', 'Informe generado', 'green', resultado);
                                        alertaAjax.close();
                                    }
                                }
                            });
                        }
                    }
                    return false;
                }
            }
        }
    });
}


// $(document).ready(function () {
//     $.datetimepicker.setLocale('es');
//     $(document).on('click', function (ev) {
//         ev.stopImmediatePropagation();
//         $(".dropdown-toggle").dropdown("active");
//     });
//     $('.accionInicioCapacitacion').on('click', function () {
//         location.reload();
//     });
//     $('.btnIniciarCapacitacion').on('click', iniciarCapacitacion);
//     $('.accionInicioPrueba').on('click', traerPlantillaPrueba);
//     //$('.accionInicioPruebaXU').on('click', terminosCondiciones);
//     $('.accionInformesCapacitacion').on('click', iniciarInformes);
//     $('#accionPreguntas').on('click', inicioPreguntas);
//     $('#accionCertificado').on('click', buscarCertificado);
//     $('#accionUsuariosCap').on('click', administrarUsuarios);
//     $('#accionCapacitacion').on('click', gestionCapacitacion);
//     $('#accionCargarTipo').on('click', gestionTipoCapacitacion);
// });


// Cambios CApacitacion LUIS-KAYA FIN



// revisar
function eliminarCapacitacion() {
    var IdCapacitacion = $(this).data('id');
    $.confirm({
        icon: 'fa fa-warning',
        title: '¿Estas seguro(a)?',
        content: 'se eliminara permanentemente esta capacitacion',
        type: 'orange',
        typeAnimated: true,
        backgroundDismiss: true,
        buttons: {
            ACEPTAR: {
                btnClass: 'btn-orange',
                action: function () {
                    $.ajax({
                        url: "../../app/controllers/capacitacionController.php",
                        type: 'POST',
                        data: {
                            metodo: "eliminarCapacitacion",
                            id: IdCapacitacion
                        },
                        success: function (resultado) {
                            if (resultado == "OK") {
                                mensaje('dark', '¡Gestion Exitosa!', 'green', "La capacitacion se elimino correctamente", "getTablaCapacitaciones");
                            } else {
                                mensaje('dark', '¡Ocurrio un error!', 'red', "No se elimio el archivo");
                            }
                        }
                    });
                }
            },
            CANCELAR: {
                action: function () {}
            }
        }
    });
}









function mensaje(tema, titulo, color, mensaje, AccionBTN) {
    // Genera un modal con mensajes hacia el usuario
    $.alert({
        icon: 'fa fa-circle',
        title: titulo,
        type: color,
        escapeKey: true,
        backgroundDismiss: true,
        theme: tema,
        columnClass: 'medium',
        animation: 'rotateYR',
        content: mensaje,
        buttons: {
            OK: {
                btnClass: 'btn-success',
                action: function () {
                    switch (AccionBTN) {
                        case "buscarFechasCapacitacion":
                            buscarFechasCapacitacion();
                            break;
                        case "guardarHistorico":
                            guardarHistorico();
                            break;
                        case "generarInfoPruebas":
                            gererarInfoPruebasConsolidado();
                            break;
                        case "administrarUsuarios":
                            administrarUsuarios();
                            break;
                        case "cambioSelectPrueba":
                            $("#selectPrueba").val(tipoCapacitacion);
                            cambioSelectPrueba();
                            break;
                        case "getTablaCapacitaciones":
                            $("#TipoCapacitacion").val(tipoCapacitacion);
                            getTablaCapacitaciones();
                        default:
                            return true;
                            break;
                    }
                }
            }
        }
    });
}
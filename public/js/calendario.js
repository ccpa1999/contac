let myModal = "";

function setCalendario(elemento, eventos = []) {
    myModal = new bootstrap.Modal($('#agendarModal'));

    let calendar = new FullCalendar.Calendar(elemento, {
        locale: 'es',
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
        },
        dayMaxEvents: true,
        editable: true,
        selectable: true,
        select: function (info) {
            let fechaSeleccionada = (!(info.startStr.includes("T"))) ? info.startStr + " 23:59:59" : info.startStr;

            $("#agendarEvento .button-calendario").show();
            $(".validar").removeClass("is-invalid");

            if (fechaMayorIgual(fechaSeleccionada, new Date())) {
                $("#agendarEvento input").removeAttr("readonly");
                $("#agendarEvento #usuario, #tipoEvento").removeAttr("disabled");

                resetFormAgendamiento();
                controlReprogramacion();

                let valorInicial = "";
                let valorFinal = "";

                if (info.startStr.includes("T")) {
                    changeClasses($("#agendarEvento").find('#inicio_evento'), "fechaHora", "fecha");
                    changeClasses($("#agendarEvento").find('#fin_evento'), "fechaHora", "fecha");

                    $("#contenedor_hora").find('input').attr("disabled", '');
                    $("#contenedor_hora").hide();

                    valorInicial = dateFormat(info.startStr);
                    valorFinal = dateFormat(info.endStr);
                } else {
                    changeClasses($("#agendarEvento").find('#inicio_evento'), "fecha", "fechaHora");
                    changeClasses($("#agendarEvento").find('#fin_evento'), "fecha", "fechaHora");

                    $("#contenedor_hora").find('input').removeAttr("disabled");
                    $("#contenedor_hora").show();

                    let fechaFinal = dateFormat(info.endStr);

                    valorInicial = info.startStr;
                    valorFinal = fechaFinal;
                }

                $("#agendarEvento").find("#inicio_evento").val(valorInicial);
                $("#agendarEvento").find("#fin_evento").val(valorFinal);

                if ($("#rolActual").val().includes("Asesor"))
                    controlReprogramacion();

                inputsTime();

                myModal.show();
            }
        },
        eventClick: function (info) {
            $(".validar").removeClass("is-invalid");
            resetFormAgendamiento();

            changeClasses($("#agendarEvento").find('#inicio_evento'), "fechaHora", "fecha");
            changeClasses($("#agendarEvento").find('#fin_evento'), "fechaHora", "fecha");
            inputsTime();

            $("#contenedor_hora").find('input').attr("disabled", '');
            $("#contenedor_hora").hide();

            // Establecer el tipo del evento
            $(`#tipoEvento option[value='${info.event.extendedProps.tipo}']`).attr("selected", true);
            $(`#tipoEvento`).val(info.event.extendedProps.tipo);
            $("#titulo").val(info.event.title);
            $(`#usuario option[value='${info.event.extendedProps.usuario}']`).attr("selected", true);

            // Habilitar y definir el id del evento
            let idEvento = info.event.id;
            $("#agendarEvento").find("#id").val(idEvento);
            $("#agendarEvento").find("#id").removeAttr("disabled");

            $("#agendarEvento #eliminarEvento").attr("data-id", idEvento);
            $("#agendarEvento #eliminarEvento").removeAttr("disabled");
            $("#agendarEvento #eliminarEvento").show();

            let fechaInicial = dateFormat(info.event.startStr);
            let fechaFin = dateFormat(info.event.endStr);

            $("#agendarEvento").find("#inicio_evento").val(fechaInicial);
            $("#agendarEvento").find("#fin_evento").val(fechaFin);

            if (fechaMayorIgual(fechaInicial, new Date())) {
                $("#agendarEvento #usuario, #tipoEvento").removeAttr("disabled");
                $("#agendarEvento .button-calendario").show();

                controlReprogramacion();

                if (!($("#rolActual").val().includes("Asesor"))) {
                    $("#agendarEvento input").removeAttr("readonly");
                }
                else {
                    if (info.event.extendedProps.tipo == "reprogramacion")
                    {
                        $("#agendarEvento #eliminarEvento").hide();

                        $("#agendarEvento #titulo").attr("readonly", "");
                        $("#agendarEvento #inicio_evento").removeAttr("readonly");
                    }
                    else 
                        deshabilitarInputsAgendamiento();
                }

                if (info.event.extendedProps.tipo == "reprogramacion")
                    $("#agendarEvento #fin_evento").attr("readonly", "");
            }
            else {
                if (!($("#rolActual").val().includes("Asesor"))) {
                    if (info.event.extendedProps.tipo != "reprogramacion")
                        controlReprogramacion();
                    else
                        obtenerUsuariosCartera("Asesor");
                }
                else
                {
                    $("#agendarEvento #usuario").html(`<option value="${info.event.extendedProps.usuario}">
                      ${info.event.extendedProps.usuario}</option>`);
                }

                deshabilitarInputsAgendamiento();
            }

            $("#agendarEvento").off("click", "#eliminarEvento");
            $("#agendarEvento").on("click", "#eliminarEvento", function () {
                $.confirm({
                    type: 'red',
                    title: 'Eliminar Opción!',
                    content: `Está seguro que quiere eliminar definitivamente: <div class="text-center fw-bold fs-5">${info.event.title}</div>`,
                    buttons: {
                        cancelar: {
                            action: function () { }
                        },
                        Eliminar: {
                            text: 'Eliminar',
                            btnClass: 'btn-danger',
                            keys: ['enter', 'shift'],
                            action: function () {
                                if (info.event.extendedProps.estado == 0) {
                                    $.ajax({
                                        url: '../../app/controllers/carterasController.php',
                                        type: 'POST',
                                        data: {
                                            id: {
                                                id: idEvento,
                                                usuario: $("#usuarios").val(),
                                            },
                                            metodo: 'borrarRegistro',
                                            accion: 'borrarEvento',
                                        }
                                    }).done(function (resultado) {
                                        resultado = JSON.parse(resultado);

                                        if (resultado !== false) {
                                            let contenido = `Se ha eliminado: 
                                                <div class="text-center fw-bold fs-5">${info.event.title}</div>`;

                                            myModal.hide();
                                            successAgendamiento(resultado, 'light', 'Eliminado', 'red', contenido);

                                        }
                                        else
                                            mensaje('light', 'Eliminado', 'red', "No se elimino el evento");
                                    });
                                }
                                else
                                    mensaje('light', 'Eliminado', 'red', "Ya se realizo el evento. No se puede ELIMINAR!!!");
                            }
                        }
                    }
                });
            })

            myModal.show();
        },
        eventDrop: function (info) {
            moverFechaHora(info);
        },
        eventResize: function (info) {
            moverFechaHora(info);
        },
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: true,
            meridiem: 'short',
            hour12: true
        },
        events: eventos,
    });

    calendar.render();
}

function moverFechaHora(info) {
    let fechaInicial = dateFormat(info.event.startStr);

    if ((fechaMayorIgual(info.oldEvent.startStr, new Date()) && fechaMayorIgual(fechaInicial, new Date()) &&
        info.event.extendedProps.tipo != "reprogramacion") && !($("#rolActual").val().includes("Asesor"))) {
        let fechaInicial = dateFormat(info.event.startStr);
        let fechaFinal = dateFormat(info.event.endStr);

        let datos = {
            id: info.event.id,
            usuario: $("#usuarios").val(),
            tipo: info.event.extendedProps.tipo,
            titulo: info.event.title,
            inicio_evento: fechaInicial,
            fin_evento: fechaFinal,
            metodo: "crearRegistro",
            accion: "guardarEvento"
        };

        $.confirm({
            title: "Mover Evento!",
            content: `Desea Mover el evento <b>${info.event.title}</b> a el<br> 
              <b class="text-primary">${fechaInicial}</b> hasta <b class="text-primary">${fechaFinal}</b>`,
            type: "blue",
            buttons: {
                cancelar: function () {
                    info.revert();
                },
                mover: {
                    text: "Mover Evento",
                    btnClass: "btn-primary",
                    keys: ['enter', 'shift'],
                    action: function () {
                        $.ajax({
                            url: "../../app/controllers/carterasController.php",
                            type: "POST",
                            data: datos,
                        }).done(function (resultado) {
                            resultado = JSON.parse(resultado);

                            if (resultado.resultado == "calendario") {
                                successAgendamiento(resultado.eventos, "light", "Proceso Exitoso", 
                                  'green', 'Se movió el evento');
                            }
                            else if (resultado.resultado === false || resultado === false) {
                                mensaje("light", "Error al guardar!!!", 'red', 'No se pudo almacenar la información');
                                info.revert();
                            }
                        });
                    }
                },
            }
        });
    }
    else
        info.revert();
}

function controlReprogramacion() {
    if ($('#tipoEvento').val() == 'reprogramacion') {
        $('#tituloLabel').html('Cédula');
        $("#fin_evento, #h_fin").attr("readonly", "");

        if ($("#inicio_evento").val() != "") {
            if ($("#inicio_evento").val().includes(" ")) {
                fechaReprogramados();
            }
            else {
                if ($("#fin_evento").val() != "" && $("#h_inicio").val() != "")
                    fechaReprogramados()
            }
        }
    } else {
        $('#tituloLabel').html('Nombre del evento');
        $("#h_fin").removeAttr("readonly");
        $("#fin_evento").removeAttr("readonly");

        obtenerUsuariosCartera("Asesor");
    }
}

function selectUsuarios(data = []) {
    $("#agendarEvento #usuario").html("");

    if (data.length == 0 && $("#agendarEvento #tipoEvento").val() == "reprogramacion") {
        $("#agendarEvento #usuario").html(`<option value="">Sin usuarios disponibles</option>`);
    }
    else {
        let usuario = $("#usuarios").val();

        for (i = 0; i < data.length; i++) {
            if (i == 0) {
                $("#agendarEvento #usuario").html(`<option value="">seleccione...</option>`);

                if ($("#rolActual").val().includes("Coordinador") && $("#agendarEvento #tipoEvento").val() != "reprogramacion") {
                    let usuarioCalendario = $("#usuarios option")[0].value;

                    $("#agendarEvento #usuario").html(`<option value="${usuarioCalendario}">${usuarioCalendario}</option>`);
                }
            }

            $("#agendarEvento #usuario").append(`<option ${(usuario == data[i].usuario) ? 'selected' : ''} value="${data[i].usuario}">${data[i].usuario}</option>`);
        }
    }
}

function resetFormAgendamiento() {
    let usuario = $("#usuario").val();

    $("#agendarEvento")[0].reset();

    $("#agendarEvento #tipoEvento option:selected").removeAttr("selected");
    $("#usuario option:selected").removeAttr("selected");

    $("#agendarEvento #id").attr("disabled", "");
    $("#agendarEvento #id").val("");

    $("#agendarEvento #eliminarEvento").attr("data-id", "");
    $("#agendarEvento #eliminarEvento").attr("disabled", "");

    $("#agendarEvento #eliminarEvento").hide();
}

function establecerUsuarioSelects(usuario = $("#usuarios").val()) {
    if (usuario == "")
        usuario = $("#usuarios").val();

    $(`#usuario option[value='${usuario}']`).attr("selected", true);
    $(`#usuarios option[value='${usuario}']`).attr("selected", true);

    $(`#agendarEvento #usuario`).val(usuario);
    $(`#usuarios`).val(usuario);
}

function changeClasses(elemento, addClass, removeClass) {
    elemento.addClass(addClass).removeClass(removeClass);
}

function dateFormat(date) {
    let fecha = new Date(date);

    fechaFormat = fecha.getFullYear() + "-"
        + ((fecha.getMonth() + 1) < 10 ? ("0" + (fecha.getMonth() + 1)) : (fecha.getMonth() + 1)) + "-"
        + (fecha.getDate() < 10 ? ("0" + fecha.getDate()) : fecha.getDate());

    if (date.includes("T")) {
        fechaFormat += " " + (fecha.getHours() < 10 ? "0" + fecha.getHours() : fecha.getHours())
            + ":" + (fecha.getMinutes() < 10 ? "0" + fecha.getMinutes() : fecha.getMinutes())
            + ":" + (fecha.getSeconds() < 10 ? "0" + fecha.getSeconds() : fecha.getSeconds());
    }

    return fechaFormat;
}

function fechaMayorIgual(fecha1, fecha2 = new Date()) {
    return (new Date(fecha1) >= new Date(fecha2));
}

function successAgendamiento(eventos, tipo, titulo, color, contenido) {
    resetFormAgendamiento();

    mensaje(tipo, titulo, color, contenido);
    setCalendario(document.getElementById('calendar'), eventos);
}

function deshabilitarInputsAgendamiento () {
    $("#agendarEvento input").attr("readonly", "");
    $("#agendarEvento #usuario, #tipoEvento").attr("disabled", "");
    $("#agendarEvento .button-calendario").hide();
}

function obtenerDisponibles(metodo, rol, tipo, fecha_inicio, fecha_fin,) {
    $.ajax({
        url: "../../app/controllers/carterasController.php",
        type: "POST",
        data: {
            metodo: metodo,
            rol: rol,
            tipo: tipo,
            fecha_inicio: fecha_inicio,
            fecha_fin: fecha_fin,
        },
    }).done(function (data) {
        selectUsuarios(JSON.parse(data));
    });
}

function fechaReprogramados() {
    let horaFinal = "";
    let fecha1 = "";
    let fecha2 = "";

    if ($("#inicio_evento").val().includes(" "))
        horaFinal = $("#inicio_evento").val().split(" ")[1];
    else
        horaFinal = $('#h_inicio').val();

    horaFinal = horaFinal.split(":");
    let minutos = (parseInt(horaFinal[1]) + 5);

    if (minutos >= 60) {
        horaFinal[0] = parseInt(horaFinal[0]) + 1;

        if (horaFinal[0] >= 23) {
            horaFinal[0] = "23";

            if (minutos >= 60)
                minutos = 59;
        }
        else
            minutos -= 60;
    }

    horaFinal = (parseInt(horaFinal[0]) < 10 ? "0" : "") + parseInt(horaFinal[0]) + (minutos < 10 ? ":0" : ":") + minutos;

    if ($("#inicio_evento").val().includes(" ")) {
        fecha1 = ($("#inicio_evento").val());
        fecha2 = ($("#inicio_evento").val().split(" ")[0] + " " + horaFinal + ":00");

        $("#fin_evento").val(fecha2);
    }
    else {
        fecha1 = ($("#inicio_evento").val() + " " + $("#h_inicio").val() + ":00");
        fecha2 = ($("#inicio_evento").val() + " " + horaFinal + ":00");

        $("#h_fin").val(horaFinal);
        $("#fin_evento").val($('#inicio_evento').val());
    }

    obtenerDisponibles("disponibilidadAgenda", "Asesor", "Jornada", fecha1, fecha2);
}

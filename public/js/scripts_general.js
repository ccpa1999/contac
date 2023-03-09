/*
Estructura base para mensajes con Jquery Confirm
*/
function mensaje(tema, titulo, color, mensaje) {
    $.alert({
        icon: 'fa fa-commenting-o fa-2x',
        title: titulo,
        type: color,
        theme: tema,
        animation: 'rotateYR',
        content: mensaje,
        backgroundDismiss: true,
        buttons: {
            aceptar: {
                text: 'Aceptar',
                keys: ['enter', 'shift'],
            }
        }
    });
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

(function () {
    "use strict";
    // custom scrollbar

    $("html").niceScroll({
        styler: "fb",
        cursorcolor: "#27cce4",
        cursorwidth: '5',
        cursorborderradius: '10px',
        background: '#424f63',
        spacebarenabled: false,
        cursorborder: '0',
        zindex: '1000'
    });
    $(".left-side").niceScroll({
        styler: "fb",
        cursorcolor: "#27cce4",
        cursorwidth: '3',
        cursorborderradius: '10px',
        background: '#424f63',
        spacebarenabled: false,
        cursorborder: '0'
    });
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
                    jQuery('.main-content').css({
                        height: ''
                    });
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
                jQuery('.custom-nav li.active ul').css({
                    display: 'block'
                });
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

            jQuery('body').css({
                left: '',
                marginRight: ''
            });
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
<style>
    .mensaje {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        padding: 1%;
        text-align: center;
        color: green;
    }


    .wrap {
        width: 95%;
        max-width: 100%;
        margin: 30px auto;
    }

    .titulo {
        color: white;
        width: 100%;
        text-align: center;
        background: #363636;
        margin-bottom: 0em;
        padding: 2%;
    }

    ul.tabs {
        width: 100%;
        background: #363636;
        list-style: none;
        display: flex;
    }

    ul.tabs li {
        width: 18%;
    }

    ul.tabs li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
        display: block;
        padding: 20px 0px;
    }

    .active {
        background: #0984CC;
    }

    ul.tabs li a .tab-text {
        margin-left: 8px;
    }

    .secciones {
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
    }

    .secciones article {
        padding: 30px;
    }

    .secciones article p {
        text-align: justify;
    }

    @media screen and (max-width: 800px) {
        ul.tabs li {
            width: none;
            flex-basis: 0;
            flex-grow: 1;
        }
    }

    @media screen and (max-width: 600px) {
        ul.tabs li a {
            padding: 15px 0px;
        }

        ul.tabs li a .tab-text {
            display: none;
        }

        .secciones article {
            padding: 20px;
        }
    }
</style>
<div class="wrap">
    <h1 class="titulo"><b> Solicitud BCS </b></h1>
    <ul class="tabs">
        <li><a href="#tab1"><span class="fa fa-user-circle"></span><span class="tab-text">Clientes</span></a></li>
        <li><a href="#tab2"><span class="fa fa-newspaper-o"></span><span class="tab-text">Solicitud</span></a></li>
        <li><a href="#tab3"><span class="fa fa-group"></span><span class="tab-text">Referencias</span></a></li>
        <li><a href="#tab4"><span class="fa fa-user-o"></span><span class="tab-text">Conyugue</span></a></li>
        <li><a href="#tab5"><span class="fa fa-map-marker "></span><span class="tab-text">Ubicación</span></a></li>
        <li><a href="#tab6"><span class="fa fa-briefcase"></span><span class="tab-text">Actividad Economica</span></a></li>
        <li><a href="#tab9"><span class="fa fa-braille"></span><span class="tab-text">Balance</span></a></li>
    </ul>
    <div class="secciones">
        <article id="tab1">
            <h1><small>Información del Solicitante</small></h1>
            <hr>
            <form id="formularioInformacionCliente" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de documento</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_documento_cliente" id="tipo_documento_cliente" class="form-control inputEnter">
                                <option value="cc">C.C</option>
                                <option value="ce">C.E</option>
                                <option value="ti">T.I</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>No. identificación</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-cc"></i>
                            </div>
                            <input type="number" required name="num_documento_cliente" id="num_documento_cliente" placeholder="Número identificación" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Fecha Expedición</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" required name="fecha_expedicion" id="fecha_expedicion" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ciudad Expedición</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="lugar_expedicion" id="lugar_expedicion" placeholder="Lugar de expedición de su documento" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Primer Nombre</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="primer_nombre_cliente" id="primer_nombre_cliente" placeholder="Primer Nombre" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Segundo Nombre</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" name="segundo_nombre_cliente" id="segundo_nombre_cliente" placeholder="Segundo Nombre" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Primer Apellido</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="primer_apellido_cliente" id="primer_apellido_cliente" placeholder="Primer apellido" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Segundo Apellido</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="segundo_apellido_cliente" id="segundo_apellido_cliente" placeholder="Segundo Apellido" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Fecha de Nacimiento</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" required name="fecha_nacimiento_cliente" id="fecha_nacimiento_cliente" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ciudad de Nacimiento</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="lugar_nacimiento_cliente" placeholder="Ciudad de nacimiento" id="lugar_nacimiento_cliente" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Genero</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-intersex"></i>
                            </div>
                            <select type="text" required name="genero_cliente" id="genero_cliente" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Estado Civil</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-heart"></i>
                            </div>
                            <select type="text" required name="estado_civil_cliente" id="estado_civil_cliente" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Casado">Casado</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Divorsiado">Divorsiado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Union libre">Unión libre</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Personas a Cargo</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="number" required name="personas_a_cargo" id="personas_a_cargo" placeholder="Cantidad de personas que tiene a cargo" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Familiar en el Banco</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="familiar_en_banco" id="familiar_en_banco" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="No">No</option>
                                <option value="N/A">N/A</option>
                                <option value="Esposa">Esposa</option>
                                <option value="Hijo(a)">Hijo(a)</option>
                                <option value="Mamá">Mamá</option>
                                <option value="Papá">Papá</option>
                                <option value="Hermano(a)">Hermano(a)</option>
                                <option value="suegro(a)">suegro(a)</option>
                                <option value="Cuñado(a)">Cuñado(a)</option>
                                <option value="Tio(a)">Tio(a)</option>
                                <option value="Primo(a)">Primo(a)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Parentesco titular</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-id-badge"></i>
                            </div>
                            <select name="parentesco_cliente" id="parentesco_cliente" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="No">No</option>
                                <option value="N/A">N/A</option>
                                <option value="Esposa">Esposa</option>
                                <option value="Hijo(a)">Hijo(a)</option>
                                <option value="Mamá">Mamá</option>
                                <option value="Papá">Papá</option>
                                <option value="Hermano(a)">Hermano(a)</option>
                                <option value="suegro(a)">suegro(a)</option>
                                <option value="Cuñado(a)">Cuñado(a)</option>
                                <option value="Tio(a)">Tio(a)</option>
                                <option value="Primo(a)">Primo(a)</option>s
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nivel Educativo</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="nivel_educativo" id="nivel_educativo" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Básico">Básico</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Tecnólogo">Tecnólogo</option>
                                <option value="Universitario">Universitario</option>
                                <option value="Especialización">Especialización</option>
                                <option value="Maestría">Maestría</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de Solicitante</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="clase_cliente" id="clase_cliente" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="solicitante">Solicitante</option>
                                <option value="deudor solidario">Deudor solidario</option>
                                <option value="avalista">Avalista</option>
                                <option value="socio">Socio</option>
                                <option value="amparado">Amparado</option>
                                <option value="autorizado">Autorizado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="informacionCliente">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioInformacionCliente">
                            GUARDAR INFORMACION DEL CLIENTE
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab2">
            <h1><small>Solicitud</small></h1>
            <hr>
            <form id="formularioDetalleSolicitud" class="form-inline" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Canal radicador</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <select name="canal_radicador" id="canal_radicador" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <?php foreach ($resultado['ciudades'] as $canal) : ?>
                                    <option value="<?= $canal['nombre_oficina_canal'] ?>"><?= $canal['nombre_oficina_canal'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Oficina</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <select name="oficina" id="oficina" class="form-control inputEnter">
                            <option value="">SELECCIONE</option>
                                <?php foreach ($resultado['ciudades'] as $canal) : ?>
                                    <option value="<?= $canal['nombre_oficina_canal'] ?>"><?= $canal['nombre_oficina_canal'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Número obligación</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="number" required name="numero_obligacion" id="numero_obligacion" placeholder="Número obligación" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de pagare soporte</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_pagare" id="tipo_pagare" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Físico">Físico</option>
                                <option value="Desmaterializado">Desmaterializado</option>
                                <option value="No requiere pagare">No requiere pagare</option>
                                <option value="Grabación">Grabación</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Garantías actuales</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="garantias_actuales" id="garantias_actuales" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Firma personal">Firma Personal</option>
                                <option value="Hipotecaria">Hipotecaria</option>
                                <option value="Fondo nacional garantias">Fondo Nacional Garantias</option>
                                <option value="USAID">USAID</option>
                                <option value="Solidario">Solidario</option>
                                <option value="Avalista">Avalista</option>
                                <option value="Prenda sin tenencia">Prenda sin tenencia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Saldo "valor solicitado"</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" required name="valor_solicitado" id="valor_solicitado" placeholder="Valor solicitado" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de Solicitud</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_solicitud" id="tipo_solicitud" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Modificación">Modificación</option>
                                <option value="Reestructuracion">Reestructuración</option>
                                <option value="Redefinicion ce 022">Redefinición CE 022</option>
                                <option value="Preaprobado PAD">Preaprobado PAD</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Subtipo de Solicitud</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="subtipo_solicitud" id="subtipo_solicitud" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="individual">Individual</option>
                                <option value="consolidada">Consolidada</option>
                                <option value="Crédito Emergencia Tasa Cero">Crédito Emergencia Tasa Cero</option>
                                <option value="Migración UVR Pesos">Migración UVR Pesos</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Estrategia</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="estrategia" id="estrategia" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="CE 022_Grupo 2">CE 022_Grupo 2</option>
                                <option value="CE 022_Grupo 3">CE 022_Grupo 3</option>
                                <option value="Ley 546">Ley 546</option>
                                <option value="CE 026 Reestructurado">CE 026 Reestructurado</option>
                                <option value="CE 026 Modificado">CE 026 Modificado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Modalidad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="modalidad" id="modalidad" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Consumo">Consumo</option>
                                <option value="Microcrédito">Microcrédito</option>
                                <option value="Hipotecario">Hipotecario</option>
                                <option value="Targeta de Crédito - Rotativo">Targeta de Crédito - Rotativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de cartera</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_cartera" id="tipo_cartera" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Propia">Propia</option>
                                <option value="Titularizada">Titularizada</option>
                                <option value="Crédito Emergencia Tasa Cero">Vehigrupo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Plazo actual</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="number" required name="plazo_actual" id="plazo_actual" placeholder="Plazo actual" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nuevo plazo</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="number" required name="nuevo_plazo" id="nuevo_plazo" placeholder="Nuevo plazos" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Periodo de gracia</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="periodo_gracia" id="periodo_gracia" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Capital">Capital</option>
                                <option value="Capital e Intereses">Capital e Intereses</option>
                                <option value="Ninguno">Ninguno</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Número de meses</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="number" required name="numero_meses" id="numero_meses" placeholder="Número de meses" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Valor cuota sugerida por el Cliente </strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="valor_sugerido" id="valor_sugerido" placeholder="valor sugerido por cliente" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nueva fecha de pago</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="nueva_fecha" id="nueva_fecha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>¿Mantiene el mismo sistema de amortización?</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="mismo_sistema" id="mismo_sistema" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cual es el nuevo sistema de amortización </strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil-square"></i>
                            </div>
                            <input type="text" name="nuevo_sistema" id="nuevo_sistema" placeholder="Nuevo sistema de amortización" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nueva tasa </strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <input type="text" name="nueva_tasa" id="nueva_tasa" placeholder="Nueva tasa" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>¿Realiza abono?</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="abona" id="abona" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Valor del abono</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="valor_abono" id="valor_abono" placeholder="Valor del abono" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>¿Se realiza condonación?</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="condonacion" id="condonacion" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Justificación</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil-square"></i>
                            </div>
                            <textarea rows="1" type="text" required name="justificacion_condonacion" id="justificacion_condonacion" placeholder="Justificación" class="form-control inputEnter"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>¿Es crédito emergencia tasa cero?</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="credito_emergencia" id="credito_emergencia" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Monto</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="monto" id="monto" placeholder="Monto" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Plazo</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <input type="text" name="plazo" id="plazo" placeholder="Plazo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Fecha de pago</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Justificación Solución</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil-square"></i>
                            </div>
                            <textarea rows="1" type="text" required name="justificacion_solucion" id="justificacion_solucion" placeholder="Justificación" class="form-control inputEnter"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Solicitud con grabación de llamada </strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select name="grabacion" id="grabacion" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="solicitud">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioDetalleSolicitud">
                            GUARDAR INFORMACION DE SOLICITUD
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab3">
            <h1><small>Referencias</small></h1>
            <hr>
            <form id="formularioReferencias" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nombres completos familiar</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="nombre_familiar" id="nombre_familiar" placeholder="Nombres y apellidos referencia familiar" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Telefono familiar</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" maxlength="8" required name="telefono_familiar" id="telefono_familiar" placeholder="Telefono referencia familiar" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Celular familiar</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" maxlength="10" required name="celular_familiar" id="celular_familiar" placeholder="Celular referencia familiar" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ciudad familiar</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="ciudad_familiar" id="ciudad_familiar" placeholder="Ciudad referencia familiar" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nombres completos referencia 2</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="nombre_referencia" id="nombre_referencia" placeholder="Nombres y apellidos referencia 2" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Telefono referencia 2</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required maxlength="8" name="telefono_referencia" id="telefono_referencia" placeholder="Telefono referencia 2" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Celular referencia 2</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input maxlength="10" type="text" required name="celular_referencia" id="celular_referencia" placeholder="Celular referencia 2" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ciudad referencia 2</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="ciudad_referencia" id="ciudad_referencia" placeholder="Ciudad referencia 2" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="referencias">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioReferencias">
                            GUARDAR REFERENCIAS
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab4">
            <h1><small>Conyugue</small></h1>
            <hr>
            <form id="formularioConyugue" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nombres</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="nombre" id="nombre" placeholder="Nombres" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Apellidos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="apellidos" id="apellidos" placeholder="Apellidos" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de documento</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-cc"></i>
                            </div>
                            <select type="text" required name="tipo_documento" id="tipo_documento" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="C.C">C.C</option>
                                <option value="C.E">C.E</option>
                                <option value="T.I">T.I</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Número de documento</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input maxlength="10" type="text" required name="numero_identificacion" id="numero_identificacion" placeholder="Número de documento" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Telefono</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required maxlength="8" name="telefono" id="telefono" placeholder="Telefono conyugue" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Actividad economica</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="actividad_economica" id="actividad_economica" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Asalariado">Asalariado</option>
                                <option value="Independiente">Independiente</option>
                                <option value="Pensionado">Pensionado</option>
                                <option value="Rentista">Rentista</option>
                                <option value="Sin ocupación">Sin ocupación</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>¿Tiene Productos en Banco Caja Social?</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="productos_activos" id="productos_activos" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>¿Su cónyuge comparte su actividad comercial?</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="actividad_comercial" id="actividad_comercial" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="conyugue">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioConyugue">
                            GUARDAR INFORMACIÓN DE CONYUGUE
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab5">
            <h1><small>Ubicación</small></h1>
            <hr>
            <form id="formularioUbicacion" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Dirección</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="direccion" id="direccion" placeholder="Direccion" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de vivienda</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_vivienda" id="tipo_vivienda" class="form-control inputEnter">
                                <option value="SELECCIONE">SELECCIONE</option>
                                <option value="Propia con hipoteca">Propia con hipoteca</option>
                                <option value="Propia sin hipoteca">Propia sin hipoteca</option>
                                <option value="Familiar">Familiar</option>
                                <option value="Arrendada">Arrendada</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Barrio</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="barrio" id="barrio" placeholder="Barrio" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ciudad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="ciudad" id="ciudad" placeholder="Ciudad" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Celular</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required maxlength="10" name="celular" id="celular" placeholder="Celular" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Telefono</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" maxlength="8" required name="telefono" id="telefono" placeholder="Telefono" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Correo</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="correo" id="correo" placeholder="Correo" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="ubicacion">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioUbicacion">
                            GUARDAR INFORMACIÓN DE UBICACIÓN
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab6">
            <h1><small>Ocupación principal</small></h1>
            <hr>
            <form id="formularioOcupacion" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ocupación</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="ocupacion" id="ocupacion" class="form-control inputEnter">
                                <option value="SELECCIONE">SELECCIONE</option>
                                <option value="Ama De Casa">Ama De Casa</option>
                                <option value="Empleado Sector Privado">Empleado Sector Privado</option>
                                <option value="Empleado Sector Público">Empleado Sector Público</option>
                                <option value="Estudiante">Estudiante</option>
                                <option value="Microempresario">Microempresario</option>
                                <option value="Otros Independientes">Otros Independientes</option>
                                <option value="Pensionado / Jubilado">Pensionado / Jubilado</option>
                                <option value="Profesional">Profesional</option>
                                <option value="Rentista">Rentista</option>
                                <option value="Técnico Independiente">Técnico Independiente</option>
                                <option value="Sin Ocupación">Sin Ocupación</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Sector</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="sector" id="sector" class="form-control inputEnter">
                                <option value="SELECCIONE">SELECCIONE</option>
                                <option value="Público">Público</option>
                                <option value="Privado">Privado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Subsector</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="subsector" id="subsector" class="form-control inputEnter">
                                <option value="SELECCIONE">SELECCIONE</option>
                                <option value="Agroindustria">Agroindustria</option>
                                <option value="Comercio">Comercio</option>
                                <option value="Industria">Industria</option>
                                <option value="Servicios">Servicios</option>
                                <option value="Servicios (Sin Establecimiento O Empleados)">Servicios (Sin Establecimiento O Empleados)</option>
                                <option value="Transportador">Transportador</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Profesión especifica</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-bolt"></i>
                            </div>
                            <select type="text" required name="profesion_especifica" id="profesion_especifica" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="01  Agronomía, Veterinaria y Afines">01 Agronomía, Veterinaria y Afines</option>
                                <option value="02  Bellas Artes">02 Bellas Artes</option>
                                <option value="03  Ciencias Educación">03 Ciencias Educación</option>
                                <option value="04  Ciencias Salud">04 Ciencias Salud</option>
                                <option value="05  Ciencias Sociales, Periodismo, Derecho o Ciencias Políticas">05 Ciencias Sociales, Periodismo, Derecho o Ciencias Políticas</option>
                                <option value="06  Economía, Administración y Ciencias Afines">06 Economía, Administración y Ciencias Afines</option>
                                <option value="07  Humanidades y Ciencias Religiosas">07 Humanidades y Ciencias Religiosas</option>
                                <option value="08  Ingeniería, Arquitectura, Urbanismo, Ciencias Afines">08 Ingeniería, Arquitectura, Urbanismo, Ciencias Afines</option>
                                <option value="09  Matemáticas, Ciencias Naturales y Afines">09 Matemáticas, Ciencias Naturales y Afines</option>
                                <option value="10  Comerciantes, Comisionistas y Afines">10 Comerciantes, Comisionistas y Afines</option>
                                <option value="11  Deportistas y Afines">11 Deportistas y Afines</option>
                                <option value="12  Pilotos, Auxiliares de Vuelo y Afines">12 Pilotos, Auxiliares de Vuelo y Afines</option>
                                <option value="13  Oficinistas, Operarios, No Profesionales">13 Oficinistas, Operarios, No Profesionales</option>
                                <option value="14  Militares">14 Militares</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Actividad general</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <select type="text" required name="actividad_general" id="actividad_general" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="AGENCIAS DE VIAJES">AGENCIAS DE VIAJES</option>
                                <option value="ALMACÉN DE ELECTRODOMÉSTICOS">ALMACÉN DE ELECTRODOMÉSTICOS</option>
                                <option value="ALMACÉN DE ROPA, CALZADO Y ARTÍCULOS DE CUERO">ALMACÉN DE ROPA, CALZADO Y ARTÍCULOS DE CUERO</option>
                                <option value="ARTESANÍAS">ARTESANÍAS</option>
                                <option value="AGRICULTURA, CAZA Y ACTIVIDADES RELACIONADAS">AGRICULTURA, CAZA Y ACTIVIDADES RELACIONADAS</option>
                                <option value="ALQUILER DE MAQUINARIA Y EQUIPO">ALQUILER DE MAQUINARIA Y EQUIPO</option>
                                <option value="CACHARRERÍA,MISCELANEA,PAPELERÍA,FOTOCOPIA,VTA X KTALOGO,COS">CACHARRERÍA,MISCELANEA,PAPELERÍA,FOTOCOPIA,VTA X KTALOGO,COS</option>
                                <option value="EXTRACCIÓN DE MINERALES">EXTRACCIÓN DE MINERALES</option>
                                <option value="CAMPO DE TEJO, BILLARES, TABERNA">CAMPO DE TEJO, BILLARES, TABERNA</option>
                                <option value="CENTRO ODONTOLÓGICO, CENTRO MEDICO, ÓPTICA, VETERINARIA">CENTRO ODONTOLÓGICO, CENTRO MEDICO, ÓPTICA, VETERINARIA</option>
                                <option value="FABRICA DE MUEBLES Y COLCHONES">FABRICA DE MUEBLES Y COLCHONES</option>
                                <option value="CONFECCIONES (INCLUYENDO SATÉLITE)">CONFECCIONES (INCLUYENDO SATÉLITE)</option>
                                <option value="CONFITERÍA (VENTAS AL POR MAYOR Y AL DETAL DE DULCES)">CONFITERÍA (VENTAS AL POR MAYOR Y AL DETAL DE DULCES)</option>
                                <option value="CURTIEMBRES">CURTIEMBRES</option>
                                <option value="DEPÓSITO DE CERVEZA">DEPÓSITO DE CERVEZA</option>
                                <option value="DROGUERÍAS">DROGUERÍAS</option>
                                <option value="EBANISTERÍA">EBANISTERÍA</option>
                                <option value="ELABORACIÓN DE PRODUCTOS ALIMENTICIOS">ELABORACIÓN DE PRODUCTOS ALIMENTICIOS</option>
                                <option value="ELABORACIÓN DE TEJIDOS">ELABORACIÓN DE TEJIDOS</option>
                                <option value="FOTOGRAFÍA">FOTOGRAFÍA</option>
                                <option value="HOTELERÍA">HOTELERÍA</option>
                                <option value="MENSAJERÍA">MENSAJERÍA</option>
                                <option value="PROFESIONALES INDEPENDIENTES">PROFESIONALES INDEPENDIENTES</option>
                                <option value="FABRICACIÓN DE CALZADO">FABRICACIÓN DE CALZADO</option>
                                <option value="FTERÍA Y DSITO MATERIALES, VIDRIERÍA, VENTA DE CHATARRA">FTERÍA Y DSITO MATERIALES, VIDRIERÍA, VENTA DE CHATARRA</option>
                                <option value="JARDÍN INFANTIL, COLEGIO, ESCUELAS VARIAS">JARDÍN INFANTIL, COLEGIO, ESCUELAS VARIAS</option>
                                <option value="JOYERÍA – TALLER">JOYERÍA – TALLER</option>
                                <option value="LAVANDERÍAS">LAVANDERÍAS</option>
                                <option value="MARQUETERÍA">MARQUETERÍA</option>
                                <option value="MARROQUINERÍA">MARROQUINERÍA</option>
                                <option value="SERVICIOS DE VIGILANCIA">SERVICIOS DE VIGILANCIA</option>
                                <option value="METALMECÁNICA Y ORNAMENTACIÓN">METALMECÁNICA Y ORNAMENTACIÓN</option>
                                <option value="PANADERÍA Y PASTELERÍA">PANADERÍA Y PASTELERÍA</option>
                                <option value="PAÑALERA, VTA DE ARTÍCULO VARIO PARA EL HOGAR, JTERÍA">PAÑALERA, VTA DE ARTÍCULO VARIO PARA EL HOGAR, JTERÍA</option>
                                <option value="PIQUETEADERO, COMIDAS RÁPIDAS, CASA DE BANQUETES">PIQUETEADERO, COMIDAS RÁPIDAS, CASA DE BANQUETES</option>
                                <option value="PISCICULTURA Y ACTIVIDADES RELACIONADAS">PISCICULTURA Y ACTIVIDADES RELACIONADAS</option>
                                <option value="PRODUCTORES DE PLÁSTICO">PRODUCTORES DE PLÁSTICO</option>
                                <option value="RECICLADORES">RECICLADORES</option>
                                <option value="REPARACIÓN DE ELECTRODOMÉSTICOS">REPARACIÓN DE ELECTRODOMÉSTICOS</option>
                                <option value="REPARACIÓN O MANTENIMIENTO DE COMPUTADORES">REPARACIÓN O MANTENIMIENTO DE COMPUTADORES</option>
                                <option value="REPARACIONES ELÉCTRICAS O ELECTRÓNICAS">REPARACIONES ELÉCTRICAS O ELECTRÓNICAS</option>
                                <option value="RESTAURANTES Y CAFETERÍAS, VENTA DE AROMÁTICA Y OTROS">RESTAURANTES Y CAFETERÍAS, VENTA DE AROMÁTICA Y OTROS</option>
                                <option value="SALÓN DE BELLEZA, PELUQUERÍA">SALÓN DE BELLEZA, PELUQUERÍA</option>
                                <option value="SERVICIO DE TELEFONÍA, CAFÉ INTERNET">SERVICIO DE TELEFONÍA, CAFÉ INTERNET</option>
                                <option value="TAPICERÍA Y ACCESORIOS PARA AUTOMÓVILES">TAPICERÍA Y ACCESORIOS PARA AUTOMÓVILES</option>
                                <option value="TIPOGRAFÍA Y LITOGRAFÍA">TIPOGRAFÍA Y LITOGRAFÍA</option>
                                <option value="TALLER DE MECÁNICA,LATONERÍA">TALLER DE MECÁNICA,LATONERÍA</option>
                                <option value="TIENDADEBCIGARRERÍASMERCADOCCIOCARNESHUEVOSFTASVDURASFLORES">TIENDADEBCIGARRERÍASMERCADOCCIOCARNESHUEVOSFTASVDURASFLORES</option>
                                <option value="TIENDA DE VÍDEO - ALQUILER">TIENDA DE VÍDEO - ALQUILER</option>
                                <option value="TRANSPORTE DE CARGA INTERMUNICIPAL">TRANSPORTE DE CARGA INTERMUNICIPAL</option>
                                <option value="TRANSPORTE DE CARGA URBANO">TRANSPORTE DE CARGA URBANO</option>
                                <option value="TRANSPORTE INFORMAL (ACARREOS), PARQUEADERO">TRANSPORTE INFORMAL (ACARREOS), PARQUEADERO</option>
                                <option value="TRANSPORTE MASIVO URBANO Y TRANSPORTE ESCOLAR">TRANSPORTE MASIVO URBANO Y TRANSPORTE ESCOLAR</option>
                                <option value="TRANSPORTE AÉREO">TRANSPORTE AÉREO</option>
                                <option value="TRANSPORTE TAXI URBANO">TRANSPORTE TAXI URBANO</option>
                                <option value="TRANSPORTE INTERMUNICIPAL">TRANSPORTE INTERMUNICIPAL</option>
                                <option value="VENTA DE REPUESTOS O INSUMOS EN GENERAL">VENTA DE REPUESTOS O INSUMOS EN GENERAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Actividad especifica</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <select name="actividad_especifica" id="actividad_especifica" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <?php foreach ($resultado['actividad_especifica'] as $actividad) : ?>
                                    <option value="<?= $actividad['descripcion'] . '-' . $actividad['codigo'] ?>"><?= $actividad['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nombre de la empresa</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <input type="text" required name="nombre_empresa" id="nombre_empresa" placeholder="Nombre de la empresa" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Dirección de la empresa</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="direccion_empresa" id="direccion_empresa" placeholder="Barrio de la empresa" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Barrio</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="barrio_empresa" id="barrio_empresa" placeholder="Barrio de la empresa" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ciudad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <input type="text" required name="ciudad_empresa" id="ciudad_empresa" placeholder="Ciudad de la empresa" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Telefono 1</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <input type="text" required maxlength="8" name="telefono1" id="telefono1" placeholder="Telefono 1 de la empresa" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Telefono 2</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <input type="text" required maxlength="8" name="telefono2" id="telefono2" placeholder="Telefono 2 de la empresa" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Grado formalidad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="grado_formalidad" id="grado_formalidad" class="form-control inputEnter">
                                <option value="SELECCIONE">SELECCIONE</option>
                                <option value="Formal">Formal</option>
                                <option value="Informal">Informal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Administra recursos públicos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="recursos_publicos" id="recursos_publicos" class="form-control inputEnter">
                                <option value="SELECCIONE">SELECCIONE</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h1><small>Asalariado</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Clasificación laboral</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <select type="text" required name="cargo" id="cargo" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="0000  Fuerza Militares (Ejército, Armada, Fuerza Aérea)">0000 Fuerza Militares (Ejército, Armada, Fuerza Aérea)</option>
                                <option value="0110  Oficial Fuerza Militares (General, Coronel, Capta">0110 Oficial Fuerza Militares (General, Coronel, Capta</option>
                                <option value="0120  Suboficial Fuerza Militares (Cabos, Sargentos, Otros)">0120 Suboficial Fuerza Militares (Cabos, Sargentos, Otros)</option>
                                <option value="0130  Soldados Fuerza Militares (Infantes, Marinos, Otro)">0130 Soldados Fuerza Militares (Infantes, Marinos, Otro)</option>
                                <option value="1000  Miem Pder Ejec y Cuerp Leg Gob y Pnal Dir Em">1000 Miem Pder Ejec y Cuerp Leg Gob y Pnal Dir Em</option>
                                <option value="1110  Miemb Pder Ejec y Cuerp Legis y Pnal Dir Gob">1110 Miemb Pder Ejec y Cuerp Legis y Pnal Dir Gob</option>
                                <option value="1130  Jefes Comunidad Indígena, Etnia Especiales - A fin">1130 Jefes Comunidad Indígena, Etnia Especiales - A fin</option>
                                <option value="1140  Dirig y Admin Partid Polít, Sindicato y Org Esp">1140 Dirig y Admin Partid Polít, Sindicato y Org Esp</option>
                                <option value="1210  Presidentes/Directores y Gerentes Generales Empresa Grande">1210 Presidentes/Directores y Gerentes Generales Empresa Grande</option>
                                <option value="1310  Gerentes de Empresas Medianas y Pequeñas">1310 Gerentes de Empresas Medianas y Pequeñas</option>
                                <option value="2000  Profesionales Univers Científicos e Intelect">2000 Profesionales Univers Científicos e Intelect</option>
                                <option value="2422  Carg Admon de Justicia: Fiscal / Jueces / Magistrdos">2422 Carg Admon de Justicia: Fiscal / Jueces / Magistrdos</option>
                                <option value="2451  Periodista / Redactor / Reportero/Columista / Corresponsal">2451 Periodista / Redactor / Reportero/Columista / Corresponsal</option>
                                <option value="2460  Sacerdotes de Distintas Religiones">2460 Sacerdotes de Distintas Religiones</option>
                                <option value="3000  Técnic, Postsecundar no Universit y Asistent">3000 Técnic, Postsecundar no Universit y Asistent</option>
                                <option value="3470  Deportistas">3470 Deportistas</option>
                                <option value="4000  Empleados de Oficina">4000 Empleados de Oficina</option>
                                <option value="5000  Trabajadores de los Servicios y Vendedores">5000 Trabajadores de los Servicios y Vendedores</option>
                                <option value="6000  Agricultores y Trabajadores Agropecuario y Pesqueros">6000 Agricultores y Trabajadores Agropecuario y Pesqueros</option>
                                <option value="7000  Ofic, Obrer ,Oper , Arts_Trb Ind Mnuf ,Const, Min">7000 Ofic, Obrer ,Oper , Arts_Trb Ind Mnuf ,Const, Min</option>
                                <option value="8000  Operadores de Instalación y Mqinas y Ensamblad ">8000 Operadores de Instalación y Mqinas y Ensamblad </option>
                                <option value="9000  Trabajadores no Calificados">9000 Trabajadores no Calificados</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cargo especifico</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <input type="text" required name="cargo_especifico" id="cargo_especifico" placeholder="Especificación del cargo" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Antigüedad en la actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" required name="antiguedad" id="antiguedad" placeholder="Especificación del cargo" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de salario</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_salario" id="tipo_salario" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="integral">Integral</option>
                                <option value="no integral con prestaciones">No integral con prestaciones</option>
                                <option value="no integral sin prestaciones">No integral sin prestaciones</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de Contrato</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_contrato" id="tipo_contrato" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="indefinido">Indefinido</option>
                                <option value="fijo">Fijo</option>
                                <option value="temporal">Temporal</option>
                                <option value="prestacion de servicio">Prestación de servicios</option>
                                <option value="obra labor">Obra labor</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h1><small>Independiente</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Sitio Fijo</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="sitio_fijo" id="sitio_fijo" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tipo de Local</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select type="text" required name="tipo_local" id="tipo_local" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="vivienda-local">Vivienda-Local</option>
                                <option value="propio distinto de vivienda">Propio distinto de vivienda</option>
                                <option value="arrendado">Arrendado</option>
                                <option value="no requiere local">No requiere local</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Tiempo funcionamiento del local</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" required name="tiempo_local" id="tiempo_local" placeholder="tiempo en meses" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Seguridad Social</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select name="seguridad_social" id="seguridad_social" class="form-control">
                                <option value="">SELECCIONE</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Declaración de renta</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select name="declara_renta" id="declara_renta" class="form-control">
                                <option value="">SELECCIONE</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Empleados fijos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="text" name="empleados_fijos" id="empleados_fijos" placeholder="Cantidad empleados fijos" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Empleados temporal</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="text" name="empleados_temporales" id="empleados_temporales" placeholder="Cantidad empleados temporales" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="ocupacion">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioOcupacion">
                            GUARDAR INFORMACIÓN DE OCUPACIÓN
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab7">
            <h1><small>Ingresos y egresos</small></h1>
            <hr>
            <form id="formularioIngresosEgresos" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <h1><small>Ingresos titular</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Salario</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="salario_titular" placeholder="salario titular" id="salario_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ingresos mensuales</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ingresos_titular" placeholder="Ingresos mensuales titular" id="salario_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros ingresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="otros_ingresos_titular" placeholder="Otros ingresos titular" id="salario_deudor1" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ayudas economicas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ayudas_economicas_titular" placeholder="Ayudas economicas titular" id="ayudas_economicas_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Descripción otros ingresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="descripcion_ingresos" id="descripcion_ingresos" placeholder="Descripción otros ingresos" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Descripción ayudas economicas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="descripcion_ayudas" id="descripcion_ayudas" placeholder="Descripción ayudas economicas" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select name="actividad_titular" id="actividad_titular" class="form-control">
                                <option value="">SELECCIONE</option>
                                <option value="Asalariado">Asalariado</option>
                                <option value="Independiente">Independiente</option>
                                <option value="Pensionado">Pensionado</option>
                                <option value="Rentista">Rentista</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Antigueada en la actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="antiguedad_titular" id="antiguedad_titular" class="form-control">
                        </div>
                    </div>
                </div>
                <h1><small>Egresos titular</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Costo de operación y ventas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="costo_operacion_titular" placeholder="Costo de operación y venta titular" id="costo_operacion_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Empleados(mano de obra)</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="empleados_titular" placeholder="Empleados titular" id="empleados_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Arriendo local</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="arriendo_local_titular" placeholder="Arriendo del local titular" id="arriendo_local_titular" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuota prestamos del local o negocio</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_prestamo_titular" placeholder="Cuotas prestamos del local o negocio titular" id="cuotas_prestamo_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros gastos operativos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="otros_gastos_titular" id="otros_gastos_titular" placeholder="Otros gastos operativos titular" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Gastos familiares</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="gastos_familiares_titular" id="gastos_familiares_titular" placeholder="Gastos familiares titular" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Valor arriendo/Hipotecas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="valor_arriendo_hipotecas_titular" placeholder="Valor arriendo titular" id="valor_arriendo_hipotecas_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas TDC</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_TDC_titular" placeholder="Cuotas TDC titular" id="cuotas_TDC_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas creditos con otras entidades</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_otras_entidades_titular" placeholder="cuotas creditos titular" id="cuotas_otras_entidades_titular" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas creditos con la entidad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_con_entidad_titular" placeholder="Cuotas creditos bscs titular" id="cuotas_con_entidad_titular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros egresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="otros_egresos_titular" placeholder="Otros egresos titular" id="otros_egresos_titular" class="form-control">
                        </div>
                    </div>
                </div>
                <h1><small>Ingresos deudor 1</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Salario</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="salario_deudor1" placeholder="Salario deudor 1" id="salario_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ingresos mensuales</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ingresos_deudor1" placeholder="Ingresos mensuales deudor 1" id="ingresos_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros ingresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="otros_ingresos_deudor1" placeholder="Otros ingresos deudor 1" id="otros_ingresos_deudor1" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ayudas economicas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ayudas_economicas_deudor1" placeholder="Ayudas economicas deudor 1" id="ayudas_economicas_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Descripción otros ingresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <textarea name="descripcion_ingresos" placeholder="Descripción otros ingresos deudor 1" id="descripcion_ingresos" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Descripción ayudas economicas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <textarea name="descripcion_ayudas" placeholder="Descripción ayudas economicas deudor 1" id="descripcion_ayudas" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select name="actividad_deudor1" id="actividad_deudor1" class="form-control">
                                <option value="">SELECCIONE</option>
                                <option value="Asalariado">Asalariado</option>
                                <option value="Independiente">Independiente</option>
                                <option value="Pensionado">Pensionado</option>
                                <option value="Rentista">Rentista</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Antigueada en la actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="antiguedad_deudor1" placeholder="Antiguedad en la actividad deudor 1" id="antiguedad_deudor1" class="form-control">
                        </div>
                    </div>
                </div>
                <h1><small>Egresos Deudor 1</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Costo de operación y ventas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="costo_operacion_deudor1" placeholder="Costo operación y ventas deudor 1" id="costo_operacion_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Empleados(mano de obra)</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="empleados_deudor1" placeholder="Empleados deudor 1" id="empleados_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Arriendo local</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="arriendo_local_deudor1" placeholder="Arriendo local deudor 1" id="arriendo_local_deudor1" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuota prestamos del local o negocio</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_prestamo_deudor1" placeholder="Cuotas prestamos del local o negocio deudor 1" id="cuotas_prestamo_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros gastos operativos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="otros_gastos_deudor1" id="otros_gastos_deudor1" placeholder="Otros gastos operativos deudor 1" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Gastos familiares</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="gastos_familiares_deudor1" placeholder="Gastos familiares deudor 1" id="gastos_familiares_deudor1" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Valor arriendo/Hipotecas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="valor_arriendo_hipotecas_deudor1" placeholder="Valor arriendo deudor 1" id="valor_arriendo_hipotecas_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas TDC</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_TDC_deudor1" placeholder="Cuotas TDC deudor 1" id="cuotas_TDC_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas creditos con otras entidades</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_otras_entidades_deudor1" placeholder="Cuotas creditos deudor 1" id="cuotas_otras_entidades_deudor1" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas creditos con la entidad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_con_entidad_deudor1" placeholder="Cuotas creditos bscs deudor 1" id="cuotas_con_entidad_deudor1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros egresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="otros_egresos_deudor1" placeholder="Otros egresos deudor 1" id="otros_egresos_deudor1" class="form-control">
                        </div>
                    </div>
                </div>
                <h1><small>Ingresos deudor 2</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Salario</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="salario_deudor2" placeholder="Salario deudor 2" id="salario_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ingresos mensuales</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ingresos_deudor2" placeholder="ingresos mensuales deudor 2" id="ingresos_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros ingresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="otros_ingresos_deudor2" placeholder="Otros ingresos deudor 2" id="otros_ingresos_deudor2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Ayudas economicas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="ayudas_economicas_deudor2" placeholder="Ayudas economicas deudor 2" id="ayudas_economicas_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Descripción otros ingresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <textarea name="descripcion_ingresos" placeholder="Descripcion otros ingresos deudor 2" id="descripcion_ingresos" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Descripción ayudas economicas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <textarea name="descripcion_ayudas" placeholder="Descripcion ayudas economicas deudor 2" id="descripcion_ayudas" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select name="actividad_deudor2" id="actividad_deudor2" class="form-control">
                            <option value="">SELECCIONE</option>
                                <option value="Asalariado">Asalariado</option>
                                <option value="Independiente">Independiente</option>
                                <option value="Pensionado">Pensionado</option>
                                <option value="Rentista">Rentista</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Antigueada en la actividad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="antiguedad_deudor2" placeholder="Antiguedad en la actividad deudor 2" id="antiguedad_deudor2" class="form-control">
                        </div>
                    </div>
                </div>
                <h1><small>Egresos Deudor 2</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Costo de operación y ventas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="costo_operacion_deudor2" placeholder="Costo de operación y ventas deudor 2" id="costo_operacion_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Empleados(mano de obra)</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="empleados_deudor2" placeholder="Empleados deudor 2" id="empleados_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Arriendo local</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="arriendo_local_deudor2" placeholder="Arriendo local deudor 2" id="arriendo_local_deudor2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuota prestamos del local o negocio</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_prestamo_deudor2" placeholder="Cuota prestamos del local o negocio deudor 2" id="cuotas_prestamo_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros gastos operativos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="otros_gastos_deudor2" placeholder="Otros gastos operativos deudor 2" id="otros_gastos_deudor2" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Gastos familiares</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <textarea name="gastos_familiares_deudor2" placeholder="Gastos familiares deudor 2" id="gastos_familiares_deudor2" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Valor arriendo/Hipotecas</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="valor_arriendo_hipotecas_deudor2" placeholder="valor arriendo deudor 2" id="valor_arriendo_hipotecas_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas TDC</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_TDC_deudor2" placeholder="Cuotas TDC deudor 2" id="cuotas_TDC_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas creditos con otras entidades</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_otras_entidades_deudor2" placeholder="Cuotas creditos deudor 2" id="cuotas_otras_entidades_deudor2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Cuotas creditos con la entidad</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="cuotas_con_entidad_deudor2" placeholder="Cuotas creditos bscs deudor 2" id="cuotas_con_entidad_deudor2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros egresos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" name="otros_egresos_deudor2" placeholder="Otros egresos deudor 2" id="otros_egresos_deudor2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="ingresosEgresos">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioIngresosEgresos">
                            GUARDAR INFORMACIÓN DE INGRESOS Y EGRESOS
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab8">
            <h1><small>Endeudamiento(s)</small></h1>
            <hr>
            <div class="text-center"> <b>¡Nota!</b> Puedes agregar varios endeudamientos</div><br>
            <form id="formularioEndeudamientos" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Entidad financiera</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <input type="text" required name="entidad" id="entidad" placeholder="Entidad financiera" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>N° Obligación (Interno)</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <input type="number" required name="num_obligacion" id="num_obligacion" placeholder="Número de obligación" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Valor de la Cuota</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" required name="valor_cuota" id="valor_cuota" placeholder="Valor de la cuota" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Saldo total</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" required name="saldo_total" id="saldo_total" placeholder="Saldo_total" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Estado</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select required name="estado" id="estado" placeholder="Estado" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Al día">Al día</option>
                                <option value="En mora">En mora</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Responsable del pago</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <select required name="responsable" id="responsable" placeholder="Estado" class="form-control inputEnter">
                                <option value="">SELECCIONE</option>
                                <option value="Solicitante">Solicitante</option>
                                <option value="Encargado">Encargado</option>
                                <option value="Otro">Otro</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Observaciones</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <input type="text" required name="observaciones" id="observaciones" placeholder="Observaciones" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="endeudamiento">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioEndeudamientos">
                            GUARDAR INFORMACIÓN DE ENDEUDAMIENTO(S)
                        </button>
                    </div>
                </div>
            </form>
        </article>
        <article id="tab9">
            <h1><small>Balance y responsable</small></h1>
            <hr>
            <h1><small>Balance</small></h1>
            <form id="formularioBalanceResponsables" class="form-inline formReestructuracion" method="POST" action="javascript:void(0);">
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Activos corrientes</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" required name="activos_corrientes" id="activos_corrientes" placeholder="Activos corrientes" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Activos fijos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" required name="activos_fijos" id="activos_fijos" placeholder="Activos fijos" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Otros activos</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input type="text" required name="otros_activos" id="otros_activos" placeholder="Otros activos" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Fecha</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" required name="fecha_balance" id="fecha_balance" placeholder="Fecha balance" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <h1><small>Responsable</small></h1>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nombre promotor</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="nombre_promotor" id="nombre_promotor" placeholder="Nombre promotor" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Número de identificación</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="number" required name="numero_identificacion" id="numero_identificacion" placeholder="Número identificación promotor" class="form-control inputEnter">
                        </div>
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Usuario</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" required name="usuario" id="usuario" placeholder="Usuario" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label for="exampleInputEmail1"><strong>Nombre de la agencia</strong></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-building"></i>
                            </div>
                            <input type="text" required name="nombre_agencia" id="nombre_agencia" placeholder="Nombre de la agencia" class="form-control inputEnter">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="form-group col-xs-8 col-xs-offset-2">
                        <input type="hidden" name="metodo" value="GuardarFormularioReestructuracion">
                        <input type="hidden" name="cartera" value="<?= $datos['cartera']; ?>">
                        <input type="hidden" name="parametro" value="balanceResponsables">
                        <button class="btn btn-primary submitFormReestructuracion" type="button" style="width: 100%; font-weight: bold" data-form="formularioBalanceResponsables">
                            GUARDAR BALANCE Y RESPONSABLE
                        </button>
                    </div>
                </div>
            </form>
        </article>
    </div>
</div>
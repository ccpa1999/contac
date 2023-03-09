<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 50%;
    }
    .allborder {
        border: black 0.5px solid;
    }

    .text-center {
        text-align: center;
    }
    .logo {
        text-align: center;
        border: 0.5px black solid;
        width: 5%;
    }

    .titulo {
        font-size: 70%;
        font-family: "Arial Black", Gadget, sans-serif;
        color: #2C448A;
        text-align: center;
        width: 85%;
    }

    table tr td{
        height: 10px;
    }

    .w_10 {
        width: 10%;
    }

    .w_90 {
        width: 90%;
    }

    .w_100 {
        width: 100%;
    }

    .title-blue {
        background-color: #527DFF;
        color: white;
    }

    .title-gray {
        background-color: #B1B1B1;
    }
    .back_blue{
        background-color: #D2ECF3;
    }
</style>

<body>
    <table style="margin-top: -3%;" class="allborder w_100">
        <tr>
            <td class="logo">
                <img src="../../public/images/bcs.png">
            </td>
            <td class="titulo">
                <b> SOLICITUD MODIFICACIÓN / REESTRUCTURACIÓN / REDEFINICIÓN DE CONDICIONES CE022 PERSONA NATURAL </b>
            </td>
        </tr>
    </table>
    <table class="w_100 allborder">
        <tr>
            <td class="w_10 allborder"></td>
            <td class="text-center allborder back_blue" colspan="5">oficina</td>
            <td rowspan="3" class="w_10 text-center allborder back_blue">Fecha</td>
            <td rowspan="3" colspan="2" class="w_10 allborder text-center"><?= $resultado['solicitante'][0]['fecha'] ?></td>
        </tr>
        <tr>
            <td class="allborder back_blue">Canal Radicador:</td>
            <td class="text-center allborder" colspan="5"><?= $resultado['solicitante'][0]['canal_radicador'] ?></td>
        </tr>
        <tr>
            <td class="allborder back_blue">Oficina Administradora:</td>
            <td class="text-center allborder" colspan="5"><?= $resultado['solicitante'][0]['oficina_administradora'] ?></td>
        </tr>
    </table>
    <div class="title-blue w_100 text-center allborder"><b>1.RADICACIÓN</b></div>
    <div class="title-gray allborder w_100"><b>SOLUCIÓN PLANTEADA</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td rowspan="2" class="w_10 allborder back_blue">Nº de obligación</td>
            <td rowspan="2" class="w_10 allborder back_blue">Tipo de pagare soporte </td>
            <td rowspan="2" class="w_10 allborder back_blue">Garantías Actuales</td>
            <td rowspan="2" class="w_10 allborder back_blue">Saldo "valor solicitado"</td>
            <td colspan="2" class="w_10 allborder back_blue">solicitud</td>
            <td rowspan="2" class="w_10 allborder back_blue">Estrategia</td>
            <td rowspan="2" class="w_10 allborder back_blue">Modalidad</td>
            <td rowspan="2" class="w_10 allborder back_blue">Tipo de Cartera</td>
        </tr>
        <tr>
            <td class="allborder w_10 back_blue">Tipo</td>
            <td class="allborder w_10 back_blue">Subtipo</td>
        </tr>
        <tr>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['numero_obligacion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['tipo_pagare_soporte'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['garantias_actuales'] ?></td>
            <td class="w_10 allborder">$<?= $resultado['solicitante'][0]['valor_solicitado'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['tipo_solicitud'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['subtipo_solicitud'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['estrategia'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['modalidad'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['tipo_cartera'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Nº de obligación</td>
            <td class="w_10 allborder back_blue">Plazo Actual</td>
            <td class="w_10 allborder back_blue">Nuevo plazo o Ampliación de Plazo (Meses)</td>
            <td class="w_10 allborder back_blue">Periodo de Gracia</td>
            <td class="w_10 allborder back_blue">No de meses</td>
            <td class="w_10 allborder back_blue">Plazo Total (meses)</td>
            <td class="w_10 allborder back_blue">Valor Cuota Sugerida por el Cliente</td>
            <td class="w_10 allborder back_blue">si cambia fecha de pago: Nueva fecha de Pago</td>
            <td class="w_10 allborder back_blue">¿Mantiene el mismo sistema de amortización? </td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['numero_obligacion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['plazo_actual'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['nuevo_plazo'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['periodo_gracia'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['num_meses'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['plazo_total'] ?></td>
            <td class="w_10 allborder">$<?= $resultado['solicitante'][0]['valor_cuota_sugerida'] ?></td>
            <td class="w_10 allborder"><?php $nueva_fecha_pago = explode('-',$resultado['solicitante'][0]['nueva_fecha_pago']); echo $nueva_fecha_pago[2] . '-' . $nueva_fecha_pago[1] . '-' . $nueva_fecha_pago[0];?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['mismo_sistema_amortizacion'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Nº de obligación</td>
            <td class="w_10 allborder back_blue">cual es el nuevo sistema de amortización </td>
            <td class="w_10 allborder back_blue">Nueva tasa </td>
            <td class="w_10 allborder back_blue">Realizo abono </td>
            <td class="w_10 allborder back_blue">valor del abono </td>
            <td class="w_10 allborder back_blue">Se realizo condonación</td>
            <td colspan="3" class="w_10 allborder back_blue">Justificación </td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['numero_obligacion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['nuevo_sistema_amortizacion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['nueva_tasa'] ?>%</td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['abono'] ?></td>
            <td class="w_10 allborder">$<?= $resultado['solicitante'][0]['valor_abono'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['condonacion'] ?></td>
            <td colspan="3" class="w_10 allborder"><?= $resultado['solicitante'][0]['justificacion'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="3" class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="3" class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="3" class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Es crédito emergencia tasa cero</td>
            <td class="w_10 allborder back_blue">Monto</td>
            <td class="w_10 allborder back_blue">plazo</td>
            <td class="w_10 allborder back_blue">Fecha de pago</td>
            <td colspan="4" class="w_10 allborder back_blue">Justificación de la solución planteada</td>
            <td class="w_10 allborder back_blue">Valor total a negociar </td>
        </tr>
        <tr>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['credito_tasa_emergencia'] ?></td>
            <td class="w_10 allborder">$<?= $resultado['solicitante'][0]['monto'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['plazo'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['fecha_pago'] ?></td>
            <td colspan="4" class="w_10 allborder"><?= $resultado['solicitante'][0]['justificacion_solucion'] ?></td>
            <td class="w_10 allborder title-gray">$<?= $resultado['solicitante'][0]['valor_total_negociar'] ?></td>
        </tr>
    </table>
    <div class="title-blue w_100 text-center allborder"><b>2. INFORMACIÓN BÁSICA DEL SOLICITANTE</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante </td>
            <td class="w_10 allborder back_blue">Tipo Documento</td>
            <td class="w_10 allborder back_blue">Número de Identificación</td>
            <td class="w_10 allborder back_blue">Primer Nombre</td>
            <td class="w_10 allborder back_blue">Segundo Nombre</td>
            <td class="w_10 allborder back_blue">Primer Apellido</td>
            <td class="w_10 allborder back_blue">Segundo Apellido</td>
            <td class="w_10 allborder back_blue">Parentesco con el titular </td>
            <td class="w_10 allborder back_blue">Si tiene familiar en BCS, ¿Cuál es el parentesco?</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['tipo_documento'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['numero_identificacion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['primer_nombre'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['segundo_nombre'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['primer_apellido'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['segundo_apellido'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['parentesco_titular'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['parentesco_familiar_bcs'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante </td>
            <td class="w_10 allborder back_blue">Ciudad Nacimiento</td>
            <td class="w_10 allborder back_blue">Fecha de Nacimiento</td>
            <td class="w_10 allborder back_blue">Ciudad Expe. Cédula</td>
            <td class="w_10 allborder back_blue">Fecha Expedición Cedula</td>
            <td class="w_10 allborder back_blue">Género</td>
            <td class="w_10 allborder back_blue">Estado Civil</td>
            <td class="w_10 allborder back_blue">Nº de Personas a Cargo </td>
            <td class="w_10 allborder back_blue">Nivel Educativo (Último Nivel Cursado)</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['ciudad_nacimiento'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['fecha_nacimiento'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['ciudad_expedicion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['fecha_expedicion'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['genero'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['estado_civil'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['personas_a_cargo'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['nivel_educativo'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 text-center allborder"><b>3. REFERENCIAS </b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder"></td>
            <td colspan="5" class="w_10 allborder back_blue">Nombres y Apellidos</td>
            <td class="w_10 allborder back_blue">Telefono Fijo (Si tiene)</td>
            <td class="w_10 allborder back_blue">Celular</td>
            <td class="w_10 allborder back_blue">Ciudad</td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">FAMILIAR (NO viva con usted)</td>
            <td colspan="5" class="w_10 allborder"><?= $resultado['solicitante'][0]['nombres_familiar'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['telefono_familiar'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['celular_familiar'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['ciudad_familiar'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Referencia 2</td>
            <td colspan="5" class="w_10 allborder"><?= $resultado['solicitante'][0]['nombres_referencia'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['telefono_referencia'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['celular_referencia'] ?></td>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['ciudad_referencia'] ?></td>
        </tr>
        <tr>
            <td class="w_10"></td>
            <td class="w_10"></td>
            <td class="w_10"></td>
            <td class="w_10"></td>
            <td class="w_10"></td>
        </tr>
    </table>
    <div class="title-blue w_100 text-center allborder"><b>4. DATOS DEL CÓNYUGE O COMPAÑERO (A) PERMANENTE</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante </td>
            <td class="w_10 allborder back_blue">Nombres</td>
            <td class="w_10 allborder back_blue">Apellidos</td>
            <td class="w_10 allborder back_blue">Tipo Documento</td>
            <td class="w_10 allborder back_blue">Número de Identificación</td>
            <td class="w_10 allborder back_blue">Teléfono (s)</td>
            <td class="w_10 allborder back_blue">Actividad economica</td>
            <td class="w_10 allborder back_blue">¿Tiene Productos Activos con el Banco Caja Social?</td>
            <td class="w_10 allborder back_blue">¿Su cónyuge comparte su actividad comercial?</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['nombres'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['apellidos'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['tipo_documento'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['numero_documento'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['telefono_conyugue'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['actividad_economica'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['productos_activos'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['actividad_comercial'] ?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 text-center allborder"><b>5. DATOS DE UBICACIÓN</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante </td>
            <td class="w_10 allborder back_blue">Dirección de Residencia</td>
            <td class="w_10 allborder back_blue">Tipo de Vivienda</td>
            <td class="w_10 allborder back_blue">Barrio</td>
            <td class="w_10 allborder back_blue">Ciudad</td>
            <td class="w_10 allborder back_blue">No celular </td>
            <td class="w_10 allborder back_blue">Teléfono 1</td>
            <td colspan="2" class="w_10 allborder back_blue">Correo Electrónico</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['direccion'] ?></td></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['tipo_vivienda'] ?></td></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['barrio'] ?></td></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['ciudad'] ?></td></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['celular'] ?></td></td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['telefono'] ?></td></td>
            <td colspan="2" class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['correo'] ?></td></td>

        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="2" class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="2" class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 text-center allborder"><b>6. OCUPACIÓN PRINCIPAL</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante</td>
            <td class="w_10 allborder back_blue">Ocupación</td>
            <td class="w_10 allborder back_blue">Sector</td>
            <td class="w_10 allborder back_blue">Subsector</td>
            <td class="w_10 allborder back_blue">Profesión Especifica</td>
            <td class="w_10 allborder back_blue">Actividad General</td>
            <td colspan="3" class="w_10 allborder back_blue">Actividad Especifica</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['ocupacion']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['sector']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['subsector']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['profesion_especifica']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['actividad_general']?></td>
            <td colspan="3" class="w_10 allborder"><?= $resultado['detalle_economico'][0]['actividad_especifica']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="3" class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td colspan="3" class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante </td>
            <td class="w_10 allborder back_blue">Nombre de la empresa o negocio</td>
            <td class="w_10 allborder back_blue">Dirección del Negocio o Empresa</td>
            <td class="w_10 allborder back_blue">Barrio</td>
            <td class="w_10 allborder back_blue">Ciudad</td>
            <td class="w_10 allborder back_blue">Teléfono 1</td>
            <td class="w_10 allborder back_blue">Teléfono 2</td>
            <td class="w_10 allborder back_blue">Grado de Formalidad</td>
            <td class="w_10 allborder back_blue">Administra recursos públicos</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['nombre_empresa']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['direccion_empresa']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['barrio']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['ciudad']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['telefono1']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['telefono2']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['grado_formalidad']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['recursos_publicos']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder"><b>6.1. Información Específica Asalariado</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante </td>
            <td colspan="2" class="w_10 allborder back_blue">Clasificación Laboral</td>
            <td colspan="2" class="w_10 allborder back_blue">Cargo Específico</td>
            <td class="w_10 allborder back_blue">Antigüedad en la actividad</td>
            <td class="w_10 allborder back_blue">Tipo de Salario</td>
            <td class="w_10 allborder back_blue">Tipo de contrato</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td colspan="2" class="w_10 allborder"><?= $resultado['detalle_economico'][0]['clasificacion_laboral']?></td>
            <td colspan="2" class="w_10 allborder"><?= $resultado['detalle_economico'][0]['cargo_especifico']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['antiguedad_actividad']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['tipo_salario']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['tipo_contrato']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td colspan="2" class="w_10 allborder"></td>
            <td colspan="2" class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td colspan="2" class="w_10 allborder"></td>
            <td colspan="2" class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder"><b>6.2. Información Específica Independiente</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante</td>
            <td class="w_10 allborder back_blue">Desarrolla su Actividad en Sitio Fijo </td>
            <td class="w_10 allborder back_blue">Tipo de local</td>
            <td class="w_10 allborder back_blue">Tiempo funcionamiento local (meses)</td>
            <td class="w_10 allborder back_blue">Seguridad Social</td>
            <td class="w_10 allborder back_blue">Declara Renta</td>
            <td class="w_10 allborder back_blue">No. de empleados temporal</td>
            <td class="w_10 allborder back_blue">No. de empleados fijos</td>
            <td class="w_10 allborder back_blue">Total empleados</td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['sitio_fijo']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['tipo_local']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['tiempo_local']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['seguridad_social']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['declara_renta']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['empleados_temporal']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['empleados_fijos']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['total_empleados']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder"><b>6.3. Información financiera(Ingresos y Gastos) "Como esta en el formato de autodeclaración resumido"</b></div>
    <table class="w_100 allborder text-center">
        <tr class="title-gray">
            <td colspan="5" class="w_10 allborder">Ingresos</td>
            <td colspan="5" class="w_10 allborder">Egresos mensuales</td>
        </tr>
        <tr class="title-gray">
            <td colspan="2" rowspan="2" class="w_10 allborder">Descripción</td>
            <td class="w_10 allborder">Titular</td>
            <td class="w_10 allborder">Otro Deudor 1</td>
            <td class="w_10 allborder">Otro Deudor 2</td>
            <td colspan="2" rowspan="2" class="w_10 allborder">Descripción</td>
            <td class="w_10 allborder">Titular</td>
            <td class="w_10 allborder">Otro Deudor 1</td>
            <td class="w_10 allborder">Otro Deudor 2</td>
        </tr>
        <tr class="title-gray">
            <td class="w_10 allborder">valor</td>
            <td class="w_10 allborder">valor</td>
            <td class="w_10 allborder">valor</td>
            <td class="w_10 allborder">valor</td>
            <td class="w_10 allborder">valor</td>
            <td class="w_10 allborder">valor</td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Salario / Pensión / Renta</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['salario_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['salario_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['salario_deudor2']?></td>
            <td colspan="2" class="w_10 allborder">Total gastos familiares y personales : LOS MUESTRA RESUMIDOS</td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['total_gastos_familiares_deudor2']?></td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['total_gastos_familiares_deudor2']?></td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['total_gastos_familiares_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Ventas o ingresos mensules </td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['ingresos_mensuales_titular']?></td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['ingresos_mensuales_deudor1']?></td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['ingresos_mensuales_deudor2']?></td>
            <td colspan="2" class="w_10 allborder back_blue">Gastos Familiares</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['gastos_familiares_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['gastos_familiares_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['gastos_familiares_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Total Costos y gastos</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['total_costos_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['total_costos_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['total_costos_deudor2']?></td>
            <td colspan="2" class="w_10 allborder back_blue">Valor arriendo/ Hipotecas</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['arriendo_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['arriendo_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['arriendo_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Costo de Operación y Venta</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['costo_operacion_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['costo_operacion_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['costo_operacion_deudor2']?></td>
            <td colspan="2" class="w_10 allborder back_blue">Cuotas TDC</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotasTDC_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotasTDC_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotasTDC_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Empleados- mano de obra </td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['empleados_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['empleados_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['empleados_deudor2']?></td>
            <td colspan="2" class="w_10 allborder back_blue">Cuotas creditos con otras entidades</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_creditos_entidades_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_creditos_entidades_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_creditos_entidades_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Arriendo Local</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['arriendo_local_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['arriendo_local_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['arriendo_local_deudor2']?></td>
            <td colspan="2" class="w_10 allborder back_blue">Cuotas creditos con la entidad</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_creditos_bcs_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_creditos_bcs_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_creditos_bcs_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Cuota prestamos del local o negocio</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_prestamos_local_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_prestamos_local_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['cuotas_prestamos_local_deudor2']?></td>
            <td colspan="2" class="w_10 allborder back_blue">Otros egresos</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_egresos_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_egresos_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_egresos_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder back_blue">Otros Gastos Operativos</td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_gastos_operativos_titular']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_gastos_operativos_deudor1']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_gastos_operativos_deudor2']?></td>
            <td colspan="2" rowspan="2" class="w_10 allborder title-gray">Total Disponible Cliente</td>
            <td rowspan="2" class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['disponible_titular']?></td>
            <td rowspan="2" class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['disponible_deudor1']?></td>
            <td rowspan="2" class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['disponible_deudor2']?></td>
        </tr>
        <tr>
            <td colspan="2" class="w_10 allborder title-gray">Utilidad Neta Unidad de Negocio</td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['ingresos_mensuales_titular'] - $resultado['detalle_economico'][0]['total_costos_titular'] ?></td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['ingresos_mensuales_deudor1'] - $resultado['detalle_economico'][0]['total_costos_deudor1'] ?></td>
            <td class="w_10 allborder back_blue">$<?= $resultado['detalle_economico'][0]['ingresos_mensuales_deudor2'] - $resultado['detalle_economico'][0]['total_costos_deudor2'] ?></td>
        </tr>
    </table>
    <div class="title-gray w_100 allborder">Otros ingresos </div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Actividad</td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['actividad_titular']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['actividad_deudor1']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['actividad_deudor2']?></td>
            <td rowspan="3" style="background-color: #8CBECB;" class="w_10 allborder">Total Disponible para la solicitud</td>
            <td rowspan="3" colspan="2" class="w_10 allborder back_blue">Descripción Otros ingresos </td>
            <td rowspan="3" colspan="2" class="w_10 allborder"><?= $resultado['detalle_economico'][0]['descripcion_otros_ingresos']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Antigüedad en la actividad</td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['antiguedad_titular']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['antiguedad_deudor1']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['antiguedad_deudor2']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Valor otros Ingresos </td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['otros_ingresos_titular']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['otros_ingresos_deudor1']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['otros_ingresos_deudor2']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder back_blue">Valor ayudas económicas (socio, cónyuge, familiar otro)</td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['ayudas_titular']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['ayudas_deudor1']?></td>
            <td class="w_10 allborder"><?= $resultado['detalle_economico'][0]['ayudas_deudor2']?></td>
            <td rowspan="2" class="w_10 allborder">$</td>
            <td rowspan="2" colspan="2" class="w_10 allborder back_blue">Descripción ayudas económicas</td>
            <td rowspan="2" colspan="2" class="w_10 allborder"><?= $resultado['detalle_economico'][0]['descripcion_ayudas']?></td>
        </tr>
        <tr>
            <td class="w_10 allborder title-gray">Total otros ingresos</td>
            <td class="w_10 allborder back_blue"><?= $resultado['detalle_economico'][0]['total_otros_ingresos_titular']?></td>
            <td class="w_10 allborder back_blue"><?= $resultado['detalle_economico'][0]['total_otros_ingresos_deudor1']?></td>
            <td class="w_10 allborder back_blue"><?= $resultado['detalle_economico'][0]['total_otros_ingresos_deudor2']?></td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder"><b>6.4. INFORMACIÓN DEL ENDEUDAMIENTO - (NO APLICA PARA PREAPROBADO)</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante</td>
            <td class="w_10 allborder back_blue">Entidad financiera</td>
            <td class="w_10 allborder back_blue">N° Obligación (Interno)</td>
            <td class="w_10 allborder back_blue">Valor de la Cuota</td>
            <td class="w_10 allborder back_blue">Saldo Total</td>
            <td class="w_10 allborder back_blue">Estado</td>
            <td class="w_10 allborder back_blue">Responsable del pago</td>
            <td class="w_10 allborder back_blue">observaciones</td>
        </tr>
        <?php foreach ($resultado['endeudamiento'] as $endeudamiento) : ?>
            <tr>
                <td class="w_10 allborder"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
                <td class="w_10 allborder"><?= $endeudamiento['entidad_financiera'] ?></td>
                <td class="w_10 allborder"><?= $endeudamiento['num_obligacion'] ?></td>
                <td class="w_10 allborder">$<?= $endeudamiento['valor_cuota'] ?></td>
                <td class="w_10 allborder">$<?= $endeudamiento['saldo_total'] ?></td>
                <td class="w_10 allborder"><?= $endeudamiento['estado'] ?></td>
                <td class="w_10 allborder"><?= $endeudamiento['responsable_pago'] ?></td>
                <td class="w_10 allborder"><?= $endeudamiento['observaciones'] ?></td>
            </tr>
            <?php $total = $total + $endeudamiento['saldo_total'] ?>
        <?php endforeach ?>
        <tr class="title-gray">
            <td class="w_10 allborder">Total endeudamiento</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$<?= $total; ?></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td rowspan="5" class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr class="title-gray">
            <td class="w_10 allborder">Total endeudamiento</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td rowspan="5" class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
        <tr class="title-gray">
            <td class="w_10 allborder">Total endeudamiento</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder"></td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder"><b>7. BALANCE (NO APLICA PARA PREAPROBADO)</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Tipo de solicitante</td>
            <td class="w_10 allborder back_blue">Activos corrientes</td>
            <td class="w_10 allborder back_blue">Activos fijos</td>
            <td class="w_10 allborder back_blue">Otros activos</td>
            <td class="w_10 allborder back_blue">TOTAL ACTIVOS</td>
            <td class="w_10 allborder back_blue">TOTAL PASIVOS</td>
            <td colspan="3" class="w_10 allborder back_blue">Fecha ejecución balance</td>
        </tr>
        <tr>
            <td class="w_10 allborder"><?= $resultado['solicitante'][0]['tipo_solicitante'] ?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['activos_corrientes']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['activos_fijos']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['otros_activos']?></td>
            <td class="w_10 allborder">$<?= $resultado['detalle_economico'][0]['total_activos']?></td>
            <td class="w_10 allborder">$<?= $total; ?></td>
            <td class="w_10 allborder back_blue">Día</td>
            <td class="w_10 allborder back_blue">Mes</td>
            <td class="w_10 allborder back_blue">Año</td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td rowspan="2" class="w_10 allborder"><?php $fecha = explode('-', $resultado['detalle_economico'][0]['fecha_balance']); echo $fecha[2]?></td>
            <td rowspan="2" class="w_10 allborder"><?= $fecha[1]?></td>
            <td rowspan="2" class="w_10 allborder"><?= $fecha[0]?></td>
        </tr>
        <tr>
            <td class="w_10 allborder"></td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
            <td class="w_10 allborder">$</td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder text-center"><b>8. RESPONSABLES NEGOCIACIÓN</b></div>
    <table class="w_100 allborder text-center">
        <tr>
            <td class="w_10 allborder back_blue">Nombre del promotor de la Negociación</td>
            <td colspan="2" class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['nombre_promotor'] ?></td></td>
            <td class="w_10 allborder back_blue">No identificación</td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['num_identificacion'] ?></td></td>
            <td class="w_10 allborder back_blue">Usuario</td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['usuario'] ?></td></td>
            <td class="w_10 allborder back_blue">Nombre de Agencia Externa o Área de Gestión</td>
            <td class="w_10 allborder"><?= $resultado['detalle_solicitante'][0]['nombre_agencia'] ?></td></td>
        </tr>
    </table>
    <div class="title-blue w_100 allborder text-center"><b>9. AUTORIZACIONES Y DECLARACIONES</b></div>
    <div class="w_100 allborder">
        <br>
        <b>En relacion con mi información crediticia:</b><br>
        <p>1. Autorizo de manera irrevocable al Banco para que consulte, solicite, suministre, reporte, procese, obtenga, recolecte, compile, confirme, intercambie, modifique, emplee, analice, estudie, conserve, reciba y envíe toda la información que se refiera a mi comportamiento crediticio, financiero, comercial o de servicios, incluyendo aquella relacionada con los aportes hechos al Sistema de Seguridad Social y la proveniente de terceros, de conformidad con lo establecido en el ordenamiento jurídico. </p>
        <p>2. Autorizo al Banco, a quien haga sus veces o represente sus derechos, para que destruya toda la información y documentación aportada para la solicitud de productos, en el caso de que ésta sea negada o desistida. </p>
        <b>Informacion del cambio de condiciones </b>
        <p>Certifico que he recibido información clara, precisa y suficiente sobre las condiciones y términos derivados de acogerme al cambio de las condiciones originalmente pactadas de mi(s) obligación (obligaciones), que este procedimiento implica la celebración de un negocio jurídico que tiene por objeto cambiar las condiciones originalmente pactadas en el crédito (tasa, plazo, sistema de amortización, garantía, etc.), con el fin de permitirle al deudor la atención adecuada de su obligación ante el real o potencial deterioro de su capacidad de pago, lo cual no significa de ninguna manera compromiso de aprobación por parte de la entidad. Si se evidencia algún cambio en las condiciones registradas en la solicitud, el Banco Caja Social se comunicará con usted para informar y validar, antes de proceder, la aceptación de las nuevas condiciones por el medio que considere más idóneo. </p>
        <br>
        <b>TÉRMINOS Y CONDICIONES PARA "MODIFICACIÓN" , "REESTRUCTURACIÓN" O "REDEFINICIÓN DE CONDICIONES"</b>
        <p>El Banco suministrará la información necesaria que le permita comprender las implicaciones de la restructuración en términos de costos y calificación crediticia, así como un comparativo entre las condiciones actuales y las del crédito una vez sea reestructurado. Para el efecto la  información mínima respecto de las nuevas condiciones establecidas, los efectos de incumplir en el pago de la obligación bajo las nuevas condiciones, así como el costo total de la operación.</p>
        <p>Las Obligaciones objeto de Redefinición de Condiciones no serán consideradas como Modificadas ni Reestructuradas, sin embargo, aquellas que al momento de la aplicación de las medidas adoptadas presentaban tal condición, la mantendrán de acuerdo a las instrucciones del cap. II de la CBCF</p>
        <p>Así mismo, los rubros de intereses de mora, intereses corrientes, seguros y comisiones vencidos adeudados en las cuotas hasta el día de hoy o por vencer en el periodo de gracia, se cargarán como un rubro adicional a la obligación para que se difieran y cancelen en el plazo restante; los seguros por vencer durante el periodo de gracia, deberán ser cancelados con normalidad durante este periodo</p>
        <hr>
        <p>Entiendo y acepto que es posible que me sea otorgado un crédito de emergencia Tasa Cero. Declaro que me fue informado que este crédito es una nueva obligación que tendrá por objeto recoger los conceptos vencidos diferentes a capital no atendidos de la obligación principal, adicionalmente en caso de requerir periodos de gracia en la obligación principal, autorizo cargar al crédito de emergencia tasa cero el valor correspondiente a los intereses de este periodo de gracia. La calificación y seguimiento de este nuevo crédito será la misma que la de la obligación principal, de acuerdo  la Circular Básica Contable 100 de 1993 expedida por la Superitendencia Financiera. </p>
        <p>Entiendo y acepto que, en caso se mora en el pago de la cuota del crédito de emergencia Tasa Cero se generarán gastos administrativos de cobranzas e intereses de mora a la tasa permitida por la ley.</p>
        <p>Entiendo y acepto que el saldo del crédito de emergencia Tasa Cero, que se proyecta en esta solicitud es aproximado dado que puede variar por la causación o pagos al momento de la aplicación.</p>
        <br><br>
        <hr>
        <b>Declaro y acepto los términos y condiciones previstos para aplicar una "Modificación", "Reestructuración" o "Redefinición de Condiciones" a mi(s) obligación(es).</b>
        <p>Para constancia se firma en la ciudad de_________________________________________ el día <?= $dia = date('d')?> de <?php setlocale(LC_TIME, "spanish"); echo strftime("%B"); ?> de <?= $año = date('Y') ?></p>
        <br>
        <p style="color: red;">*Solicitud con grabación de llamada: <?= $resultado['solicitante'][0]['grabacion'] ?> </p>
        <br><br>
        <table class="w_100">
            <tr>
                <td class="w_10">____________________________________________________________</td>
                <td class="w_10">____________________________________________________________</td>
                <td class="w_10">____________________________________________________________</td>
            </tr>
            <tr>
                <td class="w_10">FIRMA DEL SOLICITANTE / TITULAR </td>
                <td class="w_10">FIRMA DEL SOLICITANTE / DEUDOR 1</td>
                <td class="w_10">FIRMA DEL SOLICITANTE / DEUDOR 2</td>
            </tr>
            <tr>
                <td class="w_10">C.C. No. ______________________________________</td>
                <td class="w_10">C.C. No. ______________________________</td>
                <td class="w_10">C.C. No. ______________________________________</td>
            </tr>
        </table>
        <hr>
        <p style="color: red;">Rev. oct <?= $año = date('Y') ?></p>
    </div>
</body>
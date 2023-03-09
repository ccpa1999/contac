<?php if ($parametro == 'proyecccionReestructuracion') : ?>
    <div class="row" style="margin-top: 1%; margin-bottom: 1%;">
        <div class="col-xs-12">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <strong><i class="fa fa-warning"></i></strong>
                Esta es una simulación y se calcula de acuerdo a los valores ingresados.
                <br>
                <div id="lblTasaNominal"><i class="fa fa-hand-o-right"></i> <strong>Tasa Nominal: 18.37</strong> <i class="fa fa-percent"></i></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12" style="align-items: center;">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php foreach ($datos as $obligacion) : ?>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default accionSeleccionObligacionSimulador" data-seleccionado="false" data-obligacion="<?= preg_replace("/[^0-9]/", "", $obligacion['saldo_total']); ?>">
                            <i class="fa fa-plus-square" /> <?= $obligacion['numero_obligacion']; ?>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Capital</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" required id="txtCapital" value="0" placeholder="Capital Total" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Tasa Efectiva</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" required id="txtTasaEfectiva" placeholder="Tasa efectiva" value="" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Seguro Mensual</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-life-bouy"></i>
                </div>
                <input type="text" required id="txtSeguroMensual" placeholder="Seguro Mensual" value="" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Plazo</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-cc-diners-club"></i>
                </div>
                <select class="form-control" id="cuotas_simulador_reestructuracion">
                    <option value="">..Seleccione..</option>
                    <?php for ($i = 1; $i <= 88; $i++) : ?>
                        <option value="<?= $i; ?>"> <?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="form-group col-xs-4 col-xs-offset-4">
            <button class="btn btn-primary" type="button" style="width: 100%; font-weight: bold" id="iniciarSimulacionReestructuracion" data-toggle="collapse" data-target="#collapseSimulacionReestructuracion" aria-expanded="false" aria-controls="collapseExample">
                INICIAR SIMULACIÓN
            </button>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            <div class="collapse" id="collapseSimulacionReestructuracion">
                <div class="well">
                    <table class="table table-responsive table-bordered table-hover">
                        <caption>SIMULACIÓN DE CUOTAS</caption>
                        <thead>
                            <tr class="info" style="font-weight: bold; text-align: center !important;">
                                <td><i class="fa fa-money"></i> CUOTA MENSUAL (Incluye Seguro)</td>
                                <td><i class="fa fa-money"></i> CUOTA (Sin Seguro)</td>
                                <td><i class="fa fa-money"></i> ABONO CAPITAL</td>
                                <td><i class="fa fa-money"></i> ABONO INTERESES</td>
                                <td><i class="fa fa-money"></i> VALOR SEGURO</td>
                                <td><i class="fa fa-money"></i> SALDO FINAL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center !important;">
                                <td>
                                    <div id="txtCuotaMensualSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtCuotaSinSeguroSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtAbonoCapitalSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtAbonoInteresesSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtValorSeguroSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtSaldoFinalSimulado"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($parametro == 'consumo') : ?>
    <div class="row" style="margin-top: 1%; margin-bottom: 1%;">
        <div class="col-xs-12">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <strong><i class="fa fa-warning"></i></strong>
                Esta es una simulación y se calcula de acuerdo a los valores ingresados.
                <br><i class="fa fa-hand-o-right"></i> <strong>Tasa Actual: 2.1</strong> <i class="fa fa-percent"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-4">
            <label for="exampleInputEmail1"><strong>Obligación</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-tags"></i>
                </div>
                <select class="form-control" id="obligacion_simulador_consumo">
                    <option value="">..Seleccione..</option>
                    <?php foreach ($datos as $obligacion) : ?>
                        <option value="<?= preg_replace("/[^0-9]/", "", $obligacion['saldo_total']); ?>"> <?= $obligacion['numero_obligacion']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group col-xs-4">
            <label for="exampleInputEmail1"><strong>Valor Adeudado</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" required id="txtValorAdeudado" value="" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-4">
            <label for="exampleInputEmail1"><strong>Número de Cuotas</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-cc-diners-club"></i>
                </div>
                <select class="form-control" id="cuotas_simulador_consumo">
                    <option value="">..Seleccione..</option>
                    <?php for ($i = 1; $i <= 88; $i++) : ?>
                        <option value="<?= $i; ?>"> <?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-4">
            <label for="exampleInputEmail1"><strong>Ingresos</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="inpIngresos" placeholder="Ingresos Mensuales" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-4">
            <label for="exampleInputEmail1"><strong>Gastos</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="inpGastos" placeholder="Gastos Mensuales" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-4">
            <label for="exampleInputEmail1"><strong>Cuota Mensual</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="inpCuotaActual" placeholder="Cuota actual" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="form-group col-xs-4 col-xs-offset-4">
            <button class="btn btn-primary" type="button" style="width: 100%; font-weight: bold" id="iniciarSimulacionConsumo" data-toggle="collapse" data-target="#collapseSimulacionConsumo" aria-expanded="false" aria-controls="collapseExample">
                INICIAR SIMULACIÓN
            </button>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            <div class="collapse" id="collapseSimulacionConsumo">
                <div class="well">

                    <table class="table table-responsive table-bordered table-hover">
                        <caption>SIMULACIÓN DE CUOTAS</caption>
                        <thead>
                            <tr class="info" style="font-weight: bold; text-align: center !important;">
                                <td><i class="fa fa-credit-card-alt"></i> PLAZO</td>
                                <td><i class="fa fa-dollar"></i> CAPITAL</td>
                                <td><i class="fa fa-dollar"></i> INTERESES</td>
                                <td><i class="fa fa-money"></i> PRIMER CUOTA</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center !important;">
                                <td scope="row">
                                    <div id="txtPlazoSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtCapitalSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtInteresSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtCuotaSimulado"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-responsive table-bordered table-hover">
                        <caption>CAPACIDAD DE ENDEUDAMIENTO</caption>
                        <thead>
                            <tr class="info" style="font-weight: bold; text-align: center !important;">
                                <td><i class="fa fa-money"></i> DISPONIBLE</td>
                                <td><i class="fa fa-percent"></i> REDUCCIÓN</td>
                                <td><i class="fa fa-dollar"></i> DIFERENCIA</td>
                                <td><i class="fa fa-thumbs-up"></i> TIENE CAPACIDAD</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center !important;">
                                <td scope="row">
                                    <div id="txtDisponible"></div>
                                </td>
                                <td>
                                    <div id="txtReduccion"></div>
                                </td>
                                <td>
                                    <div id="txtDiferencia"></div>
                                </td>
                                <td>
                                    <div id="txtTieneCapacidad"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($parametro == "cancelacionTotal") : ?>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Capital Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" placeholder="Capital Mora" id="capitalMora"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="interesesCorrientes" placeholder="Intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeInteresesCorrientes" placeholder="Porcentaje intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesCorrientes" placeholder="Condonación intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesCorrientes" placeholder="Pago cliente intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" id="interesesMora" placeholder="Intereses Mora"></input>
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeInteresesMora" placeholder="Porcentaje intereses Mora" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesMora" placeholder="Condonación intereses Mora" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesMora" placeholder="Pago cliente intereses Mora" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="seguros" placeholder="Seguros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Intereses Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeInteresesSeguros" placeholder="Porcentaje intereses Seguros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Intereses Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesSeguros" placeholder="Condonación intereses Seguros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesSeguros" placeholder="Pago cliente intereses Seguros" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>GAC</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="gac" placeholder="GAC" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <div class="hide input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="porcentajeInteresesGAC" placeholder="Porcentaje intereses GAC" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <div class="hide input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesGAC" placeholder="Condonación intereses GAC" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses GAC</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesGAC" placeholder="Pago cliente intereses GAC" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-xs-3">
            Saldo Mora:<h3 id="saldoMora"></h3>
        </div>
        <div class="form-group col-xs-3">
        </div>
        <div class="form-group col-xs-3">
            Total Condonaciones:<h3 id="totalCondonaciones"></h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="">Saldo capital</label>
            <input class="form-control" id="saldoCapital" placeholder="Saldo Capital"></input>
        </div>
        <div class="form-group col-xs-3">
            <label for="">Valor de descuento</label>
            <input class="form-control" id="valorDescuento" placeholder="Valor de descuento"></input>
        </div>
        <div class="hide form-group col-xs-3">
            <input class="form-control" id="saldoDescuento"></input>
        </div>
        <div class="hide form-group col-xs-3">
            <input class="form-control" id="subtotal"></input>
        </div>
        <div class="form-group col-xs-3">
            Total:<h3 id="total"></h3>
            <input class="hide" id="Total">
        </div>

    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="">Cantidad de cuotas</label>
            <input class="form-control" id="cuotas" placeholder="Cantidad Cuotas"></input>
        </div>
        <div class="form-group col-xs-3">
        </div>
        <div class="form-group col-xs-3">
            Total cuota: <h3 id="cantidad"></h3>
        </div>
        <div class="hide form-group col-xs-3">
            <input class="form-control" id="totalPagoCliente"></input>
        </div>
    </div>
<?php elseif ($parametro == 'puestaDia') : ?>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Capital Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" placeholder="Capital Mora" id="capitalMora"></input>
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Descuento Capital Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" placeholder="Capital Mora" id="porcentajeCapitalMora"></input>
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Valor a descontar</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" placeholder="Capital Mora" id="condonacionCapitalMora"></input>
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Valores de pago</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" placeholder="Capital Mora" id="pagoClienteCapitalMora"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="interesesCorrientes" placeholder="Intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeInteresesCorrientes" placeholder="Porcentaje intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesCorrientes" placeholder="Condonación intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses Corrientes</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesCorrientes" placeholder="Pago cliente intereses Corrientes" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" class="form-control" id="interesesMora" placeholder="Intereses Mora"></input>
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeInteresesMora" placeholder="Porcentaje intereses Mora" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesMora" placeholder="Condonación intereses Mora" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses Mora</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesMora" placeholder="Pago cliente intereses Mora" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Otros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="otros" placeholder="otros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Otros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeOtros" placeholder="Porcentaje otros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Otros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionOtros" placeholder="Condonación otros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Otros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteOtros" placeholder="Pago cliente otros" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="seguros" placeholder="Seguros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Porcentaje Intereses Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                </div>
                <input type="text" id="porcentajeInteresesSeguros" placeholder="Porcentaje intereses Seguros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Condonación Intereses Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesSeguros" placeholder="Condonación intereses Seguros" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>Pago Cliente Intereses Seguros</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" id="pagoClienteInteresesSeguros" placeholder="Pago cliente intereses Seguros" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <label for="exampleInputEmail1"><strong>GAC</strong></label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="text" required id="gac" placeholder="GAC" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <div class="hide input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="porcentajeInteresesGAC" placeholder="Porcentaje intereses GAC" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            <div class="hide input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="condonacionInteresesGAC" placeholder="Condonación intereses GAC" class="form-control inputEnter">
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="form-group col-xs-3">
            Saldo Total:<h3 id="saldoMora"></h3>
        </div>
        <div class="form-group col-xs-3">
            Porcentaje a condonar:<h3 id="porcentajeCondonar"></h3>
        </div>
        <div class="form-group col-xs-3">
            Valor Condonación:<h3 id="totalCondonaciones"></h3>
            <input type="text" class="hide totalCondonaciones">
        </div>
        <div class="form-group col-xs-3">
        Valor recaudar credito:<h3 id="total"></h3>
            <input class="hide" id="Total">
        </div>
        <div class="hide form-group col-xs-3">
            <input class="form-control" id="totalPagoCliente"></input>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-xs-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="porcentageGac" placeholder="Porcentage GAC" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
        Valor gac proyectado:<h3 id="valorProyectado"></h3>
            <input type="text" class="hide valorProyectado">
        </div>
        <div class="form-group col-xs-3">
        Valor a pagar:<h3 id="valorPagar"></h3>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" id="valorRedondeado" placeholder="Valor redondeado" class="form-control inputEnter">
            </div>
        </div>
        <div class="form-group col-xs-3">
            GAC real:<h3 id="gacTotal"></h3>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            <div class="collapse" id="collapseSimulacionConsumo">
                <div class="well">

                    <table class="table table-responsive table-bordered table-hover">
                        <caption>SIMULACIÓN DE CUOTAS</caption>
                        <thead>
                            <tr class="info" style="font-weight: bold; text-align: center !important;">
                                <td><i class="fa fa-credit-card-alt"></i> PLAZO</td>
                                <td><i class="fa fa-dollar"></i> CAPITAL</td>
                                <td><i class="fa fa-dollar"></i> INTERESES</td>
                                <td><i class="fa fa-money"></i> PRIMER CUOTA</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center !important;">
                                <td scope="row">
                                    <div id="txtPlazoSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtCapitalSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtInteresSimulado"></div>
                                </td>
                                <td>
                                    <div id="txtCuotaSimulado"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-responsive table-bordered table-hover">
                        <caption>CAPACIDAD DE ENDEUDAMIENTO</caption>
                        <thead>
                            <tr class="info" style="font-weight: bold; text-align: center !important;">
                                <td><i class="fa fa-money"></i> DISPONIBLE</td>
                                <td><i class="fa fa-percent"></i> REDUCCIÓN</td>
                                <td><i class="fa fa-dollar"></i> DIFERENCIA</td>
                                <td><i class="fa fa-thumbs-up"></i> TIENE CAPACIDAD</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align: center !important;">
                                <td scope="row">
                                    <div id="txtDisponible"></div>
                                </td>
                                <td>
                                    <div id="txtReduccion"></div>
                                </td>
                                <td>
                                    <div id="txtDiferencia"></div>
                                </td>
                                <td>
                                    <div id="txtTieneCapacidad"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
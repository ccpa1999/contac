<?php 
    if ($parametro == 'crearTelefono' || $parametro == 'editarTelefono') :
        $this->insert("carteras/componentes/table-telefono.html", ["telefonos" => ($datos ?? NULL)]);
    elseif ($parametro == 'crearDireccion' || $parametro == 'editarDireccion') : 
        $this->insert("carteras/componentes/table-direccion.html", ["direcciones" => ($datos ?? NULL)]);
    elseif ($parametro == 'crearEmail' || $parametro == 'editarEmail') : 
        $this->insert("carteras/componentes/table-correo.html", ["emails" => ($datos ?? NULL)]); 
?>
<?php elseif ($parametro == 'formularioArbol') : ?>
    <div class="col-sm-12 col-md-12 mt-2">
        <div class="card border border-secondary">
            <div class="card-header text-center text-white bg-primary fw-bold">
                <?php
                    if ($tipo === "accion")
                        echo "Acción";
                    elseif ($tipo === "motivo")
                        echo "Motivo de no pago";
                    else
                        echo $tipo;
                ?>
            </div>

            <form id="formParametroArbol" data-id="formParametroArbol" data-controlador="carterasController" action="javascript:void(0);">
                <div class="card-body">
                    <div class="row gx-2">
                        <?php 
                            $contador = 1;

                            foreach ($parametros['homologado'] as $homologado) : 
                        ?>
                            <?php
                                $propiedad = '';

                                foreach ($parametros['asignadas'] as $asignadas) 
                                {
                                    if ($homologado['id'] == $asignadas['id']) 
                                    {
                                        $propiedad = 'checked';
                                        break;
                                    }
                                }
                            ?>

                            <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="rounded-3 border border-2 p-2 altura-max">
                                    <input class="form-check-input me-1" id="label-<?= $contador ?>" type="checkbox" <?= $propiedad; ?> name="parametro[]" value="<?= $homologado['id'] . '-' . $parametro_id; ?>">
                                    
                                    <label for="label-<?= $contador ?>" class="form-check-label">
                                        <?= (isset($homologado['homologado'])) ? mb_strtoupper($this->codificarCaracteres($homologado['homologado'])) : ''; ?>
                                        <?= (isset($homologado['motivo'])) ? mb_strtoupper($this->codificarCaracteres($homologado['motivo'])) : ''; ?>
                                    </label>
                                </div>
                            </div>
                            
                        <?php
                                $contador++; 
                            endforeach; 
                        ?>

                        <input type="hidden" name="tipo" value="<?= $tipo; ?>">
                        <input type="hidden" name="cartera" value="<?= $cartera; ?>">
                        <input type="hidden" name="parametro_id" value="<?= $parametro_id ?>">
                        <input type="hidden" name="metodo" value="crearParametroArbol">
                    </div>
                </div>

                <div class="card-footer text-center border-top border-secondary">
                    <input class="btn btn-primary" href="#" type="submit" value="GUARDAR">
                </div>
            </form>
        </div>
    </div>
<?php elseif ($parametro == 'busquedaReferencia') : ?>
    <?php $id = (!empty($resultado['pagos']) ? 'tableReferencia' : 'tableRefe'); ?>
    <div class="table-responsive">
        <table class="table table-bordered" id="<?= $id; ?>">
            <thead>
                <tr class="success">
                    <th style="text-align: center;">Referencia de Pago</th>
                    <?php if (!empty($resultado['pagos'])) : ?>
                        <th style="text-align: center;">Valor del Pago</th>
                        <th style="text-align: center;">Fecha del Pago</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody style="background-color: white; text-align: center;">
                <?php if (!empty($resultado['pagos'])) : ?>
                    <?php foreach ($resultado['pagos'] as $pagos) : ?>
                        <tr>
                            <td><?= $resultado['obligacion'][0]['estrategia_actual'] ?></td>
                            <td><?= $pagos['valor_pago']; ?></td>
                            <td><?= $pagos['fecha_pago']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td><?= $resultado['obligacion'][0]['estrategia_actual'] ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php elseif ($parametro == 'parametroObligatoriedad') : ?>
    <div class="col-sm-12 col-md-12 mt-2">
        <div class="card border border-secondary">
            <form id="formObligatoriedad" action="javascript:void(0);">
                <div class="card-body">
                    <div class="row gx-2">
                        <?php 
                            $contador = 1;

                            foreach ($parametros['inputs'] as $input) : 
                        ?>
                            <?php
                                $propiedad = '';

                                foreach ($parametros['inputsAsignados'] as $asignadas) 
                                {
                                    if ($input['id'] == $asignadas['id_input']) 
                                    {
                                        $propiedad = 'checked';
                                        break;
                                    }
                                }
                            ?>
                            
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                                <div class="rounded-3 border border-2 p-2 altura-max">
                                    <input class="form-check-input me-1" id="label-<?= $contador ?>" type="checkbox" <?= $propiedad; ?> name="parametro[]" value="<?= $input['id']; ?>">
                                    
                                    <label for="label-<?= $contador ?>" class="form-check-label">
                                        <?= mb_strtoupper($this->codificarCaracteres($input['input'])); ?>
                                    </label>
                                </div>
                            </div>

                        <?php
                                $contador++; 
                            endforeach; 
                        ?>

                        <input type="hidden" name="accion" value="<?= $accion; ?>">
                        <input type="hidden" name="contacto" value="<?= $contacto; ?>">
                        <input type="hidden" name="efecto" value="<?= $efecto; ?>">
                        <input type="hidden" name="cartera" value="<?= $cartera; ?>">
                        <input type="hidden" name="metodo" value="guardarObligatoriedad">
                    </div>
                </div>

                <div class="card-footer text-center border-top border-secondary">
                    <input class="btn btn-primary" href="#" type="submit" value="GUARDAR">
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

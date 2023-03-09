<?php if ($cliente['origen_gestion'] == 'tarea' && !isset($cliente['cliente']) || strpos(ucwords($_SESSION['rol_actual']), "Asesor") !== false && !isset($cliente['cliente'])) : ?>
    <link href="../../public/css/jquery-confirm.css" rel='stylesheet' type='text/css' />
    <script src="../../public/js/jquery-3.1.1.min.js"></script>
    <script src="../../public/js/jquery-confirm.js "></script>

    <script>
        $.confirm({
            icon: 'fa fa-comment-o',
            title: '¡ATENCIÓN!',
            type: 'blue',
            theme: 'dark',
            animation: 'scaleX',
            content: 'No se encontró titular.',
            buttons: {
                Ok: function() {
                    location.reload();
                }
            }
        });
    </script>
<?php else : ?>
    <div class="container-fluid">
        <div class="row d-flex justify-content-around">
            <div class="col-md-12 col-lg-5 mt-2">
                <div class="card border border-dark altura-max">
                    <div class="card-body d-flex flex-column">
                        <a class="mt-4 text-decoration-none text-center text-client fw-bold cedulaGestion" id="cedulaGestion" title="Pulsa 2 veces para copiar la cédula del cliente" href="#" data-clipboard-text="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>">
                            <i class="fa fa-id-card"></i>
                            <?= $cliente['cliente'][0]['cedula'] ?? ''; ?>
                        </a>

                        <a href="#" id="cedulaGestion" class="mt-3 mb-sm-2 mb-lg-0 text-decoration-none text-center text-client fw-bold cedulaGestion" title="Pulsa 2 veces para copiar la cédula del cliente" data-clipboard-text="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>">
                            <?= (isset($cliente['cliente'][0]['nombre'])) ? $cliente['cliente'][0]['nombre'] : ''; ?>
                        </a>

                        <div class="d-flex flex-column altura-max">
                            <div class="flex-column mt-auto align-bottom">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-success dropdown-toggle mb-2 py-2 fw-bold" data-bs-toggle="collapse" href="#collapseCreditos" role="button" aria-expanded="false" aria-controls="collapseCreditos" title="Créditos del cliente">
                                        <i class="fa fa-credit-card-alt success"></i> CRÉDITOS
                                    </a>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary dropdown-toggle mb-2 py-2 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDemograficos" aria-expanded="false" aria-controls="collapseDemograficos">
                                        <i class="fa fa-map-o success"></i> DEMOGRÁFICOS
                                    </button>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="#" id="siguiente" class="siguienteClienteTarea btn btn-info fw-bold" style="display: none;">
                                        SIGUIENTE TAREA <i class="fa fa-arrow-circle-right fa-1x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-7 mt-2">
                <div class="card text-dark bg-light">
                    <div class="card-header bg-ligth-blue">
                        <div class="row d-flex justify-content-around">
                            <div class="col-auto">
                                <div class="title-1 fw-bold"><i class="fa fa-info-circle"></i> Información</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body altura-max">
                        <div class="row">
                            <?php if (isset($gestion['label_informacion'])) : ?>
                                <?php foreach ($gestion['label_informacion'] as $titulos) : ?>
                                    <div class="col-sm-12 col-md-12 col-lg-6 border-bottom border-2 mb-2">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <h5 class="subtitle-1"><?= $titulos['titulo'] ?>:</h5>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <?= $this->codificarCaracteres($cliente['obligaciones'][0][$titulos['campo_tabla']] ?? '') ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="collapseCreditos" class="collapse">
                <div class="card card-body mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="align-middle small-font thead-creditos text-white">
                                <tr>
                                    <th class="text-center">Estado Reparto</th>
                                    <th class="text-center">Número Obligación</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Saldo Total</th>
                                    <th class="text-center">Saldo en Mora</th>
                                    <th class="text-center">Días Mora Actual</th>
                                    <th class="text-center">Tipo Crédito</th>
                                    <th class="text-center">Fecha Vencimiento</th>
                                    <th class="text-center">Estado Obligación</th>
                                    <th class="text-center">Clase Riesgo</th>
                                    <?php if ($_SESSION['carteraActual'] == '5' || $_SESSION['carteraActual'] == '12') : ?>
                                        <th class="text-center">Día Facturación</th>
                                        <th class="text-center">Fecha Vencimiento Factura</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($cliente['obligaciones'])) : ?>
                                    <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                        <tr class="refereciaObligacionGestion" data-obligacion="<?= $obligacion['numero_obligacion']; ?>" style="cursor:pointer;">
                                            <td><?= $this->codificarCaracteres($obligacion['estado_reparto']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['numero_obligacion']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['producto']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['saldo_total']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['saldo_mora']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['dias_mora_actual']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['ciclo_mora_actual_sistema']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['fecha_pago']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['estado_obligacion']); ?></td>
                                            <td><?= $this->codificarCaracteres($obligacion['zona']); ?></td>
                                            <?php if ($_SESSION['carteraActual'] == '5' || $_SESSION['carteraActual'] == '12') : ?>
                                                <td><?= $this->codificarCaracteres($obligacion['dia_facturacion']); ?></td>
                                                <td><?= $this->codificarCaracteres($obligacion['fecha_ultimo_alivio']); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="collapseDemograficos" class="collapse">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-6 col-xl-4 mt-2">
                    <div class="card card-body bg-gray-2 altura-max">
                        <button class="btn btn-success mb-2" data-bs-toggle="collapse" data-bs-target="#createTelefonos" aria-expanded="false" aria-controls="createTelefonos" data-parametro="telefono" data-div="divTelefonos" data-formulario="formCreacionTelefono" data-identificacion="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>">
                            <i class="fa fa-plus"></i> Agregar Teléfono
                        </button>

                        <div class="collapse mb-2" id="createTelefonos">
                            <div class="card card-body">
                                <form class="formularioCreacion formCarga" data-id="formCreacionTelefono" id="formCreacionTelefono" action="javascript:void(0);" data-ajax="telefonosDemografico" data-metodo="creacionDemografico" data-tipo="cedula" data-controlador="carterasController" data-div="divTelefonos">
                                    <div class="row mb-2">
                                        <label for="tipo" class="col-md-3 col-form-label">Tipo Teléfono</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-phone"></i></div>

                                                <select class="form-select" data-parsley-required="" name="tipo" required>
                                                    <option value="">..seleccione..</option>
                                                    <option value="celular">Celular</option>
                                                    <option value="celular oficina">Celular Oficina</option>
                                                    <option value="otro celular">Otro Celular</option>
                                                    <option value="otro teléfono">Otro Teléfono</option>
                                                    <option value="teléfono oficina">Teléfono Oficina</option>
                                                    <option value="teléfono residencia">Teléfono Residencia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="exampleInputEmail1" class="col-md-3 col-form-label">Teléfono</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-hashtag"></i></div>
                                                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el teléfono" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus-square"></i> Registrar</button>

                                        <input type="hidden" name="metodo" value="creacionDemografico">
                                        <input type="hidden" id="accion" name="accion" value="crearTelefono">
                                        <input type="hidden" name="identificacion" value="<?= $cliente['cliente'][0]['cedula'] ?? ''; ?>">
                                        <input type="hidden" name="div" value="divTelefonos">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php $this->insert("carteras/componentes/table-telefono.html", ["telefonos" => ($cliente['telefonos'] ?? NULL)]); ?>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4 mt-2" id="direcciones">
                    <div class="card card-body bg-gray-2 altura-max">
                        <button class="btn btn-success mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDirecciones" aria-expanded="false" aria-controls="collapseDirecciones" data-parametro="direcciones" data-div="direcciones" data-formulario="formCreacionDirecciones" data-identificacion="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>">
                            <i class="fa fa-plus"></i> Agregar Dirección
                        </button>

                        <div class="collapse mb-2" id="collapseDirecciones">
                            <div class="card card-body">
                                <form class="formularioCreacion formCarga" id="createDirecciones" action="javascript:void(0);" data-id="createDirecciones" data-metodo="creacionDemografico" data-tipo="direcciones" data-controlador="carterasController" data-div="divDirecciones">
                                    <div class="row mb-2">
                                        <label for="exampleInputEmail1" class="col-md-3 col-form-label">Tipo Dirección</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-location-arrow"></i></div>
                                                <select class="form-select" name="tipo" required>
                                                    <option value="">..seleccione..</option>
                                                    <option value="direccion residencia">Dirección Residencia</option>
                                                    <option value="direccion empresarial">Dirección Empresarial</option>
                                                    <option value="otra direccion">Otra Dirección</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="direccion" class="col-md-3 col-form-label">Dirección</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-info"></i></div>
                                                <input type="text" name="direccion" placeholder="Ingrese la Dirección" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="ciudad" class="col-md-3 col-form-label">Ciudad</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-map-marker"></i></div>

                                                <input type="text" name="ciudad" placeholder="Ingrese la Ciudad" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <br>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Registrar</button>

                                        <input type="hidden" name="metodo" value="creacionDemografico">
                                        <input type="hidden" id="accion" name="accion" value="crearDireccion">
                                        <input type="hidden" name="identificacion" value="<?= (isset($cliente['cliente'][0]['cedula'])) ? $cliente['cliente'][0]['cedula'] : ''; ?>">
                                        <input type="hidden" name="div" value="divDirecciones">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php $this->insert("carteras/componentes/table-direccion.html", ["direcciones" => ($cliente['direcciones'] ?? NULL)]); ?>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-4 mt-2" id="emails">
                    <div class="card card-body bg-gray-2 altura-max">
                        <button class="btn btn-success mb-2" data-bs-toggle="collapse" data-bs-target="#collapseCorreos" aria-expanded="false" aria-controls="collapseCorreos" data-parametro="correos" data-div="divCorreos" data-formulario="formCreacionCorreos" data-identificacion="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>">
                            <i class="fa fa-plus"></i> Agregar Correo
                        </button>

                        <div class="collapse" id="collapseCorreos">
                            <div class="card card-body">
                                <form class="formCarga" id="createCorreos" action="javascript:void(0);" data-id="createCorreos" data-metodo="buscarDeudorRecarga" data-tipo="cedula" data-controlador="carterasController" data-div="divCorreos">
                                    <div class="row mb-2">
                                        <label for="exampleInputEmail1" class="col-md-3 col-form-label">Tipo E-mail</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-envelope"></i></div>

                                                <select class="form-select" name="tipo" required="">
                                                    <option value="">..seleccione..</option>
                                                    <option value="email personal">E-mail Personal</option>
                                                    <option value="email oficina">E-mail Oficina</option>
                                                    <option value="otro email">Otro E-mail</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="email" class="col-md-3 col-form-label">Email</label>

                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa fa-info"></i></div>
                                                <input type="text" name="email" placeholder="Ingrese el Email" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus-square-o"></i> Registrar</button>

                                        <input type="hidden" name="metodo" value="creacionDemografico">
                                        <input type="hidden" id="accion" name="accion" value="crearEmail">
                                        <input type="hidden" name="identificacion" value="<?= $cliente['cliente'][0]['cedula'] ?? ''; ?>">
                                        <input type="hidden" name="div" value="divCorreos">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php $this->insert("carteras/componentes/table-correo.html", ["emails" => ($cliente['emails'] ?? NULL)]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-around mb-2 mt-2">
            <div class="col-auto">
                <a class="text-decoration-none fw-bold fs-4 title-informes" href="#" title="Cedúla del cliente">
                    <i class="fa fa-book"></i> HISTORIAL DE GESTIONES
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-auto">
                <button type="button" class="btn btn-success mb-2 btn-gestionar accionAgregarGestion" id="btnAgregarGestion" data-bs-toggle="collapse" data-bs-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <i class="fa fa-plus"></i> GESTIONAR
                </button>

                <button id="btnPagos" type="button" class="btn btn-primary mb-2 accionPagos" data-bs-toggle="modal" data-bs-target="#modalPagos">
                    <i class="fa fa-usd"></i> LISTA PAGOS
                </button>

                <button id="btnCalcularPagos" type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#calcularPagos">
                    <i class="fa fa-usd"></i> FUNCIÓN PAGOS
                </button>

                <?php if ($_SESSION['carteraActual'] == 2) : ?>
                    <button type="button" class="btn btn-primary mb-2 accionSolicitudReestructuracion" id="btnSolicitudReestructuracion">
                        <i class="fa fa-id-card"></i> SOLICITUD REESTRUCTURACIÓN
                    </button>
                    <button type="button" class="btn btn-primary mb-2 accionOpcionSimuladores">
                        <i class="fa fa-calculator"></i> SIMULADORES
                    </button>
                    <button type="button" data-cedula="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>" class="btn btn-danger mb-2 accionExportarSolicitud">
                        <i class="fa fa-file-pdf-o "></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="table-responsive small-font" id="divHistoricoGestion">
                        <table class="table table-striped table-bordered tablaHistoricoGestion">
                            <thead class="bg-thead text-white align-middle">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Gestor</th>
                                    <th>Obligación</th>
                                    <th>Acción</th>
                                    <th>Efecto</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <?php if (isset($gestion['campos_gestion'])) : ?>
                                        <?php foreach ($gestion['campos_gestion'] as $columnas) : ?>
                                            <?php if ($columnas['estado_tabla'] == 1) : ?>
                                                <th><?= $columnas['input'] ?></th>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($historial) && $historial != '') : ?>
                                    <?php foreach ($historial as $historico) : ?>
                                        <tr>
                                            <td><?= $this->codificarCaracteres($historico['fecha_gestion']); ?></td>
                                            <td><?= $this->codificarCaracteres($historico['gestor']); ?></td>
                                            <td><?= $this->codificarCaracteres($historico['obligacion']); ?></td>
                                            <td><?= $this->codificarCaracteres($historico['accion']); ?></td>
                                            <td><?= $this->codificarCaracteres($historico['efecto']); ?></td>
                                            <td><?= $this->codificarCaracteres($historico['contacto']); ?></td>
                                            <td><?= $this->codificarCaracteres($historico['telefono']); ?></td>
                                            <?php if (isset($gestion['campos_gestion'])) : ?>
                                                <?php foreach ($gestion['campos_gestion'] as $columnas) : ?>
                                                    <?php if ($columnas['estado_tabla'] == 1 && $columnas['estado'] == 1) : ?>
                                                        <td><?= $this->codificarCaracteres($historico[$columnas['id_input']]); ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Gestor</th>
                                    <th>Obligación</th>
                                    <th>Acción</th>
                                    <th>Efecto</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <?php if (isset($gestion['campos_gestion'])) : ?>
                                        <?php foreach ($gestion['campos_gestion'] as $columnas) : ?>
                                            <?php if ($columnas['estado_tabla'] == 1) : ?>
                                                <th><?= $columnas['input'] ?></th>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pagos -->
        <div class="modal fade" id="modalPagos" tabindex="-1" aria-labelledby="exampleModalPagos" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <!-- Modal content-->
                <div class="modal-content bg-dark text-white">
                    <div style="width: 100%; height:7px; border-radius: 5px 5px 0px 0px;" class="bg-primary"></div>

                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalPagos"><i class="fa fa-usd text-primary"></i> PAGOS</h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-light table-bordered" id="tablepagos">
                                <thead>
                                    <tr class="success">
                                        <th># Obligación</th>
                                        <th>Valor del Pago</th>
                                        <th>Fecha del Pago</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                    <?php if (isset($cliente['pagos'])) : ?>
                                        <?php foreach ($cliente['pagos'] as $pagos) : ?>
                                            <?php foreach ($pagos as $pagos) : ?>
                                                <tr>
                                                    <td><?= $pagos['obligacion']; ?></td>
                                                    <td><?= $pagos['valor_pago']; ?></td>
                                                    <td><?= $pagos['fecha_pago']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="calcularPagos" tabindex="-1" aria-labelledby="exampleCalcularPagos" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <!-- Modal content-->
                <div class="modal-content bg-dark text-white">
                    <div style="width: 100%; height:7px; border-radius: 5px 5px 0px 0px;" class="bg-primary"></div>

                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleCalcularPagos"><i class="fa fa-usd text-primary"></i> FUNCIÓN PAGOS</h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="javascript:void(0);">
                            <label for="">Capital</label>
                            <input type="number" id="capital" placeholder="Capital" class="calculoPago form-control" value="1000000">
                            <label for="">Plazo</label>
                            <input type="number" id="plazo" placeholder="Plazo" class="calculoPago form-control" value="12">
                            <label for="">Tasa Mensual %</label>
                            <input type="number" id="tasa" placeholder="Tasa mensual" class="calculoPago form-control" value="2">
                            <label for="">Factor %</label>
                            <input type="number" id="factor" placeholder="Factor" class="calculoPago form-control" value="0.52" <?= (strpos(ucwords($_SESSION['nombreCartera']),'Fincomercio') !== false) ? 'readonly' : ''; ?>>
                            <label for="">Factor Mensual %</label>
                            <input type="number" id="factor_mensual" placeholder="Factor mensual" class="calculoPago form-control" readonly>
                            <label for="">Seguro</label>
                            <input type="number" id="seguro" placeholder="Valor seguro" class="calculoPago form-control" readonly>
                        </form><br>
                        <div class="row">
                            <div class="col-md-12 text-center text-info">
                                <h6>Total cuota aproximada</h6>
                                <h3 id="totalPago">0</h3>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="wrapper" class="active">
            <!-- Sidebar -->
            <div id="sidebar-wrapper" class="ventanaMovimiento">
                <div class="container-fluid">
                    <div class="row ms-2 mt-3 d-flex justify-content-between">
                        <div class="col-auto">
                            <h5 class="fw-bold"><i class="fa fa-user"></i> GESTIÓN</h5>
                        </div>

                        <div class="col-auto">
                            <button class="btn-close btn-close-white float-end align-self-baseline accionAgregarGestion" type="button" aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="row d-flex mb-3" style="display:none;" id="visualizacionObligacion">
                        <div class="col-7">
                            <label class="badge bg-info" id="labelVisualizacionObligacion"></label>
                        </div>
                    </div>

                    <form id="formularioGestion" action="javascript:void(0);">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObligaciones" aria-expanded="false" aria-controls="collapseObligaciones">
                                        Obligaciones
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input type="number" class="form-control" required name="telefono" id="telefonosGestion" value="">
                                <!-- <div id="visualizacionTelefonos" style="display: none;"></div> -->
                            </div>

                            <div class="collapse" id="collapseObligaciones">
                                <div class="card card-body">
                                    <?php if (isset($cliente['obligaciones'])) : ?>
                                        <?php foreach ($cliente['obligaciones'] as $obligacion) : ?>
                                            <?php if ($obligacion['numero_obligacion'] !== "") : ?>
                                                <div class="form-check">
                                                    <input class="form-check-input obligacionGestion" type="checkbox" id="obligacion" name="obligacion[]" value="<?= $obligacion['numero_obligacion']; ?>">
                                                    <label class="form-check-label text-dark" for=""><?= $obligacion['numero_obligacion']; ?></label>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="exampleInputEmail1"><strong>Acción</strong></label>

                            <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-phone"></i></div>

                                <select class="form-select" id="accionGestion" name="accion" required>
                                    <option value="">seleccione...</option>

                                    <?php if (isset($gestion) && $gestion != "") : ?>
                                        <?php foreach ($gestion['acciones'] as $accion) : ?>
                                            <option value="<?= $accion['id'] ?>"><?= mb_strtoupper($this->codificarCaracteres($accion['homologado'])); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="col-form" for=""><strong>Contacto</strong></label>

                            <div class="input-group">
                                <div class="input-group-text"><i class="fa fa-male"></i></div>
                                <select class="form-select" id="contacto_gestion" name="contacto" required>
                                    <option value="">seleccione...</option>
                                </select>
                            </div>
                        </div>

                        <div id="divEfectoGestion" style="display:none;">
                            <div class="mb-2">
                                <label class="form-label" for="exampleInputEmail1"><strong>Efecto</strong></label>

                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa fa-magic"></i></div>
                                    <select class="form-select" id="efecto_gestion" name="efecto" required>
                                        <option>seleccione...</option>
                                    </select>
                                </div>
                            </div>
                            <?php if (isset($gestion['campos_gestion'])) : ?>
                                <?php for ($contador = 0; $contador < count($gestion['campos_gestion']); $contador++) : ?>
                                    <?php $this->insert(
                                        "carteras/componentes/inputs-gestion.html",
                                        ["input" => $gestion['campos_gestion'][$contador], "opciones" => $gestion['opciones_gestion']]
                                    ); ?>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </div>

                        <?php if (isset($gestion['opciones'][0])) : ?>
                            <div class="alert alert-success" role="alert">
                                <h5 class="alert-heading" id="pvlabel"><strong><?= $gestion['opciones'][0]['label']; ?></strong></h5>

                                <?php $opciones = explode(',', $gestion['opciones'][0]['opciones']); ?>
                                <div id="pvopciones">
                                    <?php foreach ($opciones as $opcion) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="producto" value="<?= $opcion; ?>">
                                            <label class="form-check-label" for="SI"><?= $opcion; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <hr>

                        <div class="row mb-2">
                            <div class="col-md-12 d-grid gap-2">

                                <div class="btn-group" role="group" aria-label="...">
                                    <button id="guardarGestion" type="submit" class="btn btn-success btn-lg" title="Guardar Gestión">
                                        <i class="fa fa-save"></i> Guardar Gestión
                                    </button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="metodo" value="guardarGestion">
                        <input type="hidden" name="origen_gestion" value="<?= $cliente['origen_gestion'] ?>">

                        <?php date_default_timezone_set("America/Bogota"); ?>
                        <input type="hidden" name="inicioGestion" id="inicioGestion" value="<?= date("Y-m-d H:i:s"); ?>">
                        <input type="hidden" name="cedula_deudor" id="cedula_deudor" value="<?= $cliente['cliente'][0]['cedula'] ?? '' ?>">

                        <?php if ($_SESSION['carteraActual'] == 5 || $_SESSION['carteraActual'] == 13) : ?>
                            <input type="hidden" name="homologadoGevening" id="homologadoGevening">
                        <?php endif; ?>

                        <input type="hidden" name="cartera" id="carteraGestion" value="<?= $_SESSION['carteraActual']; ?>">
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalMiProductividad" tabindex="-1" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">MI PRODUCTIVIDAD</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div id="estadoTareaContent" class="col-md-12" style="text-align: center;">
                                <p style="text-align: center;"><strong>Estadísticas por analista</strong></p>
                                <canvas id="miProductividadCanvas" width="200" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="container-fluid">
    <div class="d-flex flex-row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-2 mt-lg-3">
                <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
                <li class="breadcrumb-item">Administración</li>
                <li class="active breadcrumb-item">Ranking</li>
            </ol>
        </nav>
    </div>
    <div class="m-4">
        <form id="formScoring" data-id="formScoring" method="POST" action="javascript:void(0)" class="row formCarga" data-controlador="carterasController" data-ajax="moduloScoring">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Fecha inicial</label>
                        <input type="date" name="fecha_inicial" class="form-control" value="<?= date('Y-m-01'); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="">Fecha final</label>
                        <input type="date" name="fecha_final" class="form-control" value="<?php echo date('Y-m-t'); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="">Gestor</label>
                        <select class="form-control" name="gestor" id="gestor">
                            <option value="">..SELECCIONE..</option>
                            <?php foreach ($datos['usuarios'] as $usuario) : ?>
                                <option <?= ($usuario['usuario'] == $_SESSION['usuario']) ? 'selected' : ''; ?> value="<?= $usuario['usuario'] ?>"><?= $usuario['usuario'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2"><br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
                        <input type="hidden" name="metodo" value="obtenerRanking">
                    </div>
                </div>
            </div>
        </form><br>
        <div class="row">
            <div class="col-md-4 border">
                <div class="row border">
                    <div class="col-md-5 text-center">
                        <h1 id="porcentaje" class="mt-5">

                        </h1>
                        <b>PROMESAS</b>
                    </div>
                    <div class="text-center col-md-7">
                        <canvas id="progreso"></canvas>
                    </div>
                </div>
                <div class="row border text-center">
                    <div class="col-md-12 mt-5" id="tableRanking">
                        <?php $this->insert('carteras/componentes/table-ranking.html', ['datos' => $datos]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8 border">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="usuarios">
                        </canvas>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="cartera">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
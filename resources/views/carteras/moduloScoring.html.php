<div class="container-fluid">
    <div class="d-flex flex-row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-2 mt-lg-3">
                <li class="breadcrumb-item"><a class="text-decoration-none" onclick="location.reload();" href="#">FIANZA LTDA</a></li>
                <li class="breadcrumb-item">Administración</li>
                <li class="active breadcrumb-item">Scoring</li>
            </ol>
        </nav>
    </div>
    <div class="m-4">
        <form id="formScoring" data-id="formScoring" method="POST" action="javascript:void(0)" class="row formCarga" data-controlador="carterasController" data-ajax="moduloScoring">
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Fecha inicial</label>
                        <input type="date" name="fecha_inicial" class="form-control" value="<?php echo date('Y-m-01'); ?>">
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
                                <option value="<?= $usuario['usuario'] ?>"><?= $usuario['usuario'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2"><br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
                        <input type="hidden" name="metodo" value="obtenerScoring">
                    </div>
                </div>
            </div>
        </form><br>
        <div class="row">
            <div class="col-md-10 border">
                <canvas id="cartera">
                </canvas>
            </div>
            <div class="col-md-2 border">
                <div class="mx-auto border mt-3 border-5 rounded-circle shadow" style="width: 200px;height: 200px;">
                    <div class="mx-auto"><br><br>
                        <div class="text-center mx-auto">
                            <h1><b id="total">0</b></h1>
                            <h4>GESTIONES</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 border">
                <canvas id="usuarios">
                </canvas>
            </div>
        </div>
    </div>
</div>
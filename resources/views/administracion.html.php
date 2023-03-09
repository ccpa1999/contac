<?php $this->layout('layout.html', ['modulo' => 'administración']) ?>

<div id="contenedor_data">
    <div class="container-fluid">
        <div class="row">
            <!-- <code><?php //echo $_SERVER['HTTP_HOST'] ?></code> -->
            <?php foreach ($datos['clientes'] as $cartera) : ?>
                <?php if (isset($cartera['ruta_logo']) && $cartera['ruta_logo'] != '') : ?>
                    <a href="../../app/controllers/carterasController.php?&cartera=<?= $cartera['id']; ?>" 
                      target="_blank" style="min-height:150px; height:50px;"
                      class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mt-2">
                        <div class="card card-body altura-max hover-cartera">
                            <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/login/public/storage/<?= $cartera['ruta_logo']; ?>"
                            alt="" class="card-img my-auto">
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

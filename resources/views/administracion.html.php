<?php $this->layout('layout.html', ['modulo' => 'administración']) ?>

<div id="contenedor_data">
    <div class="row">
        <?php foreach ($datos['clientes'] as $cartera) : ?>
            <?php if (isset($cartera['ruta_logo']) && $cartera['ruta_logo'] != '') : ?>
                <div class="col-md-2">
                    <a href="../../app/controllers/<?php echo $cartera['controlador']; ?>?&cartera=<?php echo $cartera['id_cliente']; ?>" class="thumbnail" target="_blank" style="min-height:150px;height:50px;">
                        <img src="../../public/images/<?php echo $cartera['ruta_logo']; ?>" alt="" class="img-responsive" style="padding-top: 50px;">
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
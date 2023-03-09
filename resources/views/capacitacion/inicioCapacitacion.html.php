<?php $this->layout('layout.html', ['modulo' => 'capacitacion']) ?>
<div id="contenedor_data">
    <div class="row">

        <ol class="breadcrumb">
            <li>
                <a href="#">FIANZA LTDA</a>
            </li>
            <li class="active">Capacitaciónes
            </li>  
        </ol>
        <hr>
        <div class="row" style="overflow: hidden">
            <?php foreach ($capacitacion['tipo_capacitacion'] as $item): ?>
                <?php if ($item['imagen_capacitacion'] != ''): ?>
                    <div class="col-lg-6  col-md-4 col-sm-12">
                        <a href="#" style="height:200px; min-height: 150px;" class="thumbnail btnIniciarCapacitacion" title="<?=$item['nombre'] ?>" data-tipo="<?=$item['id']; ?>">
                            <img style="max-width: 250px; padding: 9%;" src="../../public/images/<?=$item['imagen_capacitacion'] ?>" alt="" class="img-responsive">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

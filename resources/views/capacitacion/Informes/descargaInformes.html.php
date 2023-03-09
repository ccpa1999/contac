<?php 
    if (isset($tipo)) {
        if ($tipo == "pdf") {
            $icono = "fa fa-file-pdf-o fa-4x";
        } else {
            $icono = "fa fa-file-excel-o fa-4x";
        }
    } else {
        $icono = "fa fa-file-excel-o fa-4x";
    }
    
    ?>
    <br>
    <center>
        <p><strong>El informe fue generado correctamente</strong></p>
        <p>Descarguelo haciendo click en el botón</p>
        <br>
        <p>
            <a href="<?=$ruta; ?>" class="btn btn-success" target="_blank">
                <i class="<?=$icono; ?>"></i>
            </a>
        </p>
    </center>
<?php
    $this->layout('layout.html', [
        'modulo' => 'cartera', 'carteraActual' => $_SESSION['carteraActual'],
        'logoCarteraActual' => $cartera[0]['ruta_logo'] ?? '', 
        'cliente' => $cliente['cliente'][0] ?? ''
    ]);
?>
<div id="contenedor_data">
    <?php         
        $this->insert('carteras/gestion/gestion.html', 
        ['cliente' => $cliente ?? '', 'gestion' => $gestion ?? '', 
         'historial' => $historial ?? '']); 
    ?>
</div>
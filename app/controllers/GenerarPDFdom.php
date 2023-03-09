<?php
  require '../../vendor/autoload.php';

use Dompdf\Dompdf;

class GenerarPDFdom {

  var $dompdf;

  public function __construct()
  {
      $this->dompdf = new Dompdf();
  }

  /**
   * Funcion inicializa la creación de un pdf
   * @param Array $datos: Coniente los parametros para una consulta
   * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
   * @return Array $return: Devuelve los datos del metodo llamado
  */ 

  public function generarPDFdom($datos, $parametro)
  {
      $metodo = 'formato' . $parametro;
      $return = $this->$metodo($datos, $capacitacion);
      return $return;
  }

    /**
     * Funcion crea el certificado de un usuario en un pdf 
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $ruta: Devuelve un string con la ruta de descarga del certificado
    */ 

  public function formatoCertificacion($datos){
    $this->dompdf->loadHtml($datos['plantilla']);
    $this->dompdf->setPaper('letter');
    $this->dompdf->render();
    $nombre= "Certificado de ".$datos['datos']['capacitado'][0]['nombre_completo'].".pdf";
    $ruta='../../public/archivos/descargas/certificaciones/'.$nombre;

    $salida = $this->dompdf->output();
    file_put_contents($ruta,$salida);
    return $ruta;
  }

    /**
     * Funcion crea el certificado de un usuario en un pdf
     * @param Array $datos: Coniente los parametros para una consulta
     * @author Kevin Aya, Luis Monroy <kevinsaya25@gmail.com,luismonroy97@live.com>
     * @return String $ruta: Devuelve un string con la ruta de descarga del certificado
     */

    public function formatoSolicitudReestructuracion($datos){ 
        $this->dompdf->loadHtml($datos['plantilla']);
        $this->dompdf->setPaper (array(0, 5, 800, 1200), 'portrait' );
        $this->dompdf->render();
        $ruta='../../public/archivos/descargas/solicitud_reestructuracion/Solicitud reestructuración.pdf';

        $salida = $this->dompdf->output();
        file_put_contents($ruta,$salida);
        return $ruta;
    }

}



 ?>

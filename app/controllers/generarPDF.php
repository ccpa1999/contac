<?php

include_once '../../vendor/autoload.php';

/**
 * Description of generarPDF
 *
 * @author jonnathan
 */
class generarPDF {

    var $pdf;

    public function __construct() {
        $this->pdf = new FPDF();
    }

    /**
     * Función que se encarga de generar los PDF's
     * @param type $datos
     */
    public function generarPDF($datos, $parametro) {
        $metodo = 'formato' . $parametro;
        $return = $this->$metodo($datos);
        return $return;
    }

    /**
     * Función que genera un documento pdf con la informacion de la visita un 
     * determinado usuario Asalariado  
     * 
     * @param Array $datos: tiene los datos de la peticion 
     * @author Jonnathan Murcia <jjmurciab@gmail.com>
     * @return String $ruta : contiene la ruta del archivo que se genero 
     */
    public function formatoCertificacion($datos) {

        foreach ($datos["capacitaciones"] as $val) {
            $capacitaciones .= $val["nombre"] . ", ";
        }
        $capacitaciones = substr($capacitaciones, 0, -2);
        $hoy = getdate();
        //Cabezera

        $this->pdf->AddPage();
        $this->pdf->Image('../../public/images/logo_fianza-01.png', 16, 8, 35);

        $this->pdf->Cell(60);
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->SetY(15);
        $this->pdf->SetX(42);
        $this->pdf->MultiCell(150, 6, utf8_decode('CERTIFICACIÓN ASISTENCIA A CAPACITACIÓN AUDITORIA Y FORMACIÓN'), 0, 'C', FALSE);
        $this->pdf->Ln();
        $this->pdf->Ln();

        $this->pdf->SetFont('times', '', 12);
        $this->pdf->SetX(18);
        $this->pdf->MultiCell(178, 6, utf8_decode("Yo " . utf8_encode(strtoupper($datos["capacitador"][0]["nombre_completo"])) .
                        "   Identificado(a) con cedula de Ciudadanía No " . utf8_encode($datos["capacitador"][0]["identificacion"]) .
                        " de   BOGOTÁ  En mi calidad de  Auditor Formador, me permito certificar que el señor (a) " .
                        utf8_encode(strtoupper($datos["capacitado"][0]["nombre_completo"])) . "   identificado (a) con cedula de ciudadanía  No " .
                        utf8_encode($datos["capacitador"][0]["identificacion"]) .
                        "  recibió capacitación de:"), 0, 'L', FALSE);
        $this->pdf->Ln();
        $this->pdf->Ln();
        
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("1. Capacitación Área de Auditoria y Formación"), 0, 'L', false);
        $this->pdf->Ln();

        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("2. Plantilla de Calificación, errores críticos y no críticos, concurso"
                        . " Gestionando con Calidad, método de evaluar al asesor."), 0, 'L');
        $this->pdf->Ln();

        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("3. Guiones establecidos en la campaña"), 0, 'L');
        $this->pdf->Ln();

        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("4. Políticas Externas: Circular 052, 048, Ley 1581, Habeas Data, Sac , Saro y Sarlaft."), 0, 'L');
        $this->pdf->Ln();

        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("5. Políticas Internas de Fianza LTDA. :" . $capacitaciones), 0, 'L');
        $this->pdf->Ln();

        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("6. Clínicas iniciales de cobranza en cuanto a servicio al cliente, manejo de objeciones, clientes difíciles"), 0, 'L');
        $this->pdf->Ln();

        $this->pdf->SetX(27);
        $this->pdf->MultiCell(160, 5, utf8_decode("7. Divulgación Política de Calidad, Misión, Visión y objetivos"), 0, 'L', FALSE);
        $this->pdf->Ln();
        $this->pdf->Ln();

        $this->pdf->SetX(18);
        $this->pdf->MultiCell(176, 6, utf8_decode("Así mismo certifico que entiendo "
                        . "y acepto cumplir con todas las políticas anteriormente mencionadas y que cualquier"
                        . " incumplimiento dara lugar a una falta grave en mi contrato de trabajo."), 0, 'L', FALSE);
        $this->pdf->Ln();
        
        $this->pdf->SetX(18);
        $this->pdf->MultiCell(130, 5, utf8_decode("Con una intensidad horaria de 20 horas ."), 0, 'L', FALSE);
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();

        $this->pdf->SetX(12);
        $this->pdf->MultiCell(178, 5, utf8_decode("Para constancia firma el día    " .
                        $hoy['wday'] . "    del mes    " . $hoy['mon'] . "    del año    " . $hoy['year']), 0, 'C', FALSE);
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Ln();

        $this->pdf->SetX(30);
        $this->pdf->Cell(60, 5, utf8_decode("Asesor"), 0, 0, 'C');
        $this->pdf->Cell(30, 5, "", 0, 0, 'C');
        $this->pdf->Cell(60, 5, utf8_decode("Auditor Formador"), 0, 0, 'C');
        $ejeY = $this->pdf->GetY();
        $this->pdf->SetX(14);
        $this->pdf->Line(35, $ejeY - 7, 95, $ejeY - 7);
        $this->pdf->Line(115, $ejeY - 7, 175, $ejeY - 7);

        $ruta = '../../public/archivos/descargas/certificaciones/' . "Nombre" . '.pdf';
        $resultado = $this->pdf->Output($ruta, 'F');

        return $ruta;
    }

}

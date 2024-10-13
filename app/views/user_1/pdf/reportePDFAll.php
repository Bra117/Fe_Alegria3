<?php
use Dompdf\Options;
use Dompdf\Dompdf;
ini_set("memory_limit","25M");
extract($_REQUEST);
$encryption = trim($_REQUEST['cod']);
$encryption = base64_decode(base64_decode($encryption));

include 'funcionesPDF.php';


$html = headerpdf();


/*$html.= info_planilla_solicitud($nro_solicitud);
$html.= info_empresa_importadora($nro_solicitud);
$html.= info_operacion_aduanera($nro_solicitud);
$html.= info_productos($nro_solicitud);

$html.= info_resultado_ins($nro_solicitud);
$html.= info_pago_solicitud($nro_solicitud);
$html.= info_firma_solicitud($nro_solicitud);

// Instanciamos un objeto de la clase DOMPDF.*/

$options = new Options();
$options->set('isRemoteEnabled', true);

   $pdf = new Dompdf();
    // Definimos el tamaño y orientación del papel que queremos.
     $pdf->set_paper("letter", "portrait");
    // Cargamos el contenido HTML.
     $pdf->load_html(html_entity_decode($html));
    // Renderizamos el documento PDF.
     $pdf->render();
    // Enviamos el fichero PDF al navegador.
    $pdf->stream("oficio1.pdf", ['Attachment' => false]);
    exit();

?>


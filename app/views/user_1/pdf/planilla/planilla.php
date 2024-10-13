<?php
require (ROOT.'app/plugins/dompdf/autoload.inc.php');

use Dompdf\Options;
use Dompdf\Dompdf;
ini_set("memory_limit","25M");
extract($_REQUEST);
$id = $_REQUEST['cod'];
$id_func = $_SESSION['id_ciudadano'];
$id = base64_decode(base64_decode($id));
include 'funcionesPDF.php';
   

$html= pdf($id,$id_func);

// Instanciamos un objeto de la clase DOMPDF.
$options = new Options();
$options->set('isRemoteEnabled', true);

   $pdf = new Dompdf();
    // Definimos el tamaño y orientación del papel que queremos.
     $pdf->set_paper("letter", "landscape");
    // Cargamos el contenido HTML.
     $pdf->load_html(html_entity_decode($html));
    // Renderizamos el documento PDF.
     $pdf->render();
    // Enviamos el fichero PDF al navegador.
    $pdf->stream("planilla.pdf", ['Attachment' => false]);
    exit();

?>



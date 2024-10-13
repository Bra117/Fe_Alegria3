<?php
include 'app/plugins/phpqrcode/qrlib.php';

$dir = 'app/lib/';

if(!file_exists($dir))
	mkdir($dir);

$filename = $dir.'QR.png';

$tamano    = 10;
$level     = 'M';
$framesize = 3;
$contenido = $_SESSION['usuario'];

QRcode::png($contenido, $filename, $level, $tamano, $framesize);

//echo '<img src = "'.$filename.'" />';
?>
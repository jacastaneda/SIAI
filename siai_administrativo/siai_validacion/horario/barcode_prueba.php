<?php
include_once("../librerias/fpdf.php");
include_once("../../barcode2/EAN128-4php.php");
//MakeFont('ADVC128C.afm');

$barcode='4157419700005582390200000072009620121231802000170510255112';
$filename="barcode";
//createImageBuffer($barcode);
createImageFile($barcode, $filename);

?>
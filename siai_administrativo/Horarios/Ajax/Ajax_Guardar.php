<?php  session_start();

require_once("../../clases/Classhordetalle.php");
require_once("../../clases/ClassSecciones.php");
$hordetalle=new Classhordetalle();
$secciones= new ClassSecciones();

$asi=explode("-",$_POST["txt_asignatura"]);
$secciones->setCICLO($_POST["txt_CICLO"]);
$secciones->setAULA($_POST["txt_aulas"]);
$secciones->setCODIGO_ASI($asi[1]);
$secciones->setSECCION($_POST["txt_seccion"]);
$secciones->setCUPOS($_POST["txt_cupos"]);


$hordetalle->setCICLO($_POST["txt_CICLO"]);
$hordetalle->setCODHOR(trim($_SESSION["S_horarios"],"-"));
$hordetalle->setCODIGO($asi[1]);
$hordetalle->setSECCION($_POST["txt_seccion"]);

$secciones->InsertarSeccion();
$hordetalle->insertarHoraDetalle();

unset($_SESSION["S_horarios"]);

?>
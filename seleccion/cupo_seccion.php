<?php
session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/ClassExpedientealumno.php");
include_once("../clases/ClassNotash.php");
include_once("../clases/ClassHorarios.php");
include_once("../clases/ClassHordetalle.php");
include_once("../clases/ClassSecciones.php");
include_once("../clases/ClassAsignatura.php");
include_once("../clases/ClassPrerrequisitos.php");

$nAsignatura=$_GET['asignatura'];
$nSeccion=$_GET['seccion'];

$horarios=unserialize($_SESSION['siai']['horarios']);

if($horarios[$nAsignatura]['seccion'][$nSeccion]->getDisponible())
{
	echo "resultadosiai=1";
}
else
{
	echo "resultadosiai=0";
}
?>
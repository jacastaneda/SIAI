<?php 
	session_start();
	include_once("clases/ClassConexion.php");
	include_once("clases/ClassExpedientealumno.php");
	
	$estudiante= new Expedientealumno();
	$_SESSION['siai']['carnet']=$_GET['carnet'];
	$_SESSION['siai']['estudiante']->setExpedientealumnoPorLlave($_GET['carnet']);
	
	
?>
<?php 

	include_once("../../clases/ClassAlumnoExpediente.php");//clase incluida
	include_once("../../clases/ClassConexion.php");//clase a a conexion de base de datos
	$expediente= new ClassAlumnoExpediente();

	//Seteo de variables
	$expediente->setCARNET($_REQUEST["txtCarnet"]);
	$expediente->setAPELLCASAD($_REQUEST["txtApellidoCas"]);
	$expediente->setAPELLIDO1($_REQUEST["txtApellido1"]);
	$expediente->setAPELLIDO2($_REQUEST["txtApellido2"]);
	$expediente->setCARRERA($_REQUEST["lstCarrera"]);
	$expediente->setCODIGO_PLA($_REQUEST["txtCodigoPlan"]);
	$expediente->setNOMBRES($_REQUEST["txtNombres"]);
	
	$expediente->setTIPOINGRES($_REQUEST["lstTipoIngreso"]);
	$expediente->setTIPOBECA($_REQUEST["lstTipoBeca"]);
	
	$expediente->GuardaExpedienteAlumno();


?>
<?php 
	
	include_once("../../clases/ClassAlumnoExpediente.php");//clase incluida
	include_once("../../clases/ClassConexion.php");//clase a a conexion de base de datos
	$expediente= new ClassAlumnoExpediente();
	
	
		$p1=$_REQUEST["txtApellido1"];
		$anio=date("Y");
		$p2=$_REQUEST["txtApellido2"];
		$p3=$_REQUEST["txtApellidoCas"];
		
		if($p3<>""){
			$p2[0]="D";
			}
		if($p2==""){
			$p2[0]=$p1[0];
			}
		$NcarnetTemp=$p1[0].$p2[0].$anio;
		$expediente->setCARNET($NcarnetTemp);
		$cuantosCarnet=$expediente->getCuantosCarnet();
		$cuantosTemp=$cuantosCarnet+1;
		$Ncarnet=$NcarnetTemp."0".$cuantosTemp;
		echo strtoupper($Ncarnet);

?>
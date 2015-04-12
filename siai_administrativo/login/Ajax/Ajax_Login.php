<?php  session_start();
	
	include_once("../../clases/ClassUsuarios.php");//clase incluida
	include_once("../../clases/ClassConexion.php");//clase a a conexion de base de datos 

	$usuario=new ClassUsuario();
	$usuario->setUsuario(strtolower($_REQUEST["user"]));
	$usuario->setPassword($_REQUEST["pass"]);
	$datos=$usuario->Login();
	
	
	
	if($datos[0]["CODIGO"]!=""){
		
		
		$_SESSION["user"][]=array("usuario"=>$datos[0]["CODIGO"],"TIPO_USUAR"=>$datos[0]["TIPO_USUAR"],"idCatedratico"=>$datos[0]["idCatedratico"]);
		echo 1;
		exit();
		}
	else{
		
		echo 0;	
		exit();
		}	
	
 	
 

?>
<?php 
include_once("../../clases/ClassConexion.php");//clase a a conexion de base de datos

$cnx= new MySQL();


$sql="select * 
FROM  sia_planes where CODIGO_CAR ='".$_REQUEST["lstCarrera"]."' and estatus=1";

$consulta=$cnx->consulta($sql);

while($plan=$cnx->fetch_array($consulta)){
	$p=$plan["planes"];
	
	}

 echo $p;

?>
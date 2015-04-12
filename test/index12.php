<?php 
include("clases/conexion.php");


$cnx=new Conexion();


$sql="select * from factura";

$datos=$cnx->consulta($sql);
//header("Location: http://www.gogle.com");
echo count($datos);

 foreach($datos as $row){
	echo $row["cod_factu"]."<br>";
	} 


$sql1="insert into usuarios(usuario,pass) values('er','POO')";

//echo $cnx->DUI($sql1);

//header("Location: http://www.gogle.com");

?>
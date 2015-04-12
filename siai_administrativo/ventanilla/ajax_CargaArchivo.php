<?php session_start();

include_once("../clases/ClassConexion.php");//clase a a conexion de base de datos
include_once("../clases/ClassPagoAlumnos.php");//clase a a conexion de base de datos
include_once("../clases/DB_model.php");//clase a a conexion de base de datos
require("PHPMailer/class.phpmailer.php");
require("config.php");

$cnx=new MySQL();
$pagoAlumno=new ClassPagoAlumnos();

/******************************************************************************************************
   Nombre:       Cargar_Archivo()
   Proposito:  Metodo para cargar los datos de los archivos
   REVISIONS:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        24/09/2012   Denys Urquilla       1. Metodo asignara lso valors a una caja de texto para que no se pierdan los datos
  NOTAS:
*******************************************************************************************************/



	
	
	$txt=$_SESSION["ArchivoVentanilla"];
	
	$_REQUEST["archiv"];
	//$respuesta->alert($txt);
	$file = fopen("LibUpload/savefiles/".$txt, "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
 while(!feof($file))
{
	
	$m=explode(",",fgets($file));
//echo "Cuenta ".$m[1]." "."fecha ".$m[2]."Hora ".$m[3]."Transaccion ".$m[4]."valor ".$m[5]."NUI :".substr($m[6],1,6)."<br />";
$sql="CALL PROC_ABC_PAGOS_ALUMNOS(
								  '".$m[1]."', 
								  '".$m[2]."',
								  '".$m[3]."',
								  '".$m[4]."',
								  '".$m[5]."',
								  '".substr($m[6],1,6)."',
								  '".substr($m[6],7,3)."',
								  '".substr($m[6],10,1)."',
								  '".substr($m[6],11,1)."',
								  '".substr($m[6],12,2)."'
								  

								)";
			$cnx->consulta($sql);								
}
fclose($file); 

	
//EJECUTO LA BUSQUEDA  PARA INSCRIBIR

$sql_pagos="CALL PROC_RevisionPagos";
$consulta=$cnx->consulta($sql_pagos);

while($row=$cnx->fetch_array($consulta)){
	
	echo $row["coordinador"];
	
	//AQUI ENVIARE EL CORREO 
	}
	
$pagoAlumno->VerificacionPagos();

$pagoAlumno->envio_email();
echo '<link href="../css/div_mensajes.css" rel="stylesheet" type="text/css" />';	
	
	$div='<div class="exito">
  La carga se ha Realizado Correctamente
  </div>';
echo $div;

?>
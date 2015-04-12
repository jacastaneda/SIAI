<?php
	session_start();
	include_once("clases/ClassConexion.php");
	include_once("clases/MetodosComunes.php");
	include_once("clases/ClassControl.php");
	
	$control= new Control();
	$control->setControlPorLlave('ANO_C');
	$anio=$control->getConsecutiv();
	$control->setControlPorLlave('CICLOACT');
	$ciclo_actual=$control->getConsecutiv();
	if(strlen($ciclo_actual)<2)
	{
		$ciclo_actual='0'.$ciclo_actual;
	}	
	$ciclo=$ciclo_actual.'/'.$anio;
	if(isset($_POST['carnet']))
	{		
		$carnet=$_POST['carnet'];
		$cnx=new MySQL();
		$query="UPDATE siai_obligaciones SET estado='1' WHERE usuario='$carnet';";
		$cnx->conectarse();
		$cnx->ejecutarQuery($query);
		$cnx->desconectarse();
		$query2="UPDATE asesoria SET MARCAR=1 WHERE CARNET = '$carnet'";
		//echo $query2;
		$cnx->conectarse();
		$cnx->ejecutarQuery($query2);
		$cnx->desconectarse();
		
		$query3="UPDATE siai_control SET solvente=1 WHERE usuario='$carnet' AND ciclo='$ciclo_actual' AND anio='$anio'";
		$cnx->conectarse();
		$cnx->ejecutarQuery($query3);
		$cnx->desconectarse();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Inscripción vía Internet</title>
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico">
<script type="text/javascript" src="js/Comunes.js"></script>
<script type="text/javascript" src="js/Sesion.js"></script>
<script type="text/javascript" src="js/Validaciones.js"></script>
<script type="text/javascript" src="js/md5.js"></script>
</head>
<body onresize="javascript: onResize();" onload="javascript: onResize();">
	<div id="general">
    	<div id="encabezado">
      		<div id="logo"></div>
        </div>
        <div id="contenido">
        <br />
        	<form action="" method="post">
            	Carnet: <input type="text" id="carnet" name="carnet" />
                <input type="submit" />
            </form>
        </div>	
    </div>
    <div id="ventana_emergente">
    	<div id="fondo"></div>
      	<div id="ventana">
        	<div id="barra_superior"><div id="mensaje_titulo"></div><div id="cerrar_ventana" onclick="javascript: ocultarVentana();"></div></div>
        	<div id="mensaje_texto">
            	<div class="boton">prueba</div>
            </div>
      	</div>    	
    </div>
</body>
</html>
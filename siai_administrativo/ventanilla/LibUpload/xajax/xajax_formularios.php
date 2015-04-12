<?php 
include_once("xajax/xajax_core/xajax.inc.php");

//Construimos el objeto xajax
$xajax=new xajax();
//funcion donde captuo los datos del formulario

function captura_datos($datos_f){
	
	//creo el objeto response
	$respuesta= new xajaxResponse();
	//validacion de datos
	if(empty($datos_f["nombre"])){
		$error="debe de colocar el nombre";
		$respuesta->assign("div_msn","innerHTML",$error	);
	return $respuesta;
		}
	if(empty($datos_f["apellido"])){
		$error="debe de colocar el apellido";
		$respuesta->assign("div_msn","innerHTML",$error	);
		return $respuesta;
		}	

	
	else{
//aqui captulo los datos que vien desde el formulario nombre y apellido
	$salida="nombre ".$datos_f["nombre"];
	$salida.="<br> apellido".$datos_f["apellido"];
	
	
	$respuesta->assign("div_msn","innerHTML",$salida);
	
	}
	return $respuesta;
	}
	
	function validacion(){
		
		//creo el objeto response
	$respuesta= new xajaxResponse();
	//validacion de datos
	if(empty($datos_f["nombre"])){
		$error="debe de colocar el nombre";
		$respuesta->assign("div_msn","innerHTML",$error	);
	return $respuesta;
		}
	if(empty($datos_f["apellido"])){
		$error="debe de colocar el apellido";
		$respuesta->assign("div_msn","innerHTML",$error	);
		return $respuesta;
		}	
		
		}
	
	//registrando el metodo
	$xajax->registerFunction("captura_datos");
	$xajax->registerFunction("validacion");
	$xajax->processRequest();
		
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $xajax->printJavascript("xajax/")?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form id="frn1" name="frn1" method="post" action="">
  <p>Nmbre 
    <label for="nombre"></label>
  <input type="text" name="nombre" id="nombre" onblur="xajax_validacion(xajax.getFormValues('frn1'));" />
  </p>
  <p>Apellidos 
    <label for="apellido"></label>
    <input type="text" name="apellido" id="apellido"  onblur="xajax_validacion(xajax.getFormValues('frn1'));"/>
  </p>
  <p><input type="button"  value="Agregar" onclick="xajax_captura_datos(xajax.getFormValues('frn1'));"/></p>
</form>
<div id="div_msn">
</div>
</body>

</html>
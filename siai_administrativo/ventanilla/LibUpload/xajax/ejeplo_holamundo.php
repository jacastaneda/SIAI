<?php 
include_once("xajax/xajax_core/xajax.inc.php");

//Construimos el objeto xajax
$xajax=new xajax();

function cambia_texto($texto){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	
	//xajaxResponse()
	//addAssign
	//ahora asignamos el dato a un elemento HTML
	// $respuesta->addAssingn("id del Html(Div,tabla,boton etc)",);
	$respuesta->assign("mensaje","innerHTML",$texto);
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	return $respuesta;
	
	}
	
function tabla(){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$tablita="<table border=1> 
	<tr>  <td> Denys 1</td>   </tr>
	
	</table>";
	$respuesta->assign("tab","innerHTML",$tablita);
	return $respuesta;
	
	}	
	
	function borra_tabla(){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	$tablita="<table border=1> 
	<tr>  <td> Denys 1</td>   </tr>
	
	</table>";
	$respuesta->assign("tab","innerHTML","");
	return $respuesta;
	
	}	
	//despues de la funcion registramnos la funcion con xajax
	$xajax->registerFunction("cambia_texto");
	$xajax->registerFunction("tabla");
	$xajax->registerFunction("borra_tabla");
	//y ahora procesamos las funciones XAjax
	//$xajax->processRequest();
	$xajax->processRequest();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
//imprimirmos en los encabezados el xajax
//$xajax->printJavascript("xajax/");
$xajax->printJavascript("xajax/"); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<input type="button"  value="Enviar" onclick="xajax_cambia_texto('hola');" />
</body>
<div id="mensaje">
</div>
<br />
<input type="button"  onclick="xajax_tabla();" value="Generar Tabla"/>
<input type="button"  onclick="xajax_borra_tabla();" value="Borrar"/>
<div id="tab"> </div>
</html>
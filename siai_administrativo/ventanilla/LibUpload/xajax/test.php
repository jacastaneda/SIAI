<?php 

include_once("xajax/xajax_core/xajax.inc.php");

//Construimos el objeto xajax
$xajax=new xajax();

function cambia_texto($texto){
	//lo primero que hacemos xajaxreponse(); para generar la respuesta
	$respuesta=  new xajaxResponse();
	//unlink("savefiles/".$texto);
	//xajaxResponse()
	//addAssign
	//ahora asignamos el dato a un elemento HTML
	// $respuesta->addAssingn("id del Html(Div,tabla,boton etc)",);
	$respuesta->assign("ddd","innerHTML",unlink("savefiles/".$texto));

    // unlink("savefiles/".$texto);
	//$respuesta->addAssign("respuesta","innerHTML",$salida); 
	return $respuesta;
	
	}
	$xajax->registerFunction("cambia_texto");
	$xajax->processRequest();
//cambia_texto("555053_424923374191002_217282281621780_1852481_565006252_n.jpg");


?><head><?php 
$xajax->printJavascript("xajax/"); ?>
</head>

</div>
	


<div id="ddd">

</div>
<input type="button"  value="Enviar" onclick="xajax_cambia_texto('test.txt');" />
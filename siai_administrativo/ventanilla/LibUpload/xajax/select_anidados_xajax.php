<?php  include_once("xajax/xajax_core/xajax.inc.php");

//Construimos el objeto xajax
$xajax=new xajax(); 


function select_combinado($id_depto){
	
	$san_salavdor=array("sal1","sal2","sal3");
	$santaanana=array("santa1","santa2","santal3");
	$sonsonate=array("sonso1","sonso2","sonso3");
	$depto=array($san_salavdor,$santaanana,$sonsonate);
	
	}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label for="depto"></label>
  <select name="depto" id="depto">
    <option value="0">San salvador</option>
    <option value="1">San Ana</option>
    <option value="2">Sonsonate</option>
  </select>
</form>
</body>
</html>
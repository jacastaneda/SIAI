<?php session_start();
$ok=0;
if($_POST["lst_horarios"]<>-1 and $_POST["accion"]=="accion"){
	
	//realizo la busqueda para qu eno agreguen repetidas
	
				if(strpos($_SESSION["S_horarios"], $_POST["lst_horarios"]))
					{
						$ok=1;
					}
				
			    
		
	
		if($ok==0)
			{ 
				$_SESSION["S_horarios"]=$_SESSION["S_horarios"]."-".$_POST["lst_horarios"]; 
			}
		
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<br />
<div style="width:400px">
<table width="330" border="1" class="table table-bordered table-hover">
  <tr>
    <td width="135">Horario</td>
    <td width="179">Eliminar</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><?php echo trim($_SESSION["S_horarios"],"-"); ?></td>
    <td><button class="btn" onclick="EliminarFranja();">Eliminar</button></td>
  </tr>
</table>
</div>
</body>
</html>
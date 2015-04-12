<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 
include("clases/ClassUsuario.php");

$usuario=new ClassUsuario(); //crear Objeto

/****************************************************************
	Actualizar Usuario
*****************************************************************/

/* $usuario->setNombres("denys");
$usuario->setApellidos("Urquilla2");
$usuario->setCorreo("turtlehacaaaak@hotmail.com");
$usuario->setEstado(1);
$usuario->setPassword(md5("root1"));
$usuario->setRol(1);
$usuario->setUsuario("denys"); //nombre del identificador del usuario
$usuario->actualizarUsuario();	 */


$usuario->setNombres($_POST["txtNombres"]);
$usuario->setApellidos($_POST["txtApellidos"]);
$usuario->setCorreo($_POST["txtCorreo"]);
$usuario->setEstado($_POST["txtNombres"]);
$usuario->setPassword($_POST["txtPassword"]);
$usuario->setRol($_POST["txtRol"]);
$usuario->setUsuario($_POST["txtUsuario"]); //nombre del identificador del usuario
$usuario->actualizarUsuario();	

echo "La informacion se ha Actualizada corectamente";

?>
<br />
<a href="ObjetoMostrarUsuarios.php">Volver</a>
</body>
</html>
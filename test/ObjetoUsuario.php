<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 
include("clases/ClassUsuario.php");

$usuario=new ClassUsuario();

/****************************************************************
	Insertar usuarios
*****************************************************************/
$usuario->setNombres("denys");
$usuario->setApellidos("Urquilla");
$usuario->setCorreo("Denysurquilla@hotmail.com");
$usuario->setEstado(1);
$usuario->setPassword(md5("root"));
$usuario->setRol(1);
$usuario->setUsuario("denys4");

//$usuario->insertarUsuario();



/****************************************************************
	Actualizar Usuario
*****************************************************************/

$usuario->setNombres("denys");
$usuario->setApellidos("Urquilla2");
$usuario->setCorreo("turtlehack@hotmail.com");
$usuario->setEstado(1);
$usuario->setPassword(md5("root1"));
$usuario->setRol(1);
$usuario->setUsuario("denys");

$usuario->actualizarUsuario();	


/****************************************************************
	Eliminar Usuario
*****************************************************************/

$usuario->setUsuario("denys");
$usuario->EliminarUsuario();

/****************************************************************
	mostrando usuarios
*****************************************************************/

foreach ($usuario->MostrarUsuarios() as $user){
	
	echo "usuario :".$user["usuario"]."<br>";
	}

?>
</body>
</html>
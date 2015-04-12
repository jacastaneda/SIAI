<?php 
include("clases/ClassUsuario.php");

$usuario=new ClassUsuario(); //crear Objeto

/****************************************************************
	Eliminar Usuario
*****************************************************************/

$usuario->setUsuario($_GET["user"]); // Nombre del identifiador
$usuario->EliminarUsuario();

header("Location: ObjetoMostrarUsuarios.php ");

?>

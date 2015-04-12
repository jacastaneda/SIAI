<?php 
require_once("clases/ClassUsuario.php");

$usuario=new ClassUsuario(); //crear Objeto

/****************************************************************
	Insertar usuarios
*****************************************************************/

for($i=0;$i<1000000;$i++){
$usuario->setNombres("denys");
$usuario->setApellidos("Urquilla");
$usuario->setCorreo("Denysurquilla@hotmail.com");
$usuario->setEstado(1);
$usuario->setPassword(md5("root"));
$usuario->setRol(1);
$usuario->setUsuario("denys6");
$usuario->insertarUsuario(); //METODO QUE EJECUTA EL INSERT 
}


/*
$usuario->setNombres($_POST["txtNombres"]);
$usuario->setApellidos($_POST["txtApellidos"]);
$usuario->setCorreo("Denysurquilla@hotmail.com");
$usuario->setEstado($_POST["txtEstado"]);
$usuario->setPassword(md5($_POST["txtPassword"]));
$usuario->setRol($_POST["txtRol"]);
$usuario->setUsuario($_POST["txtUsuario"]);
$usuario->insertarUsuario(); //METODO QUE EJECUTA EL INSERT
header("Location: ObjetoMostrarUsuarios.php");*/
?>

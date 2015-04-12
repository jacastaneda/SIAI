<?php 
	$module_name = "Saliendo del Sistema...";
	session_start();
	session_destroy();
	header ("Location: ../index.php");
?>
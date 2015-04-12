<?php
session_start();
include_once('../clases/ClassConexion.php');
include_once('../clases/ClassSiaiUsuario.php');

$usuario=new SiaiUsuario();
$usuario->setSiaiUsuarioPorLlave($_GET['carnet']);
$verificador=md5($usuario->getEmail());
$usuario->setActivado(1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Inscripción vía Internet</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../favicon.ico">

<link href="../css/general.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="general">
    <?php if($verificador==$_GET['verificador']): ?>
		<?php if($usuario->updateSiaiUsuario()): ?>
            <script>alert("Usuario Activado con Exito");location.href="../index.php";</script>
        <?php else: ?>
            <script>alert("No se pudo realizar la activación del usuario, intentelo en otro momento");location.href="../index.php";</script>
        <?php endif;?>
    <?php else: ?>
		<script>alert("El verificador no coincide con el enviado");location.href="../index.php";</script>
    <?php endif;?>
	</div>
</body>
</html>
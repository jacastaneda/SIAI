<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet"  href="css/magic-bootstrap.css" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 
include("clases/ClassUsuario.php");
$usuario=new ClassUsuario(); //crear Objeto

?>
<br />
<hr />
<div class="container">
<form action="ObjetoActualizarUsuario.php" method="post" name="f1"  id="f1"> 
   
   <?php 
   foreach($usuario->MostrarUsuariosPorNombre($_GET["user"]) as $u){
   ?>
   <table width="424" border="0">
  <tr>
    <td width="171">Nombres</td>
    <td width="243"><input type="text" name="txtNombres" id="txtNombres" value="<?php echo $u["nombres"]; ?>"/></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><input type="text" name="txtApellidos" id="txtApellidos" value="<?php echo $u["apellidos"]; ?>"/></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><input type="text" name="txtUsuario" id="txtUsuario" value="<?php echo $u["usuario"]; ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="text" name="txtPassword" id="txtPassword" value="<?php echo $u["password"]; ?>" /></td>
  </tr>
  <tr>
    <td> Correo</td>
    <td><input type="text" name="txtCorreo" id="txtCorreo" value="<?php echo $u["correo"]; ?>"/></td>
  </tr>
  <tr>
    <td>Rol</td>
    <td><input type="text" name="txtRol" id="txtRol"  value="<?php echo $u["rol"]; ?>"/></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td><input type="text" name="txtEstado" id="txtEstado" value="<?php echo $u["estado"]; ?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Agregar Usuario" id="Agregar Usuario" value="Actualizar"  class="btn btn-success"/></td>
  </tr>
    </table>
    <?php }?>
</form>

</div>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/magic-bootstrap.css" type="text/css" />
<title>Documento sin título</title>
</head>

<body>
	<br />
    <div class="container">
    <form action="ObjetoInsertarUsuario.php" method="post" name="f1"  id="f1"> 
    <table width="424" border="0">
  <tr>
    <td width="171">Nombres</td>
    <td width="243"><input type="text" name="txtNombres" id="txtNombres" /></td>
  </tr>
  <tr>
    <td>Apellidos</td>
    <td><input type="text" name="txtApellidos" id="txtApellidos" /></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><input type="text" name="txtUsuario" id="txtUsuario" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="text" name="txtPassword" id="txtPassword" /></td>
  </tr>
  <tr>
    <td> Correo</td>
    <td><input type="text" name="txtCorreo" id="txtCorreo" /></td>
  </tr>
  <tr>
    <td>Rol</td>
    <td><input type="text" name="txtRol" id="txtRol" /></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td><input type="text" name="txtEstado" id="txtEstado" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Agregar Usuario" id="Agregar Usuario" value="Guadar Usuario"  class="btn btn-success"/></td>
  </tr>
    </table>
</form>
</div>

</body>
</html>
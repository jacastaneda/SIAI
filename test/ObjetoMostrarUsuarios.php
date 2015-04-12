<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet"  href="css/magic-bootstrap.css" type="text/css"/>
<title>Documento sin título</title>
</head>

<body>
<?php 
include("clases/ClassUsuario.php");

$usuario=new ClassUsuario(); //crear Objeto

/****************************************************************
	mostrando usuarios
*****************************************************************/

/* foreach ($usuario->MostrarUsuarios() as $user){
	
	echo "usuario :".$user["usuario"]."<br>";
	} */


?>
<br>
<div class="container">

<form>
<table width="489" border="0">
  <tr>
    <td width="103">Nombre</td>
    <td width="376"><input type="text" name="busqueda" id="busqueda" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Buscar" class="btn btn-success" /></td>
  </tr>
</table>

</form>

<table class="table table-bordered table-hover">
    <tr>
    	<td>
      <div align="center"><strong>Usuario </strong></div></td>
        <td>
      <div align="center"><strong>Correo </strong></div></td>
        <td>
      <div align="center"><strong>Nombres </strong></div></td>
        <td>
        <div align="center"><strong>Apellidos </strong></div></td>
        <td><div align="center"><strong>Actualizar</strong></div></td>
        <td><div align="center"><strong>Eliminar</strong></div></td>
    </tr>
    
  
  <!--Line donde se reproduce el codigo -->
  
  <?php
  if(is_array($usuario->MostrarUsuariosParametro($_REQUEST["busqueda"]))){
   foreach($usuario->MostrarUsuariosParametro($_REQUEST["busqueda"]) as $u){?>
    <tr bgcolor="#FFFFFF">
    	<td>
      <?php echo   $u["usuario"]; ?>
        </td>
        <td>
        <?php echo   $u["correo"]; ?>
        </td>
        <td>
        <?php echo   $u["nombres"]; ?>
        </td>
        
        
        
        
        
        
        
        
        
        
        
        <td>
       <?php echo   $u["apellidos"]; ?>
        </td>
        <td><div align="center"><a href="FrmActualizarUsuario.php?user=<?php echo $u["usuario"]; ?>" class="btn btn-info" >Actualizar</a></div></td>
        <td><div align="center"><a href="ObjetoEliminarUsuario.php?user=<?php echo $u["usuario"]; ?>" class="btn btn-danger">Eliminar</a></div></td>
    </tr>
    <?php }
  		}?>
</table>
</div>
</body>

</html>
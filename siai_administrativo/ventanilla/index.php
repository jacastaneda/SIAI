<?php  session_start();

include_once("../clases/ClassConexion.php");//clase a a conexion de base de datos
$cnx=new MySQL();




require_once("LibUpload/phpuploader/include_phpuploader.php"); 

if(($_SESSION["user"][0]["TIPO_USUAR"])==""){
	
	header ("Location: ../index.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script src="../bootstrap/js/jquery-1.8.3.js"></script>
<script src="../bootstrap/js/bootstrap-collapse.js"></script> 
<script src="../bootstrap/js/bootstrap-dropdown.js"></script> 
<script src="../bootstrap/js/bootstrap-modal.js"></script> 
<style>
body {
	padding-top: 150px;
}
</style>
<!-- InstanceBeginEditable name="doctitle" -->

<script type="text/javascript" src="js/cargaArchivo.js"> </script>

<script type="text/javascript" src="js/LibUpload.js">  </script>
<script type="text/javascript" src="js/UploadArchivo.js">  </script>
<title>SIAI</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

    <?php
    include('../menu.php');
    ?>


<div class="container">
	<div class=" well well-small"><!-- InstanceBeginEditable name="EditRegion3" -->
	  <h4>Carga de Pagos </h4>
	<!-- InstanceEndEditable --></div>

<div class="well"><!-- InstanceBeginEditable name="EditRegion4" -->
<div  align="center" id="correcto">
 
<center>
  <div id="msn_carga" style="display:none">
<img src="../xajax/img/cargando1.gif" width="300" height="230" />
</div>
<div > 
  <p><font size="+2"><strong>Seleccione Archivo</strong></font></p>
  <p>&nbsp;</p>
</div> 

<form action="javascript:void(null)" method="post" id="carga" name="carga">
  <table width="536" border="0" align="center">
 
    <tr>
      <td><table id="filelist" style='border-collapse: collapse' class='Grid' border='0' cellspacing='0' cellpadding='2'>
			</table>
      <input type="hidden" name="tam" id="tam" />
      <label for="archivos"></label>
      <input name="archivos" type="hidden" id="archivos" value="" />
      <input name="archivo" type="file"  id="archivo" size="35" /><br />
      <input name="cmdExport2" type="button" class="button" id="cmdExport2"  onClick="javascript:SubirArchivo();" value="Subir Archivo">
      <div id="msn"></div>
      </td>
    </tr>
  </table>
  <br />
  <p>
    <button type="submit" class="btn btn-success btn-large" onclick="cargaArchivo();" disabled="disabled" id="btnCarga" name="btnCarga">Cargar Datos  <span class="icon-ok-sign icon-white"></span></button>
  </p>
</form>
</center>
  
      <div id="Datos">
</div>      
</div>

<script src="../bootstrap/js/bootstrap-alert.js"></script>
<!-- InstanceEndEditable --></div>
<footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
<!-- InstanceEnd --></html>

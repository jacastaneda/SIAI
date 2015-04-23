<?php 
session_start();
require_once("../clases/ClassControl.php");
require_once("../clases/ClassHorarios.php");
$control=new ClassControl();
$horarios=new ClassHorarios();
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
<script src="js/horarios.js"></script> 
<script src="js/jquery-1.4.2.min.js"></script>
<script src="js/autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/autocomplete.css"></link>
<title>SIAI</title>

 <script>
            $(document).ready(function(){
                /* Una vez que se cargo la pagina , llamo a todos los autocompletes y
                 * los inicializo */
                $('.autocomplete').autocomplete();
            });
        </script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<?php
include('../menu.php');
?>

<div class="container">
	<div class=" well well-small"><!-- InstanceBeginEditable name="EditRegion3" -->Horarios<!-- InstanceEndEditable --></div>

<div class="well"><!-- InstanceBeginEditable name="EditRegion4" -->
	 <span id="s_guardado1"></span>
    <div class="row">
    	<div class="span4"> 
  <table width="380" border="0">
    <tr>
      <td width="142">CICLO</td>
      <td width="228"><input type="text" name="txt_CICLO" id="txt_CICLO"  value="<?php echo $control->CicloAnioActual(); ?>"/></td>
      </tr>
    <tr>
      <td>SECCION</td>
      <td><input type="text" name="txt_seccion" id="txt_seccion" /></td>
    </tr>
    <tr>
      <td>ASIGNATURA</td>
      <td><div class="autocomplete"><input type="text" name="txt_asignatura" id="txt_asignatura" data-source="search.php?search="  value=""/>
      		</div>
      </td>
    </tr>
    <tr>
      <td>HORARIOS</td>
      <td><select name="lst_horarios" id="lst_horarios">
      		<option value="-1">Seleccione Horario</option>
      		<?php foreach($horarios->MostrarHorarios() as $H)
					  {
						?>		
            <option value="<?php echo $H["CODIGO"]; ?>"><?php echo $H["NOMBRE"]; ?></option>
      			<?php }?>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><button class="btn btn-success" onclick="AgregarFranjaOrarios('accion');">Agregar Franja</button></td>
    </tr>
  </table>
  		</div>
        
        <div class="span4">
        	SECCIONES
  <table width="200" border="0">
  <tr>
    <td>AULA</td>
    <td><input type="text" name="txt_aulas" id="txt_aulas" /></td>
  </tr>
  <tr>
    <td>CUPOS</td>
    <td><input type="text" name="txt_cupos" id="txt_cupos" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
        </div>
  </div>
  <span id="S_Franja"></span>
  <hr />
  
<center><button class="btn btn-success" onclick="validarHorarios();">GUARDAR HORARIOS</button></center>
<!-- InstanceEndEditable --></div>
<footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
<!-- InstanceEnd --></html>

<script>
   $(document).ready( function()
   {
     AgregarFranjaOrarios();
   } );
</script>

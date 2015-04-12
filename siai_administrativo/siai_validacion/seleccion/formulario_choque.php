<?php
session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/ClassExpedientealumno.php");
include_once("../clases/ClassNotash.php");
include_once("../clases/ClassHorarios.php");
include_once("../clases/ClassHordetalle.php");
include_once("../clases/ClassSecciones.php");
include_once("../clases/ClassAsignatura.php");
include_once("../clases/ClassPrerrequisitos.php");
include_once("../clases/ClassCarrera.php");

$expediente=unserialize($_SESSION['siai']['expediente']);
$choque=unserialize($_SESSION['siai']['choque']);
$carrera=unserialize($_SESSION['siai']['carrera']);


?>
<?php if(count($choque)==1): ?>
<table width="85%" cellspacing="5px;">
	<tr>
    	<td width="20%" align="right">Nombre:</td>
        <td colspan="3"><input type="text" value="<?php echo $expediente->getNombres()." ".$expediente->getApellido1()." ".$expediente->getApellido2(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:100%" disabled></td>
    </tr>
    <tr>
    	<td align="right">Carné:</td>
        <td colspan="3"><input type="text" value="<?php echo $expediente->getCarnet(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:40%" disabled></td>
    </tr>
    <tr>
    	<td align="right">Carrera:</td>
        <td colspan="3"><input type="text" value="<?php echo $carrera->getNombre(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:100%" disabled></td>
    </tr>
    <tr>
    	<td align="right">Materia 1:</td>
        <td width="50%"><input type="text" value="<?php echo $choque[0][0]['asignatura']->getNombre(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:100%" disabled></td>
        <td width="20%" align="right">Sección:</td>
        <td width="10%"><input type="text" value="<?php echo $choque[0][0]['seccion']->getSeccion(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:100%" disabled></td>
    </tr>
    <tr>
    	<td align="right">Materia 2:</td>
        <td width="50%"><input type="text" value="<?php echo $choque[0][1]['asignatura']->getNombre(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:100%" disabled></td>
        <td width="20%" align="right">Sección:</td>
        <td width="10%"><input type="text" value="<?php echo $choque[0][1]['seccion']->getSeccion(); ?>" style="border-radius:10px; padding-left:10px; padding-right:10px; width:100%" disabled></td>
    </tr>
    <tr>
    	<td width="20%" align="right">Motivo:</td>
        <td colspan="3"><textarea style=" width:100%; height:100px; border-radius:10px;"></textarea></td>
    </tr>
</table>


<div style="width:250px; margin-left:400px;"><div class="boton" onclick="javascript: ocultarVentana();">Cancelar</div><div class="boton" onclick="javascript: verFormularioChoque();">Enviar</div></div>
<?php else: ?>
<p>Se han detectado multiples choques de horarios entre las materias, favor deseleccione una de las materias o seleccione un diferente horario para poder continuar con el proceso de inscripción.</p>
<div style="width:150px; margin-left:400px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>
<?php endif; ?>
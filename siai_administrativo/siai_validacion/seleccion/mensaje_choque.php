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

$choque=unserialize($_SESSION['siai']['choque']);

?>
<?php if(count($choque)==1): ?>
<p>Se ha detectado un choque de horarios entre las materias <b><?php echo $choque[0][0]['asignatura']->getNombre(); ?></b> y <b><?php echo $choque[0][1]['asignatura']->getNombre(); ?></b>, favor deseleccione una de las materias o seleccione un diferente horario para poder continuar con el proceso de inscripción.</p>

<p>Si necesita inscribir ambas materias con choque de horario deberá llenar un formulario de inscripción de materias con choque, inscribir las materias que no tienen choque de horario y esperar respuesta con la resolución en su correo.</p>

<p style="color:#770000;">¿Desea llenar formulario de solicitud de inscripción de materias con choque de horarios?</p>
<div style="width:250px; margin-left:400px;"><div class="boton" onclick="javascript: ocultarVentana();">No</div><div class="boton" onclick="javascript: verFormularioChoque();">Si</div></div>
<?php else: ?>
<p>Se han detectado multiples choques de horarios entre las materias, favor deseleccione una de las materias o seleccione un diferente horario para poder continuar con el proceso de inscripción.</p>
<div style="width:150px; margin-left:400px;"><div class="boton" onclick="javascript: ocultarVentana();">Aceptar</div></div>
<?php endif; ?>
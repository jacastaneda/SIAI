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
<p><img src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">Se han detectado multiples choques de horarios entre las materias, favor deseleccione una de las materias o seleccione un diferente horario para poder continuar con el proceso de inscripción.</p>
<?php else: ?>
<p><img src="assets/images/other_images/appbar.alert.png" class="lazy rounded_border hover_effect pull-left">Se han detectado multiples choques de horarios entre las materias, favor deseleccione una de las materias o seleccione un diferente horario para poder continuar con el proceso de inscripción.</p>
<?php endif; ?>
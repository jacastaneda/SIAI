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
	
	$horarios=unserialize($_SESSION['siai']['horarios']);
	if(isset($_GET['indice']))
	{
		$indice=$_GET['indice'];
	}
?>

<h1><?php echo $horarios[$indice]['asignatura']->getCodigo(); ?></h1>
<h2><?php echo $horarios[$indice]['asignatura']->getNombre(); ?></h2>
<?php for($i=0; $i<count($horarios[$indice]['seccion']); $i++):	?>
	<h3>Sección <?php echo $horarios[$indice]['seccion'][$i]->getSeccion(); ?></h3>
    <?php for($ii=0; $ii<count($horarios[$indice]['horario'][$i]); $ii++):	?>
    	<p><?php echo $horarios[$indice]['horario'][$i][$ii]->getNombre(); ?></p>
    <?php endfor; ?>
    <p> <?php if($horarios[$indice]['seccion'][$i]->getDisponible()>0): ?>Cupos Disponibles: <?php echo $horarios[$indice]['seccion'][$i]->getDisponible(); ?><?php else: ?><b style="color:#CC0000">Cupo Agotado</b><?php endif; ?></p>
<?php endfor; ?>
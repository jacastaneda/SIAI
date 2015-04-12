<?php
	session_start();
	include_once("clases/ClassConexion.php");
	include_once("clases/ClassControl.php");
	include_once("clases/ClassExpedientealumno.php");
	include_once("clases/ClassAsesoria.php");
	include_once("clases/ClassCarrera.php");
	/*
	if(($_SESSION["user"][0]["TIPO_USUAR"])==""){
		header ("Location: index.php");
	}
	*/
	$control= new Control();
	$control->setControlPorLlave('ANO_C');
	$anio=$control->getConsecutiv();
	$control->setControlPorLlave('CICLOACT');
	$ciclo_actual=$control->getConsecutiv();
	
	$asesoria=new Asesoria();
	$carnets=$asesoria->getPendientesAprobacion(0);
	$pendientes;
	for($i=0;$i<count($carnets);$i++)
	{		
		$expediente=new Expedientealumno();
		$expediente->setExpedientealumnoPorLlave($carnets[$i]['CARNET']);
		$carrera=new Carrera();
		$carrera->setCarreraPorLlave($expediente->getCodcarrera());
		$pendientes[$i][0]=$expediente->getCarnet();
		$pendientes[$i][1]=$expediente->getNombres().' '.$expediente->getApellido1().' '.$expediente->getApellido2();
		$pendientes[$i][2]=$carrera->getNombre();
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado de inscripciones pendientes de aprobación</title>
<style type="text/css">
	#general{
		position:relative;
		width:960px;
		margin-left:auto;
		margin-right:auto;
	}
	table tr th{
		background-color:#0066CC;
		color:#FFFFFF;
	}
	table .fill{
		background-color:#D8E9FF
	}
	h1{
		font-size:18px;
		text-align:center;
		color:#000066;
	}
	#general .opciones{
		text-align:center;
	}
	#general .opcion{
		margin-left:5px;
		margin-right:5px;
	}
</style>
</head>

<body>

<div id="general">
	<h1>Inscripciones pendientes de aprobación</h1>
	<table width="800" border="1" align="center" >
    	<tr>
			<th width="10%">Carné</th>
            <th width="40%">Nombre Completo</th>
            <th width="30%">Carrera</th>
            <th width="20%">Opciones</th>
        </tr>
        <?php
			$fill=true;
			for($i=0;$i<count($pendientes);$i++): ?>
        <tr <?php if($fill){ echo 'class="fill"'; $fill=false;}else{$fill=true;} ?>>
        		<td><?php echo $pendientes[$i][0]; ?></td>
                <td><?php echo $pendientes[$i][1]; ?></td>
                <td><?php echo $pendientes[$i][2]; ?></td>
                <td class="opciones"><a href="detalle_inscripcion.php?estudiante=<?php echo $pendientes[$i][0]; ?>"><img src="imagenes/btn_detalle.png" class="opcion" title="Ver detalle de inscripción" border="0"/></a><a href="pdf/pensum.php?estudiante=<?php echo $pendientes[$i][0]; ?>" target="_blank"><img src="imagenes/btn_pensum_mini.png" class="opcion" title="Ver pensum del alumno" /></a></td>
        </tr>
        <?php endfor; ?>
    </table>
</div>

</body>
</html>
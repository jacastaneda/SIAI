<?php 
	session_start();
	include_once("clases/ClassConexion.php");
	include_once("clases/MetodosComunes.php");
	include_once("clases/ClassControl.php");
	include_once("clases/ClassExpedientealumno.php");
	include_once("clases/ClassAsignatura.php");
	include_once("clases/ClassAsesoria.php");
	include_once("clases/ClassAranceles.php");
	include_once("clases/ClassSiaiUsuario.php");
	include_once("clases/ClassSiaiControl.php");
	include_once("clases/ClassSiaiObligaciones.php");
	include_once("clases/ClassCarrera.php");
	include_once("clases/ClassFacultades.php");
	/*
	if(($_SESSION["user"][0]["TIPO_USUAR"])==""){
		header ("Location: index.php");
	}
	*/
	
	$carnet=$_GET['estudiante'];
	
	$control= new Control();
	$control->setControlPorLlave('ANO_C');
	$anio=$control->getConsecutiv();
	$control->setControlPorLlave('CICLOACT');
	$ciclo_actual=$control->getConsecutiv();
	
	$expediente=new Expedientealumno();
	$expediente->setExpedientealumnoPorLlave($carnet);
	
	$siaiusuario=new SiaiUsuario();
	$siaiusuario->setSiaiUsuarioPorLlave($carnet);
	
	$siaiControl=new SiaiControl();
	$siaiControl->setPorAtributos($siaiusuario->getUsuario(), $ciclo_actual, $anio);

	$carrera=new Carrera();
	$carrera->setCarreraPorLlave($expediente->getCodcarrera());
	
	$facultad=new Facultades();
	$facultad->setFacultadesPorLlave($carrera->getFacultad());
	
	$siaiobligacion=new SiaiObligaciones();
	$iObligaciones=true;
	if($lista=$siaiobligacion->listaPorAtributos($ciclo_actual,$anio,$siaiusuario->getUsuario()))
	{
		for($i=0; $i<count($lista);$i++)
		{
			$siaiobligaciones[$i]=new SiaiObligaciones();
			$siaiobligaciones[$i]->setSiaiObligacionesPorLlave($lista[$i]);
			if($siaiobligaciones[$i]->getEstado()==0)
			{
				$iObligaciones=false;				
			}
		}		
	}
	
	
	$iAprobacion=true;
	$asesoria=new Asesoria();
	$listaAsignaturas=$asesoria->getListadoAsignaturas($expediente->getCarnet(), $anio.'-01-01 00:00:00');
	for($i=0; $i<count($listaAsignaturas); $i++)
	{			
		$seleccion[$i]['asesoria']=new Asesoria();
		$seleccion[$i]['asesoria']->setAsesoriaPorLlave($expediente->getCarnet(), $listaAsignaturas[$i][0], $listaAsignaturas[$i][1]);
		$seleccion[$i]['asignatura']=new Asignatura();
		$seleccion[$i]['asignatura']->setAsignaturaPorLlave($seleccion[$i]['asesoria']->getCodigoAsi());
		if($seleccion[$i]['asesoria']->getMarcar()==0)
		{
			$iAprobacion=false;
		}
		if($seleccion[$i]['asesoria']->getArancel()!='')
		{
			$seleccion[$i]['arancel']=new Aranceles();
			$seleccion[$i]['arancel']->setArancelesPorLlave($seleccion[$i]['asesoria']->getArancel());
			//echo $seleccion[$i]['arancel']->getValor();
		}
	}
	
	$_SESSION['sai']['seleccion']=serialize($seleccion);
	$_SESSION['sai']['siaicontrol']=serialize($siaiControl);
	$_SESSION['sai']['siaiusuario']=serialize($siaiusuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
	table tr td{
		text-align:center;
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
	#general input{
		margin-left:10px;
		margin-right:10px;
	}
</style>
</head>

<body>
	<div id="general">
        <p><b>CARNET:</b><?php echo $expediente->getCarnet(); ?> <b>NUI:</b><?php echo $expediente->getNui();?></p>
        <p><b>NOMBRE DEL ESTUDIANTE:</b> <?php echo $expediente->getApellido1().' '.$expediente->getApellido2().', '.$expediente->getNombres(); ?></p>
        <a href="pdf/pensum.php?estudiante=<?php echo $expediente->getCarnet(); ?>" target="_blank">Ver Pensum PDF</a>
        <p><b>CARRERA:</b> <?php echo $carrera->getNombre().',  '.$facultad->getNombre(); ?></p>
        <p><b>CUM:</b> <?php echo $expediente->getCumGeneral(); ?></p>
        <table width="800" border="1" align="center" >
            <tr>
                <th width="15%">CODIGO</th>
                <th width="10%">UV</th>
                <th width="15%">MATRICULA</th>
                <th width="40%">NOMBRE DE ASIGNATURA</th>
                <th width="10%">SECCIÓN</th>
                <th width="10%">ARANCEL</th>
            </tr>
            <?php
                $fill=true;
                for($i=0; $i<count($seleccion);$i++):
			?>
            <tr <?php if($fill){ echo 'class="fill"'; $fill=false;}else{$fill=true;} ?>>
                    <td><?php echo $seleccion[$i]['asesoria']->getCodigoasi(); ?></td>
                    <td><?php echo $seleccion[$i]['asignatura']->getUnidadvalo(); ?></td>
                    <td><?php echo $seleccion[$i]['asesoria']->getMatricula(); ?></td>
                    <td><?php echo $seleccion[$i]['asignatura']->getNombre(); ?></td>
                    <td><?php echo $seleccion[$i]['asesoria']->getSeccion(); ?></td>
                    <?php if(isset($seleccion[$i]['arancel'])): ?>
                    	<td><?php echo $seleccion[$i]['arancel']->getValor(); ?></td>
                    <?php else: ?>
                    	<td>0.00</td>
                    <?php endif; ?>
            </tr>
            <?php endfor; ?>
        </table>
        <br />
        <input type="button" value="Validar Inscripción" onclick="javascript: if(confirm('Esta a punto de validar la inscripción de asignaturas del estudiante <?php echo $expediente->getApellido1().' '.$expediente->getApellido2().', '.$expediente->getNombres(); ?> . \nEste proceso es irrebercible por lo cual debe verificar que el estudiante sea el correcto. \n¿Esta seguro que desea inscribir al estudiante seleccionado?')){location.href='validar_inscripcion.php'}" /><input type="button" value="X Anular Inscripción" onclick="javascript: if(confirm('Esta a punto de ANULAR la inscripción de asignaturas del estudiante <?php echo $expediente->getApellido1().' '.$expediente->getApellido2().', '.$expediente->getNombres(); ?> . \nEste proceso es irrebercible por lo cual debe verificar que el estudiante sea el correcto. \n\n¿Esta seguro que desea ANULAR la inscripción del estudiante seleccionado?')){location.href='anular_inscripcion.php'}" />
    </div>
</body>
</html>
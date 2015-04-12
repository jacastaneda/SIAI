<?php
session_start();
include_once('../clases/ClassConexion.php');
include_once('../clases/ClassSiaiUsuario.php');
include_once('../clases/ClassExpedienteAlumno.php');
include_once('../clases/ClassCarrera.php');
include_once('../clases/ClassSiaiControl.php');
include_once('../clases/ClassControl.php');

$usuario=new SiaiUsuario();
$siaiControl=new SiaiControl();

$control= new Control();
$control->setControlPorLlave('ANO_C');
$anio=$control->getConsecutiv();
$control->setControlPorLlave('CICLOACT');
$ciclo_actual=$control->getConsecutiv();

if(isset($_GET['usuario']) && isset($_GET['contrasena']))
{
	if($usuario->loginAlumno($_GET['usuario'],$_GET['contrasena']))
	{
		if($usuario->getActivado())
		{
			if(!$siaiControl->setPorAtributos($usuario->getUsuario(),$ciclo_actual,$anio))
			{
				$siaiControl->setUsuario($usuario->getUsuario());
				$siaiControl->setPaso(0);
				$siaiControl->setAnio($anio);
				$siaiControl->setCiclo($ciclo_actual);
				$siaiControl->setSaldo(0);
				$siaiControl->setTotalPagar(0);
				$id=$siaiControl->insertSiaiControl();
				$siaiControl->setIdControl($id);
			}
			$expediente= new Expedientealumno();
			$_SESSION['siai']['carnet']=strtoupper($usuario->getCarnet());
			$expediente->setExpedientealumnoPorLlave($_SESSION['siai']['carnet']);
			
			$carrera= new Carrera();
			$carrera->setCarreraPorLlave($expediente->getCodcarrera());
			$_SESSION['siai']['control']=serialize($siaiControl);
			$_SESSION['siai']['expediente']=serialize($expediente);
			$_SESSION['siai']['carrera']=serialize($carrera);
			$_SESSION['siai']['usuario']=serialize($usuario);
			echo "resultadosiai=0";
		}
		else
		{
			echo "resultadosiai=2";
		}
	}
	else
	{
		echo "resultadosiai=1";
	}	
}
else
{
	echo "resultadosiai=1";
}
?>
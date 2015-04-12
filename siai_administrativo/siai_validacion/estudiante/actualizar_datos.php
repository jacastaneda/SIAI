<?php
	session_start();
	include_once("../clases/ClassConexion.php");
	include_once("../clases/ClassExpedientealumno.php");
	include_once('../clases/ClassSiaiUsuario.php');
	include_once('../clases/ClassSiaiControl.php');

	$expediente=unserialize($_SESSION['siai']['expediente']);
	$siaiControl=unserialize($_SESSION['siai']['control']);
	$comentario=$expediente->getObservacio();
	$comentario=explode("\n",$comentario);
	$usuario_estudiante=unserialize($_SESSION['siai']['usuario']);
	
	function validarEmail($texto){   
		if(preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $texto, $email, PREG_OFFSET_CAPTURE))   	{
			return $email;   
		}
		else
		{
			return false;
		}
	}
	
	
	if(isset($_GET['dircasa']) && isset($_GET['telcasa']) && isset($_GET['email']) && isset($_GET['empresa'])  && isset($_GET['dirtrabajo']) && isset($_GET['teltrabajo']))
	{
		
		echo urldecode($_GET['email']);
		$usuario_estudiante->setEmail(urldecode($_GET['email']));
		$dirCasa=urldecode($_GET['dircasa']);
		$telCasa=urldecode($_GET['telcasa']);
		$empresa=urldecode($_GET['empresa']);
		$dirTrabajo=urldecode($_GET['dirtrabajo']);
		$telTrabajo=urldecode($_GET['teltrabajo']);
		$expediente->setDireccion($dirCasa);
		$expediente->setTelefono($telCasa);
		$expediente->setObservacio($nueva_observacion);
		$expediente->setLugartraba($empresa);
		$expediente->setDirtrabajo($dirTrabajo);
		$expediente->setTeltrabajo($telTrabajo);
		if($expediente->updateExpedientealumno())
		{
			if($siaiControl->getPaso()==1)
			{
				$siaiControl->setPaso(2);
				$siaiControl->updateSiaiControl();
				$_SESSION['siai']['control']=serialize($siaiControl);
			}
			$_SESSION['siai']['expediente']=serialize($expediente);
			echo $usuario_estudiante->updateSiaiUsuario();
			$_SESSION['siai']['usuario']=serialize($usuario_estudiante);
			echo "resultadosiai=1";
		}
		else
		{
			echo "resultadosiai=0";
		}		
	}
	else
	{
		echo $_GET['telcasa'];
	}


?>
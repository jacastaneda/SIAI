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
                    $expediente= new Expedientealumno();
                    $_SESSION['siai']['carnet']=strtoupper($usuario->getCarnet());
                    $expediente->setExpedientealumnoPorLlave($_SESSION['siai']['carnet']);

                    $carrera= new Carrera();
                    $carrera->setCarreraPorLlave($expediente->getCodcarrera());
 
                    $control=$siaiControl->setPorAtributos($usuario->getUsuario(),$ciclo_actual,$anio);
                    $paso=0;
                    if($control !== FALSE)
                    {
                        $paso=$siaiControl->getPaso();
                    }
//                    print_R($control);
                    if(($control !== FALSE) && $paso >= 3)
                    {
                        echo "resultadosiai=0";
                        $_SESSION['siai']['control']=serialize($siaiControl);
                        $_SESSION['siai']['expediente']=serialize($expediente);
                        $_SESSION['siai']['carrera']=serialize($carrera);
                        $_SESSION['siai']['usuario']=serialize($usuario);                           
                    }
                    else//si no ha hecho reserva
                    {
                        if($control === FALSE) //crear control
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
                        //si existe una franja de horario configurada para la carrera del alumno que ingresa    
                        if($usuario->loginFranjaCarreraAlumno($expediente->getCodcarrera()))
                        {
                            echo "resultadosiai=0";
                            $_SESSION['siai']['control']=serialize($siaiControl);
                            $_SESSION['siai']['expediente']=serialize($expediente);
                            $_SESSION['siai']['carrera']=serialize($carrera);
                            $_SESSION['siai']['usuario']=serialize($usuario);                                
                        }
                        else// si no hay una franja configurada
                        {
                            echo "resultadosiai=3";
                        }
                    }
                                             
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
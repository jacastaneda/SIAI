<?php
session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/MetodosComunes.php");
include_once("../clases/ClassExpedientealumno.php");
include_once("../clases/ClassAsignatura.php");
include_once("../clases/ClassPlanes.php");
include_once("../clases/ClassNotash.php");
include_once("../clases/ClassCarrera.php");
include_once("../clases/ClassPrerrequisitos.php");
include_once("../clases/ClassProcSolicituddeequivalencia.php");
include_once("pdf.php");

if(isset($_SESSION['siai']['expediente']))
{	
	$expediente=unserialize($_SESSION['siai']['expediente']);
	$plan=new Planes();
	$asignaturas=$plan->getListadoAsignaturasPorPlan($expediente->getCodigoPla());
	$ii=0;
	for($i=0; $i<count($asignaturas);$i++)
	{
		$plan->setPlanesPorLlaves($expediente->getCodigoPla(),$asignaturas[$i]);
		$n=$plan->getCiclo()-1;
		if($nprevio!=$n)
		{
			$ii=0;
			$nprevio=$n;
		}			
		$planes[$n][$ii]= new Planes();
		$asignatura[$n][$ii]=new Asignatura();
		$asignatura[$n][$ii]->setAsignaturaPorLlave($asignaturas[$i]);
		$prerrequisito=$asignatura[$n][$ii]->getPrerequisito($asignaturas[$i],$expediente->getCodigoPla());
		$prerrequisitos[$n][$ii]=new Planes();
		$prerrequisitos[$n][$ii]->setPlanesPorLlaves($expediente->getCodigoPla(),$prerrequisito);
		$planes[$n][$ii]->setPlanesPorLlaves($expediente->getCodigoPla(),$asignaturas[$i]);
		$ii++;
	}
	
	$notash = new Notash();
	$materias=$notash->getListadoMateriasAprobadas($expediente->getCarnet());
	for($i=0; $i<count($materias); $i++)
	{
		$materias_aprobadas[$materias[$i]]=true;
		$tipo_inscripcion[$materias[$i]]=$notash->getTipoInscripciones($expediente->getCarnet(),$materias[$i]);
		
	}
	$equivalencias=new ProcSolicitudequivalencia();
	$materias=$equivalencias->getListadoEquivalenciasPropuestas($expediente->getCarnet());
	for($i=0; $i<count($materias); $i++)
	{
		$equivalencias_propuestas[$materias[$i]]=true;
	}
	
	
	$carrera= new Carrera();
	$carrera->setCarreraPorLlave($expediente->getCodcarrera());
	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->setEncabezado('UNIVERSIDAD POLITÉCNICA DE EL SALVADOR',utf8_decode($carrera->getNombre()));
	$pdf->setPie($expediente->getCarnet());
	
	$pdf->AliasNbPages();
	$pdf->AddPage('L','Letter');
	$pdf->SetFont('Arial','',8);
	
	for($ii=0;$ii<5;$ii++)
	{
		$pdf->SetFont('Arial','',8);
		for($i=0;$i<10;$i++)
		{
			if(isset($planes[$i][$ii]))
			{
				if($materias_aprobadas[$planes[$i][$ii]->getAsignatura()])
				{
					
					if($tipo_inscripcion[$planes[$i][$ii]->getAsignatura()]==6)
					{
						$pdf->setFillColor(245,236,102);
					}
					else
					{
						$pdf->setFillColor(179,195,140);
					}					
				}
				else
				{
					if($equivalencias_propuestas[$planes[$i][$ii]->getAsignatura()])
					{
						$pdf->setFillColor(130,140,230);
					}
					else
					{
						$pdf->setFillColor(255,255,255);
					}
					
				}
				$pdf->Cell(12,5,$planes[$i][$ii]->getCorrelativ(),'LRT',0,'C',1);
				$pdf->Cell(12,5,$asignatura[$i][$ii]->getUnidadvalo(),'LRT',0,'C',1);		
				$pdf->Cell(2,5,'',0,0,'C',0);
			}			
		}
		$pdf->Ln();
		for($i=0;$i<10;$i++)
		{
			if(isset($planes[$i][$ii]))
			{
				if($materias_aprobadas[$planes[$i][$ii]->getAsignatura()])
				{
					
					if($tipo_inscripcion[$planes[$i][$ii]->getAsignatura()]==6)
					{
						$pdf->setFillColor(245,236,102);
					}
					else
					{
						$pdf->setFillColor(179,195,140);
					}					
				}
				else
				{
					if($equivalencias_propuestas[$planes[$i][$ii]->getAsignatura()])
					{
						$pdf->setFillColor(130,140,230);
					}
					else
					{
						$pdf->setFillColor(255,255,255);
					}
					
				}
				$pdf->Cell(24,5,$planes[$i][$ii]->getAsignatura(),'LRT',0,'C',1);
				$pdf->Cell(2,5,'',0,0,'C',0);	
			}			
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',6);
		for($i=0;$i<10;$i++)
		{
			if(isset($planes[$i][$ii]))
			{
				$nombres=$asignatura[$i][$ii]->getNombre();
				$nombre='';
				$pNombre=explode(' ',$nombres);
				if(strlen($nombres)>14)
				{
					for($iNombre=0;$iNombre<count($pNombre);$iNombre++)
					{
						if((strlen($pNombre[$iNombre])+strlen($nombre))>14)
						{
							if(strlen($nombre)>=12)
							{
								$iCorte[$i][$ii]=strlen($nombre);
								
							}
							else
							{
								$iCorte[$i][$ii]=14;
								$nombre.=' '.$pNombre[$iNombre];
								$nombre=substr($nombres,0,14).'-';
							}
							$parte=$nombre;
						}
						else
						{
							$nombre.=' '.$pNombre[$iNombre];
						}
							
					}
				}
				else
				{
					$parte=$nombres;
				}
				if($materias_aprobadas[$planes[$i][$ii]->getAsignatura()])
				{
					
					if($tipo_inscripcion[$planes[$i][$ii]->getAsignatura()]==6)
					{
						$pdf->setFillColor(245,236,102);
					}
					else
					{
						$pdf->setFillColor(179,195,140);
					}					
				}
				else
				{
					if($equivalencias_propuestas[$planes[$i][$ii]->getAsignatura()])
					{
						$pdf->setFillColor(130,140,230);
					}
					else
					{
						$pdf->setFillColor(255,255,255);
					}
					
				}
				$pdf->Cell(24,4,$parte,'LR',0,'C',1);
				$pdf->Cell(2,4,'',0,0,'C',0);
				
			}			
		}
		$pdf->Ln();	
		for($i=0;$i<10;$i++)
		{
			if(isset($planes[$i][$ii]))
			{
				$nombres=$asignatura[$i][$ii]->getNombre();
				if(strlen($nombres)>14)
				{
					$nombres=substr($nombres,$iCorte[$i][$ii]-1,strlen($nombres));
					$nombre='';
					$pNombre=explode(' ',$nombres);
					if(strlen($nombres)>14)
					{
						$parte=substr($nombres,0,12).'...';
					}
					else
					{
						$parte=$nombres;
					}
				}
				else
				{
					$parte='';
				}
				if($materias_aprobadas[$planes[$i][$ii]->getAsignatura()])
				{
					
					if($tipo_inscripcion[$planes[$i][$ii]->getAsignatura()]==6)
					{
						$pdf->setFillColor(245,236,102);
					}
					else
					{
						$pdf->setFillColor(179,195,140);
					}					
				}
				else
				{
					if($equivalencias_propuestas[$planes[$i][$ii]->getAsignatura()])
					{
						$pdf->setFillColor(130,140,230);
					}
					else
					{
						$pdf->setFillColor(255,255,255);
					}
					
				}
				$pdf->Cell(24,4,$parte,'LR',0,'C',1);
				$pdf->Cell(2,4,'',0,0,'C',0);
				
			}			
		}
		$pdf->Ln();	
		$pdf->SetFont('Arial','',8);
		for($i=0;$i<10;$i++)
		{
			if(isset($planes[$i][$ii]))
			{
				if($materias_aprobadas[$planes[$i][$ii]->getAsignatura()])
				{
					
					if($tipo_inscripcion[$planes[$i][$ii]->getAsignatura()]==6)
					{
						$pdf->setFillColor(245,236,102);
					}
					else
					{
						$pdf->setFillColor(179,195,140);
					}					
				}
				else
				{
					if($equivalencias_propuestas[$planes[$i][$ii]->getAsignatura()])
					{
						$pdf->setFillColor(130,140,230);
					}
					else
					{
						$pdf->setFillColor(255,255,255);
					}
					
				}
				$pdf->Cell(24,5,$prerrequisitos[$i][$ii]->getCorrelativ(),1,0,'C',1);	
				$pdf->Cell(2,5,'',0,0,'C',0);
			}			
		}
			
		$pdf->Ln(7);
		
	}
	$pdf->Image('imagenes/pensum_detalle.png',100,$pdf->GetY()+5,160,20,'PNG');
	

	$pdf->Output();	
}
?>
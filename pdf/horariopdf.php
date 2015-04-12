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
include_once("pdf.php");

if(isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['clases']))
{
	$expediente=unserialize($_SESSION['siai']['expediente']);
	$clases=unserialize($_SESSION['siai']['clases']);
	
	for($i=0;$i<=count($clases);$i++)
	{
		$dia=(int)$clases[$i]['hora'][0];
		$hora=(int)$clases[$i]['hora'][1];
		$horario[$dia][$hora]=$i;
	}
	
	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->setEncabezado('Universidad Politécnica de El Salvador','Horario de clases personal');
	$pdf->setPie($expediente->getCarnet());
	
	$pdf->AliasNbPages();
	$pdf->AddPage('L','Letter');
	$pdf->SetFont('Times','B',12);
	$pdf->SetFillColor(224,235,255);
	$pdf->Cell(35,6,utf8_decode('LUNES'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('MARTES'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('MIERCOLES'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('JUEVES'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('VIERNES'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('SÁBADO'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('DOMINGO'),1,0,'C',1);
	$pdf->Ln();
	for($iHoras=1;$iHoras<=8;$iHoras++)
	{
		if(isset($horario[1][$iHoras]) || isset($horario[2][$iHoras]) || isset($horario[3][$iHoras]) || isset($horario[4][$iHoras]) || isset($horario[5][$iHoras]) || isset($horario[6][$iHoras]) || isset($horario[7][$iHoras]))
		{
			$pdf->SetFont('Times','B',8);
			for($iDias=1;$iDias<=7;$iDias++)
			{
				if(isset($horario[$iDias][$iHoras]))
				{
					if(strlen($clases[$horario[$iDias][$iHoras]]['asignatura']->getNombre())<18)
					{
						$texto=$clases[$horario[$iDias][$iHoras]]['asignatura']->getNombre();
					}
					else
					{
						$texto=substr($clases[$horario[$iDias][$iHoras]]['asignatura']->getNombre(),0,17).'...';
					}
					$pdf->Cell(35,6,utf8_decode($texto),'LTR',0,'L');
					
				 $clases[$horario[$iDias][$iHoras]]['horario']->getNombre();
				 $clases[$horario[$iDias][$iHoras]]['seccion']->getSeccion();
				}
				else
				{
					$pdf->Cell(35,6,'','LTR',0,'L');
				}
				
			}
			$pdf->Ln();
			$pdf->SetFont('Times','',7);
			for($iDias=1;$iDias<=7;$iDias++)
			{
				if(isset($horario[$iDias][$iHoras]))
				{
					
					
					$pdf->Cell(35,6,utf8_decode($clases[$horario[$iDias][$iHoras]]['horario']->getNombre()),'LR',0,'L');
					
				 $clases[$horario[$iDias][$iHoras]]['horario']->getNombre();
				 $clases[$horario[$iDias][$iHoras]]['seccion']->getSeccion();
				}
				else
				{
					$pdf->Cell(35,6,'','LR',0,'L');
				}
			}
			$pdf->Ln();
			$pdf->SetFont('Times','',7);
			for($iDias=1;$iDias<=7;$iDias++)
			{
				if(isset($horario[$iDias][$iHoras]))
				{
					$pdf->Cell(15,6,utf8_decode('Sec: '.$clases[$horario[$iDias][$iHoras]]['seccion']->getSeccion()),'LB',0,'L');
					$pdf->Cell(20,6,utf8_decode('Aula: '.$clases[$horario[$iDias][$iHoras]]['seccion']->getAula()),'RB',0,'L');
				}
				else
				{
					$pdf->Cell(35,6,'','LBR',0,'L');
				}
			}
			$pdf->Ln();
			
		}
	}
	$pdf->Output();
}
?>
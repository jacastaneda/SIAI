<?php
session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/MetodosComunes.php");
include_once("../clases/ClassControl.php");
include_once("../clases/ClassExpedientealumno.php");
include_once("../clases/ClassAsignatura.php");
include_once("../clases/ClassAsesoria.php");
include_once("../clases/ClassAranceles.php");
include_once("../clases/ClassSiaiUsuario.php");
include_once("../clases/ClassSiaiControl.php");
include_once("../clases/ClassSiaiObligaciones.php");
include_once("../clases/ClassCarrera.php");
include_once("../clases/ClassFacultades.php");

include_once("pdf.php");

$obligaciones=unserialize($_SESSION['siai']['mandamientos']['obligaciones']);
$titulo=$_SESSION['siai']['mandamientos']['titulo'];
$carrera=unserialize($_SESSION['siai']['carrera']);
$facultad=new Facultades();
$facultad->setFacultadesPorLlave($carrera->getFacultad());

$control= new Control();
$control->setControlPorLlave('ANO_C');
$anio=$control->getConsecutiv();
$control->setControlPorLlave('CICLOACT');
$ciclo_actual=$control->getConsecutiv();
if(strlen($ciclo_actual)<2)
{
	$ciclo_actual='0'.$ciclo_actual;
}	
$ciclo=$ciclo_actual.'/'.$anio;

if(isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['seleccion']))
{	
	$expediente=unserialize($_SESSION['siai']['expediente']);
	$seleccion=unserialize($_SESSION['siai']['seleccion']);
	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->setEncabezado('UNIVERSIDAD POLITECNICA DE EL SALVADOR','HOJA DE SERVICIOS PARA ASIGNATURAS');
	$pdf->setPie($expediente->getCarnet());
	$pdf->AliasNbPages();
	$pdf->AddPage('P','Letter');
	$pdf->SetFont('Arial','',9);
	$pdf->Image('imagenes/fondo_inscripcion.png',0,0,216,148,'PNG');
	
	$pdf->setY(20);
	// Logo
    $pdf->Image('../pdf/imagenes/logo_politecnica.png',20,14,0);
    // Arial bold 15
    $pdf->SetFont('Arial','B',14);
    // Título	
    $pdf->Cell(0,10,utf8_decode('UNIVERSIDAD POLITECNICA DE EL SALVADOR'),0,0,'C');
	// Arial
    $pdf->SetFont('Arial','',10);
    // Salto de línea
    $pdf->Ln(5);
	// Descripción
    $pdf->Cell(0,10,utf8_decode('BOLETA DE INSCRIPCIÓN DE ASIGNATURAS'),0,0,'C');
	$pdf->Ln(15);
	
	$pdf->Cell(190,5,utf8_decode('Ciclo: '.$ciclo.'    Fecha: '.getFechaCorta()),0,0,'R',0);
	$pdf->Ln(9);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10,5,'',0,0,'L',0);
	$pdf->Cell(200,5,'CARNET: '.$expediente->getCarnet().' NUI:'.$expediente->getNui(),0,0,'L',0);
	$pdf->Ln();
	$pdf->Cell(10,5,'',0,0,'L',0);
	$pdf->Cell(80,5,utf8_decode('NOMBRE DEL ESTUDIANTE: '.$expediente->getApellido1().' '.$expediente->getApellido2().', '.$expediente->getNombres()),0,0,'L',0);
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10,5,'',0,0,'L',0);
	$pdf->Cell(0,5,utf8_decode('CARRERA: '.$carrera->getNombre().',  '.$facultad->getNombre()),0,0,'L',0);
	$pdf->Ln();	
	$pdf->Cell(10,5,'',0,0,'L',0);
	$pdf->Cell(90,5,utf8_decode('CUM: '.$expediente->getCumGeneral()),0,0,'L',0);
	$pdf->Ln(10);	
	$pdf->SetFillColor(50, 130, 220);
	$pdf->SetDrawColor(30, 90, 180);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(20,5,'',0,0,'L',0);
	$pdf->Cell(20,5,'CODIGO',1,0,'C',1);
	$pdf->Cell(15,5,'UV',1,0,'C',1);
	$pdf->Cell(20,5,'MATRICULA',1,0,'C',1);
	$pdf->Cell(60,5,'NOMBRE DE ASIGNATURA',1,0,'C',1);
	$pdf->Cell(15,5,utf8_decode('SECCIÓN'),1,0,'C',1);
	$pdf->Cell(30,5,utf8_decode('ARANCEL DE LAB.'),1,0,'C',1);
	$pdf->Ln();
	$pdf->SetFillColor(230, 240, 255);
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0, 0, 0);
	$fill=0;
	for($i=0; $i<count($seleccion);$i++)
	{
		$pdf->Cell(20,5,'',0,0,'L',0);
		$pdf->Cell(20,5,$seleccion[$i]['asesoria']->getCodigoasi(),'LR',0,'C',1);
		$pdf->Cell(15,5,$seleccion[$i]['asignatura']->getUnidadvalo(),'LR',0,'C',1);
		$pdf->Cell(20,5,$seleccion[$i]['asesoria']->getMatricula(),'LR',0,'C',1);
		$pdf->Cell(60,5,utf8_decode($seleccion[$i]['asignatura']->getNombre()),'LR',0,'C',1);
		$pdf->Cell(15,5,$seleccion[$i]['asesoria']->getSeccion(),'LR',0,'C',1);
		if(isset($seleccion[$i]['arancel']))
		{
			$pdf->Cell(30,5,$seleccion[$i]['arancel']->getValor(),'LR',0,'C',1);
		}
		else
		{
			$pdf->Cell(30,5,'0.00','LR',0,'C',1);
		}
		$pdf->Ln();
		if($fill==0)
		{
			$pdf->SetFillColor(190, 210, 255);
			$fill=1;
		}
		else
		{
			$pdf->SetFillColor(230, 240, 255);
			$fill=0;
		}
	}
	$pdf->Cell(20,5,'',0,0,'L',0);
	$pdf->Cell(160,5,'','T',0,'C',0);
	$pdf->Ln();
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(20,5,'',0,0,'L',0);
	$pdf->Cell(160,5,utf8_decode('VALIDO UNICAMENTE CON SELLO Y FIRMA DE REGISTRO ACADEMICO.'),0,0,'C',0);
	$pdf->Ln(20);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(20,5,'',0,0,'L',0);
	$pdf->Cell(50,5,utf8_decode('FIRMA DEL ESTUDIANTE.'),'T',0,'C',0);
	$pdf->Cell(40,5,'',0,0,'L',0);
	$pdf->Cell(50,5,utf8_decode('FIRMA Y SELLO REGISTRO ACADEMICO.'),'T',0,'C',0);
	$pdf->Ln();
	
	$pdf->Output();
}
?>
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
include_once("../librerias/code128.php");

$obligaciones=unserialize($_SESSION['siai']['mandamientos']['obligaciones']);
$titulo=$_SESSION['siai']['mandamientos']['titulo'];
$carrera=unserialize($_SESSION['siai']['carrera']);

if(isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['mandamientos']))
{	
	$expediente=unserialize($_SESSION['siai']['expediente']);
	$matricula=unserialize($_SESSION['siai']['mandamientos']['matricula']);
	$cuota=unserialize($_SESSION['siai']['mandamientos']['cuota']);
	$seleccion=unserialize($_SESSION['siai']['mandamientos']['seleccion']);
	
	// Creación del objeto de la clase heredada
	$pdf = new PDF_Code128();
	//$pdf->setEncabezado('Universidad Politécnica de El Salvador','Mandamientos de Pago');
	//$pdf->setPie($expediente->getCarnet());
	
	$pdf->AliasNbPages();
	$pdf->AddPage('P','Letter');
	$pdf->SetFont('Arial','',9);
	
	for($i=0; $i<count($obligaciones);$i++)
	{	
		$barcode=$obligaciones[$i]->getCodigoBarras();
		$barcode=str_replace('(','',$barcode);
		$barcode=str_replace(')','',$barcode);
		$fechas=explode('-',$obligaciones[$i]->getFechaEmision());
		$fecha=$fechas[2].'/'.$fechas[1].'/'.$fechas[0];
		$pdf->Image('imagenes/fondo_mandamiento.png',0,$pdf->GetY(),216,93,'PNG');
		$pdf->Ln(16);
		$pdf->Cell(75,5,'',0,0,'L',0);
		$pdf->Cell(40,5,utf8_decode($fecha),0,0,'L',0);
		$pdf->Cell(40,5,utf8_decode($obligaciones[$i]->getDescripcion()),0,0,'C',0);
		$pdf->Ln();
		$pdf->Cell(5,5,'',0,0,'L',0);
		$pdf->Cell(40,5,'',0,0,'L',0);
		$pdf->Cell(20,5,utf8_decode($fecha),0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(100,5,'Carnet: '.$expediente->getCarnet().' NUI:'.$expediente->getNui(),0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,5,'',0,0,'L',0);
		$pdf->Cell(60,5,'Carnet: '.$expediente->getCarnet().' NUI:'.$expediente->getNui(),0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(100,5,'Nombre: '.$expediente->getNombres()." ".$expediente->getApellido1()." ".$expediente->getApellido2().'',0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,5,'',0,0,'L',0);
		$pdf->Cell(60,5,'Nombre: '.$expediente->getNombres(),0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(100,5,'Carrera: '.$carrera->getNombre(),0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(18,5,'',0,0,'L',0);
		$pdf->Cell(47,5,utf8_decode($expediente->getApellido1()." ".$expediente->getApellido2()),0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(100,5,utf8_decode('Información de Pago:'),0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,5,'',0,0,'L',0);
		$carrera1=substr($carrera->getNombre(),0,23);
		$carrera2=substr($carrera->getNombre(),23,40);
		$pdf->Cell(60,5,utf8_decode('Carrera: '.$carrera1),0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(100,5,utf8_decode(strtoupper($obligaciones[$i]->getDescripcion())),0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(18,5,'',0,0,'L',0);
		$pdf->Cell(50,5,utf8_decode($carrera2),0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(5,5,'',0,0,'L',0);
		$pdf->Cell(60,5,utf8_decode('Información de Pago:'),0,0,'L',0);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(10,5,'',0,0,'L',0);
		if($obligaciones[$i]->getCuota()==0)
		{
			$pdf->Cell(100,5,utf8_decode('Despues de la fecha de vencimiento su matricula tendrá un recargo de 10%'),0,0,'L',0);
		}
		else
		{
			$pdf->Cell(100,5,utf8_decode('Despues de la fecha de vencimiento su matricula tendrá un recargo de $8.00 dolares'),0,0,'L',0);
		}
		
		$pdf->SetFont('Arial','',9);
		$pdf->Ln();
		$pdf->Cell(5,5,'',0,0,'L',0);
		$pdf->Cell(60,5,utf8_decode(substr(strtoupper($obligaciones[$i]->getDescripcion()),0,28)),0,0,'L',0);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(90,5,utf8_decode('Vencimiento '.getFechaMasDias(3)),0,0,'L',0);
		$pdf->Cell(40,5,utf8_decode('Total a Pagar: $'.number_format($obligaciones[$i]->getValor(),2)),0,0,'L',0);
		$pdf->SetFont('Arial','',9);
		$pdf->Ln(7);
		$pdf->Cell(20,5,'',0,0,'L',0);
		$pdf->Cell(45,5,utf8_decode('Total a Pagar: $'.number_format($obligaciones[$i]->getValor(),2)),0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(130,5,'NPE '.$obligaciones[$i]->getNpeFormato(),0,0,'C',0);
		$pdf->Ln();
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Code128(87,$pdf->GetY(),$barcode,120,10);
		//$pdf->Image("codigos/".$barcode.".png",85,$pdf->GetY(),0,0,'PNG');
		$pdf->Ln(10);
		$pdf->Cell(72,5,'',0,0,'L',0);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(130,8,$obligaciones[$i]->getCodigoBarras(),0,0,'C',1);
		
		if($i%2==0)
		{
			$pdf->Ln(35);
		}
		else
		{
			$pdf->Ln(25);
			$pdf->Cell(0,5,utf8_decode('Para poder efectuar el pago deve llevar recortados los mandamientos de pago en las lineas punteadas'),0,0,'C',0);
		 	if($i+1<count($obligaciones))
			{				
				$pdf->AddPage('P','Letter');
			}
		}
	}
	$pdf->Output();	
}
?>
<?php
require('../librerias/fpdf.php');

class PDF extends FPDF
{
	private $titulo;
	private $descripcion;
	private $reporte;
	private $usuario;
	
function setEncabezado($titulo, $descripcion)
{
	$this->titulo=$titulo;
	$this->descripcion=$descripcion;
}
function setPie($usuario)
{
	$this->usuario=$usuario;
	$this->reporte=$reporte;
}
// Cabecera de página
function Header()
{
    // Logo Siai
    //$this->Image('../pdf/imagenes/logo_sobre_blanco.png',10,4,0);	
	// Logo
    $this->Image('../pdf/imagenes/logo_politecnica.png',20,4,0);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Título
    $this->Cell(0,10,utf8_decode($this->titulo),0,0,'C');
	// Arial
    $this->SetFont('Arial','',10);
    // Salto de línea
    $this->Ln(5);
	// Descripción
    $this->Cell(0,10,utf8_decode($this->descripcion),0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
	
	$this->Cell(80,6,utf8_decode('Generado por Sistema de Inscripción de Asiganturas vía Internet'),'T',0,'L');
	$this->Cell(0,6,utf8_decode('Estudiante:'.$this->usuario),'T',0,'R');
	// Salto de línea
    $this->Ln(5);
    // Número de página
    $this->Cell(0,8,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
?>
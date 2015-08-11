<?php

session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/ClassControl.php");
include_once("../clases/MetodosComunes.php");
include_once("../clases/ClassExpedientealumno.php");
include_once("../clases/ClassAranceles.php");
include_once("../clases/ClassSiaiUsuario.php");
include_once("../clases/ClassSiaiObligaciones.php");
include_once("../clases/ClassCarrera.php");
include_once("../clases/ClassObligaciones.php");
include_once("../clases/ClassAranceles.php");
include_once("../librerias/fpdf.php");
include_once("../librerias/code128.php");

if (isset($_SESSION['siai']['usuario']) && isset($_SESSION['siai']['expediente'])) {
    $estudiante = unserialize($_SESSION['siai']['expediente']);
    $usuario_estudiante = unserialize($_SESSION['siai']['usuario']);

    $control= new Control();
    $control->setControlPorLlave('ANO_C');
    $anio=$control->getConsecutiv();
    $control->setControlPorLlave('CICLOACT');
    $ciclo_actual=$control->getConsecutiv();
    $ciclo_anio_actual='0'.$ciclo_actual.'/'.$anio;    
    
    $obligaciones = new Obligaciones();
    $obligacionesArray = $obligaciones->listaNoSolvente($usuario_estudiante->getCarnet(), $ciclo_anio_actual);

    // Creación del objeto de la clase heredada
    $pdf = new PDF_Code128();

    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetFont('Arial', '', 9);
    $i = 0;
    $pdf->SetTitle("MANDAMIENTO DE PAGO", true);
    $pdf->SetAuthor("SIAI", true);
    $pdf->SetCreator("SIAI", true);
    $pdf->SetSubject("MANDAMIENTO DE PAGO", true);
    foreach ($obligacionesArray as $obligacion) {


        $fechas = new DateTime($obligacion['FECHA']);
        $fecha = $fechas->format('d/m/Y');
        $carrera = new Carrera();
        $carrera->setCarreraPorLlave($estudiante->getCodcarrera());
        $arancel = new Aranceles();
        $arancel->setArancelesPorLlave($obligacion['TIPO_ARANC']);
        $descripcion = '';
        $cta = null;
        switch ($obligacion['TIPO_ARANC']) {
            case 'CTA':
                $descripcion = $arancel->getNombre() . ' ' . $obligacion['CUOTA'];
                $cta = $obligacion['CUOTA'];
                break;
            case 'MAT':
                $descripcion = $arancel->getNombre();
                $cta = 0;
                break;
        }
        
        $descripcion.=', CICLO: '.$obligacion['CICLO'];
        $cicloarray = explode('/', $obligacion['CICLO']);
        $ciclo = $cicloarray[0];
        $anyo = $cicloarray[1];
        //------------------------GENERACION DE CODIGO DE BARRAS Y NPE----------------------------
        $caracteres = '000000';
        $numero = ((int) $obligacion['VALOR']) . '00';
        $caracteres = substr($caracteres, 0, strlen($caracteres) - strlen($numero)) . $numero;
        $fechanpe = new DateTime($obligacion['FECHA_VENC']);
        //$fecha = sumarDiasFecha($this->fechaemision, 3);
        $fechay = $fechanpe->format('Ymd');
        $npeMedio = $caracteres . $fechay . '00';

        $npeFinal = $estudiante->getNui() . $arancel->getIdunicoara() . $cta . $ciclo . substr($anyo, 2, 2);
        $caracteres = '0000000000';
        $numero = ((int) $obligacion['VALOR']) . '00';
        $caracteres = substr($caracteres, 0, strlen($caracteres) - strlen($numero)) . $numero;
        //$caracteres=substr($caracteres,0,count($caracteres)-count($numero)).$numero;

        $barrasFinal = $caracteres . '(96)' . $fechay . '(8020)0' . $npeFinal;
        if ($cta != 0) {
            $npeTemp = "0558" . $npeMedio . $npeFinal;
            $barras = "(415)7419700005971(3902)" . $barrasFinal;
        } else {
            $npeTemp = "0597" . $npeMedio . $npeFinal;
            $barras = "(415)7419700005582(3902)" . $barrasFinal;
        }
        $npeTemp = $npeTemp . generarVerificador($npeTemp);
        //------------------------FIN GENERACION DE CODIGO DE BARRAS Y NPE------------------------

        $pdf->Image('imagenes/fondo_mandamiento.png', 0, $pdf->GetY(), 216, 93, 'PNG');
        $pdf->Ln(16);
        $pdf->Cell(75, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(40, 5, utf8_decode($fecha), 0, 0, 'L', 0);
        $pdf->Cell(40, 5, utf8_decode($descripcion), 0, 0, 'C', 0);
        $pdf->Ln();
        $pdf->Cell(5, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(40, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(20, 5, utf8_decode($fecha), 0, 0, 'L', 0);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(100, 5, 'Carnet: ' . $estudiante->getCarnet() . ' NUI:' . $estudiante->getNui(), 0, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(5, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(60, 5, 'Carnet: ' . $estudiante->getCarnet() . ' NUI:' . $estudiante->getNui(), 0, 0, 'L', 0);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(100, 5, 'Nombre: ' . $estudiante->getNombres() . " " . $estudiante->getApellido1() . " " . $estudiante->getApellido2() . '', 0, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(5, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(60, 5, 'Nombre: ' . $estudiante->getNombres(), 0, 0, 'L', 0);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(100, 5, 'Carrera: ' . $carrera->getNombre(), 0, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(18, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(47, 5, utf8_decode($estudiante->getApellido1() . " " . $estudiante->getApellido2()), 0, 0, 'L', 0);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(100, 5, utf8_decode('Información de Pago:'), 0, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(5, 5, '', 0, 0, 'L', 0);

        $carrera1 = substr($carrera->getNombre(), 0, 23);
        $carrera2 = substr($carrera->getNombre(), 23, 40);

        $pdf->Cell(60, 5, utf8_decode('Carrera: ' . $carrera1), 0, 0, 'L', 0);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(100, 5, utf8_decode(strtoupper($descripcion)), 0, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(18, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(50, 5, utf8_decode($carrera2), 0, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(5, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(60, 5, utf8_decode('Información de Pago:'), 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);
        if ($obligacion['TIPO_ARANC'] == 'MAT') {
            $pdf->Cell(100, 5, utf8_decode('Despues de la fecha de vencimiento su matricula tendrá un recargo de 10%'), 0, 0, 'L', 0);
        } else {
            $pdf->Cell(100, 5, utf8_decode('Despues de la fecha de vencimiento su cuota tendrá un recargo de $8.00 dolares'), 0, 0, 'L', 0);
        }

        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln();
        $pdf->Cell(5, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(60, 5, utf8_decode(substr(strtoupper($descripcion), 0, 28)), 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);

        $fechaObj = new DateTime($obligacion['FECHA_VENC']);
        
        $fechaAct=new DateTime();
        
        $valor_pagar=number_format($obligacion['VALOR'], 2);
        if($fechaAct > $fechaObj)
        {
            if($obligacion['TIPO_ARANC'] == 'MAT')
            {
                $valor_pagar*=1.1;
            }
            else
            {
                $valor_pagar+=8;
            }
        }    

        $pdf->Cell(90, 5, utf8_decode('Vencimiento ' . $fechaObj->format('d/m/Y')), 0, 0, 'L', 0);
        $pdf->Cell(40, 5, utf8_decode('Total a Pagar: $' . number_format($valor_pagar, 2)), 0, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Ln(7);
        $pdf->Cell(20, 5, '', 0, 0, 'L', 0);
        $pdf->Cell(45, 5, utf8_decode('Total a Pagar: $' . number_format($valor_pagar, 2)), 0, 0, 'L', 0);
        $pdf->Cell(10, 5, '', 0, 0, 'L', 0);

        $npe = '';

        for ($i2 = 0; $i2 < strlen($npeTemp); $i2++) {

            if ($i2 % 4 == 0) {
                $npe.=' ' . $npeTemp[$i2];
            } else {
                $npe.=$npeTemp[$i2];
            }
        }

        $pdf->Cell(130, 5, 'NPE ' . $npe, 0, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);

        $barcode = $barras;
        $barcode = str_replace('(', '', $barcode);
        $barcode = str_replace(')', '', $barcode);

        $pdf->Code128(87, $pdf->GetY(), $barcode, 120, 10);
        //$pdf->Image("codigos/".$barcode.".png",85,$pdf->GetY(),0,0,'PNG');
        $pdf->Ln(10);
        $pdf->Cell(72, 5, '', 0, 0, 'L', 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(130, 8, $barras, 0, 0, 'C', 1);

        if ($i % 2 == 0) {
            $pdf->Ln(35);
        } else {
            $pdf->Ln(25);
            $pdf->Cell(0, 5, utf8_decode('Para poder efectuar el pago deve llevar recortados los mandamientos de pago en las lineas punteadas'), 0, 0, 'C', 0);
            if ($i + 1 < count($obligacionesArray)) {
                $pdf->AddPage('P', 'Letter');
            }
        }
        $i++;
    }
    $pdf->Output();
} else {
    unset($_SESSION['siai']);
    header('Location: index.php');
}

function generarVerificador($npe) {
    $iImpares = 0;
    $iPares = 0;
    for ($i = 0; $i < strlen($npe); $i++) {
        if ($i % 2 == 0) {
            $impares[$iImpares] = (int) $npe[$i];
            $iImpares++;
        } else {
            $pares[$iPares] = (int) $npe[$i];
            $iPares++;
        }
    }
    $tImpares = 0;
    for ($i = 0; $i < count($impares); $i++) {
        $tImpares+=($impares[$i] * 2);
        if (($impares[$i] * 2) >= 10) {
            $tImpares+=1;
        }
    }
    $tPares = 0;
    for ($i = 0; $i < count($pares); $i++) {
        $tPares+=$pares[$i];
    }
    $A = (int) ($tImpares + $tPares);
    $B = (int) ($A / 10);
    $C = (int) ($B * 10);
    $D = (int) ($A - $C);
    $E = (int) (10 - $D);
    $F = (int) ($E / 10);
    $G = (int) ($F * 10);
    $VR = (int) ($E - $G);
    return $VR;
}

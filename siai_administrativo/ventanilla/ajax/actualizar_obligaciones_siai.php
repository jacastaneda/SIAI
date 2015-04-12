<?php

session_start();
//incluyendo clases necesarias
include_once("../../../clases/ClassConexion.php");
include_once("../../../clases/ClassSiaiObligaciones.php");
include_once '../../../clases/ClassSiaiControl.php';
include_once '../../../clases/ClassControl.php';
include_once '../../../clases/ClassSiaiUsuario.php';
include_once '../../../clases/ClassEmail.php';
include_once '../../../librerias/PHPMailer/class.phpmailer.php';

//Incluir en este punto las validaciones de usuario
//Obteniendo variables enviadas por url
$idObligaciones = $_POST['id'];
$fechaPago = $_POST['fecha'];
$banco = $_POST['banco'];
$monto = $_POST['monto'];

//instanciando Clase Empleado
$siaiObligaciones = new SiaiObligaciones();
$siaiObligaciones->setSiaiObligacionesPorLlave($idObligaciones);

//ingresando datos a la clase
//$siaiObligaciones->setIdObligaciones($idObligaciones);
$siaiObligaciones->setFechaPago($fechaPago);
$siaiObligaciones->setBanco($banco);
$siaiObligaciones->setMonto($monto);
$siaiObligaciones->setEstado(1);

header('Content-Type: application/json');
//var_dump($siaiObligaciones);
if ($siaiObligaciones->updateSiaiObligaciones()) {
    echo '{"exec":true}';
    if (!$siaiObligaciones->existenObligaciones($siaiObligaciones->getUsuario())) {

        $siaicontrol = new SiaiControl();
        $control = new Control();

        $control->setControlPorLlave('ANO_C');
        $anio = $control->getConsecutiv();
        $control->setControlPorLlave('CICLOACT');
        $ciclo_actual = $control->getConsecutiv();

        $siaicontrol->setPorAtributos($siaiObligaciones->getUsuario(), $ciclo_actual, $anio);

        $siaicontrol->setPaso(5);
        $siaicontrol->setSolvente(1);

        if ($siaicontrol->updateSiaiControl()) {
            $usuario = new SiaiUsuario();
            $usuario->setSiaiUsuarioPorLlave($siaiObligaciones->getUsuario());
            $email = new Email();
            //echo $usuario->getEmail();
            $email->setAdress($usuario->getEmail());
            $email->setSubject('Tus pagos han sido registrados - SIAI');
            $email->setBody('Ya puedes continuar con el proceso de inscripción', 'Ya puedes continuar con el proceso de inscripción');
            $email->send();
        }
    }
} else {
    echo '{"exec":false}';
}
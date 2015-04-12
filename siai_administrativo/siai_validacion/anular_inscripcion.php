<?php
session_start();
include_once("clases/ClassConexion.php");
include_once("clases/MetodosComunes.php");
include_once("clases/ClassControl.php");
include_once("clases/ClassAsignatura.php");
include_once("clases/ClassAsesoria.php");
include_once("clases/ClassAranceles.php");
include_once("clases/ClassSiaiUsuario.php");
include_once("clases/ClassSiaiControl.php");
include_once("clases/ClassSiaiObligaciones.php");
include_once("clases/ClassCarrera.php");
include_once '../../librerias/PHPMailer/class.phpmailer.php';
include_once '../../clases/ClassEmail.php';

if (isset($_SESSION['sai']['seleccion'])) {
    $seleccion = unserialize($_SESSION['sai']['seleccion']);

    $siaiControl = unserialize($_SESSION['sai']['siaicontrol']);


    for ($i = 0; $i < count($seleccion); $i++) {
        $seleccion[$i]['asesoria']->setCupo(0);
        $seleccion[$i]['asesoria']->updateAsesoria();
    }
    $siaiControl->setPaso(9);
    $siaiControl->updateSiaiControl();

    $email = new Email();
    $usuario = new SiaiUsuario();
    $usuario->setSiaiUsuarioPorLlave($siaiControl->getUsuario());
    $email->setAdress($usuario->getEmail());

    $email->setSubject(utf8_decode('Inscripción Anulada - SIAI'));
    $email->setBody(utf8_decode('Su solicitud de inscripción ha sido anulada. Favor presentarse a las instalaciones de la UPES a solventar su situación.'), utf8_decode('Su solicitud de inscripción ha sido anulada. Favor presentarse a las instalaciones de la UPES a solventar su situación.'));
    $email->send();
}
?>
<script type="text/javascript">location.href = 'index.php'</script>
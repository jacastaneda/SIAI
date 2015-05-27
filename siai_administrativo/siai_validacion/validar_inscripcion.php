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
include_once('librerias/PHPMailer/class.phpmailer.php');
include_once('clases/ClassEmail.php');
include_once("clases/ClassCarrera.php");

if (isset($_SESSION['sai']['seleccion'])) {
    $seleccion = unserialize($_SESSION['sai']['seleccion']);

    $siaiControl = unserialize($_SESSION['sai']['siaicontrol']);

    $usuario = unserialize($_SESSION['sai']['siaiusuario']);

    for ($i = 0; $i < count($seleccion); $i++) {
        $seleccion[$i]['asesoria']->setMarcar(1);
        $seleccion[$i]['asesoria']->setCupo(1);
        $seleccion[$i]['asesoria']->updateAsesoria();
    }

    $siaiControl->setPaso(4);
    $siaiControl->setSaldo(0);
    $siaiControl->setSolvente(1);
    $siaiControl->updateSiaiControl();
    $email = new Email();
    $email->setAdress($usuario->getEmail());
    $email->setSubject(utf8_decode('Informe de estado de su inscripción'));
    $email->setBody('<p>Su inscripción ha sido validada por el coordinador de su carrera</p><p>Ahora podrá continuar con el proceso de inscripción</p><a href="http://'.$_SERVER['SERVER_NAME'].'/siai">Continuar con el proceso</a>', 'Su inscripción ha sido validada por el coordinador de su carrera. Ahora podrá continuar con el proceso de inscripción');
    echo "este es" . $email->send();
}
//echo ($_SESSION['sai']['siaiusuario']);
//exit();
?>
<script type="text/javascript">location.href = 'index.php'</script>
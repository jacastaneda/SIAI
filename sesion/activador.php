<?php

session_start();
include_once('../clases/ClassConexion.php');
include_once('../clases/ClassSiaiUsuario.php');
include_once('../clases/ClassSiaiControl.php');
include_once('../clases/ClassExpedienteAlumno.php');
include_once('../clases/ClassControl.php');
include_once('../clases/ClassCarrera.php');
include_once('../clases/ClassSiaiControl.php');
include_once('../librerias/PHPMailer/class.phpmailer.php');
include_once('../clases/ClassEmail.php');
include_once('../clases/ClassSiaiUsuario.php');
include_once('../clases/ClassSiaiControl.php');

function validarEmail($texto) {
    if (preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $texto, $email, PREG_OFFSET_CAPTURE)) {
        return $email;
    } else {
        return false;
    }
}

if (isset($_GET['carnet']) && isset($_GET['contrasena']) && isset($_GET['nacimiento']) && isset($_GET['email'])) {
    $expediente = new Expedientealumno();
    if ($expediente->setExpedientealumnoPorLlave(urldecode($_GET['carnet']))) {
        $comentario = $expediente->getObservacio();
        $comentario = explode("\n", $comentario);
        for ($i = 0; $i < count($comentario); $i++) {
            $comentario[$i] = trim($comentario[$i]);
            if (validarEmail($comentario[$i])) {
                $email = validarEmail($comentario[$i]);
                $email = $email[0];
            }
        }
        if ($expediente->getFechanacim() == urldecode($_GET['nacimiento']) || $email[0] == urldecode($_GET['email'])) {
            $control = new Control();
            $control->setControlPorLlave('ANO_C');
            $anio = $control->getConsecutiv();
            $control->setControlPorLlave('CICLOACT');
            $ciclo_actual = $control->getConsecutiv();

            $usuario = new SiaiUsuario();
            if ($usuario->setSiaiUsuarioPorLlave($expediente->getCarnet())) {
                if ($usuario->getActivado() == 1) {
                    echo "resultadosiai=3";
                } else {
                    echo "resultadosiai=4";
                }
            } else {
                $usuario->setUsuario($expediente->getCarnet());
                $usuario->setCarnet($expediente->getCarnet());
                $usuario->setEmail(urldecode($_GET['email']));
                $usuario->setContrasena(urldecode($_GET['contrasena']));
                $usuario->setActivado(0);
                $usuario->setTipo(0);
                $usuario->insertSiaiUsuario();

                $siaiControl = new SiaiControl();
                $siaiControl->setAnio($anio);
                $siaiControl->setCiclo($ciclo_actual);
                $siaiControl->setUsuario($usuario->getUsuario());
                $siaiControl->setSolvente(1);
                $siaiControl->setTotalPagar(0);
                $siaiControl->setSaldo(0);
                $siaiControl->setPaso(0);
                $siaiControl->insertSiaiControl();

                $email = new Email();
                $email->setAdress($usuario->getEmail());
                $email->setSubject('Universidad Politecnica te da la bienvenida como usuario del Sistema de Inscripcion de Asignaturas via Internet');
                $email->setBody('<p>Gracias por utilizar el Sistema de Inscripci&oacute;n de Asignaturas v&iacute;a Internet</p><p><a href="http://'.$_SERVER['SERVER_NAME'].'/siai/sesion/verificar.php?carnet=' . $expediente->getCarnet() . '&verificador=' . md5($usuario->getEmail()) . '">Enlace Verificador</a></p><p>SIAI - Sistema de Inscripci&oacute;n de Asignaturas v&iacute;a Internet te da la bienvenida</p>', $_SERVER['SERVER_NAME'].'/siai/sesion/verificar.php?carnet=' . $expediente->getCarnet() . '&verificador=' . md5($usuario->getEmail()));
                $email->send();

                echo "resultadosiai=0";
            }
        } else {
            echo "resultadosiai=2";
        }
    } else {
        echo "resultadosiai=1";
    }
} else {
    echo "resultadosiai=1";
}
?>
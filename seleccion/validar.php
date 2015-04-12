<?php

session_start();
include_once("../clases/ClassConexion.php");
include_once("../clases/MetodosComunes.php");
include_once("../clases/ClassExpedientealumno.php");
include_once("../clases/ClassControl.php");
include_once("../clases/ClassAsesoria.php");
include_once("../clases/ClassNotash.php");
include_once("../clases/ClassHorarios.php");
include_once("../clases/ClassHordetalle.php");
include_once("../clases/ClassSecciones.php");
include_once("../clases/ClassAsignatura.php");
include_once("../clases/ClassPlanes.php");
include_once('../clases/ClassSiaiUsuario.php');
include_once('../clases/ClassSiaiControl.php');
include_once("../clases/ClassPrerrequisitos.php");
include_once("../clases/ClassCarrera.php");
include_once("../librerias/PHPMailer/class.phpmailer.php");
include_once("../clases/ClassEmail.php");

$notash = new Notash();

$nAsignaturas = $_GET['nasignaturas'];
$horarios = unserialize($_SESSION['siai']['horarios']);
$expediente = unserialize($_SESSION['siai']['expediente']);
$contador = 0;
$contador2 = 0;
for ($i = 0; $i < $nAsignaturas; $i++) {
    //Insertando a arreglo seleccion materias selecionadas y enviadas por url
    if (isset($_GET['seccion' . $i]) && $_GET['seccion' . $i] != '') {
        $seleccion[$contador]['asignatura'] = $horarios[$i]['asignatura'];
        $seleccion[$contador]['inscripciones'] = $notash->getNumeroInscripciones($expediente->getCarnet(), $horarios[$i]['asignatura']->getCodigo());
        $seleccion[$contador]['detalle'] = $horarios[$i]['detalle'][$_GET['seccion' . $i]];
        $seleccion[$contador]['horario'] = $horarios[$i]['horario'][$_GET['seccion' . $i]];
        $seleccion[$contador]['seccion'] = $horarios[$i]['seccion'][$_GET['seccion' . $i]];
        echo count($seleccion[$contador]['horario']);
        for ($ii = 0; $ii < count($seleccion[$contador]['horario']); $ii++) {
            echo $seleccion[$contador]['horario'][$ii]->getNombre();
            $codigo = $seleccion[$contador]['horario'][$ii]->getCodigo();
            substr($codigo, (count($codigo) - 2), 2);
            $clases[$contador2]['asignatura'] = $seleccion[$contador]['asignatura'];
            $clases[$contador2]['horario'] = $seleccion[$contador]['horario'][$ii];
            $clases[$contador2]['seccion'] = $seleccion[$contador]['seccion'];
            $clases[$contador2]['hora'] = substr($codigo, (count($codigo) - 3), 2);
            //echo $clases[$contador2].' ';
            $contador2++;
        }
        $contador++;
    }
}
$contador = 0;
for ($i = 0; $i < count($clases); $i++) {
    for ($ii = 0; $ii < count($clases); $ii++) {
        if ($i > $ii && $clases[$i]['hora'] == $clases[$ii]['hora']) {
            $choque[$contador][0]['asignatura'] = $clases[$i]['asignatura'];
            //echo $clases[$i]['asignatura']->getNombre();
            $choque[$contador][0]['seccion'] = $clases[$i]['seccion'];
            $choque[$contador][1]['asignatura'] = $clases[$ii]['asignatura'];
            $choque[$contador][1]['seccion'] = $clases[$ii]['seccion'];
            $contador++;
        } else {
            //echo $clases[$i]['hora'].'!='.$clases[$ii]['hora'];
        }
    }
}

if ($contador == 0) {
    $banderaCupos = true;
    for ($i = 0; $i < count($seleccion); $i++) {
        $cupo = $seleccion[$i]['seccion']->getDisponible();
        $cupo = (int) $cupo;
        if ($cupo <= 0) {
            $banderaCupos = false;
        }
    }
    if ($banderaCupos) {
        $asesoria = new Asesoria();
        $asesoria->borrarRegistros($expediente->getCarnet());
        $asesoria->iniciarTransaccion();
        $asesoria->setCarnet($expediente->getCarnet());
        $asesoria->setFechaIngr(getFechaHora());
        $asesoria->setMarcar(0);
        $banderaAsesoria = true;

        $planes = new Planes();

        for ($iAsesoria = 0; $iAsesoria < count($seleccion); $iAsesoria++) {
            $seleccion[$iAsesoria]['seccion']->setSeccionesPorParametros($seleccion[$iAsesoria]['seccion']->getCiclo(), $seleccion[$iAsesoria]['seccion']->getSeccion(), $seleccion[$iAsesoria]['seccion']->getCodigoAsi());
            $planes->setPlanesPorLlaves($expediente->getCodigoPla, $seleccion[$iAsesoria]['asignatura']->getCodigo());
            $asesoria->setCiclo($planes->getCiclo());
            $asesoria->setCodigoAsi($seleccion[$iAsesoria]['asignatura']->getCodigo());
            $asesoria->setArancel($seleccion[$iAsesoria]['asignatura']->getArancel());
            $asesoria->setSeccion($seleccion[$iAsesoria]['seccion']->getSeccion());
            $asesoria->setMatricula($seleccion[$contador]['inscripciones'] + 1);
            if ($asesoria->transaccionAsesoria() == false) {
                $banderaAsesoria = false;
            }
        }
        if ($asesoria->finalizarTransaccion($banderaAsesoria)) {
            for ($iAsesoria = 0; $iAsesoria < count($seleccion); $iAsesoria++) {
                $nReservaciones = $seleccion[$iAsesoria]['seccion']->getReservacio();
                $nReservaciones = $nReservaciones + 1;
                $nCupos = $seleccion[$iAsesoria]['seccion']->getCupos();
                $nUtilizados = $seleccion[$iAsesoria]['seccion']->getUtilizados();
                $nDisponibles = $nCupos - ($nUtilizados + $nReservaciones);
                $seleccion[$iAsesoria]['seccion']->setReservacio($nReservaciones);
                $seleccion[$iAsesoria]['seccion']->setDisponible($nDisponibles);
                $seleccion[$iAsesoria]['seccion']->updateSecciones();
                //echo $nDisponibles;
            }
            unset($_SESSION['siai']['horarios']);
            $siaiControl = unserialize($_SESSION['siai']['control']);
            $siaiControl->setPaso(3);
            $siaiControl->updateSiaiControl();

            $carrera = unserialize($_SESSION['siai']['carrera']);
            $carreraObj = new Carrera();

            $email = new Email();
            //echo $usuario->getEmail();
            $email->setAdress($carreraObj->getCorreoCoordinador($carrera->getCodigoCar()));
            $email->setSubject(utf8_decode('Incripción Realizada - SIAI'));
            $email->setBody('<h3>Buen día,</h3><p>Tiene una nueva inscripción de asignaturas, favor validar las asignaturas inscritas.</p><p>Gracias.</p><p>Sistema de Información SIAI.</p>', 'Buen día, 
Tiene una nueva inscripción de asignaturas, favor validar las asignaturas inscritas.  
Gracias.
Sistema de Información SIAI. 
');
            $email->send();

            $_SESSION['siai']['control'] = serialize($siaiControl);
            $_SESSION['siai']['seleccion'] = serialize($seleccion);
            $_SESSION['siai']['clases'] = serialize($clases); //<----------------------AQUI
            echo "resultadosiai=0";
        } else {
            echo "resultadosiai=4";
        }
    } else {
        echo "resultadosiai=3";
    }
} else {
    $_SESSION['siai']['choque'] = serialize($choque);
    if ($contador == 1) {
        echo "resultadosiai=1";
    } else {
        echo "resultadosiai=2";
    }
}
?>
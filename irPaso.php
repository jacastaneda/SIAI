<?php

session_start();
require_once("clases/ClassConexion.php");
include_once("clases/MetodosComunes.php");
include_once("clases/ClassControl.php");
include_once("clases/ClassExpedientealumno.php");
include_once("clases/ClassAsignatura.php");
include_once("clases/ClassAsesoria.php");
include_once("clases/ClassAranceles.php");
include_once("clases/ClassSiaiUsuario.php");
include_once("clases/ClassSiaiControl.php");
include_once("clases/ClassSiaiObligaciones.php");


if (isset($_SESSION['siai']['usuario']) && isset($_SESSION['siai']['expediente']) && isset($_SESSION['siai']['control'])) {
    $expediente = unserialize($_SESSION['siai']['expediente']);
    $siaiusuario = unserialize($_SESSION['siai']['usuario']);
    $siaiControl = unserialize($_SESSION['siai']['control']);
    if ($siaiusuario->getTipo() == 0 && $siaiusuario->getActivado() == 1) {
        switch ($siaiControl->getPaso()) {
            case 0:
                header('Location: paso1.php');
                break;
            case 1:
                header('Location: paso1.php');
                break;
            case 2:
                header('Location: paso2.php');
                break;
            case 3:
                header('Location: paso3.php');
                break;
            case 4:
                // if ($siaiControl->getSolvente() == 1) {
                //  header('Location: paso5.php');
                // } else {
                header('Location: paso4.php');
                //}
                break;
            case 5:
                header('Location: paso5.php');
                break;
                        case 9:
                header('Location: inscripcion_anulada.php');
                break;
        }
    }
} else {
    unset($_SESSION['siai']);
    header('Location: index.php');
}?>
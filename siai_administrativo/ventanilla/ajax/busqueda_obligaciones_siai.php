<?php

session_start();
include_once '../../../clases/ClassConexion.php';
include_once '../../../clases/ClassSiaiObligaciones.php';
include_once '../../../clases/ClassControl.php';
$obligaciones = new SiaiObligaciones();
header('Content-Type: application/json');
//echo json_encode($data);
$criterio = $_POST['criterio'];
$criteria = $_POST['opcion'];

$control = new Control();
$control->setControlPorLlave('ANO_C');
$anio = $control->getConsecutiv();
$control->setControlPorLlave('CICLOACT');
$ciclo_actual = $control->getConsecutiv();
switch ($criteria) {
    case 1:
        if ($datos = $obligaciones->buscarPorCarnet($criterio, $ciclo_actual, $anio)) {
            $cadena = '';
//var_dump($datos);
            echo '{"execF":true,"obligaciones":[';
            foreach ($datos as $item) {
                //var_dump($item);
                $cadena = $cadena . '{'
                        . '"id":"' . $item['id_obligaciones'] . '",'
                        . '"arancel":"' . $item['arancel'] . '",'
                        . '"carnet":"' . $item['usuario'] . '",'
                        . '"nui":"' . $item['nui'] . '",'
                        . '"descripcion":"' . $item['descripcion'] . '",'
                        . '"emision":"' . $item['fecha_emision'] . '"},';
            }

            $cadena = substr($cadena, 0, -1);
            echo $cadena;
            echo ']}';
        } else {
            echo '{"execF":false}';
        }
        break;
    case 2:
        if ($datos = $obligaciones->buscarPorNui($criterio, $ciclo_actual, $anio)) {
            $cadena = '';
//var_dump($datos);
            echo '{"execF":true,"obligaciones":[';
            foreach ($datos as $item) {
                //var_dump($item);
                $cadena = $cadena . '{'
                        . '"id":"' . $item['id_obligaciones'] . '",'
                        . '"arancel":"' . $item['arancel'] . '",'
                        . '"carnet":"' . $item['usuario'] . '",'
                        . '"nui":"' . $item['nui'] . '",'
                        . '"descripcion":"' . $item['descripcion'] . '",'
                        . '"emision":"' . $item['fecha_emision'] . '"},';
            }

            $cadena = substr($cadena, 0, -1);
            echo $cadena;
            echo ']}';
        } else {
            echo '{"execF":false}';
        }
        break;
    case 3:
        $criterio = '('.$criterio;
        $criterio = substr($criterio, 0,4).')'.substr($criterio, 4);
        $criterio = substr($criterio, 0,18).'('.substr($criterio, 18,4).')'.substr($criterio, 22);
        $criterio = substr($criterio, 0,34).'('.substr($criterio, 34,2).')'.substr($criterio, 36);
        $criterio = substr($criterio, 0,46).'('.substr($criterio, 46,4).')'.substr($criterio, 50);
        if ($datos = $obligaciones->buscarPorCodigoBarras($criterio, $ciclo_actual, $anio)) {
            $cadena = '';
//var_dump($datos);
            echo '{"execF":true,"obligaciones":[';
            foreach ($datos as $item) {
                //var_dump($item);
                $cadena = $cadena . '{'
                        . '"id":"' . $item['id_obligaciones'] . '",'
                        . '"arancel":"' . $item['arancel'] . '",'
                        . '"carnet":"' . $item['usuario'] . '",'
                        . '"nui":"' . $item['nui'] . '",'
                        . '"descripcion":"' . $item['descripcion'] . '",'
                        . '"emision":"' . $item['fecha_emision'] . '"},';
            }

            $cadena = substr($cadena, 0, -1);
            echo $cadena;
            echo ']}';
        } else {
            echo '{"execF":false,"cadena":"'.$criterio.'"}';
        }
        break;
}
<?php
require_once 'funciones/conexiones.php';
$idCiclo = $_POST['txtidCiclo'];
$anio = $_POST['txtAnio'];
$numCiclo = $_POST['sltNumCiclo'];
$ciclo=$numCiclo.'/'.$anio;
$activo = $_POST['sltActivo'];

    $conU = Conectar();
    $sqlU = "INSERT INTO siai_ciclos (anio, num_ciclo, ciclo, activo) VALUES ($anio, $numCiclo, $ciclo, $activo)";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El ciclo ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

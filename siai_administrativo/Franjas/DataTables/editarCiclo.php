<?php
require_once 'funciones/conexiones.php';
$idCiclo = $_POST['txtidCiclo'];
$anio = $_POST['txtAnio'];
$numCiclo = $_POST['sltNumCiclo'];
$ciclo=$numCiclo.'/'.$anio;
$activo = $_POST['sltActivo'];

    $con = Conectar();
    $sql = "UPDATE siai_ciclos SET anio = $anio, num_ciclo='$numCiclo', ciclo='$ciclo', activo='$activo' WHERE id_ciclo = '$idCiclo'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El ciclo ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

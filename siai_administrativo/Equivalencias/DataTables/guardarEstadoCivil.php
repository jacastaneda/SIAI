<?php
require_once 'funciones/conexiones.php';
$idEstadoCivil = $_POST['txtidEstadoCivil'];
$nombreEstadoCivil = $_POST['txtnombreEstadoCivil'];

    $conU = Conectar();
    $sqlU = "INSERT INTO PROC_EstadoCivil (nombreEstadoCivil) VALUES ('$nombreEstadoCivil')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El Estado Civil ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

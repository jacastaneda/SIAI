<?php
require_once 'funciones/conexiones.php';
$idEstadoMateriaSoli = $_POST['txtidEstadoMateriaSoli'];
$nombreEstadoMateria = $_POST['txtnombreEstadoMateria'];

    $conU = Conectar();
    $sqlU = "INSERT INTO PROC_EstadoMateria (nombreEstadoMateria) VALUES ('$nombreEstadoMateria')";
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

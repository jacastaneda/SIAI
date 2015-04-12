<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$nombreUniversidad = $_POST['txtnombreUniversidad'];

    $conU = Conectar();
    $sqlU = "INSERT INTO PROC_Universidades (nombreUniversidad) VALUES ('$nombreUniversidad')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "La Universidad ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

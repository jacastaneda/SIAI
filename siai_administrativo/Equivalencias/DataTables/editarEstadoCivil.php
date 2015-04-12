<?php
require_once 'funciones/conexiones.php';
$idEstadoCivil = $_POST['txtidEstadoCivil'];
$nombreEstadoCivil = $_POST['txtnombreEstadoCivil'];

    $con = Conectar();
    $sql = "UPDATE PROC_EstadoCivil SET nombreEstadoCivil = '$nombreEstadoCivil' WHERE idEstadoCivil = '$idEstadoCivil'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El Estado Civil ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

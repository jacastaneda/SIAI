<?php
require_once 'funciones/conexiones.php';
$idEstadoMateriaSoli = $_POST['txtidEstadoMateriaSoli'];
$nombreEstadoMateria = $_POST['txtnombreEstadoMateria'];

    $con = Conectar();
    $sql = "UPDATE PROC_EstadoMateria SET nombreEstadoMateria = '$nombreEstadoMateria' WHERE idEstadoMateriaSoli = '$idEstadoMateriaSoli'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El Estado de la Materia ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

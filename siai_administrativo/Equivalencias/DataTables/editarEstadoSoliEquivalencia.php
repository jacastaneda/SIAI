<?php
require_once 'funciones/conexiones.php';
$idEstadoSolicitudEqui = $_POST['txtidEstadoSolicitudEqui'];
$nombreEstadoSoliEqui = $_POST['txtnombreEstadoSoliEqui'];
$estadoActivado = $_POST['txtestadoActivado'];
$descripcionEstado = $_POST['txtdescripcionEstado'];
    $con = Conectar();
    $sql = "UPDATE PROC_EstadoSoliEquivalencia SET nombreEstadoSoliEqui = '$nombreEstadoSoliEqui', estadoActivado = '$estadoActivado', descripcionEstado = '$descripcionEstado' WHERE idEstadoSolicitudEqui = '$idEstadoSolicitudEqui'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El Estado de la Solicitud ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

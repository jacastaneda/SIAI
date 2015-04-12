<?php
require_once 'funciones/conexiones.php';
$idEstadoSolicitudEqui = $_POST['txtidEstadoSolicitudEqui'];
$nombreEstadoSoliEqui = $_POST['txtnombreEstadoSoliEqui'];
$estadoActivado = $_POST['txtestadoActivado'];
$descripcionEstado = $_POST['txtdescripcionEstado'];

    $conU = Conectar();
    $sqlU = "INSERT INTO PROC_EstadoSoliEquivalencia (nombreEstadoSoliEqui, estadoActivado, descripcionEstado) VALUES ('$nombreEstadoSoliEqui','$estadoActivado','$descripcionEstado')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El Estado de la Solicitud ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

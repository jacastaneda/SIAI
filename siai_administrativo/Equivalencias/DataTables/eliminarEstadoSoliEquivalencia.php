<?php
    $idEstadoSolicitudEqui = $_POST['idEstadoSolicitudEqui'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_EstadoSoliEquivalencia WHERE idEstadoSolicitudEqui = '$idEstadoSolicitudEqui'";
    $q = mysql_query($sql, $con);
    
    echo "El Estado de la Solicitud ha sido eliminado satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

<?php
    $idSolicitud = $_POST['idSolicitud'];   

    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM proc_solicitudequivalencia WHERE idSolicitudEqui = '$idSolicitud'";
    $q = mysql_query($sql, $con);
    
    echo "La Solicitud ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

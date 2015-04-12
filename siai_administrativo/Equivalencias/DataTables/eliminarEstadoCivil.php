<?php
    $idEstadoCivil = $_POST['idEstadoCivil'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_EstadoCivil WHERE idEstadoCivil = '$idEstadoCivil'";
    $q = mysql_query($sql, $con);
    
    echo "El Estado Civil ha sido eliminado satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

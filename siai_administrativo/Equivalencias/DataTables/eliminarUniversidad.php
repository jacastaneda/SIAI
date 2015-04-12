<?php
    $idUniversidad = $_POST['idUniversidad'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_Universidades WHERE idUniversidad = '$idUniversidad'";
    $q = mysql_query($sql, $con);
    
    echo "La Universidad ha sido eliminado satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

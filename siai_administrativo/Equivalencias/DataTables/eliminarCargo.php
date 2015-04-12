<?php
    $idCargo = $_POST['idCargo'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM proc_cargo WHERE idCargo = '$idCargo'";
    $q = mysql_query($sql, $con);
    
    echo "El Cargo ha sido eliminado satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

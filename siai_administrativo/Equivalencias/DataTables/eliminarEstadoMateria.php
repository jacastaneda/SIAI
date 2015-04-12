<?php
    $idEstadoMateriaSoli = $_POST['idEstadoMateriaSoli'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_EstadoMateria WHERE idEstadoMateriaSoli = '$idEstadoMateriaSoli'";
    $q = mysql_query($sql, $con);
    
    echo "El Estado de la Materia ha sido eliminado satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

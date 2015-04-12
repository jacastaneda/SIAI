<?php
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];

    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_Facultades WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui'";
    $q = mysql_query($sql, $con);
    
    echo "La Facultad ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

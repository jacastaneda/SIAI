<?php
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];

    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_Carreras WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui' and idCarrera = '$idCarrera'";
    $q = mysql_query($sql, $con);
    
    echo "La Carreara ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

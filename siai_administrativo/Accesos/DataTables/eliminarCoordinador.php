<?php
$idCatedratico = $_POST['idCatedratico'];
$CODIGO_CAR = $_POST['CODIGO_CAR'];

    require_once '../../Franjas/Datatables/funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM proc_coordinadorcarrera WHERE idCatedratico= '$idCatedratico' AND CODIGO_CAR='$CODIGO_CAR'";
    $q = mysql_query($sql, $con);
    
    echo "El coordinador de carrera ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

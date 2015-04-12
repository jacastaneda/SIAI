<?php
$idFranja = $_POST['idFranja'];

    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM siai_franjas_inscripcion WHERE id_franja = '$idFranja'";
    $q = mysql_query($sql, $con);
    
    echo "La Franja ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();
    
?>

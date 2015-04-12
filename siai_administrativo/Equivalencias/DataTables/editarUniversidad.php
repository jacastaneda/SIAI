<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$nombreUniversidad = $_POST['txtnombreUniversidad'];

    $con = Conectar();
    $sql = "UPDATE PROC_Universidades SET nombreUniversidad = '$nombreUniversidad' WHERE idUniversidad = '$idUniversidad'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "La Universidad ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

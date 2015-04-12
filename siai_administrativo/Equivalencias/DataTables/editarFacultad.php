<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$idFacultadEqui = $_POST['txtidFacultadEqui'];
$nombreFacultadEqui = $_POST['txtnombreFacultadEqui'];
$idFacultadUPES = $_POST['txtidFacultadUPES'];

    $con = Conectar();
    $sql = "UPDATE PROC_Facultades SET nombreFacultadEqui = '$nombreFacultadEqui', idFacultadUPES = '$idFacultadUPES' WHERE idUniversidad = '$idUniversidad' and idFacultadEqui= '$idFacultadEqui'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "La Facultad ha sido actualizada satisfactoriamente...";
   }
   desconectar();
?>

<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$idFacultadEqui = $_POST['txtidFacultadEqui'];
$idCarrera = $_POST['txtidCarrera'];
$nombreCarreraEquivalencia = $_POST['txtnombreCarreraEquivalencia'];

    $con = Conectar();
    $sql = "UPDATE PROC_Carreras SET nombreCarreraEquivalencia = '$nombreCarreraEquivalencia' WHERE idUniversidad = '$idUniversidad' and idFacultadEqui= '$idFacultadEqui' and idCarrera= '$idCarrera'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "La Carrera ha sido actualizada satisfactoriamente...";
    }
    desconectar();
?>

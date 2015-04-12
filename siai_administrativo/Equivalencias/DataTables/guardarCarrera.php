<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$idFacultadEqui = $_POST['txtidFacultadEqui'];
$idCarrera = $_POST['txtidCarrera'];
$nombreCarreraEquivalencia = $_POST['txtnombreCarreraEquivalencia'];

    $conF = Conectar();
    $sqlF = "INSERT INTO PROC_Carreras (idUniversidad, idFacultadEqui, idCarrera, nombreCarreraEquivalencia) VALUES ('$idUniversidad','$idFacultadEqui','$idCarrera','$nombreCarreraEquivalencia')";
    $qF = mysql_query($sqlF, $conF);
    if(!$qF)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
        //echo mysql_errno($conF) . ": " . mysql_error($conF) . "\n";
    }
    else
    {
        echo "La Carreara ha sido almacenada satisfactoriamente...";
    }
    desconectar();    
    
?>

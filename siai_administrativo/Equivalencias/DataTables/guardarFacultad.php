<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$idFacultadEqui = $_POST['txtidFacultadEqui'];
//$nombreFacultadEqui = $_POST['txtnombreFacultadEqui'];
$idFacultadUPES = $_POST['txtidFacultadUPES'];

    $conF = Conectar();
    $sqlF = "INSERT INTO PROC_Facultades (idUniversidad,nombreFacultadEqui,idFacultadUPES) VALUES ('$idUniversidad','$nombreFacultadEqui','$idFacultadUPES')";
    $qF = mysql_query($sqlF, $conF);
    if(!$qF){
        echo "Ha ocurrido un error en el procesamiento de la informacion";
        //echo mysql_errno($conF) . ": " . mysql_error($conF) . "\n";
    }
    else{
        echo "La Facultad ha sido almacenada satisfactoriamente...";
    }
    desconectar();    
    
?>

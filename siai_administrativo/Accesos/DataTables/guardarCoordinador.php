<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';
$idCatedratico = $_POST['sltidCatedratico'];
$CODIGO_CAR = $_POST['sltCODIGO_CAR'];
//sltidCargo,txtNombres,txtApellidos,txtEmail, sltEstado
    $conU = Conectar();
    $sqlU = "INSERT INTO proc_coordinadorcarrera (idCatedratico, CODIGO_CAR, estatus) 
             VALUES ($idCatedratico, '$CODIGO_CAR', '1')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El coordinador de la carrera ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

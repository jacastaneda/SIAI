<?php
require_once 'funciones/conexiones.php';
$idCargo = $_POST['txtidCargo'];
$Nombre = $_POST['txtNombre'];
$Descripcion = $_POST['txtDescripcion'];
    $conU = Conectar();
    $sqlU = "INSERT INTO proc_cargo (idCargo,Nombre,Descripcion) VALUES ('$idCargo','$Nombre','$Descripcion')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El Cargo ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

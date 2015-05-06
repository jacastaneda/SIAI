<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';
$idCargo = $_POST['sltidCargo'];
$nombres = $_POST['txtNombres'];
$apellidos = $_POST['txtApellidos'];
$email=$_POST['txtEmail'];
$estado = $_POST['sltEstado'];
//sltidCargo,txtNombres,txtApellidos,txtEmail, sltEstado
    $conU = Conectar();
    $sqlU = "INSERT INTO proc_catedraticos (idCargo, Titulo, Nombres, Apellidos, Email, Estado) 
             VALUES ($idCargo,'T', '$nombres', '$apellidos', '$email', '1')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El catedratico ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

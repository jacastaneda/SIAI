<?php
require_once 'funciones/conexiones.php';
$idCargo = $_POST['txtidCargo'];
$Nombre = $_POST['txtNombre'];
$Descripcion = $_POST['txtDescripcion'];

    $con = Conectar();
    $sql = "UPDATE proc_cargo SET Nombre = '$Nombre', Descripcion = '$Descripcion' WHERE idCargo = '$idCargo'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El Cargo ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

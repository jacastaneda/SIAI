<?php
require_once '../../Franjas/Datatables/funciones/conexiones.php';
$idCatedratico = $_POST['txtidCatedratico'];
$idCargo = $_POST['sltidCargo'];
$nombres = $_POST['txtNombres'];
$apellidos = $_POST['txtApellidos'];
$email=$_POST['txtEmail'];
$estado = $_POST['sltEstado'];

    $con = Conectar();
    $sql = "UPDATE proc_catedraticos SET idCargo=$idCargo, Nombres='$nombres', Apellidos='$apellidos', Email='$email', Estado='$estado' WHERE idCatedratico = $idCatedratico";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El catedratico ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

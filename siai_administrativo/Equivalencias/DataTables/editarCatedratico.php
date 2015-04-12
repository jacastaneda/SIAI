<?php
require_once 'funciones/conexiones.php';
    $idCatedratico = $_POST['txtidCatedratico'];
    $idCargo = $_POST['txtidCargo'];
    $Titulo = $_POST['txtTitulo'];
    $Nombres = $_POST['txtNombres'];
    $Apellidos = $_POST['txtApellidos'];
    $Estado = $_POST['txtEstado'];
    $email = $_POST['txtemail'];
    
    $con = Conectar();
    $sql = "UPDATE proc_catedraticos SET idCargo = '$idCargo', Titulo = '$Titulo',Nombres = '$Nombres',Apellidos = '$Apellidos',Estado = '$Estado',email  = '$email' WHERE idCatedratico = '$idCatedratico'";
    $q = mysql_query($sql, $con);
    if(!$q){
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "El catedratico ha sido actualizado satisfactoriamente...";
    }
    desconectar();
?>

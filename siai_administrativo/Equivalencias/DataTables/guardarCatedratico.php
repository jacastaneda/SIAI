<?php
require_once 'funciones/conexiones.php';
$idCatedratico = $_POST['txtidCatedratico'];
$idCargo= $_POST['txtidCargo'];
$Titulo = $_POST['txtTitulo'];
$Nombres = $_POST['txtNombres'];
$Apellidos = $_POST['txtApellidos'];
$Estado = $_POST['txtEstado'];
$email = $_POST['txtemail'];

$conU = Conectar();
    $sqlU = "INSERT INTO proc_catedraticos (idCatedratico,idCargo,Titulo,Nombres,Apellidos,Estado,email) VALUES ('$idCatedratico','$idCargo','$Titulo','$Nombres','$Apellidos','$Estado','$email')";
    $qU = mysql_query($sqlU, $conU);
    if(!$qU){
        echo "Ha ocurrido un error en el procesamiento de la informacion";
    }
    else
    {
        echo "El Catedratico ha sido almacenado satisfactoriamente...";
    }
    desconectar();
    
?>

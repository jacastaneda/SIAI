<?php

    $idCargo = $_POST['idCargo'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT idCargo, Nombre, Descripcion FROM proc_cargo WHERE idCargo = '$idCargo'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $Nombre = $datos['Nombre'];
        $Descripcion = $datos['Descripcion'];
    }
    desconectar();
    $info['idCargo'] = $idCargo;
    $info['Nombre'] = $Nombre;       
    $info['Descripcion'] = $Descripcion;       
    echo json_encode($info);
?>

<?php

    $idUniversidad = $_POST['idUniversidad'];
    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT idUniversidad, nombreUniversidad FROM PROC_Universidades WHERE idUniversidad = '$idUniversidad'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreUniversidad = $datos['nombreUniversidad'];        
    }
    desconectar();
    $info['idUniversidad'] = $idUniversidad;
    $info['nombreUniversidad'] = $nombreUniversidad;       
    echo json_encode($info);
?>

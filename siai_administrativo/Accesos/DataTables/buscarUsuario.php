<?php

    $idCatedratico = $_POST['idCatedratico'];
    require_once '../../Franjas/Datatables/funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT * FROM proc_catedraticos WHERE idCatedratico = $idCatedratico";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $id_catedratico = $datos['idCatedratico'];
        $id_cargo = $datos['idCargo'];
        $nombres = utf8_encode($datos['Nombres']);
        $apellidos = utf8_encode($datos['Apellidos']);
        $email = $datos['email'];
        $estado = $datos['Estado'];
    }
    desconectar();
    $info['id_catedratico'] = $id_catedratico;
    $info['id_cargo'] = $id_cargo;
    $info['nombres'] = $nombres;  
    $info['apellidos'] = $apellidos;  
    $info['email'] = $email;    
    $info['estado'] = $estado;  
    echo json_encode($info);
?>

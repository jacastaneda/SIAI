<?php
    $codigo = $_POST['codigo'];
    require_once '../../Franjas/Datatables/funciones/conexiones.php';
    $con = Conectar();
    $sql = "SELECT * FROM usuarios AS u
                        LEFT OUTER JOIN proc_catedraticos AS C ON u.idCatedratico=c.idCatedratico WHERE CODIGO = '$codigo'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
//        print_r($datos);
        $codigo = $datos['CODIGO'];
        $email = $datos['email'];
        $nombre = utf8_encode($datos['NOMBRE']);
        $id_catedratico= $datos['idCatedratico'];
    }
    desconectar();
    $info['codigo'] = $codigo;
    $info['email'] = $email;
    $info['nombre'] = $nombre;  
    $info['id_catedratico'] = $id_catedratico;  
    echo json_encode($info);
?>

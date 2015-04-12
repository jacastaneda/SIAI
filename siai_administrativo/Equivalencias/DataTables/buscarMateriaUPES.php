<?php
    require_once 'funciones/conexiones.php';
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarreraUPES = $_POST['idCarreraUPES'];
    $idMateriaUPES = $_POST['idMateriaUPES'];
    
    
    $con = Conectar();
    $sql = "select a.CODIGO, a.NOMBRE, a.UNIDADVALO , p.CICLO
        from planes p, carrera c, asignatura a , sia_planes pc
        where p.CODIGO_PLA = pc.planes
        and c.CODIGO_CAR = pc.CODIGO_CAR
        and pc.estatus =1
            and c.CODIGO_CAR= '$idCarreraUPES' 
            and a.CODIGO ='$idMateriaUPES' 
            and c.FACULTAD = a.FACULTAD 
            and a.CODIGO = p.ASIGNATURA  
            order by p.CORRELATIV, p.CICLO";
    $q = mysql_query($sql, $con);
    $info = array();
    //console.log( 'This is log message $idCarreraUPES $idMateriaUPES' );
    while($datos = mysql_fetch_array($q))
    {
        $nombreMateriaUPES = $datos['NOMBRE'];
        $UVUPES = $datos['UNIDADVALO'];
        $CICLO = $datos['CICLO'];
    }
    desconectar();
    $info['idCarreraUPES'] = $idCarreraUPES;
    $info['idMateriaUPES'] = $idMateriaUPES;
    $info['nombreMateriaUPES'] = $nombreMateriaUPES;
    $info['UVUPES'] = $UVUPES;
    $info['ciclo'] = $CICLO;
    echo json_encode($info);  
?>
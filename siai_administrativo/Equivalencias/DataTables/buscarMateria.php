<?php
    require_once 'funciones/conexiones.php';
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];
    $idMateriaProcedencia = $_POST['idMateriaProcedencia'];
    
    
    $con = Conectar();
    $sql = "SELECT nombreMateriaProcedencia, idCiclo, UV FROM PROC_Materias WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui' and idCarrera = '$idCarrera' and idMateriaProcedencia = '$idMateriaProcedencia'";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreMateriaProcedencia = $datos['nombreMateriaProcedencia'];
        $idCiclo = $datos['idCiclo'];
        $UV = $datos['UV'];
    }
    desconectar();
    $info['idUniversidad'] = $idUniversidad;
    $info['idFacultadEqui'] = $idFacultadEqui;
    $info['idCarrera'] = $idCarrera;
    $info['idMateriaProcedencia'] = $idMateriaProcedencia;
    $info['nombreMateriaProcedencia'] = $nombreMateriaProcedencia;
    $info['idCiclo'] = $idCiclo;
    $info['UV'] = $UV;
    echo json_encode($info);
    
?>


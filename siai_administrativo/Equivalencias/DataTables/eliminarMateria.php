<?php
$idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];
    $idMateriaProcedencia = $_POST['idMateriaProcedencia'];

    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "DELETE FROM PROC_Materias WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui' and idCarrera = '$idCarrera' and idMateriaProcedencia = '$idMateriaProcedencia'";
    $q = mysql_query($sql, $con);
    
    echo "La Materia ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();
?>

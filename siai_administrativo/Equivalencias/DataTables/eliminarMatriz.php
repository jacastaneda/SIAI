<?php    
    require_once 'funciones/conexiones.php';
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];
    $idMateriaProcedencia = $_POST['idMateriaProcedencia'];
    $idCodCarreraUPES = $_POST['idCodCarreraUPES'];
    $IdCodAsignaturaUPES = $_POST['IdCodAsignaturaUPES'];    
    $con = Conectar();
    $sql = "DELETE FROM proc_matrizequivalencias WHERE idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui' and idCarrera = '$idCarrera' and idMateriaProcedencia = '$idMateriaProcedencia'    and idCodCarreraUPES= '$idCodCarreraUPES' and IdCodAsignaturaUPES='$IdCodAsignaturaUPES'";
    $q = mysql_query($sql, $con);    
    echo "La Matriz ha sido eliminada satisfactoriamente...".  mysql_error();
    desconectar();    
?>

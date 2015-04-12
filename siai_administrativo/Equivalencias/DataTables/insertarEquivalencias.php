<?php
    $idSolicitud = $_POST['idSolicitud'];
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultad'];
    $idCarrera = $_POST['idCarrera'];


    require_once 'funciones/conexiones.php';
    $con = Conectar();
    $sql = "insert into proc_analisismaterias(idSolicitudEqui,idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,idEstadoMateriaSoli,observacionMateria)
            select '$idSolicitud',idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,1,'Pendiente'
            from proc_matrizequivalencias where idUniversidad = '$idUniversidad' and idFacultadEqui = '$idFacultadEqui' and idCarrera ='$idCarrera'";
    $q = mysql_query($sql, $con);
    
    echo "Las Materias se han insertado satisfactoriamente...".  mysql_error();
    desconectar();
?>

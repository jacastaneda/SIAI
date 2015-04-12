<?php
    require_once 'funciones/conexiones.php';
    $idUniversidad = $_POST['txtidUniversidad'];
    $idFacultadEqui = $_POST['txtidFacultadEqui'];
    $idCarrera = $_POST['txtidCarrera'];
    $idCorrMateria = $_POST['txtidCorrMateria'];
    $idMateriaProcedencia = $_POST['txtidMateriaProcedencia'];
    $cicloPlan = $_POST['txtcicloPlan'];
    $UV_procedencia = $_POST['txtUV_procedencia'];
    $idCodCarreraUPES = $_POST['txtidCodCarreraUPES'];
    $IdCodAsignaturaUPES = $_POST['txtIdCodAsignaturaUPES'];
    $UV_upes = $_POST['txtUV_upes'];

    $conF = Conectar();
    $sqlF = "INSERT INTO proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,idCorrMateria,UV_upes,cicloPlan, UV_procedencia) values('$idUniversidad','$idFacultadEqui','$idCarrera','$idMateriaProcedencia','$idCodCarreraUPES','$IdCodAsignaturaUPES','$idCorrMateria','$UV_upes','$cicloPlan','$UV_procedencia')";
    $qF = mysql_query($sqlF, $conF);
    if(!$qF)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
        //echo mysql_errno($conF) . ": " . mysql_error($conF) . "\n";
    }
    else
    {
        echo "La Matriz ha sido almacenada satisfactoriamente...";
    }
    desconectar();    
    
?>

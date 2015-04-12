<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$idFacultadEqui = $_POST['txtidFacultadEqui'];
$idCarrera = $_POST['txtidCarrera'];
$idMateriaProcedencia = $_POST['txtidMateriaProcedencia'];
$nombreMateriaProcedencia = $_POST['txtnombreMateriaProcedencia'];
$idCiclo = $_POST['txtidCiclo'];
$UV = $_POST['txtUV'];

    $conF = Conectar();
    $sqlF = "INSERT INTO PROC_Materias (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, nombreMateriaProcedencia, idCiclo, UV) VALUES ('$idUniversidad','$idFacultadEqui','$idCarrera','$idMateriaProcedencia','$nombreMateriaProcedencia','$idCiclo', '$UV')";
    $qF = mysql_query($sqlF, $conF);
    if(!$qF)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion";
        //echo mysql_errno($conF) . ": " . mysql_error($conF) . "\n";
    }
    else
    {
        echo "La Materia ha sido almacenada satisfactoriamente...";
    }
    desconectar();    
    
?>

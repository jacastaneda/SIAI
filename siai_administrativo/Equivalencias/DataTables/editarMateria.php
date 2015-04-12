<?php
require_once 'funciones/conexiones.php';
$idUniversidad = $_POST['txtidUniversidad'];
$idFacultadEqui = $_POST['txtidFacultadEqui'];
$idCarrera = $_POST['txtidCarrera'];
$idMateriaProcedencia = $_POST['txtidMateriaProcedencia'];
$nombreMateriaProcedencia = $_POST['txtnombreMateriaProcedencia'];
$idCiclo = $_POST['txtidCiclo'];
$UV = $_POST['txtUV'];

    $con = Conectar();
    $sql = "UPDATE PROC_Materias SET nombreMateriaProcedencia = '$nombreMateriaProcedencia', idCiclo = '$idCiclo',UV = '$UV' WHERE idUniversidad = '$idUniversidad' and idFacultadEqui= '$idFacultadEqui' and idCarrera= '$idCarrera' and idMateriaProcedencia= '$idMateriaProcedencia'";
    $q = mysql_query($sql, $con);
    if(!$q)
    {
        echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
    }
    else
    {
        echo "La Materia ha sido actualizada satisfactoriamente...";
    }
    desconectar();
?>

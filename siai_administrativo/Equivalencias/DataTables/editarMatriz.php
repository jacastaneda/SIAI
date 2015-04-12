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

$con = Conectar();
$sql = "update PROC_MatrizEquivalencias 
    set idCorrMateria = '$idCorrMateria',UV_upes = '$UV_upes',cicloPlan = '$cicloPlan',UV_procedencia = '$UV_procedencia',  idCodCarreraUPES= '$idCodCarreraUPES',   IdCodAsignaturaUPES =  '$IdCodAsignaturaUPES' where idUniversidad= '$idUniversidad' and idFacultadEqui= '$idFacultadEqui' and idCarrera= '$idCarrera' and idMateriaProcedencia= '$idMateriaProcedencia' and idCodCarreraUPES= '$idCodCarreraUPES' and IdCodAsignaturaUPES='$IdCodAsignaturaUPES'";
$q = mysql_query($sql, $con);
if(!$q){
    echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
}
else{
    echo "La Matriz ha sido actualizada satisfactoriamente...";
}
desconectar();
?>

<?php
require_once 'funciones/conexiones.php';
$idSolicitudEqui = $_POST['txtidSolicitudEqui'];
$idUniversidad = $_POST['nomidUniversidad'];
$idFacultadEqui = $_POST['nomidFacultadEqui'];
$idCarrera = $_POST['nomidCarrera'];
$idMateriaProcedencia = $_POST['nomidMateriaProcedencia'];
$idCodCarreraUPES = $_POST['nomidCodCarreraUPES'];
$IdCodAsignaturaUPES = $_POST['nomidCodAsignaturaUPES'];
$idEstadoMateriaSoli = $_POST['txtidEstadoMateriaSoli'];
$observacionMateria = $_POST['txtobservacionMateria'];

$con = Conectar();
$sql = "update proc_analisismaterias set idEstadoMateriaSoli = '$idEstadoMateriaSoli',observacionMateria = '$observacionMateria' where idSolicitudEqui= '$idSolicitudEqui' and idUniversidad= '$idUniversidad' and idFacultadEqui= '$idFacultadEqui' and idCarrera= '$idCarrera' 
        and idMateriaProcedencia= '$idMateriaProcedencia' and idCodCarreraUPES= '$idCodCarreraUPES' and IdCodAsignaturaUPES='$IdCodAsignaturaUPES'";
$q = mysql_query($sql, $con);
if(!$q){
    echo "Ha ocurrido un error en el procesamiento de la informacion". $sql;
}
else{
    echo "La Materia de Equivalencia ha sido actualizada satisfactoriamente...";
}
desconectar();
?>

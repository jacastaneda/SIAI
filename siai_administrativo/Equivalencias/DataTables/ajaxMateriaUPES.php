<?php
require_once 'funciones/conexiones.php';
session_start();
$idUniversidad=$_POST['idUniversidad'];
$idFacultadEqui = $_POST['idFacultadEqui'];
$idCarreraUPES = $_POST['idCarreraUPES'];
$Accion = $_POST['Accion'];
$IdCodAsignaturaUPES = $_POST['IdCodAsignaturaUPES'];
$con = Conectar();
$sql = "select a.CODIGO, a.NOMBRE, a.UNIDADVALO , p.CICLO
        from planes p, carrera c, asignatura a , sia_planes pc
        where p.CODIGO_PLA = pc.planes
        and c.CODIGO_CAR = pc.CODIGO_CAR
        and pc.estatus =1
        and trim(c.CODIGO_CAR)= TRIM($idCarreraUPES)
        and c.FACULTAD = a.FACULTAD 
        and a.CODIGO = p.ASIGNATURA 
        and c.FACULTAD = (SELECT idFacultadUPES FROM PROC_Facultades where idUniversidad= $idUniversidad and idFacultadEqui= $idFacultadEqui) 
        and pc.planes = (select max(x.planes) from sia_planes x where x.CODIGO_CAR = c.CODIGO_CAR and x.estatus =1)
        order by p.CORRELATIV, a.CICLO";
//echo $sql;
$q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
echo '<option selected="selected">---Seleccione una Asignatura---</option>';
while($row = mysql_fetch_array($q)){
    $id=$row['CODIGO'];
    $data=$row['NOMBRE'];
    if ($Accion =='Nuevo'){
        echo '<option value="'.$id.'">'.$data.'</option>';
    }
    elseif ($Accion =='Editar'){
        if($IdCodAsignaturaUPES == $id){
            echo '<option selected value="'.$id.'">'.$data.'</option>';
        }
        else{
            echo '<option value="'.$id.'">'.$data.'</option>';
        }
    }
}    
desconectar();

?>



<?php
require_once 'funciones/conexiones.php';
session_start();
    $idUniversidad=$_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarreraUPES = $_POST['idCarreraUPES'];
    $Accion = $_POST['Accion'];
    $con = Conectar();
    $sql = "SELECT c.CODIGO_CAR, c.NOMBRE FROM carrera c, facultades f where f.codigo = c.FACULTAD and c.facultad = (SELECT idFacultadUPES FROM PROC_Facultades where idUniversidad= $idUniversidad and idFacultadEqui= $idFacultadEqui) order by f.CODIGO, c.CODIGO_CAR";
    $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
    echo '<option selected="selected">---Seleccione una Carrera---</option>';
    while($row = mysql_fetch_array($q)){
        $id=$row['CODIGO_CAR'];
        $data=$row['NOMBRE'];
        if ($Accion == 'Nuevo'){
            echo '<option value="'.$id.'">'.$data.'</option>';
        }
        elseif($Accion == 'Editar'){
            if ($idCarreraUPES == $id) {
                echo '<option selected value="'.$id.'">'.$data.'</option>';
            }
            else {
                echo '<option value="'.$id.'">'.$data.'</option>';
            }            
        }        
    }    
    desconectar();
?>
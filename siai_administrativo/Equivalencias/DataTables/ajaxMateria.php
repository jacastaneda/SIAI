<?php
require_once 'funciones/conexiones.php';
session_start();
    $idUniversidad=$_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];
    $idMateriaProcedencia = $_POST['idMateriaProcedencia'];
    $Accion = $_POST['Accion'];
    
    $con = Conectar();
    if ($Accion == 'idNombre') {
        $sql = "SELECT idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV FROM PROC_Materias where idUniversidad= $idUniversidad and idFacultadEqui = $idFacultadEqui and idCarrera = $idCarrera";
        $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");
        $totalRegistros = 0;
        echo '<option selected="selected">Seleccione una Materia</option>';    
        while($row = mysql_fetch_array($q)){
            $totalRegistros = $totalRegistros + 1;
            $id=$row['idMateriaProcedencia'];
            $data=$row['nombreMateriaProcedencia'];
            echo '<option value="'.$id.'">'.$data.'</option>';
        }
        if ($totalRegistros == 0) {            
            echo '<option selected="selected" >No Existen materia</option>';            
        }
    }
    elseif ($Accion == 'CicloUV'){
        $sql = "SELECT idCiclo, UV FROM PROC_Materias where idUniversidad= $idUniversidad and idFacultadEqui = $idFacultadEqui and idCarrera = $idCarrera and idMateriaProcedencia = $idMateriaProcedencia";
        $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");
        $info = array();
        while($datos = mysql_fetch_array($q)){
            $idCiclo = $datos['idCiclo'];        
            $UV = $datos['UV'];
        }        
        $info['idCiclo'] = $idCiclo;
        $info['UV'] = $UV;       
        echo json_encode($info);    
    }    
    elseif ($Accion == 'Editar') {
        $sql = "SELECT idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV FROM PROC_Materias where idUniversidad= $idUniversidad and idFacultadEqui = $idFacultadEqui and idCarrera = $idCarrera";
        $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");
        while($row = mysql_fetch_array($q)){
            $totalRegistros = $totalRegistros + 1;
            $id=$row['idMateriaProcedencia'];
            $data=$row['nombreMateriaProcedencia'];
            if ($idMateriaProcedencia== $id){
                echo '<option selected value="'.$id.'">'.$data.'</option>';
            }
            else{
                echo '<option value="'.$id.'">'.$data.'</option>';
            }            
        }        
    }
desconectar(); 
?>
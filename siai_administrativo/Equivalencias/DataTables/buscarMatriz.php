<?php
    require_once 'funciones/conexiones.php';    
   
    $idUniversidad= $_POST['idUniversidad'];
    $idFacultadEqui= $_POST['idFacultadEqui'];
    $idCarrera= $_POST['idCarrera'];
    $idMateriaProcedencia= $_POST['idMateriaProcedencia'];
    $idCodCarreraUPES= $_POST['idCodCarreraUPES'];
    $IdCodAsignaturaUPES= $_POST['IdCodAsignaturaUPES'];
       
    $con = Conectar();
    $sql = "SELECT me.idUniversidad, u.nombreUniversidad, me.idFacultadEqui, f.nombreFacultadEqui,";
    $sql = $sql ." me.idCarrera, c.nombreCarreraEquivalencia, me.idMateriaProcedencia, m.nombreMateriaProcedencia, me.idCodCarreraUPES, cp.NOMBRE as carreraUPES, me.IdCodAsignaturaUPES, ap.NOMBRE as materiaUPES, me.idCorrMateria,";
    $sql = $sql ." me.UV_upes, me.cicloPlan, me.UV_procedencia FROM PROC_MatrizEquivalencias me, PROC_Universidades U , PROC_Facultades F, PROC_Carreras C, PROC_Materias m, carrera cp, asignatura ap, planes pp";
    $sql = $sql ." where me.idUniversidad= '$idUniversidad' and me.idFacultadEqui = '$idFacultadEqui'  and me.idCarrera = '$idCarrera' and me.IdCodAsignaturaUPES = '$IdCodAsignaturaUPES'";
    $sql = $sql ." and u.idUniversidad= me.idUniversidad and f.idFacultadEqui = me.idFacultadEqui and f.idUniversidad = me.idUniversidad  and c.idCarrera = me.idCarrera";
    $sql = $sql ." and c.idFacultadEqui = me.idFacultadEqui  and c.idUniversidad = me.idUniversidad  and m.idMateriaProcedencia = me.idMateriaProcedencia  and m.idCarrera = me.idCarrera  and m.idFacultadEqui = me.idFacultadEqui  and m.idUniversidad = me.idUniversidad";
    $sql = $sql ." and cp.CODIGO_CAR = me.idCodCarreraUPES and pp.CODIGO_PLA = cp.CODIGO_CAR and cp.CODIGO_CAR= me.idCodCarreraUPES and ap.CODIGO = me.IdCodAsignaturaUPES and cp.FACULTAD = ap.FACULTAD and ap.CODIGO = pp.ASIGNATURA";

    $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
    $info = array();
    while($datos = mysql_fetch_array($q)){
//			$datos['nombreUniversidad'];
//                        $datos['nombreFacultadEqui'];
//                        $datos['nombreCarreraEquivalencia'];
//                        $datos['nombreMateriaProcedencia'];
//                        $datos['carreraUPES'];
//                        $datos['materiaUPES'];
        $idCorrMateria  = $datos['idCorrMateria'];
        $UV_upes= $datos['UV_upes'];
        $cicloPlan = $datos['cicloPlan'];
        $UV_procedencia = $datos['UV_procedencia'];
    }
    desconectar();
    $info['idUniversidad'] = $idUniversidad;
    $info['idFacultadEqui'] = $idFacultadEqui;
    $info['idCarrera'] = $idCarrera;
    $info['idMateriaProcedencia'] = $idMateriaProcedencia;
    $info['idCodCarreraUPES'] = $idCodCarreraUPES;
    $info['IdCodAsignaturaUPES'] = $IdCodAsignaturaUPES;
    $info['idCorrMateria'] = $idCorrMateria ;
    $info['UV_upes'] = $UV_upes ;
    $info['cicloPlan'] = $cicloPlan;
    $info['UV_procedencia']= $UV_procedencia;
    echo json_encode($info);    
?>
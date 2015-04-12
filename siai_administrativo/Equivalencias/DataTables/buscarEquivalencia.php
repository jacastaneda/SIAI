<?php
    require_once 'funciones/conexiones.php';
    $idSolicitud = $_POST['idSolicitud'];
    $idUniversidad = $_POST['idUniversidad'];
    $idFacultadEqui = $_POST['idFacultadEqui'];
    $idCarrera = $_POST['idCarrera'];
    $idMateriaProcedencia = $_POST['idMateriaProcedencia'];
    $idCodCarreraUPES = $_POST['idCodCarreraUPES'];
    $IdCodAsignaturaUPES = $_POST['IdCodAsignaturaUPES'];    
    
    $con = Conectar();
    $sql = "SELECT ame.idSolicitudEqui,ame.idUniversidad, u.nombreUniversidad, ame.idFacultadEqui, f.nombreFacultadEqui,ame.idCarrera, c.nombreCarreraEquivalencia, ame.idMateriaProcedencia, m.nombreMateriaProcedencia, 
                    ame.idCodCarreraUPES, cp.NOMBRE as carreraUPES, ame.IdCodAsignaturaUPES, ap.NOMBRE as materiaUPES, ame.idCorrMateSolicitada,ame.idEstadoMateriaSoli, eme.nombreEstadoMateria, ame.observacionMateria
                    FROM proc_analisismaterias ame, PROC_Universidades U , PROC_Facultades F, PROC_Carreras C, PROC_Materias m, carrera cp, asignatura ap, planes pp, proc_estadoMateria eme, sia_planes spp
                    where ame.idSolicitudEqui ='$idSolicitud' 
                    and ame.idUniversidad = '$idUniversidad'
                    and ame.idFacultadEqui ='$idFacultadEqui'
                    and ame.idCarrera = '$idCarrera'
                    and ame.idMateriaProcedencia ='$idMateriaProcedencia'
                    and ame.idCodCarreraUPES = '$idCodCarreraUPES'
                    and ame.IdCodAsignaturaUPES = '$IdCodAsignaturaUPES'
                    and u.idUniversidad= ame.idUniversidad and f.idFacultadEqui = ame.idFacultadEqui and f.idUniversidad = ame.idUniversidad  
                    and c.idCarrera = ame.idCarrera and c.idFacultadEqui = ame.idFacultadEqui  and c.idUniversidad = ame.idUniversidad and m.idMateriaProcedencia = ame.idMateriaProcedencia  
                    and m.idCarrera = ame.idCarrera  and m.idFacultadEqui = ame.idFacultadEqui  and m.idUniversidad = ame.idUniversidad and cp.CODIGO_CAR = ame.idCodCarreraUPES 
                    and trim(pp.CODIGO_PLA) = trim(spp.planes)
                                and trim(cp.CODIGO_CAR) = trim(spp.CODIGO_CAR)
                                and spp.planes =(select max(x.planes) from sia_planes x where x.CODIGO_CAR =  ame.idCodCarreraUPES and x.estatus =1)
                    and cp.CODIGO_CAR= ame.idCodCarreraUPES and ap.CODIGO = ame.IdCodAsignaturaUPES and cp.FACULTAD = ap.FACULTAD and ap.CODIGO = pp.ASIGNATURA
                    and eme.idEstadoMateriaSoli = ame.idEstadoMateriaSoli";
    $q = mysql_query($sql, $con);
    $info = array();
    while($datos = mysql_fetch_array($q))
    {
        $nombreUniversidad= $datos['nombreUniversidad'];
        $nombreFacultadEqui= $datos['nombreFacultadEqui'];
        $nombreCarreraEquivalencia= $datos['nombreCarreraEquivalencia'];
        $nombreMateriaProcedencia= $datos['nombreMateriaProcedencia'];
        $carreraUPES= $datos['carreraUPES'];
        $materiaUPES= $datos['materiaUPES'];
        $observacionMateria = $datos['observacionMateria'];
        $idEstadoMateriaSoli = $datos['idEstadoMateriaSoli'];
        
    }
    desconectar();

    $info['idSolicitudEqui'] = $idSolicitud;
    $info['idUniversidad'] = $nombreUniversidad;
    $info['idFacultadEqui'] = $nombreFacultadEqui;
    $info['idCarrera'] = $nombreCarreraEquivalencia;
    $info['idMateriaProcedencia'] = $nombreMateriaProcedencia;
    $info['idCodCarreraUPES'] = $carreraUPES;
    $info['IdCodAsignaturaUPES'] = $materiaUPES;
    $info['idEstadoMateriaSoli'] = $idEstadoMateriaSoli;
    $info['observacionMateria'] = $observacionMateria;
    echo json_encode($info);
    
?>


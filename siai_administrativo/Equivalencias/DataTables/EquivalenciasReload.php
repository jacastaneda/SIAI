<?php session_start(); 
require_once 'funciones/conexiones.php';
    if(isset($_POST["carnet"])) { 
        $_SESSION['carnet'] = serialize($_POST["carnet"]); 
    } 
    if(isset($_SESSION['carnet'])) { 
        $g_carnet = unserialize($_SESSION['carnet']); 
    }
    if(isset($_POST["idSolicitudEqui"])) { 
        $_SESSION['idSolicitudEqui'] = serialize($_POST["idSolicitudEqui"]); 
    } 
    if(isset($_SESSION['idSolicitudEqui'])) { 
        $g_idSolicitudEqui = unserialize($_SESSION['idSolicitudEqui']); 
    }
?>   
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<th>Id Solicitud</th>
                        <!--<th>Id</th>--> 
                        <th>Materia Original</th>                        
			<th>Carrera UPES</th>
                        <th>Materia UPES</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Editar</th>
                        
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT ame.idSolicitudEqui,ame.idUniversidad, u.nombreUniversidad, ame.idFacultadEqui, f.nombreFacultadEqui,ame.idCarrera, c.nombreCarreraEquivalencia, ame.idMateriaProcedencia, m.nombreMateriaProcedencia, 
                    ame.idCodCarreraUPES, cp.NOMBRE as carreraUPES, ame.IdCodAsignaturaUPES, ap.NOMBRE as materiaUPES, ame.idCorrMateSolicitada,ame.idEstadoMateriaSoli, eme.nombreEstadoMateria, ame.observacionMateria
                    FROM proc_analisismaterias ame, PROC_Universidades U , PROC_Facultades F, PROC_Carreras C, PROC_Materias m, carrera cp, asignatura ap, planes pp, proc_estadoMateria eme, sia_planes spp
                    where ame.idSolicitudEqui ='$g_idSolicitudEqui' and u.idUniversidad= ame.idUniversidad and f.idFacultadEqui = ame.idFacultadEqui and f.idUniversidad = ame.idUniversidad  
                    and c.idCarrera = ame.idCarrera and c.idFacultadEqui = ame.idFacultadEqui  and c.idUniversidad = ame.idUniversidad and m.idMateriaProcedencia = ame.idMateriaProcedencia  
                    and m.idCarrera = ame.idCarrera  and m.idFacultadEqui = ame.idFacultadEqui  and m.idUniversidad = ame.idUniversidad and cp.CODIGO_CAR = ame.idCodCarreraUPES 
                    and trim(pp.CODIGO_PLA) = trim(spp.planes)
                    and trim(cp.CODIGO_CAR) = trim(spp.CODIGO_CAR)
                    and spp.planes =(select max(x.planes) from sia_planes x where x.CODIGO_CAR =  ame.idCodCarreraUPES and x.estatus =1)
                    and cp.CODIGO_CAR= ame.idCodCarreraUPES and ap.CODIGO = ame.IdCodAsignaturaUPES and cp.FACULTAD = ap.FACULTAD and ap.CODIGO = pp.ASIGNATURA
                    and eme.idEstadoMateriaSoli = ame.idEstadoMateriaSoli 
                    order by idCorrMateSolicitada";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>    
                        <td><?php echo $datos['idSolicitudEqui']; ?></td>
                        <!--<td><?php // echo $datos['idCorrMateSolicitada']; ?></td>-->
			<td><?php echo $datos['nombreMateriaProcedencia']; ?></td>                        
                        <td><?php echo $datos['carreraUPES']; ?></td>			
                        <td><?php echo $datos['materiaUPES']; ?></td>
                        <td><?php echo $datos['nombreEstadoMateria']; ?></td>
                        <td><?php echo $datos['observacionMateria']; ?></td>
                        <td>                          
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idSolicitudEqui']; ?>','<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>','<?php echo $datos['idCodCarreraUPES']; ?>','<?php echo $datos['IdCodAsignaturaUPES']; ?>')" />
                        </td>                        
		</tr>
            <?php
            }
            desconectar();
            ?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
                        <!--<th></th>-->
                        <th></th>
                        <th></th>
			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>                        
		</tr>
	</tfoot>
</table>
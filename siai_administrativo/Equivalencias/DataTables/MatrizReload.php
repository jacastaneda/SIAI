<?php session_start(); 
require_once 'funciones/conexiones.php';
    if(isset($_POST["idUniversidad"])) { 
        $_SESSION['idUniversidad'] = serialize($_POST["idUniversidad"]); 
    } 
    if(isset($_SESSION['idUniversidad'])) { 
        $g_IdUniversidad = unserialize($_SESSION['idUniversidad']); 
    }
    if(isset($_POST["idFacultadEqui"])) { 
        $_SESSION['idFacultadEqui'] = serialize($_POST["idFacultadEqui"]); 
    } 
    if(isset($_SESSION['idFacultadEqui'])) { 
        $g_idFacultadEqui = unserialize($_SESSION['idFacultadEqui']); 
    }
    if(isset($_POST["idCarrera"])) { 
        $_SESSION['idCarrera'] = serialize($_POST["idCarrera"]); 
    } 
    if(isset($_SESSION['idCarrera'])) { 
        $g_idCarrera = unserialize($_SESSION['idCarrera']); 
    }
?>   
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
<!--			<th>Id Universidad</th>
                        <th>Id Facultad</th>
                        <th>Id Carrera</th>-->
                        <th>Id</th>
                        <th>Materia Procedencia</th>
                        <th>UV Procedencia</th>
                        <th>Carrera UPES</th>
                        <th>Asignatura UPES</th>
                        <th>Ciclo</th>
                        <th>UV UPES</th>
                        <th>Eliminar</th>
		</tr>
	</thead>	
	</tbody>
        <tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT trim(spp.planes), me.idUniversidad, u.nombreUniversidad, me.idFacultadEqui, f.nombreFacultadEqui,
                    me.idCarrera, c.nombreCarreraEquivalencia, me.idMateriaProcedencia, m.nombreMateriaProcedencia, me.idCodCarreraUPES, cp.NOMBRE as carreraUPES, me.IdCodAsignaturaUPES, ap.NOMBRE as materiaUPES, me.idCorrMateria,
                    me.UV_upes, me.cicloPlan, me.UV_procedencia
                    FROM PROC_MatrizEquivalencias me, PROC_Universidades U , PROC_Facultades F, PROC_Carreras C, PROC_Materias m, carrera cp, asignatura ap, planes pp, sia_planes spp
                    where me.idUniversidad= $g_IdUniversidad and me.idFacultadEqui = $g_idFacultadEqui  and me.idCarrera = $g_idCarrera and u.idUniversidad= me.idUniversidad 
                    and f.idFacultadEqui = me.idFacultadEqui 
                    and f.idUniversidad = me.idUniversidad  
                    and c.idCarrera = me.idCarrera
                    and c.idFacultadEqui = me.idFacultadEqui  
                    and c.idUniversidad = me.idUniversidad  
                    and m.idMateriaProcedencia = me.idMateriaProcedencia  
                    and m.idCarrera = me.idCarrera  
                    and m.idFacultadEqui = me.idFacultadEqui  
                    and m.idUniversidad = me.idUniversidad
                    and cp.CODIGO_CAR = me.idCodCarreraUPES 
                    and trim(pp.CODIGO_PLA) = trim(spp.planes)
                    and trim(cp.CODIGO_CAR) = trim(spp.CODIGO_CAR)
                    and trim(cp.CODIGO_CAR) = trim(me.idCodCarreraUPES) 
                    and trim(ap.CODIGO) = trim(me.IdCodAsignaturaUPES )
                    and cp.FACULTAD = ap.FACULTAD 
                    and ap.CODIGO = pp.ASIGNATURA
                    and spp.planes =(select max(x.planes) from sia_planes x where x.CODIGO_CAR =  me.idCodCarreraUPES and x.estatus =1)";
                    
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
<!--			<td><?php echo $datos['nombreUniversidad']; ?></td>
                        <td><?php echo $datos['nombreFacultadEqui']; ?></td>
                        <td><?php echo $datos['nombreCarreraEquivalencia']; ?></td>-->
                        <td><?php echo $datos['idCorrMateria']; ?></td>                        
                        <td><?php echo $datos['nombreMateriaProcedencia']; ?></td>
                        <td><?php echo $datos['UV_procedencia']; ?></td>
                        <td><?php echo $datos['carreraUPES']; ?></td>
                        <td><?php echo $datos['materiaUPES']; ?></td>
                        <td><?php echo $datos['cicloPlan']; ?></td>
                        <td><?php echo $datos['UV_upes']; ?></td>                        
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>','<?php echo $datos['idCodCarreraUPES']; ?>','<?php echo $datos['IdCodAsignaturaUPES']; ?>')" />
                        </td>                        
		</tr>
                <?php
            }
            ?>
	</tbody>
	<tfoot>
		<tr>
<!--			<th></th>
                        <th></th>
                        <th></th>-->
                        <th></th>
			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
		</tr>
	</tfoot>
</table>
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
    if(isset($_SESSION['idUniversidad'])) { 
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
			 <th>Id Materia</th>
			<th>Materia</th>
                        <th>Ciclo</th>
                        <th>Unidades Valorativas</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia,UV FROM PROC_Materias where idUniversidad= $g_IdUniversidad and idFacultadEqui = $g_idFacultadEqui and idCarrera = $g_idCarrera";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['idMateriaProcedencia']; ?></td>
			<td><?php echo $datos['nombreMateriaProcedencia']; ?></td>
                        <td><?php echo $datos['idCiclo']; ?></td>
                        <td><?php echo $datos['UV']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>','<?php echo $datos['idMateriaProcedencia']; ?>')" />
                        </td>
		</tr>
                <?php
            }
            ?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
		</tr>
	</tfoot>
</table>
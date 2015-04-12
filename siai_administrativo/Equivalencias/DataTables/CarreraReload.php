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
?>   
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
                        <th>Id Carrera</th>
			<th>Carrera</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Materia</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idUniversidad,idFacultadEqui,idCarrera, nombreCarreraEquivalencia 
                FROM PROC_Carreras where idUniversidad= $g_IdUniversidad and idFacultadEqui = $g_idFacultadEqui";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q))
            {
            ?>
		<tr>
                        <td><?php echo $datos['idCarrera']; ?></td>
			<td><?php echo $datos['nombreCarreraEquivalencia']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>','<?php echo $datos['idCarrera']; ?>')" />
                        </td>
                        <th>
                            <form action="Materia.php" method="post">
                                <input name="idUniversidad" id="idUniversidad" type="hidden" value="<?php echo $datos['idUniversidad']; ?>">
                                <input name="idFacultadEqui" id="idFacultadEqui" type="hidden" value="<?php echo $datos['idFacultadEqui']; ?>">
                                <input name="idCarrera" id="idCarrera" type="hidden" value="<?php echo $datos['idCarrera']; ?>">
                                <input value="Materias" type="submit">
                            </form>
                        </th>
		</tr>
                <?php
            }
            desconectar();
            ?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
		</tr>
	</tfoot>
</table>
<?php session_start(); 
require_once 'funciones/conexiones.php';
$ruta_assets='../../Equivalencias/DataTables/';
    if(isset($_POST["idCiclo"])) { 
        $_SESSION['idCiclo'] = serialize($_POST["idCiclo"]); 
    } 
    if(isset($_SESSION['idCiclo'])) { 
        $g_IdCiclo = unserialize($_SESSION['idCiclo']); 
    }
?>   
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<!--<th>Id Universidad</th>-->
                        <th>Id Franja</th>
			<th>Carrera</th>
                        <th>Fecha / hora Inicio</th>
                        <th>Fecha / hora Fin</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT f.id_franja, f.id_ciclo, f.CODIGO_CAR, f.fecha_hora_inicio, f.fecha_hora_fin, f.comentario, f.estado,
                    ci.ciclo,c.CODIGO_CAR, c.NOMBRE
                    FROM siai_franjas_inscripcion AS f
                    JOIN siai_ciclos AS ci ON ci.id_ciclo=f.id_ciclo 
                    JOIN carrera AS c ON c.CODIGO_CAR=f.CODIGO_CAR 
                    WHERE f.id_ciclo=$g_IdCiclo
                    ORDER BY ci.ciclo";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			
                        <td><?php echo $datos['id_franja']; ?></td>
                        <td><?php echo $datos['NOMBRE']; ?></td>
			<td><?php echo $datos['fecha_hora_inicio']; ?></td>
                        <td><?php echo $datos['fecha_hora_fin']; ?></td>
                        <td>
                            <img src="<?php echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['id_franja']; ?>')" />
                        </td>
                        <td>                          
                            <img src="<?php echo $ruta_assets;?>images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['id_franja']; ?>')" />
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
                        <th></th>
			<th></th>
                        <th></th>
                        <th></th>
                        <th></th>
		</tr>
	</tfoot>
</table>

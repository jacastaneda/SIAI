<?php session_start(); 
require_once 'funciones/conexiones.php';
$ruta_assets='../../Equivalencias/DataTables/';
    if(isset($_POST["Ciclo"])) { 
        $_SESSION['ciclo'] = serialize($_POST["Ciclo"]); 
    } 
    if(isset($_SESSION['ciclo'])) { 
        $ciclo_actual = unserialize($_SESSION['ciclo']); 
    }
    
    if(isset($_POST["Anio"])) { 
        $_SESSION['anio'] = serialize($_POST["Anio"]); 
    } 
    if(isset($_SESSION['anio'])) { 
        $anio_actual = unserialize($_SESSION['anio']); 
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
            $sql = "SELECT f.id_franja, f.anio, f.ciclo, f.CODIGO_CAR, f.fecha_hora_inicio, f.fecha_hora_fin, f.comentario, f.estado,
                    c.CODIGO_CAR, c.NOMBRE
                    FROM siai_franjas_inscripcion AS f
                    JOIN carrera AS c ON c.CODIGO_CAR=f.CODIGO_CAR 
                    WHERE f.ciclo=$ciclo_actual AND f.anio=$anio_actual
                    ORDER BY f.ciclo";
//            echo $sql;
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
                
            $PartesFechaHoraIni = explode('-', $datos['fecha_hora_inicio']);
            $PartesFechaHoraFin = explode('-', $datos['fecha_hora_fin']);
            $FechaHoraIni = $PartesFechaHoraIni[2].'/'.$PartesFechaHoraIni[1].'/'.$PartesFechaHoraIni[0];
            $FechaHoraFin = $PartesFechaHoraFin[2].'/'.$PartesFechaHoraFin[1].'/'.$PartesFechaHoraFin[0];                
            ?>
		<tr>
			
                        <td><?php echo $datos['id_franja']; ?></td>
                        <td><?php echo $datos['NOMBRE']; ?></td>
			<td><?php echo $FechaHoraIni; ?></td>
                        <td><?php echo $FechaHoraFin; ?></td>
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

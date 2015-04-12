<?php session_start(); 
require_once 'funciones/conexiones.php';
    if(isset($_POST["carnet"])) { 
        $_SESSION['carnet'] = serialize($_POST["carnet"]); 
    } 
    if(isset($_SESSION['carnet'])) { 
        $g_carnet = unserialize($_SESSION['carnet']); 
    }
?>   
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<th>Id Solicitud</th>
                        <th>Fecha Ingreso</th>
			<th>Estado</th>
                        <th>Ingresada Por</th>
                        <!--<th>Editar</th>-->
                        <th>Eliminar</th>
                        <th>Equivalencias</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "select se.idSolicitudEqui,se.idEstadoSolicitudEqui,DATE_FORMAT(fechaIngreSolicitud, '%d/%m/%Y') as fechaIngreSolicitud ,se.numeroCarne,se.nombresSolicitante,
                    se.PrimerApellidoSolicitante,se.segundoApellidoSolicitante,se.apellidoCasadaSolicitante,se.idCatedratico,
                    ct.Nombres,ct.Apellidos,es.nombreEstadoSoliEqui from proc_solicitudequivalencia se, proc_catedraticos ct, proc_estadosoliequivalencia es
                    where se.numeroCarne = '$g_carnet' and ct.idCatedratico= se.idCatedratico and es.idEstadoSolicitudEqui = se.idEstadoSolicitudEqui order by se.idSolicitudEqui";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>			
                        <td><?php echo $datos['idSolicitudEqui']; ?></td>
                        <td><?php echo $datos['fechaIngreSolicitud']; ?></td>
                        <td><?php echo $datos['nombreEstadoSoliEqui']; ?></td>			
                        <td><?php echo $datos['Nombres'].' '.$datos['Apellidos']; ?></td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idSolicitudEqui']; ?>')" />
                        </td>
                        <th>
                            <form action="Equivalencias.php" method="post">
                                <input name="CARNET" id="CARNET" type="hidden" value="<?php echo $datos['numeroCarne']; ?>">                                
                                <input name="idSolicitudEqui" id="idSolicitudEqui" type="hidden" value="<?php echo $datos['idSolicitudEqui']; ?>">
                                <input value="Equivalencias" type="submit">
                                <form action="Carrera.php" method="post">                                
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
                        <th></th>                        
		</tr>
	</tfoot>
</table>

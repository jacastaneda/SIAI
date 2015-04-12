<?php require_once('conexion.php');
$cn=  Conectarse();
$listado=  mysql_query("SELECT al.CARNET, al.NOMBRES,al.APELLIDO1,al.APELLIDO2,al.APELLCASAD,
ca.nombre
FROM  expedientealumno al
left JOIN carrera ca ON al.CODCARRERA = ca.CODIGO_CAR where al.FECHA_INGR > '2013-01-01'",$cn);
?>

 <script type="text/javascript" language="javascript" src="js/jslistadopaises.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_paises">
                <thead>
                    <tr>
                    	<th>Edit </th>
                      <th>Nombres </th>
                        <th>Carnet</th>
                        <th>Carrera </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                       
                     
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
							   echo '<td><a href="UpdateExpedienteAlumno.php?carnet='.$reg[CARNET].'"><img src="img/cog_edit.png" width="16" height="16" /></a></td>';
                               echo '<td >'.mb_convert_encoding($reg['NOMBRES']." ".$reg["APELLIDO1"]." ".$reg["APELLIDO2"], "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($reg['CARNET'], "UTF-8").'</td>';
							   echo '<td>'.mb_convert_encoding($reg['nombre'], "UTF-8").'</td>';
                               echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>

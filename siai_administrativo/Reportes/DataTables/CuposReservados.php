<?php
    session_start();
    require_once '../../Equivalencias/DataTables/funciones/conexiones.php';  
    include_once('../../clases/ClassControl.php');
    
    $control = new ClassControl();
    $ciclo_anio_actual=$control->CicloAnioActual();     
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Cupos Reservados por materia</title>
                
                <link href="../../Equivalencias/DataTables/media/css/redmond/jquery-ui-1.9.2.custom.css" type="text/css" rel="stylesheet" />                
		<style type="text/css" title="currentStyle">
			@import "../../Equivalencias/DataTables/media/css/demo_page.css";
			@import "../../Equivalencias/DataTables/media/css/demo_table.css";
                        @import "../../Equivalencias/DataTables/funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="../../Equivalencias/DataTables/media/js/jquery.js"></script>
		<script type="text/javascript"  src="../../Equivalencias/DataTables/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
                  function initTable (){
                      return $('#example').dataTable( {
                        "oLanguage":{"sUrl": "../../Equivalencias/DataTables/media/language/es_ES.txt"},                                               
                        "bRetrieve": true,
                        "bDestroy": true
                      } );
                    }

                    function tableActions (){
                      var oTable = initTable();
                      // perform API operations with oTable
                    }
                  function inicio(){  
                      initTable();
                    tableActions();
                  }
                  $(document).ready(function() {                                         
                    inicio();                    
               });
                    
		</script>
	</head>
	<body id="dt_example" class="ex_highlight_row">    	
	<div id="container" style="width:80%">

	<div class="full_width big">Cupos reservados</div>
        <h1>Informaci&oacute;n</h1>
        <?php
            $con1 = Conectar();
            //TODO: obtener ciclo y anio actual para incluir en el query
            //$ciclo_anio_actual='01/2015';
            
            $sql1 = "SELECT 
                    s.CICLO,s.CODIGO_ASI,a.NOMBRE,s.SECCION,s.CUPOS,s.RESERVACIO,s.UTILIZADOS,s.DISPONIBLE,
                    (select count(CODIGO_ASI) FROM asesoria AS ase
                    JOIN siai_control AS co ON ase.CARNET = co.usuario AND co.paso != 5
                    WHERE ase.CODIGO_ASI=a.CODIGO AND SUBSTR(s.CICLO,2,1) = co.ciclo
                    AND SUBSTR(s.CICLO,4,4) = co.anio AND ase.SECCION=s.SECCION) AS 
                    reservacion_no_concretada,
                    s.RESERVACIO - (select count(CODIGO_ASI) FROM asesoria AS ase
                    JOIN siai_control AS co ON ase.CARNET = co.usuario AND co.paso != 5
                    WHERE ase.CODIGO_ASI=a.CODIGO AND SUBSTR(s.CICLO,2,1) = co.ciclo
                    AND SUBSTR(s.CICLO,4,4) = co.anio AND ase.SECCION=s.SECCION) AS 
                    reservacion_concretada
                    FROM secciones AS s
                    JOIN asignatura AS a ON s.CODIGO_ASI=a.CODIGO 
                    WHERE s.CICLO='$ciclo_anio_actual'
                    ORDER BY a.NOMBRE";
            
            $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta ". mysql_error());
//            echo $sql1;
        ?>
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
                    <th>C&oacute;digo</th>
                    <th>Materia</th>
                    <th>Secci&oacute;n</th>
                    <th>Cupos reservados</th>
		</tr>
	</thead>
	<tbody name="" id=""> 
        <?php

            while($datos = mysql_fetch_array($q1)){
                ?>
                <tr>
                    <td><?php echo $datos['CODIGO_ASI'];?></td>
                    <td><?php echo $datos['NOMBRE'];?></td>
                    <td><?php echo $datos['SECCION'];?></td>
                    <td><?php echo $datos['reservacion_concretada'];?></td>
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
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>
        </div>
</body>
</html>
<?php
    session_start();
    require_once '../../Equivalencias/DataTables/funciones/conexiones.php';  
    include_once('../../clases/ClassControl.php');
    
    $control = new ClassControl();
    $ciclo_anio_actual=$control->CicloAnioActual2();     
    $ciclo_actual = $ciclo_anio_actual['ciclo'];
    $anio_actual = $ciclo_anio_actual['anio'];
    $carrera=$_GET['carrera'];
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

	<div class="full_width big">Alumnos Inscritos</div>
        <h1>Informaci&oacute;n</h1>
        <?php
            $con1 = Conectar();
            //TODO: obtener ciclo y anio actual para incluir en el query
            //$ciclo_anio_actual='01/2015';
            
            $sql1 = "SELECT e.CARNET, e.NOMBRES, e.APELLIDO1, e.APELLIDO2, asi.CODIGO, 
                    asi.NOMBRE
                    from siai_control AS sc
                    JOIN expedientealumno AS e ON sc.usuario = e.CARNET
                    JOIN  asesoria AS ase ON sc.usuario = ase.CARNET
                    JOIN asignatura AS asi ON ase.CODIGO_ASI = asi.CODIGO
                    WHERE sc.ciclo = $ciclo_actual AND sc.anio = $anio_actual
                    AND sc.paso = 5 ";
                    if(trim($carrera) != '' && trim($carrera) != 'TODO')
                    {
                       $sql1.=" AND e.CODCARRERA='$carrera' ";
                    }
            
            $sql1.=" ORDER BY e.NOMBRES, e.APELLIDO1, e.APELLIDO2, asi.NOMBRE";
            
            $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta ". mysql_error());
//            echo $sql1;
        ?>
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
                    <th>CARNET</th>
                    <th>NOMBRE</th>
                    <th>COD</th>
                    <th>NOMBRE ASIGNATURA</th>
		</tr>
	</thead>
	<tbody name="" id=""> 
        <?php

            while($datos = mysql_fetch_array($q1)){
                ?>
                <tr>
                    <td><?php echo $datos['CARNET'];?></td>
                    <td><?php echo $datos['NOMBRES']. ' ' .$datos['APELLIDO1']. ' ' .$datos['APELLIDO2'];?></td>
                    <td><?php echo $datos['CODIGO'];?></td>
                    <td><?php echo $datos['NOMBRE'];?></td>
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
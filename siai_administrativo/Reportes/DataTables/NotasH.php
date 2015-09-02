<?php
    session_start();
    require_once '../../Equivalencias/DataTables/funciones/conexiones.php';  
    include_once('../../clases/ClassControl.php');
    
    $control = new ClassControl();
    $ciclo_anio_actual=$control->CicloAnioActual2();     
    $ciclo_actual = $ciclo_anio_actual['ciclo'];
    $anio_actual = $ciclo_anio_actual['anio'];
    $carrera=$_GET['carrera'];
    
    if($_GET['export'] == 1)
    {
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        // output the column headings
        fputcsv($output, array('CARNET', 'CODIGO_ASI', 'NOTA1', 'NOTA2', 'NOTA3', 'NOTA4', 'PROMEDIO', 'MATRICULA', 'CICLO', 'TIPO_INS',
                'FECHA', 'SECCION', 'CODIGO_USU', 'FECHA_INGR', 'ANTIGUO', 'LABORATORI'));

        // fetch the data
        $con1 = Conectar();
        //TODO: obtener ciclo y anio actual para incluir en el query
        //$ciclo_anio_actual='01/2015';
        if (strlen($ciclo_actual) < 2) {
            $ciclo_actual = '0' . $ciclo_actual;
        }
        $ciclo = $ciclo_actual . '/' . $anio_actual;   

        $sql1 = "SELECT e.CARNET, asi.CODIGO,
                '0' AS NOTA1,
                '0' AS NOTA2,
                '0' AS NOTA3,
                '0' AS NOTA4,
                '0' AS PROMEDIO, 
                ase.MATRICULA,
                ase.CICLO_SIAI, 
                '1' AS TIPO_INS, 
                DATE_FORMAT(ase.FECHA_INGR,'%Y-%m-%d') AS FECHA, 
                ase.SECCION,
                ase.CODIGO_USU,
                ase.FECHA_INGR AS FECHA_INGR, 
                '' AS ANTIGUO,
                ase.ARANCEL AS LABORATORI
                from siai_control AS sc
                JOIN expedientealumno AS e ON sc.usuario = e.CARNET
                JOIN asesoria AS ase ON sc.usuario = ase.CARNET
                JOIN asignatura AS asi ON ase.CODIGO_ASI = asi.CODIGO
                WHERE sc.ciclo = $ciclo_actual AND sc.anio = $anio_actual
                AND ase.CICLO_SIAI = '$ciclo'
                AND sc.paso = 5 ";
                if(trim($carrera) != '' && trim($carrera) != 'TODO')
                {
                   $sql1.=" AND e.CODCARRERA='$carrera' ";
                }

        $sql1.=" ORDER BY e.NOMBRES, e.APELLIDO1, e.APELLIDO2, asi.NOMBRE";

        $rows = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta ". mysql_error());
        // loop over the rows, outputting them
        while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
        exit;
    }

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

	<div class="full_width big">Notas H</div>
        <h1>Informaci&oacute;n</h1>
        <?php
            $con1 = Conectar();
            //TODO: obtener ciclo y anio actual para incluir en el query
            //$ciclo_anio_actual='01/2015';
            if (strlen($ciclo_actual) < 2) {
                $ciclo_actual = '0' . $ciclo_actual;
            }
            $ciclo = $ciclo_actual . '/' . $anio_actual;   
            
            $sql1 = "SELECT e.CARNET, e.NOMBRES, e.APELLIDO1, e.APELLIDO2, asi.CODIGO, 
                    asi.NOMBRE, ase.MATRICULA, ase.CICLO_SIAI, ase.FECHA_INGR, ase.SECCION, ase.CODIGO_USU,
                    ase.FECHA_INGR, ase.ARANCEL, ase.CICLO
                    from siai_control AS sc
                    JOIN expedientealumno AS e ON sc.usuario = e.CARNET
                    JOIN asesoria AS ase ON sc.usuario = ase.CARNET
                    JOIN asignatura AS asi ON ase.CODIGO_ASI = asi.CODIGO
                    WHERE sc.ciclo = $ciclo_actual AND sc.anio = $anio_actual
                    AND ase.CICLO_SIAI = '$ciclo'
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
                    <th>CODIGO_ASI</th>
                    <th>NOTA1</th>
                    <th>NOTA2</th>
                    <th>NOTA3</th>
                    <th>NOTA4</th>
                    <th>PROMEDIO</th>
                    <th>MATRICULA</th>
                    <th>CICLO</th>
                    <th>TIPO_INS</th>
                    <th>FECHA</th>
                    <th>SECCION</th>
                    <th>CODIGO_USU</th>
                    <th>FECHA_INGR</th>
                    <th>ANTIGUO</th>
                    <th>LABORATORI</th>
		</tr>
	</thead>
	<tbody name="" id=""> 
        <?php

            while($datos = mysql_fetch_array($q1)){
                $partes_fec=explode(' ',$datos['FECHA_INGR']);
             
                ?>
                <tr>
                    <td><?php echo $datos['CARNET'];?></td>
                    <td><?php echo $datos['CODIGO'];?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $datos['MATRICULA'];?></td>
                    <td><?php echo $datos['CICLO_SIAI'];?></td>
                    <td><?php echo 1;?></td>
                    <td><?php echo $partes_fec[0];?></td>
                    <td><?php echo $datos['SECCION'];?></td>
                    <td><?php echo $datos['CODIGO_USU'];?></td>
                    <td><?php echo $datos['FECHA_INGR'];?></td>
                    <td></td>
                    <td><?php echo $datos['ARANCEL'];?></td>
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
            <?php
            $url_server='http://'.$_SERVER['SERVER_NAME'].'/siai/siai_administrativo/';
            ?>
        <a href="<?php echo $url_server;?>Reportes/DataTables/NotasH.php?export=1&carrera=<?php echo $carrera;?>" target="_blank">Exportar</a>
</body>
</html>
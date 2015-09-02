<?php 
session_start();
require_once '../Equivalencias/DataTables/funciones/conexiones.php';

if(($_SESSION["user"][0]["TIPO_USUAR"])==""){
	
	header ("Location: ../index.php");
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script src="../bootstrap/js/jquery-1.8.3.js"></script>
<script src="../bootstrap/js/bootstrap-collapse.js"></script> 
<script src="../bootstrap/js/bootstrap-dropdown.js"></script> 
<script src="../bootstrap/js/bootstrap-modal.js"></script> 
<style>
body {
	padding-top: 150px;
}
</style>
<title>SIAI</title>
</head>

<body>
    <?php
    include('../menu.php');
    ?>

<div class="container">
	<div class=" well well-small">Reporte Notas H</div>
<div class="well">
    <center>   
        <label for="anio_ingreso" ><b>Seleccione la Carrera</b></label>
        <?php
        $con1 = Conectar();
        
        $sql1 = "SELECT * FROM carrera WHERE TRIM(NOMBRE) != '' ORDER BY NOMBRE";

        $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta ". mysql_error());        
        ?>
        <select name="codigo_car" id="codigo_car">
            <option value="">Todas</option>
            <?php
                while($datos = mysql_fetch_array($q1)){
                    ?>
                    <option value='<?php echo $datos['CODIGO_CAR'];?>'><?php echo $datos['NOMBRE'];?></option>
                    <?php
                }   
                desconectar();
            ?>  
        </select>
        <br></br>        
        <iframe id="frameinscripcion" src="DataTables/NotasH.php?export=<?php echo $_GET['export'];?>" height="700px" width="900px" border="0"  frameborder="0" ></iframe>
    </center>
</div>
<footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<script>
    $('#codigo_car').on('change', function(){
        $('#frameinscripcion').attr('src','DataTables/NotasH.php?export=<?php echo $_GET['export'];?>&carrera='+$(this).val());
    })
</script>    


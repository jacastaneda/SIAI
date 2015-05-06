<?php session_start();
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
<!-- InstanceBeginEditable name="doctitle" -->
<title>SIAI</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<?php
include('../menu.php');
?>


<div class="container">
	<div class=" well well-small"><!-- InstanceBeginEditable name="EditRegion3" -->
            <h4><span class="full_width big">Catedr&aacute;ticos</span></h4>
	<!-- InstanceEndEditable --></div>

<div class="well"><!-- InstanceBeginEditable name="EditRegion4" --><center>
<iframe src="DataTables/Catedratico.php" height="700px" width="900px" border="0"  frameborder="0" ></iframe></center>

<!-- InstanceEndEditable --></div>
<footer> <strong>Universidad Politécnica de El Salvador <?php echo date('Y');?> </strong></footer>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
<!-- InstanceEnd --></html>

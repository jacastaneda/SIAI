<?php
    require_once 'funciones/conexiones.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
	<title>Ingreso por Equivalencias</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		body {
	background-color: #CCC;
}
        </style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
                  var procedimiento = "nuevo";            
                  $(document).ready(function() {                     
                    var num = 1;
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
		    var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "media/language/es_ES.txt"}} );               
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Universidad");
                    procedimiento = "nuevo";
                    num = num + 1;
                    
                    if ($("#btnNuevo").val()=="Agregar Universidad"){
                        $("#txtidUniversidad").attr("value",'');
                        $("#txtnombreUniversidad").attr("value",'');
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Universidad");
                    }
                    else{
                        alert("otro")
                    }
                })
                
                $("#btnProcesar").click(function(){
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();
                    
                    if(procedimiento == "nuevo")
                    {
                        $.ajax({
                        url: "guardarUniversidad.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r)
                            {
                                alert(r);
                                $("#loader").hide();
                                location.reload(true);
                            }
                        })
                    }
                    else if(procedimiento == "editar")
                    {
                        $.ajax({
                        url: "editarUniversidad.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r)
                            {
                                alert(r);
                                $("#loader").hide();
                                location.reload(true);
                            }
                    })
                    }
                  })
               });
         
		</script>
	</head>
	<body id="dt_example" class="ex_highlight_row">
		<div id="container" style="width:80%">
<h1>Informaci&oacute;n</h1>
			
                        <div class="demo_jui">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
<thead>
		<tr>
			<th>F. Ingreso</th>
                        <th>Carn&eacute;</th>
                        <th>Nombres</th>
                        <th>P. Apellido</th>
                        <th>S. Apellido</th>
                        <th>A. Casada</th>                        
                        <th>Solicitud</th>
                        
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "select DATE_FORMAT(ea.FECHA_INGR,'%d/%m/%Y') as FECHA_INGR,
                    ea.CARNET,
                    ea.NOMBRES,
                    ea.APELLIDO1,
                    ea.APELLIDO2,
                    ea.APELLCASAD
                    from expedientealumno ea
                    where ea.tipoingres= 'EQ'
                    AND ea.FECHA_INGR >= STR_TO_DATE('01/01/2012','%d/%m/%Y')
                    order by ea.FECHA_INGR, ea.carnet";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['FECHA_INGR']; ?></td>
			<td><?php echo $datos['CARNET']; ?></td>
                        <td><?php echo $datos['NOMBRES']; ?></td>
			<td><?php echo $datos['APELLIDO1']; ?></td>
                        <td><?php echo $datos['APELLIDO2']; ?></td>
			<td><?php echo $datos['APELLCASAD']; ?></td>
                        
                        <td>
                            <form action="SolicitudEquivalencia.php" method="post">
                                <input name="CARNET" id="CARNET" type="hidden" value="<?php echo $datos['CARNET']; ?>">
                                <input value="Solicitud" type="submit">
                            </form>
                        </td>
		</tr>
                <?php
            }
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
			<th></th>                        
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <!--<input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Universidad" />-->
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
        <div id="formularioRegistrar" align="center"  style='position:absolute; left: 35%; top:0px;  width:300px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:justify; border-radius:8px;box-shadow: 1px 1px 12px #555;'>
            <div id="procedimiento"></div>                
        </div>   
<?php 
//echo "</div></div>";
?>
</body>
</html>
<?php
    require_once 'funciones/conexiones.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Estado Materia para Equivalencia</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
                <script src="media/js/jquery-ui-1.9.2.custom.js"></script>
		<script type="text/javascript" charset="utf-8">
                  var procedimiento = "nuevo";            
                  $(document).ready(function() {
                      $(window).resize(function(){
                        $('#formularioRegistrar').css({
                            position:'absolute',
                            left: ($(window).width() - $('#formularioRegistrar').outerWidth())/2,
                            top: ($(window).height() - $('#formularioRegistrar').outerHeight())/2
                        });	  
                    });
                    $(window).resize();  
                    
                    $(".arrastable").draggable();
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
		    var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "media/language/es_ES.txt"}} );               
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nuevo Estado Materia");
                    procedimiento = "nuevo";
                                      
                    if ($("#btnNuevo").val()=="Agregar Estado Materia"){
                        $("#txtidEstadoMateriaSoli").attr("value",'');
                        $("#txtnombreEstadoMateria").attr("value",'');
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Estado Materia");
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
                        url: "guardarEstadoMateria.php",
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
                        url: "editarEstadoMateria.php",
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
            
            function eliminar(idEstadoMateriaSoli)
            {
                if(confirm("Esta seguro que desea eliminar el Estado de la Materia?"))
                {
                    //cedula=85150447
                    var v_idEstadoMateriaSoli = "idEstadoMateriaSoli="+idEstadoMateriaSoli;                    
                    $.ajax({
                        url:"eliminarEstadoMateria.php",
                        data: v_idEstadoMateriaSoli,
                        type: "POST",
                        success:
                            function(respuesta)
                            {
                                alert(respuesta);
                                location.reload(true);
                            }                        
                    })
                }
            }
            
            function editar(idEstadoMateriaSoli)
            {
                $("#leyenda").html("Actualizar Estado de la Materia");
                procedimiento = "editar";
                var v_idEstadoMateriaSoli = "idEstadoMateriaSoli="+idEstadoMateriaSoli;                    
                    $.ajax({
                        url:"buscarEstadoMateria.php",
                        data: v_idEstadoMateriaSoli,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidEstadoMateriaSoli").val(respuesta.idEstadoMateriaSoli);
                                $("#txtnombreEstadoMateria").val(respuesta.nombreEstadoMateria);                                  
                            }                        
                    })
            }   
</script>
	</head>
	<body id="dt_example" class="ex_highlight_row">
		<div id="container" style="width:80%">
<h1>Informaci&oacute;n</h1>
			
                        <div class="demo_jui">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<th>Id Estado Materia</th>
			<th>Estado Materia</th>
                        <th></th>
                        <th></th>                        
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idEstadoMateriaSoli, nombreEstadoMateria FROM PROC_EstadoMateria ORDER BY idEstadoMateriaSoli";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['idEstadoMateriaSoli']; ?></td>
			<td><?php echo $datos['nombreEstadoMateria']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idEstadoMateriaSoli']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idEstadoMateriaSoli']; ?>')" />
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
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Estado Materia" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
         <div class="arrastable" id="formularioRegistrar" align="center"  style='width:300px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px; background-color: #000000; color:white; '>Estado Materia</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nuevo Estado Materia</legend>   
                <table>
                    <tr>
                        <td>Id Estado Materia</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidEstadoMateriaSoli" name="txtidEstadoMateriaSoli" />
                        </td>
                    </tr>
                    <tr>
                        <td>Estado Materia</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtnombreEstadoMateria" name="txtnombreEstadoMateria"/>
                        </td>
                    </tr>                     
                    <tr>
                        <td>
                            <input type="button" id="btnProcesar" name="btnProcesar" value="Agregar" />
                        </td>
                        <td></td>
                        <td>
                            <input type="reset" name="btnBorrar" id="btnBorrar" value="Limp&iacute;ar Formulario" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <div id="loader">
                                <img src="images/loader.gif" />
                            </div>
                        </td>
                    </tr>
                </table> 
                </fieldset>
            </form>
                
        </div>   
<?php 
//echo "</div></div>";
?>
</body>
</html>
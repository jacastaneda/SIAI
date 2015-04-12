<?php
    require_once 'funciones/conexiones.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
		<title>Estado de la Solicitud de Equivalencia</title>
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
                    $("#leyenda").html("Registrar Nuevo Estado de la Solicitud de Equivalencia");
                    procedimiento = "nuevo";
                                      
                    if ($("#btnNuevo").val()=="Agregar Estado de la Solicitud"){
                        $("#txtidEstadoSolicitudEqui").attr("value",'');
                        $("#txtnombreEstadoSoliEqui").attr("value",'');
                        $("#txtestadoActivado").attr("value",'');
                        $("#txtdescripcionEstado").attr("value",'');                        
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Estado de la Solicitud");
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
                        url: "guardarEstadoSoliEquivalencia.php",
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
                        url: "editarEstadoSoliEquivalencia.php",
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
            
            function eliminar(idEstadoSolicitudEqui)
            {
                if(confirm("Esta seguro que desea eliminar el Estado de la Solicitud?"))
                {
                    //cedula=85150447
                    var v_idEstadoSolicitudEqui = "idEstadoSolicitudEqui="+idEstadoSolicitudEqui;                    
                    $.ajax({
                        url:"eliminarEstadoSoliEquivalencia.php",
                        data: v_idEstadoSolicitudEqui,
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
            
            function editar(idEstadoSolicitudEqui)
            {
                $("#leyenda").html("Actualizar Estado de la Solicitud");
                procedimiento = "editar";
                var v_idEstadoSolicitudEqui = "idEstadoSolicitudEqui="+idEstadoSolicitudEqui;                    
                    $.ajax({
                        url:"buscarEstadoSoliEquivalencia.php",
                        data: v_idEstadoSolicitudEqui,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidEstadoSolicitudEqui").val(respuesta.idEstadoSolicitudEqui);
                                $("#txtnombreEstadoSoliEqui").val(respuesta.nombreEstadoSoliEqui);
                                $("#txtestadoActivado").val(respuesta.estadoActivado);
                                $("#txtdescripcionEstado").val(respuesta.descripcionEstado);                                
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
			<th>Id Estado Solicitud</th>
			<th>Estado de la Solicitud</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                        <th></th>
                        <th></th>                        
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idEstadoSolicitudEqui, nombreEstadoSoliEqui, estadoActivado, descripcionEstado FROM PROC_EstadoSoliEquivalencia ORDER BY idEstadoSolicitudEqui";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['idEstadoSolicitudEqui']; ?></td>
			<td><?php echo $datos['nombreEstadoSoliEqui']; ?></td>
                        <td><?php echo $datos['estadoActivado']; ?></td>
                        <td><?php echo $datos['descripcionEstado']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idEstadoSolicitudEqui']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idEstadoSolicitudEqui']; ?>')" />
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
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Estado de la Solicitud" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:300px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px; background-color: #000000; color:white; '>Estado Solicitud de Equivalencia</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nuevo Estado de la Solicitud</legend>   
                <table>
                    <tr>
                        <td>Id Estado</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidEstadoSolicitudEqui" name="txtidEstadoSolicitudEqui" />
                        </td>
                    </tr>
                    <tr>
                        <td>Estado Solicitud</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtnombreEstadoSoliEqui" name="txtnombreEstadoSoliEqui"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtestadoActivado" name="txtestadoActivado"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Descripcion</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtdescripcionEstado" name="txtdescripcionEstado"/>
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
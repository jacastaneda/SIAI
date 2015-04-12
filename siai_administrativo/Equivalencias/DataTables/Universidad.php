<?php
    require_once 'funciones/conexiones.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
                <title>Instituci&oacute;n de Educaci&oacute;n Superior</title>
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
                    var num = 1;
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
		    var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "media/language/es_ES.txt"}} );               
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Instituci&oacute;n");
                    procedimiento = "nuevo";
                    num = num + 1;
                    
                    if ($("#btnNuevo").val()=="Agregar Institución"){
                        $("#txtidUniversidad").attr("value",'');
                        $("#txtnombreUniversidad").attr("value",'');
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Institución");
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
            
            function eliminar(idUniversidad)
            {
                if(confirm("Esta seguro que desea eliminar esta Institución?"))
                {
                    //cedula=85150447
                    var v_idUniversidad = "idUniversidad="+idUniversidad;                    
                    $.ajax({
                        url:"eliminarUniversidad.php",
                        data: v_idUniversidad,
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
            
            function editar(idUniversidad)
            {
                $("#leyenda").html("Actualizar Universidad");
                procedimiento = "editar";
                var v_idUniversidad = "idUniversidad="+idUniversidad;                    
                    $.ajax({
                        url:"buscarUniversidad.php",
                        data: v_idUniversidad,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidUniversidad").val(respuesta.idUniversidad);
                                $("#txtnombreUniversidad").val(respuesta.nombreUniversidad);                                  
                            }                        
                    })
            }
         function Facultad(idUniversidad)
            {
                //$("#leyenda").html("Actualizar Universidad");
                //procedimiento = "editar";
                var idUniversidad = "idUniversidad="+idUniversidad;                    
                    $.ajax({
                        url:"Facultad.php",
                        data: idUniversidad,
                        type: "POST",
                        dataType: "json"                        
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
			<th>Id Instituci&oacute;n</th>
			<th>Instituci&oacute;n</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Facultades</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idUniversidad, nombreUniversidad FROM proc_universidades ORDER BY idUniversidad";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            ?>
            <?php
            while($datos = mysql_fetch_array($q))
            {
            ?>
		<tr>
			<td><?php echo $datos['idUniversidad']; ?></td>
			<td><?php echo $datos['nombreUniversidad']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idUniversidad']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>')" />
                        </td>
                        <th>
                            <form action="Facultad2.php" method="post">
                                <input name="idUniversidad" id="idUniversidad" type="hidden" value="<?php echo $datos['idUniversidad']; ?>">
                                <input value="Facultades" type="submit">
                            </form>
                        </th>
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
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Instituci&oacute;n" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
                <div class="arrastable" id="formularioRegistrar" align="center"  style='width:450px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Instituci&oacute;n de Educaci&oacute;n Superior</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Instituci&oacute;n</legend>   
                <table>
                    <tr>
                        <td>Id Instituci&oacute;n</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidUniversidad" name="txtidUniversidad" />
                        </td>
                    </tr>
                    <tr>
                        <td>Instituci&oacute;n</td>
                        <td>:</td>
                        <td>
                            <input required type="text" size ="50" id="txtnombreUniversidad" name="txtnombreUniversidad"/>
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
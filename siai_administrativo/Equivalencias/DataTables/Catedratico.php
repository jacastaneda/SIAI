<?php
    require_once 'funciones/conexiones.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
                <title>Catedr&aacute;ticos</title>
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
                    $("#leyenda").html("Registrar Nuevo Catedr&aacute;tico");
                    procedimiento = "nuevo";
                    num = num + 1;
                    
                    if ($("#btnNuevo").val()=="Agregar Catedr&aacute;tico"){
                        $("#txtidCatedratico").attr("value",'');
                        $("#txtidCargo").attr("value",'');
                        $("#txtTitulo").attr("value",'');
                        $("#txtNombres").attr("value",'');
                        $("#txtApellidos").attr("value",'');
                        $("#txtEstado").attr("value",'');
                        $("#txtemail").attr("value",'');
                        
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Catedr&aacute;tico");
                    }
                    else{
                        alert("otro")
                    }
                })
                
                $("#btnProcesar").click(function(){
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();
                    
                    if(procedimiento == "nuevo"){
                        $.ajax({
                        url: "guardarCatedratico.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                location.reload(true);
                            }
                        })
                    }
                    else if(procedimiento == "editar"){
                        $.ajax({
                        url: "editarCatedratico.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                location.reload(true);
                            }
                    })
                    }
                  })
               });
            
            function eliminar(idCargo){
                if(confirm("Esta seguro que desea eliminar esta Universidad?")){
                    //cedula=85150447
                    var v_idCargo = "idCargo="+idCargo;                    
                    $.ajax({
                        url:"eliminarCargo.php",
                        data: v_idCargo,
                        type: "POST",
                        success:
                            function(respuesta){
                                alert(respuesta);
                                location.reload(true);
                            }                        
                    })
                }
            }
            
            function editar(idCargo){
                $("#leyenda").html("Actualizar Cargo");
                procedimiento = "editar";
                var v_idCargo = "idCargo="+idCargo;                    
                    $.ajax({
                        url:"buscarCargo.php",
                        data: v_idCargo,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta){
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidCargo").val(respuesta.idCargo);
                                $("#txtNombre").val(respuesta.Nombre);                                  
                                $("#txtDescripcion").val(respuesta.Descripcion);
                            }                        
                    })
            }
 
		</script>
	</head>
	<body id="dt_example" class="ex_highlight_row">
		<div id="container" style="width:80%">
			<div class="full_width big">
				Cargos
			</div>
                    <h1>Informaci&oacute;n</h1>
			
                        <div class="demo_jui">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<th>Id Cargo</th>
			<th>Cargo</th>
                        <th>Descripci&oacute;n</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idCargo, Nombre,Descripcion FROM proc_cargo ORDER BY idCargo";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['idCargo']; ?></td>
			<td><?php echo $datos['Nombre']; ?></td>
                        <td><?php echo $datos['Descripcion']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idCargo']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idCargo']; ?>')" />
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
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Cargo" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
                <div class="arrastable" id="formularioRegistrar" align="center"  style='width:450px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px; background-color: #000000; color:white; '>Cargo</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Universidad</legend>   
                <table>
                    <tr>
                        <td>Id Cargo</td>
                        <td>:</td>
                        <td>
                            <input type="text"  id="txtidCargo" name="txtidCargo" />
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>:</td>
                        <td>
                            <input type="text" size ="50" id="txtNombre" name="txtNombre"/>
                        </td>
                    </tr>                     
                    <tr>
                        <td>Descripcion</td>
                        <td>:</td>
                        <td>
                            <input type="text" size ="50" id="txtDescripcion" name="txtDescripcion"/>
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
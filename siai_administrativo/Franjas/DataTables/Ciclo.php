<?php
    require_once 'funciones/conexiones.php';
    $ruta_assets='../../Equivalencias/DataTables/';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
                <title>Ciclo</title>
                <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">       
                <link href="../../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />                
		<style type="text/css" title="currentStyle">
			@import "<?php echo $ruta_assets;?>media/css/demo_page.css";
			@import "<?php echo $ruta_assets;?>media/css/demo_table.css";
			@import "<?php echo $ruta_assets;?>funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="<?php echo $ruta_assets;?>media/js/jquery.js"></script>
		<script type="text/javascript"  src="<?php echo $ruta_assets;?>media/js/jquery.dataTables.js"></script>
                <script src="<?php echo $ruta_assets;?>media/js/jquery-ui-1.9.2.custom.js"></script>
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
		    var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "<?php echo $ruta_assets;?>media/language/es_ES.txt"}} );               
                    $("#btnNuevo").click(function(){
                        $("#leyenda").html("Registrar Nuevo Ciclo");
                        procedimiento = "nuevo";
                        num = num + 1;

                        if ($("#btnNuevo").val()=="Agregar Ciclo"){
                            $("#txtidCiclo").attr("value",'');
                            $("#txtAnio").attr("value",'');
                            $("#sltNumCiclo").attr("value",'');
                            $("#sltActivo").attr("value",'');
                            $("#formularioRegistrar").show();
                            $("#btnNuevo").val("Cancelar");
                        }
                        else if ($("#btnNuevo").val()=="Cancelar"){
                            $("#formularioRegistrar").hide();
                            $("#btnNuevo").val("Agregar Ciclo");
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
                        url: "guardarCiclo.php",
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
//                        alert(datos)
                        $.ajax({
                        url: "editarCiclo.php",
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
                if(confirm("Esta seguro que desea eliminar este ciclo?"))
                {
                    //cedula=85150447
                    var v_idUniversidad = "idUniversidad="+idUniversidad;                    
                    $.ajax({
                        url:"eliminarCiclo.php",
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
            
            function editar(idCiclo)
            {
                $("#leyenda").html("Actualizar Ciclo");
                procedimiento = "editar";
                var v_idCiclo = "idCiclo="+idCiclo;                    
                    $.ajax({
                        url:"buscarCiclo.php",
                        data: v_idCiclo,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidCiclo").val(respuesta.id_ciclo);
                                $("#txtAnio").val(respuesta.anio);
                                $("#sltNumCiclo").val(respuesta.num_ciclo);
                                $("#sltActivo").val(respuesta.activo);                             
                            }                        
                    })
            }
         function Franja(idCiclo)
            {
                //$("#leyenda").html("Actualizar Universidad");
                //procedimiento = "editar";
                var idCiclo = "idCiclo="+idCiclo;                    
                    $.ajax({
                        url:"Franja.php",
                        data: idCiclo,
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
			<th>Id Ciclo</th>
                        <th>A&ntilde;o</th>
			<th>Ciclo</th>
                        <th>Estado</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Franjas</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            
            $con = Conectar();
            $sql = "SELECT id_ciclo, ciclo, anio, num_ciclo, activo FROM siai_ciclos ORDER BY id_ciclo DESC";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            ?>
            <?php
            while($datos = mysql_fetch_array($q))
            {
            ?>
		<tr>
			<td><?php echo $datos['id_ciclo']; ?></td>
                        <td><?php echo $datos['anio']; ?></td>
			<td><?php echo ($datos['num_ciclo'] == 1) ? 'Impar' : 'Par' ; ?></td>
                        <td><?php echo ($datos['activo'] == 1) ? 'Activo' : 'Inactivo' ; ?></td>
                        <td>
                            <img src="<?php echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['id_ciclo']; ?>')" />
                        </td>
                        <td>                          
                            <img src="<?php echo $ruta_assets;?>images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['id_ciclo']; ?>')" />
                        </td>
                        <th>
                            <form action="Franja2.php" method="post">
                                <input name="idCiclo" id="idCiclo" type="hidden" value="<?php echo $datos['id_ciclo']; ?>">
                                <input value="Franjas" type="submit">
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
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Ciclo" />
        </div>
        <br />
        <?php
        
        //define("STYLE_OVERLAY", "visibility: visible;position: absolute;left: 0px;top: 0px; width:100%;height:100%;text-align:center;z-index: 1000;");
        //define("STYLE_WIN", "width: 600px ;margin: 150px auto;background-color: #fff;border:2px solid cornflowerblue;padding:15px;text-align:center; border-radius:8px;box-shadow: 1px 1px 12px #555; ");
        //echo "<div id='overlay' style='" . STYLE_OVERLAY . "'>";
        //echo "<div style='" . STYLE_WIN . "'>";        
         
        ?>    
                <div class="arrastable" id="formularioRegistrar" align="center"  style='width:450px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Ciclo</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nuevo Ciclo</legend>   
                <table>
                    <tr>
                        <td>Id Ciclo</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidCiclo" name="txtidCiclo" />
                        </td>
                    </tr>
                    <tr>
                        <td>A&ntilde;o</td>
                        <td>:</td>
                        <td>
                            <input required type="number" size ="50" id="txtAnio" name="txtAnio" value="<?php echo date('Y');?>"/>
                        </td>
                    </tr> 
                    <tr>
                        <td>Ciclo</td>
                        <td>:</td>
                        <td>
                            <select id="sltNumCiclo" name="sltNumCiclo">
                                <option value="1">Impar</option>
                                <option value="2">Par</option>
                            </select>
                        </td>
                    </tr>         
                    <tr>
                        <td>Estado</td>
                        <td>:</td>
                        <td>
                            <select id="sltActivo" name="sltActivo">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
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
                                <img src="<?php echo $ruta_assets;?>images/loader.gif" />
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
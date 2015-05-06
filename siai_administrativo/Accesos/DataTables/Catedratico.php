<?php
    require_once '../../Franjas/Datatables/funciones/conexiones.php';
    $ruta_assets='../../Equivalencias/DataTables/';  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
                <title>Catedr&aacute;tico</title>
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
                        $("#leyenda").html("Registrar catedratico");
                        procedimiento = "nuevo";
                        num = num + 1;

                        if ($("#btnNuevo").val()=="Agregar Catedratico"){
                            //sltidCargo,txtNombres,txtApellidos,txtEmail, sltEstado
                            $("#sltidCargo").attr("value",'1');
                            $("#txtNombres").attr("value",'');
                            $("#txtApellidos").attr("value",'');
                            $("#txtEmail").attr("value",'');
                            $("#sltEstado").attr("value",'1');
                            $("#formularioRegistrar").show();
                            $("#btnNuevo").val("Cancelar");
                        }
                        else if ($("#btnNuevo").val()=="Cancelar"){
                            $("#formularioRegistrar").hide();
                            $("#btnNuevo").val("Agregar Catedratico");
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
                        url: "guardarCatedratico.php",
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
                        url: "editarCatedratico.php",
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
            
//            function eliminar(idCatedratico)
//            {
//                if(confirm("Esta seguro que desea eliminar este catedratico?"))
//                {
//                    //cedula=85150447
//                    var v_idCatedratico = "idCatedratico="+idCatedratico;                    
//                    $.ajax({
//                        url:"eliminarCatedratico.php",
//                        data: v_idCatedratico,
//                        type: "POST",
//                        success:
//                            function(respuesta)
//                            {
//                                alert(respuesta);
//                                location.reload(true);
//                            }                        
//                    })
//                }
//            }
            
            function editar(idCatedratico)
            {
                $("#leyenda").html("Actualizar Catedratico");
                procedimiento = "editar";
                var v_idCatedratico = "idCatedratico="+idCatedratico;                    
                    $.ajax({
                        url:"buscarCatedratico.php",
                        data: v_idCatedratico,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidCatedratico").val(respuesta.id_catedratico);   
                                $("#sltidCargo").val(respuesta.id_cargo);
                                $("#txtNombres").val(respuesta.nombres);
                                $("#txtApellidos").val(respuesta.apellidos);
                                $("#txtEmail").val(respuesta.email);
                                $("#sltEstado").val(respuesta.estado);                                
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
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Modificar</th>
                        <!--<th>Eliminar</th>-->
                    </tr>
            </thead>
            <tbody> 
                <?php
                $con = Conectar();
                $sql = "SELECT *
                    FROM proc_catedraticos";
                $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
                while($datos = mysql_fetch_array($q)){
                ?>
                    <tr>
                            <td><?php echo utf8_encode($datos['Nombres']); ?></td>
                            <td><?php echo utf8_encode($datos['Apellidos']); ?></td>
                            <td><?php echo $datos['email']; ?></td>
                            <td>
                                <img src="<?php echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idCatedratico']; ?>')" />
                            </td>
<!--                            <td>                          
                                <img src="<?php echo $ruta_assets;?>images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idCatedratico']; ?>')" />
                            </td>-->
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
                    <!--<th></th>-->                    
                </tr>
            </tfoot>
    </table>
</div>
			<div class="spacer"></div>			
		</div>
            
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Catedratico" />
        </div>
        <br />
        <?php
        ?>    
        
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Franja horaria</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nuevo Catedr&aacute;tico</legend>   
                <table width="502">
                    <tr>
                        <td width="161">Id Catedr&aacute;tico</td>
                        <td width="13">:</td>
                        <td width="312">
                            <input type="text" readonly="readonly" id="txtidCatedratico" name="txtidCatedratico" />
                        </td>
                    </tr>
                    <tr>
                        <td>Cargo</td>
                        <td>:</td>
                        <td>
                            <select name="sltidCargo" id="sltidCargo">                        
                            <?php
                                $con2 = Conectar();
                                $sql2 = "SELECT * FROM proc_cargo where LENGTH(NOMBRE) > 0";
                                $q2 = mysql_query($sql2, $con2) or die ("Problemas al ejecutar la consulta");                
                                while($datos2 = mysql_fetch_array($q2)){
                                    echo '<option value="'.$datos2['idCargo'].'">'.$datos2['Nombre'].'</option>';
                                }   
                                desconectar();
                            ?>
                            </select>                            
                        </td>
                    </tr>                     
                    <tr>
                        <td>Nombres</td>
                        <td>:</td>
                        <td>
                           <input type="text" id="txtNombres" name="txtNombres" />
                        </td>
                    </tr>   
                    <tr>
                        <td>Apellidos</td>
                        <td>:</td>
                        <td>
                           <input type="text" id="txtApellidos" name="txtApellidos" />
                        </td>
                    </tr>   
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtEmail" name="txtEmail" />
                        </td>                        
                    </tr>   
                    <tr>
                        <td>Estado</td>
                        <td>:</td>
                        <td>
                            <select name="sltEstado" id="sltEstado">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </td>                        
                    </tr>                    
                    <tr>
                        <td nowrap  colspan="2" align="right" >
                            <input type="button" id="btnProcesar" name="btnProcesar" value="Agregar" />
                        </td>
                        <td align="center">
                            <input type="reset" align="center"  name="btnBorrar" id="btnBorrar" value="Limp&iacute;ar Formulario" />
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
</body>
</html>
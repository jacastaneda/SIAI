<?php
    require_once '../../Franjas/Datatables/funciones/conexiones.php';
    $ruta_assets='../../Equivalencias/DataTables/';  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
                <title>Coordinador de carrera</title>
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

                        if ($("#btnNuevo").val()=="Agregar Coordinador"){
                            //sltidCargo,txtNombres,txtApellidos,txtEmail, sltEstado
//                            $("#sltidCatedratico").attr("value",'1');
//                            $("#sltCODIGO_CAR").attr("value",'1');
                            $("#formularioRegistrar").show();
                            $("#btnNuevo").val("Cancelar");
                        }
                        else if ($("#btnNuevo").val()=="Cancelar"){
                            $("#formularioRegistrar").hide();
                            $("#btnNuevo").val("Agregar Coordinador");
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
                        url: "guardarCoordinador.php",
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
                     
            function eliminar(idCatedratico, CODIGO_CAR)
            {
                if(confirm("Esta seguro que desea eliminar este coordinador de carrera?"))
                {
                    var v_idCatedraticoCAR = "idCatedratico="+idCatedratico+'&CODIGO_CAR='+CODIGO_CAR;                    
                    $.ajax({
                        url:"eliminarCoordinador.php",
                        data: v_idCatedraticoCAR,
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
                        <th>Carrera</th>
                        <th>Coordinador</th>
                        <!--<th>Modificar</th>-->
                        <th>Eliminar</th>
                    </tr>
            </thead>
            <tbody> 
                <?php
                $con = Conectar();
                $sql = "SELECT * FROM `proc_coordinadorcarrera` AS cc
                        JOIN carrera AS c ON cc.CODIGO_CAR=c.CODIGO_CAR
                        JOIN proc_catedraticos AS cat ON cc.idCatedratico=cat.idCatedratico";
                
                $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
                while($datos = mysql_fetch_array($q)){
                ?>
                    <tr>
                            <td><?php echo utf8_encode($datos['NOMBRE']); ?></td>
                            <td><?php echo utf8_encode($datos['Nombres'].' '.$datos['Apellidos']); ?></td>
<!--                            <td>
                                <img src="<?php // echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php // echo $datos['idCatedratico']; ?>')" />
                            </td>-->
                             <td>                          
                                <img src="<?php echo $ruta_assets;?>images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idCatedratico']; ?>', '<?php echo $datos['CODIGO_CAR']; ?>')" />
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
                </tr>
            </tfoot>
    </table>
</div>
			<div class="spacer"></div>			
		</div>
            
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Coordinador" />
        </div>
        <br />
        <?php
        ?>    
        
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Franja horaria</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Coordinador</legend>   
                <table width="502">
                    <tr style="display:none">
                        <td width="161">Id Coordinador</td>
                        <td width="13">:</td>
                        <td width="312">
                            <input type="text" readonly="readonly" id="txtidCatedratico" name="txtidCatedratico" />
                            <input type="text" readonly="readonly" id="txtCODIGO_CAR" name="txtCODIGO_CAR" />
                        </td>
                    </tr>
                    <tr>
                        <td>Carrera</td>
                        <td>:</td>
                        <td>
                            <select name="sltCODIGO_CAR" id="sltCODIGO_CAR">                        
                            <?php
                                $con3 = Conectar();
                                $sql3 = "SELECT * FROM carrera where LENGTH(TRIM(NOMBRE)) > 0";
                                $q3 = mysql_query($sql3, $con3) or die ("Problemas al ejecutar la consulta");                
                                while($datos3 = mysql_fetch_array($q3)){
                                    echo '<option value="'.$datos3['CODIGO_CAR'].'">'.utf8_encode($datos3['NOMBRE']).'</option>';
                                }   
                                desconectar();
                            ?>
                            </select> 
                        </td>
                    </tr>                     
                    <tr>
                        <td>Catedr&aacute;tico</td>
                        <td>:</td>
                        <td>
                            <select name="sltidCatedratico" id="sltidCatedratico">                        
                            <?php
                                $con2 = Conectar();
                                $sql2 = "SELECT * FROM proc_catedraticos where Estado='1'";
                                $q2 = mysql_query($sql2, $con2) or die ("Problemas al ejecutar la consulta");                
                                while($datos2 = mysql_fetch_array($q2)){
                                    echo '<option value="'.$datos2['idCatedratico'].'">'.utf8_encode($datos2['Nombres'].' '.$datos2['Apellidos']).'</option>';
                                }   
                                desconectar();
                            ?>
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
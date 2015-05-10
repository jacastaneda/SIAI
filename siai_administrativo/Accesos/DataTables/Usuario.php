<?php
    require_once '../../Franjas/Datatables/funciones/conexiones.php';
    $ruta_assets='../../Equivalencias/DataTables/';  
    
    function format_tipo_usuar($int_tipo)
    {
        switch($int_tipo)
        {
            case 1:
                $tipo='Administrador';
                break;
             case 2:
                $tipo='Coordinador';
                break;
            case 3:
                $tipo='Registro acad&eacute;mico';
                break;
            case 4:
                $tipo='Contabilidad';
                break;            
        }
        
        return $tipo;
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset= UTF-8" />		
                <title>Usuario</title>
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
                        $("#leyenda").html("Registrar Usuario");
                        procedimiento = "nuevo";
                        num = num + 1;

                        if ($("#btnNuevo").val()=="Agregar Usuario"){
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
                            $("#btnNuevo").val("Agregar Usuario");
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
                        url: "guardarUsuario.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r)
                            {
                                var partesresp=r.split(',');
                                alert(partesresp[1]);
                                $("#loader").hide();                                
                                if(partesresp[0] == 1)
                                {
                                    location.reload(true);    
                                }
                            }
                        })
                    }
                    else if(procedimiento == "editar")
                    {
//                        alert(datos)
                        $.ajax({
                        url: "editarUsuario.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r)
                            {
                                var partesresp=r.split(',');
                                alert(partesresp[1]);
                                $("#loader").hide();                                
                                if(partesresp[0] == 1)
                                {
                                    location.reload(true);    
                                }                                
                            }
                    })
                    }
                  })
               });
            
            function editar(codigo)
            {
                $("#leyenda").html("Actualizar Usuario");
                procedimiento = "editar";
                var v_codigo = "codigo="+codigo;                    
                    $.ajax({
                        url:"buscarUsuario.php",
                        data: v_codigo,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                //txtCODIGO,sltTipoUsuar,sltidCatedratico,txtNombre,sltEstado
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtCODIGO").val(respuesta.codigo);   
                                $("#sltTipoUsuar").val(respuesta.tipo_usuar);
                                $("#sltidCatedratico").val(respuesta.id_catedratico);
                                $("#txtNombre").val(respuesta.nombre);
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
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Catedr&aacute;tico</th>
                        <th>Tipo</th>
                        <th>Modificar</th>
                        <!--<th>Eliminar</th>-->
                    </tr>
            </thead>
            <tbody> 
                <?php
                $con = Conectar();
                $sql = "SELECT * FROM usuarios AS u
                        LEFT OUTER JOIN proc_catedraticos AS C ON u.idCatedratico=c.idCatedratico";
                
                $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
                while($datos = mysql_fetch_array($q)){
                ?>
                    <tr>
                            <td><?php echo utf8_encode($datos['CODIGO']); ?></td>
                            <td><?php echo utf8_encode($datos['NOMBRE']); ?></td>
                            <td><?php echo utf8_encode($datos['Nombres'].' '.$datos['Apellidos']); ?></td>
                            <td><?php echo format_tipo_usuar($datos['TIPO_USUAR']); ?></td>
                            <td>
                                <img src="<?php echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['CODIGO']; ?>')" />
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
                    <th></th>
                    <!--<th></th>-->                    
                </tr>
            </tfoot>
    </table>
</div>
			<div class="spacer"></div>			
		</div>
            
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Usuario" />
        </div>
        <br />
        <?php
        ?>    
        
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Usuario</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nuevo Usuario</legend>   
                <table width="502">
                    <tr>
                        <td width="161">Usuario</td>
                        <td width="13">:</td>
                        <td width="312">
                            <input type="text" id="txtCODIGO" name="txtCODIGO" />
                        </td>
                    </tr>
                    <tr>
                        <td>Tipo de usuario</td>
                        <td>:</td>
                        <td>
                            <select name="sltTipoUsuar" id="sltTipoUsuar">
                                <option value='1'><?php echo format_tipo_usuar(1);?></option>
                                <option value='2'><?php echo format_tipo_usuar(2);?></option>
                                <option value='3'><?php echo format_tipo_usuar(3);?></option>
                                <option value='4'><?php echo format_tipo_usuar(4);?></option>
                            </select>
                        </td>                        
                    </tr>                     
                    <tr>
                        <td>Catedr&aacute;tico</td>
                        <td>:</td>
                        <td>
                            <select name="sltidCatedratico" id="sltidCatedratico"> 
                                <option value="">Ninguno</option>
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
                        <td>Nombre</td>
                        <td>:</td>
                        <td>
                           <input type="text" id="txtNombre" name="txtNombre" />
                        </td>
                    </tr>    
                    <tr>
                        <td>Contrase&ntilde;a</td>
                        <td>:</td>
                        <td>
                            <input type="password" id="txtClave" name="txtClave" />
                        </td>
                    </tr>      
                    <tr>
                        <td>Confirmar la Contrase&ntilde;a</td>
                        <td>:</td>
                        <td>
                            <input type="password" id="txtClaveConfirm" name="txtClaveConfirm" />
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
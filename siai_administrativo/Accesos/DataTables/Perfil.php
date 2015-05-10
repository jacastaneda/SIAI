<?php
session_start();
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
                <title>Catedr&aacute;tico</title>
                <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">       
                <link href="../../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />                
		<style type="text/css" title="currentStyle">
			@import "<?php echo $ruta_assets;?>media/css/demo_page.css";
			/*@import "<?php echo $ruta_assets;?>media/css/demo_table.css";*/
			@import "<?php echo $ruta_assets;?>funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="<?php echo $ruta_assets;?>media/js/jquery.js"></script>
                <script src="<?php echo $ruta_assets;?>media/js/jquery-ui-1.9.2.custom.js"></script>
		<script type="text/javascript" charset="utf-8">
                  var procedimiento = "editar";            
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
                    
                    $('#btnCerrar').click(function(){
                        $("#formularioRegistrar").hide();
                    })
                
                    $("#btnProcesar").click(function(){
                        $("#loader").show();
                        var datos = $("#frmRegistrar").serialize();

                        if(procedimiento == "editar")
                        {
    //                        alert(datos)
                            $.ajax({
                            url: "editarPerfilUsuario.php",
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
                        url:"buscarPerfilUsuario.php",
                        data: v_codigo,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
//                                $("#btnNuevo").val("Cancelar");
                                $("#paramCODIGO").val(respuesta.codigo);
                                $("#paramIdCatedratico").val(respuesta.id_catedratico);
                                $("#txtEmail").val(respuesta.email);
                                $("#txtNombre").val(respuesta.nombre);
//                                $("#sltidCatedratico").val(respuesta.nombre);                             
                            }                        
                    })
            }
    </script>
    </head>
    <body id="dt_example" class="ex_highlight_row">
        <div id="container" class="full_width" style="width:80%">
            <h1>Informaci&oacute;n</h1>
			
            <div class="demo_jui">
                <?php
                $con = Conectar();
                $sql = "SELECT * FROM usuarios AS u
                        LEFT OUTER JOIN proc_catedraticos AS C ON u.idCatedratico=c.idCatedratico WHERE CODIGO='".$_SESSION["user"][0]["usuario"]."'";
//                echo $sql;
                $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
                while($datos = mysql_fetch_array($q)){
                    $idCatedratico=$datos['idCatedratico'];
                ?>
                <table cellpadding="5" cellspacing="5" border="1" class="display" style="text-align: left; " id="example" width="100%">
                        <tr>
                            <th>Tipo de usuario</th>
                            <td><?php echo format_tipo_usuar($datos['TIPO_USUAR']); ?></td>
                        </tr>                        
                        <tr>
                            <th>Usuario</th>
                            <td><?php echo utf8_encode($datos['CODIGO']); ?></td>
                        </tr>    
                        <tr>
                            <th>Nombre (usuario)</th>
                            <td><?php echo utf8_encode($datos['NOMBRE']); ?></td>
                        </tr>
                        <?php
                        if(trim($datos['idCatedratico']) != '')
                        {    
                        ?>
                            <tr>
                                <th>Catedr&aacute;tico</th>
                                <td><?php echo utf8_encode($datos['Nombres'].' '.$datos['Apellidos']); ?></td>
                            </tr>   
                            <tr>
                                <th>Correo electr&oacute;nico para notificaciones</th>
                                <td><?php echo $datos['email']; ?></td>
                            </tr>   
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <button style="cursor: pointer;" onclick="editar('<?php echo $datos['CODIGO']; ?>')">
                                    Modificar datos
                                   <img src="<?php echo $ruta_assets;?>images/refresh.png" />                                
                                </button>
                            </td>                           
                        </tr>
                    </table>                
                    <?php
                }
                ?>
            </div>
            <div class="spacer"></div>			
        </div>

        <br />
        <?php
        ?>    
        
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Actualizaci&oacute;n de datos</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda"> Usuario</legend>   
                <table width="502">
                    <tr>
                        <td width="161">Usuario</td>
                        <td width="13">:</td>
                        <td width="312">
                            <?php echo $_SESSION["user"][0]["usuario"];?>
                            <input type="hidden" name="paramCODIGO" id="paramCODIGO" value="<?php echo $_SESSION["user"][0]["usuario"];?>">
                            <input type="hidden" name="paramIdCatedratico" id="paramIdCatedratico">
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
                        <td>Contrase&ntilde;a (Si se deja vac&iacute;a se mantendr&aacute; su contrase&ntilde;a actual) </td>
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
                    <?php
                    if(trim($idCatedratico) != '')
                    {
                        ?>
                        <tr>
                            <td>Correo electr&oacute;nico para notificaciones</td>
                            <td>:</td>
                            <td>
                                <input type="email" id="txtEmail" name="txtEmail" />
                            </td>
                        </tr>                       
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="2" align="right" >
                            <input type="button" id="btnProcesar" name="btnProcesar" value="Actualizar" />
                        </td>
                        <td align="center">
                            <input type="button" align="center"  name="btnCerrar" id="btnCerrar" value="Cancelar" />
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
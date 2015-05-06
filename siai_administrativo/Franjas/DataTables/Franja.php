<?php
    require_once 'funciones/conexiones.php';
    session_start(); 
    if(isset($_POST["idCiclo"])) { 
        $_SESSION['idCiclo'] = serialize($_POST["idCiclo"]); 
    } 
    if(isset($_SESSION['idCiclo'])) { 
        $g_idCiclo = unserialize($_SESSION['idCiclo']); 
    }
    //$g_IdUniversidad=$_POST["idUniversidad"];    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />		
		<title>Facultades</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
                        @import "funciones/formatoInput.css";
		</style>
		<script type="text/javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript"  src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
                  var procedimiento = "nuevo";                  
                  $(document).ready(function() {                   
                      
                    $("select").change(function(){
                        $posicion = $(this).attr("name");
                        // Tomo el valor de la opción seleccionada
                        $valor = $(this).val() 
                        })  
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
		    var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "media/language/es_ES.txt"}} );               
                    $("#btnNuevo").click(function(){
                    $("#leyenda").html("Registrar Nueva Facultad");
                    procedimiento = "nuevo";
                                        
                    if ($("#btnNuevo").val()=="Agregar Facultad"){
                        
                        $("#txtidUniversidad").attr("value", $('#idUniversidadParam').attr("value"));
                        $("#txtidFacultadEqui").attr("value",'');                        
                        $("#txtnombreFacultadEqui").attr("value",'');
                        $("#txtidFacultadUPES").attr("value",'');
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                    }
                    else if ($("#btnNuevo").val()=="Cancelar"){
                        $("#formularioRegistrar").hide();
                        $("#btnNuevo").val("Agregar Facultad");
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
                        url: "guardarFacultad.php",
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
                        url: "editarFacultad.php",
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
            
            function eliminar(idUniversidad,idFacultadEqui)
            {
                if(confirm("Esta seguro que desea eliminar esta Facultad?"))
                {
                    //cedula=85150447
                    var v_idUniversidad = idUniversidad;                    
                    var v_idFacultadEqui = idFacultadEqui;                    
                    $.ajax({
                        url:"eliminarFacultad.php",
                        data: {
                                idUniversidad: v_idUniversidad,
                                idFacultadEqui: v_idFacultadEqui
                              },
                        type: "POST",
                        success:
                            function(respuesta)
                            {
                                alert(respuesta);
                                $("#loader").hide();
                                location.reload(true);
                            }                        
                    })
                }
            }
            
            function editar(idUniversidad,idFacultadEqui)
            {
                $("#leyenda").html("Actualizar Facultad");
                procedimiento = "editar";
                    var parametros = {
                        "idUniversidad" : idUniversidad,
                        "idFacultadEqui": idFacultadEqui
                    }
                    $.ajax({
                        url:"buscarFacultad.php",
                        data: parametros,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                $("#txtidUniversidad").val(respuesta.idUniversidad);
                                $("#txtidFacultadEqui").val(respuesta.idFacultadEqui);
                                $("#txtnombreFacultadEqui").val(respuesta.nombreFacultadEqui);
                                $("#txtidFacultadUPES").val(respuesta.idFacultadUPES);
                            }                        
                    })
            }
		</script>
	</head>
	<body id="dt_example" class="ex_highlight_row">    	
	<div id="container" style="width:80%">
        <div class="full_width big">
            <table>
                <tr>
                    <td>Universidad</td>
                    <td>:</td>
                    <td>
                        <select name="idUniversidad" id="idUniversidadParam">                        
                        <?php
                            $con1 = Conectar();
                            $sql1 = "SELECT idUniversidad, nombreUniversidad FROM proc_universidades where idUniversidad= $g_IdUniversidad";
                            $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta");                
                            while($datos = mysql_fetch_array($q1)){
                                echo '<option value="'.$datos['idUniversidad'].'">'.$datos['nombreUniversidad'].'</option>';
                            }   
                            desconectar();
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
	<div class="full_width big">Facultades</div>
        <h1>Informaci&oacute;n</h1>
	<div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<th>Id Universidad</th>
                        <th>Id Facultad</th>
			<th>Facultad</th>
                        <th>Facultad UPES</th>
                        <th></th>
                        <th></th>
                        <th></th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT idUniversidad,idFacultadEqui, nombreFacultadEqui 
                FROM PROC_Facultades where idUniversidad= $g_IdUniversidad";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			<td><?php echo $datos['idUniversidad']; ?></td>
                        <td><?php echo $datos['idFacultadEqui']; ?></td>
			<td><?php echo $datos['nombreFacultadEqui']; ?></td>
                        <td>
                            <select>
                            <option value="01">FACULTAD DE INGENIERIA Y ARQUITECTURA</option>
                            <option value="02">FACULTAD DE CIENCIAS ECONOMICAS</option>
                            <option value="03">FACULTAD DE CIENCIAS JURIDICAS</option>
                          </select>
                        </td>
                        <td>
                            <img src="<?php echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>')" />
                        </td>
                        <td>                          
                            <img src="<?php echo $ruta_assets;?>images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>')" />
                        </td>
                        <th>
                            <form action="Carrera.php" method="post">
                                <input name="idUniversidad" id="idUniversidad" type="hidden" value="<?php echo $datos['idUniversidad']; ?>">
                                <input name="idFacultadEqui" id="idFacultadEqui" type="hidden" value="<?php echo $datos['idFacultadEqui']; ?>">
                                <input value="Carreras" type="submit">
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
                        <th></th>
                        <th></th>
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Facultad" />
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
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Facultad</legend>   
                <table>
                    <tr>
                        <td>Universidad</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidUniversidad" name="txtidUniversidad" />
                        </td>
                    </tr>
                    <tr>
                        <td>Id Facultad</td>
                        <td>:</td>
                        <td>
                            <input type="text" readonly="readonly" id="txtidFacultadEqui" name="txtidFacultadEqui" />
                        </td>
                    </tr>
                    <tr>
                        <td>Facultad</td>
                        <td>:</td>
                        <td>
                            <input type="text" id="txtnombreFacultadEqui" name="txtnombreFacultadEqui"/>
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
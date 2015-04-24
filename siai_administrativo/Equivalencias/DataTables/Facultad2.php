<?php
    require_once 'funciones/conexiones.php';
    session_start(); 
    if(isset($_POST["idUniversidad"])) { 
        $_SESSION['idUniversidad'] = serialize($_POST["idUniversidad"]); 
    } 
    if(isset($_SESSION['idUniversidad'])) { 
        $g_IdUniversidad = unserialize($_SESSION['idUniversidad']); 
    }
    //$g_IdUniversidad=$_POST["idUniversidad"];    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset = UTF-8" />		
		<title>Facultades</title>
                <link rel="stylesheet" type="text/css" href="media/css/style4.css" />
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
                  function initTable (){
                      return $('#example').dataTable( {
                        "oLanguage":{"sUrl": "media/language/es_ES.txt"},                                               
                        "bRetrieve": true,
                        "bDestroy": true,
                        "aaSorting": [ [0,'asc'], [1,'asc'] ]
                      } );
                    }

                    function tableActions (){
                      var oTable = initTable();
                      // perform API operations with oTable
                    }
                  function inicio(){  
                      initTable();
                    tableActions();
                  }

                  $(document).ready(function() {
                    $(window).resize(function(){
                        $('#formularioRegistrar').css({
                            position:'absolute',
                            left: ($(window).width() - $('#formularioRegistrar').outerWidth())/2,
                            top: ($(window).height() - $('#formularioRegistrar').outerHeight())/2
                        });	  
                    });
                    $(window).resize();  
                    inicio();
                    $(".arrastable").draggable();
                    $("#loader").hide();
                    $("#formularioRegistrar").hide();
		    //var oTable = $('#example').dataTable({"oLanguage":{"sUrl": "media/language/es_ES.txt"}} );               
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
                $('#container_buttons').click(function(){
                    //alert('di click')
                    <?php //session_destroy(); ?>
                    $('#target').submit();
                })
                $("#btnProcesar").click(function(){
                    v_idUniversidad = $("#idUniversidadParam").attr("value");                            
                    v_idFacultadEqui = $("#txtidFacultadEqui").attr("value");
                    
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();
                    
                    if(procedimiento == "nuevo"){                        
                        $.ajax({
                        url: "guardarFacultad.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);                                
                                cargarTabla(v_idUniversidad,v_idFacultadEqui);
                            }
                        })
                    }
                    else if(procedimiento == "editar"){                        
                        $.ajax({
                        url: "editarFacultad.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);
                                cargarTabla(v_idUniversidad,v_idFacultadEqui);                                
                            }
                    })
                    }
                  })
               });
            
            function eliminar(idUniversidad,idFacultadEqui){
                if(confirm("Esta seguro que desea eliminar esta Facultad?")){
                    //cedula=85150447
                    var v_idUniversidad = idUniversidad;                    
                    var v_idFacultadEqui = idFacultadEqui;
                    $("#btnNuevo").val("Cancelar");
                    $.ajax({
                        url:"eliminarFacultad.php",
                        data: {
                                idUniversidad: v_idUniversidad,
                                idFacultadEqui: v_idFacultadEqui
                              },
                        type: "POST",
                        success:
                            function(respuesta){
                                alert(respuesta);
                                cargarTabla(v_idUniversidad,v_idFacultadEqui);
                               //inicio();
                            }                        
                    })
                }
            }
            
            function cargarTabla(v_idUniversidad,v_idFacultadEqui){
                $.ajax({
                                        url:"FacultadReload.php",
                                        data: {
                                                idUniversidad: v_idUniversidad,
                                                idFacultadEqui: v_idFacultadEqui
                                              },
                                        type: "POST",
                                        success:
                                            function(respuesta){
                                                document.getElementById('detalle').innerHTML=respuesta;                                                
                                                $("#btnNuevo").attr("value",'Agregar Facultad');    
                                                inicio();
                                            }                        
                                    })                
            }
            
            function editar(idUniversidad,idFacultadEqui){
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
        <div class="container">
         <section>
          <div id="container_buttons">
              <form id="target" action="Universidad.php" method="post">
                    
              </form>
            <p><a class="a_demo_four" href="#">Volver IES</a></p>
          </div>
	</section>
        </div>    
        <div class="full_width big">
            <table>
                <tr>
                    <td>Instituci&oacute;n</td>
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
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<!--<th>Id Instituci&oacute;n</th>-->
                        <th>Id Facultad</th>
			<th>Facultad</th>
                        <th>Facultad UPES</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Carrera</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT u.nombreUniversidad as Universidad , f.nombreFacultadEqui, f.idFacultadEqui, f.idUniversidad , f.idFacultadUPES , fup.NOMBRE
                    FROM proc_universidades u, proc_facultades f, facultades fup
                    where u.idUniversidad = f.idUniversidad 
                    and fup.CODIGO= f.idFacultadUPES AND f.idUniversidad= $g_IdUniversidad order by f.idUniversidad, f.idFacultadEqui";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			
                        <td><?php echo $datos['idFacultadEqui']; ?></td>
			<td><?php echo $datos['nombreFacultadEqui']; ?></td>
                        <td><?php echo $datos['NOMBRE']; ?></td>
                        <td>
                            <img src="images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>')" />
                        </td>
                        <td>                          
                            <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['idUniversidad']; ?>','<?php echo $datos['idFacultadEqui']; ?>')" />
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
        ?>    
        
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Facultad</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Facultad</legend>   
                <table width="502">
<!--                    <tr>
                        <td>Instituci&oacute;n</td>
                        <td>:</td>
                        <td>-->
                            <input type="hidden" readonly="readonly" id="txtidUniversidad" name="txtidUniversidad" />
<!--                        </td>
                    </tr>-->
                    <tr>
                        <td width="161">Id Facultad</td>
                        <td width="13">:</td>
                        <td width="312">
                            <input type="text" readonly="readonly" id="txtidFacultadEqui" name="txtidFacultadEqui" />
                        </td>
                    </tr>
                    <tr>
                        <td>Facultad</td>
                        <td>:</td>
                        <td>
                            <input type="text" required class="awesome-text-box" size ="50" id="txtnombreFacultadEqui" name="txtnombreFacultadEqui"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Facultad UPES</td>
                        <td>:</td>
                        <td>
                            <select required name="txtidFacultadUPES" id="txtidFacultadUPES">
                            <option value="01">FACULTAD DE INGENIERIA Y ARQUITECTURA</option>
                            <option value="02">FACULTAD DE CIENCIAS ECONOMICAS</option>
                            <option value="03">FACULTAD DE CIENCIAS JURIDICAS</option>
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
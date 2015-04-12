<?php 
    require_once 'funciones/conexiones.php';
    $ruta_assets='../../Equivalencias/DataTables/';
    session_start();
    if(isset($_POST["idCiclo"])) { 
        $_SESSION['idCiclo'] = serialize($_POST["idCiclo"]); 
    } 
    if(isset($_SESSION['idCiclo'])) { 
        $g_IdCiclo = unserialize($_SESSION['idCiclo']); 
    }
//    echo $g_IdCiclo;
    //$g_IdUniversidad=$_POST["idUniversidad"];    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset = UTF-8" />		
		<title>Franjas horarias</title>
                <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">       
                <link href="../../bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
                <link href="../../ventanilla/jquery-ui-1.11.2.custom/jquery-ui.css" rel="stylesheet" />            
                <link rel="stylesheet" type="text/css" href="<?php echo $ruta_assets;?>media/css/style4.css" />
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
                  function initTable (){
                      return $('#example').dataTable( {
                        "oLanguage":{"sUrl": "<?php echo $ruta_assets;?>media/language/es_ES.txt"},                                               
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
                        $("#leyenda").html("Registrar Nueva Franja");
                        procedimiento = "nuevo";

                        if ($("#btnNuevo").val()=="Agregar Franja horaria"){
//                            alert($('#idCicloParam').attr("value"));
                            $("#txtidCiclo").attr("value", $('#idCicloParam').attr("value"));
                            $("#txtCODIGO_CAR").attr("value",'');                        
                            $("#txtFechaHoraIni").attr("value",'');
                            $("#txtFechaHoraFin").attr("value",'');
                            $("#formularioRegistrar").show();
                            $("#btnNuevo").val("Cancelar");
                        }
                        else if ($("#btnNuevo").val()=="Cancelar"){
                            $("#formularioRegistrar").hide();
                            $("#btnNuevo").val("Agregar Franja horaria");
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
                    v_idCiclo = $("#txtidCiclo").attr("value");                          
                    v_CODIGO_CAR = $("#sltCODIGO_CAR").attr("value");
                    v_FechaHoraIni = $("#txtFechaHoraIni").attr("value");                          
                    v_FechaHoraFin = $("#txtFechaHoraFin").attr("value");                    
                    
                    $("#loader").show();
                    var datos = $("#frmRegistrar").serialize();
//                    alert(datos);
                    if(procedimiento == "nuevo"){                        
                        $.ajax({
                        url: "guardarFranja.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);                                
                                cargarTabla(v_idCiclo);
                            }
                        })
                    }
                    else if(procedimiento == "editar"){                        
                        $.ajax({
                        url: "editarFranja.php",
                        type: "POST",
                        data: datos,
                        success:
                            function(r){
                                alert(r);
                                $("#loader").hide();
                                $("#formularioRegistrar").hide();
                                //location.reload(true);
                                cargarTabla(v_idCiclo);                                
                            }
                    })
                    }
                  })
               });
            
            function eliminar(idFranja){
                if(confirm("Esta seguro que desea eliminar esta Franja?")){
                    //cedula=85150447
                    var v_idFranja = idFranja;
                    var v_idCiclo = $("#txtidCiclo").attr("value"); 
                    $("#btnNuevo").val("Cancelar");
                    $.ajax({
                        url:"eliminarFranja.php",
                        data: {
                                idFranja: v_idFranja
                              },
                        type: "POST",
                        success:
                            function(respuesta){
                                alert(respuesta);
                                cargarTabla(v_idCiclo);
                               //inicio();
                            }                        
                    })
                }
            }
            
            function cargarTabla(v_idCiclo){
                $.ajax({
                    url:"FranjaReload.php",
                    data: {
                            idCiclo: v_idCiclo
                          },
                    type: "POST",
                    success:
                        function(respuesta){
                            document.getElementById('detalle').innerHTML=respuesta;                                                
                            $("#btnNuevo").attr("value",'Agregar Franja horaria');    
                            inicio();
                        }                        
                })                
            }
            
            function editar(idFranja){
                $("#leyenda").html("Actualizar Franja");
                procedimiento = "editar";
                    var parametros = {
                        "idFranja" : idFranja
                    }
                    $.ajax({
                        url:"buscarFranja.php",
                        data: parametros,
                        type: "POST",
                        dataType: "json",
                        success:
                            function(respuesta)
                            {
                                $("#formularioRegistrar").show();
                                $("#btnNuevo").val("Cancelar");
                                
                                $("#txtidCiclo").val(respuesta.id_ciclo);
                                $("#txtidFranja").val(respuesta.id_franja);
                                $("#txtCODIGO_CAR").val(respuesta.CODIGO_CAR);                        
                                $("#txtFechaHoraIni").val(respuesta.fecha_hora_inicio);
                                $("#txtFechaHoraFin").val(respuesta.fecha_hora_fin);                            
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
              <form id="target" action="Ciclo.php" method="post">
                    
              </form>
            <p><a class="a_demo_four" href="#">Volver Ciclos</a></p>
          </div>
	</section>
        </div>    
        <div class="full_width big">
            <table>
                <tr>
                    <td>Ciclo</td>
                    <td>:</td>
                    <td>
                        <select name="idCiclo" id="idCiclo">                        
                        <?php
                            $con1 = Conectar();
                            $sql1 = "SELECT * FROM siai_ciclos where id_ciclo= $g_IdCiclo";
                            $q1 = mysql_query($sql1, $con1) or die ("Problemas al ejecutar la consulta");                
                            while($datos = mysql_fetch_array($q1)){
                                echo '<option value="'.$datos['id_ciclo'].'">'.$datos['ciclo'].'</option>';
                            }   
                            desconectar();
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>            
	<div class="full_width big">Franjas horarias de acceso al sistema</div>
        <h1>Informaci&oacute;n</h1>
	<div class="demo_jui" id="detalle">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">    
	<thead>
		<tr>
			<!--<th>Id Instituci&oacute;n</th>-->
                        <th>Id Franja</th>
			<th>Carrera</th>
                        <th>Fecha / hora Inicio</th>
                        <th>Fecha / hora Fin</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
		</tr>
	</thead>
	<tbody> 
            <?php
            $con = Conectar();
            $sql = "SELECT f.id_franja, f.id_ciclo, f.CODIGO_CAR, f.fecha_hora_inicio, f.fecha_hora_fin, f.comentario, f.estado,
                    ci.ciclo,c.CODIGO_CAR, c.NOMBRE
                    FROM siai_franjas_inscripcion AS f
                    JOIN siai_ciclos AS ci ON ci.id_ciclo=f.id_ciclo 
                    JOIN carrera AS c ON c.CODIGO_CAR=f.CODIGO_CAR 
                    WHERE f.id_ciclo=$g_IdCiclo
                    ORDER BY ci.ciclo";
            $q = mysql_query($sql, $con) or die ("Problemas al ejecutar la consulta");                
            while($datos = mysql_fetch_array($q)){
            ?>
		<tr>
			
                        <td><?php echo $datos['id_franja']; ?></td>
                        <td><?php echo $datos['NOMBRE']; ?></td>
			<td><?php echo $datos['fecha_hora_inicio']; ?></td>
                        <td><?php echo $datos['fecha_hora_fin']; ?></td>
                        <td>
                            <img src="<?php echo $ruta_assets;?>images/refresh.png" style="cursor: pointer;" onclick="editar('<?php echo $datos['id_franja']; ?>')" />
                        </td>
                        <td>                          
                            <img src="<?php echo $ruta_assets;?>images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $datos['id_franja']; ?>')" />
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
                        <th></th>
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>			
		</div>
            <div id="botonNuevo" align="center">
            <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Franja horaria" />
        </div>
        <br />
        <?php
        ?>    
        
        <div class="arrastable" id="formularioRegistrar" align="center"  style='width:550px; margin: 0 auto 0 auto; background-color: #fff; border:2px solid cornflowerblue; padding:15px; text-align:justify; border-radius:8px; box-shadow: 1px 1px 12px #555; z-index: 1000;'>
            <div id="procedimiento" align="center" style=' border-radius:8px 8px 0 0; background-color: #000000; color:white; '>Franja horaria</div>
            <form name="frmRegistrar" id="frmRegistrar">
                <fieldset style="display: inline;">
                    <legend id="leyenda">Registrar Nueva Franja</legend>   
                <table width="502">
                            <input type="hidden" readonly="readonly" id="idCicloParam" name="idCicloParam" value="<?php echo $g_IdCiclo;?>"/>
                    <tr>
                        <td width="161">Id Ciclo</td>
                        <td width="13">:</td>
                        <td width="312">
                            <input type="hidden" readonly="readonly" id="txtidFranja" name="txtidFranja" />
                            <input type="text" readonly="readonly" id="txtidCiclo" name="txtidCiclo" />
                        </td>
                    </tr>
                    <tr>
<!--                    <tr>                            $("#txtidCiclo").attr("value", $('#idCicloParam').attr("value"));
                            $("#txtCODIGO_CAR").attr("value",'');                        
                            $("#txtFechaHoraIni").attr("value",'');
                            $("#txtFechaHoraFin").attr("value",'');-->
                        <td>Carrera</td>
                        <td>:</td>
                        <td>
                            <select name="sltCODIGO_CAR" id="sltCODIGO_CAR">                        
                            <?php
                                $con2 = Conectar();
                                $sql2 = "SELECT * FROM carrera where LENGTH(NOMBRE) > 0";
                                $q2 = mysql_query($sql2, $con2) or die ("Problemas al ejecutar la consulta");                
                                while($datos2 = mysql_fetch_array($q2)){
                                    echo '<option value="'.$datos2['CODIGO_CAR'].'">'.$datos2['NOMBRE'].'</option>';
                                }   
                                desconectar();
                            ?>
                            </select>                            
                        </td>
                    </tr>   
                    <tr>
                        <td>Fecha/hora inicial</td>
                        <td>:</td>
                        <td>
                            <input name="txtFechaHoraIni" id="txtFechaHoraIni">
                        </td>                        
                    </tr>
                    <tr>
                        <td>Fecha/hora final</td>
                        <td>:</td>
                        <td>
                            <input name="txtFechaHoraFin" id="txtFechaHoraFin">
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
               <script type="text/javascript" src="../js/franjas.js"></script> 
        </div>   
<?php 
//echo "</div></div>";
?>
</body>
</html>
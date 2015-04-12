<?php session_start();
// obtenemos los datos del archivo 
	 $tamano = $_FILES["archivos"]['size'];
	 $tipo = $_FILES["archivos"]['type'];
	 $archivo = $_FILES["archivos"]['name'];
	$prefijo = date("Y-m-d")."_".date("h_i_s");

if($tipo<>"text/plain"){
	//echo "<font color='#FF0000'>* Formato no permitido</font>";
	echo "1";
	//echo $tipo;
	//exit();
	}
elseif($tamano >5000000){
	echo 2;
	}	
else{

	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$destino =  "../LibUpload/savefiles/".$prefijo."_".$archivo;
		if (copy($_FILES['archivos']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
			$archivoSubido=$prefijo."_".$archivo;
			$_SESSION["ArchivoVentanilla"]=$archivoSubido;
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
echo $archivoSubido."*";

}
?>



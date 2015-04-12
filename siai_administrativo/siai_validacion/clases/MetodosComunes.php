<?php
function getHora(){
	// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
	date_default_timezone_set('America/El_Salvador');
	return date('H:i:s');
}
function getFecha(){
	// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
	date_default_timezone_set('America/El_Salvador');
	return date('Y-m-d');
}
function getAnio()
{
	// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
	date_default_timezone_set('America/El_Salvador');
	return (int)date('Y');
}
function getFechaCorta(){
	// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
	date_default_timezone_set('America/El_Salvador');
	return date('d/m/Y');
}
function getFechaHora(){
	// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
	date_default_timezone_set('America/El_Salvador');
	return date('Y-m-d H:i:s');
}
function getFechaMasDias($dias){
	// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
	date_default_timezone_set('America/El_Salvador');	
	return date('d/m/Y',strtotime(date('m/d/Y').'+'.$dias.' days'));
}

function sumarDiasFecha($fecha, $dias)
{
	$partes=explode('-',$fecha);
	return date('Y-m-d',strtotime(strtotime($partes[1].'/'.$partes[0].'/'.$partes[2]).'+'.$dias.' days'));
}
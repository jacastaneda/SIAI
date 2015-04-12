// JavaScript Document
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch (e) {
	  	try {
	   		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  	}catch (E) {
	   		xmlhttp = false;
		}
	}
	if(!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function ocultarVentana()
{
	var contenedor=document.getElementById('ventana_emergente');
	contenedor.style.visibility='hidden';
}

function setMensaje(ttl,msj)
{
	var contenedor=document.getElementById('ventana_emergente');
	var titulo=document.getElementById('mensaje_titulo');
	var mensaje=document.getElementById('mensaje_texto');
	mensaje.style.zIndex='20';
	mensaje.innerHTML=msj;
	titulo.innerHTML=ttl;
	contenedor.style.visibility="visible";
}

function onResize()
{
	var alto=new Number(window.innerHeight);
	var contenedor=document.getElementById('general');
	var altoContenedor=new Number(contenedor.offsetHeight);
	var margen=0;
	if(alto<=altoContenedor)
	{
		margen='0px';
	}
	else
	{
		margen=(alto*0.5)-(altoContenedor*0.5);
	}
	contenedor.style.marginTop=margen+'px';
}
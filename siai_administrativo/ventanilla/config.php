<?php 
/*
	Clase que opera con el modulo de notificaciones
	fecha de creacion: 12 de septiembre 2012
	Autor : Denys Urquilla

**/
	class ClassConfiguracion{
		
	private $puerto=49;
	private $usuario="denysurquilla@grupopabe.com";
	private $password="123456789";	
	private $host="mail.grupopabe.com";
	
	
	public  function getPuerto(){
		
		return $this->puerto;
		}

	public function getUsuario(){
		return $this->usuario;
		
		}
	
	public function getPasword(){
		
		return $this->password;
		}		
	
	public function getHost(){
		
		return $this->host;
		}	
	}// fin de la clase



?>
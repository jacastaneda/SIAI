<?php 
include("Conexion.php");
class ClassUsuario extends Conexion{
	
	private $usuario;
	private $password;
	private $correo;
	private $nombres;
	private $apellidos;
	private $estado;
	private $rol;
	
	
	public function setUsuario($usuario){
		$this->usuario=$usuario;
		
		}
		
	public function setPassword($password){
		$this->password=$password;
		
		}
		
	public function setCorreo($correo){
		$this->correo=$correo;
		
		}
		
	public function setNombres($nombres){
		$this->nombres=$nombres;
		
		}			
	
	public function setApellidos($apellidos){
		$this->apellidos=$apellidos;
		
		}
		
	public function setEstado($estado){
		$this->estado=$estado;
		
		}
	
	public function setRol($rol){
		$this->rol=$rol;
		
		}
	public function insertarUsuario(){
		
		$sql="insert into usuarios()
			   values('".$this->usuario."',
			   		  '".$this->password."',
					  '".$this->correo."',
					  '".$this->nombres."',
					  '".$this->apellidos."',
					  '".$this->estado."',
					  '".$this->rol."')";
		
		return $this->DUI($sql);
		
		
		}
		
	public function actualizarUsuario(){
		
		$sql="update usuarios set password='".$this->password."',
								  correo='".$this->correo."',
								  nombres='".$this->nombres."',
								  apellidos='".$this->apellidos."',
								  estado='".$this->estado."',
								  rol='".$this->rol."'
			  where usuario='".$this->usuario."'";
		return $this->DUI($sql);						 
		
		}		
	
	
	
	
	
	
	public function EliminarUsuario(){
		
		$sql="delete from usuarios where usuario='".$this->usuario."' ";
		
		return $this->DUI($sql);
		
		}
	
	
	public function MostrarUsuarios(){
		
		$sql="select * from usuarios ";
		$datos=$this->consulta($sql);
		return $datos;
		}
	
	public function MostrarUsuariosParametro($busqueda){
		
		$sql="select * from usuarios where usuario like'".$busqueda."%'";
		$datos=$this->consulta($sql);
		
		 if(!is_array($datos)){
			$datos[]=array("usuario"=>"No se encontro");
			}  
		return $datos;
		}
	
	
	
		public function MostrarUsuariosPorNombre($busqueda){
		
		$sql="select * from usuarios where usuario ='".$busqueda."'";
		$datos=$this->consulta($sql);
		
		 if(!is_array($datos)){
			$datos[]=array("usuario"=>"No se encontro");
			}  
		return $datos;
		}
	
	
	}

?>
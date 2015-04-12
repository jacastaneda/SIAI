<?php 

abstract class   Conexion {
	
	private $user="root";
	private $pass="root";
	private $baseDatos="siai";
	private $servidor="localhost";
	private $con;
	
	
	
	//metodo para abrir la conexion
	private function abrirConexion(){
		
		$this->con= new mysqli($this->servidor,
							   $this->user,
							   $this->pass,
							   $this->baseDatos) ;
						   
		if(mysqli_connect_error($this->con)){
			
			die("Error");
			exit();
			}// fin del if

		
		}// fin del metodo
	
	
	
	
	//metodo para cerrar la conexion
	
	private function cerrarConexion(){
		
		$this->con->close();
		
		}
	
	
	//metodo para ejecutar Insert,Update ,Delete
	protected function DUI($query){
		
		$this->abrirConexion();
		$re=$this->con->query($query) or  die ("mysql erorr :".mysqli_error($this->con));
		$this->cerrarConexion();
		//return $re;
		//return $this->con->affected_rows;
		}
	
	
	
	protected function consulta($query){
		$this->abrirConexion();
		
		$datos=$this->con->query($query)or  die ("mysql erorr :".mysqli_error($this->con));
		
		while($fila=$datos->fetch_assoc()){
			$matrizDatos[]=$fila;
			}						
		$this->cerrarConexion();
		return ($matrizDatos);
		}
	
	
	}
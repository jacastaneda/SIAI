<?php 
 class  DBmodel{
	
	private static $bd_host="localhost";
	private static $db_user="root";
	private static $db_pass="root";
	private static $db_nombre="siai";
	protected $query="";
	protected $row=array();
	protected $conn;
	
	
	# Metodos Abtractos para el ABC de las clases que heredaran
	
	
/* 	abstract protected function get();
	abstract protected function set();
	abstract protected function edit();
	abstract protected function delete(); */
	
	#metodo de COnexion para la BD
	
	public function Open_conexion(){
		
		$this->conn=new MySQLi (self::$bd_host,
								self::$db_user,
								self::$db_pass,
								self::$db_nombre);
		return $this->conn;
		}  
	
	#Cerrar conexion de la BD
	
	private function Cerrar_conexion(){
		
		$this->conn->close();
		
		}
	
	
	#Ejecutar un query simple para Insert,Delete,Update
	
	protected  function execute_query(){
		
		$this->Open_conexion();
		$this->conn->multi_query($this->query);
		$this->Cerrar_conexion();
		}
	
	
	protected function get_resultados_query(){
		
		$this->Open_conexion();
		$resultado=$this->conn->query($this->query);
		while($this->row[]=$resultado->fetch_assoc());
		$resultado->close();
		$this->Cerrar_conexion();
		array_pop($this->row);
		}	
	
	
	protected function num_row(){
		
		$this->Open_conexion();
		$resultado=$this->conn->query($this->query);
		
		return $resultado->num_rows;
		
		}
		
	}//fin de la clase
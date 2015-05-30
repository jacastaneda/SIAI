<?php
/*
* ClassSiaiUsuario.php
* version 1.0
*
*/
class SiaiUsuario{
     private $usuario;
     private $contrasena;
     private $email;
     private $carnet;
     private $coordinador;
     private $tipo;
     private $activado;
     //Objeto gestionador de base de datos
     private $conexionSiaiUsuario;

     public function __construct()
     {
          $atributos= array( "contrasena","email","carnet","coordinador","tipo","activado" );
          $this->conexionSiaiUsuario = new MySQL();
          $this->conexionSiaiUsuario->setNombreTabla("siai_usuario");
          $this->conexionSiaiUsuario->setNombreAtributos($atributos);
          $this->conexionSiaiUsuario->setNombreLlavePrimaria("usuario");
     }

     public function setSiaiUsuarioPorLlave($llave)
     {
          if($registro=$this->conexionSiaiUsuario->consultarRegistro($llave))
          {
               $this->usuario=$llave;
               $this->contrasena=$registro[0];
               $this->email=$registro[1];
               $this->carnet=$registro[2];
               $this->coordinador=$registro[3];
               $this->tipo=$registro[4];
               $this->activado=$registro[5];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setUsuario($usuario)
     {
          $this->usuario=$usuario;
     }
     public function setContrasena($contrasena)
     {
          $this->contrasena=$contrasena;
     }
     public function setEmail($email)
     {
          $this->email=$email;
     }
     public function setCarnet($carnet)
     {
          $this->carnet=$carnet;
     }
     public function setCoordinador($coordinador)
     {
          $this->coordinador=$coordinador;
     }
     public function setTipo($tipo)
     {
          $this->tipo=$tipo;
     }
     public function setActivado($activado)
     {
          $this->activado=$activado;
     }

     //metodos Obtener(get)
     public function getUsuario()
     {
          return $this->usuario;
     }
     public function getContrasena()
     {
          return $this->contrasena;
     }
     public function getEmail()
     {
          return $this->email;
     }
     public function getCarnet()
     {
          return $this->carnet;
     }
     public function getCoordinador()
     {
          return $this->coordinador;
     }
     public function getTipo()
     {
          return $this->tipo;
     }
     public function getActivado()
     {
          return $this->activado;
     }

     //metodo generador de listado
     public function getListadoSiaiUsuarios()
     {
          return $this->conexionSiaiUsuario->listaLlaves("contrasena", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarSiaiUsuario($valor)
     {
          return $this->conexionSiaiUsuario->buscar($valor,"contrasena", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertSiaiUsuario()
     {
          $atributos=array( $this->contrasena , $this->email , $this->carnet , $this->coordinador , $this->tipo , $this->activado );
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->usuario , $this->contrasena , $this->email , $this->carnet , $this->coordinador , $this->tipo , $this->activado );

          return $this->conexionSiaiUsuario->insertarRegistroConLlave($this->usuario,$atributos);
     }
     public function updateSiaiUsuario()
     {
          $atributos=array( $this->contrasena , $this->email , $this->carnet , $this->coordinador , $this->tipo , $this->activado );
          return $this->conexionSiaiUsuario->actualizarRegistro($this->usuario,$atributos);
     }

	 
    //Verificar Usuarios
    public function loginAlumno($usr, $pass)
    {
       $consulta="SELECT count(*) FROM siai_usuario WHERE usuario='".$usr."' AND contrasena='".$pass."' AND tipo=0;";
       //echo $consulta;
        if($registro=$this->conexionSiaiUsuario->consulta($consulta))
        {
            if($registro[0][0]==1)
            {
                 $this->setSiaiUsuarioPorLlave($usr);
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    //Verificar franja de acceso para la carrera
    public function loginFranjaCarreraAlumno($codCarrera)
    {
       $fecha_actual=date('Y-m-d');
       
       $consulta="SELECT count(*) FROM siai_franjas_inscripcion WHERE (CODIGO_CAR='".$codCarrera."' OR CODIGO_CAR='TODO') AND tipo_permiso=1 AND fecha_hora_inicio <= '$fecha_actual' AND fecha_hora_fin >= '$fecha_actual';";
//       echo $consulta;
        if($registro=$this->conexionSiaiUsuario->consulta($consulta))
        {
            if($registro[0][0] > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }    
}
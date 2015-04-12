<?php
/*
* ClassExpedientealumno.php
* version 1.0
*
*/
class Expedientealumno{
     private $carnet;
     private $codcarrera;
     private $nombres;
     private $apellido1;
     private $apellido2;
     private $apellcasad;
     private $muninacimi;
     private $deptonacim;
     private $fechanacim;
     private $nacionalid;
     private $edad;
     private $sexo;
     private $estadocivi;
     private $cedula;
     private $telefono;
     private $direccion;
     private $munidirecc;
     private $deptodirec;
     private $institucio;
     private $titulo;
     private $expediente;
     private $lugartraba;
     private $teltrabajo;
     private $dirtrabajo;
     private $tipoingres;
     private $estatus;
     private $cicloingre;
     private $observacio;
     private $titulobach;
     private $partidaori;
     private $certificac;
     private $fotos;
     private $declaracio;
     private $codigointe;
     private $avisosc;
     private $avisosi;
     private $avisosd;
     private $empresa;
     private $tipobeca;
     private $empresabec;
     private $codigopla;
     private $cumgeneral;
     private $cumrelativ;
     private $codigousu;
     private $fechaingr;
     private $tipopago;
     private $saldoanter;
     private $cargos;
     private $abonos;
     private $saldoactua;
     private $fechasoli;
     private $extension;
     private $cumtempora;
     private $uvtemporal;
     private $marca;
     private $rebaja;
     private $imagen;
     private $ciclogra;
     private $fecsal;
     private $fecrec;
     private $fecapr;
     private $fecbac;
     private $fecpda;
     private $feccer;
     private $fecfot;
     private $convenio;
     private $punto;
     private $acta;
     private $fechact;
     private $nui;
     //Objeto gestionador de base de datos
     private $conexionExpedientealumno;

     public function __construct()
     {
          $atributos= array( "CODCARRERA","NOMBRES","APELLIDO1","APELLIDO2","APELLCASAD","MUNINACIMI","DEPTONACIM","FECHANACIM","NACIONALID","EDAD","SEXO","ESTADOCIVI","CEDULA","TELEFONO","DIRECCION","MUNIDIRECC","DEPTODIREC","INSTITUCIO","TITULO","EXPEDIENTE","LUGARTRABA","TELTRABAJO","DIRTRABAJO","TIPOINGRES","ESTATUS","CICLOINGRE","OBSERVACIO","TITULOBACH","PARTIDAORI","CERTIFICAC","FOTOS","DECLARACIO","CODIGOINTE","AVISOS_C","AVISOS_I","AVISOS_D","EMPRESA","TIPOBECA","EMPRESABEC","CODIGO_PLA","CUMGENERAL","CUMRELATIV","CODIGO_USU","FECHA_INGR","TIPOPAGO","SALDOANTER","CARGOS","ABONOS","SALDOACTUA","FECHA_SOLI","EXTENSION","CUMTEMPORA","UVTEMPORAL","MARCA","REBAJA","IMAGEN","CICLOGRA","FEC_SAL","FEC_REC","FEC_APR","FEC_BAC","FEC_PDA","FEC_CER","FEC_FOT","CONVENIO","PUNTO","ACTA","FECHACT","NUI" );
          $this->conexionExpedientealumno = new MySQL();
          $this->conexionExpedientealumno->setNombreTabla("expedientealumno");
          $this->conexionExpedientealumno->setNombreAtributos($atributos);
          $this->conexionExpedientealumno->setNombreLlavePrimaria("CARNET");
     }

     public function setExpedientealumnoPorLlave($llave)
     {
          if($registro=$this->conexionExpedientealumno->consultarRegistro($llave))
          {
               $this->carnet=$llave;
               $this->codcarrera=$registro[0];
               $this->nombres=$registro[1];
               $this->apellido1=$registro[2];
               $this->apellido2=$registro[3];
               $this->apellcasad=$registro[4];
               $this->muninacimi=$registro[5];
               $this->deptonacim=$registro[6];
               $this->fechanacim=$registro[7];
               $this->nacionalid=$registro[8];
               $this->edad=$registro[9];
               $this->sexo=$registro[10];
               $this->estadocivi=$registro[11];
               $this->cedula=$registro[12];
               $this->telefono=$registro[13];
               $this->direccion=$registro[14];
               $this->munidirecc=$registro[15];
               $this->deptodirec=$registro[16];
               $this->institucio=$registro[17];
               $this->titulo=$registro[18];
               $this->expediente=$registro[19];
               $this->lugartraba=$registro[20];
               $this->teltrabajo=$registro[21];
               $this->dirtrabajo=$registro[22];
               $this->tipoingres=$registro[23];
               $this->estatus=$registro[24];
               $this->cicloingre=$registro[25];
               $this->observacio=$registro[26];
               $this->titulobach=$registro[27];
               $this->partidaori=$registro[28];
               $this->certificac=$registro[29];
               $this->fotos=$registro[30];
               $this->declaracio=$registro[31];
               $this->codigointe=$registro[32];
               $this->avisosc=$registro[33];
               $this->avisosi=$registro[34];
               $this->avisosd=$registro[35];
               $this->empresa=$registro[36];
               $this->tipobeca=$registro[37];
               $this->empresabec=$registro[38];
               $this->codigopla=$registro[39];
               $this->cumgeneral=$registro[40];
               $this->cumrelativ=$registro[41];
               $this->codigousu=$registro[42];
               $this->fechaingr=$registro[43];
               $this->tipopago=$registro[44];
               $this->saldoanter=$registro[45];
               $this->cargos=$registro[46];
               $this->abonos=$registro[47];
               $this->saldoactua=$registro[48];
               $this->fechasoli=$registro[49];
               $this->extension=$registro[50];
               $this->cumtempora=$registro[51];
               $this->uvtemporal=$registro[52];
               $this->marca=$registro[53];
               $this->rebaja=$registro[54];
               $this->imagen=$registro[55];
               $this->ciclogra=$registro[56];
               $this->fecsal=$registro[57];
               $this->fecrec=$registro[58];
               $this->fecapr=$registro[59];
               $this->fecbac=$registro[60];
               $this->fecpda=$registro[61];
               $this->feccer=$registro[62];
               $this->fecfot=$registro[63];
               $this->convenio=$registro[64];
               $this->punto=$registro[65];
               $this->acta=$registro[66];
               $this->fechact=$registro[67];
               $this->nui=$registro[68];
               return true;
          }
          else
          {
               return false;
          }
     }

     //metodos Establecer(set)
     public function setCarnet($CARNET)
     {
          $this->carnet=$CARNET;
     }
     public function setCodcarrera($CODCARRERA)
     {
          $this->codcarrera=$CODCARRERA;
     }
     public function setNombres($NOMBRES)
     {
          $this->nombres=$NOMBRES;
     }
     public function setApellido1($APELLIDO1)
     {
          $this->apellido1=$APELLIDO1;
     }
     public function setApellido2($APELLIDO2)
     {
          $this->apellido2=$APELLIDO2;
     }
     public function setApellcasad($APELLCASAD)
     {
          $this->apellcasad=$APELLCASAD;
     }
     public function setMuninacimi($MUNINACIMI)
     {
          $this->muninacimi=$MUNINACIMI;
     }
     public function setDeptonacim($DEPTONACIM)
     {
          $this->deptonacim=$DEPTONACIM;
     }
     public function setFechanacim($FECHANACIM)
     {
          $this->fechanacim=$FECHANACIM;
     }
     public function setNacionalid($NACIONALID)
     {
          $this->nacionalid=$NACIONALID;
     }
     public function setEdad($EDAD)
     {
          $this->edad=$EDAD;
     }
     public function setSexo($SEXO)
     {
          $this->sexo=$SEXO;
     }
     public function setEstadocivi($ESTADOCIVI)
     {
          $this->estadocivi=$ESTADOCIVI;
     }
     public function setCedula($CEDULA)
     {
          $this->cedula=$CEDULA;
     }
     public function setTelefono($TELEFONO)
     {
          $this->telefono=$TELEFONO;
     }
     public function setDireccion($DIRECCION)
     {
          $this->direccion=$DIRECCION;
     }
     public function setMunidirecc($MUNIDIRECC)
     {
          $this->munidirecc=$MUNIDIRECC;
     }
     public function setDeptodirec($DEPTODIREC)
     {
          $this->deptodirec=$DEPTODIREC;
     }
     public function setInstitucio($INSTITUCIO)
     {
          $this->institucio=$INSTITUCIO;
     }
     public function setTitulo($TITULO)
     {
          $this->titulo=$TITULO;
     }
     public function setExpediente($EXPEDIENTE)
     {
          $this->expediente=$EXPEDIENTE;
     }
     public function setLugartraba($LUGARTRABA)
     {
          $this->lugartraba=$LUGARTRABA;
     }
     public function setTeltrabajo($TELTRABAJO)
     {
          $this->teltrabajo=$TELTRABAJO;
     }
     public function setDirtrabajo($DIRTRABAJO)
     {
          $this->dirtrabajo=$DIRTRABAJO;
     }
     public function setTipoingres($TIPOINGRES)
     {
          $this->tipoingres=$TIPOINGRES;
     }
     public function setEstatus($ESTATUS)
     {
          $this->estatus=$ESTATUS;
     }
     public function setCicloingre($CICLOINGRE)
     {
          $this->cicloingre=$CICLOINGRE;
     }
     public function setObservacio($OBSERVACIO)
     {
          $this->observacio=$OBSERVACIO;
     }
     public function setTitulobach($TITULOBACH)
     {
          $this->titulobach=$TITULOBACH;
     }
     public function setPartidaori($PARTIDAORI)
     {
          $this->partidaori=$PARTIDAORI;
     }
     public function setCertificac($CERTIFICAC)
     {
          $this->certificac=$CERTIFICAC;
     }
     public function setFotos($FOTOS)
     {
          $this->fotos=$FOTOS;
     }
     public function setDeclaracio($DECLARACIO)
     {
          $this->declaracio=$DECLARACIO;
     }
     public function setCodigointe($CODIGOINTE)
     {
          $this->codigointe=$CODIGOINTE;
     }
     public function setAvisosC($AVISOS_C)
     {
          $this->avisosc=$AVISOS_C;
     }
     public function setAvisosI($AVISOS_I)
     {
          $this->avisosi=$AVISOS_I;
     }
     public function setAvisosD($AVISOS_D)
     {
          $this->avisosd=$AVISOS_D;
     }
     public function setEmpresa($EMPRESA)
     {
          $this->empresa=$EMPRESA;
     }
     public function setTipobeca($TIPOBECA)
     {
          $this->tipobeca=$TIPOBECA;
     }
     public function setEmpresabec($EMPRESABEC)
     {
          $this->empresabec=$EMPRESABEC;
     }
     public function setCodigoPla($CODIGO_PLA)
     {
          $this->codigopla=$CODIGO_PLA;
     }
     public function setCumgeneral($CUMGENERAL)
     {
          $this->cumgeneral=$CUMGENERAL;
     }
     public function setCumrelativ($CUMRELATIV)
     {
          $this->cumrelativ=$CUMRELATIV;
     }
     public function setCodigoUsu($CODIGO_USU)
     {
          $this->codigousu=$CODIGO_USU;
     }
     public function setFechaIngr($FECHA_INGR)
     {
          $this->fechaingr=$FECHA_INGR;
     }
     public function setTipopago($TIPOPAGO)
     {
          $this->tipopago=$TIPOPAGO;
     }
     public function setSaldoanter($SALDOANTER)
     {
          $this->saldoanter=$SALDOANTER;
     }
     public function setCargos($CARGOS)
     {
          $this->cargos=$CARGOS;
     }
     public function setAbonos($ABONOS)
     {
          $this->abonos=$ABONOS;
     }
     public function setSaldoactua($SALDOACTUA)
     {
          $this->saldoactua=$SALDOACTUA;
     }
     public function setFechaSoli($FECHA_SOLI)
     {
          $this->fechasoli=$FECHA_SOLI;
     }
     public function setExtension($EXTENSION)
     {
          $this->extension=$EXTENSION;
     }
     public function setCumtempora($CUMTEMPORA)
     {
          $this->cumtempora=$CUMTEMPORA;
     }
     public function setUvtemporal($UVTEMPORAL)
     {
          $this->uvtemporal=$UVTEMPORAL;
     }
     public function setMarca($MARCA)
     {
          $this->marca=$MARCA;
     }

     public function setRebaja($REBAJA)
     {
          $this->rebaja=$REBAJA;
     }
     public function setImagen($IMAGEN)
     {
          $this->imagen=$IMAGEN;
     }
     public function setCiclogra($CICLOGRA)
     {
          $this->ciclogra=$CICLOGRA;
     }
     public function setFecSal($FEC_SAL)
     {
          $this->fecsal=$FEC_SAL;
     }
     public function setFecRec($FEC_REC)
     {
          $this->fecrec=$FEC_REC;
     }
     public function setFecApr($FEC_APR)
     {
          $this->fecapr=$FEC_APR;
     }
     public function setFecBac($FEC_BAC)
     {
          $this->fecbac=$FEC_BAC;
     }
     public function setFecPda($FEC_PDA)
     {
          $this->fecpda=$FEC_PDA;
     }
     public function setFecCer($FEC_CER)
     {
          $this->feccer=$FEC_CER;
     }
     public function setFecFot($FEC_FOT)
     {
          $this->fecfot=$FEC_FOT;
     }
     public function setConvenio($CONVENIO)
     {
          $this->convenio=$CONVENIO;
     }
     public function setPunto($PUNTO)
     {
          $this->punto=$PUNTO;
     }
     public function setActa($ACTA)
     {
          $this->acta=$ACTA;
     }
     public function setFechact($FECHACT)
     {
          $this->fechact=$FECHACT;
     }
     public function setNui($NUI)
     {
          $this->nui=$NUI;
     }

     //metodos Obtener(get)
     public function getCarnet()
     {
          return $this->carnet;
     }
     public function getCodcarrera()
     {
          return $this->codcarrera;
     }
     public function getNombres()
     {
          return $this->nombres;
     }
     public function getApellido1()
     {
          return $this->apellido1;
     }
     public function getApellido2()
     {
          return $this->apellido2;
     }
     public function getApellcasad()
     {
          return $this->apellcasad;
     }
     public function getMuninacimi()
     {
          return $this->muninacimi;
     }
     public function getDeptonacim()
     {
          return $this->deptonacim;
     }
     public function getFechanacim()
     {
          return $this->fechanacim;
     }
     public function getNacionalid()
     {
          return $this->nacionalid;
     }
     public function getEdad()
     {
          return $this->edad;
     }
     public function getSexo()
     {
          return $this->sexo;
     }
     public function getEstadocivi()
     {
          return $this->estadocivi;
     }
     public function getCedula()
     {
          return $this->cedula;
     }
     public function getTelefono()
     {
          return $this->telefono;
     }
     public function getDireccion()
     {
          return $this->direccion;
     }
     public function getMunidirecc()
     {
          return $this->munidirecc;
     }
     public function getDeptodirec()
     {
          return $this->deptodirec;
     }
     public function getInstitucio()
     {
          return $this->institucio;
     }
     public function getTitulo()
     {
          return $this->titulo;
     }
     public function getExpediente()
     {
          return $this->expediente;
     }
     public function getLugartraba()
     {
          return $this->lugartraba;
     }
     public function getTeltrabajo()
     {
          return $this->teltrabajo;
     }
     public function getDirtrabajo()
     {
          return $this->dirtrabajo;
     }
     public function getTipoingres()
     {
          return $this->tipoingres;
     }
     public function getEstatus()
     {
          return $this->estatus;
     }
     public function getCicloingre()
     {
          return $this->cicloingre;
     }
     public function getObservacio()
     {
          return $this->observacio;
     }
     public function getTitulobach()
     {
          return $this->titulobach;
     }
     public function getPartidaori()
     {
          return $this->partidaori;
     }
     public function getCertificac()
     {
          return $this->certificac;
     }
     public function getFotos()
     {
          return $this->fotos;
     }
     public function getDeclaracio()
     {
          return $this->declaracio;
     }
     public function getCodigointe()
     {
          return $this->codigointe;
     }
     public function getAvisosC()
     {
          return $this->avisosc;
     }
     public function getAvisosI()
     {
          return $this->avisosi;
     }
     public function getAvisosD()
     {
          return $this->avisosd;
     }
     public function getEmpresa()
     {
          return $this->empresa;
     }
     public function getTipobeca()
     {
          return $this->tipobeca;
     }
     public function getEmpresabec()
     {
          return $this->empresabec;
     }
     public function getCodigoPla()
     {
          return $this->codigopla;
     }
     public function getCumgeneral()
     {
          return $this->cumgeneral;
     }
     public function getCumrelativ()
     {
          return $this->cumrelativ;
     }
     public function getCodigoUsu()
     {
          return $this->codigousu;
     }
     public function getFechaIngr()
     {
          return $this->fechaingr;
     }
     public function getTipopago()
     {
          return $this->tipopago;
     }
     public function getSaldoanter()
     {
          return $this->saldoanter;
     }
     public function getCargos()
     {
          return $this->cargos;
     }
     public function getAbonos()
     {
          return $this->abonos;
     }
     public function getSaldoactua()
     {
          return $this->saldoactua;
     }
     public function getFechaSoli()
     {
          return $this->fechasoli;
     }
     public function getExtension()
     {
          return $this->extension;
     }
     public function getCumtempora()
     {
          return $this->cumtempora;
     }
     public function getUvtemporal()
     {
          return $this->uvtemporal;
     }
     public function getMarca()
     {
          return $this->marca;
     }
     public function getRebaja()
     {
          return $this->rebaja;
     }
     public function getImagen()
     {
          return $this->imagen;
     }
     public function getCiclogra()
     {
          return $this->ciclogra;
     }
     public function getFecSal()
     {
          return $this->fecsal;
     }
     public function getFecRec()
     {
          return $this->fecrec;
     }
     public function getFecApr()
     {
          return $this->fecapr;
     }
     public function getFecBac()
     {
          return $this->fecbac;
     }
     public function getFecPda()
     {
          return $this->fecpda;
     }
     public function getFecCer()
     {
          return $this->feccer;
     }
     public function getFecFot()
     {
          return $this->fecfot;
     }
     public function getConvenio()
     {
          return $this->convenio;
     }
     public function getPunto()
     {
          return $this->punto;
     }
     public function getActa()
     {
          return $this->acta;
     }
     public function getFechact()
     {
          return $this->fechact;
     }
     public function getNui()
     {
          return $this->nui;
     }

     //metodo generador de listado
     public function getListadoExpedientealumnos()
     {
          return $this->conexionExpedientealumno->listaLlaves("CODCARRERA", "ASC");
     }

     //metodo buscador de coincidencias
     public function buscarExpedientealumno($valor)
     {
          return $this->conexionExpedientealumno->buscar($valor,"CODCARRERA", "ASC");
     }

     //metodos relacionados a la base de datos
     public function insertExpedientealumno()
     {
           $atributos=array( $this->codcarrera , $this->nombres , $this->apellido1 , $this->apellido2 , $this->apellcasad , $this->muninacimi , $this->deptonacim , $this->fechanacim , $this->nacionalid , $this->edad , $this->sexo , $this->estadocivi , $this->cedula , $this->telefono , $this->direccion , $this->munidirecc , $this->deptodirec , $this->institucio , $this->titulo , $this->expediente , $this->lugartraba , $this->teltrabajo , $this->dirtrabajo , $this->tipoingres , $this->estatus , $this->cicloingre , $this->observacio , $this->titulobach , $this->partidaori , $this->certificac , $this->fotos , $this->declaracio , $this->codigointe , $this->avisosc , $this->avisosi , $this->avisosd , $this->empresa , $this->tipobeca , $this->empresabec , $this->codigopla , $this->cumgeneral , $this->cumrelativ , $this->codigousu , $this->fechaingr , $this->tipopago , $this->saldoanter , $this->cargos , $this->abonos , $this->saldoactua , $this->fechasoli , $this->extension , $this->cumtempora , $this->uvtemporal , $this->marca , $this->rebaja , $this->imagen , $this->ciclogra , $this->fecsal , $this->fecrec , $this->fecapr , $this->fecbac , $this->fecpda , $this->feccer , $this->fecfot , $this->convenio , $this->punto , $this->acta , $this->fechact , $this->nui );
          //descomentarear la l�nea siguiente y comentarear la anterior si la llave primaria no es autoincremental
          //$atributos=array( $this->carnet , $this->codcarrera , $this->nombres , $this->apellido1 , $this->apellido2 , $this->apellcasad , $this->muninacimi , $this->deptonacim , $this->fechanacim , $this->nacionalid , $this->edad , $this->sexo , $this->estadocivi , $this->cedula , $this->telefono , $this->direccion , $this->munidirecc , $this->deptodirec , $this->institucio , $this->titulo , $this->expediente , $this->lugartraba , $this->teltrabajo , $this->dirtrabajo , $this->tipoingres , $this->estatus , $this->cicloingre , $this->observacio , $this->titulobach , $this->partidaori , $this->certificac , $this->fotos , $this->declaracio , $this->codigointe , $this->avisosc , $this->avisosi , $this->avisosd , $this->empresa , $this->tipobeca , $this->empresabec , $this->codigopla , $this->cumgeneral , $this->cumrelativ , $this->codigousu , $this->fechaingr , $this->tipopago , $this->saldoanter , $this->cargos , $this->abonos , $this->saldoactua , $this->fechasoli , $this->extension , $this->cumtempora , $this->uvtemporal , $this->marca , $this->rebaja , $this->imagen , $this->ciclogra , $this->fecsal , $this->fecrec , $this->fecapr , $this->fecbac , $this->fecpda , $this->feccer , $this->fecfot , $this->convenio , $this->punto , $this->acta , $this->fechact , $this->nui );

          return $this->conexionExpedientealumno->insertarRegistro($atributos);
     }
     public function updateExpedientealumno()
     {
          $atributos=array( $this->codcarrera , $this->nombres , $this->apellido1 , $this->apellido2 , $this->apellcasad , $this->muninacimi , $this->deptonacim , $this->fechanacim , $this->nacionalid , $this->edad , $this->sexo , $this->estadocivi , $this->cedula , $this->telefono , $this->direccion , $this->munidirecc , $this->deptodirec , $this->institucio , $this->titulo , $this->expediente , $this->lugartraba , $this->teltrabajo , $this->dirtrabajo , $this->tipoingres , $this->estatus , $this->cicloingre , $this->observacio , $this->titulobach , $this->partidaori , $this->certificac , $this->fotos , $this->declaracio , $this->codigointe , $this->avisosc , $this->avisosi , $this->avisosd , $this->empresa , $this->tipobeca , $this->empresabec , $this->codigopla , $this->cumgeneral , $this->cumrelativ , $this->codigousu , $this->fechaingr , $this->tipopago , $this->saldoanter , $this->cargos , $this->abonos , $this->saldoactua , $this->fechasoli , $this->extension , $this->cumtempora , $this->uvtemporal , $this->marca , $this->rebaja , $this->imagen , $this->ciclogra , $this->fecsal , $this->fecrec , $this->fecapr , $this->fecbac , $this->fecpda , $this->feccer , $this->fecfot , $this->convenio , $this->punto , $this->acta , $this->fechact , $this->nui );
		  return $this->conexionExpedientealumno->actualizarRegistro($this->carnet,$atributos);
		 
     }
}
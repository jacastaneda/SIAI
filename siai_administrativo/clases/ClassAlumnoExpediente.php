<?php

session_start();

class ClassAlumnoExpediente {

    //Atributos Privados

    private $CARNET;
    private $CODCARRERA;
    private $NOMBRES;
    private $APELLIDO1;
    private $APELLIDO2;
    private $APELLCASAD;
    private $TIPOINGRES;
    private $TIPOBECA;
    private $CODIGO_PLA;
    //update,

    private $SEXO;
    private $ESTADOCIVI;
    private $DIRECCION;
    private $TELEFONO;
    private $NACIONALID;
    private $DEPTODIREC;
    private $MUNIDIRECC;
    private $DEPTONACIM;
    private $MUNINACIMI;
    private $FECHANACIM;


    /* Aqui comienzan el update Documentacion */
    private $INSTITUCIO;
    private $EXPEDIENTE;
    private $TITULO;
    private $TITULOBACH;
    private $FEC_BAC;
    private $PARTIDAORI;
    private $FEC_PDA;
    private $CERTIFICAC;
    private $FEC_CER;
    private $FOTOS;
    private $FEC_FOT;
    private $DECLARACIO;
    private $FECHA_SOLI;
    private $LUGARTRABA;
    private $DIRTRABAJO;
    private $TELTRABAJO;


    /* Aqui comienzan el update Universidad */
    private $CICLOINGRE;
    private $ESTATUS;
    private $CICLOGRA;
    private $OBSERVACIO;

    public function setCARNET($CARNET) {

        $this->CARNET = $CARNET;
    }

    public function setCARRERA($CODCARRERA) {

        $this->CODCARRERA = $CODCARRERA;
    }

    public function setNOMBRES($NOMBRES) {

        $this->NOMBRES = $NOMBRES;
    }

    public function setAPELLIDO1($APELLIDO1) {

        $this->APELLIDO1 = $APELLIDO1;
    }

    public function setAPELLIDO2($APELLIDO2) {

        $this->APELLIDO2 = $APELLIDO2;
    }

    public function setAPELLCASAD($APELLCASAD) {

        $this->APELLCASAD = $APELLCASAD;
    }

    public function setTIPOINGRES($TIPOINGRES) {

        $this->TIPOINGRES = $TIPOINGRES;
    }

    public function setTIPOBECA($TIPOBECA) {

        $this->TIPOBECA = $TIPOBECA;
    }

    public function setCODIGO_PLA($CODIGO_PLA) {

        $this->CODIGO_PLA = $CODIGO_PLA;
    }

    public function setSEXO($SEXO) {

        $this->SEXO = $SEXO;
    }

    public function setCODCARRERA($CODCARRERA) {

        $this->CODCARRERA = $CODCARRERA;
    }

    public function setESTADOCIVI($ESTADOCIVI) {

        $this->ESTADOCIVI = $ESTADOCIVI;
    }

    public function setDIRECCION($DIRECCION) {

        $this->DIRECCION = $DIRECCION;
    }

    public function setTELEFONO($TELEFONO) {

        $this->TELEFONO = $TELEFONO;
    }

    public function setNACIONALID($NACIONALID) {

        $this->NACIONALID = $NACIONALID;
    }

    public function setDEPTODIREC($DEPTODIREC) {

        $this->DEPTODIREC = $DEPTODIREC;
    }

    public function setMUNIDIRECC($MUNIDIRECC) {

        $this->MUNIDIRECC = $MUNIDIRECC;
    }

    public function setDEPTONACIM($DEPTONACIM) {

        $this->DEPTONACIM = $DEPTONACIM;
    }

    public function setMUNINACIMI($MUNINACIMI) {

        $this->MUNINACIMI = $MUNINACIMI;
    }

    public function setFECHANACIM($FECHANACIM) {

        $this->FECHANACIM = $FECHANACIM;
    }

    /* Aqui comienzan el update Documentacion */

    public function setINSTITUCIO($INSTITUCIO) {

        $this->INSTITUCIO = $INSTITUCIO;
    }

    public function setEXPEDIENTE($EXPEDIENTE) {

        $this->EXPEDIENTE = $EXPEDIENTE;
    }

    public function setTITULO($TITULO) {

        $this->TITULO = $TITULO;
    }

    public function setTITULOBACH($TITULOBACH) {

        $this->TITULOBACH = $TITULOBACH;
    }

    public function setFEC_BAC($FEC_BAC) {

        $this->FEC_BAC = $FEC_BAC;
    }

    public function setPARTIDAORI($PARTIDAORI) {

        $this->PARTIDAORI = $PARTIDAORI;
    }

    public function setFEC_PDA($FEC_PDA) {

        $this->FEC_PDA = $FEC_PDA;
    }

    public function setCERTIFICAC($CERTIFICAC) {

        $this->CERTIFICAC = $CERTIFICAC;
    }

    public function setFEC_CER($FEC_CER) {

        $this->FEC_CER = $FEC_CER;
    }

    public function setFOTOS($FOTOS) {

        $this->FOTOS = $FOTOS;
    }

    public function setFEC_FOT($FEC_FOT) {

        $this->FEC_FOT = $FEC_FOT;
    }

    public function setDECLARACIO($DECLARACIO) {

        $this->DECLARACIO = $DECLARACIO;
    }

    public function setFECHA_SOLI($FECHA_SOLI) {

        $this->FECHA_SOLI = $FECHA_SOLI;
    }

    public function setLUGARTRABA($LUGARTRABA) {

        $this->LUGARTRABA = $LUGARTRABA;
    }

    public function setDIRTRABAJO($DIRTRABAJO) {

        $this->DIRTRABAJO = $DIRTRABAJO;
    }

    public function setTELTRABAJO($TELTRABAJO) {

        $this->TELTRABAJO = $TELTRABAJO;
    }

    /* Aqui comienzan el update Universidad */

    public function setCICLOINGRE($CICLOINGRE) {

        $this->CICLOINGRE = $CICLOINGRE;
    }

    public function setESTATUS($ESTATUS) {

        $this->ESTATUS = $ESTATUS;
    }

    public function setCICLOGRA($CICLOGRA) {

        $this->CICLOGRA = $CICLOGRA;
    }

    public function setOBSERVACIO($OBSERVACIO) {

        $this->OBSERVACIO = $OBSERVACIO;
    }

    public function getUltimo_plan() {

        $cnx = new MySQL();
        $sql = "SELECT CODIGO_PLA FROM  planes
				  ORDER BY  FECHAPLAN DESC limit 0,1  ";

        $consulta = $cnx->consulta($sql);
        $cn = $cnx->fetch_array($consulta);

        $Matriz = $cn["CODIGO_PLA"];



        return $Matriz;
    }

    public function getCicloActual() {

        $cnx = new MySQL();
        $sql = "SELECT CONCAT( CONCAT( CONSECUTIV,  '/' ) , INCREMENTA ) AS ciclo
				  FROM  control 
				  WHERE NOMBRE =  'CICLOACT' ";

        $consulta = $cnx->consulta($sql);
        $cn = $cnx->fetch_array($consulta);

        $Matriz = $cn["ciclo"];



        return $Matriz;
    }

    public function GuardaExpedienteAlumno() {


        $cnx = new MySQL();
        $sql = "CALL PROC_ABC_EXPEDIENTEALUMNO(1,
													'" . $this->CARNET . "',
													'" . $this->CODCARRERA . "',
													'" . $this->NOMBRES . "',
													'" . $this->APELLIDO1 . "',
													'" . $this->APELLIDO2 . "',
													'" . $this->APELLCASAD . "',
													'" . $this->TIPOINGRES . "',
													'" . $this->TIPOBECA . "',
													'" . $this->CODIGO_PLA . "',
													
													
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													'',
													''
													)";

        $consulta = $cnx->consulta($sql);
        $Aviso = $cnx->consulta("select @msn");
        $msn1 = $cnx->fetch_array($Aviso);
        return $msn1["@msn"];
    }

    public function ActualizarExpedienteAlumno() {


        $cnx = new MySQL();
        $sql = "CALL PROC_ABC_EXPEDIENTEALUMNO(3,
													'" . $this->CARNET . "',
													'" . $this->CODCARRERA . "',
													'" . $this->NOMBRES . "',
													'" . $this->APELLIDO1 . "',
													'" . $this->APELLIDO2 . "',
													'" . $this->APELLCASAD . "',
													'" . $this->TIPOINGRES . "',
													'" . $this->TIPOBECA . "',
													'" . $this->CODIGO_PLA . "',
													
													'" . $this->SEXO . "',
													'" . $this->CODCARRERA . "',
													'" . $this->ESTADOCIVI . "',
													'" . $this->DIRECCION . "',
													'" . $this->TELEFONO . "',
													'" . $this->NACIONALID . "',
													'" . $this->DEPTODIREC . "',
													'" . $this->MUNIDIRECC . "',
													'" . $this->DEPTONACIM . "',
													'" . $this->MUNINACIMI . "',
													'" . $this->FECHANACIM . "',
													
													
													'" . $this->INSTITUCIO . "',
													'" . $this->EXPEDIENTE . "',
													'" . $this->TITULO . "',
													'" . $this->TITULOBACH . "',
													'" . $this->FEC_BAC . "',
													'" . $this->PARTIDAORI . "',
													'" . $this->FEC_PDA . "',
													'" . $this->CERTIFICAC . "',
													'" . $this->FEC_CER . "',
													'" . $this->FOTOS . "',
													'" . $this->FEC_FOT . "',
													'" . $this->DECLARACIO . "',
													'" . $this->FECHA_SOLI . "',
													'" . $this->LUGARTRABA . "',
													'" . $this->DIRTRABAJO . "',
													'" . $this->TELTRABAJO . "',
													
													
													'" . $this->CICLOINGRE . "',
													'" . $this->ESTATUS . "',
													'" . $this->OBSERVACIO . "'
													
													)";

        $consulta = $cnx->consulta($sql);
    }

    //TODOS LOS CATALOGOS
    //catalogo carrera

    public function getCatCarrera() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('carrera','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO_CAR" => $cn["CODIGO_CAR"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getCatNacionalidad() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('nacionalidad','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getDepartamentos() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('departamentos','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getTipoIingreso() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('tipoingreso','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getTipoBeca() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('tipobeca','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getPlanes() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('planes','" . $this->CODIGO_PLA . "')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO_PLA" => $cn["CODIGO_PLA"]);
        }


        return $Matriz;
    }

    public function getInstituciones() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('instituciones','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getTitulo() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('titulo','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getTipoingreso() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('tipoingreso','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getEstatus() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('estatus','')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("CODIGO" => $cn["CODIGO"], "NOMBRE" => $cn["NOMBRE"]);
        }


        return $Matriz;
    }

    public function getCuantosCarnet() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_CATALOGOS('expedientealumno','" . $this->CARNET . "')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array("total" => $cn["total"]);
        }


        return $Matriz[0]["total"];
    }

    public function GetExpedienteAlumno() {

        $cnx = new MySQL();
        $sql = "CALL  PROC_VISTAS('expedientealumno','" . $this->CARNET . "')";

        $consulta = $cnx->consulta($sql);

        while ($cn = $cnx->fetch_array($consulta)) {
            $Matriz[] = array(
                "CARNET" => $cn["CARNET"],
                "CODCARRERA" => $cn["CODCARRERA"],
                "NOMBRES" => $cn["NOMBRES"],
                "APELLIDO1" => $cn["APELLIDO1"],
                "APELLIDO2" => $cn["APELLIDO2"],
                "APELLCASAD" => $cn["APELLCASAD"],
                "MUNINACIMI" => $cn["MUNINACIMI"],
                "DEPTONACIM" => $cn["DEPTONACIM"],
                "FECHANACIM" => $cn["FECHANACIM"],
                "NACIONALID" => $cn["NACIONALID"],
                "EDAD" => $cn["EDAD"],
                "SEXO" => $cn["SEXO"],
                "ESTADOCIVI" => $cn["ESTADOCIVI"],
                "CEDULA" => $cn["CEDULA"],
                "TELEFONO" => $cn["TELEFONO"],
                "DIRECCION" => $cn["DIRECCION"],
                "MUNIDIRECC" => $cn["MUNIDIRECC"],
                "DEPTODIREC" => $cn["DEPTODIREC"],
                "INSTITUCIO" => $cn["INSTITUCIO"],
                "TITULO" => $cn["TITULO"],
                "EXPEDIENTE" => $cn["EXPEDIENTE"],
                "LUGARTRABA" => $cn["LUGARTRABA"],
                "TELTRABAJO" => $cn["TELTRABAJO"],
                "EXPEDIENTE" => $cn["EXPEDIENTE"],
                "DIRTRABAJO" => $cn["DIRTRABAJO"],
                "TIPOINGRES" => $cn["TIPOINGRES"],
                "ESTATUS" => $cn["ESTATUS"],
                "CICLOINGRE" => $cn["CICLOINGRE"],
                "OBSERVACIO" => $cn["OBSERVACIO"],
                "TITULOBACH" => $cn["TITULOBACH"],
                "PARTIDAORI" => $cn["PARTIDAORI"],
                "CERTIFICAC" => $cn["CERTIFICAC"],
                "FOTOS" => $cn["FOTOS"],
                "DECLARACIO" => $cn["DECLARACIO"],
                "CODIGOINTE" => $cn["CODIGOINTE"],
                "FEC_BAC" => $cn["FEC_BAC"],
                "FEC_PDA" => $cn["FEC_PDA"],
                "FEC_FOT" => $cn["FEC_FOT"],
                "FEC_CER" => $cn["FEC_CER"],
                "FECHA_SOLI" => $cn["FECHA_SOLI"],
                "CICLOINGRE" => $cn["CICLOINGRE"],
                "CODIGO_PLA" => $cn["CODIGO_PLA"],
                "CICLOGRA" => $cn["CICLOGRA"],
                "CUMGENERAL" => $cn["CUMGENERAL"],
                "CUMRELATIV" => $cn["CUMRELATIV"]
            );
        }


        return $Matriz;
    }

    public function CatalogoBusqueda($arreglo, $bus) {

        for ($i = 0; $i < count($arreglo); $i++) {

            if ($arreglo[$i]["CODIGO_CAR"] == $bus) {
                $h = $arreglo[$i]["NOMBRE"];
            }
        }
        return $h;
    }

    public function CatalogoBusquedaNacionalidad($arreglo, $bus) {

        for ($i = 0; $i < count($arreglo); $i++) {

            if ($arreglo[$i]["CODIGO"] == $bus) {
                $h = $arreglo[$i]["NOMBRE"];
            }
        }
        return $h;
    }

    public function CatalogoBusquedaDepto($arreglo, $bus) {

        for ($i = 0; $i < count($arreglo); $i++) {

            if ($arreglo[$i]["CODIGO"] == $bus) {
                $h = $arreglo[$i]["NOMBRE"];
            }
        }
        return $h;
    }

    public function CatalogoBusquedaInstitucion($arreglo, $bus) {

        for ($i = 0; $i < count($arreglo); $i++) {

            if ($arreglo[$i]["CODIGO"] == $bus) {
                $h = $arreglo[$i]["NOMBRE"];
            }
        }
        return $h;
    }

    public function CatalogoBusquedaTitulo($arreglo, $bus) {

        for ($i = 0; $i < count($arreglo); $i++) {

            if ($arreglo[$i]["CODIGO"] == $bus) {
                $h = $arreglo[$i]["NOMBRE"];
            }
        }
        return $h;
    }

    public function CatalogoBusquedaEstatus($arreglo, $bus) {

        for ($i = 0; $i < count($arreglo); $i++) {

            if ($arreglo[$i]["CODIGO"] == $bus) {
                $h = $arreglo[$i]["NOMBRE"];
            }
        }
        return $h;
    }

}

//fin de la clase
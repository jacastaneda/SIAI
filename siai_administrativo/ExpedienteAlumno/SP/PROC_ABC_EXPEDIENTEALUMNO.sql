DROP PROCEDURE IF EXISTS siai.PROC_ABC_EXPEDIENTEALUMNO;

CREATE PROCEDURE siai.`PROC_ABC_EXPEDIENTEALUMNO`(
   opcion         int,
   CARNET1        varchar(8),
   CODCARRERA1    varchar(4),
   NOMBRES1       varchar(30),
   APELLIDO11     varchar(15),
   APELLIDO21     varchar(15),
   APELLCASAD1    varchar(30),
   TIPOINGRES1    varchar(2),
   TIPOBECA1      varchar(2),
   CODIGO_PLA1    varchar(4),
   /*Aqui comienzan el update*/

   SEXO           varchar(1),
   CODCARRERA     varchar(4),
   ESTADOCIVI     varchar(1),
   DIRECCION      varchar(60),
   TELEFONO       varchar(10),
   NACIONALID     varchar(3),
   DEPTODIREC     varchar(4),
   MUNIDIRECC     varchar(15),
   DEPTONACIM     varchar(4),
   MUNINACIMI     varchar(50),
   FECHANACIM     date,
   /*Aqui comienzan el update Documentacion*/
   INSTITUCIO     varchar(3),
   EXPEDIENTE     varchar(10),
   TITULO         varchar(3),
   TITULOBACH     int(11),
   FEC_BAC        date,
   PARTIDAORI     int(11),
   FEC_PDA        date,
   CERTIFICAC     int(11),
   FEC_CER        date,
   FOTOS          int(11),
   FEC_FOT        date,
   DECLARACIO     int(11),
   FECHA_SOLI     date,
   LUGARTRABA     varchar(30),
   DIRTRABAJO     varchar(60),
   TELTRABAJO     varchar(10),
   /*Aqui comienzan el update Universidad*/
   CICLOINGRE     varchar(7),
   ESTATUS        varchar(2),
   OBSERVACIO     varchar(900))
   BEGIN
      /*DECLARE Evaluacion1      char(8) DEFAULT NULL;*/
      DECLARE Fechaingreso     datetime;

      DECLARE ierr Int DEFAULT 0;
      DECLARE Ciclongreso1 varchar(7);
      DECLARE ultnum   int;
      DECLARE nui1 varchar(6);
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET ierr=1;
/*DECLARE CONTINUE HANDLER FOR SQLWARNING SET ierr=1;*/


      SET @msn = NULL;
      SET Ciclongreso1 =
             (SELECT CONCAT(CONCAT("0", CONCAT(CONSECUTIV, "/")), INCREMENTA)
                        AS ciclo
                FROM `control`
               WHERE NOMBRE = "CICLOACT");



      /*Captura de fecha y activo*/
      SET Fechaingreso = now();


      /*1 Inserta*/
      IF opcion = 1
      THEN
         SET ultnum = (SELECT max(nui) FROM expedientealumno);


         IF ultnum IS NULL
         THEN
            SET nui1 = ('000001');
         ELSE
            SET nui1 = (right(concat('00000000', ultnum + 1), 6));
         END IF;

         INSERT INTO expedientealumno(CARNET,
                                      CODCARRERA,
                                      NOMBRES,
                                      APELLIDO1,
                                      APELLIDO2,
                                      APELLCASAD,
                                      TIPOINGRES,
                                      TIPOBECA,
                                      CODIGO_PLA,
                                      FECHA_INGR,
                                      CICLOINGRE,
                                      NUI)
         VALUES (CARNET1,
                 CODCARRERA1,
                 NOMBRES1,
                 APELLIDO11,
                 APELLIDO21,
                 APELLCASAD1,
                 TIPOINGRES1,
                 TIPOBECA1,
                 CODIGO_PLA1,
                 Fechaingreso,
                 Ciclongreso1,
                 nui1);
      END IF;

      /*2 Borra*/
      IF opcion = 2
      THEN
         INSERT INTO cdmp_Evaluacion
         VALUES (Evaluacion1,
                 NombreEvaluacion1,
                 Anotaciones1,
                 FechaCreacion1,
                 Activo1);
      END IF;


      /*3 Actualiza */
      IF opcion = 3
      THEN
         UPDATE expedientealumno
            SET SEXO = SEXO,
                CODCARRERA = CODCARRERA,
                ESTADOCIVI = ESTADOCIVI,
                NOMBRES = NOMBRES,
                APELLIDO1 = APELLIDO11,
                APELLIDO2 = APELLIDO21,
                APELLCASAD = APELLCASAD1,
                DIRECCION = DIRECCION,
                TELEFONO = TELEFONO,
                NACIONALID = NACIONALID,
                DEPTODIREC = DEPTODIREC,
                MUNIDIRECC = MUNIDIRECC,
                DEPTONACIM = DEPTONACIM,
                MUNINACIMI = MUNINACIMI,
                FECHANACIM = FECHANACIM,
                /*Documentacion*/
                INSTITUCIO = INSTITUCIO,
                EXPEDIENTE = EXPEDIENTE,
                TITULO = TITULO,
                TITULOBACH = TITULOBACH,
                FEC_BAC = FEC_BAC,
                PARTIDAORI = PARTIDAORI,
                FEC_PDA = FEC_PDA,
                CERTIFICAC = CERTIFICAC,
                FEC_CER = FEC_CER,
                FOTOS = FOTOS,
                FEC_FOT = FEC_FOT,
                DECLARACIO = DECLARACIO,
                FECHA_SOLI = FECHA_SOLI,
                LUGARTRABA = LUGARTRABA,
                DIRTRABAJO = DIRTRABAJO,
                TELTRABAJO = TELTRABAJO,
                /*Universidad*/
                CICLOINGRE = CICLOINGRE,
                CODIGO_PLA = CODIGO_PLA1,
                TIPOINGRES = TIPOINGRES1,
                ESTATUS = ESTATUS,
                OBSERVACIO = OBSERVACIO
          WHERE CARNET = CARNET1;
      END IF;

      IF ierr = 1
      THEN
         SET @msn =
                CONCAT(1,
                       ' | ERROR AL INSERTAR DATOS, CARNET YA EXISTE...');
    ELSE
      SET @msn =
                CONCAT('ALUMNO INGRESADO CORRECTAMENTE ');
      END IF;
   END;
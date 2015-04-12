DROP PROCEDURE IF EXISTS siai.PROC_ABC_PAGOS_ALUMNOS;

CREATE PROCEDURE siai.`PROC_ABC_PAGOS_ALUMNOS`(cuenta         varchar(50),
                                               fecha          date,
                                               hora           time,
                                               transaccion    varchar(5),
                                               valor          double,
                                               nui            varchar(6),
                                               cod_arancel    varchar(4),
                                               N_cuota        int,
                                               ciclo          int,
                                               anio           int)
   BEGIN
     DECLARE ierr Int DEFAULT 0;

DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET ierr=1;
DECLARE CONTINUE HANDLER FOR SQLWARNING SET ierr=1;


      SET @msn = NULL;
      INSERT INTO pagosalumnos () VALUES(cuenta,
      fecha,
      hora,
      transaccion,
      valor,
      nui,
      cod_arancel,
      N_cuota,
      ciclo,
      anio
      )      ;

      IF ierr = 1
      THEN
         SET @msn =
                CONCAT(1,
                       ' | ERROR AL INSERTAR DATOS, REGISTRO YA EXISTE...');
      END IF;
   END;
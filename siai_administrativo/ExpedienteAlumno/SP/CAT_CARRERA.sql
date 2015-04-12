DROP PROCEDURE IF EXISTS siai.PROC_CATALOGOS;

CREATE PROCEDURE siai.`PROC_CATALOGOS`(tabla       varchar(100),
                                       busqueda    varchar(100))
   BEGIN
      IF (tabla = "carrera")
      THEN
         SELECT * FROM carrera;
      END IF;

      IF (tabla = "tipoingreso")
      THEN
         SELECT * FROM tipoingreso;
      END IF;

      IF (tabla = "tipobeca")
      THEN
         SELECT * FROM tipobeca;
      END IF;

      IF (tabla = "planes")
      THEN
         SELECT DISTINCT (CODIGO_PLA)
           FROM planes
          WHERE CODIGO_PLA = busqueda;
      END IF;

      IF (tabla = "expedientealumno")
      THEN
         SELECT COUNT(*) AS total
           FROM expedientealumno
          WHERE CARNET LIKE concat(busqueda, '%');
      END IF;
   END;

CALL PROC_CATALOGOS("expedientealumno", "um2006");
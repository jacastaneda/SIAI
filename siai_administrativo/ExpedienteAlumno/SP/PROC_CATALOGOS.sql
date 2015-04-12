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
         SELECT *
           FROM tipoingreso
         ORDER BY NOMBRE DESC;
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

      IF (tabla = "nacionalidad")
      THEN
         SELECT * FROM nacionalidad;
      END IF;

      IF (tabla = "departamentos")
      THEN
         SELECT * FROM departamentos;
      END IF;

      IF (tabla = "departamentos")
      THEN
         SELECT * FROM departamentos;
      END IF;

      IF (tabla = "instituciones")
      THEN
         SELECT * FROM instituciones;
      END IF;

      IF (tabla = "titulo")
      THEN
         SELECT * FROM titulo;
      END IF;

      IF (tabla = "tipoingreso")
      THEN
         SELECT *
           FROM tipoingreso
         ORDER BY NOMBRE DESC;
      END IF;

      IF (tabla = "estatus")
      THEN
         SELECT * FROM estatus;
      END IF;
   END;
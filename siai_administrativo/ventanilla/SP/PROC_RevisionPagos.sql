DROP PROCEDURE IF EXISTS siai.PROC_RevisionPagos;
CREATE PROCEDURE siai.`PROC_RevisionPagos`()
BEGIN
     
SELECT o.arancel,
       o.nui,
       o.usuario,
       fn_RevisionPagos(o.nui,o.arancel,o.usuario) as coordinador
  FROM    siai_obligaciones AS o
       INNER JOIN
          siai_control AS c
       ON o.usuario = c.usuario
 WHERE c.solvente = 0;

     
   END;
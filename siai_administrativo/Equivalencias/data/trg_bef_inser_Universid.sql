
DELIMITER |
CREATE TRIGGER trg_bef_inser_Carrera BEFORE INSERT ON proc_carreras
FOR EACH ROW
BEGIN
 DECLARE li_maxIdCarrera INT;
 SET li_maxIdCarrera = (SELECT  IFNULL(max(idCarrera),0)from PROC_Carreras where idUniversidad = NEW.idUniversidad and idFacultadEqui = NEW.idFacultadEqui) +1;
 set NEW.idCarrera = li_maxIdCarrera;
 END
|
DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_EstaCivil BEFORE INSERT ON proc_estadocivil
FOR EACH ROW
BEGIN
 DECLARE li_maxIdEstadoCivil INT;
 SET li_maxIdEstadoCivil = (SELECT  IFNULL(max(idEstadoCivil),0)  from PROC_EstadoCivil)   + 1;
 set NEW.idEstadoCivil = li_maxIdEstadoCivil;
END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_EstaMateria BEFORE INSERT ON proc_estadomateria
FOR EACH ROW
BEGIN
 DECLARE li_maxIdEstadoMateria INT;
 SET li_maxIdEstadoMateria = (SELECT  IFNULL(max(idEstadoMateriaSoli),0)  from PROC_EstadoMateria)   + 1;
 set NEW.idEstadoMateriaSoli = li_maxIdEstadoMateria;
END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_EstaSoliEqui BEFORE INSERT ON proc_estadosoliequivalencia
FOR EACH ROW
BEGIN
 DECLARE li_maxidEstadoSolicitudEqui INT;
 SET li_maxidEstadoSolicitudEqui = (SELECT  IFNULL(max(idEstadoSolicitudEqui),0)  from PROC_EstadoSoliEquivalencia)   + 1;
 set NEW.idEstadoSolicitudEqui = li_maxidEstadoSolicitudEqui;
END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_Facultad BEFORE INSERT ON proc_facultades
FOR EACH ROW
BEGIN
 DECLARE li_maxIdFacultad INT;
 SET li_maxIdFacultad = (SELECT  IFNULL(max(idFacultadEqui),0)from proc_facultades where idUniversidad = NEW.idUniversidad ) +1;
 set NEW.idFacultadEqui = li_maxIdFacultad;
 END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_Materia BEFORE INSERT ON proc_materias
FOR EACH ROW
BEGIN
 DECLARE li_maxIdMateria INT;
 SET li_maxIdMateria = (SELECT  IFNULL(max(idMateriaProcedencia),0) from PROC_Materias where idUniversidad = NEW.idUniversidad and idFacultadEqui = NEW.idFacultadEqui and idCarrera = NEW.idCarrera) +1;
 set NEW.idMateriaProcedencia = li_maxIdMateria;
END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_Universid BEFORE INSERT ON proc_universidades
FOR EACH ROW
BEGIN
		DECLARE li_maxIdUniversidad INT;
		SET li_maxIdUniversidad = (SELECT  IFNULL(max(idUniversidad),0)  from proc_universidades)   + 1;
		set NEW.idUniversidad = li_maxIdUniversidad;
	END//


DELIMITER ;


DELIMITER //
CREATE  TRIGGER trg_bef_inser_MatrizEQ BEFORE INSERT ON proc_matrizequivalencias
FOR EACH ROW
BEGIN
 DECLARE li_maxidCorrMateria INT;
 SET li_maxidCorrMateria = (SELECT  IFNULL(max(idCorrMateria),0) from proc_matrizequivalencias where idUniversidad = NEW.idUniversidad and idFacultadEqui = NEW.idFacultadEqui and idCarrera = NEW.idCarrera ) +1;
 set NEW.idCorrMateria = li_maxidCorrMateria;
END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_SolicitudEQ BEFORE INSERT ON proc_solicitudequivalencia
FOR EACH ROW
BEGIN
 DECLARE li_maxidSolicitudEqui INT;
 SET li_maxidSolicitudEqui = (SELECT  IFNULL(max(idSolicitudEqui),0) from proc_solicitudequivalencia ) +1;
 set NEW.idSolicitudEqui = li_maxidSolicitudEqui;
END//


DELIMITER ;

DELIMITER //
CREATE  TRIGGER trg_bef_inser_AnalisisEQ BEFORE INSERT ON proc_analisismaterias
FOR EACH ROW
BEGIN
 DECLARE li_maxidCorrMateSolicitada INT;
 SET li_maxidCorrMateSolicitada = (SELECT  IFNULL(max(idCorrMateSolicitada),0) from proc_analisismaterias where idSolicitudEqui = NEW.idSolicitudEqui ) +1;
 set NEW.idCorrMateSolicitada = li_maxidCorrMateSolicitada;
END//


DELIMITER ;

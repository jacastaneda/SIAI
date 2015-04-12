--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 1, 'Universidad Tecnologica' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 2, 'Universidad Francisco Gavidia' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 3, 'Universidad Nacional de El Salvador' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 4, 'USAM' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 5, 'Universidad Evangelica' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 6, 'Universidad Pedagogica' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 7, 'Universidad Andres Bello' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 8, 'UNSSA' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 9, 'Universidad Jose Matias Delgado' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 10, 'UCA' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 11, 'UTLA' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 12, 'Universidad Albert Einstein' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 13, 'UMA' ) 
;
INSERT INTO proc_universidades ( idUniversidad, nombreUniversidad ) 
		 VALUES ( 14, 'Universidad Don Bosco' ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_facultades ( idUniversidad, idFacultadEqui, nombreFacultadEqui, idFacultadUPES ) 
		 VALUES ( 1, 1, 'Facultad de Informática y Ciencias Aplicadas', '01' ) 
;
INSERT INTO proc_facultades ( idUniversidad, idFacultadEqui, nombreFacultadEqui, idFacultadUPES ) 
		 VALUES ( 1, 2, 'Facultad de Ciencias Empresariales', '02' ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_carreras ( idUniversidad, idFacultadEqui, idCarrera, nombreCarreraEquivalencia ) 
		 VALUES ( 1, 1, 1, 'Ingeniería en Sistemas y Computación' ) 
;
INSERT INTO proc_carreras ( idUniversidad, idFacultadEqui, idCarrera, nombreCarreraEquivalencia ) 
		 VALUES ( 1, 1, 2, 'Ingeniería Industrial' ) 
;
INSERT INTO proc_carreras ( idUniversidad, idFacultadEqui, idCarrera, nombreCarreraEquivalencia ) 
		 VALUES ( 1, 1, 3, 'Licenciatura en Informática' ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 1, 1, 'MATEMÁTICA I', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 2, 1, 'EXPRESIÓN ORAL Y ESCRITA DEL ESPAÑOL', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 3, 1, 'DIBUJO TÉCNICO', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 4, 1, 'INGLÉS I', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 5, 1, 'MATEMÁTICA II', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 6, 2, 'FÍSICA I', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 7, 2, 'DIBUJO APLICADOI', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 8, 3, 'MATEMÁTICA III', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 9, 3, 'FÍSICA II', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 10, 3, 'ESTADÍSTICA Y PROBABILIDADES', 4 ) 
;
INSERT INTO proc_materias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCiclo, nombreMateriaProcedencia, UV ) 
		 VALUES ( 1, 1, 1, 11, 3, 'FÍSICA III', 4 ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_matrizequivalencias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idCorrMateria, UV_upes, cicloPlan, UV_procedencia ) 
		 VALUES ( 1, 1, 1, 1, '2601', 'MAT100', 1, 4, 1, 4 ) 
;
INSERT INTO proc_matrizequivalencias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idCorrMateria, UV_upes, cicloPlan, UV_procedencia ) 
		 VALUES ( 1, 1, 1, 2, '2601', 'TEL126', 2, 4, 1, 4 ) 
;
INSERT INTO proc_matrizequivalencias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idCorrMateria, UV_upes, cicloPlan, UV_procedencia ) 
		 VALUES ( 1, 1, 1, 4, '2601', 'INT027', 3, 4, 3, 4 ) 
;
INSERT INTO proc_matrizequivalencias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idCorrMateria, UV_upes, cicloPlan, UV_procedencia ) 
		 VALUES ( 1, 1, 1, 5, '2601', 'MAT200', 5, 4, 3, 4 ) 
;
INSERT INTO proc_matrizequivalencias ( idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idCorrMateria, UV_upes, cicloPlan, UV_procedencia ) 
		 VALUES ( 1, 1, 1, 6, '2601', 'FIS100', 4, 4, 3, 4 ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_cargo ( idCargo, Nombre, Descripcion ) 
		 VALUES ( 1, 'Decano', NULL ) 
;
INSERT INTO proc_cargo ( idCargo, Nombre, Descripcion ) 
		 VALUES ( 2, 'Coordinador', NULL ) 
;
INSERT INTO proc_cargo ( idCargo, Nombre, Descripcion ) 
		 VALUES ( 3, 'Docente', NULL ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_catedraticos ( idCatedratico, idCargo, Titulo, Nombres, Apellidos, Estado, email ) 
		 VALUES ( 1, 1, 'Ing.', 'Ra�l Alberto', 'Garc�a Aquino', 1, ' raul.garcia@politecnica.edu.sv' ) 
;
INSERT INTO proc_catedraticos ( idCatedratico, idCargo, Titulo, Nombres, Apellidos, Estado, email ) 
		 VALUES ( 2, 1, 'Lic.', 'Wilber Evenor', 'G�mez Rivas', 1, 'w.rivas@upes' ) 
;
INSERT INTO proc_catedraticos ( idCatedratico, idCargo, Titulo, Nombres, Apellidos, Estado, email ) 
		 VALUES ( 3, 1, 'Lic.', 'Sandra', 'Romero de Garay', 1, 's.garay@upes' ) 
;
INSERT INTO proc_catedraticos ( idCatedratico, idCargo, Titulo, Nombres, Apellidos, Estado, email ) 
		 VALUES ( 4, 2, 'Ing.', 'Guillermo Antonio', 'P�rez', 1, 'g.perez@upes' ) 
;

--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_estadosoliequivalencia ( idEstadoSolicitudEqui, nombreEstadoSoliEqui, estadoActivado, descripcionEstado ) 
		 VALUES ( 1, 'Ingresada', 1, '' ) 
;
INSERT INTO proc_estadosoliequivalencia ( idEstadoSolicitudEqui, nombreEstadoSoliEqui, estadoActivado, descripcionEstado ) 
		 VALUES ( 2, 'Cancelada', 1, '' ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_estadomateria ( idEstadoMateriaSoli, nombreEstadoMateria ) 
		 VALUES ( 1, 'Digitada' ) 
;
INSERT INTO proc_estadomateria ( idEstadoMateriaSoli, nombreEstadoMateria ) 
		 VALUES ( 2, 'En Equivalencia' ) 
;
INSERT INTO proc_estadomateria ( idEstadoMateriaSoli, nombreEstadoMateria ) 
		 VALUES ( 3, 'Aprobada' ) 
;

--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_solicitudequivalencia ( idSolicitudEqui, idEstadoSolicitudEqui, fechaIngreSolicitud, numeroCarne, nombresSolicitante, PrimerApellidoSolicitante, segundoApellidoSolicitante, apellidoCasadaSolicitante, idCatedratico ) 
		 VALUES ( 6, 1, '2013-02-01 00:00:00.000', 'GO200702', 'SAUL ALEXIS', 'GONZALEZ', 'ORTIZ', '', '4' ) 
;
INSERT INTO proc_solicitudequivalencia ( idSolicitudEqui, idEstadoSolicitudEqui, fechaIngreSolicitud, numeroCarne, nombresSolicitante, PrimerApellidoSolicitante, segundoApellidoSolicitante, apellidoCasadaSolicitante, idCatedratico ) 
		 VALUES ( 7, 2, '2013-01-01 00:00:00.000', 'GO200702', 'SAUL ALEXIS', 'GONZALEZ', 'ORTIZ', '', '4' ) 
;
INSERT INTO proc_solicitudequivalencia ( idSolicitudEqui, idEstadoSolicitudEqui, fechaIngreSolicitud, numeroCarne, nombresSolicitante, PrimerApellidoSolicitante, segundoApellidoSolicitante, apellidoCasadaSolicitante, idCatedratico ) 
		 VALUES ( 8, 1, '2013-02-01 00:00:00.000', 'GO200702', 'SAUL ALEXIS', 'GONZALEZ', 'ORTIZ', '', '4' ) 
;
--
-- TABLE INSERT STATEMENTS
--
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 6, 1, 1, 1, 1, '2601', 'MAT100', 1, 1, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 6, 1, 1, 1, 2, '2601', 'TEL126', 2, 2, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 6, 1, 1, 1, 4, '2601', 'INT027', 2, 3, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 6, 1, 1, 1, 5, '2601', 'MAT200', 3, 4, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 6, 1, 1, 1, 6, '2601', 'FIS100', 3, 5, 'Pendiente' ) 
;

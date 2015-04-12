--para el ingreso por equivalencias se tomo el carnet numero SR201202
--y el plan de estudio 2626	de la carrera 2601	, si no esta end la tabla sia_planes hacer el insert
--Luis debes de tomar los datos de la tabla de proc_analisismaterias cpon idEstadoMateriaSoli =2 (en estudio)


delete from  proc_materias;

delete from proc_matrizequivalencias;

delete from proc_solicitudequivalencia;

delete from proc_analisismaterias;

insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,1,'MATEMATICA I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,1,'EXPRESION ORAL Y ESCRITA DEL ESPANOL',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,1,'DIBUJO TECNICO',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,1,'INGLES I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,2,'MATEMATICA II',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,2,'FISICA I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,2,'DIBUJO APLICADO',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,3,'MATEMATICA III',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,3,'FISICA II',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,3,'ESTADISTICA Y PROBABILIDADES',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,3,'FISICA III',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,4,'ALGORITMOS I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,4,'INTRODUCCION AL ANALISIS DE CIRCUITOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,4,'MATEMATICA FINANCIERA',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,5,'SISTEMAS OPERATIVOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,5,'PROGRAMACION ORIENTADA A OBJETOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,5,'SISTEMAS DIGITALES',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,6,'BASE DE DATOS I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,6,'ORGANIZACION DE LAS COMPUTADORAS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,7,'REDES DE DATOS I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,8,'REDES DE DATOS II',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,9,'FORMULACION Y EVALUACION DE PROYECTOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,9,'SISTEMAS DE INFORMACION GERENCIAL',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(1,1,1,10,'LENGUAJE UNIFICADO DE MODELADO(UML);',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,1,'MATEMATICA I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,1,'REDACCION Y ORTOGRAFIA',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,1,'TECNOLOGIAS DE LA COMUNICACION Y LA INFORMACION I Y II',8);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,1,'DIBUJO TECNICO',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,1,'INGLES I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,2,'MATEMATICA II',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,2,'FISICA I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,2,'LOGICA PROPOSICIONAL',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,3,'MATEMATICA III',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,3,'FISICA II',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,3,'ESTADISTICA I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,3,'FISICA III',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,4,'CIRCUITOS ELECTRICOS I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,4,'INGENIERIA ECONOMICA',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,5,'SISTEMAS OPERATIVOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,5,'CONTABILIDAD PARA INGENIEROS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,6,'DISENO DE BASES DE DATOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,7,'ADMINISTRACION DE BASES DE DATOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,7,'REDES DE COMPUTADORAS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,8,'ANALISIS DE SISTEMAS I Y II',8);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,8,'INVESTIGACION DE OPERACIONES I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,9,'DISENO Y EVALUACION DE PROYECTOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(2,1,1,9,'INGENIERIA DE SOFTWARE I Y II',8);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,1,'MATEMATICA I',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,1,'IDIOMA ESPANOL',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,1,'SOFTWARE DE APLICACIONES',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,1,'DIBUJO TECNICO',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,1,'INGLES I',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,2,'MATEMATICA II',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,2,'FISICA',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,3,'MATEMATICA III',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,3,'ESTADISTICA Y PROBABILIDAD',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,4,'DISENO DE PAGINAS WEB',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,4,'LOGICA COMPUTACIONAL',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,4,'METODOLOGIA DE LA INVESTIGACION I',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,6,'LEGISLACION APLICADA A LA EMPRESA',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,6,'BASE DE DATOS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,7,'PROTOCOLO DE COMUNICACION DE REDES',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,8,'ANALISIS DE SISTEMAS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,9,'FORMULACION Y EVALUACION DE PROYECTOS',3);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,10,'INTRANETS',4);
insert into proc_materias(idUniversidad,idFacultadEqui,idCarrera,idCiclo,nombreMateriaProcedencia,UV) values(3,1,1,10,'AUDITORIA DE SISTEMAS',4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,1,'2601','PRE000',5,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,2,'2601','COE000',3,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,3,'2601','DGD000',4,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,5,'2601','CAL100',5,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,6,'2601','FIS100',4,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,7,'2601','DAS000',2,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,8,'2601','CAL200',5,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,9,'2601','FIS200',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,10,'2601','ETD100',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,11,'2601','EYM000',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,12,'2601','FDP000',4,4,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,13,'2601','CEL100',4,4,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,14,'2601','IEC000',4,4,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,15,'2601','SOP026',3,5,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,16,'2601','POB026',4,5,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,17,'2601','SED000',4,5,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,18,'2601','BAD126',4,6,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,19,'2601','ODC026',4,6,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,20,'2601','REC026',4,7,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,21,'2601','HDR026',4,8,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,22,'2601','FEPE00',3,9,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,23,'2601','ASI026',3,9,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(1,1,1,24,'2601','TET326',3,10,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,1,'2601','PRE000',5,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,2,'2601','COE000',3,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,3,'2601','CMB000',4,1,8);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,4,'2601','DGD000',4,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,6,'2601','CAL100',5,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,7,'2601','FIS100',4,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,8,'2601','CPP026',4,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,9,'2601','CAL200',5,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,10,'2601','FIS200',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,11,'2601','ETD100',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,12,'2601','EYM000',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,13,'2601','CEL100',4,4,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,14,'2601','IEC000',4,4,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,15,'2601','SOP026',3,5,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,16,'2601','COF024',4,5,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,17,'2601','BAD126',4,6,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,18,'2601','BAD226',4,7,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,19,'2601','REC026',4,7,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,20,'2601','AYD026',4,8,8);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,21,'2601','TET126',3,8,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,22,'2601','FEPE00',3,9,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(2,1,1,23,'2601','ISO026',4,9,8);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,1,'2601','PRE000',5,1,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,2,'2601','COE000',3,1,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,3,'2601','CMB000',4,1,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,4,'2601','DGD000',4,1,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,6,'2601','CAL100',5,2,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,7,'2601','FIS100',4,2,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,8,'2601','CAL200',5,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,9,'2601','ETD100',4,3,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,10,'2601','WWW026',3,4,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,11,'2601','FDP000',4,4,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,12,'2601','MYT000',3,4,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,13,'2601','LAE000',3,6,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,14,'2601','BAD126',4,6,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,15,'2601','REC026',4,7,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,16,'2601','AYD026',4,8,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,17,'2601','FEPE00',3,9,3);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,18,'2601','DIN026',3,10,4);
insert into proc_matrizequivalencias(idUniversidad,idFacultadEqui,idCarrera,idMateriaProcedencia,idCodCarreraUPES,IdCodAsignaturaUPES,UV_upes,cicloPlan,UV_procedencia) values(3,1,1,19,'2601','SIA026',3,10,4);
INSERT INTO proc_solicitudequivalencia ( idSolicitudEqui, idEstadoSolicitudEqui, fechaIngreSolicitud, numeroCarne, nombresSolicitante, PrimerApellidoSolicitante, segundoApellidoSolicitante, apellidoCasadaSolicitante, idCatedratico ) 
		 VALUES ( 1, 1, '1970-01-01 00:00:00.000', 'SR201202', 'JORGE ALBERTO', 'SANCHEZ', 'RIVAS', '', '4' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 1, '2601', 'PRE000', 2, 1, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 2, '2601', 'COE000', 1, 2, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 3, '2601', 'DGD000', 1, 3, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 4, '2601', '', 1, 4, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 5, '2601', 'CAL100', 2, 5, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 6, '2601', 'FIS100', 2, 6, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 7, '2601', 'DAS000', 1, 7, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 8, '2601', 'CAL200', 2, 8, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 9, '2601', 'FIS200', 2, 9, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 10, '2601', 'ETD100', 1, 10, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 11, '2601', 'EYM000', 2, 11, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 12, '2601', 'FDP000', 1, 12, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 13, '2601', 'CEL100', 1, 13, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 14, '2601', 'IEC000', 1, 14, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 15, '2601', 'SOP026', 1, 15, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 16, '2601', 'POB026', 1, 16, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 17, '2601', 'SED000', 1, 17, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 18, '2601', 'BAD126', 1, 18, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 19, '2601', 'ODC026', 1, 19, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 20, '2601', 'REC026', 1, 20, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 21, '2601', 'HDR026', 1, 21, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 22, '2601', 'FEPE00', 1, 22, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 23, '2601', 'ASI026', 1, 23, 'Pendiente' ) 
;
INSERT INTO proc_analisismaterias ( idSolicitudEqui, idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES, idEstadoMateriaSoli, idCorrMateSolicitada, observacionMateria ) 
		 VALUES ( 1, 1, 1, 1, 24, '2601', 'TET326', 1, 24, 'Pendiente' ) 
;


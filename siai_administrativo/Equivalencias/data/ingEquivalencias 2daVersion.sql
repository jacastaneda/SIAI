/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/11/2012 12:24:26 a.m.                     */
/*==============================================================*/

drop table if exists PROC_Cargo;

drop table if exists PROC_Catedraticos;

drop table if exists PROC_AnalisisMaterias;

drop table if exists PROC_Carreras;

drop table if exists PROC_EstadoCivil;

drop table if exists PROC_EstadoMateria;

drop table if exists PROC_EstadoSoliEquivalencia;

drop table if exists PROC_Facultades;

drop table if exists PROC_HistEstadoSolicitud;

drop table if exists PROC_Materias;

drop table if exists PROC_MatrizEquivalencias;

drop table if exists PROC_SolicitudEquivalencia;

drop table if exists PROC_Universidades;

/*==============================================================*/
/* Table: PROC_AnalisisMaterias                                 */
/*==============================================================*/
create table PROC_AnalisisMaterias
(
   idSolicitudEqui      int not null,
   idUniversidad        int not null,
   idFacultadEqui       int not null,
   idCarrera            int not null,
   idMateriaProcedencia int not null,
   idCodCarreraUPES     varchar(4) not null,
   IdCodAsignaturaUPES  varchar(8) not null,
   idEstadoMateriaSoli  smallint not null,
   idCorrMateSolicitada int not null,
   observacionMateria   varchar(250),
   primary key (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idSolicitudEqui, idCodCarreraUPES, IdCodAsignaturaUPES)
);

/*==============================================================*/
/* Table: PROC_Carreras                                         */
/*==============================================================*/
create table PROC_Carreras
(
   idUniversidad        int not null,
   idFacultadEqui       int not null,
   idCarrera            int not null,
   nombreCarreraEquivalencia varchar(100) not null,
   primary key (idUniversidad, idFacultadEqui, idCarrera)
);

/*==============================================================*/
/* Table: PROC_EstadoCivil                                      */
/*==============================================================*/
create table PROC_EstadoCivil
(
   idEstadoCivil        int not null,
   nombreEstadoCivil    varchar(75) not null,
   primary key (idEstadoCivil)
);

/*==============================================================*/
/* Table: PROC_EstadoMateria                                    */
/*==============================================================*/
create table PROC_EstadoMateria
(
   idEstadoMateriaSoli  smallint not null,
   nombreEstadoMateria  varchar(25) not null,
   primary key (idEstadoMateriaSoli)
);

/*==============================================================*/
/* Table: PROC_EstadoSoliEquivalencia                           */
/*==============================================================*/
create table PROC_EstadoSoliEquivalencia
(
   idEstadoSolicitudEqui int not null,
   nombreEstadoSoliEqui varchar(25) not null,
   estadoActivado       bool not null,
   descripcionEstado    varchar(250),
   primary key (idEstadoSolicitudEqui)
);

/*==============================================================*/
/* Table: PROC_Facultades                                       */
/*==============================================================*/
create table PROC_Facultades
(
   idUniversidad        int not null,
   idFacultadEqui       int not null,
   nombreFacultadEqui   varchar(100) not null,
   idFacultadUPES     varchar(2)  not null,
   primary key (idUniversidad, idFacultadEqui)
);

/*==============================================================*/
/* Table: PROC_HistEstadoSolicitud                              */
/*==============================================================*/
create table PROC_HistEstadoSolicitud
(
   idCorrelativoHist    smallint not null,
   idSolicitudEqui      int,
   fechaCambio          datetime not null,
   estadoAnterior       int not null,
   estadoActual         int not null,
   usuarioCambio        varchar(16) not null,
   primary key (idCorrelativoHist)
);

/*==============================================================*/
/* Table: PROC_Materias                                         */
/*==============================================================*/
create table PROC_Materias
(
   idUniversidad        int not null,
   idFacultadEqui       int not null,
   idCarrera            int not null,
   idMateriaProcedencia int not null,
   idCiclo              int not null,
   nombreMateriaProcedencia varchar(100) not null,
   UV                   smallint not null,
   primary key (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia)
);

/*==============================================================*/
/* Table: PROC_MatrizEquivalencias                              */
/*==============================================================*/
create table PROC_MatrizEquivalencias
(
   idUniversidad        int not null,
   idFacultadEqui       int not null,
   idCarrera            int not null,
   idMateriaProcedencia int not null,
   idCodCarreraUPES     varchar(4) not null,
   IdCodAsignaturaUPES  varchar(8) not null,
   idCorrMateria        smallint not null,
   UV_upes              smallint not null,
   cicloPlan            smallint not null,
   UV_procedencia       smallint not null,
   primary key (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES)
);

/*==============================================================*/
/* Table: PROC_SolicitudEquivalencia                            */
/*==============================================================*/
create table PROC_SolicitudEquivalencia
(
   idSolicitudEqui      int not null,
   idEstadoSolicitudEqui int,
   fechaIngreSolicitud  datetime not null,
   numeroCarne          varchar(10) not null,
   nombresSolicitante   varchar(30) not null,
   PrimerApellidoSolicitante varchar(20) not null,
   segundoApellidoSolicitante varchar(20),
   apellidoCasadaSolicitante varchar(20),
   idCatedratico        varchar(4) not null,
   primary key (idSolicitudEqui)
);

/*==============================================================*/
/* Table: PROC_Universidades                                    */
/*==============================================================*/
create table PROC_Universidades
(
   idUniversidad        int not null,
   nombreUniversidad    varchar(75) not null,
   primary key (idUniversidad)
);

/*==============================================================*/
/* Table: PROC_Cargo                                            */
/*==============================================================*/
create table PROC_Cargo
(
   idCargo              int not null,
   Nombre               varchar(50) not null,
   Descripcion          varchar(250),
   primary key (idCargo)
);

/*==============================================================*/
/* Table: PROC_Catedraticos                                     */
/*==============================================================*/
create table PROC_Catedraticos
(
   idCatedratico        int not null,
   idCargo              int not null,
   Titulo               varchar(5) not null,
   Nombres              varchar(25) not null,
   Apellidos            varchar(25) not null,
   Estado               int not null,
   email                varchar(50) not null,
   primary key (idCatedratico)
);


alter table PROC_Catedraticos add constraint FK_REFERENCE_11 foreign key (idCargo)
      references PROC_Cargo (idCargo) on delete restrict on update restrict;

alter table PROC_AnalisisMaterias add constraint FK_RELATIONSHIP_16 foreign key (idSolicitudEqui)
      references PROC_SolicitudEquivalencia (idSolicitudEqui) on delete restrict on update restrict;

alter table PROC_AnalisisMaterias add constraint FK_RELATIONSHIP_17 foreign key (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES)
      references PROC_MatrizEquivalencias (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia, idCodCarreraUPES, IdCodAsignaturaUPES) on delete restrict on update restrict;

alter table PROC_AnalisisMaterias add constraint FK_RELATIONSHIP_20 foreign key (idEstadoMateriaSoli)
      references PROC_EstadoMateria (idEstadoMateriaSoli) on delete restrict on update restrict;

alter table PROC_Carreras add constraint FK_RELATIONSHIP_2 foreign key (idUniversidad, idFacultadEqui)
      references PROC_Facultades (idUniversidad, idFacultadEqui) on delete restrict on update restrict;

alter table PROC_Facultades add constraint FK_RELATIONSHIP_1 foreign key (idUniversidad)
      references PROC_Universidades (idUniversidad) on delete restrict on update restrict;

alter table PROC_HistEstadoSolicitud add constraint FK_RELATIONSHIP_21 foreign key (idSolicitudEqui)
      references PROC_SolicitudEquivalencia (idSolicitudEqui) on delete restrict on update restrict;

alter table PROC_Materias add constraint FK_RELATIONSHIP_3 foreign key (idUniversidad, idFacultadEqui, idCarrera)
      references PROC_Carreras (idUniversidad, idFacultadEqui, idCarrera) on delete restrict on update restrict;

alter table PROC_MatrizEquivalencias add constraint FK_RELATIONSHIP_6 foreign key (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia)
      references PROC_Materias (idUniversidad, idFacultadEqui, idCarrera, idMateriaProcedencia) on delete restrict on update restrict;

alter table PROC_SolicitudEquivalencia add constraint FK_RELATIONSHIP_12 foreign key (idEstadoSolicitudEqui)
      references PROC_EstadoSoliEquivalencia (idEstadoSolicitudEqui) on delete restrict on update restrict;




USE PRUEBA;

CREATE TABLE TABLA_REPORTES 
(ID NUMERIC IDENTITY(1,1) PRIMARY KEY NOT NULL,
 FECHA DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
 SOLICITANTE VARCHAR(100) NOT NULL,
 ASUNTO VARCHAR(200) NOT NULL,
 ESTADO VARCHAR(20) DEFAULT 'PENDIENTE' NOT NULL,
 TIPO VARCHAR(20) NOT NULL,
 DIFICULTAD VARCHAR(20) NOT NULL,
 TIEMPO_ESTIMADO DATE,
 ENTREGA DATE,
 USUARIO_CREACION VARCHAR(15) NOT NULL);
SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS Casas;

USE Casas;

DROP TABLE IF EXISTS casa;

CREATE TABLE `casa` (
  `idCasa` int(11) NOT NULL AUTO_INCREMENT,
  `casa_Nombre` varchar(30) NOT NULL,
  `casa_Descripcion` varchar(255) NOT NULL,
  `casa_Lati` decimal(10,7) NOT NULL,
  `casa_Long` decimal(10,7) NOT NULL,
  `casa_Region` varchar(30) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `casa_Renta` int(11) NOT NULL,
  `casa_Deposito` int(11) NOT NULL,
  PRIMARY KEY (`idCasa`),
  KEY `fkUser_Cas` (`idUsuario`),
  CONSTRAINT `fkUser_Cas` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2009 DEFAULT CHARSET=utf8mb4;

INSERT INTO casa VALUES("2000","CASA LUNA","Casa de dos piso, con alberca en el centro de Guerrero, esta casa Luna.","18.6336033","-99.2569469","Morelos","1000","1000","2000");
INSERT INTO casa VALUES("2002","SOL","","0.0000000","0.0000000","Guerrero","1000","0","0");
INSERT INTO casa VALUES("2003","TIERRA","","0.0000000","0.0000000","Guerrero","1000","0","0");
INSERT INTO casa VALUES("2004","MARTE","","0.0000000","0.0000000","Guerrero","1000","0","0");
INSERT INTO casa VALUES("2005","CASA VERDE","","19.4337714","-99.1444216","Ciudad de México","1001","0","0");



DROP TABLE IF EXISTS clausula;

CREATE TABLE `clausula` (
  `idClausula` int(11) NOT NULL AUTO_INCREMENT,
  `clau_Icon` varchar(20) NOT NULL,
  `clau_Descripcion` varchar(45) NOT NULL,
  `clau_Tipo` enum('Regla','Seguridad y Salud') NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idClausula`),
  KEY `fkCas_Clau` (`idCasa`),
  CONSTRAINT `fkCas_Clau` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6002 DEFAULT CHARSET=utf8mb4;

INSERT INTO clausula VALUES("6000","?","Entrada 11:00","Seguridad y Salud","2000");
INSERT INTO clausula VALUES("6001","?","Mascotas","Regla","2000");



DROP TABLE IF EXISTS comentario;

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `comment_Fecha` varchar(20) NOT NULL,
  `comment_Nomb` varchar(20) NOT NULL,
  `comment_Email` varchar(60) NOT NULL,
  `comment_Text` varchar(255) NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idComentario`),
  KEY `fkCas_Com` (`idCasa`),
  CONSTRAINT `fkCas_Com` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100005 DEFAULT CHARSET=utf8mb4;

INSERT INTO comentario VALUES("100000","noviembre del 2021","Victor","diazpixtoriin@gmail.com","Me encanto la estancia, súper práctica, limpia, buen precio, buena zona, no hace falta nada. Muy amables Ivón y Estefanía en sus atenciones y pendientes a las dudas.","2000");
INSERT INTO comentario VALUES("100001","noviembre del 2021","Luis","dmvo180028@upemor.edu.mx","En general es aceptable. Les recomiendo llevar cerillos para encender la estufa y estar al pendiente de los quemadores ya que se apagan solos y puede ocurrir un accidente.","2000");
INSERT INTO comentario VALUES("100002","noviembre del 2021","Zara","vdm_2120_@hotmail.com","Excelente lugar en una excelente ubicación, la atención por parte de Ivón fue excelente. Espero volver pronto :)","2000");
INSERT INTO comentario VALUES("100003","noviembre del 2021","German","iram.gs.1989@gmail.com","Excelente lugar, buenísima ubicación, limpio, ordenado, el anfitrión con mucha comunicación y disponibilidad, super recomendable.","2000");
INSERT INTO comentario VALUES("100004","noviembre del 2021","Jesus","comprasmercado2016@outlook.com","De nuevo todo súper bien!","2000");



DROP TABLE IF EXISTS contrato;

CREATE TABLE `contrato` (
  `idContrato` int(11) NOT NULL AUTO_INCREMENT,
  `cont_FechAct` date NOT NULL,
  `cont_NombreArren` varchar(30) NOT NULL,
  `cont_APaterArren` varchar(30) NOT NULL,
  `cont_AMaterArren` varchar(30) NOT NULL,
  `cont_FechEntrada` date NOT NULL,
  `cont_FechSalida` date NOT NULL,
  `cont_Anticipo` double NOT NULL,
  `cont_MontoTotal` double NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idContrato`),
  KEY `fkContr_Cas` (`idCasa`),
  CONSTRAINT `fkContr_Cas` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10020 DEFAULT CHARSET=utf8mb4;

INSERT INTO contrato VALUES("10000","0000-00-00","Juan","Sanchez","Lopez","2021-10-26","2021-10-28","0","0","2000");
INSERT INTO contrato VALUES("10001","0000-00-00","Benito","Camelo","Garcia","2021-10-19","2021-10-22","0","0","2000");
INSERT INTO contrato VALUES("10002","0000-00-00","Benito","Camelo","Garcia","2021-10-19","2021-10-22","0","0","2003");
INSERT INTO contrato VALUES("10003","0000-00-00","Juan","Benito","Sanchez","2021-09-21","2021-09-23","0","0","2000");
INSERT INTO contrato VALUES("10004","0000-00-00","Benito","Camelo","Garcia","2021-10-20","2021-10-22","0","0","2003");
INSERT INTO contrato VALUES("10005","0000-00-00","Juan","Sanchez","Lopez","2021-09-25","2021-09-27","0","0","2000");
INSERT INTO contrato VALUES("10006","0000-00-00","Benito","Camelo","Garcia","2021-09-08","2021-09-10","0","0","2003");
INSERT INTO contrato VALUES("10009","0000-00-00","Victor","Diaz","Medina","2021-10-29","2021-10-31","4000","4000","2000");
INSERT INTO contrato VALUES("10010","0000-00-00","Victor","Diaz","Medina","2021-10-29","2021-10-31","4000","4000","2000");
INSERT INTO contrato VALUES("10011","0000-00-00","Juanito","Med","sss","2021-10-29","2021-10-31","4000","4000","2000");
INSERT INTO contrato VALUES("10012","0000-00-00","Juanito","Med","sss","2021-10-29","2021-10-31","4000","4000","2000");
INSERT INTO contrato VALUES("10013","0000-00-00","Victor","Diaz","Medina","2021-11-08","2021-11-11","4000","5000","2000");
INSERT INTO contrato VALUES("10014","0000-00-00","Victor","Diaz","Medina","2021-11-19","2021-11-21","4000","4000","2000");
INSERT INTO contrato VALUES("10015","0000-00-00","Victor","Diaz","Medina","2021-12-03","2021-12-05","4000","4000","2000");
INSERT INTO contrato VALUES("10016","0000-00-00","Luis","Diaz","Medina","2021-12-24","2021-12-26","4000","4000","2000");
INSERT INTO contrato VALUES("10017","0000-00-00","Luis","Diaz","Medina","2021-12-10","2021-12-12","4000","4000","2000");
INSERT INTO contrato VALUES("10018","2021-11-08","Luis","Diaz","Medina","2021-12-17","2021-12-19","4000","4000","2000");
INSERT INTO contrato VALUES("10019","0000-00-00","Victor","Diaz","Medina","2021-12-31","2022-01-02","4000","4000","2000");



DROP TABLE IF EXISTS fotografia;

CREATE TABLE `fotografia` (
  `idFotografia` int(11) NOT NULL AUTO_INCREMENT,
  `img_Tipo` varchar(20) NOT NULL,
  `img_Url` varchar(45) NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idFotografia`),
  KEY `fkCas_Foto` (`idCasa`),
  CONSTRAINT `fkCas_Foto` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7024 DEFAULT CHARSET=utf8mb4;

INSERT INTO fotografia VALUES("7010","header","59cc5892806910fa6f2376ebb23d904c.png","2000");
INSERT INTO fotografia VALUES("7011","right2","4f10b7f080316ecaaddc78542eda1cd5.png","2000");
INSERT INTO fotografia VALUES("7012","right1","089bb4a2ec64e16832ddd3d4c319f61a.png","2000");
INSERT INTO fotografia VALUES("7013","galeria","img1.jpg","2000");
INSERT INTO fotografia VALUES("7014","galeria","img2.jpg","2000");
INSERT INTO fotografia VALUES("7015","galeria","img3.jpg","2000");
INSERT INTO fotografia VALUES("7016","galeria","img4.jpg","2000");
INSERT INTO fotografia VALUES("7017","galeria","img5.jpg","2000");
INSERT INTO fotografia VALUES("7018","galeria","img6.jpg","2000");
INSERT INTO fotografia VALUES("7019","galeria","img7.jpg","2000");
INSERT INTO fotografia VALUES("7020","galeria","img5.jpg","2004");
INSERT INTO fotografia VALUES("7021","galeria","img6.jpg","2004");
INSERT INTO fotografia VALUES("7022","galeria","img7.jpg","2004");
INSERT INTO fotografia VALUES("7023","galeria","img8.jpg","2004");



DROP TABLE IF EXISTS promocion;

CREATE TABLE `promocion` (
  `idPromocion` int(11) NOT NULL AUTO_INCREMENT,
  `promo_Codigo` varchar(45) NOT NULL,
  `promo_Cantidad` int(11) NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idPromocion`),
  KEY `fkCas_Pro` (`idCasa`),
  CONSTRAINT `fkCas_Pro` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=200002 DEFAULT CHARSET=utf8mb4;

INSERT INTO promocion VALUES("200000","CasaVerdePromo","1002","2005");



DROP TABLE IF EXISTS servicio;

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `serv_Icon` varchar(20) NOT NULL,
  `serv_Descripcion` varchar(45) NOT NULL,
  `serv_Cantidad` int(11) NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idServicio`),
  KEY `fkCas_Serv` (`idCasa`),
  CONSTRAINT `fkCas_Serv` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3003 DEFAULT CHARSET=utf8mb4;

INSERT INTO servicio VALUES("3001","?","Television","6","2000");
INSERT INTO servicio VALUES("3002","?","wsss","0","2000");



DROP TABLE IF EXISTS usuario;

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `user_Nombre` varchar(30) NOT NULL,
  `user_APaterno` varchar(30) NOT NULL,
  `user_AMaterno` varchar(30) NOT NULL,
  `user_FechNac` date NOT NULL,
  `user_Perfil` varchar(300) NOT NULL,
  `user_INE` varchar(300) NOT NULL,
  `user_WhatsApp` varchar(10) NOT NULL,
  `user_Password` varchar(255) NOT NULL,
  `user_Status` int(11) NOT NULL,
  `user_Role` enum('user','admin') NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8mb4;

INSERT INTO usuario VALUES("1000","Antonio","Diaz","Medina","0000-00-00","","","1234567890","$2y$10$18PzgkzAoN6BbyPMAbBkweus.L1D855HMCOgXREFlw/d3dOYZWT9m","1","user");
INSERT INTO usuario VALUES("1001","Victor","Diaz","Medina","1999-10-21","4509e8e54b67ac76a7fffaddcab208c0.png","","7774432521","$2y$10$Wf9802qOqwIbwl4Dw4Yp2uaHZXE2eFmgNnjV//wpaRplrafuSFeYu","1","user");
INSERT INTO usuario VALUES("1005","Admin","Admin","Admin","0000-00-00","","","1111111111","$2y$10$18PzgkzAoN6BbyPMAbBkweus.L1D855HMCOgXREFlw/d3dOYZWT9m","0","admin");



SET FOREIGN_KEY_CHECKS=1;
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
  `casa_Logo` varchar(45) NOT NULL,
  `casa_Renta` int(11) NOT NULL,
  `casa_Deposito` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idCasa`),
  KEY `fkUser_Cas` (`idUsuario`),
  CONSTRAINT `fkUser_Cas` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2004 DEFAULT CHARSET=utf8mb4;

INSERT INTO casa VALUES("2000","CASA VERDE","","19.4337714","-99.1444216","Mexico City","4616c6b49d26ca8943cf7c1a50bb93f3.png","1000","2000","1001");
INSERT INTO casa VALUES("2001","CASA LUNA","Casa de dos piso, con alberca en el centro de Guerrero, esta casa Luna.","18.6336033","-99.2569469","Morelos","355e3b0fa822d86b49c0db31c039dca2.png","0","0","1002");
INSERT INTO casa VALUES("2002","CASA ROJA","Casa de dos piso, con alberca en el centro de Guerrero, esta casa Luna.","18.6336033","-99.2569469","Morelos","","0","0","1002");
INSERT INTO casa VALUES("2003","CASA AZUL","Casa de dos piso, con alberca en el centro de Guerrero, esta casa Luna.","18.6336033","-99.2569469","Morelos","","0","0","1001");



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
) ENGINE=InnoDB AUTO_INCREMENT=100006 DEFAULT CHARSET=utf8mb4;

INSERT INTO comentario VALUES("100000","noviembre del 2021","Victor","diazpixtoriin@gmail.com","Me encanto la estancia, súper práctica, limpia, buen precio, buena zona, no hace falta nada. Muy amables Ivón y Estefanía en sus atenciones y pendientes a las dudas.","2000");
INSERT INTO comentario VALUES("100001","noviembre del 2021","Luis","dmvo180028@upemor.edu.mx","En general es aceptable. Les recomiendo llevar cerillos para encender la estufa y estar al pendiente de los quemadores ya que se apagan solos y puede ocurrir un accidente.","2000");
INSERT INTO comentario VALUES("100002","noviembre del 2021","Zara","vdm_2120_@hotmail.com","Excelente lugar en una excelente ubicación, la atención por parte de Ivón fue excelente. Espero volver pronto :)","2000");
INSERT INTO comentario VALUES("100003","noviembre del 2021","German","iram.gs.1989@gmail.com","Excelente lugar, buenísima ubicación, limpio, ordenado, el anfitrión con mucha comunicación y disponibilidad, super recomendable.","2000");
INSERT INTO comentario VALUES("100004","noviembre del 2021","Jesus","comprasmercado2016@outlook.com","De nuevo todo súper bien!","2000");
INSERT INTO comentario VALUES("100005","noviembre del 2021","German","sandra@upemor.edu.mx","ssssssssssssssssssssss","2000");



DROP TABLE IF EXISTS contrato;

CREATE TABLE `contrato` (
  `idContrato` int(11) NOT NULL AUTO_INCREMENT,
  `cont_FechAct` date NOT NULL,
  `cont_NombreArren` varchar(30) NOT NULL,
  `cont_APaterArren` varchar(30) NOT NULL,
  `cont_AMaterArren` varchar(30) NOT NULL,
  `cont_INE` varchar(30) NOT NULL,
  `cont_FechEntrada` date NOT NULL,
  `cont_FechSalida` date NOT NULL,
  `cont_Anticipo` double NOT NULL,
  `cont_MontoTotal` double NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idContrato`),
  KEY `fkContr_Cas` (`idCasa`),
  CONSTRAINT `fkContr_Cas` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10009 DEFAULT CHARSET=utf8mb4;

INSERT INTO contrato VALUES("10001","2021-11-08","Benito","Romero","Garcia","","2022-02-01","2022-02-08","4000","7000","2000");
INSERT INTO contrato VALUES("10002","2021-11-08","Juan","Sanchez","Lopez","","2021-12-10","2021-12-12","4000","4000","2000");
INSERT INTO contrato VALUES("10003","2021-11-08","Luis","Diaz","Sanchez","","2021-12-29","2021-12-31","4000","4000","2000");
INSERT INTO contrato VALUES("10004","2021-11-08","Juan","Sanchez","Lopez","","2021-11-26","2021-11-28","4000","4000","2001");
INSERT INTO contrato VALUES("10005","2021-11-08","Benito","Romero","Garcia","","2021-11-19","2021-11-22","4000","4000","2001");
INSERT INTO contrato VALUES("10006","2021-11-08","Juan","Sanchez","Lopez","","2021-12-10","2021-12-12","4000","4000","2001");
INSERT INTO contrato VALUES("10007","2021-11-08","Juan","Sanchez","Lopez","","2021-12-10","2021-12-11","4000","4000","2003");
INSERT INTO contrato VALUES("10008","2021-11-08","Luis","Diaz","Sanchez","","2021-12-29","2021-12-31","4000","4000","2003");



DROP TABLE IF EXISTS fotografia;

CREATE TABLE `fotografia` (
  `idFotografia` int(11) NOT NULL AUTO_INCREMENT,
  `img_Tipo` varchar(20) NOT NULL,
  `img_Url` varchar(45) NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idFotografia`),
  KEY `fkCas_Foto` (`idCasa`),
  CONSTRAINT `fkCas_Foto` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7014 DEFAULT CHARSET=utf8mb4;

INSERT INTO fotografia VALUES("7000","header","59cc5892806910fa6f2376ebb23d904c.png","2000");
INSERT INTO fotografia VALUES("7001","right2","4f10b7f080316ecaaddc78542eda1cd5.png","2000");
INSERT INTO fotografia VALUES("7002","right1","089bb4a2ec64e16832ddd3d4c319f61a.png","2000");
INSERT INTO fotografia VALUES("7003","galeria","img1.jpg","2000");
INSERT INTO fotografia VALUES("7004","galeria","img2.jpg","2000");
INSERT INTO fotografia VALUES("7005","galeria","img3.jpg","2000");
INSERT INTO fotografia VALUES("7006","galeria","img4.jpg","2000");
INSERT INTO fotografia VALUES("7007","galeria","img5.jpg","2000");
INSERT INTO fotografia VALUES("7008","galeria","img6.jpg","2000");
INSERT INTO fotografia VALUES("7009","galeria","img7.jpg","2000");
INSERT INTO fotografia VALUES("7010","galeria","img5.jpg","2001");
INSERT INTO fotografia VALUES("7011","galeria","img6.jpg","2001");
INSERT INTO fotografia VALUES("7012","galeria","img7.jpg","2001");
INSERT INTO fotografia VALUES("7013","galeria","img8.jpg","2001");



DROP TABLE IF EXISTS promocion;

CREATE TABLE `promocion` (
  `idPromocion` int(11) NOT NULL AUTO_INCREMENT,
  `promo_Codigo` varchar(45) NOT NULL,
  `promo_Cantidad` int(11) NOT NULL,
  `idCasa` int(11) NOT NULL,
  PRIMARY KEY (`idPromocion`),
  KEY `fkCas_Pro` (`idCasa`),
  CONSTRAINT `fkCas_Pro` FOREIGN KEY (`idCasa`) REFERENCES `casa` (`idCasa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=200001 DEFAULT CHARSET=utf8mb4;

INSERT INTO promocion VALUES("200000","CasaVerdePromo","1002","2000");



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
) ENGINE=InnoDB AUTO_INCREMENT=3002 DEFAULT CHARSET=utf8mb4;

INSERT INTO servicio VALUES("3000","?","Television","2","2000");
INSERT INTO servicio VALUES("3001","?","Recamras","4","2000");



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
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8mb4;

INSERT INTO usuario VALUES("1000","Admin","Admin","Admin","0000-00-00","","","1111111111","$2y$10$18PzgkzAoN6BbyPMAbBkweus.L1D855HMCOgXREFlw/d3dOYZWT9m","1","admin");
INSERT INTO usuario VALUES("1001","Victor","Diaz","Medina","1999-10-22","166701b30b13678938f607ad1874e18d.png","","7774432521","$2y$10$18PzgkzAoN6BbyPMAbBkweus.L1D855HMCOgXREFlw/d3dOYZWT9m","1","user");
INSERT INTO usuario VALUES("1002","Felipe","Ramirez","Lopez","1999-10-21","","","7771700133","$2y$10$18PzgkzAoN6BbyPMAbBkweus.L1D855HMCOgXREFlw/d3dOYZWT9m","1","user");



SET FOREIGN_KEY_CHECKS=1;
DROP DATABASE Casas;
CREATE DATABASE Casas;
USE Casas;

-- -----------------------------------------------------
-- Table USUARIO
-- -----------------------------------------------------
CREATE TABLE Usuario (
  idUsuario INT PRIMARY KEY AUTO_INCREMENT,
  user_Nombre VARCHAR(30) NOT NULL,
  user_APaterno VARCHAR(30) NOT NULL,
  user_AMaterno VARCHAR(30) NOT NULL,
  user_FechNac DATE NOT NULL,
  user_Perfil VARCHAR(300) NOT NULL,
  user_INE VARCHAR(300) NOT NULL,
  user_WhatsApp VARCHAR(10) NOT NULL,
  user_Password VARCHAR(255) NOT NULL,
  user_Status INT NOT NULL,
  user_Role ENUM('user','admin') NOT NULL) ENGINE = InnoDB;
  
ALTER TABLE Usuario AUTO_INCREMENT=1000;


-- -----------------------------------------------------
-- Table CASA
-- -----------------------------------------------------
CREATE TABLE Casa (
  idCasa INT PRIMARY KEY AUTO_INCREMENT,
  casa_Nombre VARCHAR(30) NOT NULL,
  casa_Descripcion VARCHAR(255) NOT NULL,
  casa_Lati DECIMAL(10,7) NOT NULL,
  casa_Long DECIMAL(10,7) NOT NULL,
  casa_Region VARCHAR(30) NOT NULL,  
  casa_Logo VARCHAR(45) NOT NULL,
  casa_Renta INT NOT NULL,
  casa_Deposito INT NOT NULL,
  idUsuario INT NOT NULL,
  CONSTRAINT fkUser_Cas FOREIGN KEY (idUsuario)
    REFERENCES Usuario(idUsuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Casa AUTO_INCREMENT=2000;
  
  
  
-- -----------------------------------------------------
-- Table SERVICIO
-- -----------------------------------------------------
CREATE TABLE Servicio (
  idServicio INT PRIMARY KEY AUTO_INCREMENT,
  serv_Icon VARCHAR(20) NOT NULL,
  serv_Descripcion VARCHAR(45) NOT NULL,
  serv_Cantidad INT NOT NULL,
  idCasa INT NOT NULL,
  CONSTRAINT fkCas_Serv FOREIGN KEY (idCasa)
    REFERENCES Casa(idCasa)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Servicio AUTO_INCREMENT=3000;
  
-- -----------------------------------------------------
-- Table CLAUSULA
-- -----------------------------------------------------
CREATE TABLE Clausula (
  idClausula INT PRIMARY KEY AUTO_INCREMENT,
  clau_Icon VARCHAR(20) NOT NULL,
  clau_Descripcion VARCHAR(45) NOT NULL,
  clau_Tipo ENUM('Regla','Seguridad y Salud') NOT NULL,
  idCasa INT NOT NULL,
  CONSTRAINT fkCas_Clau FOREIGN KEY (idCasa)
    REFERENCES Casa(idCasa)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Clausula AUTO_INCREMENT=6000;
  
-- -----------------------------------------------------
-- Table FOTOGRAFIA
-- -----------------------------------------------------
CREATE TABLE Fotografia (
  idFotografia INT PRIMARY KEY AUTO_INCREMENT,
  img_Tipo VARCHAR(20) NOT NULL,
  img_Url VARCHAR(45) NOT NULL,
  idCasa INT NOT NULL,
  CONSTRAINT fkCas_Foto FOREIGN KEY (idCasa)
    REFERENCES Casa(idCasa)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Fotografia AUTO_INCREMENT=7000;
  
-- -----------------------------------------------------
-- Table COMENTARIO
-- -----------------------------------------------------
CREATE TABLE Comentario (
  idComentario INT PRIMARY KEY AUTO_INCREMENT,
  comment_Fecha VARCHAR(20) NOT NULL,
  comment_Nomb VARCHAR(20) NOT NULL,
  comment_Email VARCHAR(60) NOT NULL,
  comment_Text VARCHAR(255) NOT NULL,
  idCasa INT NOT NULL,
  CONSTRAINT fkCas_Com FOREIGN KEY (idCasa)
    REFERENCES Casa(idCasa)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Comentario AUTO_INCREMENT=100000;


-- -----------------------------------------------------
-- Table PROMOCION
-- -----------------------------------------------------
CREATE TABLE Promocion (
  idPromocion INT PRIMARY KEY AUTO_INCREMENT,
  promo_Codigo VARCHAR(45) NOT NULL,
  promo_Cantidad INT NOT NULL,
  idCasa INT NOT NULL,
  CONSTRAINT fkCas_Pro FOREIGN KEY (idCasa)
    REFERENCES Casa(idCasa)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Promocion AUTO_INCREMENT=200000;
  
  
-- -----------------------------------------------------
-- Table CONTRATO
-- -----------------------------------------------------
CREATE TABLE Contrato (
  idContrato INT PRIMARY KEY AUTO_INCREMENT,
  cont_FechAct DATE NOT NULL,
  cont_NombreArren VARCHAR(30) NOT NULL,
  cont_APaterArren VARCHAR(30) NOT NULL,
  cont_AMaterArren VARCHAR(30) NOT NULL,
  cont_INE VARCHAR(30) NOT NULL,
  cont_FechEntrada DATE NOT NULL,
  cont_FechSalida DATE NOT NULL,
  cont_Anticipo DOUBLE NOT NULL,
  cont_MontoTotal DOUBLE NOT NULL,
  idCasa INT NOT NULL,
  CONSTRAINT fkContr_Cas FOREIGN KEY (idCasa)
    REFERENCES Casa(idCasa)
    ON DELETE CASCADE
    ON UPDATE CASCADE) ENGINE = InnoDB;
  
  ALTER TABLE Contrato AUTO_INCREMENT=10000;
  

  
  
  



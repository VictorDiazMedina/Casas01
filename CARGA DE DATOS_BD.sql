

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `user_Nombre`, `user_APaterno`, `user_AMaterno`, `user_FechNac`, `user_Perfil`, `user_INE`, `user_WhatsApp`, `user_Password`, `user_Status`, `user_Role`) VALUES
(1001, 'VICTOR', 'DIAZ', 'MEDINA', '1990-10-21', 'a1e5389f1f60774523a66aa6271a9c25.png', '', '7774432521', '$2y$10$bDMZObOBnmd0NdVPxGJCvuNkmsKl/hIxm5MPaJvFB7ejQIBdvCu1G', 1, 'user'),
(1002, 'FELIPE', 'RAMIREZ', 'LOPEZ', '1991-10-21', '13ea48ae8495d0ee92d1a8d5957c5704.png', '', '7771700133', '$2y$10$8BibxV3isyuDTYim83amsOgIj3GVVPt71OkcC6oqQGRVkN9Nnwd8y', 1, 'user'),
(1003, 'ANTONIO', 'DIAZ', 'MEDINA', '1999-10-21', 'e897e4eff9219b5eab7fcd0f6ba5f6fd.png', '', '7771416098', '$2y$10$Xg4vPJ9sb4/bctlgppEoG.GNg/F/hv.BsOyDt5E3S74jmANscyrKC', 1, 'user'),
(1004, 'BERENICE', 'SANDOVAL', 'FLORES', '1995-03-10', 'f1f51b5b195c64894ccca1d458effc4e.png', '', '7772334891', '$2y$10$ntsX2bS1SVo6W8YLOe4abuIwh/sFB2vtb3nSlRdvM2oLyei4d9Kp2', 1, 'user'),
(1005, 'MARIA', 'SANCHEZ', 'GARCIA', '1993-12-23', '2234db50f6033694e973ed49a62b8aee.png', '', '7774314554', '$2y$10$L8SjQv6gh0ASLyHZT9exk.kkw7bs1tKUEYPOgrsUrn9wPsS1ZgFL2', 1, 'user');


--
-- Volcado de datos para la tabla `casa`
--

INSERT INTO `casa` (`idCasa`, `casa_Nombre`, `casa_Descripcion`, `casa_Lati`, `casa_Long`, `casa_Region`, `casa_Logo`, `casa_Renta`, `casa_Deposito`, `idUsuario`) VALUES
(2000, 'CASA VERDE', 'Casa de campo, ubicada en Morelos, Col. Lomas de Chapultepec, México. ', '19.4340924', '-99.1476963', 'Mexico City', 'Casa.jpg', 1000, 2000, 1001),
(2001, 'CASA LUNA', 'Casa en la Ciudad de México, vístanos cerca de la capital, con lugares espectaculares alrededor. ', '18.8798285', '-99.1283076', 'Morelos', '355e3b0fa822d86b49c0db31c039dca2.png', 1200, 2000, 1002),
(2002, 'FINCA MANGO', 'Finca Mango, ubicada en Morelos, colonia la Joya, cercanías de la carretera federal. Buen lugar tranquilo y comercios a la vuelta. ', '18.8945892', '-99.1265144', 'Morelos', '4616c6b49d26ca8943cf7c1a50bb93f3.png', 1500, 2500, 1003),
(2003, 'CASA ECO', 'Casa en el estado de Puebla, ambiente cálido. Buena vista y ambiente para tu familia. Visítanos. ', '18.5984018', '-98.4566447', 'Puebla', 'd0a2fd9442c20c369f21534e712b2305.png', 2500, 3000, 1004),
(2004, 'CASA MAR', 'Casa en el centro de Puebla, ven y conoce parte de nuestro estado hospedándote en esta bella casa.', '19.0326948', '-98.2052216', 'Puebla', '53dd0fc2ba9c248ee53fca3bd1854b6b.png', 1200, 2000, 1005);




--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `serv_Icon`, `serv_Descripcion`, `serv_Cantidad`, `idCasa`) VALUES
(3000, '📺', 'Televisión', 2, 2000),
(3001, '🛌🏽', 'Recamaras', 4, 2000),
(3002, '🛌', 'Camas matrimoniales', 2, 2000),
(3003, '🚿', 'Agua Caliente', 0, 2000),
(3004, '🎱', 'Mesa de Billar', 1, 2000),
(3005, '🌐', 'Internet Wifi', 0, 2000),
(3006, '🎱', 'Mesa de Billar', 1, 2001),
(3007, '🛏️', 'Camas matrimoniales', 4, 2001),
(3008, '🛏️', 'Queen', 2, 2001),
(3009, '🛏️', 'King Size', 1, 2001),
(3010, '🍽️', 'Cubiertos', 45, 2001),
(3011, '🌐', 'Internet', 0, 2001),
(3012, '🛁', 'Jacuzzi', 1, 2001),
(3013, '🍔', 'Comida a Domicilio', 0, 2003),
(3014, '🎱', 'Mesa de Billar', 1, 2003),
(3015, '🛁', 'Baños Completos', 2, 2003),
(3016, '🛏', 'Camas Matrimoniales', 6, 2003),
(3017, '🅿️', 'Lugares de Estacionamiento', 3, 2002),
(3018, '♿️', 'Adaptaciones Discapacitados', 0, 2002),
(3019, '🛒', 'Supermercados a 5 minutos', 0, 2002),
(3020, '🍱', 'Comida a Domicilio', 0, 2004),
(3021, '🚇', 'Transporte a la puerta', 0, 2004);


--
-- Volcado de datos para la tabla `clausula`
--

INSERT INTO `clausula` (`idClausula`, `clau_Icon`, `clau_Descripcion`, `clau_Tipo`, `idCasa`) VALUES
(6000, '🕚', 'Entrada 11:00', 'Seguridad y Salud', 2000),
(6001, '🚫', 'Mascotas', 'Regla', 2000),
(6002, '🕖', 'Salida - 7 PM', 'Seguridad y Salud', 2000),
(6003, '🟡', '9 personas, extras pagan ', 'Regla', 2000),
(6004, '❗', 'Anticipo después de 24hrs.', 'Regla', 2000),
(6005, '⚕️', 'Kit Médico disponible ', 'Seguridad y Salud', 2000),
(6006, '🚫', 'No mascotas', 'Regla', 2001),
(6007, '🔇', 'Música Moderada', 'Regla', 2001),
(6008, '🚭', 'No Fumar dentro de la Casa', 'Regla', 2001),
(6009, '😷', 'Portar cubrebocas', 'Seguridad y Salud', 2001),
(6010, '⚕️', 'Kit Médico', 'Seguridad y Salud', 2001),
(6011, '💊', 'Kit Médico', 'Seguridad y Salud', 2003),
(6012, '🚭', 'No Fumar', 'Regla', 2003),
(6013, '🚫', 'No dañar mobiliarios ', 'Regla', 2002),
(6014, '🦠', 'Mobiliarios Sanitizados', 'Seguridad y Salud', 2002),
(6015, '🦠', 'Ambiente Sanitizado', 'Seguridad y Salud', 2004),
(6016, '🔇', 'Volumen moderado', 'Regla', 2004);


--
-- Volcado de datos para la tabla `fotografia`
--

INSERT INTO `fotografia` (`idFotografia`, `img_Tipo`, `img_Url`, `idCasa`) VALUES
(7000, 'header', 'beba472a0d0ccc55d12b35d8b1d8a71f.png', 2000),
(7001, 'right2', 'ba7a8a5dac01dae14793a9b34c05be75.png', 2000),
(7002, 'right1', '4a013ba3bae883735e1f9254d7f49021.png', 2000),
(7003, 'galeria', 'imagen1.jpeg', 2000),
(7004, 'galeria', 'imagen2.jpeg', 2000),
(7005, 'galeria', 'imagen3.jpeg', 2000),
(7006, 'galeria', 'imagen4.jpeg', 2000),
(7007, 'galeria', 'imagen5.jpeg', 2000),
(7008, 'galeria', 'imagen6.jpeg', 2000),
(7009, 'galeria', 'imagen7.jpeg', 2000),
(7010, 'galeria', 'imagen8.jpeg', 2000),
(7011, 'galeria', 'imagen9.jpeg', 2000),
(7012, 'galeria', 'imagen10.jpeg', 2000),
(7013, 'galeria', 'imagen11.jpeg', 2000),
(7014, 'galeria', 'imagen12.jpeg', 2000),
(7015, 'galeria', 'imagen1.jpeg', 2001),
(7016, 'galeria', 'imagen2.jpeg', 2001),
(7017, 'galeria', 'imagen3.jpeg', 2001),
(7018, 'galeria', 'imagen4.jpeg', 2001),
(7019, 'galeria', 'imagen5.jpeg', 2001),
(7020, 'galeria', 'imagen6.jpeg', 2001),
(7021, 'galeria', 'imagen7.jpeg', 2001),
(7022, 'galeria', 'imagen8.jpeg', 2001),
(7023, 'galeria', 'imagen9.jpeg', 2001),
(7024, 'galeria', 'imagen10.jpeg', 2001),
(7025, 'galeria', 'imagen11.jpeg', 2001),
(7026, 'galeria', 'imagen12.jpeg', 2001),
(7027, 'galeria', 'imagen13.jpeg', 2001),
(7028, 'galeria', 'imagen14.jpeg', 2001),
(7029, 'galeria', 'imagen15.jpeg', 2001),
(7030, 'galeria', 'imagen16.jpeg', 2001),
(7031, 'galeria', 'imagen17.jpeg', 2001),
(7032, 'galeria', 'imagen18.jpeg', 2001),
(7033, 'galeria', 'imagen19.jpeg', 2001),
(7034, 'galeria', 'imagen20.jpeg', 2001),
(7035, 'galeria', 'imagen21.jpeg', 2001),
(7036, 'galeria', 'imagen22.jpeg', 2001),
(7037, 'galeria', 'imagen23.jpeg', 2001),
(7038, 'galeria', 'imagen1.jpg', 2002),
(7039, 'galeria', 'imagen2.jpg', 2002),
(7040, 'galeria', 'imagen3.jpg', 2002),
(7041, 'galeria', 'imagen4.jpg', 2002),
(7042, 'galeria', 'imagen5.jpg', 2002),
(7043, 'galeria', 'imagen6.jpg', 2002),
(7044, 'galeria', 'imagen7.jpg', 2002),
(7045, 'galeria', 'imagen8.jpg', 2002),
(7046, 'galeria', 'imagen9.jpg', 2002),
(7047, 'galeria', 'imagen10.jpg', 2002),
(7048, 'galeria', 'imagen11.jpg', 2002),
(7049, 'galeria', 'imagen12.jpg', 2002),
(7050, 'galeria', 'imagen13.jpg', 2002),
(7051, 'galeria', 'imagen14.jpg', 2002),
(7052, 'galeria', 'imagen15.jpg', 2002),
(7053, 'galeria', 'imagen1.jpeg', 2003),
(7054, 'galeria', 'imagen2.jpeg', 2003),
(7055, 'galeria', 'imagen3.jpeg', 2003),
(7056, 'galeria', 'imagen4.jpeg', 2003),
(7057, 'galeria', 'imagen5.jpeg', 2003),
(7058, 'galeria', 'imagen6.jpeg', 2003),
(7059, 'galeria', 'imagen7.jpeg', 2003),
(7060, 'galeria', 'imagen8.jpeg', 2003),
(7061, 'galeria', 'imagen9.jpeg', 2003),
(7062, 'galeria', 'imagen10.jpeg', 2003),
(7063, 'galeria', 'imagen11.jpeg', 2003),
(7064, 'galeria', 'imagen12.jpeg', 2003),
(7065, 'galeria', 'imagen13.jpeg', 2003),
(7066, 'galeria', 'imagen14.jpeg', 2003),
(7067, 'galeria', 'imagen15.jpeg', 2003),
(7068, 'galeria', 'imagen16.jpeg', 2003),
(7069, 'galeria', 'imagen17.jpeg', 2003),
(7070, 'galeria', 'imagen18.jpeg', 2003),
(7071, 'galeria', 'imagen19.jpeg', 2003),
(7072, 'galeria', 'imagen20.jpeg', 2003),
(7073, 'galeria', 'imagen21.jpeg', 2003),
(7074, 'galeria', 'imagen22.jpeg', 2003),
(7075, 'galeria', 'imagen23.jpeg', 2003),
(7076, 'galeria', 'imagen24.jpeg', 2003),
(7077, 'galeria', 'imagen25.jpeg', 2003),
(7078, 'galeria', 'imagen26.jpeg', 2003),
(7079, 'galeria', 'imagen1.jpeg', 2004),
(7080, 'galeria', 'imagen2.jpeg', 2004),
(7081, 'galeria', 'imagen3.jpeg', 2004),
(7082, 'galeria', 'imagen4.jpeg', 2004),
(7083, 'galeria', 'imagen5.jpeg', 2004),
(7084, 'galeria', 'imagen6.jpeg', 2004),
(7085, 'galeria', 'imagen7.jpeg', 2004),
(7086, 'galeria', 'imagen8.jpeg', 2004),
(7087, 'galeria', 'imagen9.jpeg', 2004),
(7088, 'galeria', 'imagen10.jpeg', 2004),
(7089, 'galeria', 'imagen11.jpeg', 2004),
(7090, 'galeria', 'imagen12.jpeg', 2004),
(7091, 'galeria', 'imagen13.jpeg', 2004),
(7092, 'galeria', 'imagen14.jpeg', 2004),
(7093, 'galeria', 'imagen15.jpeg', 2004),
(7094, 'galeria', 'imagen13.jpeg', 2000),
(7095, 'galeria', 'imagen14.jpeg', 2000),
(7096, 'galeria', 'imagen15.jpeg', 2000),
(7097, 'header', 'c2e4ae86b0a5b0f1d7f51c45bff74d9a.png', 2001),
(7098, 'right1', 'c435791083887953e09152cf57d398d3.png', 2001),
(7099, 'right2', 'eed10b251b28c7109f2a532ffeed75c7.png', 2001),
(7100, 'header', 'edd9898e01f90edaa7bb80d247e88fa7.png', 2003),
(7101, 'right1', 'acc461212cb318b220073874578563df.png', 2003),
(7102, 'right2', '64142553e462a47d821ad5f0b559f0f8.png', 2003),
(7103, 'right1', 'd68eaa43e43654644be1612661759342.png', 2002),
(7104, 'right2', 'add34284c5db2c940793f5ab826768d1.png', 2002),
(7105, 'header', 'dcf5402c09852f31eafc62b622203a60.png', 2002),
(7106, 'header', '6d3fd016248f2dc720ddaf4da89633c6.png', 2004),
(7107, 'right1', '66284ebfe30c2eb27ad00d12947c070b.png', 2004),
(7108, 'right2', '0bc3b993bed3dc6a54efcb910470a444.png', 2004);

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `comment_Fecha`, `comment_Nomb`, `comment_Email`, `comment_Text`, `idCasa`) VALUES
(100000, 'noviembre del 2021', 'Victor', 'diazpixtoriin@gmail.com', 'Me encanto la estancia, súper práctica, limpia, buen precio, buena zona, no hace falta nada. Muy amables Ivón y Estefanía en sus atenciones y pendientes a las dudas.', 2000),
(100001, 'noviembre del 2021', 'Luis', 'dmvo180028@upemor.edu.mx', 'En general es aceptable. Les recomiendo llevar cerillos para encender la estufa y estar al pendiente de los quemadores ya que se apagan solos y puede ocurrir un accidente.', 2000),
(100002, 'noviembre del 2021', 'Zara', 'vdm_2120_@hotmail.com', 'Excelente lugar en una excelente ubicación, la atención por parte de Ivón fue excelente. Espero volver pronto :)', 2000),
(100003, 'noviembre del 2021', 'German', 'iram.gs.1989@gmail.com', 'Excelente lugar, buenísima ubicación, limpio, ordenado, el anfitrión con mucha comunicación y disponibilidad, super recomendable.', 2000),
(100004, 'noviembre del 2021', 'Jesus', 'comprasmercado2016@outlook.com', 'De nuevo todo súper bien!', 2000);


--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`idPromocion`, `promo_Codigo`, `promo_Cantidad`, `idCasa`) VALUES
(200000, 'CasaVerdePromo', 1002, 2000);



--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`idContrato`, `cont_FechAct`, `cont_NombreArren`, `cont_APaterArren`, `cont_AMaterArren`, `cont_INE`, `cont_FechEntrada`, `cont_FechSalida`, `cont_Anticipo`, `cont_MontoTotal`, `idCasa`) VALUES
(10000, '2021-11-08', 'Juan', 'Sanchez', 'Lopez', '', '2021-12-26', '2021-12-28', 4000, 4000, 2000),
(10001, '2021-11-08', 'Benito', 'Romero', 'Garcia', '', '2021-12-19', '2021-12-22', 4000, 4000, 2000),
(10002, '2021-11-08', 'Juan', 'Sanchez', 'Lopez', '', '2021-12-10', '2021-12-12', 4000, 4000, 2000),
(10003, '2021-11-08', 'Luis', 'Diaz', 'Sanchez', '', '2021-12-29', '2021-12-31', 4000, 4000, 2000),
(10004, '2021-11-08', 'Juan', 'Sanchez', 'Lopez', '', '2021-12-26', '2021-12-28', 4000, 4000, 2001),
(10005, '2021-11-08', 'Juan', 'Sanchez', 'Lopez', '', '2021-12-10', '2021-12-12', 4000, 4000, 2003);

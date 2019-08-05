-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2019 at 08:21 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pagoconfiarp`
--

-- --------------------------------------------------------

--
-- Table structure for table `detalle_solicitud`
--

CREATE TABLE `detalle_solicitud` (
  `id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `tipo_detalle` int(11) DEFAULT NULL COMMENT '1 Estudiante, 2 Profesional, 3 Confiarp',
  `punitario` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detalle_solicitud`
--


-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paises`
--

INSERT INTO `paises` (`id`, `name`) VALUES
(1, 'Afganistán'),
(2, 'Albania'),
(3, 'Alemania'),
(4, 'Algeria'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguila'),
(8, 'Antártida'),
(9, 'Antigua y Barbuda'),
(10, 'Antillas Neerlandesas'),
(11, 'Arabia Saudita'),
(12, 'Argentina'),
(13, 'Armenia'),
(14, 'Aruba'),
(15, 'Australia'),
(16, 'Austria'),
(17, 'Azerbayán'),
(18, 'Bélgica'),
(19, 'Bahamas'),
(20, 'Bahrein'),
(21, 'Bangladesh'),
(22, 'Barbados'),
(23, 'Belice'),
(24, 'Benín'),
(25, 'Bhután'),
(26, 'Bielorrusia'),
(27, 'Birmania'),
(28, 'Bolivia'),
(29, 'Bosnia y Herzegovina'),
(30, 'Botsuana'),
(31, 'Brasil'),
(32, 'Brunéi'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cabo Verde'),
(37, 'Camboya'),
(38, 'Camerún'),
(39, 'Canadá'),
(40, 'Chad'),
(41, 'Chile'),
(42, 'China'),
(43, 'Chipre'),
(44, 'Ciudad del Vaticano'),
(45, 'Colombia'),
(46, 'Comoras'),
(47, 'Congo'),
(48, 'Congo'),
(49, 'Corea del Norte'),
(50, 'Corea del Sur'),
(51, 'Costa de Marfil'),
(52, 'Costa Rica'),
(53, 'Croacia'),
(54, 'Cuba'),
(55, 'Dinamarca'),
(56, 'Dominica'),
(57, 'Ecuador'),
(58, 'Egipto'),
(59, 'El Salvador'),
(60, 'Emiratos Árabes Unidos'),
(61, 'Eritrea'),
(62, 'Eslovaquia'),
(63, 'Eslovenia'),
(64, 'España'),
(65, 'Estados Unidos de América'),
(66, 'Estonia'),
(67, 'Etiopía'),
(68, 'Filipinas'),
(69, 'Finlandia'),
(70, 'Fiyi'),
(71, 'Francia'),
(72, 'Gabón'),
(73, 'Gambia'),
(74, 'Georgia'),
(75, 'Ghana'),
(76, 'Gibraltar'),
(77, 'Granada'),
(78, 'Grecia'),
(79, 'Groenlandia'),
(80, 'Guadalupe'),
(81, 'Guam'),
(82, 'Guatemala'),
(83, 'Guayana Francesa'),
(84, 'Guernsey'),
(85, 'Guinea'),
(86, 'Guinea Ecuatorial'),
(87, 'Guinea-Bissau'),
(88, 'Guyana'),
(89, 'Haití'),
(90, 'Honduras'),
(91, 'Hong kong'),
(92, 'Hungría'),
(93, 'India'),
(94, 'Indonesia'),
(95, 'Irán'),
(96, 'Irak'),
(97, 'Irlanda'),
(98, 'Isla Bouvet'),
(99, 'Isla de Man'),
(100, 'Isla de Navidad'),
(101, 'Isla Norfolk'),
(102, 'Islandia'),
(103, 'Islas Bermudas'),
(104, 'Islas Caimán'),
(105, 'Islas Cocos (Keeling)'),
(106, 'Islas Cook'),
(107, 'Islas de Åland'),
(108, 'Islas Feroe'),
(109, 'Islas Georgias del Sur y Sandwich del Sur'),
(110, 'Islas Heard y McDonald'),
(111, 'Islas Maldivas'),
(112, 'Islas Malvinas'),
(113, 'Islas Marianas del Norte'),
(114, 'Islas Marshall'),
(115, 'Islas Pitcairn'),
(116, 'Islas Salomón'),
(117, 'Islas Turcas y Caicos'),
(118, 'Islas Ultramarinas Menores de Estados Unidos'),
(119, 'Islas Vírgenes Británicas'),
(120, 'Islas Vírgenes de los Estados Unidos'),
(121, 'Israel'),
(122, 'Italia'),
(123, 'Jamaica'),
(124, 'Japón'),
(125, 'Jersey'),
(126, 'Jordania'),
(127, 'Kazajistán'),
(128, 'Kenia'),
(129, 'Kirgizstán'),
(130, 'Kiribati'),
(131, 'Kuwait'),
(132, 'Líbano'),
(133, 'Laos'),
(134, 'Lesoto'),
(135, 'Letonia'),
(136, 'Liberia'),
(137, 'Libia'),
(138, 'Liechtenstein'),
(139, 'Lituania'),
(140, 'Luxemburgo'),
(141, 'México'),
(142, 'Mónaco'),
(143, 'Macao'),
(144, 'Macedônia'),
(145, 'Madagascar'),
(146, 'Malasia'),
(147, 'Malawi'),
(148, 'Mali'),
(149, 'Malta'),
(150, 'Marruecos'),
(151, 'Martinica'),
(152, 'Mauricio'),
(153, 'Mauritania'),
(154, 'Mayotte'),
(155, 'Micronesia'),
(156, 'Moldavia'),
(157, 'Mongolia'),
(158, 'Montenegro'),
(159, 'Montserrat'),
(160, 'Mozambique'),
(161, 'Namibia'),
(162, 'Nauru'),
(163, 'Nepal'),
(164, 'Nicaragua'),
(165, 'Niger'),
(166, 'Nigeria'),
(167, 'Niue'),
(168, 'Noruega'),
(169, 'Nueva Caledonia'),
(170, 'Nueva Zelanda'),
(171, 'Omán'),
(172, 'Países Bajos'),
(173, 'Pakistán'),
(174, 'Palau'),
(175, 'Palestina'),
(176, 'Panamá'),
(177, 'Papúa Nueva Guinea'),
(178, 'Paraguay'),
(179, 'Perú'),
(180, 'Polinesia Francesa'),
(181, 'Polonia'),
(182, 'Portugal'),
(183, 'Puerto Rico'),
(184, 'Qatar'),
(185, 'Reino Unido'),
(186, 'República Centroafricana'),
(187, 'República Checa'),
(188, 'República Dominicana'),
(189, 'Reunión'),
(190, 'Ruanda'),
(191, 'Rumanía'),
(192, 'Rusia'),
(193, 'Sahara Occidental'),
(194, 'Samoa'),
(195, 'Samoa Americana'),
(196, 'San Bartolomé'),
(197, 'San Cristóbal y Nieves'),
(198, 'San Marino'),
(199, 'San Martín (Francia)'),
(200, 'San Pedro y Miquelón'),
(201, 'San Vicente y las Granadinas'),
(202, 'Santa Elena'),
(203, 'Santa Lucía'),
(204, 'Santo Tomé y Príncipe'),
(205, 'Senegal'),
(206, 'Serbia'),
(207, 'Seychelles'),
(208, 'Sierra Leona'),
(209, 'Singapur'),
(210, 'Siria'),
(211, 'Somalia'),
(212, 'Sri lanka'),
(213, 'Sudáfrica'),
(214, 'Sudán'),
(215, 'Suecia'),
(216, 'Suiza'),
(217, 'Surinám'),
(218, 'Svalbard y Jan Mayen'),
(219, 'Swazilandia'),
(220, 'Tadjikistán'),
(221, 'Tailandia'),
(222, 'Taiwán'),
(223, 'Tanzania'),
(224, 'Territorio Británico del Océano Índico'),
(225, 'Territorios Australes y Antárticas Franceses'),
(226, 'Timor Oriental'),
(227, 'Togo'),
(228, 'Tokelau'),
(229, 'Tonga'),
(230, 'Trinidad y Tobago'),
(231, 'Tunez'),
(232, 'Turkmenistán'),
(233, 'Turquía'),
(234, 'Tuvalu'),
(235, 'Ucrania'),
(236, 'Uganda'),
(237, 'Uruguay'),
(238, 'Uzbekistán'),
(239, 'Vanuatu'),
(240, 'Venezuela'),
(241, 'Vietnam'),
(242, 'Wallis y Futuna'),
(243, 'Yemen'),
(244, 'Yibuti'),
(245, 'Zambia'),
(246, 'Zimbabue');

-- --------------------------------------------------------

--
-- Table structure for table `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `profesion` varchar(100) DEFAULT NULL,
  `lugar_trabajo_estudio` varchar(100) DEFAULT NULL,
  `pagadito_info` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1- Creada, 2- Enviada, 3 - Error, 4 - Aprobada',
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_solicitud_solicitudes_FK` (`solicitud_id`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitudes_paises_FK` (`pais_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  ADD CONSTRAINT `detalle_solicitud_solicitudes_FK` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`);

--
-- Constraints for table `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_paises_FK` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

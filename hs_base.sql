-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2024 a las 15:07:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hs_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accidentes`
--

CREATE TABLE `accidentes` (
  `id_accidente` int(11) NOT NULL,
  `nroaccidente_ace` varchar(25) NOT NULL,
  `trabajador_ace` int(11) NOT NULL,
  `centro_ace` int(11) NOT NULL,
  `lugar_ace` varchar(255) NOT NULL,
  `detalleslugar_ace` varchar(255) NOT NULL,
  `tipoaccidente_ace` int(11) NOT NULL,
  `fecha_ace` date NOT NULL,
  `fechabaja_ace` date NOT NULL,
  `hora_ace` time NOT NULL,
  `horatrabajo_ace` int(11) NOT NULL,
  `trabajohabitual_ace` varchar(255) NOT NULL,
  `diadescanso_ace` varchar(255) NOT NULL,
  `semanadescanso_ace` int(11) NOT NULL,
  `isevaluadoriesgo_ace` varchar(255) NOT NULL,
  `evalconriesgo_ace` varchar(255) NOT NULL,
  `isrecaida_ace` varchar(255) NOT NULL,
  `fechaantesrecaida_ace` date NOT NULL,
  `descripcion_ace` text NOT NULL,
  `tipolugar_ace` int(11) NOT NULL,
  `zonalugar_ace` varchar(255) NOT NULL,
  `observaclugar_ace` varchar(255) NOT NULL,
  `procesotrabajo_ace` int(11) NOT NULL,
  `observproceso_ace` varchar(255) NOT NULL,
  `tipoactividad_ace` int(11) NOT NULL,
  `observtipoactiv_ace` varchar(255) NOT NULL,
  `agentematerial_ace` int(11) NOT NULL,
  `observagmaterial_ace` varchar(255) NOT NULL,
  `desviacion_ace` int(11) NOT NULL,
  `observdesviacion_ace` varchar(255) NOT NULL,
  `agmaterdesv_ace` int(11) NOT NULL,
  `observagendesv_ace` varchar(255) NOT NULL,
  `formacontacto_ace` int(11) NOT NULL,
  `observformacont_ace` varchar(255) NOT NULL,
  `matercasusalesi_ace` int(11) NOT NULL,
  `observmatlesi_ace` varchar(255) NOT NULL,
  `numtrafectados_ace` int(11) NOT NULL,
  `declaraciontrab_ace` text NOT NULL,
  `istestigos_ace` varchar(255) NOT NULL,
  `detallestestigo_ace` text NOT NULL,
  `declaraciontestigo_ace` text NOT NULL,
  `tipolesion_ace` int(11) NOT NULL,
  `gradolesion_ace` int(11) NOT NULL,
  `partecuerpo_ace` int(11) NOT NULL,
  `isevacuacion_ace` varchar(255) NOT NULL,
  `lugarevacuacion_ace` varchar(255) NOT NULL,
  `centromedico_ace` varchar(255) NOT NULL,
  `detallescentromed_ace` varchar(255) NOT NULL,
  `recomedincorp_ace` int(11) NOT NULL,
  `recinedtrab_ace` int(11) NOT NULL,
  `istrformado_ace` varchar(255) NOT NULL,
  `istrinformado_ace` varchar(255) NOT NULL,
  `protcolectivadisp_ace` varchar(255) NOT NULL,
  `protcolecnecesa_ace` varchar(255) NOT NULL,
  `observprotcol_ace` varchar(255) NOT NULL,
  `episdispon_ace` varchar(255) NOT NULL,
  `episneces_ace` varchar(255) NOT NULL,
  `observepis_ace` varchar(255) NOT NULL,
  `causaaccidente_ace` text NOT NULL,
  `porquecausa_ace` text NOT NULL,
  `quiencontrolcausa_ace` varchar(255) NOT NULL,
  `conclusionacci_ace` text NOT NULL,
  `medidasprev_ace` text NOT NULL,
  `valoracionmedida_ace` varchar(255) NOT NULL,
  `histaccult12mes_ace` varchar(255) NOT NULL,
  `histpuestoacc_ace` varchar(255) NOT NULL,
  `histtrabajosreal_ace` varchar(255) NOT NULL,
  `histcausaacc_ace` varchar(255) NOT NULL,
  `histmedidaacc_ace` varchar(255) NOT NULL,
  `investigador_ace` varchar(255) NOT NULL,
  `cargoinvesiga_ace` varchar(255) NOT NULL,
  `fechainvestiga_ace` date NOT NULL,
  `fechacumplimen_ace` date NOT NULL,
  `revisadopor_ace` varchar(255) NOT NULL,
  `cargorevisado_ace` varchar(255) NOT NULL,
  `fecharevision_ace` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `accidentes`
--

INSERT INTO `accidentes` (`id_accidente`, `nroaccidente_ace`, `trabajador_ace`, `centro_ace`, `lugar_ace`, `detalleslugar_ace`, `tipoaccidente_ace`, `fecha_ace`, `fechabaja_ace`, `hora_ace`, `horatrabajo_ace`, `trabajohabitual_ace`, `diadescanso_ace`, `semanadescanso_ace`, `isevaluadoriesgo_ace`, `evalconriesgo_ace`, `isrecaida_ace`, `fechaantesrecaida_ace`, `descripcion_ace`, `tipolugar_ace`, `zonalugar_ace`, `observaclugar_ace`, `procesotrabajo_ace`, `observproceso_ace`, `tipoactividad_ace`, `observtipoactiv_ace`, `agentematerial_ace`, `observagmaterial_ace`, `desviacion_ace`, `observdesviacion_ace`, `agmaterdesv_ace`, `observagendesv_ace`, `formacontacto_ace`, `observformacont_ace`, `matercasusalesi_ace`, `observmatlesi_ace`, `numtrafectados_ace`, `declaraciontrab_ace`, `istestigos_ace`, `detallestestigo_ace`, `declaraciontestigo_ace`, `tipolesion_ace`, `gradolesion_ace`, `partecuerpo_ace`, `isevacuacion_ace`, `lugarevacuacion_ace`, `centromedico_ace`, `detallescentromed_ace`, `recomedincorp_ace`, `recinedtrab_ace`, `istrformado_ace`, `istrinformado_ace`, `protcolectivadisp_ace`, `protcolecnecesa_ace`, `observprotcol_ace`, `episdispon_ace`, `episneces_ace`, `observepis_ace`, `causaaccidente_ace`, `porquecausa_ace`, `quiencontrolcausa_ace`, `conclusionacci_ace`, `medidasprev_ace`, `valoracionmedida_ace`, `histaccult12mes_ace`, `histpuestoacc_ace`, `histtrabajosreal_ace`, `histcausaacc_ace`, `histmedidaacc_ace`, `investigador_ace`, `cargoinvesiga_ace`, `fechainvestiga_ace`, `fechacumplimen_ace`, `revisadopor_ace`, `cargorevisado_ace`, `fecharevision_ace`) VALUES
(4, '12/2024', 10, 6, '2', '', 2, '2024-01-03', '0000-00-00', '00:00:00', 0, '-', 'Seleccione', 0, '-', '-', '-', '0000-00-00', '', 5, '', '', 6, '', 8, '', 6, '', 6, '', 6, '', 7, '', 7, '', 0, '', '-', '', '', 16, 2, 13, '-', '', '-', '', 0, 0, '-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '-', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '0000-00-00'),
(5, '002/2024', 7, 7, '1', 'Sala maquinas', 1, '2024-01-03', '2024-01-11', '15:39:00', 4, 'SI', 'Lunes', 0, 'SI', 'SI', 'NO', '0000-00-00', 'Bajando a sala maquinas se cae al resbalar', 2, 'prueba', 'prueba', 6, 'prueba', 6, 'prueba', 14, 'prueba', 11, 'prueba', 12, 'prueba', 7, 'prueba', 9, 'prueba', 1, 'No observa bien el peldaño y cae', 'NO', '', '', 6, 2, 33, 'SI', 'hospital rosario', 'SI', 'can misses', 2024, 2024, 'SI', 'SI', 'N/D', 'N/D', '', 'Calzado', 'calzado', '', 'Falta de atencion', 'falta de atencion', 'trabajador', 'En los trabajos con escalera tiene que haber una concentracion especial al subir y bajar de ellas', 'Ficha informativa', 'entregada 12.12.2024', 'NO', '', '', '', '', 'Emili vives', 'responsable prl', '2024-01-03', '2024-01-02', 'Emili vives', 'Responsable prl', '2024-01-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_actividadfisica`
--

CREATE TABLE `ace_actividadfisica` (
  `id_actividadfisica` int(11) NOT NULL,
  `codactivfis_af` varchar(4) NOT NULL,
  `activfisica_af` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_actividadfisica`
--

INSERT INTO `ace_actividadfisica` (`id_actividadfisica`, `codactivfis_af`, `activfisica_af`) VALUES
(1, '00', 'Ninguna informaci?n '),
(2, '10', 'Operaciones con m?quinas ? sin especificar'),
(3, '11', 'Arrancar la m?quina, parar la m?quina'),
(4, '12', 'Alimentar la m?quina, vaciar la m?quina'),
(5, '13', 'Vigilar la m?quina, hacer funcionar - conducir la m?quina'),
(6, '19', 'Otra Actividad f?sica espec?fica del grupo 1 no mencionada anteriormente'),
(7, '20', 'Trabajos con herramientas manuales ? sin especificar'),
(8, '21', 'Trabajar con herramientas manuales sin motor'),
(9, '22', 'Trabajar con herramientas manuales con motor'),
(10, '29', 'Otra Actividad f?sica espec?fica del grupo 2 no mencionada anteriormente'),
(11, '30', 'Conducir / estar a bordo de un medio de transporte o equipo de carga ? sin especificar'),
(12, '31', 'Conducir un medio de transporte o un equipo de carga - m?vil y con motor'),
(13, '32', 'Conducir un medio de transporte o un equipo de carga - m?vil y sin motor'),
(14, '33', 'Ser pasajero a bordo de un medio de transporte'),
(15, '39', 'Otra Actividad f?sica espec?fica del grupo 3 no mencionada anteriormente'),
(16, '40', 'Manipulaci?n de objetos ? sin especificar'),
(17, '41', 'Coger con la mano, agarrar, sujetar, poner ? en un plano horizontal'),
(18, '42', 'Atar, ligar, arrancar, deshacer, prensar, destornillar, atornillar, girar'),
(19, '43', 'Fijar, colgar, izar, instalar - en un plano vertical'),
(20, '44', 'Lanzar, proyectar lejos'),
(21, '45', 'Abrir, cerrar (una caja, un embalaje, un paquete)'),
(22, '46', 'Verter, introducir l?quidos, llenar, regar, pulverizar, vaciar, achicar'),
(23, '47', 'Abrir (un caj?n), empujar (puerta de un hangar, de despacho, de armario)'),
(24, '49', 'Otra Actividad f?sica espec?fica del grupo 4 no mencionada anteriormente'),
(25, '50', 'Transporte manual ? sin especificar'),
(26, '51', 'Transportar verticalmente - alzar, levantar, bajar, etc. un objeto'),
(27, '52', 'Transportar horizontalmente - tirar de, empujar, hacer rodar, etc. un objeto'),
(28, '53', 'Transportar una carga (portar) - por parte de una persona'),
(29, '59', 'Otra Actividad f?sica espec?fica del grupo 5 no mencionada anteriormente'),
(30, '60', 'Movimiento ? sin especificar'),
(31, '61', 'Andar, correr, subir, bajar, etc.'),
(32, '62', 'Entrar, salir'),
(33, '63', 'Saltar, abalanzarse, etc.'),
(34, '64', 'Arrastrarse, trepar, etc.'),
(35, '65', 'Levantarse, sentarse, etc.'),
(36, '66', 'Nadar, sumergirse'),
(37, '67', 'Hacer movimientos en un mismo sitio'),
(38, '69', 'Otra Actividad f?sica espec?fica del grupo 6 no mencionada anteriormente'),
(39, '70', 'Estar presente'),
(40, '99', 'Otra Actividad f?sica espec?fica no codificada en esta clasificaci?n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_agentematerial`
--

CREATE TABLE `ace_agentematerial` (
  `id_agentematerial` int(11) NOT NULL,
  `codagentemat_am` varchar(15) NOT NULL,
  `agentematerial_am` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_agentematerial`
--

INSERT INTO `ace_agentematerial` (`id_agentematerial`, `codagentemat_am`, `agentematerial_am`) VALUES
(1, '00.00.00.00', 'Ning?n agente material o ninguna informaci?n'),
(2, '00.01.00.00', 'Ning?n agente material'),
(3, '00.02.00.00', 'Ninguna informaci?n'),
(4, '01.00.00.00', 'Edificios, construcciones, superficies - a nivel - (interior o exterior)'),
(5, '01.01.00.00', 'Elementos de edificios, de construcciones- puertas, paredes, ventanas, etc.'),
(6, '01.01.01.00', 'Ventanales, ventanas (incorporadas al edificio)'),
(7, '01.01.02.00', 'Puertas (incorporadas al edificio)'),
(8, '01.01.03.00', 'Tabiques, paredes'),
(9, '01.01.99.00', 'Otros agentes de un edificio'),
(10, '01.02.00.00', 'Superficies o ?reas de circulaci?n al mismo nivel - suelos (interior o exterior)'),
(11, '01.02.01.00', 'Superficies en general'),
(12, '01.02.01.01', 'Piso'),
(13, '01.02.01.02', 'Suelos resbaladizos debido a lluvia, nieve, hielo en el pavimento...'),
(14, '01.02.01.03', 'Otros suelos resbaladizos, incluso debido a l?quidos'),
(15, '01.02.01.04', 'Suelos congestionados (objetos peque?os, objetos grandes...)'),
(16, '01.02.01.05', 'Tabla con clavos'),
(17, '01.02.01.06', 'Otros agentes relacionados con el suelo (agujeros, bordillos de aceras,etc.)'),
(18, '01.02.02.00', 'Terrenos agr?colas (campos, praderas...)'),
(19, '01.02.03.00', 'Terrenos de deporte'),
(20, '01.02.99.00', 'Otras superficies o ?reas de circulaci?n al mismo nivel'),
(21, '01.03.00.00', 'Superficies o ?reas de circulaci?n al mismo nivel - flotantes'),
(22, '01.99.00.00', 'Otras construcciones y superficies al mismo nivel, no citadas anteriormente'),
(23, '02.00.00.00', 'Edificios, construcciones, superficies - en altura - (interior o exterior)'),
(24, '02.01.00.00', 'Partes de un  edificio fijas en altura (tejados, aberturas,...)'),
(25, '02.01.01.00', 'Escaleras Fijas de Edificios'),
(26, '02.01.02.00', 'Tejados, terrazas, luminarias, viguer?as'),
(27, '02.01.03.00', 'Abertura exterior o en el interior de un edificio'),
(28, '02.01.04.00', 'Rampas de carga / descarga'),
(29, '02.01.99.00', 'Otras partes por encima del nivel del suelo de un edificio'),
(30, '02.02.00.00', 'Construcciones, superficies fijas en altura(pasarelas,escaleras,castilletes)'),
(31, '02.02.01.00', 'Escaleras fijas'),
(32, '02.02.02.00', 'Postes, castilletes, pasarelas, entrepisos, m?stiles'),
(33, '02.02.99.00', 'Otras construcciones, superficies fijas por encima del nivel del suelo'),
(34, '02.03.00.00', 'Construcciones,superficies m?viles en altura(andamios,escaleras,barquilla)'),
(35, '02.03.01.00', 'Escaleras de mano. Escabeles. Escalera manual (tijera, extensibles..)'),
(36, '02.03.02.00', 'Soportes improvisados'),
(37, '02.03.03.00', 'Andamio desplazable sobre ruedas'),
(38, '02.03.99.00', 'Otras construcciones, superficies m?viles por encima del nivel del suelo'),
(39, '02.04.00.00', 'Construcciones,superficies temporales en altura(andamios,arneses,guindola)'),
(40, '02.04.01.00', 'Andamios (excepto sobre ruedas)'),
(41, '02.04.02.00', 'Encofrados'),
(42, '02.04.03.00', 'Arneses, guindolas'),
(43, '02.04.99.00', 'Otras superficies temporales por encima del nivel del suelo'),
(44, '02.05.00.00', 'Construcciones,superficies en altura-flotantes-plataformas perforaci?n etc'),
(45, '02.05.01.00', 'Plataforma de perforaci?n'),
(46, '02.05.99.00', 'Otras construcciones, superficies por encima del nivel del suelo flotantes'),
(47, '02.99.00.00', 'Otras construcciones y superficies en altura no citados anteriormente'),
(48, '03.00.00.00', 'Edificios, construcciones, superficies - en profundidad (interior o exterior)'),
(49, '03.01.00.00', 'Excavaciones, zanjas, pozos, fosas, escarpaduras, zanjas de garajes'),
(50, '03.01.01.00', 'Excavaciones, zanjas'),
(51, '03.01.02.00', 'Pozos, fosas'),
(52, '03.01.03.00', 'Escarpa'),
(53, '03.01.04.00', 'Foso de garaje'),
(54, '03.01.99.00', 'Otras excavaciones, zanjas, pozos...'),
(55, '03.02.00.00', 'Subterr?neos, galer?as'),
(56, '03.03.00.00', 'Medios submarinos'),
(57, '03.99.00.00', 'Otros edificios, construcciones, superficies en profundidad no citadas'),
(58, '04.00.00.00', 'Dispositivos de distribuci?n de materia, de alimentaci?n, canalizaciones'),
(59, '04.01.00.00', 'Dispositivos distribuci?n de materia,de alimentaci?n,canalizaciones fijos'),
(60, '04.01.01.00', 'Dispositivos de distribuci?n de materia, canalizaciones fijas para gas'),
(61, '04.01.01.01', 'Canalizaciones, tuber?as flexibles, v?lvulas, juntas, manorreductores (gas)'),
(62, '04.01.02.00', 'Circuito aer?ulico fijo de ventilaci?n, captaci?n'),
(63, '04.01.02.01', 'Sistema de extracci?n de virutas'),
(64, '04.01.02.02', 'Colector de polvo, cicl?n'),
(65, '04.01.02.03', 'Separador de aire, filtro, saco filtrante, filtro de manga'),
(66, '04.01.02.04', 'Dispositivo de captaci?n, campana, campana de gases'),
(67, '04.01.03.00', 'Dispositivos distribuci?n materia, canalizaciones, fijas -l?quidos,pastosos'),
(68, '04.01.03.01', 'Canalizaciones, flexibles, v?lvulas, juntas, grifos, pistolas vertedoras (l?quidos)'),
(69, '04.01.04.00', 'Dispositivos de distribuci?n de materia, canalizaciones ,fijas - s?lidos'),
(70, '04.01.04.01', 'Alimentaci?n por vac?o, succi?n, vaciado de sacos'),
(71, '04.01.04.02', 'Aparato de distribuci?n y de alimentaci?n'),
(72, '04.01.04.03', 'Mesa de acumulaci?n'),
(73, '04.01.04.04', 'Mesa de distribuci?n'),
(74, '04.01.04.05', 'Tolva vibrante'),
(75, '04.01.99.00', 'Otros dispositivos de distribuci?n de materia,alimentaci?n,canalizaciones fijas'),
(76, '04.02.00.00', 'Dispositivos distribuci?n de materia,alimentaci?n,canalizaciones m?viles'),
(77, '04.02.01.00', 'Dispositivos de distribuci?n de materia, canalizaciones,  m?viles para gas'),
(78, '04.02.01.01', 'Tubos, boquillas, pistolas de aire comprimido'),
(79, '04.02.02.00', 'Circuito aer?ulico m?vil de ventilaci?n, captaci?n'),
(80, '04.02.02.01', 'Dispositivo de aspiraci?n Cobra'),
(81, '04.02.03.00', 'Dispositivos distribuci?n de materia, canalizaciones, m?viles -l?quidos, pastoso'),
(82, '04.02.04.00', 'Dispositivos distribuci?n de materia, canalizaciones, m?viles - s?lidos'),
(83, '04.02.99.00', 'Otros dispositivos de distribuci?n de materia, alimentaci?n,canalizaciones m?viles'),
(84, '04.03.00.00', 'Canales de desag?e, drenajes'),
(85, '04.99.00.00', 'Otros dispositivos distribuci?n de materia, alimentaci?n, canalizaciones no citados'),
(86, '05.00.00.00', 'Motores, dispositivos de transmisi?n y de almacenamiento de energ?a'),
(87, '05.01.00.00', 'Motores, generadores de energ?a (t?rmica, el?ctrica, de radiaci?n)'),
(88, '05.01.01.00', 'Motores t?rmicos'),
(89, '05.01.01.01', 'Motores de explosi?n y de combusti?n interna'),
(90, '05.01.02.00', 'M?quinas el?ctricas rotativas, motores el?ctricos'),
(91, '05.01.02.01', 'M?quina el?ctrica rotativa - alternador, dinamo'),
(92, '05.01.02.02', 'Motores el?ctricos'),
(93, '05.01.03.00', 'Transformadores el?ctricos'),
(94, '05.01.04.00', 'Compresores, bombas, ventiladores'),
(95, '05.01.04.01', 'Bombas compresoras'),
(96, '05.01.04.02', 'Grupo frigor?fico'),
(97, '05.01.05.00', 'Generadores de radiaciones'),
(98, '05.01.05.01', 'Generadores de radiaciones X,  esc?neres.'),
(99, '05.01.05.02', 'Aceleradores de part?culas'),
(100, '05.01.05.03', 'Generadores de radiaciones l?ser'),
(101, '05.01.99.00', 'Otros motores generadores de energ?a'),
(102, '05.02.00.00', 'Dispositivos transmisi?n,almacenamiento de energ?a(mec?nica,neum?tica,etc)'),
(103, '05.02.01.00', 'Transmisiones mec?nicas'),
(104, '05.02.01.01', 'Cable de transmisi?n'),
(105, '05.02.01.02', 'Correa de transmisi?n'),
(106, '05.02.01.03', 'Polea de transmisi?n'),
(107, '05.02.01.04', 'Cadena'),
(108, '05.02.01.05', 'Pi??n'),
(109, '05.02.01.06', 'Engranaje reductor'),
(110, '05.02.01.07', '?rbol, manguito, chaveta'),
(111, '05.02.01.08', 'Cilindro de arrastre, cono de arrastre'),
(112, '05.02.01.09', 'Volante'),
(113, '05.02.02.00', 'Transmisiones neum?ticas'),
(114, '05.02.03.00', 'Transmisiones hidr?ulicas'),
(115, '05.02.04.00', 'Transmisiones el?ctricas (circuitos el?ctricos)'),
(116, '05.02.04.01', 'Instalaciones el?ctricas (instalaciones fijas de baja tensi?n)'),
(117, '05.02.04.02', 'L?mparas port?tiles, cables y prolongadores'),
(118, '05.02.04.03', 'Canalizaciones subterr?neas. Materiales de alta frecuencia...'),
(119, '05.02.04.04', 'Bancos de ensayo, instalaciones de alumbrado'),
(120, '05.02.04.05', 'Redes el?ctricas (subestaciones transformadoras, l?neas a?reas)'),
(121, '05.02.04.06', 'Bater?as, acumuladores'),
(122, '05.02.99.00', 'Otras formas de transmisi?n'),
(123, '05.99.00.00', 'Otros dispositivos de transmisi?n y almacenamiento de energ?a no citados antes'),
(124, '06.00.00.00', 'Herramientas manuales - sin motor - sin especificar'),
(125, '06.01.00.00', 'Herramientas manuales sin motor-para serrar'),
(126, '06.01.01.00', 'Serruchos'),
(127, '06.01.01.01', 'Serrucho de carpintero'),
(128, '06.01.01.02', 'Sierra para troncos'),
(129, '06.01.01.03', 'Sierra para metales'),
(130, '06.01.99.00', 'Otras herramientas manuales para serrar'),
(131, '06.02.00.00', 'Herramientas manuales sin motor-para cortar,separar(tijeras,cizallas etc)'),
(132, '06.02.01.00', 'Tijeras de podar de una mano,cizallas,tenazas,alicates de corte,podaderas etc'),
(133, '06.02.02.00', 'Cuchillos, machetes, cutters'),
(134, '06.02.03.00', 'Tranchetes, serpetas, hachas, podones, azuelas...'),
(135, '06.02.99.00', 'Otras herramientas manuales para cortar, separar'),
(136, '06.03.00.00', 'Herramientas manuales sin motor-para tallar, mortajar, cincelar, recortar'),
(137, '06.03.01.00', 'Buriles, husillos, punzones'),
(138, '06.03.02.00', 'Tajaderas, gubias, formones'),
(139, '06.03.99.00', 'Otras herramientas manuales para tallar...'),
(140, '06.04.00.00', 'Herramientas manuales sin motor-para raspar, pulir, lijar'),
(141, '06.04.01.00', 'Limas, escofinas, raspadores'),
(142, '06.04.99.00', 'Otras herramientas para raspar, pulir, lijar'),
(143, '06.05.00.00', 'Herramientas manuales sin motor-para taladrar, tornear, atornillar'),
(144, '06.05.01.00', 'Llaves'),
(145, '06.05.02.00', 'Destornilladores'),
(146, '06.05.03.00', 'Taladradora de mano'),
(147, '06.05.99.00', 'Otras herramientas manuales para taladrar, hacer girar, atornillar'),
(148, '06.06.00.00', 'Herramientas manuales sin motor-para clavar, remachar, grapar'),
(149, '06.06.01.00', 'Martillos, mazas, macetas...'),
(150, '06.06.02.00', 'Grapadora'),
(151, '06.06.99.00', 'Otras herramientas manuales para clavar...'),
(152, '06.07.00.00', 'Herramientas manuales sin motor-para coser, tejer'),
(153, '06.07.01.00', 'Agujas de coser'),
(154, '06.07.02.00', 'Agujas de tejer'),
(155, '06.07.99.00', 'Otras herramientas manuales para coser, tejer'),
(156, '06.08.00.00', 'Herramientas manuales sin motor-para soldar, pegar'),
(157, '06.09.00.00', 'Herramientas manuales sin motor-para extracci?n materiales,trabajo suelo'),
(158, '06.09.01.00', 'Palas, layas'),
(159, '06.09.02.00', 'Picos, azadas.'),
(160, '06.09.03.00', 'Escardillo, binadera'),
(161, '06.09.04.00', 'Bieldo'),
(162, '06.09.05.00', 'Rastrillos'),
(163, '06.09.99.00', 'Otras herramientas manuales para trabajo del suelo'),
(164, '06.10.00.00', 'Herramientas manuales sin motor-para encerar, lubrificar, lavar, limpiar'),
(165, '06.10.01.00', 'Cepillo'),
(166, '06.10.02.00', 'Esponja'),
(167, '06.10.03.00', 'Aceitera'),
(168, '06.10.99.00', 'Otras herramientas manuales para encerar, lubrificar'),
(169, '06.11.00.00', 'Herramientas manuales sin motor-para pintar'),
(170, '06.11.01.00', 'Pincel, brocha para pintar'),
(171, '06.11.02.00', 'Rodillo para pintar'),
(172, '06.11.99.00', 'Otras herramientas manuales para pintar'),
(173, '06.12.00.00', 'Herramientas manuales sin motor-para sostener, agarrar'),
(174, '06.12.01.00', 'Palancas, pinzas de sujeci?n, pies de cabra, barrenas de percusi?n, sacaclavos'),
(175, '06.12.99.00', 'Otras herramientas manuales para sostener'),
(176, '06.13.00.00', 'Herramientas manuales sin motor-para trabajos de cocina (excepto cuchillos)'),
(177, '06.13.01.00', 'Tenedor, cuchara, cazo...'),
(178, '06.13.99.00', 'Otras herramientas manuales para trabajos de cocina'),
(179, '06.14.00.00', 'Herramientas manuales sin motor-para medicina, cirug?a punzantes,cortantes'),
(180, '06.14.01.00', 'Jeringas, agujas...'),
(181, '06.14.02.00', 'Escalpelos, bistur?es'),
(182, '06.14.03.00', 'Material de dentista'),
(183, '06.14.99.00', 'Otras herramientas manuales, punzantes, cortantes, para trabajos de medicina'),
(184, '06.15.00.00', 'Herramientas manuales sin motor-para medicina cirug?a,no cortantes, otras'),
(185, '06.15.01.00', 'Pinzas, tenazas sacamuelas...'),
(186, '06.15.99.00', 'Otras herramientas manuales no cortantes para trabajos de medicina'),
(187, '06.1600.00', 'Herramientas manuales sin motor-para pescar (artes de pesca, anzuelo,etc)'),
(188, '06.1600.01', 'Anzuelo'),
(189, '06.1600.02', 'Malleta'),
(190, '06.1600.03', 'Copo'),
(191, '06.1699.00', 'Otras herramientas manuales, para trabajos de pesca (artes de pesca)'),
(192, '06.99.00.00', 'Otras herramientas manuales sin motor no citadas anteriormente'),
(193, '07.00.00.00', 'Herramientas sostenidas o guiadas con las manos - mec?nicas'),
(194, '07.01.00.00', 'Herramientas mec?nicas manuales-para serrar'),
(195, '07.01.01.00', 'Sierras alternativas'),
(196, '07.01.02.00', 'Sierras circulares'),
(197, '07.01.03.00', 'Sierras de vaiv?n'),
(198, '07.01.04.00', 'Tronzadoras'),
(199, '07.01.04.01', 'Sierras de cadena port?tiles'),
(200, '07.01.99.00', 'Otras sierras mec?nicas'),
(201, '07.02.00.00', 'Herramientas mec?nicas manuales-para cortar,separar(tijeras,cizallas etc)'),
(202, '07.02.01.00', 'Cizallas port?tiles (el?ctricas, t?rmicas...).'),
(203, '07.02.01.01', 'Cizallas port?tiles de cuchillas rectas (el?ctricas, t?rmicas...).'),
(204, '07.02.02.00', 'Separadores port?tiles'),
(205, '07.02.02.01', 'Separadores, hendedoras port?tiles'),
(206, '07.02.03.00', 'Podadera mec?nica'),
(207, '07.02.04.00', 'Herramienta para liberar personas atrapadas'),
(208, '07.02.05.00', 'Cortasetos'),
(209, '07.02.06.00', 'Cuchillos el?ctricos'),
(210, '07.02.99.00', 'Otras herramientas mec?nicas para cortar, separar'),
(211, '07.03.00.00', 'Herramientas mec?nicas manuales-para tallar, mortajar, cincelar etc.'),
(212, '07.03.01.00', 'Buriles (motorizados...)'),
(213, '07.03.01.01', 'Buriles (motorizados...), martillos de agujas, bujardas'),
(214, '07.03.02.00', 'Entalladoras, mortajadoras'),
(215, '07.03.02.01', 'Entalladoras, mortajadoras, barrenas'),
(216, '07.03.03.00', 'Brocas de dentista'),
(217, '07.03.99.00', 'Otras herramientas mec?nicas para tallar...'),
(218, '07.04.00.00', 'Herramientas mec?nicas manuales-para raspar, pulir (trozadoras disco,etc)'),
(219, '07.04.01.00', 'Muelas, amoladoras manuales'),
(220, '07.04.02.00', 'Lijadora, pulidora, pulidora de disco, cepilladora.'),
(221, '07.04.03.00', 'Descortezadora m?vil'),
(222, '07.04.03.01', 'Descortezadora m?vil, madera'),
(223, '07.04.04.00', 'Tronzadora de disco, esmeriladora-seccionadora (manual)'),
(224, '07.04.99.00', 'Otras herramientas mec?nicas para raspar, pulir...'),
(225, '07.05.00.00', 'Herramientas mec?nicas manuales-para taladrar, hacer girar, atornillar'),
(226, '07.05.01.00', 'Taladradora de mano'),
(227, '07.05.02.00', 'Atornilladora, llave, remachadora,  desatornilladora'),
(228, '07.05.03.00', 'Llave de golpe'),
(229, '07.05.99.00', 'Otras herramientas mec?nicas para taladrar, hacer girar, atornillar'),
(230, '07.06.00.00', 'Herramientas mec?nicas manuales-para clavar, remachar, grapar'),
(231, '07.06.01.00', 'Rodillos apisonadores, pisones de fundici?n'),
(232, '07.06.02.00', 'Martillos neum?ticos (sin especificar herramienta)'),
(233, '07.06.03.00', 'Pistola claveteadora'),
(234, '07.06.04.00', 'Grapadora y pistola grapadora (neum?tica...), clavadora por aire comprimido'),
(235, '07.06.05.00', 'Sacarremaches,  martillo remachador, tenazas para remachar'),
(236, '07.06.06.00', 'Pistola para soldar pl?sticos de cartuchos explosivos'),
(237, '07.06.07.00', 'M?quinas para clavar elementos de fijaci?n'),
(238, '07.06.99.00', 'Otras herramientas mec?nicas para clavar, remachar, grapar'),
(239, '07.07.00.00', 'Herramientas mec?nicas manuales-para coser, tejer'),
(240, '07.07.01.00', 'Remalladoras port?tiles'),
(241, '07.07.99.00', 'Otras herramientas mec?nicas para coser, tejer'),
(242, '07.08.00.00', 'Herramientas mec?nicas manuales-para soldar, pegar'),
(243, '07.08.01.00', 'Soldador el?ctrico'),
(244, '07.08.02.00', 'Pistolas para pegamento'),
(245, '07.08.99.00', 'Otras herramientas mec?nicas para soldar, pegar'),
(246, '07.09.00.00', 'Herramientas mec?nicas manuales-para extracci?n materiales,trabajo suelo'),
(247, '07.09.01.00', 'Martillos picadores, martillos perforadores, trituradores de hormig?n'),
(248, '07.09.99.00', 'Otras herramientas mec?nicas para extracci?n, trabajo del suelo'),
(249, '07.10.00.00', 'Herramientas mec?nicas manuales-para encerar, lubrificar, lavar, limpiar'),
(250, '07.10.01.00', 'Aspiradores'),
(251, '07.10.02.00', 'Enceradoras'),
(252, '07.10.03.00', 'Limpiadores a alta presi?n'),
(253, '07.10.99.00', 'Otras herramientas mec?nicas para encerar, lavar, lubrificar'),
(254, '07.11.00.00', 'Herramientas mec?nicas manuales-para pintar'),
(255, '07.11.01.00', 'Pistola manual para pintura'),
(256, '07.11.99.00', 'Otras herramientas mec?nicas para pintar'),
(257, '07.12.00.00', 'Herramientas mec?nicas manuales-para sostener, agarrar'),
(258, '07.12.01.00', 'Tornillos de banco neum?tico'),
(259, '07.12.02.00', 'Dobladoras'),
(260, '07.12.99.00', 'Otras herramientas mec?nicas para sostener, agarrar'),
(261, '07.13.00.00', 'Herramientas mec?nicas manuales-para trabajos de cocina excepto cuchillos'),
(262, '07.14.00.00', 'Herramientas mec?nicas manuales-para calentar(secador,plancha el?ctrica  )'),
(263, '07.14.01.00', 'Secador de pelo manual'),
(264, '07.14.02.00', 'Secador de casco a pie'),
(265, '07.14.03.00', 'Decapador t?rmico'),
(266, '07.14.04.00', 'Plancha el?ctrica'),
(267, '07.14.99.00', 'Otras herramientas mec?nicas para calentar'),
(268, '07.15.00.00', 'Herramientas mec?nicas manuales-para medicina, cirug?a punzantes,cortantes'),
(269, '07.15.01.00', 'Bistur? el?ctrico'),
(270, '07.15.99.00', 'Otras herramientas mec?nicas punzantes, cortantes, para trabajos de medicina...'),
(271, '07.16.00.00', 'Herramientas mec?nicas manuales-para medicina, cirug?a no cortantes, otras'),
(272, '07.17.00.00', 'Pistolas neum?ticas (sin especificar herramienta)'),
(273, '07.99.00.00', 'Otras herramientas mec?nicas sostenidas o guiadas con las manos'),
(274, '08.00.00.00', 'Herramientas manuales - sin especificaci?n en cuanto a motorizaci?n'),
(275, '08.01.00.00', 'Herramientas manuales sin especificar motorizaci?n-para serrar'),
(276, '08.02.00.00', 'Herramientas manuales sin especificar motorizaci?n-para cortar, separar'),
(277, '08.03.00.00', 'Herram. manual sin especificar motorizaci?n-para tallar,cincelar,recortar'),
(278, '08.04.00.00', 'Herram. manual sin especificar motorizaci?n-para raspar,pulir,lijar'),
(279, '08.05.00.00', 'Herram. manual sin especificar motorizaci?n- taladrar,tornear,atornillar'),
(280, '08.06.00.00', 'Herramientas manuales sin especificar motorizaci?n-para clavar,remachar'),
(281, '08.07.00.00', 'Herramientas manuales sin especificar motorizaci?n-para coser,tejer'),
(282, '08.08.00.00', 'Herramientas manuales sin especificar motorizaci?n-para soldar,pegar'),
(283, '08.09.00.00', 'Herramientas manuales sin especificar motorizaci?n-para extracci?n,suelo'),
(284, '08.10.00.00', 'Herram.manual sin especificar motorizaci?n-para encerar,lavar,lubrificar'),
(285, '08.11.00.00', 'Herramientas manuales sin especificar motorizaci?n-para pintar'),
(286, '08.12.00.00', 'Herramientas manuales sin especificar motorizaci?n-para sostener,agarrar'),
(287, '08.13.00.00', 'Herramientas manuales sin especificar motorizaci?n-para cocina,no cuchillos'),
(288, '08.14.00.00', 'Herram. manual sin especificar motorizaci?n-para medicina punzante,cortante'),
(289, '08.15.00.00', 'Herramientas manuales sin especificar motorizaci?n-para medicina no cortante'),
(290, '08.99.00.00', 'Otras herramientas manuales sin especificar en cuanto a motorizaci?n.'),
(291, '09.00.00.00', 'M?quinas y equipos - port?tiles o m?viles'),
(292, '09.01.00.00', 'M?quinas port?tiles/m?viles-de extracci?n y trabajo del suelo-minas,obras'),
(293, '09.01.01.00', 'Material de hinca y de extracci?n'),
(294, '09.01.01.01', 'M?quinas de hinca o de perforaci?n. M?quinas cizalladoras parciales'),
(295, '09.01.02.00', 'Material para movimiento de tierras'),
(296, '09.01.02.01', 'Minicargadoras, motobasculadores'),
(297, '09.01.02.02', 'Miniexcavadoras, excavadoras ara?a'),
(298, '09.01.02.03', 'Cargadoras, palas cargadoras'),
(299, '09.01.02.04', 'Palas de cable'),
(300, '09.01.02.05', 'Topadoras, cargadoras'),
(301, '09.01.02.06', 'Palas hidr?ulicas'),
(302, '09.01.02.07', 'Niveladoras'),
(303, '09.01.03.00', 'Compactadores vibratorios'),
(304, '09.01.03.01', 'Compactadores de neum?ticos'),
(305, '09.01.03.02', 'Compactadores de terraplenado (apisonadoras o compactadoras de pata de cabra..)'),
(306, '09.01.03.03', 'Compactadores de vibraci?n'),
(307, '09.01.04.00', 'Construcci?n, conservaci?n de la red vial'),
(308, '09.01.04.01', 'Fresadoras, M?quinas para el tratamiento del pavimento, excavadoras de zanjas.'),
(309, '09.01.04.02', 'Asfaltadoras, calderas de fusi?n'),
(310, '09.01.04.03', 'Gravilladora automotriz'),
(311, '09.01.05.00', 'Preparaci?n y colocaci?n de hormig?n'),
(312, '09.01.05.01', 'Terminadora asf?ltica, pavimentadora de encofrados deslizantes (slipforms)'),
(313, '09.01.06.00', 'Material flotante para trabajos fluviales, mar?timos'),
(314, '09.01.06.01', 'M?quinas para trabajos submarinos: buques draga, dragas aspirantes...'),
(315, '09.01.07.00', 'Material de sondeo, perforaci?n'),
(316, '09.01.07.01', 'Sonda'),
(317, '09.01.08.00', 'Material para montaje de canalizaciones'),
(318, '09.01.09.00', 'Material para trabajos subterr?neos'),
(319, '09.01.09.01', 'Tuneladoras'),
(320, '09.01.09.02', 'C?maras de esclusa'),
(321, '09.01.10.00', 'Material para demolici?n'),
(322, '09.01.10.01', 'Triturador de hormig?n sobre pala, martillo-picador (montado sobre pala)'),
(323, '09.01.10.02', 'Lanza t?rmica'),
(324, '09.01.11.00', 'M?quinas de tratamiento de suelos de hormig?n'),
(325, '09.01.11.01', 'Fratasadora'),
(326, '09.01.12.00', 'Material para el tendido y la conservaci?n de  las v?as f?rreas'),
(327, '09.01.99.00', 'Otras M?quinas port?tiles o m?viles para trabajo del suelo'),
(328, '09.02.00.00', 'M?quinas port?tiles/m?viles-de trabajo del suelo, agricultura'),
(329, '09.02.01.00', 'Motocultores'),
(330, '09.02.02.00', 'Segadoras, cortac?spedes, desbrozadoras'),
(331, '09.02.02.01', 'Segadoras'),
(332, '09.02.02.02', 'Cortac?spedes'),
(333, '09.02.02.03', 'Desbrozadoras, para tractor o no, cortabordes de hoja r?gida'),
(334, '09.02.02.04', 'Desbrozadoras (de sierra, de hilo...), podaderas (el?ctricas, neum?ticas...)'),
(335, '09.02.02.05', 'Soplador'),
(336, '09.02.03.00', 'M?quinas agr?colas de autotracci?n, tractores'),
(337, '09.02.03.01', 'Tractor agr?cola'),
(338, '09.02.03.02', 'M?quina agr?cola'),
(339, '09.02.04.00', 'M?quinas agr?colas remolcadas'),
(340, '09.02.04.01', 'Veh?culo agr?cola, carro, remolque'),
(341, '09.02.04.99', 'Otras M?quinas agr?colas remolcadas'),
(342, '09.02.05.00', 'Materiales agr?colas para tratamiento de cultivos,pesticidas-insecticidas-etc'),
(343, '09.02.99.00', 'Otros materiales agr?colas'),
(344, '09.03.00.00', 'M?quinas port?tiles/m?viles-(excepto para trabajar el suelo) - de obras'),
(345, '09.03.01.00', 'M?quina de serrar - de obras'),
(346, '09.03.99.00', 'Otras M?quinas port?tiles/m?viles de obras, construcci?n, excepto para suelo'),
(347, '09.04.00.00', 'M?quinas m?viles de limpieza de suelos'),
(348, '09.04.01.00', 'Barredora'),
(349, '09.04.02.00', 'Lavar los pisos (M?quina de)'),
(350, '09.04.03.00', 'Limpiar el suelo (M?quina de), con acompa?aLimpiar el suelo (M?quina de), con acompa?ante'),
(351, '09.04.04.00', 'Limpiar el suelo (M?quina de), con conductor'),
(352, '09.04.99.00', 'Otras M?quinas m?viles para limpieza del suelo'),
(353, '09.99.00.00', 'Otras M?quinas y equipos port?tiles o m?viles comprendidos en el grupo 09'),
(354, '10.00.00.00', 'M?quinas y equipos - fijos'),
(355, '10.01.00.00', 'M?quinas fijas para extracci?n y trabajo del suelo'),
(356, '10.01.01.00', 'M?quinas fijas para extracci?n y para trabajar el suelo, minas y canteras'),
(357, '10.01.02.00', 'M?quinas fijas para trabajo del suelo, agricultura'),
(358, '10.01.03.00', 'M?quinas fijas para trabajar el suelo, construcci?n y obras p?blicas'),
(359, '10.01.99.00', 'Otras M?quinas fijas de extracci?n'),
(360, '10.02.00.00', 'M?quina preparaci?n materiales,triturar,pulverizar,filtrar,mezclar,separar'),
(361, '10.02.01.00', 'Triturar (M?quinas de) de mordazas, barras, ruedas, muelas'),
(362, '10.02.01.01', 'Molino'),
(363, '10.02.01.02', 'Fragmentar (M?quina para)'),
(364, '10.02.01.03', 'Triturador (barras fijas y m?viles)'),
(365, '10.02.01.04', 'Molino de percusi?n'),
(366, '10.02.01.05', 'Triturador de tubos'),
(367, '10.02.01.06', 'Cuba de muela, fresa angosta'),
(368, '10.02.02.00', 'Triturar (M?quinas de) de bolas, bolas de triturador'),
(369, '10.02.02.01', 'Molino de bolas'),
(370, '10.02.03.00', 'Triturar (M?quinas de) de  cilindros'),
(371, '10.02.03.01', 'Desmenuzador, masticador de cilindros'),
(372, '10.02.03.02', 'Triturador de cilindros'),
(373, '10.02.04.00', 'Triturar (M?quinas de) de  h?lices, de hojas'),
(374, '10.02.04.01', 'Triturador de h?lices'),
(375, '10.02.04.02', 'Picadora'),
(376, '10.02.04.03', 'Desmenuzador de h?lices'),
(377, '10.02.04.04', 'Desfibrador'),
(378, '10.02.04.05', 'Hidropulper, pila de refino, pulper, reductor a pasta y refinador-pl?stico-'),
(379, '10.02.04.06', 'Cortador, mezclador'),
(380, '10.02.04.07', 'Prensa de... (para triturar, desmenuzar)'),
(381, '10.02.04.08', 'Desbastadora'),
(382, '10.02.04.09', 'Granuladora'),
(383, '10.02.05.00', 'Triturar (M?quinas de) de choque'),
(384, '10.02.05.01', 'Rompedora de hierro fundido'),
(385, '10.02.05.02', 'Molino de martillos'),
(386, '10.02.05.03', 'Martinete'),
(387, '10.02.05.04', 'Pis?n triturador'),
(388, '10.02.06.00', 'Filtrar, separar (M?quinas de), tipo oscilante'),
(389, '10.02.06.01', 'Parrilla vaciadora de arena, vaciadora (fundici?n)'),
(390, '10.02.06.02', 'M?quina clasificadora'),
(391, '10.02.06.03', 'Criba oscilante'),
(392, '10.02.06.04', 'Plansichter (cedazos planos)'),
(393, '10.02.06.05', 'Prensa vibrante, vibrador'),
(394, '10.02.06.06', 'Sasor'),
(395, '10.02.06.07', 'Tamiz oscilante'),
(396, '10.02.06.08', 'Aventadora'),
(397, '10.02.07.00', 'Filtrar, separar (M?quinas de), tipo rotativo'),
(398, '10.02.07.01', 'M?quina rotativa para grageas, productos alimentarios'),
(399, '10.02.07.02', 'Cernedero'),
(400, '10.02.07.03', 'Criba rotativa'),
(401, '10.02.07.04', 'Tambor cribador'),
(402, '10.02.07.05', 'Filtro-prensa (de cilindros)'),
(403, '10.02.08.00', 'Filtrar, separar (M?quinas de), tipo centr?fugo'),
(404, '10.02.08.01', 'Centrifugadora'),
(405, '10.02.08.02', 'Secador centr?fugo'),
(406, '10.02.09.00', 'Filtrar, separar (M?quinas de), filtro-prensa'),
(407, '10.02.09.01', 'Filtro-prensa'),
(408, '10.02.10.00', 'Filtrar, separar, decantar (M?quinas de)'),
(409, '10.02.10.01', 'Decantador'),
(410, '10.02.11.00', 'Descortezar (M?quinas de)'),
(411, '10.02.11.01', 'Desplumar (M?quina para)'),
(412, '10.02.11.02', 'Depilar (M?quina de)'),
(413, '10.02.11.03', 'Desgranar (M?quina de) productos alimentarios'),
(414, '10.02.11.04', 'Mondar (M?quina de) productos alimentarios'),
(415, '10.02.11.05', 'Descortezar (M?quina de)'),
(416, '10.02.12.00', 'Abrir (M?quinas para) textiles'),
(417, '10.02.12.01', 'Batidor, batidora de textiles'),
(418, '10.02.12.02', 'Rompebalas de textiles'),
(419, '10.02.12.03', 'Agramadera de textiles'),
(420, '10.02.12.04', 'Carda, cardadora de textiles'),
(421, '10.02.12.05', 'Cargadora (textil)'),
(422, '10.02.12.06', 'Destorcedor de textiles'),
(423, '10.02.12.07', 'Escardadora de textiles'),
(424, '10.02.12.08', 'Deshilachadora de textiles'),
(425, '10.02.12.09', 'Gill-box (Industria textil)'),
(426, '10.02.12.10', 'Bat?n abridor de textiles'),
(427, '10.02.12.11', 'Cardar (M?quina de) textiles'),
(428, '10.02.12.12', 'Abridor de materias (M?quina abridora) textiles'),
(429, '10.02.12.13', 'Mezcladora de textiles'),
(430, '10.02.12.14', 'Agramadora de textiles'),
(431, '10.02.13.00', 'Peinar (M?quina de) textiles'),
(432, '10.02.13.01', 'Estirar (M?quina para) (textil)'),
(433, '10.02.13.02', 'Peinadora textil'),
(434, '10.02.14.00', 'Mezclar, malaxar (M?quinas de) de brazo'),
(435, '10.02.14.01', 'M?quinas para rellenar moldes de tartas'),
(436, '10.02.14.02', 'Mezcladora (amasadora) de productos alimenticios'),
(437, '10.02.14.03', 'Amasadora-mezcladora'),
(438, '10.02.14.04', 'Templador (chocolate)'),
(439, '10.02.14.05', 'Mantequera'),
(440, '10.02.14.06', 'Mezcladora interna Banbury'),
(441, '10.02.14.07', 'Amasadora para caucho'),
(442, '10.02.14.08', 'Malaxador-mezclador (de brazo)'),
(443, '10.02.15.00', 'Mezclar, malaxar (M?quinas de) de cuba m?vil'),
(444, '10.02.15.01', 'Hormigonera (incluso sobre Veh?culo)'),
(445, '10.02.15.02', 'Central de hormigonado'),
(446, '10.02.15.03', 'Contenedor para hormig?n'),
(447, '10.02.16.00', 'Mezclar, malaxar (M?quinas de) de cuba fija , agitador'),
(448, '10.02.16.01', 'Barca de pintura de textiles'),
(449, '10.02.16.02', 'Tina de textiles'),
(450, '10.02.16.03', 'Batidora (confiter?a)'),
(451, '10.02.16.04', 'Cuba de cervecer?a (agitador)'),
(452, '10.02.16.05', 'Estirar (M?quina de) (confiter?a)'),
(453, '10.02.16.06', 'Sorbetera, productos alimentarios'),
(454, '10.02.16.07', 'Batidor-mezclador'),
(455, '10.02.16.08', 'Cristalizadores'),
(456, '10.02.16.09', 'Diluidor'),
(457, '10.02.16,10', 'Homogeneizar (M?quina de), homogenizador'),
(458, '10.02.16.11', 'Mezclador (de cuba fija)'),
(459, '10.02.16.12', 'Turbotriturador (tipo jirafa)'),
(460, '10.02.17.00', 'Mezclar, malaxar (M?quinas de) de cilindros'),
(461, '10.02.17.01', 'Mezclador de cilindros'),
(462, '10.02.99.00', 'Otros tipos de M?quinas para triturar, filtrar, mezclar, amasar'),
(463, '10.03.00.00', 'M?quina transformaci?n materiales-procedimiento qu?mico (reactor, fermentador)'),
(464, '10.03.01.00', 'Proceso qu?mico (M?quinas de), reactores industriales, fermentadores'),
(465, '10.03.01.01', 'Aparatos fijos para tratamiento pesticida'),
(466, '10.03.01.02', 'Reactores, fermentadores, aparatos para destilar'),
(467, '10.03.01.03', 'Ba?os y aparatos para tratamientos qu?micos'),
(468, '10.03.02.00', 'Materiales de proceso qu?mico (laboratorio)'),
(469, '10.03.02.01', 'Aparatos de laboratorio (tipo: an?lisis qu?mico o biol?gico)'),
(470, '10.03.02.02', 'Cristaler?a de laboratorio'),
(471, '10.03.99.00', 'Otros materiales de proceso qu?mico'),
(472, '10.04.00.00', 'M?quina transformaci?n materiales-procedimiento calor(horno,secador,estufa'),
(473, '10.04.01.00', 'Horno de cocci?n (cemento, cer?mica...)'),
(474, '10.04.01.01', 'Aparatos para tratamiento t?rmico'),
(475, '10.04.01.02', 'Hornos de tratamiento de los metales'),
(476, '10.04.01.03', 'Hornos de cemento, cal, tejas y ladrillos, cer?mica, cristaler?a, porcelana'),
(477, '10.04.02.00', 'Estufa, secador'),
(478, '10.04.02.01', 'Estufa'),
(479, '10.04.02.02', 'Secaderos, secador'),
(480, '10.04.02.03', 'Aparatos para mantener la temperatura'),
(481, '10.04.02.04', 'Instalaci?n de recalentamiento, recalentar (M?quina de)'),
(482, '10.04.02.05', 'Calderas, calientaaguas, calderos...'),
(483, '10.04.02.06', 'Aparatos de calefacci?n'),
(484, '10.04.02.07', 'Termorregulador'),
(485, '10.04.02.08', 'Caldera de vapor (no para alimentaci?n), vaporizador'),
(486, '10.04.03.00', 'Esterilizador, pasteurizador, autoclave'),
(487, '10.04.03.01', 'Autoclave'),
(488, '10.04.03.02', 'Pasteurizar  (M?quina de), pasteurizador'),
(489, '10.04.03.03', 'Esterilizar (M?quina de), esterilizador'),
(490, '10.04.04.00', 'Aparato para cocci?n de alimentos'),
(491, '10.04.04.01', 'Aparatos para cocci?n y recalentamiento de alimentos'),
(492, '10.04.99.00', 'Otros tipos de M?quinas de transformaci?n por calor'),
(493, '10.05.00.00', 'M?quina transformaci?n materiales-procedimiento fr?o (producci?n de frio)'),
(494, '10.05.01.00', 'Tratamiento en fr?o y de producci?n de fr?o (M?quina de)'),
(495, '10.05.01.01', 'Aparatos de producci?n de fr?o'),
(496, '10.05.01.02', 'Instalaci?n de refrigeraci?n'),
(497, '10.05.01.03', 'Refrigerar (M?quina de)'),
(498, '10.05.99.00', 'Otras M?quinas de procedimiento en fr?o'),
(499, '10.06.00.00', 'M?quinas para la transformaci?n de los materiales - otros procedimientos'),
(500, '10.07.00.00', 'Formar - por prensado, aplastamiento (M?quina de)'),
(501, '10.07.01.00', 'Prensas para conformar'),
(502, '10.07.01.01', 'Plegar las chapas de metal (M?quina de)'),
(503, '10.07.01.02', 'Prensa de incrustar'),
(504, '10.07.01.03', 'Prensa para formar los pernos, tornillos, clavos, muelles...'),
(505, '10.07.01.04', 'Incrustar (M?quina de), encapsuladora'),
(506, '10.07.01.05', 'Inyector de salmuera, productos alimentarios'),
(507, '10.07.01.06', 'Prensar los jamones , moldear los jamones (M?quina de)'),
(508, '10.07.01.07', 'Prensa para moldear los productos alimenticios'),
(509, '10.07.01.08', 'Prensa de husillo'),
(510, '10.07.01.09', 'Bigornia'),
(511, '10.07.01.10', 'Desmandrinadora'),
(512, '10.07.01.11', 'Mandrinadora'),
(513, '10.07.01.12', 'Pulidora de chorro de gres fija'),
(514, '10.07.01.13', 'Ensayo de bolas (M?quina de)'),
(515, '10.07.01.14', 'M?quina de estampaci?n'),
(516, '10.07.01.15', 'Balanceadora, p?ndulo'),
(517, '10.07.01.16', 'Plegadora, prensa plegadora'),
(518, '10.07.01.17', 'Plegadora manual, prensa plegadora manual'),
(519, '10.07.01.18', 'Prensa de dos montanPrensa de dos montantes (p?rtico)'),
(520, '10.07.01.19', 'Prensa de husillo'),
(521, '10.07.01.20', 'Prensa para calibrar'),
(522, '10.07.01.21', 'Prensa de chaveta (embrague mec?nico)'),
(523, '10.07.01.22', 'Prensa de cuello de cisne'),
(524, '10.07.01.23', 'Prensa con embrague de fricci?n'),
(525, '10.07.01.24', 'Prensa para trabajar en fr?o'),
(526, '10.07.01.25', 'Prensa de pedal'),
(527, '10.07.01.26', 'Prensa de placa'),
(528, '10.07.01.27', 'Prensa de puente giratorio'),
(529, '10.07.01.28', 'Prensa para incrustar o desincrustar'),
(530, '10.07.01.29', 'Prensa el?ctrica (de electroim?n)'),
(531, '10.07.01.30', 'Prensa neum?tica'),
(532, '10.07.01.31', 'Recalcadora'),
(533, '10.07.02.00', 'Prensas forjadoras'),
(534, '10.07.02.01', 'Forjar metal(M?quina de)'),
(535, '10.07.03.00', 'Martillos-pil?n'),
(536, '10.07.03.01', 'Maza (de forjado) para metales'),
(537, '10.07.03.02', 'Martillo-pil?n para metales'),
(538, '10.07.03.03', 'Martinete para metales'),
(539, '10.07.03.04', 'Prensa en caliente de metales'),
(540, '10.07.04.00', 'Prensas enfardadoras'),
(541, '10.07.04.01', 'Prensa de residuos, prensa enfardadora (papel, textiles, residuos metal...)'),
(542, '10.07.05.00', 'Otros tipos de prensas de moldear'),
(543, '10.07.05.01', 'Abrillantadora (fotograf?a)'),
(544, '10.07.05.02', 'Prensa para aplastar, prensa para martillar, encuadernaci?n r?stica,editorial'),
(545, '10.07.05.03', 'Prensa para unir los lomos, prensa para colocar los lomos, papel y cart?n'),
(546, '10.07.05.04', 'Prensa para gofrar, para dorar papel'),
(547, '10.07.05.05', 'Prensa  para encolar o barnizar, prensa engomadora, (papel, textiles, metal)'),
(548, '10.07.05.06', 'Satinadora, calandria sobre  papel'),
(549, '10.07.05.07', 'Planchar textiles(M?quina de), plegadora prensa planchadora (lavander?a)'),
(550, '10.07.05.08', 'Abrillantadora de pieles'),
(551, '10.07.05.09', 'Banco calibrador'),
(552, '10.07.05.10', 'Alisadora'),
(553, '10.07.05.11', 'Extrudir (M?quina de) (de cilindros hidr?ulicos)'),
(554, '10.07.05.12', 'Prensa para redondear'),
(555, '10.07.05.13', 'Prensa compactadora'),
(556, '10.07.05.14', 'Prensa para impresi?n'),
(557, '10.07.05.15', 'Prensa para matrices'),
(558, '10.07.05.16', 'Prensa para granear'),
(559, '10.07.05.17', 'Prensa para satinar'),
(560, '10.07.05.18', 'Prensa para ensayos'),
(561, '10.07.05.19', 'Prensa hidr?ulica, sin especificar'),
(562, '10.07.99.00', 'Otras M?quinas para formar por prensado'),
(563, '10.08.00.00', 'M?quinas para formar - por calandrado, laminaM?quinas para formar - por calandrado, laminado, M?quinas de cilindros'),
(564, '10.08.01.00', 'Laminadora'),
(565, '10.08.01.01', 'Blooming de metal(laminador)'),
(566, '10.08.01.02', 'Laminar en fr?o metal(M?quina de)'),
(567, '10.08.02.00', 'Trefilar (M?quinas de) (de cilindros)'),
(568, '10.08.02.01', 'Estirar metal(M?quina de), banco de estirar'),
(569, '10.08.02.02', 'Trefilar metal(M?quina de)'),
(570, '10.08.03.00', 'Alisar, curvar (M?quinas de) (de cilindros)'),
(571, '10.08.03.01', 'Curvar metal (tubos, perfiles...) (M?quina de)'),
(572, '10.08.03.02', 'Enderezar planchas, tubos e hilos de metal(M?quina de), alisar (M?quina de)'),
(573, '10.08.03.03', 'Cortadora longitudinal de chapa de metal'),
(574, '10.08.03.04', 'Curvar (M?quina de), curvadora de chapa de metal'),
(575, '10.08.03.05', 'Formadora - perfiladora de metal'),
(576, '10.08.03.06', 'Formar los tubos  de metal(M?quina de)'),
(577, '10.08.03.07', 'Perfilar metal(M?quina de)'),
(578, '10.08.03.08', 'Torneadora de metal'),
(579, '10.08.04.00', 'Calandras'),
(580, '10.08.04.01', 'Calandrar hojas de pl?stico (M?quina de)'),
(581, '10.08.04.02', 'Calandra para encolar o satinar el papel'),
(582, '10.08.04.03', 'Granear(M?quina de) (de cilindros)'),
(583, '10.08.04.04', 'Calandra (otra)'),
(584, '10.08.05.00', 'M?quinas de cilindros de fabricaci?n de papel'),
(585, '10.08.05.01', 'Desbobinadora, bobinadora para papel - cart?n'),
(586, '10.08.05.02', 'Impregnar el papel (M?quina de)'),
(587, '10.08.05.03', 'Fabricar las cajas de cart?n (M?quina de)'),
(588, '10.08.05.04', 'Fabricar los sacos de papel (M?quina de)'),
(589, '10.08.05.05', 'Hacer sobres de papel (M?quina de)'),
(590, '10.08.05.06', 'Papel (M?quina para), fabricaci?n de papel (M?quina de) (sin especificar)'),
(591, '10.08.05.07', 'Onduladora de papel'),
(592, '10.08.05.08', 'Cortadora hendedora de papel (slotter)'),
(593, '10.08.05.09', 'M?quina entubadora de papel (impresi?n, encolado y corte longitudinal)'),
(594, '10.08.05.10', 'Bobinadora de papel - hendedora - enrolladora'),
(595, '10.08.05.11', 'Devanadora de papel'),
(596, '10.08.05.12', 'Friccionador de papel (cilindros)'),
(597, '10.08.05.13', 'Lizo de telar de papel (cilindros)'),
(598, '10.08.05.14', 'Separadora de pilas de papel (M?quina)'),
(599, '10.08.05.15', 'Encolar papel (M?quina de), engomadora'),
(600, '10.08.05.16', 'Marcar los pliegues de papel con rueda de moletear (M?quina de)'),
(601, '10.08.05.17', 'Plegar papel (M?quina de)'),
(602, '10.08.05.18', 'Satinar papel (M?quina de)'),
(603, '10.08.05.19', 'Marginadora de papel'),
(604, '10.08.05.20', 'Prensa encoladora de papel (cilindros)'),
(605, '10.08.05.21', 'Mesa de fabricaci?n de papel'),
(606, '10.08.06.00', 'Cilindros, otras aplicaciones (excepto imprenta)'),
(607, '10.08.06.01', 'Pulir las chapas de metal(M?quina de)'),
(608, '10.08.06.02', 'Cepillar los Veh?culos, vagones, lavar los coches, (M?quina de)'),
(609, '10.08.06.03', 'Prensa de lavander?a de cilindros, planchadora de cilindros'),
(610, '10.08.06.04', 'Estirar las pieles (M?quina de)'),
(611, '10.08.06.05', 'Cilindros (M?quinas de) (curtidur?a)'),
(612, '10.08.06.06', 'Moldeadora de panader?a'),
(613, '10.08.06.07', 'Cilindro para moldear las pastas y caramelos'),
(614, '10.08.06.08', 'Moldeadora de pan'),
(615, '10.08.06.09', 'Laminador de pasta alimentaria'),
(616, '10.08.06.10', 'Cilindros (M?quina de) (cereales)'),
(617, '10.08.06.11', 'Mezcladoras de productos alimentarios'),
(618, '10.08.06.12', 'Impregnar los tejidos, la madera (M?quina de)'),
(619, '10.08.06.13', 'Escurrir (M?quina de), escurridora de'),
(620, '10.08.99.00', 'Otras M?quinas de formar por calandrado'),
(621, '10.09.00.00', 'M?quinas M?quinas formar- inyecci?n, extrusi?n, soplado, hilatura, moldeado,fusi?n'),
(622, '10.09.01.00', 'Inyecci?n, extrusi?n (M?quina de)'),
(623, '10.09.01.01', 'Extrusionadora de tejas, ladrillos'),
(624, '10.09.01.02', 'Fabricar bloques de cemento (M?quina de)'),
(625, '10.09.01.03', 'Prensa para tejas, ladrillos'),
(626, '10.09.01.04', 'Extrusora, prensa para inyectar (metalurgia)'),
(627, '10.09.01.05', 'Sinterizar (M?quina de)(metalurgia)'),
(628, '10.09.01.06', 'Inyectar(M?quina de, prensa para inyectar, extrusionar, moldear inyecci?n'),
(629, '10.09.01.07', 'Extrusionadora de pasta alimentaria'),
(630, '10.09.01.08', 'Terraja para mantequilla'),
(631, '10.09.01.09', 'Embutidos (M?quina para), empujador alimenticio (para embutidos)'),
(632, '10.09.01.10', 'Inyecci?n, extrusi?n, soplado (M?quina de)'),
(633, '10.09.01.11', 'Extrusionadora, extrusora'),
(634, '10.09.01.12', 'Expansi?n  (M?quina de), aparato para espuma (l?tex)'),
(635, '10.09.01.13', 'Extrusi?n, hinchado (M?quina de)'),
(636, '10.09.01.14', 'Prensa de extrusi?n'),
(637, '10.09.02.00', 'Prensado, moldeado (M?quinas de)'),
(638, '10.09.02.01', 'Moldear (M?quina de), prensa para moldear'),
(639, '10.09.02.02', 'Recauchutar (M?quina para)'),
(640, '10.09.02.03', 'Fabricaci?n de materiales compuestos de goma, pl?stico (M?quina de)'),
(641, '10.09.02.04', 'Prensa para vulcanizar'),
(642, '10.09.02.05', 'Prensa para productos alimenticios'),
(643, '10.09.02.06', 'M?quina para fundici?n en coquilla'),
(644, '10.09.02.07', 'Fluotorneado (M?quina de) rotomoldeado (M?quina de)'),
(645, '10.09.02.08', 'Termoformado (M?quina de)'),
(646, '10.09.02.09', 'Pastilladora'),
(647, '10.09.02.10', 'Prensa sopladora'),
(648, '10.09.03.00', 'Otros tipos de moldeado'),
(649, '10.09.04.00', 'Altos hornos, convertidores'),
(650, '10.09.05.00', 'Cubilote'),
(651, '10.09.06.00', 'Horno de fusi?n'),
(652, '10.09.07.00', 'Cuchara, crisol'),
(653, '10.09.08.00', 'Moldeado de vidrio (M?quinas de)'),
(654, '10.09.09.00', 'Otros dispositivos de fusi?n'),
(655, '10.09.09.01', 'Fundidora de fotograbado, metalurgia'),
(656, '10.09.09.02', 'Linotipia, metalurgia'),
(657, '10.09.99.00', 'Otras M?quinas de formar por inyecci?n...'),
(658, '10.10.00.00', 'M?quinas de mecanizado- cepillar,fresar,esmerilar,pulir,tornear,taladrar'),
(659, '10.10.01.00', 'Fresadora'),
(660, '10.10.01.01', 'Cepilladora'),
(661, '10.10.01.02', 'Biseladora'),
(662, '10.10.01.03', 'Fresar (M?quina de), fresadora'),
(663, '10.10.01.04', 'Dividir metal (M?quina de)'),
(664, '10.10.01.05', 'Graduar metal (M?quina de)'),
(665, '10.10.01.06', 'Puntear  metal (M?quina de)'),
(666, '10.10.01.07', 'Tallar los engranajes de metal (M?quina de)'),
(667, '10.10.02.00', 'Cepilladora'),
(668, '10.10.02.01', 'Limadora de metal'),
(669, '10.10.02.02', 'Desbastar (M?quina de), molduradora'),
(670, '10.10.02.03', 'Ranurar (M?quina de)'),
(671, '10.10.02.04', 'Regruesar (M?quina de), regruesadora'),
(672, '10.10.02.05', 'M?quina recortadora (cuatro caras)'),
(673, '10.10.03.00', 'Mortajadora'),
(674, '10.10.03.01', 'Entalladora'),
(675, '10.10.03.02', 'Brochadora'),
(676, '10.10.03.03', 'Mortajadora de cadena'),
(677, '10.10.04.00', 'M?quinas de esmerilar, afilar, desbarbar'),
(678, '10.10.04.01', 'Destalonadora (vidrio)'),
(679, '10.10.04.02', 'Sierra para ladrillos, sierra para vidrio'),
(680, '10.10.04.03', 'Grabadora en piedra'),
(681, '10.10.04.04', 'Desbarbar (M?quina de), esmeriladora de desbarbado'),
(682, '10.10.04.05', 'Esmeriladora de afilado, esmeriladora de pedestal, afiladoras'),
(683, '10.10.04.06', 'Esmerilar (M?quina de), esmeriladora'),
(684, '10.10.04.07', 'Muela pendular'),
(685, '10.10.04.08', 'Muela sierra'),
(686, '10.10.04.09', 'Tronzadora fija de disco'),
(687, '10.10.05.00', 'Rectificadora-alisadora'),
(688, '10.10.05.01', 'Centro de rectificaci?n'),
(689, '10.10.05.02', 'Quitar rebabas (M?quina de)'),
(690, '10.10.05.03', 'Rectificar (M?quina de) cil?ndrica o plana,'),
(691, '10.10.05.04', 'Rectificadora plana'),
(692, '10.10.06.00', 'Pulir, lijar (M?quina de)'),
(693, '10.10.06.01', 'Rectificadora plana de goma'),
(694, '10.10.06.02', 'Agamuzar cuero(M?quina de)'),
(695, '10.10.06.03', 'Cepillar (M?quina de),cepilladora'),
(696, '10.10.06.04', 'Pulir (M?quina de), pulidora (fija)'),
(697, '10.10.06.05', 'Cepilladora de pedestal'),
(698, '10.10.06.06', 'Torno para bru?ir'),
(699, '10.10.06.07', 'Torno para acabar'),
(700, '10.10.06.08', 'Torno para pulir'),
(701, '10.10.06.09', 'Lijar (M?quina de), torno para lijar'),
(702, '10.10.06.10', 'Lijar (M?quina de)'),
(703, '10.10.06.11', 'Lijadora (fija)'),
(704, '10.10.06.12', 'Lijadora de banda (fija), tanque de lijar (de banda)'),
(705, '10.10.07.00', 'Pulir en tambor (M?quina de)'),
(706, '10.10.07.01', 'Abatanadora (pulido, enarenado)'),
(707, '10.10.07.02', 'Tambor (pulido, enarenado)'),
(708, '10.10.08.00', 'Cepilladora'),
(709, '10.10.08.01', 'Cepilladora madera'),
(710, '10.10.09.00', 'Torno paralelo'),
(711, '10.10.09.01', 'Torno de bogie'),
(712, '10.10.09.02', 'Torno de muelles'),
(713, '10.10.09.03', 'Torno horizontal'),
(714, '10.10.09.04', 'Torno paralelo (de cilindrar,roscar,de espiralado,para muelles,de repujar)'),
(715, '10.10.09.05', 'Torno vertical'),
(716, '10.10.10.00', 'Torno autom?tico y para tronzar'),
(717, '10.10.10.01', 'Machihembradora de parqu?'),
(718, '10.10.10.02', 'Fresa para calzado'),
(719, '10.10.10.03', 'Roscar (M?quina de), roscadora'),
(720, '10.10.10.04', 'Torno para tronzar'),
(721, '10.10.10.05', 'Torno autom?tico'),
(722, '10.10.10.06', 'Torno de repasar'),
(723, '10.10.10.07', 'Torno rev?lver'),
(724, '10.10.10.08', 'Ensambladora'),
(725, '10.10.11.00', 'Torno de herramienta rotativa'),
(726, '10.10.11.01', 'Herramientas rotativas (M?quina de)'),
(727, '10.10.12.00', 'Tup?, espigadora'),
(728, '10.10.13.00', 'Taladradora, roscadora'),
(729, '10.10.13.01', 'Roscar interiores (M?quina para), roscadora'),
(730, '10.10.13.02', 'Taladradora (de columna, radial, monohusillo y de husillos m?ltiples...)'),
(731, '10.10.14.00', 'Mandrinadora'),
(732, '10.10.14.01', 'Mandrinadora (vertical, horizontal...)'),
(733, '10.10.14.02', 'Esmeriladora (vertical y horizontal)'),
(734, '10.10.15.00', 'Otros dispositivos para cepillar, fresar, alisar, pulir, tornear, taladrar'),
(735, '10.10.15.01', 'Torno de alfarero'),
(736, '10.10.15.02', 'Pulido elePulido electrol?tico metales(M?quina de)'),
(737, '10.10.15.03', 'Torno de recauchutado'),
(738, '10.10.15.04', 'Torno para madera, cuero'),
(739, '10.10.99.00', 'Otras M?quinas para cepillar, fresar...'),
(740, '10.11.00.00', 'M?quinas de mecanizado - para serrar'),
(741, '10.11.01.00', 'Sierra circular'),
(742, '10.11.01.01', 'Serrar con fresa (M?quina para), fresa sierra'),
(743, '10.11.01.02', 'Sierra para tableros, escuadradora,'),
(744, '10.11.01.03', 'Sierra planetaria'),
(745, '10.11.02.00', 'Sierra de cinta'),
(746, '10.11.02.01', 'Sierra de cinta (excepto sierra de cinta para troncos de ?rboles)'),
(747, '10.11.02.02', 'Sierra de cinta para dividir y desdoblar'),
(748, '10.11.03.00', 'Sierra alternativa'),
(749, '10.11.03.01', 'Sierra oscilante'),
(750, '10.11.03.02', 'Sierra de vaiv?n (fija)'),
(751, '10.11.04.00', 'Otros tipos de sierras'),
(752, '10.11.04.01', 'Canteadora madera'),
(753, '10.11.04.02', 'Sierra de cinta para troncos de ?rboles'),
(754, '10.11.99.00', 'Otras M?quinas de serrar'),
(755, '10.12.00.00', 'M?quinas de mecanizado - para cortar, ranurar, recortar'),
(756, '10.12.01.00', 'Prensa estampadora, prensa troqueladora'),
(757, '10.12.01.01', 'Prensa estampadora'),
(758, '10.12.01.02', 'Perforador de papel'),
(759, '10.12.01.03', 'Prensa estampadora y para marcar los dobleces sobre cart?n'),
(760, '10.12.01.04', 'Fresadora de discos'),
(761, '10.12.01.05', 'Entallar (M?quina de)'),
(762, '10.12.01.06', 'Perforar (M?quina de)'),
(763, '10.12.01.07', 'Punzonar (M?quina de), punzonadora'),
(764, '10.12.01.08', 'Prensa estampadora (minerva...)'),
(765, '10.12.01.09', 'Prensa troqueladora'),
(766, '10.12.02.00', 'Cizalla a guillotina, trituradora de papel'),
(767, '10.12.02.01', 'Guillotina'),
(768, '10.12.02.02', 'Trituradora de papel'),
(769, '10.12.02.03', 'Deslardadora, productos alimentarios'),
(770, '10.12.02.04', 'Cizalla recta, cizalla de guillotina'),
(771, '10.12.02.05', 'Cortar (M?quina de), corta..., recortador de...'),
(772, '10.12.02.06', 'M?quina divisoria de la masa del pan, pasteles, pastas alimenticias'),
(773, '10.12.02.07', 'Peladora'),
(774, '10.12.02.08', 'Hendedora'),
(775, '10.12.02.09', 'Fileteadora de pescado'),
(776, '10.12.02.10', 'Descuerar (M?quina para), descortezadora, productos alimentarios'),
(777, '10.12.02.11', 'Picar (M?quina para)'),
(778, '10.12.02.12', 'Raspar (M?quina para)'),
(779, '10.12.02.13', 'Extraer los tendones (M?quina para), desnervadora (I. alimentaria)'),
(780, '10.12.02.14', 'Trocear (M?quina de), troceadora, tajadera-... (cuchillas rectas)'),
(781, '10.12.02.15', 'Pesadora de panader?a'),
(782, '10.12.02.16', 'Recortador cil?ndrico'),
(783, '10.12.02.17', 'M?quina divisoria-pesadora'),
(784, '10.12.02.18', 'Guillotina'),
(785, '10.12.02.19', 'Recortadora de chapa (M?quina)'),
(786, '10.12.02.20', 'Dividir en porciones (M?quina para)'),
(787, '10.12.02.21', 'Estampadora'),
(788, '10.12.02.22', 'Recortadora'),
(789, '10.12.03.00', 'Cizalla tipo cocodrilo de mordaza'),
(790, '10.12.03.01', 'Biseladora de mano de rosca'),
(791, '10.12.03.02', 'Cizalla de chatarra'),
(792, '10.12.03.03', 'Cizalla no mec?nica de palanca o de pedal'),
(793, '10.12.04.00', 'Cizalla de cuchillas circulares, cizalla de hoja giratoria'),
(794, '10.12.04.01', 'Tajadera-..., rebanador (de disco)'),
(795, '10.12.04.02', 'Cizalla de cuchillas radiales'),
(796, '10.12.04.03', 'Cortar (M?quina de) con ruedas de moletear, cizalla cuchillas circulares etc'),
(797, '10.12.05.00', 'Cizallas (otras y no port?tiles)'),
(798, '10.12.06.00', 'Desfondadora'),
(799, '10.12.07.00', 'Sierra de cadena'),
(800, '10.12.07.01', 'Sierra circular tronzadora de cadena, sierra fija de cadena'),
(801, '10.12.08.00', 'Troceadora'),
(802, '10.12.08.01', 'Desenrolladora para chapas de madera'),
(803, '10.12.08.02', 'Hendidora de troncos'),
(804, '10.12.08.03', 'Cortadora de madera y materias similares'),
(805, '10.12.08.04', 'Hender (M?quina para), hendedora'),
(806, '10.12.09.00', 'Desfibradora'),
(807, '10.12.09.01', 'Desfibrador/a para madera y materias similares'),
(808, '10.12.09.02', 'Descortezadora'),
(809, '10.12.09.03', 'M?quina hendedora'),
(810, '10.12.10.00', 'Hendedora'),
(811, '10.12.10.01', 'Descarnadora de cuero'),
(812, '10.12.10.02', 'M?quina para dividir las pieles en su espesor'),
(813, '10.12.10.03', 'M?quina rebajadora de cuero'),
(814, '10.12.10.04', 'Hendedora de cuero'),
(815, '10.12.10.05', 'Tundidora de pieles y cepillos'),
(816, '10.12.10.06', 'M?quina de raspar'),
(817, '10.12.10.07', 'M?quina de chiflar pieles'),
(818, '10.12.10.08', 'Depilar (M?quina de)'),
(819, '10.12.10.09', 'Ablandar (M?quina para)'),
(820, '10.12.11.00', 'Oxicorte (M?quina de)'),
(821, '10.12.11.01', 'Soplete para oxicorte'),
(822, '10.12.11.02', 'Corte t?rmico de metales'),
(823, '10.12.12.00', 'Corte l?ser (M?quina para)'),
(824, '10.12.12.01', 'L?ser de corte'),
(825, '10.12.12.02', 'Mecanizar con l?ser (M?quina para)'),
(826, '10.12.13.00', 'Corte al chorro l?quido (M?quina para)'),
(827, '10.12.13.01', 'Cortar al chorro fluido (M?quina de)'),
(828, '10.12.14.00', 'Cortadora de plasma (M?quina)');
INSERT INTO `ace_agentematerial` (`id_agentematerial`, `codagentemat_am`, `agentematerial_am`) VALUES
(829, '10.12.15.00', 'Otros dispositivos para cortar'),
(830, '10.12.15.01', 'Cortadora'),
(831, '10.12.15.02', 'Electroerosi?n (M?quina de) por penetraci?n o por hilo'),
(832, '10.12.15.03', 'Descarga disruptiva (M?quina de)'),
(833, '10.12.99.00', 'Otras M?quinas para cortar, hender...'),
(834, '10.13.00.00', 'M?quinas para tratamiento superficies-limpiar,lavar,secar,pintar,imprimir'),
(835, '10.13.01.00', 'M?quina arenadora, granalladora'),
(836, '10.13.01.01', 'Arenadora de bolas de vidrio'),
(837, '10.13.01.02', 'Cabina para chorreado de arena'),
(838, '10.13.01.03', 'M?quina de granelar (offset)'),
(839, '10.13.01.04', 'Chorrear con granalla (M?quina para)'),
(840, '10.13.01.05', 'Limpiar con chorro de arena (M?quina de)'),
(841, '10.13.02.00', 'Lavar (M?quina de)'),
(842, '10.13.02.01', 'Lavar (botellas...) (M?quina de)'),
(843, '10.13.02.02', 'Lavar, desengrasar, secar (M?quina de)'),
(844, '10.13.02.03', 'Limpiar en seco (M?quina de), limpieza de tejidos con disolventes (M?quina para la)'),
(845, '10.13.02.04', 'Lavaverduras'),
(846, '10.13.02.05', 'Lavadora'),
(847, '10.13.02.06', 'L?nea de lavado'),
(848, '10.13.02.07', 'Limpieza de herramientas (maquina para la)'),
(849, '10.13.02.08', 'Enjuagado de contenedores (M?quina para el)'),
(850, '10.13.02.09', 'Material de limpieza'),
(851, '10.13.03.00', 'Secar superficies (M?quina de), excepto secadores'),
(852, '10.13.04.00', 'Pintar, imprimir (M?quinas para), superficie plana'),
(853, '10.13.04.01', 'Imprimir (minerva) (M?quina de)'),
(854, '10.13.04.02', 'Barnizar (M?quina para), superficie plana'),
(855, '10.13.04.03', 'Minerva, papel, cart?n'),
(856, '10.13.04.04', 'Prensa para dorar, papel, cart?n'),
(857, '10.13.04.05', 'Prensa de prueba, papel, cart?n'),
(858, '10.13.04.06', 'Prensa llamada minerva para imprenta, papel, cart?n'),
(859, '10.13.04.07', 'Prensa manch?n, papel, cart?n'),
(860, '10.13.04.08', 'Prensa elevadora, papel, cart?n'),
(861, '10.13.04.09', 'Prensa offset, papel, cart?n'),
(862, '10.13.04.10', 'Prensa tipogr?fica, papel, cart?n'),
(863, '10.13.05.00', 'Pintar, imprimir (M?quinas de) de cilindros'),
(864, '10.13.05.01', 'Barnizar (M?quina de) (de cilindros)'),
(865, '10.13.05.02', 'Imprimir (M?quina de) de cilindros'),
(866, '10.13.05.03', 'Serigraf?a (M?quina para)'),
(867, '10.13.05.04', 'Codificaci?n (M?quina de)'),
(868, '10.13.05.05', 'Peliculado (M?quina de)'),
(869, '10.13.05.06', 'Humectador'),
(870, '10.13.05.07', 'Preimpresora (a menudo en flexograf?a)'),
(871, '10.13.05.08', 'Rotocortador (impresi?n y corte longitudinal)'),
(872, '10.13.05.09', 'Reproductora (de planos)'),
(873, '10.13.06.00', 'Cabina de pintura por pulverizaci?n'),
(874, '10.13.06.01', 'Cabina de pintura'),
(875, '10.13.06.02', 'Instalaci?n de pintura'),
(876, '10.13.06.03', 'Pistola para pintura, instalaci?n autom?tica'),
(877, '10.13.07.00', 'Pintura al temple (M?quina de)'),
(878, '10.13.08.00', 'Te?ir, aprestar (M?quinas para)'),
(879, '10.13.08.01', 'Deslustrador decatizador, textiles'),
(880, '10.13.08.02', 'Igualadora, textiles'),
(881, '10.13.08.03', 'Ensanchadora, textiles'),
(882, '10.13.08.04', 'Esmeriladora, textiles'),
(883, '10.13.08.05', 'Encoladora, textiles'),
(884, '10.13.08.06', 'Ensimadora, textiles'),
(885, '10.13.08.07', 'Chamuscadora, textiles'),
(886, '10.13.08.08', 'Foulard, textiles'),
(887, '10.13.08.09', 'Laminadora para materias textiles'),
(888, '10.13.08.10', 'Achaflanar (M?quina de), textiles'),
(889, '10.13.08.11', 'Te?ir (M?quina de) de barca  de torniquete, textiles'),
(890, '10.13.08.12', 'Mercerizadora, textiles'),
(891, '10.13.08.13', 'Polimerizadora, textiles'),
(892, '10.13.08.14', 'Tren de tintura de apresto, textiles'),
(893, '10.13.08.15', 'Sanforizadora, textiles'),
(894, '10.13.08.16', 'Abatanadora (curtido, lavado)'),
(895, '10.13.08.17', 'Tambor (M?quina de) (curtidur?a)'),
(896, '10.13.08.18', 'Rueda de batido, cuero'),
(897, '10.13.08.19', 'Tambor (curtido, lavado)'),
(898, '10.13.08.20', 'Impresi?n (M?quina de)'),
(899, '10.13.08.21', 'Tintura (M?quina de)'),
(900, '10.13.08.22', 'Lavadora'),
(901, '10.13.08.23', 'Abatanadora (apresto y tintura)'),
(902, '10.13.08.24', 'Impregnar (M?quina de)'),
(903, '10.13.99.00', 'Otros dispositivos para limpiar, lavar, secar, pintar, imprimir, impregnar'),
(904, '10.14.00.00', 'M?quinas para tratamiento superficies - galvanizado,  electrol?tico'),
(905, '10.14.01.00', 'Tratamientos electrol?ticos (M?quinas para)'),
(906, '10.14.01.01', 'Dispositivo de tratamiento de superficie (cromo, cadmiado, n?quel, cianuros...)'),
(907, '10.14.02.00', 'Recubrimiento por aspersi?n, inmersi?n (M?quinas de)'),
(908, '10.14.02.01', 'Dispositivo de tratamiento de superficie (galvanizado, esta?ado, bru?ido...)'),
(909, '10.14.02.02', 'Metalizar (M?quina de)'),
(910, '10.14.99.00', 'Otras M?quinas para el tratamiento de superficies'),
(911, '10.15.00.00', 'M?quinas ensamblar-soldar,pegar,clavar,atornillar,remachar,hilar,coser'),
(912, '10.15.01.00', 'Soldadura por resistencia (M?quinas de)'),
(913, '10.15.01.01', 'Soldar con resistencia (M?quina de), soldadora por resistencia'),
(914, '10.15.01.02', 'Tenazas para soldadura'),
(915, '10.15.01.03', 'Prensa de soldar'),
(916, '10.15.02.00', 'Soldadura aut?gena (M?quinas de)'),
(917, '10.15.02.01', 'Soplete a gas, de gasolina'),
(918, '10.15.02.02', 'Soplete y tubos'),
(919, '10.15.02.03', 'Manorreductor (de soplete a gas)'),
(920, '10.15.02.04', 'L?mpara para soldeo fuerte, para soldar'),
(921, '10.15.02.05', 'Soldar con soplete (M?quina de)'),
(922, '10.15.02.06', 'Puesto de soldadura aut?gena'),
(923, '10.15.03.00', 'Soldadura el?ctrica (M?quinas de)'),
(924, '10.15.03.01', 'Portaelectrodo y cables'),
(925, '10.15.03.02', 'Puesto de soldadura por arco el?ctrico'),
(926, '10.15.04.00', 'Soldadura por inmersi?n (M?quinas de)'),
(927, '10.15.05.00', 'Pegar (M?quina para)'),
(928, '10.15.05.01', 'Ensambladora-encoladora'),
(929, '10.15.05.02', 'Pegar, encolar (M?quina de)'),
(930, '10.15.05.03', 'Soldar al vac?o (M?quina de)'),
(931, '10.15.06.00', 'Grapar (M?quinas para)'),
(932, '10.15.06.01', 'Grapar (M?quina para), grapado (M?quina de)(excepto l?neas acondicionamiento)'),
(933, '10.15.06.02', 'Encartonar (M?quina para)'),
(934, '10.15.06.03', 'Poner los ojetes (excepto l?neas de acondicionamiento) (M?quina para)'),
(935, '10.15.07.00', 'Clavar, remachar (M?quina de)'),
(936, '10.15.07.01', 'Remachar (M?quina de) (fija)'),
(937, '10.15.08.00', 'Hilar (M?quinas de)'),
(938, '10.15.08.01', 'Ensambladora-retorcedora, textiles'),
(939, '10.15.08.02', 'Merchera continua, textiles'),
(940, '10.15.08.03', 'Banco estirador, textiles'),
(941, '10.15.08.04', 'Banco de retorcer, textiles'),
(942, '10.15.08.05', 'Telar para doblar, textiles'),
(943, '10.15.08.06', 'Hiladora, textiles'),
(944, '10.15.08.07', 'Cableadora (hilo fino) (M?quina)'),
(945, '10.15.09.00', 'Bobinar (M?quinas de)'),
(946, '10.15.09.01', 'Canillera, textiles'),
(947, '10.15.09.02', 'Desbobinadora de hilos textiles'),
(948, '10.15.09.03', 'Desbobinadora-bobinadora de tejidos recubiertos o no'),
(949, '10.15.09.04', 'Medidora, textiles'),
(950, '10.15.09.05', 'Urdidor, textiles'),
(951, '10.15.09.06', 'Devanadora, textiles'),
(952, '10.15.09.07', 'Comprobadora, textiles'),
(953, '10.15.09.08', 'Bobinar (M?quina para), textiles'),
(954, '10.15.09.09', 'Rizar (M?quina de), textiles'),
(955, '10.15.09.10', 'Enrollar una cinta alrededor de tubos y cables (M?quina para), textiles'),
(956, '10.15.09.11', 'Gofrar (M?quina para), textiles'),
(957, '10.15.09.12', 'Bobinadora (chapas y alambres)'),
(958, '10.15.09.13', 'Desenrollador de chapas y alambres, metales'),
(959, '10.15.10.00', 'Cablear (M?quinas para)'),
(960, '10.15.10.01', 'Cableador'),
(961, '10.15.10.02', 'Calibradora'),
(962, '10.15.10.03', 'M?quinas de revestir en espiral'),
(963, '10.15.10.04', 'Trenzar (M?quina para)'),
(964, '10.15.10.05', 'Enrolladora (cables)'),
(965, '10.15.10.06', 'Trenzadora'),
(966, '10.15.11.00', 'Tejer, tricotar (M?quinas para)'),
(967, '10.15.11.01', 'M?quina para enrejar (metales)'),
(968, '10.15.11.02', 'Telar (telas met?licas)'),
(969, '10.15.11.03', 'Telar (textiles)'),
(970, '10.15.11.04', 'M?quina para tejidos de mallas'),
(971, '10.15.11.05', 'M?quina de remallar, textiles'),
(972, '10.15.11.06', 'Tricotar (M?quina de), tricotadora'),
(973, '10.15.12.00', 'Coser (M?quinas de)'),
(974, '10.15.12.01', 'Encuadernar en r?stica (M?quina de), encuadernadora de imprenta'),
(975, '10.15.12.02', 'Moldear (M?quina de)'),
(976, '10.15.12.03', 'Montar y conformar (M?quina para)'),
(977, '10.15.12.04', 'Montador de punteras'),
(978, '10.15.12.05', 'Activador de cola para punteras'),
(979, '10.15.12.06', 'Poner la espiral a los cuadernos (M?quina para)'),
(980, '10.15.12.07', 'Encartonadora-cosedora de alambre'),
(981, '10.15.12.08', 'Coser (M?quina de) (excepto l?neas de acondicionamiento)'),
(982, '10.15.12.09', 'Anudar (M?quina de)'),
(983, '10.15.12.10', 'Cosedora (excepto l?neas de acondicionamiento) (M?quina)'),
(984, '10.15.99.00', 'Otros dispositivos de soldadura, encolado, ensamblaje'),
(985, '10.15.99.01', 'Soldar los pl?sticos por todos los procedimientos (M?quina de)'),
(986, '10.16.00.00', 'M?quinas para acondicionar, embalar (llenar, etiquetar, cerrar, etc.)'),
(987, '10.16.01.00', 'Dosificar, llenar (M?quinas para)'),
(988, '10.16.01.01', 'Dispositivo para espumar los l?quidos'),
(989, '10.16.01.02', 'Balanza, b?scula (l?nea de acondicionamiento)'),
(990, '10.16.01.03', 'Controlador de nivel'),
(991, '10.16.01.04', 'Alimentador'),
(992, '10.16.01.05', 'Envinar (M?quina para), envinadora'),
(993, '10.16.01.06', 'Clasificar productos (M?quina de)'),
(994, '10.16.01.07', 'Comprimir (M?quina de)'),
(995, '10.16.01.08', 'Contar productos (M?quina para)'),
(996, '10.16.01.09', 'Acondicionar (M?quina para)'),
(997, '10.16.01.10', 'Controlar los niveles (M?quina para)'),
(998, '10.16.01.11', 'Descapsular (M?quina de)'),
(999, '10.16.01.12', 'Cortar (M?quina para), recortar los envases (M?quina para)'),
(1000, '10.16.01.13', 'Desopercular (M?quina para)'),
(1001, '10.16.01.14', 'Destornillar (M?quina para)'),
(1002, '10.16.01.15', 'Distribuir (M?quina para)'),
(1003, '10.16.01.16', 'Dosificar productos (M?quina para)'),
(1004, '10.16.01.17', 'Embotellar (M?quina para)'),
(1005, '10.16.01.18', 'Empaquetar (M?quina para)'),
(1006, '10.16.01.19', 'Revestir (envases) (M?quina para)'),
(1007, '10.16.01.20', 'Formar los productos (M?quina para)'),
(1008, '10.16.01.21', 'Lavar (M?quina de), aclarar (M?quina de) (en l?nea de acondicionamiento)'),
(1009, '10.16.01.22', 'Ovoscopio'),
(1010, '10.16.01.23', 'Moldear los productos (M?quina de)'),
(1011, '10.16.01.24', 'Abrir los envases (M?quina para)'),
(1012, '10.16.01.25', 'Parafinar (M?quina de)'),
(1013, '10.16.01.26', 'Pesar los productos (M?quina de)'),
(1014, '10.16.01.27', 'Posicionar (M?quina para)'),
(1015, '10.16.01.28', 'Muestreo (M?quina de) (incorporada a las l?neas de acondicionamiento)'),
(1016, '10.16.01.29', 'Ranurar (M?quina de)'),
(1017, '10.16.01.30', 'Recalcar (M?quina de) (para embalajes)'),
(1018, '10.16.01.31', 'Llenar las botellas y los frascos (M?quina de)'),
(1019, '10.16.01.32', 'Saturar los recipientes met?licos, las botellas y los frascos (m?qSaturar los recipientes met?licos, las botellas y los frascos (M?quina de)'),
(1020, '10.16.01.33', 'Secar los envases (M?quina de)'),
(1021, '10.16.01.34', 'Envasar (M?quina de), embotelladora'),
(1022, '10.16.01.35', 'Clasificar los productos (M?quina de)'),
(1023, '10.16.01.36', 'M?quina de embalaje y de acondicionamiento'),
(1024, '10.16.01.37', 'Desenroscado (M?quina de)'),
(1025, '10.16.01.38', 'Rellenar (M?quina para), rellenadora'),
(1026, '10.16.01.39', 'Llenadora'),
(1027, '10.16.02.00', 'Embalar, etiquetar (M?quinas de)'),
(1028, '10.16.02.01', 'M?quina taponadora de botellas'),
(1029, '10.16.02.02', 'M?quina para taponar'),
(1030, '10.16.02.03', 'Capsuladora'),
(1031, '10.16.02.04', 'Cadena de encuadernaci?n en r?stica'),
(1032, '10.16.02.05', 'Contador-apilador, M?quina para apilar'),
(1033, '10.16.02.06', 'Desenvasadora-envasadora'),
(1034, '10.16.02.07', 'M?quina para decorar (pasteler?a y confiter?a)'),
(1035, '10.16.02.08', 'Etiquetadora'),
(1036, '10.16.02.09', 'Encartonadora'),
(1037, '10.16.02.10', 'M?quina de hacer juntas'),
(1038, '10.16.02.11', 'Lector de c?digos'),
(1039, '10.16.02.12', 'Empacadora'),
(1040, '10.16.02.13', 'Taponar botellas y frascos (M?quina de)'),
(1041, '10.16.02.14', 'Capsular botellas y frascos (M?quina de)'),
(1042, '10.16.02.15', 'Envolver con celof?n (M?quina de)'),
(1043, '10.16.02.16', 'Codificar (M?quina de)'),
(1044, '10.16.02.17', 'Pegar, doblar las etiquetas (M?quina de)'),
(1045, '10.16.02.18', 'Pegar las solapas de cajas de cart?n y bolsas (M?quina de)'),
(1046, '10.16.02.19', 'Marcar (fechar, numerar) (M?quina para)'),
(1047, '10.16.02.20', 'Envolvedora skin pack (M?quina)'),
(1048, '10.16.02.21', 'Acondicionar las bandejas de alimentos (M?quina de)'),
(1049, '10.16.02.22', 'Vaciar las cajas (M?quina para)'),
(1050, '10.16.02.23', 'Descodificar (M?quina de)'),
(1051, '10.16.02.24', 'Despaletizar (M?quina de)'),
(1052, '10.16.02.25', 'Desenrollar y colocar las etiquetas en tiras (M?quina de)'),
(1053, '10.16.02.26', 'Dosificar las cajas de cart?n (M?quina de)'),
(1054, '10.16.02.27', 'Dosificar las cajas met?licas (M?quina de)'),
(1055, '10.16.02.28', 'Dosificar las botellas y frascos (M?quina de)'),
(1056, '10.16.02.29', 'Encajar (M?quina de)'),
(1057, '10.16.02.30', 'Llenar y vaciar cajas (M?quina de)'),
(1058, '10.16.02.31', 'Llenar o vaciar cajas (M?quina de)'),
(1059, '10.16.02.32', 'Llenar cajas de cart?n (M?quina de)'),
(1060, '10.16.02.33', 'Pegar las cajas de cart?n y las bolsas (M?quina de)'),
(1061, '10.16.02.34', 'Pegar las etiquetas (M?quina de)'),
(1062, '10.16.02.35', 'Encintar (M?quina de)'),
(1063, '10.16.02.36', 'Envolver (M?quina de)'),
(1064, '10.16.02.37', 'Etiquetar (M?quina de)'),
(1065, '10.16.02.38', 'Cerrar (a menudo con rebordeo) (M?quina de)'),
(1066, '10.16.02.39', 'Cerrar las cajas met?licas (M?quina de)'),
(1067, '10.16.02.40', 'Cerrar las botellas y frascos (M?quina de)'),
(1068, '10.16.02.41', 'Cerrar las cajas de cart?n y las bolsas de papel (M?quina de)'),
(1069, '10.16.02.42', 'Atadora (M?quina)'),
(1070, '10.16.02.43', 'Formar, llenar, cerrar las cajas de cart?n y las bolsas de papel (M?quina de)'),
(1071, '10.16.02.44', 'Guarnecer las botellas (M?quina de)'),
(1072, '10.16.02.45', 'Enfundar (M?quina de)'),
(1073, '10.16.02.46', 'Imprimir (M?quina de) (l?nea de acondicionamiento)'),
(1074, '10.16.02.47', 'Marcar (M?quina de) (etiquetaje)'),
(1075, '10.16.02.48', 'Poner bajo cinta (M?quina para)'),
(1076, '10.16.02.49', 'Precintar con cordeler?a de alambre (M?quina de)'),
(1077, '10.16.02.50', 'Paletizar (M?quina de)'),
(1078, '10.16.02.51', 'Empaquetadora blister (M?quina)'),
(1079, '10.16.02.52', 'Doblar las cajas de cart?n, bolsas (M?quina de)'),
(1080, '10.16.02.53', 'Doblar los folletos y prospectos (M?quina para)'),
(1081, '10.16.02.54', 'Colocar las tiras desgarrables, las solapas (M?quina para)'),
(1082, '10.16.02.55', 'Colocar los picos de vertido (M?quina de)'),
(1083, '10.16.02.56', 'Colocar las vi?etas (M?quina de)'),
(1084, '10.16.02.57', 'Llenar (a menudo con rebordeo) (M?quina de)'),
(1085, '10.16.02.58', 'Llenar las cajas met?licas (M?quina de)'),
(1086, '10.16.02.59', 'Rellenar caramelos (M?quina de)'),
(1087, '10.16.02.60', 'Llenar las cajas de cart?n y las bolsas de papel (M?quina de)'),
(1088, '10.16.02.61', 'T?nel de retracci?n'),
(1089, '10.16.02.62', 'Reducir (M?quina para)'),
(1090, '10.16.02.63', 'Forrar (l?nea de acondicionamiento) (M?quina para)'),
(1091, '10.16.02.64', 'Poner c?psulas de sobretaponado (M?quina para)'),
(1092, '10.16.02.65', 'Envolver embalajes m?ltiples (M?quina de)'),
(1093, '10.16.02.66', 'Enroscar los tapones de las botellas y de los frascos (M?quina de)'),
(1094, '10.16.02.67', 'Encapsulado (M?quina de)'),
(1095, '10.16.02.68', 'Etiquetado (M?quina de)'),
(1096, '10.16.02.69', 'Descapsulado (M?quina de)'),
(1097, '10.16.02.70', 'Cierre (M?quina de)'),
(1098, '10.16.02.71', 'Marcado (M?quina de)'),
(1099, '10.16.02.72', 'Colocaci?n de alambre sobre los tapones (M?quina de)'),
(1100, '10.16.02.73', 'Sellado (M?quina de)'),
(1101, '10.16.02.74', 'M?quina para precintar con cordeler?a de alambre (botellas y frascos)'),
(1102, '10.16.02.75', 'Paletizador'),
(1103, '10.16.02.76', 'Colocadora-apiladora'),
(1104, '10.16.02.77', 'Esta?adora (sin llenado)'),
(1105, '10.16.02.78', 'Esta?adora de acondicionamiento'),
(1106, '10.16.02.79', 'M?quina para volcar pilas'),
(1107, '10.16.03.00', 'Ensacar (M?quinas de)'),
(1108, '10.16.03.01', 'M?quina ensacadora'),
(1109, '10.16.04.00', 'Clavar, cerrar los embalajes (M?quinas de)'),
(1110, '10.16.04.01', 'Empalmar con grapas (M?quina para), utilizada en acondicionamiento'),
(1111, '10.16.04.02', 'Precintar (M?quina de)'),
(1112, '10.16.04.03', 'Encercar (M?quina de)'),
(1113, '10.16.04.04', 'Grapas (M?quina de)'),
(1114, '10.16.04.05', 'Grapar (M?quina para)'),
(1115, '10.16.04.06', 'Clavar (cajas) (M?quina de)'),
(1116, '10.16.04.07', 'Coser (M?quina de), utilizada en el acondicionamiento'),
(1117, '10.16.04.08', 'Prender con alfileres (M?quina de)'),
(1118, '10.16.04.09', 'Puntear (M?quina de), utilizada en el acondicionamiento'),
(1119, '10.16.04.10', 'Barretear (acondicionamiento) (M?quina de)'),
(1120, '10.16.04.11', 'Colocar los ojetes (acondicionamiento) y fabricaci?n (M?quina para)'),
(1121, '10.16.99.00', 'Otras M?quinas para acondicionar'),
(1122, '10.17.00.00', 'Otras M?quinas de industrias espec?ficas-control de ensayos, diversas'),
(1123, '10.17.01.00', 'M?quinas de control y de ensayos'),
(1124, '10.17.01.01', 'Pesaje, dosificaci?n (M?quina de), balanza (excepto acondicionamiento)'),
(1125, '10.17.01.02', 'Detectar metales (M?quina de)'),
(1126, '10.17.01.03', 'Control y medida (M?quina de), testar (M?quina de), M?quina de ensayo'),
(1127, '10.17.01.04', 'Instrumento de medida'),
(1128, '10.17.02.00', 'M?quinas diversas'),
(1129, '10.17.02.01', 'Centro de mecanizado'),
(1130, '10.17.02.02', 'Desguarnecer los cables el?ctricos (M?quina para)'),
(1131, '10.17.02.03', 'Fabricar las bombillas el?ctricas (M?quina para)'),
(1132, '10.17.02.04', 'Mecanizar (M?quina para) (por defecto de precisi?n)'),
(1133, '10.17.02.05', 'M?quina autom?tica'),
(1134, '10.17.02.06', 'M?quina transfer transferidora'),
(1135, '10.17.02.07', 'Robot'),
(1136, '10.17.99.00', 'Otros tipos de M?quinas de industrias espec?ficas'),
(1137, '10.18.00.00', 'M?quinas espec?ficas de agricultura no relacionadas con las citadas antes'),
(1138, '10.18.01.00', 'Orde?ar (M?quina de)'),
(1139, '10.18.99.00', 'Otras M?quinas utilizadas en agricultura'),
(1140, '10.99.00.00', 'Otras M?quinas y equipos fijos comprendidos en el grupo 10 pero no citados'),
(1141, '11.00.00.00', 'Dispositivos de traslado, transporte y almacenamiento'),
(1142, '11.01.00.00', 'Transportadores fijos, equipos y sistemas de transporte continuo'),
(1143, '11.01.01.00', 'Transportadores por cadenas, por rodillos'),
(1144, '11.01.01.01', 'Transportador por cadena'),
(1145, '11.01.01.02', 'Transportador por cadena arrastradora y portadora'),
(1146, '11.01.01.03', 'Transportador por rodillos'),
(1147, '11.01.02.00', 'Cintas transportadoras'),
(1148, '11.01.02.01', 'Transportador de cinta'),
(1149, '11.01.02.02', 'Transportador de banda y de cinta'),
(1150, '11.01.02.03', 'Cintas transportadoras m?viles'),
(1151, '11.01.03.00', 'Transportadores de tornillo'),
(1152, '11.01.03.01', 'Tornillos transportadores'),
(1153, '11.01.03.02', 'Alimentaci?n de las M?quinas por tornillos'),
(1154, '11.01.04.00', 'Escaleras, cintas rodantes'),
(1155, '11.01.04.01', 'Escaleras mec?nicas'),
(1156, '11.01.04.02', 'Plataforma m?vil'),
(1157, '11.01.05.00', 'Dispositivos de transporte suspendidos'),
(1158, '11.01.05.01', 'Telef?ricos, telesqu?s, telesillas para transporte de personas'),
(1159, '11.01.05.02', 'Telef?ricos para material'),
(1160, '11.01.06.00', 'Otros tipos de transportadores'),
(1161, '11.01.06.01', 'Transportador por palets'),
(1162, '11.01.06.02', 'Tren de rodillos, transportador de rodillos'),
(1163, '11.01.06.03', 'Transportador por aire, gu?a de deslizamiento por aire'),
(1164, '11.01.06.04', 'Transportadores por funicular a?reo'),
(1165, '11.01.06.05', 'Transportadores sobre ra?les a?reos'),
(1166, '11.01.06.06', 'Transportador vibratorio'),
(1167, '11.01.06.07', 'Transportador por inercia'),
(1168, '11.01.06.08', 'Transportar (M?quina para), trasladar (M?quina para)'),
(1169, '11.01.99.00', 'Otros transportadores fijos'),
(1170, '11.02.00.00', 'Elevadores,ascensores,equipos de nivelaci?n -montacargas,gatos,tornos etc'),
(1171, '11.02.01.00', 'Ascensores montacargas'),
(1172, '11.02.01.01', 'Ascensores'),
(1173, '11.02.01.02', 'Montacargas'),
(1174, '11.02.01.03', 'Equipos de elevaci?n de personas (barquillas, plataformas elevadoras...)'),
(1175, '11.02.02.00', 'Aparatos de elevaci?n'),
(1176, '11.02.02.01', 'Equipos de elevaci?n de Veh?culos, puente elevador'),
(1177, '11.02.02.02', 'Cabrestantes, gatos'),
(1178, '11.02.03.00', 'Otros tipos de elevadores'),
(1179, '11.02.03.01', 'Elevador de cangilones'),
(1180, '11.02.03.02', 'Elevador-cargador'),
(1181, '11.02.03.03', 'Descender (M?quina para)'),
(1182, '11.02.03.04', 'Elevar (M?quina para)'),
(1183, '11.02.03.05', 'Enderezar los envases (M?quina para)'),
(1184, '11.02.03.06', 'Volcar los envases (M?quina para)'),
(1185, '11.02.99.00', 'Otros equipos de elevaci?n'),
(1186, '11.03.00.00', 'Gr?as fijas,m?viles,montadas sobre Veh?culos, de puente, equipos elevaci?n'),
(1187, '11.03.01.00', 'Gr?as, gr?as-puente'),
(1188, '11.03.01.01', 'Gr?as'),
(1189, '11.03.01.02', 'Manipulador de carga/descarga'),
(1190, '11.03.01.03', 'Gr?as-puente y gr?as de p?rtico'),
(1191, '11.03.01.04', 'Brazo de carga sobre Veh?culos'),
(1192, '11.03.02.00', 'Chigres, polipastos, equilibradores'),
(1193, '11.03.02.01', 'Chigres, polipastos, poleas elevadoras, muflas, equilibradores'),
(1194, '11.03.99.00', 'Otros equipos de elevaci?n de carga suspendida'),
(1195, '11.04.00.00', 'Dispositivos m?viles de transporte, carros de transporte -motorizados o no'),
(1196, '11.04.01.00', 'Dispositivo de transporte de carga sin elevaci?n'),
(1197, '11.04.01.01', 'Carretillas'),
(1198, '11.04.01.02', 'Carretillas de mano'),
(1199, '11.04.01.03', 'Contenedores basculantes,carros sobre ruedas, vagonetas'),
(1200, '11.04.01.04', 'Transpaleta'),
(1201, '11.04.02.00', 'Carretillas elevadoras'),
(1202, '11.04.02.01', 'Carretillas motorizadas para transportar, elevar, apilar, con conductor'),
(1203, '11.04.02.02', 'Carretillas motorizadas para transportar, elevar, apilar, con acompa?ante'),
(1204, '11.04.99.00', 'Otros dispositivos m?viles de transporte'),
(1205, '11.05.00.00', 'Dispositivos elevadores,de amarre,de prensi?n y materiales para transporte'),
(1206, '11.05.01.00', 'Cadenas, cables met?licos, cordaje textil, eslingas, correas, el?sticos'),
(1207, '11.05.02.00', 'Balancines, pinzas, electroimanes, ventosas'),
(1208, '11.05.03.00', 'Ganchos, garfios en ese, dientes de lobo'),
(1209, '11.05.99.00', 'Otros dispositivos elevadores'),
(1210, '11.06.00.00', 'Dispositivos de almacenamiento,embalaje,contenedores-silos,dep?sitos-fijos'),
(1211, '11.06.01.00', 'Silos, acumuladores de materias, montones, fijos'),
(1212, '11.06.02.00', 'Tanques, cisternas abiertos fijos'),
(1213, '11.06.02.01', 'Estanques, piscinas, pilas fijas'),
(1214, '11.06.03.00', 'Tanques y cisternas cerrados, fijos'),
(1215, '11.06.03.01', 'Tanques y cisternas (excepto gas)'),
(1216, '11.06.03.02', 'Tanques, cisternas de gas'),
(1217, '11.06.99.00', 'Otros dispositivos fijos de almacenamiento'),
(1218, '11.07.00.00', 'Dispositivos de almacenamiento, embalaje, contenedores - m?viles'),
(1219, '11.07.01.00', 'Contenedores, tolvas de carga'),
(1220, '11.07.01.01', 'Contenedores m?viles, tolvas de carga'),
(1221, '11.07.99.00', 'Otros dispositivos m?viles de almacenamiento'),
(1222, '11.08.00.00', 'Accesorios de almacenamiento,estanter?as,especiales para palets, palets'),
(1223, '11.08.01.00', 'Estanter?as, estanter?as especiales para almacenar cargas en palets'),
(1224, '11.08.02.00', 'Palets'),
(1225, '11.08.99.00', 'Otros dispositivos accesorios de almacenamiento'),
(1226, '11.09.00.00', 'Embalajes diversos,peque?os y medianos-m?viles-cubos,botellas,extintor,etc.'),
(1227, '11.09.01.00', 'Peque?os contenedores (excepto sobre Veh?culo)'),
(1228, '11.09.02.00', 'Recipientes, bidones, toneles, botellas (excepto gas)'),
(1229, '11.09.03.00', 'Botellas de gas, aerosoles, extintores'),
(1230, '11.09.04.00', 'Recipientes flexibles'),
(1231, '11.09.04.01', 'Recipientes flexibles, Big Bag'),
(1232, '11.09.05.00', 'Utensilios de almacenamiento (en fr?o)'),
(1233, '11.09.06.00', 'Cubo de la basura, recipiente para basuras'),
(1234, '11.09.99.00', 'Otros embalajes (entre los cuales cajas de cart?n vac?as o llenas...)'),
(1235, '11.99.00.00', 'Otros dispositivos de traslado, transporte y almacenamiento no citados'),
(1236, '12.00.00.00', 'Veh?culos terrestres'),
(1237, '12.01.00.00', 'Veh?culos - pesados: camiones de carga pesada, autobuses y autocares'),
(1238, '12.01.01.00', 'Camiones remolque, semirremolque - de carga'),
(1239, '12.01.02.00', 'Autobuses, autocares, transporte de pasajeros'),
(1240, '12.01.99.00', 'Otros tipos de Veh?culos de carga pesada'),
(1241, '12.02.00.00', 'Veh?culos - ligeros: carga o pasajeros'),
(1242, '12.02.01.00', 'Autom?viles'),
(1243, '12.02.02.00', 'Camionetas, furgones'),
(1244, '12.02.03.00', 'Cami?n tractor sin remolque'),
(1245, '12.02.99.00', 'Otros tipos de Veh?culos ligeros'),
(1246, '12.03.00.00', 'Veh?culos - dos, tres ruedas, motorizados o no'),
(1247, '12.03.01.00', 'Motocicletas, velomotores, esc?ters'),
(1248, '12.03.02.00', 'Bicicletas, patinetas'),
(1249, '12.03.99.00', 'Otros Veh?culos de dos o tres ruedas'),
(1250, '12.04.00.00', 'Otros Veh?culos terrestres: esqu?s, patines de ruedas, etc.'),
(1251, '12.04.01.00', 'Equipos de desplazamiento con los pies (esqu?s, patines de ruedas...)'),
(1252, '12.04.99.00', 'Otros tipos de medios de desplazamiento terrestre'),
(1253, '12.99.00.00', 'Otros Veh?culos terrestres del grupo 12 no citados anteriormente'),
(1254, '13.00.00.00', 'Otros Veh?culos de transporte'),
(1255, '13.01.00.00', 'Veh?culos - sobre ra?les, incluso monorra?les suspendidos: carga'),
(1256, '13.01.01.00', 'Trenes, vagones: de carga'),
(1257, '13.01.02.00', 'Monorra?les: de carga'),
(1258, '13.01.99.00', 'Otros Veh?culos sobre ra?les: de carga'),
(1259, '13.02.00.00', 'Veh?culos - sobre ra?les, incluso monorra?les suspendidos: pasajeros'),
(1260, '13.02.01.00', 'Trenes, metros, tranv?as, vagones...: de pasajeros'),
(1261, '13.02.02.00', 'Monorra?les: de pasajeros'),
(1262, '13.02.99.00', 'Otros Veh?culos sobre ra?les: de pasajeros'),
(1263, '13.03.00.00', 'Veh?culos - n?uticos: carga'),
(1264, '13.03.01.00', 'Cargueros'),
(1265, '13.03.02.00', 'Gabarras automotoras, barcos empujadores: de carga'),
(1266, '13. 03.03.00', 'Pontones: de carga'),
(1267, '13. 03.99.00', 'Otros Veh?culos n?uticos: de carga'),
(1268, '13.04.00.00', 'Veh?culos - n?uticos: pasajeros'),
(1269, '13.04.01.00', 'Transbordadores: de pasajeros'),
(1270, '13.04.02.00', 'Paquebotes: de pasajeros'),
(1271, '13.04.99.00', 'Otros Veh?culos n?uticos: de pasajeros'),
(1272, '13.05.00.00', 'Veh?culos - n?uticos: pesca'),
(1273, '13.05.01.00', 'Barcos de pesca industrial'),
(1274, '13.05.02.00', 'Barcos de pesca artesanal'),
(1275, '13.05.03.00', 'Barcos de pesca tipo industrial o artesanal, sin especificar'),
(1276, '13.05.99.00', 'Otros Veh?culos n?uticos: de pesca'),
(1277, '13. 06.00.00', 'Veh?culos - a?reos: carga'),
(1278, '13. 06.01.00', 'Aviones: de carga'),
(1279, '13. 06.02.00', 'Helic?pteros: de carga'),
(1280, '13. 06.03.00', 'Globos: de carga'),
(1281, '13. 06.99.00', 'Otras aeronaves: de carga'),
(1282, '13.07.00.00', 'Veh?culos - a?reos: pasajeros'),
(1283, '13.07.01.00', 'Aviones: de pasajeros'),
(1284, '13.07.02.00', 'Helic?pteros: de pasajeros'),
(1285, '13.07.03.00', 'Globos: de pasajeros'),
(1286, '13.07.99.00', 'Otras aeronaves: de pasajeros'),
(1287, '13.99.00.00', 'Otros Veh?culos de transporte del grupo 13 pero no citados anteriormente'),
(1288, '14.00.00.00', 'Materiales, objetos, productos, elementos de M?quina, fracturas, polvo'),
(1289, '14.01.00.00', 'Materiales de construcci?n-grandes y peque?os: prefabricados,ladrillos etc'),
(1290, '14.01.01.00', 'Grandes materiales de Grandes materiales de construcci?n'),
(1291, '14.01.01.01', 'Agentes prefabricados (puertas, tabiques, ventanas...)'),
(1292, '14.01.01.02', 'Tapiales, encofrado'),
(1293, '14.01.01.03', 'Viguetas'),
(1294, '14.01.02.00', 'Peque?os materiales de construcci?n'),
(1295, '14.01.02.01', 'Ladrillos, tejas'),
(1296, '14.01.03.00', 'Agentes diversos'),
(1297, '14.01.99.00', 'Otros materiales de construcci?n'),
(1298, '14.02.00.00', 'Elementos constitutivos de M?quina, de Veh?culo: chasis,carter,rueda,etc.'),
(1299, '14.02.01.00', 'Chasis, c?rter'),
(1300, '14.02.02.00', 'Dispositivo de mando de una M?quina'),
(1301, '14.02.03.00', 'Manivela'),
(1302, '14.02.04.00', 'Ruedas'),
(1303, '14.02.05.00', 'Neum?ticos'),
(1304, '14.02.06.00', 'M?stiles-Palos'),
(1305, '14.02.07.00', 'Puerta de arrastre'),
(1306, '14.02.08.00', 'Compuerta'),
(1307, '14.02.99.00', 'Otros agentes constitutivos de M?quinas o de Veh?culos'),
(1308, '14.03.00.00', 'Piezas trabajadas o elementos de M?quinas,incluso fragmentos de los mismos'),
(1309, '14.03.01.00', 'Pieza trabajada'),
(1310, '14.03.02.00', 'Herramienta, parte de herramienta de una M?quina'),
(1311, '14.03.02.01', 'Fragmento de muela'),
(1312, '14.03.02.02', 'Fragmento, trozo de herramienta'),
(1313, '14.03.99.00', 'Otros agentes procedentes de las piezas trabajadas o de las herramientas'),
(1314, '14.04.00.00', 'Elementos de ensamblaje: tornillos, clavos, pernos, etc.'),
(1315, '14.04.01.00', 'Torniller?a, buloner?a...'),
(1316, '14.04.02.00', 'Clavos, grapas, remaches'),
(1317, '14.04.99.00', 'Otros agentes de ensamblaje'),
(1318, '14.05.00.00', 'Part?culas,polvo,astillas,fragmentos,salpicaduras y otros elementos rotos'),
(1319, '14.05.01.00', 'Fragmentos, proyecciones, astillas, trozos, cristal roto'),
(1320, '14.05.02.00', 'Part?culas, polvos'),
(1321, '14.05.99.00', 'Otros tipos de part?culas, polvos o elementos resultantes de rotura'),
(1322, '14.06.00.00', 'Productos- de la agricultura (comprende granos, paja, otras productos)'),
(1323, '14.07.00.00', 'Productos- para la agricultura y ganader?a(abonos,alimentos para animales)'),
(1324, '14.07.01.00', 'Abonos'),
(1325, '14.07.02.00', 'Alimentos'),
(1326, '14.07.03.00', 'Productos de tratamiento (herbicidas, pesticidas, fungicidas...)'),
(1327, '14.07.99.00', 'Otros productos para la agricultura'),
(1328, '14.08.00.00', 'Productos almacenados - objetos y embalajes dispuestos en un almac?n'),
(1329, '14.08.01.00', 'Materias, objetos, agentes almacenados'),
(1330, '14.08.02.00', 'Cajas de cart?n, embalajes diversos'),
(1331, '14.08.99.00', 'Otros productos almacenados'),
(1332, '14.09.00.00', 'Productos almacenados - en rollos, bobinas'),
(1333, '14.10.00.00', 'Cargas - transportadas sobre dispositivo manipulaci?n mec?nica,de transporte'),
(1334, '14.11.00.00', 'Cargas - suspendidas de dispositivo de puesta a nivel, gr?a'),
(1335, '14.12.00.00', 'Cargas - manipuladas a mano'),
(1336, '14.99.00.00', 'Otros materiales, objetos, productos, elementos de M?quinas no mencionados'),
(1337, '15.00.00.00', 'Sustancias qu?micas, explosivas, radioactivas, biol?gicas'),
(1338, '15.01.00.00', 'Materias - c?usticas, corrosivas (s?lidas, l?quidas o gaseosas)'),
(1339, '15.02.00.00', 'Materias - nocivas, t?xicas (s?lidas l?quidas o gaseosas)'),
(1340, '15.03.00.00', 'Materias - inflamables (s?lidas, l?quidas o gaseosas)'),
(1341, '15.03.01.00', 'Materias susceptibles de inflamaci?n espont?nea'),
(1342, '15.03.02.00', 'Materias susceptibles de producir gas inflamable por reacci?n a substancias'),
(1343, '15.03.03.00', 'Materias combustibles'),
(1344, '15.03.99.00', 'Otras materias inflamables'),
(1345, '15.04.00.00', 'Materias - explosivas, reactivas (s?lidas, l?quidas o gaseosas)'),
(1346, '15.04.01.00', 'Mezclas explosivas'),
(1347, '15.04.02.00', 'Explosivos o artificios pirot?cnicos'),
(1348, '15.04.03.00', 'Materias que reaccionan violentamente al contacto con el agua'),
(1349, '15.04.99.00', 'Otras materias explosivas'),
(1350, '15.05.00.00', 'Gases, vapores sin efectos espec?ficos - inertes para la vida, asfixiantes'),
(1351, '15.05.01.00', 'Gases, vapores sin efectos espec?ficos'),
(1352, '15.05.02.00', 'Gases, vapores inertes para la vida, asfixiantes'),
(1353, '15.05.99.00', 'Otros gases sin efecto espec?fico'),
(1354, '15.06.00.00', 'Sustancias - radioactivas'),
(1355, '15.07.00.00', 'Sustancias - biol?gicas'),
(1356, '15.07.01.00', 'Orina'),
(1357, '15.07.02.00', 'Materias fecales'),
(1358, '15.07.03.00', 'Sangre, plasma, suero'),
(1359, '15.07.04.00', 'L?quidos biol?gicos, esperma,  esputos, mucosidades, coloides, etc. ...'),
(1360, '15.07.05.00', 'Alergenos de origen biol?gico'),
(1361, '15.07.06.00', 'Toxinas'),
(1362, '15.07.99.00', 'Otras materias biol?gicas'),
(1363, '15.08.00.00', 'Sustancias, materias - sin peligro espec?fico (agua, materias inertes,etc)'),
(1364, '15.99.00.00', 'Otras sustancias qu?micas,explosivas,radioactivas,biol?gicas no mencionadas'),
(1365, '16.00.00.00', 'Dispositivos y equipos de seguridad'),
(1366, '16.01.00.00', 'Dispositivos de protecci?n - sobre M?quina'),
(1367, '16.02.00.00', 'Equipos de protecci?n  individual'),
(1368, '16.02.01.00', 'Protecci?n de la cabeza'),
(1369, '16.02.02.00', 'Protecci?n respiratoria'),
(1370, '16.02.03.00', 'Protecci?n de los ojos'),
(1371, '16.02.04.00', 'Protecci?n del cuerpo'),
(1372, '16.02.05.00', 'Protecci?n de las manos'),
(1373, '16.02.06.00', 'Protecci?n de los pies'),
(1374, '16.02.99.00', 'Otras protecciones'),
(1375, '16.03.00.00', 'Dispositivos y equipos de emergencia'),
(1376, '16.99.00.00', 'Otros dispositivos y equipos protecci?n no mencionados anteriormente'),
(1377, '17.00.00.00', 'Equipos oficina y personales, material de deporte, armas, aparatos dom?sticos'),
(1378, '17.01.00.00', 'Mobiliario'),
(1379, '17.02.00.00', 'Equipos - inform?ticos, ofim?tica, reprograf?a, comunicaci?n'),
(1380, '17.02.01.00', 'Ordenador'),
(1381, '17.02.02.00', 'Pantalla de ordenador'),
(1382, '17.02.03.00', 'Impresora'),
(1383, '17.02.04.00', 'Esc?ner (de ordenador)'),
(1384, '17.02.05.00', 'Fotocopiadora'),
(1385, '17.02.06.00', 'Material de telefon?a, de telefacs?mil'),
(1386, '17.02.99.00', 'Otro equipo inform?tico, ofim?tico'),
(1387, '17.03.00.00', 'Equipos - para ense?anza, escritura, dibujo- M?quinas de escribir,etc'),
(1388, '17.03.01.00', 'Aparato de reproducci?n'),
(1389, '17.03.01.01', 'Banco de reproducci?n al arco o al xen?n'),
(1390, '17.03.02.00', 'Material fotogr?fico'),
(1391, '17.03.02.01', 'Ampliador'),
(1392, '17.03.02.02', 'Bobinadora de pel?culas fotogr?ficas'),
(1393, '17.03.03.00', 'Escribir, imprimir, etc. (M?quina de)'),
(1394, '17.03.03.01', 'Escribir (M?quina de)'),
(1395, '17.03.03.02', 'Imprimir las fajas de direcciones (M?quina de)'),
(1396, '17.03.03.03', 'Timbrar (M?quina de)'),
(1397, '17.03.03.04', 'Fechador'),
(1398, '17.03.99.00', 'Otros equipos para escritura, dibujo'),
(1399, '17.04.00.00', 'Objetos y equipos para el deporte y los juegos'),
(1400, '17.05.00.00', 'Armas'),
(1401, '17.05.01.00', 'Armas de fuego'),
(1402, '17.05.02.00', 'Armas blancas'),
(1403, '17.05.99.00', 'Otros tipos de armas'),
(1404, '17.06.00.00', 'Objetos personales, prendas de vestir'),
(1405, '17.06.01.00', 'Objetos diversos, lapicero, pluma, gafas...'),
(1406, '17.06.02.00', 'Prendas de vestir'),
(1407, '17.06.99.00', 'Otros objetos personales'),
(1408, '17.07.00.00', 'Instrumentos de m?sica'),
(1409, '17.08.00.00', 'Aparatos, utensilios, objetos, ropa del hogar (uso profesional)'),
(1410, '17.99.00.00', 'Otros equipos de oficina y personales,material de deporte,armas,etc'),
(1411, '18.00.00.00', 'Organismos vivos y seres humanos'),
(1412, '18.01.00.00', '?rboles, plantas, cultivos'),
(1413, '18.01.01.00', 'Ramas, troncos...'),
(1414, '18.01.02.00', 'Setas'),
(1415, '18.01.99.00', 'Otro agente vegetal'),
(1416, '18.02.00.00', 'Animales - dom?sticos y de cr?a'),
(1417, '18.02.01.00', 'Invertebrados'),
(1418, '18.02.02.00', 'Peces'),
(1419, '18.02.03.00', 'Anfibios'),
(1420, '18.02.04.00', 'Aves'),
(1421, '18.02.05.00', 'Mam?feros dom?sticos'),
(1422, '18.02.05.01', 'Porcinos'),
(1423, '18.02.05.02', 'Bovinos'),
(1424, '18.02.05.03', 'Ovinos'),
(1425, '18.02.05.04', 'Caballos'),
(1426, '18.02.05.05', 'Perros, gatos'),
(1427, '18.02.05.06', 'Ratones, ratas'),
(1428, '18.02.99.00', 'Otros animales dom?sticos o de cr?a'),
(1429, '18.03.00.00', 'Animales - salvajes, insectos, serpientes'),
(1430, '18.03.01.00', 'Par?sitos multicelulares'),
(1431, '18.03.02.00', 'Insectos'),
(1432, '18.03.03.00', 'Ar?cnidos'),
(1433, '18.03.04.00', 'Serpientes'),
(1434, '18.03.05.00', 'Invertebrados, medusas, coral, etc.'),
(1435, '18.03.06.00', 'Peces'),
(1436, '18.03.07.00', 'Anfibios'),
(1437, '18.03.08.00', 'Aves'),
(1438, '18.03.09.00', 'Mam?feros'),
(1439, '18.03.99.00', 'Otros animales salvajes'),
(1440, '18.04.00.00', 'Microorganismos'),
(1441, '18.04.01.00', 'Par?sitos unicelulares'),
(1442, '18.04.02.00', 'Bacterias y organismos similares'),
(1443, '18.04.03.00', 'Mohos y levaduras'),
(1444, '18.04.99.00', 'Otros microorganismos'),
(1445, '18.05.00.00', 'Agentes infecciosos v?ricos'),
(1446, '18.06.00.00', 'Humanos'),
(1447, '18.99.00.00', 'Otros organismos vivos del grupo 18 pero no citados anteriormente'),
(1448, '19.00.00.00', 'Residuos en grandes cantidades'),
(1449, '19.01.00.00', 'Residuos en grandes cantidades - de materias,productos,materiales,objetos'),
(1450, '19.02.00.00', 'Residuos en grandes cantidades - de sustancias qu?micas'),
(1451, '19.03.00.00', 'Residuos en grandes cantidades-de sustancias biol?gicas,vegetales,animales'),
(1452, '19.03.01.00', 'Residuos de laboratorios, hospitales, etc.'),
(1453, '19.03.01.01', 'Sangre, orina, materias fecales'),
(1454, '19.03.01.02', 'Residuos de cultivos celulares y bacteriol?gicos'),
(1455, '19.03.01.99', 'Otros residuos de laboratorios, hospitales, etc.'),
(1456, '19.03.02.00', 'Restos de animales'),
(1457, '19.03.03.00', 'Restos de vegetales'),
(1458, '19.03.99.00', 'Otros residuos biol?gicos'),
(1459, '19.99.00.00', 'Otros residuos en grandes cantidades del grupo 19 pero no citados antes'),
(1460, '20.00.00.00', 'Fen?menos f?sicos y elementos naturales'),
(1461, '20.01.00.00', 'Fen?menos f?sicos - ruido, radiaci?n natural, luz,arco el?ctrico, presi?n'),
(1462, '20.02.00.00', 'Elementos naturales y atmosf?ricos(agua,barro,lluvia,nieve,hielo,etc)'),
(1463, '20.03.00.00', 'Cat?strofes naturales (inundaci?n, volc?n, terremoto, maremoto, fuego,etc)'),
(1464, '20.03.01.00', 'Elementos naturales (rayo, inundaci?n, tornado, etc.)'),
(1465, '20.03.02.00', 'Se?smo, erupci?n volc?nica'),
(1466, '20.03.03.00', 'Incendio, fuego'),
(1467, '20.03.99.00', 'Otra cat?strofe natural'),
(1468, '20.99.00.00', 'Otros fen?menos f?sicos y elementos del grupo 20 no citados anteriormente'),
(1469, '99.00.00.00', 'Otros agentes materiales no citados en esta clasificaci?n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_desviacion`
--

CREATE TABLE `ace_desviacion` (
  `id_desviacion` int(11) NOT NULL,
  `coddesviacion_des` varchar(4) NOT NULL,
  `desviacion_des` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_desviacion`
--

INSERT INTO `ace_desviacion` (`id_desviacion`, `coddesviacion_des`, `desviacion_des`) VALUES
(1, '00', 'Ninguna informaci?n'),
(2, '10', 'Desviaci?n por problema el?ctrico, explosi?n, fuego ? sin especificar'),
(3, '11', 'Problema el?ctrico que da lugar a descarga el?ctrica ? sin contacto f?sico'),
(4, '12', 'Problema el?ctrico que da lugar a un contacto con un elemento anormalmente en tensi?n'),
(5, '13', 'Explosi?n'),
(6, '14', 'Incendio, fuego'),
(7, '19', 'Otra Desviaci?n conocida del grupo 1 pero no mencionada anteriormente'),
(8, '20', 'Desviaci?n por desbordamiento, vuelco, escape, derrame, emanaci?n ? sin especificar'),
(9, '21', 'En estado s?lido - desbordamiento, vuelco'),
(10, '22', 'En estado l?quido - escape, rezumamiento, derrame, salpicadura, aspersi?n'),
(11, '23', 'En estado gaseoso - vaporizaci?n, formaci?n de aerosoles, formaci?n de gases'),
(12, '24', 'Material pulverulento, emanaci?n de humos, emisi?n de polvo, part?culas'),
(13, '29', 'Otra Desviaci?n conocida del grupo 2 pero no mencionada anteriormente'),
(14, '30', 'Rotura, estallido, deslizamiento, ca?da, derrumbamiento de Agente material ? sin especificar'),
(15, '31', 'Rotura de material, en las juntas, en las conexiones'),
(16, '32', 'Rotura, estallido, en fragmentos (madera, cristal, metal, piedra, otros)'),
(17, '33', 'Deslizamiento, ca?da, derrumbamiento de Agente material ? que cae de arriba sobre el trabajador'),
(18, '34', 'Ca?da, derrumbamiento de Agente material ? sobre el que est? el trabajador que cae'),
(19, '35', 'Deslizamiento, ca?da, ca?da, derrumbamiento de Agente material ? que se vuelca sobre el trabajador'),
(20, '39', 'Otra Desviaci?n conocida del grupo 3 pero no mencionada anteriormente'),
(21, '40', 'P?rdida de control total o parcial de equipos de trabajo o materiales ? sin especificar'),
(22, '41', 'P?rdida (total o parcial) de control - de m?quina, incluido el arranque intempestivo, as? como de la materia sobre la que se trabaje con la m?quina'),
(23, '42', 'P?rdida (total o parcial) de control ? de medio de transporte, o de equipo de carga, con o sin motor'),
(24, '43', 'P?rdida (total o parcial) de control - de herramienta manual con motor o sin motor, as? como de la materia sobre la que se trabaje con la herramienta'),
(25, '44', 'P?rdida (total o parcial) de control ? del objeto o material (transportado, desplazado, manipulado, etc.)'),
(26, '45', 'P?rdida de control (total o parcial) ? de animales que se encuentran bajo la supervisi?n de cuidadores'),
(27, '49', 'Otra Desviaci?n conocida del grupo 4 pero no mencionada anteriormente'),
(28, '50', 'Ca?da de personas ? Resbal?n o tropez?n con ca?da ? sin especificar'),
(29, '51', 'Ca?da de una persona - desde una altura'),
(30, '52', 'Ca?da de una persona - al mismo nivel'),
(31, '59', 'Otra Desviaci?n conocida del grupo 5 pero no mencionada anteriormente'),
(32, '60', 'Movimiento del cuerpo sin esfuerzo f?sico a?adido ? sin especificar'),
(33, '61', 'Pisar un objeto cortante o punzante'),
(34, '62', 'Arrodillarse, sentarse, apoyarse contra'),
(35, '63', 'Quedar atrapado, ser arrastrado, por alg?n elemento o por el impulso de este'),
(36, '64', 'Movimientos no coordinados, gestos intempestivos, inoportunos'),
(37, '69', 'Otra Desviaci?n conocida del grupo 6 pero no mencionada anteriormente'),
(38, '70', 'Movimiento del cuerpo como consecuencia de o con esfuerzo f?sico ? sin especificar'),
(39, '71', 'Levantar, transportar, levantarse'),
(40, '72', 'Empujar, tirar de'),
(41, '73', 'Depositar una carga, un objeto, agacharse'),
(42, '74', 'Al girarse o manipular en rotaci?n, en torsi?n de una carga, un objeto'),
(43, '75', 'Caminar con dificultad, traspi?s, tropez?n sin ca?da, resbal?n sin ca?da'),
(44, '79', 'Otra Desviaci?n conocida del grupo 7 pero no mencionada anteriormente'),
(45, '80', 'Sorpresa, miedo, violencia, agresi?n, amenaza, presencia ? sin especificar'),
(46, '81', 'Sorpresa, miedo'),
(47, '82', 'Violencia, agresi?n, amenaza - entre miembros de la empresa'),
(48, '83', 'Violencia, agresi?n, amenaza - ejercida por personas ajenas a la empresa'),
(49, '84', 'Agresi?n, golpes ? por animales no supervisados por un cuidador'),
(50, '85', 'Presencia de la v?ctima o de una tercera persona que represente un peligro'),
(51, '89', 'Otra Desviaci?n conocida del grupo 8 pero no mencionada anteriormente'),
(52, '99', 'Otra Desviaci?n no codificada en esta clasificaci?n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_formacontacto`
--

CREATE TABLE `ace_formacontacto` (
  `id_formacontacto` int(11) NOT NULL,
  `codformacont_fc` varchar(4) NOT NULL,
  `formacontacto_fc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_formacontacto`
--

INSERT INTO `ace_formacontacto` (`id_formacontacto`, `codformacont_fc`, `formacontacto_fc`) VALUES
(1, '00', 'Ninguna informaci?n'),
(2, '10', 'Contacto el?ctrico, con fuego, temperaturas o sustancias peligrosas ? sin especificar'),
(3, '11', 'Contacto con un arco el?ctrico o rayo (pasivo) (sin contacto material con el elemento)'),
(4, '12', 'Contacto directo con la electricidad, recibir una descarga el?ctrica'),
(5, '13', 'Contacto con llamas directas u objetos o entornos con elevadas temperaturas'),
(6, '14', 'Contacto con objeto o entorno fr?o o helado'),
(7, '15', 'Contacto con sustancias peligrosas - a trav?s de la nariz, la boca, por inhalaci?n'),
(8, '16', 'Contacto con sustancias peligrosas - a trav?s de la piel y de los ojos'),
(9, '17', 'Contacto con sustancias peligrosas - a trav?s del sistema digestivo tragando'),
(10, '19', 'Otro Contacto conocido del grupo 1 no mencionado anteriormente'),
(11, '20', 'Ahogamiento, quedar sepultado, quedar envuelto ? sin especificar'),
(12, '21', 'Ahogamiento en un l?quido'),
(13, '22', 'Quedar sepultado bajo un s?lido'),
(14, '23', 'Estar envuelto por, rodeado de gases o de part?culas en suspensi?n'),
(15, '29', 'Otro Contacto conocido del grupo 2 no mencionado anteriormente'),
(16, '30', 'Golpe contra un objeto inm?vil, trabajador en movimiento ? sin especificar'),
(17, '31', 'Golpe sobre o contra resultado de una ca?da del trabajador'),
(18, '32', 'Golpe resultado de un tropiezo sobre o contra un objeto inm?vil'),
(19, '39', 'Otro Contacto conocido del grupo 3 no mencionado anteriormente'),
(20, '40', 'Choque o golpe contra un objeto en movimiento, colisi?n con ? sin especificar'),
(21, '41', 'Choque o golpe contra un objeto o fragmentos ? proyectados'),
(22, '42', 'Choque o golpe contra un objeto ? que cae o se desprende'),
(23, '43', 'Choque o golpe contra un objeto ?  en balanceo o giro'),
(24, '44', 'Choque o golpe contra un objeto, incluidos los veh?culos ? trabajador inm?vil'),
(25, '45', 'Colisi?n con un objeto, veh?culo o persona ? trabajador en movimiento'),
(26, '46', 'Golpe de mar'),
(27, '49', 'Otro Contacto conocido del grupo 4 no mencionado anteriormente'),
(28, '50', 'Contacto con Agente material, cortante, punzante, duro ? sin especificar'),
(29, '51', 'Contacto con un Agente material cortante ?  cuchillo, hoja, etc.'),
(30, '52', 'Contacto con un Agente material punzante ? clavo, herramienta afilada, etc.'),
(31, '53', 'Contacto con un Agente material que ara?e ? rallador, lija ?  o duro'),
(32, '59', 'Otro Contacto conocido del grupo 5 no mencionado anteriormente'),
(33, '60', 'Quedar atrapado, ser aplastado, sufrir una amputaci?n ? sin especificar'),
(34, '61', 'Quedar atrapado, ser aplastado ? en algo en movimiento'),
(35, '62', 'Quedar atrapado, ser aplastado ? bajo algo en movimiento'),
(36, '63', 'Quedar atrapado, quedar aplastado ? entre algo en movimiento y otro objeto'),
(37, '64', 'Amputaci?n, seccionamiento de un miembro, una mano o un dedo'),
(38, '69', 'Otro Contacto conocido del grupo 6 no mencionado anteriormente'),
(39, '70', 'Sobreesfuerzo, trauma ps?quico, radiaciones, ruido, etc. ? sin especificar'),
(40, '71', 'Sobreesfuerzo f?sico - sobre el sistema musculoesquel?tico'),
(41, '72', 'Exposici?n a radiaciones, ruido, luz o presi?n'),
(42, '73', 'Trauma ps?quico'),
(43, '79', 'Otro Contacto conocido del grupo 7 no mencionado anteriormente'),
(44, '80', 'Mordeduras, patadas, etc. (de animales o personas) ? sin especificar'),
(45, '81', 'Mordeduras, ara?azos'),
(46, '82', 'Picadura de un insecto, un pez'),
(47, '83', 'Golpes, patadas, cabezazos, estrangulamiento, etc.'),
(48, '89', 'Otro Contacto conocido del grupo 8 no mencionado anteriormente'),
(49, '90', 'Infartos, derrames cerebrales y otras patolog?as no traum?ticas'),
(50, '99', 'Otros Contacto no codificado en la presente clasificaci?n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_gravedad`
--

CREATE TABLE `ace_gravedad` (
  `id_gravedad` int(11) NOT NULL,
  `codgravedad_gr` int(11) NOT NULL,
  `gravedad_gr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_gravedad`
--

INSERT INTO `ace_gravedad` (`id_gravedad`, `codgravedad_gr`, `gravedad_gr`) VALUES
(1, 1, 'Leve'),
(2, 2, 'Grave'),
(3, 3, 'Muy Grave'),
(4, 4, 'Mortal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_partecuerpo`
--

CREATE TABLE `ace_partecuerpo` (
  `id_partecuerpo` int(11) NOT NULL,
  `codpartecuerpo_pc` varchar(4) NOT NULL,
  `partecuerpo_pc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_partecuerpo`
--

INSERT INTO `ace_partecuerpo` (`id_partecuerpo`, `codpartecuerpo_pc`, `partecuerpo_pc`) VALUES
(1, '00', 'Parte del cuerpo afectada sin especificar'),
(2, '10', 'Cabeza - sin especificar'),
(3, '11', 'Cabeza cerebro, nervios craneanos y vasos cerebrales'),
(4, '12', 'Zona facial'),
(5, '13', 'Ojo(s)'),
(6, '14', 'Oreja(s)'),
(7, '15', 'Dientes'),
(8, '18', 'Cabeza, múltiples partes afectadas'),
(9, '19', 'Cabeza, otras partes no mencionadas anteriormente'),
(10, '20', 'Cuello - sin especificar'),
(11, '21', 'Cuello, incluida la columna y las vértebras cervicales'),
(12, '29', 'Cuello, otras partes no mencionadas anteriomente'),
(13, '30', 'Espalda, incluida la columna y las vértebras dorsolumbares ? sin especificar'),
(14, '31', 'Espalda, incluida la columna y las vértebras dorsolumbares'),
(15, '39', 'Espalda, otras partes no mencionadas anteriomente'),
(16, '40', 'Tronco y órganos - sin especificar'),
(17, '41', 'Caja torácica, costillas, incluidos omoplatos y articulaciones acromioclaviculares'),
(18, '42', 'Región torácica, incluidos sus órganos'),
(19, '43', 'Región pélvica y abdominal, incluidos sus órganos'),
(20, '48', 'Tronco, múltiples partes afectadas'),
(21, '49', 'Tronco, otras partes no mencionadas anteriormente'),
(22, '50', 'Extremidades superiores - sin especificar'),
(23, '51', 'Hombro y articulaciones del húmero'),
(24, '52', 'Brazo, incluida la articulación del cúbito'),
(25, '53', 'Mano'),
(26, '54', 'Dedo(s)'),
(27, '55', 'Muñeca'),
(28, '58', 'Extremidades superiores, múltiples partes afectadas'),
(29, '59', 'Extremidades superiores, otras partes no mencionadas anteriormente'),
(30, '60', 'Extremidades inferiores - sin especificar'),
(31, '61', 'Cadera y articulación de la cadera'),
(32, '62', 'Pierna, incluida la rodilla'),
(33, '63', 'Tobillo'),
(34, '64', 'Pie'),
(35, '65', 'Dedo(s) del pie'),
(36, '68', 'Extremidades inferiores, múltiples partes afectadas'),
(37, '69', 'Extremidades inferiores, otras partes no mencionadas anteriormente'),
(38, '70', 'Todo el cuerpo y múltiples partes - sin especificar'),
(39, '71', 'Todo el cuerpo (efectos sistémicos)'),
(40, '78', 'Múltiples partes del cuerpo afectadas'),
(41, '99', 'Otras partes del cuerpo afectadas, no mencionadas anteriormente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_tipoaccidente`
--

CREATE TABLE `ace_tipoaccidente` (
  `id_tipoaccidente` int(11) NOT NULL,
  `codtipoaccidente_ta` int(11) NOT NULL,
  `tipoaccidente_ta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_tipoaccidente`
--

INSERT INTO `ace_tipoaccidente` (`id_tipoaccidente`, `codtipoaccidente_ta`, `tipoaccidente_ta`) VALUES
(1, 1, 'Accidente con baja'),
(2, 2, 'Accidente sin baja'),
(3, 3, 'Accidente in itinere');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_tipolesion`
--

CREATE TABLE `ace_tipolesion` (
  `id_tipolesion` int(11) NOT NULL,
  `codtipolesion_tl` varchar(5) NOT NULL,
  `tipolesion_tl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_tipolesion`
--

INSERT INTO `ace_tipolesion` (`id_tipolesion`, `codtipolesion_tl`, `tipolesion_tl`) VALUES
(1, '000', 'Lesi?n desconocida'),
(2, '010', 'Heridas y lesiones superficiales'),
(3, '011', 'Lesiones superficiales y cuerpos extra?os en los ojos'),
(4, '012', 'Heridas abiertas'),
(5, '019', 'Otros tipos de heridas y lesiones superficiales'),
(6, '020', 'Fracturas de huesos'),
(7, '021', 'Fracturas cerradas'),
(8, '022', 'Fracturas abiertas'),
(9, '029', 'Otras fracturas'),
(10, '030', 'Dislocaciones, esguinces y distensiones'),
(11, '031', 'Dislocaciones y subluxaciones'),
(12, '032', 'Esguinces y torceduras'),
(13, '039', 'Otros tipos de dislocaciones, esguinces y distensiones'),
(14, '040', 'Amputaciones traum?ticas, p?rdidas de partes del cuerpo'),
(15, '050', 'Conmoci?n y lesiones internas'),
(16, '051', 'Conmoci?n y lesiones intracraneales'),
(17, '052', 'Lesiones internas'),
(18, '059', 'Otros tipos de conmoci?n y lesiones internas'),
(19, '060', 'Quemaduras, escaldaduras y congelaci?n'),
(20, '061', 'Quemaduras y escaldaduras (t?rmicas)'),
(21, '062', 'Quemaduras qu?micas (corrosi?n)'),
(22, '063', 'Congelaci?n'),
(23, '069', 'Otros tipos de quemaduras, escaldaduras y congelaci?n'),
(24, '070', 'Envenenamientos e infecciones'),
(25, '071', 'Envenenamientos agudos'),
(26, '072', 'Infecciones agudas'),
(27, '073', 'COVID-19'),
(28, '079', 'Otros tipos de envenenamientos e infecciones'),
(29, '080', 'Ahogamiento y asfixia'),
(30, '081', 'Asfixia'),
(31, '082', 'Ahogamiento y sumersiones no mortales'),
(32, '089', 'Otros tipos de ahogamiento y asfixia'),
(33, '090', 'Efectos del ruido, la vibraci?n y la presi?n'),
(34, '091', 'P?rdida auditiva aguda'),
(35, '092', 'Efectos de la presi?n (barotrauma)'),
(36, '099', 'Otros efectos agudos del ruido, la vibraci?n y la presi?n'),
(37, '100', 'Efectos de las temperaturas extremas, la luz y la radiaci?n'),
(38, '101', 'Calor e insolaci?n'),
(39, '102', 'Efectos de la radiaci?n no t?rmica (rayos X, sustancias radioactivas, etc)'),
(40, '103', 'Efectos de las bajas temperaturas'),
(41, '109', 'Otros efectos de las temperaturas extremas, la luz y la radiaci?n'),
(42, '110', 'Da?os psicol?gicos, choques traum?ticos'),
(43, '111', 'Da?os psicol?gicos debidos a agresiones o amenazas'),
(44, '112', 'Choques traum?ticos (el?ctricos, provocados por un rayo, etc)'),
(45, '119', 'Otros tipos de choques (desastres naturales, choque anafil?ctico, etc)'),
(46, '120', 'Lesiones m?ltiples'),
(47, '130', 'Infartos, derrames cerebrales y otras patolog?as no traum?ticas'),
(48, '999', 'Otras lesiones especificadas no incluidas en otros apartados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_tipolugar`
--

CREATE TABLE `ace_tipolugar` (
  `id_tipolugar` int(11) NOT NULL,
  `codtipolugar_tl` int(5) NOT NULL,
  `tipolugar_tl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_tipolugar`
--

INSERT INTO `ace_tipolugar` (`id_tipolugar`, `codtipolugar_tl`, `tipolugar_tl`) VALUES
(1, 0, 'Ninguna informaci?n'),
(2, 10, 'Zonas industriales ? sin especificar'),
(3, 11, 'Lugar de producci?n, taller, f?brica'),
(4, 12, '?rea de mantenimiento, taller de reparaci?n'),
(5, 13, '?rea destinada principalmente a almacenamiento, carga, descarga'),
(6, 19, 'Otros Tipos de lugar conocidos del grupo 01 no mencionados anteriormente'),
(7, 20, 'Obras, construcci?n, cantera, mina a cielo abierto ? sin especificar'),
(8, 21, 'Obras ? edificio en construcci?n'),
(9, 22, 'Obras - edificio en demolici?n, renovaci?n o mantenimiento'),
(10, 23, 'Cantera, minas a cielo abierto, excavaci?n, zanja'),
(11, 24, 'Obras subterr?neas'),
(12, 25, 'Obras en el agua'),
(13, 26, 'Obras en medio hiperb?rico, bajo el agua'),
(14, 29, 'Otros Tipos de lugar conocidos del grupo 02 no mencionados anteriormente'),
(15, 30, 'Lugares agr?colas, ganaderos, forestales, de piscicultura ? sin especificar'),
(16, 31, 'Lugares de cr?a de animales'),
(17, 32, 'Lugares agr?colas ? cultivo del suelo'),
(18, 33, 'Lugares agr?colas - cultivo de ?rboles y arbustos'),
(19, 34, 'Zonas forestales'),
(20, 35, 'Zonas pisc?colas, pesca, acuicultura (no a bordo de un barco)'),
(21, 36, 'Jardines, parques, jardines bot?nicos, parques zool?gicos'),
(22, 39, 'Otros Tipos de lugar conocidos del grupo 03 no mencionados anteriormente'),
(23, 40, 'Lugares del sector servicios, oficinas, zonas de ocio, etc ? sin especificar'),
(24, 41, 'Oficinas, salas de reuni?n, bibliotecas, etc.'),
(25, 42, 'Centros de ense?anza, escuelas, institutos, universidades, guarder?as'),
(26, 43, 'Lugares de venta, peque?os o grandes (incluida la venta ambulante)'),
(27, 44, 'Restaurantes, lugares de ocio, de alojamiento (incluidos museos, ferias, etc.)'),
(28, 49, 'Otros Tipos de lugar conocidos del grupo 04 no mencionados anteriormente'),
(29, 50, 'Centros sanitarios ? sin especificar'),
(30, 51, 'Centros sanitarios, cl?nicas privadas, hospitales, centros geri?tricos'),
(31, 59, 'Otros Tipos de lugar conocidos del grupo 05 no mencionados anteriormente'),
(32, 60, 'Lugares p?blicos, medios de transporte ? sin especificar'),
(33, 61, 'Lugares p?blicos, v?as de acceso, de circulaci?n, aeropuerto, estaci?n, etc'),
(34, 62, 'Medios de transporte terrestre: carretera o ferrocarril ? privado o p?blico'),
(35, 63, 'Zona aneja a lugares p?blicos con acceso reservado al personal autorizado'),
(36, 69, 'Otros Tipos de lugar conocidos del grupo 06 no mencionados anteriormente'),
(37, 70, 'Domicilios ? sin especificar'),
(38, 71, 'Domicilio privado'),
(39, 72, 'Partes comunes, anexos, jardines colindantes privados'),
(40, 79, 'Otros Tipos de lugar conocidos del grupo 07 no mencionados anteriormente'),
(41, 80, 'Lugares de actividades deportivas ? sin especificar'),
(42, 81, 'En el interior ? salas de actividades deportivas, gimnasios, piscinas cubiertas'),
(43, 82, 'En el exterior ? terrenos de deporte, piscinas, pistas de esqu?'),
(44, 89, 'Otros Tipos de lugar conocidos del grupo 08 no mencionados anteriormente'),
(45, 90, 'En el aire, elevados ? con excepci?n de las obras ? sin especificar'),
(46, 91, 'Elevados ? en una superficie fija (tejados, terrazas, etc.)'),
(47, 92, 'Elevados ? m?stiles, torres, plataformas suspendidas'),
(48, 93, 'En el aire ? a bordo de una aeronave, etc.'),
(49, 99, 'Otros Tipos de lugar conocidos del grupo 09 no mencionados anteriormente'),
(50, 100, 'Subterr?neos ? con excepci?n de las obras ? sin especificar'),
(51, 101, 'Subterr?neos ? t?neles (carretera, tren, metro)'),
(52, 102, 'Subterr?neos ? minas'),
(53, 103, 'Subterr?neos ? alcantarillas'),
(54, 109, 'Otros Tipos de lugar conocidos del grupo 10 no mencionados anteriormente'),
(55, 110, 'En el agua, a bordo de todo tipo de nav?os, excepto obras ? sin especificar'),
(56, 111, 'Mares, oc?anos, a bordo de todo tipo de nav?os, plataformas, buques, barcos'),
(57, 112, 'Lagos, r?os, puertos ? a bordo de todo tipo de nav?os, plataformas, buques, barcos'),
(58, 119, 'Otros Tipos de lugar conocidos del grupo 11 no mencionados anteriormente'),
(59, 120, 'En medio hiperb?rico, bajo el agua ? excepto obras ? sin especificar'),
(60, 121, 'En medio hiperb?rico ? bajo el agua (inmersiones, etc.)'),
(61, 122, 'En medio hiperb?rico ? c?mara hiperb?rica'),
(62, 129, 'Otros Tipos de lugar conocidos del grupo 12 no mencionados anteriormente'),
(63, 999, 'Otros Tipos de Lugar no codificados en esta clasificaci?n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ace_tipotrabajo`
--

CREATE TABLE `ace_tipotrabajo` (
  `id_tipotrabajo` int(11) NOT NULL,
  `codigo_tt` varchar(3) NOT NULL,
  `tipotrabajo_tt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ace_tipotrabajo`
--

INSERT INTO `ace_tipotrabajo` (`id_tipotrabajo`, `codigo_tt`, `tipotrabajo_tt`) VALUES
(1, '0', 'Ninguna información sin especificar'),
(2, '10', 'Tareas de producción, transformación, almacenamiento sin especificar'),
(3, '11', 'Producción, transformación, tratamiento de todo tipo'),
(4, '12', 'Almacenamiento de todo tipo  '),
(5, '19', 'Otros Tipos de trabajo conocidos del grupo 1 no mencionados anteriormente'),
(6, '20', 'Movimiento de tierras, construcción, demolición  sin especificar'),
(7, '21', 'Movimiento de tierras'),
(8, '22', 'Nueva construcción edificios'),
(9, '23', 'Nueva construcción obras de fábrica, carreteras, puentes, presas, puertos'),
(10, '24', 'Renovación, reparación, agregación, mantenimiento -  todo tipo de construcciones'),
(11, '25', 'Demolici?n de todo tipo de construcciones'),
(12, '29', 'Otros Tipos de trabajo conocidos del grupo 2 no mencionados anteriormente'),
(13, '30', 'Labores agr?colas, forestales, ganaderas, pisc?colas ? sin especificar'),
(14, '31', 'Labores de tipo agr?cola - trabajos de la tierra'),
(15, '32', 'Labores de tipo agr?cola - con vegetales, horticultura'),
(16, '33', 'Labores de tipo ganaderas - con animales vivos'),
(17, '34', 'Labores de tipo forestal'),
(18, '35', 'Labores de tipo pisc?cola, pesca'),
(19, '39', 'Otros Tipos de trabajo conocidos del grupo 3 no mencionados anteriormente'),
(20, '40', 'Servicios a empresas o a personal y trabajos intelectuales ? sin especificar'),
(21, '41', 'Servicios, atenci?n sanitaria, asistencia a personas'),
(22, '42', 'Actividades intelectuales, oficinas, ense?anza, tratamiento de la informaci?n'),
(23, '43', 'Actividades comerciales - compra, venta, servicios relacionados'),
(24, '49', 'Otros Tipos de trabajo conocidos del grupo 4 no mencionados anteriormente'),
(25, '50', 'Tareas de instalaci?n, mantenimiento, limpieza, gesti?n de residuos, vigilancia ? sin especificar'),
(26, '51', 'Instalaci?n, colocaci?n, preparaci?n'),
(27, '52', 'Mantenimiento, reparaci?n, reglaje, puesta a punto'),
(28, '53', 'Limpieza de locales, de m?quinas - industrial o manual'),
(29, '54', 'Gesti?n de residuos, desecho, tratamiento de residuos de todo tipo'),
(30, '55', 'Vigilancia, inspecci?n de procesos de fabricaci?n, locales, medios de transporte'),
(31, '59', 'Otros Tipos de trabajo conocidos del grupo 5 no mencionados anteriormente'),
(32, '60', 'Circulaci?n, actividades deportivas y art?sticas ? sin especificar'),
(33, '61', 'Circulaci?n, incluso en los medios de transporte'),
(34, '62', 'Actividades deportivas y art?sticas'),
(35, '69', 'Otros Tipos de trabajo conocidos del grupo 6 no mencionados anteriormente'),
(36, '99', 'Otros tipos de trabajo no codificados en esta clasificaci?n ? sin especificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ag_acciones`
--

CREATE TABLE `ag_acciones` (
  `id_accion` int(11) NOT NULL,
  `codigo_acc` varchar(255) NOT NULL,
  `fecha_acc` date NOT NULL,
  `centro_acc` int(11) NOT NULL,
  `descripcion_acc` varchar(255) NOT NULL,
  `responsable_acc` varchar(255) NOT NULL,
  `medida_acc` text NOT NULL,
  `fechaprevista_acc` date NOT NULL,
  `fecharea_acc` date NOT NULL,
  `fechaveri_acc` date NOT NULL,
  `avance_acc` varchar(5) NOT NULL,
  `estado_acc` varchar(255) NOT NULL,
  `accpropuesta_acc` text NOT NULL,
  `accrealizada_acc` text NOT NULL,
  `seguimiento_acc` text NOT NULL,
  `recursos_acc` int(11) NOT NULL,
  `imagen1_acc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `imagen2_acc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ag_acciones`
--

INSERT INTO `ag_acciones` (`id_accion`, `codigo_acc`, `fecha_acc`, `centro_acc`, `descripcion_acc`, `responsable_acc`, `medida_acc`, `fechaprevista_acc`, `fecharea_acc`, `fechaveri_acc`, `avance_acc`, `estado_acc`, `accpropuesta_acc`, `accrealizada_acc`, `seguimiento_acc`, `recursos_acc`, `imagen1_acc`, `imagen2_acc`) VALUES
(1, 'N/A', '2024-01-01', 4, 'Sin accion', 'n/a', 'n/a', '2024-01-01', '2024-01-01', '2024-01-01', '100%', 'Cerrada', 'n/A', 'n/a', 'n/a', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ag_actividad`
--

CREATE TABLE `ag_actividad` (
  `id_actividad` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  `fecha_acc` date NOT NULL,
  `horain_acc` time NOT NULL,
  `horafin_acc` time NOT NULL,
  `horas_acc` time NOT NULL,
  `responsable_acc` varchar(255) NOT NULL,
  `detalles_acc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ag_actividad`
--

INSERT INTO `ag_actividad` (`id_actividad`, `id_tarea`, `fecha_acc`, `horain_acc`, `horafin_acc`, `horas_acc`, `responsable_acc`, `detalles_acc`) VALUES
(1, 6, '2023-12-06', '17:33:40', '20:33:40', '00:00:00', 'Emili Vives', 'Realizar listados de siniestralidad, busqueda de valores segun mutua'),
(2, 4, '2023-12-18', '20:53:49', '22:53:49', '00:00:00', 'Emili Vives', 'Crear programacion anual'),
(3, 4, '2023-12-06', '15:42:25', '18:42:25', '00:00:00', 'Emili', 'Imprimir y colgar en servidor'),
(4, 4, '2023-12-07', '13:43:00', '15:43:00', '00:00:00', 'Emili', 'Proga'),
(5, 4, '2023-12-15', '12:45:00', '14:45:00', '00:00:00', 'Maria Jose', 'Detalles proba'),
(6, 4, '2023-12-14', '13:47:00', '16:47:00', '00:00:00', 'Emili', ''),
(7, 4, '2023-12-07', '14:52:00', '20:52:00', '00:00:00', 'Emili', 'Proba 2'),
(8, 4, '2023-12-14', '12:12:00', '13:13:00', '00:00:00', 'Maria Jose', 'Progba 55'),
(9, 4, '2023-12-15', '14:43:00', '19:40:00', '00:00:00', 'Maria Jose', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ag_proyecto`
--

CREATE TABLE `ag_proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_py` varchar(255) NOT NULL,
  `responsable_py` int(11) NOT NULL,
  `descripcion_py` text NOT NULL,
  `estado_py` int(11) NOT NULL,
  `fechainicio_py` date NOT NULL,
  `fechafin_py` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ag_proyecto`
--

INSERT INTO `ag_proyecto` (`id_proyecto`, `nombre_py`, `responsable_py`, `descripcion_py`, `estado_py`, `fechainicio_py`, `fechafin_py`) VALUES
(1, 'Actividad Anual 2024', 1, 'Actividad preventiva de TRASMAPI (servicios y concesiones maritimas ibicencas S.A.)', 1, '2024-01-01', '2024-12-31'),
(2, 'Revision equipos', 2, 'REvision equipos de trabjo', 1, '2023-11-07', '2023-11-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ag_tareas`
--

CREATE TABLE `ag_tareas` (
  `id_tarea` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `nombre_ta` varchar(255) NOT NULL,
  `fecha_ta` date NOT NULL,
  `fechareal_ta` date NOT NULL,
  `centro_ta` int(11) NOT NULL,
  `responsable_ta` int(11) NOT NULL,
  `prioridad_ta` varchar(255) NOT NULL,
  `estado_ta` varchar(255) NOT NULL,
  `programada_ta` tinyint(1) NOT NULL,
  `detalles_ta` text NOT NULL,
  `categoria_ta` varchar(255) NOT NULL,
  `accionprl_ta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ag_tareas`
--

INSERT INTO `ag_tareas` (`id_tarea`, `id_proyecto`, `nombre_ta`, `fecha_ta`, `fechareal_ta`, `centro_ta`, `responsable_ta`, `prioridad_ta`, `estado_ta`, `programada_ta`, `detalles_ta`, `categoria_ta`, `accionprl_ta`) VALUES
(4, 1, 'Programacion anual', '2023-11-09', '2023-11-09', 4, 1, 'alta', 'Completado', 1, 'detalles de la tarea con su descripciones', 'documentos', 1),
(5, 2, 'Listar equipos', '2023-11-15', '2023-11-14', 5, 1, 'Baja', 'En curso', 1, 'Listar aquellos equipos de trabajo que haya en el centro', 'Seguridad', 1),
(6, 1, 'Listado siniestralidad', '2023-11-09', '2023-11-21', 4, 1, 'Media', 'En curso', 1, 'Mostrar datos estadisticos de la siniestralidad del año anterior', 'Documentos', 1),
(14, 1, 'Revision extintores', '2023-12-19', '2023-12-19', 4, 4, 'Media', 'Completado', 0, 'Revision extintores de co2', 'Seguridad', 1),
(15, 1, 'Evaluacion buque', '2023-12-12', '2023-12-12', 5, 3, 'Media', 'En curso', 1, '', 'Seguridad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(50) NOT NULL,
  `departamento_cat` varchar(50) NOT NULL,
  `descripcion_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_cat`, `departamento_cat`, `descripcion_cat`) VALUES
(1, 'Administracion', 'Administracion', 'Puestos de trabajo incluidos: Responsable SGI, Responsable RRHH, Administrativo RRHH, Administrativo Técnico, Administrativo comercial, Responsable Opto. Marketing, Administrativo marketing, Diseñador/a gráfico, Responsable Opto. Calidad, Administrativo contable, Responsable Opto. Compras, Administrativo compras, Administrativo Informático, administrativo Call Centre y administrativo.\r\nLa definición de trabajos y funciones especificas de cada uno de los puestos se definen en el documento R1-03-A (Tabla definición puestos) del Sistema de Gestión Integrada de la empresa.\r\nEl puesto de trabajo concierne a trabajadores de distintos departamentos con riesgos similares aunque realizan trabajos administrativos de diferentes índoles.\r\nLas funciones genéricas establecidas dentro del puesto de trabajo de administración incluyen: Gestionar (recibir, redactar, transcribir, clasificar, registrar, distribuir, etc.) documentos, informes o escritos, correspondencia, actas administrativas, etc., utilizando para ello ordenador personal, fax, teléfono, etc. Uso de pantallas de visualización de datos. Planificar, dirigir y coordinar diariamente las actividades relativas a la empresa asegurando la utilización racional de los recursos y el cumplimiento de las normas. Negociar, vender y contratar equipos, aparatos e instrumentos técnicos, productos, repuestos, etc., así como servicios\r\ndiversos a empresas y a clientes particulares. Atender llamadas telefónicas y/o correos electrónicos, solicitando información, citas,\r\nentrevistas ... Establecer la comunicación entre el solicitante y la persona a quien va dirigida la llamada . . Asimismo, puede realizar labores\r\nde información, orientación. En ocasiones pueden realizar desplazamientos al exterior mediante vehículos, transporte público o andando.'),
(2, 'Marinero', 'Embarcado', 'La definicion de trabajos y  funciones especificas de cada uno de los puestos se definen en el documento R1-03-A (Tabla definición puestos) del Sistema de Gestion Integrada de la empresa. Actividad:  A las órdenes del primer oficial, tiene asignadas las funciones siguientes asumiendo sus responsabilidades: • Mantenimiento de los equipos de cubierta y casco. • Maniobras de atraque • Embarque y desembarque del pasaje • Estiba del equipaje incluido la ayuda al pasajero con su equipaje en las rampas de acceso. • Atención al pasaje, transmitir cualquier incidencia al primer oficial, • Limpieza general • Otras funciones generales de marinería que le sean encomendadas.  Condiciones de trabajo: Participa de las condiciones generales de la embarcación. En ella, existen distintas zonas: Zonas de cubierta, con distintos niveles a los que se accede por escaleras de servicio. Zonas de proa y popa en donde existen diferentes elementos para hacer firme como molinetes, bozas, cabos, cornamusas, bitas, etc. Zonas de pasaje. Están ubicadas en cubierta principal y superior. Hay una zona abierta y otras cerradas. Todas ellas disponen de hileras de asientos para el pasaje. De manera general, la marinería se encuentra expuesta a las condiciones climáticas exteriores, y por tanto, variables. Disponen de ropa de trabajo adecuada a las inclemencias del tiempo y a las condiciones de las distintas épocas del año. En las operaciones de atraque y desamarre, participan también de las condiciones del muelle, existiendo interacción con pasarelas, defensas del muelle, norays, etc.'),
(3, 'Amarrador', 'Puerto', 'detalles de categoria amarrador'),
(21, 'Informático', 'Administracion', 'Detalles puesto informatico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `id_centro` int(11) NOT NULL,
  `nombre_cen` varchar(100) NOT NULL,
  `empresa_cen` int(11) NOT NULL,
  `tipo_cen` int(11) NOT NULL,
  `direccion_cen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`id_centro`, `nombre_cen`, `empresa_cen`, `tipo_cen`, `direccion_cen`) VALUES
(4, 'Oficina Trasmapi', 1, 1, 'Moll pescadors S/N - Eivissa'),
(5, 'Castavi Jet', 1, 2, 'C/ Aragon, 71 - Eivissa'),
(6, 'Aires de Formentera', 2, 2, 'Ctra Sant Francesc s/n - La savina'),
(7, 'Espalmador Jet', 1, 2, 'C/ Aragón, 71 - Eivissa'),
(8, 'Illetas Jet', 1, 2, 'C/ Aragón, 71 - Eivissa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre_emp` varchar(255) NOT NULL,
  `razonsocial_emp` varchar(255) NOT NULL,
  `cif_emp` varchar(10) NOT NULL,
  `direccion_emp` varchar(255) NOT NULL,
  `modalidadprl_emp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre_emp`, `razonsocial_emp`, `cif_emp`, `direccion_emp`, `modalidadprl_emp`) VALUES
(1, 'TRASMAPI', 'SERVICIOS Y CONCESIONES MARITIMAS IBICENCAS S.A.', 'A07066749', 'C/ Aragón, 71. 07800. Eivissa (Illes Balears)', 'Mixta (Trabajador designado + SPA)'),
(2, 'FORMENTERA LINES', 'MEDITERRANEA LA NAVIERA DE FORMENTERA S.L.', 'B16620635', 'Ctra. Sant Francesc - La savina', 'SPA (Previs)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE `formacion` (
  `id_formacion` int(11) NOT NULL,
  `nroformacion` int(11) NOT NULL,
  `tipo_fr` int(11) NOT NULL,
  `fecha_fr` date NOT NULL,
  `fechacad_fr` date NOT NULL,
  `formador_fr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formacion`
--

INSERT INTO `formacion` (`id_formacion`, `nroformacion`, `tipo_fr`, `fecha_fr`, `fechacad_fr`, `formador_fr`) VALUES
(14, 1, 2, '2024-01-10', '2024-01-17', 2),
(15, 2, 1, '2024-01-09', '2024-01-10', 1),
(17, 3, 1, '2024-01-18', '2024-01-26', 1),
(20, 4, 1, '2024-01-25', '2024-01-25', 1),
(21, 11, 1, '2024-01-10', '2025-01-10', 1),
(22, 12, 1, '2023-02-08', '2024-01-11', 1),
(23, 14, 1, '2024-01-11', '2024-01-23', 1),
(24, 15, 2, '2024-01-17', '2024-01-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `form_asistencia`
--

CREATE TABLE `form_asistencia` (
  `id_formasistencia` int(11) NOT NULL,
  `nroformacion` int(11) NOT NULL,
  `idtrabajador_fas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `form_asistencia`
--

INSERT INTO `form_asistencia` (`id_formasistencia`, `nroformacion`, `idtrabajador_fas`) VALUES
(1, 1, 3),
(6, 1, 4),
(8, 1, 8),
(10, 1, 5),
(11, 1, 6),
(12, 2, 3),
(13, 2, 4),
(14, 2, 6),
(15, 3, 10),
(16, 4, 4),
(17, 11, 6),
(18, 12, 6),
(19, 12, 4),
(20, 14, 6),
(21, 15, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reconocimientos`
--

CREATE TABLE `reconocimientos` (
  `id_reconocimiento` int(11) NOT NULL,
  `id_trabajador` int(11) NOT NULL,
  `fecha_rm` date NOT NULL,
  `caducidad_rm` date NOT NULL,
  `vigente_rm` int(11) NOT NULL,
  `cita_rm` date NOT NULL,
  `anotaciones_rm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reconocimientos`
--

INSERT INTO `reconocimientos` (`id_reconocimiento`, `id_trabajador`, `fecha_rm`, `caducidad_rm`, `vigente_rm`, `cita_rm`, `anotaciones_rm`) VALUES
(1, 3, '2023-12-11', '2023-12-12', 1, '0000-00-00', ''),
(2, 8, '2023-12-14', '2023-12-28', 1, '0000-00-00', ''),
(3, 6, '2023-12-21', '2023-12-14', 0, '0000-00-00', ''),
(4, 6, '2023-12-05', '2024-01-31', 1, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables`
--

CREATE TABLE `responsables` (
  `id_responsable` int(11) NOT NULL,
  `nombre_resp` varchar(50) NOT NULL,
  `cargo_resp` varchar(50) NOT NULL,
  `email_resp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `responsables`
--

INSERT INTO `responsables` (`id_responsable`, `nombre_resp`, `cargo_resp`, `email_resp`) VALUES
(1, 'Emili Vives', 'Trabajador Designado - Responsable PRL', 'prevencion@trasmapi.com'),
(2, 'Vicente Tur', 'Responsable mantenimiento', 'v.tur@trasmapi.com'),
(3, 'Damia Torres Cerda', 'Capitán embarcacion', 'fairweather@trasmapi.com'),
(4, 'Maria Jose Planells', 'Responsable Calidad', 'm.planells@trasmapi.com'),
(5, 'Maria Robles', 'Resp. RRHH', 'm.robles@trasmapi.com'),
(6, 'Maria Perez', 'RRHH', 'm.perez@trasmapi.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_perfiles`
--

CREATE TABLE `tb_perfiles` (
  `id_perfil` int(11) NOT NULL,
  `nombre_pf` varchar(25) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_perfiles`
--

INSERT INTO `tb_perfiles` (`id_perfil`, `nombre_pf`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'ADMINISTRADOR', '2023-11-03 14:30:26', '2023-11-03 14:30:26'),
(2, 'USUARIO', '2023-11-08 15:42:01', '2023-11-08 15:42:01'),
(3, 'ALUMNO', '2023-11-08 16:10:39', '0000-00-00 00:00:00'),
(4, 'EMPLEADO', '2023-11-08 16:10:39', '2023-11-08 17:36:40'),
(5, 'RESPONSABLE', '2023-11-08 17:00:52', '2023-11-16 14:57:03'),
(6, 'ALUMNO 0', '2023-11-08 17:00:52', '2023-11-10 08:13:35'),
(7, 'ALUMNO 5', '2023-11-14 12:49:36', '0000-00-00 00:00:00'),
(8, 'ALUMNO 5', '2023-11-14 12:49:36', '0000-00-00 00:00:00'),
(9, 'ALUMNO 3', '2023-11-14 12:50:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usr` varchar(255) NOT NULL,
  `email_usr` varchar(255) NOT NULL,
  `password_usr` text NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `token_usr` varchar(11) DEFAULT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombre_usr`, `email_usr`, `password_usr`, `id_perfil`, `token_usr`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'evives', 'prevencion@trasmapi.com', '$2y$10$D1KaWpLGy9D.mcVt/IasnefWGsQztIGHXoISNm9QkUBcixxxiWYca', 1, NULL, '2023-11-03 14:30:54', '2023-11-10 11:41:06'),
(4, 'prueba2', 'asdas@asds.es', '$2y$10$I0IP94V17/VaZMbsL/cQ.eJRuwx9A5O3KYguIcacM2fJ4G1uYyfDO', 2, NULL, '2023-11-10 08:24:12', '2023-11-10 11:45:44'),
(8, 'Proba5', '123456abc@gmail.com', '$2y$10$dRRBy5oVHGdzSAfxmuKkX.CAVEdNoEYcsnrT7KfPxcqPcpc3b9LfG', 4, NULL, '2023-11-10 11:38:31', '2023-11-10 11:45:32'),
(9, 'mgomez', 'prueba@gmai.com', '$2y$10$q2CXpRA5ucNc6CGnrncHdeLuP8xsHgax/o70Rlp.S9pQsZZpuINiW', 3, NULL, '2023-11-14 13:04:59', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocentros`
--

CREATE TABLE `tipocentros` (
  `id_tipocentro` int(11) NOT NULL,
  `nombre_tc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipocentros`
--

INSERT INTO `tipocentros` (`id_tipocentro`, `nombre_tc`) VALUES
(1, 'Edificio'),
(2, 'Embarcacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoformacion`
--

CREATE TABLE `tipoformacion` (
  `id_tipoformacion` int(11) NOT NULL,
  `nombre_tf` varchar(50) NOT NULL,
  `duracion_tf` int(4) NOT NULL,
  `validez_tf` int(2) NOT NULL,
  `detalles_tf` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoformacion`
--

INSERT INTO `tipoformacion` (`id_tipoformacion`, `nombre_tf`, `duracion_tf`, `validez_tf`, `detalles_tf`) VALUES
(1, 'Puesto de trabajo 1h', 1, 3, 'Formacion de los riesgos segun el puesto de trabajo que realiza el trabajador:(LPRL 31/1995) \r\nExposición y medidas frente a los riesgos que esta expuesto el trabajador según el puesto de trabajoque realice (Conceptos generales LPRL: Normativa, derechos y obligaciones, Siniestralidad departamento / Centro /Grupo\r\nCaidas al mismo nivel\r\nCaidas a distinto nivel\r\nCaida de objetos en manipulación\r\nCorte por herramientas / útiles\r\nGolpes por objetos o herramientas\r\nProyección de fragmentos o partículas\r\nAtrapamiento por elementos de máquinas / vehículos\r\nSobresfuerzos\r\nContáctos térmicos\r\nContactos eléctricos\r\nExposición a sustancias tóxicas o nocivas, causticas o corrosivas\r\nExposicición a altas temperaturas (actuación ante el golpe de calor)\r\nIncendios – Emergneicas (uso extintores, evacuación, señalización)\r\nRuido – Vibraciones\r\nOperativas de trabajo seguro (rampas, accesos, atraque)\r\nRiesgos Psicosociales \r\nActuacion en caso de accidente\r\nRiesgos y medidas frente COVID-19 \r\nEquipos de protección individual (EPI’s)\r\nActuacion en caso de accidente\r\nVigilancia de la salud'),
(2, 'Equipos de trabajo', 2, 5, 'Detalles formacion equipos trabajo 2h');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id_trabajador` int(11) NOT NULL,
  `codigo_tr` int(11) NOT NULL,
  `dni_tr` varchar(25) NOT NULL,
  `nombre_tr` varchar(250) NOT NULL,
  `sexo_tr` varchar(1) NOT NULL,
  `fechanac_tr` date NOT NULL,
  `categoria_tr` int(11) NOT NULL,
  `inicio_tr` date NOT NULL,
  `centro_tr` int(11) NOT NULL,
  `activo_tr` int(1) NOT NULL DEFAULT 1,
  `formacionpdt_tr` date NOT NULL,
  `anotaciones_tr` text NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id_trabajador`, `codigo_tr`, `dni_tr`, `nombre_tr`, `sexo_tr`, `fechanac_tr`, `categoria_tr`, `inicio_tr`, `centro_tr`, `activo_tr`, `formacionpdt_tr`, `anotaciones_tr`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(3, 110, '47627004F', 'VIVES GARCIA, EMILI', 'H', '1979-10-03', 1, '2021-08-01', 4, 1, '0000-00-00', '0000-00-00', '2023-11-17 09:56:23', '2024-01-10 12:25:19'),
(4, 221, '12452145F', 'SANCHEZ TORRES, JOSE LUIS', 'H', '1988-11-01', 2, '2023-07-11', 7, 0, '0000-00-00', '0000-00-00', '2023-11-17 09:56:23', '2023-11-17 09:56:23'),
(5, 98898, '00001000T', 'PEREZ PEREZ, PRUEBA', 'H', '1988-11-09', 2, '2023-10-31', 4, 1, '0000-00-00', '0000-00-00', '2023-11-27 08:32:45', '2023-11-27 08:32:45'),
(6, 125855, '11244484F', 'RUIZ RUIZ, PEPE', 'H', '2023-11-14', 2, '2023-11-07', 6, 1, '0000-00-00', '0000-00-00', '2023-11-27 08:34:16', '2023-11-27 08:34:16'),
(7, 1254, '125444587S', 'SANCHEZ PERA, JOSE LUIS', 'H', '1988-06-11', 2, '2021-08-12', 7, 1, '0000-00-00', '0000-00-00', '2023-12-07 12:25:18', '2023-12-07 12:25:18'),
(8, 1009, '56855222L', 'LUENGO ROJAS, JOSE JAVIER ', 'H', '1988-12-05', 2, '2023-12-15', 7, 1, '0000-00-00', '0000-00-00', '2023-12-12 14:18:59', '2024-01-10 10:51:16'),
(9, 1885, '65532455R', 'FERNANDEZPEREZ, JOSE', 'H', '1979-12-15', 2, '2023-12-01', 5, 1, '0000-00-00', '0000-00-00', '2023-12-13 11:47:07', '2023-12-13 11:47:07'),
(10, 2556, '45875454S', 'GARCIA GARCIA, MANUEL', 'H', '1988-12-05', 2, '2023-12-15', 7, 1, '0000-00-00', '0000-00-00', '2023-12-13 11:48:08', '2023-12-13 11:48:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accidentes`
--
ALTER TABLE `accidentes`
  ADD PRIMARY KEY (`id_accidente`),
  ADD KEY `trabajador_ace` (`trabajador_ace`),
  ADD KEY `centro_ace` (`centro_ace`),
  ADD KEY `tipolugar_ace` (`tipolugar_ace`),
  ADD KEY `procesotrabajo_ace` (`procesotrabajo_ace`),
  ADD KEY `tipoactividad_ace` (`tipoactividad_ace`),
  ADD KEY `agentematerial_ace` (`agentematerial_ace`),
  ADD KEY `desviacion_ace` (`desviacion_ace`),
  ADD KEY `agmaterdesv_ace` (`agmaterdesv_ace`),
  ADD KEY `formacontacto_ace` (`formacontacto_ace`),
  ADD KEY `matercasusalesi_ace` (`matercasusalesi_ace`),
  ADD KEY `tipolesion_ace` (`tipolesion_ace`),
  ADD KEY `gradolesion_ace` (`gradolesion_ace`),
  ADD KEY `partecuerpo_ace` (`partecuerpo_ace`),
  ADD KEY `tipoaccidente_ace` (`tipoaccidente_ace`);

--
-- Indices de la tabla `ace_actividadfisica`
--
ALTER TABLE `ace_actividadfisica`
  ADD PRIMARY KEY (`id_actividadfisica`);

--
-- Indices de la tabla `ace_agentematerial`
--
ALTER TABLE `ace_agentematerial`
  ADD PRIMARY KEY (`id_agentematerial`);

--
-- Indices de la tabla `ace_desviacion`
--
ALTER TABLE `ace_desviacion`
  ADD PRIMARY KEY (`id_desviacion`);

--
-- Indices de la tabla `ace_formacontacto`
--
ALTER TABLE `ace_formacontacto`
  ADD PRIMARY KEY (`id_formacontacto`);

--
-- Indices de la tabla `ace_gravedad`
--
ALTER TABLE `ace_gravedad`
  ADD PRIMARY KEY (`id_gravedad`);

--
-- Indices de la tabla `ace_partecuerpo`
--
ALTER TABLE `ace_partecuerpo`
  ADD PRIMARY KEY (`id_partecuerpo`);

--
-- Indices de la tabla `ace_tipoaccidente`
--
ALTER TABLE `ace_tipoaccidente`
  ADD PRIMARY KEY (`id_tipoaccidente`);

--
-- Indices de la tabla `ace_tipolesion`
--
ALTER TABLE `ace_tipolesion`
  ADD PRIMARY KEY (`id_tipolesion`);

--
-- Indices de la tabla `ace_tipolugar`
--
ALTER TABLE `ace_tipolugar`
  ADD PRIMARY KEY (`id_tipolugar`);

--
-- Indices de la tabla `ace_tipotrabajo`
--
ALTER TABLE `ace_tipotrabajo`
  ADD PRIMARY KEY (`id_tipotrabajo`);

--
-- Indices de la tabla `ag_acciones`
--
ALTER TABLE `ag_acciones`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `responsble_acc` (`responsable_acc`),
  ADD KEY `centro_acc` (`centro_acc`);

--
-- Indices de la tabla `ag_actividad`
--
ALTER TABLE `ag_actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_tarea` (`id_tarea`);

--
-- Indices de la tabla `ag_proyecto`
--
ALTER TABLE `ag_proyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `responsable_py` (`responsable_py`);

--
-- Indices de la tabla `ag_tareas`
--
ALTER TABLE `ag_tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `FK_proyecto_py` (`id_proyecto`),
  ADD KEY `responsable_ta` (`responsable_ta`),
  ADD KEY `centro_ta` (`centro_ta`),
  ADD KEY `accionprl_ta` (`accionprl_ta`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id_centro`),
  ADD KEY `FK_empresa_cen` (`empresa_cen`) USING BTREE,
  ADD KEY `FK_tipo_cen` (`tipo_cen`) USING BTREE;

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD PRIMARY KEY (`id_formacion`),
  ADD KEY `tipo_fr` (`tipo_fr`),
  ADD KEY `nroformacion_fr` (`nroformacion`),
  ADD KEY `formador_fr` (`formador_fr`);

--
-- Indices de la tabla `form_asistencia`
--
ALTER TABLE `form_asistencia`
  ADD PRIMARY KEY (`id_formasistencia`),
  ADD KEY `formacion_fas` (`nroformacion`),
  ADD KEY `trabajadores_fas` (`idtrabajador_fas`);

--
-- Indices de la tabla `reconocimientos`
--
ALTER TABLE `reconocimientos`
  ADD PRIMARY KEY (`id_reconocimiento`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`id_responsable`);

--
-- Indices de la tabla `tb_perfiles`
--
ALTER TABLE `tb_perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_perfil_usr` (`id_perfil`);

--
-- Indices de la tabla `tipocentros`
--
ALTER TABLE `tipocentros`
  ADD PRIMARY KEY (`id_tipocentro`);

--
-- Indices de la tabla `tipoformacion`
--
ALTER TABLE `tipoformacion`
  ADD PRIMARY KEY (`id_tipoformacion`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id_trabajador`),
  ADD KEY `FK_categoria_tr` (`categoria_tr`),
  ADD KEY `FK_centro_tr` (`centro_tr`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accidentes`
--
ALTER TABLE `accidentes`
  MODIFY `id_accidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ace_formacontacto`
--
ALTER TABLE `ace_formacontacto`
  MODIFY `id_formacontacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `ace_gravedad`
--
ALTER TABLE `ace_gravedad`
  MODIFY `id_gravedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ace_tipoaccidente`
--
ALTER TABLE `ace_tipoaccidente`
  MODIFY `id_tipoaccidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ag_acciones`
--
ALTER TABLE `ag_acciones`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ag_actividad`
--
ALTER TABLE `ag_actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ag_proyecto`
--
ALTER TABLE `ag_proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ag_tareas`
--
ALTER TABLE `ag_tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `id_centro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `formacion`
--
ALTER TABLE `formacion`
  MODIFY `id_formacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `form_asistencia`
--
ALTER TABLE `form_asistencia`
  MODIFY `id_formasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reconocimientos`
--
ALTER TABLE `reconocimientos`
  MODIFY `id_reconocimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `responsables`
--
ALTER TABLE `responsables`
  MODIFY `id_responsable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_perfiles`
--
ALTER TABLE `tb_perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipocentros`
--
ALTER TABLE `tipocentros`
  MODIFY `id_tipocentro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoformacion`
--
ALTER TABLE `tipoformacion`
  MODIFY `id_tipoformacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accidentes`
--
ALTER TABLE `accidentes`
  ADD CONSTRAINT `accidentes_ibfk_1` FOREIGN KEY (`procesotrabajo_ace`) REFERENCES `ace_tipotrabajo` (`id_tipotrabajo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_11` FOREIGN KEY (`partecuerpo_ace`) REFERENCES `ace_partecuerpo` (`id_partecuerpo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_12` FOREIGN KEY (`tipoaccidente_ace`) REFERENCES `ace_tipoaccidente` (`id_tipoaccidente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_13` FOREIGN KEY (`trabajador_ace`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_14` FOREIGN KEY (`desviacion_ace`) REFERENCES `ace_desviacion` (`id_desviacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `accidentes_ibfk_15` FOREIGN KEY (`tipolesion_ace`) REFERENCES `ace_tipolesion` (`id_tipolesion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `accidentes_ibfk_2` FOREIGN KEY (`tipoactividad_ace`) REFERENCES `ace_actividadfisica` (`id_actividadfisica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_3` FOREIGN KEY (`tipolugar_ace`) REFERENCES `ace_tipolugar` (`id_tipolugar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_4` FOREIGN KEY (`agentematerial_ace`) REFERENCES `ace_agentematerial` (`id_agentematerial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_6` FOREIGN KEY (`agmaterdesv_ace`) REFERENCES `ace_agentematerial` (`id_agentematerial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_7` FOREIGN KEY (`formacontacto_ace`) REFERENCES `ace_formacontacto` (`id_formacontacto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_8` FOREIGN KEY (`matercasusalesi_ace`) REFERENCES `ace_agentematerial` (`id_agentematerial`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accidentes_ibfk_9` FOREIGN KEY (`gradolesion_ace`) REFERENCES `ace_gravedad` (`id_gravedad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ag_acciones`
--
ALTER TABLE `ag_acciones`
  ADD CONSTRAINT `ag_acciones_ibfk_1` FOREIGN KEY (`centro_acc`) REFERENCES `centros` (`id_centro`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `ag_actividad`
--
ALTER TABLE `ag_actividad`
  ADD CONSTRAINT `ag_actividad_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `ag_tareas` (`id_tarea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ag_proyecto`
--
ALTER TABLE `ag_proyecto`
  ADD CONSTRAINT `ag_proyecto_ibfk_1` FOREIGN KEY (`responsable_py`) REFERENCES `responsables` (`id_responsable`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `ag_tareas`
--
ALTER TABLE `ag_tareas`
  ADD CONSTRAINT `ag_tareas_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `ag_proyecto` (`id_proyecto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ag_tareas_ibfk_3` FOREIGN KEY (`centro_ta`) REFERENCES `centros` (`id_centro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ag_tareas_ibfk_4` FOREIGN KEY (`responsable_ta`) REFERENCES `responsables` (`id_responsable`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ag_tareas_ibfk_5` FOREIGN KEY (`accionprl_ta`) REFERENCES `ag_acciones` (`id_accion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `centros`
--
ALTER TABLE `centros`
  ADD CONSTRAINT `centros_ibfk_1` FOREIGN KEY (`empresa_cen`) REFERENCES `empresa` (`id_empresa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `centros_ibfk_2` FOREIGN KEY (`tipo_cen`) REFERENCES `tipocentros` (`id_tipocentro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD CONSTRAINT `formacion_ibfk_1` FOREIGN KEY (`tipo_fr`) REFERENCES `tipoformacion` (`id_tipoformacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formacion_ibfk_4` FOREIGN KEY (`nroformacion`) REFERENCES `form_asistencia` (`nroformacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `formacion_ibfk_5` FOREIGN KEY (`formador_fr`) REFERENCES `responsables` (`id_responsable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `form_asistencia`
--
ALTER TABLE `form_asistencia`
  ADD CONSTRAINT `form_asistencia_ibfk_1` FOREIGN KEY (`idtrabajador_fas`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reconocimientos`
--
ALTER TABLE `reconocimientos`
  ADD CONSTRAINT `reconocimientos_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `tb_perfiles` (`id_perfil`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`categoria_tr`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trabajadores_ibfk_2` FOREIGN KEY (`centro_tr`) REFERENCES `centros` (`id_centro`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

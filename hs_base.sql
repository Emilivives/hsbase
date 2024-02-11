-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2024 a las 08:15:44
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
(24, 15, 2, '2024-01-17', '2024-01-24', 1),
(25, 16, 2, '2024-02-08', '2024-02-23', 1);

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
(4, 'prueba2', 'asdas@asds.es', '$2y$10$I0IP94V17/VaZMbsL/cQ.eJRuwx9A5O3KYguIcacM2fJ4G1uYyfDO', 2, NULL, '2023-11-10 08:24:12', '2023-11-10 11:45:44'),
(8, 'Proba5', '123456abc@gmail.com', '$2y$10$dRRBy5oVHGdzSAfxmuKkX.CAVEdNoEYcsnrT7KfPxcqPcpc3b9LfG', 4, NULL, '2023-11-10 11:38:31', '2023-11-10 11:45:32'),
(9, 'mgomez', 'prueba@gmai.com', '$2y$10$q2CXpRA5ucNc6CGnrncHdeLuP8xsHgax/o70Rlp.S9pQsZZpuINiW', 3, NULL, '2023-11-14 13:04:59', NULL),
(12, 'Emili Vives', 'prevencion@trasmapi.com', '$2y$10$cIoBp9T9JEC8EdJVGc6h6upDWH0.RPTpqMIteE0b/o6QC5xIzpCsO', 1, NULL, '2024-01-29 13:32:06', NULL);

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
(3, 110, '47627004F', 'VIVES GARCIA, EMILI', 'H', '1979-10-03', 1, '2021-08-01', 4, 1, '0000-00-00', '0000-00-00', '2023-11-17 09:56:23', '2024-01-30 14:13:39'),
(4, 221, '12452145F', 'SANCHEZ TORRES, JOSE LUIS', 'H', '1988-11-01', 2, '2023-07-11', 7, 0, '0000-00-00', '0000-00-00', '2023-11-17 09:56:23', '2024-01-31 10:04:46'),
(5, 98898, '00001000T', 'PEREZ PEREZ, PRUEBA', 'H', '1988-11-09', 2, '2023-10-31', 4, 1, '0000-00-00', '0000-00-00', '2023-11-27 08:32:45', '2023-11-27 08:32:45'),
(6, 125855, '11244484F', 'RUIZ RUIZ, PEPE', 'H', '2023-11-14', 2, '2023-11-07', 6, 1, '0000-00-00', '0000-00-00', '2023-11-27 08:34:16', '2023-11-27 08:34:16'),
(7, 1254, '125444587S', 'SANCHEZ PERA, JOSE LUIS', 'H', '1988-06-11', 2, '2021-08-12', 7, 1, '0000-00-00', '0000-00-00', '2023-12-07 12:25:18', '2023-12-07 12:25:18'),
(8, 1009, '56855222L', 'LUENGO ROJAS, JOSE JAVIER ', 'H', '1988-12-05', 2, '2023-12-15', 7, 1, '0000-00-00', '0000-00-00', '2023-12-12 14:18:59', '2024-01-30 13:41:59'),
(9, 1885, '65532455R', 'FERNANDEZPEREZ, JOSE', 'H', '1979-12-15', 2, '2023-12-01', 5, 1, '0000-00-00', '0000-00-00', '2023-12-13 11:47:07', '2023-12-13 11:47:07'),
(10, 2556, '45875454S', 'GARCIA GARCIA, MANUEL', 'H', '1988-12-05', 2, '2023-12-15', 7, 1, '0000-00-00', '0000-00-00', '2023-12-13 11:48:08', '2023-12-13 11:48:08');

--
-- Índices para tablas volcadas
--

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
  MODIFY `id_formacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

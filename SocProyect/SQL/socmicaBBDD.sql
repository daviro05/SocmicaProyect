-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2013 a las 20:40:24
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `socmica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje` varchar(20) NOT NULL,
  `nick_usuario_em` varchar(15) NOT NULL,
  `nick_usuario_re` varchar(15) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` varchar(200) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `nick_usuario_em`, `nick_usuario_re`, `asunto`, `mensaje`, `fecha_hora`) VALUES
('Albert1370381608', 'Albert', 'Kokimbo', 'Gracias Kooookimbou', 'Me presento\r\nSoy Alberto\r\ny mi flow\r\nva por dentro\r\nSoy carpintero\r\ny músico experto\r\nsi me votas te respeto YEAH...YEAH...', '2013-06-04 23:33:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musica`
--

CREATE TABLE IF NOT EXISTS `musica` (
  `id_fichero` varchar(20) NOT NULL,
  `nick_usuario` varchar(15) NOT NULL,
  `nombre_fichero` varchar(40) NOT NULL,
  `votos` int(4) NOT NULL,
  `enlace_fichero` varchar(70) NOT NULL,
  PRIMARY KEY (`id_fichero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `musica`
--

INSERT INTO `musica` (`id_fichero`, `nick_usuario`, `nombre_fichero`, `votos`, `enlace_fichero`) VALUES
('David1369857419', 'David', 'Georgeux', 3, 'http://www.goear.com/listen/554c68a/presentacion-ldll-drmseries'),
('Albert1370380429', 'Albert', 'El Albert Del Maiz', 0, './ficheros_musica/AlbertBusco algun lugar  con Albert.mp3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE IF NOT EXISTS `seguidores` (
  `id_usuario` varchar(15) NOT NULL,
  `usuario_seguido` varchar(15) NOT NULL,
  PRIMARY KEY (`id_usuario`,`usuario_seguido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`id_usuario`, `usuario_seguido`) VALUES
('David', 'drmseries'),
('David', 'Sonia'),
('drmseries', 'David'),
('Kokimbo', 'Albert'),
('Sonia', 'David');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nick` varchar(15) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `edad` int(3) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `otros_detalles` varchar(100) NOT NULL,
  `img_perfil` varchar(70) NOT NULL DEFAULT './ficheros_imgperfil/perfil_vacio.jpg',
  `num_canciones` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nick`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `nombre`, `apellidos`, `password`, `email`, `edad`, `sexo`, `otros_detalles`, `img_perfil`, `num_canciones`) VALUES
('Albert', 'Alberto', 'Sanchez', 'd2fc72a1bc8fa36d260ecf2173336872', 'alberto@paloma.com', 23, 'M', 'Usuario creado con exito', './ficheros_imgperfil/Albert_perfil.jpg', 1),
('David', 'David', 'Rodriguez', 'd2fc72a1bc8fa36d260ecf2173336872', 'david@gmail.com', 20, 'M', '014e8e98d331ece19ef26494f763f6d6', './ficheros_imgperfil/perfil_vacio.jpg', 1),
('drmseries', 'David', 'Rodríguez Marco', 'd2fc72a1bc8fa36d260ecf2173336872', 'drm909@hotmail.com', 21, 'M', 'ad08161851c0f673313ef86a7e0884f5', './ficheros_imgperfil/drmseries_perfil.jpg', 0),
('Marta', 'Marta', 'Martin', 'd2fc72a1bc8fa36d260ecf2173336872', 'marta94@gmail.com', 19, 'F', 'Usuario creado con exito', './ficheros_imgperfil/perfil_vacio.jpg', 0),
('Sonia', 'Sonia', 'GCal', 'd2fc72a1bc8fa36d260ecf2173336872', 'sonia@gmail.com', 19, 'F', 'Usuario creado con exito', './ficheros_imgperfil/perfil_vacio.jpg', 1),
('Kokimbo', 'Koke', 'RDa', 'd2fc72a1bc8fa36d260ecf2173336872', 'kokimbo@gmail.com', 19, 'M', 'Usuario creado con exito', './ficheros_imgperfil/Kokimbo_perfil.jpeg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

CREATE TABLE IF NOT EXISTS `votaciones` (
  `id_votante` varchar(15) NOT NULL,
  `id_votado` varchar(15) NOT NULL,
  `id_cancion` varchar(20) NOT NULL,
  PRIMARY KEY (`id_votante`,`id_cancion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `votaciones`
--

INSERT INTO `votaciones` (`id_votante`, `id_votado`, `id_cancion`) VALUES
('Kokimbo', 'Albert', 'Albert1370374025');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

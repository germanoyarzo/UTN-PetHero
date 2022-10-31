USE pethero;

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `dni` varchar(250) NOT NULL,
  `phoneNumber` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;


--
-- Estructura de tabla para la tabla `keeper`
--

CREATE TABLE `keeper` (
  `id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `salary` float NOT NULL,
  `available` varchar(10) NOT NULL,
  `dateStart` date NOT NULL,
  `dateEnd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `keeper`
--

INSERT INTO `keeper` (`id`, `size`, `salary`, `available`, `dateStart`, `dateEnd`) VALUES
(1, 'small', 3000, 'true', '2022-10-25', '2022-10-26'),
(2, 'medium', 3000, 'true', '2022-10-24', '2022-10-31'),
(3, 'big', 3000, 'true', '2022-10-25', '2022-10-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `keeper`
--
ALTER TABLE `keeper`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `keeper`
--
ALTER TABLE `keeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;




--
-- Estructura de tabla para la tabla `pet`
--

CREATE TABLE `pet` (
  `id` int(10) NOT NULL,
  `idUser` int(10) NOT NULL,
  `race` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL,
  `vaccination` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;
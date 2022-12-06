-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Maio-2022 às 21:01
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `restaurant`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `productId` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `productType` varchar(9) NOT NULL,
  `price` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `product` (`productId`, `name`, `productType`, `price`) VALUES
(1, 'Sandwich', 'Dish', '8'),
(2, 'French Fries ', 'Dish ', '4'),
(3, 'Chicken à la King', 'Dish', '15'),
(4, 'Beef Stroganoff ', 'Dish', '35'),
(5, 'Waldorf Salad' , 'Dish' , '15'),
(6, 'Baked Alaska' , 'Dessert' , '15'),
(7, 'Tiramisu' , 'Dessert' , '10'),
(8, 'Soda' , 'Drink' , '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(6) NOT NULL,
  `clientName` varchar(50) NOT NULL,
  `reservationDate` date NOT NULL,
  `reservationHour` varchar(5) NOT NULL,
  `seatsQty` int(2) NOT NULL,
  `is_Attended` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` int(9) NOT NULL,
  `adress` varchar(60) NOT NULL,
  `userType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `phoneNumber`, `adress`, `userType`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin', 125697, 'admin house ', 'Admin'),
('client', '62608e08adc29a8d6dbc9754e659f125', 'client@gmail', 15964, 'client house', 'Client'),
('table_manager', 'd04e1b9675a2dc5c47bd22fe3d4f8063', 'table_manager@system.pt', 123456789, 'table manager adress', 'Table_manager');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Índices para tabela `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

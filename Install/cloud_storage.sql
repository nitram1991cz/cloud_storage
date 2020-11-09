-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 09. lis 2020, 15:05
-- Verze serveru: 10.4.13-MariaDB
-- Verze PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cloud_storage`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `file_size` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `files`
--

INSERT INTO `files` (`file_id`, `file_size`, `user_id`, `file_name`) VALUES
(1, 0, 1, 'prvni.jpg'),
(2, 2, 1, 'druhy.txt'),
(36, 6665589, 1, '2.mp3'),
(47, 5, 2, 'Nový textový dokument - kopie.txt'),
(48, 5, 2, 'Nový textový dokument - kopie (2).txt'),
(49, 6, 2, 'Nový textový dokument - kopie (3).txt'),
(50, 6382956, 1, 'GOPR4919.JPG'),
(51, 6417750, 1, 'GOPR4918.JPG');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `storage_limit` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `storage_limit`, `admin`) VALUES
(1, 'Franta2', 'heslo2', NULL, 1),
(2, 'Pepa', 'heslo12', 5, 0),
(3, 'Ondra', 'heslo3', NULL, 0),
(4, 'Novz', 'heslo', NULL, 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 12:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sensor_pukulan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_record`
--

CREATE TABLE `data_record` (
  `id_record` int(10) NOT NULL,
  `id_user` int(5) NOT NULL,
  `berat_pukulan` float NOT NULL,
  `kecepatan_pukulan` float NOT NULL,
  `jarak` float NOT NULL,
  `kategori` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_record`
--

INSERT INTO `data_record` (`id_record`, `id_user`, `berat_pukulan`, `kecepatan_pukulan`, `jarak`, `kategori`, `waktu`) VALUES
(1, 2, 421, 0, 0, 'OK', '2023-12-16 11:31:18'),
(2, 2, 365, 5.02, 40, 'OK', '2023-12-16 11:31:30'),
(3, 1, 386, 7.4, 53, 'OK', '2023-12-16 11:46:44'),
(4, 1, 392, 5.85, 45, 'OK', '2023-12-16 12:05:55'),
(5, 2, 377, 8.64, 48, 'OK', '2023-12-16 12:06:27'),
(6, 2, 434, 3.91, 61, 'OK', '2023-12-16 12:12:39'),
(7, 2, 267, 2.1, 52, 'OK', '2023-12-16 12:15:18'),
(8, 2, 401, 3.23, 53, 'OK', '2023-12-16 12:33:36'),
(10, 2, 136, 6.29, 62, 'OK', '2023-12-16 13:27:52'),
(11, 2, 409, 1.9, 54, 'OK', '2023-12-16 13:31:14'),
(13, 3, 464, 12, 48, 'OK', '2023-12-16 13:47:57'),
(14, 3, 402, 8.48, 53, 'OK', '2023-12-16 13:48:21'),
(15, 2, 437, 14.74, 61, 'OK', '2023-12-16 13:58:59'),
(16, 2, 367, 10.04, 53, 'OK', '2023-12-16 14:00:17'),
(17, 4, 297, 5.61, 87, 'OK', '2023-12-16 19:24:50'),
(18, 4, 325, 0, 0, 'OK', '2023-12-16 19:25:26'),
(19, 4, 373, 0.57, 86, 'OK', '2023-12-16 19:25:44'),
(20, 4, 443, 18, 86, 'OK', '2023-12-16 19:26:08'),
(21, 4, 349, 16.84, 87, 'OK', '2023-12-16 19:27:12'),
(22, 4, 270, 1.04, 7, 'OK', '2023-12-16 19:27:56'),
(23, 4, 368, 9.55, 61, 'OK', '2023-12-16 19:35:32'),
(24, 4, 358, 9.28, 49, 'Sedang', '2023-12-16 19:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(1) NOT NULL,
  `rolename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `rolename`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `id_role`) VALUES
(1, 'Administrator', 'admin', '12344321', 1),
(2, 'Muhammad Adnan Surya', 'adnansurya', '12345678', 2),
(3, 'Dummy User', 'dummyuser', '67896789', 2),
(4, 'User Tes', 'usertes', '12341234', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_record`
--
ALTER TABLE `data_record`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_record`
--
ALTER TABLE `data_record`
  MODIFY `id_record` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221119.dd915776f2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 03:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amalia`
--

-- --------------------------------------------------------

--
-- Table structure for table `prasetya`
--

CREATE TABLE `prasetya` (
  `id_pembeli` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jenis_barang` varchar(25) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prasetya`
--

INSERT INTO `prasetya` (`id_pembeli`, `nama`, `alamat`, `hp`, `tgl_transaksi`, `jenis_barang`, `nama_barang`, `jumlah`, `harga`) VALUES
(1, 'Amalia', 'Bekasi', '85215452888', '2022-11-04', 'CD/Album', 'Kyun', 2, 400000),
(2, 'Swastika', 'Tokyp', '4656566', '2022-11-02', 'Towel', 'Towel Konser', 4, 50000),
(3, 'Indra', 'Osaka', '235456', '2022-11-16', 'Merch', 'Lightstick', 6, 200000),
(4, 'Prasetya', 'Chiba', '454546', '2022-11-18', 'CD/Album', 'Sonna Koto Nai yo', 3, 5000000),
(5, 'Amel', 'Osaka', '454566', '2022-11-19', 'CD/Album', 'Doremi', 1, 300000),
(6, 'Amalia Swastika Indra Prasetya', 'Jakarta', '981234567', '2022-12-10', 'CD/Album', 'Boku Nanka', 4, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'amalia', 'amalia', 'amalia@gmail.com', '$2y$10$qo2EMf3qdgV0ew.vEDlFy.0aKXHYqOKT6mjRkeiXIgUZh3gw2wik2'),
(2, 'swastika', 'swastika', 'swastika@gmail.com', '$2y$10$tyo1W9Z1lqdV..eLGAhu3eBZ9fCP4O.QrkvE47istcJjM.MHsAani');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prasetya`
--
ALTER TABLE `prasetya`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

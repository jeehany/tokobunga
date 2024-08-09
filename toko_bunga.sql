-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2024 at 05:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_bunga`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Bloom Box'),
(2, 'Wrapped Bouquet'),
(3, 'Joyfull Balloon');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(3, 2, 'Olivia Imported (S)', 375000, 'XSoK1O6L5vEHgAmo8NRQ.jpg', NULL, 'tersedia'),
(4, 2, 'White C&#039;est La Vie (M)', 300000, 'bDh6vP6oE875tg38i1sd.jpg', NULL, 'tersedia'),
(5, 2, 'Red C&#039;est La Vie (M)', 300000, 'PSVOfgpXW4mCaRJyKV6f.jpg', NULL, 'tersedia'),
(6, 2, 'Everlasting Love ', 625000, 'NraDATz4igmW7g7TR6Yh.jpg', NULL, 'tersedia'),
(7, 2, 'Calla Bouquet ', 550000, '2CHAXZcqxcM9AXBkQw8U.jpg', NULL, 'tersedia'),
(8, 2, 'Charlotte', 600000, 'XM0Ld2rYdmpzQybKgIuO.jpg', NULL, 'tersedia'),
(9, 2, 'Blue Millie ', 275000, 'A5mS90oLud35IW7Sh5Zl.jpg', NULL, 'tersedia'),
(10, 2, 'Yellow C&#039;est La Vie', 300000, 'VJuj7khjayc9ezMBbvcH.jpg', NULL, 'tersedia'),
(11, 2, 'Coral Pink C&#039;est La Vie', 300000, 'BrgmTKL7RixJ9taxSLHX.jpg', NULL, 'tersedia'),
(12, 2, 'Brighter Day', 425000, 'XxMFekmuCTGLy7QEV7jw.jpg', NULL, 'tersedia'),
(13, 2, 'Oh Sunny Day ', 400000, 'kxWJH8jWtKy74ZzrUknX.jpg', NULL, 'tersedia'),
(14, 2, 'White Loving Lily', 550000, 'jSr3F5gW8fhx5fseeHJq.jpg', NULL, 'tersedia'),
(15, 2, 'Something About You', 600000, 'sJUFb6vZ9dBIvh8h5tQS.jpg', NULL, 'tersedia'),
(16, 2, 'Truelips ', 850000, 'mvIhdumFLo8sItah27Ma.jpg', NULL, 'tersedia'),
(17, 2, 'French Blue &amp; White Merry', 525000, 'w8KYazZOC6Z5JjYUZiqH.jpg', NULL, 'tersedia'),
(18, 3, 'Additional Ellie Balloon', 200000, 'pnK70U1k6vT3fzCtTRrA.jpg', NULL, 'tersedia'),
(19, 3, 'Additional Momo Balloon', 150000, 'YWzTGVUZ5vnfc66Z4Zid.jpg', NULL, 'tersedia'),
(20, 3, 'Additional Plain Balloon', 150000, 'GqFJCUINLhBwKqQvyXh3.jpg', NULL, 'tersedia'),
(21, 1, 'True Love Bloom Box', 750000, 'KUN22goI2hqZsZhb1oE4.jpg', NULL, 'tersedia'),
(22, 1, 'Bellarosa Bloom Box', 785000, 'uACq9hBnqRpbIlpvlWYF.jpg', NULL, 'tersedia'),
(23, 1, 'White Elysian Bloom Box', 685000, '0FhdW7K4Le6u4pmBAsIO.jpg', NULL, 'tersedia'),
(24, 1, 'Mariposa Bloom Box', 685000, 'GEuCvDWV4uE8jqVTPEU8.jpg', NULL, 'tersedia'),
(25, 1, 'Love Symphony Bloom Box', 685000, 'F6LyZsMUAgnt7Jt4D3da.jpg', NULL, 'tersedia'),
(26, 1, 'Pink Butterfly Bloom Box', 535000, 'Lulh2EtAyT98p4YiziMF.jpg', NULL, 'tersedia'),
(27, 1, 'Blue Ivy Bloom Box', 485000, '7W8j6rUnOmVyg8MCuUBQ.jpg', NULL, 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$s60MOj9LIm1ltJqk8ojrGOJ892oqRnsScv/FOZGsergnJ5vd95zrC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

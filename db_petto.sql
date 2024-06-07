-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 08:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_petto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `status`) VALUES
(1, 'ri', 'MoKha', '$2y$10$ErAFjLfRGZhMt2UqHdAiCuihNvDGZBj5SZBvEq.y/5pSm7pyTvqkG', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `cart` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status_order` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama`, `alamat`, `phone`, `email`, `username`, `password`, `status`, `cart`, `total`, `status_order`) VALUES
(12, 'MoKha', 'Bandoeng', '08811231', 'ri@gmail.com', 'MoKha', '$2y$10$uYrgoFhjRVm8THN7CPNTzuNzv/bKeD.E0dgotmvf8vrdJjXd.xXWy', 'customer', 0, 412000, 'konfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `banyak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id`, `nama_jenis`, `banyak`) VALUES
(1, 'Foods', 3),
(2, 'Toys', 5),
(3, 'Clothes', 0),
(4, 'Accessories', 2),
(5, 'Vitamins', 5),
(6, 'Grooming Tools', 4),
(7, 'Sleeping Tools', 4);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pembelian`
--

CREATE TABLE `laporan_pembelian` (
  `id` int(11) NOT NULL,
  `id_customers` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `banyak_produk` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `waktu_konfirmasi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_pembelian`
--

INSERT INTO `laporan_pembelian` (`id`, `id_customers`, `id_produk`, `harga_produk`, `banyak_produk`, `total`, `waktu_konfirmasi`) VALUES
(107, 12, 6, 345000, 1, 345000, '2022-06-09 06:37:31'),
(108, 12, 7, 62000, 1, 62000, '2022-06-09 06:37:31');

--
-- Triggers `laporan_pembelian`
--
DELIMITER $$
CREATE TRIGGER `reduce_banyak` AFTER INSERT ON `laporan_pembelian` FOR EACH ROW BEGIN
	UPDATE produk SET banyak = banyak - NEW.banyak_produk
    WHERE id=NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_customers` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `banyak_produk` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_customers`, `id_produk`, `harga_produk`, `banyak_produk`, `total`, `status`) VALUES
(107, 12, 6, 345000, 1, 345000, 'checkout'),
(108, 12, 7, 62000, 1, 62000, 'checkout');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `addCart` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
	UPDATE customers SET cart = cart + 1
    WHERE id=NEW.id_customers;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `addPrice` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
	UPDATE customers SET total = total + NEW.harga_produk
    WHERE id=NEW.id_customers;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteCart` BEFORE DELETE ON `orders` FOR EACH ROW BEGIN
	UPDATE customers SET cart = cart - OLD.banyak_produk, total = total - OLD.total
    WHERE id=OLD.id_customers;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `banyak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `foto`, `nama`, `harga`, `jenis`, `banyak`) VALUES
(6, 'cat2.png', 'Whiskas Mackerel Flavour 7Kg', 345000, 1, 45),
(7, 'dog1.png', 'Pedigree Beef & Vegetables Flavor 1.5Kg', 62000, 1, 20),
(8, 'fish1.png', 'Sakura Fish Food 100g', 3500, 1, 445),
(9, 'toy1.png', 'Fish Toys For Cat', 25000, 2, 40),
(10, 'toy2.png', 'Long Fur Cat Toy', 20000, 2, 57),
(11, 'toy3.png', 'Mice Like Cat Toy', 10000, 2, 76),
(12, 'toy4.png', 'Leaps & Bounds Lattice Ball and Bell Cat Toys', 12000, 2, 35),
(15, 'toy5.png', 'Frisbee Dog Silicon', 75000, 2, 16),
(16, 'boost-supplement.png', 'Fitpet Supplement for energy boost', 250000, 5, 55),
(21, 'multivitamin.png', 'VetIQ Healthy Support MultiVitamin for Adult Dogs, 90 Soft Chews', 150000, 5, 75),
(22, 'prosense.jpeg', 'Pro-Sense Advanced Strength Glucosamine Chews for Dogs, 120 Tablets', 275000, 5, 37),
(23, 'herbion.jpeg', 'Herbion Pets Allergy + Immune Chews with Kelp & Vitamin C, 120 Soft Chews', 275000, 5, 48),
(24, 'fish_oil.jpeg', 'Fera Pet Organics Fish Oil Drops for Dogs and Cats with Natural NON-GMO Vitamin E Source', 225000, 5, 18),
(25, 'groom.png', 'Pet Life Grooming Deshedder Pet Comb', 200000, 6, 47),
(26, 'sisir_merah.png', 'Pet Brush Deshedding Grooming Tool Pet Hair Remover', 130000, 6, 25),
(27, 'clipper.jpeg', 'Pet Grooming Hair Clipper Rechargeable Low Noise Cordless', 200000, 6, 30),
(28, 'clipper1.jpeg', 'BOSHEL Dog Nail Clippers &Trimmer with Safety Guard', 165000, 6, 25),
(29, 'sleep.png', 'Pet Bed Round Autumn and Winter Warm', 100000, 7, 15),
(30, 'bed.jpeg', 'Vibrant Life Cuddler Pet Bed, Small, Gray', 65000, 7, 17),
(31, 'cat_house.jpeg', 'Cat Tree Tower House for Kittens Activity Tower with Scratching Posts', 350000, 7, 13),
(32, 'dog_house.jpeg', 'Outback Dog House for Dog size XL Up to 90lbs', 500000, 7, 5),
(33, 'acc1.png', 'Cats Necklace Bow-knot', 42000, 4, 30),
(34, 'acc2.png', 'Miyanuby Cute Cat Rabbit Hat', 142500, 4, 40);

--
-- Triggers `produk`
--
DELIMITER $$
CREATE TRIGGER `hapus` BEFORE DELETE ON `produk` FOR EACH ROW BEGIN
	UPDATE jenis_produk SET banyak = banyak - 1
    WHERE id=OLD.jenis;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `isi` AFTER INSERT ON `produk` FOR EACH ROW BEGIN
	UPDATE jenis_produk SET banyak = banyak + 1
    WHERE id=NEW.jenis;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_pembelian`
--
ALTER TABLE `laporan_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customers` (`id_customers`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customers` (`id_customers`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis` (`jenis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan_pembelian`
--
ALTER TABLE `laporan_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_pembelian`
--
ALTER TABLE `laporan_pembelian`
  ADD CONSTRAINT `laporan_pembelian_ibfk_1` FOREIGN KEY (`id_customers`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `laporan_pembelian_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_customers`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `jenis_produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

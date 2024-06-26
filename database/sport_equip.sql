-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2024 at 08:51 AM
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
-- Database: `sport_equip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`) VALUES
(1, 'hafizi', 'mh642859@gmail.com', '$2y$10$yp..QlK.bLv99mA4EApRSubuHlI5Qs.67eJDXJOAkKs7UarVLzomK'),
(2, 'admin', 'admin@gmail.com', '$2y$10$5xHlbkOxM//z2qCMsq0Pfetau4UdeXcP5g3aFfoliDAxUS/.X0xkm');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `kode`, `nama_barang`, `harga`, `jumlah`, `tanggal`) VALUES
(9, 'putridwiyanti', 'G003', 'Bola Billiard', '80000.00', 1, '2024-06-18 02:41:41'),
(19, 'uqi', 'A001', 'Sepeda Statis', '80000.00', 1, '2024-06-18 07:26:28'),
(24, 'admin', 'A001', 'Sepeda Statis', '80000.00', 1, '2024-06-21 14:56:59'),
(41, 'stan', 'F001', 'Stik Golf', '200000.00', 1, '2024-06-22 02:30:14'),
(42, 'stan', 'B004', 'String Badminton Yonex', '85000.00', 1, '2024-06-22 02:36:59'),
(47, 'sep12', 'G001', 'Meja Biliard', '300000.00', 1, '2024-06-22 04:39:12'),
(51, 'hafizi', 'B003', 'Jersey Badminton', '35000.00', 1, '2024-06-22 08:00:02'),
(52, 'hafizi', 'A003', 'Angkle Weight', '50000.00', 1, '2024-06-22 08:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_sport_equip`
--

CREATE TABLE `catalog_sport_equip` (
  `kode` varchar(5) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `catalog_sport_equip`
--

INSERT INTO `catalog_sport_equip` (`kode`, `nama_barang`, `kategori`, `foto`, `stok`, `harga`, `status`, `deskripsi`) VALUES
('A001', 'Sepeda Statis', 'Fitness', 'uploads/sepeda-statis.jpeg', 10, '80000.00', 'Full Booking', 'Sepeda statis adalah alat kebugaran yang digunakan untuk latihan kardio. Alat ini memungkinkan pengguna untuk mensimulasikan pengalaman bersepeda di luar ruangan dengan berbagai tingkat resistensi'),
('A002', 'Dumbell', 'Fitness', 'uploads/dumbell.jpeg', 20, '50000.00', 'Ready', 'Dumbell adalah alat berat kecil yang digunakan dalam latihan kekuatan dan angkat beban. Tersedia dalam berbagai bobot untuk membantu memperkuat otot dan meningkatkan kebugaran tubuh'),
('A003', 'Angkle Weight', 'Fitness', 'uploads/ankle-weight.jpg', 50, '50000.00', 'Ready', 'Angkle weight adalah beban yang dapat dipasang di pergelangan kaki untuk menambah resistensi dalam latihan fisik. Alat ini membantu meningkatkan kekuatan otot kaki dan daya tahan'),
('A004', 'Pull-up Bar', 'Fitness', 'uploads/pull-up-bar.jpg', 40, '20000.00', 'Ready', 'Pull-up bar adalah alat yang dipasang di pintu atau dinding untuk latihan pull-up. Alat ini digunakan untuk memperkuat otot-otot tubuh bagian atas, termasuk lengan dan punggung'),
('A005', 'Balance Ball', 'Fitness', 'uploads/balance-ball.jpg', 30, '15000.00', 'Ready', 'dikenal sebagai bola kebugaran atau bola stabilitas, digunakan dalam latihan keseimbangan dan kekuatan inti. Alat ini membantu meningkatkan koordinasi dan stabilitas tubuh.'),
('B001', 'Raket Badminton Yonex', 'Badminton', 'uploads/raket-badminton-yonex.jpg', 10, '50000.00', 'Ready', 'raket berkualitas tinggi yang dirancang untuk permainan bulu tangkis. Raket ini terkenal dengan desain ergonomis dan teknologi canggih untuk meningkatkan performa pemain.'),
('B003', 'Jersey Badminton', 'Badminton', 'uploads/jersey-badminton.jpeg', 100, '35000.00', 'Ready', 'Pakaian olahraga yang dirancang khusus untuk pemain bulu tangkis. Terbuat dari bahan ringan dan breathable untuk kenyamanan maksimal selama permainan'),
('B004', 'String Badminton Yonex', 'Badminton', 'uploads/string-badminton-yonex.jpg', 250, '85000.00', 'Ready', 'senar raket berkualitas tinggi yang menawarkan kekuatan dan ketahanan. Senar ini membantu meningkatkan kontrol dan kekuatan pukulan.'),
('B005', 'Shuttlecock Nylon', 'Badminton', 'uploads/kok-badminton-nylon.jpg', 100, '20000.00', 'Ready', 'kok bulu tangkis yang terbuat dari bahan nylon, menawarkan daya tahan dan konsistensi dalam permainan'),
('C004', 'Bola Sepak', 'Football', 'uploads/bola sepak 1.png', 30, '20000.00', 'Ready', 'bola yang digunakan dalam permainan sepak bola, dirancang sesuai dengan standar resmi untuk ukuran, berat, dan tekanan'),
('D001', 'Bola Volly', 'Volleyball', 'uploads/bola-voly.jpg', 50, '50000.00', 'Ready', 'Bola yang digunakan dalam permainan bola voli, dirancang dengan ukuran dan berat yang sesuai untuk pertandingan resmi'),
('E001', 'Raket Wilson Tennis', 'Tenis', 'uploads/raket wilson tennis 1.png', 20, '25000.00', 'Ready', 'raket berkualitas tinggi yang digunakan dalam permainan tenis, dirancang dengan teknologi canggih untuk meningkatkan performa pemain'),
('F001', 'Stik Golf', 'Golf', 'uploads/stik_golf 1.png', 15, '200000.00', 'Ready', 'adalah alat utama yang digunakan dalam permainan golf untuk memukul bola. Terdapat berbagai jenis stik golf, termasuk driver, fairway woods, hybrids, irons, wedges, dan putters. Setiap jenis dirancang untuk jenis pukulan dan jarak tertentu.'),
('F002', 'Bola Golf', 'Golf', 'uploads/bola golf 1.png', 20, '40000.00', 'Ready', 'adalah bola kecil yang digunakan dalam permainan golf. Bola ini biasanya berwarna putih dan memiliki permukaan bertekstur yang membantu mengurangi hambatan udara dan meningkatkan jarak terbang'),
('G001', 'Meja Biliard', 'Billiard', 'uploads/meja biliard 1.png', 10, '300000.00', 'Ready', 'adalah peralatan utama dalam permainan biliar yang terdiri dari permukaan datar yang dilapisi kain biliar (biasanya terbuat dari wol) dan dilengkapi dengan bantalan di sekelilingnya'),
('G002', 'Stik Biliard', 'Billiard', 'uploads/stik biliard 1.png', 10, '100000.00', 'Ready', 'adalah tongkat panjang yang digunakan untuk memukul bola biliar. Biasanya terbuat dari kayu berkualitas tinggi atau bahan komposit, stik biliar terdiri dari beberapa bagian utama: gagang, batang, dan ujung stik (tip)'),
('G003', 'Bola Billiard', 'Billiard', 'uploads/bola biliard 1.png', 100, '80000.00', 'Ready', 'adalah bola yang digunakan dalam permainan biliar. Set standar bola biliar terdiri dari 16 bola, termasuk satu bola putih (cue ball) dan 15 bola bernomor (7 bola solid, 7 bola stripe, dan satu bola hitam nomor 8)');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int NOT NULL,
  `id_user` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal` date NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`id_rental`, `id_user`, `tanggal`, `name`, `alamat`, `total_bayar`, `status`) VALUES
(30, 'U-001', '2024-06-22', 'Putri Dwi Yanti', 'Pondok Rajeg', '80000.00', 'pending'),
(31, 'U-002', '2024-06-22', 'Muhamad Hafizi', 'Cibatok, Bogor, Jawa Barat', '35000.00', 'pending'),
(32, 'U-005', '2024-06-22', 'septian', 'Puncak, Bogor, Jawa Barat', '300000.00', 'pending'),
(33, 'U-002', '2024-06-22', 'Muhamad Hafizi', 'Cibatok, Bogor, Jawa Barat', '35000.00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `rental_details`
--

CREATE TABLE `rental_details` (
  `rental_id` int NOT NULL,
  `id_user` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rental_details`
--

INSERT INTO `rental_details` (`rental_id`, `id_user`, `name`, `nama_barang`, `harga`, `jumlah`) VALUES
(30, 'U-001', 'Putri Dwi Yanti', 'Bola Billiard', '80000.00', 1),
(31, 'U-002', 'Muhamad Hafizi', 'Jersey Badminton', '35000.00', 1),
(32, 'U-005', 'septian', 'Meja Biliard', '300000.00', 1),
(33, 'U-002', 'Muhamad Hafizi', 'Jersey Badminton', '35000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `username`, `email`, `password`, `telepon`) VALUES
('U-001', 'Putri Dwi Yanti', 'putridwiyanti', 'dwip501@gmail.com', '$2y$10$Nq7U90aGKxND2nRCF.ZG0.mZlShkJ2y9MBvr56umjM.9CH.ahSnRm', '088102573333'),
('U-002', 'Muhamad Hafizi', 'hafizi', 'hfz@gmail', '$2y$10$C8lCnupOE/rdIR0RtbgShu3kNCGOKZ3vBwsAje2eesknOSuDp/L7G', '085150501162'),
('U-003', 'Salwa Salsabil', 'salwa125', 'salwa@gmail.com', '$2y$10$cofIL0dxenkUn7LXgSz9NOSWH8EGC3Tx2Gqj1IslsUBsyPJJq0mUy', '085199202016'),
('U-004', 'syauqi', 'uqi', 'syauqi@gmail.com', '$2y$10$IoWvRrT7Q9V/cEJS9yFo0OZ8rlRRbySYSEjEY1Hik1TO43WJTxQ16', '088213999831'),
('U-005', 'septian', 'sep12', 'septian@gmail.com', '$2y$10$4cwxPYTU9664Dy67zZxajOQtJE.NjG9nyykfNY.ueoyo64VoMMTJ6', '085122401900'),
('U-006', 'stan', 'stan', 'stanpix20@gmail.com', '$2y$10$1vRF9QtvILG4iahgeKoThe3zPWCCX0UBottaiaHr60HbkP.peauK.', '088020616100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_sport_equip`
--
ALTER TABLE `catalog_sport_equip`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `rental_details`
--
ALTER TABLE `rental_details`
  ADD PRIMARY KEY (`rental_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `rental_details`
--
ALTER TABLE `rental_details`
  MODIFY `rental_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

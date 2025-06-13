-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Apr 2025 pada 08.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_grosir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `tanggal_terima` datetime NOT NULL,
  `status` enum('Diterima','Pending') DEFAULT 'Diterima'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_product` varchar(255) NOT NULL,
  `kategori` enum('elektronik','pakaian','makanan') NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_product`, `kategori`, `harga`, `stok`, `status`, `created_at`) VALUES
(3, 'Samsung Galaxy A54', 'elektronik', 4500000.00, 30, 'aktif', '2025-04-03 10:43:18'),
(4, 'T-shirt Cotton Uniqlo', 'pakaian', 120000.00, 50, 'aktif', '2025-04-03 10:43:18'),
(5, 'Celana Jeans Levis', 'pakaian', 350000.00, 25, 'aktif', '2025-04-03 10:43:18'),
(7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000.00, 10, 'aktif', '2025-04-03 10:43:18'),
(8, 'Rice Cooker Philips', 'elektronik', 650000.00, 40, 'aktif', '2025-04-03 10:43:18'),
(9, 'Nasi Goreng Instan', 'makanan', 20000.00, 100, 'aktif', '2025-04-03 10:43:18'),
(10, 'Coklat SilverQueen', 'makanan', 25000.00, 75, 'aktif', '2025-04-03 10:43:18'),
(11, 'Samuel Hutagalung', 'elektronik', 3500.00, 200, 'aktif', '2025-04-03 10:43:18'),
(12, 'Samuel Hutagalung', 'pakaian', 99999999.99, 34, 'aktif', '2025-04-03 11:17:46'),
(13, 'ayam jantan', 'makanan', 2000000.00, 32, 'aktif', '2025-04-03 11:42:00'),
(14, 'fancise chicken', 'makanan', 2000.00, 23, 'aktif', '2025-04-03 11:45:46'),
(15, 'ayam geprek', 'makanan', 12000.00, 120, 'aktif', '2025-04-03 11:46:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `total_harga`) VALUES
(1, '2025-04-03 14:34:11', 650000),
(2, '2025-04-03 14:34:54', 2000),
(3, '2025-04-03 14:35:07', 4000),
(4, '2025-04-03 14:37:14', 1950000),
(5, '2025-04-03 14:40:51', 120000),
(6, '2025-04-03 14:41:46', 120000),
(7, '2025-04-03 14:42:25', 5270000),
(8, '2025-04-03 14:43:30', 5512000),
(9, '2025-04-03 15:49:24', 38512000),
(10, '2025-04-03 16:10:07', 12000),
(11, '2025-04-03 16:26:16', 24000),
(12, '2025-04-08 08:10:09', 20000),
(13, '2025-04-08 08:10:20', 3500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `product_id`, `nama_produk`, `kategori`, `harga`, `jumlah`, `total`) VALUES
(1, 1, 8, 'Rice Cooker Philips', 'elektronik', 650000, 1, 650000),
(2, 2, 14, 'fancise chicken', 'makanan', 2000, 1, 2000),
(3, 3, 14, 'fancise chicken', 'makanan', 2000, 1, 2000),
(4, 3, 14, 'fancise chicken', 'makanan', 2000, 1, 2000),
(5, 4, 8, 'Rice Cooker Philips', 'elektronik', 650000, 1, 650000),
(6, 4, 8, 'Rice Cooker Philips', 'elektronik', 650000, 1, 650000),
(7, 4, 8, 'Rice Cooker Philips', 'elektronik', 650000, 1, 650000),
(8, 5, 4, 'T-shirt Cotton Uniqlo', 'pakaian', 120000, 1, 120000),
(9, 6, 4, 'T-shirt Cotton Uniqlo', 'pakaian', 120000, 1, 120000),
(10, 7, 8, 'Rice Cooker Philips', 'elektronik', 650000, 1, 650000),
(11, 7, 4, 'T-shirt Cotton Uniqlo', 'pakaian', 120000, 1, 120000),
(12, 7, 3, 'Samsung Galaxy A54', 'elektronik', 4500000, 1, 4500000),
(13, 8, 15, 'ayam geprek', 'makanan', 12000, 1, 12000),
(14, 8, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(15, 9, 15, 'ayam geprek', 'makanan', 12000, 1, 12000),
(16, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(17, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(18, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(19, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(20, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(21, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(22, 9, 7, 'Televisi Samsung 42 Inch', 'elektronik', 5500000, 1, 5500000),
(23, 10, 15, 'ayam geprek', 'makanan', 12000, 1, 12000),
(24, 11, 15, 'ayam geprek', 'makanan', 12000, 1, 12000),
(25, 11, 15, 'ayam geprek', 'makanan', 12000, 1, 12000),
(26, 12, 9, 'Nasi Goreng Instan', 'makanan', 20000, 1, 20000),
(27, 13, 11, 'Samuel Hutagalung', 'elektronik', 3500, 1, 3500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pengunjung') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(9, 'Rangga Serangga', 'rangga01@gmail.com', '$2y$10$MosRkpQvfBFe6dJT5yCO5efBiFzGmgkZiJ/sQQEq5h0toVG8uv43e', 'admin', '2025-04-03 09:54:03'),
(10, 'Hizkia Siahaan', 'hizkia12@gmail.com', '$2y$10$LO.xx91.dQdgYAvFL/vlVOf0QqURpdPLpyDABdOnWB0ov.twId5aa', 'pengunjung', '2025-04-03 14:37:01'),
(11, 'Samuel Hutagalung', 'samuel@gmail.com', '$2y$10$HSPtDKOxx8gapKO3.AJ8fuX0Ryi51YTNVpQ5YwKIAvbzACS0p8U/O', 'pengunjung', '2025-04-08 06:09:44');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD CONSTRAINT `penerimaan_barang_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

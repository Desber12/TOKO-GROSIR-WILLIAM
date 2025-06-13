<?php
session_start();
require '../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {

    // ✅ DITAMBAHKAN: Validasi jika keranjang kosong
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<script>alert('Keranjang kosong!'); window.location.href='penjualan.php';</script>";
        exit;
    }

    // ✅ DITAMBAHKAN: Ambil total harga dari form
    $total_harga = isset($_POST['total_harga']) ? (int) $_POST['total_harga'] : 0;

    // ✅ DITAMBAHKAN: Simpan ke tabel transaksi
    $tanggal_transaksi = date('Y-m-d H:i:s');
    $query_transaksi = "INSERT INTO transaksi (tanggal_transaksi, total_harga) VALUES (?, ?)";
    $stmt_transaksi = $conn->prepare($query_transaksi);
    $stmt_transaksi->bind_param("si", $tanggal_transaksi, $total_harga);
    $stmt_transaksi->execute();
    $id_transaksi = $stmt_transaksi->insert_id; // Ambil ID terakhir

    // ✅ DITAMBAHKAN: Simpan ke tabel transaksi_detail
    $query_detail = "INSERT INTO transaksi_detail (id_transaksi, nama_produk, kategori, harga, jumlah, subtotal) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_detail = $conn->prepare($query_detail);

    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $stmt_detail->bind_param(
            "issdii",
            $id_transaksi,
            $item['name'],
            $item['category'],
            $item['price'],
            $item['quantity'],
            $subtotal
        );
        $stmt_detail->execute();
    }

    unset($_SESSION['cart']);

    echo "<script>alert('Checkout berhasil! Transaksi telah disimpan.'); window.location.href='invoice.php?id=$id_transaksi';</script>";
    exit;
} else {

    echo "<script>alert('Akses tidak valid!'); window.location.href='penjualan.php';</script>";
    exit;
}
?>

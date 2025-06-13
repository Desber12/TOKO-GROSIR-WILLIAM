<?php
session_start();
require '../database/db.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID transaksi tidak ditemukan.'); window.location.href='penjualan.php';</script >";
    exit;
}

$id_transaksi = (int)$_GET['id'];

// Ambil data transaksi
$query_transaksi = "SELECT * FROM transaksi WHERE id_transaksi = ?";
$stmt = $conn->prepare($query_transaksi);
$stmt->bind_param("i", $id_transaksi);
$stmt->execute();
$result_transaksi = $stmt->get_result();

if ($result_transaksi->num_rows === 0) {
    echo "<script>alert('Transaksi tidak ditemukan.'); window.location.href='penjualan.php';</script>";
    exit;
}

$transaksi = $result_transaksi->fetch_assoc();

// Ambil detail produk
$query_detail = "SELECT * FROM transaksi_detail WHERE id_transaksi = ?";
$stmt_detail = $conn->prepare($query_detail);
$stmt_detail->bind_param("i", $id_transaksi);
$stmt_detail->execute();
$result_detail = $stmt_detail->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Transaksi</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/penjualan.css">
</head>
<body>
    <div class="main-content">
        <h2>🧾 Invoice Transaksi</h2>
        <p><strong>ID Transaksi:</strong> <?= $transaksi['id_transaksi'] ?></p>
        <p><strong>Tanggal:</strong> <?= $transaksi['tanggal_transaksi'] ?></p>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $result_detail->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($item['kategori']) ?></td>
                        <td>Rp. <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= $item['jumlah'] ?></td>
                        <td>Rp. <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Total: Rp. <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></h3>
        <a href="penjualan.php" class="btn-checkout">Kembali ke Penjualan</a>
    </div>
</body>
</html>

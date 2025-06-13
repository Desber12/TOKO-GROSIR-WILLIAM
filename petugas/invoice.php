<?php
session_start();
require '../database/db.php'; 

// Ambil ID transaksi dari URL
$transaksi_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($transaksi_id == 0) {
    echo "<script>alert('ID transaksi tidak valid!'); window.location.href='../petugas/invoice.php';</script>";
    exit;
}

// Ambil data transaksi
$sql_transaksi = "SELECT * FROM transaksi WHERE id='$transaksi_id'";
$result_transaksi = $conn->query($sql_transaksi);
$transaksi = $result_transaksi->fetch_assoc();

// Ambil detail transaksi
$sql_detail = "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id'";
$result_detail = $conn->query($sql_detail);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/sale.css">
</head>

<body>
    <?php require '../navbar/navbar_petugas.php'; ?>

    <div class="main-content">
        <?php require '../navbar/header.php'; ?>

        <div class="invoice-container">
            <h2 class="section-title">🧾 Invoice Pembelian</h2>
            <p class="subtitle">Terima kasih telah berbelanja!</p>

            <div class="invoice-details">
                <p><strong>ID Transaksi:</strong> <?= $transaksi['id'] ?></p>
                <p><strong>Tanggal:</strong> <?= $transaksi['tanggal'] ?></p>
                <p><strong>Total Harga:</strong> Rp. <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></p>
            </div>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($item = $result_detail->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                            <td><?= htmlspecialchars($item['kategori']) ?></td>
                            <td>Rp. <?= number_format($item['harga'], 0, ',', '.') ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td>Rp. <?= number_format($item['total'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="../petugas/data_penjualan.php" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke List</a>
        </div>
    </div>

    <script src="../script-box/script.js"></script>
</body>

</html>

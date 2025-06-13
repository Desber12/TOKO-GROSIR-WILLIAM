<?php
session_start();
require '../database/db.php'; 


$sql_transaksi = "SELECT id, tanggal, total_harga FROM transaksi ORDER BY tanggal DESC";
$result_transaksi = $conn->query($sql_transaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/data_penjualan.css">
</head>

<body>
    <?php require '../navbar/navbar_petugas.php'; ?>

    <div class="main-content">
        <?php require '../navbar/header.php'; ?>

        <div class="sales-container">
            <h2 class="section-title">📊 Data Penjualan</h2>
            <p class="subtitle">Daftar transaksi pembelian tanpa informasi pengguna.</p>

            <table class="sales-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_transaksi->num_rows > 0) {
                        while ($row = $result_transaksi->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['tanggal']}</td>
                                    <td>Rp. " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                                    <td><a href='invoice.php?id={$row['id']}' class='btn-detail'><i class='fas fa-file-invoice'></i> Lihat</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='no-data'>Belum ada transaksi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../script-box/script.js"></script>
</body>

</html>

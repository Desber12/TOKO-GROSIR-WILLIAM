<?php
require '../database/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_product = $_POST['nama_product'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];

    if (empty($nama_product) || empty($kategori) || empty($harga) || empty($stok) || empty($status)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href='tambah_data.php';</script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO produk (nama_product, kategori, harga, stok, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $nama_product, $kategori, $harga, $stok, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='../petugas/data_produk.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
require '../database/db.php';

if (!isset($_GET['id'])) {
    die("ID Produk tidak ditemukan.");
}

$id = $_GET['id'];

$sql = "DELETE FROM produk WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Produk berhasil dihapus!'); window.location.href='../petugas/data_produk.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk!');</script>";
}

$conn->close();
?>

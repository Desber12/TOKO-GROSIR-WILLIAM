<?php
session_start();
require '../database/db.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengguna berhasil dihapus!'); window.location.href='data_pelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID pengguna tidak ditemukan.'); window.history.back();</script>";
}

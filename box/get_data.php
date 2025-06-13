<?php
require '../database/db.php';

$sql = "SELECT SUM(stok) AS total_stok FROM produk";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$total_stok = $row['total_stok'] ?? 0;

echo json_encode(['stok' => $total_stok]);
?>

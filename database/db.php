<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "toko_grosir";

$conn = new mysqli($host,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Koneksi Gagal!" . $conn->connect_error);
}

?>
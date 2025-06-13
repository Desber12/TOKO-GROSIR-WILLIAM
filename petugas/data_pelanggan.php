<?php
session_start();
require '../database/db.php';  // Pastikan koneksi ke database sudah benar

// Mengambil data pengguna dari database
$sql = "SELECT id, nama, email, role, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Pengguna</title>
    <!--Link CDN FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--Link Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/data.css">
</head>

<body>
    <?php require '../navbar/navbar_petugas.php'; ?>

    <div class="main-content">
        <?php require '../navbar/header.php'; ?>

        <div class="container">
            <h2>📋 Kelola Data Pengguna</h2>
            <p>Berikut adalah daftar pengguna yang terdaftar dalam sistem:</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Ditambahkan Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan data pengguna
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['role']}</td>
                                    <td>{$row['created_at']}</td>
                                    <td>

                                        <a href='delete_user.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\")'><i class='fas fa-trash'></i> Hapus</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada pengguna yang terdaftar.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../script-box/script.js"></script>

</body>

</html>

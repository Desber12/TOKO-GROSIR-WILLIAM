<?php
require '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['switch']); 

    if (empty($nama) || empty($email) || empty($password) || empty($role)) {
        echo "Semua kolom harus diisi!";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql_check_email = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql_check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email sudah terdaftar! Silakan <a href='../form/login.php'>login</a>.";
    } else {
        
        $sql_insert = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssss", $nama, $email, $hashed_password, $role);

        if ($stmt_insert->execute()) {
            
            header("Location: ../form/login.php");
            exit();
        } else {
            echo "Terjadi kesalahan. Silakan coba lagi.";
        }

        $stmt_insert->close(); 
    }

    $stmt->close(); 
    $conn->close(); 
} else {
    echo "Metode request tidak valid.";
}
?>

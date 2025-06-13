<?php
session_start();
require '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['switch']);  


    if (empty($email) || empty($password) || empty($role)) {
        $_SESSION['error'] = "Semua kolom harus diisi!";
        header("Location: ../form/login.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

 
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = htmlspecialchars($user['nama']);
            $_SESSION['role'] = $user['role'];

        
            if ($user['role'] === 'admin') {
                header("Location: ../petugas/dashboard.php");
                exit();
            } elseif ($user['role'] === 'pengunjung') {
                header("Location: ../main/index.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Password salah!";
            header("Location: ../form/login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email atau peran tidak ditemukan!";
        header("Location: ../form/login.php");
        exit();
    }


    $stmt->close();
    $conn->close();
} else {
    $_SESSION['error'] = "Metode request tidak valid.";
    header("Location: ../form/login.php");
    exit();
}
?>

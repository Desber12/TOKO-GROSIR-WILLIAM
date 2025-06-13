<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!--Link CDN FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--Link Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/daftar.css">
</head>

<body>
    <div class="container">
        <form action="proses_login.php" method="post">
            <h2>Formulir Login</h2>
            <div class="input-container">
                <label for="email">Email</label>
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Masukkan Email Anda" required>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
            </div>
            <div class="input-container">
                <select name="switch" id="switch">
                    <option selected disabled>Pilih Salah Satu</option>
                    <option value="admin">👤 Admin</option>
                    <option value="pengunjung">🚶 Pengunjung</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Submit
            </button>
        </form>
        <div class="link-span">
            <p>Belum Punya Akun ? <span><a href="../form/daftar.php">Daftar Disini</a></span></p>
        </div>
    </div>
</body>

</html>
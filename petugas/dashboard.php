<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama Home Budget Tracker</title>
    <!--Link CDN FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--Link Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/img.css">
</head>

<body>
    <?php require '../navbar/navbar_petugas.php'   ?>
    <div class="main-content">
        <?php require '../navbar/header.php' ?>

        <div class="box-champion">
            <div class="box">
                <i class="fas fa-users"></i>
                <h3>Pengunjung</h3>
                <p id="visitors">3</p>
            </div>
            <div class="box">
                <i class="fas fa-box-open"></i>
                <h3>Stok Tersedia</h3>
                <p id="stock">0</p>
            </div>
            <div class="box">
                <i class="fas fa-user-check"></i>
                <h3>Pengguna Online</h3>
                <p id="users-online">2</p>
            </div>
        </div>

        <div class="img-container">
            <img src="../img/home.jpeg" alt="home">
            <img src="../img/dua.jpeg" alt="dua">
        </div>

    </div>

    <script src="../script-box/script.js"></script>

</body>

</html>
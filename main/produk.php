<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman produk</title>
    <!--Link CDN FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--Link Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/produk.css">
</head>

<body>
    <?php require '../navbar/navbar.php'; ?>
    <div class="main-content">
        <?php require '../navbar/header.php'; ?>

        <div class="product-list">
            <h2 class="section-title">✨ Temukan Produk Favoritmu di Sini! ✨</h2>
            <p class="subtitle">"Berbagai pilihan produk berkualitas menunggu kamu. Yuk, cek sekarang sebelum kehabisan!"</p>

            <div class="products-container">
                <?php
                require '../database/db.php';

       
                $sql = "SELECT * FROM produk ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $kategori = isset($row['kategori']) ? htmlspecialchars($row['kategori']) : 'Kategori tidak tersedia';

                     
                        echo "<div class='product-card'>
                                <div class='product-info'>
                                    <h3 class='product-name'>" . htmlspecialchars($row['nama_product']) . "</h3>
                                    <p class='category'><i class='fas fa-tag'></i> $kategori</p>
                                    <p class='price'><i class='fas fa-money-bill-wave'></i> Rp. " . number_format($row['harga'], 0, ',', '.') . "</p>
                                    <p class='stock'><i class='fas fa-boxes'></i> Stok: " . htmlspecialchars($row['stok']) . "</p>
                                </div>
                                <form method='POST' action='penjualan.php'>
                                    <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                                    <input type='hidden' name='product_name' value='" . htmlspecialchars($row['nama_product']) . "'>
                                    <input type='hidden' name='product_price' value='" . $row['harga'] . "'>
                                    <input type='hidden' name='product_stock' value='" . $row['stok'] . "'>
                                    <input type='hidden' name='product_category' value='" . htmlspecialchars($row['kategori']) . "'> <!-- Menambahkan kategori ke form -->
                                    <button type='submit' name='add_to_cart' class='btn-buy'>
                                        <i class='fas fa-shopping-cart'></i> Beli Sekarang
                                    </button>
                                </form>
                            </div>";
                    }
                } else {
                    echo "<p class='no-products'>Tidak ada produk yang tersedia.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="../script-box/script.js"></script>
</body>

</html>

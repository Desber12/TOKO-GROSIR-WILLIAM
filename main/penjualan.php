<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Penjualan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets//penjualan.css">
</head>

<body>
    <?php
    session_start();
    require '../navbar/navbar.php';
    require '../database/db.php';

    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_stock = $_POST['product_stock'];
        $product_category = $_POST['product_category'];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'stock' => $product_stock,
            'category' => $product_category,
            'quantity' => 1
        ];
    }

    if (isset($_GET['id'])) {
        $id_to_remove = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id_to_remove) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    ?>

    <div class="main-content">
        <?php require '../navbar/header.php'; ?>

        <div class="cart-container">
            <h2 class="section-title">🛒 Keranjang Belanja Anda</h2>
            <p class="subtitle">"Yuk, cek barang-barang pilihanmu sebelum checkout!"</p>

            <div class="cart-items">
                <?php
                if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                    echo "<p class='no-items'>Keranjang belanja kosong. Yuk, belanja sekarang! 🛍️</p>";
                } else {
                    echo "<table class='cart-table'>
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $totalHarga = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total = $item['price'] * $item['quantity'];
                        $totalHarga += $total;
                        echo "<tr>
                                <td>" . htmlspecialchars($item['name']) . "</td>
                                <td>" . htmlspecialchars($item['category']) . "</td>
                                <td>Rp. " . number_format($item['price'], 0, ',', '.') . "</td>
                                <td>" . $item['quantity'] . "</td>
                                <td>Rp. " . number_format($total, 0, ',', '.') . "</td>
                                <td><a href='penjualan.php?id=" . $item['id'] . "' class='btn-delete'> <i class='fas fa-trash'></i> Hapus</a></td>
                              </tr>";
                    }
                    echo "</tbody>
                          </table>";
                    echo "<div class='cart-total'>
                            <h3>Total Harga: Rp. " . number_format($totalHarga, 0, ',', '.') . "</h3>

                            <!-- ✅ DITAMBAHKAN / DIUBAH -->
                            <form action='checkout.php' method='POST'>
                                <input type='hidden' name='total_harga' value='" . $totalHarga . "'>
                                <button type='submit' name='checkout' class='btn-checkout'>
                                    <i class='fas fa-credit-card'></i> Checkout
                                </button>
                            </form>
                            <!-- ✅ AKHIR PERUBAHAN -->

                          </div>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="../script-box/script.js"></script>
</body>

</html>

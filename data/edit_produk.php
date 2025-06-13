<?php
require '../database/db.php';

if (!isset($_GET['id'])) {
    die("ID Produk tidak ditemukan.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Produk tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_product = $_POST['nama_product'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];

    $sql_update = "UPDATE produk SET nama_product=?, kategori=?, harga=?, stok=?, status=? WHERE id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssdisi", $nama_product, $kategori, $harga, $stok, $status, $id);
    
    if ($stmt_update->execute()) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='../petugas/data_produk.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama Home Budget Tracker</title>
    <!--Link CDN FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!--Link Font Google-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/tambah_data.css">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>Edit Data Produk</h2>

            <div class="input-container">
                <label for="nama_product">Nama Produk</label>
                <i class="fas fa-box"></i>
                <input type="text" id="nama_product" name="nama_product" placeholder="Masukkan Nama Produk" value="<?php echo htmlspecialchars($product['nama_product']); ?>" required>
            </div>

            <div class="input-container">
                <label for="kategori">Kategori</label>
                <i class="fas fa-tags"></i>
                <select id="kategori" name="kategori" required>
                    <option disabled>Pilih Kategori</option>
                    <option value="elektronik" <?php echo ($product['kategori'] == 'elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                    <option value="pakaian" <?php echo ($product['kategori'] == 'pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                    <option value="makanan" <?php echo ($product['kategori'] == 'makanan') ? 'selected' : ''; ?>>Makanan</option>
                </select>
            </div>

            <div class="input-container">
                <label for="harga">Harga</label>
                <i class="fas fa-dollar-sign"></i>
                <input type="number" id="harga" name="harga" placeholder="Masukkan Harga Produk" value="<?php echo $product['harga']; ?>" required>
            </div>

            <div class="input-container">
                <label for="stok">Stok</label>
                <i class="fas fa-boxes"></i>
                <input type="number" id="stok" name="stok" placeholder="Masukkan Stok Produk" value="<?php echo $product['stok']; ?>" required>
            </div>

            <div class="input-container">
                <label for="status">Status</label>
                <i class="fas fa-check-circle"></i>
                <select id="status" name="status" required>
                    <option disabled>Pilih Salah Satu</option>
                    <option value="aktif" <?php echo ($product['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                    <option value="tidak aktif" <?php echo ($product['status'] == 'tidak aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="data_produk.php" class="btn-cancel">
                <i class="fas fa-times-circle"></i> Batal
            </a>
        </form>
    </div>
</body>
</html>

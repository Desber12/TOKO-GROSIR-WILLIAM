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
    <link rel="stylesheet" href="../assets/tambah_data.css">
</head>

<body>
    <div class="container">
        <form action="tambah_data.php" method="post">
            <h2>Tambah Data</h2>

            <div class="input-container">
                <label for="nama_produk">Nama Product</label>
                <i class="fas fa-box"></i>
                <input type="text" id="nama_product" name="nama_product" placeholder="Masukkan Nama Product" required>
            </div>

            <div class="input-container">
                <label for="kategori">Kategori</label>
                <i class="fas fa-tags"></i>
                <select id="kategori" name="kategori" required>
                    <option selected disabled>Pilih Kategori</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="pakaian">Pakaian</option>
                    <option value="makanan">Makanan</option>
                </select>
            </div>

            <div class="input-container">
                <label for="harga">Harga</label>
                <i class="fas fa-dollar-sign"></i>
                <input type="number" id="harga" name="harga" placeholder="Masukkan Harga Product" required>
            </div>

            <div class="input-container">
                <label for="stok">Stok</label>
                <i class="fas fa-boxes"></i>
                <input type="number" id="stok" name="stok" placeholder="Masukkan Stok Product" required>
            </div>

            <div class="input-container">
                <label for="status">Status</label>
                <i class="fas fa-check-circle"></i>
                <select id="status" name="status" required>
                    <option selected disabled>Pilih Salah Satu</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Submit
            </button>
            <a href="../petugas/data_produk.php" class="btn-cancel">
                <i class="fas fa-times-circle"></i> Batal
            </a>

        </form>
    </div>

</body>

</html>
<?php
require '../database/db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql_total = "SELECT COUNT(*) AS total FROM produk WHERE 1";

if ($search != '') {
    $sql_total .= " AND nama_product LIKE '%" . $conn->real_escape_string($search) . "%'";
}

if ($category != '') {
    $sql_total .= " AND kategori = '" . $conn->real_escape_string($category) . "'";
}

$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];


$total_pages = ceil($total_records / $limit);

$sql = "SELECT * FROM produk WHERE 1";


if ($search != '') {
    $sql .= " AND nama_product LIKE '%" . $conn->real_escape_string($search) . "%'";
}

if ($category != '') {
    $sql .= " AND kategori = '" . $conn->real_escape_string($category) . "'";
}

$sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/body.css">
    <link rel="stylesheet" href="../assets/data_produk.css">
</head>

<body>
    <?php require '../navbar/navbar_petugas.php'; ?>
    <div class="main-content">
        <?php require '../navbar/header.php'; ?>

        <div class="product-data">
            <h2>Data Produk</h2>

            <a href="../data/input_barang.php" class="btn-add-product">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>

            <div class="filter-container">
                <form method="get" action="">
                    <input type="text" id="search-product" name="search" placeholder="Cari Produk..." class="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <select id="filter-category" name="category" class="filter-category">
                        <option selected disabled>Filter Kategori</option>
                        <option value="elektronik" <?php echo (isset($_GET['category']) && $_GET['category'] == 'elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                        <option value="pakaian" <?php echo (isset($_GET['category']) && $_GET['category'] == 'pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                        <option value="makanan" <?php echo (isset($_GET['category']) && $_GET['category'] == 'makanan') ? 'selected' : ''; ?>>Makanan</option>
                    </select>
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i> Cari
                    </button>

                </form>
            </div>


            <table class="product-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['nama_product']) . "</td>
                                    <td>" . htmlspecialchars($row['kategori']) . "</td>
                                    <td>Rp. " . number_format($row['harga'], 0, ',', '.') . "</td>
                                    <td>" . htmlspecialchars($row['stok']) . "</td>
                                    <td>" . ucfirst($row['status']) . "</td>
                                    <td>
                                        <a href='../data/edit_produk.php?id=" . $row['id'] . "' class='btn-edit'>
                                            <i class='fas fa-edit'></i> Edit
                                        </a>
                                        <a href='../data/hapus_produk.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>
                                            <i class='fas fa-trash'></i> Hapus
                                        </a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data produk</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>

            <div class="pagination">

                <?php if ($page > 1) { ?>
                    <a href="?page=1" class="pagination-link">
                        <i class="fas fa-angle-double-left"></i> First
                    </a>
                    <a href="?page=<?php echo $page - 1; ?>" class="pagination-link">
                        <i class="fas fa-chevron-left"></i> Prev
                    </a>
                <?php } ?>


                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <a href="?page=<?php echo $i; ?>" class="pagination-link <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php } ?>


                <?php if ($page < $total_pages) { ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="pagination-link">
                        <i class="fas fa-chevron-right"></i> Next
                    </a>
                    <a href="?page=<?php echo $total_pages; ?>" class="pagination-link">
                        <i class="fas fa-angle-double-right"></i> Last
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>
</body>

</html>
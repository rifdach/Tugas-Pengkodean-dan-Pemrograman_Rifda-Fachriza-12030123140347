<?php
include 'koneksi.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil data produk dari database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (!$result) {
    die("Error Query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gudang_persediaan.css">
    <title>Daftar Produk</title>
</head>
<body>
    <div class="container">
        <h1>Dashboard - Daftar Produk</h1>
        <div class="dashboard-buttons">
            <a href="dashboard.php" class="button">Dashboard</a>
            <a href="tambah_produk.php" class="button">Tambah Produk</a>
            <a href="cari_produk.php" class="button">Cari Produk</a>
        </div>

        <h2>Daftar Produk</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Jumlah Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo htmlspecialchars($row['stock_quantity']); ?></td>
                            <td><?php echo number_format($row['price'], 2); ?></td>
                            <td>
                                <a href="edit_produk.php?id=<?php echo $row['product_id']; ?>" class="button">Edit</a>
                                <a href="hapus_produk.php?id=<?php echo $row['product_id']; ?>" class="button" style="background-color: #dc3545;">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Tidak ada produk yang tersedia.</p>
        <?php } ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
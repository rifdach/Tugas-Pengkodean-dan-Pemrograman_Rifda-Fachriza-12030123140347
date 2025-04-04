<?php
include 'koneksi.php';

// Inisialisasi variabel pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query pencarian
$sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR category LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gudang_persediaan.css">
    <title>Pencarian Produk</title>
</head>
<body>
    <div class="container">
        <h1>Pencarian Produk</h1>
        <form method="get">
            <input type="text" name="search" placeholder="Cari berdasarkan nama atau kategori" value="<?php echo htmlspecialchars($search); ?>" required>
            <button type="submit" class="button">Cari</button>
            <a href="index.php" class="button">Kembali</a>
        </form>
        
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
            <p>Tidak ada produk yang sesuai dengan pencarian.</p>
        <?php } ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
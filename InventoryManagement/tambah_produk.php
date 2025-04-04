<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $stock_quantity = (int) $_POST['stock_quantity'];
    $price = (float) $_POST['price'];

    // Validasi input
    if (empty($product_name) || empty($category) || $stock_quantity < 0 || $price <= 0) {
        echo "<script>alert('Data tidak valid. Pastikan semua field terisi dengan benar.'); window.location.href='tambah_produk.php';</script>";
    } else {
        $sql = "INSERT INTO products (product_name, category, stock_quantity, price) VALUES ('$product_name', '$category', '$stock_quantity', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan produk: {$conn->error}'); window.location.href='tambah_produk.php';</script>";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gudang_persediaan.css">
    <title>Tambah Produk</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Produk Baru</h1>
        <form method="post">
            <label>Nama Produk:</label>
            <input type="text" name="product_name" required><br>

            <label>Kategori:</label>
            <input type="text" name="category" required><br>

            <label>Jumlah Stok:</label>
            <input type="number" name="stock_quantity" min="0" required><br>

            <label>Harga:</label>
            <input type="number" step="0.01" name="price" min="0.01" required><br>

            <button type="submit" class="button">Tambah Produk</button>
            <a href="index.php" class="button">Kembali</a>
        </form>
    </div>
</body>
</html>
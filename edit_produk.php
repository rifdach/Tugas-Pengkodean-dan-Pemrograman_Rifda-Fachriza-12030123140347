<?php
include 'koneksi.php';

// Pastikan ada parameter ID produk
if (!isset($_GET['id'])) {
    echo "<script>alert('ID Produk tidak ditemukan.'); window.location.href='index.php';</script>";
    exit();
}

$product_id = (int)$_GET['id'];

// Ambil data produk dari database
$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "<script>alert('Produk tidak ditemukan.'); window.location.href='index.php';</script>";
    exit();
}
$product = $result->fetch_assoc();

// Proses update data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $stock_quantity = (int) $_POST['stock_quantity'];
    $price = (float) $_POST['price'];

    $sql_update = "UPDATE products SET product_name='$product_name', category='$category', stock_quantity=$stock_quantity, price=$price WHERE product_id=$product_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk: {$conn->error}'); window.location.href='edit_produk.php?id=$product_id';</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gudang_persediaan.css">
    <title>Edit Produk</title>
</head>
<body>
    <div class="container">
        <h1>Edit Produk</h1>
        <form method="post">
            <label>Nama Produk:</label>
            <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required><br>

            <label>Kategori:</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required><br>

            <label>Jumlah Stok:</label>
            <input type="number" name="stock_quantity" value="<?php echo htmlspecialchars($product['stock_quantity']); ?>" min="0" required><br>

            <label>Harga:</label>
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" min="0.01" required><br>

            <button type="submit" class="button">Simpan Perubahan</button>
            <a href="index.php" class="button">Kembali</a>
        </form>
    </div>
</body>
</html>
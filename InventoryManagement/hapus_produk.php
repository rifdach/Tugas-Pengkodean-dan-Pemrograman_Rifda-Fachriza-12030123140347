<?php
include 'koneksi.php';

// Pastikan ada parameter ID produk
if (!isset($_GET['id'])) {
    echo "<script>alert('ID Produk tidak ditemukan.'); window.location.href='index.php';</script>";
    exit();
}

$product_id = (int)$_GET['id'];

// Hapus produk dari database
$sql = "DELETE FROM products WHERE product_id = $product_id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Produk berhasil dihapus!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk: {$conn->error}'); window.location.href='index.php';</script>";
}

$conn->close();
?>

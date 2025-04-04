<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');

    // Ambil harga barang
    $query = "SELECT harga, stok FROM barang WHERE id_barang = $id_barang";
    $result = mysqli_query($conn, $query);
    $barang = mysqli_fetch_assoc($result);
    $harga = $barang['harga'];
    $stok = $barang['stok'];

    if ($jumlah > $stok) {
        echo "Stok tidak cukup!";
        exit;
    }

    // Hitung subtotal
    $subtotal = $harga * $jumlah;
    $total_harga = $subtotal; // Untuk contoh sederhana, hanya 1 barang

    // Simpan ke tabel penjualan
    $query = "INSERT INTO penjualan (id_pelanggan, tanggal_penjualan, total_harga) 
              VALUES ('$id_pelanggan', '$tanggal', '$total_harga')";
    mysqli_query($conn, $query);
    $id_penjualan = mysqli_insert_id($conn);

    // Simpan ke tabel detail_penjualan
    $query = "INSERT INTO detail_penjualan (id_penjualan, id_barang, jumlah, subtotal) 
              VALUES ('$id_penjualan', '$id_barang', '$jumlah', '$subtotal')";
    mysqli_query($conn, $query);

    // Kurangi stok
    $new_stok = $stok - $jumlah;
    $query = "UPDATE barang SET stok = $new_stok WHERE id_barang = $id_barang";
    mysqli_query($conn, $query);

    mysqli_close($conn);
    header("Location: index.php");
    exit;
}
?>
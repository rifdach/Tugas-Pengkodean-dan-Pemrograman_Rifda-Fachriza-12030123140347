<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = ''; // Sesuaikan dengan password MySQL Anda
$database = 'gudang_persediaan';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die('Koneksi Gagal: ' . $conn->connect_error);
}

// Pesan sukses koneksi
// echo 'Koneksi berhasil';
?>

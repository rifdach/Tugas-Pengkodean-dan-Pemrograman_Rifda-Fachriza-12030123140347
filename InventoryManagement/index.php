<?php
include 'koneksi.php';

// Aktifkan error reporting untuk debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil data produk dari database
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

if (!$result) {
    die("Error saat mengambil data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gudang_persediaan.css">
    <title>Gudang Persediaan</title>
    <style>
        body {
            background-color: #f7f1e3;
            font-family: Arial, sans-serif;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #6a0572;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffdde1;
        }
        table th {
            background-color: #ff758c;
            color: white;
            padding: 10px;
        }
        table td {
            padding: 10px;
            border: 1px solid #ff8fab;
        }
        .button {
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }
        .edit {
            background: #ff5d8f;
        }
        .edit:hover {
            background: #e63e7b;
        }
        .delete {
            background: #ff3d3d;
        }
        .delete:hover {
            background: #d63031;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📦 Gudang Persediaan</h1>
        
        <div class="dashboard-buttons">
            <a href="tambah_produk.php" class="button" style="background: #ff6b81;">➕ Tambah Produk</a>
            <a href="cari_produk.php" class="button" style="background: #6a0572;">🔍 Cari Produk</a>
        </div>
        
        <h2>📋 Daftar Produk</h2>
        
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
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
                            <td>Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="edit_produk.php?id=<?php echo htmlspecialchars($row['product_id']); ?>" class="button edit">✏️ Edit</a>
                                <a href="hapus_produk.php?id=<?php echo htmlspecialchars($row['product_id']); ?>" class="button delete">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-data">🚫 Tidak ada produk yang tersedia.</p>
        <?php } ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>

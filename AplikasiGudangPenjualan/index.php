<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gudang dan Penjualan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Barang di Gudang</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                
                if (!$conn) {
                    echo "<tr><td colspan='5'>Gagal terhubung ke database: " . mysqli_connect_error() . "</td></tr>";
                } else {
                    $query = "SELECT b.id_barang, b.nama_barang, k.nama_kategori, b.harga, b.stok 
                              FROM barang b 
                              LEFT JOIN kategori k ON b.id_kategori = k.id_kategori";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id_barang'] . "</td>";
                            echo "<td>" . $row['nama_barang'] . "</td>";
                            echo "<td>" . $row['nama_kategori'] . "</td>";
                            echo "<td>" . number_format($row['harga'], 2) . "</td>";
                            echo "<td>" . $row['stok'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Gagal menjalankan query: " . mysqli_error($conn) . "</td></tr>";
                    }

                    mysqli_close($conn);
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="sales.php" class="button">Catat Penjualan</a>
            <a href="add_item.php" class="button">Tambah Barang</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Barang Baru</h1>
        <form action="process_add_item.php" method="POST">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" required>

            <label for="id_kategori">Kategori:</label>
            <select name="id_kategori" id="id_kategori" required>
                <option value="">Pilih Kategori</option>
                <?php
                include 'config.php';
                $query = "SELECT id_kategori, nama_kategori FROM kategori";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
                }
                ?>
            </select>

            <label for="harga">Harga:</label>
            <input type="number" name="harga" id="harga" step="0.01" min="0" required>

            <label for="stok">Stok:</label>
            <input type="number" name="stok" id="stok" min="0" required>

            <div class="button-container">
                <button type="submit">Simpan Barang</button>
            </div>
        </form>
        <div class="button-container">
            <a href="index.php" class="button">Kembali</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
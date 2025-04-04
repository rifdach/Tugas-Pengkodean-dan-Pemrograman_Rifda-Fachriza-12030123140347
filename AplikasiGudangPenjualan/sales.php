<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catat Penjualan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Catat Penjualan</h1>
        <form action="process_sale.php" method="POST">
            <label for="id_pelanggan">Pelanggan:</label>
            <select name="id_pelanggan" id="id_pelanggan" required>
                <option value="">Pilih Pelanggan</option>
                <?php
                include 'config.php';
                $query = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_pelanggan'] . "'>" . $row['nama_pelanggan'] . "</option>";
                }
                ?>
            </select>

            <label for="id_barang">Barang:</label>
            <select name="id_barang" id="id_barang" required>
                <option value="">Pilih Barang</option>
                <?php
                $query = "SELECT id_barang, nama_barang FROM barang WHERE stok > 0";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_barang'] . "'>" . $row['nama_barang'] . "</option>";
                }
                ?>
            </select>

            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlah" min="1" required>

            <div class="button-container">
                <button type="submit">Simpan Penjualan</button>
            </div>
        </form>
        <div class="button-container">
            <a href="index.php" class="button">Kembali</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
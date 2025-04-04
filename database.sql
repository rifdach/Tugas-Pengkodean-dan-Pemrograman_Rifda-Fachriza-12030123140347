-- Gunakan database jika sudah ada, jika tidak maka buat baru
CREATE DATABASE IF NOT EXISTS gudang_persediaan;

-- Gunakan database gudang_persediaan
USE gudang_persediaan;

-- Tabel Produk
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    stock_quantity INT DEFAULT 0,
    price DECIMAL(10,2) NOT NULL
);

-- Tabel Pemasok
CREATE TABLE IF NOT EXISTS Suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(255) NOT NULL,
    contact_info VARCHAR(255)
);

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS Customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    contact_info VARCHAR(255)
);

-- Tabel Transaksi Stok
CREATE TABLE IF NOT EXISTS StockTransactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    transaction_type ENUM('IN', 'OUT') NOT NULL,
    quantity INT NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Menambahkan Produk Contoh jika belum ada
INSERT IGNORE INTO products (product_name, category, stock_quantity, price) VALUES
('Laptop', 'Elektronik', 10, 750.00),
('Mouse', 'Aksesoris', 50, 15.00),
('Keyboard', 'Aksesoris', 30, 25.00);

-- Menambahkan Pemasok Contoh jika belum ada
INSERT IGNORE INTO Suppliers (supplier_name, contact_info) VALUES
('PT Elektronik Jaya', 'email@elektronikjaya.com'),
('PT Aksesoris Makmur', 'email@aksesorismakmur.com');

-- Menambahkan Pelanggan Contoh jika belum ada
INSERT IGNORE INTO Customers (customer_name, contact_info) VALUES
('John Doe', 'john.doe@email.com'),
('Jane Smith', 'jane.smith@email.com');

-- Menambahkan Transaksi Stok (Produk Masuk) jika belum ada
INSERT IGNORE INTO StockTransactions (product_id, transaction_type, quantity) VALUES
(1, 'IN', 5),
(2, 'IN', 20);

-- Menampilkan Produk dan Stok
SELECT * FROM products;

-- Menampilkan Transaksi Stok
SELECT * FROM StockTransactions;

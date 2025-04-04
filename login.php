<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Admin username dan password
    $admin_username = 'admin';
    $admin_password = 'admin123';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login berhasil sebagai Admin!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Login gagal. Username atau password salah.'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gudang_persediaan.css">
    <title>Login Admin</title>
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #d63031;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #6c5ce7;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        .button {
            background-color: #e84393;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #ff7675;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Admin</h1>
        <form method="post" action="login.php">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit" class="button">Login</button>
        </form>
    </div>
</body>
</html>

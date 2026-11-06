<?php
include 'koneksi.php';

$pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];
    $full_name = trim($_POST['full_name']);

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, full_name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password_hash, $full_name);

    if ($stmt->execute()) {
        $pesan = "Registrasi berhasil! Silakan <a href='login.php'>Login</a>";
    } else {
        $pesan = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Chizu House</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-header">
            <h2>Buat Akun Baru</h2>
            <p style="color: red;"><?php echo $pesan; ?></p>
        </div>
        <form action="register.php" method="POST" class="login-form">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Contoh: admin_toko">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="admin@chizuhouse.com">
            </div>
            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" required placeholder="Password">
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="full_name" placeholder="Nama Toko / Admin">
            </div>
            <button type="submit" class="btn-submit">Daftar</button>
        </form>
        <div class="login-footer">
            <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
        </div>
    </div>
</body>
</html>
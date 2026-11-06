<?php
session_start();
require_once 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cari user berdasarkan username atau email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password hash
        if (password_verify($password, $user['password_hash'])) {
            // Set session login sukses
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];

            // Arahkan ke halaman utama toko
            header("Location: index.php");
            exit();
        } else {
            // Password Salah -> Redirect dengan parameter error
            header("Location: login.php?error=wrong_password");
            exit();
        }
    } else {
        // Username tidak ditemukan -> Redirect dengan parameter error
        header("Location: login.php?error=user_not_found");
        exit();
    }
}
?>
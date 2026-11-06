<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chizu House</title>
    <!-- CSS Utama Website -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Styling Tambahan Khusus Halaman Login Agar Rapi & Tidak Aneh -->
    <style>
        body.login-page-custom {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: #f9f6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-box {
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .login-box-header {
            text-align: center;
            margin-bottom: 25px;
        }
        .login-box-header img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        .login-box-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: #1f2937;
            margin: 0;
        }
        .custom-form-group {
            margin-bottom: 18px;
        }
        .custom-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .custom-form-group input {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }
        .custom-form-group input:focus {
            border-color: #d97706;
        }
        .custom-btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #d97706;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s;
        }
        .custom-btn-submit:hover {
            background-color: #b45309;
        }
        .login-box-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6b7280;
        }
        .login-box-footer a {
            color: #d97706;
            text-decoration: none;
            font-weight: 600;
        }
        .login-box-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="login-page-custom">

    <div class="login-box">
        <div class="login-box-header">
            <img src="assets/brand/chizu-house-logo.png" alt="Logo Chizu House">
            <h2>Masuk ke Akun</h2>
        </div>

        <form action="login_process.php" method="POST">
            <div class="custom-form-group">
                <label for="username">Email / Username</label>
                <input type="text" id="username" name="username" required placeholder="Masukkan email atau username">
            </div>

            <div class="custom-form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi">
            </div>

            <button type="submit" class="custom-btn-submit">Masuk</button>
        </form>

        <div class="login-box-footer">
            <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
        </div>
    </div>

<!-- MODAL POPUP ERROR LOGIN (Salah Password / Username) -->
    <div id="login-error-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.75); z-index: 1005; justify-content: center; align-items: center; pointer-events: none;">
        <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; max-width: 420px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.3); pointer-events: auto;">
            
            <!-- Icon Silang / Peringatan Merah -->
            <div style="width: 70px; height: 70px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 20px auto;">
                ✕
            </div>

            <h3 style="margin-top: 0; font-family: 'Playfair Display', serif; color: #1f2937; font-size: 24px; margin-bottom: 10px;">Login Gagal</h3>
            <p id="login-error-message" style="font-size: 15px; color: #6b7280; margin-bottom: 25px; line-height: 1.5;">Username atau password yang Anda masukkan salah. Silakan coba lagi.</p>
            
            <button onclick="closeLoginErrorModal()" style="width: 100%; padding: 12px; background-color: #ef4444; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 16px;">Coba Lagi</button>
        </div>
    </div>
    <!-- END MODAL POPUP ERROR LOGIN -->

    <script>
        // Cek URL secara otomatis saat halaman login dimuat
        window.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');

            if (error) {
                const errorModal = document.getElementById('login-error-modal');
                const errorMsg = document.getElementById('login-error-message');

                if (error === 'wrong_password') {
                    errorMsg.innerText = 'Password yang Anda masukkan salah. Periksa kembali sandi Anda.';
                } else if (error === 'user_not_found') {
                    errorMsg.innerText = 'Username atau email tidak terdaftar di sistem Chizu House.';
                }

                if (errorModal) {
                    errorModal.style.display = 'flex';
                    errorModal.style.pointerEvents = 'auto';
                }
            }
        });

        // Fungsi untuk menutup modal error dan membersihkan URL
        function closeLoginErrorModal() {
            const errorModal = document.getElementById('login-error-modal');
            if (errorModal) {
                errorModal.style.display = 'none';
                errorModal.style.pointerEvents = 'none';
            }
            // Hapus parameter error dari URL agar tidak muncul terus saat di-refresh
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>

</body>
</html>
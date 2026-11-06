<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chizu House - Cheese snacks dan makanan lezat.">
    <title>Chizu House | Lezatnya Keju, Bikin Semua Happy!</title>
    <link rel="icon" type="image/jpeg" href="assets/brand/chizu-house-logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

    <div class="announcement">
        🧀 CHIZU HOUSE · LEZATNYA KEJU, BIKIN SEMUA HAPPY!
    </div>

    <header class="header">
        <a href="#home" class="logo logo-brand"><img src="assets/brand/chizu-house-logo.png" alt="Logo Chizu House"><span>chizu house</span></a>

        <nav class="nav" id="nav">
            <a href="#home" onclick="closeMenu()">Beranda</a>
            <a href="#categories" onclick="closeMenu()">Kategori</a>
            <a href="#products" onclick="closeMenu()">Menu</a>
            <a href="#about" onclick="closeMenu()">Tentang</a>
        </nav>

        <div class="header-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Tampilan Jika User Sudah Login -->
                <div class="user-greeting" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 600; color: #d97706; font-size: 14px;">
                    <span>👋 Halo, <?php echo htmlspecialchars($_SESSION['full_name'] ?: $_SESSION['username']); ?></span>
                    <a href="logout.php" style="text-decoration: none; padding: 4px 10px; font-size: 12px; background-color: #ef4444; color: white; border-radius: 4px;">Keluar</a>
                </div>
            <?php else: ?>
                <!-- Tampilan Jika User Belum Login -->
                <a href="login.php" class="login-btn" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Masuk</a>
            <?php endif; ?>

            <button class="cart-btn" onclick="toggleCart()">
                Keranjang <span id="cart-count">0</span>
            </button>
            <button class="menu-btn" onclick="toggleMenu()">☰</button>
        </div>
    </header>

    <main>
        <section class="hero" id="home">
            <div class="hero-content reveal">
                <span class="eyebrow">HOMEMADE CHEESY FAVORITES</span>
                <h1>Lezatnya keju.<br><em>Bikin happy!</em></h1>
                <p>Temukan camilan dan makanan favorit dengan rasa keju yang menggugah selera. Dibuat dengan penuh cinta untuk menemani momen spesialmu.</p>
                <a href="#products" class="primary-btn">Jelajahi Menu <span aria-hidden="true">↗</span></a>

                <div class="hero-info">
                    <div><strong>Fresh</strong><small>Dibuat dengan cinta</small></div>
                    <div><strong>Cheesy</strong><small>Rasa yang bikin happy</small></div>
                </div>
            </div>

            <div class="hero-image reveal">
                <img src="assets/brand/logo_utama.jpeg"
                     alt="Lumpia Kornet Mozzarella Chizu House">
                <div class="image-label">
                    <span>✦</span>
                    <div>
                        <strong>Made with love</strong>
                        <small>Lezatnya di setiap gigitan</small>
                    </div>
                </div>
            </div>
        </section>

        <section class="categories section" id="categories">
            <div class="section-heading reveal">
                <div>
                    <span class="eyebrow">PILIH FAVORITMU</span>
                    <h2>Temukan Favoritmu</h2>
                </div>
                <p>Empat pilihan lezat, satu harga spesial.</p>
            </div>

            <div class="category-list">
                <button class="category-card active" onclick="filterCategory('All', this)">
                    <span>✦</span><strong>Semua Menu</strong>
                </button>
                <button class="category-card" onclick="filterCategory('Snack', this)">
                    <span>🥟</span><strong>Camilan</strong>
                </button>
                <button class="category-card" onclick="filterCategory('Cheese', this)">
                    <span>🧀</span><strong>Cheesy</strong>
                </button>
                <button class="category-card" onclick="filterCategory('Meal', this)">
                    <span>🍱</span><strong>Makanan</strong>
                </button>
            </div>
        </section>

        <section class="products section" id="products">
            <div class="section-heading reveal">
                <div>
                    <span class="eyebrow">MENU CHIZU HOUSE</span>
                    <h2>Semua Menu</h2>
                </div>
                <input type="search" id="search-input"
                       placeholder="Cari menu favorit..."
                       oninput="searchProducts(this.value)">
            </div>

            <div class="product-grid" id="product-grid"></div>
        </section>

        <section class="about section" id="about">
            <span class="eyebrow">CERITA CHIZU HOUSE</span>
            <h2>Lezatnya keju,<br><em>bikin semua happy!</em></h2>
            <p>Chizu House hadir untuk menemani harimu dengan camilan dan makanan bercita rasa keju. Setiap menu disiapkan dengan sepenuh hati agar setiap gigitan jadi momen yang menyenangkan.</p>
        </section>
    </main>

    <footer class="footer">
        <a href="#home" class="logo logo-brand footer-brand"><img src="assets/brand/chizu-house-logo.png" alt="Logo Chizu House"><span>chizu house</span></a>
        <p>© 2026 Chizu House. Lezatnya Keju, Bikin Semua Happy!</p>
        <a href="#home">Back to top ↑</a>
    </footer>

    <!-- Cart Overlay & Panel -->
    <div class="cart-overlay" id="cart-overlay" onclick="toggleCart()"></div>

    <aside class="cart-panel" id="cart-panel">
        <div class="cart-heading">
            <h2>Keranjang Belanja</h2>
            <button onclick="toggleCart()">✕</button>
        </div>
        <div id="cart-items"></div>
        <div class="cart-bottom">
            <div class="total-row">
                <strong>Total</strong>
                <strong id="cart-total">Rp0</strong>
            </div>
            <button class="primary-btn checkout-btn" onclick="checkout()">
                Checkout ↗
            </button>
        </div>
    </aside>

    <div class="toast" id="toast"></div>

    <!-- MODAL PEMBAYARAN QR TOKO (2 Kolom: Gambar Besar di Kiri) -->
    <div id="payment-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.75); z-index: 1000; justify-content: center; align-items: center; pointer-events: none;">
        <div style="background: white; padding: 40px; border-radius: 20px; text-align: left; max-width: 780px; width: 95%; box-shadow: 0 20px 40px rgba(0,0,0,0.3); pointer-events: auto; display: flex; gap: 40px; align-items: center; flex-wrap: wrap;">
            
            <!-- Kolom Kiri: Gambar QR Code (Sangat Besar) -->
            <div style="flex: 1.2; text-align: center; min-width: 300px;">
                <h3 style="margin-top: 0; margin-bottom: 15px; font-family: 'Playfair Display', serif; color: #1f2937; font-size: 22px;">Scan QRIS</h3>
                <img src="assets/brand/qr-code.jpeg" alt="QR Code Toko" style="width: 340px; height: 340px; object-fit: contain; border: 2px solid #e5e7eb; border-radius: 12px; padding: 12px; background: #fafafa;">
            </div>

            <!-- Kolom Kanan: Informasi Total & Tombol Aksi -->
            <div style="flex: 1; min-width: 260px; display: flex; flex-direction: column; justify-content: center;">
                <h3 style="margin-top: 0; font-family: 'Playfair Display', serif; color: #1f2937; font-size: 22px;">Konfirmasi Pembayaran</h3>
                <p style="font-size: 15px; color: #6b7280; margin-bottom: 20px; line-height: 1.6;">Silakan scan QR di samping menggunakan aplikasi e-wallet atau mobile banking Anda.</p>
                
                <div id="payment-total-text" style="font-weight: bold; font-size: 20px; color: #d97706; margin-bottom: 25px; background: #fffbeb; padding: 15px; border-radius: 10px; border: 1px solid #fef3c7;">Total: Rp0</div>
                
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <button onclick="confirmPayment()" style="width: 100%; padding: 14px; background-color: #10b981; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 16px;">Konfirmasi Pembayaran</button>
                    <button onclick="closePaymentModal()" style="width: 100%; padding: 14px; background-color: #ef4444; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 16px;">Tutup</button>
                </div>
            </div>

        </div>
    </div>
    <!-- END MODAL PEMBAYARAN -->

    <!-- MODAL POPUP SUKSES PEMBAYARAN -->
    <div id="success-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.75); z-index: 1001; justify-content: center; align-items: center; pointer-events: none;">
        <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; max-width: 420px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.3); pointer-events: auto;">
            
            <!-- Icon Centang Sukses -->
            <div style="width: 70px; height: 70px; background: #d1fae5; color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 36px; margin: 0 auto 20px auto;">
                ✓
            </div>

            <h3 style="margin-top: 0; font-family: 'Playfair Display', serif; color: #1f2937; font-size: 24px; margin-bottom: 10px;">Pembayaran Berhasil!</h3>
            <p style="font-size: 15px; color: #6b7280; margin-bottom: 25px; line-height: 1.5;">Terima kasih telah berbelanja di Chizu House. Pesanan Anda sedang diproses.</p>
            
            <button onclick="closeSuccessModal()" style="width: 100%; padding: 12px; background-color: #10b981; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 16px;">Selesai</button>
        </div>
    </div>
    <!-- END MODAL POPUP SUKSES -->

    <!-- MODAL POPUP PERINGATAN LOGIN -->
    <div id="login-alert-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.75); z-index: 1002; justify-content: center; align-items: center; pointer-events: none;">
        <div style="background: white; padding: 40px; border-radius: 20px; text-align: center; max-width: 420px; width: 90%; box-shadow: 0 20px 40px rgba(0,0,0,0.3); pointer-events: auto;">
            
            <!-- Icon Kunci / Peringatan -->
            <div style="width: 70px; height: 70px; background: #fef3c7; color: #d97706; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 20px auto;">
                🔒
            </div>

            <h3 style="margin-top: 0; font-family: 'Playfair Display', serif; color: #1f2937; font-size: 24px; margin-bottom: 10px;">Login Diperlukan</h3>
            <p style="font-size: 15px; color: #6b7280; margin-bottom: 25px; line-height: 1.5;">Silakan masuk (login) terlebih dahulu untuk mulai memesan menu favorit di Chizu House!</p>
            
            <div style="display: flex; gap: 10px;">
                <a href="login.php" style="flex: 1; padding: 12px; background-color: #d97706; color: white; text-decoration: none; border-radius: 10px; font-weight: 600; display: inline-block; font-size: 15px;">Masuk Sekarang</a>
                <button onclick="closeLoginAlertModal()" style="flex: 1; padding: 12px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 15px;">Nanti Saja</button>
            </div>
        </div>
    </div>
    <!-- END MODAL POPUP PERINGATAN LOGIN -->
    
    <!-- VARIABEL STATUS LOGIN UNTUK JAVASCRIPT -->
    <script>
        const isUserLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>

    <!-- JavaScript Files -->
    <script src="js/products.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
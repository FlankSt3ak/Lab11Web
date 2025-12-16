<style>
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 50px;
        text-align: center;
        margin: 30px 0;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    .welcome-card h1 {
        font-size: 42px;
        margin-bottom: 15px;
    }
    .welcome-card p {
        font-size: 18px;
        opacity: 0.95;
        margin-bottom: 30px;
    }
    .btn-custom {
        display: inline-block;
        padding: 15px 40px;
        background: white;
        color: #667eea;
        text-decoration: none;
        border-radius: 30px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        margin: 5px;
    }
    .btn-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 40px;
    }
    .feature-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .feature-card:hover {
        transform: translateY(-5px);
    }
    .feature-card .icon {
        font-size: 48px;
        margin-bottom: 15px;
    }
    .feature-card h3 {
        color: #667eea;
        margin-bottom: 10px;
    }
</style>

<div class="welcome-card">
    <h1>🎉 Selamat Datang!</h1>
    <p>Sistem Manajemen Data Barang dengan PHP OOP Framework</p>
    
    <?php if (isset($_SESSION['is_login'])): ?>
        <p>Halo, <strong><?php echo $_SESSION['nama']; ?></strong>! 👋</p>
        <a href="/lab11_php_oop/barang/index" class="btn-custom">📦 Kelola Data Barang</a>
        <a href="/lab11_php_oop/user/profile" class="btn-custom">👤 Lihat Profil</a>
    <?php else: ?>
        <p>Silakan login untuk mengakses sistem</p>
        <a href="/lab11_php_oop/user/login" class="btn-custom">🔐 Login Sekarang</a>
    <?php endif; ?>
</div>

<div class="features">
    <div class="feature-card">
        <div class="icon">🔐</div>
        <h3>Autentikasi Aman</h3>
        <p>Login dengan password terenkripsi menggunakan bcrypt</p>
    </div>
    
    <div class="feature-card">
        <div class="icon">📦</div>
        <h3>Manajemen Barang</h3>
        <p>CRUD lengkap untuk mengelola data barang dengan mudah</p>
    </div>
    
    <div class="feature-card">
        <div class="icon">🎨</div>
        <h3>Desain Modern</h3>
        <p>Interface yang clean dan user-friendly</p>
    </div>
    
    <div class="feature-card">
        <div class="icon">⚡</div>
        <h3>Framework Modular</h3>
        <p>Struktur kode yang rapi dan mudah dikembangkan</p>
    </div>
</div>
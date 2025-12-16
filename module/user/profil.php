<?php
// Cek login
if (!isset($_SESSION['is_login'])) {
    header('Location: /lab11_php_oop/user/login');
    exit;
}

$db = new Database();
$message = "";
$message_type = "";

// Ambil data user dari database
$user = $db->get('users', "id = '" . $_SESSION['user_id'] . "'");

// Proses Update Password
if ($_POST && isset($_POST['update_password'])) {
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $password_konfirmasi = $_POST['password_konfirmasi'];
    
    // Validasi panjang password
    if (strlen($password_baru) < 6) {
        $message = "Password baru minimal 6 karakter!";
        $message_type = "error";
    }
    // Verifikasi password lama
    elseif (password_verify($password_lama, $user['password'])) {
        // Cek password baru dan konfirmasi sama
        if ($password_baru === $password_konfirmasi) {
            // Hash password baru
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            
            // Update ke database dengan escaping
            $user_id = $db->escapeString($_SESSION['user_id']);
            $update = $db->update('users', ['password' => $password_hash], "id = '{$user_id}'");
            
            if ($update) {
                $message = "Password berhasil diubah!";
                $message_type = "success";
                // Refresh data user
                $user = $db->get('users', "id = '{$user_id}'");
            } else {
                $message = "Gagal mengubah password!";
                $message_type = "error";
            }
        } else {
            $message = "Password baru dan konfirmasi tidak sama!";
            $message_type = "error";
        }
    } else {
        $message = "Password lama salah!";
        $message_type = "error";
    }
}
?>

<style>
    .profile-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 20px;
    }
    .card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .card h2 {
        color: #667eea;
        margin-bottom: 20px;
        font-size: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .profile-info {
        margin-bottom: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .profile-info label {
        display: block;
        font-weight: 600;
        color: #666;
        font-size: 13px;
        margin-bottom: 5px;
    }
    .profile-info .value {
        font-size: 16px;
        color: #333;
        font-weight: 500;
    }
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
    }
    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: border 0.3s;
    }
    .form-group input:focus {
        outline: none;
        border-color: #667eea;
    }
    .btn-update {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php if ($message): ?>
    <div class="alert alert-<?= $message_type ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="profile-container">
    <!-- Card Informasi Profil -->
    <div class="card">
        <h2>👤 Informasi Profil</h2>
        
        <div class="profile-info">
            <label>ID User</label>
            <div class="value"><?= $user['id'] ?></div>
        </div>
        
        <div class="profile-info">
            <label>Nama Lengkap</label>
            <div class="value"><?= $user['nama'] ?></div>
        </div>
        
        <div class="profile-info">
            <label>Username</label>
            <div class="value"><?= $user['username'] ?></div>
        </div>
        
        <div class="profile-info">
            <label>Status</label>
            <div class="value">
                <span style="background:#d4edda; color:#155724; padding:5px 12px; border-radius:15px; font-size:13px;">
                    ✅ Aktif
                </span>
            </div>
        </div>
    </div>
    
    <!-- Card Ganti Password -->
    <div class="card">
        <h2>🔒 Ganti Password</h2>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="password_lama" placeholder="Masukkan password lama" required>
            </div>
            
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password_baru" placeholder="Masukkan password baru" required>
            </div>
            
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_konfirmasi" placeholder="Konfirmasi password baru" required>
            </div>
            
            <button type="submit" name="update_password" class="btn-update">
                💾 Update Password
            </button>
        </form>
    </div>
</div>
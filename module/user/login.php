<?php
// Cek jika sudah login, redirect ke home
if (isset($_SESSION['is_login'])) {
    header('Location: /lab11_php_oop/home/index');
    exit;
}

$message = "";

// Logika Proses Login
if ($_POST) {
    $db = new Database();
    
    // Ambil input dan escape untuk keamanan
    $username = $db->escapeString($_POST['username']);
    $password = $_POST['password'];
    
    // Query cari user berdasarkan username
    $sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
    $result = $db->query($sql);
    
    // Cek apakah query berhasil dan ada datanya
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $data['password'])) {
            // Login Sukses: Set Session
            $_SESSION['is_login'] = true;
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            
            // Redirect ke halaman barang
            header('Location: /lab11_php_oop/barang/index');
            exit;
        } else {
            $message = "Username atau password salah!";
        }
    } else {
        $message = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            max-width: 420px;
            width: 100%;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #667eea;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        .alert {
            padding: 12px;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
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
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        .demo-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #1565c0;
        }
        .demo-info strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>🔐 Login</h2>
            <p>Sistem Manajemen Data Barang</p>
        </div>
        
        <div class="demo-info">
            <strong>Demo Account:</strong>
            Username: <strong>admin</strong><br>
            Password: <strong>admin123</strong>
        </div>
        
        <?php if ($message): ?>
            <div class="alert"><?= $message ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>👤 Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required autofocus>
            </div>
            
            <div class="form-group">
                <label>🔒 Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" class="btn-login">Login</button>
        </form>
        
        <div class="back-link">
            <a href="/lab11_php_oop/home/index">← Kembali ke Home</a>
        </div>
    </div>
</body>
</html>
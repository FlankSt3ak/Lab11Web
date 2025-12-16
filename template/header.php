<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 11 - PHP OOP Framework</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .navbar li {
            margin: 0;
        }
        .navbar a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: all 0.3s;
        }
        .navbar a:hover {
            background: #667eea;
            color: white;
        }
        .content {
            min-height: 500px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>📦 Sistem Manajemen Data Barang</h1>
            <p>Praktikum 11 - PHP OOP Framework Modular</p>
        </div>
    </div>
    
    <div class="navbar">
        <ul>
            <li><a href="<?php echo '/lab11_php_oop/home/index'; ?>">🏠 Home</a></li>
            
            <?php if (isset($_SESSION['is_login'])): ?>
                <li><a href="<?php echo '/lab11_php_oop/barang/index'; ?>">📦 Data Barang</a></li>
                <li><a href="<?php echo '/lab11_php_oop/user/profile'; ?>">👤 Profil</a></li>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['is_login'])): ?>
                <li style="margin-left: auto;"><a href="<?php echo '/lab11_php_oop/user/logout'; ?>">🚪 Logout (<?php echo $_SESSION['nama']; ?>)</a></li>
            <?php else: ?>
                <li style="margin-left: auto;"><a href="<?php echo '/lab11_php_oop/user/login'; ?>">🔐 Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
    <div class="container content">
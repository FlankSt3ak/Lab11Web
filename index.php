<?php
// Mulai Session di paling atas
session_start();

// Load konfigurasi
include "config.php";

// Include class
include "class/Database.php";
include "class/Form.php";

// ROUTING LOGIC
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';

// Memecah path menjadi array
$segments = explode('/', trim($path, '/'));

// Menentukan Module (default: home)
$mod = isset($segments[0]) && $segments[0] != '' ? $segments[0] : 'home';

// Menentukan Action/Page (default: index)
$page = isset($segments[1]) && $segments[1] != '' ? $segments[1] : 'index';

// CEK SESSION LOGIN
// Halaman yang boleh diakses tanpa login
$public_pages = ['home', 'user'];

if (!in_array($mod, $public_pages)) {
    // Jika belum login, redirect ke halaman login
    if (!isset($_SESSION['is_login'])) {
        header('Location: /lab11_php_oop/user/login');
        exit();
    }
}

// Menentukan path file modul
$file = "module/{$mod}/{$page}.php";

// LOAD TEMPLATE & KONTEN
// Jika halaman login, jangan pakai header/footer
if ($mod == 'user' && ($page == 'login' || $page == 'logout')) {
    if (file_exists($file)) {
        include $file;
    } else {
        echo 'Halaman tidak ditemukan.';
    }
} else {
    include "template/header.php";
    
    if (file_exists($file)) {
        include $file;
    } else {
        echo '<div style="padding:20px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px; margin:20px 0;">';
        echo 'Modul tidak ditemukan: ' . $mod . '/' . $page;
        echo '</div>';
    }
    
    include "template/footer.php";
}
?>
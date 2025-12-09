<?php
// Load konfigurasi
include "config.php";

// Include class
include "class/Database.php";
include "class/Form.php";

// Mulai Session
session_start();

// ROUTING LOGIC
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/barang/index';

// Memecah path menjadi array
$segments = explode('/', trim($path, '/'));

// Menentukan Module (default: barang)
$mod = isset($segments[0]) && $segments[0] != '' ? $segments[0] : 'barang';

// Menentukan Action/Page (default: index)
$page = isset($segments[1]) && $segments[1] != '' ? $segments[1] : 'index';

// Menentukan path file modul
$file = "module/{$mod}/{$page}.php";

// LOAD TEMPLATE & KONTEN
include "template/header.php";

// Cek apakah file modul ada
if (file_exists($file)) {
    include $file;
} else {
    echo '<div style="padding:20px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px; margin:20px 0;">';
    echo 'Modul tidak ditemukan: ' . $mod . '/' . $page;
    echo '</div>';
}

include "template/footer.php";
?>
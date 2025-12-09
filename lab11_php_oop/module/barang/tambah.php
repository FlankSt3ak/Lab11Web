<?php
$db = new Database();
$form = new Form("", "💾 Simpan Data");

// Logika penyimpanan data
if ($_POST) {
    $data = [
        'kategori' => $_POST['kategori'],
        'nama' => $_POST['nama'],
        'harga_beli' => $_POST['harga_beli'],
        'harga_jual' => $_POST['harga_jual'],
        'stok' => $_POST['stok'],
        'gambar' => '-' // Untuk sementara
    ];
    
    $simpan = $db->insert('data_barang', $data);
    
    if ($simpan) {
        echo '<div style="padding:15px; background:#d4edda; color:#155724; border:1px solid #c3e6cb; border-radius:5px; margin-bottom:20px;">
        ✅ Data berhasil disimpan! <a href="/lab11_php_oop/barang/index" style="color:#155724; font-weight:600;">Lihat Data</a>
        </div>';
    } else {
        echo '<div style="padding:15px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px; margin-bottom:20px;">❌ Gagal menyimpan data.</div>';
    }
}
?>

<style>
    .card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 700px;
    }
    .card h2 {
        color: #667eea;
        margin-bottom: 20px;
        font-size: 24px;
    }
    form table {
        width: 100%;
    }
    form td {
        padding: 10px 5px;
    }
    form input[type="text"],
    form input[type="number"],
    form select,
    form textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        transition: border 0.3s;
    }
    form input[type="text"]:focus,
    form input[type="number"]:focus,
    form select:focus,
    form textarea:focus {
        outline: none;
        border-color: #667eea;
    }
    form input[type="submit"] {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }
    form input[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .back-link {
        display: inline-block;
        margin-bottom: 15px;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }
    .back-link:hover {
        text-decoration: underline;
    }
</style>

<a href="/lab11_php_oop/barang/index" class="back-link">← Kembali ke Daftar Barang</a>

<div class="card">
    <h2>➕ Tambah Data Barang</h2>
    
    <?php
    // Menambahkan field form
    $form->addField("kategori", "Kategori", "select", [
        'Komputer' => 'Komputer',
        'Elektronik' => 'Elektronik',
        'Hand Phone' => 'Hand Phone',
        'Peralatan Kantor' => 'Peralatan Kantor',
        'Furniture' => 'Furniture'
    ]);
    
    $form->addField("nama", "Nama Barang");
    $form->addField("harga_beli", "Harga Beli (Rp)", "number");
    $form->addField("harga_jual", "Harga Jual (Rp)", "number");
    $form->addField("stok", "Stok", "number");
    
    // Tampilkan form
    $form->displayForm();
    ?>
</div>
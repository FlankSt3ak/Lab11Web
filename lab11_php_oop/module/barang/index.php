<?php
$db = new Database();

// Cek jika ada aksi hapus
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $hapus = $db->delete('data_barang', "id_barang = '$id'");
    if ($hapus) {
        echo '<div style="padding:15px; background:#d4edda; color:#155724; border:1px solid #c3e6cb; border-radius:5px; margin-bottom:20px;">Data berhasil dihapus!</div>';
    } else {
        echo '<div style="padding:15px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px; margin-bottom:20px;">Gagal menghapus data!</div>';
    }
}

// Ambil semua data barang
$barang = $db->getAll('data_barang');
?>

<style>
    .card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .card h2 {
        color: #667eea;
        margin-bottom: 20px;
        font-size: 24px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }
    td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
    }
    tr:hover {
        background: #f8f9fa;
    }
    .btn {
        display: inline-block;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 13px;
        margin-right: 5px;
        transition: all 0.3s;
    }
    .btn-edit {
        background: #ffc107;
        color: #333;
    }
    .btn-edit:hover {
        background: #ffb300;
    }
    .btn-hapus {
        background: #dc3545;
        color: white;
    }
    .btn-hapus:hover {
        background: #c82333;
    }
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-success {
        background: #d4edda;
        color: #155724;
    }
    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }
    .badge-danger {
        background: #f8d7da;
        color: #721c24;
    }
</style>

<div class="card">
    <h2>📋 Daftar Data Barang</h2>
    
    <?php if (count($barang) > 0): ?>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kategori</th>
                <th width="20%">Nama Barang</th>
                <th width="13%">Harga Beli</th>
                <th width="13%">Harga Jual</th>
                <th width="8%">Stok</th>
                <th width="16%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($barang as $item): 
                // Tentukan badge stok
                if ($item['stok'] == 0) {
                    $badge = '<span class="badge badge-danger">Habis</span>';
                } elseif ($item['stok'] <= 5) {
                    $badge = '<span class="badge badge-warning">Sedikit</span>';
                } else {
                    $badge = '<span class="badge badge-success">Tersedia</span>';
                }
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($item['kategori']); ?></td>
                <td><?php echo htmlspecialchars($item['nama']); ?></td>
                <td>Rp <?php echo number_format($item['harga_beli'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($item['harga_jual'], 0, ',', '.'); ?></td>
                <td><?php echo $item['stok']; ?> <?php echo $badge; ?></td>
                <td>
                    <a href="/lab11_php_oop/barang/ubah?id=<?php echo $item['id_barang']; ?>" class="btn btn-edit">✏️ Edit</a>
                    <a href="/lab11_php_oop/barang/index?aksi=hapus&id=<?php echo $item['id_barang']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div style="padding:30px; text-align:center; color:#666;">
        <p style="font-size:48px;">📦</p>
        <p>Belum ada data barang. Silakan tambah data baru.</p>
    </div>
    <?php endif; ?>
</div>
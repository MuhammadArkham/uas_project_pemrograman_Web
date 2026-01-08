<?php
/**
 * REVISI PROFESIONAL: PROTEKSI AKSES & VALIDASI
 */

// 1. Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Akses Ditolak! Anda harus login sebagai Admin.'); 
            window.location='?mod=auth&page=login';
          </script>";
    exit;
}

if (isset($_POST['simpan'])) {
    $db = new Database();

    // 2. Sanitasi input sederhana (Mencegah XSS)
    $nama       = htmlspecialchars($_POST['nama']);
    $kategori   = htmlspecialchars($_POST['kategori']);
    $harga_beli = (int)$_POST['harga_beli'];
    $harga_jual = (int)$_POST['harga_jual'];
    $stok       = (int)$_POST['stok'];

    $data = [
        'nama'       => $nama,
        'kategori'   => $kategori,
        'harga_beli' => $harga_beli,
        'harga_jual' => $harga_jual,
        'stok'       => $stok,
        'gambar'     => 'default_product.jpg' 
    ];

    if ($db->insert('barang', $data)) {
        echo "<script>
                alert('Produk [$nama] berhasil ditambahkan ke database!'); 
                window.location='?mod=barang&page=katalog';
              </script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk. Silahkan coba lagi.');</script>";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 border-0 shadow-lg" 
             style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(15px); border: 1px solid rgba(6, 182, 212, 0.2) !important;">
            
            <div class="d-flex align-items-center mb-4">
                <div style="width: 5px; height: 30px; background: var(--neon-teal); margin-right: 15px;"></div>
                <h3 class="text-white mb-0" style="font-family: 'Orbitron'; letter-spacing: 1px;">INPUT DATA PRODUK</h3>
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-info fw-bold" style="font-family: 'Rajdhani';">NAMA PRODUK</label>
                    <input type="text" name="nama" class="form-control bg-dark text-white border-secondary focus-teal" 
                           placeholder="Contoh: Asus ROG Zephyrus" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-info fw-bold" style="font-family: 'Rajdhani';">KATEGORI</label>
                    <select name="kategori" class="form-select bg-dark text-white border-secondary">
                        <option value="Laptop">Laptop</option>
                        <option value="Smartphone">Smartphone</option>
                        <option value="Komputer">Komputer</option>
                        <option value="Aksesoris">Aksesoris</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-info fw-bold" style="font-family: 'Rajdhani';">HARGA BELI</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary text-white border-0">Rp</span>
                            <input type="number" name="harga_beli" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-info fw-bold" style="font-family: 'Rajdhani';">HARGA JUAL</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary text-white border-0">Rp</span>
                            <input type="number" name="harga_jual" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label text-info fw-bold" style="font-family: 'Rajdhani';">STOK AWAL</label>
                        <input type="number" name="stok" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="?mod=barang&page=katalog" class="btn btn-outline-secondary px-4 fw-bold">BATAL</a>
                    <button type="submit" name="simpan" class="btn btn-teal flex-grow-1 fw-bold py-2 shadow-sm">
                        <i class="bi bi-save me-2"></i>SIMPAN DATA KE SYSTEM
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .focus-teal:focus {
        border-color: var(--neon-teal) !important;
        box-shadow: 0 0 10px rgba(6, 182, 212, 0.3);
    }
    .form-control, .form-select {
        border-radius: 8px;
        transition: 0.3s;
    }
</style>
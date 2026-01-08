<?php
/**
 * REVISI PROFESIONAL: KATALOG PRODUK
 * Perbaikan: Navigasi Pencarian (Sinkronisasi GET & Reset Halaman)
 */
$db = new Database();

// 1. Pengaturan Pagination & Keyword
$batas = 8; 
$keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : "";
$where = $keyword ? "WHERE nama LIKE '%$keyword%' OR kategori LIKE '%$keyword%'" : "";

// 2. Hitung Total Data Terlebih Dahulu
$query_total = $db->query("SELECT COUNT(*) as total FROM barang $where");
$total_data = $query_total->fetch_assoc()['total'];
$total_halaman = ceil($total_data / $batas);

// 3. Logika Reset Halaman
$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
if ($halaman > $total_halaman && $total_halaman > 0) {
    $halaman = 1;
}
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// 4. Eksekusi Query Produk
$sql = "SELECT * FROM barang $where ORDER BY id_barang DESC LIMIT $halaman_awal, $batas";
$result = $db->query($sql);
?>

<div class="row mb-5 align-items-center" style="border-left: 4px solid var(--neon-teal); background: linear-gradient(90deg, rgba(6, 182, 212, 0.1) 0%, transparent 100%); padding: 25px 20px; border-radius: 0 15px 15px 0; border-bottom: 1px solid rgba(6, 182, 212, 0.1);">
    <div class="col-md-6">
        <h2 class="mb-0" style="font-family: 'Orbitron'; color: #fff; letter-spacing: 2px; font-weight: 700; text-shadow: 0 0 15px rgba(6, 182, 212, 0.4);">
            KATALOG <span style="color: var(--neon-teal);">PRODUK</span>
        </h2>
        <div class="mt-2 d-flex gap-3 text-dim small" style="font-family: 'Rajdhani'; opacity: 0.8;">
            <span><i class="bi bi-cpu-fill me-1 text-info"></i> TOTAL: <?= $total_data ?> UNIT TERSEDIA</span>
            <span class="d-none d-sm-inline">|</span>
            <span><i class="bi bi-shield-check-fill me-1 text-info"></i> PRODUK ORIGINAL</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex justify-content-md-end justify-content-between align-items-center gap-3 mt-3 mt-md-0">
            <form method="GET" class="d-flex" style="flex: 1; max-width: 350px;">
                <input type="hidden" name="mod" value="barang">
                <input type="hidden" name="page" value="katalog">
                <div class="input-group border border-secondary rounded overflow-hidden" style="background: rgba(15, 23, 42, 0.8);">
                    <input type="text" name="keyword" 
                           class="form-control bg-transparent text-white border-0 shadow-none" 
                           placeholder="Cari perangkat..." 
                           value="<?= $keyword ?>"
                           style="font-family: 'Rajdhani';">
                    <button type="submit" class="btn text-info border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
            
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="?mod=barang&page=tambah" class="btn btn-teal px-4 fw-bold shadow-sm" style="font-family: 'Rajdhani'; transition: 0.3s; letter-spacing: 1px;">
                    + DATA BARU
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row g-4">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-lg position-relative overflow-hidden product-card" 
                 style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; transition: 0.3s;">
                
                <div class="position-absolute top-0 end-0 m-2 z-3 px-2 py-1 rounded border border-info" 
                     style="background: rgba(15, 23, 42, 0.9); color: var(--neon-teal); font-size: 0.6rem; font-weight: bold; font-family: 'Orbitron';">
                    <?= strtoupper($row['kategori']) ?>
                </div>

                <div class="img-container" style="height: 200px; overflow: hidden; background: #000;">
                    <img src="img/<?= $row['gambar']; ?>" 
                         alt="<?= $row['nama']; ?>" 
                         class="w-100 h-100" 
                         style="object-fit: cover; transition: 0.5s;"
                         onerror="this.src='https://via.placeholder.com/300x300?text=Hardware';">
                </div>

                <div class="card-body p-3 d-flex flex-column text-start">
                    <h6 class="text-white mb-1 text-truncate" title="<?= $row['nama'] ?>" style="font-weight: 700; font-family: 'Rajdhani'; letter-spacing: 0.5px;">
                        <?= $row['nama'] ?>
                    </h6>
                    
                    <h5 class="mb-3" style="color: var(--neon-teal); font-family: 'Orbitron'; font-size: 1rem; text-shadow: 0 0 10px rgba(6, 182, 212, 0.2);">
                        Rp <?= number_format($row['harga_jual'], 0, ',', '.') ?>
                    </h5>

                    <div class="mb-3">
                        <span class="text-dim small" style="font-family: 'Rajdhani';">
                            <i class="bi bi-stack me-1 text-info"></i> Stok: <?= $row['stok'] ?> Unit
                        </span>
                    </div>

                    <div class="mt-auto">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <div class="d-grid gap-2 d-md-flex">
                                <a href="?mod=barang&page=edit&id=<?= $row['id_barang'] ?>" class="btn btn-sm btn-outline-warning flex-grow-1" style="border-radius: 6px;">Edit</a>
                                <a href="?mod=barang&page=hapus&id=<?= $row['id_barang'] ?>" class="btn btn-sm btn-outline-danger flex-grow-1" style="border-radius: 6px;" onclick="return confirm('Hapus?')">Hapus</a>
                            </div>
                        <?php elseif(isset($_SESSION['is_login'])): ?>
                            <button onclick="alert('Item berhasil masuk keranjang!')" class="btn btn-teal w-100 fw-bold py-2 shadow-sm" style="font-family: 'Rajdhani'; letter-spacing: 1px;">
                                BELI SEKARANG
                            </button>
                        <?php else: ?>
                            <a href="?mod=auth&page=login" class="btn btn-outline-info w-100 fw-bold py-2 shadow-sm" style="font-family: 'Rajdhani';" onclick="return confirm('Anda harus login terlebih dahulu. Lanjutkan ke Login?')">
                                BELI SEKARANG
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 py-5 text-center">
            <h4 style="font-family: 'Orbitron'; color: var(--text-dim); opacity: 0.5;">PRODUK TIDAK DITEMUKAN</h4>
            <a href="?mod=barang&page=katalog" class="btn btn-outline-info mt-3 btn-sm">RESET PENCARIAN</a>
        </div>
    <?php endif; ?>
</div>

<?php if ($total_halaman > 1): ?>
<nav class="mt-5 mb-5">
    <ul class="pagination justify-content-center">
        <?php for($x=1; $x<=$total_halaman; $x++): ?>
            <li class="page-item <?= ($halaman==$x)?'active':'' ?> mx-1">
                <a class="page-link rounded shadow-sm border-0" 
                   href="?mod=barang&page=katalog&hal=<?= $x ?>&keyword=<?= urlencode($keyword) ?>" 
                   style="background: <?= ($halaman==$x)?'var(--neon-teal)':'rgba(255,255,255,0.05)' ?>; 
                          color: <?= ($halaman==$x)?'#000':'#fff' ?>; 
                          font-weight: bold; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                   <?= $x ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<style>
    .product-card:hover {
        transform: translateY(-8px);
        border-color: var(--neon-teal) !important;
        box-shadow: 0 15px 35px rgba(6, 182, 212, 0.25) !important;
    }
    .product-card:hover .img-container img {
        transform: scale(1.1);
    }
    .text-dim { color: #94a3b8; }
    .btn-teal {
        background: linear-gradient(45deg, #06b6d4, #0891b2);
        color: white;
        border: none;
    }
    .btn-teal:hover { color: white; transform: scale(1.02); }
</style>
<?php
$db = new Database();

// Config Pagination
$batas = 8; 
$halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

// Search Logic
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
$where = $keyword ? "WHERE nama LIKE '%$keyword%' OR kategori LIKE '%$keyword%'" : "";

// Queries
$sql = "SELECT * FROM barang $where ORDER BY id_barang DESC LIMIT $halaman_awal, $batas";
$result = $db->query($sql);
$total_data = $db->query("SELECT * FROM barang $where")->num_rows;
$total_halaman = ceil($total_data / $batas);
?>

<div class="row mb-5 align-items-end" style="border-bottom: 1px solid rgba(6, 182, 212, 0.2); padding-bottom: 20px;">
    <div class="col-md-5">
        <h3 class="mb-0" style="font-family: 'Orbitron'; color: var(--neon-teal); letter-spacing: 2px; text-transform: uppercase; font-weight: 700; text-shadow: 0 0 15px rgba(6,182,212,0.3);">
            KATALOG PRODUK
        </h3>
    </div>
    <div class="col-md-7">
        <div class="d-flex justify-content-md-end justify-content-between align-items-center gap-3 mt-3 mt-md-0">
            <form method="POST" class="d-flex" style="flex: 1; max-width: 400px;">
                <div class="input-group">
                    <input type="text" name="keyword" 
                           class="form-control bg-transparent text-white border-secondary" 
                           placeholder="Cari produk..." 
                           value="<?= $keyword ?>"
                           style="font-family: 'Rajdhani'; border-radius: 5px 0 0 5px;">
                    <button type="submit" class="btn btn-outline-info" style="border-radius: 0 5px 5px 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="?mod=barang&page=tambah" class="btn btn-teal px-4 fw-bold shadow-sm" style="font-family: 'Rajdhani'; letter-spacing: 1px;">
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
            <div class="card h-100 border-0 shadow-lg position-relative overflow-hidden group-hover-effect" 
                 style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; transition: all 0.3s ease;">
                
                <div style="height: 220px; overflow: hidden; position: relative; border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <img src="img/<?= $row['gambar']; ?>" 
                         alt="<?= $row['nama']; ?>" 
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;"
                         onmouseover="this.style.transform='scale(1.1)'"
                         onmouseout="this.style.transform='scale(1)'"
                         onerror="this.src='https://via.placeholder.com/300x300?text=No+Image';">
                    
                    <div class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill" 
                         style="background: rgba(0,0,0,0.7); border: 1px solid var(--neon-teal); color: var(--neon-teal); font-family: 'Rajdhani'; font-size: 0.75rem; font-weight: bold; letter-spacing: 1px;">
                        <?= strtoupper($row['kategori']) ?>
                    </div>
                </div>

                <div class="card-body p-4 d-flex flex-column text-start">
                    <h5 class="text-white mb-2 text-truncate" title="<?= $row['nama'] ?>" style="font-family: 'Rajdhani'; font-weight: 700; letter-spacing: 0.5px;">
                        <?= $row['nama'] ?>
                    </h5>
                    
                    <h4 class="mb-3" style="color: var(--neon-teal); font-family: 'Orbitron'; font-size: 1.1rem; text-shadow: 0 0 10px rgba(6, 182, 212, 0.3);">
                        Rp <?= number_format($row['harga_jual']) ?>
                    </h4>

                    <div class="d-flex justify-content-between align-items-center mb-4 text-muted small" style="font-family: 'Rajdhani';">
                        <span><i class="bi bi-box-seam me-1"></i> Stok: <?= $row['stok'] ?></span>
                        <span>ID: #00<?= $row['id_barang'] ?></span>
                    </div>

                    <div class="mt-auto">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <div class="d-grid gap-2 d-md-flex">
                                <a href="?mod=barang&page=edit&id=<?= $row['id_barang'] ?>" class="btn btn-sm btn-outline-warning flex-grow-1" style="border-radius: 6px;">Edit</a>
                                <a href="?mod=barang&page=hapus&id=<?= $row['id_barang'] ?>" class="btn btn-sm btn-outline-danger flex-grow-1" style="border-radius: 6px;" onclick="return confirm('Hapus?')">Hapus</a>
                            </div>
                        <?php else: ?>
                            <button class="btn btn-teal w-100 py-2 fw-bold shadow-sm" style="border-radius: 6px; letter-spacing: 1px; transition: 0.3s;">
                                ADD TO CART
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 py-5 text-center text-muted">
            <h4 style="font-family: 'Orbitron'">DATA TIDAK DITEMUKAN</h4>
            <p>Cobalah kata kunci lain atau tambahkan produk baru.</p>
        </div>
    <?php endif; ?>
</div>

<nav class="mt-5 mb-5">
    <ul class="pagination justify-content-center">
        <?php for($x=1;$x<=$total_halaman;$x++): ?>
            <li class="page-item <?= ($halaman==$x)?'active':'' ?> mx-1">
                <a class="page-link rounded-circle d-flex align-items-center justify-content-center" 
                   href="?mod=barang&hal=<?= $x ?>" 
                   style="width: 40px; height: 40px; border: 1px solid var(--neon-teal); background: <?= ($halaman==$x)?'var(--neon-teal)':'transparent' ?>; color: <?= ($halaman==$x)?'#000':'#fff' ?>; font-weight: bold;">
                   <?= $x ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<style>
    .card:hover {
        transform: translateY(-8px); /* Efek kartu naik saat hover */
        border-color: var(--neon-teal) !important; /* Border menyala saat hover */
        box-shadow: 0 10px 30px rgba(6, 182, 212, 0.15) !important;
    }
</style>
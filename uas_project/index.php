<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

include "config.php"; //
include "class/database.php"; //
include "template/header.php"; //

$mod = isset($_GET['mod']) ? $_GET['mod'] : 'home'; //
$page = isset($_GET['page']) ? $_GET['page'] : ''; //

if (empty($page)) {
    if ($mod == 'home') {
        $page = 'dashboard'; //
    } elseif ($mod == 'barang') {
        $page = 'katalog'; //
    } else {
        $page = 'index'; //
    }
}

/** * --- SISTEM KEAMANAN (MIDDLEWARE) ---
 * Menentukan halaman mana yang bisa diakses tanpa login
 */
$public_modules = ['home', 'auth']; 
$is_public = in_array($mod, $public_modules);

// Pengecekan: Jika bukan halaman publik DAN belum login, lempar ke login
if (!$is_public && !isset($_SESSION['is_login'])) {
    // Kecuali halaman katalog produk, pengunjung boleh lihat
    if (!($mod == 'barang' && $page == 'katalog')) {
        echo "<script>alert('Sesi berakhir atau Anda belum login. Silahkan login kembali.'); window.location='?mod=auth&page=login';</script>";
        exit;
    }
}

$file = "module/" . $mod . "/" . $page . ".php"; //

if (file_exists($file)) {
    include $file; //
} else {
    echo '<div class="container text-center mt-5" style="min-height:50vh;">
            <h1 style="font-family: Orbitron; color: var(--neon-teal); font-size: 5rem;">404</h1>
            <h3 class="text-white">File Tidak Ditemukan</h3>
            <p class="text-muted">Sistem tidak dapat menemukan file: <b>'. $file .'</b></p>
          </div>'; //
}

include "template/footer.php"; //
?>
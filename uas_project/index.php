<?php
// Debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

include "config.php";
include "class/database.php";

// Template Header
include "template/header.php";

// --- LOGIKA BARU UNTUK NAMA FILE UNIK ---
$mod = isset($_GET['mod']) ? $_GET['mod'] : 'home';
$page = isset($_GET['page']) ? $_GET['page'] : '';

// Jika tidak ada parameter page, tentukan default berdasarkan modul
if (empty($page)) {
    if ($mod == 'home') {
        $page = 'dashboard'; // Default untuk home adalah dashboard.php
    } elseif ($mod == 'barang') {
        $page = 'katalog';   // Default untuk barang adalah katalog.php
    } else {
        $page = 'index';     // Default lainnya
    }
}

$file = "module/" . $mod . "/" . $page . ".php";

if (file_exists($file)) {
    include $file;
} else {
    // Tampilan Error Space Style
    echo '<div class="container text-center mt-5" style="min-height:50vh;">
            <h1 style="font-family: Orbitron; color: var(--neon-teal); font-size: 5rem;">404</h1>
            <h3 class="text-white">File Tidak Ditemukan</h3>
            <p class="text-muted">Sistem tidak dapat menemukan file: <b>'. $file .'</b></p>
            <p class="text-muted">Pastikan nama file di folder module sudah direname dengan benar.</p>
          </div>';
}

// Template Footer
include "template/footer.php";
?>
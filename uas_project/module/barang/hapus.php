<?php
// Proteksi: Cek Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Anda tidak memiliki izin untuk menghapus data!'); window.location='?mod=barang&page=katalog';</script>";
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id']; //
    $db = new Database(); //
    if($db->delete("barang", "WHERE id_barang='$id'")){ //
        echo "<script>alert('Produk telah dihapus.'); window.location='?mod=barang';</script>"; //
    }
} else {
    header("Location: ?mod=barang");
}
?>
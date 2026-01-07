<?php
$id = $_GET['id'];
$db = new Database();
if($db->delete("barang", "WHERE id_barang='$id'")){
    echo "<script>alert('Produk telah dihapus.'); window.location='?mod=barang';</script>";
}
?>
<?php
$id = $_GET['id'];
$db = new Database();
$data_barang = $db->get("barang", "id_barang='$id'")->fetch_assoc();

if(isset($_POST['update'])){
    $data = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga_beli' => $_POST['harga_beli'],
        'harga_jual' => $_POST['harga_jual'],
        'stok' => $_POST['stok']
    ];
    if($db->update('barang', $data, "id_barang='$id'")){
        echo "<script>alert('Data berhasil diperbarui!'); window.location='?mod=barang';</script>";
    }
}
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-space p-4">
            <h3 class="text-white mb-4">Edit Produk: <?= $data_barang['nama'] ?></h3>
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" value="<?= $data_barang['nama'] ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="kategori" value="<?= $data_barang['kategori'] ?>" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" value="<?= $data_barang['harga_beli'] ?>" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" value="<?= $data_barang['harga_jual'] ?>" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" value="<?= $data_barang['stok'] ?>" class="form-control">
                    </div>
                </div>
                <button type="submit" name="update" class="btn btn-teal w-100 mt-3">UPDATE DATA</button>
            </form>
        </div>
    </div>
</div>
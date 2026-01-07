<?php
if(isset($_POST['simpan'])){
    $data = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga_beli' => $_POST['harga_beli'],
        'harga_jual' => $_POST['harga_jual'],
        'stok' => $_POST['stok'],
        'gambar' => 'default_product.jpg' 
    ];
    $db = new Database();
    if($db->insert('barang', $data)){
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location='?mod=barang';</script>";
    }
}
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-space p-4">
            <h3 class="text-white mb-4">Input Produk Baru</h3>
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control text-white bg-dark">
                        <option>Laptop</option>
                        <option>Smartphone</option>
                        <option>Komputer</option>
                        <option>Aksesoris</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Stok Awal</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-teal w-100 mt-3">SIMPAN KE DATABASE</button>
            </form>
        </div>
    </div>
</div>
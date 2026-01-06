# Project UAS Pemrograman Web

Nama : Muhammad Arkhamullah Rifai Asshidiq

NIM  : 312410545

PEMROGRAMAN WEB 1



---

## 📖 Deskripsi Project
**Arkham Store** adalah aplikasi berbasis web yang dirancang untuk mengelola inventaris toko elektronik. Aplikasi ini dibangun menggunakan **PHP Native** dengan pendekatan **Object-Oriented Programming (OOP)** dan struktur **Modular** sesuai dengan ketentuan tugas.

Selain fungsionalitas CRUD (Create, Read, Update, Delete), aplikasi ini  menggunakan framework **Bootstrap 5** dengan kustomisasi *Glassmorphism*.

### 🎯 Tujuan Project
Project ini dibuat untuk memenuhi tugas Ujian Akhir Semester (UAS) mata kuliah Pemrograman Web, dengan fokus pemenuhan syarat:
1.  Implementasi konsep **OOP (Class & Object)** dalam koneksi database.
2.  Penerapan struktur **Modular** untuk kemudahan maintenance.
3.  Penggunaan **Routing App** (Pretty URL) menggunakan `.htaccess`.
4.  Desain **Responsive Mobile-First** menggunakan Bootstrap.
5.  Sistem Login Multi-Role (Admin & User).

---

## 🛠️ Teknologi yang Digunakan
* **Backend:** PHP Native (v8.x recommended)
* **Database:** MySQL / MariaDB
* **Frontend:** HTML5, CSS3, Bootstrap 5.3
* **Styling:** Custom CSS (Neon & Glassmorphism Effects)
* **Server:** Apache (XAMPP/Laragon)


## ✨ Fitur Utama

### 1. Arsitektur & Keamanan
* ✅ **OOP Database Wrapper:** Semua koneksi dan query database dibungkus dalam Class `Database.php`.
* ✅ **Modular System:** File logika dipisah berdasarkan modul (`auth`, `barang`, `home`).
* ✅ **Routing System:** URL bersih dan aman menggunakan `.htaccess` (contoh: `?mod=barang&page=katalog`).
* ✅ **Session Management:** Sistem login aman dengan validasi sesi.

### 2. Fitur Fungsional
* **Multi-Role Login:**
    * 🔐 **Admin:** Akses penuh (CRUD), Manajemen Data, Upload Gambar.
    * 👤 **User:** View Only, Searching, Filtering, Pagination.
* **Manajemen Produk (CRUD):** Tambah, Edit, Hapus, dan Lihat data barang.
* **Upload Gambar:** Fitur upload gambar produk ke server.
* **Pencarian Canggih:** Filter barang berdasarkan Nama atau Kategori.
* **Pagination:** Pembagian halaman data otomatis jika produk banyak.

---

## 📸 Dokumentasi & Screenshot Aplikasi

Berikut adalah dokumentasi lengkap alur penggunaan aplikasi:

### 1. Proses Login (Autentikasi)
Halaman login dengan validasi Role. Admin dan User memiliki dashboard yang berbeda.

![Halaman Login](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215525.png?raw=true)

### 2. Halaman Utama (Dashboard)
Tampilan awal setelah login berhasil, menampilkan ringkasan toko.

![Halaman Dashboard](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215619.png?raw=true)

### 3. Katalog Produk (Read & Pagination)
Menampilkan daftar barang dengan desain Grid. Terdapat fitur **Pagination** di bagian bawah.

![Katalog Produk](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215722.png?raw=true)
![Katalog Produk](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215809.png?raw=true)

### 4. Proses Pencarian (Filter Search)
Fitur pencarian barang berdasarkan nama atau kategori secara real-time.

![Fitur Search](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215902.png?raw=true)

### 5. Proses Tambah Data (Create) - *Admin Only*
Formulir untuk memasukkan data barang baru dan upload gambar produk.

![Form Tambah Data](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20220517.png?raw=true)
![Form Tambah Data](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20220533.png?raw=true)
### 6. Proses Edit Data (Update) - *Admin Only*
Formulir untuk mengubah informasi stok atau harga barang.

![Form Edit Data](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20220638.png?raw=true)


### 7. Hapus Data (Delete) - *Admin Only*
Validasi konfirmasi (alert) sebelum menghapus data untuk mencegah kesalahan.

![Konfirmasi Hapus](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20220719.png?raw=true)
![Produk telah di Hapus](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20220728.png?raw=true)

---

## 📂 Struktur Direktori
Struktur folder disusun rapi untuk memisahkan *Logic*, *View*, dan *Assets*:

```text
uas_project/
├── .htaccess           # Konfigurasi Routing (RewriteRule)
├── config.php          # Konfigurasi Database Credentials
├── index.php           # Main Router (Gerbang Utama Aplikasi)
├── db_toko.sql         # File Database SQL
├── README.md           # Dokumentasi Project
│
├── class/              # Core Logic (OOP)
│   └── Database.php    # Class untuk koneksi & query DB
│
├── img/                # Penyimpanan file gambar produk
│   ├── mouse.jpg
│   └── ...
│
├── module/             # Modular Business Logic
│   ├── auth/           # Login & Logout logic
│   ├── barang/         # CRUD Barang (Katalog, Tambah, Edit, Hapus)
│   └── home/           # Dashboard Page
│
└── template/           # Layout Views
    ├── header.php      # Navbar & CSS Links
    └── footer.php      # Copyright & JS Scripts

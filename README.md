# Project UAS Pemrograman Web

Nama : Muhammad Arkhamullah Rifai Asshidiq

NIM  : 312410545

PEMROGRAMAN WEB 1



---

##  Deskripsi Project
 Aplikasi ini adalah sistem berbasis web yang dirancang untuk mengelola data penjualan dan stok barang. Aplikasi dikembangkan dengan konsep Object Oriented Programming (OOP) dan struktur Modular, serta menerapkan routing aplikasi menggunakan .htaccess. Tujuan utama aplikasi ini adalah mempermudah pengelolaan data barang (gadget & komputer) secara efisien,Selain fungsionalitas CRUD (Create, Read, Update, Delete), aplikasi ini  menggunakan framework **Bootstrap 5** dan dicustom.

###  Tujuan Project
Project ini dibuat untuk memenuhi tugas Ujian Akhir Semester (UAS) mata kuliah Pemrograman Web, dengan fokus pemenuhan syarat:
1.  Implementasi konsep **OOP (Class & Object)** dalam koneksi database.
2.  Penerapan struktur **Modular** untuk kemudahan maintenance.
3.  Penggunaan **Routing App** (Pretty URL) menggunakan `.htaccess`.
4.  Desain **Responsive Mobile-First** menggunakan Bootstrap.
5.  Sistem Login Multi-Role (Admin & User).

## Link Demo Aplikasi

Aplikasi sudah di-hosting dan dapat diakses di sini:
- **URL:** http://uas-arkham-312410545.infinityfreeapp.com
- **Akun Admin:**
  - Username: admin
  - Password: admin123
    
- **Akun User:**
  - Username: user
  - Password: user123

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
```
##  Teknologi yang Digunakan
* **Backend:** PHP Native (v8.x recommended)
* **Database:** MySQL / MariaDB
* **Frontend:** HTML5, CSS3, Bootstrap 5.3
* **Styling:** Custom CSS (Neon & Glassmorphism Effects)
* **Server:** Apache (XAMPP/Laragon)


##  Fitur Utama

### 1. Arsitektur & Keamanan
*  **OOP Database Wrapper:** Semua koneksi dan query database dibungkus dalam Class `Database.php`.
*  **Modular System:** File logika dipisah berdasarkan modul (`auth`, `barang`, `home`).
*  **Routing System:** URL menggunakan `.htaccess` (contoh: `?mod=barang&page=katalog`).
*  **Session Management:** Sistem login aman dengan validasi sesi.
  
### 2. Fitur Fungsional
* **Multi-Role Login:**
    *  **Admin:** Akses penuh (CRUD), Manajemen Data, Upload Gambar.
    *  **User:** View Only, Searching, Filtering, Pagination.
* **Manajemen Produk (CRUD):** Tambah, Edit, Hapus, dan Lihat data barang.
* **Upload Gambar:** Fitur upload gambar produk ke server.
* **Pencarian Canggih:** Filter barang berdasarkan Nama atau Kategori.
* **Pagination:** Pembagian halaman data otomatis jika produk banyak.

## Pemenuhan Ketentuan UAS
Berikut adalah penjelasan teknis mengenai implementasi fitur berdasarkan syarat soal UAS:

### 1. Project Praktikum OOP dan Modular
* **OOP (Object Oriented Programming):** Sistem koneksi database tidak lagi prosedural, melainkan dibungkus dalam **Class `Database`** (`class/Database.php`) dengan properti dan method (`__construct`, `query`, dll) untuk menerapkan konsep *Encapsulation*.
* **Modular:** Struktur kode tidak menumpuk di satu file. Logika program dipecah berdasarkan fungsinya ke dalam folder `module/` (contoh: `module/auth`, `module/barang`, `module/home`).

### 2. Routing App (Menggunakan .htaccess)
* Aplikasi menggunakan teknik **Pretty URL** atau routing parameter.
* File `.htaccess` digunakan untuk konfigurasi *Rewrite Rule* agar URL lebih bersih dan aman.
* Logika routing utama berada di `index.php` yang menggunakan `switch-case` untuk memanggil modul dinamis (`index.php?mod=barang&page=add`).

### 3. Desain Responsive (Mobile First & Framework CSS)
* **Framework:** Menggunakan **Twitter Bootstrap 5.3** untuk tata letak Grid System.
* **Responsive:** Tampilan otomatis menyesuaikan layar HP, Tablet, dan Desktop (Mobile First Approach).
* **Custom Design:** Desain disempurnakan dengan tema *Dark Neon* & *Glassmorphism* (efek kaca transparan) agar lebih modern dan tidak kaku seperti template bawaan.

### 4. Sistem Login dengan Role Admin dan User
* Menggunakan **PHP Session** untuk menyimpan status login.
* **Logic Role:**
    * **Admin:** Diarahkan ke dashboard dengan akses penuh (Tombol Tambah/Edit/Hapus muncul).
    * **User:** Diarahkan ke dashboard katalog belanja (Tombol manipulasi data disembunyikan/diproteksi).

### 5. Fungsionalitas Lengkap (CRUD, Filter, Pagination)
* **CRUD:** Admin sukses melakukan Create (Upload Gambar), Read (Lihat Data), Update (Edit Data), dan Delete (Hapus Data).
* **Filter Pencarian:** Menggunakan Query SQL `LIKE` untuk mencari nama barang atau kategori secara real-time.
* **Pagination:** Menggunakan logika `LIMIT` dan `OFFSET` pada SQL untuk membatasi jumlah produk per halaman agar loading website tetap ringan.
  

---






##  Implementasi Kode Utama
Berikut adalah cuplikan kode penting yang menunjukkan penerapan konsep **OOP** dan **Modular** dalam aplikasi ini:



### 1. Penerapan OOP (Koneksi Database)
Menggunakan Class `Database` untuk membungkus koneksi MySQLi, sehingga penulisan kode lebih rapi dan aman (*Encapsulation*).

```php
// File: class/Database.php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "db_toko";
    public $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
        
        if ($this->mysqli->connect_error) {
            die("Koneksi gagal: " . $this->mysqli->connect_error);
        }
    }
}

```

### 2. Penerapan Modular & Routing

Menggunakan logika `switch-case` pada `index.php` untuk memanggil modul berdasarkan parameter URL. Ini membuat URL lebih bersih dan terstruktur.

```php
// File: index.php
$mod = isset($_GET['mod']) ? $_GET['mod'] : 'home';

switch ($mod) {
    case 'home':
        include 'module/home/index.php';
        break;
    case 'barang':
        include 'module/barang/index.php';
        break;
    case 'auth':
        include 'module/auth/index.php';
        break;
    default:
        include 'module/home/index.php';
        break;
}

```

### 3. Kustomisasi UI 

Kode CSS untuk menciptakan efek kartu transparan yang futuristik pada halaman Katalog.

```css
/* File: template/header.php (Style Block) */
.card-space {
    background: rgba(30, 41, 59, 0.7); /* Transparan */
    backdrop-filter: blur(10px);        /* Efek Blur Kaca */
    border: 1px solid rgba(6, 182, 212, 0.3); /* Border Neon */
    box-shadow: 0 0 15px rgba(6, 182, 212, 0.1);
}

.text-neon {
    color: #06b6d4;
    text-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
    font-family: 'Orbitron', sans-serif;
}


---


---
```
##  Dokumentasi & Screenshot Aplikasi

Berikut adalah dokumentasi lengkap alur penggunaan aplikasi:

### 1. Proses Login (Autentikasi)
Halaman login dengan validasi Role. Admin dan User memiliki dashboard yang berbeda.

![Halaman Login](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215525.png?raw=true)

### 2. Halaman Utama (Dashboard)
Tampilan awal setelah login berhasil, menampilkan ringkasan toko.

![Halaman Dashboard](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215619.png?raw=true)

### 3. Katalog Produk (Read & Pagination)
Menampilkan daftar barang dengan desain Grid. Terdapat fitur **Pagination** di bagian bawah.
#### Tampilan dari sisi user :
![Katalog Produk](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-06%20215722.png?raw=true)
![Katalog Produk](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-07%20020130.png?raw=true)
#### Tampilan dari sisi admin :
![Katalog Produk](https://github.com/MuhammadArkham/uas_project_pemrograman_Web/blob/main/DOKUMENTASI%20PROJECT/Screenshot%202026-01-07%20020255.png?raw=true)

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



## 🚀 Modern POS (Point of Sale) 

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel) ![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-blue?style=flat-square&logo=tailwind-css) ![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-purple?style=flat-square&logo=php) ![MySQL](https://img.shields.io/badge/MySQL-Database-blue?style=flat-square&logo=mysql)

**Sistem Kasir Modern dengan Antarmuka Tema Gelap, Dibangun Menggunakan Laravel Breeze & Tailwind CSS.**

---

## ✨ Fitur Utama

### 🎨 Antarmuka Modern dengan Tema Gelap
- Desain **Glassmorphism** yang elegan
- **Responsif** untuk berbagai perangkat
- Halaman autentikasi kustom

### 🛍️ Manajemen Produk
- Daftar produk dengan gambar
- Pengorganisasian kategori
- Manajemen stok
- Fitur unggah gambar

### 💰 Sistem Transaksi
- **Pembaruan keranjang real-time**
- **Pencarian produk dinamis**
- **Perhitungan pajak otomatis** (12%)
- **Pemrosesan pembayaran**
- **Kalkulasi kembalian**
- **Riwayat transaksi**

### 👥 Manajemen Pengguna
- **Akses berbasis peran** (Admin/Cashier)
- **CRUD pengguna**
- **Keamanan autentikasi**

---

## 🛠️ Teknologi yang Digunakan

- 🚀 **Laravel 11 + Breeze** *(Framework backend modern)*
- 🎨 **Tailwind CSS** *(Styling fleksibel & cepat)*
- 🔗 **Font Awesome** *(Ikon yang kaya dan elegan)*
- 🛢️ **MySQL** *(Database handal untuk penyimpanan data)*

---

## ⚡ Persyaratan Minimum

- PHP **>= 8.1**
- MySQL Database
- Composer *(untuk mengelola dependensi)*

---

## 🔧 Cara Instalasi

```bash
# 1. Clone repository
$ git clone https://github.com/KaZaaaa8/SalesPro.git

# 2. Masuk ke folder proyek
$ cd SalesPro

# 3. Install dependensi
$ composer install

# 4. Konfigurasi environment
$ cp .env.example .env
$ php artisan key:generate

# 5. Atur database di file .env
DB_DATABASE=pos_db
DB_USERNAME=root
DB_PASSWORD=

# 6. Jalankan migrasi database
$ php artisan migrate

# 7. Buat link ke penyimpanan
$ php artisan storage:link

# 8. Jalankan server
$ php artisan serve
```

---

## 📁 Struktur Proyek

```plaintext
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php
│   │   │   ├── TransactionController.php
│   │   │   └── UserController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── forgot-password.blade.php
│       ├── products/
│       ├── transactions/
│       └── users/
└── routes/
    └── web.php
```

---

## 🚀 Fitur yang Sedang Dikembangkan

- 📊 **Laporan Penjualan** *(Analisis transaksi harian, mingguan, bulanan)*
- ⚠️ **Peringatan Stok Habis** *(Notifikasi otomatis untuk stok rendah)*
- 🧾 **Pembuatan Struk dalam Format PDF**

---

## 🔒 Keamanan

- 🛡️ **Autentikasi berbasis peran** *(Admin & Staff memiliki izin berbeda)*
- 🔐 **Rute admin yang dilindungi** *(Akses terbatas untuk user tertentu)*
- 📂 **Keamanan unggah file** *(Mencegah eksploitasi file berbahaya)*
- 🔄 **Proteksi CSRF** *(Mencegah serangan keamanan di formulir)*

---

## 🤝 Kontribusi

💡 Ingin berkontribusi? Silakan buat **Pull Request** atau buka **Issue** untuk perbaikan dan fitur baru.

---

## 📜 Lisensi

[MIT License](https://opensource.org/licenses/MIT)

---

## ❓ FAQ

**Q: Bagaimana cara menambahkan produk baru?**  
A: Admin bisa menambahkan produk melalui halaman admin di menu Produk.

**Q: Bagaimana cara reset password?**  
A: Klik tombol "Lupa Password" di halaman login dan ikuti instruksi.

---

## 💡 Kredit & Teknologi yang Digunakan

- 🎵 **Laravel** *(Framework PHP yang kuat)*
- 🎨 **Tailwind CSS** *(Framework CSS modern)*
- 🚀 **Font Awesome** *(Ikon yang stylish dan profesional)*

🚀 **Dikembangkan dengan ❤️ oleh [Muhammad Faza Husnan](https://github.com/KaZaaaa8)**  
📧 **Email:** fazahusnan06@gmail.com

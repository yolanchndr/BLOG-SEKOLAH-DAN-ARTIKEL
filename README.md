# BLOG-SEKOLAH-DAN-ARTIKEL

<p align="center">
  <strong>School Website & Article Management System</strong>
</p>

<p align="center">
  Sistem website sekolah berbasis CodeIgniter 4 untuk mengelola profil sekolah, artikel, halaman informasi, galeri, dokumen, banner, menu, dan konten website secara terintegrasi.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/CodeIgniter-4-EF4223?style=flat-square&logo=codeigniter&logoColor=white" alt="CodeIgniter 4">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat-square&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/CSS-1572B6?style=flat-square&logo=css3&logoColor=white" alt="CSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square&logo=opensourceinitiative&logoColor=white" alt="MIT License">
</p>

---

## Tentang Project

**BLOG-SEKOLAH-DAN-ARTIKEL** adalah aplikasi website sekolah berbasis **CodeIgniter 4** yang dirancang untuk menjadi pusat informasi resmi sekolah sekaligus sistem manajemen konten.

Administrator dapat mengelola berbagai informasi website melalui panel admin tanpa harus mengubah kode aplikasi.

Konten utama seperti **nama sekolah, logo, profil, artikel, halaman, menu, banner, galeri, dokumen, dan media sosial** disimpan di database sehingga dapat dikelola secara dinamis.

---

## Fitur Utama

### Website Sekolah

Menyediakan halaman publik untuk menampilkan:

* Profil sekolah
* Sejarah sekolah
* Visi & Misi
* Artikel/berita
* Dokumen
* Galeri
* Informasi kontak
* Media sosial
* Banner
* Informasi kepala sekolah

Data profil sekolah disimpan pada database dan dapat dikelola dari panel administrator. Struktur database mencakup nama sekolah, NPSN, jenjang, logo, favicon, alamat, kontak, kepala sekolah, pesan kepala sekolah, dan konfigurasi SEO.

### Manajemen Artikel

Sistem artikel mendukung:

* Judul artikel
* Slug SEO-friendly
* Kategori
* Author
* Excerpt
* Konten artikel
* Featured image
* Status artikel
* Jadwal publikasi
* View counter
* SEO title
* SEO description
* SEO keywords
* Canonical URL
* Soft delete

Status artikel yang tersedia:

```text
draft
published
scheduled
archived
```

Struktur database artikel juga menyediakan tabel khusus untuk attachment sehingga artikel dapat memiliki file pendukung.

### Kategori Artikel

Kategori dapat dikelola secara dinamis dan memiliki:

* Nama
* Slug
* Deskripsi
* SEO title
* SEO description
* Status

Contoh kategori:

```text
Pengumuman Resmi
Kegiatan Sekolah
Prestasi Siswa
```

### Halaman Statis

Halaman informasi sekolah dapat dikelola menggunakan sistem CMS.

Contoh:

```text
Profil Sekolah
Sejarah
Visi & Misi
```

Setiap halaman menggunakan slug sehingga URL lebih bersih dan mudah digunakan.

### Manajemen Menu

Menu website dapat dikelola melalui database.

Mendukung:

* Parent menu
* Submenu
* URL
* Target `_self`
* Target `_blank`
* Icon
* Sort order
* Status

Contoh struktur:

```text
Profil
├── Profil Sekolah
├── Sejarah
└── Visi & Misi

Berita
Dokumen
Kontak
```

Struktur menu tersebut disimpan dalam tabel `menus`.

### Banner

Sistem banner mendukung:

* Judul
* Subtitle
* Gambar
* Button text
* Button URL
* Urutan
* Status
* Waktu mulai tampil
* Waktu berakhir

### Gallery

Gallery menggunakan konsep:

```text
Album
└── Photos
```

Setiap album memiliki nama, slug, deskripsi, cover image, dan status.

Foto gallery memiliki:

* Nama file
* File tersimpan
* Path
* Caption
* Sort order
* User uploader

### Dokumen

Website dapat menyediakan dokumen yang dapat diunduh pengguna.

Data dokumen mencakup:

* Judul
* Slug
* Deskripsi
* Nama file asli
* Nama file tersimpan
* Extension
* MIME type
* Ukuran file
* Download counter
* Status
* Uploader

### Social Media

Media sosial dapat dikelola melalui database sehingga administrator dapat menambahkan platform dan URL tanpa mengubah source code.

### Contact Message

Pesan dari halaman kontak dapat disimpan dan dikelola melalui sistem.

Status pesan:

```text
unread
read
replied
archived
```

### User & Role

Sistem menyediakan role-based access.

Role yang tersedia pada database saat ini:

```text
Super Admin
Author
```

Super Admin memiliki akses penuh, sedangkan Author digunakan untuk mengelola artikel miliknya.

### Activity Log

Aktivitas pengguna dicatat melalui tabel `activity_logs`.

Informasi yang disimpan antara lain:

* User
* Action
* Module
* Description
* IP address
* User agent
* Created time

Fitur ini membantu administrator melakukan audit terhadap aktivitas dalam sistem.

---

## Teknologi

| Teknologi   | Keterangan            |
| ----------- | --------------------- |
| PHP         | 8.2+                  |
| CodeIgniter | 4.7+                  |
| MySQL       | Database              |
| Bootstrap   | UI Framework          |
| JavaScript  | Interaksi frontend    |
| CSS         | Styling               |
| Composer    | Dependency management |
| PHPUnit     | Testing               |

Requirement PHP dan CodeIgniter mengikuti `composer.json` repository, yaitu PHP `^8.2` dan CodeIgniter Framework `^4.7`.

---

## Struktur Project

```text
BLOG-SEKOLAH-DAN-ARTIKEL/
│
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   ├── Filters/
│   ├── Helpers/
│   ├── Models/
│   └── Views/
│
├── public/
│   ├── assets/
│   └── index.php
│
├── tests/
│
├── writable/
│
├── builds/
│
├── blog.sql
├── composer.json
├── composer.lock
├── env
├── phpunit.dist.xml
├── preload.php
├── spark
└── README.md
```

Repository saat ini memang menggunakan struktur standar aplikasi CodeIgniter 4 dengan `app`, `public`, `tests`, `writable`, `composer.json`, `env`, dan `spark`.

---

## Database

Project menyediakan file:

```text
blog.sql
```

Database menggunakan MySQL dan dump saat ini dibuat menggunakan MySQL 8.0.30 serta PHP 8.3.30.

Database utama:

```text
blog
```

Beberapa tabel utama:

```text
activity_logs
albums
articles
article_attachments
banners
categories
contact_messages
documents
gallery_photos
menus
pages
roles
school_profile
social_media
users
```

Selain itu terdapat tabel `migrations` untuk mencatat migration CodeIgniter.

---

# Requirements

Sebelum menjalankan aplikasi, pastikan tersedia:

* PHP >= 8.2
* Composer
* MySQL / MariaDB
* Apache atau Nginx
* PHP extension `intl`
* PHP extension `mbstring`
* PHP extension `mysqli` atau `mysqlnd`

CodeIgniter 4 juga merekomendasikan extension tambahan sesuai kebutuhan aplikasi, termasuk `mysqlnd` untuk MySQL.

---

# Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/yolanchndr/BLOG-SEKOLAH-DAN-ARTIKEL.git
```

Masuk ke project:

```bash
cd BLOG-SEKOLAH-DAN-ARTIKEL
```

## 2. Install Dependency

```bash
composer install
```

## 3. Buat `.env`

Copy file:

```bash
cp env .env
```

Pada Windows PowerShell:

```powershell
Copy-Item env .env
```

Kemudian sesuaikan:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://blog-sekolah.test'

database.default.hostname = localhost
database.default.database = blog
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

---

# Konfigurasi Database

Buat database:

```sql
CREATE DATABASE blog;
```

Kemudian import:

```text
blog.sql
```

melalui phpMyAdmin atau MySQL CLI.

Alternatif menggunakan MySQL:

```bash
mysql -u root -p blog < blog.sql
```

---

# Menggunakan Migration

Jika ingin membuat database menggunakan migration CodeIgniter:

```bash
php spark migrate
```

Kemudian jika project memiliki seeder:

```bash
php spark db:seed DatabaseSeeder
```

Pastikan konfigurasi database pada `.env` sudah benar sebelum menjalankan migration.

---

# Menjalankan Aplikasi

Dengan PHP built-in server:

```bash
php spark serve
```

Kemudian buka:

```text
http://localhost:8080
```

Untuk Laragon, project dapat ditempatkan pada:

```text
C:\laragon\www\BLOG-SEKOLAH-DAN-ARTIKEL
```

Jika Auto Virtual Hosts aktif, gunakan domain lokal yang dibuat Laragon.

---

# Web Server

Untuk production, document root harus diarahkan ke:

```text
public/
```

Bukan ke root project.

Contoh:

```text
BLOG-SEKOLAH-DAN-ARTIKEL/
└── public/   ← Document Root
```

Hal ini penting untuk menjaga file aplikasi seperti `app`, `writable`, dan konfigurasi project tidak dapat diakses langsung melalui web.

CodeIgniter 4 memang menempatkan `index.php` di dalam folder `public` untuk pemisahan komponen dan keamanan.

---

# Testing

Project menggunakan PHPUnit.

Menjalankan test:

```bash
composer test
```

atau:

```bash
vendor/bin/phpunit
```

Konfigurasi development pada `composer.json` menggunakan PHPUnit `^10.5.16`.

---

# Keamanan

Beberapa hal yang perlu diperhatikan saat deployment:

* Gunakan `CI_ENVIRONMENT = production`.
* Jangan commit password database.
* Jangan menggunakan password default untuk production.
* Pastikan `.env` tidak diakses publik.
* Arahkan document root ke `public/`.
* Validasi semua file upload.
* Batasi ukuran file upload.
* Gunakan HTTPS.
* Gunakan password yang kuat.
* Bersihkan file temporary yang tidak digunakan.
* Pastikan folder `writable/` dapat ditulis oleh PHP.
* Jangan memberikan akses write pada seluruh source code.

---

# Fitur yang Direncanakan

Beberapa pengembangan yang dapat ditambahkan:

* [ ] Dashboard statistik artikel
* [ ] Rich Text Editor
* [ ] SEO management yang lebih lengkap
* [ ] Sitemap XML otomatis
* [ ] RSS Feed
* [ ] Search artikel
* [ ] Pagination artikel
* [ ] Related articles
* [ ] Article sharing
* [ ] Comment system
* [ ] Notification
* [ ] Role & permission yang lebih granular
* [ ] Backup database dari admin
* [ ] Media library
* [ ] Web analytics
* [ ] Dark mode
* [ ] PWA support

---

# Contributing

Kontribusi untuk pengembangan project ini terbuka.

Clone repository:

```bash
git clone https://github.com/yolanchndr/BLOG-SEKOLAH-DAN-ARTIKEL.git
```

Install dependency:

```bash
composer install
```

Buat branch:

```bash
git checkout -b feature/nama-fitur
```

Setelah melakukan perubahan:

```bash
git add .
git commit -m "feat: menambahkan fitur baru"
git push origin feature/nama-fitur
```

Gunakan format commit yang konsisten:

```text
feat: menambahkan fitur
fix: memperbaiki bug
refactor: merapikan kode
docs: memperbarui dokumentasi
style: memperbaiki tampilan
chore: perubahan konfigurasi
test: menambahkan atau memperbaiki test
```

---

# License

Project ini menggunakan **MIT License**. Repository mencantumkan MIT license pada halaman GitHub.

---

# Repository

Source code:

[BLOG-SEKOLAH-DAN-ARTIKEL — GitHub](https://github.com/yolanchndr/BLOG-SEKOLAH-DAN-ARTIKEL?utm_source=chatgpt.com)

---

# Author

**yolanchndr**

PHP Developer yang berfokus pada pengembangan aplikasi web menggunakan PHP, CodeIgniter 4, Laravel, MySQL, dan berbagai solusi web untuk kebutuhan administrasi serta publikasi informasi.

---

<p align="center">
  <strong>BLOG-SEKOLAH-DAN-ARTIKEL</strong><br>
  School Website & Article Management System
</p>

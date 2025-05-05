# 🐾 CariHewan

CariHewan adalah aplikasi web yang dibangun dengan CodeIgniter 4 untuk membantu mempertemukan kembali hewan peliharaan yang hilang dengan pemiliknya. Platform ini memungkinkan pengguna untuk melaporkan hewan yang hilang dan hewan yang ditemukan, memudahkan pemilik hewan untuk menemukan hewan kesayangan mereka yang hilang.

## 🌟 Fitur Utama

- **Laporan Hewan Hilang**: Pengguna dapat membuat laporan detail tentang hewan yang hilang termasuk:
  - Nama dan jenis hewan
  - Ciri-ciri fisik
  - Lokasi terakhir terlihat
  - Foto
  - Informasi kontak

- **Laporan Hewan Ditemukan**: Penemu dapat melaporkan hewan yang mereka temukan dengan:
  - Identifikasi jenis hewan
  - Lokasi penemuan
  - Deskripsi fisik
  - Foto
  - Detail kontak perawat sementara

- **Integrasi Peta Interaktif**: Penandaan lokasi yang tepat untuk hewan hilang dan ditemukan
- **Profil Pengguna**: Kelola laporan dan informasi kontak Anda
- **Desain Responsif**: Berfungsi dengan baik di desktop maupun perangkat mobile

## 📸 Tampilan Aplikasi

### Halaman Utama
![Halaman Utama](https://raw.githubusercontent.com/KleiKleiKlei/cariHewan/main/screenshots/home.png)
*Interface utama dengan opsi pelaporan hewan hilang dan ditemukan*

### Form Laporan Hewan Hilang
![Form Hewan Hilang](https://raw.githubusercontent.com/KleiKleiKlei/cariHewan/main/screenshots/lost-pet-form.png)
*Form untuk melaporkan hewan yang hilang*

### Form Laporan Hewan Ditemukan
![Form Hewan Ditemukan](https://raw.githubusercontent.com/KleiKleiKlei/cariHewan/main/screenshots/found-pet-form.png)
*Form untuk melaporkan hewan yang ditemukan*

### Daftar Hewan
![Daftar Hewan](https://raw.githubusercontent.com/KleiKleiKlei/cariHewan/main/screenshots/pet-listings.png)
*Daftar hewan yang dilaporkan hilang dan ditemukan*

## 🛠 Persyaratan Teknis

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server Apache/Nginx
- CodeIgniter 4.x
- Composer

## 💻 Cara Instalasi

1. Clone repository:
```bash
git clone https://github.com/KleiKleiKlei/cariHewan.git
```

2. Install dependencies:
```bash
composer install
```

3. Buat database dan konfigurasi `.env`:
```bash
cp env .env
# Edit pengaturan database di file .env
```

4. Jalankan migrasi:
```bash
php spark migrate
```

5. Mulai server development:
```bash
php spark serve
```


## 💾 Database Setup

### Menggunakan phpMyAdmin
1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Buat database baru bernama `petdb`
3. Pilih database `petdb`
4. Klik tab "Import"
5. Klik "Choose File" dan pilih file `petdb.sql` dari folder proyek
6. Klik "Go" untuk mengimpor struktur dan data

### Menggunakan Command Line
```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE petdb;

# Import struktur dan data
mysql -u root -p petdb < petdb.sql
```

### Struktur Database
Database terdiri dari beberapa tabel utama:
- `users`: Menyimpan data pengguna
- `hewan`: Informasi detail hewan
- `laporan`: Data laporan hewan hilang/ditemukan
- `admins`: Data administrator sistem

### Konfigurasi Database
1. Copy file `env` menjadi `.env`
2. Edit pengaturan database di `.env`:
```env
database.default.hostname = localhost
database.default.database = petdb
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### Data Default
Database sudah termasuk beberapa data contoh:
- 2 akun pengguna
- 2 data hewan
- 2 laporan (hilang dan ditemukan)

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan kirim Pull Request.

## 📝 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail.

## 👥 Pengembang

- [@KleiKleiKlei](https://github.com/KleiKleiKlei)

## 🙏 Ucapan Terima Kasih

- Dibangun dengan CodeIgniter 4
- Dirancang untuk membantu mempertemukan kembali hewan peliharaan dengan keluarganya
- Terinspirasi oleh cinta terhadap hewan dan dukungan komunitas

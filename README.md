# Sistem Peminjaman Ruangan

Sistem informasi berbasis web untuk mempermudah pengelolaan jadwal dan peminjaman ruangan. Aplikasi ini dirancang agar proses pemesanan ruangan menjadi lebih transparan, tertata, dan mudah dipantau baik oleh pengelola maupun pengguna ruangan.

## Fitur Utama

Sistem ini memiliki beberapa level akses dengan fitur yang disesuaikan untuk masing-masing peran:

### 🌟 Publik (Halaman Depan)
- **Lihat Jadwal Ruangan:** Menampilkan jadwal penggunaan ruangan secara *real-time*.
- **Portal Berita/Informasi:** Menampilkan artikel atau pengumuman terkait fasilitas dan kegiatan.
- **Pencarian & Filter:** Mencari jadwal berdasarkan kriteria tertentu.

### 👤 Admin (Pengguna/Peminjam)
- **Manajemen Jadwal Pribadi:** Mengajukan, mengubah, atau membatalkan jadwal peminjaman ruangan.
- **Dasbor Statistik:** Melihat grafik ringkasan peminjaman yang sedang aktif atau sudah selesai.
- **Manajemen Berita:** (Opsional) Menulis dan mempublikasikan berita atau pengumuman.

### 👑 Super Admin (Pengelola Sistem)
- **Manajemen Ruangan:** Menambah, mengubah, atau menghapus daftar ruangan yang tersedia.
- **Manajemen Pengguna:** Mengelola akun Admin/Peminjam (tambah, edit, hapus, *reset password*).
- **Kontrol Penuh Jadwal:** Mengelola, menyetujui, atau membatalkan semua jadwal dari semua pengguna.
- **Laporan & Dasbor Lengkap:** Memantau keseluruhan aktivitas di dalam sistem.

---

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan *stack* teknologi standar yang mudah dipelajari dan di-*deploy*:

**Backend:**
- PHP (Native)
- MySQL (menggunakan ekstensi `mysqli`)

**Frontend:**
- HTML5, CSS3, JavaScript
- [Bootstrap 4](https://getbootstrap.com/) (menggunakan *template* [SB Admin 2](https://startbootstrap.com/theme/sb-admin-2))
- jQuery
- [DataTables](https://datatables.net/) (untuk tabel data interaktif)
- [Chart.js](https://www.chartjs.org/) (untuk visualisasi grafik)
- [CKEditor 5](https://ckeditor.com/) (sebagai *Rich Text Editor* penulisan berita)
- FontAwesome (untuk ikon)

---

## Prasyarat

Sebelum mulai menginstal proyek ini di komputer lokalmu, pastikan perangkat lunak berikut sudah terpasang:
- **Web Server:** Apache (misalnya melalui XAMPP, Laragon, atau MAMP).
- **PHP:** Versi 7.x atau 8.x.
- **Database:** MySQL atau MariaDB.

---

## Cara Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

1. **Kloning Repositori**
   Buka terminal atau Git Bash, lalu jalankan perintah berikut di dalam direktori root server kamu (misal: `htdocs` untuk XAMPP):
   ```bash
   git clone [https://github.com/username/sistem-peminjaman-ruangan.git](https://github.com/username/sistem-peminjaman-ruangan.git)

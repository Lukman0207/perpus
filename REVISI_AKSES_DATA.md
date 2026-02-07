# Perpustakaan Sekolah Digital - Data Akses

## Revisi Yang Sudah Dilakukan

### 1. Batas Pinjam Buku (Siswa)
- **Maksimal 5 buku aktif** (belum dikembalikan) per siswa
- Sistem akan menolak peminjaman jika sudah mencapai batas

### 2. Denda Keterlambatan
- **Rp 1.000 per hari** terlambat
- Dihitung otomatis saat pengembalian
- Disimpan di tabel `transactions` (kolom `hari_terlambat` dan `denda`)

### 3. Pencarian Buku (Siswa)
- **Satu kolom pencarian** untuk judul, penulis, penerbit, ISBN, atau kategori
- **Filter kategori** dengan dropdown (Tombol Cari sesuai kategori)
- Tombol Reset untuk mengosongkan filter

### 4. Kategori Buku
- Kolom `kategori` ditambahkan ke tabel books
- Kategori contoh: Teknologi, Sains, Sejarah, Bahasa, Bisnis, Seni

### 5. Tema Dark/Light
- Tombol toggle **kanan atas** di semua halaman
- Mendukung dark mode dan light mode
- Preferensi disimpan di localStorage

### 6. UI/UX
- Dashboard Admin & Siswa diperbaiki dengan desain lebih modern
- Ikon untuk setiap menu dan statistik
- Kartu buku dengan hover effect dan gradient
- Dukungan dark mode di seluruh aplikasi

---

## Data Akses Awal

### Login Admin
- **Email:** admin@perpus.local
- **Password:** password

### Login Siswa (5 akun)
| No | Nama         | Email              | NIS | Kelas      | Password |
|----|--------------|--------------------|-----|------------|----------|
| 1  | Ahmad Rizki  | ahmad@siswa.local  | 001 | XII IPA 1  | password |
| 2  | Siti Nurhaliza | siti@siswa.local | 002 | XII IPA 2  | password |
| 3  | Budi Santoso | budi@siswa.local   | 003 | XI IPS 1   | password |
| 4  | Dewi Lestari | dewi@siswa.local   | 005 | XI IPS 2   | password |
| 5  | Andi Pratama | andi@siswa.local   | 005 | X IPA 1    | password |

### Data Buku (10 buku dengan kategori)
- Teknologi: Pemrograman Web Laravel, Database Management, Algoritma
- Sejarah: Sejarah Indonesia Modern
- Sains: Matematika Dasar, Fisika Modern, Biologi Sel
- Bahasa: Bahasa Inggris untuk Pemula
- Bisnis: Kewirausahaan
- Seni: Seni Rupa

---

## Cara Menjalankan

1. **Jalankan migration** (jika belum):
   ```bash
   php artisan migrate
   ```

2. **Jika database sudah ada**, jalankan migration untuk kolom baru:
   ```bash
   php artisan migrate
   ```

3. **Reset database & seed** (untuk data awal lengkap):
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Build assets**:
   ```bash
   npm run build
   ```

5. **Jalankan server**:
   ```bash
   php artisan serve
   ```

6. Buka browser: **http://localhost:8000**

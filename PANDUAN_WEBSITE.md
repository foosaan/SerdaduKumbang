# 📘 Panduan Penggunaan Website SerdaduKumbang

---

## 🌐 A. Halaman Publik (Tanpa Login)

Halaman-halaman ini bisa diakses oleh siapa saja.

### 1. Beranda (`/`)
- Menampilkan informasi utama tentang SerdaduKumbang
- Daftar partner/mitra
- Struktur kepengurusan (BPH & Staff)
- Status pendaftaran (Buka/Tutup)

### 2. Informasi (`/informasi`)
- Daftar artikel/pengumuman dari admin
- Bisa difilter berdasarkan **kategori**
- Klik artikel untuk baca detail lengkap

### 3. Kegiatan (`/kegiatan`)
- Daftar kegiatan yang sudah, sedang, atau akan dilaksanakan
- Klik kegiatan untuk lihat detail

### 4. Kontak (`/contact`)
- Informasi kontak: alamat, WhatsApp, email
- Link media sosial (Instagram & TikTok)
- Peta lokasi via Google Maps

### 5. Formulir Pendaftaran (`/pendaftaran`)
Formulir ini terdiri dari **3 langkah**:

| Langkah | Isi |
|---------|-----|
| **Step 1 — Data Diri** | Nama, jenis kelamin, email, no. WA, asal instansi, tanggal lahir, alamat |
| **Step 2 — Dokumen** | Upload CV (PDF), bukti follow IG (PDF), bukti follow TikTok (PDF), portofolio (PDF, opsional) |
| **Step 3 — Pilihan Divisi** | Sumber info, motivasi, pilihan divisi 1 & 2 + alasan, kesediaan divisi lain |

> **Catatan:**
> - Semua file maksimal **10MB** per file, format **PDF**
> - Portofolio **wajib** jika memilih divisi **Media Branding**
> - Setelah berhasil, akan muncul halaman **Pendaftaran Berhasil** dengan email dan password sementara
> - Password juga dikirim ke email pendaftar

---

## 👤 B. Dashboard User (Setelah Login)

Login di: `/login`

### 1. Dashboard (`/user/dashboard`)
Setelah login, user bisa melihat:

- **Status Verifikasi** — Menunggu / Lulus / Tidak Lulus
- **Tanggal Daftar**
- **Kelengkapan Berkas**
- **Rincian Data Pendaftaran** — Nama, jenis kelamin, email, no. HP, alamat
- **Pratinjau Berkas** — Tombol untuk melihat semua dokumen yang sudah diupload (CV, Follow IG, Follow TikTok, Portofolio)
- **Keterangan Admin** — Muncul jika status "Tidak Lulus", berisi alasan dari admin

### 2. Ganti Password (`/profile`)
- User bisa mengganti password akun

---

## 🔧 C. Dashboard Admin

Login di: `/admin/login`

### 1. Dashboard Utama (`/admin`)
Halaman utama admin menampilkan:

- **Statistik:**
  - Total pendaftar
  - Jumlah belum diverifikasi (klik untuk filter langsung)
  - Grafik gender (Donut Chart)
  - Grafik pilihan divisi (Bar Chart)

- **Filter Gelombang:** Tabs untuk filter pendaftar per gelombang

- **Filter Data:**
  - Cari berdasarkan nama/email/HP
  - Filter status (Menunggu / Lulus / Tidak Lulus)
  - Filter gender
  - Filter gelombang

- **Tabel Pendaftar:**
  - Nama, gelombang, gender, divisi, kontak, status
  - Tombol **Detail** (ikon mata) — lihat data lengkap
  - Tombol **Hapus** (ikon tempat sampah) — hapus data pendaftar

- **Bulk Action:**
  - Centang beberapa pendaftar sekaligus
  - Ubah status secara massal (Lulus / Tidak Lulus / Menunggu)

- **Export Data:**
  - 📗 **Export Excel** — download data pendaftar format `.xlsx`
  - 📕 **Export PDF** — download data pendaftar format `.pdf`
  - 📦 **Download Berkas (ZIP)** — download semua file dokumen pendaftar dalam format `.zip`

- **Hapus Semua Data:**
  - Tombol "Bersihkan Semua Data" → memerlukan **password admin** untuk konfirmasi

---

### 2. Detail Pendaftar (`/admin/pendaftar/{id}`)
- Lihat semua data lengkap seorang pendaftar
- Preview dokumen yang diupload
- **Verifikasi:** Ubah status menjadi Lulus / Tidak Lulus + isi alasan (jika tidak lulus) 
- Status verifikasi akan otomatis terkirim ke whatsapp pendaftar

---

### 3. Kelola Informasi (`/admin/informasi`)
Menu untuk membuat dan mengelola artikel/pengumuman.

| Aksi | Keterangan |
|------|-----------|
| **Tambah** | Buat artikel baru dengan judul, kategori, konten, dan gambar |
| **Edit** | Ubah artikel yang sudah ada |
| **Hapus** | Hapus artikel |

---

### 4. Kelola Kegiatan (`/admin/kegiatan`)
Menu untuk membuat dan mengelola kegiatan.

| Aksi | Keterangan |
|------|-----------|
| **Tambah** | Buat kegiatan baru |
| **Edit** | Ubah data kegiatan |
| **Hapus** | Hapus kegiatan |

---

### 5. Kelola Kontak (`/admin/kontak`)
- Edit informasi kontak yang tampil di halaman publik
- Isi: alamat, telepon/WhatsApp, email

---

### 6. Kelola Akun (`/admin/akun`)
Menu untuk mengelola admin.

| Aksi | Keterangan |
|------|-----------|
| **Tambah Akun** | Buat akun baru (admin) |
| **Edit Akun** | Ubah data akun |
| **Reset Password** | Reset password akun tertentu |
| **Hapus Akun** | Hapus akun |

---

### 7. Kelola Partner (`/admin/partner`)
Menu untuk mengelola daftar mitra/partner yang tampil di halaman beranda.

| Aksi | Keterangan |
|------|-----------|
| **Tambah** | Tambah partner baru dengan nama dan logo |
| **Edit** | Ubah data partner |
| **Hapus** | Hapus partner |

---

### 8. Kelola Pengurus (`/admin/pengurus`)
Menu untuk mengelola struktur kepengurusan yang tampil di halaman beranda.

| Aksi | Keterangan |
|------|-----------|
| **Tambah** | Tambah pengurus baru (nama, jabatan, kategori, foto) |
| **Edit** | Ubah data pengurus |
| **Hapus** | Hapus pengurus |

---

### 9. Notifikasi WA (`/admin/notifikasi`)
- Kirim notifikasi WhatsApp ke pendaftar
- Menggunakan API **Fonnte** untuk pengiriman otomatis

---

### 10. Status Formulir (`/admin/status-form`)
- **Buka/Tutup** formulir pendaftaran
- Atur **gelombang aktif** (Gelombang 1, 2, dst.)
- Ketika formulir ditutup, halaman pendaftaran akan redirect ke beranda dengan pesan "Pendaftaran sedang ditutup"

---

## 🔑 Informasi Login

| Role | URL Login | Catatan |
|------|-----------|---------|
| **User** | `/login` | Email & password dikirim setelah pendaftaran berhasil |
| **Admin** | `/admin/login` | Gunakan akun admin yang sudah dibuat |

---

## ⚠️ Tips Penting

1. **Backup data** sebelum menggunakan fitur "Bersihkan Semua Data"
2. **Export Excel/PDF** secara berkala untuk arsip
4. File upload maksimal **10MB per file** — jika hosting punya limit lebih kecil, sesuaikan di cPanel > MultiPHP INI Editor

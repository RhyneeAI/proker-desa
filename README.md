# Website Desa Cibulakan

Website resmi Desa Cibulakan — portal informasi pemerintahan, pelayanan, dan potensi desa.

## Fitur

- **Beranda** — hero slider (dikelola lewat CRUD), statistik pengunjung, pengumuman & berita terbaru, galeri foto, peta interaktif, dan layanan desa.
- **Konten** — berita, pengumuman, galeri foto, hero slider.
- **Profil Desa** — profil, sejarah, bagan struktur, aparatur desa, dan peta.
- **Ekonomi & Wisata** — UMKM, wisata, potensi desa.
- **Wilayah & Infrastruktur** — fasilitas umum, titik air (data GIS/trajectory).
- **Peta Desa** — peta interaktif dengan batas wilayah desa, tanpa API key.
- **Kontak** — alamat, telepon, dan media sosial.
- **Admin panel** — dashboard, manajemen konten, dan pengguna.
- **Mode gelap**, animasi, dan desain responsif untuk pengunjung.

## Persyaratan

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL / MariaDB (sqlite cukup untuk testing)

## Instalasi

```bash
git clone <repo-url> proker-desa
cd proker-desa

# Bootstrap penuh (dependensi, .env, key, migrate, npm, build)
composer run setup
```

Siapkan penyimpanan file publik:

```bash
php artisan storage:link
```

Seed data contoh (akun admin & konten awal):

```bash
php artisan migrate --seed
```

> Catatan: `.env` tidak masuk git. Salin dari `.env.example` bila perlu dan sesuaikan kredensial database lokal. Tests memakai sqlite in-memory dan tidak butuh database nyata.

## Menjalankan saat pengembangan

```bash
composer run dev
```

Menjalankan server, queue worker (wajib aktif), dan Vite secara paralel.

## Akun default

| Kolom | Nilai |
| --- | --- |
| email | `admin@desa.test` |
| username | `admin` |
| password | `password` |

Login memakai satu field `identifier` yang mendeteksi email vs username secara otomatis.

> Website ini admin-only: pendaftaran publik sengaja dihapus.

## Testing

```bash
composer test
```

## Deployment (Docker)

```bash
docker compose up -d --build
```

Saat pertama kali dijalankan, proses otomatis: generate `APP_KEY`, menunggu database siap, `migrate --force`, seed data (hanya bila tabel user kosong), `storage:link`, dan cache view.

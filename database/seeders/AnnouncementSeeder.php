<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::query()->forceDelete();

        $data = [
            [
                'title' => 'Undangan Musyawarah Desa Pembahasan APBDes Perubahan',
                'content' => "Diberitahukan kepada seluruh warga Desa Cibulakan bahwa Pemerintah Desa akan mengadakan Musyawarah Desa (Musdes) untuk membahas rancangan Anggaran Pendapatan dan Belanja Desa (APBDes) perubahan.\n\nHari/Tanggal: Sabtu, 15 Agustus 2026\nWaktu: 09.00 WIB - Selesai\nTempat: Aula Kantor Desa Cibulakan\n\nSeluruh warga diharapkan hadir. Kehadiran dan masukan warga sangat penting demi pembangunan desa yang lebih baik.",
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Pendaftaran Bantuan Langsung Tunai (BLT) Dana Desa',
                'content' => "Pemerintah Desa Cibulakan membuka pendaftaran Bantuan Langsung Tunai (BLT) Dana Desa bagi warga yang memenuhi kriteria keluarga penerima manfaat.\n\nPersyaratan:\n1. Warga Desa Cibulakan dengan Kartu Keluarga aktif.\n2. Belum pernah menerima bantuan sosial serupa dari sumber lain.\n3. Terdata pada Data Terpadu Kesejahteraan Sosial (DTKS).\n\nPendaftaran dibuka mulai Senin, 10 Agustus 2026 hingga 21 Agustus 2026 di Kantor Desa pada jam kerja. Bawa fotokopi KTP dan Kartu Keluarga.",
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Jadwal Imunisasi Balita di Posyandu Bulan Agustus',
                'content' => "Kegiatan imunisasi dan pemeriksaan balita di Posyandu Desa Cibulakan dilaksanakan sesuai jadwal berikut:\n\nPosyandu Mawar 1: Selasa, 11 Agustus 2026, pukul 08.00 - 11.00\nPosyandu Mawar 2: Rabu, 12 Agustus 2026, pukul 08.00 - 11.00\n\nDiharapkan ibu-ibu yang memiliki balita membawa buku KIA dan mengikuti kegiatan sesuai jadwal. Kegiatan ini gratis.",
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Kegiatan Kerja Bakti Bersih Lingkungan Minggu Pagi',
                'content' => "Pemerintah Desa Cibulakan mengajak seluruh warga untuk mengikuti kegiatan kerja bakti membersihkan lingkungan desa.\n\nHari/Tanggal: Minggu, 16 Agustus 2026\nWaktu: 06.30 WIB\nTitik kumpul: Lapangan Desa Cibulakan\n\nMari jaga kebersihan dan keindahan desa kita bersama-sama. Bagi warga yang membawa peralatan kebersihan, kami ucapkan terima kasih.",
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Pemutakhiran Data Keluarga untuk Bantuan Sosial',
                'content' => "Diberitahukan kepada seluruh warga Desa Cibulakan bahwa pemerintah desa akan melakukan pemutakhiran data keluarga sebagai dasar penyaluran bantuan sosial.\n\nPetugas akan mendatangi rumah warga secara bertahap. Warga diharapkan menyiapkan dokumen kependudukan berupa KK dan KTP.\n\nPemutakhiran data ini penting agar penyaluran bantuan tepat sasaran. Apabila petugas belum berkunjung dan warga memiliki data yang perlu diperbarui, silakan menghubungi kantor desa.",
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($data as $item) {
            $item['slug'] = Str::slug($item['title']);
            $item['is_published'] = true;

            Announcement::create($item);
        }
    }
}

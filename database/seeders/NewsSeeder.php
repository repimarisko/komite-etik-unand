<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsData = [
            [
                'title' => 'Panduan Baru Pengajuan Penelitian Etik 2025',
                'content' => 'Komite Etik Penelitian Universitas Andalas telah menerbitkan panduan terbaru untuk pengajuan penelitian etik tahun 2025. Panduan ini mencakup prosedur yang telah disederhanakan dan persyaratan dokumen yang lebih jelas. Peneliti diharapkan untuk mengikuti panduan terbaru ini dalam setiap pengajuan penelitian yang melibatkan subjek manusia. Panduan lengkap dapat diunduh melalui website resmi komite etik.',
                'is_published' => true,
                'is_featured' => true,
                'created_by' => 'Admin Komite Etik',
                'published_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Jadwal Rapat Komite Etik Bulan Januari 2025',
                'content' => 'Komite Etik Penelitian akan mengadakan rapat rutin pada tanggal 15 dan 30 Januari 2025. Rapat akan membahas pengajuan penelitian yang masuk dan evaluasi protokol penelitian yang sedang berjalan. Peneliti yang memiliki pengajuan dalam antrian akan diberitahu melalui email mengenai status review mereka.',
                'is_published' => true,
                'is_featured' => false,
                'created_by' => 'Sekretariat Komite Etik',
                'published_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Workshop Etika Penelitian untuk Mahasiswa S2 dan S3',
                'content' => 'Dalam rangka meningkatkan pemahaman tentang etika penelitian, Komite Etik akan mengadakan workshop khusus untuk mahasiswa S2 dan S3. Workshop akan membahas prinsip-prinsip dasar etika penelitian, cara mengisi formulir pengajuan, dan tips untuk mendapatkan persetujuan etik dengan cepat. Pendaftaran dibuka mulai tanggal 20 Januari 2025.',
                'is_published' => true,
                'is_featured' => false,
                'created_by' => 'Tim Edukasi Komite Etik',
                'published_at' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek(),
                'updated_at' => Carbon::now()->subWeek(),
            ],
            [
                'title' => 'Pembaruan Sistem Informasi Komite Etik',
                'content' => 'Sistem informasi komite etik telah diperbarui dengan fitur-fitur baru untuk meningkatkan pengalaman pengguna. Fitur baru termasuk dashboard yang lebih informatif, tracking status pengajuan real-time, dan notifikasi email otomatis. Semua pengguna diharapkan untuk memperbarui profil mereka dan memastikan informasi kontak terbaru.',
                'is_published' => false,
                'is_featured' => false,
                'created_by' => 'Tim IT Komite Etik',
                'published_at' => null,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ]
        ];

        foreach ($newsData as $data) {
            News::create($data);
        }
    }
}

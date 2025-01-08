<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KonselingSeeder extends Seeder
{
    public function run()
    {
        // Data sampel
        $data = [
            [
                'id_siswa'   => 1,
                'id_konselor' => 1,
                'slug'        => 'konseling-siswa-1',
                'tanggal'     => '2024-11-10',
                'masalah'     => 'Kesulitan dalam pelajaran matematika.',
                'tindakan'    => 'Memberikan tambahan materi dan tugas.',
                'catatan'     => 'Siswa menunjukkan kemajuan.',
                'status'      => 'Selesai',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id_siswa'   => 2,
                'id_konselor' => 1,
                'slug'        => 'konseling-siswa-2',
                'tanggal'     => '2024-11-15',
                'masalah'     => 'Masalah emosional dan sosial.',
                'tindakan'    => 'Diskusi dan konseling mendalam.',
                'catatan'     => 'Perlu perhatian lebih lanjut.',
                'status'      => 'Dijadwalkan',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id_siswa'   => 3,
                'id_konselor' => 2,
                'slug'        => 'konseling-siswa-3',
                'tanggal'     => '2024-11-23',
                'masalah'     => 'Tindak lanjut dari sesi sebelumnya.',
                'tindakan'    => 'Evaluasi hasil sesi konseling.',
                'catatan'     => 'Siswa menunjukkan kemajuan, tetap dipantau.',
                'status'      => 'Selesai',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        // Menyisipkan data ke dalam tabel
        $this->db->table('konseling')->insertBatch($data);
    }
}

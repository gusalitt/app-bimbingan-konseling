<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IndustriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_siswa'       => 5, 
                'slug'           => 'industri-3',
                'tempat_industri'=> 'PT ABC',
                'tgl_mulai'      => '2024-01-01',
                'tgl_selesai'    => '2024-12-31',
                'status'         => 'aktif',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'id_siswa'       => 3,
                'slug'           => 'industri-28',
                'tempat_industri'=> 'PT XYZ',
                'tgl_mulai'      => '2024-02-01',
                'tgl_selesai'    => '2024-11-30',
                'status'         => 'non-aktif',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('industri')->insertBatch($data);
    }
}

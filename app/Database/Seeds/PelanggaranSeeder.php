<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PelanggaranSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $tingkatPelanggaran = ['ringan', 'sedang', 'berat'];

        for ($i = 1; $i <= 8; $i++) {
            $name = $faker->name;
            $data = [
                'slug'                  => url_title($name, "-", true),
                'id_siswa'              => $faker->numberBetween(1, 10),
                'pelanggaran'           => $faker->sentence(3),
                'tindakan'              => $faker->sentence(8),
                'tingkat_pelanggaran'   => $faker->randomElement($tingkatPelanggaran),
                'tanggal'               => $faker->dateTime->format("Y-m-d"),
                'created_at'            => $faker->dateTime->format("Y-m-d H:i:s"),
                'updated_at'            => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('pelanggaran')->insert($data);
        }
    }
}

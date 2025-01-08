<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kelasList = [10, 11, 12];
        $jurusanList = ['PPLG', 'TKC', 'Perhotelan', 'Kuliner'];

        for ($i = 1; $i <= 10; $i++) {
            $name = $faker->name;
            $data = [
                'slug'              => url_title($name, "-", true),
                'nama_siswa'        => $name,
                'nisn'              => $faker->unique()->numerify('##########'),
                'kelas'             => $faker->randomElement($kelasList),
                'jurusan'           => $faker->randomElement($jurusanList),
                'created_at'        => $faker->dateTime->format("Y-m-d H:i:s"),
                'updated_at'        => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('siswa')->insert($data);
        }
    }
}

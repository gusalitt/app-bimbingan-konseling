<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kelasList = [10, 11, 12];
        $mapelLisT = ['Bahasa Indonesia', 'PPKN', 'IPA', 'IPS', '-', 'Sejarah', 'Bahasa Inggris', 'Matematika'];

        for ($i = 1; $i <= 10; $i++) {
            $name = $faker->name;
            $data = [
                'slug'              => url_title($name, "-", true),
                'nama_guru'         => $name,
                'mata_pelajaran'    => $faker->randomElement($mapelLisT),
                'wali_kelas'        => $faker->randomElement($kelasList),
                'created_at'        => $faker->dateTime->format("Y-m-d H:i:s"),
                'updated_at'        => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('guru')->insert($data);
        }
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 4; $i++) {
            $name = $faker->word;

            $data = [
                'slug'              => url_title($name, "-", true),
                'nama_jurusan'      => $name . ' ' . $faker->word,
                'deskripsi'         => $faker->sentence(6),
                'created_at'        => $faker->dateTime->format("Y-m-d H:i:s"),
                'updated_at'        => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('jurusan')->insert($data);
        }
    }
}

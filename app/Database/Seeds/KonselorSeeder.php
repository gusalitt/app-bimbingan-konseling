<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class KonselorSeeder extends Seeder
{
    public function run()
    {

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 10; $i++) {
            $name = $faker->name;
            $data = [
                'slug'              => url_title($name, "-", true),
                'nama_konselor'     => $name,
                'no_telp'           => str_replace(" ", "", str_replace("(+62)", "08", $faker->phoneNumber)),
                'total_konseling'   => $faker->numberBetween(1, 50),
                'created_at'        => $faker->dateTime->format("Y-m-d H:i:s"),
                'updated_at'        => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('konselor')->insert($data);
        }
    }
}

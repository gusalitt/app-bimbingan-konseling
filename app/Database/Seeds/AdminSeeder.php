<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 12; $i++) {
            $name = $faker->userName;
            $data = [
                'slug'             => url_title($name, '-', true),
                'username'         => $name,
                'email'            => $faker->unique()->safeEmail,
                'password'         => password_hash('admin123', PASSWORD_DEFAULT), 
                'tanggal_terdaftar' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'status'           => $faker->randomElement(['aktif', 'non-aktif']),
                'created_at'        => $faker->dateTime->format("Y-m-d H:i:s"),
                'updated_at'        => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('admin')->insert($data);
        }
    }
}

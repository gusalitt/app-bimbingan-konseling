<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'unique'         => true,
            ],
            'foto' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
                'default'        => '-',
            ],
            'nama_siswa' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'nisn' => [
                'type'           => 'CHAR',
                'constraint'     => 10,
                'unique'         => true,
            ],
            'kelas' => [
                'type'           => 'VARCHAR',
                'constraint'     => 10,
            ],
            'jurusan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id_siswa', true);
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}

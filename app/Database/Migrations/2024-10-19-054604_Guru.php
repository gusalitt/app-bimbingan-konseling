<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_guru' => [
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
            'nama_guru' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'mata_pelajaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'wali_kelas' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true,
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

        $this->forge->addKey('id_guru', true);
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable('guru');
    }
}

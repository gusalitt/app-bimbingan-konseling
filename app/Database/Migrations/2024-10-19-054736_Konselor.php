<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konselor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_konselor' => [
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
            'nama_konselor' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'no_telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => 15,
            ],
            'total_konseling' => [
                'type'           => 'INT',
                'constraint'     => 11,
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

        $this->forge->addKey('id_konselor', true);
        $this->forge->createTable('konselor');
    }

    public function down()
    {
        $this->forge->dropTable('konselor');
    }
}

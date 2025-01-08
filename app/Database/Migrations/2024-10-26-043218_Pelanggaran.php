<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggaran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'unique'         => true,
            ],
            'pelanggaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'tingkat_pelanggaran' => [
                'type'           => 'ENUM',
                'constraint'     => ['berat', 'sedang', 'ringan'],
                'default'    => 'ringan',
            ],
            'tindakan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'tanggal' => [
                'type'           => 'DATE',
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

        $this->forge->addKey('id_pelanggaran', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pelanggaran');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pelanggaran', 'pelanggaran_id_siswa_foreign');
        $this->forge->dropTable('pelanggaran');
    }
}

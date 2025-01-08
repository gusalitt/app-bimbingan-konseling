<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konseling extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_konseling' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_siswa' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'id_konselor' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'slug' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
            ],
            'tanggal' => [
                'type'              => 'DATE',
            ],
            'permasalahan' => [
                'type'              => 'TEXT',
            ],
            'tindakan' => [
                'type'              => 'TEXT',
            ],
            'catatan' => [
                'type'              => 'TEXT',
            ],
            'status' => [
                'type'              => 'ENUM',
                'constraint'        => ['Dijadwalkan', 'Selesai', 'Dibatalkan'],
                'default'           => 'Dijadwalkan',
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);

        $this->forge->addKey('id_konseling', true);

        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_konselor', 'konselor', 'id_konselor', 'CASCADE', 'CASCADE');

        $this->forge->createTable('konseling');
    }

    public function down()
    {
        $this->forge->dropForeignKey('konseling', 'konseling_id_siswa_foreign');
        $this->forge->dropForeignKey('konseling', 'konseling_id_konselor_foreign');
        $this->forge->dropTable('konseling');
    }
}

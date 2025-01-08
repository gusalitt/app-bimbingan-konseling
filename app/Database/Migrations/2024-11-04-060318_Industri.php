<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Industri extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_industri' => [
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
            'tempat_industri' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'tgl_mulai' => [
                'type'           => 'DATE',
            ],
            'tgl_selesai' => [
                'type'           => 'DATE',
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['aktif', 'non-aktif'],
                'default'        => 'aktif',
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

        $this->forge->addKey('id_industri', true);
        $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('industri');
    }

    public function down()
    {
        $this->forge->dropForeignKey('industri', 'industri_id_siswa_foreign');
        $this->forge->dropTable('industri');
    }
}

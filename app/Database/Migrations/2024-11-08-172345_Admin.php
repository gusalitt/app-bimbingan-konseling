<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'slug' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
            ],
            'username' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true,
            ],
            'password' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'tanggal_terdaftar' => [
                'type'              => 'DATETIME',
                'null'              => false,
            ],
            'status' => [
                'type'              => 'ENUM',
                'constraint'        => ['aktif', 'non-aktif'],
                'default'           => 'aktif',
            ],
            'remember_token' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
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

        $this->forge->addPrimaryKey('id_admin');
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}

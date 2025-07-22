<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SatkerCreate extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'id_satker' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
        ],
        'kode_satker' => [
            'type'       => 'VARCHAR',
            'constraint' => 250,
            'null'       => false,
        ],
        'nama_satker' => [
            'type'       => 'VARCHAR',
            'constraint' => 250,
            'null'       => false,
        ],
        'organisasi_id' => [
            'type'       => 'VARCHAR',
            'constraint' => 250,
            'null'       => false,
        ],
        'nama_organisasi' => [
            'type'       => 'VARCHAR',
            'constraint' => 250,
            'null'       => false,
        ],
        'kategori' => [
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ],
        'nama_kategori' => [
            'type'       => 'VARCHAR',
            'constraint' => 250,
            'null'       => false,
        ],
        'pembina' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
            'null'       => false,
        ],
        'created_at' => [
            'type'    => 'DATETIME',
            'null'       => true,
        ],
        'updated_at' => [
            'type'    => 'DATETIME',
            'null'       => true,
        ],
    ]);

    $this->forge->addKey('id', true); // Primary key
    $this->forge->createTable('satker');
}


    public function down()
    {
        //
    }
}

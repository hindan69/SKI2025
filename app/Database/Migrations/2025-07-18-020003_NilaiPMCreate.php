<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiPMCreate extends Migration
{
    public function up()
{
    $this->forge->addField([
        'idx' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'null'           => false,
            'auto_increment' => true,
        ],
        'id_user' => [
            'type'       => 'INT',
            'constraint' => 10,
            'null'       => false,
        ],
        'id_satker' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
            'null'       => false,
        ],
        'id_pm_satker' => [
            'type'       => 'INT',
            'constraint' => 10,
            'null'       => false,
        ],
        'nilai' => [
            'type'       => 'INT',
            'constraint' => 5,
            'null'       => false,
        ],
        'link_dakung' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
        ],
        'thn_dipa' => [
            'type'       => 'INT',
            'constraint' => 5,
            'null'       => false,
        ],
        'created_at' => [
            'type'    => 'DATETIME',
            'null'       => false,
        ],
        'updated_at' => [
            'type'    => 'DATETIME',
            'null'       => false,
        ],
    ]);

    $this->forge->addKey('idx', true); // Primary Key
    $this->forge->createTable('nilai_pm');
}

    public function down()
    {
        //
    }
}

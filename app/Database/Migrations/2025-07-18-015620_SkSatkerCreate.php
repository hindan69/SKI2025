<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SkSatkerCreate extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id_sk' => [
            'type'           => 'INT',
            'constraint'     => 5,
            'null'           => false,
            'auto_increment' => true,
        ],
        'id_satker' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
            'null'       => false,
        ],
        'id_user' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
            'null'       => false,
        ],
        'thn_anggaran' => [
            'type'       => 'VARCHAR',
            'constraint' => 5,
            'null'       => false,
        ],
        'link_sk' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
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

    $this->forge->addKey('id_sk', true); // Primary Key
    $this->forge->createTable('sk_pmsatker');
}


    public function down()
    {
        //
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TimauditCreate extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id_timaudit' => [
            'type'           => 'INT',
            'constraint'     => 10,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'id_satker' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
            'null'       => false,
        ],
        'nosurat' => [
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => true,
        ],
        'tgl_awal' => [
            'type' => 'DATE',
            'null' => false,
        ],
        'tgl_akhir' => [
            'type' => 'DATE',
            'null' => false,
        ],
        'tgl_surat' => [
            'type' => 'DATE',
            'null' => true,
        ],
        'tim' => [
            'type'       => 'VARCHAR',
            'constraint' => 30,
            'null'       => false,
        ],
        'penanggungjawab' => [
            'type'       => 'VARCHAR',
            'constraint' => 20,
            'null'       => false,
        ],
        'namapenanggung' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
            'null'       => false,
        ],
        'statustim' => [
            'type'       => 'INT',
            'constraint' => 10,
            'null'       => true,
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
    $this->forge->addKey('id_timaudit', true); // Primary key
    $this->forge->createTable('timaudit');
}


    public function down()
    {
        //
    }
}

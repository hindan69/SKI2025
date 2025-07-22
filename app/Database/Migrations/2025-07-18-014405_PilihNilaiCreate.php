<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PilihNilaiCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 255,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomer' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
            ],
            'nilai' => [
                'type'       => 'FLOAT',
                'null'       => false,
            ],
            'desc' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
    
        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('pilih_nilai');
    }
    

    public function down()
    {
        //
    }
}

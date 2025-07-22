<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KomponenCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komponen' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
                'auto_increment' => true,
            ],
            'nama_komponen' => [
                'type'       => 'VARCHAR',   
                'constraint' => 255,             
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

        $this->forge->addKey('id_komponen', true);
        $this->forge->createTable('komponen');
    }

    public function down()
    {
        //
    }
}

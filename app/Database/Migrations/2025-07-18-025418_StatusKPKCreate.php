<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusKPKCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
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
            'status' => [
                'type'       => 'INT',   
                'constraint' => 5,             
                'null'       => false,
            ],
            'thn_dipa' => [
                'type'       => 'INT',   
                'constraint' => 10,             
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('status_kpk');
    }

    public function down()
    {
        //
    }
}

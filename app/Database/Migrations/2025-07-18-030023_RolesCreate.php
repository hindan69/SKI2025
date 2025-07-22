<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',   
                'constraint' => 255,             
                'null'       => false,
            ],
            'display' => [
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

        $this->forge->addKey('id', true);
        $this->forge->createTable('roles');
    }

    public function down()
    {
        //
    }
}

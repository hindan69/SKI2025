<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssignPKCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pk' => [
                'type'       => 'INT',
                'constraint' => 50,
                'null'       => false,
                'auto_increment' => true,
            ],
            'id_timaudit' => [
                'type'       => 'VARCHAR',   
                'constraint' => 50,             
                'null'       => false,
            ],
            'id_auditor' => [
                'type'       => 'VARCHAR',   
                'constraint' => 50,             
                'null'       => false,
            ],
            'role_pk' => [
                'type'       => 'VARCHAR',   
                'constraint' => 50,             
                'null'       => false,
            ],
            'id_satker' => [
                'type'       => 'VARCHAR',   
                'constraint' => 50,             
                'null'       => false,
            ],
            'id_tu' => [
                'type'       => 'VARCHAR',   
                'constraint' => 50,             
                'null'       => false,
            ],
            'is_active' => [
                'type'       => 'VARCHAR',   
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

        $this->forge->addKey('id_pk', true);
        $this->forge->createTable('assign_pk');
    }

    public function down()
    {
        //
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubUnsurCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sub_unsur' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
                'auto_increment' => true,
            ],
            'name_sub_unsur' => [
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

        $this->forge->addKey('id_sub_unsur', true);
        $this->forge->createTable('sub_unsur');
    }

    public function down()
    {
        //
    }
}

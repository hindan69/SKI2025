<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnsurCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_unsur' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
                'auto_increment' => true,
            ],
            'nama_unsur' => [
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

        $this->forge->addKey('id_unsur', true);
        $this->forge->createTable('unsur');
    }

    public function down()
    {
        //
    }
}

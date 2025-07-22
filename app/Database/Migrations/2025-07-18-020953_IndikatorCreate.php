<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IndikatorCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_indikator' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
                'auto_increment' => true,
            ],
            'nama_indikator' => [
                'type'       => 'LONGTEXT',                
                'null'       => false,
            ],
            'bobot_indikator' => [
                'type'       => 'FLOAT',
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

        $this->forge->addKey('id_indikator', true);
        $this->forge->createTable('indikator');
    }

    public function down()
    {
        //
    }
}

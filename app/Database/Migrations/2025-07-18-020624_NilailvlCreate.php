<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilailvlCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idx' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => false,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'id_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'id_pm_satker' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'nilai' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'komentlvl' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => false,
            ],
            'rekomendasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => false,
            ],
            'thn_dipa' => [
                'type'       => 'INT',
                'constraint' => 5,
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
    
        $this->forge->addKey('idx', true); // Primary Key
        $this->forge->createTable('nilai_lvl');
    }

    public function down()
    {
        //
    }
}

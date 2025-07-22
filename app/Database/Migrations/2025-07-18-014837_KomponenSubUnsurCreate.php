<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KomponenSubUnsurCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komponen' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
            ],
            'id_unsur' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
            ],
            'id_sub_unsur' => [
                'type'       => 'INT',
                'constraint' => 255,
                'null'       => false,
            ],
            'id_indikator' => [
                'type'       => 'INT',
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

        $this->forge->addKey(['id_komponen', 'id_unsur', 'id_sub_unsur', 'id_indikator'], true);
        $this->forge->createTable('komponen_sub_unsur');
    }


    public function down()
    {
        //
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataumumCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dataumum' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => false,
                'auto_increment' => true,
            ],
            'id_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nama_pimpinan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nip_pimpinan' => [
                'type'       => 'BIGINT',
                'null'       => false,
            ],
            'nama_jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'nama_ketua' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nip_ketua' => [
                'type'       => 'BIGINT',
                'null'       => false,
            ],
            'alamat_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'kota_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'kodepos' => [
                'type'       => 'INT',
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
    
        $this->forge->addKey('id_dataumum', true);
        $this->forge->createTable('dataumum');
    }
    

    public function down()
    {
        //
    }
}

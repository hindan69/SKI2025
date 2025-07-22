<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersCreate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'role' => [
                'type'       => 'INT',
                'constraint' => 10,
                'null'       => false,
            ],
            'id_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'id_user_spip' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'is_active' => [
                'type'       => 'INT',
                'constraint' => 10,
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
        $this->forge->createTable('users');
    }
    

    public function down()
    {
        //
    }
}

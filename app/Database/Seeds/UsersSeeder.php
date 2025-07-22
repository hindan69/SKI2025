<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [                
                'username'    => 'pmitjen1',
                'firstname' => 'SEKRETARIAT INSPEKTORAT JENDERAL',
                'lastname' => 'create by spip',
                'email' => null,
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'role' => 4,
                'id_satker' => 208,
                'id_user_spip' => '',
                'is_active' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [                
                'username'    => 'sesitjen',
                'firstname' => 'SEKRETARIAT INSPEKTORAT JENDERAL',
                'lastname' => 'create by spip',
                'email' => null,
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'role' => 3,
                'id_satker' => 208,
                'id_user_spip' => '',
                'is_active' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [                
                'username'    => '199504282020121004',
                'firstname' => 'TOMMI ANDREAN, S.Kom',
                'lastname' => 'PRANATA KOMPUTER AHLI PERTAMA',
                'email' => '-',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'role' => 5,
                'id_satker' => 0,
                'id_user_spip' => '',
                'is_active' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [                
                'username'    => '197905172010121001',
                'firstname' => 'ARIO AGUNG BRAMANTHI, S.Kom, CertDA',
                'lastname' => '-',
                'email' => '-',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'role' => 5,
                'id_satker' => 0,
                'id_user_spip' => '',
                'is_active' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}

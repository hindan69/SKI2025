<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubUnsurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_sub_unsur' => 1,
                'name_sub_unsur' => 'Dukungan Sumber Daya Manusia',
            ],
            [
                'id_sub_unsur' => 2,
                'name_sub_unsur' => 'Akses Data & Informasi',
            ],
            [
                'id_sub_unsur' => 3,
                'name_sub_unsur' => 'Komunikasi',
            ],
            [
                'id_sub_unsur' => 4,
                'name_sub_unsur' => 'Pengelolaan Keuangan',
            ],
            [
                'id_sub_unsur' => 5,
                'name_sub_unsur' => 'Kinerja',
            ],
            [
                'id_sub_unsur' => 6,
                'name_sub_unsur' => 'Kedisiplinan Pegawai',
            ],
            [
                'id_sub_unsur' => 7,
                'name_sub_unsur' => 'Reformasi Birokrasi/WBK/WBBM',
            ],
        ];
        
       $this->db->table('sub_unsur')->insertBatch($data);
    }
}

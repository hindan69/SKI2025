<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KomponenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_komponen' => 1,
                'nama_komponen' => 'Komponen Pengungkit',
            ],
            [
                'id_komponen' => 2,
                'nama_komponen' => 'Komponen Hasil',
            ],
        ];
        $this->db->table('komponen')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KomponenSubUnsurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 1],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 2],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 3],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 4],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 5],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 6],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 1, 'id_indikator' => 7],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 2, 'id_indikator' => 8],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 2, 'id_indikator' => 9],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 2, 'id_indikator' => 10],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 3, 'id_indikator' => 11],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 3, 'id_indikator' => 12],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 3, 'id_indikator' => 13],
            ['id_komponen' =>1,'id_unsur' => 1, 'id_sub_unsur' => 3, 'id_indikator' => 14],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 4, 'id_indikator' => 15],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 4, 'id_indikator' => 16],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 4, 'id_indikator' => 17],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 4, 'id_indikator' => 18],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 4, 'id_indikator' => 19],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 20],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 21],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 22],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 23],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 24],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 25],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 26],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 27],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 28],
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 5, 'id_indikator' => 29],            
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 7, 'id_indikator' => 30],                        
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 7, 'id_indikator' => 31],                                    
            ['id_komponen' =>1,'id_unsur' => 2, 'id_sub_unsur' => 7, 'id_indikator' => 32],
        ];
        $this->db->table('komponen_sub_unsur')->insertBatch($data);
    }
}

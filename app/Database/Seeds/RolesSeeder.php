<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {   
        $data = [
            [
                'id' => 0,
                'name' => 'Ketua Tim PK',
                'display' => 'Ketua Tim PK',
            ],
            [
                'id' => 1,
                'name' => 'superadmin',
                'display' => 'Super Admin',
            ],
            [
                'id' => 2,
                'name' => 'admin_tu_itjen',
                'display' => 'Admin Inspektorat (TU)',
            ],
            [
                'id' => 3,
                'name' => 'satker_approval',
                'display' => 'Pimpinan Satker',
            ],
            [
                'id' => 4,
                'name' => 'satker_pm',
                'display' => 'Penilaian Mandiri Satker',
            ],
            [
                'id' => 5,
                'name' => 'auditor',
                'display' => 'Auditor',
            ],
            [
                'id' => 6,
                'name' => 'inspektur',
                'display' => 'Inspektur Inspektorat',
            ],
            [
                'id' => 7,
                'name' => 'satker_admin',
                'display' => 'Admin Satker',
            ],
            [
                'id' => 8,
                'name' => 'eselon_1',
                'display' => 'Eselon I',
            ],
            [
                'id' => 9,
                'name' => 'inspektur_jenderal',
                'display' => 'Inspektur Jenderal',
            ],
            [
                'id' => 10,
                'name' => 'Ketua Tim PK',
                'display' => 'Ketua Tim PK',
            ],
            [
                'id' => 11,
                'name' => 'Anggota Tim PK',
                'display' => 'Anggota Tim PK',
            ],
            [
                'id' => 12,
                'name' => 'Ketua Tim Level',
                'display' => 'Ketua Tim Level',
            ],
            [
                'id' => 13,
                'name' => 'Anggota Tim Level',
                'display' => 'Anggota Tim Level',
            ],
        ];        
        $this->db->table('roles')->insertBatch($data);
    }
}

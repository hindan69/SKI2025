<?php

namespace App\Models;

use CodeIgniter\Model;

class DataUmumModel extends Model
{
    protected $table            = 'dataumum';
    protected $primaryKey       = 'id_dataumum';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_dataumum',
        'id_satker',
        'nama_pimpinan',
        'nip_pimpinan',
        'nama_jabatan',
        'nama_ketua',
        'nip_ketua',
        'alamat_satker',
        'kota_satker',
        'kodepos'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getBySatker($id_satker)
    {
        return $this->where('id_satker', $id_satker)->findAll();
    }

    public function edit($data)
    {
        $id_satker = $data['id_satker'];
        $builder = $this->db->table('dataumum');
        $builder->where('id_satker', $id_satker);
        return $builder->update($data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PimPKModel extends Model
{
    protected $table            = 'status_kpk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_satker', 'id_user', 'thn_dipa', 'status', 'nilai_pk', 'created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function filter($id_satker, $thn_dipa)
    {
        $builder = $this->db->table('status_kpk');
        $builder->select('*');
        $builder->where('id_satker', $id_satker);
        $builder->where('thn_dipa', $thn_dipa);
        $query = $builder->get();
        return $query->getResultArray();
    }
}

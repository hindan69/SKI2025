<?php

namespace App\Models;

use CodeIgniter\Model;

class SPimPMModel extends Model
{
    protected $table            = 'status_pim';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_satker', 'id_user', 'thn_dipa', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function filter($id_satker, $thn_dipa)
    {
        $builder = $this->db->table('status_pim');
        $builder->select('*');
        $builder->where('id_satker', $id_satker);
        $builder->where('thn_dipa', $thn_dipa);
        $query = $builder->get();
        return $query->getResultArray();
    }
}

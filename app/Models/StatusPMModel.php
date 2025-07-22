<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPMModel extends Model
{
    protected $table            = 'status_pm';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_satker', 'id_user', 'status', 'thn_dipa', 'nilai_pm'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function filter($id_satker, $thn_dipa)
    {
        $builder = $this->db->table('status_pm');
        $builder->select('*');
        $builder->where('id_satker', $id_satker);
        $builder->where('thn_dipa', $thn_dipa);
        $query = $builder->get();
        return $query->getResultArray();
    }
}

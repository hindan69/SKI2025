<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaTimModel extends Model
{
    protected $table            = 'assign_pk';
    protected $primaryKey       = 'id_pk';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pk', 'id_timaudit', 'id_auditor', 'rolepk', 'id_satker', 'created_date', 'id_tu', 'is_active'];


    public function getByID($id)
    {
        $builder = $this->db->table('assign_pk as a');
        $builder->select('a.id_pk, a.id_timaudit, a.id_auditor, a.rolepk, a.id_satker, a.created_date, a.id_tu, a.is_active, b.username, b.firstname');
        $builder->join('users as b', 'a.id_auditor = b.id', 'left');
        $builder->where('a.id_timaudit', $id); // variabel $id berisi id_timaudit yang ingin difilter
        $builder->orderBy('a.rolepk', 'ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function updateByStat($data)
    {
        $id = $data['id_timaudit'];
        $builder = $this->db->table('assign_pk');
        $builder->where('id_timaudit', $data['id_timaudit']);
        return $builder->update([
            'is_active'  => $data['is_active']
        ]);
    }
}

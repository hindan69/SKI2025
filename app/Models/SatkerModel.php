<?php

namespace App\Models;

use CodeIgniter\Model;

class SatkerModel extends Model
{
    protected $table            = 'satker';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getSatkerByPembina($pembina)
    {
        return $this->where('pembina', $pembina)
            ->findAll();
    }

    public function getNilai($id)
    {
        $builder = $this->db->table('sk_pmsatker AS sk');
        $builder->select('
        sk.id_satker,
        sk.thn_anggaran,
        stkr.nama_satker,
        stkr.pembina,
        COALESCE(spm.status, 0) AS status_pim,
        COALESCE(spk.status, 0) AS status_kpk,
        COALESCE(slvl.status, 0) AS status_klvl
        ');

        // Join tabel-tabel yang diperlukan
        $builder->join('satker AS stkr', 'stkr.id = sk.id_satker', 'left');
        $builder->join('status_pim AS spm', 'spm.id_satker = sk.id_satker AND spm.thn_dipa = sk.thn_anggaran', 'left');
        $builder->join('status_kpk AS spk', 'spk.id_satker = sk.id_satker AND spk.thn_dipa = sk.thn_anggaran', 'left');
        $builder->join('status_klvl AS slvl', 'slvl.id_satker = sk.id_satker AND slvl.thn_dipa = sk.thn_anggaran', 'left');
        // Jika ada filter id_satker dan thn_anggaran
        $builder->where('sk.id_satker', $id);
        $builder->orderBy('sk.thn_anggaran', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSatker($id)
    {
        $builder = $this->db->table('satker');
        $query = $builder->where('id', $id)->get();        
  
        return $query->getResult();
    }
}

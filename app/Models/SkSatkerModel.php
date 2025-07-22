<?php

namespace App\Models;

use CodeIgniter\Model;

class SkSatkerModel extends Model
{
    protected $table            = 'sk_pmsatker';
    protected $primaryKey       = 'id_sk';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_sk', 'id_satker', 'id_user', 'thn_anggaran', 'link_sk'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function statusSK($id_satker)
    {
        // Query builder CodeIgniter
        $builder = $this->db->table('sk_pmsatker AS A');
        $builder->select('
            A.id_sk,
            A.id_satker,
            A.thn_anggaran,
            A.link_sk,
            COALESCE(B.status, 0) AS status_pim,
            COALESCE(C.status, 0) AS status_kpk,
            COALESCE(D.status, 0) AS status_klvl
        ');
        $builder->join('status_pim AS B', 'A.id_satker = B.id_satker AND A.thn_anggaran = B.thn_dipa', 'left');
        $builder->join('status_kpk AS C', 'A.id_satker = C.id_satker AND A.thn_anggaran = C.thn_dipa', 'left');
        $builder->join('status_klvl AS D', 'A.id_satker = D.id_satker AND A.thn_anggaran = D.thn_dipa', 'left');
        $builder->where('A.id_satker', $id_satker);

        // Eksekusi query
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function edit($data)
    {
        $id_sk = $data['id_sk'];
        $builder = $this->db->table('sk_pmsatker');
        $builder->where('id_sk', $id_sk);
        return $builder->update($data);
    }

    public function resume($data)
    {
        $pembina = $data;
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
        $builder->where('stkr.pembina', $pembina);
        $builder->orderBy('sk.thn_anggaran', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function resumeAll()
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
        $builder->orderBy('sk.thn_anggaran', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}

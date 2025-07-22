<?php

namespace App\Models;

use CodeIgniter\Model;

class TimauditModel extends Model
{
    protected $table            = 'timaudit';
    protected $primaryKey       = 'id_timaudit';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_timaudit', 'id_satker', 'nosurat', 'tgl_awal', 'tgl_akhir', 'tgl_surat', 'tim', 'penanggungjawab', 'namapenanggung', 'statustim'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getByIR($ir)
    {
        $builder = $this->db->table('timaudit as a');
        $builder->select('a.id_timaudit, b.nama_satker, b.nama_organisasi, a.tgl_surat, a.tim, a.statustim');
        $builder->join('satker as b', 'a.id_satker = b.id', 'left');
        $builder->where('b.pembina', $ir);
        $builder->orderBy('a.tgl_surat', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getByID($id)
    {
        $builder = $this->db->table('timaudit as a');
        $builder->select('a.id_timaudit, a.nosurat,a.id_satker, b.nama_satker, a.tgl_awal, a.tgl_akhir, a.tgl_surat, a.tim, a.statustim');
        $builder->join('satker as b', 'a.id_satker = b.id', 'left');
        $builder->where('a.id_timaudit', $id);
        $builder->orderBy('a.tgl_surat', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function updateByID($data)
    {
        $id = $data['id_timaudit'];
        $builder = $this->db->table('timaudit');
        $builder->where('id_timaudit', $data['id_timaudit']);
        return $builder->update([
            'tgl_awal'  => $data['tglAwal'],
            'tgl_akhir' => $data['tglAkhir']
        ]);
    }

    public function updateByStat($data)
    {
        $id = $data['id_timaudit'];
        $builder = $this->db->table('timaudit');
        $builder->where('id_timaudit', $data['id_timaudit']);
        return $builder->update([
            'statustim'  => $data['statustim']
        ]);
    }
}
